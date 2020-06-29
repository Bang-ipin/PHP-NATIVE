<html>
<head>
	<title>LIST ANGGOTA</title>
	<!---------------CSS------------>
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet" >
	<!---------------JS------------>
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>
	</head>
<body>
<?php
include "koneksi.php";
$query = "SELECT * FROM anggota";
$hasil = mysqli_query($con,$query);
echo " <div class='container'>";
echo "<h2>NAMA ANGGOTA</h2>";

echo "<table class='table table-bordered table-striped' width=\"100%\" style=\"border: black 1px solid\">";
echo "<thead>";
echo "<tr bgcolor=\"silver\">";
echo"<th width='5%'>No</th>
	<th width='15%'>Nama</th>
	<th width='15%'>Alamat</th>
	<th width='15%'>Saldo Awal</th>
	<th width='20%'>Bunga (6%)</th>
	<th width='20%'>Saldo Akhir</th>";
echo "</tr>";
echo "</thead>";


$no = 1;
while ($detail = mysqli_fetch_array($hasil)){
$bunga					= 6/100*$detail['saldo'];
$saldoakhir 			= $bunga+$detail['saldo'];
echo "<tbody>";
echo "<tr>";
echo "<td align='center'>".$no."</td>";
echo "<td align='center'>".$detail['nama']."</td>";
echo "<td align='center'>".$detail['alamat']."<br/>";
echo "<td align='center'>".$detail['saldo']."<br/>";
echo "<td align='center'>".$bunga."<br/>";
echo "<td align='center'>".$saldoakhir."<br/>";

$no++;
}
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "<a href=\"menu.php\" class='btn btn-default'>Kembali</a>";
echo "</div>";

?>