<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Diklat_Model extends CI_Model {
		
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
		
		function get_all_diklat_pegawai($id_pegawai){
			$db =  $this->db->query("SELECT d.ID_Diklat, jd.Nama_Jenis_Diklat, d.Nama_Pelatihan, d.Lembaga_Penyelenggara, d.No_Sertifikat, DATE_FORMAT(d.Tanggal_Sertifikat, '%d %M %Y') AS Tanggal_Sertifikat, d.Jenis_Diklat_ID_Jenis_Diklat, d.Pegawai_ID_Pegawai
			FROM diklat d, jenis_diklat jd
			WHERE d.Pegawai_ID_Pegawai=$id_pegawai AND d.Jenis_Diklat_ID_Jenis_Diklat = jd.ID_Jenis_Diklat");
			return $db->result_array();
		}
		
		function get_detail_diklat_pegawai($id_pegawai, $id_diklat){
			$db =  $this->db->query("SELECT d.ID_Diklat, jd.Nama_Jenis_Diklat, d.Nama_Pelatihan, d.Lembaga_Penyelenggara, d.No_Sertifikat, DATE_FORMAT(d.Tanggal_Sertifikat, '%d %M %Y') AS Tanggal_Sertifikat, d.Jenis_Diklat_ID_Jenis_Diklat, d.Pegawai_ID_Pegawai
			FROM diklat d, jenis_diklat jd
			WHERE d.Pegawai_ID_Pegawai=$id_pegawai AND d.Jenis_Diklat_ID_Jenis_Diklat = jd.ID_Jenis_Diklat AND d.id_diklat=$id_diklat");
			return $db;
			//return $db->result_array();
		}
		
		function get_jenis_diklat()
		{
			$db =  $this->db->query("SELECT * FROM jenis_diklat ");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */