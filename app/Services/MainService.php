<?php

namespace App\Services;

class MainService
{
    protected $model;

    public function pagination(int $perPage = 10, int $page = 1)
    {
        return $this->model::query()
            ->orderBy('created_at', 'desc')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model::findOrFail($id);
    }

    public function create(array $data)
    {
        $this->model::create($data);
    }

    public function edit($model, array $data)
    {
        $model->update($data);
    }

    public function delete($model)
    {
        $model->delete();
    }
}
