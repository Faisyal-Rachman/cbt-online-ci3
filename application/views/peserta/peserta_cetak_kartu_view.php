<html>
<head>
	<title>Cetak Kartu Peserta</title>
	<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
</head>
<style>
	table {
	
		border: 0px;
		padding: 2px;
		font-size: 0.75em; 
		color: #000 !important; 
		font-family: Verdana, Arial, sans-serif; 
	}
	
	td {
		vertical-align: top;		
	}
	
	hr {
		border: 0.5px solid black;
	}
	
	.header {
		text-align: center;
		font-weight: bold;
		font-size: 1.5em;
	}
	
	.kartu {
		width: 300px;
		height: 330px;
		border: 2px solid black;
		border-radius: 8px;
		padding: 2px;
		margin: 6px;
		display: inline-block;
		position: relative;
  text-align: center;
  color: black;
	}
	.centered {
  width: 340px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

</style>

<body>
	<?php
		if(!empty($kartu)){
			echo $kartu;			
		}
	?>
	
	<script lang="javascript">
		$(function(){
			window.print();
		});
	</script>
</body>
</html>