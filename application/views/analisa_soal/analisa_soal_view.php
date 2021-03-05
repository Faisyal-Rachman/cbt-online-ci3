<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
 Analisis Soal
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="container-fluid">
         <form id="form" method="post">
            <div class="form-group">
                            
                            <div class="col-sm-12">
                                <input type="hidden" name="check" id="check">
                                <select name="pilih-tes" id="pilih-tes" class="form-control" style="width:20%;!important;">
                                    <?php if(!empty($select_tes)){ echo $select_tes; } ?>
                                </select>
                            </div>
                        </div>
            <div class="card">
              
            <div class="card-body form-horizontal">
                  <div class="row">
                    
                        <div class="col-sm-4">
                        
                        </div>
                       
                     
              <!-- /.col -->
            </div>
            <!-- /.row -->
 <div class="row">
                    
                        <div class="col-sm-2">
                        <div class="form-group">
                           <b>Mata Pelajaran</b>
                           
                        </div>
                         <div class="form-group">
                           <b>Tingat</b>
                           
                        </div>
                        
                         <div class="form-group">
                         <b> Kelas</b>
                           
                        </div>
                        </div>
                        <div class="col-sm-0">
                            <div class="form-group">:</div>
                                <div class="form-group">:</div>
                                    <div class="form-group">:</div>
                                      
                            </div>
                        <div class="col-sm-4">
                        <div class="form-group">
                           
                            <div id="ket1">
                             
                            </div>
                        </div>
                         <div class="form-group">
                           
                             <div id="ket2">
                              
                            </div>
                        </div>
                         <div class="form-group">
                           
                            <div id="ket3">
                             
                            </div>
                        </div>
                        
                        </div>
                     
             
            </div>
           
            <!-- /.row -->
          </div>
                <div class="card-footer">
                    <button type="button" id="btn-pilih" name="submit" class="btn btn-primary pull-right"><span>Pilih</span></button>
                </div>
            </div>
             </form>
        </div>
    </div>
    <div class="row">
    <div class="container-fluid">
        <?php echo form_open($url.'/edit_tes','id="form-edit"'); ?>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header with-border">
                   <div class="card-tools pull-right">
                        <div class="dropdown pull-right">
                            <a class="btn btn-warning btn-sm" style="cursor: pointer;" onclick="export_excel()">Export ke Excel</a>
                        </div>
                    </div>
                </div><!-- /.card-header -->


            <div class="card-body">
                    <input type="hidden" name="edit-pilihan" id="edit-pilihan">
                    <table id="<?=$th?>" class="table table-bordered table-hover table-sm">
                    <thead class="table table-primary table-sm">
                            <tr>
                                <th>No.</th>
                                <th>Soal Pilihan Ganda</th>
                               <th>Responder</th>
                                <th>Benar</th>
                                <th>Salah</th>
                                <th>Indikator</th>
                               <th>Analisis</th>
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
                            </tr>
                        </tbody>
                    </table>                        
                </div>
               
            </div>
        </div>

        <?= $pn ?>

        </form>
    </div> </div>
</section><!-- /.content -->



<script lang="javascript">
    function refresh_table(){
        $('#table-hasil').dataTable().fnReloadAjax();
    }

    function detail_tes(tesuser_id){
        window.open("<?php echo site_url().'manager/tes_hasil_detail'; ?>/index/"+tesuser_id);
    }

    function export_excel(){
       var tes = $('#pilih-tes').val();
        var group = $('#pilih-group').val();
        var waktu = $('#pilih-rentang-waktu').val();
        var urutkan = $('#pilih-urutkan').val();
        var status = $('#pilih-status').val();
    //  var keterangan = $('#pilih-keterangan').val();

        window.open("<?php echo site_url().'/'.$url; ?>/export/"+tes+"/"+group+"/"+waktu+"/"+urutkan+"/"+status, "_self");
    
    }

    $(function(){
        $('#pilih-rentang-waktu').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD H:mm'});

        $("#pilih-status").change(function(){
            if($('#pilih-status').val()=='mengerjakan'){
                $('#info-waktu').html('Rentang waktu peserta saat memulai Tes');
            }else{
                $('#info-waktu').html('Rentang waktu Tes dilaksanakan sesuai di Daftar Tes');
            }
        });
        $('#pilih-tes').click(function(){
            
                       $('#ket1').html('');
                       $('#ket2').html('');
                        $('#ket3').html('');
                        
                  
        });
        $('#btn-pilih').click(function(){
             var data =$('#form').serialize();
            $.ajax({
                    url:"<?php echo site_url().''.$url; ?>/cek",
                    type:"POST",
                   data:$('#form').serialize(),
                    cache: false,
                    success:function(data){
                      var obj = $.parseJSON(data);
                       $('#ket1').html(obj.mpl);
                       $('#ket2').html(obj.tkt);
                        $('#ket3').html(obj.kls);
                           console.log(obj);
                        console.log(obj.kls);
                    }
            });
            $("#modal-proses").modal('show');
            $('#check').val('0');
            refresh_table();
            $("#modal-proses").modal('hide');
        });

        $('#btn-edit-hapus').click(function(){
            $('#edit-pilihan').val('hapus');
            $('#form-edit').submit();
        });

        $('#btn-edit-hentikan').click(function(){
           $('#edit-pilihan').val('hentikan');
            $('#form-edit').submit(); 
        });

        $('#btn-edit-buka-tes').click(function(){
            $('#edit-pilihan').val('buka');
            $('#form-edit').submit();
        });

        $('#btn-edit-waktu').click(function(){
            $('#edit-pilihan').val('waktu');
            $('#waktu-menit').val('10');
            $("#modal-waktu").modal('show');
        });

        $('#btn-edit-waktu-simpan').click(function(){
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

        $('#form-edit').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/edit_tes",
                    type:"POST",
                    data:$('#form-edit').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#modal-waktu").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error(obj.pesan);
                        }
                    }
            });
            return false;
        });

       $('#table-hasil').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
                        {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"80px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"30px"},
                        {"bSearchable": false, "bSortable": false, "className" : "text-center", "sWidth":"20px"}],
                  "sAjaxSource": "<?php echo site_url().''.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "tes", "value": $('#pilih-tes').val()} );
                  }
         });          
    });
</script>