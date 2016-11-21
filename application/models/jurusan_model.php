<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan_Model extends CI_Model
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
    
    function get_all_jurusan()
    {
        $db = $this->db->query("SELECT mj.ID_Jurusan, mj.Nama_Jurusan, mj.Keterangan_Jurusan, mf.Nama_Fakultas, tp.Nama_Tingkat_Pendidikan
            FROM master_jurusan mj, master_fakultas mf, tingkat_pendidikan tp
            WHERE mj.ID_Fakultas = mf.ID_Fakultas AND mf.ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan");
        return $db->result_array();
    }
    
    function get_all_tingkat_pendidikan()
    {
        $db = $this->db->query("SELECT * FROM tingkat_pendidikan");
        return $db->result_array();
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

    function get_tingkat_by_fakultas($id_fakultas)
    {
        $db = $this->db->query("SELECT ID_Tingkat_Pendidikan FROM master_fakultas WHERE ID_Fakultas = $id_fakultas");
        return $db->row()->ID_Tingkat_Pendidikan;
    }
    
    function get_single_jurusan($id_jurusan)
    {
        $db = $this->db->query("SELECT mj.ID_Jurusan, mj.Nama_Jurusan, mj.Keterangan_Jurusan, mf.Nama_Fakultas, tp.Nama_Tingkat_Pendidikan
            FROM master_jurusan mj, master_fakultas mf, tingkat_pendidikan tp
            WHERE mj.ID_Fakultas = mf.ID_Fakultas AND mf.ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan AND mj.ID_Jurusan = $id_jurusan");
        return $db->result_array();
    }
    
}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */