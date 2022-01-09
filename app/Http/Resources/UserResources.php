<?php

namespace App\Http\Resources;

use App\Repository\Compensation\CompensationRepositoryInterface;
use App\Repository\Contracts\ContractRepositoryInterface;

class UserResources extends \Illuminate\Http\Resources\Json\JsonResource
{
    public function toArray($request)
    {
        $contract = app()->make(ContractRepositoryInterface::class)->getByUser($this->resource->id);
        $numberRequest = 0;
        if ($this->resource->role > 0)
        {
            $numberRequest = app()->make(CompensationRepositoryInterface::class)->getNumberRequest();
        }
        return [
            'id' => $this->resource->id,
            'username' => $this->resource->username,
            'role' => (int)$this->resource->role,
            'contracts'=>$contract,
            'number_request'=>$numberRequest
        ];
    }
}
