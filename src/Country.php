<?php
namespace MoneyPHP\IsoCurrencies;

/**
 * Class Country
 * @package MoneyPHP\IsoCurrencies
 */
final class Country
{
    /**
     * @var string
     */
    private $alphabeticCode;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var string
     */
    private $entity;
    /**
     * @var int
     */
    private $minorUnit;
    /**
     * @var int
     */
    private $numericCode;

    /**
     * @param string $entity
     * @param string $currency
     * @param string $alphabeticCode
     * @param int $numericCode
     * @param int $minorUnit
     */
    public function __construct($entity, $currency, $alphabeticCode, $numericCode, $minorUnit)
    {
        $this->alphabeticCode = $alphabeticCode;
        $this->currency = $currency;
        $this->entity = $entity;
        $this->minorUnit = $minorUnit;
        $this->numericCode = $numericCode;
    }

    /**
     * @return string
     */
    public function getAlphabeticCode()
    {
        return $this->alphabeticCode;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return int
     */
    public function getMinorUnit()
    {
        return $this->minorUnit;
    }

    /**
     * @return int
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }
}
