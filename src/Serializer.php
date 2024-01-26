<?php
namespace MoneyPHP\IsoCurrencies;

interface Serializer
{
    /**
     * @param array<int|string, Country> $countries
     */
    public function serialize(array $countries): string;
}
