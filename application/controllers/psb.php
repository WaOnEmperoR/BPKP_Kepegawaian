<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Psb extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('psb_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data PSB";
            $d['breadcumb'] = "Pengolahan Data PSB";
            $d['all_psb'] = $this->psb_model->get_all_psb();

            $d['content'] = $this->load->view('psb/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data PSB";
            $d['breadcumb'] = "Pengolahan Data PSB";

            $d['id']        = '';
            $d['tgl_awal_psb']  = '';
            $d['tgl_akhir_psb'] = '';
            $d['id_sekolah']   = '';
            $d['nm_psb']      = '';
            $d['info_psb']      = '';
            $d['kuota_psb_reguler']     = '0';
            $d['kuota_psb_lokal']     = '0';
            $d['kuota_psb_luar']     = '0';
            $d['stat_psb']    = '';


            $text = "SELECT * FROM tbl_sekolah";
            $d['l_sekolah'] = $this->psb_model->manualQuery($text);

            $d['content'] = $this->load->view('psb/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {

            $up['tgl_awal_psb']     = $this->input->post('tgl_awal_psb');
            $up['tgl_akhir_psb']    = $this->input->post('tgl_akhir_psb');
            $up['id_sekolah']       = $this->input->post('id_sekolah');
            $up['nm_psb']           = $this->input->post('nm_psb');
            $up['info_psb']         = $this->input->post('info_psb');
            $up['kuota_psb_reguler']    = $this->input->post('kuota_psb_reguler');
            $up['kuota_psb_lokal']    = $this->input->post('kuota_psb_lokal');
            $up['kuota_psb_luar']    = $this->input->post('kuota_psb_luar');
            $up['stat_psb']         = $this->input->post('stat_psb');
             if(empty($up['stat_psb']))
                $up['stat_psb'] = 2;


            $id['id_psb'] = $this->input->post('id');

            $data = $this->psb_model->getSelectedData("tbl_psb",$id);

            $up['kuota_psb'] = intval($up['kuota_psb_reguler']) + intval($up['kuota_psb_lokal']) + intval($up['kuota_psb_luar']);

            if($data->num_rows()>0){
                $result = $data->row_array();

                $this->psb_model->updateData("tbl_psb",$up,$id);
            }else{
                $this->psb_model->insertData("tbl_psb",$up);
            }

            redirect('psb');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data PSB";
            $d['breadcumb'] = "Pengolahan Data PSB";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_psb WHERE id_psb='$id'";
            $data = $this->psb_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id']        = $db->id_psb;
                    $d['tgl_awal_psb']  = $db->tgl_awal_psb;
                    $d['tgl_akhir_psb'] = $db->tgl_akhir_psb;
                    $d['id_sekolah']   = $db->id_sekolah;
                    $d['nm_psb']      = $db->nm_psb;
                    $d['info_psb']      = $db->info_psb;
                    $d['kuota_psb_reguler']     = $db->kuota_psb_reguler;
                    $d['kuota_psb_lokal']     = $db->kuota_psb_lokal;
                    $d['kuota_psb_luar']     = $db->kuota_psb_luar;
                    $d['stat_psb']    = $db->stat_psb;
                }
            } else {
                $d['id']        = '';
                $d['tgl_awal_psb']  = '';
                $d['tgl_akhir_psb'] = '';
                $d['id_sekolah']   = '';
                $d['nm_psb']      = '';
                $d['info_psb']      = '';
                $d['kuota_psb_reguler']     = '0';
                $d['kuota_psb_lokal']     = '0';
                $d['kuota_psb_luar']     = '0';
                $d['stat_psb']    = '';
            }

            $text = "SELECT * FROM tbl_sekolah";
            $d['l_sekolah'] = $this->psb_model->manualQuery($text);

            $d['content'] = $this->load->view('psb/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->psb_model->manualQuery("DELETE FROM tbl_psb WHERE id_psb='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "psb'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
