<?php
namespace MoneyPHP\IsoCurrencies;

interface Serializer
{
    /**
     * @param Country[] $countries
     * @return string
     */
    public function serialize(array $countries);
}
