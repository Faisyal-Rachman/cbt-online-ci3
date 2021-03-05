<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Import Data Peserta
		
	</h1>

</section>

<!-- Main content -->
<section class="content">

	<div class="row">
        <div class="col-md-12">
			<?php echo form_open_multipart($url.'/import','id="form-importsiswa"'); ?>
                <div class="card bg-success">
                    <div class="card-header with-border">
    					<div class="card-title"><h5>Import Peserta</h5></div>
    					<div class="card-tools pull-right">
							<div class="dropdown pull-right">
								<a class="btn btn-block btn-light btn-flat" href="<?php echo base_url(); ?>public/form/form-datasiswa.xls">Download Form Import Siswa</a>
    						</div>
    					</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
						<label>
                            <?php if(!empty($error_upload)){ echo $error_upload; } ?>
                            <?php if(!empty($filename)){ echo $filename; } ?>
                        </label>
                        <span id="form-pesan">
                            <?php if(!empty($error)){ echo $error; } ?>
                        </span>
                        <div class="form-group">
                            <input type="file" id="userfile" name="userfile">
                            <p class="help-block">File Excel yang didukung adalah Microsoft Excel 2003 dan Microsoft Excel 2007</p>
                            <p class="help-block">SAVE AS ke Office 2007 jika gagal mengupload data dalam format Office 2003</p>
                        </div>
                        
                        <?php if(!empty($hasil)){ echo $hasil; } ?>
                    </div>
					
					<div class="card-footer">
                        <button type="submit" class="btn btn-warning" id="import">Import</button>
                    </div>
                </div>
			<?php echo form_close(); ?> 
        </div>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-peserta').dataTable().fnReloadAjax();
    }

    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-username').val('');
        $('#tambah-password').val('');
        $('#tambah-nama').val('');
        $('#tambah-email').val('');

        $("#modal-tambah").modal("show");
        $('#tambah-username').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-username').val(data.username);
                $('#edit-password').val(data.password);
                $('#edit-nama').val(data.nama);
                $('#edit-email').val(data.email);
                $('#edit-group').val(data.group);
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
        $("#group").change(function(){
            refresh_table();
        });

        $('#edit-simpan').click(function(){
            $('#edit-pilihan').val('simpan');
            $('#form-edit').submit();
        });
        $('#edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });

        $('#form-tambah').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    data:$('#form-tambah').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-tambah").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });      
    });
</script>