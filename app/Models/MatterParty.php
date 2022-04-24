<?php

namespace App\Models;

use App\Contracts\MatterPartyContract;
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

    public $timestamps = true;

    public function subParties(){

        return $this->belongsTo(Party::class,'parent_id');
    }

}
