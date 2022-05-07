<?php

namespace App\Models;

use App\Contracts\MatterPartyContract;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;

class MatterParty extends Pivot
{
    //
    use LogsActivity;
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
