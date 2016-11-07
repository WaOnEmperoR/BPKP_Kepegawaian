<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Home extends CI_Controller {
		
		/**
			* @author : Caberawit
			* @keterangan : Controller untuk dashboard
		**/
		function __construct(){
			parent::__construct();
			
			include(APPPATH."libraries/FusionCharts.php");	
			$this->load->model('m_dashboard_populate');
			$this->load->model('mitensilan_dashboard_model');
		}
		
		public function index()
		{
			// Load the tables library
			$this->load->library('table');
			
			$cek = $this->session->userdata('logged_in');
			$pelayanan = $this->mitensilan_dashboard_model->Get_Pelayanan_Yearly()->result();
			$performance = $this->mitensilan_dashboard_model->Get_Performance_Pegawai()->result();
			
			$graph['yearly_service']=json_encode($pelayanan);
			$graph['employee_service']=json_encode($performance);
		
			if(!empty($cek)){
				
				$d['judul']     ="Home";
				$d['title']     = $this->config->item('nama_aplikasi');
				$d['graph']		= $graph;

				$d['content'] = $this->load->view('dashboard_mitensilan', $d, true);
				//$d['content'] = "<p>Halo Cest</p>";
				//echo("Here---");exit();
				
				$this->load->view('home',$d);
				
				}else{
				header('location:'.base_url().'login');
			}
		}
		
		
	}
	
	/* End of file home.php */
	/* Location: ./application/controllers/home.php */
