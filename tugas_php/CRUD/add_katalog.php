<html>
<head>
	<title>Add katalog</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
	<?php
		include_once("connect.php");
			$katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
	?>
<body>
	<div class="my-2 ms-5">
			<a class="btn btn-primary" role="button" href="katalog.php">Go to Katalog</a>
	</div>
	<form class="mx-4" action="add_katalog.php" method="post" name="form1">
		<table class="table" width="25%" border="0">
        <tr> 
          <td>ID katalog</td>
          <td><input type="text" name="id_katalog"></td>
        </tr>
        <tr> 
          <td>Nama katalog</td>
          <td><input type="text" name="nama"></td>
        <tr> 
          <td></td>
          <td><input class="btn btn-primary" type="submit" name="Submit" value="Add"></td>
			  </tr> 
		</table>
	</form>
	<?php
		// Check If form submitted, insert form data into users table.
		if(isset($_POST['Submit'])) {

			  $id_katalog = $_POST['id_katalog'];
        $nama = $_POST['nama'];

			include_once("connect.php");

			$result = mysqli_query($mysqli, "INSERT INTO `katalog` (`id_katalog`, `nama`) VALUES ('$id_katalog', '$nama');");
			
			header("Location:katalog.php");
		}
	?>
</body>
</html>