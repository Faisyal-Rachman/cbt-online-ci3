<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_bacara extends Member_Controller {
	private $kode_menu = 'bacara';
	private $kelompok = 'master';
	private $url = 'manager/data_bacara';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_tesgrup_model');
		$this->load->model('cbt_tes_user_model');
		$this->load->model('Master_model', 'master');
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		parent::cek_akses($this->kode_menu);
	}
	
	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

    public function index(){
		
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Berita Acara',
			'subjudul' => 'Data Berita Acara',
			'nama_ujian'	=> $this->master->getUjian(),
			//'tidak_hadir'	=> $this->master->getTdkHadir(),
			'nm_ujian' => '',
			'proktor'	=> $this->master->proktor(),
			'pengawas'	=> $this->master->guru_pengampu(),
			'sesi'	=> $this->master->sesi(),
			'ruang'	=> $this->master->ruang()
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        // ambil user
        $query_user = $this->cbt_user_model->get_by_kolomuser();
        if($query_user->num_rows()>0){
        	$select = '';
        	$query_user = $query_user->result();
        	foreach ($query_user as $temp) {
        $select = $select.'<option value="'.$temp->user_id.'">'.$temp->user_firstname.'</option>';
        		
        }	
        }
        $data['select_group'] = $select;

        $this->template->display_admin($this->kelompok.'/bacara/data', 'Berita Acara Ujian ', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataBacara(), false);
	}
	  function get_absen($modul=null){
        $data['data']=0;
        $data['select_topik'] = '<option value="kosong">Tidak Ada Topik</option>';
        if(!empty($modul)){
            $data['data']=1;
        $query_topik = $this->cbt_tes_user_model->getTdkHadir('cbt_tes.tes_id', $modul, 1);
            if($query_topik->num_rows()){
                $query_topik = $query_topik->result();
                $select = '';
                foreach ($query_topik as $topik) {
                  
                    $select = $select.'<option value="'.$topik->uid.'">'.$topik->np.'</option>';

                }
                $data['jumlahabsen'] = count($query_topik);
                $data['select_topik'] = $select;
            }
        }

        echo json_encode($data);
    }
     function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('cbt_bacara', $chk, 'bacara_id')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	function get_topik_by_modul($modul=null){
        $data['data']=0;

        $data['select_topik'] = '<option value="kosong">Tidak Ada Topik</option>';
        if(!empty($modul)){
            $data['data']=1;
        $query_topik = $this->cbt_topik_model->get_by_kolom_aktif('topik_modul_id', $modul, 1);
            if($query_topik->num_rows()){
                $query_topik = $query_topik->result();
                $select = '';
                foreach ($query_topik as $topik) {
                    $jml_soal = $this->cbt_soal_model->count_by_kolom('soal_topik_id', $topik->topik_id)->row()->hasil;
                    $select = $select.'<option value="'.$topik->topik_id.'">'.$topik->topik_nama.' ['.$jml_soal.' soal]</option>';
                }
                
                $data['select_topik'] = $select;
            }
        }

        echo json_encode($data);
    }
	public function simpan()
	{
		$rows = count($this->input->post('bacaraujian_id', true));
		$mode = $this->input->post('mode', true);
		$status = array();
		
			$bacaraujian_id = 'bacaraujian_id';
			$bacara_catatan = 'bacara_catatan';
			$bacara_tdk_hadir = 'bacara_tdk_hadir';
			$bacara_nip_pengawas = 'bacara_nip_pengawas';
		    $bacara_nip_operator = 'bacara_nip_operator';
		    $bacara_p_jawab = 'bacara_p_jawab';
		    $bacara_p_jawab_nip = 'bacara_p_jawab_nip';
		    $bacara_ujian_mulai = 'bacara_ujian_mulai';
		    $bacara_ujian_akhir = 'bacara_ujian_akhir';
			$bacara_operator = 'bacara_operator';
			$bacara_pengawas = 'bacara_pengawas';
			
		   
			$this->form_validation->set_rules($bacaraujian_id, 'Pilih Nama Ujian', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

					$insert[] = [
						'bacaraujian_id' => $this->input->post($bacaraujian_id, true),
						'bacara_nip_pengawas' => $this->input->post($bacara_nip_pengawas, true),
						'bacara_nip_operator' => $this->input->post($bacara_nip_operator, true),
						'bacara_tdk_hadir' => $this->input->post($bacara_tdk_hadir, true),
						'bacara_catatan' => $this->input->post($bacara_catatan, true),
						'bacara_p_jawab' => $this->input->post($bacara_p_jawab, true),
						'bacara_p_jawab_nip' => $this->input->post($bacara_p_jawab_nip, true),
						'bacara_ujian_mulai' => $this->input->post($bacara_ujian_mulai, true),
						'bacara_ujian_akhir' => $this->input->post($bacara_ujian_akhir, true),
						'bacara_operator' => $this->input->post($bacara_operator, true),
						'bacara_pengawas' => $this->input->post($bacara_pengawas, true)
						
					];
					
				
			
		
			
				$getidbacara = $this->cbt_user_model->getidbacara()->row()->id;
                $tidak_hadir = $this->input->post('tidak_hadir', true);
                    // menghapus data group berdasarkan tes terlebih dahulu
                   foreach ($tidak_hadir as $tidakhadir) {
                        $data_group['absen_bacara_id'] = $getidbacara;
                        $data_group['absen_user_id'] = $tidakhadir;

                        // Jika group tidak kosong
                        if($tidakhadir!=0){
                           $this->cbt_tesgrup_model->saveabsen($data_group);
                        }
                


				    $this->master->create('cbt_bacara', $insert, true);
				
				       $status['status'] = 1;
                       $status['pesan'] = 'Data Berica Acara disimpan';
			
		} 
		
		 echo json_encode($status);
		//redirect('manager/data_bacara');
	}
	public function save()
	{
        $status['status'] = 0;
		$rows = count($this->input->post('bacara_operator', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$status['status'] = 0;
			$bacara_catatan = 'bacara_catatan';
			
			$bacara_operator = 'bacara_operator';
			$bacara_pengawas = 'bacara_pengawas';
			$this->form_validation->set_rules($bacara_operator, 'Nama Kelas', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$bacara_operator => form_error($bacara_operator)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						
						'bacara_operator' => $this->input->post($bacara_operator, true),
						'bacara_pengawas' => $this->input->post($bacara_pengawas, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						
						
						'bacara_catatan' => $this->input->post($bacara_catatan, true),
						'bacara_pengawas' => $this->input->post($bacara_pengawas, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
            $status = 0;
			$update[] = array(
                'bacara_id'	=> $this->input->post('bacara_id', true),
                'bacara_catatan' => $this->input->post($bacara_catatan, true),
                'bacara_pengawas' => $this->input->post($bacara_pengawas, true)
            );
			if ($mode == 'add') {
				$this->master->create('cbt_bacara', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_bacara', $update, 'bacara_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		 echo json_encode($status);
		//redirect('mssssatpel');
	}

	
public function cetak_bacara($grup_id=null){
		$data['kode_menu'] = $this->kode_menu;
		
		$kartu = '<h3>Data Peserta Kosong</h3>';
		if(!empty($grup_id)){
			$query_user = $this->cbt_user_model->get_by_kolom('user_grup_id', $grup_id);
			if($query_user->num_rows()>0){
				$kartu = '';
				$query_user = $query_user->result();
				
				$query_konfig = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
				$cbt_nama = 'Computer Based-ddTest';
				if($query_konfig->num_rows()>0){
					$cbt_nama = $query_konfig->row()->konfigurasi_isi;
				}
				
				$query_group = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $grup_id, 1);
				$group = 'NULL';
				if($query_group->num_rows()>0){
					$group = $query_group->row()->grup_nama;
				}
				$bgimg = base_url().'assets/img/download.png';
				$kp = base_url().'assets/img/kartupeserta.png';
				foreach($query_user AS $temp){
					$kartu = $kartu.'
					<div class="kartu"><img style="width: 100%;" src="'.$kp.'">
<div class="centered">
<div class="header">

<table style="width: 280px;">
<tbody>
<tr>
<td valign="center"><br><br><center><img src="http://localhost/ujiancbtnew/assets/img/097346900_1443162687-tut_wuri.png" width="45px" /></center></td>
<td style="width:220px;"><center><br><img src="'.$bgimg.'" width="110px" /><div style="font-size: 10px;">Kartu Peserta Ujian - US 2020</div>
'.$cbt_nama.'</center></td>
<td valign="center"><br><br><center><img src="http://localhost/ujiancbtnew/assets/img/download.jpg" width="45px" /></center></td>
</tr>
</tbody>
</table cellspacing="4" cellpadding="4">
</div>
<hr />
<table>
<tbody>
<tr>
<td width="95px"><strong>Nama</strong></td>
<td width="5px">:</td>
<td width="250px">'.$temp->user_birthdate.'</td>
<td rowspan="2" width="100px"><div style="font-size: 10px;">http://cbtujiannas.cek.org</font></td>
</tr>
<tr>
<td><strong>Username</strong></td>
<td>:</td>
<td>'.$temp->user_name.'</td>
</tr>
<tr>
<td><strong>Password</strong></td>
<td>:</td>
<td>'.$temp->user_password.'</td>
<td rowspan="3"><center><img src="http://localhost/ujiancbtnew/assets/img/tt.png" width="60px" /></center></td>
</tr>
<tr>
<td><strong>Grup</strong></td>
<td>:</td>
<td>'.$group.'</td>
</tr>
<tr>
<td><strong>Keterangan</strong></td>
<td>:</td>
<td>'.$temp->user_detail.'</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
</div>
</div>

					';
				}
			}
		}
		
		$data['kartu'] = $kartu;
		
		$this->load->view($this->kelompok.'/peserta_cetak_kartu_view', $data);
	}


    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-group', 'Nama Group','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['grup_nama'] = $this->input->post('tambah-group', true);

            if($this->cbt_user_grup_model->count_by_kolom('grup_nama', $data['grup_nama'])->row()->hasil>0){
                $status['status'] = 0;
                $status['pesan'] = 'Nama Group sudah terpakai !';
            }else{
				$this->cbt_user_grup_model->save($data);
                
                $status['status'] = 1;
                $status['pesan'] = 'Group berhasil disimpan ';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_user_grup_model->get_by_kolom('grup_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->grup_id;
				$data['group'] = $query->grup_nama;
			}
		}
		echo json_encode($data);
    }

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('bacara');
		} else {
			$bacara = $this->master->getBacarabyid($chk);
			$data = [
				//'user' 		=> $this->ion_auth->user()->row(),
				'judul'	=> 'Berita Acara',
			'subjudul' => 'Data Berita Acara',
            'nama_ujian'	=> $this->master->getUjian(),
            'bacara'	=> $bacara,
			'proktor'	=> $this->master->proktor(),
			'pengawas'	=> $this->master->guru_pengampu()
			];
		
			$this->template->display_admin($this->kelompok.'/bacara/edit', 'Daftar Berita Acara', $data);
			
			
		}
	}
    
   
	
	/**
	* funsi tambahan 
	* 
	* 
*/
	
	function get_start() {
		$start = 0;
		if (isset($_GET['iDisplayStart'])) {
			$start = intval($_GET['iDisplayStart']);

			if ($start < 0)
				$start = 0;
		}

		return $start;
	}

	function get_rows() {
		$rows = 10;
		if (isset($_GET['iDisplayLength'])) {
			$rows = intval($_GET['iDisplayLength']);
			if ($rows < 5 || $rows > 500) {
				$rows = 10;
			}
		}

		return $rows;
	}

	function get_sort_dir() {
		$sort_dir = "ASC";
		$sdir = strip_tags($_GET['sSortDir_0']);
		if (isset($sdir)) {
			if ($sdir != "asc" ) {
				$sort_dir = "DESC";
			}
		}

		return $sort_dir;
	}
}