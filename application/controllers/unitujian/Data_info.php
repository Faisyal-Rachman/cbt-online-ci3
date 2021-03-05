<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_info extends Member_Controller {
	private $kode_menu = 'info';
	private $kelompok = 'master';
	private $url = 'manager/data_info';
	
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
			'judul'	=> 'Pengumuman',
			'subjudul' => 'Data Pengumuman',
			'nama_ujian'	=> $this->master->getUjian(),
			'proktor'	=> $this->master->proktor(),
			'pengawas'	=> $this->master->guru_pengampu(),
			'sesi'	=> $this->master->sesi(),
			'ruang'	=> $this->master->ruang()
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/info/data', 'Pengumuman Sekolah ', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataInfo(), false);
	}
	
	public function simpan()
	{
		$status['status'] = 0;
		$rows = $this->input->post('tambah-info');
		$rows2 = $this->input->post('info_isi');
		$info_judul = $this->input->post('info_judul');
		$mode = $this->input->post('mode', true);

		$tgl = date('Y-m-d');
			$this->form_validation->set_rules('info_judul', 'Isi Judul', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
				$info_judul => form_error($info_judul)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'info_judul' => $this->input->post('info_judul', true),
						'info_isi' => $this->input->post('tambah-info', true),
						'info_kategori' => $this->input->post('info_kategori', true),
						'info_tgl' => $tgl
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'info_id'	=> $this->input->post('info_id', true),
						'info_judul' => $this->input->post($info_judul, true),
						'info_isi' => $this->input->post($info_isi, true),
						'info_kategori' => $this->input->post($info_kategori, true),
						'info_tgl' => date('Y-m-d')
					);
				}
				$status = TRUE;
			}
		
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('cbt_info', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_info', $update, 'info_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
		//redirect('manager/data_info');
	}
	public function save()
	{
        $status['status'] = 0;
		$rows = count($this->input->post('bacara_operator', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			$status['status'] = 0;
			$bacara_catatan = 'bacara_catatan';
			$bacara_sesi = 'bacara_sesi';
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
						'bacara_sesi' => $this->input->post($bacara_sesi, true),
						'bacara_ruang' => $this->input->post($bacara_ruang, true),
						'bacara_operator' => $this->input->post($bacara_operator, true),
						'bacara_pengawas' => $this->input->post($bacara_pengawas, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'bacara_id'	=> $this->input->post('bacara_id', true),
						'bacara_sesi' => $this->input->post($bacara_sesi, true),
						'bacara_ruang' => $this->input->post($bacara_ruang, true),
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
				$this->master->create('cbt_info', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_info', $update, 'bacara_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
		redirect('mssssatpel');
	}

	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Mata Pelajaran',
			'subjudul' => 'Import bacara',
			'bacara' => $this->master->getAllbacara()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/bacara/import', 'Daftar Group bacara', $data);
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
			$bacara = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$bacara[] = [
					'grup_nama' => $sheetData[$i][0]
				];
				
			}

			unlink($file);

			$this->import($bacara);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('bacara', true));
		$bacara = [];
		foreach ($data as $d) {
		$bacara[] = [
				'grup_nama' => $d->grup_nama
			];
		}

		$save = $this->master->create('cbt_user_grup', $bacara, true);
		if ($save) {
			redirect('manager/data_info');
		} else {
			redirect('manager/data_info/import');
		}
	}



	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!isset($chk)) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('cbt_info', $chk, 'info_id')) {
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