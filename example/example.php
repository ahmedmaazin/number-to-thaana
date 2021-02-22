<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\NumberToThaana;

$input = 11;
$numberToThaana = new NumberToThaana($input);
$output = $numberToThaana->convert();

var_dump($output);
