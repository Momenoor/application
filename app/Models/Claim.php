<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'amount',
        'status',
        'type',
        'recurring',
        'matter_id',
        'user_id',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function cash()
    {
        return $this->hasMany(Cash::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
