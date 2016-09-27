<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Testable extends CI_Controller{
		
		function __construct(){
			parent::__construct();
			
			$this->load->model('m_dashboard_populate');
		}
		public function index(){
			// Load the tables library
			$this->load->library('table');
			
			$data['tampung'] = $this->m_dashboard_populate->top10_tampung_reguler();
			
			$tmpl = array ( 'table_open'  => '<table cellpadding="2" cellspacing="1" id="dayatampung" class="tablesorter">' );
			$this->table->set_template($tmpl);
			$header = array('Nama Sekolah', 'Nama PSB', 'Daya Tampung');
			$this->table->set_heading($header);
			// Load the view and send the results
			$this->load->view('testable', $data);
		}
	}
?>