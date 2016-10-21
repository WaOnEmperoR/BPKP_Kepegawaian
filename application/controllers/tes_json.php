<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Tes_JSON extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('jenis_diklat_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();
		}
		
		public function index() {
			echo("[{Tahun: '2016', Jumlah: 2},{Tahun: '2017', Jumlah: 4}]");
		}
		
		public function tambah() {
			if (is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Master Diklat";
				$d['breadcumb'] = "Pengolahan Data Master Diklat";
				
				$d['ID_Jenis_Diklat'] = '';
				$d['Nama_Jenis_Diklat'] = '';
				$d['Deskripsi_Jenis_Diklat'] = '';
				
				$d['content'] = $this->load->view('jenis_diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if (is_admin()) {
				
				$id['ID_Jenis_Diklat'] = $this->input->post('id');
				$up['Nama_Jenis_Diklat'] = $this->input->post('nama_jenis');
				$up['Deskripsi_Jenis_Diklat'] = $this->input->post('deskripsi');
				
				$data = $this->jenis_diklat_model->getSelectedData("jenis_diklat",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->jenis_diklat_model->updateData("jenis_diklat",$up,$id);
					}else{
					$this->jenis_diklat_model->insertData("jenis_diklat",$up);
				}
				
				redirect('jenis_diklat');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$cek = $this->session->userdata('logged_in');
			if (!empty($cek)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Diklat";
				$d['breadcumb'] = "Pengolahan Data Master Diklat";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM jenis_diklat WHERE ID_Jenis_Diklat='$id'";
				$data = $this->jenis_diklat_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Jenis_Diklat'] = $db->ID_Jenis_Diklat;
						$d['Nama_Jenis_Diklat'] = $db->Nama_Jenis_Diklat;
						$d['Deskripsi_Jenis_Diklat'] = $db->Deskripsi_Jenis_Diklat;
					}
				} 
				else 
				{
					$d['ID_Jenis_Diklat'] = '';
					$d['Nama_Jenis_Diklat'] = '';
					$d['Deskripsi_Jenis_Diklat'] = '';
				}
				
				$d['content'] = $this->load->view('jenis_diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if (is_admin()) {
				$id = $this->uri->segment(3);
				$this->jenis_diklat_model->manualQuery("DELETE FROM jenis_diklat WHERE ID_Jenis_Diklat='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "jenis_diklat'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
