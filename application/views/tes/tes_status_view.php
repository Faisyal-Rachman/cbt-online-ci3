<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Hasil Ujian
	</h1>
	<ol class="breadcrumb">
	
		<li class="active">Hasil Tes</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="container-fluid">
            <div class="card">
              
               
					<table border="1">
  <tr>
   <th>No</th>
   <th>Tahun</th>
   <th>Jenis Lomba</th>
   <th>Juara</th>
   <th>Nama</th>
   <th>Sekolah</th>
   <th>ID</th> 
  </tr>
  <?php   
   for($a=0; $a < count($matpel); $a++)
   {
    print "<tr>";
    // penomeran otomatis
    print "<td>".$a."</td>";
    // menayangkan 
    print "<td>".$data[$a]['tahun']."</td>";
    print "<td>".$data[$a]['jenis']."</td>";
    print "<td>".$data[$a]['juara']."</td>";
    print "<td>".$data[$a]['nama']."</td>";
    print "<td>".$data[$a]['sekolah']."</td>";
    print "<td>".$data[$a]['id']."</td>";
    print "</tr>";
   }
  ?>
 </table>                       
				
                </div>
            </div>
        </div>
   
</section><!-- /.content -->


