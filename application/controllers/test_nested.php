<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_nested extends CI_Controller
{
    
    /**
     * @author : Caberawit
     * */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('queryselect_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
        
        $this->load->library(array(
            'ion_auth',
            'form_validation'
        ));
        $this->load->helper(array(
            'url',
            'language'
        ));
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        $this->lang->load('auth');
    }
    
    public function index()
    {
        //$this->queryselect_model->get_fakultas_and_jurusan();
        /*$fakjur = array(
        'TEKNIK' => array('Mesin', 'Sipil', 'Teknik Kimia', 'Elektro'),
        'ILKOM' => array('Informatika', 'Sistem Informasi', 'Tekkom'),
        'HUKUM' => array(),
        'EKONOMI' => array('Akuntansi', 'Manajemen')
        );*/
        
        $fakjur            = array();
        $fakjur['TEKNIK']  = array();
        $fakjur['ILKOM']   = array();
        $fakjur['EKONOMI'] = array();
        $fakjur['HUKUM']   = array();
        
        $subjur = array();
        array_push($subjur, 'Mesin');
        array_push($subjur, 'Sipil');
        array_push($subjur, 'Teknik Kimia');
        array_push($subjur, 'Elektro');
        
        $fakjur['TEKNIK'] = $subjur;
        
        echo (count($fakjur) . " - " . count($fakjur['TEKNIK']) . "<br/>");
        foreach ($fakjur as $key => $value) {
            echo ($key);
            echo ("<br/>");
            foreach ($value as $subval) {
                echo ('----' . $subval);
                echo ('<br/>');
            }
        }
        
        print_r($fakjur);

        echo("<br/>");

        $list=array();
        $list[0]=array();
        $list[1]=array();
        $list[2]=array();

        $sublist = array("NIP" => 123, "NIK" => 456);

        $list[0]=$sublist;

        print_r($list);


        echo("<br/>");

        var_dump($list);
        echo("<br/>");

        foreach ($list as $key => $value) {
            echo ($key);
            echo ("<br/>");
            foreach ($value as $subkey => $subvalue) {
                echo ($subkey."-" . $subvalue);
                echo ('<br/>');
            }
        }

        $str = 'array(0 => array("a","b"), 1 => array("c","d"))';

        eval('$var=' . $str . ';');
        print_r($var);

        foreach ($var as $key => $value) {
            echo ($key);
            echo ("<br/>");
            foreach ($value as $subkey => $subvalue) {
                echo ($subkey."-" . $subvalue);
                echo ('<br/>');
            }
        }
    }
    
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
