<?php

namespace App\Traits;

use App\Services\Money;

/**
 *
 */
trait hasCashCollection
{

    protected $mount;

    public function amount(Money $amount): Money
    {
        if ($amount) {
            return $this->amount = $amount;
        }

        return $this->amount;
    }

    public function collect(){

    }
}
