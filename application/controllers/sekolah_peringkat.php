<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah_peringkat extends CI_Controller {

    /**
     * @author : Caberawit
     * @keterangan : Controller untuk dashboard
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_peringkat_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index()
    {
        if(is_admin() || is_operator_disdik() || is_operator_sekolah() || is_eksekutif() || is_kepala_sekolah()){

            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Daftar Peringkat Siswa";
            $d['breadcumb']     = "Data Peringkat Siswa";

            $id_kantor = (is_operator_sekolah()|| is_kepala_sekolah()) ? $this->session->userdata('id_kantor') : '';

            $d['list_pelamar_reguler'] = $this->sekolah_peringkat_model->list_pelamar_reguler($id_kantor);
            $d['list_pelamar_luar'] = $this->sekolah_peringkat_model->list_pelamar_luar($id_kantor);
            $d['list_pelamar_lokal_ekonomi'] = $this->sekolah_peringkat_model->list_pelamar_lokal_ekonomi($id_kantor);
            $d['list_pelamar_lokal_alamat'] = $this->sekolah_peringkat_model->list_pelamar_lokal_alamat($id_kantor);
            $d['list_pelamar_lokal_prestasi'] = $this->sekolah_peringkat_model->list_pelamar_lokal_prestasi($id_kantor);

            $d['content']    = $this->load->view('backend_sekolah/peringkat_siswa',$d,true);
            $this->load->view('home',$d);

        }else{
           header('location:'.base_url().'login');
        }
    }

    public function simpan() {
        if (is_admin() || is_kepala_sekolah()) {
            $up['stat_lulus'] = $this->input->post('stat_lulus');
            $id['id_seleksi'] = $this->input->post('id');

            $data = $this->sekolah_peringkat_model->getSelectedData("tbl_seleksi", $id);
            if ($data->num_rows() > 0) {
                $result = $data->row_array();

                // cek status = lulus
                if($up['stat_lulus'] == 1){
                    // cek kuota sekolah
                    if(!$this->sekolah_peringkat_model->is_memenuhi_kuota($result['id_sekolah'])){
                        redirect('sekolah_peringkat');
                    }
                }
                
                $this->sekolah_peringkat_model->updateData("tbl_seleksi", $up, $id);
                if($up['stat_lulus'] != 0)
                    $this->sekolah_peringkat_model->updateData("tbl_registrasi", array("stat_akhir"=>7), array("id_registrasi"=>$result['id_registrasi']));
            }

            redirect('sekolah_peringkat');
        } else {
            header('location:' . base_url());
        }
    }

    public function ubah() {
        if (is_admin() || is_kepala_sekolah()) {

            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Ubah Status Kelulusan";
            $d['breadcumb'] = "Pengolahan Data Kelulusan Jalur Lokal";

            $id = $this->uri->segment(3);
            $text = "SELECT tbl_seleksi.*,tbl_registrasi.*,tbl_sekolah.*,tbl_ijazah.*,tbl_jalur_seleksi.* FROM tbl_seleksi "
                    . "LEFT JOIN tbl_registrasi ON tbl_registrasi.id_registrasi = tbl_seleksi.id_registrasi "
                    . "LEFT JOIN tbl_sekolah ON tbl_sekolah.id_sekolah = tbl_seleksi.id_sekolah "
                    . "LEFT JOIN tbl_ijazah ON tbl_ijazah.id_registrasi = tbl_registrasi.id_registrasi "
                    . "LEFT JOIN tbl_jalur_seleksi ON tbl_jalur_seleksi.id_jalur = tbl_seleksi.id_jalur "
                    . "WHERE id_seleksi='$id' AND tbl_seleksi.id_sekolah = ".$this->session->userdata('id_kantor');
            $data = $this->sekolah_peringkat_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['id'] = $db->id_seleksi;
                    $d['no_registrasi'] = $db->no_registrasi;
                    $d['nm_siswa'] = $db->nm_siswa;
                    $d['jk_siswa'] = ($db->jk == 1 ? "Laki-laki" : "Perempuan");
                    $d['tmp_lahir_siswa'] = $db->tmp_lahir_siswa;
                    $d['tgl_lahir_siswa'] = $db->tgl_lahir_siswa;
                    $d['almt_siswa'] = $db->almt_siswa;
                    $d['agama_siswa'] = $db->agama_siswa;
                    $d['sekolah'] = $db->nm_sekolah;
                    $d['stat_lulus'] = $db->stat_lulus;
                }
            } else {
                $d['id'] = '';
                $d['no_registrasi'] = '';
                $d['nm_siswa'] = '';
                $d['stat_lulus'] = '';
            }

            $d['content'] = $this->load->view('backend_sekolah/form_peringkat_siswa', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
