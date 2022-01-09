<?php

namespace App\Http\Resources\History;

class HistoryResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'pay_date'=>$this->resource->pay_date,
            'pay_total'=>($this->resource->pay_total > 0)? number_format($this->resource->pay_total).'đ':'',
            'reason'=>$this->resource->reason,
            'pay_content'=>$this->resource->pay_content,
            'status'=>(int)$this->resource->status
        ];
    }
}
