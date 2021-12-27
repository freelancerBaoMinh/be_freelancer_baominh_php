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
        return DB::table($this->model->getTable())->select(['id','role','avatar','username'])
            ->where('username',$username)->where('status', 1)->first();
    }
    public function getList($keyword = '', $page = 1): array
    {
        $query = DB::table($this->model->getTable())->select(['id', 'role','avatar','username'])
            ->where('status', 1);
        if ($keyword != '')
        {
            $query = $query->where('username', 'LIKE', '%'.$keyword.'%');
        }
        if ($page > 1)
        {
            $query = $query->where('id','>', $page);
        }
        $list = $query->limit(20)->get();
        $lastId = 0;
        if ($list->last() && sizeof($list) === 20)
        {
            $lastId = $list->last()->id;
        }
        return [
            'list'=>$list,
            'next_page'=>$lastId
        ];
    }
}
