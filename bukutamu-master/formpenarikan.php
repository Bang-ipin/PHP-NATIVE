<html>
	<head>
		<title>FORM PENARIKAN</title>
			<!---------------CSS------------>
			<link href="css/bootstrap.css" type="text/css" rel="stylesheet" >
			<!---------------JS------------>
			<script src="js/jquery.js" type="text/javascript"></script>
			<script src="js/bootstrap.js" type="text/javascript"></script>
	</head>
	<body>
	<div class="container">
		<form action = "formpenarikan.php" method="POST">
			<fieldset>
				<legend> FORM PENARIKAN : </legend>
				<b>Nama Lengkap : </b> <br> 
					<select name="id" id="id" class="form-control" onchange="changeValue(this.value)" required>
						<option value="pilih">--PILIH NAMA --</option>
						<?php 
							include "koneksi.php";
							$query = mysqli_query($con,"SELECT *from anggota"); 
							$jsArray = "var dtbrg = new Array();\n";  
							if(mysqli_num_rows($query)>0){?>
							<?php while($row=mysqli_fetch_array($query)){?>
								<?php 
									echo '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';    
										$jsArray .= "dtbrg['" . $row['id'] . "'] = 
										{
											saldo:'".addslashes($row['saldo'])."'
										};\n";    
								?>											
							<?php } ?>
						<?php } ?>
					</select>
					<br/>
					<script type="text/javascript">
						<?php echo $jsArray; ?>  
						function changeValue(id){  
							document.getElementById("saldo").value = dtbrg[id].saldo;  
						};
					</script>
				<b>Tanggal : </b> <br> <input type="date" class="form-control" id="tglpenarikan" name="tglpenarikan" required /><br>
				<b>Saldo: </b> <br> <input  type="text" class="form-control" name="saldo" id="saldo" readonly="true"/><br>
				<b>Jumlah Penarikan : </b> <br> <input  class="form-control" type="text" name="jmlpenarikan" id="jmlpenarikan" /><br>
				<input type="submit" class="btn btn-default" name="simpanpenarikan" value="simpan">
				<a href="menu.php" class="btn btn-default" >Kembali</a>
				</fieldset>
		</form>
	</div>
	<script>
		$("#jmlpenarikan").keypress(function(data){
			if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
				return false;
			}
		});
		
		$(function () {
			$('input[name=simpanpenarikan]').click(function (e) {
				var saldoakhir = $('#saldo').val();
				var jmltarik = $('#jmlpenarikan').val();
				var id=$('#id').val();
				if (
				id=="pilih" || id==null){
					alert('Anda Belum Memilih Nama Anggota');
					$('#id').focus();
					return false;
				}else
				if(	jmltarik=="" || jmltarik==null){
					alert('Tambahkan Nominal Penarikan');
					$('#jmlpenarikan').focus();
					return false;
				}else
				if(	Number(jmltarik) > Number(saldoakhir)){
					alert('Saldo Tidak Cukup');
					$('#jmlpenarikan').focus();
					return false;
				}
			});
		});
	</script>
			<?php
				include "koneksi.php";
				if (isset($_POST['simpanpenarikan'])) {
				$id = $_POST['id'];
				$tanggal 	= $_POST['tglpenarikan'];
				$jmlpenarikan = $_POST['jmlpenarikan'];
				
				$query 		= "INSERT INTO setoran (id_anggota,tanggal,jml_penarikan) VALUE ('$id','$tanggal','$jmlpenarikan')" or die (mysqli_error());
				$query2 	= "UPDATE anggota SET saldo =saldo-'$jmlpenarikan' WHERE id='$id'";
				mysqli_query($con,$query2);
				
				if (mysqli_query($con,$query)) {
						echo "<script> alert('data tersimpan')</script>";
					}
				}
			?>
	</body>
	</html>