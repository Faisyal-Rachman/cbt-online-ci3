<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data Peserta

	</h1>
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
    <div class="col-md-9">

                    </div>

                    <div class="container-fluid">
                <div class="card bg-light">
                
                    <div class="card-header with-border">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kelas <small>(Pilih kelas untuk <b>menampilkan</b> peserta)</small></b></label>
                            <div id="data-kelas">
                                <select name="group" id="group" class="form-control input-sm">
                                    <option value="semua">Semua Kelas</option>
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
                            </div>
                      
                    </div>
                    </div>
    						<div class="card-title"> <a class="btn btn-outline-success btn-sm" style="cursor: pointer;" onclick="tambah()">Tambah Peserta</a></div>
    						<div class="card-tools pull-right">
    							<div class="dropdown pull-right">
                                <button type="button" id="btn-edit-hapus" class="btn btn-warning btn-sm" title="Hapus Siswa yang dipilih">Hapus</button>
    							</div>
    						</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <?php echo form_open($url.'/hapus_daftar_siswa','id="form-hapus"'); ?>
                        <input type="hidden" name="check" id="check" value="0">
                        <table id="table-peserta" class="table table-bordered table-striped table-sm">
                        <thead class="table table-primary">
                                <tr>
                                    <th class="all">No.Peserta</th>
                                    <th>Nama Siswa</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th class="all">Nis</th>
                                    <th>Kelas</th>
                                     <th>Sesi</th>
                                   <th>Ruang</th>
                                    <th class="all">Action</th>
                                    <th class="all"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
									<td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
									<td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>  
                        </form>                      
                    </div>
                  
                </div>
        </div>
    </div>

    <div style="overflow-y:auto;" class="modal" id="modal-hapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title">Hapus Peserta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                        <strong>Perhatian!</strong>
                            Data Siswa akan dihapus, Data Hasil Tes juga akan terhapus.
                            <br /><br />
                            Anda yakin ?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-hapus" class="btn btn-default pull-left">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-tambah" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
     <?php echo form_open($url.'/tambah','id="form-tambah"'); ?>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Tambah Peserta Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Nis</label><input type="text" class="form-control" id="tambah-email" name="tambah-email" placeholder="Nis Peserta"> 
                            </div>
                            </div>
                 <div class="col-md-6"><div class="form-group"><label>No.Pes</label><input type="text" class="form-control" id="tambah-nama" name="tambah-nama" placeholder="Nomor Peserta"> </div>
                </div>
                <div class="col-md-6"><div class="form-group"> <label>Kelas</label>
                                <select id="tambah-group" name="tambah-group" class="form-control input-sm">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select></div>
                </div>
                <div class="row">  
                <div class="col-md-4"><div class="form-group"><label>Jurusan</label>
                <select id="tambah-jurusan" name="tambah-jurusan" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($jurusan as $j) : ?>
                            <option value="<?=$j->jurusan_kode?>"><?=$j->jurusan_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-md-4"><div class="form-group"><label>Sesi</label>
                <select id="tambah-sesi" name="tambah-sesi" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($sesi as $s) : ?>
                            <option value="<?=$s->sesi_kode?>"><?=$s->sesi_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-md-4"><div class="form-group"> <label>Ruang</label>
                <select id="tambah-detail" name="tambah-detail" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($ruang as $r) : ?>
                            <option value="<?=$r->ruang_kode?>"><?=$r->ruang_nama?></option>
                        <?php endforeach; ?>
                    </select></div>
                </div>
                </div>
                <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Nama Siswa</label>
                                <input type="text" class="form-control" id="tambah-siswa" name="tambah-siswa" placeholder="Username Peserta">
                            </div>
                            </div>
                <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Username</label>
                                <input type="text" class="form-control" id="tambah-username" name="tambah-username" placeholder="Username Peserta">
                            </div>
                            </div>
                <div class="col-md-12">
                <div id="form-pesan"></div>
                            <div class="form-group">
                            <label>Password</label><input type="password" class="form-control" id="tambah-password" name="tambah-password" placeholder="Password"> 
                            </div>
                            </div>
            
               </div> 

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Tambah</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

   <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModalEdit" aria-hidden="true">
       <?php echo form_open($url.'/edit','id="form-edit"'); ?>
        <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Peserta Ujian</h5>
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
                            
                            <input type="text" class="form-control" id="edit-email" name="edit-email" placeholder="Nis Peserta"> 
                            </div>
                            </div>
                 <div class="col-md-6"><div class="form-group"><label>No.Pes</label><input type="text" class="form-control" id="edit-nama" name="edit-nama" placeholder="Nomor Peserta"> </div>
                </div>
                <div class="col-md-6">
                <div class="form-group"><label>Kelas</label>
                                <select id="edit-group" name="edit-group" class="form-control input-sm">
                                    <?php if(!empty($select_group)){ echo $select_group; } ?>
                                </select></div>
                </div>
                <div class="row">  
                <div class="col-md-4"><div class="form-group"><label>Jurusan</label>
                <select id="edit-jurusan" name="edit-jurusan" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($jurusan as $j) : ?>
                            <option value="<?=$j->jurusan_kode?>"><?=$j->jurusan_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-md-4"><div class="form-group"><label>Sesi</label>
                <select id="edit-sesi" name="edit-sesi" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($sesi as $s) : ?>
                            <option value="<?=$s->sesi_kode?>"><?=$s->sesi_nama?></option>
                        <?php endforeach; ?>
                    </select>
                </div></div>
                <div class="col-md-4"><div class="form-group"> <label>Ruang</label>
                <select id="edit-detail" name="edit-detail" class="form-control select2" style="width: 100%!important">
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
                            </div>
                            </div>
            
               </div> 

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="edit-simpan" class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>


        <!--  <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Peserta Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                 <div class="modal-body">
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan-edit"></div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="hidden" name="edit-id" id="edit-id">
                                <input type="hidden" name="edit-pilihan" id="edit-pilihan">
                                <input type="text" class="form-control" id="edit-username" name="edit-username" readonly >
                            </div>

                            <div class="form-group">
                                <label>Password</label>
								<div class="input-group">
									<input type="password" id="edit-password" name="edit-password" class="form-control">
									<span class="input-group-btn">
										<button class="btn btn-flat" id="btn-show-password" title="Tampilkan Password" type="button"><i id="icon-show-password" class="fa fa-eye"></i></button>
									</span>
								</div>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" id="edit-nama" name="edit-nama" placeholder="Nama Lengkap Peserta">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="edit-email" name="edit-email" placeholder="Email Peserta (Boleh dikosongkan)">
                            </div>
							
							<div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" id="edit-detail" name="edit-detail" placeholder="Keterangan peserta. (Bisa disi ruang dan sesi)">
								<p class="help-block">Dapat diisi Ruang dan Sesi Peserta. Contoh : Ruang 1, Sesi 1</p>
                            </div>

                            <div class="form-group">
                                <label>Group</label>
                                <select name="edit-group" id="edit-group" class="form-control input-sm">
                                    <?php// if(!empty($select_group)){ echo $select_group; } ?>
                                </select>
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
            -->
        </div>

    </form>
    </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-peserta').dataTable().fnReloadAjax();
    }
	
	function showpassword(){
		var x = document.getElementById("edit-password");
		if (x.type === "password") {
			x.type = "text";
			$("#icon-show-password").removeClass("fa-eye");
			$("#icon-show-password").addClass("fa-eye-slash");
		} else {
			x.type = "password";
			$("#icon-show-password").removeClass("fa-eye-slash");
			$("#icon-show-password").addClass("fa-eye");
		}
    }

    function tambah(){
        $('#form-pesan').html('');
        $('#tambah-username').val('');
        $('#tambah-siswa').val('');
        $('#tambah-password').val('');
        $('#tambah-jurusan').val('');
        $('#tambah-sesi').val('');
        $('#tambah-nama').val('');
        $('#tambah-email').val('');
        $('#tambah-detail').val('');
        $('#tambah-group').val('');
        $("#modal-tambah").modal("show");
        $('#tambah-username').focus();
    }

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#edit-id').val(data.id);
                $('#edit-username').val(data.username);
                $('#edit-siswa').val(data.siswa);
                $('#edit-password').val(data.password);
                $('#edit-jurusan').val(data.jurusan);
                $('#edit-sesi').val(data.sesi);
                $('#edit-nama').val(data.nama);
                $('#edit-email').val(data.email);
				$('#edit-detail').val(data.detail);
                $('#edit-group').val(data.group);
                
                $("#modal-edit").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
		$("#btn-show-password").click(function(){
			showpassword();
		});
		
        $("#group").change(function(){
            refresh_table();
        });

        $('#edit-simpan').click(function(){
            $('#edit-pilihan').val('simpan');
            $('#form-edit').submit();
        });
        $('#edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });
        $('#btn-edit-pilih').click(function(event) {
            if($('#check').val()==0) {
                $(':checkcard').each(function() {
                    this.checked = true;
                });
                $('#check').val('1');
            }else{
                $(':checkcard').each(function() {
                    this.checked = false;
                });
                $('#check').val('0');
            }
        });
        $('#btn-edit-hapus').click(function(){
            $("#modal-hapus").modal('show');
        });
        $('#btn-hapus').click(function(){
            $("#form-hapus").submit();
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_daftar_siswa",
                    type:"POST",
                    data:$('#form-hapus').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-hapus").modal('hide');
                            notify_success(obj.pesan);
                            $('#check').val('0');
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

        $('#form-edit').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-edit").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-edit').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#form-tambah').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    data:$('#form-tambah').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-tambah").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-peserta').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"80px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"40px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"40px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "group", "value": $('#group').val()} );
                  }
         });          
    });
</script>