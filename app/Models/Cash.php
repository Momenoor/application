<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'description',
        'type',
        'matter_id',
        'claim_id',
        'user_id',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
