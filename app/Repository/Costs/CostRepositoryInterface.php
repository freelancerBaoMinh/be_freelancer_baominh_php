<?php

namespace App\Repository\Costs;

interface CostRepositoryInterface
{
    public function insertCost($input, $requestId);
}
