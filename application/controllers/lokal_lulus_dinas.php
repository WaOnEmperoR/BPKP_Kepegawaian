<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lokal_lulus_dinas extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('lokal_lulus_dinas_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Kelulusan Jalur Lokal";
            $d['breadcumb'] = "Pengolahan Data Kelulusan Jalur Lokal";
            $d['all_pendaftar'] = $this->lokal_lulus_dinas_model->get_all_lokal();

            $d['content'] = $this->load->view('lokal_lulus_dinas/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {
            $up['stat_lulus'] = $this->input->post('stat_lulus');

            $id['id_seleksi'] = $this->input->post('id');

            $data = $this->lokal_lulus_dinas_model->getSelectedData("tbl_seleksi", $id);
            if ($data->num_rows() > 0) {
                $result = $data->row_array();

                $this->lokal_lulus_dinas_model->updateData("tbl_seleksi", $up, $id);
                if($up['stat_lulus'] != 0)
                    $this->lokal_lulus_dinas_model->updateData("tbl_registrasi", array("stat_akhir"=>7), array("id_registrasi"=>$result['id_registrasi']));
            }

            redirect('lokal_lulus_dinas');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Status Kelulusan";
            $d['breadcumb'] = "Pengolahan Data Kelulusan Jalur Lokal";

            $id = $this->uri->segment(3);
            $text = "SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.*,tbl_jalur_seleksi.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE id_seleksi='$id'";
            $data = $this->lokal_lulus_dinas_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_seleksi;
                    $d['no_registrasi'] = $db->no_registrasi;
                    $d['nm_siswa'] = $db->nm_siswa;
                    $d['jk_siswa'] = ($db->jk == 1 ? "Laki-laki" : "Perempuan");
                    $d['tmp_lahir_siswa'] = $db->tmp_lahir_siswa;
                    $d['tgl_lahir_siswa'] = $db->tgl_lahir_siswa;
                    $d['almt_siswa'] = $db->almt_siswa;
                    $d['agama_siswa'] = $db->agama_siswa;
                    $d['sekolah'] = $db->nm_sekolah;
                    $d['stat_lulus'] = $db->stat_lulus;
                }
            } else {
                $d['id'] = '';
                $d['no_registrasi'] = '';
                $d['nm_siswa'] = '';
                $d['stat_lulus'] = '';
            }

            $d['content'] = $this->load->view('lokal_lulus_dinas/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
