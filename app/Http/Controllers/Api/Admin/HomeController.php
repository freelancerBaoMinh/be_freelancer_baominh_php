<?php

namespace App\Http\Controllers\Api\Admin;

use App\Repository\Compensation\CompensationRepositoryInterface;
use App\Repository\Contracts\ContractRepositoryInterface;
use App\Repository\Details\DetailRepositoryInterface;
use App\Repository\History\HistoryRepositoryInterface;
use App\Repository\Packages\PackageRepositoryInterface;
use App\Repository\Packages\PackageUserRepositoryInterface;
use App\Repository\Rules\RuleRepositoryInterface;
use App\Repository\Users\UserRepositoryInterface;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends \App\Http\Controllers\Controller
{
    use ApiResponse;

    /**
     * @var PackageRepositoryInterface
     */
    private $packageRepository;
    /**
     * @var DetailRepositoryInterface
     */
    private $detailRepository;
    /**
     * @var RuleRepositoryInterface
     */
    private $ruleRepository;
    /**
     * @var PackageUserRepositoryInterface
     */
    private $packageUserRepository;
    /**
     * @var ContractRepositoryInterface
     */
    private $contractRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var CompensationRepositoryInterface
     */
    private $compensationRepository;
    /**
     * @var HistoryRepositoryInterface
     */
    private $historyRepository;

    public function __construct(PackageRepositoryInterface      $packageRepository,
                                DetailRepositoryInterface       $detailRepository,
                                RuleRepositoryInterface         $ruleRepository,
                                PackageUserRepositoryInterface  $packageUserRepository,
                                ContractRepositoryInterface     $contractRepository,
                                UserRepositoryInterface         $userRepository,
                                CompensationRepositoryInterface $compensationRepository,
                                HistoryRepositoryInterface      $historyRepository
    )
    {
        $this->packageRepository = $packageRepository;
        $this->detailRepository = $detailRepository;
        $this->ruleRepository = $ruleRepository;
        $this->packageUserRepository = $packageUserRepository;
        $this->contractRepository = $contractRepository;
        $this->userRepository = $userRepository;
        $this->compensationRepository = $compensationRepository;
        $this->historyRepository = $historyRepository;
    }

    public function listPackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = (int)$request->get('page', 1);
        $list = $this->packageRepository->getList($page);
        return $this->successResponseMessage($list, 200, 'success');
    }

    public function detailPackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'package_id' => 'numeric|required'
        ]);
        return $this->successResponseMessage($this->detailRepository->getDetail($request->get('package_id')), 200, 'success');
    }

    public function listRule(): \Illuminate\Http\JsonResponse
    {
        $list = $this->ruleRepository->listRule();
        return $this->successResponseMessage($list, 200, 'success');
    }

    public function createPackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'name' => 'string|required',
            'benefit' => 'string|required'
        ]);
        $benefit = $request->get('benefit', '[]');
        $benefit = json_decode($benefit, true);
        if (!is_array($benefit)) {
            return $this->successResponseMessage(new \stdClass(), 4003, 'success');
        }
        $package = $this->packageRepository->create($request->only(['name', 'code']));
        $details = [];
        foreach ($benefit as $detail) {
            if (isset($detail['rule_id'])) {
                $detail['package_id'] = $package->id;
                $detail['created_at'] = Carbon::now();
                $details[] = $detail;
            }
        }
        $this->detailRepository->insert($details);
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    public function deletePackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'package_id' => 'required|numeric'
        ]);
        $userLogin = $request->get('user');
        if ($userLogin->role != 2) {
            return $this->successResponseMessage(new \stdClass(), 403, 'Bạn không có quyền');
        }
        $this->packageRepository->update(['id' => $request->get('package_id')], ['status' => 0]);
        $this->packageUserRepository->update(['package_id' => $request->get('package_id')], ['status' => 0]);
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    public function listContract(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = (int)$request->get('page', 1);
        $list = $this->contractRepository->getList($page);
        return $this->successResponseMessage($list, 200, 'success');
    }

    public function deleteContract(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'contract_id' => 'required|numeric'
        ]);
        $userLogin = $request->get('user');
        if ($userLogin->role != 2) {
            return $this->successResponseMessage(new \stdClass(), 403, 'Bạn không có quyền');
        }
        $contractId = (int)$request->get('contract_id');
        $this->contractRepository->update(['id' => $contractId], ['status' => 0]);
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    public function updateContract(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'contract_id' => 'required|numeric',
            'contract_number' => 'string|max:100',
            'code' => 'string|max:10',
            'name' => 'string|max:255',
            'company_name' => 'string|max:255',
            'date_of_birth' => 'numeric',
            'cmnd' => 'string|max:20',
            'gender' => 'numeric|max:1|min:0',
            'effective_date' => 'numeric',
            'end_date' => 'numeric',
            'email' => 'string|email',
            'relationship' => 'string|max:255'
        ]);
        $input = $request->only(['contract_number', 'code', 'name', 'company_name',
            'date_of_birth', 'cmnd', 'gender', 'effective_date', 'end_date', 'email', 'relationship']);
        $contractId = (int)$request->get('contract_id');
        if (isset($input['date_of_birth'])) {
            $input['date_of_birth'] = date('Y-m-d', $input['date_of_birth']);
        }
        if (isset($input['effective_date'])) {
            $input['effective_date'] = date('Y-m-d', $input['effective_date']);
        }
        if (isset($input['end_date'])) {
            $input['end_date'] = date('Y-m-d', $input['end_date']);
        }
        $this->contractRepository->update(['id' => $contractId], $input);
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    public function createAccount(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'username' => 'required|string|min:6',
            'password' => 'required|string|min:6',
            'role' => 'numeric|min:0|max:2'
        ]);
        $username = $request->get('username');
        $userLogin = $request->get('user');
        $user = $this->userRepository->findByUsername($username);
        if ($user) {
            return $this->successResponseMessage(new \stdClass(), 4004, 'Username đã tồn tại');
        }
        $input = $request->only(['username', 'password', 'role']);
        $input['admin_id'] = $userLogin->id;
        $user = $this->userRepository->create($input);
        unset($user->admin_id);
        unset($user->fcm_token);
        unset($user->status);
        unset($user->device);
        return $this->successResponseMessage($user, 200, 'success');
    }

    public function listAccount(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = (int)$request->get('page', 1);
        $keyword = $request->get('keyword', '');
        $list = $this->userRepository->getList($keyword, $page);
        return $this->successResponseMessage($list, 200, 'success');
    }

    public function updateAccount(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'role' => 'numeric|min:0|max:2'
        ]);
        $this->userRepository->update(['id' => (int)$request->get('user_id')], ['role' => $request->get('role')]);
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    public function deleteAccount(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'user_id' => 'required|numeric'
        ]);
        $this->userRepository->update(['id' => (int)$request->get('user_id')], ['status' => 0]);
        return $this->successResponseMessage(new \stdClass(), 200, 'success');
    }

    public function accept(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'compensation_id' => 'required|numeric',
            'pay_total' => 'required|numeric',
            'pay_content' => 'required|string'
        ]);
        $user = $request->get('user');
        $compensationId = (int)$request->get('compensation_id');
        $compensation = $this->compensationRepository->findById($compensationId);
        if ($compensation) {
            if ($compensation->status === 1) {
                return $this->errorResponse('Compensation has been processed', 444);
            }
            $compensation->update([
                'status' => 1
            ]);
            $input = $request->only(['compensation_id', 'pay_total', 'pay_content']);
            $input['admin_id'] = $user->id;
            $input['reason'] = $compensation->diagnose;
            $input['user_id'] = $compensation->user_id;
            $input['date_request'] = strtotime($compensation->created_at);
            $input['pay_date'] = strtotime(Carbon::now());
            $input['status'] = 1;
            $this->historyRepository->create($input);
            return $this->successResponseMessage(new \stdClass(), 200, 'success');
        }
        return $this->errorResponse('Compensation not found', 404);
    }
    public function cancel(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'compensation_id' => 'required|numeric',
            'reason' => 'required|string'
        ]);
        $user = $request->get('user');
        $compensationId = (int)$request->get('compensation_id');
        $compensation = $this->compensationRepository->findById($compensationId);
        if ($compensation) {
            if ($compensation->status === 1) {
                return $this->errorResponse('Compensation has been processed', 444);
            }
            $compensation->update([
                'status' => 1
            ]);
            $input = $request->only(['compensation_id', 'pay_total', 'pay_content']);
            $input['admin_id'] = $user->id;
            $input['reason'] = $request->get('reason');
            $input['user_id'] = $compensation->user_id;
            $input['date_request'] = strtotime($compensation->created_at);
            $input['pay_date'] = strtotime(Carbon::now());
            $input['status'] = 0;
            $this->historyRepository->create($input);
            return $this->successResponseMessage(new \stdClass(), 200, 'success');
        }
        return $this->errorResponse('Compensation not found', 404);
    }
    public function listCompensation(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = (int)$request->get('page', 1);
        $list = $this->compensationRepository->list(0, $page);
        return $this->successResponseMessage($list, 200, 'success');
    }
}
