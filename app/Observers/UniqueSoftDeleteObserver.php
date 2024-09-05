<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class UniqueSoftDeleteObserver
{
    private const DELIMITER = '--';

    /**
     * Handle the "deleted" event for any model.
     */
    public function deleted(Model $model)
    {
        if (!$model->isForceDeleting()) {
            foreach ($model->getDuplicateAvoidColumns() as $column) {
                $newValue = time() . self::DELIMITER . $model->{$column};
                $model->{$column} = $newValue;
            }
            $model->save();
        }
    }
}
