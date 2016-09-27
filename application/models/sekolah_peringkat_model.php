<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah_Peringkat_Model extends CI_Model {

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

    function get_kuota_sekolah($id_kantor){
        $db = $this->db->query("SELECT kuota_psb_lokal AS jumlah FROM tbl_psb WHERE id_sekolah = $id_kantor");

        $data = $db->row_array();
        
        if(!empty($data)){
            return intval($data["jumlah"]);
        }else{
            return 0;
        }
    }

    function get_jumlah_peserta_sekolah($id_kantor){
        $db = $this->db->query("SELECT COUNT(id_seleksi) AS jumlah FROM tbl_seleksi WHERE id_sekolah = $id_kantor AND stat_lulus = 1");

        $data = $db->row_array();

        if(!empty($data)){
            return intval($data["jumlah"]);
        }else{
            return 0;
        }
    }

    // fungsi mengecek sekolahnya masih ada kuota atau tidak untuk yg statusnya lulus
    function is_memenuhi_kuota($id_kantor){
        $pelamar = $this->get_jumlah_peserta_sekolah($id_kantor);
        $kuota = $this->get_kuota_sekolah($id_kantor);

        if($pelamar < $kuota){
            return true;
        }else{
            return false;
        }
    }

    /* Kode Jalur Reguler 01 */
	function list_pelamar_reguler($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_jalur_seleksi.kd_jalur = '01' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_sekolah.nm_sekolah asc,tbl_ijazah.nem desc");
        }else{
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_jalur_seleksi.kd_jalur = '01' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_ijazah.nem desc");
        }
        
        return $db->result_array();
    }

    /* Kode Jalur Luar 02 */
    function list_pelamar_luar($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_jalur_seleksi.kd_jalur = '02' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_sekolah.nm_sekolah asc,tbl_ijazah.nem desc");
        }else{
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_jalur_seleksi.kd_jalur = '02' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_ijazah.nem desc");
        }
        return $db->result_array();
    }

    /* Kode Jalur Lokal Ekonomi 05 */
    function list_pelamar_lokal_ekonomi($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_jalur_seleksi.kd_jalur = '05' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7) "
                    . "ORDER BY tbl_sekolah.nm_sekolah asc,tbl_ijazah.nem desc");
        }else{
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_jalur_seleksi.kd_jalur = '05' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_ijazah.nem desc");
        }
        return $db->result_array();
    }

    /* Kode Jalur Lokal Alamat 04 */
    function list_pelamar_lokal_alamat($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_jalur_seleksi.kd_jalur = '04' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_sekolah.nm_sekolah asc,tbl_ijazah.nem desc");
        }else{
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_jalur_seleksi.kd_jalur = '04' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_ijazah.nem desc");
        }
        return $db->result_array();
    }

    /* Kode Jalur Lokal Prestasi 03 */
    function list_pelamar_lokal_prestasi($id_kantor){
        if(empty($id_kantor)){
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_jalur_seleksi.kd_jalur = '03' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_sekolah.nm_sekolah asc,tbl_ijazah.nem desc");
        }else{
            $db = $this->db->query("SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE tbl_seleksi.id_sekolah = $id_kantor AND tbl_jalur_seleksi.kd_jalur = '03' AND (tbl_registrasi.stat_akhir=6 OR tbl_registrasi.stat_akhir=7)  "
                    . "ORDER BY tbl_ijazah.nem desc");
        }
        return $db->result_array();
    }
    

}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */
