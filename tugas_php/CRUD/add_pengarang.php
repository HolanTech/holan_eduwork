<html>
<head>
	<title>Add Pengarang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
  <?php
    include_once("connect.php");
      $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
  ?>
<body>
  <div class="my-2 ms-5" >
      <a class="btn btn-primary" role="button" href="pengarang.php">Go to Pengarang</a>
  </div>
	<form class="mx-4" action="add_pengarang.php" method="post" name="form1">
		<table class="table" width="25%" border="0">
        <tr> 
          <td>ID Pengarang</td>
          <td><input type="text" name="id_pengarang"></td>
        </tr>
        <tr> 
          <td>Nama Pengarang</td>
          <td><input type="text" name="nama_pengarang"></td>
        </tr>
        <tr> 
          <td>Email</td>
          <td><input type="text" name="email"></td>
        </tr>
        <tr> 
          <td>Telepon</td>
          <td><input type="text" name="telp"></td>
        </tr>
        <tr> 
          <td>Alamat</td>
          <td><input type="text" name="alamat"></td>
        </tr>
        <tr> 
          <td></td>
          <td><input class="btn btn-primary" type="submit" name="Submit" value="Add"></td>
			  </tr> 
		</table>
	</form>
	<?php
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {

			  $id_pengarang = $_POST['id_pengarang'];
        $nama_pengarang = $_POST['nama_pengarang'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];	

			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `email`, `telp`, `alamat`) VALUES ('$id_pengarang', '$nama_pengarang', '$email', '$telp', '$alamat');");
		
      header("Location:pengarang.php");
		}
	?>
</body>
</html>