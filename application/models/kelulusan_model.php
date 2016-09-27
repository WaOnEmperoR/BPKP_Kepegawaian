<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Kelulusan_model extends CI_Model {
		
		/**
			* @author :
			* @keterangan : Model untuk menangani pemeringkatan kelulusan
		**/
		public function get_sisa_kuota_sekolah_reguler($id_sekolah) {
			$sql = SELECT counter_psb_reguler as kuota FROM tbl_psb where id_sekolah = $id_sekolah;
			$hasil = $this->db->query($sql);
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}	
		}
		
		public function get_sisa_kuota_sekolah_luar($id_sekolah) {
			$sql = SELECT counter_psb_luar as kuota FROM tbl_psb where id_sekolah = $id_sekolah;
			$hasil = $this->db->query($sql);
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}	
		}
		
		public function get_sisa_cadangan_sekolah_reguler($id_sekolah) {
			$sql = SELECT counter_cadangan_reguler as kuota_cad FROM tbl_psb where id_sekolah = $id_sekolah;
			$hasil = $this->db->query($sql);
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
				}	
		}
		
		public function get_sisa_cadangan_sekolah_luar($id_sekolah) {
			$sql = SELECT counter_cadangan_luar as kuota_cad FROM tbl_psb where id_sekolah = $id_sekolah;
			$hasil = $this->db->query($sql);
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}	
		}
		
		public function get_bobot_mapel($id_mapel)
		{
			$sql = SELECT bobot_mapel FROM tbl_mapel where id_mapel = $id_mapel;
			$hasil = $this->db->query($sql);
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
				} else {
				return array();
			}
		}
		
		public function update_weighted_nem()
		{
			$sql = 
			update tbl_ijazah set weighted_nem = (nilai_bhs * (select bobot_mapel from tbl_mapel where id_mapel=1)) + 
			(nilai_eng * (select bobot_mapel from tbl_mapel where id_mapel=2)) + 
			(nilai_mtk * (select bobot_mapel from tbl_mapel where id_mapel=3)) +
			(nilai_ipa * (select bobot_mapel from tbl_mapel where id_mapel=4));
			
			$hasil = $this->db->query($sql);
		}
		
		public function list_order($id_jalur)
		{
			if ($id_jalur == 4)
			{
				$sql = SELECT * FROM tbl_siap_assign_reguler order by ID ASC;
			}
			elseif ($id_jalur == 5)
			{
				$sql = SELECT * FROM tbl_siap_assign_luartangsel order by ID ASC;
			}
			
			//echo($sql);exit();
			
			$hasil = $this->db->query($sql);
			
			//echo($hasil->num_rows());exit();
			
			if($hasil->num_rows() > 0){
				return $hasil->result_array();
				} else {
				return array();
			}
		}
		
		public function fill_assigner_table($id_jalur)
		{
			//echo($id_jalur.--);
			if ($id_jalur == 4){
				$hapus = truncate table tbl_siap_assign_reguler;
				
				$sql = INSERT INTO	tbl_siap_assign_reguler
				(id_registrasi, nm_siswa, no_peserta_un, nem, nilai_bhs, nilai_eng, nilai_mtk, nilai_ipa, umur)   (
				SELECT
				DISTINCT treg.id_registrasi,
				treg.nm_siswa,
				treg.no_peserta_un,
				ti.nem,
				ti.nilai_bhs,
				ti.nilai_eng,
				ti.nilai_mtk,
				ti.nilai_ipa,
				(DATEDIFF(STR_TO_DATE('2016-07-01',
				'%Y-%m-%d'),
				treg.tgl_lahir_siswa)/365) AS umur  
				FROM
				tbl_seleksi tsel,
				tbl_ijazah ti,
				tbl_registrasi treg  
				WHERE
				tsel.id_registrasi = ti.id_registrasi 
				AND treg.id_registrasi = tsel.id_registrasi 
				AND tsel.id_jalur = $id_jalur 
				AND treg.stat_akhir = 6  
				ORDER BY
				ti.nem DESC,
				ti.nilai_mtk DESC,
				ti.nilai_ipa DESC,
				ti.nilai_bhs DESC,
				ti.nilai_eng DESC,
				pilihan ASC,
				umur DESC
				);
			}
			elseif ($id_jalur==5)
			{
				$hapus = truncate table tbl_siap_assign_luartangsel;
				
				$sql = INSERT INTO	tbl_siap_assign_luartangsel
				(id_registrasi, nm_siswa, no_peserta_un, nem, nilai_bhs, nilai_eng, nilai_mtk, nilai_ipa, umur)   (
				SELECT
				DISTINCT treg.id_registrasi,
				treg.nm_siswa,
				treg.no_peserta_un,
				ti.nem,
				ti.nilai_bhs,
				ti.nilai_eng,
				ti.nilai_mtk,
				ti.nilai_ipa,
				(DATEDIFF(STR_TO_DATE('2016-07-01',
				'%Y-%m-%d'),
				treg.tgl_lahir_siswa)/365) AS umur  
				FROM
				tbl_seleksi tsel,
				tbl_ijazah ti,
				tbl_registrasi treg  
				WHERE
				tsel.id_registrasi = ti.id_registrasi 
				AND treg.id_registrasi = tsel.id_registrasi 
				AND tsel.id_jalur = $id_jalur 
				AND treg.stat_akhir = 6  
				ORDER BY
				ti.nem DESC,
				ti.nilai_mtk DESC,
				ti.nilai_ipa DESC,
				ti.nilai_bhs DESC,
				ti.nilai_eng DESC,
				pilihan ASC,
				umur DESC
				);
			}
			//echo($id_jalur.--);
			//echo($sql);exit();
			$siap = $this->db->query($hapus);
			$hasil = $this->db->query($sql);
		}
		
		public function get_sekolah_pilihan($id_registrasi, $id_pilihan)
		{
			$sql = 
			select id_sekolah as idsek from tbl_seleksi tsel where id_registrasi = $id_registrasi and pilihan = $id_pilihan;
			;
			
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
