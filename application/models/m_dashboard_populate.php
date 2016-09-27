<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class M_dashboard_populate extends CI_Model {
		
		public function get_peserta_by_gender() {
			$sql = "SELECT
			(CASE dalam.jk
			WHEN 1 THEN 'Laki-Laki'
			WHEN 2 THEN 'Perempuan'
			END) AS jenis_kelamin,
			dalam.hasil AS hasil
			FROM (SELECT
			jk,
			COUNT(jk) AS hasil
			FROM tbl_registrasi
			GROUP BY jk) dalam ";
			$hasil = $this->db->query($sql);
			//print_r ($this->db->last_query());
			//print_r($hasil->result());
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
		}
		
		public function top10_tampung_reguler() {
			$sql = "SELECT ts.nm_sekolah, tp.nm_psb, tp.kuota_psb_reguler
			FROM tbl_psb tp, tbl_sekolah ts
			WHERE ts.id_sekolah = tp.id_sekolah
			ORDER BY tp.kuota_psb_reguler desc
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			//print_r($hasil->result_array());exit();
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}	
		}
		
		public function top10_tampung_lokal() {
			$sql = "SELECT ts.nm_sekolah, tp.nm_psb, tp.kuota_psb_lokal
			FROM tbl_psb tp, tbl_sekolah ts
			WHERE ts.id_sekolah = tp.id_sekolah
			ORDER BY tp.kuota_psb_lokal desc
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}	
		}
		
		public function top10_tampung_luar() {
			$sql = "SELECT ts.nm_sekolah, tp.nm_psb, tp.kuota_psb_luar
			FROM tbl_psb tp, tbl_sekolah ts
			WHERE ts.id_sekolah = tp.id_sekolah
			ORDER BY tp.kuota_psb_luar desc
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}	
		}
		
		public function top5_sekolah_favorit($id_jenjang){
			$sql = "SELECT tsek.nm_sekolah, count(tsel.id_sekolah) as jumlah
			FROM tbl_seleksi tsel, tbl_sekolah tsek
			WHERE tsel.id_sekolah = tsek.id_sekolah AND tsek.id_jenjang = ".$id_jenjang." 
			GROUP BY tsek.nm_sekolah
			ORDER BY jumlah desc
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
		}
		
		public function top5_sekolah_least_favourite($id_jenjang){
			$sql = "SELECT tsek.nm_sekolah, count(tsel.id_sekolah) as jumlah
			FROM tbl_seleksi tsel, tbl_sekolah tsek
			WHERE tsel.id_sekolah = tsek.id_sekolah AND tsek.id_jenjang = ".$id_jenjang." 
			GROUP BY tsek.nm_sekolah
			ORDER BY jumlah asc
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
		}
		
		public function top5_rata2_nem($id_jenjang)
		{
			$sql = "SELECT nest1.nm_sekolah, AVG(nest1.nem) AS rata2_nem
			FROM
			(
			SELECT dalam.nm_siswa, dalam.nm_psb, dalam.nm_sekolah, ti.nem, dalam.id_seleksi
			FROM tbl_ijazah ti,
			(
			SELECT treg.id_registrasi, treg.nm_siswa, tp.nm_psb, treg.no_peserta_un, tsek.nm_sekolah, tsel.id_seleksi
			FROM
			tbl_seleksi tsel, tbl_registrasi treg, tbl_psb tp, tbl_sekolah tsek
			WHERE
			treg.id_registrasi = tsel.id_registrasi AND tp.id_psb = tsel.id_psb AND 
			tsek.id_sekolah = tsel.id_sekolah AND tsek.id_jenjang = ".$id_jenjang." 
			)dalam
			WHERE dalam.id_registrasi = ti.id_registrasi 
			)nest1
			GROUP BY nest1.nm_psb
			ORDER BY AVG(nest1.nem) DESC
			LIMIT 5";
			
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
			
		}
		
		public function top5_max_nem($id_jenjang)
		{
			$sql = "SELECT nest1.nm_sekolah, MAX(nest1.nem) AS max_nem
			FROM
			(
			SELECT dalam.nm_siswa, dalam.nm_psb, dalam.nm_sekolah, ti.nem, dalam.id_seleksi
			FROM tbl_ijazah ti,
			(
			SELECT treg.id_registrasi, treg.nm_siswa, tp.nm_psb, treg.no_peserta_un, tsek.nm_sekolah, tsel.id_seleksi
			FROM
			tbl_seleksi tsel, tbl_registrasi treg, tbl_psb tp, tbl_sekolah tsek
			WHERE
			treg.id_registrasi = tsel.id_registrasi AND tp.id_psb = tsel.id_psb AND 
			tsek.id_sekolah = tsel.id_sekolah AND tsek.id_jenjang = ".$id_jenjang." 
			)dalam
			WHERE dalam.id_registrasi = ti.id_registrasi 
			)nest1
			GROUP BY nest1.nm_psb
			ORDER BY MAX(nest1.nem) DESC
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
			
		}
		
		public function top5_min_nem($id_jenjang)
		{
			$sql = "SELECT nest1.nm_sekolah, MIN(nest1.nem) AS min_nem
			FROM
			(
			SELECT dalam.nm_siswa, dalam.nm_psb, dalam.nm_sekolah, ti.nem, dalam.id_seleksi
			FROM tbl_ijazah ti,
			(
			SELECT treg.id_registrasi, treg.nm_siswa, tp.nm_psb, treg.no_peserta_un, tsek.nm_sekolah, tsel.id_seleksi
			FROM
			tbl_seleksi tsel, tbl_registrasi treg, tbl_psb tp, tbl_sekolah tsek
			WHERE
			treg.id_registrasi = tsel.id_registrasi AND tp.id_psb = tsel.id_psb AND 
			tsek.id_sekolah = tsel.id_sekolah AND tsek.id_jenjang = ".$id_jenjang." 
			)dalam
			WHERE dalam.id_registrasi = ti.id_registrasi 
			)nest1
			GROUP BY nest1.nm_psb
			ORDER BY MIN(nest1.nem) ASC
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
			
		}
		
		public function top5_nem_sekolah($id_sekolah, $id_jalur)
		{
			$sql = "SELECT dalam.nm_siswa, ti.nem
			FROM tbl_ijazah ti,
			(
			SELECT treg.id_registrasi, treg.nm_siswa, tp.nm_psb, treg.no_peserta_un, tsek.nm_sekolah, tsel.id_seleksi
			FROM
			tbl_seleksi tsel, tbl_registrasi treg, tbl_psb tp, tbl_sekolah tsek
			WHERE
			treg.id_registrasi = tsel.id_registrasi AND tp.id_psb = tsel.id_psb AND 
			tsek.id_sekolah = tsel.id_sekolah AND tsek.id_sekolah = ".$id_sekolah." AND tsel.id_jalur = ".$id_jalur."
			)dalam
			WHERE dalam.id_registrasi = ti.id_registrasi 
			ORDER BY ti.nem DESC
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
		}
		
		public function low5_nem_sekolah($id_sekolah, $id_jalur)
		{
			$sql = "SELECT dalam.nm_siswa, ti.nem
			FROM tbl_ijazah ti,
			(
			SELECT treg.id_registrasi, treg.nm_siswa, tp.nm_psb, treg.no_peserta_un, tsek.nm_sekolah, tsel.id_seleksi
			FROM
			tbl_seleksi tsel, tbl_registrasi treg, tbl_psb tp, tbl_sekolah tsek
			WHERE
			treg.id_registrasi = tsel.id_registrasi AND tp.id_psb = tsel.id_psb AND 
			tsek.id_sekolah = tsel.id_sekolah AND tsek.id_sekolah = ".$id_sekolah." AND tsel.id_jalur = ".$id_jalur."
			)dalam
			WHERE dalam.id_registrasi = ti.id_registrasi 
			ORDER BY ti.nem ASC
			LIMIT 5";
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
		}
		
		public function persentase_gender($id_sekolah)
		{
			if ($id_sekolah == ""){
				$sql = "SELECT
				(CASE dalam.jk WHEN 1 THEN 'Laki-Laki' WHEN 2 THEN 'Perempuan' ELSE 'Tidak Diketahui' END) AS jenis_kelamin,
				dalam.hasil AS hasil
				FROM (
				SELECT
				jk, COUNT(jk) AS hasil
				FROM tbl_registrasi
				GROUP BY jk) dalam";
			}
			else
			{
				$sql = "SELECT (CASE dalam.jk WHEN 1 THEN 'Laki-Laki' WHEN 2 THEN 'Perempuan' ELSE 'Tidak Diketahui' END) AS jenis_kelamin, dalam.hasil AS hasil
				FROM 
				(
				SELECT treg.jk, COUNT(treg.jk) AS hasil
				FROM tbl_registrasi treg, tbl_sekolah tsek, tbl_seleksi tsel
				WHERE tsel.id_registrasi = treg.id_registrasi AND tsek.id_sekolah = ".$id_sekolah." AND tsek.id_sekolah = tsel.id_sekolah
				GROUP BY tsek.id_sekolah, treg.jk)dalam";
			}
			
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
			
		}
		
		public function grouping_by_usia($id_sekolah)
		{
			if ($id_sekolah == ""){
				$sql = "SELECT FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), tgl_lahir_siswa)/365) AS umur, COUNT(FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), tgl_lahir_siswa)/365)) AS jumlah
				FROM tbl_registrasi
				GROUP BY FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), tgl_lahir_siswa)/365)
				ORDER BY FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), tgl_lahir_siswa)/365) ASC
				";
			}
			else{
				$sql = "SELECT FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), treg.tgl_lahir_siswa)/365) AS umur, COUNT(FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), treg.tgl_lahir_siswa)/365)) AS jumlah
				FROM tbl_registrasi treg, tbl_sekolah tsek, tbl_seleksi tsel
				WHERE treg.id_registrasi = tsel.id_registrasi AND tsel.id_sekolah = tsek.id_sekolah AND tsek.id_sekolah = ".$id_sekolah."
				GROUP BY FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), treg.tgl_lahir_siswa)/365)
				ORDER BY FLOOR(DATEDIFF(STR_TO_DATE('2016-07-01', '%Y-%m-%d'), treg.tgl_lahir_siswa)/365) ASC";
			}
			
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result();
				} else {
				return array();
			}	
			
		}
		
		public function pendaftar_per_sekolah($id_sekolah, $id_jalur)
		{
			//echo("identitas ". $id_identitas);exit();
			if ($id_sekolah == "")
			{
				$sql = "
				SELECT @rn:=@rn+1 AS rank, t1.nm_siswa, t1.no_peserta_un, t1.nem
				FROM
				(
				SELECT ti.no_ijazah, treg.id_registrasi, treg.nm_siswa, treg.no_peserta_un, ti.nilai_bhs, ti.nilai_eng, ti.nilai_mtk, ti.nilai_ipa, ti.nem,
				tsek.nm_sekolah, tsel.id_seleksi, tsel.id_jalur, tsel.pilihan
				FROM
				tbl_seleksi tsel, tbl_sekolah tsek, tbl_registrasi treg, tbl_ijazah ti
				WHERE 
				treg.id_registrasi = tsel.id_registrasi AND tsek.id_sekolah = tsel.id_sekolah AND 
				ti.id_registrasi = treg.id_registrasi AND tsel.id_jalur=4
				ORDER BY tsek.nm_sekolah ASC, ti.nem DESC
				)t1, (
				SELECT @rn:=0) t2		
				";
			}
			elseif ($id_jalur!=100)
			{
				$sql = "
				SELECT @rn:=@rn+1 AS rank, t1.nm_siswa, t1.no_peserta_un, t1.nem
				FROM
				(
				SELECT ti.no_ijazah, treg.id_registrasi, treg.nm_siswa, treg.no_peserta_un, ti.nilai_bhs, ti.nilai_eng, ti.nilai_mtk, ti.nilai_ipa, ti.nem,
				tsek.nm_sekolah, tsel.id_seleksi, tsel.id_jalur, tsel.pilihan
				FROM
				tbl_seleksi tsel, tbl_sekolah tsek, tbl_registrasi treg, tbl_ijazah ti
				WHERE 
				treg.id_registrasi = tsel.id_registrasi AND tsek.id_sekolah = tsel.id_sekolah AND tsel.id_jalur=".$id_jalur." AND
				ti.id_registrasi = treg.id_registrasi AND tsek.id_sekolah = ".$id_sekolah."
				ORDER BY ti.nem DESC
				)t1, (
				SELECT @rn:=0) t2		
				";
			}
			elseif ($id_jalur==100)
			{
				$sql = "
				SELECT @rn:=@rn+1 AS rank, t1.nm_siswa, t1.no_peserta_un
				FROM
				(
				SELECT ti.no_ijazah, treg.id_registrasi, treg.nm_siswa, treg.no_peserta_un, ti.nilai_bhs, ti.nilai_eng, ti.nilai_mtk, ti.nilai_ipa, ti.nem,
				tsek.nm_sekolah, tsel.id_seleksi, tsel.id_jalur, tsel.pilihan
				FROM
				tbl_seleksi tsel, tbl_sekolah tsek, tbl_registrasi treg, tbl_ijazah ti
				WHERE 
				treg.id_registrasi = tsel.id_registrasi AND tsek.id_sekolah = tsel.id_sekolah AND tsel.id_jalur in (1,2,3) AND
				ti.id_registrasi = treg.id_registrasi AND tsek.id_sekolah = ".$id_sekolah." 
				ORDER BY ti.no_ijazah ASC
				)t1, (
				SELECT @rn:=0) t2		
				";
			}
			
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}
			
		}
		
		public function get_passed_psb_reguler($id_sekolah)
		{
			$sql = "SELECT tab3.*
			FROM
			(
			SELECT @rn:=@rn+1 AS rank, t1.no_ijazah, t1.nm_siswa, t1.no_peserta_un, t1.nem
			FROM
			(
			SELECT ti.no_ijazah, treg.id_registrasi, treg.nm_siswa, treg.no_peserta_un, ti.nilai_bhs, ti.nilai_eng, ti.nilai_mtk, ti.nilai_ipa, ti.nem,
			tsek.nm_sekolah, tsel.id_seleksi, tsel.id_jalur, tsel.pilihan
			FROM
			tbl_seleksi tsel, tbl_sekolah tsek, tbl_registrasi treg, tbl_ijazah ti
			WHERE 
			treg.id_registrasi = tsel.id_registrasi AND tsek.id_sekolah = tsel.id_sekolah AND 
			ti.id_registrasi = treg.id_registrasi AND tsek.id_sekolah = ".$id_sekolah." and
			tsel.id_jalur = 4 
			ORDER BY ti.nem DESC
			)t1, (
			SELECT @rn:=0) t2
			)tab3
			WHERE tab3.rank <= (select kuota_psb_reguler from tbl_psb where id_sekolah = ".$id_sekolah.")";	
			
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}
		}
		
		public function get_passed_psb_luarTangsel($id_sekolah)
		{
			$sql = "SELECT tab3.*
			FROM
			(
			SELECT @rn:=@rn+1 AS rank, t1.no_ijazah, t1.nm_siswa, t1.no_peserta_un, t1.nem
			FROM
			(
			SELECT ti.no_ijazah, treg.id_registrasi, treg.nm_siswa, treg.no_peserta_un, ti.nilai_bhs, ti.nilai_eng, ti.nilai_mtk, ti.nilai_ipa, ti.nem,
			tsek.nm_sekolah, tsel.id_seleksi, tsel.id_jalur, tsel.pilihan
			FROM
			tbl_seleksi tsel, tbl_sekolah tsek, tbl_registrasi treg, tbl_ijazah ti
			WHERE 
			treg.id_registrasi = tsel.id_registrasi AND tsek.id_sekolah = tsel.id_sekolah AND 
			ti.id_registrasi = treg.id_registrasi AND tsek.id_sekolah = ".$id_sekolah." and
			tsel.id_jalur = 5
			ORDER BY ti.nem DESC
			)t1, (
			SELECT @rn:=0) t2
			)tab3
			WHERE tab3.rank <= (select kuota_psb_reguler from tbl_psb where id_sekolah = ".$id_sekolah.")";	
			
			$hasil = $this->db->query($sql);
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}
		}
		
		public function get_IDSekolah()
		{
			$id_sekolah = "";
			
			$iduser = $this->session->userdata('id_pengguna');
			
			//echo ("ID_User : ". $iduser ." isadmin ".is_admin()." is disdik ".is_operator_disdik(). "---");
			
			if(!is_admin() && !is_operator_disdik()){
				$id_sekolah = $this->session->userdata('id_kantor');
				//echo("Msuk sini");
			}
			
			return $id_sekolah;
		}
		
		public function get_NamaSekolah($id_sekolah)
		{
			$sql = "select tp.nm_sekolah from tbl_sekolah tp where tp.id_sekolah= ".$id_sekolah;
			
			$hasil = $this->db->query($sql);
			$res = $hasil->result_array();
			
			$my_name = "";
			
			foreach ($res as $row)
			{
				$my_name = $row['nm_sekolah'];	
			}
			
			//echo ($my_name);
			return $my_name;
		}
		
		public function progress_pengguna($id_progress, $id_sekolah)
		{
			if ($id_sekolah == "")
			{
				$sql = "select count(*) as hasil from tbl_registrasi where stat_akhir = ".$id_progress ;
			}
			else
			{
				$sql = "select count(treg.id_registrasi) as hasil
				from tbl_registrasi treg, tbl_seleksi tsel
				where treg.id_registrasi = tsel.id_registrasi and tsel.id_sekolah = ".$id_sekolah." and treg.stat_akhir=".$id_progress;
			}
			
			$hasil = $this->db->query($sql);
			$res = $hasil->result_array();
			
			$jumlah = "";
			
			foreach ($res as $row)
			{
				$jumlah = $row['hasil'];	
			}
			
			return $jumlah;
		}
		
		
		
	}																					