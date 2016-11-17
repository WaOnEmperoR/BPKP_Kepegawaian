<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Diklat extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('diklat_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();

			$this->load->library(array('ion_auth','form_validation'));
			$this->load->helper(array('url','language'));

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

			$this->lang->load('auth');
		}
		
		public function index() {
			$id_pegawai = $this->uri->segment(3);
			
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group) && !empty($id_pegawai)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tabel Riwayat Diklat Pegawai";
				$d['breadcumb'] = "Pengolahan Riwayat Diklat";
				
				$d['riwayat_diklat'] = $this->diklat_model->get_all_diklat_pegawai($id_pegawai);
				
				$d['id_pegawai'] = $id_pegawai;
				
				$d['content'] = $this->load->view('pendidikan/view', $d, true);
				
				$this->load->view('home', $d);
				} else {
				$this->load->view('error_404');
			}
		}
		
		public function tambah() {
			$id_pegawai = $this->uri->segment(3);
			
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group) && !empty($id_pegawai)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Tambah Data Diklat Pegawai";
				$d['breadcumb'] = "Pengolahan Data Diklat Pegawai";
				
				$d['Nama_Pegawai'] = '';
				$d['ID_Diklat'] = '';
				$d['Nama_Pelatihan'] = '';
				$d['Lembaga_Penyelenggara'] = '';
				$d['No_Sertifikat'] = '';
				$d['Tanggal_Sertifikat'] = '';
				$d['Jenis_Diklat_ID_Jenis_Diklat'] = '';
				$d['Pegawai_ID_Pegawai'] = $id_pegawai;
				
				$query = "SELECT nama_pegawai FROM Pegawai where ID_Pegawai = ".$id_pegawai;
				$nama_pegawai = $this->diklat_model->manualQuery($query)->row()->nama_pegawai;
				
				$d['Nama_Pegawai'] = $nama_pegawai;
				
				$d['list_diklat'] = $this->diklat_model->get_jenis_diklat();
				
				$d['content'] = $this->load->view('diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			$id_pegawai = $this->uri->segment(3);
			
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group) && !empty($id_pegawai)) {
				
				$id['ID_Diklat'] = $this->input->post('id');
				$up['Nama_Pelatihan'] = $this->input->post('nama_pelatihan');
				$up['Lembaga_Penyelenggara'] = $this->input->post('lembaga_penyelenggara');
				$up['No_Sertifikat'] = $this->input->post('no_sertifikat');
				$up['Tanggal_Sertifikat'] = date('Y/m/d', strtotime($this->input->post('tanggal_sertifikat')));
				$up['Jenis_Diklat_ID_Jenis_Diklat'] = $this->input->post('jenis_diklat');
				$up['Pegawai_ID_Pegawai'] = $id_pegawai;
				
				//echo ($up['Tanggal_Sertifikat']);exit();
				$data = $this->diklat_model->getSelectedData("diklat",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->diklat_model->updateData("diklat",$up,$id);
					}else{
					$this->diklat_model->insertData("diklat",$up);
				}
				
				//redirect('pendidikan/index/'.$id_pegawai);
				redirect('pegawai/ubah/'.$id_pegawai);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$id_pegawai = $this->uri->segment(3);
			$id_diklat = $this->uri->segment(4);
			
			if ($this->ion_auth->is_admin() && !empty($id_pegawai) && !empty($id_diklat)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Detail Diklat Pegawai";
				$d['breadcumb'] = "Pengolahan Data Diklat Pegawai";
				
				$query = "SELECT nama_pegawai FROM Pegawai where ID_Pegawai = ".$id_pegawai;
				$nama_pegawai = $this->diklat_model->manualQuery($query)->row()->nama_pegawai;
				
				$data = $this->diklat_model->get_detail_diklat_pegawai($id_pegawai, $id_diklat);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						$d['Nama_Pegawai'] = $nama_pegawai;
						$d['ID_Diklat'] = $db->ID_Diklat;
						$d['Nama_Pelatihan'] = $db->Nama_Pelatihan;
						$d['Lembaga_Penyelenggara'] = $db->Lembaga_Penyelenggara;
						$d['No_Sertifikat'] = $db->No_Sertifikat;
						$d['Tanggal_Sertifikat'] = date('d-m-Y', strtotime($db->Tanggal_Sertifikat));
						$d['Jenis_Diklat_ID_Jenis_Diklat'] = $db->Jenis_Diklat_ID_Jenis_Diklat;
						$d['Pegawai_ID_Pegawai'] = $db->Pegawai_ID_Pegawai;
						
					}
				} 
				else 
				{
					$d['Nama_Pegawai'] = '';
					$d['ID_Diklat'] = '';
					$d['Nama_Pelatihan'] = '';
					$d['Lembaga_Penyelenggara'] = '';
					$d['No_Sertifikat'] = '';
					$d['Tanggal_Sertifikat'] = '';
					$d['Jenis_Diklat_ID_Jenis_Diklat'] = '';
					$d['Pegawai_ID_Pegawai'] = '';
				}
				
				$d['list_diklat'] = $this->diklat_model->get_jenis_diklat();
				
				$d['content'] = $this->load->view('diklat/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group)) {
				$id_pegawai = $this->uri->segment(3);
				$id_diklat = $this->uri->segment(4);
				$this->diklat_model->manualQuery("DELETE FROM diklat WHERE ID_Diklat='$id_diklat'");
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pegawai/ubah/$id_pegawai'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
