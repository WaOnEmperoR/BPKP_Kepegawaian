<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Home extends CI_Controller {
		
		/**
			* @author : Caberawit
			* @keterangan : Controller untuk dashboard
		**/
		function __construct(){
			parent::__construct();
			$this->load->database();
			$this->load->library(array('ion_auth','form_validation'));
			$this->load->helper(array('url','language'));

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

			$this->lang->load('auth');

			$this->load->model('mitensilan_dashboard_model');
		}
		
		public function index()
		{
			// Load the tables library
			$this->load->library('table');

			if ($this->ion_auth->logged_in())
			{	
				$pelayanan = $this->mitensilan_dashboard_model->Get_Pelayanan_Yearly()->result();
				$performance = $this->mitensilan_dashboard_model->Get_Performance_Pegawai()->result();
			
				$graph['yearly_service']=json_encode($pelayanan);
				$graph['employee_service']=json_encode($performance);

				$d['judul']     ="Home";
				$d['title']     = $this->config->item('nama_aplikasi');
				$d['graph']		= $graph;

				$d['content'] = $this->load->view('dashboard_mitensilan', $d, true);
				
				$this->load->view('home',$d);
				
			}else{
				header('location:'.base_url().'login');
			}
		}
		
		
	}
	
	/* End of file home.php */
	/* Location: ./application/controllers/home.php */
