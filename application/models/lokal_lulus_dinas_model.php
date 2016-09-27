<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lokal_Lulus_Dinas_Model extends CI_Model {

    /**
     * @author : Tim CA-BKN
     * @keterangan : Model untuk menangani semua query database aplikasi
     * */
    public function getSelectedData($table, $data) {
        return $this->db->get_where($table, $data);
    }

    function updateData($table, $data, $field_key) {
        $this->db->update($table, $data, $field_key);
    }

    function deleteData($table, $data) {
        $this->db->delete($table, $data);
    }

    function insertData($table, $data) {
        $this->db->insert($table, $data);
    }

    function manualQuery($q) {
        return $this->db->query($q);
    }

    function get_all_lokal() {
        $db = $this->db->query("SELECT sel.id_seleksi AS id_seleksi,"
                . "sel.id_registrasi AS id_registrasi, "
                . "reg.no_registrasi AS no_registrasi, "
                . "reg.nm_siswa AS nm_siswa, sel.id_sekolah AS id_pilihan_1, "
                . "sek.nm_sekolah AS pilihan_1, ijazah.nem AS nem, "
                . "(SELECT id_seleksi FROM tbl_seleksi WHERE tbl_seleksi.id_registrasi = sel.id_registrasi AND tbl_seleksi.pilihan = 2) AS id_seleksi_2, "
                . "(SELECT nm_sekolah FROM tbl_sekolah LEFT JOIN tbl_seleksi ON tbl_seleksi.id_sekolah = tbl_sekolah.id_sekolah WHERE tbl_seleksi.pilihan=2 AND tbl_seleksi.id_registrasi = sel.id_registrasi) AS pilihan_2 "
                . "FROM tbl_seleksi sel "
                . "LEFT JOIN tbl_registrasi reg ON reg.id_registrasi = sel.id_registrasi "
                . "LEFT JOIN tbl_sekolah sek ON sek.id_sekolah = sel.id_sekolah "
                . "LEFT JOIN tbl_ijazah ijazah ON ijazah.id_registrasi = reg.id_registrasi "
                . "WHERE sel.id_jalur = 2 AND sel.stat_lulus=0 AND sel.pilihan = 1 "
                . "GROUP BY sel.id_registrasi");
        return $db->result_array();
    }

}

/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */