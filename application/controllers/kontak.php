<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan, S.Kom, Intan Permatasari, S.Kom, Annisa Andarachmi, S.Kom
     * @keterangan : Controller
     **/

    public function __construct()
    {
        parent::__construct();
//        $this->load->database();
        $this->load->library('functions');
//        $this->load->library('email');
    }


    public function index()
    {
            $d['judul']     ="Home";
            $d['title']     = $this->config->item('nama_aplikasi');

            $d['content']    = $this->load->view('front/kontak',$d,true);
            $this->load->view('front/home',$d);


    }

   

}

/* End of file front.php */
/* Location: ./application/controllers/front.php */