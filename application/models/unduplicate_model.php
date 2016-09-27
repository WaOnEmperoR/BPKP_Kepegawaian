<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Unduplicate_model extends CI_Model {
		
		/**
			* @author :
			* @keterangan : Model untuk menangani pemeringkatan kelulusan
		**/
		public function list_order()
		{
			$sql = "SELECT * FROM urut_duplicate"; 

			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}
		}
	
		function manualQuery($q)
		{
			return $this->db->query($q);
		}		
	}
	
	/* End of file app_model.php */
	/* Location: ./application/models/app_model.php */
