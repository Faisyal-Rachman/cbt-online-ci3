<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_daftar extends Member_Controller {
	private $kode_menu = 'peserta_daftar';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_daftar';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_user_model');
        $this->load->model('Master_model', 'master');
		$this->load->model('cbt_konfigurasi_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'CBT SMKN PASTI BISA',
			'subjudul' => 'Bank Soal',
			'jurusan'	=> $this->master->jurusan(),
			'sesi'	=> $this->master->sesi(),
			'ruang'	=> $this->master->ruang()

		];
		$queryjenjang = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_jenjang_sekolah', 1)->row()->konfigurasi_isi;
       
        if( $queryjenjang == 'sd' or $queryjenjang == 'smp'){
       
			$data['jenjang_pendidikan'] = 'disabled';
      
    }


        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $query_agama = $this->cbt_user_grup_model->get_agama();

        if($query_agama->num_rows()>0){
        	$select1 = '';
        	$query_agama = $query_agama->result();
        	foreach ($query_agama as $temp) {
        		$select1 = $select1.'<option value="'.$temp->agama_kode.'">'.$temp->agama_nama.'</option>';
        	}

        }else{
        	$select1 = '<option value="100000">KOSONG</option>';
        }
        $data['select_agama'] = $select1;

 $query_jkl = $this->cbt_user_grup_model->get_jkl();

        if($query_jkl->num_rows()>0){
        	$selectjkl = '';
        	$query_jkl = $query_jkl->result();
        	foreach ($query_jkl as $temp) {
        		$selectjkl = $selectjkl.'<option value="'.$temp->jkl_kode.'">'.$temp->jkl_nama.'</option>';
        	}

        }else{
        	$selectjkl = '<option value="100000">KOSONG</option>';
        }
        $data['select_jkl'] = $selectjkl;
        $query_group = $this->cbt_user_grup_model->get_group();

        if($query_group->num_rows()>0){
        	$select = '';
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="100000">KOSONG</option>';
        }
        $data['select_group'] = $select;
        
        $this->template->display_admin($this->kelompok.'/peserta_daftar_view', 'Daftar Peserta', $data);
    }

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-username', 'Username','required|strip_tags');
        $this->form_validation->set_rules('tambah-password', 'Password','required|strip_tags');
        $this->form_validation->set_rules('tambah-sesi', 'Sesi','required|strip_tags');
        $this->form_validation->set_rules('tambah-nama', 'Nama Lengkap','required|strip_tags');
        $this->form_validation->set_rules('tambah-siswa', 'Nama Siswa','required|strip_tags');
        $this->form_validation->set_rules('tambah-email', 'Email','strip_tags');
		$this->form_validation->set_rules('tambah-detail', 'Keterangan','strip_tags|max_length[30]');
        $this->form_validation->set_rules('tambah-group', 'Group','required|strip_tags');
        $this->form_validation->set_rules('tambah-agama', 'Agama','required|strip_tags');
         $this->form_validation->set_rules('tambah-jkl', 'Jenis Kelamin','required|strip_tags');
        if(empty($this->input->post('tambah-jurusan'))){
			$datajur = "Bukan SMK";
		}else{
		$datajur = $this->input->post('tambah-jurusan');
			}
        if($this->form_validation->run() == TRUE){
        	$data['user_name'] = $this->input->post('tambah-username', true);
            $data['user_password'] = $this->input->post('tambah-password', true);
            $data['user_email'] = $this->input->post('tambah-email', true);
            $data['user_jurusan'] = $datajur;
            $data['user_sesi'] = $this->input->post('tambah-sesi', true);
            $data['user_firstname'] = $this->input->post('tambah-nama', true);
            $data['user_birthdate'] = $this->input->post('tambah-siswa', true);
			$data['user_detail'] = $this->input->post('tambah-detail', true);
            $data['user_grup_id'] = $this->input->post('tambah-group', true);
            $data['user_agama'] = $this->input->post('tambah-agama', true);
            $data['user_jkl'] = $this->input->post('tambah-jkl', true);

            if($this->cbt_user_grup_model->count_by_kolom('grup_id', $data['user_grup_id'])->row()->hasil>0){
            	if($this->cbt_user_model->count_by_kolom('user_name', $data['user_name'])->row()->hasil>0){
	                $status['status'] = 0;
	                $status['pesan'] = 'Username sudah terpakai !';
	            }else{
					$this->cbt_user_model->save($data);
	                
	                $status['status'] = 1;
	                $status['pesan'] = 'Data Peserta berhasil disimpan ';
	            }
            }else{
            	$status['status'] = 0;
                $status['pesan'] = 'Data Group tidak tersedia, Silahkan tambah data Group';
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
			$query = $this->cbt_user_model->get_by_kolom('user_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->user_id;
				$data['username'] = $query->user_name;
			   $data['jurusan'] = $query->user_jurusan;
               $data['siswa'] = $query->user_birthdate;
				$data['password'] = $query->user_password;
				$data['sesi'] = $query->user_sesi;
				$data['nama'] = $query->user_firstname;
				$data['email'] = $query->user_email;
				$data['detail'] = $query->user_detail;
				$data['group'] = $query->user_grup_id;
				$data['agama'] = $query->user_agama;
				$data['jkl'] = $query->user_jkl;
			}
		}
		echo json_encode($data);
    }

    /**
     * Cek
     * @return [type] [description]
     */
    function hapus_daftar_siswa(){
    	$this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-user-id[]', 'Siswa','required|strip_tags');
		if($this->form_validation->run() == TRUE){
			$user_id = $this->input->post('edit-user-id', TRUE);
			foreach( $user_id as $kunci => $isi ) {
				if($isi=="on"){
					$this->cbt_user_model->delete('user_id', $kunci);
            	}
            }
            $status['status'] = 1;
            $status['pesan'] = 'Daftar Siswa berhasil dihapus';
		}else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

   /* function edit(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-id', 'ID','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
		$this->form_validation->set_rules('edit-username', 'Username','required|strip_tags');
	//	$this->form_validation->set_rules('edit-jurusan', 'Jurusan','required|strip_tags');
	   $this->form_validation->set_rules('edit-password', 'Password','required|strip_tags');
	   $this->form_validation->set_rules('edit-sesi', 'Sesi','required|strip_tags');
      $this->form_validation->set_rules('edit-siswa', 'Nama Siswa','required|strip_tags');
       $this->form_validation->set_rules('edit-nama', 'Nama Lengkap','required|strip_tags');
        $this->form_validation->set_rules('edit-email', 'Email','strip_tags');
		$this->form_validation->set_rules('edit-detail', 'Keterangan','strip_tags|max_length[30]');
        $this->form_validation->set_rules('edit-group', 'Group','required|strip_tags');
		
		if(empty($this->input->post('edit-jurusan'))){
			$datajur = "Bukan SMK";
		}else{
		$datajur = $this->input->post('edit-jurusan');
			}
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $id = $this->input->post('edit-id', true);
            
            if($pilihan=='hapus'){//hapus
            	$this->cbt_user_model->delete('user_id', $id);
				$status['status'] = 1;
				$status['pesan'] = 'Data Peserta berhasil dihapus !';

			}else if($pilihan=='simpan'){//simpan
				$data['user_jurusan'] = $this->input->post('edit-jurusan', true);
				$data['user_sesi'] = $this->input->post('edit-sesi', true);
				$data['user_name'] = $this->input->post('edit-username', true);
				$data['user_jurusan'] = $datajur;
                $data['user_password'] = $this->input->post('edit-password', true);
                $data['user_firstname'] = $this->input->post('edit-nama', true);
                $data['user_email'] = $this->input->post('edit-email', true);
                $data['user_grup_id'] = $this->input->post('edit-group', true);
                $data['user_birthdate'] = $this->input->post('edit-siswa', true);
				$data['user_detail'] = $this->input->post('edit-detail', true);

                $this->cbt_user_model->update('user_id', $id, $data);

                $status['status'] = 1;
		        $status['pesan'] = 'Data Peserta berhasil disimpan ';
            }
            
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
	*/
	function edit(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-id', 'ID','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
        $this->form_validation->set_rules('edit-username', 'Username','required|strip_tags');
        $this->form_validation->set_rules('edit-password', 'Password','required|strip_tags');
        $this->form_validation->set_rules('edit-nama', 'Nama Lengkap','required|strip_tags');
        $this->form_validation->set_rules('edit-email', 'Email','strip_tags');
		$this->form_validation->set_rules('edit-detail', 'Keterangan','strip_tags|max_length[30]');
        $this->form_validation->set_rules('edit-group', 'Group','required|strip_tags');
        $this->form_validation->set_rules('edit-agama', 'Agama','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $id = $this->input->post('edit-id', true);
            
            if($pilihan=='hapus'){//hapus
            	$this->cbt_user_model->delete('user_id', $id);
				$status['status'] = 1;
				$status['pesan'] = 'Data Peserta berhasil dihapus !';

			}else if($pilihan=='simpan'){//simpan
				$data['user_name'] = $this->input->post('edit-username', true);
            $data['user_password'] = $this->input->post('edit-password', true);
            $data['user_email'] = $this->input->post('edit-email', true);
            $data['user_jurusan'] = $this->input->post('edit-jurusan', true);
            $data['user_sesi'] = $this->input->post('edit-sesi', true);
            $data['user_firstname'] = $this->input->post('edit-nama', true);
            $data['user_birthdate'] = $this->input->post('edit-siswa', true);
			$data['user_detail'] = $this->input->post('edit-detail', true);
            $data['user_grup_id'] = $this->input->post('edit-group', true);
            $data['user_agama'] = $this->input->post('edit-agama', true);
               $this->cbt_user_model->update('user_id', $id, $data);

                $status['status'] = 1;
		        $status['pesan'] = 'Data Peserta berhasil diubah ';
            }
            
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
	}
	
    function get_datatable(){
		// variable initialization
		$group = $this->input->get('group');

		$search = "";
		$start = 0;
		$rows = 10;

	
		$start = $this->get_start();
		$rows = $this->get_rows();

		// run query to get user listing
		$query = $this->cbt_user_model->get_datatable($start, $rows, 'user_firstname', $search, $group);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal = $this->cbt_user_model->get_datatable_count('user_firstname', $search, $group)->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

	    // get result after running query and put it in array
		$i=$start;
		$query = $query->result();
	    foreach ($query as $temp) {			
			$record = array();
            
			$record[] = $temp->user_firstname;
			$record[] = $temp->user_birthdate;
			$record[] = $temp->user_name;
			$record[] = $temp->user_password;
           	$record[] = $temp->user_email;
            $query_group = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $temp->user_grup_id, 1)->row();

			$record[] = $query_group->grup_nama;
			//$record[] = $temp->user_jurusan;
			$record[] = $temp->user_sesi;
			$record[] = $temp->user_detail;
			$lvl = $this->access->get_level();
if($lvl=='admin'){
			$record[] = '<a onclick="edit(\''.$temp->user_id.'\')" style="cursor: pointer;" class="btn btn-warning btn-sm">Edit</a>';
			$record[] = '<input type="checkbox" name="edit-user-id['.$temp->user_id.']" >';
}else{
	$record[] = '<a onclick="noakses()" style="cursor: pointer;" class="btn btn-warning btn-sm"> <i class="nav-icon far fa-eye-slash"></i></button></a>';
	$record[] = '<i class="nav-icon far fa-eye-slash"></i>';
}
           

			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
	}
	

	
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