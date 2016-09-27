<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Syarat_Model extends CI_Model {

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

	function insert_lampiran($data)
	{
		$this->db->insert('tbl_lampiran',$data);
		return $this->db->insert_id();
	}

	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	function get_all_syarat(){
        $this->db->select('*');
        $this->db->from('tbl_lampiran');
        //$this->db->join('tbl_lampiran_jenis_lampiran', 'tbl_lampiran_jenis_lampiran.id_lampiran = tbl_lampiran.id_lampiran');

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_jenis_syarat($id_lampiran){
        $this->db->select('*');
        $this->db->from('tbl_lampiran_jenis_lampiran');
        $this->db->join('tbl_jenis_lampiran', 'tbl_jenis_lampiran.id_jenis_lampiran = tbl_lampiran_jenis_lampiran.id_jenis_lampiran');
        $this->db->where('id_lampiran',$id_lampiran);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_jalur($id_lampiran){
        $this->db->select('*');
        $this->db->from('tbl_lampiran_jalur');
        $this->db->join('tbl_jalur_seleksi', 'tbl_jalur_seleksi.id_jalur = tbl_lampiran_jalur.id_jalur');
        $this->db->where('id_lampiran',$id_lampiran);

        $query = $this->db->get();
        return $query->result_array();
    }

}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */