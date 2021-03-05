<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Statusujian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		$this->load->model('Master_model', 'master');
		$this->form_validation->set_error_delimiters('', '');
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function index()
	{
		$data = [
		//	'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Mata Pelajaran',
			'subjudul' => 'Data statusujian'
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/statusujian/data');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function data()
	{
		$this->output_json($this->master->getDatamapel(), false);
	}

	public function add()
	{
		$data = [
			'user' 		=> $this->ion_auth->user()->row(),
			'judul'		=> 'Tambah Mata Pelajaran',
			'subjudul'	=> 'Tambah Data statusujian',
			'banyak'	=> $this->input->post('banyak', true)
		];
		$this->load->view('_templates/dashboard/_header.php', $data);
		$this->load->view('master/statusujian/add');
		$this->load->view('_templates/dashboard/_footer.php');
	}

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('statusujian');
		} else {
			$statusujian = $this->master->getstatusujianById($chk);
			$data = [
				'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Edit Mata Pelajaran',
				'subjudul'	=> 'Edit Data statusujian',
				'statusujian'	=> $statusujian
			];
			$this->load->view('_templates/dashboard/_header.php', $data);
			$this->load->view('master/statusujian/edit');
			$this->load->view('_templates/dashboard/_footer.php');
		}
	}

	public function save()
	{
		$rows = count($this->input->post('nama_statusujian', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			//ini inisialisasi var
			$nama_statusujian = 'nama_statusujian';
			$kode_statusujian = 'kode_statusujian';
			$this->form_validation->set_rules($nama_statusujian, 'Mata Kuliah', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
				$kode_statusujian => form_error($kode_statusujian),
					$nama_statusujian => form_error($nama_statusujian)
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
					'kode_statusujian' => $this->input->post($kode_statusujian, true),
						'nama_statusujian' => $this->input->post($nama_statusujian, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'id_statusujian'	=> $this->input->post('id_statusujian', true),
						'nama_statusujian' 	=> $this->input->post($nama_statusujian, true),
						'kode_statusujian' 	=> $this->input->post($kode_statusujian, true)
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('statusujian', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('statusujian', $update, 'id_statusujian', null, true);
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

	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('statusujian', $chk, 'id_statusujian')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

	public function import($import_data = null)
	{
		$data = [
			'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Mata Pelajaran',
			'subjudul' => 'Import statusujian',
			'statusujian' => $this->master->getAllstatusujian()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->load->view('_templates/dashboard/_header', $data);
		$this->load->view('master/statusujian/import');
		$this->load->view('_templates/dashboard/_footer');
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
			$statusujian = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$statusujian[] = [
					'kode_statusujian' => $sheetData[$i][0],
					'nama_statusujian' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($statusujian);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('statusujian', true));
		//$statusujian = [];
		foreach ($data as $d) {
		$statusujian[] = [
		
				'id_statusujian' => $d->id_statusujian,
				'kode_statusujian' => $d->kode_statusujian,
				'nama_statusujian' => $d->nama_statusujian
			];
		}

		$save = $this->master->create('statusujian', $statusujian, true);
		if ($save) {
			redirect('statusujian');
		} else {
			redirect('statusujian/import');
		}
	}
}
