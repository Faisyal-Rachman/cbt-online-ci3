<body style="background-image: url('<?php echo base_url(); ?>assets/img/keyboard.jpg');background-repeat: repeat;
  background-attachment: fixed;
  background-position: center;">
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="<?php echo base_url(); ?>assets/img/logologin.png" class="brand_logo" alt="Logo">
					</div>
				</div>
			
				<div class="d-flex justify-content-center form_container">
				<?php echo form_open('welcome/login','id="form-login" class="form-horizontal"')?>
					<div id="form-pesan">
						</div>
					<div class="form-group">
							<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" id="username" name="username" class="form-control input_user" value="" placeholder="username">
						</div>
						</div>
						
						<div class="form-group">
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password"id="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
						
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="button" id="btn-login" class="btn btn-success pull-right">Login</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						<p class="text-light">Masukkan Username dan Password</p>
					</div>
					<div class="d-flex justify-content-center links">
						<font style="color:lavender; font-size:20px;"><span id="span"></span></font>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <div class="modal" id="modal-proses" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
                    Load data.. Selamat Ujian!
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->





	<script type="text/javascript">
var span = document.getElementById('span');
setInterval(time, 1000);
function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = h + ":" + m + ":" + s;
}
</script>


<script type="text/javascript">
setInterval(time, 1000);
    $(function () {
        $('#username').focus();   
        
        $('#btn-login').click(function(){
            $('#form-login').submit();
        });
        
        $('#form-login').submit(function(){
            $("#modal-proses").modal('show');
                $.ajax({
                    url:"<?php echo site_url(); ?>/welcome/login",
     			    type:"POST",
     			    data:$('#form-login').serialize(),
     			    cache: false,
      		        success:function(respon){
         		    	var obj = $.parseJSON(respon);
      		            if(obj.status==1){
      		              window.open("<?php echo site_url(); ?>/tes_dashboard","_self");
          		        }else{
                            $('#form-pesan').html(pesan_err(obj.error));
                            $("#modal-proses").modal('hide');
          		        }
         			}
      		});
            
      		return false;
        });    
    });
</script>