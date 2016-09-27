<?php
	set_time_limit(0); 
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
	class unduplicate extends CI_Controller {
		
		/**
			* @author : Caberawit
		* */
		public function __construct() {
			parent::__construct();
			$this->load->model('unduplicate_model');
			$this->load->database();
		}
		
		public function index()
		{
		
			if (is_admin() || is_operator_disdik()) 
			{	
				//Reguler Dalam Tangsel
				$data = $this->unduplicate_model->list_order();
				$walk = 0;
				$prev_name = "aloha snackbar";
				$repeat = 0;
				//echo(count($data));exit();
				
				foreach ($data as $val){
					echo($walk." - ".$val['id']." - ".$val['id_seleksi']." - ".$val['id_registrasi']." - ".$val['nama']." - ".$val['id_sekolah']."<br>");
					
					if ($prev_name!=$val['nama'])
					{
						$repeat = 1;
					}
					
					$str_sql = "UPDATE urut_duplicate SET no_urut = ".$repeat." WHERE id = ".$val['id'];
					echo($str_sql."<br>");
					$this->unduplicate_model->manualQuery($str_sql);
					
					$repeat = $repeat + 1;
					$prev_name = $val['nama'];
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