<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {
    public $table = 'cbt_level';

    public function create($table, $data, $batch = false)
    {
        if($batch === false){
            $insert = $this->db->insert($table, $data);
        }else{
            $insert = $this->db->insert_batch($table, $data);
        }
        return $insert;
    }

    public function update($table, $data, $pk, $id = null, $batch = false)
    {
        if($batch === false){
            $insert = $this->db->update($table, $data, array($pk => $id));
        }else{
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }

 public function update2($table, $data, $pk, $id = null, $batch = false)
    {
       
            $insert = $this->db->update_batch($table, $data, $pk);
        
        return $insert;
    }
    public function delete($table, $data, $pk)
    {
        $this->db->where_in($pk, $data);
        return $this->db->delete($table);
    }
    public function hps($tablef, $data, $pk)
    {
        $this->db->where_in($pk, $data);
        return $this->db->delete('cbt_info');
    }

    /**
     * Data Jenis Ujian
     */
    public function getStatusUjian()
    {
        $this->datatables->select('cbt_tes_user.*, IF( NOW()>tesuser_creation_time, "Selesai", "Belum Selesai") as status, cbt_tes_topik_set.*,cbt_tes.*,cbt_user.*,cbt_user_grup.*');
        $this->datatables->from('cbt_tes_user');
        $this->datatables->join('cbt_tes','cbt_tes.tes_id = cbt_tes_user.tesuser_tes_id');
        $this->datatables->join('cbt_tes_topik_set','cbt_tes_topik_set.tset_tes_id = cbt_tes_user.tesuser_tes_id');
        $this->datatables->join('cbt_user','cbt_tes_user.tesuser_user_id = cbt_user.user_id');
        $this->datatables->join('cbt_user_grup','cbt_user.user_grup_id = cbt_user_grup.grup_id');
     //   $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'tes_id,tes_nama');
        return $this->datatables->generate();
    }
    public function getNilaiUjian()
    {
        $this->datatables->select('cbt_remidi.user_birthdate,cbt_remidi.user_firstname,cbt_remidi.tes_jenis,cbt_remidi.grup_nama,cbt_remidi.tes_duration_time,cbt_sesi_ujian.sesi_nama,round(cbt_remidi.nilai) as nilai');
        $this->datatables->join('cbt_sesi_ujian','cbt_sesi_ujian.sesi_kode = cbt_remidi.user_sesi');
        $this->datatables->from('cbt_remidi');
     //  $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'tes_id,tes_nama');
        return $this->datatables->generate();
    }
    public function getStatusUjian2()
    {
        $this->datatables->select('cbt_tes.*');
        $this->datatables->from('cbt_tes');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'tes_id,tes_nama');
        return $this->datatables->generate();
    }
    public function jenis(){
        $this->db->select('cbt_tes.tes_jenis');
        $this->db->from('cbt_tes');
        $this->db->group_by('cbt_tes.tes_jenis');
        $query = $this->db->get()->result();
        return $query;
        }
        public function mapel(){
        $this->db->select('*');
        $this->db->from('cbt_modul');
         $this->db->where('(modul_aktif=1)');
        $query = $this->db->get()->result();
        return $query;
        } 
    /**
     * Data Sesi
     */
    public function getUjian()
    {
        $this->db->join('cbt_tes_topik_set','cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id');
        $this->db->join('cbt_modul','cbt_modul.modul_id = cbt_tes_topik_set.tset_modul');
        $this->db->where_in('*');
        $this->db->order_by('tes_nama');
        $query = $this->db->get('cbt_tes')->result();
        return $query;
    }
     public function getKelas()
    {
        $this->db->join('cbt_tesgrup','cbt_tesgrup.tstgrp_grup_id = cbt_user_grup.grup_id');
        $this->db->where_in('*');
        $this->db->order_by('grup_nama');
        $query = $this->db->get('cbt_user_grup')->result();
        return $query;
    }
    
    public function sesi(){
        $this->db->select('cbt_sesi_ujian.*');
        $this->db->from('cbt_sesi_ujian');
        $query = $this->db->get()->result();
        return $query;
        }

    public function getDataSesi()
    {
        $this->datatables->select('sesi_id, sesi_nama,sesi_kode');
        $this->datatables->from('cbt_sesi_ujian');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'sesi_id,sesi_nama,sesi_kode');        
        return $this->datatables->generate();
    }
    public function getSesiById($id)
    {
        $this->db->where_in('sesi_id', $id);
        $this->db->order_by('sesi_nama');
        $query = $this->db->get('cbt_sesi_ujian')->result();
        return $query;
    }
    public function getSesiAll()
    {
        $this->db->where_in('*');
        $this->db->order_by('sesi_nama');
        $query = $this->db->get('cbt_sesi_ujian')->result();
        return $query;
    }

/**
     * Data Ruang
     */
    public function proktor(){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('level','operator-tes');
        $query = $this->db->get()->result();
        return $query;
        } 
      


/**
     * Data Ruang
     */

    public function getjenis(){
        $this->db->select('cbt_jenis_ujian.*');
        $this->db->from('cbt_jenis_ujian');
        $this->db->where('status', 1);
        $query = $this->db->get()->result();
        return $query;
        }
    public function ruang(){
        $this->db->select('cbt_ruang.*');
        $this->db->from('cbt_ruang');
        $query = $this->db->get()->result();
        return $query;
        }
    public function getDataRuang()
    {
        $this->datatables->select('ruang_id, ruang_nama, ruang_kode');
        $this->datatables->from('cbt_ruang');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'ruang_id, ruang_nama, ruang_kode');        
        return $this->datatables->generate();
    }

    public function getRuangById($id)
    {
        $this->db->where_in('ruang_id', $id);
        $this->db->order_by('ruang_nama');
        $query = $this->db->get('cbt_ruang')->result();
        return $query;
    }

    public function getAllRuang()
    {
        return $this->db->get('cbt_ruang')->result();
    }

/**
 * Guru Pengampu
 */
public function guru_pengampu(){
    $this->db->select('guru_pengampu.*');
    $this->db->from('guru_pengampu');
    $query = $this->db->get()->result();
    return $query;
    }
    public function guru_pengampu2(){
        $this->db->select('guru_pengampu.*');
        $this->db->from('guru_pengampu');
        $query = $this->db->get();
        return $query;
        }
    public function getDataGuru()
    {
        $this->datatables->select('guru_id, guru_nama, guru_kode');
        $this->datatables->from('guru_pengampu');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'guru_id, guru_nama, guru_kode');        
        return $this->datatables->generate();
    }
    public function getGuruById($id)
    {
        $this->db->where_in('guru_id', $id);
        $this->db->order_by('guru_nama');
        $query = $this->db->get('guru_pengampu')->result();
        return $query;
    }
    public function getAllGuru()
    {
        return $this->db->get('guru_pengampu')->result();
    }
    /**
   
  public function get_level(){
    $this->db->select('cbt_level.level_nama, cbt_user_grup.*');
    $this->db->from('cbt_user_grup');
      $this->db->join('cbt_level', 'cbt_level.level_kode = cbt_user_grup.level_kode_kelas');
    $query = $this->db->get()->result();
    return $query;
    }
    * Data Kelas
    */
    public function get_level(){
        $this->db->select('cbt_level.*');
        $this->db->from('cbt_level');
        $query = $this->db->get()->result();
        return $query;
        }
         public function get_levelInput(){
         $this->db->from('cbt_level')
                 ->order_by('level_nama', 'ASC');
        return $this->db->get();
    }
     public function get_kelasInput(){
         $this->db->from('cbt_user_grup')
                 ->order_by('grup_id', 'ASC');
        return $this->db->get();
    }
     public function getEditLevel($id = null){
            if($id === null){
            $this->db->order_by('level_nama', 'ASC');
            return $this->db->get('cbt_level')->result();    
        }else{
            $this->db->select('level_kode_kelas');
            $this->db->from('cbt_user_grup');
            $this->db->where('level_id', $id);
            $jurusan = $this->db->get()->result();
            $id_jurusan = [];
            foreach ($jurusan as $j) {
                $id_jurusan[] = $j->jurusan_id;
            }
            if($id_jurusan === []){
                $id_jurusan = null;
            }
            
            $this->db->select('*');
            $this->db->from('cbt_user_grup');
            $this->db->where_not_in('level_kode_kelas', $id_jurusan);
            $matkul = $this->db->get()->result();
            return $matkul;
        }
            }
    public function get_level_by_id($id){
        $this->db->where('id', $id)
                 ->from('user_menu')
                 ->limit(1);
        return $this->db->get();
    }
    function get_kelas($kolom, $isi){
        $this->db->select('cbt_level.*, cbt_user_grup.*')
                 ->join('cbt_user_grup', 'cbt_level.level_kode = cbt_user_grup.level_kode_kelas')
                 ->from($this->table)
                 ->where($kolom, $isi);
        return $this->db->get();
    }

    public function getDataBacara()
    {
        $this->datatables->select('tes_nama,bacara_id,bacaraujian_id,tes_begin_time,tes_end_time,bacara_operator,bacara_ujian_mulai,bacara_ujian_akhir,bacara_pengawas,bacara_nip_pengawas,bacara_nip_operator,bacara_tdk_hadir,bacara_catatan');
        $this->datatables->from('cbt_bacara');
        $this->datatables->join('cbt_tes',' cbt_tes.tes_id = cbt_bacara.bacaraujian_id');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'bacara_id,bacaraujian_id,bacara_sesi,bacara_ruang,tes_begin_time,tes_end_time,bacara_operator,bacara_pengawas,bacara_catatan');        
        return $this->datatables->generate();
    }
    public function getBacarabyid($id)
    {
        $this->db->where_in('bacara_id', $id);
        $this->db->order_by('bacaraujian_id');
        $query = $this->db->get('cbt_bacara')->result();
        return $query;
    }
    public function getDataInfo()
    {
        $this->datatables->select('info_id,info_judul,info_isi,info_kategori,info_tgl');
        $this->datatables->from('cbt_info');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'info_id,info_judul,info_isi,info_kategori,info_tgl');        
        return $this->datatables->generate();
    }
    public function getDataInfoPm()
    {
        $this->db->select('info_id,info_judul,info_isi,info_kategori,info_tgl');
        $this->db->from('cbt_info');
        $query = $this->db->get()->result();
        return $query;
    }
    public function getInfobyid($id)
    {
      
         $this->db->select('info_id,info_judul,info_kategori,info_isi,info_tgl')
                 ->where('info_id', $id)
                   ->from('cbt_info');
        return $this->db->get();
    }
    public function getDataKelas()
    {
        $this->datatables->select('grup_id,grup_nama,level_kode_kelas');
        $this->datatables->from('cbt_user_grup');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'grup_id,grup_nama,level_kode_kelas');        
        return $this->datatables->generate();
    }

    public function getKelasById($id)
    {
        $this->db->where_in('grup_id', $id);
        $this->db->order_by('grup_nama');
        $query = $this->db->get('cbt_user_grup')->result();
        return $query;
    }

    public function getAllKelas()
    {
        return $this->db->get('cbt_user_grup')->result();
    }

    public function getAllSesi()
    {
        return $this->db->get('cbt_user_grup')->result();
    }

    /**
     * Data Matpel
     */

    public function getDataMapel($start, $rows)
    {
       $this->db->order_by('modul_id', 'ASC');
        $this->db->limit($rows, $start);
        $hasil = $this->db->get('cbt_modul');
        return $hasil;
    }
     public function get_datatable_mapel_count(){
        $this->db->select('COUNT(*) AS hasil')
                  ->from('cbt_modul');
        return $this->db->get();
    }

   public function get_by_kolom_mapel($kolom, $isi){
        $this->db->select('*')
                 ->where($kolom, $isi)
                         ->from('cbt_modul');
        return $this->db->get();
    }
public function getmatpelById($id){
        $this->db->where('modul_id',$id)
                ->from('cbt_modul');
        return $this->db->get();
        
    }
    public function getruangId($id){
        $this->db->where('ruang_id',$id)
                ->from('cbt_ruang');
        return $this->db->get();
        
    }
    public function getlevelId($id){
        $this->db->where('level_id',$id)
                ->from('cbt_level');
        return $this->db->get();
        
    }
     public function getjurusanId($id){
        $this->db->where('jurusan_id',$id)
                ->from('cbt_jurusan');
        return $this->db->get();
        
    }
    public function getRuang($start, $rows)
    {
       $this->db->order_by('ruang_id', 'ASC');
        $this->db->limit($rows, $start);
        $hasil = $this->db->get('cbt_ruang');
        return $hasil;
    }
     public function getkelasId($id){
        $this->db->where('grup_id',$id)
                ->from('cbt_user_grup');
        return $this->db->get();
        
    }
      public function get_datatable_ruang_count(){
        $this->db->select('COUNT(*) AS hasil')
                  ->from('cbt_ruang');
        return $this->db->get();
    }
   public function getLevel($start, $rows)
    {
       $this->db->order_by('level_id', 'ASC');
        $this->db->limit($rows, $start);
        $hasil = $this->db->get('cbt_level');
        return $hasil;
    }
      public function get_datatable_level_count(){
        $this->db->select('COUNT(*) AS hasil')
                  ->from('cbt_level');
        return $this->db->get();
    }
    public function getKelasT($start, $rows)
    {
       $this->db->order_by('grup_id', 'ASC');
        $this->db->limit($rows, $start);
        $hasil = $this->db->get('cbt_user_grup');
        return $hasil;
    }
      public function get_datatable_kelas_count(){
        $this->db->select('COUNT(*) AS hasil')
                  ->from('cbt_user_grup');
        return $this->db->get();
    }
    public function getSesi($start, $rows)
    {
       $this->db->order_by('sesi_id', 'ASC');
        $this->db->limit($rows, $start);
        $hasil = $this->db->get('cbt_sesi_ujian');
        return $hasil;
    }
      public function get_datatable_sesi_count(){
        $this->db->select('COUNT(*) AS hasil')
                  ->from('cbt_sesi_ujian');
        return $this->db->get();
    }
    public function getsesiId($id){
        $this->db->where('sesi_id',$id)
                ->from('cbt_sesi_ujian');
        return $this->db->get();
        
    }
     public function getJenisUjian($start, $rows)
    {
       $this->db->order_by('jenis_id', 'ASC');
        $this->db->limit($rows, $start);
        $hasil = $this->db->get('cbt_jenis_ujian');
        return $hasil;
    }
      public function get_datatable_jenis_count(){
        $this->db->select('COUNT(*) AS hasil')
                  ->from('cbt_jenis_ujian');
        return $this->db->get();
    }
    public function getjenisId($id){
        $this->db->where('jenis_id',$id)
                ->from('cbt_jenis_ujian');
        return $this->db->get();
        
    }
    public function getjenisById($id)
    {
        $this->db->where_in('jenis_id', $id);
        $this->db->order_by('jenis_nama');
        $query = $this->db->get('cbt_jenis_ujian')->result();
        return $query;
    }
    public function getAllMatpel()
    {
        return $this->db->get('cbt_modul')->result();
    }

    /**
     * Data Jurusan
     */
    public function jurusan(){
        $this->db->select('cbt_jurusan.*');
        $this->db->from('cbt_jurusan');
        $query = $this->db->get()->result();
        return $query;
        }
    public function getDataJurusan()
    {
        $this->datatables->select('jurusan_id, jurusan_nama, jurusan_kode');
        $this->datatables->from('cbt_jurusan');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'jurusan_id, jurusan_nama, jurusan_kode');
        return $this->datatables->generate();
    }
    public function getDataJenis()
    {
        $this->datatables->select('jenis_id, jenis_nama, kode_jenis, IF(status="1","Aktif","Tidak Aktif") as status');
        $this->datatables->from('cbt_jenis_ujian');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'jenis_id, jenis_nama, kode_jenis, status');
        return $this->datatables->generate();
    }
    public function getJurusanById($id)
    {
        $this->db->where_in('jurusan_id', $id);
        $this->db->order_by('jurusan_nama');
        $query = $this->db->get('cbt_jurusan')->result();
        return $query;
    }
    public function getAllJurusan()
    {
        return $this->db->get('cbt_jurusan')->result();
    }
 /**
     * Data Level
     */

    public function getDataLevel()
    {
        $this->datatables->select('level_id, level_nama, level_kode');
        $this->datatables->from('cbt_level');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'level_id, level_nama, level_kode');
        return $this->datatables->generate();
    }

    public function getLevelById($id)
    {
        $this->db->where_in('level_id', $id);
        $this->db->order_by('level_nama');
        $query = $this->db->get('cbt_level')->result();
        return $query;
    }
    public function getAllLevel()
    {
        return $this->db->get('cbt_level')->result();
    }

    /**
     * Data Mahasiswa
     */

    public function getDataMahasiswa()
    {
        $this->datatables->select('a.id_mahasiswa, a.nama, a.nim, a.email, b.nama_kelas, c.nama_jurusan');
        $this->datatables->select('(SELECT COUNT(id) FROM users WHERE username = a.nim) AS ada');
        $this->datatables->from('mahasiswa a');
        $this->datatables->join('kelas b', 'a.kelas_id=b.id_kelas');
        $this->datatables->join('jurusan c', 'b.jurusan_id=c.id_jurusan');
        return $this->datatables->generate();
    }

    public function getMahasiswaById($id)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->join('kelas', 'kelas_id=id_kelas');
        $this->db->join('jurusan', 'jurusan_id=id_jurusan');
        $this->db->where(['id_mahasiswa' => $id]);
        return $this->db->get()->row();
    }

    public function getJurusan()
    {
        $this->db->select('id_jurusan, nama_jurusan');
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan_id=id_jurusan');
        $this->db->order_by('nama_jurusan', 'ASC');
        $this->db->group_by('id_jurusan');
        $query = $this->db->get();
        return $query->result();
    }

       public function getKelasByJurusan($id)
    {
        $query = $this->db->get_where('kelas', array('jurusan_id'=>$id));
        return $query->result();
    }

    /**
     * Data Dosen
     */

    public function getDataDosen()
    {
        $this->datatables->select('a.id_dosen,a.nip, a.nama_dosen, a.email, a.matkul_id, b.nama_matkul, (SELECT COUNT(id) FROM users WHERE username = a.nip OR email = a.email) AS ada');
        $this->datatables->from('dosen a');
        $this->datatables->join('matkul b', 'a.matkul_id=b.id_matkul');
        return $this->datatables->generate();
    }

    public function getDosenById($id)
    {
        $query = $this->db->get_where('dosen', array('id_dosen'=>$id));
        return $query->row();
    }

    /**
     * Data Matkul
     */

    public function getDataMatkul()
    {
        $this->datatables->select('id_matkul, nama_matkul');
        $this->datatables->from('matkul');
        return $this->datatables->generate();
    }

    public function getAllMatkul()
    {
        return $this->db->get('matkul')->result();
    }

    public function getMatkulById($id, $single = false)
    {
        if($single === false){
            $this->db->where_in('id_matkul', $id);
            $this->db->order_by('nama_matkul');
            $query = $this->db->get('matkul')->result();
        }else{
            $query = $this->db->get_where('matkul', array('id_matkul'=>$id))->row();
        }
        return $query;
    }

    /**
     * Data Kelas Dosen
     */

    public function getKelasDosen()
    {
        $this->datatables->select('kelas_dosen.id, dosen.id_dosen, dosen.nip, dosen.nama_dosen, GROUP_CONCAT(kelas.nama_kelas) as kelas');
        $this->datatables->from('kelas_dosen');
        $this->datatables->join('kelas', 'kelas_id=id_kelas');
        $this->datatables->join('dosen', 'dosen_id=id_dosen');
        $this->datatables->group_by('dosen.nama_dosen');
        return $this->datatables->generate();
    }

    public function getAllDosen($id = null)
    {
        $this->db->select('dosen_id');
        $this->db->from('kelas_dosen');
        if($id !== null){
            $this->db->where_not_in('dosen_id', [$id]);
        }
        $dosen = $this->db->get()->result();
        $id_dosen = [];
        foreach ($dosen as $d) {
            $id_dosen[] = $d->dosen_id;
        }
        if($id_dosen === []){
            $id_dosen = null;
        }

        $this->db->select('id_dosen, nip, nama_dosen');
        $this->db->from('dosen');
        $this->db->where_not_in('id_dosen', $id_dosen);
        return $this->db->get()->result();
    }

    
    public function getKelasByDosen($id)
    {
        $this->db->select('kelas.id_kelas');
        $this->db->from('kelas_dosen');
        $this->db->join('kelas', 'kelas_dosen.kelas_id=kelas.id_kelas');
        $this->db->where('dosen_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    /**
     * Data Jurusan Matkul
     */

    public function getJurusanMatkul()
    {
        $this->datatables->select('jurusan_matkul.id, matkul.id_matkul, matkul.nama_matkul, jurusan.id_jurusan, GROUP_CONCAT(jurusan.nama_jurusan) as nama_jurusan');
        $this->datatables->from('jurusan_matkul');
        $this->datatables->join('matkul', 'matkul_id=id_matkul');
        $this->datatables->join('jurusan', 'jurusan_id=id_jurusan');
        $this->datatables->group_by('matkul.nama_matkul');
        return $this->datatables->generate();
    }

    public function getMatkul($id = null)
    {
        $this->db->select('matkul_id');
        $this->db->from('jurusan_matkul');
        if($id !== null){
            $this->db->where_not_in('matkul_id', [$id]);
        }
        $matkul = $this->db->get()->result();
        $id_matkul = [];
        foreach ($matkul as $d) {
            $id_matkul[] = $d->matkul_id;
        }
        if($id_matkul === []){
            $id_matkul = null;
        }

        $this->db->select('id_matkul, nama_matkul');
        $this->db->from('matkul');
        $this->db->where_not_in('id_matkul', $id_matkul);
        return $this->db->get()->result();
    }

    public function getJurusanByIdMatkul($id)
    {
        $this->db->select('jurusan.id_jurusan');
        $this->db->from('jurusan_matkul');
        $this->db->join('jurusan', 'jurusan_matkul.jurusan_id=jurusan.id_jurusan');
        $this->db->where('matkul_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
}