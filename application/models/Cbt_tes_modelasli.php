<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_tes_model extends CI_Model{
	public $table = 'cbt_tes';
	
	function __construct(){
        parent::__construct();
        $d='1';
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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
	
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function get_by_tanggal($tglawal, $tglakhir){
        $this->db->where('(DATE(tes_begin_time)>="'.$tglawal.'" AND DATE(tes_begin_time)<="'.$tglakhir.'")')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_now(){
        $this->db->where('(DATE(tes_begin_time)<=DATE(NOW()) AND DATE(tes_end_time)>=DATE(NOW()))')
                 ->from($this->table)
				 ->order_by('tes_id', 'ASC');
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->select('tes_id,tes_nama,tes_detail,tes_jenis,tes_status,tes_begin_time,tes_end_time,tes_duration_time,tes_ip_range,tes_results_to_users, tes_score_right, tes_score_wrong, tes_score_unanswered, tes_max_score, tes_token,cbt_tes_topik_set.*')
                 ->where($kolom, $isi)
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function get_kelas_kolom($id){
        $this->db->select('grup_nama')
        ->where('cbt_tes.tes_id',$id)
        ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
        ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id')
        ->from('cbt_user_grup');
        return $this->db->get();
       // return $query->result_array();
           }
	
	
	function get_datatable($start, $rows, $kolom, $isi){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table)
				 ->order_by('tes_id', 'DESC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%")')
                 ->from($this->table);
        return $this->db->get();
	}
}