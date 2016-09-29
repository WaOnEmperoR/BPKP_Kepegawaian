<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Master_Peran extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('master_peran_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();
		}
		
		public function index() {
			if (is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tabel Master Master Peran";
				$d['breadcumb'] = "Pengolahan Master Peran";
				$d['all_master_peran'] = $this->master_peran_model->get_all_master_peran();
								
				$d['content'] = $this->load->view('master_peran/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if (is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Master Peran";
				$d['breadcumb'] = "Pengolahan Data Master Peran";
				
				$d['ID_Peran'] = '';
				$d['Nama_Peran'] = '';
				$d['Deskripsi_Peran'] = '';
				
				$d['content'] = $this->load->view('master_peran/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if (is_admin()) {
				
				$id['ID_Peran'] = $this->input->post('id');
				$up['Nama_Peran'] = $this->input->post('nama_jenis');
				$up['Deskripsi_Peran'] = $this->input->post('deskripsi');
				
				$data = $this->master_peran_model->getSelectedData("master_peran",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->master_peran_model->updateData("master_peran",$up,$id);
					}else{
					$this->master_peran_model->insertData("master_peran",$up);
				}
				
				redirect('master_peran');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Peran";
				$d['breadcumb'] = "Pengolahan Data Master Peran";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM master_peran WHERE ID_Peran='$id'";
				$data = $this->master_peran_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Peran'] = $db->ID_Peran;
						$d['Nama_Peran'] = $db->Nama_Peran;
						$d['Deskripsi_Peran'] = $db->Deskripsi_Peran;
					}
				} 
				else 
				{
					$d['ID_Peran'] = '';
					$d['Nama_Peran'] = '';
					$d['Deskripsi_Peran'] = '';
				}
				
				$d['content'] = $this->load->view('master_peran/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if (is_admin()) {
				$id = $this->uri->segment(3);
				$this->master_peran_model->manualQuery("DELETE FROM master_peran WHERE ID_Peran='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "master_peran'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
