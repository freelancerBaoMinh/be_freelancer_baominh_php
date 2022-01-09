<?php

namespace App\Repository\Users;

interface UserRepositoryInterface
{
    public function create($input);
    public function findByUsername($username);
    public function getList($keyword = '', $page = 1);
    public function getListById($ids);
}
