<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions, HasRoles, LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    public const DEFAULT_PASSWORD = 123456;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $logAttributes  = [
        'name',
        'password',
        'language',
    ];
    protected $fillable = [
        'name',
        'password',
        'language',
    ];

    protected $with = [
        'account',
        'roles',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function getExpertAttribute()
    {
        return optional($this->account)->expert;
    }

    public function marketers()
    {

        return $this->belongsToMany(User::class, 'matter_marketing')->withPivot('type');
    }

    public function symbol()
    {
        return 'M';
    }
    public function color()
    {
        if ($this->pivot) {
            return 'info';
        }
        return 'warning';
    }

    public function category()
    {
        return $this->category;
    }
    public function field()
    {
        if ($this->pivot) {
            return $this->pivot->type;
        }
        return 'user';
    }

    public function pivotType()
    {
        return 'marketing';
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
