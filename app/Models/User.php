<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;


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
    protected $logAttributes = [
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

//    public function getExpertAttribute()
//    {
//        return optional($this->account)->expert;
//    }

    public function marketers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(User::class, 'matter_marketing')->withPivot('type');
    }

    public function symbol(): string
    {
        return 'M';
    }

    public function color(): string
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

    public function pivotType(): string
    {
        return 'marketing';
    }

    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function expert(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Expert::class, 'account_id', 'account_id');
    }
}
