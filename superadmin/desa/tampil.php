<?php
$data_desa = $desa->tampil();
?>
<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Desa</h1>
	<a href="index.php?halaman=tambah_desa" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
</div>
<div class="card">
	<div class="card-body table-responsive">
		<?php if (!empty($data_desa)): ?>
			
			<table class="table-bordered table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Desa</th>
						<th>Kecamatan</th>
						<th>Kabupaten</th>
						<th>Provinsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_desa as $key => $value): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $value['nama_desa']; ?></td>
							<td><?php echo $value['kecamatan']; ?></td>
							<td><?php echo $value['kabupaten']; ?></td>
							<td><?php echo $value['provinsi']; ?></td>
							<td>
								<a href="index.php?halaman=edit_desa&id=<?php echo $value['id_desa']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
								<a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<?php else: ?>
				<div class="alert alert-info">
					Belum ada data kecamatan.
				</div>
			<?php endif ?>
		</div>
	</div>