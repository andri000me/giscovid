<?php
include 'config/koneksi.php';
if(isset($_POST['cari'])){
  $databantuan = $bantuan->tampil_admin($_POST['desa']);
}else{
  $databantuan=array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>GIS DATA BANTUAN COVID-19</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">GIS - DATA BANTUAN COVID</a>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <div class="container-fluid">
        <div class="panel panel-default">
          <div class="panel-body">

            <form method="POST">
              <h3>Searching Data Bantuan berdasarkan desa:</h3>
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
      </div>

      <div id="map" style="width: 100%;height: 500px;"></div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script>
        var provinsi='superadmin/ajax/provinsi.php';
        var kabupaten='superadmin/ajax/kabupaten.php';
        var kecamatan='superadmin/ajax/kecamatan.php';
        var desa='superadmin/ajax/desa.php';
        var nama_provinsi='';
        var nama_kabupaten='';
        var nama_kecamatan='';
        var nama_desa='';
      </script>
      <script src="assets/admin/js/provinsi.js"></script>

      <?php if ($databantuan!=array()): ?>
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
<?php else: ?>
  <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm6Z-CVqOZ_abridFVNriw8ct993G4gpw&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
  <script>
    "use strict";

    let map;

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: {
          lat:  -6.200000,
          lng: 106.816666
        },
        zoom: 8
      });
    }
  </script>
<?php endif ?>
</body>
</html>