<?php
//menghitung luas persegi panjang
function persegi_panjang(int $p , int $l):void
{
    $hasil = $p * $l ;
    echo "luas persegi panjang <br>$p*$l= {$hasil} <br><br>";
}
persegi_panjang(20 , 30);
//mengitung luas segitiga
function segitiga (int $a,int $t):void 
{
    $luas = 1/2 * $a * $t ;
    echo "Luas segitiga <br>1/2*$a*$t= {$luas} <br><br>" ;
}
segitiga(20,20);

//menghitung luas lingkaran
function lingkaran(int $r):void
{
    $luas = 22/7 * $r**2 ;
    echo "Luas lingkaran <br>22/7*($r**2)= {$luas} <br><br>";
}
lingkaran(30);
//menghitung volume kubus
function kubus(int $s):void
{
    $volume = $s**3 ;
    echo "Volume kumus <br>$s**3= {$volume} <br><br>" ;
}
kubus(50);
//menghitung volume balok
function balok(int $p , int $l , int $t):void
{
    $volume = $p * $l * $t ;
    echo "Volume balok <br>$p*$l*$t= {$volume} <br><br>";
}
balok(30, 30, 30);
?>