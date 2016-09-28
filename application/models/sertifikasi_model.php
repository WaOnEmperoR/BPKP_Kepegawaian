<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Sertifikasi_Model extends CI_Model {
		
		/**
			* @author : Tim CA-BKN
			* @keterangan : Model untuk menangani semua query database aplikasi
		**/
		
		public function getSelectedData($table,$data)
		{
			return $this->db->get_where($table, $data);
		}
		
		function updateData($table,$data,$field_key)
		{
			$this->db->update($table,$data,$field_key);
		}
		function deleteData($table,$data)
		{
			$this->db->delete($table,$data);
		}
		
		function insertData($table,$data)
		{
			$this->db->insert($table,$data);
		}
		
		function manualQuery($q)
		{
			return $this->db->query($q);
		}
		
		function get_all_sertifikasi_pegawai($id_pegawai){
			$db =  $this->db->query("SELECT s.ID_Sertifikasi, js.Nama_Jenis_Sertifikasi, s.Nama_Sertifikasi, s.Lembaga_Penyelenggara, s.No_Sertifikat, DATE_FORMAT(s.Tanggal_Sertifikat, '%d %M %Y') AS Tanggal_Sertifikat, s.Jenis_Sertifikasi_ID_Jenis_Sertifikasi, s.Pegawai_ID_Pegawai
			FROM sertifikasi s, jenis_sertifikasi js
			WHERE s.Pegawai_ID_Pegawai=$id_pegawai AND s.Jenis_Sertifikasi_ID_Jenis_Sertifikasi = js.ID_Jenis_Sertifikasi");
			return $db->result_array();
		}
		
		function get_detail_sertifikasi_pegawai($id_pegawai, $id_sertifikasi){
			$db =  $this->db->query("SELECT s.ID_Sertifikasi, js.Nama_Jenis_Sertifikasi, s.Nama_Sertifikasi, s.Lembaga_Penyelenggara, s.No_Sertifikat, DATE_FORMAT(s.Tanggal_Sertifikat, '%d %M %Y') AS Tanggal_Sertifikat, s.Jenis_Sertifikasi_ID_Jenis_Sertifikasi, s.Pegawai_ID_Pegawai
			FROM sertifikasi s, jenis_sertifikasi js
			WHERE s.Pegawai_ID_Pegawai=$id_pegawai AND s.Jenis_Sertifikasi_ID_Jenis_Sertifikasi = js.ID_Jenis_Sertifikasi AND s.ID_Sertifikasi=$id_sertifikasi");
			return $db;
			//return $db->result_array();
		}
		
		function get_jenis_sertifikasi()
		{
			$db =  $this->db->query("SELECT * FROM jenis_sertifikasi ");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */