<?php
	set_time_limit(0); 
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class kelulusan extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('kelulusan_model');
			$this->load->database();
		}
		
		public function index() {
			if (is_admin() || is_operator_disdik()) 
			{
			}
			else
			{
				echo("Get Away From Here");
			}
		}
		
		public function reset_seleksi($id_jalur)
		{
			//Persiapan, reset status di tabel seleksi dan registrasi
			$res_01 = "UPDATE tbl_seleksi SET stat_lulus = 0 WHERE id_jalur = $id_jalur";
			
			if ($id_jalur==4)
			{
				$res_02 = "UPDATE tbl_registrasi SET stat_akhir = 6 WHERE stat_akhir = 7 and id_registrasi in (select distinct id_registrasi from tbl_seleksi where id_jalur = 4)";
				$res_03 = "UPDATE tbl_psb SET counter_psb_reguler = kuota_psb_reguler";
				$res_04 = "UPDATE tbl_psb SET counter_cadangan_reguler = kuota_cadangan_reguler";
			}
			elseif ($id_jalur==5)
			{
				$res_02 = "UPDATE tbl_registrasi SET stat_akhir = 6 WHERE stat_akhir = 7 and id_registrasi in (select distinct id_registrasi from tbl_seleksi where id_jalur = 5)";
				$res_03 = "UPDATE tbl_psb SET counter_psb_luar = kuota_psb_luar";
				$res_04 = "UPDATE tbl_psb SET counter_cadangan_luar = kuota_cadangan_luar";
			}
					
			$this->kelulusan_model->manualQuery($res_01);
			$this->kelulusan_model->manualQuery($res_02);
			$this->kelulusan_model->manualQuery($res_03);
			$this->kelulusan_model->manualQuery($res_04);
		}
		
		public function fill_table($id_jalur)
		{
			$this->kelulusan_model->fill_assigner_table($id_jalur);
		}
		
		public function reguler()
		{
		
			if (is_admin() || is_operator_disdik()) 
			{	
				//Reguler Dalam Tangsel
				$data = $this->kelulusan_model->list_order(4);
				$walk = 1;
				
				//echo(count($data));exit();
				
				foreach ($data as $val){
					echo($walk." - ".$val['id_registrasi']." - ".$val['nm_siswa']." - ".$val['nem']."<br>");
					
					$pilihan1 = 0;
					$pilihan2 = 0;
					
					$assign_cadangan = 0;
					
					//pilihan pertama
					$cek_01 = $this->kelulusan_model->get_sekolah_pilihan($val['id_registrasi'], 1);
					foreach ($cek_01 as $mypil)
					{
						$pilihan1 = $mypil['idsek'];
					}
					
					//pilihan kedua
					$cek_02 = $this->kelulusan_model->get_sekolah_pilihan($val['id_registrasi'], 2);
					foreach ($cek_02 as $mypil)
					{
						$pilihan2 = $mypil['idsek'];
					}
					
					echo("---> Pilihan 1 : ".$pilihan1." - Pilihan 2 : ".$pilihan2."<br>");
					
					$sisa_kuota_pilihan_1 = 0;
					$sisa_kuota_pilihan_2 = 0;
					
					//sisa kuota 1
					$cek_03 = $this->kelulusan_model->get_sisa_kuota_sekolah_reguler($pilihan1);
					foreach ($cek_03 as $mypil_a)
					{
						$sisa_kuota_pilihan_1 = $mypil_a['kuota'];
					}
					
					//sisa kuota 2
					$cek_04 = $this->kelulusan_model->get_sisa_kuota_sekolah_reguler($pilihan2);
					foreach ($cek_04 as $mypil_b)
					{
						$sisa_kuota_pilihan_2 = $mypil_b['kuota'];
					}
					
					$sisa_cadangan_pilihan_1 = 0;
					$sisa_cadangan_pilihan_2 = 0;
										
					//sisa cadangan 1
					$cek_05 = $this->kelulusan_model->get_sisa_cadangan_sekolah_reguler($pilihan1);
					foreach ($cek_05 as $mypil_c)
					{
						$sisa_cadangan_pilihan_1 = $mypil_c['kuota_cad'];
					}
					
					//sisa cadangan 2
					$cek_06 = $this->kelulusan_model->get_sisa_cadangan_sekolah_reguler($pilihan2);
					foreach ($cek_06 as $mypil_d)
					{
						$sisa_cadangan_pilihan_2 = $mypil_d['kuota_cad'];
					}
					
					echo("---> Sisa Kuota 1 : ".$sisa_kuota_pilihan_1." - Sisa Kuota 2 : ".$sisa_kuota_pilihan_2."<br>");
					echo("+++> Sisa Cadangan 1 : ".$sisa_cadangan_pilihan_1." - Sisa Cadangan 2 : ".$sisa_cadangan_pilihan_2."<br>");
					
					if ($sisa_kuota_pilihan_1>0)
					{
						echo("*************Anda diterima di pilihan 1<br>");
						//Anda diterima di pilihan 1
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 1 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_psb_reguler = counter_psb_reguler-1 WHERE id_sekolah = ".$pilihan1;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
												
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					elseif ($sisa_kuota_pilihan_2>0)
					{
						echo("*************Anda diterima di pilihan 2<br>");
						//Anda diterima di pilihan 2
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 1 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_psb_reguler = counter_psb_reguler-1 WHERE id_sekolah = ".$pilihan2;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					elseif ($sisa_cadangan_pilihan_1>0)
					{
						echo("*************Anda diterima sebagai cadangan di pilihan 1<br>");
						//Anda diterima di pilihan 1 cadangan
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 3 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_cadangan_reguler = counter_cadangan_reguler-1 WHERE id_sekolah = ".$pilihan1;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
						
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					elseif ($sisa_cadangan_pilihan_2>0)
					{
						echo("*************Anda diterima sebagai cadangan di pilihan 2<br>");
						//Anda diterima di pilihan 2 cadangan
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 3 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_cadangan_reguler = counter_cadangan_reguler-1 WHERE id_sekolah = ".$pilihan2;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					else
					{
						echo("*************Mohon maaf Anda tidak diterima dimanapun<br>");
					}
					
					$walk=$walk+1;
				}
			}
			else
			{
				echo("Get Away From Here");
			}
		}
		
		public function luartangsel()
		{
			if (is_admin() || is_operator_disdik()) 
			{	
				//Reguler Dalam Tangsel
				$data = $this->kelulusan_model->list_order(5);
				$walk = 1;
				
				foreach ($data as $val){
					echo($walk." - ".$val['id_registrasi']." - ".$val['nm_siswa']." - ".$val['nem']."<br>");
					
					$pilihan1 = 0;
					$pilihan2 = 0;
					
					$assign_cadangan = 0;
					
					//pilihan pertama
					$cek_01 = $this->kelulusan_model->get_sekolah_pilihan($val['id_registrasi'], 1);
					foreach ($cek_01 as $mypil)
					{
						$pilihan1 = $mypil['idsek'];
					}
					
					//pilihan kedua
					$cek_02 = $this->kelulusan_model->get_sekolah_pilihan($val['id_registrasi'], 2);
					foreach ($cek_02 as $mypil)
					{
						$pilihan2 = $mypil['idsek'];
					}
					
					echo("---> Pilihan 1 : ".$pilihan1." - Pilihan 2 : ".$pilihan2."<br>");
					
					$sisa_kuota_pilihan_1 = 0;
					$sisa_kuota_pilihan_2 = 0;
					
					//sisa kuota 1
					$cek_03 = $this->kelulusan_model->get_sisa_kuota_sekolah_luar($pilihan1);
					foreach ($cek_03 as $mypil_a)
					{
						$sisa_kuota_pilihan_1 = $mypil_a['kuota'];
					}
					
					//sisa kuota 2
					$cek_04 = $this->kelulusan_model->get_sisa_kuota_sekolah_luar($pilihan2);
					foreach ($cek_04 as $mypil_b)
					{
						$sisa_kuota_pilihan_2 = $mypil_b['kuota'];
					}
					
					$sisa_cadangan_pilihan_1 = 0;
					$sisa_cadangan_pilihan_2 = 0;
										
					//sisa cadangan 1
					$cek_05 = $this->kelulusan_model->get_sisa_cadangan_sekolah_luar($pilihan1);
					foreach ($cek_05 as $mypil_c)
					{
						$sisa_cadangan_pilihan_1 = $mypil_c['kuota_cad'];
					}
					
					//sisa cadangan 2
					$cek_06 = $this->kelulusan_model->get_sisa_cadangan_sekolah_luar($pilihan2);
					foreach ($cek_06 as $mypil_d)
					{
						$sisa_cadangan_pilihan_2 = $mypil_d['kuota_cad'];
					}
					
					echo("---> Sisa Kuota 1 : ".$sisa_kuota_pilihan_1." - Sisa Kuota 2 : ".$sisa_kuota_pilihan_2."<br>");
					echo("+++> Sisa Cadangan 1 : ".$sisa_cadangan_pilihan_1." - Sisa Cadangan 2 : ".$sisa_cadangan_pilihan_2."<br>");
					
					if ($sisa_kuota_pilihan_1>0)
					{
						echo("*************Anda diterima di pilihan 1<br>");
						//Anda diterima di pilihan 1
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 1 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_psb_luar = counter_psb_luar-1 WHERE id_sekolah = ".$pilihan1;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
												
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					elseif ($sisa_kuota_pilihan_2>0)
					{
						echo("*************Anda diterima di pilihan 2<br>");
						//Anda diterima di pilihan 2
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 1 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_psb_luar = counter_psb_luar-1 WHERE id_sekolah = ".$pilihan2;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					elseif ($sisa_cadangan_pilihan_1>0)
					{
						echo("*************Anda diterima sebagai cadangan di pilihan 1<br>");
						//Anda diterima di pilihan 1 cadangan
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 3 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_cadangan_luar = counter_cadangan_luar-1 WHERE id_sekolah = ".$pilihan1;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
						
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					elseif ($sisa_cadangan_pilihan_2>0)
					{
						echo("*************Anda diterima sebagai cadangan di pilihan 2<br>");
						//Anda diterima di pilihan 2 cadangan
						$up_01 = "UPDATE tbl_seleksi SET stat_lulus = 3 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 2";
						$up_02 = "UPDATE tbl_registrasi SET stat_akhir = 7 WHERE id_registrasi = ".$val['id_registrasi'];
						$up_03 = "UPDATE tbl_psb SET counter_cadangan_luar = counter_cadangan_luar-1 WHERE id_sekolah = ".$pilihan2;
						$up_04 = "UPDATE tbl_seleksi SET stat_lulus = 2 WHERE id_registrasi = ".$val['id_registrasi']." and pilihan = 1";
						
						$this->kelulusan_model->manualQuery($up_01);
						$this->kelulusan_model->manualQuery($up_02);
						$this->kelulusan_model->manualQuery($up_03);
						$this->kelulusan_model->manualQuery($up_04);
					}
					else
					{
						echo("*************Mohon maaf Anda tidak diterima dimanapun<br>");
					}
					
					$walk=$walk+1;
				}
			}
			else
			{
				echo("Get Away From Here");
			}
			
		}
		
		/* End of file sk_belum.php */
		/* Location: ./application/controllers/sk_belum.php */
	}		