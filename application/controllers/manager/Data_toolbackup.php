<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_toolbackup extends Member_Controller {
	private $kode_menu = 'guru';
	private $kelompok = 'master';
	private $url = 'manager/data_guru';
	
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
			'judul'	=> 'Guru Pengampu',
			'subjudul' => 'List Guru'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/tool/data', 'Daftar Guru Pengampu', $data);
	}
	
    public function delete(){
        $nis = $_POST['nis']; // Ambil data NIS yang dikirim oleh view.php melalui form submit
        $this->SiswaModel->delete($nis); // Panggil fungsi delete dari model
        $this->master->delete('cbt_bacara', $chk, 'bacara_id');
        redirect('siswa');
    }


}