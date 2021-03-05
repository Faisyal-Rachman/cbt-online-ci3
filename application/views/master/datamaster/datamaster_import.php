<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Import Data
			</h1>

</section>

<!-- Main content -->
<section class="content">

	<div class="row">
        <div class="col-md-12">
			<?php echo form_open_multipart($url.'/import','id="importdatamaster"'); ?>
                <div class="card bg-success">
                    <div class="card-header with-border">
    					<div class="card-title"><h5>Import Data Master</h5></div>
                        <div id="rangking" class="panel-body">

</div>
    					<div class="card-tools pull-right">
							<div class="dropdown pull-right">
								<a class="btn btn-block btn-light btn-flat" href="<?php echo base_url(); ?>public/form/form-masterdata.xls">Download Form Import Data Master</a>
    						</div>
    					</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
						<label>
                            <?php if(!empty($error_upload)){ echo $error_upload; } ?>
                            <?php if(!empty($pesan)){ echo $pesan; } ?>
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



<script type="text/javascript">
/*
function fetch_ujian()
{
  var active_ujian='fetch_data';

           $.ajax({
            url:'<?php echo base_url(); ?>index.php/manager/data_all_master/import',
                method:"POST",
                data:{active_ujian:active_ujian},
                success:function(data){
                    if (data) {
                    Swal({
                        "title": "Sukses",
                        "text": "Data Berhasil disimpan",
                        "type": "success"
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = base_url+'manager/data_all_master';
                        }
                    });
                }
  
   
  }
  */
 });
}
fetch_ujian();
    
  
</script>