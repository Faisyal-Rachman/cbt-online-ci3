<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbt_user_model extends CI_Model{
	public $table = 'cbt_user';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
    }
    function saveuser($data){
        $this->db->insert('cbt_user', $data);
    }
    function save1($data){
        $this->db->insert('cbt_user1', $data);
    }
    function save2($data){
        $this->db->insert('cbt_jenis_ujian', $data);
    }
    function save3($data){
        $this->db->insert('cbt_user_grup', $data);
    }
    function save4($data){
        $this->db->insert('cbt_ruang', $data);
    }
    function save5($data){
        $this->db->insert('cbt_sesi_ujian', $data);
    }
    function save6($data){
        $this->db->insert('cbt_level', $data);
    }
    function delete($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->delete($this->table);
    }
    
    function update($kolom, $isi, $data){
        $this->db->where($kolom, $isi)
                 ->update($this->table, $data);
    }
    
    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
    function count_by_master($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from('cbt_jurusan');
        return $this->db->get();
    }

    function count_by_master2($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from('cbt_modul');
        return $this->db->get();
    }
 function count_by_master3($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from('cbt_level');
        return $this->db->get();
    }
    function count_by_master4($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from('cbt_jenis_ujian');
        return $this->db->get();
    }
	function get_by_kolom($kolom, $isi){
        $this->db->select('user_id,user_grup_id,user_name,user_jkl,user_agama,user_jurusan,user_sesi,user_password,user_email,user_firstname,user_birthdate,user_detail,user_regdate')
                 ->where($kolom, $isi)
                 ->join('cbt_sesi_ujian', 'cbt_sesi_ujian.sesi_kode = cbt_user.user_sesi')
                 ->from($this->table);
        return $this->db->get();
    }
    function get_by_kolomkartu($kolom, $isi){
        $this->db->select('user_id,user_grup_id,user_name,user_jurusan,tes_jenis,user_sesi,user_password,user_email,user_firstname,user_birthdate,user_detail,user_regdate,tes_nama,tes_begin_time')
                 ->where($kolom, $isi)
                 ->join('cbt_sesi_ujian', 'cbt_sesi_ujian.sesi_kode = cbt_user.user_sesi')
                 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user.user_grup_id')
                 ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id')
                 ->from($this->table);
        return $this->db->get();
    }
     function get_bacara_kolom($id){
        $this->db->select('user_name')
        ->where('cbt_bacara.bacara_id',$id)
        ->join('cbt_absengrup', 'bt_absengrup.absen_user_id = cbt_user.user_id')
        ->join('cbt_bacara', 'cbt_bacara.bacara_id = cbt_absengrup.bacara_id')
        ->from('cbt_user_grup');
        return $this->db->get();
    }
     function getidbacara(){
        $sql = "SELECT AUTO_INCREMENT as id FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'kedaiola_cbt' AND TABLE_NAME = 'cbt_bacara'";

        return $this->db->query($sql);
    }
    function get_by_kolomuser(){
        $this->db->select('user_id,user_grup_id,user_name,user_jurusan,user_sesi,user_password,user_email,user_firstname,user_birthdate,user_detail,user_regdate')
                
                 ->join('cbt_sesi_ujian', 'cbt_sesi_ujian.sesi_kode = cbt_user.user_sesi')
                 ->from($this->table);
        return $this->db->get();
    }
    
    function get_count_user(){
        $this->db->select('*, COUNT(user_id) as hasil');
        $hasil = $this->db->get('cbt_user');
       return $hasil;
}
function get_count_soal(){
    $this->db->select('*, COUNT(soal_id) as hasil');
    $hasil = $this->db->get('cbt_soal');
   return $hasil;
}
function get_count_kelas(){
    $this->db->select('*, COUNT(grup_id) as hasil');
    $hasil = $this->db->get('cbt_user_grup');
   return $hasil;
}
function get_count_topiksoal(){
    $this->db->select('*, COUNT(topik_id) as hasil');
    $hasil = $this->db->get('cbt_topik');
   return $hasil;
}
function get_token(){
    
    $this->db->select('*,token_isi as hasil')
    ->limit(1)
    ->order_by('token_ts', 'DESC');
     $hasil = $this->db->get('cbt_tes_token');
   return $hasil;
}
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->select('*')
                 ->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function count_by_username_password($username, $password){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('(user_name="'.$username.'" AND user_password="'.$password.'")')
                 ->from($this->table);
        return $this->db->get()->row()->hasil;  
    }

    function get_by_username($username){
        $this->db->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id','LEFT')
                 ->where('user_name',$username)
                 ->limit(1);
        $query = $this->db->get($this->table);
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
	 function get_cek_ujianuser($username,$grupid){
      $this->db->select('*')
         ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id')
          ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id')
           ->join('cbt_user_grup', 'cbt_user_grup.grup_id = cbt_user.user_grup_id')
        ->where('cbt_user.user_name = "'.$username.'" AND cbt_tesgrup.tstgrp_grup_id = "'.$grupid.'" AND cbt_tes.tes_status = 1')
                 ->from('cbt_user');
         $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
     function get_cek_ujianusercount($username,$grupid){
      $this->db->select('count(*) as hasil')
         ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id')
          ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id')
           ->join('cbt_user_grup', 'cbt_user_grup.grup_id = cbt_user.user_grup_id')
        ->where('cbt_user.user_name = "'.$username.'" AND cbt_tesgrup.tstgrp_grup_id = "'.$grupid.'" AND cbt_tes.tes_status = 1')
                 ->from('cbt_user');
         $query = $this->db->get();
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
	function get_datatable($start, $rows, $kolom, $isi, $group){
        $query = '';
        if($group!='semua'){
            $query = 'AND user_grup_id='.$group;
        }
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" '.$query.')')
                 ->from($this->table)
				 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi, $group){
        $query = '';
        if($group!='semua'){
            $query = 'AND user_grup_id='.$group;
        }
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" '.$query.')')
                 ->from($this->table);
        return $this->db->get();
	}
	
	/**
	* export data user yang belum mengerjakan
	*/
	function get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tes_begin_time>="'.$tanggal[0].'" AND tes_end_time<="'.$tanggal[1].'" AND tesuser_id IS NULL';
		
           $sql = $sql.' AND nilai<=tes_pg';
        $this->db->select('*')
             ->where('('.$sql.' )')
             ->from('cbt_remidi');
           
    return $this->db->get();
    }
    function get_by_tes_group_urut_tanggal_absen($tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tes_begin_time>="'.$tanggal[0].'" AND tes_end_time<="'.$tanggal[1].'" AND tesuser_id IS NULL';
		
      
        $order = '';
        if($urutkan=='nama'){
            $order = 'user_firstname ASC';
        }else if($urutkan=='waktu'){
            $order = 'tes_begin_time DESC';
        }else{
            $order = 'tes_id ASC';
        }
	

		$this->db->select('cbt_tes.*,cbt_user_grup.grup_nama, cbt_tes_user.tesuser_creation_time, cbt_user.*, "0" AS nilai')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
				 ->order_by($order);
                
        return $this->db->get();
    }
	/**
	* datatable untuk hasil tes yang belum mengerjakan
	*
	*/
	function get_datatable_hasiltes($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tes_begin_time>="'.$tanggal[0].'" AND tes_end_time<="'.$tanggal[1].'" AND tesuser_id IS NULL';
		
      
        $order = '';
        if($urutkan=='nama'){
            $order = 'user_firstname ASC';
        }else if($urutkan=='waktu'){
            $order = 'tes_begin_time DESC';
        }else{
            $order = 'tes_id ASC';
        }
	

		$this->db->select('cbt_tes.*,cbt_user_grup.grup_nama, cbt_tes.*, cbt_user.*, "0" AS nilai')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
				 ->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_hasiltes_count($tes_id, $grup_id, $urutkan, $tanggal){
        $sql = '(tes_begin_time>="'.$tanggal[0].'" AND tes_end_time<="'.$tanggal[1].'") AND tesuser_id IS NULL';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
		
		if(!empty($keterangan)){
			$sql = $sql.' AND user_detail LIKE "%'.$keterangan.'%"';
		}

		$this->db->select('COUNT(*) AS hasil')
                 ->where('( '.$sql.' )')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
                 ->from($this->table);
        return $this->db->get();
    }
    function get_datatable_hasiltes_remidi($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal, $keterangan){
        $sql = 'tes_begin_time>="'.$tanggal[0].'" AND tes_end_time<="'.$tanggal[1].'" AND tesuser_id IS NULL';
		
      
        $order = '';
        if($urutkan=='nama'){
            $order = 'user_firstname ASC';
        }else if($urutkan=='waktu'){
            $order = 'tes_begin_time DESC';
        }else{
            $order = 'tes_id ASC';
        }
	

		$this->db->select('cbt_tes.*,cbt_user_grup.grup_nama, cbt_tes.*, cbt_user.*, "0" AS nilai')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
				 ->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
    }

    function get_datatable_hasiltes_count_remidi($tes_id, $grup_id, $urutkan, $tanggal, $keterangan){
        $sql = '(tes_begin_time>="'.$tanggal[0].'" AND tes_end_time<="'.$tanggal[1].'") AND tesuser_id IS NULL';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
	
		$this->db->select('COUNT(*) AS hasil')
                 ->where('( '.$sql.' )')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
				 ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
				 ->join('cbt_tes_user', '(cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id) AND (cbt_tes_user.tesuser_user_id = cbt_user.user_id)', 'left')
                 ->from($this->table);
        return $this->db->get();
    }
}