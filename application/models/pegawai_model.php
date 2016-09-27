<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Pegawai_Model extends CI_Model {
		
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
			echo("Maukemana<br/>");
			//print_r($data);exit();
			$this->db->insert($table,$data);
		}
		
		function manualQuery($q)
		{
			return $this->db->query($q);
		}
		
		function get_all_pegawai(){
			$db =  $this->db->query("SELECT ID_Pegawai, Nama_Pegawai, NIK, NIP, Tempat_Lahir, DATE_FORMAT(Tanggal_Lahir, '%d %M %Y') AS Tanggal_Lahir, Alamat, 
			(CASE Jenis_Kelamin WHEN 'L' THEN 'Pria' WHEN 'P' THEN 'Wanita' ELSE '' END) AS Jenis_Kelamin,
			(CASE Agama WHEN 'I' THEN 'Islam' WHEN 'KK' THEN 'Kristen Katolik' WHEN 'KP' THEN 'Kristen Protestan'
			WHEN 'H' THEN 'Hindu' WHEN 'B' THEN 'Buddha' ELSE '' END) AS Agama
			FROM pegawai ");
			return $db->result_array();
		}
		
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */