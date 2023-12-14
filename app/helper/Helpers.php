<?php

if (!function_exists('currency_IDR')) {
    function currency_IDR($value)
    {
        return "Rp. " . number_format($value, 0, ',', '.');
    }
}

if (!function_exists('currencyIDRToNumeric')) {
    function currencyIDRToNumeric($value)
    {
        return preg_replace('/\D/', '', $value);
    }
}

if (!function_exists('nomorHp')) {
    function nomorHp($value)
    {
        return preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $value);
    }
}
