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
        $contract = DB::table($this->model->getTable())->where('user_id', $userId)->first();
        if ($contract)
        {
            return new ContractResources($contract);
        }
        return new \stdClass();
    }
}
