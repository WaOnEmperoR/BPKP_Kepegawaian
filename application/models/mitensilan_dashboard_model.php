<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Mitensilan_Dashboard_Model extends CI_Model {
		
		public function Get_Pelayanan_Yearly()
		{
			$sql = "SELECT EXTRACT(YEAR
			FROM p.Tanggal_Laporan_Pelaksanaan) AS Tahun, COUNT(EXTRACT(YEAR
			FROM p.Tanggal_Laporan_Pelaksanaan)) AS Jumlah
			FROM pelayanan p
			GROUP BY EXTRACT(YEAR
			FROM p.Tanggal_Laporan_Pelaksanaan)";
			
			return $this->db->query($sql);
		}
		
	}																						