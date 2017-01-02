<?php
use MoneyPHP\IsoCurrencies\Fetcher;
use MoneyPHP\IsoCurrencies\Serializer\JsonExEntitySerializer;
use MoneyPHP\IsoCurrencies\Serializer\JsonWithEntitySerializer;
use MoneyPHP\IsoCurrencies\Serializer\PhpExportExEntitySerializer;
use MoneyPHP\IsoCurrencies\Serializer\PhpExportWithEntitySerializer;

require_once __DIR__."/../vendor/autoload.php";

$fetcher = new Fetcher(
    'http://www.currency-iso.org/dam/downloads/lists/list_one.xml'
);

$fetcher->saveTo(__DIR__ . "/../resources/current.php", new PhpExportExEntitySerializer());
$fetcher->saveTo(__DIR__ . "/../resources/current.json", new JsonExEntitySerializer());
$fetcher->saveTo(__DIR__ . "/../resources/current.with.entities.php", new PhpExportWithEntitySerializer());
$fetcher->saveTo(__DIR__ . "/../resources/current.with.entities.json", new JsonWithEntitySerializer());
