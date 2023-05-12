<?php
function find_low_high($arr)
{
    $n = count($arr);
    $min = $arr[0];
    $max = $arr[0];

    for ($i = 1; $i < $n; $i++) {
        if ($arr[$i] < $min) {
            $min = $arr[$i];
        }

        if ($arr[$i] > $max) {
            $max = $arr[$i];
        }
    }

    return array("low" => $min, "high" => $max);
}
$arr = array(4, 2, 6, 88, 3, 11);
$result = find_low_high($arr);
echo "low : " . $result['low'] . ", high : " . $result['high'];
