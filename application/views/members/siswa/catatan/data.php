<nav class="main-header navbar navbar-expand-md navbar-dark navbar-green border-bottom-0">
    <ul class="navbar-nav ml-2">
        <li class="nav-item">
            <a class="nav-link btn-outline-success" href="<?= base_url('dashboard') ?>" role="button"><i
                        class="fas fa-arrow-left"></i> Beranda</a>
        </li>
    </ul>

    <div class="mx-auto text-white text-center" style="line-height: 1">
        <span class="text-lg p-0"><?=$setting->nama_aplikasi?></span>
        <br>
        <small>Tahun Pelajaran: <?= $tp_active->tahun ?> Smt:<?= $smt_active->smt ?></small>
    </div>
</nav>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top: -1px;">
    <!-- Main content -->
    <div class="sticky">
    </div>
    <section class="content overlap p-4">
        <div class="container">
            <div class="info-box bg-transparent shadow-none">
                <img src="<?= base_url() ?>/assets/app/img/ic_graduate.png" width="120" height="120">
                <div class="info-box-content">
                    <h5 class="info-box-text text-white text-wrap"><b><?= $siswa->nama ?></b></h5>
                    <span class="info-box-text text-white"><?= $siswa->nis ?></span>
                    <span class="info-box-text text-white mb-1"><?= $siswa->nama_kelas ?></span>
                    <button onclick="logout()" class="btn btn-danger btn-outline-light" style="width: 200px">
                        LOGOUT<i class="fas fa-sign-out-alt ml-2"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-purple">
                        <div class="card-header">
                            <div class="card-title text-white">
                                <?= $subjudul ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            //echo '<pre>';
                            //var_dump($catatan[0]->reading);
                            //echo '</pre>';
                            ?>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <?php if (count($catatan) > 0) :?>
                                            <ul class="list-group" style="list-style:none;border-radius: 0;padding: 0">
                                                <?php foreach ($catatan as $cat) :
                                                    $for = $cat->type === '1' ? 'semua siswa kelas '. $siswa->nama_kelas : $siswa->nama;
                                                    $readed1 = $cat->type === '1' && ($cat->reading && in_array($cat->id_siswa, $cat->reading));
                                                $readed2 = $cat->type === '2' && $cat->readed !== '0';
                                                ?>
                                                <li class="list-group-item list-group-item-action" data-table="<?=$cat->table?>" data-id="<?=$cat->id_catatan?>"
                                                    style="border-bottom: 1px solid rgba(0,0,0,.125);line-height: 1;padding: 10px 0;width: 100%;height: 100%;">
                                                    <a href="javascript:void(0)">
                                                        <div class="media pl-3 pr-3">
                                                            <img class="img-circle media-left" src="<?= base_url('/assets/img/user.jpg') ?>" width="35" height="35" />
                                                            <div class="media-body ml-2">
                                                                <span class="text-dark"><?=$cat->nama_guru?></span>
                                                                <?php if ($cat->level == '1') :?>
                                                                    <span class="float-right text-xs text-success"><i class="fa fa-circle"></i></span>
                                                                <?php elseif ($cat->level == '2') : ?>
                                                                    <span class="float-right text-xs text-warning"><i class="fa fa-circle"></i></span>
                                                                <?php elseif ($cat->level == '3') : ?>
                                                                    <span class="float-right text-xs text-pink"><i class="fa fa-circle"></i></span>
                                                                <?php elseif ($cat->level == '4') : ?>
                                                                    <span class="float-right text-xs text-danger"><i class="fa fa-circle"></i></span>
                                                                <?php endif; ?>
                                                                <br />
                                                                <span class="text-xs text-muted">Kepada: <?=$for?></span>
                                                                <br />
                                                                <span class="text-xs text-muted"><?=buat_tanggal(date('D, d M Y H:i', strtotime($cat->tgl)))?></span>
                                                                <span class="float-right text-xs text-muted isreaded">
                                                                    <i><?= $readed1 ? 'sudah dibaca' : ($readed2 ? 'sudah dibaca' : 'belum dibaca') ?></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="ket">Keteraangan:</div>
                                    <div style="line-height: 1">
                                        <span class="text-xs"><i class="fa fa-circle text-success"></i> : saran</span>
                                        <br>
                                        <span class="text-xs"><i class="fa fa-circle text-warning"></i> : teguran</span>
                                        <br>
                                        <span class="text-xs"><i class="fa fa-circle text-pink"></i> : peringatan</span>
                                        <br>
                                        <span class="text-xs"><i class="fa fa-circle text-danger"></i> : sangsi</span>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 hidden-xs">
                                    <div class="empty text-center mt-5">Detail Catatan</div>
                                    <div id="detail" class="card d-none">
                                        <div class="card-header">
                                            <div class="media" style="line-height: 1.2">
                                                <img class="img-circle media-left" src="<?= base_url('/assets/img/user.jpg') ?>" width="50" height="50" />
                                                <div class="media-body ml-4">
                                                    <span id="nama-guru" class="text-lg"><b>Nama Guru</b></span>
                                                    <br />
                                                    <span id="jabatan-guru"> Jabatan </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="isi" class="text-justify">mdh kjydfkyf uy luy fl yfluyf</div>
                                        </div>
                                        <div class="overlay d-none">
                                            <div class="spinner-grow"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="daftarLabel">Detail Catatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-header">
                    <div class="media" style="line-height: 1.2">
                        <img class="img-circle media-left" src="<?= base_url('/assets/img/user.jpg') ?>" width="50" height="50" />
                        <div class="media-body ml-4">
                            <span id="nama-guru-modal" class="text-lg"><b>Nama Guru</b></span>
                            <br />
                            <span id="jabatan-guru-modal"> Jabatan </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="isi-modal" class="text-justify">mdh kjydfkyf uy luy fl yfluyf</div>
                </div>
                <div class="overlay d-none">
                    <div class="spinner-grow"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function screenSize() {
            var w = $(document).innerWidth();
            return (w < 768) ? 'xs' : ((w < 992) ? 'sm' : ((w < 1200) ? 'md' : 'lg'));
        }

        function viewDetail(data, table) {
            //console.log('size',screenSize());
            var detail = data.detail;
            var reading = data.reading;
            var mapel = detail.nama_mapel == null ? detail.jabatan + ' ' + detail.nama_kelas : 'Guru ' + detail.nama_mapel;
            if (screenSize() === 'xs') {
                $('#nama-guru-modal').html(detail.nama_guru);
                $('#jabatan-guru-modal').html(mapel);
                $('#isi-modal').html(detail.text);
                $('#detailModal').modal('show');
            } else {
                $('#nama-guru').html(detail.nama_guru);
                $('#jabatan-guru').html(mapel);
                $('#isi').html(detail.text);
                $('#detail').removeClass('d-none');
                $('.empty').addClass('d-none');
            }
            $('.overlay').addClass('d-none');

            var ada = reading.length > 0 && $.inArray(detail.id_siswa, reading) > -1;
            var readed;
            if (detail.type === '1') readed = ada;
            else readed = detail.readed !== '0';
            console.log('siswa', detail.id_siswa);
            console.log('readed', readed);

            if (!readed) {
                $.ajax({
                    url: base_url + 'siswaview/readed/'+table+'/'+detail.id_catatan,
                    type: 'GET',
                    success: function (response) {
                        console.log('read',response);
                    },
                    error: function (xhr, error, status) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }


        $('ul li').click(function (e) {
            var id = $(this).data('id');
            var table = $(this).data('table');

            $.ajax({
                url: base_url + 'siswaview/detailcatatan/'+ table + '/' + id,
                type: 'GET',
                success: function (response) {
                    console.log('response',response);
                    viewDetail(response, table);
                },
                error: function (xhr, error, status) {
                    console.log(xhr.responseText);
                }
            });
            $('ul li').removeClass('alert-default-primary');
            $(this).addClass('alert-default-primary');
            $('.overlay').removeClass('d-none');
            $(this).find('span.isreaded').html('<i>sudah dibaca</i>');
        });
    });
</script>