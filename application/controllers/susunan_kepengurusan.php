<?php
	
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class Susunan_Kepengurusan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('susunan_kepengurusan_model');
			$this->load->model('posisi_kepengurusan_model');
			$this->load->model('tingkat_pendidikan_model');
			$this->load->library('Datatables');
			$this->load->library('table');
			$this->load->database();
		}
		
		public function tambah() {
			if (is_admin()) {

				$data = array(
					'Nama_Pengurus' => $this->input->post('nama_pengurus'),
					'Master_Posisi_Kepengurusan_idMaster_Posisi' => $this->input->post('id_posisi'),
					'Mitra_ID_Mitra' => $this->input->post('id_mitra'),
				);
				$insert = $this->susunan_kepengurusan_model->insertData('susunan_kepengurusan', $data);
				echo json_encode(array("status" => TRUE));
	
			}
		}
			
		
		public function ubah() {
			if (is_admin()) {

				$id_sp = "ID_Susunan_Kepengurusan =".$this->input->post('id_susunan_kepengurusan');
				//echo $id_sp;exit();
					
				$data = array(
					'Nama_Pengurus' => $this->input->post('nama_pengurus'),
					'Master_Posisi_Kepengurusan_idMaster_Posisi' => $this->input->post('id_posisi'),
					'Mitra_ID_Mitra' => $this->input->post('id_mitra'),
				);
				//console.log()
				//print_r($data);
				//echo "id sp ".$id_sp;exit();
				$update = $this->susunan_kepengurusan_model->updateData('susunan_kepengurusan', $data, $id_sp );
				echo json_encode(array("status" => TRUE));
	
			}
		}
		
		
		public function hapus() {
			if (is_admin()) {
				$id = $this->uri->segment(3);
				$id_mitra = $this->uri->segment(4);
				//echo $id." dan ".$id_mitra;
				//exit();
								$this->susunan_kepengurusan_model->manualQuery("DELETE FROM susunan_kepengurusan WHERE ID_Susunan_Kepengurusan='$id'");
				header('location:' . base_url() . "mitra/ubah/".$id_mitra);
				} else {
				header('location:' . base_url());
			}
		}


		public function getData() {
			if (is_admin()) {
				$id = $this->uri->segment(3);
				$data = $this->susunan_kepengurusan_model->getData($id);
				echo json_encode( array("ID_Susunan_Kepengurusan" => $data[0]['ID_Susunan_Kepengurusan'], "Nama_Pengurus" => $data[0]['Nama_Pengurus'], "Master_Posisi_Kepengurusan_idMaster_Posisi" => $data[0]['Master_Posisi_Kepengurusan_idMaster_Posisi'], "Mitra_ID_Mitra" => $data[0]['Mitra_ID_Mitra']));
				//exit();
								//array("Nama_Pengurus" => $data[0, "id" => "2")
				//echo json_encode($data); exit();
				//echo json_encode();
				//echo json_encode($data);
			} 
			else 
			{
				header('location:' . base_url());
			}
		}			
	}
	
	/* End of file pegawai.php */
	/* Location: ./application/controllers/pegawai.php */
