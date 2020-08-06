<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Tambah Desa Baru</h1>
	<a href="index.php?halaman=desa" class="float-right btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<div class="card">
	<div class="card-body">
		<form method="POST">
			<div class="form-group">
				<label>Provinsi</label>
				<select name="provinsi" class="form-control" required>
					<option value="">-- Pilih Provinsi --</option>
				</select>
			</div>
			<div class="form-group">
				<label>Kabupaten</label>
				<select name="kabupaten" class="form-control" required>
					<option value="">-- Pilih Kabupaten --</option>
				</select>
			</div>
			<div class="form-group">
				<label>Kecamatan</label>
				<select name="kecamatan" class="form-control" required>
					<option value="">-- Pilih Kecamatan --</option>
				</select>
			</div>
			<div class="form-group">
				<label>Desa</label>
				<input type="text" class="form-control" name="nama_desa" pattern="[A-Z a-z 0-9]{3,200}" required>
			</div>
			<button class="btn btn-primary btn-sm" name="simpan">Simpan</button>
		</form>
		<?php
		if(isset($_POST['simpan'])){
			$cek = $desa->tambah($_POST['provinsi'],$_POST['kabupaten'],$_POST['kecamatan'],$_POST['nama_desa']);

			if($cek=="gagal"){
				echo "<script>alert('Desa sudah terdaftar');location='index.php?halaman=tambah_desa';</script>";
			}else{
				echo "<script>alert('Data berhasil disimpan');location='index.php?halaman=desa';</script>";
			}
		}
		?>
	</div>
</div>