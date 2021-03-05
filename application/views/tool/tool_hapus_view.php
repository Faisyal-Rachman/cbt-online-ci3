<html>
<head>
  <title>Multiple Delete</title>
  <style>
  table {
    border-collapse: collapse;
  }
  table, td, th {
    border: 1px solid black;
  }
  </style>
    
    <!-- Load librari/plugin jquery nya -->
  <script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script> 
</head>
<body>
  <h1>Data Siswa</h1>
    
    <form method="post" action="<?php echo base_url('index.php/siswa/delete') ?>" id="form-delete">
      <table border="1" cellpadding="5">
      <tr>
        <th><input type="checkbox" id="check-all"></th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Telepon</th>
        <th>Alamat</th>
      </tr>
      <?php
      if( ! empty($siswa)){
        $no = 1;
        foreach($siswa as $data){
          echo "<tr>";
          echo "<td><input type='checkbox' class='check-item' name='nis[]' value='".$data->nis."'></td>";
          echo "<td>".$data->nis."</td>";
          echo "<td>".$data->nama."</td>";
          echo "<td>".$data->telp."</td>";
          echo "<td>".$data->alamat."</td>";
          echo "</tr>";
          $no++;
        }
      }
      ?>
      </table>
        <hr>
        <button type="button" id="btn-delete">DELETE</button>
    </form>
    
    <script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
    });
  });
  </script>
</body>
</html>