<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jalur extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('jalur_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {
            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Jalur Seleksi";
            $d['breadcumb'] = "Pengolahan Data Jalur Seleksi";
            $d['all_jalur'] = $this->jalur_model->get_all_jalur();

            $d['content'] = $this->load->view('jalur/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Jalur Seleksi";
            $d['breadcumb'] = "Pengolahan Data Jalur Seleksi";

            $d['id'] = '';
            $d['nama'] = '';
            $d['kode'] = '';
            $d['deskripsi'] = '';

            $d['content'] = $this->load->view('jalur/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {

            $up['nm_jalur'] = $this->input->post('nama');
            $up['desk_jalur'] = $this->input->post('deskripsi');
            $up['kd_jalur'] = $this->input->post('kode');
            $id['id_jalur'] = $this->input->post('id');

            $data = $this->jalur_model->getSelectedData("tbl_jalur_seleksi", $id);

            if ($data->num_rows() > 0) {
                $this->jalur_model->updateData("tbl_jalur_seleksi", $up, $id);
            } else {
                $this->jalur_model->insertData("tbl_jalur_seleksi", $up);
            }
            redirect('jalur');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Jalur Seleksi";
            $d['breadcumb'] = "Pengolahan Data Jalur Seleksi";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_jalur_seleksi WHERE id_jalur='$id'";
            $data = $this->jalur_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_jalur;
                    $d['kode'] = $db->kd_jalur;
                    $d['nama'] = $db->nm_jalur;
                    $d['deskripsi'] = $db->desk_jalur;
                }
            } else {
                $d['id'] = '';
                $d['kode'] = '';
                $d['nama'] = '';
                $d['deskripsi'] = '';
            }

            $d['content'] = $this->load->view('jalur/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->jalur_model->manualQuery("DELETE FROM tbl_jalur_seleksi WHERE id_jalur='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jalur'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
