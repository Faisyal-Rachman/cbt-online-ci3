<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_konfigurasi_model extends CI_Model{
	public $table = 'cbt_konfigurasi';
	
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
    
    function count_all(){
        $this->db->select('COUNT(*) AS hasil')
                 ->from($this->table);
        return $this->db->get();
    }

    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
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
  function get_logotk(){
        $this->db->select('*');
        $this->db->from('cbt_konfigurasi');
        $this->db->where('konfigurasi_id', 9);
        $this->db->limit(1); 
        $query = $this->db->get()->result();
        return $query;
    }
    function get_logo(){
        $this->db->select('*');
        $this->db->from('cbt_konfigurasi');
        $this->db->where('konfigurasi_id', 5);
        $query = $this->db->get()->result();
        return $query;
    }
     function get_logo2(){
        $this->db->select('*');
        $this->db->from('cbt_konfigurasi');
        $this->db->where('konfigurasi_id', 9);
        $query = $this->db->get()->result();
        return $query;
    }
}