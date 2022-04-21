<?php

namespace App\Observers;

use App\Models\Matter;

class MatterObserver
{
    public function creating(Matter $model)
    {
        $model->user_id = auth()->id();
        $model->status = 'current';
    }

    public function deleting(Matter $model)
    {
        $model->parties()->detach();
        $model->experts()->detach();
        $model->procedures()->delete();
        $model->claims()->delete();
        $model->cashes()->delete();
        $model->notes()->delete();
        $model->attachments()->delete();
    }
}
