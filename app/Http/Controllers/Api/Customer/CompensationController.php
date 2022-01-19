<?php

namespace App\Http\Controllers\Api\Customer;

use App\Repository\Compensation\CompensationRepositoryInterface;
use App\Repository\Costs\CostRepositoryInterface;
use App\Repository\Details\DetailRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tymon\JWTAuth\JWTAuth;

class CompensationController extends \App\Http\Controllers\Controller
{
    use ApiResponse;
    /**
     * @var CompensationRepositoryInterface
     */
    private $compensationRepository;
    /**
     * @var \Tymon\JWTAuth\Contracts\JWTSubject
     */
    private $userLogin;
    /**
     * @var int|mixed
     */
    private $userId;
    /**
     * @var DetailRepositoryInterface
     */
    private $detailRepository;
    /**
     * @var CostRepositoryInterface
     */
    private $costRepository;

    public function __construct(JWTAuth $jwt, CompensationRepositoryInterface $compensationRepository,
                                DetailRepositoryInterface $detailRepository,
                                CostRepositoryInterface $costRepository
    )
    {
        $this->compensationRepository = $compensationRepository;
        $this->userLogin = $jwt->user();
        $this->userId = ($this->userLogin)?$this->userLogin->id:0;
        $this->detailRepository = $detailRepository;
        $this->costRepository = $costRepository;
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'insurance_name'=>'required|string',
            'email'=>'required|email|string|max:50',
            'phone'=>'required|numeric',
            'cmnd'=>'required|string|max:20',
            'level'=>'required|numeric',
            'pay_request'=>'required|numeric',
            'day_off'=>'required|numeric',
            'is_cash'=>'required|numeric|max:1',
            'birthday'=>'required|numeric',
            'bank_number'=>'string|max:255',
            'bank_name'=>'string|max:255',
            'bank_addr'=>'string',
            'bank_account'=>'string|max:255',
            'date_of_acident'=>'required|numeric',
            'diagnose'=>'required|string',
            'hospital_name'=>'required|string',
            'date_of_admission'=>'required|numeric',
            'date_of_discharge'=>'required|numeric',
            'media' => 'array|max:5',
            'media.*' => 'image|mimes:jpg,jpeg,png|max:5120',
            'cost'=>'string'
        ]);
        $input = $request->only([
            'insurance_name','email','phone','cmnd','level','pay_request','day_off','is_cash','birthday','bank_number',
            'bank_name','bank_addr','bank_account','date_of_acident','diagnose','hospital_name','date_of_admission','date_of_discharge'
            ]);
        if ($request->has('media'))
        {
            $media = $this->moveImage($request->file('media'), $this->userId);
            $input['media'] = json_encode($media);
        }
        $input['user_id'] = $this->userId;
        $compensation = $this->compensationRepository->create($input);
        $costs = $request->get('cost', '[]');
        $costs = json_decode($costs, true);
        if (is_array($costs) && sizeof($costs) > 0)
        {
            $this->costRepository->insertCost($costs, $compensation->id);
        }
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    private function moveImage($files, $userId = 0): array
    {
        $images = [];
        $path = public_path('images/'.$userId);
        foreach ($files as $file) {
            $fileName = Str::random(4) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $images[] = env('APP_PATH').'images/' .$userId.'/'. $fileName;
            $file->move($path, $fileName);
        }
        return $images;
    }
    public function detail(Request $request)
    {
        $this->validate($request, [
            'compensation_id'=>'required|numeric'
        ]);
        $compensationId = $request->get('compensation_id');
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }
    public function list(Request  $request)
    {
        $page = (int)$request->get('page', 1);
        $list = $this->compensationRepository->listByUser($this->userId, $page);
        return $this->successResponseMessage($list, 200, 'success');
    }
    public function detailPackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'package_id' => 'numeric|required'
        ]);
        return $this->successResponseMessage($this->detailRepository->getDetail($request->get('package_id')), 200, 'success');
    }
}
