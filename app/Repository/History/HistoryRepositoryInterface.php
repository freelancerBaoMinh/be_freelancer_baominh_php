<?php

namespace App\Repository\History;

interface HistoryRepositoryInterface
{
    public function getListById($compensationIds);
}
