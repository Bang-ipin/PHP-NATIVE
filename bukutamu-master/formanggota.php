<html>
	<head>
		<title>FORM ANGGOTA</title>
		<!---------------CSS------------>
		<link href="css/bootstrap.css" type="text/css" rel="stylesheet" >
		<!---------------JS------------>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<form action = "formanggota.php" method="POST">
				<fieldset>
					<legend> FORM ANGGOTA : </legend>
					<b>Nama Lengkap : </b> <br> <input type="text" class="form-control" name="nama" size="50" required><br>
					<b>Alamat : </b> <br> <textarea rows="10" name="alamat" class="form-control" cols="50" required></textarea><br>
					<input type="submit" class="btn btn-default" name="simpananggota" value="simpan">
					<a href="menu.php" class="btn btn-default" >Kembali</a>
				</fieldset>
			</form>
		</div>
		<?php
		 include "koneksi.php";
		 if (isset($_POST['simpananggota'])) {
			$nama 		= $_POST['nama'];
			$alamat 	= $_POST['alamat'];
			
			$query 		= "INSERT INTO anggota (nama,alamat) VALUE ('$nama','$alamat')" or die (mysqli_error());
			
			if (mysqli_query($con,$query)) {
				echo "<script> alert('data tersimpan')</script>";
				}
			}
		?>
	</body>
</html>