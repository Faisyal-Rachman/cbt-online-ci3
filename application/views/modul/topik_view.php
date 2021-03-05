<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Bank Soal
		
	</h1>
</h1>
    <ol class="breadcrumb">
        
        <li class="active">Mapel dan Topik Soal</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
       
   <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                         <div class="col-md-6">
                        <div class="form-group">
                            <label>Mata Pelajaran <small>(Pilih mapel untuk <b>menampilkan dan menambahkan</b> topik)</small></b></label>
                            <div id="data-kelas">
                                <select name="modul" id="modul" class="form-control input-sm">
                                    <?php if(!empty($select_modul)){ echo $select_modul; } ?>
                                </select>
                            </div>
                        </div>
                    </div>  
                   	<div class="card-title"><a class="btn btn-primary btn-sm text-light" style="cursor: pointer;" onclick="tambah()">Tambah Topik</a></div>
    						<div class="card-tools pull-right">
    							<div class="dropdown pull-right">
                                <button type="button" id="btn-edit-hapus" class="btn btn-warning btn-sm" title="Hapus Topik yang dipilih">Hapus</button>
    							</div>
    						</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <?php echo form_open($url.'/hapus_daftar_topik','id="form-hapus"'); ?>
                        <input type="hidden" name="check" id="check" value="0">
                        <table id="table-topik" class="table table-bordered table-striped table-sm">
                        <thead class="table table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th class="all">Nama Topik</th>
                                    <th>Guru Pengampu</th>
                                    <th>Jml. Soal</th>
                                    <th>Status</th>
                                    <th class="all">Action</th>
                                    <th class="all"></th>
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
                        </form>                       
                    </div>
                   
                </div>
        </div>
    </div>

    <div class="modal" id="modal-tambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/tambah','id="form-tambah"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title">Tambah Topik Soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                          <div class="card-body">
                            <div id="form-pesan"></div>
                            <div class="form-group">
                                <label>Topik Soal</label>
                                <input type="hidden" name="tambah-modul-id" id="tambah-modul-id">
                                <input type="text" class="form-control" id="tambah-topik" name="tambah-topik" placeholder="Nama Topik">
                            </div>

                                 <div class="row">
      <div class="col-md-8"><div class="form-group">
                            <label class="control-label">Guru Pengampu</label>
                           
                            <select name="tambah-deskripsi" class="form-control" style="width: 100%!important">
                       
                        <?php foreach ($pengampu as $gp) : ?>
                            <option value="<?=$gp->guru_nama?>"><?=$gp->guru_nama?></option>
                        <?php endforeach; ?>
                    </select>
                          
                        </div></div>


     
      <div class="col-md-4"><div class="form-group">
                            <label class="control-label">Status</label>
                      <select name="tambah-status" class="form-control" style="width: 100%!important">
                        <option value="" disabled selected></option>
                         <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
          </select>
                          
                        </div></div>
    </div>
                       
                             </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Tambah</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/edit','id="form-edit"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title">Edit Topik Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                            <div id="form-pesan-edit"></div>
                            <div class="form-group">
                                <label>Nama Topik</label>
                                <input type="hidden" name="edit-id" id="edit-id">
								<input type="hidden" name="edit-modul-id" id="edit-modul-id">
                                <input type="hidden" name="edit-pilihan" id="edit-pilihan">
                                <input type="hidden" name="edit-topik-asli" id="edit-topik-asli">
                                <input type="text" class="form-control" id="edit-topik" name="edit-topik" placeholder="Nama Topik">
                            </div>
                            <div class="form-group">
                                <label>Guru Pengampu</label>
                                <input type="text" class="form-control" id="edit-deskripsi" name="edit-deskripsi" placeholder="Deskripsi Topik" >
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="edit-status" class="form-control" style="width: 100%!important">
                        <option value="" disabled selected></option>
                         <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
          </select>
                            </div>
                            <p>NB : Topik yang dihapus, maka semua bank soal akan ikut terhapus !</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-hapus" class="btn btn-default pull-left">Hapus</button>
                    <button type="button" id="edit-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Batal</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div class="modal" id="modal-hapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title">Hapus Topik Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                            <strong>Perhatian!</strong>
                            Data Topik yang sudah dipilih akan dihapus beserta isi soal didalamnya.
                            <br /><br />
                            Anda yakin ?
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
</section><!-- /.content -->



<script lang="javascript">
     function refresh_table(){
        $('#table-topik').dataTable().fnReloadAjax();
    }
    
$(document).on('click','.status_checks',function(){
    var status = ($(this).hasClass("btn-success btn-sm")) ? '0' : '1';
var msg = (status=='0')? 'Nonaktifkan' : 'Aktifkan';
if(confirm("Anda yakin topik di "+ msg)){
	var current_element = $(this);
	 url = "<?php echo base_url(); ?>index.php/manager/modul_topik/update",
	$.ajax({
	type:"POST",
	url: url,
	data: {id:$(current_element).attr('data'),status:status},
	success: function(data)
		{   
             refresh_table();
            notify_success('Status Topik di ' +msg);
			//location.reload();
		}
	});
	}      
    });

    function refresh_table(){
        $('#table-topik').dataTable().fnReloadAjax();
    }
    
    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-topik').val('');
        $('#tambah-modul-id').val('');
        $('#tambah-deskripsi').val('');

        $("#modal-tambah").modal("show");
        $('#tambah-topik').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-topik').val(data.topik);
                $('#edit-topik-asli').val(data.topik);
                $('#edit-deskripsi').val(data.deskripsi);
				$('#edit-modul-id').val('');
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
        $('#btn-edit-pilih').click(function(event) {
            if($('#check').val()==0) {
                $(':checkcard').each(function() {
                    this.checked = true;
                });
                $('#check').val('1');
            }else{
                $(':checkcard').each(function() {
                    this.checked = false;
                });
                $('#check').val('0');
            }
        });

        $("#modul").change(function(){
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
        $('#btn-edit-hapus').click(function(){
            $("#modal-hapus").modal('show');
        });
        $('#btn-hapus').click(function(){
            $("#form-hapus").submit();
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_topik",
                    type:"POST",
                    data:$('#form-hapus').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-hapus").modal('hide');
                           Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "info"
                    });
                            $('#check').val('0');
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

        $('#form-edit').submit(function(){
			$('#edit-modul-id').val($('#modul').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-edit").modal('hide');
                             Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "success"
                    });
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-edit').html(pesan_err(obj.pesan));
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
        $('#form-tambah').submit(function(){
            $('#tambah-modul-id').val($('#modul').val());
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
                              Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "success"
                    });
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-topik').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center"},
    					{"bSearchable": false, "bSortable": false, "className" : "text-center"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"140px"},
                       {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "modul", "value": $('#modul').val()} );
                  }
         });          
    });
</script>