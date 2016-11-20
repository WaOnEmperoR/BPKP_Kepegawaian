<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_Sertifikasi_Model extends CI_Model
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
    
    function get_all_master_sertifikasi()
    {
        $db = $this->db->query("SELECT ms.ID_Sertifikasi, ms.Nama_Sertifikasi, ms.Keterangan_Sertifikasi, js.Nama_Jenis_Sertifikasi 
            FROM jenis_sertifikasi js, master_sertifikasi ms
            WHERE js.ID_Jenis_Sertifikasi = ms.ID_Jenis_Sertifikasi");
        return $db->result_array();
    }
    
    function get_all_jenis_sertifikasi()
    {
        $db = $this->db->query("SELECT * FROM jenis_sertifikasi");
        return $db->result_array();
    }
    
    function get_single_sertifikasi($id_sertifikasi)
    {
        $db = $this->db->query("SELECT ms.ID_Sertifikasi, ms.Nama_Sertifikasi, ms.Keterangan_Sertifikasi, js.Nama_Jenis_Sertifikasi 
            FROM jenis_sertifikasi js, master_sertifikasi ms
            WHERE js.ID_Jenis_Sertifikasi = ms.ID_Jenis_Sertifikasi AND ms.ID_Sertifikasi = $id_sertifikasi");
        return $db->result_array();
    }
    
}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */