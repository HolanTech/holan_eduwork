<?php

$int = 15;

for ($i = 1; $i <= $int; $i++) {
  $output = '';

  if ($i % 3 == 0) {
    $output .= 'Edu';
  }

  if ($i % 5 == 0) {
    $output .= 'Work';
  }

  if ($output == '') {
    $output = $i;
  }

  echo $output . '<br>';
}
