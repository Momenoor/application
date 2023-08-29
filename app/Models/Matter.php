<?php

namespace App\Models;

use App\Services\ClaimCollectionStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Services\ClaimsService;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Matter extends Model
{

    use LogsActivity;

    protected static $logOnlyDirty = true;

    protected static $submitEmptyLogs = false;

    protected static $logAttributes = [
        'year',
        'number',
        'status',
        'commissioning',
        'external_marketing_rate',
        'received_date',
        'next_session_date',
        'reported_date',
        'submitted_date',
        'user_id',
        'expert_id',
        'court_id',
        'level_id',
        'type_id',
        'parent_id',
        'claim_status',
        'last_action_date',
    ];

    protected $fillable = [
        'year',
        'number',
        'status',
        'commissioning',
        'external_marketing_rate',
        'received_date',
        'next_session_date',
        'reported_date',
        'submitted_date',
        'user_id',
        'expert_id',
        'court_id',
        'level_id',
        'type_id',
        'parent_id',
        'claim_status',
        'last_action_date',
        'last_action_date',
    ];

    protected $dates = [
        'received_date',
        'next_session_date',
        'reported_date',
        'submitted_date',
        'created_at',
        'updated_at',
        'last_action_date',
    ];

    public $timestamps = true;

    public const INDIVIDUAL = 'individual';
    public const COMMITTEE = 'committee';


    public static function boot()
    {

        parent::boot();

        static::retrieved(function ($matter) {
            (new ClaimsService($matter));
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function getAssistantAttribute()
    {
        $assistant = $this->assistants->first();
        //$this->unsetRelation('assistants');
        return $assistant;
    }

    public function getPlaintiffAttribute()
    {
        $plaintiff = $this->plaintiffs->first();
        //$this->unsetRelation('plaintiffs');
        return $plaintiff;
    }

    public function getDefendantAttribute()
    {
        $defendant = $this->defendants->first();
        //$this->unsetRelation('defendants');
        return $defendant;
    }

    public function getClaimsSumAmountAttribute()
    {
        //return $this->claims->sum('amount');
        return ClaimCollectionStatus::make($this)->getSumTotalClaims();
    }

    public function getClaimsSumAmountUnformattedAttribute()
    {
        //return $this->claims->sum('amount');
        return $this->claims->sum('amount');
    }

    public function getCashSumAmountAttribute()
    {
        return ClaimCollectionStatus::make($this)->getSumCollectedClaims();
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function assistants()
    {
        return $this->belongsToMany(Expert::class, 'matter_expert')
            ->wherePivot('type', '=', 'assistant')->withTimestamps();
    }

    public function experts()
    {
        return $this->belongsToMany(Expert::class, 'matter_expert')
            ->withPivot('type')->withTimestamps();
    }

    public function marketers()
    {
        return $this->belongsToMany(User::class, 'matter_marketing')->withPivot('type')->withTimestamps();
    }

    public function internalMarketers()
    {
        return $this->belongsToMany(User::class, 'matter_marketing')
            ->wherePivot('type', '=', 'marketer')->withTimestamps();
    }

    public function externalMarketers()
    {
        return $this->belongsToMany(Party::class, 'matter_party')
            ->wherePivot('type', '=', 'external_marketer')->withTimestamps();
    }

    public function plaintiffs()
    {
        return $this->belongsToMany(Party::class)
            ->wherePivot('type', '=', 'plaintiff')->withTimestamps();
    }

    public function defendants()
    {
        return $this->belongsToMany(Party::class)
            ->wherePivot('type', '=', 'defendant')->withTimestamps();
    }

    public function parties()
    {
        return $this->belongsToMany(Party::class)->withPivot(['type', 'parent_id'])->withTimestamps();
    }

    public function onlyParties()
    {
        return $this->belongsToMany(Party::class)->withPivot(['type', 'parent_id'])->wherePivotIn('type', ['defendant', 'plaintiff', 'implicat-litigant'])->withTimestamps();
    }

    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }

    public function nextSessionDateProcedureList()
    {
        return $this->procedures()
            ->where('type', 'next_session_date');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function cashes()
    {
        return $this->hasMany(Cash::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function scopeCurrent($query)
    {
        return $query->where('matters.status', 'current');
    }

    public function scopeFinished($query)
    {
        return $query->whereIn('matters.status', ['reported', 'submitted']);
    }

    public function isReported()
    {
        return (!is_null($this->reported_date)) or $this->status == 'reported';
    }

    public function isSubmitted()
    {
        return $this->isReported() && (!is_null($this->submitted_date) or $this->status == 'submitted');
    }

    public function isOverPaid()
    {
        return Cash::OVERPAID == ClaimCollectionStatus::make($this)->getClaimStatus();
    }
    public function isPaid()
    {
        return Cash::PAID == ClaimCollectionStatus::make($this)->getClaimStatus();
    }

    public function isUnpaid()
    {
        return Cash::UNPAID == ClaimCollectionStatus::make($this)->getClaimStatus();
    }

    public function isPartial()
    {
        return Cash::PARTIAL == ClaimCollectionStatus::make($this)->getClaimStatus();
    }

    public function claimsOpen()
    {
        return $this->isUnpaid() or $this->isPartial();
    }

    public function dueAmount()
    {
        return ClaimCollectionStatus::make($this)->getSumDueClaims();
    }

    public function dueClaims()
    {
        return ClaimCollectionStatus::make($this)->getDueClaims();
    }

    public function isPrivate()
    {
        return $this->whereNotIn('experts.id', config('system.experts.main'));
    }

    public function isOffice()
    {
        return !$this->isPrivate();
    }

    public function isNotPrivate()
    {
        return $this->isOffice();
    }

    public function getClaimStatusColorAttribute()
    {
        return config('system.claims.status.' . $this->claim_status . '.color');
    }
}
