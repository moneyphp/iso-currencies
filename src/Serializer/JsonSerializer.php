<?php
namespace MoneyPHP\IsoCurrencies\Serializer;

use MoneyPHP\IsoCurrencies\Country;
use MoneyPHP\IsoCurrencies\Serializer;

final class JsonSerializer implements Serializer
{
    /**
     * @param array<int|string, Country> $countries
     * @throws \JsonException
     */
    public function serialize(array $countries): string
    {
        $serialized = [];
        foreach ($countries as $country) {
            if (empty($country->getAlphabeticCode())) {
                continue;
            }
            $serialized[$country->getAlphabeticCode()] = [
                'alphabeticCode' => $country->getAlphabeticCode(),
                'currency' => $country->getCurrency(),
                'minorUnit' => $country->getMinorUnit(),
                'numericCode' => $country->getNumericCode(),
            ];
        }

        \ksort($serialized);

        return json_encode($serialized, JSON_THROW_ON_ERROR);
    }
}
