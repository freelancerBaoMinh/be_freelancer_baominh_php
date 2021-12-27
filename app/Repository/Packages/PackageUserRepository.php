<?php

namespace App\Repository\Packages;

use App\Models\PackageUser;

class PackageUserRepository extends \App\Repository\BaseRepository implements PackageUserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return PackageUser::class;
    }
}
