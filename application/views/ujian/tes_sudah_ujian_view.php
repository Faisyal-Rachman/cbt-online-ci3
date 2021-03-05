<!-- Content Header (Page header) -->
  <section class="content">
       <br><br>
      
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="card-body">
            <?php 
            foreach($sdhujian as $stujian){
                  ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                
              <?php
$tg = strtotime($stujian->tesuser_creation_time);
              $tgl = date('d M Y h:i:s', $tg);
               echo 'Mengerjakan ujian pada tanggal '.$tgl ?>
                         
                      

                <p><h5><?= $stujian->tes_jenis ?></h5></p>
              </div>
              <div class="icon">
              <i class="fa fa-book" aria-hidden="true"></i>
              </div>
              <a href="#" class="small-box-footer"><?= $stujian->tes_duration_time ?> Menit</a>
            </div>
          </div>
           <?php 
                }?>
         </div>
        </div>
        </div></section>
        