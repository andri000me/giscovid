<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Tambah Admin/Users Baru</h1>
	<a href="index.php?halaman=users" class="float-right btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
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
				<select name="desa" class="form-control" required>
					<option value="">-- Pilih Desa --</option>
				</select>
			</div>

			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password">
			</div>

			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<button class="btn btn-primary btn-sm" name="simpan">Simpan</button>
		</form>
		<?php
		if(isset($_POST['simpan'])){
			$cek = $admin->tambah($_POST['nama'],$_POST['username'],$_POST['password'],$_POST['desa']);

			if($cek=="gagal"){
				echo "<script>alert('Username sudah terdaftar');location='index.php?halaman=tambah_users';</script>";
			}else{
				echo "<script>alert('Data berhasil disimpan');location='index.php?halaman=users';</script>";
			}
		}
		?>
	</div>
</div>