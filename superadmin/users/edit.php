<!-- Page Heading -->
<?php $detail = $admin->detail($_GET['id']); ?>
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Edit Admin/Users</h1>
	<a href="index.php?halaman=users" class="float-right btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<div class="card">
	<div class="card-body">
		<form method="POST">
			<div class="form-group">
				<label>Provinsi</label>
				<select name="provinsi" class="form-control">
					<option value="<?php echo $detail['provinsi'] ?>"><?php echo $detail['provinsi'] ?></option>
				</select>
			</div>
			<div class="form-group">
				<label>Kabupaten</label>
				<select name="kabupaten" class="form-control">
					<option value="<?php echo $detail['kabupaten'] ?>"><?php echo $detail['kabupaten'] ?></option>
				</select>
			</div>
			<div class="form-group">
				<label>Kecamatan</label>
				<select name="kecamatan" class="form-control">
					<option value="<?php echo $detail['kecamatan'] ?>"><?php echo $detail['kecamatan'] ?></option>
				</select>
			</div>
			<div class="form-group">
				<label>Desa</label>
				<select name="desa" class="form-control" required>
					<option value="<?php echo $detail['id_desa'] ?>"><?php echo $detail['nama_desa'] ?></option>
				</select>
			</div>

			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" value="<?php echo $detail['username']; ?>">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password">
				<span class="text-danger"><i>*Apabila password tidak diubah mohon dikosongkan</i></span>
			</div>

			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama" value="<?php echo $detail['nama']; ?>">
			</div>
			<button class="btn btn-primary btn-sm" name="simpan">Simpan</button>
		</form>
		<?php
		if(isset($_POST['simpan'])){
			$cek = $admin->edit($_POST['nama'],$_POST['username'],$_POST['password'],$_POST['desa'],$_GET['id']);

			if($cek=="gagal"){
				echo "<script>alert('Username sudah terdaftar');location='index.php?halaman=tambah_users';</script>";
			}else{
				echo "<script>alert('Data berhasil disimpan');location='index.php?halaman=users';</script>";
			}
		}
		?>
	</div>
</div>