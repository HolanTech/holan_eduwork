<?php

// jawaban no 1

function hitungFaktorial($n)
{
    $hasil = 1;
    for ($i = $n; $i > 0; $i--) {
        $hasil *= $i;
    }
    return $hasil;
}

// Contoh penggunaan
$n = 4;
echo "Faktorial dari $n adalah " . hitungFaktorial($n); // Output: Faktorial dari 4 adalah 24

$n = 8;
echo "Faktorial dari $n adalah " . hitungFaktorial($n); // Output: Faktorial dari 8 adalah 40320
