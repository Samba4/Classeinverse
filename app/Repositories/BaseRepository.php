<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function store(array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function getBySlug($slug)
    {
        return $this->model->whereSlug($slug)->firstOrFail();
    }

    public function getByUser($id)
    {
        return $this->model->whereUserId($id)->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
