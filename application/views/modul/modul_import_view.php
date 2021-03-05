<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Mengimport Soal
	
	</h1>
	<ol class="breadcrumb">
		
		<li class="active">Import Soal berdasarkan Modul dan Topik</li>
	</ol>
</section>


<section class="content">
    <div class="row">
    <?php echo form_open_multipart($url.'/import','id="form-importsoal"'); ?>
    <div class="container-fluid">
            <div class="card">
              
                <div class="card-body form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                    <div class="card">
                <div class="card-header bg-dark">
                    <div class="card-title">Pilih Topik Pelajaran</div>
                </div><!-- /.card-header -->

                <div class="card-body">
					<div class="form-group">
                       
                        <select name="topik" id="topik" class="form-control input-sm">
                                <?php if($topikid==0){
                                    ?>
                                      <option value="" disabled selected></option>
                                      <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                        <?php    }else{ 
                                    echo $ctop; ?>
                                     <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                              <?php  } ?>
                                        </select>

				
					</div>
                </div>
                <div class="card-footer">
                    <p>Pilih terlebih dahulu Topik yang akan digunakan sebelum melakukan import soal</p>
                </div>
            </div>
                    </div>
                    
                    <div class="col-md-6">
                    <div class="card bg-light">
                <div class="card-header with-border bg-dark">
                    <div class="card-title">Import Soal</div>
					<div class="card-tools pull-right">
						<div class="dropdown pull-right">
							<a class="btn btn-block btn-info btn-flat" href="<?php echo base_url(); ?>public/form/form-soal.xls">Contoh Format Soal</a>
    					</div>
    				</div>
                </div><!-- /.card-header -->

                <div class="card-body">
					<span id="form-pesan"></span>
                    <div class="form-group">
                        <label>Pilih File</label>
                        <input type="file" id="userfile" name="userfile">
						
                        <p class="help-block">File Excel yang didukung adalah Microsoft Excel 2003 dan Microsoft Excel 2007</p>
                       
					</div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary pull-right" id="import">Import</button>
                </div>
            </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	

</section>
<!-- Main content -->




<script lang="javascript">

    function batal_tambah(){
        $("#form-pesan").html('');
        $('#userfile').val('');
    }

    $(function(){
       

        /**
         * Submit form tambah soal
         */
        $('#form-importsoal').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/import",
                    type:"POST",
                    timeout: 300000,
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            batal_tambah();
                            $('#form-pesan').html(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    },
                    statusCode: {
                        500: function(respon) {
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err('Terjadi kesalahan pada File yang di Upload. Silahkan cek terlebih dahulu file yang anda upload.'));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal mengimport Soal, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });
		 
		$( document ).ready(function() {
            
		});
    });
</script>