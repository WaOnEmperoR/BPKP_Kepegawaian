<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sekolah extends CI_Controller {

    /**
     * @author : Caberawit
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('sekolah_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data sekolah Seleksi";
            $d['breadcumb'] = "Pengolahan Data sekolah Seleksi";
            $d['all_sekolah'] = $this->sekolah_model->get_all_sekolah();

            $d['content'] = $this->load->view('sekolah/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function tambah() {
        if (is_admin() || is_operator_disdik()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Sekolah";
            $d['breadcumb'] = "Pengolahan Data Sekolah";

            $d['id'] = '';
            $d['nama'] = '';
            $d['alamat'] = '';
            $d['prov'] = '';
            $d['kab'] = '';
            $d['status'] = '';
            $d['jenjang'] = '';
            $d['dinas'] = '';
            $d['logo'] = '';

            $text = "SELECT * FROM tbl_prov";
            $d['l_provinsi'] = $this->sekolah_model->manualQuery($text);
            $text1 = "SELECT * FROM tbl_kab";
            $d['l_kabupaten'] = $this->sekolah_model->manualQuery($text1);
            $text2 = "SELECT * FROM tbl_jenjang";
            $d['l_jenjang'] = $this->sekolah_model->manualQuery($text2);
            $text3 = "SELECT * FROM tbl_dinas";
            $d['l_dinas'] = $this->sekolah_model->manualQuery($text3);
            $d['content'] = $this->load->view('sekolah/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin() || is_operator_disdik()) {

            $up['nm_sekolah'] = $this->input->post('nama');
            $up['almt_sekolah'] = $this->input->post('alamat');
            $up['prov_sekolah'] = $this->input->post('prov');
            $up['kab_sekolah'] = $this->input->post('kab');
            $up['id_jenjang'] = $this->input->post('jenjang');
            $up['logo_sekolah'] = $this->input->post('logo');
            $up['id_dinas'] = $this->input->post('dinas');
            $up['stat_sekolah'] = $this->input->post('status');
            if(empty($up['stat_sekolah']))
                $up['stat_sekolah'] = 2;

            $id['id_sekolah'] = $this->input->post('id');

            if (!empty($_FILES['logo']['name'])) {
                    // upload
                    $config['upload_path']      = './uploads/logo_sekolah/';
                    $config['allowed_types']    = 'gif|jpg|png';
                    #$config['file_name']        =  $_FILES['logo']['name'];
                    //$config['max_size']       = '1024';
                    //$config['max_width']      = '1024';
                    //$config['max_height']     = '768';

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    

                    if ( ! $this->upload->do_upload('logo'))
                    {
                        print_r($this->upload->display_errors());exit();
                        /*$error = array('error' => $this->upload->display_errors());
                        print_r($error); exit();*/
                        //redirect('slide');
                    }
                    else
                    {
                        //Image Resizing
                        $data_upload = $this->upload->data();

                        $file_name = $data_upload["file_name"];

                        $this->load->library('image_lib');
                        $config_resize['image_library'] = 'gd2';
                        $config_resize['create_thumb'] = FALSE;
                        $config_resize['maintain_ratio'] = TRUE;
                        $config_resize['new_image'] = './uploads/logo_sekolah/thumbs';
                        $config_resize['master_dim'] = 'height';
                        $config_resize['quality'] = "100%";
                        $config_resize['source_image'] = './uploads/logo_sekolah/'. $file_name;

                        $config_resize['width'] = 80;
                        $config_resize['height'] = 80;
                        $this->image_lib->initialize($config_resize);
                        $this->image_lib->resize();

                        $pp = array('upload_data' => $this->upload->data());
                    }

                    $up['logo_sekolah'] = $pp['upload_data']['file_name'];

                }


                $data = $this->sekolah_model->getSelectedData("tbl_sekolah",$id);
                if($data->num_rows()>0){
                    $result = $data->row_array();

                    $this->sekolah_model->updateData("tbl_sekolah",$up,$id);
                    $old_dir = './uploads/sekolah/';
                    $old_thumbs    = './uploads/sekolah/thumbs/';
                    if(file_exists($old_dir . $result['logo_sekolah'])){
                        unlink($old_dir . $result['logo_sekolah']);
                        unlink($old_thumbs . $result['logo_sekolah']);
                    }
                }else{
                    $this->sekolah_model->insertData("tbl_sekolah",$up);
                }

            redirect('sekolah');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        $cek = $this->session->userdata('logged_in');
        if (!empty($cek)) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data sekolah Pendidikan";
            $d['breadcumb'] = "Pengolahan Data sekolah Pendidikan";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_sekolah WHERE id_sekolah='$id'";
            $data = $this->sekolah_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_sekolah;
                    $d['nama'] = $db->nm_sekolah;
                    $d['alamat'] = $db->almt_sekolah;
                    $d['prov'] = $db->prov_sekolah;
                    $d['kab'] = $db->kab_sekolah;
                    $d['jenjang'] = $db->id_jenjang;
                    $d['status'] = $db->stat_sekolah;
                    $d['logo'] = $db->logo_sekolah;
                    $d['dinas'] = $db->id_dinas;
                }
            } else {
                $d['id']            = '';
                $d['nama']          = '';
                $d['deskripsi']     = '';
                $d['prov']          = '';
                $d['kab']           = '';
                $d['jenjang']       = '';
                $d['status']        = '';
                $d['logo']          = '';
                $d['dinas']         = '';
            }

            $text = "SELECT * FROM tbl_prov";
            $d['l_provinsi'] = $this->sekolah_model->manualQuery($text);
            $text1 = "SELECT * FROM tbl_kab";
            $d['l_kabupaten'] = $this->sekolah_model->manualQuery($text1);
            $text2 = "SELECT * FROM tbl_jenjang";
            $d['l_jenjang'] = $this->sekolah_model->manualQuery($text2);
            $text3 = "SELECT * FROM tbl_dinas";
            $d['l_dinas'] = $this->sekolah_model->manualQuery($text3);

            $d['content'] = $this->load->view('sekolah/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function hapus() {
        if (is_admin() || is_operator_disdik()) {
            $id = $this->uri->segment(3);
            $this->sekolah_model->manualQuery("DELETE FROM tbl_sekolah_seleksi WHERE id_sekolah='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "sekolah'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
