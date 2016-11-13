<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Kategori_Mitra extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('kategori_mitra_model');
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
				$d['judul_halaman'] = "Tabel Master Kategori Mitra";
				$d['breadcumb'] = "Pengolahan Kategori Mitra";
				$d['all_kategori_mitra'] = $this->kategori_mitra_model->get_all_kategori_mitra();
								
				$d['content'] = $this->load->view('kategori_mitra/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Kategori Mitra";
				$d['breadcumb'] = "Pengolahan Data Kategori Mitra";
				
				$d['ID_Kategori_Mitra'] = '';
				$d['Nama_Kategori'] = '';
				$d['Deskripsi_Kategori_Mitra'] = '';
				
				$d['content'] = $this->load->view('kategori_mitra/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Kategori_Mitra'] = $this->input->post('id');
				$up['Nama_Kategori'] = $this->input->post('nama_kategori');
				$up['Deskripsi_Kategori_Mitra'] = $this->input->post('deskripsi');
				
				$data = $this->kategori_mitra_model->getSelectedData("kategori_mitra",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->kategori_mitra_model->updateData("kategori_mitra",$up,$id);
					}else{
					$this->kategori_mitra_model->insertData("kategori_mitra",$up);
				}
				
				redirect('kategori_mitra');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Kategori Mitra";
				$d['breadcumb'] = "Pengolahan Data Kategori Mitra";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM kategori_mitra WHERE ID_Kategori_Mitra='$id'";
				$data = $this->tingkat_pendidikan_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Kategori_Mitra'] = $db->ID_Kategori_Mitra;
						$d['Nama_Kategori'] = $db->Nama_Kategori;
						$d['Deskripsi_Kategori_Mitra'] = $db->Deskripsi_Kategori_Mitra;
					}
				} 
				else 
				{
					$d['ID_Kategori_Mitra'] = '';
					$d['Nama_Kategori'] = '';
					$d['Deskripsi_Kategori_Mitra'] = '';
				}
				
				$d['content'] = $this->load->view('kategori_mitra/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->tingkat_pendidikan_model->manualQuery("DELETE FROM kategori_mitra WHERE ID_Kategori_Mitra='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "kategori_mitra'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
