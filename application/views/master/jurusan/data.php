<div class="content-wrapper bg-white pt-4">
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
			<div class="card my-shadow mb-4">
				<div class="card-header py-3">
					<div class="card-title">
						<h6>Master <?=$subjudul?></h6>
					</div>
					<div class="card-tools">
						<button type="button" onclick="reload_ajax()" class="btn btn-sm btn-default"><i
								class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ml-1">Reload</span>
						</button>
						<button type="button" data-toggle="modal" data-target="#createJurusanModal" class="btn btn-sm btn-primary"><i
								class="fas fa-plus"></i><span class="d-none d-sm-inline-block ml-1">Tambah Data</span>
						</button>
						<a href="<?= base_url('datajurusan/import') ?>" class="btn btn-sm btn-flat btn-success"><i
								class="fas fa-upload"></i><span class="d-none d-sm-inline-block ml-1">Import</span></a>
					</div>
				</div>
				<div class="card-body">
					<?=form_open('',array('id'=>'bulk'))?>
					<table id="jurusan" class="w-100 table table-striped table-bordered table-hover table-sm">
						<thead>
						<tr>
							<th class="text-center align-middle p-0" style="width: 40px">
								<input type="checkbox" id="select_all">
							</th>
							<th style="width: 40px" class="text-center align-middle p-0">No.</th>
							<th>Jurusan</th>
							<th>Kode</th>
                            <th>Status</th>
							<th class="text-center align-middle p-0" style="width: 100px"><span>Aksi</span></th>
						</tr>
						</thead>
					</table>
					<?=form_close()?>
				</div>
			</div>
		</div>
	</section>
</div>

<?=form_open('create', array('id'=>'create'))?>
<div class="modal fade" id="createJurusanModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Jurusan*</label>
                    <div class="col-md-10">
                        <input type="text" id="createnama" name="nama_jurusan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Kode*</label>
                    <div class="col-md-10">
                        <input type="text" id="createkode" name="kode_jurusan" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Status*</label>
                    <div class="col-md-10">
                        <?php
                        echo form_dropdown(
                            'status',
                            $status,
                            '1',
                            'class="form-control" required'
                        ); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>
<?=form_close()?>

<?=form_open('update', array('id'=>'update'))?>
    <div class="modal fade" id="editJurusanModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row" id="formnama">
                        <label class="col-md-2 col-form-label">Jurusan*</label>
                        <div class="col-md-10">
                            <input type="text" id="namaEdit" name="nama_jurusan" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row" id="formkode">
                        <label class="col-md-2 col-form-label">Kode*</label>
                        <div class="col-md-10">
                            <input type="text" id="kodeEdit" name="kode_jurusan" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row" id="formstatus">
                        <label class="col-md-2 col-form-label">Status*</label>
                        <div class="col-md-10">
                            <?php
                            echo form_dropdown(
                                'status',
                                $status,
                                '1',
                                'id="status" class="form-control" required'
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="editIdJurusan" name="id_jurusan" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
<?=form_close()?>

<!--
<div class="template-demo d-flex justify-content-between flex-wrap">
    <button type="button" class="btn btn-success btn-fw" onclick="showSuccessToast()">Success</button>
    <button type="button" class="btn btn-info btn-fw" onclick="showInfoToast()">Info</button>
    <button type="button" class="btn btn-warning btn-fw" onclick="showWarningToast()">Warning</button>
    <button type="button" class="btn btn-danger btn-fw" onclick="showDangerToast()">Danger</button>
</div>
-->
<script src="<?=base_url()?>/assets/app/js/master/jurusan/crud.js"></script>
