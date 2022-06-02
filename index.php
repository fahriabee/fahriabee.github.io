<?php
	//Koneksi Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "dbtubesbasdat";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(msqli_error($koneksi));

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		// Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE tolshop set
											Nama ='$_POST[tNama]',
											Alamat ='$_POST[tAlamat]',
											No_HP ='$_POST[tNo_HP]',
											Nama_Barang ='$_POST[tNama_Barang]',
											Harga ='$_POST[tHarga]',
											Jasa_Kirim ='$_POST[tJasa_Kirim]',
											Pembayaran ='$_POST[tPembayaran]'
											WHERE Nama ='$_GET[id]'
											");

				if($edit) //jika simpan sukses
				{
					echo "<script>
							alert('Edit data suksess!');
							document.location='index.php';
							</script>";
				}			
			else 
			{
				echo "<script>
						alert('Edit data GAGAL!');
						document.location='index.php';
						</script>";
			}
		}
		 else
		{
			//Data akan disimpan baru 
			$simpan = mysqli_query($koneksi, "INSERT INTO tolshop (Nama, Alamat, No_HP, Nama_Barang, Harga, Jasa_Kirim, Pembayaran)
			VALUES ('$_POST[tNama]',
					'$_POST[tAlamat]',
					'$_POST[tNo_HP]',
					'$_POST[tNama_Barang]',
					'$_POST[tHarga]',
					'$_POST[tJasa_Kirim]',
					'$_POST[tPembayaran]')
				");
				if($simpan) //jika simpan sukses
				{
					echo "<script>
							alert('simpan data suksess!');
							document.location='index.php';
							</script>";
				}
			else 
			{
				echo "<script>
						alert('simpan data GAGAL!');
						document.location='index.php';
						</script>";
			}
		}
	}
	

	//Pengujian jika tombol edit / hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit data
		if($_GET['hal'] == "edit")
		{
			//Tampilan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tolshop WHERE Nama = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//jika data ditemukan, maka data ditampung ke dalam variabel
				$vNama = $data['Nama'];
				$vAlamat = $data['Alamat'];
				$vNo_HP = $data['No_HP'];
				$vNama_Barang = $data['Nama_Barang'];
				$vHarga = $data['Harga'];
				$vJasa_Kirim = $data['Jasa_Kirim'];
				$vPembayaran = $data['Pembayaran'];	
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM tolshop WHERE Nama = '$_GET[id]'");
			if($hapus)
			{
				echo "<script>
						alert('Hapus data Suksess!!');
						document.location='index.php';
						</script>";
			}

		}
	}
?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Form Data Pembelian Barang</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
<h1 class="text-center">Data Pembelian Barang</h1>
<h2 class="text-center">Friendly Gadget</h2>

	<!--.Awal.Card.Form.-->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Data Konsumen yang Membeli Barang
	  </div>
	  <div class="card-body">
	   <form method="post" action="">
	   	<div class="form-group">
	   		<div class="form-group">
	   	<label>Nama</label>
	   	<input type="text" name="tNama" value="<?=@$vNama?>" class="form-control" placeholder="Input Nama anda disini!" required>
	   		<div class="form-group">
	   	<label>Alamat</label>
	   	<textarea class="form-control" name="tAlamat" placeholder="Input Alamat anda disini!"required><?=@$vAlamat?></textarea>
	   		<div class="form-group">
	   	<label>No HP</label>
	   	<input type="text" name="tNo_HP" value="<?=@$vNo_HP?>" class="form-control" placeholder="Input No HP anda disini!" required>	
	   		<div class="form-group">
	   	<label>Nama Barang</label>
	   	<select class="form-control" name="tNama_Barang" > 
	   		<option value="<?=@$vNama_Barang?>"><?=@$vNama_Barang?></option>
	   		<option value="Headset">Headset</option>
	   		<option value="Earphone">Earphone</option>
	   		<option value="Case Handphone">Case Handphone</option>
	   		<option value="Charger Handphone">Charger Handphone</option>
	   		<option value="Memory Eksternal">Memory Eksternal</option>
	   	</select>
	   	<label>Harga</label>
	   	<input type="text" name="tHarga" value="<?=@$vHarga?>" class="form-control" placeholder="Input Harga anda disini!" required>
	   		<div class="form-group">
	   	<label>Jasa Kirim</label>
	   	<select class="form-control" name="tJasa_Kirim" > 
	   		<option value="<?=@$vJasa_Kirim?>"><?=@$vJasa_Kirim?></option>
	   		<option value="JNE">JNE</option>
	   		<option value="SICEPAT">SICEPAT</option>
	   		<option value="J&T">J&T</option>
	   		<option value="NINJA EXPRESS">NINJA EXPRESS</option>
	   		<option value="POS INDONESIA">POS INDONESIA</option>
	   	</select>			
	   	<div class="form-group">
	   	<label>Pembayaran</label>
	   	<select class="form-control" name="tPembayaran" >
	   		<option value="<?=@$vPembayaran?>"><?=@$vPembayaran?></option>
	   		<option value="Alfamart">Alfamart</option>
	   		<option value="Indomart">Indomart</option>
	   		<option value="Bank BRI">Bank BRI</option>
	   		<option value="Bank BJB">Bank BJB</option>
	   		<option value="Bank BNI">Bank BNI</option>
	   		<option value="Bank Mandiri">Bank Mandiri</option>
	   		<option value="DANA">DANA</option>
	   		<option value="GOPAY">GOPAY</option>
	   	</select>			
	   	</div>

	   	<button type="sumbit" class="btn btn-success" name="bsimpan">simpan</button>
	   	<button type="reset" class="btn btn-danger" name="breset">kosongkan</button>

	   </form>
	  </div>
	</div>
	<!--.Akhir.Card.Form.-->

<!--.Awal.Card.Table.-->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Konsumen
	  </div>
	  <div class="card-body">
	   
	  	<table class="table table-bordered table-striped">
	  		<tr>
	  			<th>No.</th>
	  			<th>Nama</th>
	  			<th>Alamat</th>
	  			<th>No HP</th>
	  			<th>Nama barang</th>
	  			<th>Harga</th>
	  			<th>Jasa Kirim</th>
	  			<th>Pembayaran</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query($koneksi, "SELECT * from tolshop order by Nama desc");
	  			while($data = mysqli_fetch_array($tampil)) :
	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['Nama']?></td>
	  			<td><?=$data['Alamat']?></td>
	  			<td><?=$data['No_HP']?></td>
	  			<td><?=$data['Nama_Barang']?></td>
	  			<td><?=$data['Harga']?></td>
	  			<td><?=$data['Jasa_Kirim']?></td>
	  			<td><?=$data['Pembayaran']?></td>
	  			<td>
	  				<a href = "index.php?hal=edit&id=<?=$data['Nama']?>" class="btn btn-warning"> Edit </a>
	  				<a href = "index.php?hal=hapus&id=<?=$data['Nama']?>" onclick ="return confirm ('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
	  			</td>

	  		</tr>
	  	<?php endwhile; //penutup perulangan while?>
	  	</table>

	  </div>
	</div>
	<!--.Akhir.Card.Table.-->



	</div>



<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>