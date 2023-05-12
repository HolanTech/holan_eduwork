<?php
function is_leap_year($year)
{
    if ($year % 4 == 0) {
        if ($year % 100 == 0) {
            if ($year % 400 == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    } else {
        return false;
    }
}
$year1 = 2021;
if (is_leap_year($year1)) {
    echo $year1 . " adalah tahun kabisat";
} else {
    echo $year1 . " bukan tahun kabisat";
}

$year2 = 2024;
if (is_leap_year($year2)) {
    echo $year2 . " adalah tahun kabisat";
} else {
    echo $year2 . " bukan tahun kabisat";
}
