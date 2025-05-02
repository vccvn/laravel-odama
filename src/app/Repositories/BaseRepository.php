<?php

namespace Odama\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        if (!class_exists(get_class($model))) {
            throw new Exception("Model không tồn tại: " . get_class($model));
        }
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
}