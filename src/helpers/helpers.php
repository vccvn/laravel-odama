<?php

if (!function_exists('format_currency')) {
    function format_currency($amount, $currency = 'VND')
    {
        if (!is_numeric($amount)) {
            return '0 ' . $currency;
        }
        return number_format($amount, 0, ',', '.') . ' ' . $currency;
    }
}