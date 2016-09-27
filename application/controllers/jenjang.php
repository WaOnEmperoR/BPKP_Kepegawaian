<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenjang extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('jenjang_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {
            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Jenjang Pendidikan";
            $d['breadcumb'] = "Pengolahan Data Jenjang Pendidikan";
            $d['all_jenjang'] = $this->jenjang_model->get_all_jenjang();

            $d['content'] = $this->load->view('jenjang/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Jenjang Pendidikan";
            $d['breadcumb'] = "Pengolahan Data Jenjang Pendidikan";

            $d['id'] = '';
            $d['nama'] = '';
            $d['deskripsi'] = '';
            $d['kejuruan'] = '';

            $d['content'] = $this->load->view('jenjang/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {
            $up['nm_jenjang'] = $this->input->post('nama');
            $up['desk_jenjang'] = $this->input->post('deskripsi');
            $up['kejuruan_jenjang'] = $this->input->post('kejuruan');
             if(empty($up['kejuruan_jenjang']))
                $up['kejuruan_jenjang'] = 2;

            $id['id_jenjang'] = $this->input->post('id');

            $data = $this->jenjang_model->getSelectedData("tbl_jenjang", $id);

            if ($data->num_rows() > 0) {
                $this->jenjang_model->updateData("tbl_jenjang", $up, $id);
            } else {
                $this->jenjang_model->insertData("tbl_jenjang", $up);
            }
            redirect('jenjang');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Jenjang Pendidikan";
            $d['breadcumb'] = "Pengolahan Data Jenjang Pendidikan";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_jenjang WHERE id_jenjang='$id'";
            $data = $this->jenjang_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_jenjang;
                    $d['nama'] = $db->nm_jenjang;
                    $d['deskripsi'] = $db->desk_jenjang;
                    $d['kejuruan'] = $db->kejuruan_jenjang;
                }
            } else {
                $d['id'] = '';
                $d['nama'] = '';
                $d['deskripsi'] = '';
                $d['kejuruan'] = '';
            }

            $d['content'] = $this->load->view('jenjang/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->jenjang_model->manualQuery("DELETE FROM tbl_jenjang WHERE id_jenjang='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jenjang'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
