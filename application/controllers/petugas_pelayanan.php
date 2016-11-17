<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Petugas_Pelayanan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('petugas_pelayanan_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();

			$this->load->library(array('ion_auth','form_validation'));
			$this->load->helper(array('url','language'));

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

			$this->lang->load('auth');
		}
		
		public function tambah() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				
				$data = array(
				'Pelayanan_ID_Pelayanan' => $this->input->post('id_pelayanan'),
				'Pegawai_ID_Pegawai' => $this->input->post('id_pegawai'),
				'Master_Peran_ID_Peran' => $this->input->post('id_peran')
				);
				$insert = $this->petugas_pelayanan_model->insertData('pelayanan_has_pegawai', $data);
				echo json_encode(array("status" => TRUE));
				
			}
		}
		
		
		public function ubah() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				
				$id_php = "ID_Pelayanan_has_Pegawai =".$this->input->post('id_pelayanan_has_pegawai');
				//echo $id_sp;exit();
				
				$data = array(
				'Pelayanan_ID_Pelayanan' => $this->input->post('id_pelayanan'),
				'Pegawai_ID_Pegawai' => $this->input->post('id_pegawai'),
				'Master_Peran_ID_Peran' => $this->input->post('id_peran')
				);
				//console.log()
				//print_r($data);
				//echo "id sp ".$id_sp;exit();
				$update = $this->petugas_pelayanan_model->updateData('pelayanan_has_pegawai', $data, $id_php );
				echo json_encode(array("status" => TRUE));
				
			}
		}
		
		
		public function hapus() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				$id_pelayanan = $this->uri->segment(3);
				$id_php = $this->uri->segment(4);
				
				$this->petugas_pelayanan_model->manualQuery("DELETE FROM Pelayanan_has_Pegawai WHERE ID_Pelayanan_has_Pegawai='$id_php'");
				header('location:' . base_url() . "pelayanan/ubah/".$id_pelayanan);
				} else {
				header('location:' . base_url());
			}
		}
		
		
		public function getData() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				$id = $this->uri->segment(3);
				$data = $this->petugas_pelayanan_model->getData($id);
				echo json_encode( array("ID_Pelayanan_has_Pegawai" => $data[0]['ID_Pelayanan_has_Pegawai'], "Pelayanan_ID_Pelayanan" => $data[0]['Pelayanan_ID_Pelayanan'], "Pegawai_ID_Pegawai" => $data[0]['Pegawai_ID_Pegawai'], "Master_Peran_ID_Peran" => $data[0]['Master_Peran_ID_Peran'], "Nama_Pegawai" => $data[0]['Nama_Pegawai']));
			} 
			else 
			{
				header('location:' . base_url());
			}
		}
		
		public function get_all_pegawai($kode) {
			$query = $this->petugas_pelayanan_model->get_pegawai_autocomplete($kode); //query model
			
			$pegawai =  array();
			foreach ($query as $d) {
				$pegawai[]     = array(
				"ID_Pegawai" => $d->ID_Pegawai,
				"Nama_Pegawai" => $d->Nama_Pegawai
				);
			}
			echo json_encode($pegawai);   
		}
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
