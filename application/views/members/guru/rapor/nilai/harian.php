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
                        <h6><b>Template Nilai <?=$mapel['nama_mapel']?></b></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <a href="<?=base_url('rapor/downloadtemplateharian/'.$mapel['id_mapel'].'/'.$kelas['id_kelas'])?>" id="download" type="button" class="btn btn-primary w-100">
                                <i class="fa fa-download"></i> <span class="ml-1">Download Template</span>
                            </a>
                        </div>

                        <div class="col-md-8">
                            <?= form_open_multipart('', array('id'=>'uploadharian')); ?>
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
                </div>
            </div>

            <div class="card my-shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h6><b>Indikator Penilaian <?=$mapel['nama_mapel']?></b></h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-default-info align-content-center" role="alert">
                        - Penulisan ringkasan KD/indikator KD max 70 huruf
                        <br>
                        - Klik pada tiap teks untuk mengedit materi
                        <br>
                        - Jangan lupa untuk menyimpan perubahan ringkasan materi
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <table id="tbl1" class="table table-bordered table-sm">
                                <thead>
                                <tr class="alert-default-success">
                                    <th class="text-center align-middle border-success" style="width: 50px">#</th>
                                    <th class="border-success">
                                        <span class="pl-2 align-middle">Edit Aspek Pengetahuan</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ($i=0;$i<8;$i++):
                                    $id_kikd = $mapel['id_mapel'].$kelas['id_kelas'].'1'.($i+1);
                                    $materi = $kikd[1][$id_kikd] == null ? '' : $kikd[1][$id_kikd]->materi_kikd;
                                    ?>
                                    <tr>
                                        <td style="width: 50px" class="text-sm text-center border-success nomor pt-0 pb-0">P<?= $i+1 ?></td>
                                        <td class="text-sm border-success editable p-0 pl-2"><?= $materi ?></td>
                                    </tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table id="tbl2" class="table table-bordered border-success table-sm">
                                <thead>
                                <tr class="alert-default-success">
                                    <th class="text-center align-middle border-success">#</th>
                                    <th class="border-success">
                                        <span class="pl-2 align-middle">Edit Aspek Keterampilan (Praktik/Portofolio/Proyek)</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ($i=0;$i<8;$i++):
                                    $id_kikd = $mapel['id_mapel'].$kelas['id_kelas'].'2'.($i+1);
                                    $materi = $kikd[2][$id_kikd] == null ? '' : $kikd[2][$id_kikd]->materi_kikd;
                                    ?>
                                    <tr>
                                        <td style="width: 50px" class="text-sm text-center border-success nomor pt-0 pb-0">K<?= $i+1 ?></td>
                                        <td class="text-sm border-success editable p-0 pl-2"><?= $materi ?></td>
                                    </tr>
                                <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?= form_open('', array('id' => 'editkikd')) ?>
                    <button type="submit" class="btn btn-success float-right" data-jenis="1">Simpan</button>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="card my-shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-title">
                        <h6><b>Edit Nilai <?=$mapel['nama_mapel']?></b></h6>
                    </div>
                </div>
                <div class="card-body">
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
    var arrKiKd = JSON.parse(JSON.stringify(<?= json_encode($kikd)?>));
    var kkm = JSON.parse(JSON.stringify(<?= json_encode($kkm)?>));
    var idMapel = '<?=$mapel['id_mapel']?>';
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

    var arrIndic1 = [];
    for (let i = 0; i < 8; i++) {
        var asp1 = arrKiKd[1];
        var idP = 'P'+ (i+1);
        if (asp1[idMapel+idKelas+'1'+(i+1)] != null && asp1[idMapel+idKelas+'1'+(i+1)].materi_kikd !== '') {
            idP = asp1[idMapel+idKelas+'1'+(i+1)].materi_kikd;
        }
        arrIndic1.push(idP);
    }
    var arrIndic2 = [];
    for (let i = 0; i < 8; i++) {
        var asp2 = arrKiKd[2];
        var idK = 'K'+ (i+1);
        if (asp2[idMapel+idKelas+'2'+(i+1)] != null && asp2[idMapel+idKelas+'2'+(i+1)].materi_kikd !== '') {
            idK = asp2[idMapel+idKelas+'2'+(i+1)].materi_kikd;
        }
        arrIndic2.push(idK);
    }

    var cols = [];

    var mp1 = 'P1';
    var mp2 = 'P2';
    var mp3 = 'P3';
    var mp4 = 'P4';
    var mp5 = 'P5';
    var mp6 = 'P6';
    var mp7 = 'P7';
    var mp8 = 'P8';

    $(function () {
        bsCustomFileInput.init();
    });

    function inRange(n, start, end) {
        return n >= start && n <= end;
    }

    function sortByNilai(arr, key) {
        return arr.sort(function (a,b) {
            var x = a[key];
            var y = b[key];
            return ((x>y) ? -1 : ((x<y) ? 1 : 0));
        });
    }

    function preCalcKetr(n1,n2, n3, pos, posdesk) {
        var res = '';
        if (n2!=null) {
            if (inRange(n2, pre_a, pre_asd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_a, pre_asd)) {
                        if (inRange(n3, pre_a, pre_asd)) {
                            res += ', ' + arrIndic2[posdesk];
                        } else {
                            res += ' dan ' + arrIndic2[posdesk];
                        }
                    } else {
                        res += ', sangat baik kemampuan dalam ' + arrIndic2[posdesk];
                    }
                } else {
                    res += ' sangat baik dalam ' + arrIndic2[posdesk];
                }
            } else if (inRange(n2, pre_b, pre_bsd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_b, pre_bsd)) {
                        if (inRange(n3, pre_b, pre_bsd)) {
                            res += ', ' + arrIndic2[posdesk];
                        } else {
                            res += ' dan ' + arrIndic2[posdesk];
                        }
                    } else {
                        res += ', baik kemampuan dalam ' + arrIndic2[posdesk];
                    }
                } else {
                    res += ' baik dalam ' + arrIndic2[posdesk];
                }
            } else if (inRange(n2, pre_c, pre_csd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_c, pre_csd)) {
                        if (inRange(n3, pre_c, pre_csd)) {
                            res += ', ' + arrIndic2[posdesk];
                        } else {
                            res += ' dan ' + arrIndic2[posdesk];
                        }
                    } else {
                        res += ', cukup kemampuan dalam ' + arrIndic2[posdesk];
                    }
                } else {
                    res += ' cukup dalam ' + arrIndic2[posdesk];
                }
            } else if (inRange(n2, pre_d, pre_dsd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_d, pre_dsd)) {
                        if (inRange(n3, pre_d, pre_dsd)) {
                            res += ', ' + arrIndic2[posdesk];
                        } else {
                            res += ' dan ' + arrIndic2[posdesk];
                        }
                    } else {
                        res += ', kurang kemampuan dalam ' + arrIndic2[posdesk];
                    }
                } else {
                    res += ' kurang dalam ' + arrIndic2[posdesk];
                }
            }
        }

        if (n3 == null) {
            res += '.';
        }
        return res;
    }

    function preCalcPeng(n1,n2, n3, pos, posdesk) {
        var res = '';
        if (n2!=null) {
            if (inRange(n2, pre_a, pre_asd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_a, pre_asd)) {
                        if (inRange(n3, pre_a, pre_asd)) {
                            res += ', ' + arrIndic1[posdesk];
                        } else {
                            res += ' dan ' + arrIndic1[posdesk];
                        }
                    } else {
                        res += ', sangat baik kemampuan dalam ' + arrIndic1[posdesk];
                    }
                } else {
                    res += ' sangat baik dalam ' + arrIndic1[posdesk];
                }
            } else if (inRange(n2, pre_b, pre_bsd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_b, pre_bsd)) {
                        if (inRange(n3, pre_b, pre_bsd)) {
                            res += ', ' + arrIndic1[posdesk];
                        } else {
                            res += ' dan ' + arrIndic1[posdesk];
                        }
                    } else {
                        res += ', baik kemampuan dalam ' + arrIndic1[posdesk];
                    }
                } else {
                    res += ' baik dalam ' + arrIndic1[posdesk];
                }
            } else if (inRange(n2, pre_c, pre_csd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_c, pre_csd)) {
                        if (inRange(n3, pre_c, pre_csd)) {
                            res += ', ' + arrIndic1[posdesk];
                        } else {
                            res += ' dan ' + arrIndic1[posdesk];
                        }
                    } else {
                        res += ', cukup kemampuan dalam ' + arrIndic1[posdesk];
                    }
                } else {
                    res += ' cukup dalam ' + arrIndic1[posdesk];
                }
            } else if (inRange(n2, pre_d, pre_dsd)) {
                if (pos > 0) {
                    if (inRange(n1, pre_d, pre_dsd)) {
                        if (inRange(n3, pre_d, pre_dsd)) {
                            res += ', ' + arrIndic1[posdesk];
                        } else {
                            res += ' dan ' + arrIndic1[posdesk];
                        }
                    } else {
                        res += ', kurang kemampuan dalam ' + arrIndic1[posdesk];
                    }
                } else {
                    res += ' kurang dalam ' + arrIndic1[posdesk];
                }
            }
        }

        if (n3 == null) {
            res += '.';
        }
        return res;
    }

    function setDeskPengetahuan(desk) {
        cols = [];
        for (let j = 0; j < desk.length; j++) {
            var item = {};
            item['pos'] = j;
            item['nilai'] = desk[j];
            item['desk'] = arrIndic1[j];
            cols.push(item)
        }
        cols = sortByNilai(cols, 'nilai');
        cols = $.grep(cols, function (n, i) {
            return (n != null && n.nilai !== '');
        });

        var result = cols.length>1 ? 'Memiliki kemampuan' : '';
        for (let i = 0; i < cols.length; i++) {
            if (cols[i].nilai != null && cols[i].nilai !== '' && cols[i].nilai > 0) {
                if (i === 0) {
                    if (cols[i+1] != null) {
                        result += preCalcPeng(null, cols[i].nilai, cols[i + 1].nilai, i, cols[i].pos);
                    }
                } else if (i === cols.length-1) {
                    if (cols[i-1] != null) {
                        result += preCalcPeng(cols[i-1].nilai, cols[i].nilai, null, i, cols[i].pos);
                    }
                } else {
                    if (cols[i-1] != null && cols[i+1] != null) {
                        result += preCalcPeng(cols[i-1].nilai, cols[i].nilai, cols[i + 1].nilai, i, cols[i].pos);
                    }
                }
            }
        }
        return result;
    }

    function setDeskKeterampilan(desk) {
        cols = [];
        for (let j = 0; j < desk.length; j++) {
            var item = {};
            item['pos'] = j;
            item['nilai'] = desk[j];
            item['desk'] = arrIndic2[j];
            cols.push(item)
        }
        cols = sortByNilai(cols, 'nilai');
        cols = $.grep(cols, function (n, i) {
            return (n != null && n.nilai !== '');
        });
        //console.log(cols);

        var result = cols.length>1 ? 'Memiliki keterampilan' : '';
        for (let i = 0; i < cols.length; i++) {
            if (cols[i].nilai != null && cols[i].nilai !== '' && cols[i].nilai > 0) {
                if (i === 0) {
                    if (cols[i+1] != null) {
                        result += preCalcKetr(null, cols[i].nilai, cols[i + 1].nilai, i, cols[i].pos);
                    }
                } else if (i === cols.length-1) {
                    if (cols[i-1] != null) {
                        result += preCalcKetr(cols[i-1].nilai, cols[i].nilai, null, i, cols[i].pos);
                    }
                } else {
                    if (cols[i-1] != null && cols[i+1] != null) {
                        result += preCalcKetr(cols[i-1].nilai, cols[i].nilai, cols[i + 1].nilai, i, cols[i].pos);
                    }
                }
            }
        }
        return result;
    }

    $(document).ready(function() {
        console.log(idKelas);
        //console.log('a' + pre_a + ' b' + pre_b + ' bd' + pre_bsd + ' c' + pre_c + ' cd' + pre_csd + ' dd' + pre_dsd);
        var dataSiswa = [];
        var row = 1;
        $.each(arrSiswa, function (i, v) {
            var nilai = arrNilai[v.id_siswa];
            var p1 = nilai.p1=='0'?'':nilai.p1; var p2 = nilai.p2=='0'?'':nilai.p2;
            var p3 = nilai.p3=='0'?'':nilai.p3; var p4 = nilai.p4=='0'?'':nilai.p4;
            var p5 = nilai.p5=='0'?'':nilai.p5; var p6 = nilai.p6=='0'?'':nilai.p6;
            var p7 = nilai.p7=='0'?'':nilai.p7; var p8 = nilai.p8=='0'?'':nilai.p8;

            var k1 = nilai.k1=='0'?'':nilai.k1; var k2 = nilai.k2=='0'?'':nilai.k2;
            var k3 = nilai.k3=='0'?'':nilai.k3; var k4 = nilai.k4=='0'?'':nilai.k4;
            var k5 = nilai.k5=='0'?'':nilai.k5; var k6 = nilai.k6=='0'?'':nilai.k6;
            var k7 = nilai.k7=='0'?'':nilai.k7; var k8 = nilai.k8=='0'?'':nilai.k8;

            dataSiswa.push(
                [
                    v.nisn, v.nama, p1, p2, p3, p4, p5, p6, p7, p8,
                    '=COUNTA(C'+row+':J'+row+')',
                    '=IF(COUNT(C'+row+':J'+row+')<2,"",ROUND(SUM(C'+row+':J'+row+')/K'+row+',0))',
                    '=IF(L'+row+'>'+pre_bsd+',"A",IF(L'+row+'>'+pre_csd+',"B",IF(L'+row+'>'+pre_dsd+',"C",IF(L'+row+'<'+pre_c+',"D",""))))',
                    setDeskPengetahuan([p1, p2, p3, p4, p5, p6, p7, p8]),
                    k1, k2, k3, k4, k5, k6, k7, k8,
                    '=COUNTA(O'+row+':V'+row+')',
                    '=IF(COUNT(O'+row+':V'+row+')<2,"",ROUND(SUM(O'+row+':V'+row+')/W'+row+',0))',
                    '=IF(X'+row+'>'+pre_bsd+',"A",IF(X'+row+'>'+pre_csd+',"B",IF(X'+row+'>'+pre_dsd+',"C",IF(X'+row+'<'+pre_c+',"D",""))))',
                    setDeskKeterampilan([k1, k2, k3, k4, k5, k6, k7, k8]),
                    v.id_siswa,
                    '=SUM(C'+row+':J'+row+')',
                    '=SUM(O'+row+':V'+row+')',
                    '=SUM(AB'+row+':AC'+row+')'
                ]
            );
            row++;
        });

        var arrCol = [];

        var pno = 1;
        var kno = 1;
        var char= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for (let i = 0; i < 30; i++) {
            var item = {};

            if (i === 0) {
                item['title'] = 'N I S N\n'+char.charAt(i);
                item['width'] = 100;
            } else if (i === 1) {
                item['title'] = 'NAMA SISWA\n'+char.charAt(i);
                item['width'] = 250;
            } else if (i < 10) {
                item['title'] = 'P-'+pno+'\n'+char.charAt(i);
                item['width'] = 35;
                pno++;
            } else if (i === 10) {
                item['title'] = 'JML\n'+char.charAt(i);
                item['width'] = 1;
            } else if (i === 11) {
                item['title'] = 'RATA\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 12) {
                item['title'] = 'PRED\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 13) {
                item['title'] = 'DESKRIPSI\n'+char.charAt(i);
                item['width'] = 200;
                item['wordWrap'] = true;
            } else if (i < 22) {
                item['title'] = 'K-'+kno+'\n'+char.charAt(i);
                item['width'] = 35;
                kno++;
            } else if (i === 22) {
                item['title'] = 'JML\n'+char.charAt(i);
                item['width'] = 1;
            } else if (i === 23) {
                item['title'] = 'RATA\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 24) {
                item['title'] = 'PRED\n'+char.charAt(i);
                item['width'] = 50;
            } else if (i === 25) {
                item['title'] = 'DESKRIPSI\n'+char.charAt(i);
                item['width'] = 200;
                item['wordWrap'] = true;
            } else if (i === 26) {
                item['title'] = 'ID';
                item['width'] = 1;
            } else if (i > 26 ) {
                item['width'] = 1;
            }

            arrCol.push(item);
        }

        var tableSiswa = $('#t-siswa').jexcel({
            data:dataSiswa,
            minDimensions:[30],
            //defaultColWidth: 100,
            tableOverflow: true,
            tableWidth: ''+$('#t-siswa').width()+'px',
            tableHeight: (120*dataSiswa.length)+'px',
            search:true,
            freezeColumns: 2,
            columnResize: false,
            //rowResize: true,
            /*
            toolbar:[
                //{ type:'i', content:'undo', onclick:function() { tableSiswa.undo(); } },
                //{ type:'i', content:'redo', onclick:function() { tableSiswa.redo(); } },
                //{ type:'select', k:'font-family', v:['Arial','Verdana'] },
                //{ type:'select', k:'font-size', v:['9px','10px','11px','12px','13px','14px','15px','16px','17px','18px','19px','20px'] },
                { type:'i', content:'save', onclick:function () { $('#uploadnilai').submit(); } },
                //{ type:'i', content:'format_align_left', k:'text-align', v:'left' },
                //{ type:'i', content:'format_align_center', k:'text-align', v:'center' },
                //{ type:'i', content:'format_align_right', k:'text-align', v:'right' },
                //{ type:'i', content:'format_bold', k:'font-weight', v:'bold' },
                //{ type:'color', content:'format_color_text', k:'color' },
                //{ type:'color', content:'format_color_fill', k:'background-color' },
            ],*/
            columns: arrCol,
            /*[
            {width: 100},
            {width: 300},       ],*/
            nestedHeaders:[
                [
                    {
                        title: 'Nilai Harian',
                        colspan: '30',
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

                if (col === 10 || col === 11 || col === 12 || col === 13 ||
                    col === 22 || col === 23 || col === 24 || col === 25 ||
                    col === 26 || col === 27 || col === 28 || col === 29) {
                    cell.className = '';
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                }

                if (col === 2 || col === 3 || col === 4 || col === 5 || col === 6 ||
                    col === 7 || col === 8 || col === 9 || col === 14 || col === 15 ||
                    col === 16 || col === 17 || col === 18 || col === 19 || col === 20 || col === 21) {
                    cell.style.backgroundColor = '#b9f6ca';
                }

                if (col === 13 || col === 25) {
                    cell.style.fontSize = 'small';
                    cell.style.textAlign = 'left';
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
                    $(`td[data-x="13"][data-y="${row}"]`).text(setDeskPengetahuan(d));
                }

                if (col === 22) {
                    d = [];
                    for (let i = 14; i < 22; i++) {
                        var values2 = $(`td[data-x="${i}"][data-y="${row}"]`).text();
                        d.push(values2);
                    }
                    //console.log(setDesk(d));
                    $(`td[data-x="25"][data-y="${row}"]`).text(setDeskKeterampilan(d));
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

        $('#uploadharian').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = new FormData($('#uploadharian')[0]);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_url + 'rapor/uploadharian/'+idMapel+'/'+idKelas,
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
                            window.location.href = base_url + 'rapor/inputharian/'+idMapel+'/'+idKelas
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
            var dataPost = $(this).serialize() + '&nilai='+JSON.stringify(tbl);
            console.log(dataPost);
            $.ajax({
                type: "POST",
                url: base_url + 'rapor/importharian/'+idMapel+'/'+idKelas,
                data: dataPost,
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
                            window.location.href = base_url + 'rapor/inputharian/'+idMapel+'/'+idKelas
                        }
                    });
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    showDangerToast(e.responseText);
                }
            });
        });

        /*
        $('#download').on('click', function () {
            //console.log('json',tableSiswa.jexcel('getColumnData', 1));
            var form = $('#template').serialize();
            //console.log(form +'&data='+ JSON.stringify(tableSiswa.jexcel('getJson')));
            $.ajax({
                type: "POST",
                url: base_url+"rapor/prosesnilaiharian",
                data: form +'&data='+ JSON.stringify(tableSiswa.jexcel('getJson')),
                //cache: false
                success: function(response){
                    if (response.status) {
                        window.location.href = base_url+"rapor/download";
                    }
                }
            });
        })*/

        $('.editable').attr('contentEditable',true);

        $('#editkikd').on('submit', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();

            const $rows1 = $('#tbl1').find('tr'), headers1 = $rows1.splice(0, 1);
            var jsonObj = [];
            var no = 1;
            $rows1.each((i, row) => {
                var id_kikd = ''+idMapel+idKelas+'1'+ no;
                const materi_kikd = $(row).find('.editable').text();

                let item = {};
                item ["id_kikd"] = id_kikd;
                item ["id_mapel_kelas"] = '' + idMapel + idKelas;
                item ["aspek"] = '1';
                item ["materi_kikd"] = materi_kikd;

                jsonObj.push(item);
                no++;
            });

            const $rows2 = $('#tbl2').find('tr'), headers2 = $rows2.splice(0, 1);
            no = 1;
            $rows2.each((i, row) => {
                var id_kikd = ''+idMapel+idKelas+'2'+ no;
                const materi_kikd = $(row).find('.editable').text();

                let item = {};
                item ["id_kikd"] = id_kikd;
                item ["id_mapel_kelas"] = '' + idMapel + idKelas;
                item ["aspek"] = '2';
                item ["materi_kikd"] = materi_kikd;

                jsonObj.push(item);
                no++;
            });

            var dataPost = $(this).serialize() + "&indikator=" + JSON.stringify(jsonObj);
            console.log(dataPost);

            $.ajax({
                url: base_url + "rapor/savekikd",
                type: "POST",
                dataType: "JSON",
                data: dataPost,
                success: function (data) {
                    console.log("response:", data);
                    if (data.status) {
                        //showSuccessToast('Data berhasil disimpan')
                        swal.fire({
                            title: "Sukses",
                            html: "Indikator penilaian berhasil disimpan",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then(result => {
                            if (result.value) {
                                window.location.href = base_url + 'rapor/inputharian/'+idMapel+'/'+idKelas
                            }
                        });
                    } else {
                        showDangerToast('gagal disimpan')
                    }
                }, error: function (xhr, status, error) {
                    console.log("response:", xhr.responseText);
                    showDangerToast('gagal disimpan')
                }
            });
        });

    });
</script>
