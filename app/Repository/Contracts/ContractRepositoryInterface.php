<?php

namespace App\Repository\Contracts;

interface ContractRepositoryInterface
{
    public function getByUser($userId);
    public function getList($page = 1);
    public function getRelationship($userId);
}
