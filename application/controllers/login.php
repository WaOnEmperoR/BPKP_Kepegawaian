<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * @author : Tim CA-BKN
     * @keterangan : Controller untuk login ke backend
     **/

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
            if(!empty($cek)){
                header('location:'.base_url().'home');
            }
        $d['judul']     ="Login";
        $d['title']     = $this->config->item('nama_aplikasi');

        $d['username'] = array('name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'class' => 'form-control',
            'autocomplete' => 'off',
            'placeholder' => 'Masukkan username.....'
        );
        $d['password'] = array('name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'autocomplete' => 'off',
            'placeholder' => 'Masukkan password.....'
        );
		
        $d['submit'] = array('name' => 'submit',
            'id' => 'submit',
            'type' => 'submit',
            'class' => 'btn btn-primary'
        );

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('login',$d);
        }else{
            $u = $this->input->post('username');
            $p = $this->input->post('password');
            $this->app_model->getLoginData($u,$p);
        }

    }
    
    public function logout(){
        $cek = $this->session->userdata('logged_in');
        if(empty($cek))
        {
            header('location:'.base_url());
        }else{
            $this->session->sess_destroy();
            header('location:'.base_url().'login');
        }
    }
}

/* End of file  */
/* Location: ./application/controllers*/
