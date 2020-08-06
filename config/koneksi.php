<?php
ob_start();
session_start();
ob_clean();
$db = new mysqli("localhost","root","","aplikasi-gis-covid");

class desa{

	private $table='desa';
	private $koneksi;

	function __construct($db)
	{
		$this->koneksi = $db;
	}

	public function tampil(){

		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." ORDER BY id_desa DESC");
		$semua=array();
		while($per_data = $ambil->fetch_assoc()){
			$semua[] = $per_data;
		}

		return $semua;
	}

	public function tambah($provinsi,$kabupaten,$kecamatan,$desa){
		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." WHERE provinsi='$provinsi' AND kabupaten='$kabupaten' AND kecamatan='$kecamatan' AND nama_desa='$desa'");

		if($ambil->num_rows ==1){
			return 'gagal';
		}else{
			$this->koneksi->query("INSERT INTO ".$this->table." (provinsi,kabupaten,kecamatan,nama_desa)VALUES('$provinsi','$kabupaten','$kecamatan','$desa')");
			return 'berhasil';
		}
	}

	public function detail($id){

		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." WHERE id_desa='$id'");
		$detail = $ambil->fetch_assoc();

		return $detail;
	}

	public function desa_kecamatan($kecamatan){

		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." WHERE kecamatan='$kecamatan'");
		$semua=array();
		while($per_data = $ambil->fetch_assoc()){
			$semua[] = $per_data;
		}

		return $semua;
	}

}

$desa = new desa($db);

class admin{

	private $table='admin';
	private $koneksi;

	function __construct($db)
	{
		$this->koneksi = $db;
	}

	public function tampil(){

		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." LEFT JOIN desa ON admin.id_desa=desa.id_desa ORDER BY id_admin DESC");
		$semua=array();
		while($per_data = $ambil->fetch_assoc()){
			$semua[] = $per_data;
		}

		return $semua;
	}

	public function tambah($nama,$username,$password,$desa){
		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." WHERE username='$username'");

		if($ambil->num_rows ==1){
			return 'gagal';
		}else{

			$password = sha1($password);

			$this->koneksi->query("INSERT INTO ".$this->table." (nama,username,password,id_desa)VALUES('$nama','$username','$password','$desa')");
			return 'berhasil';
		}
	}

	public function detail($id){

		$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." LEFT JOIN desa ON admin.id_desa=desa.id_desa WHERE id_admin='$id'");
		$detail = $ambil->fetch_assoc();

		return $detail;
	}

	public function edit($nama,$username,$password,$id_desa,$id){
		$detail = $this->detail($id);
		if($detail['username']==$username){

			if(empty($password)){
				$this->koneksi->query("UPDATE admin SET nama='$nama', username='$username', id_desa='$id_desa' WHERE id_admin='$id'");
				return 'berhasil';
			}else{
				$password = sha1($password);
				$this->koneksi->query("UPDATE admin SET nama='$nama', username='$username', id_desa='$id_desa',password='$password' WHERE id_admin='$id'");
				return 'berhasil';
			}
		}else{

			$ambil = $this->koneksi->query("SELECT * FROM ".$this->table." WHERE username='$username'");

			if($ambil->num_rows ==1){
				return 'gagal';
			}else{
				if(empty($password)){
					$this->koneksi->query("UPDATE admin SET nama='$nama', username='$username', id_desa='$id_desa' WHERE id_admin='$id'");
					return 'berhasil';
				}else{
					$password = sha1($password);
					$this->koneksi->query("UPDATE admin SET nama='$nama', username='$username', id_desa='$id_desa',password='$password' WHERE id_admin='$id'");
					return 'berhasil';
				}
			}
		}
	}

}

$admin = new admin($db);

class kegiatan{

	private $table='kegiatan';
	private $koneksi;

	function __construct($db)
	{
		$this->koneksi = $db;
	}

	public function tampil(){

		$ambil = $this->koneksi->query("SELECT * FROM kegiatan LEFT JOIN desa ON kegiatan.id_desa = desa.id_desa ORDER BY id_kegiatan DESC");
		$semua=array();
		while ($data_array = $ambil->fetch_assoc()) 
		{
			$semua[] = $data_array;
		}
		return $semua;
	}

	public function tampil_admin($id_desa){

		$ambil = $this->koneksi->query("SELECT * FROM kegiatan LEFT JOIN desa ON kegiatan.id_desa = desa.id_desa WHERE kegiatan.id_desa='$id_desa' ORDER BY id_kegiatan DESC");
		$semua=array();
		while ($data_array = $ambil->fetch_assoc()) 
		{
			$semua[] = $data_array;
		}
		return $semua;
	}

	public function tambah($id_desa,$judul_kegiatan,$tanggal_kegiatan,$deskripsi_kegiatan,$lat,$lng){
		$ambil = $this->koneksi->query("SELECT * FROM kegiatan WHERE judul_kegiatan='$judul_kegiatan'");
		if($ambil->num_rows ==1){
			return 'gagal';
		}else{
			$this->koneksi->query("INSERT INTO ".$this->table." (id_desa,judul_kegiatan,tanggal_kegiatan,deskripsi_kegiatan,lat_kegiatan,lng_kegiatan)VALUES('$id_desa','$judul_kegiatan','$tanggal_kegiatan','$deskripsi_kegiatan','$lat','$lng')");
			return 'berhasil';
		}
	}

	public function edit($id_desa,$judul_kegiatan,$tanggal_kegiatan,$deskripsi_kegiatan,$lat,$lng, $id){

		$this->koneksi->query("UPDATE kegiatan SET id_desa='$id_desa', judul_kegiatan='$judul_kegiatan', tanggal_kegiatan='$tanggal_kegiatan', deskripsi_kegiatan='$deskripsi_kegiatan',lat_kegiatan='$lat',lng_kegiatan='$lng' WHERE id_kegiatan='$id'");
		return 'berhasil';
	}

	function hapus_kegiatan($id)
	{
		$this->koneksi->query("DELETE FROM kegiatan WHERE id_kegiatan='$id'");
	}

	public function detail($id){

		$ambil = $this->koneksi->query("SELECT * FROM kegiatan LEFT JOIN desa ON kegiatan.id_desa = desa.id_desa WHERE kegiatan.id_kegiatan='$id' ORDER BY id_kegiatan DESC");
		$detail = $ambil->fetch_assoc();

		return $detail;
	}

	public function tampil_kegiatan_by_desa($id_desa){

		$ambil = $this->koneksi->query("SELECT * FROM kegiatan LEFT JOIN desa ON kegiatan.id_desa = desa.id_desa WHERE kegiatan.id_desa='$id_desa' ORDER BY id_kegiatan DESC");
		$semua=array();
		while($per_data = $ambil->fetch_assoc()){
			$semua[] = $per_data;
		}

		return $semua;
	}

}

$kegiatan = new kegiatan($db);

class bantuan{

	private $table='bantuan';
	private $koneksi;

	function __construct($db)
	{
		$this->koneksi = $db;
	}

	public function tampil(){

		$ambil = $this->koneksi->query("SELECT * FROM bantuan LEFT JOIN desa ON bantuan.id_desa = desa.id_desa ORDER BY id_bantuan DESC");
		$semua=array();
		while ($data_array = $ambil->fetch_assoc()) 
		{
			$semua[] = $data_array;
		}
		return $semua;
	}

	public function tampil_admin($id_desa){

		$ambil = $this->koneksi->query("SELECT * FROM bantuan LEFT JOIN desa ON bantuan.id_desa = desa.id_desa WHERE bantuan.id_desa='$id_desa' ORDER BY id_bantuan DESC");
		$semua=array();
		while ($data_array = $ambil->fetch_assoc()) 
		{
			$semua[] = $data_array;
		}
		return $semua;
	}

	public function tambah($id_desa,$nama,$kk,$nik,$jk,$alamat,$lat,$lng,$keterangan){

		$this->koneksi->query("INSERT INTO ".$this->table." (id_desa,nama,kk,nik,jk,alamat,lat_bantuan,lng_bantuan,keterangan)VALUES('$id_desa','$nama','$kk','$nik','$jk','$alamat','$lat','$lng','$keterangan')");
		
	}

	public function detail($id){

		$ambil = $this->koneksi->query("SELECT * FROM bantuan LEFT JOIN desa ON bantuan.id_desa = desa.id_desa WHERE bantuan.id_bantuan='$id' ORDER BY id_bantuan DESC");
		$detail = $ambil->fetch_assoc();

		return $detail;
	}

	public function edit($id_desa,$nama,$kk,$nik,$jk,$alamat,$lat,$lng,$keterangan,$id){

		$this->koneksi->query("UPDATE bantuan SET nama='$nama',kk='$kk',nik='$nik',jk='$jk',alamat='$alamat',lat_bantuan='$lat',lng_bantuan='$lng',keterangan='$keterangan' WHERE id_bantuan='$id'");
		
	}

	public function hapus_bantuan($id)
	{
		$this->koneksi->query("DELETE FROM bantuan WHERE id_bantuan='$id'");
	}

	public function tampil_bantuan_by_desa($id_desa){

		$ambil = $this->koneksi->query("SELECT * FROM bantuan LEFT JOIN desa ON bantuan.id_desa = desa.id_desa WHERE bantuan.id_desa='$id_desa' ORDER BY id_bantuan DESC");
		$semua=array();
		while($per_data = $ambil->fetch_assoc()){
			$semua[] = $per_data;
		}

		return $semua;
	}

}

$bantuan = new bantuan($db);

class kategori{

	private $table='kategori';
	private $koneksi;

	function __construct($db)
	{
		$this->koneksi = $db;
	}

	public function tampil(){

		$ambil = $this->koneksi->query("SELECT * FROM kategori_kegiatan ORDER BY nama_kategori_kegiatan ASC");
		$semua=array();
		while ($data_array = $ambil->fetch_assoc()) 
		{
			$semua[] = $data_array;
		}
		return $semua;
	}

}

$kategori = new kategori($db);

class login{

	private $koneksi;

	function __construct($db)
	{
		$this->koneksi = $db;
	}

	function login_superadmin ($username, $password)
	{
		$password = sha1($password);

		$ambil = $this->koneksi->query("SELECT * FROM superadmin WHERE username='$username' AND password='$password'");

		$hitung = $ambil->num_rows;
		if ($hitung > false) 
		{
			$pecah = $ambil->fetch_array();
			unset($pecah['password']);
			$_SESSION['superadmin'] = $pecah;

			return 'berhasil';
		}
		else
		{
			return 'gagal';
		}
	}

	function login_admin ($username, $password)
	{
		$password = sha1($password);

		$ambil = $this->koneksi->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");

		$hitung = $ambil->num_rows;
		if ($hitung > false) 
		{
			$pecah = $ambil->fetch_array();
			unset($pecah['password']);
			$_SESSION['admin'] = $pecah;

			return 'berhasil';
		}
		else
		{
			return 'gagal';
		}
	}

}

$login = new login($db);

?>