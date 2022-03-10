<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;

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
        return $this->morphToMany(Matter::class, 'partiable', 'matter_party')->wherePivot('type', '=', 'assistant');
    }

    public function scopeCommitteesList()
    {
        return $this->where('category', 'external');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
