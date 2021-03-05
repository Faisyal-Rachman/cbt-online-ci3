<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Pengaturan Web
		
	</h1>
	
</section>

<!-- Main content -->
<section class="content">
<div class="container-fluid">
	<div class="row">

    <div class="col-md-7">
  
			<?php echo form_open_multipart($url.'/simpan','id="form-pengaturan"'); ?>
                <div class="card">
                   <div class="card-body form-horizontal">
						<div id="form-pesan"></div>
                        <div class="form-group">
							<label class="col-sm-4 control-label">Nama Sekolah</label>
                            <div class="col-md-8">
								<input type="text" class="form-control input-sm" id="web-nama" name="web-nama" >
                              
							</div>
						</div>
                           <div class="form-group">
                            <label class="col-sm-4 control-label">Kepala Sekolah</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-sm" id="web-kepala" name="web-kepala" >
                              
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-4 control-label">NIP Kepala Sekolah</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-sm" id="web-kepala-nip" name="web-kepala-nip" >
                              
                            </div>
                        </div>
                      <div class="form-group">
							<label class="col-sm-4 control-label">Keterangan</label>
                            <div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="web-keterangan" name="web-keterangan" >
                             
							</div>
						</div>
					<div class="form-group">
                            <label class="col-sm-4 control-label">Link Login</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" id="cbt_login" name="cbt_login" >
                             
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="col-sm-4 control-label">Tahun Ajaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" id="cbt_tahun" name="cbt_tahun" >
                             
                            </div>
                        </div>
						
						<div class="form-group">
							<label class="col-sm-6 control-label">Lock Mobile Exam Browser</label>
                            <div class="col-sm-8">
								<select class="form-control input-sm" id="web-mobile-lock-xambro" name="web-mobile-lock-xambro">
									<option value="tidak">Tidak</option>
                                    <option value="ya">Ya</option>
								</select>
                                
							</div>
						</div>

                        <div class="form-group">
							<label class="col-sm-6 control-label">Jenjang Pendidikan</label>
                            <div class="col-sm-8">
								<select class="form-control input-sm" id="jenjang-pendidikan" name="jenjang-pendidikan">
									
                                    <option value="smp">SMP</option>
                                    <option value="sma">SMA</option>
								</select>
                                
							</div>
						</div>
                    </div></div>
					<div class="card-footer">
						<button type="submit" id="btn-simpan" class="btn btn-primary pull-right">Simpan Pengaturan</button>
					</div>
               
			</form>
          
            </div>
  <div class="col-md-4">
            <div class="row">
            <?php echo form_open_multipart($url.'/uploadImage','id="form-upload"');?>
            <div id="form-pesan"></div>
            <div class="card">
                   <div class="card-body form-horizontal">
            <div class="form-group">
          
            <label class="control-label">Logo Sekolah Nasional</label>
                            <div class="col-sm-10">
                        
                           
    <input type="file" name="berkas" />
 
    <br /><br />
 
    <input type="submit" value="Upload Logo" />
 
</form>
</div>      </div>  </div>
<div class="card-footer">
        <img src="<?php echo base_url(); ?>assets/img/<?=$gambar->row()->konfigurasi_isi?>" class="user-image" width="40%" alt="User Image" />
                     
        </div>
</div>
            <div class="col-md-4">
            <div class="row">
            <?php echo form_open_multipart($url.'/uploadImage2','id="form-upload2"');?>
            <div id="form-pesan"></div>
            <div class="card">
                   <div class="card-body form-horizontal">
            <div class="form-group">
          
            <label class="control-label">Logo Identitas Sekolah</label>
                            <div class="col-sm-10">
						
                           
	<input type="file" name="berkas2" />
 
	<br /><br />
 
	<input type="submit" value="Upload Logo" />
 
</form>
</div>      </div>  </div>
<div class="card-footer">
        <img src="<?php echo base_url(); ?>assets/img/<?=$gambar2->row()->konfigurasi_isi?>" class="user-image" width="40%" alt="User Image" />
                     
        </div>
</div>

 <div class="col-md-4">
            <div class="row">
            <?php echo form_open_multipart($url.'/uploadImage3','id="form-upload3"');?>
            <div id="form-pesan"></div>
            <div class="card">
                   <div class="card-body form-horizontal">
            <div class="form-group">
          
            <label class="control-label">Tanda Tangan Kepala</label>
                            <div class="col-sm-10">
                        
                           
    <input type="file" name="berkas3" />
 
    <br /><br />
 
    <input type="submit" value="Upload Tanda Tangan" />
 
</form>
</div>      </div>  </div>
<div class="card-footer">
        <img src="<?php echo base_url(); ?>assets/img/<?=$gambar3->row()->konfigurasi_isi?>" class="user-image" width="40%" alt="User Image" />
                     
        </div>
</div>

                            </div>
                            </div>
        </div>



  </div>
  </div>
</section><!-- /.content -->



<script lang="javascript">
	function load_data(){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_pengaturan_web', function(data){
            if(data.data==1){
                $('#web-nama').val(data.cbt_nama);
                $('#web-keterangan').val(data.cbt_keterangan);
                $('#web-link-login').val(data.link_login_operator);
                $('#cbt_login').val(data.cbt_login);
                $('#cbt_tahun').val(data.cbt_tahun);
				$('#web-mobile-lock-xambro').val(data.mobile_lock_xambro);
                $('#jenjang-pendidikan').val(data.jenjang_pendidikan);
                $('#web-kepala').val(data.kepala_sekolah);
                $('#web-kepala-nip').val(data.nip_kepala_sekolah);
                $('#logo_sekolah').attr('src',data.logo_sekolah);
                $('#logo_sekolah_2').attr('src',data.logo_sekolah_2);
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
		load_data();
        $('#form-pengaturan').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/simpan",
                    type:"POST",
                    data:$('#form-pengaturan').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            $("#modal-proses").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
    });
    
</script>