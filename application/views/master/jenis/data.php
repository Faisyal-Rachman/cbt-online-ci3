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
			<button type="button" data-toggle="modal" onclick="tambah()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Data</button>
			
			
			<div class="card-tools">
				 <?php 
$info = $this->session->flashdata('info');
if(!empty($info))
{ 
    echo $info; 
    
    
     }


?>
			</div>
			</div>
            <div class="card-body table-responsive">
              
              
              <table id="table-jenis" class="table table-bordered table-striped table-sm">
                <thead class="table table-primary">
                <tr>
                  <th>#</th>
                  <th>Jenis Ujian</th>
                  <th>Status</th>
                 <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
               
                <tr>
                  <td></td>
                  <td></td>
                   <td></td>
                <td></td>
                 </tr>
               
                </tbody>
                <tfoot>
                </tfoot>
              </table>
              
              
              
</div>
</div>

 <div style="max-height: 100%;overflow-y:auto;" class="modal" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-notify modal-info modal-md">
		<div class="modal-content">
			<div class="modal-header">
			 <h5 class="modal-title"><b>Tambah <?=$judul?></b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
				
			</div>
			  <?php echo form_open($url.'/simpan','id="form-tambah"'); ?>
                <div class="modal-body">
 
                    
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Status(1:Aktif)(0:Tidak Aktif)</label>
                        <div class="col-xs-8">
                            <input name="jenis_aktif" id="jenis_aktif" class="form-control" type="text" placeholder="1 / 0" required>
                        </div>
                    </div>
                <div class="form-group">
                        <label class="control-label col-xs-3" >Kode</label>
                        <div class="col-xs-8">
                            <input name="jenis_kkm" id="jenis_kkm" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ujian</label>
                        <div class="col-xs-8">
                            <input name="jenis_nama" id="jenis_nama" class="form-control" type="text" placeholder="Nama jenis" required>
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
<div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
                <h5 class="modal-title">Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <i class="nav-icon fas fa-window-close"></i></button>
                </div>
      <div class="modal-bodydelete">
       
        <div class="card card-primary">
            
           
            <!-- form start -->
            <form class="form" id="form-delete" action="<?php echo base_url()?>manager/data_jenis/hapus" method="post">
              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="lokasi3" value="Lokasi" />
                 <label for="exampleInputEmail2" id="alrt"> <strong style="color:red">Anda akan menghapus</label>&nbsp;<i id="nama"></i>?</strong>
                  
                  <input type="hidden" name="id3" id="id3" class="form-control" required="required" />
                  <input type="hidden" name="stts" id="stts" class="form-control" required="required" />
                </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">Submit</button>
                  <button data-dismiss="modal" class="btn btn-primary">Cancel</button>
                </div>
              </div>
            </form>
        </div>



      </div>
      
    </div>
  </div>
</div>
 <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModalEdit" aria-hidden="true">
       <?php echo form_open($url.'/edit','id="form-edit"'); ?>
	<div class="modal-dialog modal-notify modal-info modal-md">
		<div class="modal-content">
			<div class="modal-header">
			 <h5 class="modal-title"><b>Edit <?=$judul?></b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
				
			</div>
			  <?=form_open('manager/data_jenis/simpanedit', array('id'=>'jenis'), array('mode'=>'add'))?>
                <div class="modal-body">
 
                     <div id="form-pesan"></div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Edit Status(1:Aktif)(0:Tidak Aktif)</label>
                        <div class="col-xs-8">
                        	  <input type="hidden" name="edit-id" id="edit-id">
                            <input name="ejenis_aktif" id="ejenis_aktif" class="form-control" type="text" placeholder="1 / 0" required>
                        </div>
                    </div>
                <div class="form-group">
                        <label class="control-label col-xs-3" >Edit KKM</label>
                        <div class="col-xs-8">
                            <input name="ejenis_kkm" id="ejenis_kkm" class="form-control" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Edit Nama Mapel</label>
                        <div class="col-xs-8">
                            <input name="ejenis_nama" id="ejenis_nama" class="form-control" type="text" placeholder="Nama jenis" required>
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

 <script lang="javascript">
    function refresh_table(){
        $('#table-jenis').dataTable().fnReloadAjax();
    }
    
    function showpassword(){
        var x = document.getElementById("edit-password");
        if (x.type === "password") {
            x.type = "text";
            $("#icon-show-password").removeClass("fa-eye");
            $("#icon-show-password").addClass("fa-eye-slash");
        } else {
            x.type = "password";
            $("#icon-show-password").removeClass("fa-eye-slash");
            $("#icon-show-password").addClass("fa-eye");
        }
    }
 
    function tambah(){
      
        $('#jenis_aktif').val('');
        $('#jenis_kkm').val('');
         $('#jenis_nama').val('');
        $("#myModal").modal("show");
      
     
        $.clearInput();
        imageUpload();
    }


   function imageUpload2(){
        $('#card-preview').addClass('hide');
        $('#image-preview2').html('');
        $('#form-pesan-upload-image').html('');
        $('#image-isi').val('');
        $('#image-file').val('');

       // refresh_table_image();

        $("#modal-image2").modal("show");
    }
      function imageUpload(){
        $('#card-preview').addClass('hide');
        $('#image-preview').html('');
        $('#form-pesan-upload-image').html('');
        $('#image-isi').val('');
        $('#image-file').val('');

       // refresh_table_image();

        $("#modal-image").modal("show");
    }
 function image_preview(posisi, image){
        $('#image-preview').html('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-height: 110px;" />');
        $('#image-isi').val('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-width: 600px;" />');
        $('#card-preview').removeClass('hide');
    }
function image_preview2(posisi, image){
        $('#image-preview2').html('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-height: 110px;" />');
        $('#image-isi').val('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-width: 600px;" />');
        $('#card-preview2').removeClass('hide');
    }

    function edit(id){
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#ejenis_nama').val(data.jenis);
               $('#ejenis_aktif').val(data.stat);
                $('#ejenis_kkm').val(data.kkm);
                $("#modal-edit").modal("show");
                 // imageUpload2();
               $("#btn-image-insert").addClass('hide');
               $("#btn-image-insert2").removeClass('hide');
            }
           });
    }

    function noakses(){
        alert('Anda Bukan Admin!');
    }
 function refresh_table_image(){
        $('#table-image').dataTable().fnReloadAjax();
    }
    $(function(){
        $("#btn-show-password").click(function(){
            showpassword();
        });
        
        $("#group").change(function(){
            refresh_table();
        });

        $('#edit-simpan').click(function(){
            $('#edit-pilihan').val('simpan');
            $('#form-edit').submit();
        });
        $('#edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
          //  $('#form-edit').submit();
        });
        $('#btn-edit-pilih').click(function(event) {
            if($('#check').val()==0) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });
                $('#check').val('1');
            }else{
                $(':checkbox').each(function() {
                    this.checked = false;
                });
                $('#check').val('0');
            }
        });
        $('#btn-edit-hapus').click(function(){
            $("#modal-hapus").modal('show');
        });
        $('#btn-hapus').click(function(){
            $("#form-hapus").submit();
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_siswa",
                    type:"POST",
                    data:$('#form-hapus').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-hapus").modal('hide');
                            notify_success(obj.pesan);
                            $('#check').val('0');
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });
$('#delete').on('show.bs.modal', function(e) {
   //get data-id attribute of the clicked element
    var id = $(e.relatedTarget).data('id3');
    var sts = $(e.relatedTarget).data('stts');
    $(e.currentTarget).find('input[name="id3"]').val(id);
    $('#nama').html(sts);
    //  notify_success("Berhasil di Hapus");
});
        $('#form-edit').submit(function(){
        
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpanedit",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                       
                            $("#modal-edit").modal('hide');
                             Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "success"
                    });
                        }else{
                           
                            $('#form-pesan-edit').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

    
        $('#form-tambah').submit(function(){
                $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/simpan",
                    type:"POST",
                    data:$('#form-tambah').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                          
                           $("#myModal").modal('hide');
                            Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "success"
                    });
                        }else{
                         
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

     $('#form-delete').submit(function(){
        
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus",
                    type:"POST",
                    data:$('#form-delete').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                       
                            $("#delete").modal('hide');
                           Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "info"
                    });
                        }else{
                           
                            $('#form-pesan-edit').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
  $('#btn-image-insert').click(function(){
            var image = $('#image-isi').val();
          
           CKEDITOR.instances.ket.insertHtml(image);
         
          
            $("#modal-image").modal("hide");
        });
   $('#btn-image-insert2').click(function(){
       
            var image2 = $('#image-isi').val();
           CKEDITOR.instances.editket.insertHtml(image2);
            $("#modal-image").modal("hide");
        });

     $('#form-upload-image').submit(function(){
        
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/upload_file",
                    type:"POST",
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $('#image-preview').html(obj.image);
                            $('#image-isi').val(obj.image_isi);
                            $('#card-preview').removeClass('hide');
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-upload-image").html('');
                            $('#image-file').val('');
                           // refresh_table_image();
                            notify_success(obj.pesan);
                        }else{
                        
                            $('#form-pesan-upload-image').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
 $('#form-upload-image2').submit(function(){
        
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/upload_file",
                    type:"POST",
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $('#image-preview2').html(obj.image);
                            $('#image-isi').val(obj.image_isi);
                            $('#card-preview2').removeClass('hide');
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-upload-image").html('');
                            $('#image-file').val('');
                           // refresh_table_image();
                            notify_success(obj.pesan);
                        }else{
                        
                            $('#form-pesan-upload-image').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
        $('#table-jenis').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"40px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"30px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"20px"}],
                  "sAjaxSource": "<?php echo site_url().''.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "group", "value": $('#group').val()} );
                  }
         });  
 
    });
CKEDITOR.replaceAll();
</script>  