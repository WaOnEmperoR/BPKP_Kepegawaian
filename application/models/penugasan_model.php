<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Penugasan_Model extends CI_Model {
		
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
		
		function get_all_penugasan_pegawai($id_pegawai){
			$db =  $this->db->query("SELECT pg.ID_Penugasan, pg.Objek_Penugasan, pg.Nama_Penugasan, m_pg.Nama_Jenis_Penugasan, m_pr.Nama_Peran, DATE_FORMAT(pg.Tanggal_Mulai_Penugasan, '%d %M %Y') AS Tanggal_Mulai, DATE_FORMAT(pg.Tanggal_Selesai_Penugasan, '%d %M %Y') AS Tanggal_Selesai, pg.Master_Peran_ID_Peran, pg.Master_Penugasan_ID_Jenis_Penugasan, pg.Pegawai_ID_Pegawai
			FROM master_peran m_pr, master_penugasan m_pg, penugasan pg
			WHERE pg.Pegawai_ID_Pegawai=$id_pegawai AND pg.Master_Peran_ID_Peran=m_pr.ID_Peran AND pg.Master_Penugasan_ID_Jenis_Penugasan=m_pg.ID_Jenis_Penugasan");
			return $db->result_array();
		}
		
		function get_detail_penugasan_pegawai($id_pegawai, $id_penugasan){
			$db =  $this->db->query("SELECT pg.ID_Penugasan, pg.Objek_Penugasan, pg.Nama_Penugasan, m_pg.Nama_Jenis_Penugasan, m_pr.Nama_Peran, DATE_FORMAT(pg.Tanggal_Mulai_Penugasan, '%d %M %Y') AS Tanggal_Mulai_Penugasan, DATE_FORMAT(pg.Tanggal_Selesai_Penugasan, '%d %M %Y') AS Tanggal_Selesai_Penugasan, pg.Master_Peran_ID_Peran, pg.Master_Penugasan_ID_Jenis_Penugasan, pg.Pegawai_ID_Pegawai
			FROM master_peran m_pr, master_penugasan m_pg, penugasan pg
			WHERE pg.Pegawai_ID_Pegawai=$id_pegawai AND pg.Master_Peran_ID_Peran=m_pr.ID_Peran AND pg.Master_Penugasan_ID_Jenis_Penugasan=m_pg.ID_Jenis_Penugasan AND pg.ID_Penugasan=$id_penugasan");
			return $db;
		}
		
		function get_jenis_peran()
		{
			$db =  $this->db->query("SELECT * FROM master_peran ");
			return $db->result_array();
		}
		
		function get_jenis_penugasan()
		{
			$db =  $this->db->query("SELECT * FROM master_penugasan ");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */