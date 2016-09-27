<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Syarat extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('syarat_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Persyaratan Pendaftaran";
            $d['breadcumb'] = "Pengolahan Data Persyaratan Pendaftaran";
            $d['all_syarat'] = $this->syarat_model->get_all_syarat();

            $d['content'] = $this->load->view('syarat/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Persyaratan";
            $d['breadcumb'] = "Pengolahan Data Persyaratan Pendaftaran";

            $d['id'] = '';
            $d['kode'] = '';
            $d['nama'] = '';
            $d['ukuran'] = '';
            $d['jenis'] = '';
            $d['jalur'] = '';
            $d['wajib'] = '';
            $d['status'] = '';

            $text = "SELECT * FROM tbl_jenis_lampiran";
            $d['l_jenislampiran'] = $this->syarat_model->manualQuery($text);
            $text1 = "SELECT * FROM tbl_jalur_seleksi";
            $d['l_jalur'] = $this->syarat_model->manualQuery($text1);
            $d['content'] = $this->load->view('syarat/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {

            $id['id_lampiran'] = $this->input->post('id');

            $up['kd_lampiran'] = $this->input->post('kode');
            $up['nm_lampiran'] = $this->input->post('nama');
            $up['size_lampiran'] = $this->input->post('ukuran');
            //$up['tipe_lampiran'] = $this->input->post('jenis');
                       

            $up['wajib_lampiran'] = $this->input->post('wajib');
            $up['stat_lampiran'] = $this->input->post('status');
            if(empty($up['stat_lampiran']))
                $up['stat_lampiran'] = 2;

            $data = $this->syarat_model->getSelectedData("tbl_lampiran", $id);

            if ($data->num_rows() > 0) {
                $this->syarat_model->updateData("tbl_lampiran", $up, $id);
                $this->syarat_model->manualQuery("DELETE FROM tbl_lampiran_jenis_lampiran WHERE id_lampiran=".$id['id_lampiran']);
                foreach ($this->input->post('jenis') as $selectedOption) {
                    $d['id_lampiran'] = $id['id_lampiran'];
                    $d['id_jenis_lampiran'] = $selectedOption;

                    $this->syarat_model->insertData("tbl_lampiran_jenis_lampiran", $d);
                }
                $this->syarat_model->manualQuery("DELETE FROM tbl_lampiran_jalur WHERE id_lampiran=".$id['id_lampiran']);
                foreach ($this->input->post('jalur') as $selectedOption) {
                    $dy['id_lampiran'] = $id['id_lampiran'];
                    $dy['id_jalur'] = $selectedOption;

                    $this->syarat_model->insertData("tbl_lampiran_jalur", $dy);
                }
            } else {
                // $this->syarat_model->insertData("tbl_lampiran", $up);
                $id_lamp = $this->syarat_model->insert_lampiran($up);
                foreach ($this->input->post('jenis') as $selectedOption) {
                    $d['id_lampiran'] = $id_lamp;
                    $d['id_jenis_lampiran'] = $selectedOption;

                    $this->syarat_model->insertData("tbl_lampiran_jenis_lampiran", $d);
                }
                foreach ($this->input->post('jalur') as $selectedOption) {
                    $d['id_lampiran'] = $id_lamp;
                    $d['id_jalur'] = $selectedOption;

                    $this->syarat_model->insertData("tbl_lampiran_jalur", $d);
                }
            }
            redirect('syarat');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Persyaratan";
            $d['breadcumb'] = "Pengolahan Data Persyaratan Pendaftaran";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_lampiran WHERE id_lampiran='$id'";
            $data = $this->syarat_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_lampiran;
                    $d['kode'] = $db->kd_lampiran;
                    $d['nama'] = $db->nm_lampiran;
                    $d['ukuran'] = $db->size_lampiran;
                    $d['jenis'] = $db->tipe_lampiran;
                    $d['wajib'] = $db->wajib_lampiran;
                    $d['status'] = $db->stat_lampiran;
                }
            } else {
                $d['id'] = '';
                $d['nama'] = '';
                $d['ukuran'] = '';
                $d['jenis'] = '';
                $d['jalur'] = '';
                $d['wajib'] = '';
                $d['status'] = '';
            }
            
            $text = "SELECT * FROM tbl_jenis_lampiran";
            $d['l_jenislampiran'] = $this->syarat_model->manualQuery($text);
            $text1 = "SELECT * FROM tbl_lampiran_jenis_lampiran WHERE id_lampiran=$id";
            $d['l_jenis'] = $this->syarat_model->manualQuery($text1);
            $text2 = "SELECT * FROM tbl_jalur_seleksi";
            $d['l_jalur'] = $this->syarat_model->manualQuery($text2);
            $text3 = "SELECT * FROM tbl_lampiran_jalur WHERE id_lampiran=$id";
            $d['l_lampiranjalur'] = $this->syarat_model->manualQuery($text3);
            $d['content'] = $this->load->view('syarat/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->syarat_model->manualQuery("DELETE FROM tbl_lampiran WHERE id_lampiran='$id'");
            $this->syarat_model->manualQuery("DELETE FROM tbl_lampiran_jenis_lampiran WHERE id_lampiran='$id'");
            $this->syarat_model->manualQuery("DELETE FROM tbl_lampiran_jalur WHERE id_lampiran='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "syarat'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
