<?php
$data_admin = $admin->tampil();
if(isset($_GET['id'])){
	$admin->hapus($_GET['id']);
	echo "<script>alert('Data berhasil dihapus');location='index.php?halaman=users';</script>";
}
?>
<!-- Page Heading -->
<div class="clearfix">
	<h1 class="h3 mb-4 float-left text-gray-800">Users/Admin</h1>
	<a href="index.php?halaman=tambah_users" class="float-right btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
</div>
<div class="card">
	<div class="card-body table-responsive">
		<?php if (!empty($data_admin)): ?>
			
			<table class="table-bordered table table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Nama</th>
						<th>Desa</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data_admin as $key => $value): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo $value['username']; ?></td>
							<td><?php echo $value['nama']; ?></td>
							<td><?php echo $value['nama_desa']; ?></td>
							<td>
								<a href="index.php?halaman=edit_users&id=<?php echo $value['id_admin']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
								<a href="index.php?halaman=users&id=<?php echo $value['id_admin']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash"></i></a>
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