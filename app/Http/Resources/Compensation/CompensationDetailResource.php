<?php

namespace App\Http\Resources\Compensation;

class CompensationDetailResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    /**
     * @var mixed
     */
    private $user;
    public function __construct($resource, $user = null)
    {
        parent::__construct($resource);
        $this->user = $user;
    }

    public function toArray($request)
    {
        return [
            'compensation_id' => $this->resource->id,
            'date_request' => strtotime($this->resource->created_at),
            'diagnose' => $this->resource->diagnose,
            'pay_request'=>number_format($this->resource->pay_request).'đ',
            'media'=>json_decode($this->resource->media),
            'insurance_name'=>$this->resource->insurance_name,
            'birthday'=>$this->resource->birthday,
            'phone'=>$this->resource->phone,
            'cmnd'=>$this->resource->cmnd,
            'email'=>$this->resource->email,
            'level'=>number_format($this->resource->level).'đ',
            'day_off'=>$this->resource->day_off,
            'date_of_acident'=>$this->resource->date_of_acident,
            'hospital_name'=>$this->resource->hospital_name,
            'date_of_admission'=>$this->resource->date_of_admission,
            'date_of_discharge'=>$this->resource->date_of_discharge,
            'employee_request'=>$this->user??new \stdClass()
        ];
    }
}
