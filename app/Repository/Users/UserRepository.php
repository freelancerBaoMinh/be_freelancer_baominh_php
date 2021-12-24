<?php

namespace App\Repository\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends \App\Repository\BaseRepository implements UserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return User::class;
    }
    public function create($input)
    {
        if (isset($input['password']))
        {
            $input['password'] = Hash::make($input['password']);
        }
        return $this->model->create($input);
    }
    public function findByUsername($username)
    {
        return DB::table($this->model->getTable())->select(['id','status','role','avatar','username'])
            ->where('username',$username)->first();
    }
}
