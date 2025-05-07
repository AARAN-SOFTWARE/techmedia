<?php

namespace Aaran\Assets\Helper;

class Format
{
    public static function Decimal(?float $value): string
    {
        return ($value == 0 || is_null($value)) ? '' : number_format($value, 2, '.', ',');
    }

    public static function Decimal_3Digit(?float $value): string
    {
        return ($value == 0 || is_null($value)) ? '' : number_format($value, 3, '.', '');
    }

    public static function rupeesFormat($v)
    {
        if ($v) {
            $fmt = new \NumberFormatter('en_IN', \NumberFormatter::CURRENCY);
            // Modify the pattern to include a space between symbol and value
            $fmt->setPattern('¤ #,##,##0.00'); // '¤' = currency symbol, followed by a non-breaking space
            return $fmt->formatCurrency($v, 'INR');
        }
        return '';
    }

}
