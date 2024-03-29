<?php

namespace MoneyPHP\IsoCurrencies\Serializer;

use MoneyPHP\IsoCurrencies\Country;
use MoneyPHP\IsoCurrencies\Serializer;
use Symfony\Component\Yaml\Yaml;

final class YamlSerializer implements Serializer
{
    /**
     * @param array<int|string, Country> $countries
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

        return Yaml::dump($serialized);
    }
}
