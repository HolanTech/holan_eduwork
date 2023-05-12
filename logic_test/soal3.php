<?php
function printDigitValue($str)
{
    // Buang semua karakter selain angka
    $numStr = preg_replace('/[^0-9]/', '', $str);

    // Loop untuk setiap digit mulai dari 9 hingga 1
    for ($digit = 9; $digit >= 1; $digit--) {
        $count = substr_count($numStr, (string) $digit);
        $power = pow(10, $digit - 1);

        // Tampilkan hasil jika jumlah kemunculan > 0
        if ($count > 0) {
            echo $count * $power;
            if ($digit > 1) {
                echo '<br>';
            }
        }
    }
}

// Memanggil fungsi dengan parameter '9.86-A5.321'
printDigitValue('9.86-A5.321');
