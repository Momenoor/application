<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MatterMarketing extends Pivot
{

    protected $table = 'matter_marketing';

    protected $fillable = [
        'matter_id',
        'user_id',
        'type',
    ];
}
