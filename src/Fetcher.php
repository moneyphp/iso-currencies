<?php
namespace MoneyPHP\IsoCurrencies;

/**
 * Class Fetcher
 * @package MoneyPHP\IsoCurrencies
 */
final class Fetcher
{
    /**
     * @var
     */
    private $location;

    /**
     * @var null|array|Country[]
     */
    private $countries;

    /**
     * @param $location
     */
    public function __construct($location)
    {
        $this->location = $location;
    }

    private function fetch()
    {
        if ($this->countries === null) {
            $this->countries = [];

            $content = file_get_contents($this->location);
            $xml = new \SimpleXMLElement($content);

            foreach ($xml->{'CcyTbl'}->{'CcyNtry'} as $countryXml) {
                $country = new Country(
                    (string) $countryXml->{'CtryNm'},
                    (string) $countryXml->{'CcyNm'},
                    (string) $countryXml->{'Ccy'},
                    (int) $countryXml->{'CcyNbr'},
                    (int) $countryXml->{'CcyMnrUnts'}
                );

                $this->countries[] = $country;
            }
        }
    }

    /**
     * @param $fileName
     * @param Serializer $serializer
     */
    public function saveTo($fileName, Serializer $serializer)
    {
        $this->fetch();

        file_put_contents(
            $fileName,
            $serializer->serialize($this->countries)
        );
    }
}
