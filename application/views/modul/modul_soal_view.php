<!-- Content Header (Page header) -->
<body class="sidebar-collapse">
<section class="content-header">
	<h1>
		Kelola Soal
		
	</h1>

</section>
  <?php echo form_open_multipart($url.'/tambah','id="form-tambah" class="form-horizontal"'); ?>
<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="container-fluid">
            <div class="card bg-light">
              
                <div class="card-body">
                    <div class="col-xs-2"></div>
                    <div class="col-xs-6">
                        <div class="form-group"> 
                        <div class="row">
                        <div class="col-sm-5"><label class="col-sm-4 control-label">Pilih Topik Soal </label>
                                <select name="topik" id="topik" class="form-control input-sm" style="width: 70%!important">
                                <?php if($topikid==0){
                                    ?>
                                      <option value="" disabled selected></option>
                                      <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                        <?php    }else{ 
                                    echo $ctop; ?>
                                     <?php if(!empty($select_topik)){ echo $select_topik; } ?>
                              <?php  } ?>
                         </select></div>

                            <div class="col-sm-5">
                                  <label class="col-sm-4 control-label">Tipe Soal</label>
                          
                           <select class="form-control input-sm" id="tambah-tipe" style="width: 50% !important" name="tambah-tipe">
                           <option value="1">Tipe Soal</option>
                               <option value="1">Pilihan Ganda</option>
                               <option value="2">Esai</option>
                               <option value="3">Jawaban Singkat</option>
                           </select>
                          
                             </div>
                       </div>
                        </div>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
               
            </div>
        </div>
    </div>
	<div class="row">
    <div class="container-fluid">
                <div class="card bg-light">
                  
                        <div class="card-header with-border">
                            <div class="card-title"><b>Topik Soal :</b> <span id="judul-tambah-soal"></span><span id="judul-tambah-soal1"></span></div>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div id="form-pesan"></div>
                            <div class="form-group">
                            <div class="row">
                               
                                <div class="col-sm-6">
                                    <input type="hidden" name="tambah-topik-id" id="tambah-topik-id" >
                                    <input type="hidden" name="tambah-soal-id" id="tambah-soal-id" >
                                    <input type="hidden" name="tambah-soal" id="tambah-soal" >
                                     
                                    <?= $optinput; ?>
                                     <?= $idinput; ?>
                                    <textarea class="textarea" id="tambah_soal" name="tambah_soal" style="width: 80%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    <p class="help-block"> Gambar dapat di copy langsung atau di upload terlebih dahulu. Adalah (*.jpg dan *.png)</p>
                                </div>
                                <div class="col-md-6"> 
                    <div class="form-group hide" id="kolom-jawaban">
                    <?= $option; ?>

</div>
                         <div class="form-group hide" id="form-tambah-jawaban">
                                <label class="col-sm-8 control-label">Kunci Jawaban</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" id="tambah-kunci-jawaban-singkat" name="tambah-kunci-jawaban-singkat" >
                                    <p class="help-block">
                                        Kunci Jawaban untuk Tipe Soal Jawaban Singkat.
                                         </p>
                                </div>
                            </div> </div>
                            </div></div>
                            <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label">File Audio</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" id="tambah-nama-audio" name="tambah-nama-audio" readonly>
                                </div>
                              
                                <div class="col-sm-4">
                                    <input type="file" id="tambah-audio" name="tambah-audio" >
                                            </div> 
                                
                                 </div>
                                
                            </div>
                       
                            <div class="form-group">
                           
                            <div class="form-group">
                            <div class="row">
                     
                           <label class="col-sm-2 control-label">Tingkat Kesulitan</label>
                                <div class="col-sm-4">
                                    <select class="form-control input-sm" id="tambah-kesulitan" name="tambah-kesulitan">
                                        <option value="1">Mudah</option>
                                        <option value="2">Sedang</option>
                                        <option value="3">Sulit</option>
                             </select>
                                </div>
                           </div>
                            </div>
                                                  
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-xs-10 float-right">
                                <button type="submit" id="btn-tambah-simpan" class="btn btn-primary"><span id="judul-tambah-simpan">Simpan</span></button>
                                    <button type="button" id="btn-tambah-batal" class="btn btn-default"><span>Batal</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
   

    
    <div class="card-body">
                <div class="col-xs-20">
                    <div class="card-header with-border">
                        <div class="card-title"><b># List Soal dalam Topik</b> <span id="judul-daftar-soal"></span><span id="judul-daftar-soal1"></span></div>
                        <div class="card-tools pull-right">
                            <div class="dropdown pull-right">
                            <a class="btn btn-outline-warning btn-sm" style="cursor: pointer;" onclick="refresh_table()">Refresh</a>
                            </div>
                        </div>
                    </div><!-- /.card-header -->

                   <div class="row">
             <div class="container-fluid">
                    <div class="card">
                        <div class="card-header with-border">
                            <div class="card-title">Soal dan Jawaban</div>
                            <div class="card-tools pull-right">
                                <a href="#" onclick="refresh_table()">Refresh Detail Tes</span></a>
                            </div>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <table id="table-soal" class="table borderless table-sm">
                                
                                <tbody>
                                    <tr>
                                        
                                        
                                        <td> </td>
                                    </tr>
                                </tbody>
                            </table>                        
                        </div>
                    </div>
            </div>
        </div>
                </div>
        </div>
    


        <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-image" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Masukkan Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?php echo form_open_multipart($url.'/upload_file','id="form-upload-image" class="form-horizontal"'); ?>
                                        <div class="card">
                                          
                                            <div class="card-body">
                                                <div class="row-fluid">
                                                    <div class="card-body">
                                                        <div id="form-pesan-upload-image"></div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">File</label>
                                                            <div class="col-sm-10">
                                                                <input type="hidden" id="image-topik-id" name="image-topik-id" >
                                                                <input type="file" id="image-file" name="image-file" >
                                                                <p class="help-block">File yang didukung adalah jpg, jpeg, png</p>
                                                            </div>
                                                            <button type="submit" id="image-upload" class="btn btn-primary">Upload File</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xs-6">
                                        <div class="card hide" id="card-preview" >
                                            <div class="card-body">
                                                <div class="row-fluid">
                                                    <div class="card-body" style="height: 10rem;">
                                                        <input type="hidden" name="image-isi" id="image-isi">
                                                        <div id="image-preview" style="text-align: center;vertical-align: middle;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="btn-image-insert" class="btn btn-primary">Masukkan Gambar</button>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row">
                            <div class="container-fluid">
                                    <div class="card">
                                        <div class="card-body" style="max-height: 50rem;overflow-y:auto;">
                                            <table id="table-image" class="table table-bordered table-hover table-sm">
                                            <thead class="table table-primary">
                                                    <tr>
                                                       
                                                      
                                                        <th>Preview</th>
                                                         <th> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                       
                                                      
                                                        <td> </td>
                                                        <td> </td>
                                                    </tr>
                                                </tbody>
                                            </table>                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-hapus-soal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <?php echo form_open($url.'/hapus_soal','id="form-hapus-soal"'); ?>
    <div class="modal-dialog modal-notify modal-info modal-md">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title"><b>Hapus soal</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="nav-icon fas fa-window-close"></i></button>
               
                </div>
                <div class="modal-body">
                    <div class="row-fluid">
                        <div class="card-body">
                            <div id="form-pesan-hapus"></div>
                            <div class="form-group">
                                <label>Soal</label>
                                <input type="hidden" name="hapus-id" id="hapus-id">
                                <div id="hapus-soal"  style="max-height: 250px;overflow: auto;"></div>
                            </div>
                            <p>Perhatian, soal yang dihapus akan membuat daftar jawaban ikut terhapus.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-hapus-soal" class="btn btn-primary">Hapus</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>

    </form>
    </div>
</section><!-- /.content -->



<script type="text/javascript">
function check(input)
    {
    	
    	var checkboxes = document.getElementsByClassName("radioCheck");
    	
    	for(var i = 0; i < checkboxes.length; i++)
    	{
    		//uncheck all
    		if(checkboxes[i].checked == true)
    		{
    			checkboxes[i].checked = false;
    		}
    	}
    	
    	//set checked of clicked object
    	if(input.checked == true)
    	{
    		input.checked = false;
    	}
    	else
    	{
    		input.checked = true;
    	}	
    }
var body = document.body;
body.classList.add("sidebar-collapse");


    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
    
    function refresh_table(){
        $('#table-soal').dataTable().fnReloadAjax();
    }

    function refresh_table_image(){
        $('#table-image').dataTable().fnReloadAjax();
    }
	
	function refresh_topik(){
        var judul = $('#topik option:selected').text();
        $('#judul-daftar-soal').html(judul);
        $('#judul-tambah-soal').html(judul);
        var judul2 = $('#topik2 option:selected').text();
        $('#judul-daftar-soal1').html(judul2);
        $('#judul-tambah-soal1').html(judul2);

	}
    $('#tambah-tipe').click(function(){
            
            $('#jawaban_detail5').html('');
                   <?php 
                   
               for ($i = 1; $i <= $op1; $i++){
        echo "CKEDITOR.instances.jawaban_detail$i.setData('');";
       echo "$('#collapse$i').removeClass('show');";   
            }
  
         ?> 

                  
        });

    function edit(id){
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
     
            if(data.data==1){
                $("#form-pesan").html('');
                $('#tambah-soal').val('');
             
                CKEDITOR.instances.tambah_soal.setData(data.soal);
   //     CKEDITOR.instances.jawaban_detail1.setData(data.pilganda".$i.");
               // console.log(data.pilganda2);
                <?php 
               for ($i = 1; $i <= $op1; $i++){
               echo "CKEDITOR.instances.jawaban_detail".$i.".setData(data.pilganda".$i.");";
            echo "$('#jawaban-id".$i."').val(data.jawaban_id".$i.");";
           
            }
  
         ?> 

                $('#tambah-tipe').val(data.tipe);
                $('#tambah-topik-id').val(data.id_topik);
                $('#tambah-soal-id').val(data.id);
                $('#tambah-putar').val(data.putar);
                $('#tambah-audio').val('');
				$('#tambah-kesulitan').val(data.kesulitan);
                $('#tambah-nama-audio').val(data.audio);
                $('#topik').val(data.id_topik);
                if(data.tipe==3){
                    $('#form-tambah-jawaban').removeClass('hide');
                    $('#tambah-kunci-jawaban-singkat').val(data.kunci);
                }
                if(data.tipe==1){
                    $('#kolom-jawaban').removeClass('hide');
                   $('#form-tambah-jawaban').addClass('hide');
                }
                $('html, body').animate({
                    scrollTop: $("#form-tambah").offset().top
                }, 500);
            }
            $("#modal-proses").modal('hide');
        });
    }

    function hapus(id){
        $('#hapus-id').val('');
        $('#hapus-soal').html('');
        $('#form-pesan-hapus').html('');
        $("#modal-proses").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
            if(data.data==1){
                $('#hapus-id').val(data.id);
                $('#hapus-soal').html(data.soal);
                
                $("#modal-hapus-soal").modal("show");
            }
            $("#modal-proses").modal('hide');
        });
    }

    function jawaban(id){
        window.open('<?php echo site_url(); ?>/manager/modul_jawaban/index/'+id);
    }

    /**
     * Fungsi untuk upload image dari editor text
     */
    function imageUpload(){
        $('#card-preview').addClass('hide');
        $('#image-preview').html('');
        $('#form-pesan-upload-image').html('');
        $('#image-isi').val('');
        $('#image-file').val('');

        refresh_table_image();

        $("#modal-image").modal("show");
    }

    function image_preview(posisi, image){
        $('#image-preview').html('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-height: 110px;" />');
        $('#image-isi').val('<img src="<?php echo base_url(); ?>'+posisi+'/'+image+'" style="max-width: 600px;" />');
        $('#card-preview').removeClass('hide');
    }

    function batal_tambah(){
        
        $("#form-pesan").html('');
        $('#tambah-topik-id').val('');
        $('#tambah-soal-id').val('');
        $('#tambah-soal').val('');
        $('#tambah-putar').val('0');
        $('#tambah-audio').val('');
        $('#tambah-nama-audio').val('');
        $('#tambah-tipe').val('1');
		$('#tambah-kesulitan').val('1');
        $('#tambah-kunci-jawaban-singkat').val('');
     
     
     
        $('#form-tambah-jawaban').removeClass('hide');
        $('#form-tambah-jawaban').addClass('hide');
        $('#kolom-jawaban').removeClass('hide');
        $('#kolom-jawaban').addClass('hide');
        CKEDITOR.instances.tambah_soal.setData('');
        $.clearInput = function(){
    $('form').find('input[type=text],textarea').val('');
}
 $('#collapse').on('hidden',function(){
    $.clearInput();
 });
    }

    $(function(){
       
        
        $("#topik").change(function(){
            refresh_topik();
            refresh_table();
          <?= $cisiopt; ?>
            CKEDITOR.instances.tambah_soal.setData('');
        $.clearInput = function(){
    $('form').find('input[type=text],textarea').val('');
}
 $('#collapse').on('hidden',function(){
    $.clearInput();
 });
        });

        $('#tambah-audio').change(function(e){
            var fileName = e. target. files[0]. name;
            $('#tambah-nama-audio').val(fileName);
        });

        $('#btn-image-insert').click(function(){
            var image = $('#image-isi').val();
            CKEDITOR.instances.tambah_soal.insertHtml(image);
            <?php 
   if($jenjang='sma'){
  $i = 1;
   for($i; $i<4;){
    echo "CKEDITOR.instances.jawaban_detail[$i].insertHtml(image);";
       $i++;
   }
}
?>
            $("#modal-image").modal("hide");
        });

        $('#tambah-tipe').change(function(e){
            var tipe = $('#tambah-tipe').val();

            if(tipe==3){
                $('#form-tambah-jawaban').removeClass('hide');
                $('#kolom-jawaban').addClass('hide');
            }else if(tipe==1){
                $('#kolom-jawaban').removeClass('hide');
                 $('#form-tambah-jawaban').addClass('hide');
            }else{
                $('#kolom-jawaban').addClass('hide');
                $('#form-tambah-jawaban').addClass('hide');
            }
        });

        $('#btn-tambah-batal').click(function(){
            batal_tambah();
        });

        /**
         * Submit form tambah soal
         */
        $('#form-tambah').submit(function(){
         var i = CKEDITOR.instances;
            $('#tambah-soal').val(CKEDITOR.instances.tambah_soal.getData());
            $('#tambah-topik-id').val($('#topik').val());
            $("#modal-proses").modal('show');
            <?= $isiopt; ?>
        
         // CKEDITOR.instances.jawaban_detail[i].getData();
         
         // CKEDITOR.instances.jawaban_detail[1].getData();
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/tambah",
                    type:"POST",
                    timeout: 60000,
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            batal_tambah();
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan').html(pesan_err('OKE'));
                          
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modal-proses").modal('hide');
                            notify_error("Gagal menyimpan Soal, Silahkan Refresh Halaman");
                        }else{
                            $("#modal-proses").modal('hide');
                            notify_error('Pilih jawaban terlebih dahulu');
                        }
                    }
            });
            return false;
        });

        /**
         * Submit form hapus soal
         */
        $('#form-hapus-soal').submit(function(){
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/hapus_soal",
                    type:"POST",
                    data:$('#form-hapus-soal').serialize(),
                    cache: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-hapus").html('');
                            $("#modal-hapus-soal").modal('hide');
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-hapus').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });

        /**
         * Submit form upload pada image browser
         */
        $('#form-upload-image').submit(function(){
            $('#image-topik-id').val($('#topik').val());
            $("#modal-proses").modal('show');
            $.ajax({
                    url:"<?php echo site_url().'/'.$url; ?>/upload_file",
                    type:"POST",
                    data:new FormData(this),
                    mimeType: "multipart/form-data",
                    contentType:false,
                    cache: false,
                    processData: false,
                    success:function(respon){
                        var obj = $.parseJSON(respon);
                        if(obj.status==1){
                            refresh_table();
                            $('#image-preview').html(obj.image);
                            $('#image-isi').val(obj.image_isi);
                            $('#card-preview').removeClass('hide');
                            $("#modal-proses").modal('hide');
                            $("#form-pesan-upload-image").html('');
                            $('#image-file').val('');
                            refresh_table_image();
                            notify_success(obj.pesan);
                        }else{
                            $("#modal-proses").modal('hide');
                            $('#form-pesan-upload-image').html(pesan_err(obj.pesan));
                        }
                    }
            });
            return false;
        });
		 
		$( document ).ready(function() {
            refresh_topik();
            $('#table-soal').DataTable({
                 "paging": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "info": false,
                  "ordering": false,
                  "aoColumns": [
                        
                        {"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false}],
                  "sAjaxSource": "<?php echo site_url().''.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                  }
         });

            $('#table-image').DataTable({
                  "bPaginate": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        
                      
                      //  {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"90px"},
                        {"bSearchable": false, "bSortable": false, "sWidth":"50px"}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable_image/",
                  "autoWidth": false,
                  "fnServerParams": function ( aoData ) {
                    aoData.push( { "name": "topik", "value": $('#topik').val()} );
                  }
            });

         //   CKEDITOR.replace('tambah_soal');
         
CKEDITOR.replaceAll();
     
          
            <?php if(!empty($data_soal)){ echo $data_soal; } ?>
		});
    });
   
</script>