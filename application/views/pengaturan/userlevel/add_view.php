<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Tambah Hak Akses
	
	</h1>

</section>

<!-- Main content -->
<section class="content">
<?php echo form_open('manager/userlevel/add','id="form-tambah-level" class="form-horizontal"')?>
<div class="row">
		<div class="col-md-4">
			<div class="card card-primary">
				<div class="card-header with-border">
					<h3 class="card-title">Level</h3>
				</div><!-- /.card-header -->
				
				<div class="card-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label class="col-sm-3 control-label">Level</label>
								<div class="col-sm-10">
									<input type="text" class="form-control input-sm" id="level" name="level" placeholder="Level">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-6 control-label">Keterangan</label>
								<div class="col-sm-10">
									<input type="text" class="form-control input-sm" id="keterangan" name="keterangan" placeholder="Keterangan Level">
								</div>
							</div>
						</div>
					</div>
					</div>
					
				</div>
			</div>
		
			
		</div>
		
		<div class="col-md-8">
			<div class="card card-primary">
				<div class="card-header with-border">
					<h3 class="card-title">Hak Akses</h3>
				</div><!-- /.card-header -->
				
				<div class="card-body">
                    <div id="form-pesan"></div>
				    <?php if(!empty($data_menu)){ echo $data_menu; } ?>
				</div>
				<div class="card-footer">
					<button type="submit" id="btn-simpan" class="btn btn-info pull-right">Simpan</button>
				</div>
			</div>
		
			
		</div>

    </div>
</form>
</section><!-- /.content -->

<script lang="javascript">
    $(function(){
        $('#form-tambah-level').submit(function(){
            $("#modal-proses").modal('show');
                $.ajax({
                    url:"<?php echo site_url(); ?>/manager/userlevel/add",
     			    type:"POST",
     			    data:$('#form-tambah-level').serialize(),
     			    cache: false,
      		        success:function(respon){
         		    	var obj = $.parseJSON(respon);
      		            if(obj.status==1){
      		                $("#modal-proses").modal('hide');
      		                $('#form-pesan').html(pesan_succ(obj.pesan));
                            setTimeout(function(){ window.open("<?php echo site_url(); ?>/manager/userlevel","_self"); }, 1000);
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