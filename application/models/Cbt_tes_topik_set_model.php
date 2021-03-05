<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbt_tes_topik_set_model extends CI_Model{
	public $table = 'cbt_tes_topik_set';
	
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
        $this->db->select('COUNT('.$kolom.') AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function count_by_test_topik($tes_id, $topik){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('tset_tes_id="'.$tes_id.'" AND tset_topik_id="'.$topik.'"')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom($kolom, $isi){
        $this->db->select('tset_id,tset_tes_id, tset_topik_id, tset_tipe, tset_difficulty,tset_jumlah,tset_modul,tset_jawaban,tset_acak_jawaban,tset_acak_soal,modul_nama')
                 ->where($kolom, $isi)
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $tes_id){
        $this->db->select('tset_id,tset_tes_id, tset_topik_id, tset_tipe, tset_difficulty,tset_jumlah,tset_modul,tset_jawaban,tset_acak_jawaban,tset_acak_soal,modul_nama')
                ->where('(tset_tes_id="'.$tes_id.'")')
                 ->from($this->table)
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
				 ->order_by('tset_id', 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    function get_tessoal($tes_id){
        $this->db->select('tset_id,tset_tes_id, tset_topik_id, tset_tipe, tset_difficulty,tset_jumlah,tset_modul,tset_jawaban,tset_acak_jawaban,tset_acak_soal,modul_id,modul_nama')
                ->where('(tset_tes_id="'.$tes_id.'")')
                 ->from($this->table)
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->order_by('tset_id', 'ASC');
         return $this->db->get();
    }
    function get_datatable_count($tes_id){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('(tset_tes_id="'.$tes_id.'")')
                 ->from($this->table);
        return $this->db->get();
	}
}