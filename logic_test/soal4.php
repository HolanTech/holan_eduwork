<?php
$a = 3;
$b = 7;

// Swap the values of $a and $b
$a = $a + $b;
$b = $a - $b;
$a = $a - $b;

echo "a = " . $a . ", b = " . $b;
