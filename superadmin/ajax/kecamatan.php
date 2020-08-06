<?php
$id_distrik = $_POST["id_distrik"];
$kodepos = $_POST["kodepos"];
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$id_distrik,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array("key: 25ac07716543d70bee96175bd541c2b5")));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) 
{
	echo "cURL Error #:" . $err;
} 
else 
{
	$array_response = json_decode($response,TRUE);

	$data_kecamatan = $array_response["rajaongkir"]["results"];

	echo "<option value=''>--Pilih Kecamatan--</option>";

	foreach ($data_kecamatan as $key => $tiap) 
	{
		echo "<option 
		subdistrict_id='".$tiap["subdistrict_id"]."' 
		province_id='".$tiap["province_id"]."' 
		province='".$tiap["province"]."' 
		city_id='".$tiap["city_id"]."' 
		city='".$tiap["city"]."' 
		type='".$tiap["type"]."' 
		subdistrict_name='".$tiap["subdistrict_name"]."'>";
		echo $tiap["subdistrict_name"];
		echo "</option>";
	}
}

?>