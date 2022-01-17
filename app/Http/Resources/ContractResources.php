<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResources extends JsonResource
{
    /**
     * @var mixed|null
     */
    private $package;

    public function __construct($resource, $package = null)
    {
        parent::__construct($resource);
        $this->package = $package;
    }

    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'contract_number' => $this->resource->contract_number,
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'company_name'=>$this->resource->company_name,
            'birthday'=>date('d-m-Y', strtotime($this->resource->date_of_birth)),
            'cmnd'=>$this->resource->cmnd,
            'gender'=>($this->resource->gender === 0)?'Nữ':'Nam',
            'effective_date'=>date('d-m-Y', strtotime($this->resource->effective_date)),
            'end_date'=>date('d-m-Y', strtotime($this->resource->end_date)),
            'email'=>$this->resource->email,
            'package'=>$this->package??new \stdClass(),
            'relation_name'=>$this->resource->relationship_name??''
        ];
    }
}
