<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php if(!empty($site_name)){ echo $site_name; } ?>ee | <?php echo $title; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="<?=base_url()?>public/plugins/AdminLTE3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

	<!-- Datatables Buttons -->
	
    <link href="<?php echo base_url(); ?>public/plugins/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

    <!-- summernote dimatikan
    <link href="<?php echo base_url(); ?>public/plugins/summernote/summernote.css" rel="stylesheet" type="text/css" />
    -->

    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    
    
    <script src="<?=base_url()?>public/plugins/AdminLTE3/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery 2.1.4 -->
   
    <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>public/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->

    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>public/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>public/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	


    <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.reload.js" type="text/javascript"></script>
       <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/datatables-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
     <script src="<?php echo base_url(); ?>public/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
  
    
    <!-- summernote dimatikan
    <script src="<?php echo base_url(); ?>public/plugins/summernote/summernote.js" type="text/javascript"></script>
    -->

   

    <!-- datetimerange -->
    <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

    <!-- ckeditor -->
    <script src="<?php echo base_url(); ?>public/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    
    <!-- select2 -->
    <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/bower_components2/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?=base_url()?>assets/bower_components2/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
   
   

<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->

<script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->

<link href="<?php echo base_url () ?>assets/onsenui/css/onsenui.css" type="text/css" rel="stylesheet" media="all">



        <link href="<?php echo base_url () ?>assets/onsenui/css/onsen-css-components.css" type="text/css" rel="stylesheet" media="all">


  <link href="<?php echo base_url () ?>assets/onsenui/css/ionicons/css/ionicons.min.css" type="text/css" rel="stylesheet" media="all">
  <link href="<?php echo base_url () ?>assets/onsenui/css/ionicons/css/ionicons.css" type="text/css" rel="stylesheet" media="all">
  <link rel="stylesheet" href="<?php echo base_url () ?>assets/onsenui/css/font_awesome/css/fontawesome.css" type="text/css" media="all">
   <link rel="stylesheet" href="<?php echo base_url () ?>assets/onsenui/css/font_awesome/css/fontawesome.min.css" type="text/css" media="all">

        <script src="<?php echo base_url () ?>assets/onsenui/js/onsenui.min.js"></script> 

		<style type="text/css">
	#mypage .page__background {
		background-image: url('<?php echo base_url(); ?>assets/img/keyboard.jpg');background-repeat: repeat;
  background-attachment: fixed;
  background-position: center;
  opacity: 0.4;
}

    </style>
    <script type="text/javascript">
		function notify_success(pesan){
			new PNotify({
				title: 'Berhasil',
				text: pesan,
				type: 'success',
				history: false,
				delay:4000
			});
		}
        
        function notify_info(pesan){
			new PNotify({
				title: 'Informasi',
				text: pesan,
				type: 'info',
				history: false,
				delay:2000
			});
		}
    
		function notify_error(pesan){
			new PNotify({
				title: 'Error',
				text: pesan,
				type: 'error',
				history: false,
				delay:2000
			});
		} 


  </script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap.min.css">

	<script src="<?=base_url()?>public/plugins/AdminLTE3/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/AdminLTE3/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
	<style>
		/* Coded with love by Mutiullah Samim */
		body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			
		}
		.text-input--underbar{
			font-weight: bold;
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: none;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border:none;
			box-shadow:0px 3px 12px #999;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
		.login-form {
  text-align: center;
  width: 80%;
  margin: 60px auto 0;
}

input[type=email], input[type=password] {
  display: block;
  width: 100%;
  margin: 0 auto;
  outline: none;
  padding-top: 10px;
  padding-bottom: 10px;
}

.login-button {
  width: 100%;
  margin: 0 auto;
}

.forgot-password {
  display: block;
  margin: 8px auto 0 auto;
  font-size: 14px;
}


	</style>

	 <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>
</head>
<body>
  <?php 
            if(!empty($content)){
                echo $content; 
            }
            ?>

</body>
</html>