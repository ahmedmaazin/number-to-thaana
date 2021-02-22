<?php

$input = 100;
$numberToThaana = new NumberToThaana($input);
$output = $numberToThaana->convert();

print_r("Input: " . $input . "\n");
print_r("Output: " . $output . "\n");