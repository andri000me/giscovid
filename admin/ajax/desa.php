<?php
include '../../config/koneksi.php';

$data_desa = $desa->desa_kecamatan($_POST['kecamatan']);
?>
<option value="">- Pilih Desa -</option>
<?php foreach ($data_desa as $key => $value): ?>
	<option value="<?php echo $value['id_desa'] ?>"><?php echo $value['nama_desa']; ?></option>
<?php endforeach ?>