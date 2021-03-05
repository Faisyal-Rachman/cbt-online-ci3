<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Backup Data
		
	</h1>

</section>

<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-md-6">
                <div class="card">
                  
                    <div class="card-body">
                        <span id="form-pesan-database"></span>
                        <p<b>Backup database CBT.</b></p>
                        <p>Database akan disimpan dalam archive. Extract terlebih dahulu sebelum melakukan restore database.</p>
                       
                    </div>
					
					<div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="backup-database">Backup Database</button>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
                <div class="card">
                  
                    <div class="card-body">
                        <span id="form-pesan-data-upload"></span>
                        <p><b>Backup Data Upload.</b> untuk melakukan Backup (gambar, audio).</p>
                        <p>Restore Data dengan meng-copy data ke folder uploads pada folder utama CBT</p>
                    </div>
					
					<div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="backup-data-upload">Backup Data Upload</button>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
                <div class="card">
                  
                    <div class="card-body">
                        <span id="form-pesan-data-upload"></span>
                        <p><b>Backup Data Upload.</b> untuk melakukan Backup (gambar, audio).</p>
                        <p>Restore Data dengan meng-copy data ke folder uploads pada folder utama CBT</p>
                    </div>
					
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="backup-session">Clear Sessions</button>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
                <div class="card">
                  
                    <div class="card-body">
                        <span id="form-pesan-data-upload"></span>
                        <p><b>Backup Data Upload.</b> untuk melakukan Backup (gambar, audio).</p>
                        <p>Restore Data dengan meng-copy data ke folder uploads pada folder utama CBT</p>
                    </div>
					
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="hapus-master">Hapus Data Master</button>
                    </div>
                </div>
        </div>
        <div class="col-md-6">
                <div class="card">
                  
                    <div class="card-body">
                        <span id="form-pesan-data-upload"></span>
                        <p><b>Backup Data Upload.</b> untuk melakukan Backup (gambar, audio).</p>
                        <p>Restore Data dengan meng-copy data ke folder uploads pada folder utama CBT</p>
                    </div>
					
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="hapus-soal">Hapus Bank Soal</button>
                    </div>
                </div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-6">
        <div class="card">
                  

                    <div class="card-body">
                        <span id="form-pesan-database"></span>
                        <p><input type="checkbox" name="tambah_benar['.$i.']" value="1"> Hapus Data Master</p>
                        <p><input type="checkbox" name="tambah_benar['.$i.']" value="1"> Hapus Bank Soal</p>
                        <p><input type="checkbox" name="tambah_benar['.$i.']" value="1"> Clear Sessions Siswa</p>
                        <p><input type="checkbox" name="tambah_benar['.$i.']" value="1"> Hapus Nilai dan Jawaban Siswa</p>
					     </div>
					
					<div class="card-footer">
                        <button type="submit" class="btn btn-danger" id="backup-session">Hapus Data</button>
                    </div>
                </div>
              
        </div>
       
	</div>
</section><!-- /.content -->



<script lang="javascript">
    $(function(){
        $('#backup-database').click(function(){
            window.open("<?php echo site_url().''.$url; ?>/database");
        });

        $('#backup-data-upload').click(function(){
            window.open("<?php echo site_url().''.$url; ?>/data_upload");
        });
		
		$('#backup-session').click(function(){
			$("#modal-proses").modal('show');
			$.getJSON('<?php echo site_url().''.$url; ?>/clear_session', function(data){
				if(data.status==1){
					window.location.reload(true);
				}
				$("#modal-proses").modal('hide');
			});
        });
        	
		$('#hapus-master').click(function(){
            Swal.fire({
  title: 'Anda Yakin?',
  text: 'Semua file data master akan dihapus!',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Setuju, Hapus',
  cancelButtonText: 'Tidak, Biarkan'
}).then((result) => {
  if (result.value) {
    $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_master",
                    type:"POST",
                     cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                                        Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "info"
                    });
                        }
                    }
            });
  // For more information about handling dismissals please visit
  // https://sweetalert2.github.io/#handling-dismissals
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Dibatalkan',
      'Data master Anda tersimpan aman :)',
      'error'
    )
  }
})   
    
});
        $('#hapus-soal').click(function(){
            Swal.fire({
  title: 'Anda Yakin?',
  text: 'Semua soal dan jawaban akan dihapus!',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Setuju, Hapus',
  cancelButtonText: 'Tidak, Biarkan'
}).then((result) => {
  if (result.value) {
    $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_soal",
                    type:"POST",
                     cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                                        Swal({
                        "title":  obj.pesan,
                       // "text": "Nama Costumer "+obj.nama,
                        "type": "info"
                    });
                        }
                    }
            });
  // For more information about handling dismissals please visit
  // https://sweetalert2.github.io/#handling-dismissals
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    Swal.fire(
      'Dibatalkan',
      'Data soal dan jawaban tersimpan aman :)',
      'error'
    )
  }
})   
});
    });
</script>