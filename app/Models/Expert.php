<?php

namespace App\Models;

use App\Contracts\MatterPartyContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expert extends Model implements MatterPartyContract
{
    use HasFactory, LogsActivity;

    const MAIN = 'main';
    const CERTIFIED = 'certified';
    const ASSISTANT = 'assistant';
    const EXTERNAL = 'external';
    const EXTERNAL_ASSISTANT = 'external-assistant';

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected $logAttributes  = [
        'name',
        'phone',
        'email',
        'category',
        'field',
        'user_id',
        'active',
    ];
    protected $fillable = [
        'name',
        'phone',
        'email',
        'category',
        'field',
        'user_id',
        'active',
    ];

    public function matters()
    {
        return $this->hasMany(Matter::class);
    }

    public function asAssistant()
    {
        return $this->belongsToMany(Matter::class, 'matter_expert')->wherePivot('type', '=', 'assistant');
    }
    public function asAssistantAsFinished()
    {
        return $this->asAssistant()->finished();
    }

    public function asAssistantLastActivityMonth()
    {
        $startDate = Carbon::now();
        $startDate->subMonth(1)->day('23');
        return $this->asAssistant()->where('reported_date', '>=', $startDate)->where('reported_date', '<=', now());
    }

    public function claims()
    {
        return $this->hasManyThrough(Claim::class, Matter::class);
    }

    public function scopeCommitteesList()
    {
        return $this->where('category', 'external');
    }

    public function scopeAssistantsList($query)
    {
        return $query->whereIn('category', [self::CERTIFIED, self::ASSISTANT]);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 'active');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->type;
    }
    public function category()
    {
        return $this->category;
    }
    public function field()
    {
        return $this->field;
    }
    public function pivotType()
    {
        if ($this->pivot) {
            return $this->pivot->type;
        }
        return 'expert';
    }
    public function symbol()
    {
        return 'E';
    }
    public function color()
    {
        if ($this->pivot) {
            if ($this->pivotType() == 'assistant') {
                return 'warning';
            }
            return 'light';
        }
        return 'dark';
    }

    public function account()
    {
        return $this->morphOne(Account::class, 'accountable');
    }

    public function categoryColor()
    {
        if ($this->category() == static::MAIN) {
            return 'success';
        } elseif ($this->category() == static::CERTIFIED) {
            return 'primary';
        } elseif ($this->category() == static::ASSISTANT) {
            return 'warning';
        } elseif ($this->category() == static::EXTERNAL) {
            return 'info';
        } elseif ($this->category() == static::EXTERNAL_ASSISTANT) {
            return 'info';
        } else {
            return 'danger';
        }
    }


}
