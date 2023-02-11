<html>
<head>
	<title>Edit katalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
  <?php
  include_once("connect.php");
    $id_katalog = $_GET['id_katalog'];
      $katalog = mysqli_query($mysqli, "SELECT * FROM katalog WHERE id_katalog='$id_katalog'");
    
      while($katalog_data = mysqli_fetch_array($katalog))
      {
        $nama = $katalog_data['nama'];
      }
  ?>
<body>
  <div class="my-2 ms-5" >
      <a class="btn btn-primary" role="button" href="katalog.php">Go to Katalog</a>
  </div>
  <form class="mx-4" action="edit_katalog.php?id_katalog=<?php echo $id_katalog; ?>" method="post">
    <table class="table" width="25%" border="0">
      <tr> 
        <td>ID katalog</td>
        <td style="font-size: 11pt;"><?php echo $id_katalog; ?> </td>
      </tr>
      <tr> 
        <td>Nama katalog</td>
        <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
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
      
      $id_katalog = $_GET['id_katalog'];
      $nama = $_POST['nama'];
      
      include_once("connect.php");

      $result = mysqli_query($mysqli, "UPDATE katalog SET nama = '$nama' WHERE id_katalog='$id_katalog';");
      
      header("Location:katalog.php");
    }
  ?>
</body>
</html>