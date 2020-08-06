$(document).ready(function(){
	$(document).ajaxStart(function(){
		$('.bg').show();
	}).ajaxStop(function(){
		$('.bg').hide();
	});
	$.ajax({
		type:'post',
		url:provinsi,
		data:'nama_provinsi='+nama_provinsi,
		success:function(hasil_provinsi)
		{
			$("select[name=provinsi]").html(hasil_provinsi);
		}
	});

	var id_provinsiterpilih = $("select[name=provinsi]").find("option:selected").attr("id_provinsi");

	console.log(id_provinsiterpilih);
	$.ajax({
		type:'post',
		url:kabupaten,
		data:'id_provinsi='+id_provinsiterpilih,
		success:function(hasil_distrik)
		{
			$("select[name=kabupaten]").html(hasil_distrik);
		}
	});

	$("select[name=provinsi]").on("change",function(){
		var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
		$.ajax({
			type:'post',
			url:kabupaten,
			data:'id_provinsi='+id_provinsi_terpilih,
			success:function(hasil_distrik)
			{
				$("select[name=kabupaten]").html(hasil_distrik);
			}
		});
	});

	$("select[name=kabupaten]").on("change",function() {
		var id_distrik_terpilih = $("option:selected",this).attr("id_distrik");
		var kodepos = $("option:selected",this).attr("kodepos");
		$.ajax({
			type:'post',
			url:kecamatan,
			data:'id_distrik='+id_distrik_terpilih+'&kodepos='+kodepos,
			success:function(hasil_kecamatan)
			{
				console.log(hasil_kecamatan);
				$("select[name=kecamatan]").html(hasil_kecamatan);
			}
		});
	});


	$("select[name=kecamatan]").on("change",function() {
		var kecamatan_n = $("option:selected",this).attr("subdistrict_name");
		console.log(kecamatan_n);
		$.ajax({
			type:'post',
			url:desa,
			data:'kecamatan='+kecamatan_n,
			success:function(hasil_desa)
			{
				console.log(hasil_desa);
				$("select[name=desa]").html(hasil_desa);
			}
		});
	});
});