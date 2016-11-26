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
        $this->load->model('diklat_model');
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
        if ($this->ion_auth->logged_in()) {
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Pencarian";
            $d['breadcumb']     = "Pencarian Berdasarkan Pilihan";
                    
            $d['content'] = $this->load->view('queryselect/pilih', $d, true);
            
            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }
   
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
