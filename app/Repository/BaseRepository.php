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
}
