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
		}
		
		public function index() {
			if (is_admin()) {
				
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
			if (is_admin()) {
				
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
			if (is_admin()) {
				
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
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {
				
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
				
				// $d_inner_diklat['title'] = $this->config->item('nama_aplikasi');
				// $d_inner_diklat['judul_halaman'] = "Tabel Riwayat Diklat Pegawai";
				// $d_inner_diklat['breadcumb'] = "Pengolahan Riwayat Diklat";
				
				// $d_inner_diklat['riwayat_diklat'] = $this->diklat_model->get_all_diklat_pegawai($d['ID_Pegawai']);
				
				// $d_inner_diklat['id_pegawai'] = $d['ID_Pegawai'];
				
				// $d['content_inner_diklat'] = $this->load->view('diklat/view_inner', $d_inner_diklat, true);
				
				// $d_inner_sertifikasi['title'] = $this->config->item('nama_aplikasi');
				// $d_inner_sertifikasi['judul_halaman'] = "Tabel Riwayat Sertifikasi Pegawai";
				// $d_inner_sertifikasi['breadcumb'] = "Pengolahan Riwayat Sertifikasi";
				
				// $d_inner_sertifikasi['riwayat_sertifikasi'] = $this->sertifikasi_model->get_all_sertifikasi_pegawai($d['ID_Pegawai']);
				
				// $d_inner_sertifikasi['id_pegawai'] = $d['ID_Pegawai'];
				
				// $d['content_inner_sertifikasi'] = $this->load->view('sertifikasi/view_inner', $d_inner_sertifikasi, true);
				
				// $d_inner_penugasan['title'] = $this->config->item('nama_aplikasi');
				// $d_inner_penugasan['judul_halaman'] = "Tabel Riwayat Penugasan Pegawai";
				// $d_inner_penugasan['breadcumb'] = "Pengolahan Riwayat Penugasan";
				
				// $d_inner_penugasan['riwayat_penugasan'] = $this->penugasan_model->get_all_penugasan_pegawai($d['ID_Pegawai']);
				
				// $d_inner_penugasan['id_pegawai'] = $d['ID_Pegawai'];
				
				// $d['content_inner_penugasan'] = $this->load->view('penugasan/view_inner', $d_inner_penugasan, true);
				$d['list_layanan'] = $this->pelayanan_model->get_jenis_layanan();
				$d['content'] = $this->load->view('pelayanan/form', $d, true);
								
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if (is_admin()) {
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
