<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <br> 
      
    </section>
   
    <section class="content">
        <div class="row">
        <?php echo form_open('unitujian/tes_kerjakan/simpan_jawaban','id="form-kerjakan"')?>
            <input type="hidden" name="tes-id" id="tes-id" value="<?php if(!empty($tes_id)){ echo $tes_id; } ?>">
            <input type="hidden" name="tes-user-id" id="tes-user-id" value="<?php if(!empty($tes_user_id)){ echo $tes_user_id; } ?>">
            <input type="hidden" name="tes-soal-id" id="tes-soal-id" value="<?php if(!empty($tes_soal_id)){ echo $tes_soal_id; } ?>">
            <input type="hidden" name="tes-soal-nomor" id="tes-soal-nomor"  value="<?php if(!empty($tes_soal_nomor)){ echo $tes_soal_nomor; } ?>">
            <input type="hidden" name="tes-soal-jml" id="tes-soal-jml" value="<?php if(!empty($tes_soal_jml)){ echo $tes_soal_jml; } ?>">
            <input type="hidden" name="tes-soal-ragu" id="tes-soal-ragu" value="<?php if(!empty($tes_ragu)){ echo $tes_ragu; } ?>">

<div class="container-fluid"> <!-- If Needed Left and Right Padding in 'md' and 'lg' screen means use container class -->
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                  <small> <b>Nama : <?php if(!empty($nama)){ echo $nama; } ?><br>Kelas : <?php if(!empty($group)){ echo $group; } ?></b></small>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                
                    <b> <div id="sisa-waktu" class="text-dark"></div></b>
                </div>
            </div>
        </div>

      <div class="container">  
        <div class="row">
                      
                    </div>
                   </div>

           <div class="card card-success card-solid">
                <div class="card-header with-border">
                    <h3 class="card-title">Soal <span id="judul-soal"></span></h3>
                    <div class="card-tools pull-right">
                       
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div id="isi-tes-soal" style="font-size: 15px;">
                        <?php if(!empty($tes_soal)){ echo $tes_soal; } ?>
                    </div>
                </div><!-- /.card-body -->
                <div class="card-footer">
                   &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
                  
                   
                     <div class="pull-right">
                    
                </div>
            </div><!-- /.card -->
        </form>
   
        </div>
        
        <div class="row">
        
            <div class="card card-success card-solid">
               
                <div class="card-body">
                    <?php if(!empty($tes_daftar_soal)){ echo $tes_daftar_soal; } ?>
                  
                </div><!-- /.card-body -->
                <div class="card-footer">
               
                </div>
            </div><!-- /.card -->
        </div>
    </section><!-- /.content -->
  
    <ons-dialog class="modal" style="max-height: 100%;overflow-y: auto;" id="modal-hentikan" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hentikan_tes','id="form-hentikan"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
          
                <div class="modal-body" >
                    <div class="row">
                        <div class="card-body">
                            <div id="form-pesan"></div>
                            <div class="callout callout-danger">
                                <p>APAKAH YAKIN MENGAKHIRI UJIAN ?                      
                                </p>
                                
                            </div>
                            <div class="form-group">
                            <label class="control-label col-md-4">NAMA TES</label>
                                <input type="hidden" name="hentikan-tes-id" id="hentikan-tes-id" >
                                <input type="hidden" name="hentikan-tes-user-id" id="hentikan-tes-user-id" >
                                <div class="col-md-8">
                                <input type="text" class="form-control" id="hentikan-tes-nama" name="hentikan-tes-nama" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="control-label col-md-4">KETARANGAN</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="hentikan-dijawab" name="hentikan-dijawab" readonly>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="checbox">
                                <label class="control-label col-md-4">HENTIKAN UJIAN</label>
                                    <div class="col-md-8">
                                    <input type="checkbox" id="hentikan-centang" name="hentikan-centang" value="1"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">YA AKHIRI</button>
                    <a href="#" class="btn btn-default" data-dismiss="modal">CLOSE</a>
                </div>
            </div>
        </div>

    </form>
    </ons-page>
    </ons-dialog>
    <ons-dialog class="modal fade" id="modal-hentikan2" style="max-height: 100%;overflow-y: auto;" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
   <div class="modal-dialog modal-notify " role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <?php echo form_open($url.'/hentikan_tes','id="form-hentikan2"'); ?>

<input type="hidden" name="hentikan-tes-id" id="hentikan-tes-id2" >
                                <input type="hidden" name="hentikan-tes-user-id" id="hentikan-tes-user-id2" >
                               
                                <input type="hidden" class="form-control" id="hentikan-tes-nama2" name="hentikan-tes-nama" readonly>


       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fa fa-exclamation-triangle fa-6x text-danger" aria-hidden="true"></i>
           <p>Waktu Anda Mengerjakan sudah Habis!</p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit" type="button" class="btn btn-success btn-lg btn-block">OKE</button>
       
       </div>
     </div>
     <!--/.Content-->
   </div>
 </ons-dialog>
    </div> 
    <ons-bottom-toolbar position="absolute">
      <ons-tabbar swipeable position="absolute">
   
      <button class="tabbar__button hide" id="btn-sebelumnya">
    <div class="tabbar__icon" page="sfgdfsdf" >
      <ons-icon icon="md-tag-more" size="30px" style="color:#4b3588;text-shadow: 1px 1px 1px #cccccc;"></ons-icon>
    </div>
    <div class="tabbar__label">KEMBALI</div>
    </button>
 
       <button class="tabbar__button" id="btn-selanjutnya">
    <div class="tabbar__icon">
      <ons-icon icon="md-google-play" size="30px" style="color:#4b3588;text-shadow: 1px 1px 1px #cccccc;"></ons-icon>
    </div>
    <div class="tabbar__label">SELANJUTNYA</div>
   </button>
  <button class="tabbar__button" id="btn-ragu" onclick="ragu()"><div class="tabbar__icon">
  <ons-icon icon="md-library" size="30px" style="color:#4b3588;text-shadow: 1px 1px 1px #cccccc;  name="btn-ragu-checkcard" id="btn-ragu-checkcard" <?php if(!empty($tes_ragu)){ echo "checked"; } ?>></ons-icon> 
  </div>
    <div class="tabbar__label">RAGU</div>
  
  </button>
      </ons-tabbar>
    </ons-bottom-toolbar>

    <script type="text/javascript">
 
    function zoombesar(){
        $('#isi-tes-soal').css("font-size", "140%");
        $('#isi-tes-soal').css("line-height", "140%");
    }

    function zoomnormal(){
        $('#isi-tes-soal').css("font-size", "15px");
        $('#isi-tes-soal').css("line-height", "110%");
    }

    function ragu(){
        $("#modal-proses").modal('show');

        $.ajax({
            url:'<?php echo site_url().''.$url; ?>/get_tes_soal_by_tessoal/'+$('#tes-soal-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    // Mengubah nilai ragu-ragu di database
                    if($('#tes-soal-ragu').val()==0){
                        var ragu=1;
                    }else{
                        var ragu=0;
                    }
                    $.ajax({
                            url:'<?php echo site_url().''.$url; ?>/update_tes_soal_ragu/'+$('#tes-soal-id').val()+''+ragu,
                            type:"POST",
                            cache: false,
                            timeout: 5000,
                            success:function(respon){
                                var data = $.parseJSON(respon);
                                if(data.data==1){
                                    notify_success('Jawaban Ragu-ragu berhasil diubah');
                                }
                            },
                            error: function(xmlhttprequest, textstatus, message) {
                                if(textstatus==="timeout") {
                                    $("#modal-proses").modal('hide');
                                    notify_error("Gagal mengubah Soal, Silahkan Refresh Halaman");
                                }else{
                                    $("#modal-proses").modal('hide');
                                    notify_error(textstatus);
                                }
                            }
                    });

                    // Mengubah warna daftar soal dan checkbox pada tombol ragu-ragu
                    if(data.tessoal_dikerjakan==1){
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-primary');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-primary');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }else{
                        if($('#tes-soal-ragu').val()==0){
                            // Membuat menjadi ragu-ragu
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-default');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-warning');
                            $('#btn-ragu-checkbox').prop("checked", true);
                            $('#tes-soal-ragu').val(1);
                        }else{
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).removeClass('btn-warning');
                            $('#btn-soal-'+$('#tes-soal-nomor').val()).addClass('btn-default');
                            $('#btn-ragu-checkbox').prop("checked", false);
                            $('#tes-soal-ragu').val(0);
                        }
                    }
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengubah soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function soal(tessoal_id){
        $("#modal-proses").modal('show');
        $.ajax({
            url:'<?php echo site_url().''.$url; ?>/get_soal_by_tessoal/'+tessoal_id+'/'+$('#tes-user-id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(respon){
                var data = $.parseJSON(respon);
                if(data.data==1){
                    $('#tes-soal-id').val(data.tes_soal_id);
                    $('#tes-soal-nomor').val(data.tes_soal_nomor);
                    $('#isi-tes-soal').html(data.tes_soal);
                    $('#tes-soal-ragu').val(data.tes_ragu);
                    $('#judul-soal').html('ke '+data.tes_soal_nomor);

                    if(data.tes_ragu==0){
                        // Menghilangkan checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", false);
                    }else{
                        // Menambah checkbox ragu-ragu
                        $('#btn-ragu-checkbox').prop("checked", true);
                    }

                    // menghilangkan tombol sebelum jika soal di nomor1
                    // dan menghilangkan tombol selanjutnya jika disoal terakhir
                    var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
                    var tes_soal_jml = parseInt($('#tes-soal-jml').val());
                    var tes_soal_tujuan = data.tes_soal_nomor;
                    if(tes_soal_tujuan==1){
                        $('#btn-sebelumnya').addClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }else if(tes_soal_tujuan==tes_soal_jml){
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').addClass('hide');
                    }else{
                        $('#btn-sebelumnya').removeClass('hide');
                        $('#btn-selanjutnya').removeClass('hide');
                    }

                }else if(data.data==2){
                    window.location.reload();
                }
                $("#modal-proses").modal('hide');
            },
            error: function(xmlhttprequest, textstatus, message) {
                if(textstatus==="timeout") {
                    $("#modal-proses").modal('hide');
                    notify_error("Gagal mengambil Soal, Silahkan Refresh Halaman");
                }else{
                    $("#modal-proses").modal('hide');
                    notify_error(textstatus);
                }
            }
        });
    }

    function audio(status){
        var audio_player_status = $('#audio-player-status').val();
        var audio_player_update = $('#audio-player-update').val();
        if(status==1){
            if(audio_player_update==0){
                $('#audio-player-update').val('1');
                /**
                 * Update status audio jika pemutaran audio dibatasi
                 */
                $.getJSON('<?php echo site_url().''.$url; ?>/update_status_audio/'+$('#tes-soal-id').val(), function(data){
                    if(data.data==1){
                        notify_success(data.pesan);
                    }
                });
            }
        }
        
        if(audio_player_status==0){
            $('#audio-player-status').val('1');
            $('#audio-player').trigger('play');
            $('#audio-player-judul').html('Pause');
            $('#audio-player-judul-logo').removeClass('fa-play');
            $('#audio-player-judul-logo').addClass('fa-pause');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player').trigger('pause');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function audio_ended(status){
        if(status==1){
            $('#audio-control').addClass('hide');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function jawab(){
        $('#form-kerjakan').submit();
    }

    function hentikan_tes(){
        $("#modal-proses").modal('show');
        $('#hentikan-centang').prop("checked", false);
        $.getJSON('<?php echo site_url().''.$url; ?>/get_tes_info/'+$('#tes-id').val(), function(data){
            if(data.data==1){
                $('#hentikan-tes-id').val(data.tes_id);
                $('#hentikan-tes-user-id').val(data.tes_user_id);
                $('#hentikan-tes-nama').val(data.tes_nama);
                $('#hentikan-tes-id2').val(data.tes_id);
                $('#hentikan-tes-user-id2').val(data.tes_user_id);
                $('#hentikan-tes-nama2').val(data.tes_nama);
                $('#hentikan-dijawab').val(data.tes_dijawab+" dijawab. "+data.tes_blum_dijawab+" belum dijawab.");
                $('#hentikan-belum-dijawab').val(data.tes_blum_dijawab);

                
                $("#modal-hentikan").modal('show');
                $('#modal-hentikan').appendTo("body") 
            }else{
                window.location.reload();
            }
            $("#modal-proses").modal('hide');
        });
    }
function hentikan_tes2(){
        $("#modal-proses").modal('show');
        $('#hentikan-centang').prop("checked", false);
        $.getJSON('<?php echo site_url().''.$url; ?>/get_tes_info/'+$('#tes-id').val(), function(data){
            if(data.data==1){
                $('#hentikan-tes-id').val(data.tes_id);
                $('#hentikan-tes-user-id').val(data.tes_user_id);
                $('#hentikan-tes-nama').val(data.tes_nama);
                $('#hentikan-tes-id2').val(data.tes_id);
                $('#hentikan-tes-user-id2').val(data.tes_user_id);
                $('#hentikan-tes-nama2').val(data.tes_nama);
                $('#hentikan-dijawab').val(data.tes_dijawab+" dijawab. "+data.tes_blum_dijawab+" belum dijawab.");
                $('#hentikan-belum-dijawab').val(data.tes_blum_dijawab);

                $("#modal-hentikan2").appendTo("body").modal("show");
               
            }else{
                window.location.reload();
            }
            $("#modal-proses").modal('hide');
        });
    }
   
    function soal_navigasi(navigasi){
        var tes_soal_nomor = parseInt($('#tes-soal-nomor').val());
        var tes_soal_jml = parseInt($('#tes-soal-jml').val());
        var tes_soal_tujuan = tes_soal_nomor+navigasi;

        if((tes_soal_tujuan>=1 && tes_soal_tujuan<=tes_soal_jml)){
            $('#btn-soal-'+tes_soal_tujuan).trigger('click');
        }
    }

    $(function () {
        var sisa_detik = <?php if(!empty($detik_sisa)){ echo $detik_sisa; } ?>;
        setInterval(function() {
            var sisa_menit = Math.round(sisa_detik/60);
            sisa_detik = sisa_detik-1;
            $("#sisa-waktu").html("Sisa Waktu : "+sisa_menit+" Menit");

            if(sisa_detik<1){
              //  window.location.reload();
            }
        }, 1000);

        $('#btn-sebelumnya').click(function(){
            soal_navigasi(-1);
        });

        $('#btn-selanjutnya').click(function(){
            soal_navigasi(1);
        });

        $('#btn-hentikan').click(function(){
            hentikan_tes();
        });
        /**
         * Submit form soal saat sudah menjawab
         */
        $('#form-kerjakan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/simpan_jawaban",
                    type:"POST",
                    data:$('#form-kerjakan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);

                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                           $('#btn-soal-'+obj.nomor_soal).removeClass('btn-default');
                           $('#btn-soal-'+obj.nomor_soal).removeClass('btn-warning');
                           $('#btn-soal-'+obj.nomor_soal).addClass('btn-primary');
                             $('#bjb'+obj.nomor_soal).html(obj.jwbn);

                        }else if(obj.status==2){
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyimpan jawaban, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        /**
         * Submit form hentikan tes
         */
        $('#form-hentikan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/hentikan_tes",
                    type:"POST",
                    data:$('#form-hentikan').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menghentikan Tes, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });
 $('#form-hentikan2').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/hentikan_tes",
                    type:"POST",
                    data:$('#form-hentikan2').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            window.location.reload();
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menghentikan Tes, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });
        $( document ).ready(function() {
            
        });
    });
    $(document).ready(function(){
function update_user_activity(){
       var active_time='update_time';
           $.ajax({
            url:'<?php echo base_url(); ?>index.php/tes_kerjakan/index/<?php $tes_id; ?>',
                method:"POST",
                data:{active_time:active_time},
                success:function(data){
                 console.log(data)
                   }
                   });
                 }
              setInterval(function(){
               update_user_activity()
                 },3000);

});
    var sisa_detik3 = <?php if(!empty($tes_waktu)){ echo $tes_waktu; } ?>;
    var btnsls = <?php if(!empty($btnselesai)){ echo $btnselesai; } ?>;
    var sisa_menit2 = sisa_detik3 * 60000;
    var sisa_menit3 = (sisa_detik3 * 60000) - (60000 * btnsls);
         
            $("#sisa-waktu").html("Sisa Waktu : "+sisa_menit2+" Menit");

    setTimeout(function() {
 
             hentikan_tes2()  
           
     }, +sisa_menit2);
     setTimeout(function() {
  // var sisa_menit3 = Math.round(sisa_detik3/60);
             
    $("#btn-hentikan").show();
           
     }, +sisa_menit3);
</script>

