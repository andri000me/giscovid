<?php include '../config/koneksi.php'; ?>
<?php 
if (!isset($_SESSION['superadmin'])) {
  echo "<script>alert('Anda harus login');location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Superadmin </title>

  <!-- Custom fonts for this template-->
  <link href="../assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'menu.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'header.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <?php
          if (!isset($_GET['halaman'])) 
          {
            include "dashboard.php";
          }
          else
          {
            if($_GET['halaman']=="desa")
            {
              include 'desa/tampil.php';
            }
            elseif($_GET['halaman']=="tambah_desa")
            {
              include 'desa/tambah.php';
            }
            elseif($_GET['halaman']=="edit_desa"){
              include 'desa/edit.php';
            }
            elseif($_GET['halaman']=="users")
            {
              include 'users/tampil.php';
            }
            elseif($_GET['halaman']=="tambah_users")
            {
              include 'users/tambah.php';
            }
            elseif($_GET['halaman']=="edit_users")
            {
              include 'users/edit.php';
            }
            elseif($_GET['halaman']=="kegiatan")
            {
              include 'kegiatan/tampil.php';
            }
            elseif($_GET['halaman']=="bantuan")
            {
              include 'bantuan/tampil.php';
            }
            elseif($_GET['halaman']=="logout")
            {
              include 'logout.php';
            }
          }
          ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/admin/js/sb-admin-2.min.js"></script>

  <?php if (isset($_GET['halaman'])): ?>
    <?php if ($_GET['halaman']=="tambah_desa"): ?>
      <script>
        var provinsi='ajax/provinsi.php';
        var kabupaten='ajax/kabupaten.php';
        var kecamatan='ajax/kecamatan.php';
        var nama_provinsi='';
        var nama_kabupaten='';
        var nama_kecamatan='';
      </script>
      <script src="../assets/admin/js/provinsi.js"></script>
    <?php endif ?>
    <?php if ($_GET['halaman']=="edit_desa"): ?>
      <script>
        var provinsi='ajax/provinsi.php';
        var kabupaten='ajax/kabupaten.php';
        var kecamatan='ajax/kecamatan.php';
        var nama_provinsi='<?php echo $detail['provinsi'] ?>';
        var nama_kabupaten='<?php echo $detail['kabupaten'] ?>';
        var nama_kecamatan='<?php echo $detail['kecamatan'] ?>';
      </script>
      <script src="../assets/admin/js/provinsi.js"></script>
    <?php endif ?>
    <?php if ($_GET['halaman']=="tambah_users" OR $_GET['halaman']=="edit_users" OR $_GET['halaman']=="kegiatan" OR $_GET['halaman']=="bantuan"): ?>
      <script>
        var provinsi='ajax/provinsi.php';
        var kabupaten='ajax/kabupaten.php';
        var kecamatan='ajax/kecamatan.php';
        var desa='ajax/desa.php';
        var nama_provinsi='';
        var nama_kabupaten='';
        var nama_kecamatan='';
        var nama_desa='';
      </script>
      <script src="../assets/admin/js/provinsi.js"></script>
    <?php endif ?>

  <?php endif ?>
  <script>
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
      console.error( error );
    } );
  </script>

  <?php if (!isset($_GET['halaman'])): ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm6Z-CVqOZ_abridFVNriw8ct993G4gpw&callback=initialize" defer></script>
    <script>

      var markers = [
      <?php foreach ($databantuan as $key => $value): ?>
        ['NO.KK : <?php echo $value['kk'] ?><br/>NIK : <?php echo $value['nik'] ?><br/>Nama Lengkap : <?php echo $value['nama'] ?><br/>Jenis Kelamin : <?php echo $value['jk'] ?><br/>Alamat : <?php echo $value['alamat'] ?><br/>Keterangan : <?php echo $value['keterangan'] ?>', <?php echo $value['lat_bantuan'] ?> , <?php echo $value['lng_bantuan'] ?>],
      <?php endforeach ?>
      ];

      function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }     
        var map = new google.maps.Map(mapCanvas, mapOptions)

        var infowindow = new google.maps.InfoWindow(), marker, i;
    var bounds = new google.maps.LatLngBounds(); // diluar looping
    for (i = 0; i < markers.length; i++) {  
      pos = new google.maps.LatLng(markers[i][1], markers[i][2]);
    bounds.extend(pos); // di dalam looping
    marker = new google.maps.Marker({
      position: pos,
      map: map
    });
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(markers[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
    map.fitBounds(bounds); // setelah looping
  }

}


google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php endif ?>

</body>

</html>
