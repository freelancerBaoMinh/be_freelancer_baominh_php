<?php

namespace App\Repository\Package;

use App\Models\Package;

class PackageRepository extends \App\Repository\BaseRepository implements PackageRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Package::class;
    }
}
