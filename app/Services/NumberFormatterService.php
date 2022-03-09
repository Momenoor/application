<?php
namespace App\Services;

use NumberFormatter;

class NumberFormatterService
{
    public static function getFormattedNumber(
        $value,
        $locale = 'en_US',
        $style = NumberFormatter::DECIMAL,
        $precision = 2,
        $groupingUsed = true,
        $currencyCode = 'AED'
    ) {
        $formatter = new NumberFormatter($locale, $style);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        $formatter->setAttribute(NumberFormatter::GROUPING_USED, $groupingUsed);
        if ($style == NumberFormatter::CURRENCY) {
            $formatter->setTextAttribute(NumberFormatter::CURRENCY_CODE, $currencyCode);
        }

        return $formatter->format($value);
    }
}
