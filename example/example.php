<?php

use Mazin\Thaana\NumberToThaana;

require_once __DIR__ . '/../vendor/autoload.php';

$numberToThaana = (new NumberToThaana("11"))->convert();
var_dump($numberToThaana);