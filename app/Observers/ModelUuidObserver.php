<?php

namespace App\Observers;

use App\Entities\ModelUuid;
use Ramsey\Uuid\Uuid;

class ModelUuidObserver
{
    /**
     * @param ModelUuid $model
     */
    public function creating(ModelUuid $model): void
    {
        $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
    }
}
