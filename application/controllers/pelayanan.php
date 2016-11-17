<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Pelayanan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('pelayanan_model');
			$this->load->model('petugas_pelayanan_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();

			$this->load->library(array('ion_auth','form_validation'));
			$this->load->helper(array('url','language'));

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

			$this->lang->load('auth');
		}
		
		public function index() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tabel Data Pelayanan";
				$d['breadcumb'] = "Pengolahan Data Pelayanan";
				
				$d['all_pelayanan'] = $this->pelayanan_model->get_all_pelayanan();
								
				$d['content'] = $this->load->view('pelayanan/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Pelayanan";
				$d['breadcumb'] = "Pengolahan Data Pelayanan";
				
				$d['ID_Pelayanan'] = '';
				$d['Nomor_Pelayanan'] = '';
				$d['Judul_Pelayanan'] = '';
				$d['Tanggal_Mulai'] = '';
				$d['Tanggal_Selesai'] = '';
				$d['Tanggal_Laporan_Pelaksanaan'] = '';
				$d['Biaya'] = '';
				$d['Jenis_Layanan_ID_Jenis_Layanan'] = '';
				$d['Mitra_ID_Mitra'] = '';
				$d['Nama_Mitra'] = '';
				$d['Action'] = 'Tambah';
				$d['list_layanan'] = $this->pelayanan_model->get_jenis_layanan();
				
				$d['content'] = $this->load->view('pelayanan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				
				$id['ID_Pelayanan'] = $this->input->post('id');
				$up['Nomor_Pelayanan'] = $this->input->post('nomor_pelayanan');
				$up['Judul_Pelayanan'] = $this->input->post('judul_pelayanan');
				$up['Tanggal_Mulai'] = date('Y/m/d', strtotime($this->input->post('tanggal_mulai')));
				$up['Tanggal_Selesai'] = date('Y/m/d', strtotime($this->input->post('tanggal_selesai')));
				$up['Tanggal_Laporan_Pelaksanaan'] = date('Y/m/d', strtotime($this->input->post('tanggal_laporan_pelaksanaan')));
				$up['Biaya'] = $this->input->post('biaya');
				$up['Jenis_Layanan_ID_Jenis_Layanan'] = $this->input->post('kategori_layanan');
				$up['Mitra_ID_Mitra'] = $this->input->post('id_mitra');
				
				$data = $this->pelayanan_model->getSelectedData("pelayanan",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					echo("Herexxx");
					$this->pelayanan_model->updateData("pelayanan",$up,$id);
					}else{
					echo("Here");
					$this->pelayanan_model->insertData("pelayanan",$up);
				}
				
				redirect('pelayanan');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function get_all_mitra($kode) {
			$query = $this->pelayanan_model->get_mitra_autocomplete($kode); //query model
			
			$mitra =  array();
			foreach ($query as $d) {
				$mitra[]     = array(
				"ID_Mitra" => $d->ID_Mitra,
				"Nama_Mitra" => $d->Nama_Mitra
				);
			}
			echo json_encode($mitra);   
		}
		
		public function ubah() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Pelayanan";
				$d['breadcumb'] = "Pengolahan Data Pelayanan";
				
				$id = $this->uri->segment(3);
				$text = "SELECT p.*, m.Nama_Mitra FROM pelayanan p, mitra m WHERE ID_Pelayanan='$id' AND p.Mitra_ID_Mitra = m.ID_Mitra ";
				$data = $this->pelayanan_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Pelayanan'] = $db->ID_Pelayanan;
						$d['Nomor_Pelayanan'] = $db->Nomor_Pelayanan;
						$d['Judul_Pelayanan'] = $db->Judul_Pelayanan;
						$d['Tanggal_Mulai'] = date('d-m-Y', strtotime($db->Tanggal_Mulai));
						$d['Tanggal_Selesai'] = date('d-m-Y', strtotime($db->Tanggal_Selesai));
						$d['Tanggal_Laporan_Pelaksanaan'] = date('d-m-Y', strtotime($db->Tanggal_Laporan_Pelaksanaan));
						$d['Biaya'] = $db->Biaya;
						$d['Jenis_Layanan_ID_Jenis_Layanan'] = $db->Jenis_Layanan_ID_Jenis_Layanan;
						$d['Mitra_ID_Mitra'] = $db->Mitra_ID_Mitra;
						$d['Nama_Mitra'] = $db->Nama_Mitra;
					}
				} 
				else 
				{
					$d['ID_Pelayanan'] = '';
					$d['Nomor_Pelayanan'] = '';
					$d['Judul_Pelayanan'] = '';
					$d['Tanggal_Mulai'] = '';
					$d['Tanggal_Selesai'] = '';
					$d['Tanggal_Laporan_Pelaksanaan'] = '';
					$d['Biaya'] = '';
					$d['Jenis_Layanan_ID_Jenis_Layanan'] = '';
					$d['Mitra_ID_Mitra'] = '';
				}
				
				$d['Action'] = 'Ubah';
				
				$d_inner_personnel['title'] = $this->config->item('nama_aplikasi');
				$d_inner_personnel['judul_halaman'] = "Tabel Pegawai yang Terlibat dalam Pelayanan";
				$d_inner_personnel['breadcumb'] = "Pengolahan Pegawai-Pelayanan";
				
				$d_inner_personnel['susunan_petugas_pelayanan'] = $this->petugas_pelayanan_model->get_pelayanan_penugasan($d['ID_Pelayanan']);
				$d_inner_personnel['all_peran_penugasan'] = $this->petugas_pelayanan_model->get_jenis_peran();
				
				$d_inner_personnel['id_pelayanan'] = $d['ID_Pelayanan'];
				
				$d['content_inner_personnel'] = $this->load->view('petugas_pelayanan/view_inner', $d_inner_personnel, true);
				
				$d['list_layanan'] = $this->pelayanan_model->get_jenis_layanan();
				$d['content'] = $this->load->view('pelayanan/form', $d, true);
								
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				$id = $this->uri->segment(3);
				$this->pegawai_model->manualQuery("DELETE FROM pelayanan WHERE id_pelayanan='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pelayanan'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
