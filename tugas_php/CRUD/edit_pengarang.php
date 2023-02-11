<html>
<head>
	<title>Edit pengarang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
</head>
  <?php
  include_once("connect.php");
    $id_pengarang = $_GET['id_pengarang'];
      $pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang'");
    
      while($pengarang_data = mysqli_fetch_array($pengarang))
      {
        $nama_pengarang = $pengarang_data['nama_pengarang'];
        $email = $pengarang_data['email'];
        $telp = $pengarang_data['telp'];
        $alamat = $pengarang_data['alamat'];
      }
  ?>
<body>
  <div class="my-2 ms-5" >
      <a class="btn btn-primary" role="button" href="pengarang.php">Go to pengarang</a>
  </div>
  <form class="mx-4" action="edit_pengarang.php?id_pengarang=<?php echo $id_pengarang; ?>" method="post">
    <table class="table" width="25%" border="0">
      <tr> 
        <td>ID Pengarang</td>
        <td style="font-size: 11pt;"><?php echo $id_pengarang; ?> </td>
      </tr>
      <tr> 
        <td>Nama Pengarang</td>
        <td><input type="text" name="nama_pengarang" value="<?php echo $nama_pengarang; ?>"></td>
      </tr>
      <tr> 
        <td>Email</td>
        <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
      </tr>
      <tr> 
        <td>Telepon</td>
        <td><input type="text" name="telp" value="<?php echo $telp; ?>"></td>
      </tr>
      <tr> 
        <td>Alamat</td>
        <td><input type="text" name="alamat" value="<?php echo $alamat; ?>"></td>
      </tr>
      <tr> 
        <td></td>
        <td><input class="btn btn-primary" type="submit" name="update" value="Update"></td>
      </tr>
    </table>
  </form>
  <?php
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['update'])) {

      $id_pengarang = $_GET['id_pengarang'];
      $nama_pengarang = $_POST['nama_pengarang'];
      $email = $_POST['email'];
      $telp = $_POST['telp'];
      $alamat = $_POST['alamat'];

      include_once("connect.php");

      $result = mysqli_query($mysqli, "UPDATE pengarang SET nama_pengarang = '$nama_pengarang',email='$email',telp='$telp',alamat='$alamat' WHERE id_pengarang='$id_pengarang';");
      
      header("Location:pengarang.php");
    }
  ?>
</body>
</html>