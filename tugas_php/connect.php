<?php 
$servername = "localhost";
$database = "database_perpustakaan";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("connection failed:" . mysqli_connect_error());
}

// echo "connected sucsessfully";
// mysqli_close($conn);

$sql = "SELECT * FROM buku WHERE harga_pinjam > 5000 ORDER BY judul ASC;";
$result = $conn->query($sql);

if($result -> num_rows > 0){
  //output data each row
  while($row = $result ->fetch_assoc()){
    echo "Buku : ". $row["isbn"]. "  " . "Judul : ". $row["judul"]. "". "Harga Pinjam : ". $row["harga_pinjam"]."<br>";
  }
} else {
  echo "0 result";
}

echo "<hr>";

$sql = "SELECT * FROM buku WHERE judul LIKE '%belajar%' ORDER BY judul ASC;";
$result = $conn->query($sql);

if($result -> num_rows > 0){
  //output data each row
  while($row = $result ->fetch_assoc()){
    echo "Buku : ". $row["isbn"]. "  " ."Judul : ". $row["judul"]. "<br>";
  }
} else {
  echo "0 result";
}

$conn->close()

?>