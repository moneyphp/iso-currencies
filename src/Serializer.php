<?php
namespace MoneyPHP\IsoCurrencies;

interface Serializer
{
    /**
     * @param Country[] $countries
     */
    public function serialize(array $countries): string;
}
