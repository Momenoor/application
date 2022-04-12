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
        if ($collection == null) {
            $this->collection = $this->matter->cashes;
        } else {
            $this->collection = $collection;
        }
        $this->claims = $matter->claims;
        $this->getDueClaims();
    }

    public static function make(Matter $matter, ?Cash $collection = null)
    {
        return new static($matter, $collection);
    }

    public function getDueClaims()
    {
        $claims = $this->claims;

        $this->dueClaims = $claims->filter(function ($item, $key) {
            if ($item->status != Cash::PAID) {
                return $item;
            }
        });
        return $this->dueClaims->all();
    }

    public function getSumCollectedClaims($format = true)
    {
        if ($format) {

            return app(Money::class)->getFormattedNumber($this->collection->sum('amount'));
        }
        return $this->collection->sum('amount');
    }

    public function getSumDueClaims($format = true)
    {
        $dueClaims = $this->getSumTotalClaims(false) - $this->getSumCollectedClaims(false);
        if ($format) {
            return app(Money::class)->getFormattedNumber($dueClaims);
        }
        return $dueClaims;
    }


    public function getSumTotalClaims($format = true)
    {
        $totalClaims = $this->claims->sum('amount');
        if ($format) {
            return app(Money::class)->getFormattedNumber($totalClaims);
        }
        return $totalClaims;
    }

    function getClaimStatus()
    {

        if ($this->getSumCollectedClaims(false) > $this->getSumTotalClaims(false)) {
            return Cash::OVERPAID;
        }

        if ($this->getSumCollectedClaims(false) == $this->getSumTotalClaims(false)) {
            return Cash::PAID;
        }

        if ($this->getSumCollectedClaims(false) > 0 && $this->getSumCollectedClaims(false) < $this->getSumTotalClaims(false)) {
            return Cash::PARTIAL;
        }

        if ($this->getSumCollectedClaims(false) <= 0) {
            return Cash::UNPAID;
        }
    }
}
