<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    /**
     * @author : Hartanto Kurniawan, S.Kom, Intan Permatasari, S.Kom, Annisa Andarachmi, S.Kom
     * @keterangan : Controller
     * */
    public function __construct() {
        parent::__construct();
        $this->load->model('pengguna_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
    }

    public function index() {
        if (is_admin()) {
            $d['title'] = $this->config->item('nama_aplikasi');
            $d['judul_halaman'] = "Daftar Pengguna";
            $d['breadcumb'] = "Data Pengguna";

            //$d['all_pegawai'] = $this->m_sk->get_sk_belum();

            $d['content'] = $this->load->view('pengguna/view', $d, true);

            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    function datatable() {
        $this->datatables->select('tbl_admin.username,tbl_admin.nama_lengkap,
        tbl_admin.id_level,tbl_admin.email,tbl_level.`level`')
                ->unset_column('tbl_admin.id_level')
                ->from('tbl_admin')
                ->join('tbl_level', 'tbl_admin.id_level = tbl_level.id_level', 'left')
                ->add_column('Aksi', '
            <a href="' . base_url() . 'pengguna/edit/$1" ><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a> |
		    <a href="' . base_url() . 'pengguna/hapus/$1"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>
			', 'tbl_admin.username');

        echo $this->datatables->generate();
    }

    public function tambah() {
        if (is_admin()) {
            $d['title'] = "E-Data";
            $d['judul_form'] = "Tambah Pengguna";

            $d['username'] = '';
            $d['nama_lengkap'] = '';
            $d['password'] = '';
            $d['level'] = '';
            $d['email'] = '';
            $d['sta_pengguna'] = '';

            $text = "SELECT * FROM tbl_level";
            $d['l_level'] = $this->app_model->manualQuery($text);

            $d['content'] = $this->load->view('pengguna/form', $d, true);

            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan() {
        if (is_admin()) {
            $pwd = $this->input->post('password');
            $nama = $this->input->post('nama_lengkap');
            $level = $this->input->post('level');
            $user = $this->input->post('username', TRUE);

            $up['username'] = $user;
            $up['nama_lengkap'] = $nama;
            $up['password'] = md5($pwd);
            $up['id_level'] = $level;
            $up['email'] = $this->input->post('email');
            $up['sta_pengguna'] = $this->input->post('sta_pengguna');

            $id['username'] = $this->input->post('username');

            $data = $this->app_model->getSelectedData("tbl_admin", $id);
            if ($data->num_rows() > 0) {
//                if(empty($pwd)){
//                    $this->app_model->manualQuery("UPDATE tbl_admin SET nama_lengkap='$nama',id_level='$level' WHERE username='$user'");
//                }else{
//                    $this->app_model->updateData("tbl_admin",$up,$id);
//                }
                print "<script type=\"text/javascript\">alert('USERNAME Sudah Ada Coy... !!!');</script>";
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pengguna/tambah'>";
            } else {

                // cek jika ada file yg diupload
                if (!empty($_FILES['userfile']['name'])) {
                    // upload
                    $config['upload_path'] = './uploads/pengguna/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $user;
                    //$config['max_size']	    = '1024';
                    //$config['max_width']      = '1024';
                    //$config['max_height']     = '768';

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload()) {
                        /* $error = array('error' => $this->upload->display_errors());
                          print_r($error); exit(); */
                        //redirect('slide');
                    } else {
                        //Image Resizing
                        $data_upload = $this->upload->data();

                        $file_name = $data_upload["file_name"];

                        $this->load->library('image_lib');
                        $config_resize['image_library'] = 'gd2';
                        $config_resize['create_thumb'] = FALSE;
                        $config_resize['maintain_ratio'] = TRUE;
                        $config_resize['new_image'] = './uploads/pengguna/thumbs';
                        $config_resize['master_dim'] = 'height';
                        $config_resize['quality'] = "100%";
                        $config_resize['source_image'] = './uploads/pengguna/' . $file_name;

                        $config_resize['width'] = 1;
                        $config_resize['height'] = 270;
                        $this->image_lib->initialize($config_resize);
                        $this->image_lib->resize();

                        $pp = array('upload_data' => $this->upload->data());
                    }

                    $up['user_image'] = $pp['upload_data']['file_name'];
                }

                //print_r($up); exit();


                $data = $this->app_model->getSelectedData("tbl_admin", $id);
                if ($data->num_rows() > 0) {
                    $result = $data->row_array();

                    $this->app_model->updateData("tbl_admin", $up, $id);
                    $old_dir = './uploads/pengguna/';
                    $old_thumbs = './uploads/pengguna/thumbs/';
                    if (file_exists($old_dir . $result['pengguna_image'])) {
                        unlink($old_dir . $result['pengguna_image']);
                        unlink($old_thumbs . $result['pengguna_image']);
                    }
                } else {
                    $this->app_model->insertData("tbl_admin", $up);
                }

                redirect('pengguna');
            }
        } else {
            header('location:' . base_url());
        }
    }

    public function simpan_edit() {
        if (is_admin()) {
            $pwd = $this->input->post('password');
            $nama = $this->input->post('nama_lengkap');
            $level = $this->input->post('level');
            $email = $this->input->post('email');
            $sta = $this->input->post('sta_pengguna');
            $user = $this->input->post('username', TRUE);

            $up['username'] = $user;
            $up['nama_lengkap'] = $nama;
            $up['password'] = md5($pwd);
            $up['id_level'] = $level;
            $up['email'] = $email;
            $up['sta_pengguna'] = $sta;

            $id['username'] = $this->input->post('username');

            $data = $this->app_model->getSelectedData("tbl_admin", $id);
            if ($data->num_rows() > 0) {
                if (empty($pwd)) {
                    $this->app_model->manualQuery("UPDATE tbl_admin SET nama_lengkap='$nama',id_level='$level',email='$email',
                    sta_pengguna='$sta' WHERE username='$user'");
                } else {
                    $this->app_model->updateData("tbl_admin", $up, $id);
                }
                echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pengguna'>";
            } else {                // cek jika ada file yg diupload
                if (!empty($_FILES['userfile']['name'])) {
                    // upload
                    $config['upload_path'] = './uploads/pengguna/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $user;
                    //$config['max_size']	    = '1024';
                    //$config['max_width']      = '1024';
                    //$config['max_height']     = '768';

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload()) {
                        /* $error = array('error' => $this->upload->display_errors());
                          print_r($error); exit(); */
                        //redirect('slide');
                    } else {
                        //Image Resizing
                        $data_upload = $this->upload->data();

                        $file_name = $data_upload["file_name"];

                        $this->load->library('image_lib');
                        $config_resize['image_library'] = 'gd2';
                        $config_resize['create_thumb'] = FALSE;
                        $config_resize['maintain_ratio'] = TRUE;
                        $config_resize['new_image'] = './uploads/pengguna/thumbs';
                        $config_resize['master_dim'] = 'height';
                        $config_resize['quality'] = "100%";
                        $config_resize['source_image'] = './uploads/pengguna/' . $file_name;

                        $config_resize['width'] = 1;
                        $config_resize['height'] = 270;
                        $this->image_lib->initialize($config_resize);
                        $this->image_lib->resize();

                        $pp = array('upload_data' => $this->upload->data());
                    }

                    $up['user_image'] = $pp['upload_data']['file_name'];
                }

                //print_r($up); exit();


                $data = $this->app_model->getSelectedData("tbl_admin", $id);
                if ($data->num_rows() > 0) {
                    $result = $data->row_array();

                    $this->app_model->updateData("tbl_admin", $up, $id);
                    $old_dir = './uploads/pengguna/';
                    $old_thumbs = './uploads/pengguna/thumbs/';
                    if (file_exists($old_dir . $result['pengguna_image'])) {
                        unlink($old_dir . $result['pengguna_image']);
                        unlink($old_thumbs . $result['pengguna_image']);
                    }
                } else {
                    $this->app_model->insertData("tbl_admin", $up);
                }

                redirect('pengguna');
            }
        } else {
            header('location:' . base_url());
        }
    }

    public function edit() {
        if (is_admin()) {

            $d['judul_form'] = 'Input Data Penduduk';
            $d['title'] = "E-Data";

            $id = $this->uri->segment(3);
            $text = "SELECT * FROM tbl_admin WHERE username='$id'";
            $data = $this->app_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['username'] = $id;
                    $d['nama_lengkap'] = $db->nama_lengkap;
                    $d['password'] = '';
                    $d['level'] = $db->id_level;
                    $d['email'] = $db->email;
                    $d['sta_pengguna'] = $db->blokir;
                }
            } else {
                $d['username'] = $id;
                $d['nama_lengkap'] = '';
                $d['password'] = '';
                $d['email'] = '';
                $d['sta_pengguna'] = '';
            }

            $text = "SELECT * FROM tbl_level";
            $d['l_level'] = $this->app_model->manualQuery($text);

            $d['content'] = $this->load->view('pengguna/form', $d, true);
            $this->load->view('home', $d);
        } else {
            header('location:' . base_url());
        }
    }

    public function edit_profile() {
        if (is_admin()) {

            $d['judul_form'] = 'Input Data Penduduk';
            $d['title'] = "E-Data";

            //$id = $this->uri->segment(3);
            $id = $this->app_model->CariUserPengguna();
            $text = "SELECT * FROM tbl_admin WHERE username='$id'";
            $data = $this->app_model->manualQuery($text);
            if ($data->num_rows() > 0) {
                foreach ($data->result() as $db) {
                    $d['username'] = $id;
                    $d['nama_lengkap'] = $db->nama_lengkap;
                    $d['password'] = '';
                    $d['level'] = $db->id_level;
                    $d['email'] = $db->email;
                    $d['sta_pengguna'] = $db->blokir;
                }
            } else {
                $d['username'] = $id;
                $d['nama_lengkap'] = '';
                $d['password'] = '';
                $d['email'] = '';
                $d['sta_pengguna'] = '';
            }

            $text = "SELECT * FROM tbl_level";
            $d['l_level'] = $this->app_model->manualQuery($text);

            $d['content'] = $this->load->view('pengguna/form', $d, true);
            $this->load->view('home', $d);
        } else {
            $this->load->view('error_404');
        }
    }

    public function hapus() {
        if (is_admin()) {
            $id = $this->uri->segment(3);
            $this->app_model->manualQuery("DELETE FROM tbl_admin WHERE username='$id'");
            echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "pengguna'>";
        } else {
            header('location:' . base_url());
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */