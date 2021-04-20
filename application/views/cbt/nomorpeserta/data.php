<?php
/**
 * Created by IntelliJ IDEA.
 * User: multazam
 * Date: 07/07/20
 * Time: 17:20
 */
?>

<div class="content-wrapper bg-white">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $judul ?></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="card card-default my-shadow mb-4">
				<div class="card-header">
					<h6 class="card-title"><?= $subjudul ?></h6>
					<div class="card-tools">
						<?= form_open('setNomor', array('id' => 'setNomor')); ?>
						<button type="submit" class="btn btn-sm btn-primary">
							<i class="fas fa-save"></i><span class="d-none d-sm-inline-block ml-1">Simpan</span>
						</button>
						<?= form_close() ?>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label>Pilih Kelas Penilaian</label>
							<?php
							echo form_dropdown(
								'kelas[]',
								$kelas,
								null,
								'id="kelas" class="form-control" multiple="multiple" data-placeholder="Pilih kelas penilaian"'
							); ?>
							<small class="ml-2"><i>Pilih semua kelas yang akan melaksanakan penilaian</i></small>
						</div>
						<div class="col-md-6 d-none" id="generate">
							<label>Aksi Kelas Terpilih</label>
							<br>
							<button type="button" class="btn btn-primary" onclick="createNumber()">Buat Nomor Otomatis
							</button>
							<button type="button" class="btn btn-danger" onclick="resetNumber()">Hapus Nomor Peserta
							</button>
						</div>
					</div>
					<div>
						<table class="table table-bordered table-sm mt-4" id="table-nomor">
						</table>
					</div>
				</div>
				<div class="overlay d-none" id="loading">
					<div class="spinner-grow"></div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	var arrKelas = JSON.parse('<?=json_encode($kelas)?>');
	var tahun = '<?=$tp_active->tahun?>';

	function pad(str, max) {
		str = str.toString();
		return str.length < max ? pad("0" + str, max) : str;
	}

	var arrayNomor = [];

	function getNomorPeserta(arr) {
		if (arr.length > 0) {
			$('#loading').removeClass('d-none');
			setTimeout(function () {
				var arrStr = encodeURIComponent(JSON.stringify(arr));
				$.ajax({
					type: "GET",
					url: base_url + "cbtnomorpeserta/getsiswakelas/" + arrStr,
					success: function (response) {
						console.log(response);
						var newArr = [];
						$.map(response.siswa, function (value, index) {
							var item = {};
							item['id'] = value.id_siswa;
							item['username'] = value.username;
							item['nama'] = value.nama;
							item['level'] = value.level;
							item['kelas'] = value.nama_kelas;
							item['nomor'] = response.nomor[value.id_siswa].nomor_peserta;

							newArr.push(item);
						});
						arrayNomor = newArr;
						createPreview();
					}
				})
			}, 500);
		} else {
			$('#generate').addClass('d-none');
		}
	}

	function resetNumber() {
		var val = $('#kelas').val();

		if (val.length > 0) {
			$('#loading').removeClass('d-none');
			setTimeout(function () {
				var arrStr = encodeURIComponent(JSON.stringify(val));
				console.log(arrStr);
				$.ajax({
					url: base_url + "cbtnomorpeserta/resetnomor?kelas="+arrStr,
					type: "GET",
					//data: $(this).serialize() + "&siswa=" + JSON.stringify(arrayNomor),
					success: function (data) {
						console.log("response:", data);
						console.log(data);
						if (data.status) {
							getNomorPeserta(val)
						} else {
							swal.fire({
								title: "ERROR",
								text: "Data Tidak Tersimpan",
								icon: "error",
								showCancelButton: false,
							});
						}
					}, error: function (xhr, status, error) {
						swal.fire({
							title: "ERROR",
							text: "Data Tidak Tersimpan",
							icon: "error",
							showCancelButton: false,
						});
					}
				});
			});
		}
	}

	function createNumber() {
		$('#loading').removeClass('d-none');
		setTimeout(function () {
			if (arrayNomor.length > 0) {
				//var t = new Date();
				//var current = t.getFullYear();
				//t.setFullYear(t.getFullYear() + 1);
                var thn = tahun.split('/');
				//console.log(current.toString().substr(-2), t.getFullYear().toString().substr(-2));

				var newArrNomor = [];
				var n = 1;
				$.map(arrayNomor, function (value, index) {
					var item = {};
					item['id'] = value.id;
					item['username'] = value.username;
					item['nama'] = value.nama;
					item['level'] = value.level;
					item['kelas'] = value.kelas;
					item['nomor'] = thn[0].substr(-2) +
						thn[1].substr(-2) + '.' +
						pad(value.level, 2) + '.' +
						pad(n, 3);

					n++;
					newArrNomor.push(item);
				});
				arrayNomor = newArrNomor;
				createPreview();
			}
		}, 500);
	}

	function createPreview() {
		$('#generate').removeClass('d-none');
		$('#table-nomor').html('');
		var tbody = '<thead class="alert-primary">' +
			'<tr>' +
			'<th class="text-center align-middle" width="40" height="50">No.</th>' +
			'<th class="text-center align-middle" width="100">USERNAME</th>' +
			'<th class="text-center align-middle">NAMA</th>' +
			'<th class="text-center align-middle">KELAS</th>' +
			'<th class="text-center align-middle">NO. PESERTA UJIAN</th>' +
			'</tr></thead><tbody>';

		for (let i = 0; i < arrayNomor.length; i++) {
			//var nomorPes = data.nomor[data.siswa[i].id_siswa].nomor_peserta;
			tbody += '<tr>' +
				'<td class="text-center">' + (i + 1) + '</td>' +
				'<td class="text-center">' + arrayNomor[i].username + '</td>' +
				'<td>' + arrayNomor[i].nama + '</td>' +
				'<td class="text-center">' + arrayNomor[i].kelas + '</td>' +
				'<td class="text-center">' + arrayNomor[i].nomor + '</td>' +
				'</tr>';
		}

		tbody += '</tbody>';
		$('#table-nomor').html(tbody);
		$('#loading').addClass('d-none');
	}

	$(document).ready(function () {
		ajaxcsrf();

		var opsiKelas = $("#kelas");
		opsiKelas.select2();

		//console.log(Object.keys(arrKelas).length);

		if (Object.keys(arrKelas).length > 0) {
			opsiKelas.prepend("<option value='Semua'>Semua Kelas</option>");
		}

		opsiKelas.change(function () {
			var val = $(this).val();
			getNomorPeserta(val);
		});

		$('#setNomor').submit('click', function (e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			if (arrayNomor.length > 0) {
				//console.log($(this).serialize() + "&siswa=" + JSON.stringify(arrayNomor));
				$.ajax({
					url: base_url + "cbtnomorpeserta/savenomor",
					type: "POST",
					dataType: "JSON",
					data: $(this).serialize() + "&siswa=" + JSON.stringify(arrayNomor),
					success: function (data) {
						console.log("response:", data);
						console.log(data);
						if (data) {
							swal.fire({
								title: "Sukses",
								text: "Nomor Peserta berhasil disimpan",
								icon: "success",
								showCancelButton: false,
							});
						} else {
							swal.fire({
								title: "ERROR",
								text: "Data Tidak Tersimpan",
								icon: "error",
								showCancelButton: false,
							});
						}
					}, error: function (xhr, status, error) {
						swal.fire({
							title: "ERROR",
							text: "Data Tidak Tersimpan",
							icon: "error",
							showCancelButton: false,
						});
					}
				});
			}
		});
	});
</script>
