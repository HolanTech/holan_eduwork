<?php
function angka_ke_kata($angka)
{
    $angka_kata = array(
        0 => 'nol',
        1 => 'satu',
        2 => 'dua',
        3 => 'tiga',
        4 => 'empat',
        5 => 'lima',
        6 => 'enam',
        7 => 'tujuh',
        8 => 'delapan',
        9 => 'sembilan',
        10 => 'sepuluh',
        11 => 'sebelas',
        12 => 'dua belas',
        13 => 'tiga belas',
        14 => 'empat belas',
        15 => 'lima belas',
        16 => 'enam belas',
        17 => 'tujuh belas',
        18 => 'delapan belas',
        19 => 'sembilan belas',
        20 => 'dua puluh',
        30 => 'tiga puluh',
        40 => 'empat puluh',
        50 => 'lima puluh',
        60 => 'enam puluh',
        70 => 'tujuh puluh',
        80 => 'delapan puluh',
        90 => 'sembilan puluh'
    );

    if ($angka < 0 || $angka > 100) {
        return "silahkan masukkan bilangan 1-100";
    } elseif ($angka < 20) {
        return $angka_kata[$angka];
    } elseif ($angka < 100) {
        $puluh = $angka % 10;
        if ($puluh == 0) {
            return $angka_kata[$angka - $puluh];
        } else {
            return $angka_kata[$angka - $puluh] . " " . $angka_kata[$puluh];
        }
    } else {
        return "silahkan masukkan bilangan 1-100";
    }
}
echo angka_ke_kata(4); // Output: empat

echo angka_ke_kata(20); // Output: dua puluh

echo angka_ke_kata(39); // Output: tiga puluh sembilan

echo angka_ke_kata(104); // Output: silahkan masukkan bilangan 1-100