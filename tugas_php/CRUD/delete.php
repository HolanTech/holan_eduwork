<?php
include_once("connect.php");

$page=$_GET['page'];

if($page == "pengarang"){
  $id_pengarang = $_GET['id_pengarang'];
  $result = mysqli_query($mysqli, "DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'");
  // After delete redirect to Pengarang, so that latest user list will be displayed.
  header("Location:pengarang.php");
}
 
if($page == "buku"){
  $isbn = $_GET['isbn'];
  $result = mysqli_query($mysqli, "DELETE FROM buku WHERE isbn='$isbn'");
  // After delete redirect to Buku, so that latest user list will be displayed.
  header("Location:index.php");
}

if($page == "penerbit"){
  $id_penerbit = $_GET['id_penerbit'];
  $result = mysqli_query($mysqli, "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'");
  // After delete redirect to Penerbit, so that latest user list will be displayed.
  header("Location:penerbit.php");
}

if($page == "katalog"){
  $id_katalog = $_GET['id_katalog'];
  $result = mysqli_query($mysqli, "DELETE FROM katalog WHERE id_katalog='$id_katalog'");
  // After delete redirect to Katalog, so that latest user list will be displayed.
  header("Location:katalog.php");
}

?>