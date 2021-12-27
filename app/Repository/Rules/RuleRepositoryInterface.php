<?php

namespace App\Repository\Rules;

interface RuleRepositoryInterface
{
    public function getList(array $ids);
    public function listRule();
}
