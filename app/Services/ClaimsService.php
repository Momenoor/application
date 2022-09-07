<?php

namespace App\Services;

use App\Models\Matter;

class ClaimsService
{
    private static $matter;
    private static $claims = [];
    /*     public function __construct(Matter $matter)
    {
        $this->matter = $matter;
        $this->officeShare();
    } */

    public static function make(Matter $matter)
    {
        static::$matter = $matter;
        static::$claims = static::$matter->claims;
        return new static();
    }


    public function getClaims()
    {
        $claims = $this->setClaimsNature();
        return $claims;
    }

    public function setClaimsNature()
    {
        $claims = static::$claims;
        $claims->each(function ($item) {
            $condition = config('system.claims.types.' . $item->type . '.condition');
            if ($condition == -1 && $item->amount > 0) {
                $item->amount = $condition * $item->amount;
            }
            return $item;
        });
        return $claims;
    }
    public function netClaim()
    {
    }

    public function officeShare()
    {
        return $this->matter->claims->where('type', 'office_share');
        if ($this->matter->isPrivate()) {
        }
    }
}
