<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * @author : Tim CA-BKN
     * @keterangan : Controller untuk login ke backend
     **/

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

    public function index_old()
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

    // log the user in
	public function index()
	{
        
		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input
		//$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		//$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/home', 'refresh');
			}
			else
			{
				// if the login was un-successful]
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['username'] = array('name' => 'username',
				'id'    => 'username',
				'type'  => 'text',
                'class' => 'form-control',
                'autocomplete' => 'off',
                'placeholder' => 'Masukkan username.....',
				'value' => $this->form_validation->set_value('username')
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
                'class' => 'form-control',
                'autocomplete' => 'off',
                'placeholder' => 'Masukkan password.....'
			);
            $this->data['submit'] = array('name' => 'submit',
                'id' => 'submit',
                'type' => 'submit',
                'class' => 'btn btn-primary'
            );
            $data['judul']     ="Login";
            $data['title']     = $this->config->item('nama_aplikasi');

			//$this->_render_page('login', $this->data);
            $this->load->view('login', $this->data);
		}
	}
    
    public function logout_old(){
        $cek = $this->session->userdata('logged_in');
        if(empty($cek))
        {
            header('location:'.base_url());
        }else{
            $this->session->sess_destroy();
            header('location:'.base_url().'login');
        }
    }

    // log the user out
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('/login', 'refresh');
	}

    public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}
}

/* End of file  */
/* Location: ./application/controllers*/
