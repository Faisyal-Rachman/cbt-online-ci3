<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_jurusan extends Member_Controller {
	private $kode_menu = 'jurusan';
	private $kelompok = 'master';
	private $url = 'manager/data_jurusan';
	
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
			'judul'	=> 'Group Jurusan',
			'subjudul' => 'Data Jurusan'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/jurusan/data', 'Daftar Group jurusan', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataJurusan(), false);
	}
	
	public function simpan()
	{
		$rows = count($this->input->post('jurusan_nama', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			//ini inisialisasi var
			$jurusan_nama = 'jurusan_nama';
			$jurusan_kode = 'jurusan_kode';
			
			$this->form_validation->set_rules($jurusan_nama, 'Nama Jurusan', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$jurusan_nama => form_error($jurusan_nama)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'jurusan_nama' => $this->input->post($jurusan_nama, true),
						'jurusan_kode' => $this->input->post($jurusan_kode, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'jurusan_id'	=> $this->input->post('jurusan_id', true),
						'jurusan_nama' 	=> $this->input->post($jurusan_nama, true),
						'jurusan_kode' 	=> $this->input->post($jurusan_kode, true)
					
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('cbt_jurusan', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_jurusan', $update, 'jurusan_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		//$this->output_json($data);
		redirect('manager/data_jurusan');
	}
	public function save()
	{
		$rows = count($this->input->post('jurusan_nama', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			//ini inisialisasi var
			$jurusan_nama = 'jurusan_nama[' . $i . ']';
			$jurusan_kode = 'jurusan_kode[' . $i . ']';
			
			$this->form_validation->set_rules($jurusan_nama, 'Nama Jurusan', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$jurusan_nama => form_error($jurusan_nama),
					$jurusan_kode => form_error($jurusan_kode),
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'jurusan_nama' => $this->input->post($jurusan_nama, true),
						'jurusan_kode' => $this->input->post($jurusan_kode, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'jurusan_id'	=> $this->input->post('jurusan_id[' . $i . ']', true),
						'jurusan_nama' 	=> $this->input->post($jurusan_nama, true),
						'jurusan_kode' 	=> $this->input->post($jurusan_kode, true)
					
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('cbt_jurusan', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_jurusan', $update, 'jurusan_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
	}

	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Jurusan Keahlian',
			'subjudul' => 'Import Jurusan',
			'jurusan' => $this->master->getAlljurusan()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/jurusan/import', 'Daftar Jurusan', $data);
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
			$jurusan = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$jurusan[] = [
					'jurusan_nama' => $sheetData[$i][0],
					'jurusan_kode' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($jurusan);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('jurusan', true));
		$jurusan = [];
		foreach ($data as $d) {
		$jurusan[] = [
				'jurusan_nama' => $d->jurusan_nama,
				'jurusan_kode' => $d->jurusan_kode
			];
		}

		$save = $this->master->create('cbt_jurusan', $jurusan, true);
		if ($save) {
			redirect('manager/data_jurusan');
		} else {
			redirect('manager/data_jurusan/import');
		}
	}



	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('cbt_jurusan', $chk, 'jurusan_id')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
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
			redirect('jurusan');
		} else {
			$jurusan = $this->master->getJurusanById($chk);
			$data = [
				//'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Edit Group jurusan',
				'subjudul'	=> 'Edit jurusan',
				'jurusan'	=> $jurusan
			];
		
			$this->template->display_admin($this->kelompok.'/jurusan/edit', 'Daftar Group jurusan', $data);
			
			
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
		$query = $this->cbt_user_grup_model->get_datatable($start, $rows, 'grup_nama', $search);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_user_grup_model->get_datatable_count('grup_nama', $search)->row()->hasil;
	    
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
            $record[] = $temp->grup_nama;
            $record[] = '<a onclick="edit(\''.$temp->grup_id.'\')" style="cursor: pointer;" class="btn btn-default btn-xs">Edit</a>';

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