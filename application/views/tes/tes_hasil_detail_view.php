<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Tes Detail
		
	</h1>
	<ol class="breadcrumb">
		
		<li class="active">Hasil Tes Detail <?php if(!empty($user_nama)){ echo $user_nama; } ?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="container-fluid">
            <div class="card">
                <div class="card-header with-border">
                    <div class="card-title">Informasi</div>
                </div><!-- /.card-header -->

                <div class="card-body form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama Tes</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="tes-user-id" id="tes-user-id" value="<?php if(!empty($tes_user_id)){ echo $tes_user_id; } ?>">
                                <input type="text" name="tes-nama" id="tes-nama" class="form-control input-sm" value="<?php if(!empty($tes_nama)){ echo $tes_nama; } ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Nomor Perserta</label>
                            <div class="col-sm-9">
                                <input type="text" name="user-nama" id="user-nama" class="form-control input-sm" value="<?php if(!empty($user_nama)){ echo $user_nama; } ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Waktu Tes Mulai</label>
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
                        <div class="form-group">
                            <div class="col-sm-9">
<?php
if($nilai < $statuspg){
    echo ' 
    <div class="info-box bg-danger">
      <span class="info-box-icon"><i class="fas fa-book"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Nilai di bawah Passing grade '.$statuspg.'</span>
        <span class="info-box-number">Belum berhasil !</span>

        <div class="progress">
          <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
        '.$ket.'
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  ';
}elseif($nilai >= $statuspg){
    echo ' <div class="info-box bg-gradient-success">
    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Nilai dalam Passing grade '.$statuspg.'</span>
      <span class="info-box-number">Berhasil !</span>

      <div class="progress">
        <div class="progress-bar" style="width: 70%"></div>
      </div>
      <span class="progress-description">
      '.$ket.'
      </span>
    </div>
    <!-- /.info-box-content -->
  </div>';
}else{
echo'   <div class="info-box bg-gradient-warning">
<span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

<div class="info-box-content">
  <span class="info-box-text">Nilai belum update</span>
  <span class="info-box-number">Belum update !</span>

  <div class="progress">
    <div class="progress-bar" style="width: 70%"></div>
  </div>
  <span class="progress-description">
  Belum update !
  </span>
</div>
<!-- /.info-box-content -->
</div>';
}
?>
                        
                                          </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
    <div class="container-fluid">
                <div class="card">
                    <div class="card-header with-border">
    					<div class="card-title">Soal dan Jawaban</div>
                        <div class="card-tools pull-right">
                            <a  class="btn btn-block btn-outline-info btn-flat" href="#" onclick="refresh_table()">Refresh</span></a>
                        </div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <table id="table-soal" class="table table-bordered table-sm">
                        <thead class="table table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Tipe Soal</th>
                                    <th>Soal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
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
        $('#table-soal').dataTable().fnReloadAjax();
    }

    $(function(){
        $('#table-soal').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"80px"},
    					{"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes_user_id", "value": $('#tes-user-id').val()} );
                  }
         });
		 
		$( document ).ready(function() {
			
		});
    });
</script>