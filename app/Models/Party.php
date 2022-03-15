<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'fax',
        'address',
        'email',
        'type',
        'extra',
        'parent_id',
        'user_id',
    ];

    public function scopeNotBlackList()
    {
        return $this->where('black_list', false);
    }
}
