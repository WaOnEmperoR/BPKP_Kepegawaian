<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna_Model extends CI_Model {

	/**
     * @author : Tim CA-BKN
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/

	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}

	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	function get_all_pengguna(){
		$db = $this->db->query("SELECT *,(case when kd_pegawai = 1 then (select nm_dinas from tbl_dinas where id_dinas = id_kantor) when kd_pegawai = 2 then (select nm_sekolah from tbl_sekolah where id_sekolah = id_kantor) else '' end) AS instansi FROM tbl_login LEFT JOIN tbl_pegawai ON tbl_pegawai.id_pegawai = tbl_login.id_pengguna WHERE tbl_login.level <> 4 ");
        
        return $db->result_array();
    }

    function list_pegawai(){
    	return $this->db->query("SELECT *,(case when kd_pegawai = 1 then (select nm_dinas from tbl_dinas where id_dinas = id_kantor) when kd_pegawai = 2 then (select nm_sekolah from tbl_sekolah where id_sekolah = id_kantor) else '' end) AS kantor FROM tbl_pegawai");
    }

}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */