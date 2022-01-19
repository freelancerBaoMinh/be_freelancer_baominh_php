<?php

namespace App\Http\Resources\Compensation;

use App\Repository\Costs\CostRepositoryInterface;
use App\Repository\Users\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CompensationDetailCollection extends ResourceCollection
{
    /**
     * @var array|mixed
     */
    private $userIds;
    /**
     * @var array|mixed
     */
    private $requestIds;

    public function __construct($resource, $userIds = [], $requestIds = [])
    {
        parent::__construct($resource);
        $this->userIds = $userIds;
        $this->requestIds = $requestIds;
    }

    public function toArray($request)
    {
        $costs = [];
        $users = [];
        if (sizeof($this->userIds) > 0) {
            $users = app()->make(UserRepositoryInterface::class)->getListById($this->userIds);
        }
        if (sizeof($this->requestIds) > 0)
        {
            $costs = app()->make(CostRepositoryInterface::class)->getCostByRequest($this->requestIds);
        }
        return $this->collection->map(function ($item) use (&$users, &$costs) {
            return new CompensationDetailResource($item, $users[$item->user_id] ?? null, $costs[$item->id]??[]);
        });
    }
}
