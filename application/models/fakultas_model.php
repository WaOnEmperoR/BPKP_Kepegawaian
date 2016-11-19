<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fakultas_Model extends CI_Model
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
    
    function get_all_fakultas()
    {
        $db = $this->db->query("SELECT mf.ID_Fakultas, mf.Nama_Fakultas, mf.Keterangan_Fakultas, tp.Nama_Tingkat_Pendidikan
					FROM master_fakultas mf, tingkat_pendidikan tp
					WHERE mf.ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan");
        return $db->result_array();
    }
    
    function get_all_tingkat_pendidikan()
    {
        $db = $this->db->query("SELECT * FROM tingkat_pendidikan");
        return $db->result_array();
    }
    
    function get_single_fakultas($id_fakultas)
    {
        $db = $this->db->query("SELECT mf.ID_Fakultas, mf.Nama_Fakultas, mf.Keterangan_Fakultas, tp.Nama_Tingkat_Pendidikan
					FROM master_fakultas mf, tingkat_pendidikan tp
					WHERE mf.ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan AND mf.id_fakultas = $id_fakultas");
        return $db->result_array();
    }
    
}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */