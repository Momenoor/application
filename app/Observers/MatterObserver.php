<?php

namespace App\Observers;

use App\Models\Matter;
use Exception;

class MatterObserver
{
    public function creating(Matter $model)
    {
        //$model->user_id = auth()->id();
        //$model->status = 'current';
    }

    public function deleting(Matter $model)
    {
        try {
            $model->parties()->detach();
            $model->experts()->detach();
            $model->marketers()->detach();
            $model->procedures()->delete();
            $model->cashes()->delete();
            $model->claims()->delete();
            $model->notes()->delete();
            $model->attachments()->delete();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
