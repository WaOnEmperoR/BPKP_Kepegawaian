<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendidikan_Model extends CI_Model
{
    
    /**
     * @author : Tim CA-BKN
     * @keterangan : Model untuk menangani semua query database aplikasi
     **/
    
    public function getSelectedData($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
    
    function updateData($table, $data, $field_key)
    {
        $this->db->update($table, $data, $field_key);
    }
    function deleteData($table, $data)
    {
        $this->db->delete($table, $data);
    }
    
    function insertData($table, $data)
    {
        $this->db->insert($table, $data);
    }
    
    function manualQuery($q)
    {
        return $this->db->query($q);
    }
    
    function get_fakultas_by_tingkat($id_tingkat)
    {
        $db = $this->db->query("SELECT * FROM master_fakultas WHERE ID_Tingkat_Pendidikan = $id_tingkat");
        return $db;
    }
    
    function get_fakultas_by_tingkat_display($id_tingkat)
    {
        $db = $this->db->query("SELECT * FROM master_fakultas WHERE ID_Tingkat_Pendidikan = $id_tingkat");
        return $db->result_array();
    }
    
    function get_jurusan_by_fakultas($id_fakultas)
    {
        $db = $this->db->query("SELECT * FROM master_jurusan WHERE ID_Fakultas = $id_fakultas");
        return $db;
    }
    
    function get_jurusan_by_fakultas_display($id_fakultas)
    {
        $db = $this->db->query("SELECT * FROM master_jurusan WHERE ID_Fakultas = $id_fakultas");
        return $db->result_array();
    }
    
    function get_tingkat_by_fakultas($id_fakultas)
    {
        $db = $this->db->query("SELECT ID_Tingkat_Pendidikan FROM master_fakultas WHERE ID_Fakultas = $id_fakultas");
        return $db->row()->ID_Tingkat_Pendidikan;
    }
    
    function get_all_pendidikan_pegawai($id_pegawai)
    {
        $db = $this->db->query("SELECT p.ID_Pendidikan, tp.Nama_Tingkat_Pendidikan, p.Nama_Instansi, f.Nama_Fakultas, j.Nama_Jurusan, p.Nomor_Ijazah, DATE_FORMAT(p.Tanggal_Ijazah, '%d %M %Y') AS Tanggal_Ijazah, p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan, p.Pegawai_ID_Pegawai, f.ID_Fakultas,j.ID_Jurusan
									FROM pendidikan p
									LEFT JOIN master_fakultas f ON p.Fakultas_ID_Fakultas = f.ID_Fakultas 
									LEFT JOIN master_jurusan j ON p.Jurusan_ID_Jurusan = j.ID_Jurusan
									LEFT JOIN tingkat_pendidikan tp ON p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan
									WHERE p.Pegawai_ID_Pegawai=$id_pegawai ");
        return $db->result_array();
    }
    
    function get_detail_pendidikan_pegawai($id_pegawai, $id_pendidikan)
    {
        $db = $this->db->query("SELECT p.ID_Pendidikan, tp.Nama_Tingkat_Pendidikan, p.Nama_Instansi, p.Nomor_Ijazah, DATE_FORMAT(p.Tanggal_Ijazah, '%d %M %Y') AS Tanggal_Ijazah, p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan, p.Pegawai_ID_Pegawai, p.Fakultas_ID_Fakultas,p.Jurusan_ID_Jurusan
									FROM pendidikan p
									LEFT JOIN master_fakultas f ON p.Fakultas_ID_Fakultas = f.ID_Fakultas 
									LEFT JOIN master_jurusan j ON p.Jurusan_ID_Jurusan = j.ID_Jurusan
									LEFT JOIN tingkat_pendidikan tp ON p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan
									WHERE p.Pegawai_ID_Pegawai=$id_pegawai AND p.ID_Pendidikan=$id_pendidikan");
        
        return $db;
    }
    
    function get_tingkat_pendidikan()
    {
        $db = $this->db->query("SELECT * FROM tingkat_pendidikan ");
        return $db->result_array();
    }
}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */