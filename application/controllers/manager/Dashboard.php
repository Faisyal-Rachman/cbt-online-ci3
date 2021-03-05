<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Member_Controller {
	private $username;
    private $user_id;
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_model', 'master');
		$this->load->model('cbt_konfigurasi_model');
		$this->load->model('cbt_tes_user_model');
		$this->load->model('cbt_tes_soal_model');
		$this->load->model('cbt_tes_model');
	}
    
    public function index(){
		
		 $this->load->helper('form');
		
        $data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'CBT SMKN PASTI BISA',
			'subjudul' => 'Dashboard',
			'siswa'	=> $this->master->get_count_user(),
			'soal'	=> $this->master->get_count_soal(),
			'kelas'	=> $this->master->get_count_kelas(),
			'topiksoal'	=> $this->master->get_count_topiksoal(),
			'token'	=> $this->master->get_token()
		];
	
       
		$data['gambar'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 5);
        $data['nama'] = $this->access->get_nama();
		$data['keterangan'] = $this->access->get_keterangan();
        $data['post_max_size'] = ini_get('post_max_size');
        $data['upload_max_filesize'] = ini_get('upload_max_filesize');
		$data['waktu_server'] = strtotime('2020-08-17 23:33:16');
		$data['date'] = date("Y-m-d", STRTOTIME(('2020-08-11 23:33:16')));

        $dir1 = './public/uploads/';
        $dir2 = './uploads/';

        $data['dir_public_uploads'] = 'Not Writeable';
        if(is_writable($dir1)){
        	$data['dir_public_uploads'] = 'Writeable';
        }

        $data['dir_uploads'] = 'Not Writeable';
        if(is_writable($dir2)){
        	$data['dir_uploads'] = 'Writeable';
        }

        $this->template->display_admin('manager/dashboard_view', 'Dashboard', $data);
	}
	 function get_by_id($id){
    $cs = $this->cbt_tes_user_model->tampilstatusbyid($id);
    foreach($cs->result_array() as $cstat) {
		$data['tes'] = $cstat['user_birthdate'];
	
		echo json_encode($data);
    }}
	
	function status($tesid){
		$this->load->library('access_tes','access');
		$nama = $this->access->get_nama();
		$user_id = $this->access_tes->get_userid();
		$cs = $this->cbt_tes_user_model->tampilstatus($tesid);
		$bd = $this->cbt_tes_soal_model->count_by_kolom_st($user_id);
	    $bs =  $this->cbt_tes_soal_model->count_soal($user_id);

		
		foreach($bs->result_array() as $cst) {
			$cek = $cst['banyaksoal'];
		//	echo $cek;
		}
		$rows=$cs->num_rows();
		if($rows>0){
		foreach($cs->result_array() as $cstat) {
			if($cstat['tesuser_status']==1){
				$stat = 'Sedang mengerjakan ujian...';
				$us = '<i class="fas fa-user-edit"></i> ';
			}else{
				$stat = '<font class="text-muted"><b>Selesai!</b></font>';
				$us = '<font class="text-muted"><i class="fas fa-user-check"></i></font>';
			}
			$bar = $cstat['jawab'] / $cstat['hasil'] * 100;
		$output = '<div class="col-md-12 col-sm-6 col-12">
		<div class="text-dark">
		  <span class="info-box-icon">'.$us.' <b>'.$cstat['user_birthdate'].'</b> ['.$cstat['user_firstname'].']</span>

		  <div class="info-box-content">
			<span class="info-box-text">Jurusan :  '.$cstat['user_jurusan'].' - Sesi : '.$cstat['user_sesi'].'</span>
			<div class="progress">
			  <div class="progress-bar text-light" style="width: '.floor($bar).'%"></div>
			</div>
			<span class="progress-description text-info">
			<b>'.floor($bar).'% </b>'.$stat.' <b>'.$cstat['tes_nama'].' : '.$cstat['tes_jenis'].'</b>
			</span>
		  </div>
		  <br>
		  <!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
		 </div>';
	 
	
	echo $output;
}
		}else{
			echo '<div class="col-md-12 col-sm-6 col-12">
			<div class="text-dark">
			  <span class="info-box-icon"></span>
	
			  <div class="info-box-content">
				<span class="info-box-text">TIDAK ADA UJIAN</span>
				<div class="progress">
				  <div class="progress-bar text-light" style="width: 0%"></div>
				</div>
				<span class="progress-description">
				
				</span>
			  </div>
			  <br>
			  <!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		  </div>';
		}

	}
	function statusujian(){
			$query_tes = $this->cbt_tes_model->get_by_kolom_limit_aktif();
			
			$rows=$query_tes->num_rows();
		if($rows>0){
			$hd = '<table class="table table-bordered table-striped table-sm" style="text-align:center">
			<thead class="table table-info">
	<tr>
	<th>Nama Ujian</th>
	<th>Mata Pelajaran</th>
	<th>Token</th>
	<th>Detail</th>
	</tr>
	</thead>
	<tbody>';
	echo $hd;
	
		foreach($query_tes->result_array() as $cstat) {
			
	$output = '
<tr> 
<td width="220px"><b>'.$cstat['tes_nama'].'</b></td>
<td>'.$cstat['modul_nama'].'</td>
<td width="180px">'.$cstat['tesuser_token'].'</td>
<td width="200px"><button class="btn btn-info btn-sm" onclick="move('.$cstat['tes_id'].')">Lihat Status Siswa ujian</button> 
</td>
</tr>
';

	echo $output;
}
$ft = '</tbody>

</table>';
		}else{
			echo '<table class="table table-bordered table-striped table-sm">
			<thead class="table table-dark">
	<tr>
	<th>Nama Ujian</th>
	<th>Mapel</th>
	<th>Token</th>
	<th>Detail</th>
	</tr>
	</thead>
	<tbody>
	<tr> 
	<td width="120px">-</td>
	<td>TIDAK ADA UJIAN</td>
	<td>TIDAK ADA UJIAN</td>
	<td width="100px">-</td>
	</tr>
	</tbody>
	
	</table>';
		}

	}
	function rank(){
		$this->load->library('access_tes','access');
		$tesid = 29;
		$query_rank = $this->cbt_tes_soal_model->get_peringkat();
		$rows=$query_rank->num_rows();
	if($rows>0){
		$hd = '<table class="table table-striped table-sm">
		<thead class="table table-info">
<tr>
<th colspan="5"> <i class="fa fa-hashtag fa-1x" aria-hidden="true"></i>   Peringkat 10 Besar  </th>
</tr>
</thead>
		<thead class="table table-info">
<tr>
<th>No.</th>
<th>Nama Siswa</th>
<th>Kelas</th>
<th>Skor Rata - Rata </th>
<th>Rangking</th>
</tr>
</thead>
<tbody>';
echo $hd;
$i = 0;
	foreach($query_rank->result_array() as $cstat) {
	if($cstat['nilai']>5){
$peringkat = 'Peringkat';
	
		
			//$rank = 'Peringkat 1';
		
		$i = $i + 1;
$output = '
<tr> 
<td width="50px">'.$i.'</td>
<td width="120px">'.$cstat['user_birthdate'].'</td>
<td width="100px">'.$cstat['level_nama'].'</td>
<td width="100px">'.$cstat['nilai'].'</td>
<td width="100px">'.$peringkat.' '.$cstat['rank'].'</td>
</tr>
';

echo $output;
}		
}
$ft = '</tbody>

</table>';
	}else{
		echo '<table class="table table-bordered table-striped table-sm">
		<thead class="table table-dark">
<tr>
<th>Nama Ujian</th>
<th>Mapel</th>
<th>Token</th>
<th>Detail</th>
</tr>
</thead>
<tbody>
<tr> 
<td width="120px">TIDAK ADA UJIAN </td>
<td>TIDAK ADA UJIAN</td>
<td>TIDAK ADA UJIAN</td>
<td width="100px">TIDAK ADA UJIAN</td>
</tr>
</tbody>

</table>';
	}

}
	function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

	function password(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('password-old', 'Password Lama','required|strip_tags');
		$this->form_validation->set_rules('password-new', 'Password Baru','required|strip_tags');
        $this->form_validation->set_rules('password-confirm', 'Confirm Password','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
			$old = $this->input->post('password-old', TRUE);
			$new = $this->input->post('password-new', TRUE);
			$confirm = $this->input->post('password-confirm', TRUE);
			
			$username = $this->access->get_username();
			
			if($this->users_model->get_user_count($username, $old)>0){
				if($new==$confirm){
					$this->users_model->change_password($username, $new);
					$status['status'] = 1;
					$status['error'] = '';
				}else{
					$status['status'] = 0;
					$status['error'] = 'Kedua password baru tidak sama';
				}
			}else{
				$status['status'] = 0;
				$status['error'] = 'Password Lama tidak Sesuai';
			}
        }else{
            $status['status'] = 0;
            $status['error'] = validation_errors();
        }
        
        echo json_encode($status);
    }
}