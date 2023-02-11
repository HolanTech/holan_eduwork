<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>Daftar Nilai</nav>
  <table>
        <tr>
          <th>No.</th>
          <th>Nama</th>
          <th>Tanggal Lahir</th>
          <th>Umur</th>
          <th>Alamat</th>
          <th>Kelas</th>
          <th>Nilai</th>
          <th>Hasil</th>
        </tr>
        <?php 
      $json_data = file_get_contents("data.json");
      $students = json_decode($json_data,true);
      if(count($students) !=0){
        foreach($students as $student => $value){
          $date = $value['tanggal_lahir'];
          $datepart = str_split("$date",4);
          $year = $datepart[0];
          $umur = date('Y') - $year;
          ?>
        <tr>
          <td><?php echo $student+1; ?></td>
          <td><?php echo $value['nama']; ?></td>
          <td><?php echo $value['tanggal_lahir']; ?></td>
          <td><?php echo $umur; ?></td>
          <td><?php echo $value['alamat']; ?></td>
          <td><?php echo $value['kelas']; ?></td>
          <td><?php echo $value['nilai']; ?></td>
          <td><?php if($value['nilai']>=90){
            echo "A";
          } elseif($value['nilai']<90 && $value['nilai']>=80){
            echo "B";
          } elseif($value['nilai']<80 && $value['nilai']>=70){
            echo "C";
          } else {
            echo "D";
          }
          ?></td>
        </tr>
      <?php 
        }
      }
    ?>
  </tabel>
</body>
</html>