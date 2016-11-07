<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Report_pelayanan_mitra extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		
		public function __construct() {
			parent::__construct();
			$this->load->model('reporting_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();
		}
		
		public function index() {
			$d['title'] = $this->config->item('nama_aplikasi');
			$d['judul_halaman'] = "Laporan Pelayanan Mitra";
			$d['breadcumb'] = "Reporting Pelayanan Mitra";
			$d['list_layanan'] = $this->reporting_model->get_jenis_layanan();
			
			$d['content'] = $this->load->view('report_layanan_mitra/form', $d, true);
			
			$this->load->view('home', $d);
		}
		
		public function get_all_mitra($kode) {
			$query = $this->reporting_model->get_mitra_autocomplete($kode); //query model
			
			$mitra =  array();
			foreach ($query as $d) {
				$mitra[]     = array(
				"ID_Mitra" => $d->ID_Mitra,
				"Nama_Mitra" => $d->Nama_Mitra,
				);
			}
			echo json_encode($mitra);   
		}
		
		public function print_pelayanan_mitra()
		{
			$id_jenis_layanan = $this->input->post('kategori_layanan')."-";
			$tanggal_mulai = $this->input->post('tanggal_mulai')."-";
			$tanggal_selesai = $this->input->post('tanggal_selesai')."-";
			$id_mitra = $this->input->post('id_mitra')."-";
			
			$id_jenis_layanan = ($id_jenis_layanan=="all-"?"kosong":$this->input->post('kategori_layanan'));
			$tanggal_mulai = ($tanggal_mulai=="-"?"kosong":$this->input->post('tanggal_mulai'));
			$tanggal_selesai = ($tanggal_selesai=="-"?"kosong":$this->input->post('tanggal_selesai'));
			$id_mitra = ($id_mitra=="-"?"kosong":$this->input->post('id_mitra'));
			
			redirect('generatePDF/rekap_pelayanan/'.$id_jenis_layanan.'/'.$tanggal_mulai.'/'.$tanggal_selesai.'/'.$id_mitra);
		}
		
		
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
