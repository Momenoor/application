<?php

namespace App\Models;

use App\Contracts\MatterPartyContract;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MatterMarketing extends Pivot implements MatterPartyContract
{

    protected $table = 'matter_marketing';

    protected $fillable = [
        'matter_id',
        'user_id',
        'type',
    ];

    public function type()
    {
        return $this->type;
    }
    public function category()
    {
        if ($this->pivot) {
            return \Str::of($this->pivot->type)->replace('_marketer','');
        }
    }
    public function field()
    {
        return 'marketer';
    }
    public function pivotType()
    {
        if ($this->pivot) {
            return $this->pivot->type;
        }
        return 'marketer';
    }
    public function symbol(){
        return 'E';
    }
    public function color(){
        return 'info';
    }
}
