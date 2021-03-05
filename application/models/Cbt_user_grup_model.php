<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbt_user_grup_model extends CI_Model{
	public $table = 'cbt_user_grup';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
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
    function count_by_kolom_jurusan($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from('cbt_jurusan');
        return $this->db->get();
    }
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
    function get_by_kolom_limit_sesi($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from('cbt_sesi_ujian')
				 ->limit($limit);
        return $this->db->get();
    }
    function get_by_kolom_limit_ruang($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from('cbt_ruang')
				 ->limit($limit);
        return $this->db->get();
    }
    function get_by_kolom_limit_jurusan($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from('cbt_jurusan')
				 ->limit($limit);
        return $this->db->get();
    }
    function save1($data){
        $this->db->insert('cbt_modul', $data);
    }
    function get_jenis(){
        $this->db->from('cbt_jenis_ujian')
                 ->order_by('jenis_nama', 'ASC');
        return $this->db->get();
    }
    function get_group(){
        $this->db->from($this->table)
                 ->order_by('grup_nama', 'ASC');
        return $this->db->get();
    }
    function get_agama(){
        $this->db->from('cbt_agama')
                 ->order_by('agama_id', 'ASC');
        return $this->db->get();
    }
     function get_jkl(){
        $this->db->from('cbt_jkl')
                 ->order_by('jkl_id', 'ASC');
        return $this->db->get();
    }
	 function get_sesi(){
        $this->db->from('cbt_sesi_ujian')
                 ->order_by('sesi_nama', 'ASC');
        return $this->db->get();
    }
	function get_datatable($start, $rows, $kolom, $isi){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table)
				 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    function get_datatablejur($start, $rows, $kolom, $isi){
        $this->db->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from('cbt_jurusan')
                 ->order_by($kolom, 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
    }
    function get_datatable_count($kolom, $isi){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table);
        return $this->db->get();
    }
    function get_datatable_countjur($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from('cbt_jurusan');
        return $this->db->get();
    }
    function get_groupnilai(){
        $this->db->from($this->table)
        ->order_by('grup_nama', 'ASC');
return $this->db->get();
	}
}