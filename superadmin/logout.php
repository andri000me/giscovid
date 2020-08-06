<?php
// berhentikan session
session_destroy();

echo "<script>alert('Anda berhasil logout');location='login.php';</script>";

?>