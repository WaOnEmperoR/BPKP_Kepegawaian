<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Master_Diklat extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('master_diklat_model');
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
				$d['judul_halaman'] = "Tabel Master Diklat";
				$d['breadcumb'] = "Pengolahan Master Diklat";
				$d['all_jenis_diklat'] = $this->master_diklat_model->get_all_master_diklat();
								
				$d['content'] = $this->load->view('master_diklat/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Master Diklat";
				$d['breadcumb'] = "Pengolahan Data Master Diklat";
				
				$d['ID_Diklat'] = '';
				$d['Nama_Diklat'] = '';
				$d['Keterangan_Diklat'] = '';
                $d['ID_Jenis_Diklat'] = '';
                $d['list_jenis_diklat'] = $this->master_diklat_model->get_all_jenis_diklat();
				
				$d['content'] = $this->load->view('master_diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			if ($this->ion_auth->is_admin()) {
				
				$id['ID_Diklat'] = $this->input->post('id');
				$up['Nama_Diklat'] = $this->input->post('nama_diklat');
				$up['Keterangan_Diklat'] = $this->input->post('keterangan_diklat');
				$up['ID_Jenis_Diklat'] = $this->input->post('jenis_diklat');

				$data = $this->master_diklat_model->getSelectedData("master_diklat",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->master_diklat_model->updateData("master_diklat",$up,$id);
					}else{
					$this->master_diklat_model->insertData("master_diklat",$up);
				}
				
				redirect('master_diklat');
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			if ($this->ion_auth->is_admin()) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Master Diklat";
				$d['breadcumb'] = "Pengolahan Data Master Diklat";
				
				$id = $this->uri->segment(3);
				$text = "SELECT * FROM master_diklat WHERE ID_Diklat='$id'";
				$data = $this->master_diklat_model->manualQuery($text);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						
						$d['ID_Diklat'] = $db->ID_Diklat;
						$d['Nama_Diklat'] = $db->Nama_Diklat;
						$d['Keterangan_Diklat'] = $db->Keterangan_Diklat;
                        $d['ID_Jenis_Diklat'] = $db->ID_Jenis_Diklat;
                        $d['list_jenis_diklat'] = $this->master_diklat_model->get_all_jenis_diklat();
 					}
				} 
				else 
				{
					$d['ID_Diklat'] = '';
					$d['Nama_Diklat'] = '';
					$d['Keterangan_Diklat'] = '';
                    $d['ID_Jenis_Diklat'] = '';
                    $d['list_jenis_diklat'] = $this->master_diklat_model->get_all_jenis_diklat();
				}
				
				$d['content'] = $this->load->view('master_diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if ($this->ion_auth->is_admin()) {
				$id = $this->uri->segment(3);
				$this->master_diklat_model->manualQuery("DELETE FROM master_diklat WHERE ID_Diklat='$id'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "master_diklat'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
