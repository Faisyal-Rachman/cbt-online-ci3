<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$subjudul?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?=$judul?></a></li>
              <li class="breadcrumb-item active"><?=$subjudul?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section>
	<div class="card">
	<div class="card-header">
			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Data</button>
			<a href="<?= base_url('siswa/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a>
			<button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
			<div class="card-tools">
				
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button>
			</div>
			</div>
    <div class="card-body">
      
        <?= form_open('siswa/delete', array('id' => 'bulk')); ?>
        <div class="table-responsive">
            <table id="siswa" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th width="100" class="text-center">Aksi</th>
                        <th width="100" class="text-center">
                            <input class="select_all" type="checkbox">
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th width="100" class="text-center">Aksi</th>
                        <th width="100" class="text-center">
                            <input class="select_all" type="checkbox">
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-notify modal-info modal-md">
		<div class="modal-content">
			<div class="modal-header">
			 <h5 class="modal-title"><b>Tambah <?=$judul?></b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
				
			</div>
			   <?=form_open('siswa/save', array('id'=>'siswa'), array('method'=>'add'))?>
			                <div class="modal-body">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input autofocus="autofocus" onfocus="this.select()" placeholder="NIM" type="text" name="nim" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input placeholder="Nama" type="text" name="nama" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input placeholder="Email" type="email" name="email" class="form-control">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control select2">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="form-control select2">
                            <option value="" disabled selected>-- Pilih --</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select id="kelas" name="kelas" class="form-control select2">
                            <option value="">-- Pilih --</option>
                        </select>
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group pull-right">
                        <button type="reset" class="btn btn-flat btn-default"><i class="fa fa-rotate-left"></i> Reset</button>
                        <button type="submit" id="submit" class="btn btn-flat bg-purple"><i class="fa fa-save"></i> Simpan</button>
                    </div>
					</div>
                <?=form_close()?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
</section>
<script src="<?= base_url() ?>assets/dist/js/app/master/siswa/data.js"></script>
<script src="<?= base_url() ?>assets/dist/js/app/master/siswa/add.js"></script>
<script src="<?= base_url() ?>assets/dist/js/app/master/siswa/edit.js"></script>