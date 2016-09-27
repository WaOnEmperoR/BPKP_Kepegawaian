<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah_registrasi extends CI_Controller {

    /**
     * @author : Caberawit
     * @keterangan : Controller untuk dashboard
     **/

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

     				$d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Daftar Her Registrasi";
            $d['breadcumb']     = "Data Peringkat Siswa";

            $d['content']    = $this->load->view('backend_sekolah/her_registrasi',$d,true);
            $this->load->view('home',$d);

        }else{
           header('location:'.base_url().'login');
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
