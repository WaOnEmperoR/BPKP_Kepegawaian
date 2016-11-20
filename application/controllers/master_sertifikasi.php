<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Master_Sertifikasi extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('master_sertifikasi_model');
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
				$d['judul_halaman'] = "Tabel Master Sertifikasi";
				$d['breadcumb'] = "Pengolahan Master Sertifikasi";
				$d['all_sertifikasi'] = $this->master_sertifikasi_model->get_all_master_sertifikasi();
								
				$d['content'] = $this->load->view('master_sertifikasi/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Master Sertifikasi";
				$d['breadcumb'] = "Pengolahan Data Master Sertifikasi";
				
				$d['ID_Sertifikasi'] = '';
				$d['Nama_Sertifikasi'] = '';
				$d['Keterangan_Sertifikasi'] = '';
                $d['ID_Jenis_Sertifikasi'] = '';
                $d['list_jenis_sertifikasi'] = $this->master_sertifikasi_model->get_all_jenis_sertifikasi();
				
				$d['content'] = $this->load->view('master_sertifikasi/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Sertifikasi'] = $this->input->post('id');
				$up['Nama_Sertifikasi'] = $this->input->post('nama_sertifikasi');
				$up['Keterangan_Sertifikasi'] = $this->input->post('keterangan_sertifikasi');
				$up['ID_Jenis_Sertifikasi'] = $this->input->post('jenis_sertifikasi');

				$data = $this->master_sertifikasi_model->getSelectedData("master_sertifikasi",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->master_sertifikasi_model->updateData("master_sertifikasi",$up,$id);
					}else{
					$this->master_sertifikasi_model->insertData("master_sertifikasi",$up);
				}
				
				redirect('master_sertifikasi');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Sertifikasi";
				$d['breadcumb'] = "Pengolahan Data Master Sertifikasi";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM master_sertifikasi WHERE ID_Sertifikasi='$id'";
				$data = $this->master_sertifikasi_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Sertifikasi'] = $db->ID_Sertifikasi;
						$d['Nama_Sertifikasi'] = $db->Nama_Sertifikasi;
						$d['Keterangan_Sertifikasi'] = $db->Keterangan_Sertifikasi;
                        $d['ID_Jenis_Sertifikasi'] = $db->ID_Jenis_Sertifikasi;
                        $d['list_jenis_sertifikasi'] = $this->master_sertifikasi_model->get_all_jenis_sertifikasi();
 					}
				} 
				else 
				{
					$d['ID_Sertifikasi'] = '';
					$d['Nama_Sertifikasi'] = '';
					$d['Keterangan_Sertifikasi'] = '';
                    $d['ID_Jenis_Sertifikasi'] = '';
                    $d['list_jenis_sertifikasi'] = $this->master_sertifikasi_model->get_all_jenis_sertifikasi();
				}
				
				$d['content'] = $this->load->view('master_sertifikasi/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->master_sertifikasi_model->manualQuery("DELETE FROM master_sertifikasi WHERE ID_Sertifikasi='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "master_sertifikasi'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
