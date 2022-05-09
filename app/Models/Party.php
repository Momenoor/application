<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Party extends Model
{
    use HasFactory,LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $logAttributes  = [
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = auth()->id();
        });
    }

    public function scopeNotBlackList()
    {
        return $this->where('black_list', false);
    }

}
