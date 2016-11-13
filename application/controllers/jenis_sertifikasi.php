<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Jenis_Sertifikasi extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('jenis_sertifikasi_model');
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
				$d['judul_halaman'] = "Tabel Master Jenis Sertifikasi";
				$d['breadcumb'] = "Pengolahan Jenis Sertifikasi";
				$d['all_jenis_sertifikasi'] = $this->jenis_sertifikasi_model->get_all_jenis_sertifikasi();
								
				$d['content'] = $this->load->view('jenis_sertifikasi/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Master Sertifikasi";
				$d['breadcumb'] = "Pengolahan Data Master Sertifikasi";
				
				$d['ID_Jenis_Sertifikasi'] = '';
				$d['Nama_Jenis_Sertifikasi'] = '';
				$d['Deskripsi_Jenis_Sertifikasi'] = '';
				
				$d['content'] = $this->load->view('jenis_sertifikasi/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Jenis_Sertifikasi'] = $this->input->post('id');
				$up['Nama_Jenis_Sertifikasi'] = $this->input->post('nama_jenis');
				$up['Deskripsi_Jenis_Sertifikasi'] = $this->input->post('deskripsi');
				
				$data = $this->jenis_sertifikasi_model->getSelectedData("jenis_sertifikasi",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->jenis_sertifikasi_model->updateData("jenis_sertifikasi",$up,$id);
					}else{
					$this->jenis_sertifikasi_model->insertData("jenis_sertifikasi",$up);
				}
				
				redirect('jenis_sertifikasi');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Sertifikasi";
				$d['breadcumb'] = "Pengolahan Data Master Sertifikasi";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM jenis_sertifikasi WHERE ID_Jenis_Sertifikasi='$id'";
				$data = $this->jenis_sertifikasi_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Jenis_Sertifikasi'] = $db->ID_Jenis_Sertifikasi;
						$d['Nama_Jenis_Sertifikasi'] = $db->Nama_Jenis_Sertifikasi;
						$d['Deskripsi_Jenis_Sertifikasi'] = $db->Deskripsi_Jenis_Sertifikasi;
					}
				} 
				else 
				{
					$d['ID_Jenis_Sertifikasi'] = '';
					$d['Nama_Jenis_Sertifikasi'] = '';
					$d['Deskripsi_Jenis_Sertifikasi'] = '';
				}
				
				$d['content'] = $this->load->view('jenis_sertifikasi/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->jenis_sertifikasi_model->manualQuery("DELETE FROM jenis_sertifikasi WHERE ID_Jenis_Sertifikasi='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jenis_sertifikasi'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
