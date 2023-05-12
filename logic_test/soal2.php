<?php

function reverse_string($string)
{
    $reversed_string = '';
    $length = strlen($string);
    for ($i = $length - 1; $i >= 0; $i--) {
        $reversed_string .= $string[$i];
    }
    return $reversed_string;
}
// Contoh kasus uji
$input = "abcde";
$output = reverse_string($input);
echo "Input: $input\n";
echo "Output: $output\n"; // Output: "edcba"

// Kasus uji lainnya
$input = "Hello world!";
$output = reverse_string($input);
echo "Input: $input\n";
echo "Output: $output\n"; // Output: "!dlrow olleH"