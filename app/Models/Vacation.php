<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Vacation extends Model
{
    use HasFactory, LogsActivity;


    protected $logAttributes  = [
        'start_date',
        'end_date',
        'all_day',
        'title',
        'type',
        'request_by',
        'request_at',
        'approved_by',
        'approved_at',
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'all_day',
        'title',
        'type',
        'request_by',
        'request_at',
        'approved_by',
        'approved_at',
    ];

    protected $dates = [
        'request_at',
        'approved_at',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->request_by = auth()->id();
            $query->request_at = now();
        });
    }
}
