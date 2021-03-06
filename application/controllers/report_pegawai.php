<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Report_pegawai extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('reporting_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();

			$this->load->library(array('ion_auth','form_validation'));
			$this->load->helper(array('url','language'));

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

			$this->lang->load('auth');
		}
		
		public function index() {
			if ($this->ion_auth->logged_in()){
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Laporan Pegawai";
				$d['breadcumb'] = "Reporting Pegawai";
				
				$d['content'] = $this->load->view('report_pegawai/form', $d, true);
				
				$this->load->view('home', $d);
			}
		}
		
		public function get_all_pegawai($kode) {
			$query = $this->reporting_model->get_list_pegawai_old($kode); //query model
			
			$pegawai =  array();
			foreach ($query as $d) {
				$pegawai[]     = array(
				"ID_Pegawai" => $d->ID_Pegawai,
				"Nama_Pegawai" => $d->Nama_Pegawai,
                "NIK" => $d->NIK, //variabel yg dibawa ke id NIK
                "NIP" => $d->NIP //variabel yang dibawa ke id NIP
				);
			}
			echo json_encode($pegawai);   
		}
		
		public function print_single_pegawai()
		{
			$id_pegawai = $this->input->post('id_pegawai');
			
			redirect('generatePDF/tambahan/'.$id_pegawai);
		}
		
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
