<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Jadwal Ujian
		
	</h1>
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
    <div class="container-fluid">
                <div class="card">
                    <div class="card-header with-border">


                    <div class="card-title"><a href="<?php echo site_url(); ?>manager/tes_tambah" class="btn btn-outline-warning btn-sm" style="cursor: pointer;">Tambah Ujian</a></div>
    						<div class="card-tools pull-right">
    						
    						</div>
					                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <?php echo form_open($url.'/hapus_daftar_tes','id="form-hapus-pilih"'); ?>
                        <input type="hidden" name="check" id="check" value="0">
                        <input type="hidden" name="centang" id="centang" value="0">
                        <div id="form-pesan"><?php if(!empty($pesan_hapus)){ echo $pesan_hapus; } ?></div>
                        <table id="table-tes" class="table table-bordered table-striped table-sm">
                        <thead class="table table-primary">
                                <tr>
                                   
                                    <th class="all">Ujian</th>
                                    <th>KKM</th>
                                    <th>Jenis</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Sesi</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                    <th>Token</th>
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

    <div class="modal" id="modal-hapus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hapus_tes','id="form-hapus"'); ?>
    <div class="modal-dialog modal-notify modal-info modal-md">
            <div class="modal-content">
            <div class="modal-header bg-primary">
			 <h5 class="modal-title"><b>Hapus Jadwal Ujian</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
				
			</div>
                <div class="modal-body">
                <div class="container-fluid">
                        <div class="card-body d-flex"><div class="col-xs-10">
                            <div id="form-pesan-hapus"></div>
                            <div class="form-group">
                                <label>Nama Tes</label>
                                <input type="hidden" name="hapus-id" id="hapus-id">
                                <input type="text" class="form-control" id="hapus-nama" name="hapus-nama" readonly>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" id="hapus-deskripsi" name="hapus-deskripsi" readonly>
                            </div>
                            <p>Tes yang dihapus akan membuat data nilai user juga akan ikut terhapus</p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-hapus" class="btn btn-default">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>

    <div class="modal" id="modal-hapus-pilih" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <div id="trx-judul">Hapus Tes</div>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                            <strong>Peringatan</strong>
                            Data Tes yang sudah dipilih akan dihapus beserta hasil tes tersebut.
                            <br /><br />
                            Apakah anda yakin untuk menghapus data Topik ?
                            <div class="form-group">
                                <div class="checkcard">
                                    <label>
                                        <input type="checkcard" id="edit-hapus-centang" name="edit-hapus-centang" value="1"> Ya, saya yakin Menghapus Tes yang telah dipilih.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-hapus-pilih" class="btn btn-default pull-left">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-tes').dataTable().fnReloadAjax();
    }
$(document).on('click','.status_checks',function(){
    var status = ($(this).hasClass("btn-success btn-sm")) ? '0' : '1';
var msg = (status=='0')? 'Nonaktifkan' : 'Aktifkan';
if(confirm("Anda yakin topik di "+ msg)){
    var current_element = $(this);
     url = "<?php echo base_url(); ?>index.php/manager/tes_daftar/update",
    $.ajax({
    type:"POST",
    url: url,
    data: {id:$(current_element).attr('data'),status:status},
    success: function(data)
        {   
             refresh_table();
            notify_success('Jadwal Tes di ' +msg);
            //location.reload();
        }
    });
    }      
    });

    function edit(id){
        window.open("<?php echo site_url(); ?>manager/tes_tambah/index/"+id, "_self");
    }

    function hapus(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#hapus-id').val(data.id);
                $('#hapus-nama').val(data.nama);
                $('#hapus-deskripsi').val(data.deskripsi);


                $("#modal-hapus").modal('show');
            }
            $("#modal-proses").modal('hide');
        });
    }

    $(function(){
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
            $('#centang').val('0');
            $('#edit-hapus-centang').removeAttr("checked");;
            $("#modal-hapus-pilih").modal('show');
        });
        $('#btn-hapus-pilih').click(function(){
            $("#modal-proses").modal('show');
            $("#form-hapus-pilih").submit();
        });
        $("#edit-hapus-centang").change(function() {
            if(this.checked) {
                $('#centang').val('1');
            }else{
                $('#centang').val('0');
            }
        });

        $('#form-hapus').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_tes",
                    type:"POST",
                    data:$('#form-hapus').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table()
                            $("#modal-proses").modal('hide');
                            $("#modal-hapus").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-hapus').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        $('#table-tes').DataTable({
                  "paging": true,
                  "iDisplayLength":50,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					
    					{"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"200px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().''.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true
         });          
    });
</script>