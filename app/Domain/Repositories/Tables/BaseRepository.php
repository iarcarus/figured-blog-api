<?php

namespace App\Domain\Repositories\Tables;

use App\Exceptions\SystemExceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return string
     */
    abstract public function model();

    public function makeModel()
    {
        $model = app()->make($this->model());

        if (!$model instanceof Model) {
            $e = (new RepositoryException())->setParams(['model' => $this->model()]);
            throw $e;
        }

        return $this->model = $model;
    }

    public function create(array $attributes = [])
    {
        $instance = $this->makeModel();

        $instance->fill($attributes);

        $instance->save();

        return $instance;
    }

    public function update($id, array $attributes = [])
    {
        $instance = $id instanceof Model ? $id : $this->find($id);

        if ($instance) {
            $instance->fill($attributes);

            $instance->save();
        }

        return $instance;
    }

    public function delete($id)
    {
        $instance = $id instanceof Model ? $id : $this->find($id);

        if ($instance) {
            $instance->delete();
        }

        return $instance;
    }

    public function find($id)
    {
        return $this->makeModel()::find($id);
    }

    public function query()
    {
        return $this->makeModel()::query();
    }
}
