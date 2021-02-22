<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\NumberToThaana;

$input = 11;
$numberToThaana = new NumberToThaana($input);
$output = $numberToThaana->convert();

print_r("Input: " . $input . "\n");
print_r("Output: " . $output . "\n");