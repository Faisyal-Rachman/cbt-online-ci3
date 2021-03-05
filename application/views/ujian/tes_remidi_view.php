<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
  Peserta Remidi 
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="container-fluid">
            <div class="card">
              
                <div class="card-body form-horizontal">
                <div class="row">
                    <div class="col-sm-6">
				
                      
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Waktu Ujian</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" name="pilih-rentang-waktu" id="pilih-rentang-waktu" class="form-control input-sm" value="<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>" readonly />
                                </div>
								<span class="help-block" id="info-waktu">Rentang waktu</span>
                            </div>
                            
                        </div>  <button type="button" id="btn-pilih" class="btn btn-primary pull-right"><span>Pilih</span></button>
                    </div>
                  
                </div></div>
               
            </div>
        </div>
    </div>
	<div class="row">
    <div class="container-fluid">
        <?php echo form_open($url.'/edit_tes','id="form-edit"'); ?>
        <div class="container-fluid">
			<div class="card">
				<div class="card-header with-border">
				   <div class="card-tools pull-right">
                        <div class="dropdown pull-right">
                            <a class="btn btn-outline-warning btn-sm" style="cursor: pointer;" onclick="export_excel()">Export ke Excel</a>
                        </div>
                    </div>
				</div><!-- /.card-header -->

                <div class="card-body">
                    <input type="hidden" name="edit-pilihan" id="edit-pilihan">
					<table id="table-hasil" class="table table-bordered table-hover table-sm">
                    <thead class="table table-primary">
                            <tr>
                                <th class="all">No.</th>
                                <th>Waktu Ujian</th>
                                <th>Ujian</th>
                                <th>Kelas</th>
                                <th class="all">Nama</th>
                                <th class="all">Passing Grade</th>
                                <th>Nilai</th>
                                <th>Status</th>
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
                                <td> </td>
                            </tr>
                        </tbody>
					</table>                        
				</div>
               
			</div>
        </div>

        <div class="modal" id="modal-waktu" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                        <div id="trx-judul">Tambah Waktu</div>
                    </div>
                    <div class="modal-body">
                        <div class="row-fluid">
                            <div class="card-body">
                                <div id="form-pesan-waktu"></div>
                                <div class="form-group">
                                    <label>Jumlah Waktu</label>
                                    <input type="text" class="form-control" id="waktu-menit" name="waktu-menit" value="10">
                                    <p class="help-block">Waktu dalam satuan MENIT</p>
                                </div>
                                <p class="">Menambah Waktu Tes melalui Penambahan "Waktu Mulai" pada user tes yang sudah dicentang sebelumnya.</p>
                                <p class="">Waktu Mulai pengerjaan Tes hasil penambahan tidak boleh melebihi waktu saat ini.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-edit-waktu-simpan" class="btn btn-primary">Simpan</button>
                        <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div> </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-hasil').dataTable().fnReloadAjax();
    }

    function detail_tes(tesuser_id){
        window.open("<?php echo site_url().'/manager/tes_hasil_detail'; ?>/index/"+tesuser_id);
    }

    function export_excel(){
        var tes = $('#pilih-tes').val();
        var group = $('#pilih-group').val();
        var waktu = $('#pilih-rentang-waktu').val();
        var urutkan = $('#pilih-urutkan').val();
		var status = $('#pilih-status').val();
		var keterangan = $('#pilih-keterangan').val();

        window.open("<?php echo site_url().'/'.$url; ?>/export/"+tes+"/"+group+"/"+waktu+"/"+urutkan+"/"+status+"/"+keterangan, "_self");
    }

    $(function(){
        $('#pilih-rentang-waktu').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD H:mm'});

		$("#pilih-status").change(function(){
            if($('#pilih-status').val()=='mengerjakan'){
				$('#info-waktu').html('Rentang waktu peserta saat memulai Tes');
			}else{
				$('#info-waktu').html('Rentang waktu Tes dilaksanakan sesuai di Daftar Tes');
			}
        });
		
        $('#btn-pilih').click(function(){
            $("#modal-proses").modal('show');
            $('#check').val('0');
            refresh_table();
            $("#modal-proses").modal('hide');
        });

        $('#btn-edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });

        $('#btn-edit-hentikan').click(function(){
           $('#edit-pilihan').val('hentikan');
            $('#form-edit').submit(); 
        });

        $('#btn-edit-buka-tes').click(function(){
            $('#edit-pilihan').val('buka');
            $('#form-edit').submit();
        });

        $('#btn-edit-waktu').click(function(){
            $('#edit-pilihan').val('waktu');
            $('#waktu-menit').val('10');
            $("#modal-waktu").modal('show');
        });

        $('#btn-edit-waktu-simpan').click(function(){
            $('#form-edit').submit();
        });

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

        $('#form-edit').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit_tes",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-waktu").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

        $('#table-hasil').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
    				    {"bSearchable": false, "bSortable": false, "sWidth":"100px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "aLengthMenu": [[10, 25, 50, 100, 200, 500], [10, 25, 50, 100, 200, 500]],
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes", "value": $('#pilih-tes').val()} );
                    aoData.push( { "name": "group", "value": $('#pilih-group').val()} );
                    aoData.push( { "name": "waktu", "value": $('#pilih-rentang-waktu').val()} );
                    aoData.push( { "name": "urutkan", "value": $('#pilih-urutkan').val()} );
					aoData.push( { "name": "status", "value": $('#pilih-status').val()} );
					aoData.push( { "name": "keterangan", "value": $('#pilih-keterangan').val()} );
                  }
         });          
    });
</script>