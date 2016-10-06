<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Reporting_Model extends CI_Model {
		
		/**
			* @author : Tim CA-BKN
			* @keterangan : Model untuk menangani semua query database aplikasi
		**/
		
		function manualQuery($q)
		{
			return $this->db->query($q);
		}
		
		function get_data_single_pegawai($id_pegawai)
		{
			$db =  $this->db->query("SELECT ID_Pegawai, Nama_Pegawai, NIK, NIP, Tempat_Lahir, DATE_FORMAT(Tanggal_Lahir, '%d %M %Y') AS Tanggal_Lahir, Alamat, 
			(CASE Jenis_Kelamin WHEN 'L' THEN 'Pria' WHEN 'P' THEN 'Wanita' ELSE '' END) AS Jenis_Kelamin,
			(CASE Agama WHEN 'I' THEN 'Islam' WHEN 'KK' THEN 'Kristen Katolik' WHEN 'KP' THEN 'Kristen Protestan'
			WHEN 'H' THEN 'Hindu' WHEN 'B' THEN 'Buddha' ELSE '' END) AS Agama
			FROM pegawai WHERE ID_Pegawai = $id_pegawai");
			return $db;
			//->result_array();
		}
		
		function get_pendidikan_pegawai($id_pegawai)
		{
			$db =  $this->db->query("SELECT p.ID_Pendidikan, tp.Nama_Tingkat_Pendidikan, p.Nama_Instansi, p.Jurusan, p.Nomor_Ijazah, DATE_FORMAT(p.Tanggal_Ijazah, '%d-%m-%Y') as Tanggal_Ijazah, p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan, p.Pegawai_ID_Pegawai 
			FROM pendidikan p, tingkat_pendidikan tp
			WHERE p.Pegawai_ID_Pegawai=$id_pegawai AND p.Tingkat_Pendidikan_ID_Tingkat_Pendidikan = tp.ID_Tingkat_Pendidikan");
			return $db->result_array();
		}
		
		function get_diklat_pegawai($id_pegawai)
		{
			$db =  $this->db->query("SELECT d.ID_Diklat, jd.Nama_Jenis_Diklat, d.Nama_Pelatihan, d.Lembaga_Penyelenggara, d.No_Sertifikat, DATE_FORMAT(d.Tanggal_Sertifikat, '%d-%m-%Y') AS Tanggal_Sertifikat, d.Jenis_Diklat_ID_Jenis_Diklat, d.Pegawai_ID_Pegawai
			FROM diklat d, jenis_diklat jd
			WHERE d.Pegawai_ID_Pegawai=$id_pegawai AND d.Jenis_Diklat_ID_Jenis_Diklat = jd.ID_Jenis_Diklat");
			return $db->result_array();
		}
		
		function get_sertifikasi_pegawai($id_pegawai)
		{
			$db =  $this->db->query("SELECT s.ID_Sertifikasi, js.Nama_Jenis_Sertifikasi, s.Nama_Sertifikasi, s.Lembaga_Penyelenggara, s.No_Sertifikat, DATE_FORMAT(s.Tanggal_Sertifikat, '%d-%m-%Y') AS Tanggal_Sertifikat, s.Jenis_Sertifikasi_ID_Jenis_Sertifikasi, s.Pegawai_ID_Pegawai
			FROM sertifikasi s, jenis_sertifikasi js
			WHERE s.Pegawai_ID_Pegawai=$id_pegawai AND s.Jenis_Sertifikasi_ID_Jenis_Sertifikasi = js.ID_Jenis_Sertifikasi");
			return $db->result_array();
		}
		
		function get_penugasan_pegawai($id_pegawai)
		{
			$db =  $this->db->query("SELECT pg.ID_Penugasan, pg.Objek_Penugasan, pg.Nama_Penugasan, m_pg.Nama_Jenis_Penugasan, m_pr.Nama_Peran, CONCAT(DATE_FORMAT(pg.Tanggal_Mulai_Penugasan, '%d-%m-%Y'),' - ', DATE_FORMAT(pg.Tanggal_Selesai_Penugasan, '%d-%m-%Y')) AS Periode, pg.Master_Peran_ID_Peran, pg.Master_Penugasan_ID_Jenis_Penugasan, pg.Pegawai_ID_Pegawai
			FROM master_peran m_pr, master_penugasan m_pg, penugasan pg
			WHERE pg.Pegawai_ID_Pegawai=$id_pegawai AND pg.Master_Peran_ID_Peran=m_pr.ID_Peran AND pg.Master_Penugasan_ID_Jenis_Penugasan=m_pg.ID_Jenis_Penugasan");
			return $db->result_array();
		}
		
		function get_list_pegawai_old($nama_pegawai)
		{
			$db =  $this->db->query("SELECT ID_Pegawai, Nama_Pegawai, NIK, NIP FROM pegawai WHERE upper(Nama_Pegawai) like concat('%', upper('$nama_pegawai'), '%') ORDER BY Nama_Pegawai ");
			return $db->result();
		}
		
		function get_list_pegawai()
		{
			$db =  $this->db->query("SELECT ID_Pegawai, Nama_Pegawai, NIK, NIP FROM pegawai ORDER BY Nama_Pegawai ");
			return $db->result();
		}
	}
	
	/* End of file lampiran_model.php */
/* Location: ./application/models/lampiran_model.php */