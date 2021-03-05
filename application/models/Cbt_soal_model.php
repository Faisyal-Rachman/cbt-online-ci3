<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_soal_model extends CI_Model{
	public $table = 'cbt_soal';
	
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
 function count_by_kolomsoal($kolom, $isi){
        $this->db->select('soal_id,soal_topik_id,
(SELECT COUNT(*) FROM cbt_soal WHERE soal_tipe = 1 AND soal_topik_id = '.$isi.') AS objective,
(SELECT COUNT(*) FROM cbt_soal WHERE soal_tipe = 2 AND soal_topik_id = '.$isi.') as js,
(SELECT COUNT(*) FROM cbt_soal WHERE soal_tipe = 3 AND soal_topik_id = '.$isi.') AS esai')
              ->group_by('soal_topik_id', 'ASC')
                ->limit(1)
                 ->from($this->table);
        return $this->db->get();
    }
    function get_all(){
        $this->db->from($this->table)
                 ->order_by('soal_id', 'ASC');
        return $this->db->get();
    }
    function getidsoal(){
        $sql = "SELECT AUTO_INCREMENT as id FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'cbt' AND TABLE_NAME = 'cbt_soal'";

        return $this->db->query($sql);
    }
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->join('cbt_jawaban', 'cbt_jawaban.jawaban_soal_id = cbt_soal.soal_id','LEFT')
                 ->from($this->table);
           
        return $this->db->get();
    }

    function get_by_topik_tipe_kesulitan_select_limit($topik, $tipe, $kesulitan, $select, $limit){
        $tipe_sql = '';
        if($tipe!=0){
            $tipe_sql = ' AND soal_tipe="'.$tipe.'"';
        }
        $sql = 'SELECT '.$select.' FROM cbt_soal WHERE soal_topik_id="'.$topik.'" AND soal_difficulty="'.$kesulitan.'" '.$tipe_sql.' ORDER BY RAND() LIMIT '.$limit;


        return $this->db->query($sql);
    }

    function get_by_topik_tipe_kesulitan_select_limit_tanpa_acak($topik, $tipe, $kesulitan, $select, $limit){
        $tipe_sql = '';
        if($tipe!=0){
            $tipe_sql = ' AND soal_tipe="'.$tipe.'"';
        }
        $sql = 'SELECT '.$select.' FROM cbt_soal WHERE soal_topik_id="'.$topik.'" AND soal_difficulty="'.$kesulitan.'" '.$tipe_sql.' ORDER BY soal_id ASC LIMIT '.$limit;


        return $this->db->query($sql);
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $kolom, $isi, $topik){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND soal_topik_id="'.$topik.'")')
                 ->from($this->table)
				 ->order_by('soal_id', 'DESC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi, $topik){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND soal_topik_id="'.$topik.'")')
                 ->from($this->table);
        return $this->db->get();
	}
  function get_datatable2($start, $rows, $kolom, $isi, $topik){
   $this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND soal_topik_id="'.$topik.'")')
                 ->from('cbt_soal')
               
                 ->limit($rows, $start);
        return $this->db->get();
  }
   function get_datatable_count2($kolom, $isi, $topik){
    $this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND soal_topik_id="'.$topik.'")')
              
                 ->from('cbt_soal');
        return $this->db->get();
    }
}