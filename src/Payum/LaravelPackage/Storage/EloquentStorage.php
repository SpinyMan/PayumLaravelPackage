<?php

declare(strict_types = 1);

namespace Payum\LaravelPackage\Storage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Payum\Core\Model\Identity;
use Payum\Core\Storage\AbstractStorage;

class EloquentStorage extends AbstractStorage
{
    protected function doUpdateModel($model)
    {
        $model->save();
    }

    protected function doDeleteModel($model)
    {
        $model->delete();
    }

    protected function doGetIdentity($model)
    {
        return new Identity($model->{$model->getKeyName()}, $model);
    }

    protected function doFind($id)
    {
        $modelClass = $this->modelClass;

        return $modelClass::find($id);
    }

    public function findBy(array $criteria)
    {
        if (!$criteria) {
            return [];
        }

        $modelClass = $this->modelClass;

        /** @var Builder $query */
        $query = null;
        foreach ($criteria as $name => $value) {
            if (!$query) {
                $query = $modelClass::where($name, '=', $value);
            }

            $query->where($name, '=', $value);
        }

        return iterator_to_array($query->get());
    }
}
