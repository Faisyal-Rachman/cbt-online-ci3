<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data User
	
	</h1>
	<ol class="breadcrumb">
	
		<li class="active">Hak Akses</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
    <div class="container-fluid">
                <div class="card">
                    <div class="card-header with-border">
    						<div class="card-title">Data User</div>
    						<div class="card-tools pull-right">
    							<div class="dropdown pull-right">
    								    <button type="button" data-toggle="modal" onclick="tambah()" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Data</button>
    							</div>
    						</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <table id="table-user" class="table table-bordered table-hover table-sm">
                        <thead class="table table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Level</th>
									<th>Opsi 1</th>
									<th>Opsi 2</th>
									<th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
									<td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
                </div>
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
</section><!-- /.content -->

<script lang="javascript">
 function tambah(){
      //  $('#form-pesan').html('');
     //   $('#jenis_aktif').val('');
     //   $('#jenis_kkm').val('');
       //  $('#jenis_nama').val('');
        $("#myModal").modal("show");
   //     $('#tambah-username').focus();
     
    //    $.clearInput();
     //   imageUpload();
    }

    $(function(){
        $('#table-user').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"40px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo current_url();?>/get_all_user/",
                  "autoWidth": false
         });          
    });
</script>