<?php

use App\Services\Money;

if (!function_exists('format_amount')) {
    function format_amount($amount)
    {
        return app(Money::class)->getFormattedNumber($amount);
    }
}
