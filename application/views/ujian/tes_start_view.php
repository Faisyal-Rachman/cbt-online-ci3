<div class="container">
	<!-- Content Header (Page header) -->
    <br><br>
	<!-- Main content -->
    <section class="content">
        <?php echo form_open('unitujian/'.$url.'/mulai_tes','id="form-konfirmasi-tes" class="form-horizontal"'); ?>
        <div class="card border-primary">
            <div class="card-header with-border">
                <h3 class="card-title text-center"><b>INFORMASI UJIAN</b></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="card-body no-padding">
                    <div id="form-pesan"></div>
                    <input type="hidden" name="tes-id" id="tes-id" value="<?php if(!empty($tes_id)){ echo $tes_id; } ?>">
                    <table class="table table-striped table-hover table-light">
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Nama : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($namaasli)){ echo $namaasli; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right; width:100px">Ujian : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($tes_nama)){ echo $tes_nama; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Soal : </td>
                            <td style="vertical-align: middle;"><?php if(!empty($jml)){ echo $jml; } ?> Pertanyaan</td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;text-align: right;">Waktu : </td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($tes_waktu)){ echo $tes_waktu; } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 45px;">
                            <td></td>
                            <td style="vertical-align: middle;text-align: right;"><b>Poin Dasar : </b></td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($tes_poin)){ echo number_format($tes_poin); } ?></b></td>
                            <td></td>
                        </tr>
                        <tr style="height: 46px;">
                            <td></td>
                            <td style="vertical-align: middle;text-align: right;"><b>Passing Grade : </b></td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($tes_kkm)){ echo number_format($tes_kkm); } ?></b></td>
                            <td style="vertical-align: middle;"><b><?php if(!empty($id)){ echo $id; } ?></b></td>
                            
                            <td></td>
                        </tr>
                        <?php if(!empty($tes_token)){ echo $tes_token; } ?>
                  </table>
            </div><!-- /.card-body -->
            
        </div><!-- /.card -->
        </ons-page>
        <ons-bottom-toolbar position="absolute">
      <ons-tabbar swipeable position="absolute">
   
   
 
       <button class="tabbar__button" id="btn-selanjutnya">
    <div class="tabbar__icon">
      <ons-icon icon="md-sign-in" size="30px" style="color:#4b3588;text-shadow: 1px 1px 1px #cccccc;"></ons-icon>
    </div>
    <div class="tabbar__label" type="submit" style="color:#444;text-shadow: 1px 1px 1px #ccc;" id="btn-tambah-simpan">MULAI UJIAN</div>
   </button>

      </ons-tabbar>
    </ons-bottom-toolbar>
        </form>
    </section><!-- /.content -->
</div><!-- /.container -->



<script type="text/javascript">
 

    $(function () {
        $('#btn-hentikan').addClass('hide');
        $('#form-konfirmasi-tes').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'unitujian/'.$url; ?>/mulai_tes",
                    type:"POST",
                    data:$('#form-konfirmasi-tes').serialize(),
                    cache: false,
                    timeout: 60000,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html('');
                            window.open("<?php echo site_url(); ?>unitujian/tes_kerjakan/index/"+obj.tes_id, "_self");
                        }else if(obj.status==2){
                            window.open("<?php echo site_url().'unitujian/'.$url; ?>/", "_self");
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    },
                    statusCode: {
                        500: function(respon) {
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err('Terjadi kesalahan pada persiapan Tes. Silahkan hubungi petugas.'));
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyiapkan Tes, Halaman akan di Refresh !");
                            setInterval(function() {
                                window.location.reload();
                            }, 4000);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(textstatus);
                            setInterval(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    }
            });
            return false;
        });
    });
   
</script>