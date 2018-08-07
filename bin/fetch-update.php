<?php
use MoneyPHP\IsoCurrencies\Fetcher;
use MoneyPHP\IsoCurrencies\Serializer\JsonSerializer;
use MoneyPHP\IsoCurrencies\Serializer\PhpExportSerializer;
use MoneyPHP\IsoCurrencies\Serializer\YamlSerializer;

require_once __DIR__ . "/../vendor/autoload.php";

$fetcher = new Fetcher(
    'https://www.currency-iso.org/dam/downloads/lists/list_one.xml',
    'https://www.currency-iso.org/dam/downloads/lists/list_three.xml'
);

$fetcher->saveCurrentCountriesTo(__DIR__ . "/../resources/current.php", new PhpExportSerializer());
$fetcher->saveCurrentCountriesTo(__DIR__ . "/../resources/current.json", new JsonSerializer());
$fetcher->saveCurrentCountriesTo(__DIR__ . "/../resources/current.yaml", new YamlSerializer());

$fetcher->saveHistoricCountriesTo(__DIR__ . "/../resources/historic.php", new PhpExportSerializer());
$fetcher->saveHistoricCountriesTo(__DIR__ . "/../resources/historic.json", new JsonSerializer());
$fetcher->saveHistoricCountriesTo(__DIR__ . "/../resources/historic.yaml", new YamlSerializer());

$fetcher->saveAllCountriesTo(__DIR__ . "/../resources/all.php", new PhpExportSerializer());
$fetcher->saveAllCountriesTo(__DIR__ . "/../resources/all.json", new JsonSerializer());
$fetcher->saveAllCountriesTo(__DIR__ . "/../resources/all.yaml", new YamlSerializer());
