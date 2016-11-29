<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    
    /**
     * @author : Caberawit
     * */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jurusan_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
        
        $this->load->library(array(
            'ion_auth',
            'form_validation'
        ));
        $this->load->helper(array(
            'url',
            'language'
        ));
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        $this->lang->load('auth');
    }
    
    public function index()
    {
        //echo("Hai");
        if ($this->ion_auth->is_admin()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Master Jurusan";
            $d['breadcumb']     = "Pengolahan Jurusan";
            $d['all_jurusan']   = $this->jurusan_model->get_all_jurusan();
            
            $d['content'] = $this->load->view('jurusan/view', $d, true);
            
            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }
    
    public function tambah()
    {
        if ($this->ion_auth->is_admin()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Jurusan";
            $d['breadcumb']     = "Pengolahan Data Jurusan";
            
            $d['ID_Jurusan']              = '';
            $d['Nama_Jurusan']            = '';
            $d['Keterangan_Jurusan']      = '';
            $d['ID_Tingkat_Pendidikan']   = '';
            $d['ID_Fakultas']             = '';
            $d['list_tingkat_pendidikan'] = $this->jurusan_model->get_all_tingkat_pendidikan();
            $d['list_fakultas']           = '';
            
            $d['content'] = $this->load->view('jurusan/form', $d, true);
            
            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }
    
    public function simpan()
    {
        if ($this->ion_auth->is_admin()) {
            
            $id['ID_Jurusan']         = $this->input->post('id');
            $up['Nama_Jurusan']       = $this->input->post('nama_jurusan');
            $up['Keterangan_Jurusan'] = $this->input->post('keterangan_jurusan');
            $up['ID_Fakultas']        = $this->input->post('fakultas');
            
            $data = $this->jurusan_model->getSelectedData("master_jurusan", $id);
            echo ($data->num_rows());
            if ($data->num_rows() > 0) {
                $this->jurusan_model->updateData("master_jurusan", $up, $id);
            } else {
                $this->jurusan_model->insertData("master_jurusan", $up);
            }
            
            redirect('jurusan');
        } else {
            header('location:' . base_url());
        }
    }
    
    public function ubah()
    {
        if ($this->ion_auth->is_admin()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Jurusan";
            $d['breadcumb']     = "Pengolahan Data Jurusan";
            
            $id   = $this->uri->segment(3);
            $text = "SELECT * FROM master_jurusan WHERE ID_Jurusan='$id'";
            $data = $this->jurusan_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['ID_Jurusan']              = $db->ID_Jurusan;
                    $d['Nama_Jurusan']            = $db->Nama_Jurusan;
                    $d['Keterangan_Jurusan']      = $db->Keterangan_Jurusan;
                    $d['ID_Fakultas']             = $db->ID_Fakultas;
                    $d['list_tingkat_pendidikan'] = $this->jurusan_model->get_all_tingkat_pendidikan();
                    $d['ID_Tingkat_Pendidikan']   = $this->jurusan_model->get_tingkat_by_fakultas($db->ID_Fakultas);
                    $d['list_fakultas']           = $this->jurusan_model->get_fakultas_by_tingkat_display($d['ID_Tingkat_Pendidikan']);
                }
            } else {
                $d['ID_Jurusan']              = '';
                $d['Nama_Jurusan']            = '';
                $d['Keterangan_Jurusan']      = '';
                $d['ID_Fakultas']             = '';
                $d['list_tingkat_pendidikan'] = $this->jurusan_model->get_all_tingkat_pendidikan();
                $d['ID_Tingkat_Pendidikan']   = '';
                $d['list_fakultas']           = '';
            }
            
            $d['content'] = $this->load->view('jurusan/form', $d, true);
            
            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }
    
    public function hapus()
    {
        if ($this->ion_auth->is_admin()) {
            $id = $this->uri->segment(3);
            $this->jurusan_model->manualQuery("DELETE FROM master_jurusan WHERE ID_Jurusan='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jurusan'>";
        } else {
            header('location:' . base_url());
        }
    }
    
    public function getFakultasByTingkat($id_tingkat)
    {
        $list_fakultas = $this->jurusan_model->get_fakultas_by_tingkat($id_tingkat);
        foreach ($list_fakultas->result() as $db) {
            echo "<option value=$db->ID_Fakultas>$db->Nama_Fakultas</option>";
        }
    }
    
    public function tes_return($id)
    {
        $hasil = $this->jurusan_model->get_tingkat_by_fakultas($id);
        echo ($hasil);
    }
    
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
