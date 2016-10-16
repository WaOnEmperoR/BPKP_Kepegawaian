<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Petugas_Pelayanan_Model extends CI_Model {
		
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
		
		function get_all_pelayanan_mitra($id_mitra)
		{
			$db = $this->db->query("SELECT * FROM pelayanan WHERE Mitra_ID_Mitra = $id_mitra");
			return $db->result_array();
		}
		
		function get_pelayanan_penugasan($id_pelayanan)
		{
			$db = $this->db->query("select php.ID_Pelayanan_has_Pegawai, php.Pelayanan_ID_Pelayanan, pl.Nomor_Pelayanan, p.Nama_Pegawai, mp.Nama_Peran
			from pelayanan_has_pegawai php, pegawai p, master_peran mp, pelayanan pl
			where p.ID_Pegawai = php.Pegawai_ID_Pegawai AND mp.ID_Peran = php.Master_Peran_ID_Peran AND php.Pelayanan_ID_Pelayanan=pl.ID_Pelayanan
			AND pl.ID_Pelayanan = $id_pelayanan");	
			return $db->result_array();
		}
		
		function get_pegawai_autocomplete($nama_pegawai)
		{
			$str = "SELECT ID_Pegawai, Nama_Pegawai FROM pegawai WHERE upper(Nama_Pegawai) like concat('%', upper('".$nama_pegawai."'), '%') ORDER BY Nama_Pegawai";
			$db =  $this->db->query($str);
			return $db->result();
		}
		
		function get_jenis_peran()
		{
			$db = $this->db->query("SELECT ID_Peran, Nama_Peran FROM master_peran");
			return $db->result_array();
		}
		
		function getData($id)
		{
			$db =  $this->db->query("SELECT php.*, p.Nama_Pegawai FROM pelayanan_has_pegawai php, pegawai p where ID_Pelayanan_has_Pegawai=$id and p.ID_Pegawai = php.Pegawai_ID_Pegawai");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */