<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'number',
        'status',
        'commissioning',
        'external_marketing_percent',
        'user_id',
        'expert_id',
        'court_id',
        'level_id',
        'type_id',
        'parent_id',
    ];


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
        return $this->morphedByMany(Expert::class, 'partiable', 'matter_party')->wherePivot('type', '=', 'assistant');
    }

    public function parties()
    {
        return $this->morphedByMany(Party::class, 'partiable', 'matter_party');
    }

    public function plaintiffs()
    {
        return $this->morphedByMany(Party::class, 'partiable', 'matter_party')->wherePivot('type', '=', 'plaintiff');
    }

    public function defendants()
    {
        return $this->morphedByMany(Party::class, 'partiable', 'matter_party')->wherePivot('type', '=', 'defendant');
    }

    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }
    public function receivedDateProcedure()
    {
        return $this->procedures()->where('type', 'received_date');
    }
    public function nextSessionDateProcedure()
    {
        return $this->procedures()->where('type', 'next_session_date');
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
}
