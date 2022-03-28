<?php

namespace App\Models;

use App\Services\NumberFormatterService;
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

    protected $dates = [
        'date'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->date = now();
            $query->status = 'unpaid';
            $query->user_id = auth()->id();
        });
    }

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

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = app(NumberFormatterService::class)->getUnformattedNumber($value);
    }

    public function getClaimAmountAttribute()
    {
        return app(NumberFormatterService::class)->getFormattedNumber($this->amount);
    }

    public function getTypeColorAttribute()
    {
        return config('system.claims.' . $this->type . '.color');
    }

    public function getRecurringColorAttribute()
    {
        return config('system.claims.recurring.values.' . $this->recurring . '.color');
    }
}
