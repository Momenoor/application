<?php

namespace App\Models;

use App\Contracts\MatterPartyContract;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;

class MatterExpert extends Pivot implements MatterPartyContract
{
    use LogsActivity;
    protected $table = 'matter_expert';

    protected $fillable = [
        'matter_id',
        'expert_id',
        'type',
    ];

    public function type()
    {
        return $this->type;
    }
    public function category()
    {
        return $this->category;
    }
    public function field()
    {
        return $this->field;
    }
    public function pivotType()
    {
        if ($this->pivot) {
            return $this->pivot->type;
        }
        return 'expert';
    }
    public function symbol()
    {
        return 'A';
    }
    public function color()
    {
        return 'light';
    }
}
