<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Sertifikasi extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('sertifikasi_model');
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
				$d['judul_halaman'] = "Tabel Riwayat Sertifikasi Pegawai";
				$d['breadcumb'] = "Pengolahan Riwayat Sertifikasi";
				
				$d['riwayat_sertifikasi'] = $this->sertifikasi_model->get_all_sertifikasi_pegawai($id_pegawai);
				
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
				$d['judul_halaman'] = "Tambah Data Sertifikasi Pegawai";
				$d['breadcumb'] = "Pengolahan Data Sertifikasi Pegawai";
				
				$d['Nama_Pegawai'] = '';
				$d['ID_Sertifikasi'] = '';
				$d['Nama_Sertifikasi'] = '';
				$d['Lembaga_Penyelenggara'] = '';
				$d['No_Sertifikat'] = '';
				$d['Tanggal_Sertifikat'] = '';
				$d['Jenis_Sertifikasi_ID_Jenis_Sertifikasi'] = '';
				$d['Pegawai_ID_Pegawai'] = $id_pegawai;
				
				$query = "SELECT nama_pegawai FROM Pegawai where ID_Pegawai = ".$id_pegawai;
				$nama_pegawai = $this->sertifikasi_model->manualQuery($query)->row()->nama_pegawai;
				
				$d['Nama_Pegawai'] = $nama_pegawai;
				
				$d['list_sertifikasi'] = $this->sertifikasi_model->get_jenis_sertifikasi();
				
				
				$d['content'] = $this->load->view('sertifikasi/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function simpan() {
			$id_pegawai = $this->uri->segment(3);
			
			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group) && !empty($id_pegawai)) {
				
				$id['ID_Sertifikasi'] = $this->input->post('id');
				$up['Nama_Sertifikasi'] = $this->input->post('nama_sertifikasi');
				$up['Lembaga_Penyelenggara'] = $this->input->post('lembaga_penyelenggara');
				$up['No_Sertifikat'] = $this->input->post('no_sertifikat');
				$up['Tanggal_Sertifikat'] = date('Y/m/d', strtotime($this->input->post('tanggal_sertifikat')));
				$up['Jenis_Sertifikasi_ID_Jenis_Sertifikasi'] = $this->input->post('jenis_sertifikasi');
				$up['Pegawai_ID_Pegawai'] = $id_pegawai;
				
				//echo ($up['Tanggal_Sertifikat']);exit();
				$data = $this->sertifikasi_model->getSelectedData("sertifikasi",$id);
				echo($data->num_rows());
				if($data->num_rows()>0){
					$this->sertifikasi_model->updateData("sertifikasi",$up,$id);
					}else{
					$this->sertifikasi_model->insertData("sertifikasi",$up);
				}
				
				//redirect('pendidikan/index/'.$id_pegawai);
				redirect('pegawai/ubah/'.$id_pegawai);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function ubah() {
			$id_pegawai = $this->uri->segment(3);
			$id_sertifikasi = $this->uri->segment(4);

			$group = array('admin', 'bidang_kepegawaian');
			if ($this->ion_auth->in_group($group) && !empty($id_pegawai) && !empty($id_sertifikasi)) {
				
				$d['title'] = $this->config->item('nama_aplikasi');
				$d['judul_halaman'] = "Ubah Data Detail Sertifikasi Pegawai";
				$d['breadcumb'] = "Pengolahan Data Sertifikasi Pegawai";
				
				$query = "SELECT nama_pegawai FROM Pegawai where ID_Pegawai = ".$id_pegawai;
				$nama_pegawai = $this->sertifikasi_model->manualQuery($query)->row()->nama_pegawai;
				
				$data = $this->sertifikasi_model->get_detail_sertifikasi_pegawai($id_pegawai, $id_sertifikasi);
				if ($data->num_rows() > 0) {
					foreach ($data->result() as $db) {
						$d['Nama_Pegawai'] = $nama_pegawai;
						$d['ID_Sertifikasi'] = $db->ID_Sertifikasi;
						$d['Nama_Sertifikasi'] = $db->Nama_Sertifikasi;
						$d['Lembaga_Penyelenggara'] = $db->Lembaga_Penyelenggara;
						$d['No_Sertifikat'] = $db->No_Sertifikat;
						$d['Tanggal_Sertifikat'] = date('d-m-Y', strtotime($db->Tanggal_Sertifikat));
						$d['Jenis_Sertifikasi_ID_Jenis_Sertifikasi'] = $db->Jenis_Sertifikasi_ID_Jenis_Sertifikasi;
						$d['Pegawai_ID_Pegawai'] = $db->Pegawai_ID_Pegawai;
						
					}
				} 
				else 
				{
					$d['Nama_Pegawai'] = '';
					$d['ID_Sertifikasi'] = '';
					$d['Nama_Sertifikasi'] = '';
					$d['Lembaga_Penyelenggara'] = '';
					$d['No_Sertifikat'] = '';
					$d['Tanggal_Sertifikat'] = '';
					$d['Jenis_Sertifikasi_ID_Jenis_Sertifikasi'] = '';
					$d['Pegawai_ID_Pegawai'] = '';
				}
				
				$d['list_sertifikasi'] = $this->sertifikasi_model->get_jenis_sertifikasi();
				
				$d['content'] = $this->load->view('sertifikasi/form', $d, true);
				
				$this->load->view('home', $d);
				} else {
				header('location:' . base_url());
			}
		}
		
		public function hapus() {
			if (is_admin()) {
				$id_pegawai = $this->uri->segment(3);
				$id_sertifikasi = $this->uri->segment(4);
				$this->sertifikasi_model->manualQuery("DELETE FROM sertifikasi WHERE ID_Sertifikasi='$id_sertifikasi'");
				//echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pendidikan/index/$id_pegawai'>";
				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pegawai/ubah/$id_pegawai'>";
				} else {
				header('location:' . base_url());
			}
		}
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
