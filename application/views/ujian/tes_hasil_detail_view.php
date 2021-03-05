<div class="container">
	<!-- Content Header (Page header) -->
	<br><br>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			 <div class="container-fluid">
				<div class="card">
				
					<div class="card-body form-horizontal">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Tes</label>
								<div class="col-sm-9">
									<input type="hidden" name="tes-user-id" id="tes-user-id" value="<?php if(!empty($tes_user_id)){ echo $tes_user_id; } ?>">
									<input type="text" name="tes-nama" id="tes-nama" class="form-control input-sm" value="<?php if(!empty($tes_nama)){ echo $tes_nama; } ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama User</label>
								<div class="col-sm-9">
									<input type="text" name="user-nama" id="user-nama" class="form-control input-sm" value="<?php if(!empty($user_nama)){ echo $user_nama; } ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Waktu Tes Mulai</label>
								<div class="col-sm-9">
									<input type="text" name="tes-mulai" id="tes-mulai" class="form-control input-sm" value="<?php if(!empty($tes_mulai)){ echo $tes_mulai; } ?>" readonly>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Nilai</label>
								<div class="col-sm-9">
									<input type="text" name="tes-nilai" id="tes-nilai" class="form-control input-sm" value="<?php if(!empty($nilai)){ echo $nilai; } ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Benar</label>
								<div class="col-sm-9">
									<input type="text" name="tes-benar" id="tes-benar" class="form-control input-sm" value="<?php if(!empty($benar)){ echo $benar; } ?>" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer with-border">
						<a href="<?php echo site_url().'/tes_dashboard'; ?>" class="btn btn-primary">Kembali</a>
					</div><!-- /.card-header -->
				</div>
			</div>
		</div>
		<div class="row">
			 <div class="container-fluid">
					<div class="card">
						<div class="card-header with-border">
							<div class="card-title">Soal dan Jawaban</div>
							<div class="card-tools pull-right">
								<a href="#" onclick="refresh_table()">Refresh Detail Tes</span></a>
							</div>
						</div><!-- /.card-header -->

						<div class="card-body">
							<table id="table-soal" class="table borderless table-sm">
								
								<tbody>
									<tr>
										
										
										<td> </td>
									</tr>
								</tbody>
							</table>                        
						</div>
					</div>
			</div>
		</div>

	</section><!-- /.content -->
</div>



<script lang="javascript">
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
    }

    $(function(){
        $('#table-soal').DataTable({
                 "paging": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "info": false,
                  "ordering": false,
                  "aoColumns": [
    					
    					{"bSearchable": false, "bSortable": false, "sWidth":"150px"},
    					{"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes_user_id", "value": $('#tes-user-id').val()} );
                  }
         });
		 
		$( document ).ready(function() {
			refresh_topik();
		});
    });
</script>