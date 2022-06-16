<?php

use App\Helpers\Currency;
use App\Models\User;

if (! function_exists('currency')) {
    function currency($currency = null, ?User $user = null): Currency
    {
        return new Currency($currency, $user);
    }
}

if (! function_exists('timezones')) {
    function timezones(): array
    {
        return \DateTimeZone::listIdentifiers();
    }
}
