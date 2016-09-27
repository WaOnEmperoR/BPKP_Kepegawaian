<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah_verifikasi extends CI_Controller {

    /**
     * @author : Caberawit
     * @keterangan : Controller untuk dashboard
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_verifikasi_model');
        $this->load->model('lampiran_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index()
    {
        if(is_operator_sekolah()){

            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Verifikasi Siswa";
            $d['breadcumb']     = "Data Siswa";

            $id_kantor = (is_operator_sekolah()|| is_kepala_sekolah()) ? $this->session->userdata('id_kantor') : '';

            $d['list_pelamar_reguler'] = $this->sekolah_verifikasi_model->list_pelamar_reguler($id_kantor);
            $d['list_pelamar_luar'] = $this->sekolah_verifikasi_model->list_pelamar_luar($id_kantor);
            $d['list_pelamar_lokal_ekonomi'] = $this->sekolah_verifikasi_model->list_pelamar_lokal_ekonomi($id_kantor);
            $d['list_pelamar_lokal_alamat'] = $this->sekolah_verifikasi_model->list_pelamar_lokal_alamat($id_kantor);
            $d['list_pelamar_lokal_prestasi'] = $this->sekolah_verifikasi_model->list_pelamar_lokal_prestasi($id_kantor);

            $d['content']       = $this->load->view('backend_sekolah/list_siswa',$d,true);

            $this->load->view('home',$d);

        }else{
            $this->load->view('error_404');
        }

    }

	public function verifikasi()
    {
        if (is_admin() || is_operator_sekolah()) {

            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Verifikasi";
            $d['breadcumb']     = "Verifikasi Siswa";

            $id = $this->uri->segment(3);

            // query data siswa berdasarkan id_registrasi
            $d['data_siswa'] = $this->sekolah_verifikasi_model->get_siswa($id);

            if(empty($d['data_siswa'])){
                $this->load->view('error_404');
                return;
            }

            // set keterangan dan verified status untuk data siswa yg ditolak
            $d['keterangan'] = $d['data_siswa']['keterangan'];
            if($d['data_siswa']['verified_status'] == 3){
                $d['verified_status'] = $d['data_siswa']['verified_status'];
            }

            // id jalur by id registrasi
            $id_jalur = $this->sekolah_verifikasi_model->get_jalur_from_siswa($id);

            // query lampiran yg aktif
            $d['lampiran'] = $this->lampiran_model->list_lampiran_aktif_per_jalur($id_jalur);

            // query berkas berdasarkan data pegawai
            $d['berkas'] = $this->sekolah_verifikasi_model->list_berkas($id);

            // looping data berkas per lampiran
            $d['lampiran_berkas'] = array();
            if(!empty($d['lampiran'])){
                foreach ($d['lampiran'] as $key => $lampiran) {
                    $d['lampiran_berkas'][$key] = array();
                    $d['lampiran_berkas'][$key]['nm_lampiran'] = $lampiran['nm_lampiran'];
                    if(!empty($d['berkas'])){
                        foreach ($d['berkas'] as $key2 => $berkas) {
                            if($lampiran['id_lampiran'] == $berkas['id_lampiran']){
                                $d['lampiran_berkas'][$key]['id_berkas'] = $berkas['id_berkas'];
                                $d['lampiran_berkas'][$key]['file_lampiran'] = $berkas['file_lampiran'];
                                $d['lampiran_berkas'][$key]['stat_berkas'] = $berkas['stat_berkas'];
                                break;
                            }else{
                                $d['lampiran_berkas'][$key]['id_berkas'] = "";
                                $d['lampiran_berkas'][$key]['file_lampiran'] = "";
                                $d['lampiran_berkas'][$key]['stat_berkas'] = 1;
                            }
                        }
                    }else{
                        $d['lampiran_berkas'][$key]['id_berkas'] = "";
                        $d['lampiran_berkas'][$key]['file_lampiran'] = "";
                        $d['lampiran_berkas'][$key]['stat_berkas'] = 1;
                    }
                }
            }

            $d['content']       = $this->load->view('backend_sekolah/verifikasi_siswa',$d,true);

            $this->load->view('home',$d);

        }else{
            $this->load->view('error_404');
        }

    }

    public function simpan() {//print_r($this->input->post());exit();
        //Array ( [id] => 31 [status_berkas] => Array ( [-0] => 2 [1] => 2 [2] => 2 [3] => 2 ) [id_berkas] => Array ( [0] => 68 [1] => 69 [2] => [3] => [4] => [5] => [6] => ) ) 
        if (is_admin() || is_operator_sekolah()) {
            $id['id_registrasi'] = $this->input->post('id');

            // verifikasi
            $up['verified_date'] = date('Y-m-d');
            $up['verified_by'] = $this->session->userdata('id_pengguna');

            // looping per status berkas, lalu update status berkas di tabel berkas
            $is_checked_all = true;
            $is_not_checked_all = true;
            $id_berkas_all = $this->input->post('id_berkas');
            $status_berkas_all = $this->input->post('status_berkas');
            if(!empty($id_berkas_all)){
                foreach ($id_berkas_all as $key => $id_berkas) {
                    if(empty($id_berkas)){
                        $is_checked_all = false;
                    }else{
                        // update status berkas, 1= tidak disetujui 2=disetujui
                        $status_berkas = 1;
                        if(empty($status_berkas_all[$key])){
                            $is_checked_all = false;
                        }else{
                            if($status_berkas_all[$key] == 1){
                                $is_checked_all = false;
                            }else{
                                $is_not_checked_all = false;
                                $status_berkas = 2;
                            }
                        }
                        $up['stat_berkas'] = $status_berkas;

                        $id_berkas = array("id_berkas"=>$id_berkas);
                        $data = $this->sekolah_verifikasi_model->getSelectedData("tbl_berkas", $id_berkas);
                        if ($data->num_rows() > 0) {
                            $result = $data->row_array();
                            $this->sekolah_verifikasi_model->updateData("tbl_berkas", $up, $id_berkas);
                        }
                    }
                }
            }else{
                $is_checked_all = false;
            }

            // set verifikasi di tabel registrasi
            $reg['verified_date'] = $up['verified_date'];
            $reg['verified_by'] = $up['verified_by'];
            // cek status kelengkapan berkas dan update status berkas akhir di tabel registrasi
            if($is_checked_all){
                // terverifikasi lengkap
                $reg['verified_status'] = 1;
            }else{
                // belum lengkap
                $reg['verified_status'] = 2;

                // tidak diverifikasi
                if($is_not_checked_all){
                    $reg['verified_status'] = 0;
                }
            }
            // jika ditolak
            if($this->input->post('status_tolak') == "1"){
                $reg['verified_status'] = 3;
                $reg['keterangan'] = $this->input->post('keterangan');
            }

            $data = $this->sekolah_verifikasi_model->getSelectedData("tbl_registrasi", $id);
            if ($data->num_rows() > 0) {
                $result = $data->row_array();
                $this->sekolah_verifikasi_model->updateData("tbl_registrasi", $reg, $id);
            }

            redirect('sekolah_verifikasi');
        } else {
            header('location:' . base_url());
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
