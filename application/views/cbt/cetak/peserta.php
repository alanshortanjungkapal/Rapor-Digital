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
						<div class="col-6 col-md-3 d-none mb-4" id="by-kelas">
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
						<div class="col-6 col-md-3 mb-4" id="by-ruang">
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
						<div class="col-6 col-md-3">
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
						<div class="col-9 col-md-4 mb-4">
							<div class="input-group">
								<div class="input-group-prepend w-30">
									<span class="input-group-text">Jenis Ujian</span>
								</div>
								<?php
								echo form_dropdown(
									'jenis',
									$ujian,
									null,
									'id="jenis" class="form-control"'
								); ?>
							</div>
						</div>
						<div class="col-3 col-md-2">
							<button class="btn bg-success text-white" id="btn-print">
								<i class="fa fa-print"></i><span class="ml-1">Cetak</span>
							</button>
						</div>
					</div>
					<hr>
					<br>
                    <div class="d-flex justify-content-center bg-gray-light" style="min-height: 300mm">
                        <div id="print-preview" class="m-2">
                            <!--
                            <div class="bg-white" style="display: flex; justify-content: center; align-items: center;">
                                <div style="width: 21cm; min-height: 30cm;" class="border my-shadow p-5">
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <table id="table-header-print"
                                               style="width: 100%; border: 0;">
                                            <tr>
                                                <td style="width:15%;">
                                                    <img id="prev-logo-kanan-print" src="<?= base_url().$kop->logo_kiri ?>"
                                                         style="width:85px; height:85px; margin: 6px;">
                                                </td>
                                                <td style="width:70%; text-align: center;">
                                                    <div style="line-height: 1.1;font-size: 13pt"><?= $kop->sekolah ?></div>
                                                    <div style="line-height: 1.1;font-size: 16pt"><b>DAFTAR PESERTA</b>
                                                    </div>
                                                    <div style="line-height: 1.1;font-size: 14pt" id="jenis-ujian">Jenis
                                                        Ujian
                                                    </div>
                                                    <div style="line-height: 1.1;font-size: 12pt">Tahun
                                                        Pelajaran: <?= $tp_active->tahun ?>
                                                        Semester: <?= $smt_active->smt ?></div>
                                                </td>
                                                <td style="width:15%;">
                                                    <img id="prev-logo-kiri-print" src="<?= base_url().$kop->logo_kanan ?>"
                                                         style="width:85px; height:85px; margin: 6px; border-style: none">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <hr>
                                    <div id="daftar-siswa" style="display: flex; flex-wrap: wrap !important; -ms-flex-wrap: wrap !important; justify-content: center; align-items: center;">
                                    </div>
                                </div>
                            </div>
                            -->
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
    function createPreview(data) {
        console.log(data);
        var pages = Math.ceil(data.length / 10);
        var konten = '';

        for (let a = 0; a < pages; a++) {
            var card = '<div class="border my-shadow mb-3 p-4 bg-white"><div class="pt-4" ' +
                'style="-webkit-justify-content: center;justify-content: center;background: white;width: 210mm; height: 297mm;padding: 1mm">';

            var tds = [];
            //var kelas = printBy === 1 ? 'Kelas/Sesi' : 'Ruang/Sesi';

            let t = a*10;
            let end = (a+1)<pages ? t+10 : data.length;

            if (a === 0) {
                card += '<div style="display: flex; justify-content: center; align-items: center;">\n' +
                    '    <table id="table-header-print"\n' +
                    '           style="width: 100%; border: 0;">\n' +
                    '        <tr>\n' +
                    '            <td style="width:15%;">\n' +
                    '                <img id="prev-logo-kanan-print" src="<?= base_url() . $kop->logo_kiri ?>"\n' +
                    '                     style="width:85px; height:85px; margin: 6px;">\n' +
                    '            </td>\n' +
                    '            <td style="width:70%; text-align: center;">\n' +
                    '                <div style="line-height: 1.1;font-size: 13pt"><?= $kop->sekolah ?></div>\n' +
                    '                <div style="line-height: 1.1;font-size: 16pt"><b>DAFTAR PESERTA</b>\n' +
                    '                </div>\n' +
                    '                <div style="line-height: 1.1;font-size: 14pt" id="jenis-ujian">Jenis\n' +
                    '                    Ujian\n' +
                    '                </div>\n' +
                    '                <div style="line-height: 1.1;font-size: 12pt">Tahun\n' +
                    '                    Pelajaran: <?= $tp_active->tahun ?>\n' +
                    //'                    Semester: <?= $smt_active->smt ?></div>\n' +
                    '            </td>\n' +
                    '            <td style="width:15%;">\n' +
                    '                <img id="prev-logo-kiri-print" src="<?= base_url() . $kop->logo_kanan ?>"\n' +
                    '                     style="width:85px; height:85px; margin: 6px; border-style: none">\n' +
                    '            </td>\n' +
                    '        </tr>\n' +
                    '    </table>\n' +
                    '</div>\n' +
                    '<hr>\n'
            }

            for (let i = t; i < end; i++) {
                var td = '<div style="display: flex; justify-content: center; align-items: center;">' +
                    '<div style="width: 100mm; padding: 8px; outline: 1px solid;">' +
                    '<table id="table-body-print" style="width:100%; min-height: 40mm">' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td rowspan="7" style="width: 20%;vertical-align: top">' +
                    '<img class="avatar" style="margin-right:8px;width: 25mm; height: 30mm; object-fit: cover;object-position: center; ' +
                    'outline: 1px solid;" ' +
                    'src= "' + base_url + data[i].foto + '"' +
                    '/>' +
                    '</td>' +
                    '<td style="padding-top:4px;width: 25%">No. Peserta</td>' +
                    '<td style="padding-top:4px;">:</td>' +
                    '<td style="padding-top:4px;">' + data[i].nomor_peserta + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td>NISN</td>' +
                    '<td>:</td>' +
                    '<td>'+data[i].nisn + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td>NIS</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].nis + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td style="vertical-align: top">Nama</td>' +
                    '<td style="vertical-align: top">:</td>' +
                    '<td>' + data[i].nama.toUpperCase() + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td>Kelas</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].nama_kelas + '</td>' +
                    '</tr>' +
                    //'<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    //'<td>Ruang/Sesi</td>' +
                    //'<td>:</td>' +
                    //'<td>' + ruang + '/' + sesi + '</td>' +
                    //'</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td>Username</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].username + '</td>' +
                    '</tr>' +
                    '<tr style="line-height: 1; font-family: \'Times New Roman\'; font-size: 12pt">' +
                    '<td>Password</td>' +
                    '<td>:</td>' +
                    '<td>' + data[i].password + '</td>' +
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

        /*
        var tds = [];
		for (let i = 0; i < data.length; i++) {
			var td = '<div style="outline: 1px solid; padding: 10px; margin: 10px">' +
                '<div style="display: block;width: 3cm;"> '+
                '<img class="avatar" style="width: 3cm; height: 3.38cm; object-fit: cover;object-position: center;" ' +
                'src= "' + base_url + data[i].foto + '"' +
                '/>' +
                '</div>' +
				'<div>' + data[i].nomor_peserta +
				'</div>' +
				'<div>' + data[i].nama +
				'</div></div>';

			tds.push(td);
		}

		var divs = '';
		for (let j = 0; j < tds.length; j++) {
			divs += '<div style="text-align: left; width: 8.5cm">' + tds[j] + '</div>';
		}
		$("#daftar-siswa").html(divs);
		*/
        $("#print-preview").html(konten);

        $(`.avatar`).each(function () {
            $(this).on("error", function () {
                $(this).attr("src", base_url + 'assets/img/siswa.png');
            });
        });

        $('#loading').addClass('d-none');
    }

	$(document).ready(function () {
		ajaxcsrf();
		var opsiRuang = $("#ruang");
		var opsiKelas = $("#kelas");
		var opsiSesi = $("#sesi");
		var opsiJenis = $("#jenis");

		function loadSiswaRuang(ruang, sesi) {
			var notempty = ruang != '' && sesi !='';
			console.log('empty', notempty);
			if (notempty) {
				$('#loading').removeClass('d-none');
				setTimeout(function () {
					$.ajax({
						type: "GET",
						url: base_url + "cbtcetak/getsiswaruang?ruang=" + ruang + '&sesi=' + sesi + '&jadwal=null',
						success: function (response) {
							createPreview(response.siswa)
						}
					});
				}, 500);
			}
		}

		function loadSiswaKelas(kelas, sesi) {
			var notempty = kelas && sesi;
			console.log('empty', notempty);
			if (notempty) {
				$('#loading').removeClass('d-none');
				setTimeout(function () {
					$.ajax({
						type: "GET",
						url: base_url + "cbtcetak/getsiswakelas?kelas=" + kelas + '&sesi=' + sesi + '&jadwal=null',
						success: function (response) {
							createPreview(response.siswa)
						}
					});
				}, 500);
			}
		}

		opsiRuang.prepend("<option value='' selected='selected'>Pilih Ruang</option>");
		opsiKelas.prepend("<option value='' selected='selected'>Pilih Kelas</option>");
		opsiSesi.prepend("<option value='' selected='selected'>Pilih Sesi</option>");
		opsiJenis.prepend("<option value='' selected='selected'>Pilih Jenis Ujian</option>");

		opsiKelas.change(function () {
			loadSiswaKelas($(this).val(), opsiSesi.val())
		});

		opsiRuang.change(function () {
			loadSiswaRuang($(this).val(), opsiSesi.val())
		});

		opsiSesi.change(function () {
            loadSiswaRuang(opsiRuang.val(), $(this).val())
		});

		opsiJenis.change(function () {
			$('#jenis-ujian').text($("#jenis option:selected").text().toUpperCase());
		});

		$("#btn-print").click(function () {
			var kosong = opsiRuang.val() === '';
			if (kosong || opsiJenis.val() === '' || opsiSesi === '') {
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
					'        min-height: 29.7cm;' +
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

		$('#selector button').click(function () {
			$(this).addClass('active').siblings().addClass('btn-outline-primary').removeClass('active btn-primary');

			if (!$('#by-kelas').is(':hidden')) {
				$('#by-kelas').addClass('d-none');
				$('#by-ruang').removeClass('d-none');
				printBy = 1;
			} else {
				$('#by-kelas').removeClass('d-none');
				$('#by-ruang').addClass('d-none');
				printBy = 2;
			}
		});

	})
</script>
