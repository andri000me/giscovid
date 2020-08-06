<?php
$data_kegiatan = $kegiatan->tampil_admin($_SESSION['admin']['id_desa']);
?>
<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Kegiatan</h1>
	<a href="index.php?halaman=tambah_kegiatan" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
</div>

<div class="card">
	<div class="card-body table-responsive">
		<?php if (!empty($data_kegiatan)): ?>

			<table class="table-bordered table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Desa</th>
						<th>Judul Kegiatan</th>
						<th>Tanggal Kegiatan</th>
						<th>Deskripsi Kegiatan</th>
						<th>Aksi</th>
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
							<td>
								<a href="index.php?halaman=edit_kegiatan&id=<?php echo $value['id_kegiatan']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
								<a href="index.php?halaman=hapus_kegiatan&id=<?php echo $value['id_kegiatan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin')"><i class="fa fa-trash"></i></a>
							</td>
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