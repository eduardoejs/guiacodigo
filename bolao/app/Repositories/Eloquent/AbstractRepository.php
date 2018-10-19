<?php

namespace App\Repositories\Eloquent;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractRepository
{
    protected $model;

    function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function all():Collection
    {
        return $this->model->all();
    }

    public function paginate(int $paginate = 10):LengthAwarePaginator
    {
        return $this->model->paginate($paginate);
    }
}
