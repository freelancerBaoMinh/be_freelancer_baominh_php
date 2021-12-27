<?php

namespace App\Repository\Contracts;

use App\Http\Resources\ContractResources;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class ContractRepository extends \App\Repository\BaseRepository implements ContractRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Contract::class;
    }
    public function getByUser($userId)
    {
        $select = ['name', 'email', 'contract_number', 'code', 'company_name',
            'date_of_birth', 'cmnd', 'gender', 'effective_date', 'end_date', 'agency_ids',
            'gender', 'package_code', 'relationship'];
        $contract = DB::table($this->model->getTable())->select($select)
            ->where('user_id', $userId)
            ->where('status', 1)
            ->first();
        if ($contract)
        {
            return new ContractResources($contract);
        }
        return new \stdClass();
    }
    public function getList($page = 1): array
    {
        $query = DB::table($this->model->getTable())->selectRaw("id,name, email, contract_number, code, company_name,
            date_of_birth, cmnd, gender, effective_date, end_date,
            gender, package_code, relationship")->where('status', 1);
        if ($page > 1)
        {
            $query = $query->where('id','>', $page);
        }
        $list = $query->limit(20)->get();
        $lastId = 0;
        if ($list->last() && sizeof($list) === 20)
        {
            $lastId = $list->last()->id;
        }
        return [
            'list'=>ContractResources::collection($list),
            'next_page'=>$lastId
        ];
    }
}
