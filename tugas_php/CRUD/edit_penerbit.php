<html>
<head>
	<title>Edit penerbit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
</head>
  <?php
  include_once("connect.php");
    $id_penerbit = $_GET['id_penerbit'];
      $penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit'");
    
      while($penerbit_data = mysqli_fetch_array($penerbit))
      {
        $nama_penerbit = $penerbit_data['nama_penerbit'];
        $email = $penerbit_data['email'];
        $telp = $penerbit_data['telp'];
        $alamat = $penerbit_data['alamat'];
      }
  ?>
<body>
  <div class="my-2 ms-5">
      <a class="btn btn-primary" role="button" href="penerbit.php">Go Penerbit</a>
  </div>
  <form class="mx-4" action="edit_penerbit.php?id_penerbit=<?php echo $id_penerbit; ?>" method="post">
    <table class="table" width="25%" border="0">
      <tr> 
        <td>ID penerbit</td>
        <td style="font-size: 11pt;"><?php echo $id_penerbit; ?> </td>
      </tr>
      <tr> 
        <td>Nama penerbit</td>
        <td><input type="text" name="nama_penerbit" value="<?php echo $nama_penerbit; ?>"></td>
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
      
      $id_penerbit = $_GET['id_penerbit'];
      $nama_penerbit = $_POST['nama_penerbit'];
      $email = $_POST['email'];
      $telp = $_POST['telp'];
      $alamat = $_POST['alamat'];
      
      include_once("connect.php");

      $result = mysqli_query($mysqli, "UPDATE penerbit SET nama_penerbit = '$nama_penerbit',email='$email',telp='$telp',alamat='$alamat' WHERE id_penerbit='$id_penerbit';");
      
      header("Location:penerbit.php");
    }
  ?>
</body>
</html>