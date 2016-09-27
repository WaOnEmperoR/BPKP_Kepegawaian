<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_status_lulus'))
{
	function get_status_lulus($id_lulus)
	{
        if($id_lulus == 1){
            return "Lulus";
        }else if($id_lulus == 2){
            return "Tidak Lulus";
        }else if($id_lulus == 3){
            return "Cadangan";
        }else{
            return "Belum Diverifikasi";
        }
	}
}

if ( ! function_exists('get_level_pengguna'))
{
    function get_level_pengguna($level)
    {
        if($level == 1){
            return "Administrator";
        }else if($level == 2){
            return "Operator Dinas";
        }else if($level == 3){
            return "Operator Sekolah";
        }else if($level == 5){
            return "Eksekutif";
        }else if($level == 6){
            return "Kepala Sekolah";
        }else if($level == 7){
            return "Operator Nilai UN";
        }
    }
}

if ( ! function_exists('get_status_verifikasi'))
{
    function get_status_verifikasi($id)
    {
        if($id == 1){
            return "Sudah Diverifikasi";
        }else if($id == 2){
            return "Tidak Lengkap";
        }else{
            return "Belum Diverifikasi";
        }
    }
}

if ( ! function_exists('get_status_aktif'))
{
    function get_status_aktif($id)
    {
        if($id == 1){
            return "Aktif";
        }else if($id == 2){
            return "Tidak Aktif";
        }else{
            return "Belum Diset";
        }
    }
}

if ( ! function_exists('get_jenis_kelamin'))
{
    function get_jenis_kelamin($id)
    {
        if($id == 1){
            return "Laki-laki";
        }else if($id == 2){
            return "Perempuan";
        }else{
            return "Tidak Diketahui";
        }
    }
}

if ( ! function_exists('get_even_odd'))
{
    function get_even_odd($number)
    {
        if($number % 2 == 0){
            return "even";
        }else{
            return "odd";
        }
    }
}
