<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     */
    abstract public function getModel();

    /**
     * set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }
    public function create($input)
    {
        return $this->model->create($input);
    }
    public function findById($id)
    {
        return $this->model->find($id);
    }
    public function update($condition,$input){
        DB::table($this->model->getTable())->where($condition)->update($input);
    }
    public function paginateSortDesc($condition, $select = ['*'] ,$page = 1): array
    {
        $query = DB::table($this->model->getTable())
            ->select($select)
            ->where($condition);
        if ($page > 1)
        {
            $query = $query->where('id', '<', $page);
        }
        $list = $query->orderBy('id', 'DESC')->limit(20)->get();
        $lastId = 0;
        if (sizeof($list) === 20)
        {
            $last = $list->last();
            if ($last)
            {
                $lastId = $last->id;
            }
        }
        return [
          'list'=>$list,
          'next_page'=>$lastId
        ];
    }
}
