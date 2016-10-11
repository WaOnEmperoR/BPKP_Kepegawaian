<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Mitra_Model extends CI_Model {
		
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
			foreach($data as $key=>$val)
			{
			$this->db->set($key, $val);
			}
			//print_r($data);exit();
			//$this->db->insert($table,$data);
			$this->db->insert($table,$data);
		}
		
		function manualQuery($q)
		{
			return $this->db->query($q);
		}
		
		function get_all_mitra(){
			$db =  $this->db->query("SELECT a.*, b.Nama_Kategori from mitra a, kategori_mitra b where a.Kategori_Mitra_ID_Kategori_Mitra=b.ID_Kategori_Mitra"); 
			return $db->result_array();
		}

		function get_all_kategori_mitra(){
			$db =  $this->db->query("SELECT * from kategori_mitra"); 
			return $db->result_array();	
		}
		
		function getSelectedDataManual($id=0){
			$db =  $this->db->query("SELECT * from mitra where `ID Mitra`=$id"); 
			return $db->result();	
		}

		function insertDataManual($d=null){
			$q = "INSERT INTO mitra (Nama_Mitra, Alamat_Mitra, Kota, Provinsi, Bidang_Usaha, Deskripsi, Kategori_Mitra_ID_Kategori_Mitra) VALUES ('".$d['Nama_Mitra']."', '".$d['Alamat_Mitra']."', '".$d['Kota']."', '".$d['Provinsi']."', '".$d['Bidang_Usaha']."', '".$d['Deskripsi']."', '".$d['Kategori Mitra_ID_Kategori_Mitra']."')";
			$this->db->query($q);
			//exit();
			//print_r($d);exit();
			//$this->db->query("INSERT INTO mitra (Nama_Mitra, Alamat_Mitra, Kota, Provinsi, Bidang_Usaha, Deskripsi, 'Kategori Mitra_ID_Kategori_Mitra`) VALUES ('".$id['ID Mitra']."', '".$d[Nama_Mitra]."', '".$d[Alamat_Mitra]."', '".$d[Kota]."', '".$d[Provinsi]."', '".$d[Bidang_Usaha]."', '".$d[Deskripsi]."', '".$d["Kategori Mitra_ID_Kategori_Mitra"]."')";
		//$this->db->query("INSERT INTO mitra (Nama_Mitra, Alamat_Mitra, Kota, Provinsi, Bidang_Usaha, Deskripsi, 'Kategori Mitra_ID_Kategori_Mitra`) VALUES ('".$id['ID Mitra']."', '".$d['Nama_Mitra']."', '".$d['Alamat_Mitra']."', '".$d['Kota']."', '".$d['Provinsi']."', '".$d['Bidang_Usaha']."', '".$d['Deskripsi']."', '".$d['Kategori Mitra_ID_Kategori_Mitra']."')";
					
			//return $db->result();	
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */