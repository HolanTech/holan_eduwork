
    <?php

    $a=20;
    $b=30;
    $c=40;
//luas persegi panjang
    $d=$a*$b;
    echo "$a*$b =$d";
    echo "<hr>";
//luas persegi
    $d=$a*$a;
    echo "$a*$a =$d";
    echo "<hr>";
//luar segitiga
    $d=$b*$b/2;
    echo"$b*$b/2=$d";
    echo"<hr>";
//luar bileh ketupat
//diagonal 1 =40 dan 2 =30
    $d=$c*$b/2;
    echo "$c*$b/2=$d";
    echo "<hr>";
//luas lingkaran
//jari-jari=20
    $d = 3.14 * $a ** 2;
    echo "3.14*$a**2*=$d";
    echo "<hr>";
//Kubus
//dimana sisi=20
    $d = $a **3;
    echo "$a**3=$d";
    echo "<hr>";
//Balok: panjang=c lebar=b tinggi =a
    $d = $c * $b * $a;
    echo "$c*$b*$a=$d";
    echo "<hr>";

//Prisma Segitiga: panjang =a lebar =c dan tinggi =b
    $d = ($a * $c / 2) *$b;
    echo "($a*$c/2)*$b=$d";
    echo "<hr>";


?>
