<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Src\NumberToThaana;

$numberToThaana = (new NumberToThaana("11"))->convert();
var_dump($numberToThaana);