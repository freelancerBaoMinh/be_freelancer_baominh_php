<?php

namespace App\Repository\Compensation;

interface CompensationRepositoryInterface
{
    public function getNumberRequest();
    public function listByUser($userId, $page = 1);
    public function list($status =0, $page = 1);
}
