<?php

namespace App\Http\Resources\Compensation;

use App\Repository\Users\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CompensationDetailCollection extends ResourceCollection
{
    /**
     * @var array|mixed
     */
    private $userIds;

    public function __construct($resource, $userIds = [])
    {
        parent::__construct($resource);
        $this->userIds = $userIds;
    }

    public function toArray($request)
    {
        $users = [];
        if (sizeof($this->userIds) > 0) {
            $users = app()->make(UserRepositoryInterface::class)->getListById($this->userIds);
        }
        return $this->collection->map(function ($item) use (&$users) {
            if (isset($users[$item->user_id])) {
                return new CompensationDetailResource($item, $users[$item->user_id]);
            }
            return new CompensationDetailResource($item);
        });
    }
}
