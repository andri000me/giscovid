<?php
if(isset($_GET['id']))
{
  $ambil = $bantuan->hapus_bantuan($_GET['id']);
  echo "<script>alert('Data Berhasil Di Hapus');location='index.php?halaman=bantuan'</script>";
}
?>