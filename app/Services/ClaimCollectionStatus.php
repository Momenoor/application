<?php

namespace App\Services;

use App\Models\Cash;
use App\Models\Claim;
use App\Models\Expert;
use App\Models\Matter;
use App\Models\Party;
use App\Models\Procedure;
use Illuminate\Support\Collection;
use PDO;

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
        $this->claims = ClaimsService::make($matter)->getClaims();
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
            if ($item->status != Cash::PAID && $item->status != Cash::OVERPAID && $item->getDueAmount() > 0) {
                return $item;
            }
        });
        return $this->dueClaims->all();
    }

    public function getSumCollectedClaims($format = true)
    {
        $this->collection->each(function ($item) {
            $condition = config('system.claims.types.' . $item->claim->type . '.condition');
            if ($condition == -1 && $item->amount > 0) {
                $item->amount = $condition * $item->amount;
            }
            return $item;
        });
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

    function updateMatterClaimCollectionStatus()
    {

        $this->matter->claim_status = $this->getClaimStatus();
        $this->matter->save();
        $this->matter->claims->each(function ($claim) {
            if ($claim->matter->claim_status == Cash::PAID) {
                $claim->status = Cash::PAID;
            } else {
                $amount = $claim->amount;
                $collectedAmount = $claim->cashes->sum('amount');
                $claim->status = $this->claimCollectionStatus($amount, $collectedAmount);
            }
            $claim->save();
        });
        return $this->matter;
    }

    protected function claimCollectionStatus($amount, $collected)
    {
        if ($collected > $amount) {

            return Cash::OVERPAID;
        }

        if ($collected == $amount) {
            return Cash::PAID;
        }

        if ($collected > 0 && $collected < $amount) {
            return Cash::PARTIAL;
        }

        if ($collected <= 0) {
            return Cash::UNPAID;
        }
    }
}
