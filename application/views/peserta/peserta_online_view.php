<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Status Online
		
	</h1>
	<ol class="breadcrumb">
	
		<li class="active">Status Peserta UJian Online</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="container-fluid">
            <div class="card bg-light">
                <div class="card-header with-border">
                    <div class="card-title"><h5>Pilih Opsi Peserta</h5></div>
                </div><!-- /.card-header -->

                <div class="card-body form-horizontal">
                <div class="row">
                    <div class="col-sm-6">
						<div class="form-group">
                            <label class="col-sm-3 control-label">Pilih Kelas</label>
                            <div class="col-sm-9">
                                <select name="group" id="group" class="form-control input-sm">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
								<p class="help-block">Pilih kelas peserta</p>
                            </div>
                        </div>
					</div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ruang Ujian</label>
                            <div class="col-sm-9">
                                <input name="keterangan" id="keterangan" class="form-control input-sm" autocomplete="off">
								<p class="help-block">Pilih peserta berdasarkan Ruang Peserta</p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
					<div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Rentang Waktu</label>
                            <div class="col-sm-9">
                                <input name="waktu" id="waktu" class="form-control input-sm" value="<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>" readonly >
								<p class="help-block">Rentang Waktu peserta memulai Ujian</p>
                            </div>
                        </div>
                    </div>
                   
           
					<div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <select name="status" id="status" class="form-control input-sm">
                                    <option value="semua">Semua</option>
									<option value="online">Online</option>
									<option value="offline">Offline</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="btn-kartu" class="btn btn-primary pull-right">Pilih</button>
                </div>
            </div>
        </div>
    </div>
	
    <div class="row">
    <div class="container-fluid">
                <div class="card">
                    <div class="card-header with-border">
                        <div class="card-title"><h5>Daftar Status Peserta</h5></div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <table id="table-peserta" class="table table-bordered table-hover table-sm">
                        <thead class="table table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th class="all">Nama</th>
                                    <th>Username</th>
                                    <th>Keterangan</th>
									<th class="all">Status</th>
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
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-peserta').dataTable().fnReloadAjax();
    }

    $(function(){
		$( document ).ready(function() {
			$('#waktu').daterangepicker({timePicker: true, timePickerIncrement: 10, format: 'YYYY-MM-DD H:mm'});
			
            $('#table-soal').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                  }
            });
		});
    });
</script>