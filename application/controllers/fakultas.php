<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fakultas extends CI_Controller
{
    
    /**
     * @author : Caberawit
     * */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('fakultas_model');
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
        if ($this->ion_auth->is_admin()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Master Fakultas";
            $d['breadcumb']     = "Pengolahan Fakultas";
            $d['all_fakultas']  = $this->fakultas_model->get_all_fakultas();
            
            $d['content'] = $this->load->view('fakultas/view', $d, true);
            
            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }
    
    public function tambah()
    {
        if ($this->ion_auth->is_admin()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tambah Data Fakultas";
            $d['breadcumb']     = "Pengolahan Data Fakultas";
            
            $d['ID_Fakultas']             = '';
            $d['Nama_Fakultas']           = '';
            $d['Keterangan_Fakultas']     = '';
            $d['ID_Tingkat_Pendidikan']   = '';
            $d['list_tingkat_pendidikan'] = $this->fakultas_model->get_all_tingkat_pendidikan();
            
            $d['content'] = $this->load->view('fakultas/form', $d, true);
            
            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }
    
    public function simpan()
    {
        if ($this->ion_auth->is_admin()) {
            
            $id['ID_Fakultas']           = $this->input->post('id');
            $up['Nama_Fakultas']         = $this->input->post('nama_fakultas');
            $up['Keterangan_Fakultas']   = $this->input->post('keterangan_fakultas');
            $up['ID_Tingkat_Pendidikan'] = $this->input->post('tingkat_pendidikan');
            
            $data = $this->fakultas_model->getSelectedData("master_fakultas", $id);
            echo ($data->num_rows());
            if ($data->num_rows() > 0) {
                $this->fakultas_model->updateData("master_fakultas", $up, $id);
            } else {
                $this->fakultas_model->insertData("master_fakultas", $up);
            }
            
            redirect('fakultas');
        } else {
            header('location:' . base_url());
        }
    }
    
    public function ubah()
    {
        if ($this->ion_auth->is_admin()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Data Fakultas";
            $d['breadcumb']     = "Pengolahan Data Fakultas";
            
            $id   = $this->uri->segment(3);
            $text = "SELECT * FROM master_fakultas WHERE ID_Fakultas='$id'";
            $data = $this->fakultas_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    
                    $d['ID_Fakultas']             = $db->ID_Fakultas;
                    $d['Nama_Fakultas']           = $db->Nama_Fakultas;
                    $d['Keterangan_Fakultas']     = $db->Keterangan_Fakultas;
                    $d['ID_Tingkat_Pendidikan']   = $db->ID_Tingkat_Pendidikan;
                    $d['list_tingkat_pendidikan'] = $this->fakultas_model->get_all_tingkat_pendidikan();
                }
            } else {
                $d['ID_Fakultas']             = '';
                $d['Nama_Fakultas']           = '';
                $d['Keterangan_Fakultas']     = '';
                $d['ID_Tingkat_Pendidikan']   = '';
                $d['list_tingkat_pendidikan'] = $this->fakultas_model->get_all_tingkat_pendidikan();
            }
            
            $d['content'] = $this->load->view('fakultas/form', $d, true);
            
            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }
    
    public function hapus()
    {
        if ($this->ion_auth->is_admin()) {
            $id = $this->uri->segment(3);
            $this->fakultas_model->manualQuery("DELETE FROM master_fakultas WHERE ID_Fakultas='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "fakultas'>";
        } else {
            header('location:' . base_url());
        }
    }
    
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
