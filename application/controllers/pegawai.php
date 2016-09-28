<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Pegawai extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('pegawai_model');
			$this->load->model('pendidikan_model');
			$this->load->model('diklat_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();
		}
		
		public function index() {
			if (is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tabel Data Pegawai";
				$d['breadcumb'] = "Pengolahan Data Pegawai";
				$d['all_pegawai'] = $this->pegawai_model->get_all_pegawai();
				
				$d['content'] = $this->load->view('pegawai/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if (is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Pegawai";
				$d['breadcumb'] = "Pengolahan Data Pegawai";
				
				$d['ID_Pegawai'] = '';
				$d['Nama_Pegawai'] = '';
				$d['NIK'] = '';
				$d['NIP'] = '';
				$d['Alamat'] = '';
				$d['Jenis_Kelamin'] = '';
				$d['Tempat_Lahir'] = '';
				$d['Tanggal_Lahir'] = '';
				$d['Agama'] = '';
				
				$d['content'] = $this->load->view('pegawai/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if (is_admin()) {
				
				$id['ID_Pegawai'] = $this->input->post('id');
				$up['Nama_Pegawai'] = $this->input->post('nama');
				$up['NIK'] = $this->input->post('nik');
				$up['NIP'] = $this->input->post('nip');
				$up['Alamat'] = $this->input->post('alamat');
				$up['Jenis_Kelamin'] = $this->input->post('jenis_kelamin');
				$up['Tempat_Lahir'] = $this->input->post('tempat_lahir');
				$up['Tanggal_Lahir'] = date('Y/m/d', strtotime($this->input->post('tanggal_lahir')));
				$up['Agama'] = $this->input->post('agama');
				
				$data = $this->pegawai_model->getSelectedData("pegawai",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					echo("Herexxx");
					$this->pegawai_model->updateData("pegawai",$up,$id);
					}else{
					echo("Here");
					$this->pegawai_model->insertData("pegawai",$up);
				}
				
				redirect('pegawai');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Pegawai";
				$d['breadcumb'] = "Pengolahan Data Pegawai";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM pegawai WHERE ID_Pegawai='$id'";
				$data = $this->pegawai_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Pegawai'] = $db->ID_Pegawai;
						$d['Nama_Pegawai'] = $db->Nama_Pegawai;
						$d['NIK'] = $db->NIK;
						$d['NIP'] = $db->NIP;
						$d['Alamat'] = $db->Alamat;
						$d['Jenis_Kelamin'] = $db->Jenis_Kelamin;
						$d['Tempat_Lahir'] = $db->Tempat_Lahir;
						$d['Tanggal_Lahir'] = date('d-m-Y', strtotime($db->Tanggal_Lahir));
						$d['Agama'] = $db->Agama;
					
					}
				} 
				else 
				{
					$d['ID_Pegawai'] = '';
					$d['Nama_Pegawai'] = '';
					$d['NIK'] = '';
					$d['NIP'] = '';
					$d['Alamat'] = '';
					$d['Jenis_Kelamin'] = '';
					$d['Tempat_Lahir'] = '';
					$d['Tanggal_Lahir'] = '';
					$d['Agama'] = '';
				}
				
				$d_inner_pendidikan['title'] = $this->config->item('nama_aplikasi');
				$d_inner_pendidikan['judul_halaman'] = "Tabel Riwayat Pendidikan Pegawai";
				$d_inner_pendidikan['breadcumb'] = "Pengolahan Riwayat Pendidikan";
				
				$d_inner_pendidikan['riwayat_pendidikan'] = $this->pendidikan_model->get_all_pendidikan_pegawai($d['ID_Pegawai']);
				
				$d_inner_pendidikan['id_pegawai'] = $d['ID_Pegawai'];
				
				$d['content_inner_pendidikan'] = $this->load->view('pendidikan/view_inner', $d_inner_pendidikan, true);
				
				$d_inner_diklat['title'] = $this->config->item('nama_aplikasi');
				$d_inner_diklat['judul_halaman'] = "Tabel Riwayat Diklat Pegawai";
				$d_inner_diklat['breadcumb'] = "Pengolahan Riwayat Diklat";
				
				$d_inner_diklat['riwayat_diklat'] = $this->diklat_model->get_all_diklat_pegawai($d['ID_Pegawai']);
				
				$d_inner_diklat['id_pegawai'] = $d['ID_Pegawai'];
				
				$d['content_inner_diklat'] = $this->load->view('diklat/view_inner', $d_inner_diklat, true);
				
				$d['content'] = $this->load->view('pegawai/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if (is_admin()) {
				$id = $this->uri->segment(3);
				$this->pegawai_model->manualQuery("DELETE FROM pegawai WHERE id_pegawai='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pegawai'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
