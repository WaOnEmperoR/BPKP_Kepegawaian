<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Pendidikan_Model extends CI_Model {
		
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
		
		function get_all_pendidikan_pegawai($id_pegawai){
			$db =  $this->db->query("SELECT p.ID_Pendidikan, tp.Nama_Tingkat_Pendidikan, p.Nama_Instansi, p.Jurusan, p.Nomor_Ijazah, DATE_FORMAT(p.Tanggal_Ijazah, '%d %M %Y') as Tanggal_Ijazah, p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan, p.Pegawai_ID_Pegawai 
			FROM pendidikan p, tingkat_pendidikan tp
			WHERE p.Pegawai_ID_Pegawai=$id_pegawai AND p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan");
			return $db->result_array();
		}
		
		function get_detail_pendidikan_pegawai($id_pegawai, $id_pendidikan){
			$db =  $this->db->query("SELECT p.ID_Pendidikan, tp.Nama_Tingkat_Pendidikan, p.Nama_Instansi, p.Jurusan, p.Nomor_Ijazah, p.Tanggal_Ijazah, p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan, p.Pegawai_ID_Pegawai 
			FROM pendidikan p, tingkat_pendidikan tp
			WHERE p.Pegawai_ID_Pegawai=$id_pegawai AND p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan AND p.ID_Pendidikan=$id_pendidikan");
			return $db;
			//return $db->result_array();
		}
		
		function get_tingkat_pendidikan()
		{
			$db =  $this->db->query("SELECT * FROM tingkat_pendidikan ");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */