<div class="content-wrapper bg-white pt-4">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-6">
					<h1><?= $judul ?></h1>
				</div>
				<div class="col-6">
					<a href="<?= base_url('cbtcetak') ?>" type="button" class="btn btn-sm btn-danger float-right">
						<i class="fas fa-arrow-circle-left"></i><span
							class="d-none d-sm-inline-block ml-1">Kembali</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="card my-shadow">
				<div class="card-header">
					<h6 class="card-title">Setting Kop</h6>
					<button class="card-tools btn btn-sm bg-primary text-white" onclick="submitKop()">
						<i class="fas fa-save mr-1"></i> Simpan
					</button>
				</div>
				<div class="card-body">
					<?= form_open('', array('id' => 'set-kop')) ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Header 1</label>
								<textarea id="header-1" class="form-control" name="header_1" rows="2"
										  placeholder="Header baris 1" required><?= $kop->header_1 ?></textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Header 2</label>
								<textarea id="header-2" class="form-control" name="header_2" rows="2"
										  placeholder="Header baris 2" required><?= $kop->header_2 ?></textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Header 3</label>
								<textarea id="header-3" class="form-control" name="header_3" rows="2"
										  placeholder="Header baris 3" required><?= $kop->header_3 ?></textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Header 4</label>
								<textarea id="header-4" class="form-control" name="header_4" rows="2"
										  placeholder="Header baris 4" required><?= $kop->header_4 ?></textarea>
							</div>
						</div>
					</div>
					<?= form_close() ?>
				</div>
			</div>

			<div class="card my-shadow">
				<div class="card-header">
					<div class="card-title">
						<h6>Cetak</h6>
					</div>
					<div id="selector" class="card-tools btn-group">
						<button type="button" class="btn active btn-primary">By Ruang</button>
						<button type="button" class="btn btn-outline-primary">By Kelas</button>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-3 d-none" id="by-kelas">
							<div class="input-group">
								<div class="input-group-prepend w-30">
									<span class="input-group-text">Kelas</span>
								</div>
								<?php
								echo form_dropdown(
									'kelas',
									$kelas,
									null,
									'id="kelas" class="form-control"'
								); ?>
							</div>
						</div>
						<div class="col-3" id="by-ruang">
							<div class="input-group">
								<div class="input-group-prepend w-30">
									<span class="input-group-text">Ruang</span>
								</div>
								<?php
								echo form_dropdown(
									'ruang',
									$ruang,
									null,
									'id="ruang" class="form-control"'
								); ?>
							</div>
						</div>
						<div class="col-3">
							<div class="input-group">
								<div class="input-group-prepend w-30">
									<span class="input-group-text">Sesi</span>
								</div>
								<?php
								echo form_dropdown(
									'sesi',
									$sesi,
									null,
									'id="sesi" class="form-control"'
								); ?>
							</div>
						</div>
						<div class="col-3">
							<div class="input-group">
								<div class="input-group-prepend w-30">
									<span class="input-group-text">Jadwal</span>
								</div>
								<?php
								echo form_dropdown(
									'jadwal',
									$jadwal,
									null,
									'id="jadwal" class="form-control"'
								); ?>
							</div>
						</div>
						<div class="col-2">
							<button class="btn bg-success text-white" id="btn-print">
								<i class="fa fa-print"></i><span class="ml-1">Cetak</span>
							</button>
						</div>
					</div>
					<hr>
					<br>
					<div id="print-preview" class="p-4">
						<div style="display: flex; justify-content: center; align-items: center;">
							<div style="width: 21cm; height: 30cm; padding: 1cm" class="border my-shadow">
								<table id="table-header-print"
									   style="width: 100%; border: 0;">
									<tr>
										<td style="width:15%;">
											<img id="prev-logo-kanan-print" src="<?= base_url().$kop->logo_kiri ?>" style="width:85px; height:85px; margin: 6px;">
										</td>
										<td style="width:70%; text-align: center;">
											<div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 14pt"><?= $kop->header_1 ?></div>
											<div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"><b><?= $kop->header_2 ?></b></div>
											<div style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 13pt"><?= $kop->header_3 ?></div>
											<div style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 12pt"><?= $kop->header_4 ?></div>
										</td>
										<td style="width:15%;">
											<img id="prev-logo-kiri-print" src="<?= base_url().$kop->logo_kanan ?>"
												 style="width:85px; height:85px; margin: 6px; border-style: none">
										</td>
									</tr>
								</table>
								<hr style="border: 1px solid; margin-bottom: 6px">
								<br>
								<br>
								<div style="text-align: justify; font-family: 'Times New Roman'">
									Pada hari ini <span class="editable bg-lime" id="edit-hari" style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('D'))?></span>
									tanggal <span class="editable bg-lime" id="edit-tanggal" style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('d'))?></span>
									bulan <span class="editable bg-lime" id="edit-bulan" style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('M'))?></span>
									tahun <span class="editable bg-lime" id="edit-tahun" style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('Y'))?></span>
									telah diselenggarakan <span class="editable bg-lime" id="edit-jenis-ujian" style="display: inline-block;min-width: 20px">............................................</span>
									untuk Mata Pelajaran <span class="editable bg-lime" id="edit-mapel" style="display: inline-block;min-width: 20px">.....................................</span>
									dari pukul <span class="editable bg-lime" id="edit-waktu-mulai" style="display: inline-block;min-width: 20px">.............</span>
									sampai dengan pukul <span class="editable bg-lime" id="edit-waktu-akhir" style="display: inline-block;min-width: 20px">...........</span>
								</div>
								<br>
								<table style="width: 100%;font-family: 'Times New Roman';">
									<tr>
										<td style="width: 30px;">1. </td>
										<td style="width: 30%;">
											Pada Sekolah/Madrasah
										</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-nama_sekolah"><?= $kop->sekolah ?></td>
									</tr>
									<tr>
										<td></td>
										<td id="title-ruang">
											Ruang
										</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-ruang">.................................................................</td>
									</tr>
									<tr>
										<td></td>
										<td>Sesi</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-sesi">.................................................................</td>
									</tr>
									<tr>
										<td></td>
										<td>
											Jumlah Peserta Seharusnya
										</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-jml-peserta">.................................................................</td>
									</tr>
									<tr>
										<td></td>
										<td>
											Jumlah Peserta Hadir
										</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-hadir">.................................................................</td>
									</tr>
									<tr>
										<td></td>
										<td>
											Jumlah Peserta Tidak Hadir
										</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-tidak-hadir">.................................................................</td>
									</tr>
									<tr>
										<td></td>
										<td>
											Nomor Peserta Tidak Hadir
										</td>
										<td>:</td>
										<td class="editable bg-lime" id="edit-username">.................................................................</td>
									</tr>
									<tr>
										<td style="padding-top: 12px">2.</td>
										<td style="padding-top: 12px" colspan="3">
											Catatan selama <span class="editable bg-lime" id="edit-nama-ujian" style="display: inline-block;min-width: 20px">.......</span> berlangsung :
										</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="3" style="height: 100px; border: 1px solid black; padding: 12px" class="editable bg-lime" id="edit-catatan"></td>
									</tr>
								</table>
								<br>
								<br>
								<br>
								<br>
								<table style="width:90%; font-family: 'Times New Roman';">
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th style="text-align: center">TTD</th>
									</tr>
									<tr>
										<td style="width: 30px;">1.</td>
										<td>Proktor</td>
										<td>:</td>
										<td class="editable bg-lime"><?= $kop->proktor ?></td>
										<td style="padding-left: 20px" rowspan="2">1. _________________________</td>
									</tr>
									<tr>
										<td></td>
										<td>
											NIP
										</td>
										<td>:</td>
										<td class="editable bg-lime">_________________________</td>
									</tr>
									<tr>
										<td style="padding-top: 12px">2.</td>
										<td style="padding-top: 12px">
											Pengawas
										</td>
										<td style="padding-top: 12px">:</td>
										<td style="padding-top: 12px" class="editable bg-lime" id="edit-pengawas"></td>
										<td style="padding-left: 20px" rowspan="2">2. _________________________</td>
									</tr>
									<tr>
										<td></td>
										<td>
											NIP
										</td>
										<td>:</td>
										<td class="editable bg-lime">_________________________</td>
									</tr>
									<tr>
										<td style="padding-top: 12px">3.</td>
										<td style="padding-top: 12px">
											Kepala Sekolah
										</td>
										<td style="padding-top: 12px">:</td>
										<td style="padding-top: 12px" class="editable bg-lime"><?= $kop->kepsek ?></td>
										<td style="padding-left: 20px" rowspan="2">3. _________________________</td>
									</tr>
									<tr>
										<td></td>
										<td>
											NIP
										</td>
										<td>:</td>
										<td class="editable bg-lime">_________________________</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="overlay d-none" id="loading">
					<div class="spinner-grow"></div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="<?= base_url() ?>/assets/app/js/print-area.js"></script>
<script>
	var oldVal1 = '<?=$kop->header_1?>';
	var oldVal2 = '<?=$kop->header_2?>';
	var oldVal3 = '<?=$kop->header_3?>';
	var oldVal4 = '<?=$kop->header_4?>';

	var kepsek = '<?=$kop->kepsek?>';
	var logoKanan = '<?=base_url().$kop->logo_kanan?>';
	var logoKiri = '<?=base_url().$kop->logo_kiri?>';
	var tandatangan = '<?=base_url().$kop->tanda_tangan?>';

	var printBy = 1;
	var infoData = {};
	var infoSiswa = [];
	var allInfo = '';
	var oldInfo = '';

	var hari = ['Minngu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
	var bulan = ['Jan', 'Feb', 'Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];

	var d = new Date();
	var curr_day = d.getDay();
	var curr_date = d.getDate();

	var curr_month = d.getMonth();
	var curr_year = d.getFullYear();

	function buatTanggal() {
		return  hari[curr_day] + ", " + curr_date + "  " + bulan[curr_month] + " " + curr_year;
	}

	function submitKop() {
		$('#set-kop').submit();
	}

	$(document).ready(function () {
		ajaxcsrf();
		var opsiJadwal = $("#jadwal");
		var opsiRuang = $("#ruang");
		var opsiSesi = $("#sesi");
		var opsiKelas = $("#kelas");

		$('.editable').attr('contentEditable',true);

		function loadSiswaRuang(ruang, sesi, jadwal) {
		    var notempty = ruang && sesi && jadwal;
		    if (notempty) {
                $.ajax({
                    type: "GET",
                    url: base_url + "cbtcetak/getsiswaruang?ruang=" + ruang + '&sesi=' +sesi + '&jadwal=' + jadwal,
                    success: function (response) {
                        console.log('respon', response);
                        $('#edit-jml-peserta').html('<b>'+response.siswa.length+'</b>');

                        $('#edit-jenis-ujian').html('<b>'+response.info.jadwal.nama_jenis+'</b>');
                        $('#edit-nama-ujian').html('<b>'+response.info.jadwal.nama_jenis+'<b>');
                        $('#edit-waktu-mulai').html('<b>'+response.info.sesi.waktu_mulai.substring(0, 5)+'</b>');
                        $('#edit-waktu-akhir').html('<b>'+response.info.sesi.waktu_akhir.substring(0, 5)+'</b>');
                        $('#edit-mapel').html('<b>'+response.info.jadwal.nama_mapel+'</b>');
                        $('#edit-pengawas').text(response.info.pengawas[0].nama_guru);
                    }
                });
            }
		}

		function loadSiswaKelas(kelas, sesi, jadwal) {
            var notempty = kelas && sesi && jadwal;
            if (notempty) {
                $.ajax({
                    type: "GET",
                    url: base_url + "cbtcetak/getsiswakelas?kelas=" + kelas + '&sesi=' + sesi + '&jadwal=' + jadwal,
                    success: function (response) {
                        console.log('respon', response);
                        $('#edit-jml-peserta').html('<b>' + response.siswa.length + '</b>');

                        $('#edit-jenis-ujian').html('<b>' + response.info.jadwal.nama_jenis + '</b>');
                        $('#edit-nama-ujian').text(response.info.jadwal.nama_jenis);
                        $('#edit-waktu-mulai').html('<b>' + response.info.sesi.waktu_mulai.substring(0, 5) + '</b>');
                        $('#edit-waktu-akhir').html('<b>' + response.info.sesi.waktu_akhir.substring(0, 5) + '</b>');
                        $('#edit-mapel').html('<b>' + response.info.jadwal.nama_mapel + '</b>');
                        $('#edit-pengawas').text(+response.info.pengawas[0].nama_guru);
                    }
                });
            }
		}

		opsiJadwal.prepend("<option value='' selected='selected'>Pilih Jadwal</option>");
		opsiRuang.prepend("<option value='' selected='selected'>Pilih Ruang</option>");
		opsiSesi.prepend("<option value='' selected='selected'>Pilih Sesi</option>");
		opsiKelas.prepend("<option value='' selected='selected'>Pilih Kelas</option>");


		opsiKelas.change(function () {
			$('#edit-ruang').text($("#kelas option:selected").text());
			loadSiswaKelas($(this).val(), opsiSesi.val(), opsiJadwal.val())
		});

		opsiRuang.change(function () {
			$('#edit-ruang').text($("#ruang option:selected").text());
			loadSiswaRuang($(this).val(), opsiSesi.val(), opsiJadwal.val())
		});

		opsiSesi.change(function () {
			$('#edit-sesi').text($("#sesi option:selected").text());
			if (printBy === 1) {
				loadSiswaRuang(opsiRuang.val(), $(this).val(), opsiJadwal.val())
			} else {
				loadSiswaKelas(opsiKelas.val(), $(this).val(), opsiJadwal.val())
			}
		});

		opsiJadwal.change(function () {
			if (printBy === 1) {
				loadSiswaRuang(opsiRuang.val(), opsiSesi.val(), $(this).val())
			} else {
				loadSiswaKelas(opsiKelas.val(), opsiSesi.val(), $(this).val())
			}
		});

		$("#btn-print").click(function () {
			var kosong = printBy===2 ? ($('#kelas').val() === '' || ($('#sesi').val() === '') || ($('#jadwal').val() === '')) : ($('#ruang').val() === '' || ($('#sesi').val() === '') || ($('#jadwal').val() === ''));
			if (kosong) {
				Swal.fire({
					title: "ERROR",
					text: "Isi semua pilihan terlebih dulu",
					icon: "error"
				})
			} else {
                $('#print-preview').print();
			    /*
				var header = '<style>' +
					'@media print {' +
					'    body{' +
					'        width: 21cm;' +
					'        height: 29.7cm;' +
					'        margin: auto;' +
					'   }' +
					'}' +
					//'* { margin:auto; padding:0; line-height:100%; }' +
					'</style>' +
					'</head>' +
					'<body onload="window.print()">';
				var divToPrint = document.getElementById('print-preview');
				var newWin = window.open('', 'Print-Window');
				newWin.document.open();
				newWin.document.write(header + divToPrint.innerHTML + '</body>');
				newWin.document.close();

				//setTimeout(function(){newWin.close();
				//},10);
				*/
			}
		});

		$("#header-1").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal1) {
				return;
			}
			oldVal1 = currentVal;
		});

		$("#header-2").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal2) {
				return;
			}
			oldVal2 = currentVal;
		});

		$("#header-3").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal3) {
				return;
			}
			oldVal3 = currentVal;
		});

		$("#header-4").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal4) {
				return;
			}
			oldVal4 = currentVal;
		});

		$('#set-kop').on('submit', function (e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			$.ajax({
				url: base_url + 'cbtcetak/savekopberita',
				type: 'POST',
				data: $(this).serialize(),
				success: function (response) {
					console.log(response);
					//history.back();
					window.location.href = base_url + 'cbtcetak/beritaacara'
				},
				error: function (xhr, error, status) {
					console.log(xhr.responseText);
				}
			});
		});

		$('#selector button').click(function () {
			$(this).addClass('active').siblings().addClass('btn-outline-primary').removeClass('active btn-primary');

			if (!$('#by-kelas').is(':hidden')) {
				$('#by-kelas').addClass('d-none');
				$('#by-ruang').removeClass('d-none');
				printBy = 1;
				$('#title-ruang').text('Ruang');
			} else {
				$('#by-kelas').removeClass('d-none');
				$('#by-ruang').addClass('d-none');
				$('#title-ruang').text('Kelas');
				printBy = 2;
			}
		});

	})
</script>
