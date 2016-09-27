<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	if ( ! function_exists('is_admin'))
	{
		function is_admin()
		{
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='1'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_operator_disdik'))
	{
		function is_operator_disdik()
		{       
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='2'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_operator_sekolah'))
	{
		function is_operator_sekolah()
		{
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='3'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_siswa'))
	{
		function is_siswa()
		{
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='4'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_eksekutif'))
	{
		function is_eksekutif()
		{
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='5'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_kepala_sekolah'))
	{
		function is_kepala_sekolah()
		{
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='6'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_operator_un'))
	{
		function is_operator_un()
		{       
			$ci=& get_instance();
			if(!empty($ci->session->userdata('level'))){
				if($ci->session->userdata('level')=='7'){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
	
	if ( ! function_exists('is_current_user'))
	{
		function is_current_user($id)
		{       
			$ci=& get_instance();
			if(!empty($ci->session->userdata('id_pengguna'))){
				if($ci->session->userdata('id_pengguna')==$id){
					return true;
                    }else{
					return false;
				}
                }else{
				return false;
			}
		}
	}
