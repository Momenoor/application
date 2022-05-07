<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Type extends Model
{
    use HasFactory,LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $logAttributes  = [
        'name',
        'active'
    ];
    protected $fillable = [
        'name',
        'active'
    ];
}
