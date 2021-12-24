<?php

namespace App\Repository;

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
}
