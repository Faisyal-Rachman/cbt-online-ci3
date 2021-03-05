<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php if(!empty($site_name)){ echo $site_name; } ?> | <?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=0.9, minimum-scale=0.1, maximum-scale=10, user-scalable=yes' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url(); ?>public/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>public/plugins/adminlte/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
  
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>public/plugins/adminlte/js/app.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.reload.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>public/plugins/pnotify/pnotify.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>public/app.js" type="text/javascript"></script>
    

    <link href="<?php echo base_url () ?>assets/onsenui/css/onsenui.css" type="text/css" rel="stylesheet" media="all">
     <link href='<?php echo base_url () ?>manifest.json' rel='manifest'>
     <link href='<?php echo base_url () ?>manifest.webmanifest' rel='manifest'>
     <link href="<?php echo base_url () ?>assets/onsenui/css/onsen-css-components.css" type="text/css" rel="stylesheet" media="all">
<link rel="manifest" href="<?php echo base_url () ?>manifest.json">    
<link rel="manifest" href="<?php echo base_url () ?>manifest.webmanifest">
  <link href="<?php echo base_url () ?>assets/onsenui/css/ionicons/css/ionicons.min.css" type="text/css" rel="stylesheet" media="all">
  <link href="<?php echo base_url () ?>assets/onsenui/css/ionicons/css/ionicons.css" type="text/css" rel="stylesheet" media="all">
  <link rel="stylesheet" href="<?php echo base_url () ?>assets/onsenui/css/font_awesome/css/fontawesome.css" type="text/css" media="all">
   <link rel="stylesheet" href="<?php echo base_url () ?>assets/onsenui/css/font_awesome/css/fontawesome.min.css" type="text/css" media="all">

        <script src="<?php echo base_url () ?>assets/onsenui/js/onsenui.min.js"></script> 
 
   <link rel="stylesheet" href="<?= base_url('assets/bootstrap-4.3.1-dist/css/bootstrap.css') ?>" />

    <!-- membuat gambar responsive pada soal -->
    <style type="text/css">
      .borderless td, .borderless th{
        border : none;
      }
    div label input {
   margin-right:100px;
}
body {
    font-family:sans-serif;
}
#btn-hentikan {
  display:none;
}
.jwb{
  margin-top:6px;
}
.txtjwb{
  padding-top:20px;
}
.notxtjwb{
 padding-top:26px;
}
#ck-button {
    margin:10px;
    background-color:#efeff4;
    border-radius:80px;
    padding:0px 0px;
    border:3px solid #4b3588;
    overflow:auto;
    float:left;
}


#ck-button label {
    float:left;
    width:2.0em;
}

#ck-button label span {
    text-align:center;
   
    padding:2px 0px;
    display:block;
}

#ck-button label input {
    position:absolute;
    top:-20px;
}

#ck-button input:checked + span {
    background-color:#4b3588;
    margin-top:5px;
    padding:2px 2px;
    color:#fff;
}
    .skin-blue .main-header .navbar {
    background-color: #4b3588 !important;
}
skin-blue .main-header li.user-header {
    background-color: #4b3588 !important;
}
ol.d {
  list-style-type:lower-alpha;
}
    .menubawah{
      position:absolute;
      bottom:0;
    }
    .modal{
      position : none !important
    }
      #isi-tes-soal img {
        display: block;
        max-width: 100%;
        height: auto;
      }
    </style>

    <script type="text/javascript">
    function notify_success(pesan){
      new PNotify({
        title: 'Jawaban',
        text: pesan,
        type: 'success',
        history: false,
        delay:2000
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
  </head>

  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container">
       
           
            <div class="navbar-custom-menu">
            <img src="<?php echo base_url(); ?>public/images/avatar.png" class="navbar-brand" width="30px" alt="User Image" /> 
            <div class="navbar-brand text-info"> <b><?php if(!empty($site_name)){ echo $site_name; } ?></b></div>
           
                <ul class="nav navbar-nav"> 
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                   <p></p>
                  
                    <button class="btn btn-light btn-sm" id="btn-hentikan"> Selesai</button> 
                   
                  </li>
 <ul class="nav navbar-nav">
                    <li></li>
                  </ul>
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="<?php echo base_url(); ?>public/images/avatar.png" class="user-image" alt="User Image" />
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php if(!empty($nama)){ echo $nama; }else{ echo 'User Tes'; } ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header" style="max-height: 70px;">
                        <p>
                          <?php if(!empty($nama)){ echo $nama; }else{ echo 'User Tes'; } ?>
                          <?php if(!empty($group)){ echo ' | '.$group; } ?>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        
                          <a href="<?php echo site_url(); ?>/welcome/logout" class="btn btn-default btn-flat">Log out</a>
                       
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
      <ons-page>
            <?php 
            if(!empty($content)){
                echo $content; 
            }
            ?>
            
      </div><!-- /.content-wrapper -->
     
    </div><!-- ./wrapper -->

  
   

  <script type="text/javascript">
    $(function () {
        var serverTime = <?php if(!empty($timestamp)){ echo $timestamp; } ?>;
        var counterTime=0;
        var date;

        setInterval(function() {
          date = new Date();

          serverTime = serverTime+1;

          date.setTime(serverTime*1000);
          time = date.toLocaleTimeString();
          $("#timestamp").html(time);
        }, 1000);

        $('#modal-password').on('shown.bs.modal', function (e) {
          $('#form-pesan-password').html('');
          $('#password-old').val('');
          $('#password-new').val('');
          $('#password-confirm').val('');
          $('#password-old').focus();
        });
        
        $('#form-password').submit(function(){        
          $.ajax({
            url:"<?php echo site_url(); ?>/tes_dashboard/password",
            type:"POST",
            data:$('#form-password').serialize(),
            cache: false,
            success:function(respon){
              var obj = $.parseJSON(respon);
              if(obj.status==1){
                $('#form-pesan-password').html('');
                $('#modal-password').modal('hide');
                notify_success('Password berhasil diubah');
              }else{
                $('#form-pesan-password').html(pesan_err(obj.error));
              }
            }
          });
          return false;
        });
    });
  </script>

<script type="text/javascript">
    function zoombesar(){
        $('#isi-tes-soal').css("font-size", "140%");
        $('#isi-tes-soal').css("line-height", "140%");
    }

    function zoomnormal(){
        $('#isi-tes-soal').css("font-size", "15px");
        $('#isi-tes-soal').css("line-height", "110%");
    }

   
   


    function audio_ended(status){
        if(status==1){
            $('#audio-control').addClass('hide');
        }else{
            $('#audio-player-status').val('0');
            $('#audio-player-judul').html('Play');
            $('#audio-player-judul-logo').removeClass('fa-pause');
            $('#audio-player-judul-logo').addClass('fa-play');
        }
    }

    function jawab(){
        $('#form-kerjakan').submit();
    }

   

   
</script>


  </body>
</html>
