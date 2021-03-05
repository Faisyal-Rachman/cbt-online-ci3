<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Cetak Kartu Peserta
		
	</h1>
	
</section>

<!-- Main content -->
<section class="content">

	<div class="card bg-success">
        <div class="card-header">
			<?php echo form_open($url.'/kartu','id="form-kartu"'); ?>
                <div class="box">
                  

                    <div class="box-body">
                        <div class="form-group col-sm-6">
                            <label>Pilih Kelas</label>
							<div id="data-group">
								<select name="group" id="group" class="form-control input-sm">
									<?php if(!empty($select_group)){ echo $select_group; } ?>
								</select>
							</div>
                            <p class="help-block">Pilih Data Kelas Peserta yang akan di cetak</p>
                        </div>
                       
                        <?php if(!empty($hasil)){ echo $hasil; } ?>
                    </div>
					
					<div class="box-footer">
                        <button type="button" class="btn btn-warning" id="kartu">Cetak kartu</button>
                    </div>
                </div>
			<?php echo form_close(); ?> 
        </div>
    </div>
</section><!-- /.content -->



<script lang="javascript">
	$(function(){
        $('#kartu').click(function(){
			var grup_id = $('#group').val();
			window.open("<?php echo site_url().''.$url; ?>/cetak_kartu/"+grup_id);
		});
    });
</script>