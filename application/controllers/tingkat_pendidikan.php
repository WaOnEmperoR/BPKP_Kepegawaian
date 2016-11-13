<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Tingkat_Pendidikan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('tingkat_pendidikan_model');
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
				$d['judul_halaman'] = "Tabel Master Tingkat Pendidikan";
				$d['breadcumb'] = "Pengolahan Tingkat Pendidikan";
				$d['all_tingkat_pendidikan'] = $this->tingkat_pendidikan_model->get_all_tingkat_pendidikan();
								
				$d['content'] = $this->load->view('tingkat_pendidikan/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Tingkat Pendidikan";
				$d['breadcumb'] = "Pengolahan Data Tingkat Pendidikan";
				
				$d['ID_Tingkat_Pendidikan'] = '';
				$d['Nama_Tingkat_Pendidikan'] = '';
				$d['Deskripsi_Tingkat_Pendidikan'] = '';
				
				$d['content'] = $this->load->view('tingkat_pendidikan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Tingkat_Pendidikan'] = $this->input->post('id');
				$up['Nama_Tingkat_Pendidikan'] = $this->input->post('nama_tingkat');
				$up['Deskripsi_Tingkat_Pendidikan'] = $this->input->post('deskripsi');
				
				$data = $this->tingkat_pendidikan_model->getSelectedData("tingkat_pendidikan",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->tingkat_pendidikan_model->updateData("tingkat_pendidikan",$up,$id);
					}else{
					$this->tingkat_pendidikan_model->insertData("tingkat_pendidikan",$up);
				}
				
				redirect('tingkat_pendidikan');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Tingkat Pendidikan";
				$d['breadcumb'] = "Pengolahan Data Tingkat Pendidikan";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM tingkat_pendidikan WHERE ID_Tingkat_Pendidikan='$id'";
				$data = $this->tingkat_pendidikan_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Tingkat_Pendidikan'] = $db->ID_Tingkat_Pendidikan;
						$d['Nama_Tingkat_Pendidikan'] = $db->Nama_Tingkat_Pendidikan;
						$d['Deskripsi_Tingkat_Pendidikan'] = $db->Deskripsi_Tingkat_Pendidikan;
					}
				} 
				else 
				{
					$d['ID_Tingkat_Pendidikan'] = '';
					$d['Nama_Tingkat_Pendidikan'] = '';
					$d['Deskripsi_Tingkat_Pendidikan'] = '';
				}
				
				$d['content'] = $this->load->view('tingkat_pendidikan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->tingkat_pendidikan_model->manualQuery("DELETE FROM tingkat_pendidikan WHERE ID_Tingkat_Pendidikan='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "tingkat_pendidikan'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
