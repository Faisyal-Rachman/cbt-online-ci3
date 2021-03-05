<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_web extends Member_Controller {
	private $kode_menu = 'pengaturan-web';
	private $kelompok = 'pengaturan';
	private $url = 'manager/pengaturan_web';
	
	
    function __construct(){
		parent:: __construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('cbt_konfigurasi_model');
		$this->load->model('Master_model', 'master');
		parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
		$data = [
			'gambar'	=> $this->cbt_konfigurasi_model->get_logo(),
			'gambar2'	=> $this->cbt_konfigurasi_model->get_logo2(),
			'gambar23'	=> $this->cbt_konfigurasi_model->get_logotk(),
			'subjudul' => 'Status Ujian'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/pengaturan_web_view', 'Pengaturan web', $data);
    }

    function simpan(){
		
	       $this->load->library('form_validation');
        
        $this->form_validation->set_rules('web-nama', 'Nama web','required|strip_tags');
        $this->form_validation->set_rules('web-keterangan', 'Keterangan web','required|strip_tags');
		//$this->form_validation->set_rules('web-link-login', 'Link Login Operator','required|strip_tags');
		$this->form_validation->set_rules('web-mobile-lock-xambro', 'Lock Mobile Exam Browser','required|strip_tags');
		$this->form_validation->set_rules('jenjang-pendidikan', 'Jenjang Sekolah','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['konfigurasi_isi'] = $this->input->post('web-nama', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_nama', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('web-keterangan', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_keterangan', $data);
			
		//	$data['konfigurasi_isi'] = $this->input->post('web-link-login', true);
		//	$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'link_login_operator', $data);
			
			$data['konfigurasi_isi'] = $this->input->post('web-mobile-lock-xambro', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_mobile_lock_xambro', $data);

			$data['konfigurasi_isi'] = $this->input->post('jenjang-pendidikan', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_jenjang_sekolah', $data);
              $data['konfigurasi_isi'] = $this->input->post('cbt_login', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_login', $data);
			  $data['konfigurasi_isi'] = $this->input->post('cbt_tahun', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'cbt_tahun', $data);
			
			 $data['konfigurasi_isi'] = $this->input->post('web-kepala', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'kepala_sekolah', $data);
			
			 $data['konfigurasi_isi'] = $this->input->post('web-kepala-nip', true);
			$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'nip_kepala_sekolah', $data);
           
            $status['status'] = 1;
			$status['pesan'] = 'Pengaturan berhasil disimpan ';
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    function get_pengaturan_web(){
    	$data['data'] = 1;
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'link_login_operator', 1);
		$data['link_login_operator'] = 'ya';
		if($query->num_rows()>0){
			$data['link_login_operator'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
		$data['cbt_nama'] = 'Computeddr Based-Test';
		if($query->num_rows()>0){
			$data['cbt_nama'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_keterangan', 1);
		$data['cbt_keterangan'] = 'Ujian Online Berbasis Komputer';
		if($query->num_rows()>0){
			$data['cbt_keterangan'] = $query->row()->konfigurasi_isi;
		}
		
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_mobile_lock_xambro', 1);
		$data['mobile_lock_xambro'] = 'ya';
		if($query->num_rows()>0){
			$data['mobile_lock_xambro'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_jenjang_sekolah', 1);
		$data['jenjang_pendidikan'] = 'sd';
		if($query->num_rows()>0){
			$data['jenjang_pendidikan'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'logo_sekolah', 1);
		$data['logo_sekolah'] = 'ya';
		if($query->num_rows()>0){
			$data['logo_sekolah'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'logo_sekolah_2', 1);
		$data['logo_sekolah_2'] = '';
		if($query->num_rows()>0){
			$data['logo_sekolah_2'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_login', 1);
		$data['cbt_login'] = '';
		if($query->num_rows()>0){
			$data['cbt_login'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun', 1);
		$data['cbt_tahun'] = '';
		if($query->num_rows()>0){
			$data['cbt_tahun'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'kepala_sekolah', 1);
		$data['kepala_sekolah'] = '';
		if($query->num_rows()>0){
			$data['kepala_sekolah'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'nip_kepala_sekolah', 1);
		$data['nip_kepala_sekolah'] = '';
		if($query->num_rows()>0){
			$data['nip_kepala_sekolah'] = $query->row()->konfigurasi_isi;
		}
		$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'tanda_tangan', 1);
		$data['tanda_tangan'] = '';
		if($query->num_rows()>0){
			$data['tanda_tangan'] = $query->row()->konfigurasi_isi;
		}
		echo json_encode($data);
	}
	function uploadImage()
{
	
	$config['upload_path']          = './assets/img';

	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['max_width']            = 1024;

	$config['max_height']           = 768;

	$this->load->library('upload', $config);
	
	if ( ! $this->upload->do_upload('berkas')){
		$data = array('upload_data' => $this->upload->data());
		$newImage['konfigurasi_isi'] = $data['upload_data']['file_name'];
		$error = array('error' => $this->upload->display_errors());
		$status['status'] = 0;
		$status['pesan'] = 'Periksa logo sekolah';
		
		}else{
		
		$data = array('upload_data' => $this->upload->data());
		$newImage['konfigurasi_isi'] = $data['upload_data']['file_name'];
		$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'logo_sekolah', $newImage);
		//$this->cbt_konfigurasi_model->setValueStore('sitelogo', $newImage);
		redirect('manager/pengaturan_web');
		
		}
		echo json_encode($status);
}
function uploadImage2()
{
	
	$config['upload_path']          = './assets/img';

	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['max_width']            = 1024;

	$config['max_height']           = 768;

	$this->load->library('upload', $config);
	
	if ( ! $this->upload->do_upload('berkas2')){
		$data = array('upload_data' => $this->upload->data());
		$newImage['konfigurasi_isi'] = $data['upload_data']['file_name'];
		$error = array('error' => $this->upload->display_errors());
		$status['status'] = 0;
		$status['pesan'] = 'Periksa logo sekolah';
		
		}else{
		
		$data = array('upload_data' => $this->upload->data());
		$newImage['konfigurasi_isi'] = $data['upload_data']['file_name'];
		$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'logo_sekolah_2', $newImage);
		//$this->cbt_konfigurasi_model->setValueStore('sitelogo', $newImage);
		redirect('manager/pengaturan_web');
		
		}
		echo json_encode($status);
}
function uploadImage3()
{
	
	$config['upload_path']          = './assets/img';

	$config['allowed_types']        = 'gif|jpg|png';

	$config['max_size']             = 2048;

	$config['max_width']            = 1024;

	$config['max_height']           = 768;

	$this->load->library('upload', $config);
	
	if ( ! $this->upload->do_upload('berkas3')){
		$data = array('upload_data' => $this->upload->data());
		$newImage['konfigurasi_isi'] = $data['upload_data']['file_name'];
		$error = array('error' => $this->upload->display_errors());
		$status['status'] = 0;
		$status['pesan'] = 'Periksa tanda tangan';
		
		}else{
		
		$data = array('upload_data' => $this->upload->data());
		$newImage['konfigurasi_isi'] = $data['upload_data']['file_name'];
		$this->cbt_konfigurasi_model->update('konfigurasi_kode', 'tanda_tangan', $newImage);
		//$this->cbt_konfigurasi_model->setValueStore('sitelogo', $newImage);
		redirect('manager/pengaturan_web');
		
		}
		echo json_encode($status);
}
}