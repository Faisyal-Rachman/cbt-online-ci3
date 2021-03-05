<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$subjudul?></h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>
	

	<div class="card">
		<div class="card-header">
			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Data</button>
			<div class="card-tools">
				
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Delete</button>
			</div>
			</div>
		    <div class="card-body">
		<?= form_open('', array('id' => 'bulk')) ?>
		<table id="info" class="w-100 table table-striped table-bordered table-hover table-sm">
			<thead class="table table-primary">
				<tr>
					<th style="width:23px;">NO.</th>
					<th style="width:220px;">Judul</th>
					<th style="width:120px;">Tanggal</th>
					<th style="width:120px;">Kategori</th>
					
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
		<div class="modal-header bg-primary">
			 <h5 class="modal-title"><b>Tambah <?=$judul?></b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
				
			</div>
			  <?=form_open('manager/data_info/simpan', array('id'=>'info'), array('mode'=>'add'))?>
                <div class="modal-body">
				<div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
							<label>Judul Pengumuman</label>
							<input type="hidden" class="form-control" name="tambah-info" id="tambah-info" >
                            <input type="text" class="form-control" name="info_judul" id="info_judul" >
							</div>
                            </div>
							<div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Isi Pengumuman</label>
							<textarea class="textarea" id="info_isi" name="info_isi" style="width: 80%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                   		</div>
                            </div>
                 <div class="col-md-6"><div class="form-group"><label>Kategori</label>
				 <select name="info_kategori" class="form-control" style="width: 100%!important">
                        <option value="Kegiatan"> Kegiatan</option>
                        <option value="Ujian"> Ujian</option>
                        <option value="Peringatan">Peringatan</option>
                    </select></div>
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
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
</section>

<script src="<?= base_url() ?>assets/dist/js/app/master/info/data.js"></script>
<script type="text/javascript">
 
$(document).ready(function () {
    
    $('form#info').on('submit', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
       
		var cek = CKEDITOR.instances.info_isi.getData();
		$('#tambah-info').val(cek);
      
        var btn = $('#submit');
        btn.attr('disabled', 'disabled').text('Wait...');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            method: 'POST',
            success: function (data) {
                btn.removeAttr('disabled').text('Simpan');
                console.log(cek);
                if (data.status) {
                    Swal({
                        "title": "Sukses",
                        "text": "Data Berhasil disimpan",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = base_url+'manager/data_info';
                        }
                    });
                } else {
                    var j;
                    for (let i = 0; i <= data.errors.length; i++) {
                        $.each(data.errors[i], function (key, val) {
                            j = $('[name="' + key + '"]');
                            j.closest('.form-group').addClass('has-error');
                            j.next().next().text(val);
                            if (val == '') {
                                j.closest('.form-group').removeClass('has-error');
                                j.next().next().text('');
                            }
                        });
                    }
                }
            }
        });
    });
});
</script>
