<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_level extends Member_Controller {
	private $kode_menu = 'level';
	private $kelompok = 'master';
	private $url = 'manager/data_level';
	
    function __construct(){
		parent:: __construct();
		
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_tesgrup_model');
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
			'judul'	=> 'Level Kelas',
			'subjudul' => 'Daftar Level'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/level/data', 'Daftar level Ujian', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataLevel(), false);
	}
	
	public function simpan()
	{
		$rows = count($this->input->post('level_nama', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			//ini inisialisasi var
			$level_nama = 'level_nama';
			$level_kode = 'level_kode';
			$this->form_validation->set_rules($level_nama, 'Nama level', 'required');
			$this->form_validation->set_rules($level_kode, 'level Kode', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
				
					$level_nama => form_error($level_nama)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'level_nama' => $this->input->post($level_nama, true),
						'level_kode' => $this->input->post($level_kode, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'level_id'	=> $this->input->post('level_id', true),
						'level_nama' 	=> $this->input->post($level_nama, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('cbt_level', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_level', $update, 'level_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		//$this->output_json($data);
		redirect('manager/data_level');
	}
	public function save()
	{
		$rows = count($this->input->post('level_nama', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			//ini inisialisasi var
			$level_nama = 'level_nama[' . $i . ']';
			$level_kode = 'level_kode[' . $i . ']';
			$this->form_validation->set_rules($level_nama, 'Nama level', 'required');
			$this->form_validation->set_rules($level_kode, 'level Kode', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$level_nama => form_error($level_nama),
					$level_kode => form_error($level_kode),
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'level_nama' => $this->input->post($level_nama, true),
						'level_kode' => $this->input->post($level_kode, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'level_id'	=> $this->input->post('level_id[' . $i . ']', true),
						'level_nama' 	=> $this->input->post($level_nama, true),
						'level_kode' 	=> $this->input->post($level_kode, true)
					
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('cbt_level', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_level', $update, 'level_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
		//redirect('mssssatpel');
	}

	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'level Ujian',
			'subjudul' => 'Import level',
			'level' => $this->master->getAlllevel()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/level/import', 'Daftar Group level', $data);
	}

	public function preview()
	{
		$config['upload_path']		= './uploads/import/';
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= 2048;
		$config['encrypt_name']		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_file')) {
			$error = $this->upload->display_errors();
			echo $error;
			die;
		} else {
			$file = $this->upload->data('full_path');
			$ext = $this->upload->data('file_ext');

			switch ($ext) {
				case '.xlsx':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					break;
				case '.xls':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
					break;
				case '.csv':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
					break;
				default:
					echo "unknown file ext";
					die;
			}

			$spreadsheet = $reader->load($file);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$level = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$level[] = [
					'level_nama' => $sheetData[$i][0],
					'level_kode' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($level);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('level', true));
		$level = [];
		foreach ($data as $d) {
		$level[] = [
				'level_nama' => $d->level_nama,
				'level_kode' => $d->level_kode
			];
		}

		$save = $this->master->create('cbt_level', $level, true);
		if ($save) {
			redirect('manager/data_level');
		} else {
			redirect('manager/data_level/import');
		}
	}



	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('cbt_level', $chk, 'level_id')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-group', 'Nama Group','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['level_nama'] = $this->input->post('tambah-group', true);

            if($this->cbt_user_grup_model->count_by_kolom('level_nama', $data['level_nama'])->row()->hasil>0){
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
			$query = $this->cbt_user_grup_model->get_by_kolom('level_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->level_id;
				$data['group'] = $query->level_nama;
			}
		}
		echo json_encode($data);
    }

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('level');
		} else {
			$level = $this->master->getlevelById($chk);
			$data = [
				//'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Edit level Ujian',
				'subjudul'	=> 'Edit level',
				'level'	=> $level
			];
		
			$this->template->display_admin($this->kelompok.'/level/edit', 'Daftar Group Kelas', $data);
			
			
		}
	}
    
    function get_datatable(){
		// variable initialization
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
		$query = $this->cbt_user_grup_model->get_datatable($start, $rows, 'level_nama', $search);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_user_grup_model->get_datatable_count('level_nama', $search)->row()->hasil;
	    
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
            
			$record[] = ++$i;
            $record[] = $temp->level_nama;
            $record[] = '<a onclick="edit(\''.$temp->level_id.'\')" style="cursor: pointer;" class="btn btn-default btn-xs">Edit</a>';

			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
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