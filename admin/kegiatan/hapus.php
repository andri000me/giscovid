<?php
if(isset($_GET['id']))
{
  $ambil = $kegiatan->hapus_kegiatan($_GET['id']);
  echo "<script>alert('Data Berhasil Di Hapus');location='index.php?halaman=kegiatan'</script>";
}
?>