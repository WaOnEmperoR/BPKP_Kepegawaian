<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Mitra extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('susunan_kepengurusan_model');
			$this->load->model('mitra_model');
			$this->load->model('pegawai_model');
			$this->load->model('pendidikan_model');
			$this->load->model('diklat_model');
			$this->load->model('sertifikasi_model');
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
				$d['judul_halaman'] = "Tabel Data Mitra";
				$d['breadcumb'] = "Pengolahan Data Mitra";
				$d['all_mitra'] = $this->mitra_model->get_all_mitra();
				
				$d['content'] = $this->load->view('mitra/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Mitra";
				$d['breadcumb'] = "Pengolahan Data Mitra";
				
				$d['ID_Mitra'] = '';
				$d['Nama_Mitra'] = '';
				$d['Alamat_Mitra'] = '';
				$d['Kota'] = '';
				$d['Provinsi'] = '';
				$d['Bidang_Usaha'] = '';
				$d['Deskripsi'] = '';
				$d['Kategori_Mitra_ID_Kategori_Mitra'] = '';
				$d['Action'] = 'Tambah';
				
				$d['kategori_mitra_pilih'] = '';
				$d['all_kategori_mitra'] = $this->mitra_model->get_all_kategori_mitra();
				
				$d['content'] = $this->load->view('mitra/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Mitra'] = $this->input->post('id');
				$up['Nama_Mitra'] = $this->input->post('nama');
				$up['Alamat_Mitra'] = $this->input->post('alamat');
				$up['Kota'] = $this->input->post('kota');
				$up['Provinsi'] = $this->input->post('provinsi');
				$up['Bidang_Usaha'] = $this->input->post('bidang_usaha');
				$up['Deskripsi'] = $this->input->post('deskripsi');
				$up['Kategori_Mitra_ID_Kategori_Mitra'] = $this->input->post('ketegori_mitra');
				
				//if(empty($id['ID_Mitra']))
				//	$id['ID_Mitra'] = 0;
				
				//$data = $this->kategori_mitra_model->getSelectedData("kategori_mitra",$id);
				
				$data = $this->mitra_model->getSelectedData("mitra",$id);
				echo($data->num_rows());
				if($data->num_rows()>0)
				{
					echo("Herexxx");
					$this->mitra_model->updateData("mitra",$up,$id);
				}
				else
				{
					echo("Here");
					$this->mitra_model->insertData("mitra",$up);
				}
				
				//$this->mitra_model->insertData("mitra",$up);
				//$this->mitra_model->insertDataManual($up);
				redirect('mitra');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Mitra";
				$d['breadcumb'] = "Pengolahan Data Mitra";
				$d['all_kategori_mitra'] = $this->mitra_model->get_all_kategori_mitra();
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM mitra WHERE `ID_Mitra`='$id'";
				$data = $this->mitra_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Mitra'] = $db->ID_Mitra;
						$d['Nama_Mitra'] = $db->Nama_Mitra;
						$d['Alamat_Mitra'] = $db->Alamat_Mitra;
						$d['Kota'] = $db->Kota;
						$d['Provinsi'] = $db->Provinsi;
						$d['Bidang_Usaha'] = $db->Bidang_Usaha;
						$d['Deskripsi'] = $db->Deskripsi;
						$d['Kategori_Mitra_ID_Kategori_Mitra'] = $db->Kategori_Mitra_ID_Kategori_Mitra;
						$d['Action'] = 'Tambah';
						
					}
				} 
				else 
				{
					$d['ID_Mitra'] = '';
					$d['Nama_Mitra'] = '';
					$d['Alamat_Mitra'] = '';
					$d['Kota'] = '';
					$d['Provinsi'] = '';
					$d['Bidang_Usaha'] = '';
					$d['Deskripsi'] = '';
					$d['Kategori_Mitra_ID_Kategori_Mitra'] = '';
					
				}
				
				$d['Action'] = 'Ubah';
				
				
				$d_inner_pendidikan['title'] = $this->config->item('nama_aplikasi');
				$d_inner_pendidikan['judul_halaman'] = "Tabel Susunan Kepengurusan";
				$d_inner_pendidikan['breadcumb'] = "Pengolahan Susunan Kepengurusan";
				
				$d_inner_pendidikan['all_posisi_kepengurusan'] = $this->susunan_kepengurusan_model->all_posisi_kepengurusan();
				$d_inner_pendidikan['susunan_kepengurusan'] = $this->susunan_kepengurusan_model->get_all_susunan_kepengurusan($d['ID_Mitra']);
								
				$d_inner_pendidikan['id_mitra'] = $d['ID_Mitra'];
				$d['content_inner_pendidikan'] = $this->load->view('susunan_kepengurusan/view_inner', $d_inner_pendidikan, true);
								
				$d['content'] = $this->load->view('mitra/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->pegawai_model->manualQuery("DELETE FROM mitra WHERE ID_Mitra='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "mitra'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
