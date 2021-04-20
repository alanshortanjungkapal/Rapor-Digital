<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-light">
    <section class="content-header p-0 d-flex align-items-end" style="height: 400px; background: url('<?=base_url('assets/img/wall2.png')?>')">
        <div class="container-fluid pl-0 pr-0 pb-0 pt-4" style="background-color: rgba(255,255,255,0.7)">
            <div class="row m-0">
                <?php foreach ($info_box as $info) : ?>
                    <div class="col-md-2 col-3">
                        <div class="shadow small-box bg-<?= $info->box ?>">
                            <div class="inner">
                                <h5 class="mb-0"><b><?= $info->total; ?></b></h5>
                                <span><?= $info->title; ?></span>
                            </div>
                            <div class="icon">
                                <i class="fa fa-<?= $info->icon ?>" style="font-size:40px; top: 10px"></i>
                            </div>
                            <!--
                            <a href="<?= base_url() . strtolower($info->title); ?>" class="small-box-footer">
                                Detail <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            -->
                        </div>
                    </div>
                <?php endforeach; ?>
			</div>
		</div>
	</section>

    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Penilaian</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($ujian_box as $info) : ?>
                                    <div class="col-md-3 col-4" style="min-height: 60px">
                                        <div class="info-box border" style="min-height: 60px">
                                            <!--
												<span class="info-box-icon bg-gradient-<?= $info->box ?> elevation-1">
													<i class="fa fa-<?= $info->icon ?>"></i>
												</span>
												-->
                                            <div class="info-box-content pl-1 pr-1">
                                                <span class="info-box-text text-sm"><?= $info->title; ?></span>
                                                <h5 class="info-box-number"><?= $info->total; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="card">
                        <div class="card-header with-border">
                            <div class="card-title">Pengumuman</div>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                    -->
                    <hr>
                    <h5>Pengumuman</h5>
                    <div class="konten-pengumuman">
                        <div id="pengumuman">
                        </div>
                        <p id="loading-post" class="text-center d-none">
                            <br/><i class="fa fa-spin fa-circle-o-notch"></i> Loading....
                        </p>
                        <div id="loadmore-post"
                             onclick="getPosts()"
                             class="text-center mt-4 loadmore d-none">
                            <div class="btn btn-default">Muat Pengumuman lainnya ...</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Aktifitas</div>
                        </div>
                        <div class="card-body">
                            <div id="log-list">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
</div>

<div class="modal fade" id="komentarModal" tabindex="-1" role="dialog" aria-labelledby="komentarLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="komentarLabel">Tulis Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/img/siswa.png') ?>" alt="Alt Text">
                <div class="img-push">
                    <?= form_open('create', array('id' => 'komentar')) ?>
                    <input type="hidden" id="id-post" name="id_post" value="">
                    <div class="input-group">
                        <input type="text" name="text" placeholder="Tulis komentar ..."
                               class="form-control form-control-sm" required>
                        <span class="input-group-append">
                                <button type="submit" class="btn btn-success btn-sm">Komentari</button>
                            </span>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="balasanModal" tabindex="-1" role="dialog" aria-labelledby="balasanLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balasanLabel">Tulis Balasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/img/siswa.png') ?>" alt="Alt Text">
                <div class="img-push">
                    <?= form_open('create', array('id' => 'balasan')) ?>
                    <input type="hidden" id="id-comment" name="id_comment" value="">
                    <div class="input-group">
                        <input type="text" name="text" placeholder="Tulis balasan ...."
                               class="form-control form-control-sm" required>
                        <span class="input-group-append">
                                <button type="submit" class="btn btn-success btn-sm">Balas</button>
                            </span>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    var halaman = 0;
    var idGuru = "<?=$guru->id_guru?>";
    function createTime(d) {
        var date = new Date(d);

        var jam = date.getHours();
        var menit = date.getMinutes();
        var sJam;
        var sMenit;

        if (jam < 10) sJam = '0' + jam;
        else sJam = '' + jam;

        if (menit < 10) sMenit = '0' + menit;
        else sMenit = '' + menit;

        var hari = daysdifference(d);
        var time;

        if (hari === 0) {
            time = sJam + ':' + sMenit;
        } else if (hari === 1) {
            time = 'kemarin ' + sJam + ':' + sMenit;
        } else {
            time = jQuery.timeago(d) + ', ' + sJam + ':' + sMenit;
        }
        return time;
    }

    function daysdifference(last) {
        var startDay = new Date(last);
        var endDay = new Date();

        var millisBetween = startDay.getTime() - endDay.getTime();
        var days = millisBetween / (1000 * 3600 * 24);

        return Math.round(Math.abs(days));
    }

    function addComments(id, comments, append) {
        var comm = '';
        $.each(comments, function (i, v) {
            var dari = v.dari_group == '1' ? 'Admin' : (v.dari_group == '2' ? v.nama_guru : v.nama_siswa);
            var foto = v.dari_group == '2' ? (v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png') :
                (v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png');
            var avatar = v.dari == '0' ? '<div class="btn-circle-sm btn-success media-left pt-1" style="width: 43px; height: 40px">A</div>' : '<img class="img-circle border" src="' + foto + '" alt="Img" width="40px" height="40px">';
            comm += '<div class="media mt-1" id="parent-reply' + v.id_comment + '">'
                + avatar +
                '    <div class="w-100 ml-2">' +
                '        <div class="media-body border pl-3 bg-light" style="border-radius: 20px">' +
                '            <span class="text-xs text-muted"><b>' + dari + '</b></span>' +
                '            <div class="comment-text pb-1">' + v.text + '</div>' +
                '        </div>' +
                '        <div class="ml-2">' +
                '            <span class="btn-sm mr-2 text-muted">' + createTime(v.tanggal) + '</span>' +
                '            <span id="trigger-reply'+v.id_comment+'" class="btn btn-sm mr-2 text-muted action-collapse" data-toggle="collapse" aria-expanded="true"' +
                '                              aria-controls="collapse-reply' + v.id_comment + '"' +
                '                              href="#collapse-reply' + v.id_comment + '"><b>' + v.jml + ' balasan</b></span>' +
                '            <span class="btn btn-sm mr-2 text-muted btn-toggle-reply"' +
                '                  data-id="' + v.id_comment + '" data-toggle="modal" data-target="#balasanModal">' +
                '                <i class="fas fa-reply"></i> <b>Balas</b></span>';
            if (v.dari_group === '2' && v.dari === idGuru) {
                comm += '            <span class="btn btn-sm text-muted" data-id="'+v.id_comment+'">' +
                    '                <i class="fa fa-trash mr-1"></i> Hapus' +
                    '            </span>';
            }
            comm += '        </div>' +
                '<div id="collapse-reply' + v.id_comment + '" class="p-2 collapse toggle-reply" data-id="' + v.id_comment + '" data-parent="#parent-reply' + v.id_comment + '">';
            if (v.jml != '0') {
                comm += '<div id="konten-reply' + v.id_comment + '"></div>'+
                    '<div id="loadmore-reply' + v.id_comment + '" onclick="getReplies('+v.id_comment+')" class="text-center mb-3 loadmore-reply">' +
                    '       <div class="btn btn-default">Muat balasan lainnya ...</div>' +
                    '</div>';
            }
            comm += '    <div id="loading-reply' + v.id_comment + '" class="text-center d-none">' +
                '        <div class="spinner-grow"></div>' +
                '    </div>' +
                '</div>'+
                '    </div>' +
                '</div>';
        });

        if (append) {
            $(`#konten${id}`).append(comm);
        } else {
            $(`#konten${id}`).prepend(comm);
        }

        $('.toggle-reply').on('shown.bs.collapse', function (e) {
            var konten = $(this);
            var id = konten.data('id');
            var list = $(this).find('.media').length;
            if (list === 0) $(`#loadmore-reply${id}`).click();
        });
    }

    function addReplies(id, replies, append) {
        console.log('replies', replies);
        var repl = '';
        $.each(replies, function (i, v) {
            var sudahAda = $(`.media${v.id_reply}`).length;
            if (!sudahAda) {
                var dari = v.dari_group == '1' ? 'Admin' : (v.dari_group == '2' ? v.nama_guru : v.nama_siswa);
                var foto = v.dari_group == '2' ? (v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png') :
                    (v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png');
                var avatar = v.dari == '0' ? '<div class="btn-circle-sm btn-success media-left pt-1 mr-2" style="width: 37px">A</div>' : '<img class="img-circle mr-2 border" src="' + foto + '" alt="Img" width="35px" height="35px">';
                repl +=
                    '<div class="media mt-1 media'+v.id_reply+'">'
                    + avatar +
                    '    <div class="w-100">' +
                    '        <div class="media-body border pl-3" style="border-radius: 17px; background-color: #dee2e6">' +
                    '            <span class="text-xs text-muted"><b>'+dari+'</b></span>' +
                    '            <div class="comment-text">' + v.text +
                    '            </div>' +
                    '        </div>' +
                    '        <div class="ml-2">' +
                    '            <small class="btn-sm mr-2 text-muted">'+createTime(v.tanggal)+'</small>';
                if (v.dari_group === '2' && v.dari === idGuru) {
                    repl += '            <span class="btn btn-sm text-muted" data-id="'+v.id_reply+'">' +
                        '                <i class="fa fa-trash mr-1"></i> Hapus' +
                        '            </span>';
                }
                repl += '        </div>' +
                    '    </div>' +
                    '</div>';
            }
        });

        if (append) {
            $(`#konten-reply${id}`).append(repl);
        } else {
            $(`#konten-reply${id}`).prepend(repl);
        }
        console.log('added', 'reply'+id);
    }

    function getComments(id) {
        $(`#loading${id}`).removeClass('d-none');
        $(`#loadmore${id}`).addClass('d-none');
        var $count = $(`#loadmore${id}`), page = $count.data('count');
        if (!page) page = 0;

        setTimeout(function () {
            $.ajax({
                url: base_url + "pengumuman/getcomment/" + id + "/" + page,
                type: "GET",
                success: function (response) {
                    //console.log('page', page);
                    console.log("result", response);
                    page += 1;
                    currentPage = page;
                    $count.data('count', page);

                    if (response.length === 5) {
                        $(`#loadmore${id}`).removeClass('d-none');
                    }
                    $(`#loading${id}`).addClass('d-none');
                    addComments(id, response, true)
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        }, 500);
    }

    function getReplies(id) {
        $(`#loading-reply${id}`).removeClass('d-none');
        $(`#loadmore-reply${id}`).addClass('d-none');
        var $count = $(`#loadmore-reply${id}`), page = $count.data('count');
        if (!page) page = 0;

        setTimeout(function () {
            $.ajax({
                url: base_url + "pengumuman/getreplies/" + id + "/" + page,
                type: "GET",
                success: function (response) {
                    //console.log('page', page);
                    console.log("result", response);
                    page += 1;
                    currentPage = page;
                    $count.data('count', page);

                    //n >= start && n <= end
                    if (response.length === 5) {
                        $(`#loadmore-reply${id}`).removeClass('d-none');
                    }
                    $(`#loading-reply${id}`).addClass('d-none');
                    addReplies(id, response, true)
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        }, 500);
    }

    function addPosts(response) {
        var card = '';

        $.each(response, function (i, v) {
            var dari = v.dari_group == '1' ? 'Admin' : (v.dari_group == '2' ? v.nama_guru : v.nama_siswa);
            var foto = v.dari_group == '2' ? (v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png') :
                (v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png');

            var avatar = v.dari == '0' ? '<div class="btn-circle btn-success media-left pt-1">A</div>' :
                '<img class="img-circle media-left" src="' + foto + '" alt="Img" width="50px" height="50px">';
            card += '<div class="card">' +
                '    <div class="card-body" id="parent'+v.id_post+'">' +
                '        <div class="media">' +
                avatar +
                '                <div class="media-body ml-3">' +
                '                    <span class="font-weight-bold"><b>'+dari+'</b></span>' +
                '                    <br/>' +
                '                    <span class="text-gray">' + createTime(v.tanggal) + '</span>' +
                '                </div>' +
                '        </div>' +
                '        <div class="mt-2">' + v.text + '</div>' +
                '        <div class="text-muted">' +
                '            <button type="button" class="btn btn-default btn-sm mr-2 btn-toggle"' +
                '                    data-id="'+v.id_post+'" data-toggle="modal"' +
                '                    data-target="#komentarModal"><i class="fas fa-reply mr-1"></i> Tulis komentar' +
                '            </button>' +
                '            <button type="button" id="trigger'+v.id_post+'" class="btn btn-default btn-sm mr-2 action-collapse"' +
                '                    data-toggle="collapse" aria-expanded="true"' +
                '                    aria-controls="collapse-'+v.id_post+'"' +
                '                    href="#collapse-'+v.id_post+'">' +
                '                <i class="fa fa-commenting-o mr-1"></i>'+v.jml+' komentar' +
                '            </button>';
            if (v.dari_group === '2' && v.dari === idGuru) {
                card += '            <button type="button" class="btn btn-default btn-sm" data-id="'+v.id_post+'">' +
                    '                <i class="fa fa-trash mr-1"></i> Hapus' +
                    '            </button>';
            }
            card += '        </div>' +
                '    </div>' +
                '    <div id="collapse-'+v.id_post+'" class="p-2 collapse toggle-comment"' +
                '         data-id="'+v.id_post+'" data-parent="#parent'+v.id_post+'">' +
                '        <hr class="m-0">' +
                '        <div id="konten'+v.id_post+'" class="p-4">' +
                '        </div>' +
                '        <div id="loading'+v.id_post+'" class="text-center d-none">' +
                '            <div class="spinner-grow"></div>' +
                '        </div>';
            if (v.jml=='0'){
                card += '<div class="text-center">Tidak ada komentar</div>';
            } else {
                card += '<div id="loadmore'+v.id_post+'"' +
                    '     onclick="getComments('+v.id_post+')"' +
                    '     class="text-center mt-4 loadmore">' +
                    '    <div class="btn btn-default">Muat komentar lainnya ...</div>' +
                    '</div>';
            }
            card += '</div>' +
                '</div>';
        });

        $('#pengumuman').html(card);

        $('.toggle-comment').on('shown.bs.collapse', function (e) {
            var konten = $(this);
            var id = konten.data('id');
            var list = $(this).find('.media').length;
            if (list === 0) $(`#loadmore${id}`).click();
        });

        $('#komentarModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            $("#id-post").val(id);

            var isVisible = $(`#collapse-${id}`).hasClass('show');
            if (!isVisible) {
                $(`#trigger${id}`).click();
            }
        });

        $('#balasanModal').on('show.bs.modal', function (e) {
            var id = $(e.relatedTarget).data('id');
            $("#id-comment").val(id);

            var isVisible = $(`#collapse-reply${id}`).hasClass('show' );
            if (!isVisible) {
                $(`#trigger-reply${id}`).click();
            }
        });

        $('#komentar').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            console.log("data", $(this).serialize());
            var id = $(this).find('input[name=id_post]').val();

            $.ajax({
                url: base_url + "pengumuman/savekomentar",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (response) {
                    console.log("result", response);
                    $('#komentarModal').modal('hide').data('bs.modal', null);
                    $('#komentarModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    addComments(id, response, false)
                    //window.location.href = base_url + 'pengumuman';
                },
                error: function (xhr, status, error) {
                    $('#komentarModal').modal('hide').data('bs.modal', null);
                    $('#komentarModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    showDangerToast('Error, komentar tidak terkirim');
                }
            });
        });

        $('#balasan').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            console.log("data", $(this).serialize());
            var id = $(this).find('input[name=id_comment]').val();

            $.ajax({
                url: base_url + "pengumuman/savebalasan",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (response) {
                    console.log("result", response);
                    $('#balasanModal').modal('hide').data('bs.modal', null);
                    $('#balasanModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    //window.location.href = base_url + 'pengumuman';
                    addReplies(id, response, false)
                },
                error: function (xhr, status, error) {
                    $('#balasanModal').modal('hide').data('bs.modal', null);
                    $('#balasanModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    showDangerToast('Error, balasan tidak terkirim');
                }
            });
        });

    }

    function getPosts() {
        $(`#loading-post`).removeClass('d-none');
        $(`#loadmore-post`).addClass('d-none');

        setTimeout(function () {
            $.ajax({
                url: base_url + "pengumuman/getpost/" + halaman,
                type: "GET",
                success: function (response) {
                    console.log("result", response);
                    halaman += 1;

                    if (response.length === 5) {
                        $(`#loadmore-post`).removeClass('d-none');
                    }
                    $(`#loading-post`).addClass('d-none');
                    addPosts(response)
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        }, 500);
    }

    $(document).ready(function () {
        getPosts();
    });

</script>