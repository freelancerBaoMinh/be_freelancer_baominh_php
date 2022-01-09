<?php

namespace App\Http\Resources\Compensation;

use App\Repository\History\HistoryRepositoryInterface;

class CompensationCollection extends \Illuminate\Http\Resources\Json\ResourceCollection
{
    private $listIds;

    public function __construct($resource, $listIds)
    {
        parent::__construct($resource);
        $this->listIds = $listIds;
    }
    public function toArray($request)
    {
        $histories = [];
        if (sizeof($this->listIds) > 0) {
            $histories = app()->make(HistoryRepositoryInterface::class)->getListById($this->listIds);
        }
        return $this->collection->map(function ($item) use (&$histories) {
            if (isset($histories[$item->id])) {
                return new CompensationResource($item, $histories[$item->id]);
            }
            return new CompensationResource($item);
        });
    }
}
