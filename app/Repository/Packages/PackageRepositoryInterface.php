<?php

namespace App\Repository\Packages;

interface PackageRepositoryInterface
{
    public function getList($page = 1);
}
