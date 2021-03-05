<div class="container">

	<!-- Main content -->
    <section class="content">
       <br><br>
        <div class="card card-success card-solid">
         
            <div class="card-body">
            <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-sm">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
             
              <div class="card">
              <div class="card-header">
                <h3 class="card-title text-info">Pengumuman :</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php 
                
                foreach($pengumuman as $infobaru){
                  ?>
               <li class="item">
                  
                  <div class="product-info">
                  <a onclick="edit('<?= $infobaru->info_id ?>')" class="product-title text-info"><?= $infobaru->info_id ?> <?= $infobaru->info_judul ?>
                      <span class="badge badge-info float-right"><?= $infobaru->info_kategori ?> <?= $infobaru->info_tgl ?></span></a>
                    <span class="product-description">
                    <?php $intro = substr($infobaru->info_isi,0,200);
                    echo $intro; ?>
                    </span>
                  
                  </div>
                </li>
               <?php 
                }?>

                  
                  
                  <!-- /.item -->
                
                  <!-- /.item -->
                
                  <!-- /.item -->
                 
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
            
              <!-- /.card-footer -->
            </div>
              </div>
            </div>
          </div>
          <!-- ./col -->
        
          <!-- ./col -->
        
          <!-- ./col -->
         
          <!-- ./col -->
        </div> 
            </div><!-- /.card-body -->
        </div><!-- /.card -->
        <div style="max-height: 100%;overflow-y:auto;" class="modal" id="modal-info" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModalEdit" aria-hidden="true">
       <?php echo form_open($url.'/edit','id="form-edit"'); ?>
       <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title"><div id="info-judul"></div></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <i class="nav-icon fas fa-window-close"></i></button>
                </div>
                <div class="modal-body">
                <div class="container-fluid">
                <div class="row">
                       
                        <div class="col-sm">
                
                <div class="form-group">
                <label><div id="info-kategori"></div></label>
               
              <div id="info-isi"></div>
              <label><div id="info-tgl"></div></label>
                </div>
                </div>
             
                
                    </div>
                </div>
             
            </div>
        </div>

    </form>
    </div>
    </section><!-- /.content -->
</div><!-- /.container -->

<script type="text/javascript">
  function edit(id){
        $("#modal-info").modal('show');
        $.getJSON('<?php echo site_url().'/'.$url; ?>/get_by_id/'+id+'', function(data){
           
              var judul = 'oke';
    
                $('#info-judul').html(data.judul);
                $('#info-isi').html(data.isi);
                $('#info-kategori').html(data.kategori);
                $('#info-tgl').html(data.tgl);
             
                $("#modal-info").modal("show");
        });
    }
    $(function () {
        $('#btn-hentikan').addClass('hide');
        $('#table-tes').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "aoColumns": [
                        
                    {"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                      
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false,}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true
         });   
    });
</script>