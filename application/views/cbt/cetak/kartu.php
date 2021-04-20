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
			<div class="row">
				<div class="col-md-5">
					<div class="card my-shadow card-primary card-outline">
						<div class="card-header">
							<h6 class="card-title">Setting Kartu</h6>
							<button class="card-tools btn btn-sm bg-primary text-white" onclick="submitKartu()">
								<i class="fas fa-save mr-1"></i> Simpan
							</button>
						</div>
						<div class="card-body">
							<?= form_open('', array('id' => 'set-kartu')) ?>
							<div class="form-group">
								<label>Header 1</label>
								<textarea id="header-1" class="form-control" name="header_1" rows="2"
										  placeholder="Header baris 1" required><?= $kartu->header_1 ?></textarea>
							</div>
							<div class="form-group">
								<label>Header 2</label>
								<textarea id="header-2" class="form-control" name="header_2" rows="2"
										  placeholder="Header baris 2" required><?= $kartu->header_2 ?></textarea>
							</div>
							<div class="form-group">
								<label>Header 3</label>
								<textarea id="header-3" class="form-control" name="header_3" rows="2"
										  placeholder="Header baris 3" required><?= $kartu->header_3 ?></textarea>
							</div>
							<div class="form-group">
								<label>Header 4</label>
								<textarea id="header-4" class="form-control" name="header_4" rows="2"
										  placeholder="Header baris 4" required><?= $kartu->header_4 ?></textarea>
							</div>
							<div class="form-group">
								<label>Tanggal</label>
								<input id="input-tanggal" class="form-control" name="tanggal" placeholder="Titimangsa"
									   value="<?= $kartu->tanggal ?>" required>
							</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="card my-shadow">
						<div class="card-header">
							<div class="card-title">
								Preview
							</div>
							<!--
							<div class="card-tools mr-2 mt-1">
								<button class="btn btn-sm bg-blue text-white">
									<i class="fa fa-file-word-o"></i><span class="ml-1">Word</span>
								</button>
								<button class="btn btn-sm bg-red text-white">
									<i class="fa fa-file-pdf-o"></i><span class="ml-1">Pdf</span>
								</button>
								<button class="btn btn-sm bg-success text-white">
									<i class="fa fa-print"></i><span class="ml-1">Cetak</span>
								</button>
							</div>
							-->
						</div>
						<div class="card-body pb-4">
							<div style="display: flex; justify-content: center; align-items: center;">
								<div style="width: 10cm">
									<table id="table-header"
										   style="width: 100%; border-top: 1px solid black; border-bottom: 0;border-left: 1px solid black; border-right: 1px solid black">
										<tr>
											<td style="width:20%;">
												<img id="prev-logo-kiri" src="<?= base_url().$setting->logo_kiri ?>"
													 style="width:55px; height:55px; margin: 6px;">
											</td>
											<td style="width:60%;">
												<div id="prev-header-1" class="text-center"
													 style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 9pt"><?= $kartu->header_1 ?></div>
												<div id="prev-header-2" class="text-center"
													 style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 10pt">
													<b><?= $kartu->header_2 ?></b></div>
												<div id="prev-header-3" class="text-center"
													 style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 8pt"><?= $kartu->header_3 ?></div>
												<div id="prev-header-4" class="text-center"
													 style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 8pt"><?= $kartu->header_4 ?></div>
											</td>
											<td style="width:20%;">
												<img id="prev-logo-kanan" src="<?= base_url().$setting->logo_kanan ?>"
													 style="width:55px; height:55px; margin: 6px; border-style: none">
											</td>
										</tr>
									</table>
									<table id="table-body" style="width:100%;border: 1px solid black">
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-top:8px;padding-left:22px;width: 35%">Nomor Peserta</td>
											<td style="padding-top:8px;">:</td>
											<td style="padding-top:8px;width: 60%">0000.00.000</td>
										</tr>
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-left:22px">Nama</td>
											<td>:</td>
											<td>Nama Siswa</td>
										</tr>
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-left:22px;width: 35%">NIS/NISN</td>
											<td>:</td>
											<td>012334455</td>
										</tr>
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-left:22px;width: 35%">Kelas</td>
											<td>:</td>
											<td>IXA</td>
										</tr>
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-left:22px;width: 35%">Ruang/Sesi</td>
											<td>:</td>
											<td>1/2</td>
										</tr>
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-left:22px;width: 35%">Username</td>
											<td>:</td>
											<td>umbk001</td>
										</tr>
										<tr style="line-height: 1; font-family: 'Times New Roman'; font-size: 9pt">
											<td style="padding-left:22px;width: 35%">Password</td>
											<td>:</td>
											<td>umbk001</td>
										</tr>
										<tr>
											<td colspan="2"
												style="padding-top: 6px; padding-bottom: 6px; padding-left:22px;width: 35%">
												<div
													style="width: 60px; height: 70px; background: url('<?= base_url('assets/img/siswa.png') ?>') no-repeat center; background-size: cover; outline: 1px solid;"></div>
											</td>
											<td style="text-align: center;">
												<div id="prev-tandatangan" style="font-family: 'Times New Roman'; font-size: 9pt; line-height: 1; background: url('<?= base_url().$setting->tanda_tangan ?>') no-repeat center; background-size: 100px 60px">
													<span id="prev-kota"><?= $setting->kota ?></span>, <span
														id="prev-tanggal"><?= $kartu->tanggal ?></span>
													<br>
                                                    Kepala Madrasah
													<br>
                                                    <br>
													<br>
													<br>
													<span id="prev-kepsek"><?= $setting->kepsek ?></span>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<br>
						</div>
					</div>
					<div class="card my-shadow">
						<div class="card-header">
							<div class="card-title">
								Cetak
							</div>
                            <!--
							<div id="selector" class="card-tools btn-group">
								<button type="button" class="btn active btn-primary">By Kelas</button>
								<button type="button" class="btn btn-outline-primary">By Ruang</button>
							</div>
							-->
						</div>
						<div class="card-body pb-4">
							<div class="row">
								<div class="col-8">
									<div class="input-group">
										<?php
										echo form_dropdown(
											'kelas',
											$kelas,
											null,
											'id="kelas" class="form-control"'
										); ?>
									</div>
									<div class="input-group">
										<?php
										echo form_dropdown(
											'ruang',
											$ruang,
											null,
											'id="ruang" class="form-control d-none"'
										); ?>
									</div>
								</div>
								<div class="col-4">
									<!--
									<button class="btn bg-blue text-white">
										<i class="fa fa-file-word-o"></i><span class="ml-1">Word</span>
									</button>
									<button class="btn bg-red text-white" id="btn-pdf">
										<i class="fa fa-file-pdf-o"></i><span class="ml-1">Pdf</span>
									</button>
									-->
									<button class="btn bg-success text-white" id="btn-print">
										<i class="fa fa-print"></i><span class="ml-1">Cetak</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-shadow">
                        <div class="card-header">
                            <div class="card-title">
                                Preview
                            </div>
                        </div>
                        <div class="card-body pb-4">
                            <div class="d-flex justify-content-center bg-gray-light" style="min-height: 300mm">
                                <div id="print-preview" class="m-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</section>
</div>
<!--
<script src="<?= base_url() ?>/assets/app/js/pdfobject.js"></script>
<script>PDFObject.embed("/pdf/sample-3pp.pdf", "#example1");</script>
-->
<script src="<?= base_url() ?>/assets/app/js/print-area.js"></script>
<script>
	var oldVal1 = '<?=$kartu->header_1?>';
	var oldVal2 = '<?=$kartu->header_2?>';
	var oldVal3 = '<?=$kartu->header_3?>';
	var oldVal4 = '<?=$kartu->header_4?>';
    var oldTgl = '<?=$kartu->tanggal?>';
	var oldKota = '<?=$setting->kota?>';
	var logoKanan = '<?=base_url().$setting->logo_kanan?>';
	var logoKiri = '<?=base_url().$setting->logo_kiri?>';
	var tandatangan = '<?=base_url().$setting->tanda_tangan?>';
	var kepsek = '<?= $setting->kepsek ?>';
	var printBy = 1;

	function submitKartu() {
		$('#set-kartu').submit();
	}

	function createPrintPreview(data) {
		console.log(data);
        var bagi2 = Math.round(data.length / 2);
        var pages = Math.round(bagi2 / 4);
        //console.log('data', data.length);
        //console.log('pages', pages);
        var konten = '';
        for (let a = 0; a < pages; a++) {
            var card = '<div class="border my-shadow mb-3 pt-4 bg-white"><div class="pt-4" ' +
                'style="display: flex;-webkit-justify-content: center;justify-content: center;background: white;width: 210mm; height: 297mm;padding: 1mm">';

            var tds = [];
            var kelas = printBy === 1 ? 'Kelas/Sesi' : 'Ruang/Sesi';

            let t = a*8;
            let end = (a+1)<pages ? t+8 : data.length;
            //console.log('t', t);
            //console.log('end', end);

            for (let i = t; i < end; i++) {
                var setSiswa = data[i].set_siswa === '1';
                var ruang = setSiswa ? data[i].ruang_kelas : data[i].kode_ruang;
                var sesi = setSiswa ? data[i].sesi_kelas : data[i].kode_sesi;
                //var kelasVal = printBy === 1 ? data[i].nama_kelas : ruang;

                //var foto = data[i].foto == null || data[i].foto === '' ? 'siswa.png' : data[i].foto;
                //var foto = getFoto(data[i].foto);
                var td = '<div style="display: flex; justify-content: center; align-items: center;">' +
                    '<div style="width: 10cm">' +
                    '<table id="table-header-print" style="width: 100%; border-top: 1px solid black; border-bottom: 0;border-left: 1px solid black; border-right: 1px solid black">' +
                    '<tr>' +
                    '<td style="width:20%;">' +
                    '<img id="prev-logo-kiri-print" src="' + logoKiri + '" style="width:55px; height:55px; margin-left: 6px; margin-right: 6px; margin-top:4px;">' +
                    '</td>' +
                    '<td style="width:60%; text-align: center;">' +
                    '<div style="line-height: 1.1; font-family: \'Times New Roman\'; font-size: 9pt">' + oldVal1 + '</div>' +
                    '<div class="text-center" style="line-height: 1.1; font-family: \'Times New Roman\'; font-size: 10pt"><b>' + oldVal2 + '</b></div>' +
                    '<div class="text-center" style="line-height: 1.2; font-family: \'Times New Roman\'; font-size: 8pt">' + oldVal3 + '</div>' +
                    '<div class="text-center" style="line-height: 1.2; font-family: \'Times New Roman\'; font-size: 8pt">' + oldVal4 + '</div>' +
                    '</td>' +
                    '<td style="width:20%;">' +
                    '<img id="prev-logo-kanan-print" src="' + logoKanan + '" style="width:55px; height:55px; margin-left: 6px; margin-right: 6px; margin-top:4px; border-style: none">' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '<table id="table-body-print" style="width:100%;border: 1px solid black">' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 10pt">' +
                    '<td style="padding-top:4px;padding-left:22px;width: 30%">No. Peserta</td>' +
                    '<td style="padding-top:4px;">:</td>' +
                    '<td style="padding-top:4px;width: 65%">' + data[i].nomor_peserta + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 9pt">' +
                    '<td style="padding-left:22px;width: 30%">Nama</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].nama + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 9pt">' +
                    '<td style="padding-left:22px;width: 30%">NIS / NISN</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].nis + '/' + data[i].nisn + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 9pt">' +
                    '<td style="padding-left:22px;width: 30%">Kelas</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].nama_kelas + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 9pt">' +
                    '<td style="padding-left:22px;width: 30%">Ruang/Sesi</td>' +
                    '<td>:</td>' +
                    '<td>' + ruang + '/' + sesi + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 9pt">' +
                    '<td style="padding-left:22px;width: 30%">Username</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].username + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 9pt">' +
                    '<td style="padding-left:22px;width: 30%">Password</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].password + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td colspan="2" style="padding-top: 6px; padding-bottom: 6px; padding-left:22px;width: 35%">' +
                    '<img class="avatar" style="width: 60px; height: 70px; object-fit: cover;object-position: center; ' +
                    'outline: 1px solid;" ' +
                    'src= "' + base_url + data[i].foto + '"' +
                    '/>' +
                    '</td>' +
                    '<td style="text-align: center;">' +
                    '<div id="prev-tandatangan-print" style="font-family: \'Times New Roman\'; font-size: 9pt; line-height: 1; background: url('+tandatangan+') no-repeat center; background-size: 100px 60px">' +
                    '<span>' + oldKota + '</span>, <span>' + oldTgl + '</span>' +
                    '<br>Kepala Madrasah' +
                    '<br>' +
                    '<br>' +
                    '<br>' +
                    '<br>' +
                    '<span>' + kepsek + '</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '</div>' +
                    '</div>';

                tds.push(td);
            }
            var table = '<table>';
            for (let j = 0; j < tds.length; j++) {
                if ((j + 1) % 2 === 0) {
                    table += '<td style="padding: 5px;">' + tds[j] + '</td></tr>';
                } else {
                    table += '<tr><td style="padding: 5px;">' + tds[j] + '</td>';
                }
            }
            table += '</table>';
            card += table + '</div></div>';
            konten += card + '<div style="page-break-after: always"></div>';
        }

		$("#print-preview").html(konten);

        $(`.avatar`).each(function () {
            $(this).on("error", function () {
                $(this).attr("src", base_url + 'assets/img/siswa.png');
            });
        });

    }

	$(document).ready(function () {
		ajaxcsrf();

		var drEvent = $('.dropify').dropify({
			messages: {
				'default': 'Seret logo kesini atau klik',
				'replace': 'Seret atau klik<br>untuk mengganti logo',
				'remove': 'Hapus',
				'error': 'Ooops, ada kesalahan!!.'
			},
			error: {
				'fileSize': 'The file size is too big ({{ value }} max).',
				'minWidth': 'The image width is too small ({{ value }}}px min).',
				'maxWidth': 'The image width is too big ({{ value }}}px max).',
				'minHeight': 'The image height is too small ({{ value }}}px min).',
				'maxHeight': 'The image height is too big ({{ value }}px max).',
				'imageFormat': 'The image format is not allowed ({{ value }} only).'
			}
		});


		drEvent.on('dropify.beforeClear', function (event, element) {
			//return confirm("Hapus logo \"" + element.file.name + "\" ?");
		});

		drEvent.on('dropify.afterClear', function (event, element) {
			//console.log(element.element.id);
			if (element.element.id === 'logo-kanan') {
				logoKanan = '';
				$('#prev-logo-kanan').attr('src', '');
			} else if (element.element.id === 'logo-kiri') {
				logoKiri = '';
				$('#prev-logo-kiri').attr('src', '');
				/*
			} else if (element.element.id === 'tanda-tangan') {
				tandatangan = '';
				$('#prev-tandatangan').css(
					{'background': 'url() no-repeat center'},
					{'font-family': 'Times New Roman'},
					{'font-size': '10pt'},
					{'background-size': '100px 60px'}
				);
				*/
			}
		});

		drEvent.on('dropify.errors', function (event, element) {
			console.log('Has Errors');
			$.toast({
				heading: "Error",
				text: "file rusak",
				icon: 'warning',
				showHideTransition: 'fade',
				allowToastClose: true,
				hideAfter: 5000,
				position: 'top-right'
			});
		});

		$("#logo-kanan").change(function () {
			var input = $(this)[0];
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#prev-logo-kanan').attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);

				var form = new FormData($('#set-logo-kanan')[0]);
				uploadAttach(base_url + 'cbtcetak/uploadfile/logo_kanan', form);
			}
		});

		$("#logo-kiri").change(function () {
			var input = $(this)[0];
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#prev-logo-kiri').attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);

				var form = new FormData($('#set-logo-kiri')[0]);
				uploadAttach(base_url + 'cbtcetak/uploadfile/logo_kiri', form);
			}
		});

		$("#header-1").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal1) {
				return;
			}

			oldVal1 = currentVal;
			$('#prev-header-1').html(currentVal);
			//alert("changed!");
		});
		$("#header-2").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal2) {
				return;
			}

			oldVal2 = currentVal;
			$('#prev-header-2').text(currentVal);
			//alert("changed!");
		});
		$("#header-3").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal3) {
				return;
			}

			oldVal3 = currentVal;
			$('#prev-header-3').text(currentVal);
			//alert("changed!");
		});
		$("#header-4").on("change keyup paste", function () {
			var currentVal = $(this).val();
			if (currentVal === oldVal4) {
				return;
			}

			oldVal4 = currentVal;
			$('#prev-header-4').text(currentVal);
			//alert("changed!");
		});

		$('#input-tanggal').on('input', function (e) {
			var tgl = $(this).val();
			$('#prev-tanggal').text(tgl);
			oldTgl = tgl;
		});

		$('#set-kartu').on('submit', function (e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			$.ajax({
				url: base_url + 'cbtcetak/savekartu',
				type: 'POST',
				data: $(this).serialize() + '&logo_kanan=' + logoKanan + '&logo_kiri=' + logoKiri + '&tanda_tangan=' + tandatangan,
				success: function (response) {
					console.log(response);
					window.location.href = base_url + 'cbtcetak/kartupeserta';
				},
				error: function (xhr, error, status) {
					console.log(xhr.responseText);
				}
			});
		});

		function uploadAttach(action, data) {
			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: action,
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.src.includes('kanan')) {
						logoKanan = data.src;
						//console.log('kanan', data.src);
					} else if (data.src.includes('kiri')) {
						logoKiri = data.src;
						//console.log('kiri', data.src);
					} else if (data.src.includes('tanda')) {
						tandatangan = data.src;
						//console.log('tandatangan', data.src);
					}
				},
				error: function (e) {
					console.log("error", e.responseText);
					$.toast({
						heading: "ERROR!!",
						text: "file tidak terbaca",
						icon: 'error',
						showHideTransition: 'fade',
						allowToastClose: true,
						hideAfter: 5000,
						position: 'top-right'
					});
				}
			});
		}

		function deleteImage(src) {
			$.ajax({
				data: {src: src},
				type: "POST",
				url: base_url + "cbtcetak/deletefile",
				cache: false,
				success: function (response) {
					console.log(response);
				}
			});
		}

		function loadSiswaKelas(kelas) {
			$.ajax({
				type: "GET",
				url: base_url + "cbtcetak/getsiswakelas?kelas=" + kelas,
				success: function (response) {
					createPrintPreview(response.siswa);
				}
			});
		}

		function loadSiswaRuang(ruang) {
			$.ajax({
				type: "GET",
				url: base_url + "cbtcetak/getsiswaruang?ruang=" + ruang,
				success: function (response) {
					createPrintPreview(response.siswa);
				}
			});
		}

		//loadSiswaKelas($('#kelas').val());
		$("#kelas").prepend("<option value='' selected='selected'>Pilih Kelas</option>");
		$("#ruang").prepend("<option value='' selected='selected'>Pilih Ruang</option>");
		$("#kelas").change(function () {
			loadSiswaKelas($(this).val());
		});

		$("#ruang").change(function () {
			loadSiswaRuang($(this).val());
		});

		$("#btn-print").click(function () {
			if ($('#kelas').val() === '') {
				Swal.fire({
					title: "ERROR",
					text: "Pilih kelas dulu",
					icon: "error"
				})
			} else {
                $('#print-preview').print();
            }
		});

		$('#selector button').click(function () {
			$(this).addClass('active').siblings().addClass('btn-outline-primary').removeClass('active btn-primary');

			if (!$('#kelas').is(':hidden')) {
				$('#kelas').addClass('d-none');
				$('#ruang').removeClass('d-none');
				printBy = 2;
			} else {
				$('#kelas').removeClass('d-none');
				$('#ruang').addClass('d-none');
				printBy = 1;
			}
		});
	})

</script>
