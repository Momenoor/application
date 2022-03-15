<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MatterParty extends Pivot
{
    //
    protected $fillable = [
        'matter_id',
        'party_id',
        'parent_id',
        'type',
    ];
}
