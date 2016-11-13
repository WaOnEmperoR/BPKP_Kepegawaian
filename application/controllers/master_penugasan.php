<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Master_Penugasan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('master_penugasan_model');
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
				$d['judul_halaman'] = "Tabel Master Master Penugasan";
				$d['breadcumb'] = "Pengolahan Master Penugasan";
				$d['all_master_penugasan'] = $this->master_penugasan_model->get_all_master_penugasan();
								
				$d['content'] = $this->load->view('master_penugasan/view', $d, true);
				
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
				
				$d['ID_Jenis_Penugasan'] = '';
				$d['Nama_Jenis_Penugasan'] = '';
				$d['Deskripsi_Jenis_Penugasan'] = '';
				
				$d['content'] = $this->load->view('master_penugasan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Jenis_Penugasan'] = $this->input->post('id');
				$up['Nama_Jenis_Penugasan'] = $this->input->post('nama_jenis');
				$up['Deskripsi_Jenis_Penugasan'] = $this->input->post('deskripsi');
				
				$data = $this->master_penugasan_model->getSelectedData("master_penugasan",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->master_penugasan_model->updateData("master_penugasan",$up,$id);
					}else{
					$this->master_penugasan_model->insertData("master_penugasan",$up);
				}
				
				redirect('master_penugasan');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Penugasan";
				$d['breadcumb'] = "Pengolahan Data Master Penugasan";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM master_penugasan WHERE ID_Jenis_Penugasan='$id'";
				$data = $this->master_penugasan_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Jenis_Penugasan'] = $db->ID_Jenis_Penugasan;
						$d['Nama_Jenis_Penugasan'] = $db->Nama_Jenis_Penugasan;
						$d['Deskripsi_Jenis_Penugasan'] = $db->Deskripsi_Jenis_Penugasan;
					}
				} 
				else 
				{
					$d['ID_Jenis_Penugasan'] = '';
					$d['Nama_Jenis_Penugasan'] = '';
					$d['Deskripsi_Jenis_Penugasan'] = '';
				}
				
				$d['content'] = $this->load->view('master_penugasan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->master_penugasan_model->manualQuery("DELETE FROM master_penugasan WHERE ID_Jenis_Penugasan='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "master_penugasan'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
