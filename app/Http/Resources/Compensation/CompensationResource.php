<?php

namespace App\Http\Resources\Compensation;

use App\Http\Resources\History\HistoryResource;

class CompensationResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    private $history;

    public function __construct($resource, $history = null)
    {
        parent::__construct($resource);
        $this->history = $history;
    }

    public function toArray($request)
    {
        return [
            'date_request' => strtotime($this->resource->created_at),
            'compensation_id' => $this->resource->id,
            'diagnose' => $this->resource->diagnose,
            'pay_request'=>number_format($this->resource->pay_request).'đ',
            'status'=>(int)$this->resource->status,
            'history'=>$this->history?new HistoryResource($this->history):new \stdClass()
        ];
    }
}
