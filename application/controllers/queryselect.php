<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Queryselect extends CI_Controller
{
    
    /**
     * @author : Caberawit
     * */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('queryselect_model');
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
        if ($this->ion_auth->logged_in()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Pencarian";
            $d['breadcumb']     = "Pencarian Berdasarkan Pilihan";
            
            $d['list_fakultas'] = $this->queryselect_model->get_fakultas();
            $d['list_fakjur']   = $this->queryselect_model->get_list_fak_jur();
            
            //print_r($d['list_fakultas_and_jurusan']);
            //exit();
            
            $d['content'] = $this->load->view('queryselect/pilih', $d, true);
            
            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }
    
    public function get_list_fakjur()
    {
        $list_fakjur = $this->queryselect_model->get_list_fak_jur();
        foreach ($list_fakjur as $key => $value) {
            echo ($key);
            echo ("<br/>");
            foreach ($value as $subval) {
                echo ('----' . $subval);
                echo ('<br/>');
            }
        }
    }
    
    public function get_fakultas_all()
    {
        $hasil = $this->queryselect_model->get_fakultas();
        print_r($hasil);
    }
    
    public function get_jurusan_by_fakultas($id_fakultas)
    {
        $hasil = $this->queryselect_model->get_jurusan($id_fakultas);
        print_r($hasil);
    }
    
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
