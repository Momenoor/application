<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Court extends Model
{
    use HasFactory,LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $logAttributes  = [
        'name',
        'phone',
        'email',
        'address',
    ];
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function matters()
    {
        return $this->hasMany(Matter::class);
    }
}
