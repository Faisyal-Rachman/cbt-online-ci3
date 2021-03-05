<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
   Absensi Ujian
	
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
                         

  <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Pilih detail Ujian</label>
                            <div id="judul"></div>
                            <select name="pilih-tes" class="form-control" id="pilih-tes" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($nama_ujian as $m) : ?>

                            <option value="<?=$m->tes_id?>"><?=$m->tes_nama?> - <?=$m->tes_detail?> - <?=$m->tes_ruang?> (Mapel <?=$m->modul_nama?>)</option>
                        <?php endforeach; ?>
                    </select>
                            </div>
                            </div>

                        
                        </div>
                    </div>
                   
                </div></div>
                <div class="card-footer">
                    <button type="button" id="btn-pilih" class="btn btn-primary pull-right"><span>Ambil data</span></button>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
    <div class="container-fluid">
        <?php echo form_open($url.'/edit_tes','id="form-edit"'); ?>
        <div class="container-fluid">
			<div class="card">
				<div class="card-header with-border"><div class="card-title"><b># Data absensi</b> <span id="judul-daftar-soal"></span></div>
				   <div class="card-tools pull-right">
                        <div class="dropdown pull-right">
                            <a class="btn btn-success btn-sm text-white" style="cursor: pointer;" onclick="export_excel()">Export PDF</a>
                          
                        </div>
                    </div>
				</div><!-- /.card-header -->

                <div class="card-body">
                    <input type="hidden" name="edit-pilihan" id="edit-pilihan">
					<table id="table-hasil" class="table table-bordered table-hover table-sm">
                    <thead class="table table-primary" align="center">
                            <tr>
                                <th class="all">No.</th>
                                <th>No. Ujian</th>
                                <th>Nama Peserta</th>
                               
                                <th class="all">Tanda Tangan</th>
                                <th>Keterangan</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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

       

        </form>
    </div> </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-hasil').dataTable().fnReloadAjax();
    }
$("#pilih-tes").change(function(){
            refresh_topik();
              });
function refresh_topik(){
        var judul = $('#pilih-tes option:selected').text();
        $('#judul-daftar-soal').html(judul);
      }
    function detail_tes(tesuser_id){
        window.open("<?php echo site_url().'/manager/tes_hasil_detail'; ?>/index/"+tesuser_id);
    }

    function export_excel(){
        var tes = $('#pilih-tes').val();
        var group = $('#pilih-group').val();
        var waktu = $('#pilih-rentang-waktu').val();
      //  var urutkan = $('#pilih-urutkan').val();
	//	var status = $('#pilih-status').val();
		//var keterangan = $('#pilih-keterangan').val();

        window.open("<?php echo site_url().''.$url; ?>/export/"+group+"/"+tes+"/"+waktu, "_blank");
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
                  "iDisplayLength":50,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "className" : "text-center","sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "className" : "text-center","sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center"},
    				    {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"100px"}],
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