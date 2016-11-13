<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Jenis_Layanan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('jenis_layanan_model');
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
				$d['judul_halaman'] = "Tabel Master Jenis Layanan";
				$d['breadcumb'] = "Pengolahan Jenis Layanan";
				$d['all_jenis_layanan'] = $this->jenis_layanan_model->get_all_jenis_layanan();
								
				$d['content'] = $this->load->view('jenis_layanan/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Jenis layanan";
				$d['breadcumb'] = "Pengolahan Data Jenis Layanan";
				
				$d['ID_Jenis_Layanan'] = '';
				$d['Kategori_Layanan'] = '';
				$d['Deskripsi_Jenis_Layanan'] = '';
				
				$d['content'] = $this->load->view('jenis_layanan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Jenis_Layanan'] = $this->input->post('id');
				$up['Kategori_Layanan'] = $this->input->post('nama_layanan');
				$up['Deskripsi_Jenis_Layanan'] = $this->input->post('deskripsi');
				
				$data = $this->jenis_layanan_model->getSelectedData("jenis_layanan",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->jenis_layanan_model->updateData("jenis_layanan",$up,$id);
					}else{
					$this->jenis_layanan_model->insertData("jenis_layanan",$up);
				}
				
				redirect('jenis_layanan');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Jenis Layanan";
				$d['breadcumb'] = "Pengolahan Data Jenis Layanan";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM jenis_layanan WHERE ID_Jenis_Layanan='$id'";
				$data = $this->jenis_layanan_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Jenis_Layanan'] = $db->ID_Jenis_Layanan;
						$d['Kategori_Layanan'] = $db->Kategori_Layanan;
						$d['Deskripsi_Jenis_Layanan'] = $db->Deskripsi_Jenis_Layanan;
					}
				} 
				else 
				{
					$d['ID_Jenis_Layanan'] = '';
					$d['Kategori_Layanan'] = '';
					$d['Deskripsi_Jenis_Layanan'] = '';
				}
				
				$d['content'] = $this->load->view('jenis_layanan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->tingkat_pendidikan_model->manualQuery("DELETE FROM jenis_layanan WHERE ID_Jenis_Layanan='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jenis_layanan'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
