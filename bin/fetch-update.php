<?php
use MoneyPHP\IsoCurrencies\Fetcher;
use MoneyPHP\IsoCurrencies\Serializer\JsonSerializer;
use MoneyPHP\IsoCurrencies\Serializer\PhpExportSerializer;
use MoneyPHP\IsoCurrencies\Serializer\YamlSerializer;

require_once __DIR__ . "/../vendor/autoload.php";

$fetcher = new Fetcher(
    'http://www.currency-iso.org/dam/downloads/lists/list_one.xml'
);

$fetcher->saveTo(__DIR__ . "/../resources/current.php", new PhpExportSerializer());
$fetcher->saveTo(__DIR__ . "/../resources/current.json", new JsonSerializer());
$fetcher->saveTo(__DIR__ . "/../resources/current.yaml", new YamlSerializer());
