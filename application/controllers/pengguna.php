<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('pengguna_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {
            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Pengguna";
            $d['breadcumb'] = "Pengolahan Data Pengguna";
            $d['all_pengguna'] = $this->pengguna_model->get_all_pengguna();

            $d['content'] = $this->load->view('pengguna/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Pengguna";
            $d['breadcumb'] = "Pengolahan Data Pengguna";

            $d['id']        = '';
            $d['nama']      = '';
            $d['password']  = '';
            $d['pegawai']   = '';
            $d['email']     = '';
            $d['level']     = '';
            $d['status']    = '';

            $d['l_pegawai'] = $this->pengguna_model->list_pegawai();
            $d['content'] = $this->load->view('pengguna/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {
            $up['username']     = $this->input->post('nama');
            if(!empty($this->input->post('password')))
                $up['password']     = md5($this->input->post('password'));
            $up['password']     = md5($this->input->post('password'));
            $up['id_pengguna']   = $this->input->post('pegawai');
            $up['email']        = $this->input->post('email');
            $up['level']        = $this->input->post('level');
            $up['sta_aktif']    = $this->input->post('status');
             if(empty($up['sta_aktif']))
                $up['sta_aktif'] = 2;
            $up['created_date']    = date("Y-m-d");

            $id['id_login'] = $this->input->post('id');

            $data = $this->pengguna_model->getSelectedData("tbl_login", $id);

            if ($data->num_rows() > 0) {
                $this->pengguna_model->updateData("tbl_login", $up, $id);
            } else {
                $this->pengguna_model->insertData("tbl_login", $up);
            }
            redirect('pengguna');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Pengguna";
            $d['breadcumb'] = "Pengolahan Data Pengguna";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_login WHERE id_login='$id'";
            $data = $this->pengguna_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id']        = $db->id_login;
                    $d['nama']      = $db->username;
                    $d['password']  = $db->password;
                    $d['pegawai']   = $db->id_pengguna;
                    $d['email']     = $db->email;
                    $d['level']     = $db->level;
                    $d['status']    = $db->sta_aktif;
                    
                }
            } else {
                $d['id']        = '';
                $d['nama']      = '';
                $d['password']  = '';
                $d['pegawai']   = '';
                $d['email']     = '';
                $d['level']     = '';
                $d['status']    = '';
            }

            $d['l_pegawai'] = $this->pengguna_model->list_pegawai();
            $d['content'] = $this->load->view('pengguna/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->pengguna_model->manualQuery("DELETE FROM tbl_login WHERE id_login='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pengguna'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
