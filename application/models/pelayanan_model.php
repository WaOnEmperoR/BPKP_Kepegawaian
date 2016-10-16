<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Pelayanan_Model extends CI_Model {
		
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
		
		function get_all_pelayanan()
		{
			$db = $this->db->query("select p.ID_Pelayanan, p.Nomor_Pelayanan, p.Judul_Pelayanan, DATE_FORMAT(p.Tanggal_Mulai, '%d %M %Y') as Tanggal_Mulai, DATE_FORMAT(p.Tanggal_Selesai, '%d %M %Y') as Tanggal_Selesai, DATE_FORMAT(p.Tanggal_Laporan_Pelaksanaan, '%d %M %Y') as Tanggal_Laporan_Pelaksanaan, p.Biaya, p.Jenis_Layanan_ID_Jenis_Layanan, p.Mitra_ID_Mitra, m.Nama_Mitra, jl.Kategori_Layanan
			from pelayanan p, mitra m, jenis_layanan jl
			where p.Mitra_ID_Mitra = m.ID_Mitra and p.Jenis_Layanan_ID_Jenis_Layanan = jl.ID_Jenis_Layanan");
			return $db->result_array();
		}
		
		function get_mitra_autocomplete($nama_mitra)
		{
			$db =  $this->db->query("SELECT ID_Mitra, Nama_Mitra FROM mitra WHERE upper(Nama_Mitra) like concat('%', upper('$nama_mitra'), '%') ORDER BY Nama_Mitra");
			return $db->result();
		}
		
		function get_jenis_layanan()
		{
			$db = $this->db->query("SELECT ID_Jenis_Layanan, Kategori_Layanan FROM jenis_layanan");
			return $db->result_array();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */