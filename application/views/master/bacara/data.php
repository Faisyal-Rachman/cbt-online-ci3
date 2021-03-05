<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$subjudul?></h1>
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>
	

	<div class="card">
		<div class="card-header">
			<button type="button" data-toggle="modal" data-target="#myModal" id="tambahbacara" class="btn btn-sm btn-flat bg-purple"><i class="fa fa-plus"></i> Tambah Berita Acara</button>
			<div class="card-tools">
				
				<button onclick="bulk_delete()" class="btn btn-sm btn-flat btn-danger" type="button"><i class="fa fa-trash"></i> Hapus</button>
			</div>
			</div>
		    <div class="card-body">
		<?= form_open('', array('id' => 'bulk')) ?>
		<table id="bacara" class="w-100 table table-striped table-bordered table-hover table-sm">
			<thead class="table table-primary">
				<tr>
					<th style="width:23px;">NO.</th>
					<th style="width:220px;">NAMA UJIAN</th>
                    <th style="width:220px;">TIDAK HADIR</th>
					<th style="width:120px;">TGL MULAI</th>
					<th style="width:120px;">TGL AKHIR</th>
					<th style="width:120px;">PROKTOR</th>
					<th style="width:120px;">PENGAWAS</th>
					<th style="width:150px;">CATATAN</th>
		         	<th style="width:70px;" class="text-center">
						<input type="checkbox" id="select_all">
					</th>
				</tr>
			</thead>
		</table>
		<?= form_close() ?>
	</div>
</div>

    <div class="modal fade" id="myModal">
	<div class="modal-dialog modal-notify modal-info modal-md">
		<div class="modal-content">
		<div class="modal-header bg-primary">
			 <h5 class="modal-title"><b>Tambah <?=$judul?></b></h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;"><span aria-hidden="true">&times;</span></button>
				
			</div>
       	 <?= form_open('manager/data_bacara/simpan', array('id'=>'form-bacara'), array('mode'=>'add'))?>
                <div class="modal-body">
				<div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Detail Ujian</label>
                            <div id="judul"></div>
							<select name="bacaraujian_id" class="form-control" id="bacaraujian_id" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($nama_ujian as $m) : ?>

                            <option value="<?=$m->tes_id?>"><?=$m->tes_nama?> - <?=$m->tes_detail?> - <?=$m->tes_ruang?> (Mapel <?=$m->modul_nama?>)</option>
                        <?php endforeach; ?>
                    </select>
							</div>
                            </div>
                           
							<div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Catatan</label>
						<textarea class="form-control" id="bacara_catatan" name="bacara_catatan" placeholder="Catatan"></textarea> 
							</div>
                               <div class="form-group">
                            <label>Waktu Mulai</label>
                        <input type="text" class="form-control" id="bacara_ujian_mulai" name="bacara_ujian_mulai" placeholder="00:00">
                            </div>
                               <div class="form-group">
                            <label>Waktu Selesai</label>
                        <input type="text" class="form-control" id="bacara_ujian_akhir" name="bacara_ujian_akhir" placeholder="00:00">
                            </div>
                              <div class="form-group">
                            <label>Penanggung Jawab</label>
                        <input type="text" class="form-control" id="bacara_p_jawab" name="bacara_p_jawab" placeholder="Penanggung Jawab">
                            </div>
                                <div class="form-group">
                            <label>NIP Penanggung Jawab</label>
                        <input type="text" class="form-control" id="bacara_p_jawab_nip" name="bacara_p_jawab_nip" placeholder="Penanggung Jawab">
                            </div>
                            </div>
                 <div class="col-md-6"><div class="form-group"><label>Nama Proktor</label>
				 <select name="bacara_operator" class="form-control" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($proktor as $m) : ?>
                            <option value="<?=$m->nama?>"><?=$m->nama?></option>
                        <?php endforeach; ?>
                    </select></div>
                </div>
                <div class="col-md-6"><div class="form-group"> <label>NIP Proktor</label>
                <input type="text" class="form-control input-sm" id="bacara_nip_operator" name="bacara_nip_operator"> </div>
                </div>
                <div class="col-md-6"><div class="form-group"> <label>Nama Pengawas</label>
                <select name="bacara_pengawas" class="form-control" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($pengawas as $m) : ?>
                            <option value="<?=$m->guru_nama?>"><?=$m->guru_nama?></option>
                        <?php endforeach; ?>
                    </select></div>
                </div>
                 <div class="col-md-6"><div class="form-group"> <label>NIP Pengawas</label>
                <input type="text" class="form-control input-sm" id="bacara_nip_pengawas" name="bacara_nip_pengawas"> </div>
                </div>
              
               <div class="col-md-12">
                
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Jumlah Tidak Hadir</label>
            <input type="text" class="form-control input-sm" id="bacara_tdk_hadir" name="bacara_tdk_hadir"> </div>
                            </div>
                            </div>
            <div class="col-md-12">

                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>No.Tidak Hadir</label>

                 
        <select class="select2" style="width: 100%" multiple="multiple" id="tidak_hadir" name="tidak_hadir[]" data-placeholder="Select a State" >                      
                                </select>
                            </div>
                            </div>
               </div> 

                    </div>
				
 
                <div class="modal-footer">
                   <button id="submit" type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-save"></i> Simpan
                </button>
                </div>
           <?= form_close() ?>
		</div>
		</div>
		<!-- /.modal-content -->
	</div>

 <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModalEdit" aria-hidden="true">
       <?php echo form_open($url.'/edit','id="form-edit"'); ?>
       <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <div class="row">
                       
                        <div class="col-md-12">
                
                <div class="form-group">
                <label>Nis</label>
                <input type="hidden" name="edit-id" id="edit-id">
                <input type="hidden" name="edit-pilihan" id="edit-pilihan">
                <input type="text" class="form-control" id="edit-email" name="edit-email" placeholder="Nis Peserta"> 
                </div>
                </div>
                <div class="col-md-6"><div class="form-group"><label>No.Pes</label><input type="text" class="form-control" id="edit-nama" name="edit-nama" placeholder="Nomor Peserta"> </div>
                </div>
                <div class="col-md-6">
                <div class="form-group"><label>Agama</label>
                                <select id="edit-agama" name="edit-agama" class="form-control input-sm">
                                    <?php if(!empty($select_agama)){ echo $select_agama; } ?>
                                </select></div>
                </div>
                <div class="row">  
                     <div class="col-md-3">
                <div class="form-group"><label>Kelas</label>
                                <select id="edit-group" name="edit-group" class="form-control input-sm">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select></div>
                </div>
                <div class="col-md-3"><div class="form-group"><label>Jurusan</label>
                <select id="edit-jurusan" name="edit-jurusan" class="form-control" style="width: 100%!important" <?= $jenjang_pendidikan?>>
                        <option value="" disabled selected></option>
                        <?php foreach ($jurusan as $j) : ?>
                            <option value="<?=$j->jurusan_kode?>"><?=$j->jurusan_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-md-3"><div class="form-group"><label>Sesi</label>
                <select id="edit-sesi" name="edit-sesi" class="form-control" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($sesi as $s) : ?>
                            <option value="<?=$s->sesi_kode?>"><?=$s->sesi_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-md-3"><div class="form-group"> <label>Ruang</label>
                <select id="edit-detail" name="edit-detail" class="form-control" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($ruang as $r) : ?>
                            <option value="<?=$r->ruang_kode?>"><?=$r->ruang_nama?></option>
                        <?php endforeach; ?>
                    </select></div>
                </div>
                </div>
                <div class="col-md-12">
                
                <div class="form-group">
                <label>Nama Siswa</label>
                    <input type="text" class="form-control" id="edit-siswa" name="edit-siswa" placeholder="Nama Peserta">
                </div>
                </div>
                <div class="col-md-12">
               
               <div class="form-group">
               <label>Username</label>
                  <input type="text" class="form-control" id="edit-username" name="edit-username" placeholder="Username Peserta" readonly>
               </div>
               </div>
               <div class="col-md-12">
               
               <div class="form-group">
               <label>Password</label><input type="password" class="form-control" id="edit-password" name="edit-password" placeholder="Password"> 
                <div toggle="#edit-password" class="fa fa-fw fa-eye field-icon toggle-password"></div> </div>
               </div>
                      

                            <p>NB : Peserta yang dihapus, maka semua hasil tes akan ikut terhapus !</p>
                       
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-hapus" class="btn btn-default pull-left">Hapus</button>
                    <button type="button" id="edit-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>



</div>
</section>

<script src="<?= base_url() ?>assets/dist/js/app/master/bacara/data.js"></script>
<script lang="javascript">
 function refresh_table(){
        $('#bacara').dataTable().fnReloadAjax();
    }
       
        function refresh_absen(){
        $("#modal-proses").modal('show');
        var modul = $('#bacaraujian_id').val();
       
        $.getJSON('<?php echo site_url().''.$url; ?>/get_absen/'+modul, function(data){
            if(data.data==1){
               $('#bacara_tdk_hadir').val(data.jumlahabsen);
                $('#tidak_hadir').html(data.select_topik);

            }
            $("#modal-proses").modal('hide');
        });
    }
  $(function(){
    $('#tambahbacara').click(function(){
        $('#form-pesan').html('');
         $('#bacaraujian_id').val('');
        $('#bacara_nip_pengawas').val('');
       $('#bacara_nip_operator').val('');
        $('#bacara_tdk_hadir').val('');
          $('#bacara_catatan').val('');
        $('#bacara_p_jawab').val('');
          $('#bacara_p_jawab_nip').val('');
        $('#bacara_ujian_mulai').val('');
          $('#bacara_ujian_akhir').val('');
        $('#bacara_operator').val('');
        $('#bacara_pengawas').val('');
        
          complete: function(response) { // on complete
             $('#tidak_hadir').val('');
output.html(response.responseText); //update element with received data
      myform.resetForm(); // reset form
      submitbutton.removeAttr('disabled'); //enable submit button
      progressbox.slideUp(); // hide progressbar
        $.clearInput();
        }
    });

 $('#form-bacara').submit(function(){
                    $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan",
                    type:"POST",
                    data:$('#form-bacara').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                         refresh_table();
                           $("#myModal").modal('hide');
                           notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });
   $("#bacaraujian_id").change(function(){
            refresh_absen();
        });
 });
  function refresh_topik(){
        var judul = $('#bacaraujian_id option:selected').text();
        $('#bacara_tdk_hadir').val('tes');
      }
       
</script>