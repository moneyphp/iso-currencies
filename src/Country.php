<?php
namespace MoneyPHP\IsoCurrencies;

final class Country
{
    public function __construct(
                                private readonly string $entity,
                                private readonly string $currency,
                                private readonly string $alphabeticCode,
                                private readonly int $numericCode,
                                private readonly int $minorUnit)
    {
    }

    public function getAlphabeticCode(): string
    {
        return $this->alphabeticCode;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getEntity(): string
    {
        return $this->entity;
    }

    public function getMinorUnit(): int
    {
        return $this->minorUnit;
    }

    public function getNumericCode(): int
    {
        return $this->numericCode;
    }
}
