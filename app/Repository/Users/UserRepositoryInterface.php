<?php

namespace App\Repository\Users;

interface UserRepositoryInterface
{
    public function create($input);
    public function findByUsername($username);
}
