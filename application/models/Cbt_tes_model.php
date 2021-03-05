<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_tes_model extends CI_Model{
	public $table = 'cbt_tes';
	
	function __construct(){
        parent::__construct();
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
    function get_kelas_kolom($id){
        $this->db->select('grup_nama')
        ->where('cbt_tes.tes_id',$id)
        ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id')
        ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id')
        ->from('cbt_user_grup');
        return $this->db->get();
       // return $query->result_array();
           }
    function get_by_tanggal($tglawal, $tglakhir){
        $this->db->where('(DATE(tes_begin_time)>="'.$tglawal.'" AND DATE(tes_begin_time)<="'.$tglakhir.'")')
                 ->from($this->table);
        return $this->db->get();
    }
	 function getidtes(){
        $sql = "SELECT AUTO_INCREMENT as id FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'cbt' AND TABLE_NAME = 'cbt_tes'";

        return $this->db->query($sql);
    }
	function get_by_now(){
        $this->db->where('(DATE(tes_begin_time)<=DATE(NOW()) AND DATE(tes_end_time)>=DATE(NOW()))')
                 ->from($this->table)
				 ->order_by('tes_id', 'ASC');
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->select('tes_id,tes_nama,tes_detail,tes_begin_time,tes_end_time,tes_duration_time,tes_ip_range,tes_results_to_users, tes_score_right,tes_pg,tes_score_wrong, tes_score_unanswered, tes_max_score, tes_token,modul_kkm')
                 ->where($kolom, $isi)
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                  ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
    function get_by_kolom_limit_aktif(){
        $this->db->select('tes_id,tes_nama,tes_detail,tes_begin_time,tes_end_time,tes_duration_time,tes_ip_range,tes_results_to_users, tes_score_right,tes_pg,tes_score_wrong, tes_score_unanswered, tes_max_score, tesuser_token, modul_nama')
                  ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                  ->join('cbt_tes_user', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                  ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                  ->group_by('cbt_tes.tes_nama')
                 ->from($this->table);
				 return $this->db->get();
    }
    function get_jml($tes_id){
        $this->db->select('sum(cbt_tes_topik_set.tset_jumlah) AS jml')
                 ->where('cbt_tes_topik_set.tset_tes_id', $tes_id)
                ->from('cbt_tes_topik_set');				
        return $this->db->get();
    }
	function get_sudah_tes($tes_id){
        $this->db->select('sum(cbt_tes_topik_set.tset_jumlah) AS jml')
                 ->where('cbt_tes_topik_set.tset_tes_id', $tes_id)
                ->from('cbt_tes_topik_set');        
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $kolom, $isi){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%")')
    ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
     ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
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
    function set_remidi(){
        /*   if($this->db->table_exists('cbt_remidi')){
               $dbremidi = $this->db->delete('cbt_remidi');
           }else{
               */
           $dbremidi = $this->db->query('create view cbt_remidi as SELECT cbt_user_grup.grup_nama,cbt_tes.*,cbt_tes_user.tesuser_user_id,cbt_tes_user.tesuser_id,cbt_tes_user.tesuser_creation_time,
           cbt_tes_user.tesuser_tes_id,cbt_tes_user.tesuser_status, cbt_user.*,cbt_modul.modul_id, (SUM(cbt_tes_soal.tessoal_nilai)) AS nilai
                      FROM cbt_tes_user
                      join cbt_user on cbt_tes_user.tesuser_user_id = cbt_user.user_id
                      join cbt_user_grup on cbt_user.user_grup_id = cbt_user_grup.grup_id
                      join cbt_tes on cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id
                      join cbt_tes_soal on cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id
                      JOIN cbt_tes_topik_set ON cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id
                      JOIN cbt_topik ON cbt_topik.topik_id = cbt_tes_topik_set.tset_topik_id
                      JOIN cbt_modul ON cbt_modul.modul_id = cbt_topik.topik_modul_id
                    GROUP by cbt_tes_user.tesuser_id   
           ');
                   
           return $dbremidi;
         }
     function del_remidi(){
        $dbremidi = $this->db->query('drop view if exists cbt_remidi');
          return $dbremidi;
  }
}