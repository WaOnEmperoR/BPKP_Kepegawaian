<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dinas extends CI_Controller {

    /**
     * @author : Caberawit
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dinas_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index()
    {
        if(is_admin() || is_operator_disdik()){
            $d['title']         = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Tabel Data Dinas Pendidikan";
            $d['breadcumb']     = "Pengolahan Data Dinas Pendidikan";
            $d['all_dinas']	    = $this->dinas_model->get_all_dinas();

            $d['content']       = $this->load->view('dinas/view',$d,true);

            $this->load->view('home',$d);
        }else{
            $this->load->view('error_404');
        }
    }

    public function tambah(){
        if(is_admin() || is_operator_disdik()){
            $d['title']             = $this->config->item('nama_aplikasi');
            $d['judul_halaman']     = "Tambah Data Dinas Pendidikan";
            $d['breadcumb']         = "Pengolahan Data Dinas Pendidikan";

            $d['id']        = '';
            $d['nama']      = '';
            $d['alamat']    = '';
            $d['prov']      = '';
            $d['kab']       = '';
            $d['status']    = '';
            $d['logo']      = '';

            $text = "SELECT * FROM tbl_prov";
            $d['l_provinsi'] = $this->dinas_model->manualQuery($text);
            $text = "SELECT * FROM tbl_kab";
            $d['l_kabupaten'] = $this->dinas_model->manualQuery($text);
            $d['content']= $this->load->view('dinas/form',$d,true);

            $this->load->view('home',$d);
        }else{
            header('location:'.base_url());
        }
    }

    public function simpan() {

        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $up['nm_dinas']       = $this->input->post('nama');
            $up['almt_dinas']     = $this->input->post('alamat');
            $up['prov_dinas']     = $this->input->post('prov');
            $up['kab_dinas']      = $this->input->post('kab');
            $up['stat_aktif']     = $this->input->post('status');
            if(empty($up['stat_aktif']))
                $up['stat_aktif'] = 2;
            //$up['logo_dinas']     = $this->input->post('logo');

            $id['id_dinas']       =   $this->input->post('id');

            /*$data = $this->dinas_model->getSelectedData("tbl_dinas",$id);

            if($data->num_rows()>0){
                $this->dinas_model->updateData("tbl_dinas",$up,$id);
            }else{
                $this->dinas_model->insertData("tbl_dinas",$up);
            }*/


            if (!empty($_FILES['logo']['name'])){
                    // upload
                    $config['upload_path']      = './uploads/logo_dinas/';
                    $config['allowed_types']    = 'gif|jpg|png';
                    #$config['file_name']        =  $_FILES['logo']['name'];
                    //$config['max_size']       = '1024';
                    //$config['max_width']      = '1024';
                    //$config['max_height']     = '768';

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    

                    if ( ! $this->upload->do_upload('logo'))
                    {
                        print_r($this->upload->display_errors());exit();
                        /*$error = array('error' => $this->upload->display_errors());
                        print_r($error); exit();*/
                        //redirect('slide');
                    }
                    else
                    {
                        //Image Resizing
                        $data_upload = $this->upload->data();

                        $file_name = $data_upload["file_name"];

                        $this->load->library('image_lib');
                        $config_resize['image_library'] = 'gd2';
                        $config_resize['create_thumb'] = FALSE;
                        $config_resize['maintain_ratio'] = TRUE;
                        $config_resize['new_image'] = './uploads/logo_dinas/thumbs';
                        $config_resize['master_dim'] = 'height';
                        $config_resize['quality'] = "100%";
                        $config_resize['source_image'] = './uploads/logo_dinas/'. $file_name;

                        $config_resize['width'] = 80;
                        $config_resize['height'] = 80;
                        $this->image_lib->initialize($config_resize);
                        $this->image_lib->resize();

                        $pp = array('upload_data' => $this->upload->data());
                    }

                    $up['logo_dinas'] = $pp['upload_data']['file_name'];

                }


                $data = $this->dinas_model->getSelectedData("tbl_dinas",$id);
                if($data->num_rows()>0){
                    $result = $data->row_array();

                    $this->dinas_model->updateData("tbl_dinas",$up,$id);
                    $old_dir = './uploads/sekolah/';
                    $old_thumbs    = './uploads/sekolah/thumbs/';
                    if(file_exists($old_dir . $result['logo_dinas'])){
                        unlink($old_dir . $result['logo_dinas']);
                        unlink($old_thumbs . $result['logo_dinas']);
                    }
                }else{
                    $this->dinas_model->insertData("tbl_dinas",$up);
                }

            redirect('dinas');
        }else{
            header('location:'.base_url());
        }

    }

    public function ubah() {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $d['title']             = $this->config->item('nama_aplikasi');
            $d['judul_halaman']     = "Ubah Data Perdinasan";
            $d['breadcumb']         = "Pengolahan Data Perdinasan Pendaftaran";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_dinas WHERE id_dinas='$id'";
            $data = $this->dinas_model->manualQuery($text);
            if($data->num_rows() > 0){
                foreach($data->result() as $db){
                    $d['id']        = $db->id_dinas;
                    $d['nama']      = $db->nm_dinas;
                    $d['alamat']    = $db->almt_dinas;
                    $d['prov']      = $db->prov_dinas;
                    $d['kab']       = $db->kab_dinas;
                    $d['status']    = $db->stat_aktif;
                    $d['logo']      = $db->logo_dinas;
                }
            }else{
                $d['id']          = '';
                $d['nama']        = '';
                $d['alamat']      = '';
                $d['prov']        = '';
                $d['kab']         = '';
                $d['status']      = '';
                $d['logo']        = '';
            }

            $text = "SELECT * FROM tbl_prov";
            $d['l_provinsi'] = $this->dinas_model->manualQuery($text);
            $text = "SELECT * FROM tbl_kab";
            $d['l_kabupaten'] = $this->dinas_model->manualQuery($text);
            $d['content']= $this->load->view('dinas/form',$d,true);

            //$d['content']= $this->load->view('dinas/form',$d,true);

            $this->load->view('home',$d);

        }else{
            header('location:'.base_url());
        }
    }

        public function hapus()  {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){
            $id = $this->uri->segment(3);
            $this->dinas_model->manualQuery("DELETE FROM tbl_dinas WHERE id_dinas='$id'");
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."dinas'>";
        }else{
            header('location:'.base_url());
        }
    }

    public function get_kab(){
        $id_prov = $_GET["id"];
        $text = "SELECT * FROM tbl_kab where no_prov = $id_prov";
        $d = $this->dinas_model->manualQuery($text);
        echo json_encode($d->result());
    }
}

/* End of file sk_belum.php */
/* Location: ./application/controllers/sk_belum.php */
