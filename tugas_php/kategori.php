<?php
$name = "Holan";
  $weight = "55"; 
  // berat badan dalam kilogram
  $height = "1.65"; 
  // tinggi badan dalam meter

  $bmi = $weight / ($height * $height);

  if ($bmi < 18.5) {
    echo "Hallo ,$name . niali BMI anda adalah $bmi anda termasuk kurus";
  } elseif ($bmi >= 18.5 && $bmi < 25) {
    echo "Hallo ,$name . niali BMI anda adalah $bmi anda termasuk sedang";
  } elseif ($bmi >= 25 && $bmi < 30) {
    echo "Hallo ,$name . niali BMI anda adalah $bmi anda termasuk gemuk";
  } else {
    echo "Hallo ,$name . niali BMI anda adalah $bmi anda termasuk Obesitas";
  }
?>

