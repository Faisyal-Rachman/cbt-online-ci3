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
	

	<div class="card">
		<div class="card-header">
			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Data</button>
			<a href="<?= base_url('manager/data_mapel/import') ?>" class="btn btn-sm btn-flat btn-success"><i class="fa fa-upload"></i> Import</a>
			<button type="button" onclick="reload_ajax()" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Reload</button>
			<div class="card-tools">
				<button onclick="bulk_edit()" class="btn btn-sm btn-flat btn-warning" type="button"><i class="fa fa-edit"></i> Edit</button>
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button>
			</div>
			</div>
		    <div class="card-body">
		<?= form_open('', array('id' => 'bulk')) ?>
		<table id="matpel" class="w-100 table table-striped table-bordered table-hover table-sm">
			<thead class="table table-primary">
				<tr>
					<th style="width:23px;">NO.</th>
					<th style="width:220px;">MATA PELAJARAN</th>
					<th style="width:70px;">KODE</th>
					<th style="width:70px;">STATUS</th>
					<th style="width:70px;" class="text-center">
						<input type="checkbox" id="select_all">
					</th>
				</tr>
			</thead>
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
			  <?=form_open('manager/data_mapel/simpan', array('id'=>'matpel'), array('mode'=>'add'))?>
                <div class="modal-body">
 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status(1:Aktif)(0:Tidak Aktif)</label>
                        <div class="col-xs-8">
                            <input name="modul_aktif" class="form-control" type="text" placeholder="Kode matpel..." required>
                        </div>
                    </div>
   
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Mata Pelajaran</label>
                        <div class="col-xs-8">
                            <input name="modul_nama" class="form-control" type="text" placeholder="Nama matpel..." required>
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

<script src="<?= base_url() ?>assets/dist/js/app/master/matpel/data.js"></script>
