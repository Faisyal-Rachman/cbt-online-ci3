<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_tes{
	function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->helper('cookie');
		$this->CI->load->model('cbt_user_model');
		
		$this->users_model =& $this->CI->cbt_user_model;
	}
	
	
	/**
	 * proses login
	 * 0 = username tak ada
	 * 1 = sukses
	 * 2 = password salah
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @return boolean
	 */
	function login($username, $password){
//	echo $username;
		$result = $this->users_model->get_by_username($username);
		if($result){
			$result2 = $this->users_model->get_cek_ujianusercount($username,$result->grup_id);
			$result3 = $this->users_model->get_cek_ujianuser($username,$result->grup_id);
			$g = 4;
			if($password === $result->user_password AND $result2->hasil>0){
				$this->CI->session->set_userdata('cbt_tes_userid',$result3->user_id);
				$this->CI->session->set_userdata('cbt_tes_user_id',$result3->user_name);
				//$this->CI->session->set_userdata('cbt_tes_id',$result->tesuser_user_id);
				$this->CI->session->set_userdata('cbt_tes_nama',stripslashes($result3->user_firstname));
				$this->CI->session->set_userdata('cbt_tes_nas',stripslashes($result3->user_birthdate));
                $this->CI->session->set_userdata('cbt_tes_group',$result3->grup_nama);
                $this->CI->session->set_userdata('cbt_tes_group_id',$result3->grup_id);
				return 1;
			}else{
				return 2;
				return 3;
			}
		}
		return 2;
	}
	
	/**
	 * cek apakah sudah login
	 * @return boolean
	 */
	function is_login(){
		return (($this->CI->session->userdata('cbt_tes_user_id')) ? TRUE : FALSE);
	}
	function get_userid(){
		return $this->CI->session->userdata('cbt_tes_userid');
	}

	function get_username(){
		return $this->CI->session->userdata('cbt_tes_user_id');
	}
	
	function get_tes_id(){
		return $this->CI->session->userdata('cbt_tes_id');
	}
	
    function get_nama(){
		return $this->CI->session->userdata('cbt_tes_nama');
	}
    function get_nama_asli(){
		return $this->CI->session->userdata('cbt_tes_nas');
	}
    function get_group(){
		return $this->CI->session->userdata('cbt_tes_group');
	}
    
    function get_group_id(){
		return $this->CI->session->userdata('cbt_tes_group_id');
	}
	
	/**
	 * logout
	 */
	function logout(){
		$this->CI->session->unset_userdata('cbt_tes_user_id');
		$this->CI->session->unset_userdata('cbt_tes_nama');
		$this->CI->session->unset_userdata('cbt_tes_group_id');
		$this->CI->session->unset_userdata('cbt_tes_group');
	}
}