<div class="content-wrapper bg-white pt-4">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $judul . $kelas['nama_kelas']?></h1>
                </div>
                <div class="col-6">
                    <button onclick="window.history.back();" type="button" class="btn btn-sm btn-danger float-right">
                        <i class="fas fa-arrow-circle-left"></i><span class="d-none d-sm-inline-block ml-1">Kembali</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card my-shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h6><b><?=$mapel['nama_mapel']?></b></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="<?=base_url('rapor/downloadtemplatepas/'.$mapel['id_mapel'].'/'.$kelas['id_kelas'])?>" id="download" type="button" class="btn btn-primary w-100">
                                <i class="fa fa-download"></i> <span class="ml-1">Download Template</span>
                            </a>
                        </div>

                        <div class="col-md-8">
                            <?= form_open_multipart('', array('id'=>'uploadpas')); ?>
                            <div class="row">
                                <div class="col-8">
                                    <div class="custom-file">
                                        <input type="file" name="upload_file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih file excel</label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <button id="upload" type="submit" class="btn btn-success w-100">
                                        <i class="fa fa-upload"></i> <span class="ml-1">Upload</span>
                                    </button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                    <hr>
                    <?php
                    if ($kkm_guru==null && $kkm_setting==null) :?>
                        <div class="alert alert-default-warning shadow align-content-center" role="alert">
                            KKM dan Bobot belum diatur
                        </div>
                    <?php endif; ?>
                    <div id="t-siswa" class="w-100"></div>
                    <?= form_open('', array('id' => 'uploadnilai')) ?>
                    <button type="submit" class="btn btn-primary float-right mt-3 mb-3">
                        <i class="fa fa-save mr-1"></i>Simpan
                    </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?=base_url()?>/assets/plugins/jexcel/js/jexcel.js"></script>
<script type="text/javascript" src="<?=base_url()?>/assets/plugins/jexcel/js/jsuites.js"></script>
<script>
    var arrSiswa = JSON.parse(JSON.stringify(<?= json_encode($siswa)?>));
    var arrNilai = JSON.parse(JSON.stringify(<?= json_encode($nilai)?>));
    var kkmGuru = JSON.parse(JSON.stringify(<?= json_encode($kkm_guru)?>));
    var kkmSetting = JSON.parse(JSON.stringify(<?= json_encode($kkm_setting)?>));
    var idMapel = '<?=$mapel['id_mapel']?>';
    var idKelas = '<?=$kelas['id_kelas']?>';

    var isi;
    var bobotPH, bobotPTS, bobotPAS;
    if (kkmSetting.kkm_tunggal == '1') {
        isi = parseInt(kkmSetting.kkm);
        bobotPH = parseInt(kkmSetting.bobot_ph);
        bobotPTS = parseInt(kkmSetting.bobot_pts);
        bobotPAS = parseInt(kkmSetting.bobot_pas);
    } else {
        isi = parseInt(kkmGuru.kkm);
        bobotPH = parseInt(kkmSetting.bobot_ph);
        bobotPTS = parseInt(kkmSetting.bobot_pts);
        bobotPAS = parseInt(kkmSetting.bobot_pas);
    }
    var pre_d = 0;
    var pre_dsd = isi - 1;
    var pre_c = isi;
    var pre_csd = Math.floor(isi + (100 - isi) / 3);
    var pre_b = pre_csd + 1;
    var pre_bsd = Math.floor(pre_b + (100 - pre_b) / 2);
    var pre_a = pre_bsd + 1;
    var pre_asd = 100;

    var arrIndic = ["P1","P2","P3","P4","P5","P6","P7","P8"];
    var cols = [];

    $(function () {
        bsCustomFileInput.init();
    });

    $(document).ready(function() {
        //console.log('a' + pre_a + ' b' + pre_b + ' bd' + pre_bsd + ' c' + pre_c + ' cd' + pre_csd + ' dd' + pre_dsd);
        var dataSiswa = [];
        var row = 1;
        $.each(arrSiswa, function (i, v) {
            var nilai = arrNilai[v.id_siswa];
            dataSiswa.push(
                [
                    v.nisn, v.nama, nilai.nhar, nilai.npts, nilai.npas,
                    '=IFERROR(ROUND((((C'+row+'*'+bobotPH+')/100)+((D'+row+'*'+bobotPTS+')/100)+((E'+row+'*'+bobotPAS+')/100)),0),"")',
                    '=IF(F'+row+'>'+pre_bsd+',"A",IF(F'+row+'>'+pre_csd+',"B",IF(F'+row+'>'+pre_dsd+',"C",IF(F'+row+'<'+pre_c+',"D",""))))',
                    nilai.p_deskripsi, nilai.k_rata_rata, nilai.k_predikat, nilai.k_deskripsi, v.id_siswa
                ]
            );
            row++;
        });

        var tableSiswa = $('#t-siswa');

        var arrCol = [];

        var pno = 1;
        var kno = 1;
        var char= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for (let i = 0; i < 12; i++) {
            var item = {};

            if (i === 0) {
                item['title'] = 'N I S N\n'+char.charAt(i);
                item['width'] = 100;
            } else if (i === 1) {
                item['title'] = 'NAMA SISWA\n'+char.charAt(i);
                item['width'] = 250;
            } else if (i === 2) {
                item['title'] = 'RPH\n'+char.charAt(i);
                item['width'] = 50;
                pno++;
            } else if (i === 3) {
                item['title'] = 'PTS\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 4) {
                item['title'] = 'PAS\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 5) {
                item['title'] = 'AKHIR\n'+char.charAt(i);
                item['width'] = 70;
            } else if (i === 6) {
                item['title'] = 'PRED\n'+char.charAt(i);
                item['width'] = 70;
            } else if (i === 7) {
                item['title'] = 'DESKRIPSI\n'+char.charAt(i);
                item['width'] = 300;
                item['wordWrap'] = true;
            } else if (i === 8) {
                item['title'] = 'NILAI\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 9) {
                item['title'] = 'PRED\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 10) {
                item['title'] = 'DESKRIPSI\n'+char.charAt(i);
                item['width'] = 300;
                item['wordWrap'] = true;
            } else if (i === 11) {
                item['title'] = 'ID';
                item['width'] = 1;
            }
            item['colspan'] = '1';

            arrCol.push(item);
        }

        tableSiswa.jexcel({
            data:dataSiswa,
            minDimensions:[12],
            //defaultColWidth: 100,
            tableOverflow: true,
            tableWidth: ''+tableSiswa.width()+'px',
            tableHeight: (80*dataSiswa.length)+'px',
            search:true,
            freezeColumns: 2,
            //rowResize: true,
            columnResize: false,
            columns: arrCol,
            /*[
            {width: 100},
            {width: 300},       ],*/
            nestedHeaders:[
                [
                    {
                        title: 'DATA SISWA',
                        colspan: '2',
                    },
                    {
                        title: 'NILAI PENGETAHUAN',
                        colspan: '6',
                    },
                    {
                        title: 'NILAI KETERAMPILAN',
                        colspan: '4',
                    },
                ],
            ],
            updateTable:function(instance, cell, col, row, val, label, cellName) {
                if (col === 0 || col === 1) {
                    cell.className = '';
                    cell.style.backgroundColor = '#f8d7da';
                    cell.style.textAlign = 'left';
                    cell.classList.add('readonly');
                }

                if (col === 4) {
                    cell.style.backgroundColor = '#b9f6ca';
                }


                if (col === 7 || col === 10 || col === 11) {
                    cell.className = '';
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                    cell.style.fontSize = 'small';
                }

                if (col === 2 || col === 3 || col === 5 || col === 6 || col === 8 || col === 9) {
                    cell.className = '';
                    cell.style.backgroundColor = '#ffebee';
                    cell.classList.add('readonly');
                }

                if (col === 5 || col === 6 || col === 8 || col === 9) {
                    cell.style.fontWeight = '600'
                }
            },
            onchange: function(instance, cell, col, row, value, label) {
                //var cellName = jexcel.getColumnNameFromId([col,row]);
                var d = [];
                if (col === 10) {
                    d = [];
                    for (let i = 2; i < 10; i++) {
                        var values1 = $(`td[data-x="${i}"][data-y="${row}"]`).text();
                        d.push(values1);
                    }
                    $(`td[data-x="13"][data-y="${row}"]`).text(setDesk(d));
                }

                if (col === 22) {
                    d = [];
                    for (let i = 14; i < 22; i++) {
                        var values2 = $(`td[data-x="${i}"][data-y="${row}"]`).text();
                        d.push(values2);
                    }
                    //console.log(setDesk(d));
                    $(`td[data-x="25"][data-y="${row}"]`).text(setDesk(d));
                }
            }
        });

        function cellRef(cel) {
            var x = cel.replace(/[A-Za-z]/g, "");
            x = x.charCodeAt(0) - 65;
            var y = cel.replace(/\D/g, "");
            y = y -1;

            return x + "," + y;
        }

        $('#uploadpas').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = new FormData($('#uploadpas')[0]);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_url + 'rapor/uploadpas/'+idMapel+'/'+idKelas,
                data: form,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    console.log(data);
                    swal.fire({
                        title: "Sukses",
                        html: "<b>"+data+"<b> nilai berhasil diupdate",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then(result => {
                        if (result.value) {
                            window.location.href = base_url + 'rapor/inputpas/'+idMapel+'/'+idKelas
                        }
                    });
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    showDangerToast(e.responseText);
                }
            });
        });

        $('#uploadnilai').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var tbl = $('table.jexcel tr').get().map(function(row) {
                return $(row).find('td').get().map(function(cell) {
                    return $(cell).html();
                });
            });
            tbl.shift();
            tbl.shift();
            console.log($(this).serialize() + '&nilai='+JSON.stringify(tbl));

            $.ajax({
                type: "POST",
                url: base_url + 'rapor/importpas/'+idMapel+'/'+idKelas,
                data: $(this).serialize() + '&nilai='+JSON.stringify(tbl),
                cache: false,
                success: function (data) {
                    console.log(data);
                    swal.fire({
                        title: "Sukses",
                        html: "<b>"+data+"<b> nilai berhasil disimpan",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then(result => {
                        if (result.value) {
                            window.location.href = base_url + 'rapor/inputpas/'+idMapel+'/'+idKelas
                        }
                    });
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    showDangerToast(e.responseText);
                }
            });
        });

    });
</script>
