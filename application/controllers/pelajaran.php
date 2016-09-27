<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelajaran extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('pelajaran_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {
            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Mata Pelajaran";
            $d['breadcumb'] = "Pengolahan Data Mata Pelajaran";
            $d['all_pelajaran'] = $this->pelajaran_model->get_all_pelajaran();

            $d['content'] = $this->load->view('pelajaran/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Mata Pelajaran";
            $d['breadcumb'] = "Pengolahan Data Mata Pelajaran";

            $d['id']    = '';
            $d['nama']  = '';
            $d['bobot'] = '';
            $d['status'] = '';

            $d['content'] = $this->load->view('pelajaran/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {
            $up['nm_mapel'] = $this->input->post('nama');
            $up['bobot_mapel'] = $this->input->post('bobot');
            $up['stat_mapel'] = $this->input->post('status');
            if(empty($up['stat_mapel']))
                $up['stat_mapel'] = 2;

            $id['id_mapel'] = $this->input->post('id');

            $data = $this->pelajaran_model->getSelectedData("tbl_mapel", $id);

            if ($data->num_rows() > 0) {
                $this->pelajaran_model->updateData("tbl_mapel", $up, $id);
            } else {
                $this->pelajaran_model->insertData("tbl_mapel", $up);
            }
            redirect('pelajaran');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Mata Pelajaran";
            $d['breadcumb'] = "Pengolahan Data Mata Pelajaran";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_mapel WHERE id_mapel='$id'";
            $data = $this->pelajaran_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_mapel;
                    $d['nama'] = $db->nm_mapel;
                    $d['bobot'] = $db->bobot_mapel;
                    $d['status'] = $db->stat_mapel;
                }
            } else {
                $d['id'] = '';
                $d['nama'] = '';
                $d['bobot'] = '';
                $d['status'] = '';
            }

            $d['content'] = $this->load->view('pelajaran/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->pelajaran_model->manualQuery("DELETE FROM tbl_mapel WHERE id_pelajaran='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pelajaran'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
