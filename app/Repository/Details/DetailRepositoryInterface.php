<?php

namespace App\Repository\Details;

interface DetailRepositoryInterface
{
    public function getDetail($packageId);
    public function insert($input);
}
