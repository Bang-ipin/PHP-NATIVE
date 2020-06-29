<html>
	<head>
		<title>FORM SETORAN</title>
		<!---------------CSS------------>
		<link href="css/bootstrap.css" type="text/css" rel="stylesheet" >
		<!---------------JS------------>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<form action = "formsetoran.php" method="POST">
				<fieldset>
					<legend> FORM SETORAN : </legend>
					<b>Nama Lengkap : </b> <br> 
					<select name="id_anggota" class="form-control" required>
						<option>--PILIH NAMA --</option>
						<?php 
							include "koneksi.php";
							$query 		= mysqli_query($con,"SELECT * FROM anggota order by nama ASC");
							if(mysqli_num_rows($query)>0){?>
							<?php while($row=mysqli_fetch_array($query)){?>
								<option value="<?php echo $row['id'];?>"> <?php echo $row['nama'];?></option>
							<?php } ?>
						<?php } ?>
					</select><br/>
					<b>Tanggal : </b> <br> <input type="date" class="form-control" id="tglsetor" name="tglsetor" required /><br>
					<b>Jumlah Setoran : </b> <br> <input  type="text" class="form-control" id="jmlsetoran" name="jmlsetoran" required /><br>
					<input type="submit" class="btn btn-default" name="simpansetoran" value="simpan">
					<a href="menu.php" class="btn btn-default" >Kembali</a>
				</fieldset>
			</form>
		</div>
		<script>
			$("#jmlsetoran").keypress(function(data){
				if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
					return false;
				}
			});
			
		</script>
		<?php
			include "koneksi.php";
			if (isset($_POST['simpansetoran'])) {
			$id_anggota = $_POST['id_anggota'];
			$tanggal 	= $_POST['tglsetor'];
			$jmlsetoran = $_POST['jmlsetoran'];
			
			$query 		= "INSERT INTO setoran (id_anggota,tanggal,jml_setoran) VALUE ('$id_anggota','$tanggal','$jmlsetoran')" or die (mysqli_error());
			$query2 	= "UPDATE anggota SET saldo =saldo+'$jmlsetoran' WHERE id='$id_anggota'";
			mysqli_query($con,$query2);
			
			if (mysqli_query($con,$query)) {
					echo "<script> alert('data tersimpan')</script>";
				}
			}
		?>
	</body>
</html>