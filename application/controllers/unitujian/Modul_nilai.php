<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_nilai extends Member_Controller {
	private $kode_menu = 'nilai-ujian';
	private $kelompok = 'nilai';
	private $url = 'manager/modul_nilai';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_nilai_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('cbt_tes_topik_set_model');
		$this->load->model('Master_model', 'master');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'CBT SMKN PASTI BISA',
			'subjudul' => 'Bank Soal',
			'pengampu'	=> $this->master->guru_pengampu(),
			'stat'	=> $this->master->get_level()

		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        
		if($this->cbt_modul_model->count_all()->row()->hasil==0){
			$data_modul['modul_nama'] = 'Default';
	        $data_modul['modul_aktif'] = 1;
	        $this->cbt_modul_model->save($data_modul);
		}

		$query_modul = $this->cbt_user_grup_model->get_group();
        if($query_modul->num_rows()>0){
        	$select = '';
        	$query_modul = $query_modul->result();
        	foreach ($query_modul as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="10000000">KOSONG</option>';
        }
        $data['select_grup'] = $select;
		
		$query_modul = $this->cbt_modul_model->get_modul();
        if($query_modul->num_rows()>0){
        	$select = '';
        	$query_modul = $query_modul->result();
        	foreach ($query_modul as $temp) {
        		$select = $select.'<option value="'.$temp->modul_id.'">'.$temp->modul_nama.'</option>';
        	}

        }else{
        	$select = '<option value="10000000">KOSONG</option>';
        }
        $data['select_modul'] = $select;
        
        $this->template->display_admin($this->kelompok.'/tes_hasil_view', 'Daftar Topik', $data);
    }

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-topik', 'Nama Topik','required|strip_tags');
        $this->form_validation->set_rules('tambah-modul-id', 'ID Modul','required|strip_tags');
        $this->form_validation->set_rules('tambah-deskripsi', 'Deskripsi','required|strip_tags');
        $this->form_validation->set_rules('tambah-status', 'Status','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
        	$data['topik_modul_id'] = $this->input->post('tambah-modul-id', true);
            $data['topik_nama'] = $this->input->post('tambah-topik', true);
            $data['guru_pengampu'] = $this->input->post('tambah-deskripsi', true);
            $data['topik_aktif'] = 1;

            //if($this->cbt_topik_model->count_by_kolom('topik_nama', $data['topik_nama'])->row()->hasil>0){
            if($this->cbt_topik_model->count_by_topik_modul($data['topik_nama'], $data['topik_modul_id'])->row()->hasil>0){
                $status['status'] = 0;
                $status['pesan'] = 'Nama Topik sudah terpakai !';
            }else{
				$this->cbt_topik_model->save($data);
                
                $status['status'] = 1;
                $status['pesan'] = 'Topik berhasil disimpan ';
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
			$query = $this->cbt_topik_model->get_by_kolom('topik_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->topik_id;
				$data['topik'] = $query->topik_nama;
				$data['deskripsi'] = $query->guru_pengampu;
				$data['status'] = $query->topik_aktif;
			}
		}
		echo json_encode($data);
    }

    /**
     * Cek
     * @return [type] [description]
     */
    function hapus_daftar_topik(){
    	$this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-topik-id[]', 'Topik','required|strip_tags');
		if($this->form_validation->run() == TRUE){
			$topik_id = $this->input->post('edit-topik-id', TRUE);
			$error_hapus = 0;
			foreach( $topik_id as $kunci => $isi ) {
				if($isi=="on"){
					if($this->cbt_tes_topik_set_model->count_by_kolom('tset_topik_id', $kunci)->row()->hasil>0){
	            		$error_hapus++;
	            	}else{
	            		
						$this->db->trans_start();

	            		
	            		$this->cbt_topik_model->delete('topik_id', $kunci);

	            	
						$this->db->trans_complete();

	            		
	            		$this->load->helper('directory');
						$this->load->helper('file');
	            		
	            		$folder = $this->config->item('upload_path').'/topik_'.$kunci;
	            		if(is_dir($folder)){
	            			delete_files($folder, TRUE);
	            			rmdir($folder);
	            		}
	            	}
            	}
            }
            $status['status'] = 1;
            if($error_hapus>0){
            	$status['pesan'] = 'Daftar topik sebagian tidak dapat dihapus karena masih digunakan Tes !';
            }else{
            	$status['pesan'] = 'Daftar Topik berhasil dihapus';
            }
		}else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function edit(){
        $this->load->library('form_validation');
        
		$this->form_validation->set_rules('edit-id', 'ID','required|strip_tags');
		$this->form_validation->set_rules('edit-modul-id', 'ID Modul','required|strip_tags');
		$this->form_validation->set_rules('edit-topik', 'Nama Topik','required|strip_tags');
		$this->form_validation->set_rules('edit-deskripsi', 'Deskripsi','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
		$this->form_validation->set_rules('edit-topik-asli', 'Nama Topik','required|strip_tags');
		$this->form_validation->set_rules('edit-status', 'Status','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $id = $this->input->post('edit-id', true);
			$modul_id = $this->input->post('edit-modul-id', true);
            
            if($pilihan=='hapus'){
            	if($this->cbt_tes_topik_set_model->count_by_kolom('tset_topik_id', $id)->row()->hasil>0){
            		$status['status'] = 0;
                	$status['pesan'] = 'Topik masih dipakai pada Tes, tidak bisa dihapus.';
            	}else{
            		
            		$this->cbt_topik_model->delete('topik_id', $id);

            		
            		$this->load->helper('directory');
					$this->load->helper('file');
            		
            		$folder = $this->config->item('upload_path').'/topik_'.$id;
            		if(is_dir($folder)){
            			delete_files($folder, TRUE);
            			rmdir($folder);
            		}

					$status['status'] = 1;
					$status['pesan'] = 'Topik berhasil dihapus !';
            	}
            }else if($pilihan=='simpan'){//simpan
				$topik_asli = $this->input->post('edit-topik-asli', true);
                $data['topik_nama'] = $this->input->post('edit-topik', true);
                $data['topik_aktif'] = $this->input->post('edit-status', true);

                if($topik_asli!=$data['topik_nama']){
                	//if($this->cbt_topik_model->count_by_kolom('topik_nama', $data['topik_nama'])->row()->hasil>0){
					if($this->cbt_topik_model->count_by_topik_modul($data['topik_nama'], $modul_id)->row()->hasil>0){
		                $status['status'] = 0;
		                $status['pesan'] = 'Nama Topik sudah terpakai !';
		            }else{
						$this->cbt_topik_model->update('topik_id', $id, $data);
		                
		                $status['status'] = 1;
		                $status['pesan'] = 'Topik berhasil disimpan ';
		            }
                }else{
                	$this->cbt_topik_model->update('topik_id', $id, $data);
                	$status['status'] = 1;
                	$status['pesan'] = 'Topik Berhasil disimpan';
                }
            }
            
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_datatable(){
		// variable initialization
		$modul = $this->input->get('modul');

		$search = "";
		$start = 0;
		$rows = 10;

		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start = $this->get_start();
		$rows = $this->get_rows();

		// run query to get user listing
		$query = $this->cbt_nilai_model->get_datatable($start, $rows, 'topik_nama', $search, $modul);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_nilai_model->get_datatable_count('topik_nama', $search, $modul)->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

		// get result after running query and put it in array
		$m = " Menit";
		$i=$start;
		$query = $query->result();
	    foreach ($query as $temp) {			
			$record = array();
            
			$record[] = $temp->user_firstname;
            $record[] = $temp->user_birthdate;
            $record[] = $temp->grup_nama;
            $record[] = $temp->tes_duration_time. $m ;
			$record[] = $temp->sesi_nama;
            $record[] = $temp->sesi_nama;
            $record[] = $temp->nilai;

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