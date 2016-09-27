<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah_Rekap_Model extends CI_Model {

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

	function get_all_list($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "ORDER BY tbl_sekolah.nm_sekolah asc, tbl_ijazah.nem desc");
        }else{
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor "
                    . "ORDER BY tbl_ijazah.nem desc");
        }
        return $db->result_array();
    }

    function get_kuota($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT sum(kuota_psb) as jumlah FROM tbl_psb");
        }else{
            $db = $this->db->query("SELECT kuota_psb as jumlah FROM tbl_psb "
                    . "WHERE id_sekolah = $id_kantor");
        }
        
        return $db->row_array();
    }

   
    function get_total_pelamar($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT count(tbl_seleksi.id_seleksi) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi");
        }else{
            $db = $this->db->query("SELECT count(tbl_seleksi.id_seleksi) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor");
        }
        
        return $db->row_array();
    }

     function get_total_siswa($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT count(tbl_seleksi.id_seleksi) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_registrasi.jk=1");
        }else{
            $db = $this->db->query("SELECT count(tbl_seleksi.id_seleksi) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_registrasi.jk=1");
        }
        
        return $db->row_array();
    }

    function get_total_siswi($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT count(tbl_seleksi.id_seleksi) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_registrasi.jk=2");
        }else{
            $db = $this->db->query("SELECT count(tbl_seleksi.id_seleksi) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_registrasi.jk=2");
        }
        
        return $db->row_array();
    }

    function get_max_nem($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT max(tbl_ijazah.nem) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi");
        }else{
            $db = $this->db->query("SELECT max(tbl_ijazah.nem) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor");
        }
        
        return $db->row_array();
    }

    function get_avg_nem($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT cast(AVG(tbl_ijazah.nem) as decimal(6, 2)) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi");
        }else{
            $db = $this->db->query("SELECT cast(AVG(tbl_ijazah.nem) as decimal(6, 2)) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor");
        }
        
        return $db->row_array();
    }

     function get_min_nem($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT min(tbl_ijazah.nem) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi");
        }else{
            $db = $this->db->query("SELECT min(tbl_ijazah.nem) as jumlah FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor");
        }
        
        return $db->row_array();
    }

    function get_nama_sekolah($id_kantor){
     	$db = $this->db->query("SELECT nm_sekolah FROM tbl_sekolah where id_sekolah=$id_kantor");        
      return $db->row_array();
    }
    

}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */
