<?php
namespace MoneyPHP\IsoCurrencies\Serializer;

use MoneyPHP\IsoCurrencies\Country;
use MoneyPHP\IsoCurrencies\Serializer;

final class PhpExportSerializer implements Serializer
{
    /**
     * @param array|Country[] $countries
     * @return string
     */
    public function serialize(array $countries)
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

        return '<?php return '.var_export($serialized, true).';';
    }
}
