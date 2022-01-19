<?php

namespace App\Repository\Compensation;

use App\Http\Resources\Compensation\CompensationCollection;
use App\Http\Resources\Compensation\CompensationDetailCollection;
use App\Models\Compensation;
use Illuminate\Support\Facades\DB;

class CompensationRepository extends \App\Repository\BaseRepository implements CompensationRepositoryInterface
{
    /**
     * @var string
     */
    private $table;

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        $this->table = 'compensations';
        // TODO: Implement getModel() method.
        return Compensation::class;
    }
    public function getNumberRequest()
    {
        $field = DB::table($this->table)->selectRaw("COUNT(1) as number")
            ->where('status', 0)
            ->first();
        if ($field)
        {
            return $field->number;
        }
        return 0;
    }
    public function listByUser($userId, $page = 1): array
    {
        $resp = $this->paginateSortDesc(['user_id'=>$userId], ['created_at','id','pay_request','diagnose','status'], $page);
        $ids = $resp['list']->pluck('id')->toArray();
        $resp['list'] = new CompensationCollection($resp['list'], $ids);
        return $resp;
    }
    public function list($status =0, $page = 1): array
    {
        $resp = $this->paginateSortDesc(['status'=>$status], ['*'], $page);
        $userIds = $resp['list']->pluck('user_id')->toArray();
        $ids = $resp['list']->pluck('id')->toArray();
        $resp['list'] = new CompensationDetailCollection($resp['list'], $userIds, $ids);
        return $resp;
    }
}
