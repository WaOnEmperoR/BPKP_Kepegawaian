<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lampiran_Model extends CI_Model {

	/**
     * @author : Tim CA-BKN
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/

	function list_lampiran_aktif(){
        $db = $this->db->query("SELECT * FROM tbl_lampiran "
                    . "WHERE stat_lampiran = 1");
        return $db->result_array();
    }

    function list_lampiran_aktif_per_jalur($id_jalur){
        $db = $this->db->query("SELECT * FROM tbl_lampiran l "
        			. "LEFT JOIN tbl_lampiran_jalur lj ON l.id_lampiran = lj.id_lampiran "
                    . "WHERE stat_lampiran = 1 AND lj.id_jalur = $id_jalur");
        return $db->result_array();
    }
	

}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */