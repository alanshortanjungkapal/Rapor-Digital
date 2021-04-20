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
                        <h6><b><?=$ekstra['nama_ekstra']?></b></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="<?=base_url('rapor/downloadtemplateekstra/'.$ekstra['id_ekstra'].'/'.$kelas['id_kelas'])?>" id="download" type="button" class="btn btn-primary w-100">
                                <i class="fa fa-download"></i> <span class="ml-1">Download Template</span>
                            </a>
                        </div>

                        <div class="col-md-8">
                            <?= form_open_multipart('', array('id'=>'uploadekstra')); ?>
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
                    <?php if ($kkm==null) :?>
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
    var kkm = JSON.parse(JSON.stringify(<?= json_encode($kkm)?>));
    var idMapel = '<?=$ekstra['id_ekstra']?>';
    var idKelas = '<?=$kelas['id_kelas']?>';

    var isi = parseInt(kkm.kkm);
    var pre_d = 0;
    var pre_dsd = isi - 1;
    var pre_c = isi;
    var pre_csd = Math.floor(isi + (100 - isi) / 3);
    var pre_b = pre_csd + 1;
    var pre_bsd = Math.floor(pre_b + (100 - pre_b) / 2);
    var pre_a = pre_bsd + 1;
    var pre_asd = 100;


    $(function () {
        bsCustomFileInput.init();
    });

    function inRange(n, start, end) {
        return n >= start && n <= end;
    }

    function setDeskripsi(desk) {
        var result = '';
        if (inRange(desk, pre_a, pre_asd)) {
            result = "Sangat Baik";
        } else if (inRange(desk, pre_b, pre_bsd)) {
            result = "Baik";
        } else if (inRange(desk, pre_c, pre_csd)) {
            result = "Cukup";
        } else if (inRange(desk, pre_d, pre_dsd)) {
            result = "Kurang";
        }
        return result;
    }

    $(document).ready(function() {
        //console.log('a' + pre_a + ' b' + pre_b + ' bd' + pre_bsd + ' c' + pre_c + ' cd' + pre_csd + ' dd' + pre_dsd);
        var dataSiswa = [];
        var row = 1;
        $.each(arrSiswa, function (i, v) {
            var nilai = arrNilai[v.id_siswa];
            dataSiswa.push(
                [
                    v.nisn, v.nama, nilai.nilai,
                    '=IF(C'+row+'>'+pre_bsd+',"A",IF(C'+row+'>'+pre_csd+',"B",IF(C'+row+'>'+pre_dsd+',"C",IF(C'+row+'<'+pre_c+',"D",""))))',
                    '=IF(D'+row+'=="A","Sangat Baik",IF(D'+row+'=="B","Baik",IF(D'+row+'=="C","Cukup",IF(C'+row+'=="D","Kurang",""))))',
                    v.id_siswa
                ]
            );
            row++;
        });

        var tableSiswa = $('#t-siswa');

        var arrCol = [];

        var char= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for (let i = 0; i < 6; i++) {
            var item = {};
            if (i === 0) {
                item['title'] = 'N I S N\n'+char.charAt(i);
                item['width'] = 100;
            } else if (i === 1) {
                item['title'] = 'NAMA SISWA\n'+char.charAt(i);
                item['width'] = 250;
            } else if (i === 2) {
                item['title'] = 'NILAI PTS\n'+char.charAt(i);
                item['width'] = 100;
            } else if (i === 3) {
                item['title'] = 'PREDIKAT\n'+char.charAt(i);
                item['width'] = 100;
            } else if (i === 4) {
                item['title'] = 'DESKRIPSI\n'+char.charAt(i);
                item['width'] = 100;
            } else if (i === 5) {
                item['title'] = 'ID';
                item['width'] = 1;
            }
            item['colspan'] = '1';

            arrCol.push(item);
        }

        tableSiswa.jexcel({
            data:dataSiswa,
            minDimensions:[5],
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
            updateTable:function(instance, cell, col, row, val, label, cellName) {
                if (col === 0 || col === 1) {
                    cell.className = '';
                    cell.style.backgroundColor = '#f8d7da';
                    cell.style.textAlign = 'left';
                    cell.classList.add('readonly');
                }

                if (col === 3 || col === 4 || col === 5) {
                    cell.className = '';
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                }

                if (col === 2) {
                    cell.style.backgroundColor = '#b9f6ca';
                }
            },
        });

        $('#uploadekstra').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = new FormData($('#uploadekstra')[0]);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_url + 'rapor/uploadekstra/'+idMapel+'/'+idKelas,
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
                            window.location.href = base_url + 'rapor/inputekstra/'+idMapel+'/'+idKelas
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
            console.log($(this).serialize() + '&nilai='+JSON.stringify(tbl));

            $.ajax({
                type: "POST",
                url: base_url + 'rapor/importekstra/'+idMapel+'/'+idKelas,
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
                            window.location.href = base_url + 'rapor/inputekstra/'+idMapel+'/'+idKelas
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
