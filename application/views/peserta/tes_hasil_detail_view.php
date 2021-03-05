<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Detail Hasil UJian Peserta		
	</h1>
	<ol class="breadcrumb">
		
		<li class="active"><b><?php if(!empty($user_birthdate)){ echo $user_birthdate; } ?> / <?php if(!empty($user_nama)){ echo $user_nama; } ?> / <?php if(!empty($tes_nama)){ echo $tes_nama; } ?>  
        / <?php if(!empty($tes_mulai)){ echo $tes_mulai; } ?>  </b></li>
	
        <?php
if($hasilujian < $statuspg){
    echo ' 
    <div class="info-box bg-danger">
      <span class="info-box-icon"><i class="fas fa-book"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Nilai di bawah Passing grade '.$statuspg.'</span>
        <span class="info-box-number">Belum berhasil !</span>

        <div class="progress">
          <div class="progress-bar" style="width: 50%"></div>
        </div>
        <span class="progress-description">
        '.$nilai.'
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  ';
}elseif($hasilujian >= $statuspg){
    echo ' <div class="info-box bg-gradient-success">
    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Nilai dalam Passing grade '.$statuspg.'</span>
      <span class="info-box-number">Berhasil !</span>

      <div class="progress">
        <div class="progress-bar" style="width: 80%"></div>
      </div>
      <span class="progress-description">
      '.$nilai.'
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
?></ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
    <div class="form-group">
                          
                            <div class="col-sm-9">
                                <input type="hidden" name="tes-user-id" id="tes-user-id" value="<?php if(!empty($tes_user_id)){ echo $tes_user_id; } ?>">
                                       </div>
                        </div>
    <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
    					

                    <div class="card-body">
                        <table id="table-soal" class="table borderless table-sm" cellpadding="1" cellspacing="1">
                       
                            <tbody>
                               
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
                 "paging": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "info": false,
                  "ordering": false,
                  "aoColumns": [
    					
    					{"bSearchable": false, "bSortable": false, "sWidth":"80px"},
    					{"bSearchable": false, "bSortable": false,  "sWidth":"300px"}],
                  "sAjaxSource": "<?php echo site_url().''.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes_user_id", "value": $('#tes-user-id').val()} );
                  }
         });
		 
		$( document ).ready(function() {
			
		});
    });
</script>