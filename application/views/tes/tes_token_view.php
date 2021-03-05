<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Token
</h1>

</section>

<!-- Main content -->
<section class="content">

	<div class="row">
    <div class="container-fluid">
            <?php echo form_open($url.'/token','id="form-token"'); ?>
              
                <div class="card">
                    <div class="card-header with-border">
    					<div class="card-title">Generate Token</div>
						<div class="card-tools pull-right">
    							<div class="dropdown pull-right">
    								<a  class="btn btn-sm text-light btn-primary" style="cursor: pointer;" onclick="manual()">Token Tes Manual</a>
    							</div>
    						</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                    <div class="row">
<div class="col-md-3"></div>
  <div class="col-md-6"> 
   <div class="card bg-success">
   <div class="card-body">
                                <div class="inner">
                                    <h3><span id="isi-token">0</span></h3>
                                    <p>Token Tes</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-barcode fa-5x"></i>
                                </div>
                                </div> 
                            </div>    
                            <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Masa Aktif</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-sm" id="token-aktif" name="token-aktif">
                                        <option value="1">1 Hari</option>
                                        <option value="5">5 menit</option>
                                        <option value="15">15 menit</option>
                                        <option value="30">30 menit</option>
                                        <option value="60">1 Jam</option>
                                        <option value="120">2 Jam</option>
                                        <option value="240">4 Jam</option>
                                    </select>
                                    <p class="help-block">Masa Aktif Token</p>
                                </div>
                            </div>
                            </div>
							<div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Daftar Tes</label>
                                <div class="col-sm-9">
                                    <select class="form-control input-sm" id="token-tes" name="token-tes">
                                        <?php if(!empty($select_tes)){ echo $select_tes; } ?>
                                    </select>
                                   
                                </div>
                                </div>
                            </div>
                            </div>
  <div class="col-md-3"></div>
</div>
                       
                     
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary pull-right" id="import">Generate Token</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
    <div class="container-fluid">
                <div class="card">
                <div class="card-header with-border">
                  		<div class="card-tools pull-right">
    							<div class="dropdown pull-right">
                                <button type="button" id="btn-edit-hapus" class="btn btn-warning btn-sm" title="Hapus Token yang dipilih">Hapus</button>
    							</div>
    						</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                    <?php echo form_open($url.'/hapus_daftar_token','id="form-hapus"'); ?>
                    <input type="hidden" name="check" id="check" value="0">
                        <table id="table-token" class="table table-bordered table-hover table-sm">
                           <thead class="table table-primary">
                                <tr>
                                    <th class="all">No.</th>
                                    <th class="all">Token</th>
                                    <th>Waktu Generate</th>
                                    <th>Masa Aktif</th>
									<th>Tes</th>
                                    <th></th>
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
                                </tr>
                            </tbody>
                        </table>    
                        </form>                       
                    </div>
                </div>
        </div>
    </div>
	


    <div style="overflow-y:auto;" class="modal" id="modal-hapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title">Hapus Token</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                        <strong>Anda yakin akan menghapus Token? Pastikan Token tidak terpakai!</strong>
                       
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-hapus" class="btn btn-default pull-left">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>


	<div class="modal" id="modal-token-manual" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/token_manual','id="form-token-manual"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
            <div id="trx-judul">Token Tes Manual</div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                                    </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                            <div id="form-pesan-manual"></div>
                            <div class="form-group">
                                <label>Token Tes</label>
                                <input type="text" class="form-control" id="manual-token" name="manual-token" placeholder="Token Tes">
								<span class="help-block">Pastikan Token Tes Manual belum pernah digunakan pada hari yang sama.</span>
                            </div>
							
							<div class="form-group">
                                <label>Masa Aktif</label>
                                <select class="form-control input-sm" id="manual-aktif" name="manual-aktif">
                                        <option value="1">1 Hari</option>
                                        <option value="5">5 menit</option>
                                        <option value="15">15 menit</option>
                                        <option value="30">30 menit</option>
                                        <option value="60">1 Jam</option>
                                        <option value="120">2 Jam</option>
                                        <option value="240">4 Jam</option>
								</select>
                            </div>
							<div class="form-group">
                                <label>Daftar Tes</label>
                                <select class="form-control input-sm" id="manual-tes" name="manual-tes">
									<?php if(!empty($select_tes)){ echo $select_tes; } ?>
								</select>
								<p class="help-block">Token dapat digunakan secara spesifik untuk suatu TES atau semua TES.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-token').dataTable().fnReloadAjax();
    }
	
	function manual(){
        $('#form-pesan-manual').html('');
        $('#manual-token').val('');

        $("#modal-token-manual").modal("show");
        $('#manual-token').focus();
    }

    $(function(){
        $('#form-token').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/token",
                    type:"POST",
                    data:$('#form-token').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $("#isi-token").html(obj.token);
                            notify_success(obj.pesan);
                            refresh_table();
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
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
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_token",
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

		$('#form-token-manual').submit(function(){
            $("#modal-proses").modal('show');
			var isi_token = $('#manual-token').val();
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/token_manual",
                    type:"POST",
                    data:$('#form-token-manual').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                            refresh_table();
							$("#isi-token").html(isi_token);
							$("#modal-token-manual").modal('hide');
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-manual').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-token').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
				  "responsive": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
    					{"bSearchable": false, "bSortable": false},
						{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false
         }); 
    });
</script>