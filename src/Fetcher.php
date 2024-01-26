<?php
namespace MoneyPHP\IsoCurrencies;

final class Fetcher
{
    /**
     * @var null|array|Country[]
     */
    private ?array $currentCountries = null;

    /**
     * @var null|array|Country[]
     */
    private ?array $historicCountries = null;

    public function __construct(private readonly string $currentLocation,
                                private readonly string $historicLocation)
    {
    }

    /**
     * @throws \Exception
     */
    public function saveCurrentCountriesTo(string $fileName, Serializer $serializer): void
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize($this->currentCountries)
        );
    }

    /**
     * @throws \Exception
     */
    public function saveHistoricCountriesTo(string $fileName, Serializer $serializer): void
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize($this->historicCountries)
        );
    }

    /**
     * @throws \Exception
     */
    public function saveAllCountriesTo(string $fileName, Serializer $serializer): void
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize(array_merge($this->historicCountries, $this->currentCountries))
        );
    }

    /**
     * @throws \Exception
     */
    private function fetch(): void
    {
        $this->fetchCurrentCountries();
        $this->fetchHistoricCountries();
    }

    /**
     * @throws \Exception
     */
    private function fetchCurrentCountries(): void
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

    /**
     * @throws \Exception
     */
    private function fetchHistoricCountries(): void
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
