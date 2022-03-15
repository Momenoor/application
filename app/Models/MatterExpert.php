<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MatterExpert extends Pivot
{

    protected $table = 'matter_expert';

    protected $fillable = [
        'matter_id',
        'expert_id',
        'type',
    ];
}
