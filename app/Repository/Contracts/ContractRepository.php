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
            'gender', 'package_code', 'relationship','id'];
        $contract = DB::table($this->model->getTable())->select($select)
            ->where('user_id', $userId)
            ->where('status', 1)
            ->where('relationship', 0)
            ->first();
        if ($contract)
        {
            return new ContractResources($contract);
        }
        return new \stdClass();
    }
    public function getList($page = 1): array
    {
        $resp = $this->paginateSortDesc(['status'=>1], ['id','name','email','contract_number','code','company_name',
            'date_of_birth','cmnd','gender','effective_date','end_date','package_code','relationship'], $page);
        $resp['list'] = ContractResources::collection($resp['list']);
        return $resp;
    }
}
