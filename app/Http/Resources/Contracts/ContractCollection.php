<?php

namespace App\Http\Resources\Contracts;

use App\Http\Resources\ContractResources;
use App\Repository\Packages\PackageRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContractCollection extends ResourceCollection
{
    private $packageIds;

    public function __construct($resource, $packageIds)
    {
        parent::__construct($resource);
        $this->packageIds = $packageIds;
    }

    public function toArray($request)
    {
        $packages = [];
        if (sizeof($this->packageIds) > 0)
        {
            $packages = app(PackageRepositoryInterface::class)->getListIds($this->packageIds);
        }
        return $this->collection->map(function ($item) use (&$packages) {
            if (isset($packages[$item->package_code])) {
                return new ContractResources($item, $packages[$item->package_code]);
            }
            return new ContractResources($item);
        });
    }
}
