<!-- Content Header (Page header) -->

<!-- Main content -->


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <?php if(!empty($site_name)){ echo $site_name; } ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><script type='text/javascript'>

var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];

var date = new Date();

var day = date.getDate();

var month = date.getMonth();

var thisDay = date.getDay(),

    thisDay = myDays[thisDay];

var yy = date.getYear();

var year = (yy < 1000) ? yy + 1900 : yy;

document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);

</script>
</li>
              <li class="breadcrumb-item active">
            <font style="color:blue; font-size:20px;font-family:courier new;font-weight:bold"><span id="span"></span></font>
          </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                <?php foreach ($siswa->result_array() as $gp) : ?>
                           <?=$gp['hasil']?>
                        <?php endforeach; ?>
                       </h3>

                <p>Jumlah Siswa</p>
              </div>
              <div class="icon">
              <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/manager/peserta_daftar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>
                <?php foreach ($soal->result_array() as $gp) : ?>
                           <?=$gp['hasil']?>
                        <?php endforeach; ?>
                       </h3>

                <p>Jumlah Soal</p>
              </div>
              <div class="icon">
              <i class="fa fa-edit" aria-hidden="true"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/manager/modul_daftar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3> <?php foreach ($kelas->result_array() as $gp) : ?>
                           <?=$gp['hasil']?>
                        <?php endforeach; ?>
                       </h3>
                      </h3>

                <p>Jumlah Kelas</p>
              </div>
              <div class="icon">
              <i class="fa fa-suitcase" aria-hidden="true"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/manager/data_kelas" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h3> <?php foreach ($topiksoal->result_array() as $gp) : ?>
                           <?=$gp['hasil']?>
                        <?php endforeach; ?>
                       </h3>

                <p>Topik Soal</p>
              </div>
              <div class="icon">
              <i class="fa fa-newspaper" aria-hidden="true"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/manager/modul_topik" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3> <?php foreach ($token->result_array() as $gp) : ?>
                           <?=$gp['hasil']?>
                          <small>Token</small>
                       </h3>

                <p><b><?=$gp['token_ts']?></b></p>
                <?php endforeach; ?>
              </div>
              <div class="icon">
              <i class="fa fa-key" aria-hidden="true"></i>
              </div>
              <a href="<?php echo base_url(); ?>index.php/manager/tes_token" class="small-box-footer">Semua info Token <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        
        <div class="row">

               
         <div class="col-lg-12">
         <div class="card card-info">
         <div class="card-header">
                <h3 class="text-center"> <i class="fa fa-history" aria-hidden="true"></i>  Ujian Aktif </h3>
              </div>
         <div class="col-sm-12">
            <!-- small box -->
          <p></p>
             
              <div id="status_ujian" class="panel-body">

</div>
            
              <div class="icon">
              </div>
              
            
          </div>  </div>
          <div class="col-sm-12">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3>
                
                       </h3>

                       <div id="rangking" class="panel-body">

</div>
              </div>
              <div class="icon">
             
              </div>
               </div>
            </div>
          
          
          </div>
          <!-- ./col -->
          <div class="col-lg-4">
            <!-- small box -->
   

          </div>
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
      <div class="modal" id="modal-proses" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div style="text-align: center;">
              <img width="50" src="<?php echo base_url(); ?>public/images/loading.gif" /> <br />Data Sedang diproses...              
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="myModal" class="modal hide fade in" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
           
            <div class="card card-primary">
           
              <div class="card-body">
              <div id="user_status" class="panel-body">

</div>

            
              <!-- /.card-body -->
   
            
          
            <button onclick="myStopFunction()" class="btn btn-primary float-right">Tutup</button>
            </div>
            </div>   
        </div>
        </div>
   
    </div>
      <script type="text/javascript">
         
     function gtes(id){


  var active_ujian='fetch_data';

           $.ajax({
            url:'<?php echo site_url(); ?>manager/dashboard/get_by_id/'+id,
                method:"POST",
                data:{active_ujian:active_ujian},
                success:function(data){
   $('#kolom-stat').removeClass('hide');
   $('#stat').html(data);
  
   
  }
 });


      
    }
var id = {};
function tes(id)
{

/*
 var active_fetch='fetch_data';

       $.ajax({
         url:'<?php echo site_url(); ?>manager/dashboard/status/'+id,
                method:"POST",
                data:{active_fetch:active_fetch},
                success:function(data){


   $('#user_status').html(data);
    $('#user_stat').html(data.cek);
 // $('#kolom-stat').removeClass('hide');

  }
 });
*/

}

function fetch_ujian()
{
  var active_ujian='fetch_data';

           $.ajax({
            url:'<?php echo base_url(); ?>index.php/manager/dashboard/statusujian',
                method:"POST",
                data:{active_ujian:active_ujian},
                success:function(data){
  $('#status_ujian').html(data);
   $('#load').html(data);
  
   
  }
 });
}
fetch_ujian();
 setInterval(function(){
        fetch_ujian();
}, 3000);

function fetch_rank()
{
  var active_rank='fetch_data';

           $.ajax({
            url:'<?php echo base_url(); ?>index.php/manager/dashboard/rank',
                method:"POST",
                data:{active_rank:active_rank},
                success:function(data){
  
   $('#rangking').html(data);
  
   
  }
 });
}
fetch_rank();
 setInterval(function(){
  fetch_rank();
}, 3000);

var span = document.getElementById('span');

function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = h + ":" + m + ":" + s;
}
</script>
<script type="text/javascript">
setInterval(time, 1000);
    $(function () {
        $('#username').focus();   
        
        $('#btn-login').click(function(){
            $('#form-login').submit();
        });
        
        $('#form-login').submit(function(){
            $("#modal-proses").modal('show');
                $.ajax({
                    url:"<?php echo site_url(); ?>manager/welcome/login",
              type:"POST",
              data:$('#form-login').serialize(),
              cache: false,
                  success:function(respon){
                  var obj = $.parseJSON(respon);
                      if(obj.status==1){
                          window.open("<?php echo site_url(); ?>manager/dashboard","_self");
                      }else{
                            $('#form-pesan').html(pesan_err(obj.error));
                            $("#modal-proses").modal('hide');
                      }
              }
          });
            
          return false;
        });    
    });

    var id;
function move(ids) {
    $('#myModal').modal('show'); 
  id = setInterval(frame, 1000);
  var value = ids;
  function frame() {
    var active_fetch='fetch_data';
    $.ajax({
  url:'<?php echo site_url(); ?>manager/dashboard/status/'+value,
         method:"POST",
         data:{active_fetch:active_fetch},
         success:function(data){

$('#user_status').html(data);
$('#user_stat').html(data.cek);
}
});
  }
}
function myStopFunction() {
    $('#myModal').modal('hide'); 
  clearInterval(id);
}
</script>

