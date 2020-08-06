<!-- Page Heading -->
<?php $detail = $bantuan->detail($_GET['id']); ?>
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Edit Bantuan</h1>
	<a href="index.php?halaman=bantuan" class="float-right btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<div class="card">
	<div class="card-body">
		<form method="POST">
			<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" class="form-control" name="nama" required value="<?php echo $detail['nama'] ?>">
			</div>

			<div class="form-group">
				<label>NO KK</label>
				<input type="number" class="form-control" name="kk" required value="<?php echo $detail['kk'] ?>">
			</div>

			<div class="form-group">
				<label>NIK</label>
				<input type="number" class="form-control" name="nik" required value="<?php echo $detail['nik'] ?>">
			</div>

			<div class="form-group">
				<label>Jenis Kelamin</label>
				<br/>
				<input type="radio" name="jk" required value="L" <?php if($detail['jk']=="L"){echo "checked";} ?>> Laki-laki
				<br/>
				<input type="radio" name="jk" required value="P" <?php if($detail['jk']=="P"){echo "checked";} ?>> Perempuan
			</div>
			
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat" required><?php echo $detail['alamat'] ?></textarea>
			</div>

			<div class="form-group">
				<label>Keterangan</label>
				<textarea id="editor" class="form-control" name="keterangan"><?php echo $detail['keterangan'] ?></textarea>
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
						<input type="text" class="form-control" name="lat" id="lat" required readonly value="<?php echo $detail['lat_bantuan'] ?>">
					</div>
					<div class="col-md-6">
						<input type="text" class="form-control" name="lng" id="lng" required readonly value="<?php echo $detail['lng_bantuan'] ?>">
					</div>	
				</div>
			</div>
			<button class="btn btn-primary btn-sm" name="simpan">Simpan</button>
		</form>
		<?php
		if(isset($_POST['simpan'])){
			$cek = $bantuan->edit($_SESSION['admin']['id_desa'],$_POST['nama'],$_POST['kk'],$_POST['nik'],$_POST['jk'],$_POST['alamat'],$_POST['lat'],$_POST['lng'],$_POST['keterangan'],$_GET['id']);
				echo "<script>alert('Data berhasil disimpan');location='index.php?halaman=bantuan';</script>";
		}
		?>
	</div>
</div>