<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Jenis_Diklat extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('jenis_diklat_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();

			$this->load->library(array('ion_auth','form_validation'));
			$this->load->helper(array('url','language'));

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

			$this->lang->load('auth');
		}
		
		public function index() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tabel Master Jenis Diklat";
				$d['breadcumb'] = "Pengolahan Jenis Diklat";
				$d['all_jenis_diklat'] = $this->jenis_diklat_model->get_all_jenis_diklat();
								
				$d['content'] = $this->load->view('jenis_diklat/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Master Diklat";
				$d['breadcumb'] = "Pengolahan Data Master Diklat";
				
				$d['ID_Jenis_Diklat'] = '';
				$d['Nama_Jenis_Diklat'] = '';
				$d['Deskripsi_Jenis_Diklat'] = '';
				
				$d['content'] = $this->load->view('jenis_diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Jenis_Diklat'] = $this->input->post('id');
				$up['Nama_Jenis_Diklat'] = $this->input->post('nama_jenis');
				$up['Deskripsi_Jenis_Diklat'] = $this->input->post('deskripsi');
				
				$data = $this->jenis_diklat_model->getSelectedData("jenis_diklat",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->jenis_diklat_model->updateData("jenis_diklat",$up,$id);
					}else{
					$this->jenis_diklat_model->insertData("jenis_diklat",$up);
				}
				
				redirect('jenis_diklat');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$cek = $this->session->userdata('logged_in');
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Diklat";
				$d['breadcumb'] = "Pengolahan Data Master Diklat";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM jenis_diklat WHERE ID_Jenis_Diklat='$id'";
				$data = $this->jenis_diklat_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Jenis_Diklat'] = $db->ID_Jenis_Diklat;
						$d['Nama_Jenis_Diklat'] = $db->Nama_Jenis_Diklat;
						$d['Deskripsi_Jenis_Diklat'] = $db->Deskripsi_Jenis_Diklat;
					}
				} 
				else 
				{
					$d['ID_Jenis_Diklat'] = '';
					$d['Nama_Jenis_Diklat'] = '';
					$d['Deskripsi_Jenis_Diklat'] = '';
				}
				
				$d['content'] = $this->load->view('jenis_diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->jenis_diklat_model->manualQuery("DELETE FROM jenis_diklat WHERE ID_Jenis_Diklat='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jenis_diklat'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
