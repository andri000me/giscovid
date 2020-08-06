<?php
$detail = $kegiatan->detail($_GET['id']);
?>

<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Edit Kegiatan Baru</h1>
	<a href="index.php?halaman=kegiatan" class="float-right btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<div class="card">
	<div class="card-body">
		<form method="POST">
			<div class="form-group">
				<label>Judul Kegiatan</label>
				<input type="text" class="form-control" name="judul_kegiatan" value="<?php echo $detail['judul_kegiatan']; ?>">
			</div>
			<div class="form-group">
				<label>Tanggal Kegiatan</label>
				<input type="datetime-local" class="form-control" name="tanggal_kegiatan" value="<?php echo date('Y-m-d\TH:i:sP', $detail['tanggal_kegiatan']); ?>">
			</div>
			<div class="form-group">
				<label>Deskripsi Kegiatan</label>
				<textarea id="editor" class="form-control" name="deskripsi_kegiatan" rows="3"><?php echo $detail['deskripsi_kegiatan']; ?></textarea>
			</div>

			<div class="form-group">
				<label>Lokasi</label>
				<input
				id="pac-input" class="form-control" type="text"
				placeholder="Search Box" style="width: 50%;"/>
				<br/>
				<div id="map" style="width: 100%;height: 500px;"></div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" name="lat" id="lat" required readonly value="<?php echo $detail['lat_kegiatan'] ?>">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" name="lng" id="lng" required readonly value="<?php echo $detail['lng_kegiatan'] ?>">
					</div>	
				</div>
			</div>
			<button class="btn btn-success btn-sm" value="ubah" name="ubah">Ubah</button>
		</form>
		<?php
		if(isset($_POST['ubah'])){
			$cek = $kegiatan->edit($_SESSION['admin']['id_desa'],$_POST['judul_kegiatan'],$_POST['tanggal_kegiatan'],$_POST['deskripsi_kegiatan'], $_POST['lat'],$_POST['lng'],$_GET['id']);

			if($cek=="gagal"){
				echo "<script>alert('Kegiatan sudah terdaftar');location='index.php?halaman=edit_kegiatan';</script>";
			}else{
				echo "<script>alert('Data berhasil diubah');location='index.php?halaman=kegiatan';</script>";
			}
		}
		?>
	</div>
</div>