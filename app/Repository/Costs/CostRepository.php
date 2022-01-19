<?php

namespace App\Repository\Costs;

use App\Models\Cost;
use Illuminate\Support\Facades\DB;

class CostRepository extends \App\Repository\BaseRepository implements CostRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Cost::class;
    }
    public function insertCost($input, $requestId)
    {
        $data = [];
        foreach ($input as $cost)
        {
            if (isset($cost['invoice_date']) && isset($cost['cost']))
            $data[] = [
              'invoice_date'=>$cost['invoice_date'],
              'cost'=>$cost['cost'],
              'request_id'=>$requestId
            ];
        }
        DB::table($this->model->getTable())->insert($data);
    }
    public function getCostByRequest($requestIds): \Illuminate\Support\Collection
    {
        return DB::table($this->model->getTable())
            ->whereIn('request_id', $requestIds)
            ->get()
            ->groupBy('request_id');
    }
}
