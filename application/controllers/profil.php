<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan, S.Kom, Intan Permatasari, S.Kom, Annisa Andarachmi, S.Kom
     * @keterangan : Controller
     **/

    public function index()
    {
        if(is_admin()){

            $d['menu']     ="profil";
            $d['judul']     ="Kabupaten Semarang";
            $d['title']     = $this->config->item('nama_aplikasi');

            $d['no_identitas'] = $this->session->userdata('reg_identitas');

            $text_jenis_ijin = "SELECT * FROM tbl_jenis_header ORDER BY jen_nama ASC";
            $d['l_jenis_ijin'] = $this->app_model->manualQuery($text_jenis_ijin);

            $d['content']    = $this->load->view('front/profil_pemohon',$d,true);
            $this->load->view('front/home_pemohon',$d);

        }else{
            header('location:'.base_url().'login');
        }
    }

    public function InfoNIKPemohon()
    {
        $kode = $this->input->post('kode');

        $text = "SELECT tbl_registrasi.reg_id,tbl_registrasi.reg_kode,tbl_registrasi.reg_tgl,tbl_registrasi.identitas_id,
          tbl_registrasi.reg_identitas,tbl_registrasi.reg_nama,tbl_registrasi.reg_tmp_lahir,tbl_registrasi.reg_tgl_lahir,
          tbl_registrasi.reg_agama,tbl_registrasi.reg_pekerjaan,tbl_registrasi.reg_jk,tbl_registrasi.kew_id,tbl_registrasi.reg_negara,
          tbl_registrasi.reg_npwp,tbl_registrasi.reg_alamat,tbl_registrasi.kec_pilih,tbl_registrasi.reg_kelurahan,tbl_registrasi.reg_telp,
          tbl_registrasi.reg_hp,tbl_registrasi.reg_email,tbl_registrasi.reg_sta,tbl_registrasi.reg_aktif,
          tbl_agama.aga_nama,tbl_pekerjaan.pek_nama,tbl_kecamatan.kecamatan_nama,tbl_kelurahan.kelurahan_nama
          FROM tbl_registrasi
        INNER JOIN tbl_agama ON tbl_registrasi.reg_agama = tbl_agama.aga_id
        INNER JOIN tbl_pekerjaan ON tbl_registrasi.reg_pekerjaan = tbl_pekerjaan.pek_id
        INNER JOIN tbl_kecamatan ON tbl_registrasi.kec_pilih = tbl_kecamatan.kecamatan_id
        INNER JOIN tbl_kelurahan ON tbl_registrasi.reg_kelurahan = tbl_kelurahan.kelurahan_id WHERE reg_identitas='$kode'";
        $tabel = $this->app_model->manualQuery($text);
        $row = $tabel->num_rows();
        if($row>0){
            foreach($tabel->result() as $t){
                $data['reg_nama']       = $t->reg_nama;
                $data['reg_tmp_lahir']  = $t->reg_tmp_lahir;
                $data['reg_tgl_lahir']  = $this->functions->convert_date_indo(array("datetime" => $t->reg_tgl_lahir));
                $data['aga_nama']       = $t->aga_nama;
                $data['pek_nama']       = $t->pek_nama;
                $data['reg_jk']         = $t->reg_jk;
                $data['kew_id']         = $t->kew_id;
                $data['reg_negara']     = $t->reg_negara;
                $data['reg_npwp']       = $t->reg_npwp;
                $data['reg_alamat']     = $t->reg_alamat;
                $data['kecamatan_nama'] = $t->kecamatan_nama;
                $data['kelurahan_nama'] = $t->kelurahan_nama;
                $data['reg_telp']       = $t->reg_telp;
                $data['reg_hp']         = $t->reg_hp;
                $data['reg_email']      = $t->reg_email;
                $data['reg_sta']        = $t->reg_sta;
                $data['reg_aktif']      = $t->reg_aktif;

                echo json_encode($data);
            }
        }else{
            $data['reg_nama']       = '';
            $data['reg_tmp_lahir']  = '';
            $data['reg_tgl_lahir']  = '';
            $data['reg_agama']      = '';
            $data['reg_pekerjaan']  = '';
            $data['reg_jk']         = '';
            $data['kew_id']         = '';
            $data['reg_negara']     = '';
            $data['reg_npwp']       = '';
            $data['reg_alamat']     = '';
            $data['kec_pilih']      = '';
            $data['reg_kelurahan']  = '';
            $data['reg_telp']       = '';
            $data['reg_hp']         = '';
            $data['reg_email']      = '';
            $data['reg_sta']        = '';
            $data['reg_aktif']      = '';

            echo json_encode($data);
        }

    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */