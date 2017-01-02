<?php
namespace MoneyPHP\IsoCurrencies\Serializer;

use MoneyPHP\IsoCurrencies\Country;
use MoneyPHP\IsoCurrencies\Serializer;

final class JsonWithEntitySerializer implements Serializer
{
    /**
     * @param array|Country[] $countries
     * @return string
     */
    public function serialize(array $countries)
    {
        $serialized = [];
        foreach ($countries as $country) {
            if (isset($serialized[$country->getAlphabeticCode()])) {
                $serialized[$country->getAlphabeticCode()]['entity'][] = $country->getEntity();
            } else {
                $serialized[$country->getAlphabeticCode()] = [
                    'alphabeticCode' => $country->getAlphabeticCode(),
                    'currency' => $country->getCurrency(),
                    'entity' => [$country->getEntity()],
                    'minorUnit' => $country->getMinorUnit(),
                    'numericCode' => $country->getNumericCode(),
                ];
            }
        }

        return json_encode($serialized);
    }
}
