<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Penugasan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('penugasan_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();
		}
		
		public function index() {
			$id_pegawai = $this->uri->segment(3);
			
			if (is_admin() && !empty($id_pegawai)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tabel Riwayat Penugasan Pegawai";
				$d['breadcumb'] = "Pengolahan Riwayat Penugasan";
				
				$d['riwayat_penugasan'] = $this->penugasan_model->get_all_penugasan_pegawai($id_pegawai);
				
				$d['id_pegawai'] = $id_pegawai;
				
				$d['content'] = $this->load->view('pendidikan/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			$id_pegawai = $this->uri->segment(3);
			
			if (is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Penugasan Pegawai";
				$d['breadcumb'] = "Pengolahan Data Penugasan Pegawai";
				
				$d['Nama_Pegawai'] = '';
				$d['ID_Penugasan'] = '';
				$d['Objek_Penugasan'] = '';
				$d['Nama_Penugasan'] = '';
				$d['Tanggal_Mulai_Penugasan'] = '';
				$d['Tanggal_Selesai_Penugasan'] = '';
				$d['Master_Penugasan_ID_Jenis_Penugasan'] = '';
				$d['Master_Peran_ID_Peran'] = '';
				$d['Pegawai_ID_Pegawai'] = $id_pegawai;
				
				$query = "SELECT nama_pegawai FROM Pegawai where ID_Pegawai = ".$id_pegawai;
				$nama_pegawai = $this->penugasan_model->manualQuery($query)->row()->nama_pegawai;
				
				$d['Nama_Pegawai'] = $nama_pegawai;
				
				$d['list_penugasan'] = $this->penugasan_model->get_jenis_penugasan();
				$d['list_peran'] = $this->penugasan_model->get_jenis_peran();
								
				$d['content'] = $this->load->view('penugasan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			$id_pegawai = $this->uri->segment(3);
			
			if (is_admin()) {
				
				$id['ID_Penugasan'] = $this->input->post('id');
				$up['Nama_Penugasan'] = $this->input->post('nama_penugasan');
				$up['Objek_Penugasan'] = $this->input->post('objek_penugasan');
				$up['Tanggal_Mulai_Penugasan'] = date('Y/m/d', strtotime($this->input->post('tanggal_mulai_penugasan')));
				$up['Tanggal_Selesai_Penugasan'] = date('Y/m/d', strtotime($this->input->post('tanggal_selesai_penugasan')));
				$up['Master_Penugasan_ID_Jenis_Penugasan'] = $this->input->post('nama_jenis_penugasan');
				$up['Master_Peran_ID_Peran'] = $this->input->post('nama_jenis_peran');
				$up['Pegawai_ID_Pegawai'] = $id_pegawai;
				
				//echo ($up['Tanggal_Sertifikat']);exit();
				$data = $this->penugasan_model->getSelectedData("penugasan",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->penugasan_model->updateData("penugasan",$up,$id);
					}else{
					$this->penugasan_model->insertData("penugasan",$up);
				}
				
				//redirect('pendidikan/index/'.$id_pegawai);
				redirect('pegawai/ubah/'.$id_pegawai);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$id_pegawai = $this->uri->segment(3);
			$id_penugasan = $this->uri->segment(4);
			$cek = $this->session->userdata('logged_in');
			
			if (!empty($cek) && !empty($id_pegawai) && !empty($id_penugasan)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Detail Penugasan Pegawai";
				$d['breadcumb'] = "Pengolahan Data Penugasan Pegawai";
				
				$query = "SELECT nama_pegawai FROM Pegawai where ID_Pegawai = ".$id_pegawai;
				$nama_pegawai = $this->penugasan_model->manualQuery($query)->row()->nama_pegawai;
				
				$data = $this->penugasan_model->get_detail_penugasan_pegawai($id_pegawai, $id_penugasan);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						$d['Nama_Pegawai'] = $nama_pegawai;
						$d['ID_Penugasan'] = $db->ID_Penugasan;
						$d['Nama_Penugasan'] = $db->Nama_Penugasan;
						$d['Objek_Penugasan'] = $db->Objek_Penugasan;
						$d['Tanggal_Mulai_Penugasan'] = date('d-m-Y', strtotime($db->Tanggal_Mulai_Penugasan));
						$d['Tanggal_Selesai_Penugasan'] = date('d-m-Y', strtotime($db->Tanggal_Selesai_Penugasan));
						$d['Master_Penugasan_ID_Jenis_Penugasan'] = $db->Master_Penugasan_ID_Jenis_Penugasan;
						$d['Pegawai_ID_Pegawai'] = $db->Pegawai_ID_Pegawai;
						$d['Master_Peran_ID_Peran'] = $db->Master_Peran_ID_Peran;
					}
				} 
				else 
				{
					$d['Nama_Pegawai'] = '';
					$d['ID_Penugasan'] = '';
					$d['Nama_Penugasan'] = '';
					$d['Objek_Penugasan'] = '';
					$d['Tanggal_Mulai_Penugasan'] = '';
					$d['Tanggal_Selesai_Penugasan'] = '';
					$d['Master_Peran_ID_Peran'] = '';
					$d['Pegawai_ID_Pegawai'] = '';
				}
				
				$d['list_penugasan'] = $this->penugasan_model->get_jenis_penugasan();
				$d['list_peran'] = $this->penugasan_model->get_jenis_peran();
				
				$d['content'] = $this->load->view('penugasan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if (is_admin()) {
				$id_pegawai = $this->uri->segment(3);
				$id_penugasan = $this->uri->segment(4);
				$this->penugasan_model->manualQuery("DELETE FROM penugasan WHERE ID_Penugasan='$id_penugasan'");
				//echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pendidikan/index/$id_pegawai'>";
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pegawai/ubah/$id_pegawai'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
