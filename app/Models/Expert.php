<?php

namespace App\Models;

use App\Contracts\MatterPartyContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model implements MatterPartyContract
{
    use HasFactory;

    const MAIN = 'main';
    const CERTIFIED = 'certified';
    const ASSISTANT = 'assistant';
    const EXTERNAL = 'external';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'catgeory',
        'field',
        'user_id',
    ];

    public function matters()
    {
        return $this->hasMany(Matter::class);
    }

    public function asAssistant()
    {
        return $this->morphByMany(Matter::class, 'partiable', 'matter_party')->wherePivot('type', '=', 'assistant');
    }

    public function scopeCommitteesList()
    {
        return $this->where('category', 'external');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        return 'E';
    }
    public function color()
    {
        if ($this->pivot) {
            if ($this->pivotType() == 'assistant') {
                return 'warning';
            }
            return 'light';
        }
        return 'dark';
    }
}
