<?php

namespace App\Services;

use App\Models\Cash;
use App\Models\Claim;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Procedure;
use Illuminate\Support\Collection;

class ClaimCollectionStatus
{
    protected $matter;
    protected $collection;
    protected $claims;
    protected $dueClaims;


    public function __construct($matter = null, $collection = null)
    {
        $this->matter = $matter;
        $this->collection = $collection;
        $this->claims = $matter->claims;
        $this->getDueClaims();
    }

    public static function make(Matter $matter, Cash $collection)
    {
        return new static($matter, $collection);
    }

    public function getDueClaims()
    {
        return $this->dueClaims = $this->claims->each(function ($item) {
            if ($item->status == Cash::UNPAID) {
                return $item;
            }
            if ($item->status == Cash::PARTIAL) {
                $item->amount -= $item->cashes()->sum('amount');
                return $item;
            }
        });
    }

    public function getSumDueClaims()
    {
        return $this->dueClaims->sum('amount');
    }


    public function getTotalClaims()
    {
    }
}
