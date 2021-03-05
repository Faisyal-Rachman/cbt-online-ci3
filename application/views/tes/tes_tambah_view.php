<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Jadwal Ujian
	</h1>
	<ol class="breadcrumb">
	
		<li class="active">Jadwal & Soal</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
    <div class="container-fluid">
            <div class="card card-default">
                <?php echo form_open($url.'tambah_tes','id="form-tambah-tes"  class="form-horizontal"'); ?>
             

                <div class="container-fluid">
                <div class="card-body">
                <div class="row">
           
                 <div class="col-sm"> 
                        <div id="form-pesan-tes"></div>
                        <div class="form-group">
                            <label>Deskripsi Ujian</label>
                            <div class="col-sm-9">
                                 <input type="hidden" name="data_tes" value="<?php if(!empty($data_tes)){ echo $data_tes; } ?>" />
                                <input type="hidden" name="tambah-id" id="tambah-id" />
                                <input type="hidden" name="tambah-nama-lama" id="tambah-nama-lama" />
                                <input type="text" name="tambah-nama" id="tambah-nama" class="form-control input-sm" />
                            </div>
                        </div>
                       </div>
                        <div class="col-sm">
                    
                        <div class="form-group">
                            <label class="col-sm-7 control-label">Mapel</label>
                            <div class="col-sm-10">
                        <input type="hidden" name="soal-tes-id" id="soal-tes-id" value="<?=$tesid?>">
                        <input type="hidden" name="tambah-status" id="tambah-status" value="1">
                 
                    <select id="soal-modul" name="soal-modul" class="form-control" >
                  <option value="" disabled selected></option>$select_topik?>
                    <?php foreach ($mapel as $t) : ?>
                            <option value="<?=$t->modul_id?>" ><?=$t->modul_nama?></option>
                        <?php endforeach; ?>
                                </select>
                            </div>
                        </div> </div>   
                         <div class="col-sm">
                         <div class="form-group">
                            <label class="col-sm-7 control-label">Topik Soal</label>
                            <div class="col-sm-10">
                <select style="width: 100%" class="form-control" id="soal-topik" name="soal-topik" >
                                  
                                        <?php 
                                    echo $select_topik;
                                    ?>
                                    
                                 
                                </select>
                            </div>
                        </div>
                        </div>
                        </div>  
                <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label>Jenis Ujian</label>
                <select id="tambah-jenis" name="tambah-jenis" class="form-control" style="width: 60%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($jenis as $r) : ?>
                            <option value="<?=$r->jenis_nama?>" ><?=$r->jenis_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>

                      <div class="col-sm">
                        <div class="form-group">
                            <label>Rentang Waktu</label>
                           
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" name="tambah-rentang-waktu" id="tambah-rentang-waktu" class="form-control input-sm" value="<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>" readonly />
                                </div>
                               
                           
                        </div>
                        </div>
  <div class="col-sm">
                        <div class="form-group">
                            <label>Lama Ujian <small>(menit)</small></label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-waktu" id="tambah-waktu" class="form-control input-sm" value="30" />
                               
                            </div>
                        </div>
                    </div>
                    </div>

                     <div class="row">
                        <div class="col-md-4">
                        <div class="form-group">
                            <label>Tombol Selesai <small>(menit)</small></label>
                            <div class="col-sm-9">
                                 <input type="text" name="selesai-tombol" id="selesai-tombol" class="form-control input-sm" />
                                </div>
                        </div>
                     </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kelas</label>
                            <div class="col-sm-9">
                                 <select class="form-control input-sm" multiple="multiple" id="tambah-group" name="tambah-group[]" size="8" required>
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
                                </div>
                        </div>
                     </div>
              <div class="col-sm">
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Jawaban Kosong</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin-kosong" id="tambah-poin-kosong" class="form-control input-sm" value="0" />
                                <p class="help-block">Poin untuk jawaban kosong</p>
                            </div>
                        </div>
                    </div>
                        
                     </div>

                     <div class="row">
                          <div class="col-sm">
                        <div class="form-group">
                            <label class="col-sm-9 control-label">Sesi Ujian</label>
                            <div class="col-sm-9">
                               
                         <select class="form-control input-sm" id="tambah-sesi" name="tambah-sesi">
                         <option value="" disabled selected></option>
                         <?php foreach ($sesi as $s) : ?>
                                  <option value="<?=$s->sesi_kode?>" ><?=$s->sesi_nama?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="col-sm">
                        <div class="form-group">
                            <label class="col-sm-7 control-label">Jml Soal</label>
                            <div class="col-sm-10">
                                 <input type="hidden" name="soal-jml-lama" id="soal-jml-lama" class="form-control input-sm" />
                                <input type="text" class="form-control input-sm" name="soal-jml" id="soal-jml" />
                            </div>
                        </div>
                         </div>
                         <div class="col-sm">
                        <div class="form-group">
                            <label class="control-label">Bobot Objektif</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin" id="tambah-poin" class="form-control input-sm" />
                            </div>
                        </div>
                    </div>
                </div>
                     <div class="row">
                      <div class="col-sm">
                        <div class="form-group">
                            <label class="col-sm-9 control-label">Bobot Essai</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin-essai" id="tambah-poin-essai" class="form-control input-sm" />
                               
                            </div>
                        </div>
                    </div>
                        <div class="col-sm">
                        <div class="form-group">
                            <label class="col-sm-9 control-label">Jawaban Salah</label>
                            <div class="col-sm-9">
                                <input type="text" name="tambah-poin-salah" id="tambah-poin-salah" class="form-control input-sm" value="0" />
                               
                            </div>
                        </div>
                    </div>
                      <div class="col-sm">
                        <div class="form-group">
                            <label class="col-sm-9 control-label">Ruang Ujian</label>
                            <div class="col-sm-9">
                               
                         <select class="form-control input-sm" id="tambah-ruang" name="tambah-ruang">
                         <option value="" disabled selected required></option>
                         <?php foreach ($ruang as $r) : ?>
                                  <option value="<?=$r->ruang_kode?>" ><?=$r->ruang_nama?></option>
                                     <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                   
                </div>
                 <div class="row">

            <div class="col-sm">
                      <div class="form-group">
                            <label>Tipe Soal</label>
                          <select class="form-control input-sm" id="soal-tipe" name="soal-tipe" style="width: 50%!important">
                                    <option value="0">Semua</option>
                                    <option value="1">Pilihan Ganda</option>
                                    <option value="2">Essay</option>
                                    <option value="3">Jawaban Singkat</option>
                                </select>
                           </div>
                         </div>
                 <div class="col-sm">
                        <div class="form-group">
                            <label>Putar Sekali</label>
                            <div class="col-sm-9">
                            <input type="checkbox" name="tambah-putar" id="tambah-putar" value="1" >
                            
                            </div>
                        </div>
                    </div>
                                       
 <div class="col-sm">
                        <div class="form-group">
                            <label>Detail Hasil</label>
                            <div class="col-sm-9">
                            <input type="checkbox" name="tambah-detail-hasil" id="tambah-detail-hasil" value="1" >
                            
                            </div>
                        </div>
                    </div>
                  
                </div>

                <div class="row">
                         <div class="col-sm">
                        <div class="form-group">
                            <label>Token</label>
                            <div class="col-sm-9">
                                <input type="checkbox" name="tambah-token" id="tambah-token" value="1" >
                             
                            </div>
                        </div>
                    </div>
                     
                    <div class="col-sm">
                     <div class="form-group">
                            <label>Acak Soal</label>
                            <div class="col-sm-9">
                            <input type="checkbox" name="soal-acak-soal" id="soal-acak-soal" class="input-sm" value="1" checked>
                              
                            </div>
                        </div> 
                    </div>
                    <div class="col-sm">
                     <div class="form-group">
                            <label>Acak Jawab</label>
                            <div class="col-sm-9">
                            <input type="checkbox" name="soal-acak-jawaban" id="soal-acak-jawaban" class="input-sm" value="1" checked>
                              
                            </div>
                        </div>
                        </div>
                          <div class="col-sm">
                        <div class="form-group">
                            <label>Tampil Hasil</label>
                            <div class="col-sm-9">
                            <input type="checkbox" name="tambah-tunjukkan-hasil" id="tambah-tunjukkan-hasil" value="1" checked>
                             
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                                <div class="col-sm">
                                <select class="form-control input-sm" id="soal-kesulitan" name="soal-kesulitan" hidden >
                                    <option value="1" selected="selected">1</option>
                                   
                                </select>
                            </div>
                        </div>
                </div>

                 <div class="row">
                       
                    </div>
                    <div>
                      <button type="submit" id="btn-tambah-simpan" class="btn btn-info">Simpan</button>
              </div>
              </form>  
              </div>
                   
                   
                   
                                  
               
            </div>
        </div>
</section>
        <section class="content">
    
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
    }
  $(document).ready(function () {

                $("#tambah-group").select2({

                    placeholder: "Silahkan Pilih"

                });

            });
    
function refresh_topik(){
        $("#modal-proses").modal('show');
        var modul = $('#soal-modul').val();
        $.getJSON('<?php echo site_url().''.$url; ?>/get_topik_by_modul/'+modul, function(data){
            if(data.data==1){
                $('#soal-topik').html(data.select_topik);
            }
            $("#modal-proses").modal('hide');
        });
    }
    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().''.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#tambah-id').val(data.id);
                $('#soal-tes-id').val(data.id);
                $('#selesai-tombol').val(data.pg);
                $('#tambah-nama').val(data.nama);
                $('#tambah-jenis').val(data.jenis);
                $('#tambah-nama-lama').val(data.nama);
                $('#tambah-sesi').val(data.sesi);
                $('#tambah-ruang').val(data.ruang);
                $('#tambah-waktu').val(data.waktu);
                $('#tambah-poin').val(data.poin);
                $('#tambah-poin-essai').val(data.poinessai);
                $('#tambah-poin-kosong').val(data.poin_kosong);
                $('#tambah-poin-salah').val(data.poin_salah);
                $('#tambah-rentang-waktu').val(data.rentang_waktu);
                $('#soal-modul').val(data.modul_nama);
                $('#soal-jml').val(data.jmlh);
               $('#soal-jml-lama').val(data.jmlh);
              //  $('#soal-topik').val(data.topik_id);
                if(data.putar==1){
                    $('#tambah-putar').prop("checked", true);
                }else{
                    $('#tambah-putar').prop("checked", false);
                }
                if(data.tunjukkan_hasil==1){
                    $('#tambah-tunjukkan-hasil').prop("checked", true);
                }else{
                    $('#tambah-tunjukkan-hasil').prop("checked", false);
                }
                if(data.detail_hasil==1){
                    $('#tambah-detail-hasil').prop("checked", true);
                }else{
                    $('#tambah-detail-hasil').prop("checked", false);
                }
                if(data.token==1){
                    $('#tambah-token').prop("checked", true);
                }else{
                    $('#tambah-token').prop("checked", false);
                }

               // refresh_topik();
                refresh_table();

                $('#kolom-soal').removeClass('hide');
            }
            $("#modal-proses").modal('hide');
        });
    }

    function hapus_soal(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().''.$url; ?>/hapus_soal_by_id/'+id+'', function(data){
            if(data.data==1){
                notify_success(data.pesan);

                refresh_table();
            }else{
                notify_error(data.pesan);                
            }
            $("#modal-proses").modal('hide');
        });
    }

    function selesai(){
        $('#tambah-id').val('');
        $('#tambah-nama').val('');
        $('#tambah-pg').val('');
        $('#tambah-nama-lama').val('');
        $('#tambah-deskripsi').val('');
        $('#tambah-jenis').val('');
        $('#tambah-status').val('');
        $('#tambah-waktu').val('30');
        $('#tambah-poin').val('1.00');
        $('#tambah-poin-kosong').val('0.00');
        $('#tambah-poin-salah').val('0.00');
        $('#tambah-rentang-waktu').val('<?php if(!empty($rentang_waktu)){ echo $rentang_waktu; } ?>');
        $('#tambah-group option:selected').removeAttr('selected');
        $('#tambah-acak-jawaban').prop("checked", true);

        $('#soal-tes-id').val('');

       // $('#kolom-soal').addClass('hide');
        $('#tambah-nama'),focus();
    }

    $(function(){
        $('#tambah-rentang-waktu').daterangepicker({timePicker: true, timePickerIncrement: 10, format: 'YYYY-MM-DD H:mm'});
        $('#btn-tambah-selesai').click(function(){
            window.open("<?php echo site_url(); ?>manager/tes_tambah", "_self");
        });

        $('#btn-tambah-daftar').click(function(){
            window.open("<?php echo site_url(); ?>manager/tes_daftar", "_self");
        });
    
        $("#soal-modul").change(function(){
            refresh_topik();
        });
        $('#form-tambah-tes').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/tambah_tes",
                    type:"POST",
                    data:$('#form-tambah-tes').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $('#form-pesan-tes').html('');
                            $("#tambah-id").val(obj.tes_id);
                          //  $("#tambah-nama-lama").val(obj.tes_nama);
                            // menampilkan tambah soal
                          refresh_topik()
                            $("#soal-tes-id").val(obj.tes_id);
                            $('#kolom-soal').removeClass('hide');
                            $("#modal-proses").modal('hide');
                            
                            notify_success(obj.pesan);
                             window.open("<?php echo site_url(); ?>manager/tes_tambah", "_self");
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-tes').html(pesan_err(obj.pesan));
                            
                        }
                    }
            });
            return false;
        });

        $('#form-tambah-soal').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/tambah_soal",
                    type:"POST",
                    data:$('#form-tambah-soal').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-soal').html('');
                            refresh_table();                            
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-soal').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

       <?php if(!empty($data_tes)){ echo $data_tes; } ?>
    });
</script>