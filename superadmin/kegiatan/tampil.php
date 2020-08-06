<?php
$data_kegiatan = array();
$provinsi="";
$kabupaten="";
$kecamatan="";
$desa_n="";
if(isset($_POST['cari'])){

	$data_kegiatan = $kegiatan->tampil_kegiatan_by_desa($_POST['desa']);
	$detaildesa = $desa->detail($_POST['desa']);

	$provinsi=$detaildesa['provinsi'];
	$kabupaten=$detaildesa['kabupaten'];
	$kecamatan=$detaildesa['kecamatan'];
	$desa_n=$detaildesa['nama_desa'];
}
?>
<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Kegiatan</h1>
</div>
<div class="card">
	<div class="card-body">
		<form method="POST">
			<div class="row">
				<div class="col-lg-3">
					<div class="form-group">
						<label>Provinsi</label>
						<select name="provinsi" class="form-control" required>
							<option value="">-- Pilih Provinsi --</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label>Kabupaten</label>
						<select name="kabupaten" class="form-control" required>
							<option value="">-- Pilih Kabupaten --</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label>Kecamatan</label>
						<select name="kecamatan" class="form-control" required>
							<option value="">-- Pilih Kecamatan --</option>
						</select>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						<label>Desa</label>
						<select name="desa" class="form-control" required>
							<option value="">-- Pilih Desa --</option>
						</select>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" name="cari">Cari</button>
		</form>
	</div>
</div>
<br>
<div class="card">
	<div class="card-body table-responsive">
		<?php if (!empty($data_kegiatan)): ?>
			
			<h6><b>Tampil Data Berdasarkan:</b></h6>
			<br>

			<h6>Provinsi : <?php echo $provinsi; ?></h6>
			<h6>Kabupaten : <?php echo $kabupaten; ?></h6>
			<h6>Kecamatan : <?php echo $kecamatan; ?></h6>
			<h6>Desa : <?php echo $desa_n; ?></h6>

			<br>

			<table class="table-bordered table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Desa</th>
						<th>Judul Kegiatan</th>
						<th>Tanggal Kegiatan</th>
						<th>Deskripsi Kegiatan</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_kegiatan as $key => $value): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $value['nama_desa']; ?></td>
							<td><?php echo $value['judul_kegiatan']; ?></td>
							<td><?php echo $value['tanggal_kegiatan']; ?></td>
							<td><?php echo $value['deskripsi_kegiatan']; ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<div class="alert alert-info">
				Belum ada data kegiatan.
			</div>
		<?php endif ?>
	</div>
</div>