<?php
$data_bantuan = $bantuan->tampil_admin($_SESSION['admin']['id_desa']);
?>
<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Bantuan Penduduk</h1>
	<a href="index.php?halaman=tambah_bantuan" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
</div>

<div class="card">
	<div class="card-body table-responsive">
		<?php if (!empty($data_bantuan)): ?>

			<table class="table-bordered table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NO. KK</th>
						<th>NIK</th>
						<th>Nama Lengkap</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_bantuan as $key => $value): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $value['kk']; ?></td>
							<td><?php echo $value['nik']; ?></td>
							<td><?php echo $value['nama']; ?></td>
							<td>
								<?php if ($value['jk']=="L"): ?>
									Laki-Laki
								<?php else: ?>
									Perempuan
								<?php endif ?>
							</td>
							<td><?php echo $value['alamat']; ?></td>
							<td><?php echo $value['keterangan']; ?></td>
							<td>
								<a href="index.php?halaman=edit_bantuan&id=<?php echo $value['id_bantuan']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
								<a href="index.php?halaman=hapus_bantuan&id=<?php echo $value['id_bantuan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin')"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		<?php else: ?>
			<div class="alert alert-info">
				Belum ada data bantuan.
			</div>
		<?php endif ?>
	</div>
</div>