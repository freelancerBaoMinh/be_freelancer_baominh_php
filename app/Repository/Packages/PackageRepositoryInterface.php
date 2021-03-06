<?php

namespace App\Repository\Packages;

interface PackageRepositoryInterface
{
    public function getList($page = 1);
    public function update($condition,$input);
    public function getListIds($ids);
}
