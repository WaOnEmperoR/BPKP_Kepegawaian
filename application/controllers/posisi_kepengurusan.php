<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Posisi_Kepengurusan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('posisi_kepengurusan_model');
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
				$d['judul_halaman'] = "Tabel Master Posisi Kepengurusan";
				$d['breadcumb'] = "Pengolahan Posisi Kepengurusan";
				$d['all_posisi_kepengurusan'] = $this->posisi_kepengurusan_model->get_all_posisi_kepengurusan();
								
				$d['content'] = $this->load->view('posisi_kepengurusan/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Posisi Kepengurusan";
				$d['breadcumb'] = "Pengolahan Data Posisi Kepengurusan";
				
				$d['ID_Posisi_Kepengurusan'] = '';
				$d['Nama_Posisi'] = '';
				$d['Deskripsi_Posisi_Kepengurusan'] = '';
				
				$d['content'] = $this->load->view('posisi_kepengurusan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['idMaster_Posisi'] = $this->input->post('id');
				$up['Nama_Posisi'] = $this->input->post('nama_posisi');
				$up['Deskripsi_Posisi_Kepengurusan'] = $this->input->post('deskripsi');
				
				$data = $this->tingkat_pendidikan_model->getSelectedData("master_posisi_kepengurusan",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->posisi_kepengurusan_model->updateData("master_posisi_kepengurusan",$up,$id);
					}else{
					$this->posisi_kepengurusan_model->insertData("master_posisi_kepengurusan",$up);
				}
				
				redirect('posisi_kepengurusan');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Posisi Kepengurusan";
				$d['breadcumb'] = "Pengolahan Data Posisi Kepengurusan";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM master_posisi_kepengurusan WHERE idMaster_Posisi='$id'";
				$data = $this->posisi_kepengurusan_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Posisi_Kepengurusan'] = $db->idMaster_Posisi;
						$d['Nama_Posisi'] = $db->Nama_Posisi;
						$d['Deskripsi_Posisi_Kepengurusan'] = $db->Deskripsi_Posisi_Kepengurusan;
					}
				} 
				else 
				{
					$d['ID_Posisi_Kepengurusan'] = '';
					$d['Nama_Posisi'] = '';
					$d['Deskripsi_Posisi_Kepengurusan'] = '';
				}
				
				$d['content'] = $this->load->view('posisi_kepengurusan/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->tingkat_pendidikan_model->manualQuery("DELETE FROM master_posisi_kepengurusan WHERE idMaster_Posisi='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "posisi_kepengurusan'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
