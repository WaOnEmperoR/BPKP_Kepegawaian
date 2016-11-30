<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Queryselect_Model extends CI_Model
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
    
    function get_fakultas_and_jurusan($json_bool)
    {
        $db         = $this->db->query("SELECT * FROM master_fakultas ");
        $pre_result = $db->result_array();
        
        $data = array();
        
        $i = 0;
        foreach ($pre_result as $hasil) {
            $arr_fakultas = array(
                'id' => $hasil['ID_Fakultas'],
                'text' => $hasil['Nama_Fakultas']
            );
            $data[$i]     = $arr_fakultas;
            
            $db2       = $this->db->query("SELECT * FROM master_jurusan WHERE ID_Fakultas=" . $hasil['ID_Fakultas']);
            $inner_res = $db2->result_array();
            
            $j = 0;
            if (count($inner_res) > 0) {
                foreach ($inner_res as $s) {
                    $data[$i]['children'][$j]['id']   = $s['ID_Jurusan'];
                    $data[$i]['children'][$j]['text'] = $s['Nama_Jurusan'];
                    $j++;
                }
            }
            $i++;
        }
        
        if ($json_bool == 1) {
            $kembali = json_encode($data);
        } else {
            $kembali = $data;
        }
        return $kembali;
    }
    
    function get_sertifikasi($json_bool)
    {
        $db         = $this->db->query("SELECT * FROM jenis_sertifikasi ");
        $pre_result = $db->result_array();
        
        $data = array();
        
        $i = 0;
        foreach ($pre_result as $hasil) {
            $arr_jenis_cert = array(
                'id' => $hasil['ID_Jenis_Sertifikasi'],
                'text' => $hasil['Nama_Jenis_Sertifikasi']
            );
            $data[$i]       = $arr_jenis_cert;
            
            $db2       = $this->db->query("SELECT * FROM master_sertifikasi WHERE ID_Jenis_Sertifikasi=" . $hasil['ID_Jenis_Sertifikasi']);
            $inner_res = $db2->result_array();
            
            $j = 0;
            if (count($inner_res) > 0) {
                foreach ($inner_res as $s) {
                    $data[$i]['children'][$j]['id']   = $s['ID_Sertifikasi'];
                    $data[$i]['children'][$j]['text'] = $s['Nama_Sertifikasi'];
                    $j++;
                }
            }
            $i++;
        }
        
        if ($json_bool == 1) {
            $kembali = json_encode($data);
        } else {
            $kembali = $data;
        }
        return $kembali;
    }
    
    function get_diklat($json_bool)
    {
        $db         = $this->db->query("SELECT * FROM jenis_diklat ");
        $pre_result = $db->result_array();
        
        $data = array();
        
        $i = 0;
        foreach ($pre_result as $hasil) {
            $arr_jenis_diklat = array(
                'id' => $hasil['ID_Jenis_Diklat'],
                'text' => $hasil['Nama_Jenis_Diklat']
            );
            $data[$i]         = $arr_jenis_diklat;
            
            $db2       = $this->db->query("SELECT * FROM master_diklat WHERE ID_Jenis_Diklat=" . $hasil['ID_Jenis_Diklat']);
            $inner_res = $db2->result_array();
            
            $j = 0;
            if (count($inner_res) > 0) {
                foreach ($inner_res as $s) {
                    $data[$i]['children'][$j]['id']   = $s['ID_Diklat'];
                    $data[$i]['children'][$j]['text'] = $s['Nama_Diklat'];
                    $j++;
                }
            }
            $i++;
        }
        
        if ($json_bool == 1) {
            $kembali = json_encode($data);
        } else {
            $kembali = $data;
        }
        return $kembali;
    }
}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */