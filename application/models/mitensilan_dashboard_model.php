<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mitensilan_Dashboard_Model extends CI_Model {
	
	
	public function Get_Pelayanan_Yearly()
	{
		
		$sql = "SELECT EXTRACT(YEAR	FROM p.Tanggal_Laporan_Pelaksanaan) AS Tahun, COUNT(EXTRACT(YEAR FROM p.Tanggal_Laporan_Pelaksanaan)) AS Jumlah	FROM pelayanan p GROUP BY EXTRACT(YEAR FROM p.Tanggal_Laporan_Pelaksanaan)";
		return $this->db->query($sql);
		
	}
	
	
	public function Get_Performance_Pegawai()
	{
		
		$sql = "SELECT pgw.Nama_Pegawai, dalam.jumlah_pelayanan as Jumlah_Pelayanan FROM (SELECT php.Pegawai_ID_Pegawai, count(php.Pelayanan_ID_Pelayanan) as jumlah_pelayanan FROM pelayanan_has_pegawai php GROUP BY php.Pegawai_ID_Pegawai)dalam, pegawai pgw WHERE dalam.Pegawai_ID_Pegawai = pgw.ID_Pegawai ORDER BY pgw.Nama_Pegawai ";
		return $this->db->query($sql);
	}
	
	
}
