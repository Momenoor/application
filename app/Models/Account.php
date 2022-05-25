<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $logAttributes  = [
        'name',
        'phone',
        'email',
        'accountable_id',
        'accountable_type',
    ];
    protected $fillable = [
        'name',
        'phone',
        'email',
        'accountable_id',
        'accountable_type',
    ];

    public function accountable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
