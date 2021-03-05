<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool_backup extends Member_Controller {
	private $kode_menu = 'tool-backup';
	private $kelompok = 'tool';
	private $url = 'manager/tool_backup';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');

		parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        
        $this->template->display_admin($this->kelompok.'/tool_backup_view', 'Backup Data', $data);
    }

    public function database(){
    	ini_set("memory_limit","-1");
		ini_set('max_execution_time', 200);

    	// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		$tanggal = date('Y-m-d_H-i-s');
		force_download('backup_database_'.$tanggal.'_.gz', $backup);
    }
	public function hapus_master(){
		// error_reporting(E_ALL ^ E_NOTICE);
	  $this->db->query('TRUNCATE cbt_user_grup');
	$this->db->query('TRUNCATE cbt_user');
	//$this->db->query('TRUNCATE cbt_tes_user');
	  $this->db->query('TRUNCATE cbt_sesi_ujian');
	  $this->db->query('TRUNCATE cbt_ruang');
	  $this->db->query('TRUNCATE cbt_modul');
	  $this->db->query('TRUNCATE cbt_level');
	  $this->db->query('TRUNCATE cbt_jurusan');
	  $this->db->query('TRUNCATE cbt_jenis_ujian');
	  $status['status'] = 1;
		$status['pesan'] = 'Data master berhasil dihapus';
		echo json_encode($status);
	}
	public function hapus_soal(){
		$hasil = $this->db->query("
		SET foreign_key_checks = 0;
		TRUNCATE cbt_soal;
		TRUNCATE cbt_jawaban;
		SET foreign_key_checks = 1;
	 ");
$query = $hasil;
	  $status['status'] = 1;
		$status['pesan'] = 'Bank soal berhasil dihapus';
		echo json_encode($status);
		return $query;
	}
    public function data_upload(){
    	ini_set("memory_limit","-1");
		ini_set('max_execution_time', 200);
    	
    	$this->load->library('zip');

    	$path = $this->config->item('upload_path');

		$this->zip->read_dir($path);

		// Download the file to your desktop. Name it "my_backup.zip"
		$this->zip->download('backup_data_upload.zip');
    }
	
	public function clear_session(){
		$this->load->model('cbt_sessions_model');
		
		$this->cbt_sessions_model->empty_table();
		
		$status['status'] = 1;
		$status['pesan'] = 'Sessions berhasil dihapus';
		echo json_encode($status);
	}
}