<!DOCTYPE html>
<html>
<head>
	<title>Looping2</title>
  <style>
    table{width:300px; text-align:center; margin:auto;}
    table th { background-color: #428df5; }
    h2 {text-align:center; font-style:italic; font-weight:bold;}
    tr:nth-child(odd) {background: #a2abb8;}
  </style>
</head>
<body>
<form>
		<table border= "1"  >
			<tr >
				<th>NO</th>
				<th>Nama</th>
				<th>Kelas</th>
			</tr>
		<?php  for ($no=1, $i=1, $a=10; 
                $no <= 10, $i <= 10, $a >= 1; 
                $no++, $i++, $a--) { ?>
			<tr>
				<td> <?php echo $no; ?></td>
				<td><?php echo "Nama ke- $i"; ?></td>
				<td><?php echo "Kelas $a"; ?></td>
			</tr>
		<?php } ?>
        

		</table>
	</form>
</body>
</html>