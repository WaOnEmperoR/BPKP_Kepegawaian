<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('tahun_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Tahun Ajaran";
            $d['breadcumb'] = "Pengolahan Data Tahun Ajaran";
            $d['all_tahun'] = $this->tahun_model->get_all_tahun();

            $d['content'] = $this->load->view('tahun/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Tahun Ajaran";
            $d['breadcumb'] = "Pengolahan Data Tahun Ajaran";

            $d['id'] = '';
            $d['periode'] = '';
            $d['sekolah'] = '';
            $d['tahun'] = '';
            $d['semester'] = '';
            $d['tgl_mulai'] = '';
            $d['tgl_akhir'] = '';
            
            $text = "SELECT * FROM tbl_sekolah";
            $d['l_sekolah'] = $this->tahun_model->manualQuery($text);
            $d['content'] = $this->load->view('tahun/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {

            $up['kd_periode']   = $this->input->post('periode');
            $up['id_sekolah']   = $this->input->post('sekolah');
            $up['thn']          = $this->input->post('tahun');
            $up['semester']     = $this->input->post('semester');
            $up['tgl_mulai']    = $this->input->post('tgl_mulai');
            $up['tgl_akhir']    = $this->input->post('tgl_akhir');
            

            $id['id_ta'] = $this->input->post('id');

            
            $data = $this->tahun_model->getSelectedData("tbl_thn_ajaran",$id);
            if($data->num_rows()>0){
                $result = $data->row_array();
                $this->tahun_model->updateData("tbl_thn_ajaran",$up,$id);        
            }else{
                $this->tahun_model->insertData("tbl_thn_ajaran",$up);
            }

            redirect('tahun');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        $cek = $this->session->userdata('logged_in');
        if (!empty($cek)) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Tahun Ajaran";
            $d['breadcumb'] = "Pengolahan Data Tahun Ajaran";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_thn_ajaran WHERE id_ta='$id'";
            $data = $this->tahun_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_ta;
                    $d['periode'] = $db->kd_periode;
                    $d['sekolah'] = $db->id_sekolah;
                    $d['tahun'] = $db->thn;
                    $d['semester'] = $db->semester;
                    $d['tgl_mulai'] = $db->tgl_mulai;
                    $d['tgl_akhir'] = $db->tgl_akhir;
                   
                }
            } else {
                $d['id']            = '';
                $d['periode']       = '';
                $d['sekolah']       = '';
                $d['thn']           = '';
                $d['semester']      = '';
                $d['tgl_mulai']     = '';
                $d['tgl_akhir']     = '';
                
            }

           $text = "SELECT * FROM tbl_sekolah";
            $d['l_sekolah'] = $this->tahun_model->manualQuery($text);

            $d['content'] = $this->load->view('tahun/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->tahun_model->manualQuery("DELETE FROM tbl_thn_ajaran_seleksi WHERE id_ta='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "tahun'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
