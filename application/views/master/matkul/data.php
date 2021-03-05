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
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Master <?= $subjudul ?></h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="mt-2 mb-3">
			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Data</button>
			<a href="<?= base_url('matkul/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a>
			<button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
			<div class="pull-right">
				<button onclick="bulk_edit()" class="btn btn-sm btn-flat btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
		<?= form_open('', array('id' => 'bulk')) ?>
		<table id="matkul" class="w-100 table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>No.</th>
					<th>Mata Kuliah</th>
					<th class="text-center">
						<input type="checkbox" class="select_all">
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>No.</th>
					<th>Mata Kuliah</th>
					<th class="text-center">
						<input type="checkbox" class="select_all">
					</th>
				</tr>
			</tfoot>
		</table>
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
			  <?=form_open('matkul/save', array('id'=>'matkul'), array('mode'=>'add'))?>
                <div class="modal-body">
 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Kode matpel</label>
                        <div class="col-xs-8">
                            <input name="kode_matkul" class="form-control" type="text" placeholder="Kode matpel..." required>
                        </div>
                    </div>
   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama matpel</label>
                        <div class="col-xs-8">
                            <input name="nama_matkul" class="form-control" type="text" placeholder="Nama matpel..." required>
                        </div>
                    </div>
 
                   
 
                </div>
 
                <div class="modal-footer">
                   <button id="submit" type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-save"></i> Simpan
                </button>
                </div>
            <?=form_close()?>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
</section>
<script src="<?= base_url() ?>assets/dist/js/app/master/matkul/data.js"></script>
<script src="<?= base_url() ?>assets/dist/js/app/master/matkul/add.js"></script>
<script src="<?= base_url() ?>assets/dist/js/app/master/matkul/edit.js"></script>