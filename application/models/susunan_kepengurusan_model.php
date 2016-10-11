<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Susunan_Kepengurusan_Model extends CI_Model {
		
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
		
		function get_all_susunan_kepengurusan($id_mitra){
			$db =  $this->db->query("SELECT a.ID_Susunan_Kepengurusan, a.Nama_Pengurus,b.Nama_Posisi  FROM susunan_kepengurusan a, master_posisi_kepengurusan b WHERE a.Master_Posisi_Kepengurusan_idMaster_Posisi = b.idMaster_Posisi and a.Mitra_ID_Mitra=$id_mitra");
			return $db->result_array();
		}

		function all_posisi_kepengurusan(){
			$db =  $this->db->query("SELECT idMaster_Posisi, Nama_Posisi  FROM master_posisi_kepengurusan");
			return $db->result_array();
		}

		function get_detail_pendidikan_pegawai($id_pegawai, $id_pendidikan){
			$db =  $this->db->query("SELECT p.ID_Pendidikan, tp.Nama_Tingkat_Pendidikan, p.Nama_Instansi, p.Jurusan, p.Nomor_Ijazah, p.Tanggal_Ijazah, p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan, p.Pegawai_ID_Pegawai 
			FROM pendidikan p, tingkat_pendidikan tp
			WHERE p.Pegawai_ID_Pegawai=$id_pegawai AND p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan AND p.ID_Pendidikan=$id_pendidikan");
			return $db;
		}
		
		function getData($id)
		{
			$db =  $this->db->query("SELECT * FROM susunan_kepengurusan where ID_Susunan_Kepengurusan=$id ");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */