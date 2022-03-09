<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'datetime',
        'descrtiption',
        'link',
        'link_type',
        'matter_id',
    ];

    public function scopeReceivedDate($query)
    {
        return $query->where('type', 'received_date');
    }

    public function scopeNextSessionDate($query)
    {
        return $query->where('type', 'next_session_date');
    }
}
