<?php

namespace App\Models;

use App\Services\NumberFormatterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Matter extends Model
{
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
    ];

    protected $dates = [
        'received_date',
        'next_session_date',
        'reported_date',
        'submitted_date',
    ];



    public const INDIVIDUAL = 'individual';
    public const COMMITTEE = 'committee';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = auth()->id();
            $query->status = 'current';
        });
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
        return app(NumberFormatterService::class)->getFormattedNumber($this->claims->sum('amount'));
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
            ->wherePivot('type', '=', 'assistant');
    }

    public function experts()
    {
        return $this->belongsToMany(Expert::class, 'matter_expert')
        ->withPivot('type');
    }

    public function marketers()
    {
        return $this->belongsToMany(User::class, 'matter_marketing');
    }

    public function internalMarketers()
    {
        return $this->belongsToMany(User::class, 'matter_marketing')
            ->wherePivot('type', '=', 'marketer');
    }

    public function externalMarketers()
    {
        return $this->belongsToMany(Party::class, 'matter_party')
            ->wherePivot('type', '=', 'external_marketer');
    }

    public function plaintiffs()
    {
        return $this->belongsToMany(Party::class)
            ->wherePivot('type', '=', 'plaintiff');
    }

    public function defendants()
    {
        return $this->belongsToMany(Party::class)
            ->wherePivot('type', '=', 'defendant');
    }

    public function parties()
    {
        return $this->belongsToMany(Party::class)->withPivot(['type','parent_id']);
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

    public function isReported(){
        return (! is_null($this->reported_date) ) ;
    }

    public function isSubmitted(){
        return $this->isReported() && (! is_null($this->submitted_date));
    }
}
