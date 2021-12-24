<?php

namespace App\Repository\Contracts;

interface ContractRepositoryInterface
{
    public function getByUser($userId);
}
