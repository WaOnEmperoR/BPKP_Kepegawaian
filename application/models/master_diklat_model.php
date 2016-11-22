<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_Diklat_Model extends CI_Model
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
    
    function get_all_master_diklat()
    {
        $db = $this->db->query("SELECT md.ID_Diklat, md.Nama_Diklat, md.Keterangan_Diklat, jd.Nama_Jenis_Diklat, md.ID_Jenis_Diklat 
                FROM jenis_diklat jd, master_diklat md
                WHERE jd.ID_Jenis_Diklat = md.ID_Jenis_Diklat");
        return $db->result_array();
    }
    
    function get_all_jenis_diklat()
    {
        $db = $this->db->query("SELECT * FROM jenis_diklat");
        return $db->result_array();
    }
    
    function get_single_master_diklat($id_diklat)
    {
        $db = $this->db->query("SELECT md.ID_Diklat, md.Nama_Diklat, md.Keterangan_Diklat, jd.Nama_Jenis_Diklat, md.ID_Jenis_Diklat 
                FROM jenis_diklat jd, master_diklat md
                WHERE jd.ID_Jenis_Diklat = md.ID_Jenis_Diklat AND mD.ID_Diklat = $id_diklat");
        return $db->result_array();
    }
    
}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */