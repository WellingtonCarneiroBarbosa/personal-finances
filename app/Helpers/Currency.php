<?php

namespace App\Helpers;

use App\Models\User;

class Currency
{
    protected float $currency;

    public function __construct(null|string|float|int $currency = null, public ?User $user = null)
    {
        $this->currency = $currency != null ? (float)preg_replace('/[^0-9.]/', '', $currency) : 0;
    }

    public function toFloat(): float
    {
        return $this->currency;
    }

    public function toReadable(): string
    {
        return $this->toReadableCurrency();
    }

    public function toCurrencyFormat(): string
    {
        $currentCurrencyFormat = $this->getCurrentCurrencyFormat();

        return  number_format($this->currency, 2, $currentCurrencyFormat['cents_separator'], $currentCurrencyFormat['thousands_separator']);
    }

    public function getCurrentCurrencyFormat(): array
    {
        if ($this->user) {
            $locale = $this->user->settings->locale;
        } else {
            $locale = config('app.locale');
        }

        $currencies = config('currencies');

        return $currencies[$locale] ?? $currencies['en-US'];
    }

    private function toReadableCurrency(): string
    {
        $symbol = $this->getCurrentCurrencyFormat()['symbol'];

        $currencyFormatted = $this->toCurrencyFormat();

        return "{$symbol}\r{$currencyFormatted}";
    }
}
