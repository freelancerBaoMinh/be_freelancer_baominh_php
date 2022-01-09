<?php

namespace App\Repository\History;

use App\Models\History;
use Illuminate\Support\Facades\DB;

class HistoryRepository extends \App\Repository\BaseRepository implements HistoryRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return History::class;
    }
    public function getListById($compensationIds): \Illuminate\Support\Collection
    {
        return DB::table($this->model->getTable())
            ->select(['id','pay_date','pay_total','reason','pay_content','status','compensation_id'])
            ->whereIn('compensation_id', $compensationIds)
            ->get()->keyBy('compensation_id');
    }
}
