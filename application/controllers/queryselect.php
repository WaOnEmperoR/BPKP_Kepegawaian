<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Queryselect extends CI_Controller
{
    
    /**
     * @author : Caberawit
     * */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('queryselect_model');
        $this->load->database();
        $this->load->library('Datatables');
        $this->load->library('table');
        
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
        if ($this->ion_auth->logged_in()) {
            
            if (!empty($_POST)) {
                $gabung_tabel = array();
                $gabung_where = array();
                
                $gabung_fakjur     = "";
                $gabung_diklat     = "";
                $gabung_sertifikat = "";
                
                $query_fakjur      = "";
                $query_diklat      = "";
                $query_sertifikasi = "";
                
                $where_fakjur      = "";
                $where_diklat      = "";
                $where_sertifikasi = "";
                
                $query_total_tabel = "";
                $query_total_where = "";
                
                $patokan = "";
                
                if ($this->input->post('result_fakjur')) {
                    $fakjur        = $this->input->post('result_fakjur');
                    $gabung_fakjur = implode(",", $fakjur);
                    $jumlah        = count($fakjur);
                    
                    $js_arr_fakjur = json_encode($fakjur);
                    

                    $query_fakjur = "(SELECT Pegawai_Id_pegawai FROM pendidikan WHERE Jurusan_ID_Jurusan IN ($gabung_fakjur) GROUP BY Pegawai_Id_Pegawai HAVING COUNT(*) = $jumlah) pd";
                    array_push($gabung_tabel, $query_fakjur);
                    
                    $patokan = "pd.*";
                }
                if ($this->input->post('result_diklat')) {
                    $diklat        = $this->input->post('result_diklat');
                    $gabung_diklat = implode(",", $diklat);
                    $jumlah        = count($diklat);
                    
                    $query_diklat = "(SELECT Pegawai_Id_pegawai FROM diklat WHERE Master_Diklat_ID_Diklat IN ($gabung_diklat) GROUP BY Pegawai_Id_Pegawai HAVING COUNT(*) = $jumlah) d";
                    array_push($gabung_tabel, $query_diklat);
                    
                    if ($this->input->post('result_fakjur')) {
                        $where_diklat = "pd.Pegawai_ID_Pegawai = d.Pegawai_ID_Pegawai";
                        array_push($gabung_where, $where_diklat);
                    }
                    
                    $patokan = "d.*";
                }
                if ($this->input->post('result_sertifikat')) {
                    $sertifikat        = $this->input->post('result_sertifikat');
                    $gabung_sertifikat = implode(",", $sertifikat);
                    $jumlah            = count($sertifikat);
                    
                    $query_sertifikasi = "(SELECT Pegawai_Id_pegawai FROM sertifikasi WHERE ID_Master_Sertifikasi IN ($gabung_sertifikat) GROUP BY Pegawai_Id_Pegawai HAVING COUNT(*) = $jumlah) s";
                    array_push($gabung_tabel, $query_sertifikasi);
                    
                    if ($this->input->post('result_fakjur')) {
                        $where_sertifikasi = "pd.Pegawai_ID_Pegawai = s.Pegawai_ID_Pegawai";
                        array_push($gabung_where, $where_sertifikasi);
                    }
                    if ($this->input->post('result_diklat')) {
                        $where_sertifikasi = "d.Pegawai_ID_Pegawai = s.Pegawai_ID_Pegawai";
                        array_push($gabung_where, $where_sertifikasi);
                    }
                    
                    $patokan = "s.*";
                }
                
                $query_total_tabel = implode(" , ", $gabung_tabel);
                $query_total_where = implode(" AND ", $gabung_where);
                
                if (count($gabung_tabel) > 0) {
                    if (count($gabung_where) > 0) {
                        $query_all = "(SELECT $patokan FROM $query_total_tabel WHERE $query_total_where)dalam";
                    } else {
                        $query_all = "(SELECT $patokan FROM $query_total_tabel)dalam";
                    }
                    
                    $final_query = "SELECT pg.* FROM Pegawai pg, $query_all WHERE pg.ID_Pegawai = dalam.Pegawai_ID_Pegawai";
                    
                    $d['list_orang'] = $this->queryselect_model->manualQuery($final_query)->result_array();
                } else {
                    $d['list_orang'] = '';
                }
            } else {
                $d['list_orang'] = '';
            }
            
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Pencarian";
            $d['breadcumb']     = "Pencarian Berdasarkan Pilihan";
            
            $d['content'] = $this->load->view('queryselect/pilih', $d, true);
            
            $this->load->view('home', $d);
            //echo "<script language=\"javascript\">setValueFakjur();</script>";
        } else {
            $this->load->view('error_404');
        }
    }
    
    public function getJSONFakjur()
    {
        $list_fakjur = $this->queryselect_model->get_fakultas_and_jurusan(1);
        echo ($list_fakjur);
    }
    
    public function get_params()
    {
        $gabung_tabel = array();
        $gabung_where = array();
        
        $gabung_fakjur     = "";
        $gabung_diklat     = "";
        $gabung_sertifikat = "";
        
        $query_fakjur      = "";
        $query_diklat      = "";
        $query_sertifikasi = "";
        
        $where_fakjur      = "";
        $where_diklat      = "";
        $where_sertifikasi = "";
        
        $query_total_tabel = "";
        $query_total_where = "";
        
        array_push($gabung_tabel, "Pegawai pg");
        
        if ($this->input->post('result_fakjur')) {
            $fakjur        = $this->input->post('result_fakjur');
            $gabung_fakjur = implode(",", $fakjur);
            
            $query_fakjur = "(SELECT DISTINCT Pegawai_ID_Pegawai FROM pendidikan WHERE Jurusan_ID_Jurusan in ($gabung_fakjur)) pd";
            $where_fakjur = "pg.ID_Pegawai = pd.Pegawai_ID_Pegawai";
            
            array_push($gabung_tabel, $query_fakjur);
            array_push($gabung_where, $where_fakjur);
        }
        if ($this->input->post('result_diklat')) {
            $diklat        = $this->input->post('result_diklat');
            $gabung_diklat = implode(",", $diklat);
            
            $query_diklat = "(SELECT DISTINCT Pegawai_ID_Pegawai FROM diklat WHERE Master_Diklat_ID_Diklat in ($gabung_diklat)) d";
            $where_diklat = "pg.ID_Pegawai = d.Pegawai_ID_Pegawai";
            
            array_push($gabung_tabel, $query_diklat);
            array_push($gabung_where, $where_diklat);
        }
        if ($this->input->post('result_sertifikat')) {
            $sertifikat        = $this->input->post('result_sertifikat');
            $gabung_sertifikat = implode(",", $sertifikat);
            
            $query_sertifikasi = "(SELECT DISTINCT Pegawai_ID_Pegawai FROM sertifikasi WHERE Jenis_Sertifikasi_ID_Jenis_Sertifikasi in ($gabung_diklat)) s";
            $where_sertifikasi = "pg.ID_Pegawai = s.Pegawai_ID_Pegawai";
            
            array_push($gabung_tabel, $query_sertifikasi);
            array_push($gabung_where, $where_sertifikasi);
        }
        
        $query_total_tabel = implode(" , ", $gabung_tabel);
        $query_total_where = implode(" AND ", $gabung_where);
        
        $query_all = "SELECT pg.* FROM $query_total_tabel WHERE $query_total_where";
        
        echo ($query_all);
        
    }
    
    public function getJSONSertifikasi()
    {
        $list_sertifikasi = $this->queryselect_model->get_sertifikasi(1);
        echo ($list_sertifikasi);
    }
    
    public function getJSONDiklat()
    {
        $list_diklat = $this->queryselect_model->get_diklat(1);
        echo ($list_diklat);
    }
    
}

/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */