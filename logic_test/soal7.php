<?php
$data = array(1, 4, 7, 9, 12);
$low = 2;
$high = 15;

$result = array_filter($data, function ($x) use ($low, $high) {
    return ($x >= $low && $x <= $high);
});

$count = count($result);

echo "Jumlah angka yang termasuk dalam bagian low dan high adalah: " . $count;
