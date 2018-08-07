<?php
namespace MoneyPHP\IsoCurrencies;

/**
 * Class Fetcher
 * @package MoneyPHP\IsoCurrencies
 */
final class Fetcher
{
    /**
     * @var string
     */
    private $currentLocation;

    /**
     * @var string
     */
    private $historicLocation;

    /**
     * @var null|array|Country[]
     */
    private $currentCountries;

    /**
     * @var null|array|Country[]
     */
    private $historicCountries;

    /**
     * @param string $currentLocation
     * @param string $historicLocation
     */
    public function __construct($currentLocation, $historicLocation)
    {
        $this->currentLocation = $currentLocation;
        $this->historicLocation = $historicLocation;
    }

    /**
     * @param string $fileName
     * @param Serializer $serializer
     */
    public function saveCurrentCountriesTo($fileName, Serializer $serializer)
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize($this->currentCountries)
        );
    }

    /**
     * @param string $fileName
     * @param Serializer $serializer
     */
    public function saveHistoricCountriesTo($fileName, Serializer $serializer)
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize($this->historicCountries)
        );
    }

    /**
     * @param string $fileName
     * @param Serializer $serializer
     */
    public function saveAllCountriesTo($fileName, Serializer $serializer)
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize(array_merge($this->historicCountries, $this->currentCountries))
        );
    }

    private function fetch()
    {
        $this->fetchCurrentCountries();
        $this->fetchHistoricCountries();
    }

    private function fetchCurrentCountries()
    {
        if ($this->currentCountries === null) {
            $this->currentCountries = [];

            $content = file_get_contents($this->currentLocation);
            $xml = new \SimpleXMLElement($content);

            foreach ($xml->{'CcyTbl'}->{'CcyNtry'} as $countryXml) {
                $country = new Country(
                    (string) $countryXml->{'CtryNm'},
                    (string) $countryXml->{'CcyNm'},
                    (string) $countryXml->{'Ccy'},
                    (int) $countryXml->{'CcyNbr'},
                    (int) $countryXml->{'CcyMnrUnts'}
                );

                $this->currentCountries[] = $country;
            }
        }
    }

    private function fetchHistoricCountries()
    {
        if ($this->historicCountries === null) {
            $this->historicCountries = [];

            $content = file_get_contents($this->historicLocation);
            $xml = new \SimpleXMLElement($content);

            foreach ($xml->{'HstrcCcyTbl'}->{'HstrcCcyNtry'} as $countryXml) {
                $country = new Country(
                    (string) $countryXml->{'CtryNm'},
                    (string) $countryXml->{'CcyNm'},
                    (string) $countryXml->{'Ccy'},
                    (int) $countryXml->{'CcyNbr'},
                    (int) $countryXml->{'CcyMnrUnts'}
                );

                $this->historicCountries[] = $country;
            }
        }
    }
}
