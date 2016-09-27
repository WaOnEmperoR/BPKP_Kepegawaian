<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Nilaiun extends CI_Controller {

		/**
			* @author : Caberawit
			* */
			public function __construct() {
				parent::__construct();
				$this->load->model('nilaiun_model');
				$this->load->library('Datatables');
				$this->load->library('table');
				$this->load->database();
			}

			public function index() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {

					$d['title'] = $this->config->item('nama_aplikasi');
					$d['judul_halaman'] = "Tabel Data Nilai UN per Siswa";
					$d['breadcumb'] = "Pengolahan Data Nilai UN";
					$d['all_nilai'] = $this->nilaiun_model->get_all_nilai();

				//print_r($d['all_nilai']);exit();

					$d['content'] = $this->load->view('nilaiun/view', $d, true);

					$this->load->view('home', $d);
				} else {
					$this->load->view('error_404');
				}
			}

			public function tambah() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {

					$d['title'] = $this->config->item('nama_aplikasi');
					$d['judul_halaman'] = "Tambah Data Nilai UN";
					$d['breadcumb'] = "Pengolahan Data Nilai UN";

					$d['id'] = '';
					$d['no_peserta'] = '';
					$d['nama_peserta'] = '';
					$d['tempat_lahir'] = '';
					$d['tanggal_lahir'] = '';
					$d['n_mapel_01'] = '';
					$d['n_mapel_02'] = '';
					$d['n_mapel_03'] = '';
					$d['n_mapel_04'] = '';
					$d['n_mapel_total'] = '';
					$d['sekolah_asal'] = '';

					$text = "SELECT * FROM master_nilai_un order by ID desc limit 500";
					$d['l_nilaiun'] = $this->nilaiun_model->manualQuery($text);
					$d['content'] = $this->load->view('nilaiun/form', $d, true);

					$this->load->view('home', $d);
				} else {
					header('location:' . base_url());
				}
			}

			public function import() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {

					$d['title'] = $this->config->item('nama_aplikasi');
					$d['judul_halaman'] = "Import Data Nilai UN";
					$d['breadcumb'] = "Pengolahan Data Nilai UN";

					$d['content'] = $this->load->view('nilaiun/unggah', $d, true);

					$this->load->view('home', $d);
				} else {
					header('location:' . base_url());
				}
			}

			public function upload() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {
					// check uploaded file
					if (!empty($_FILES['file_name']['name'])) {
						// init upload config
	                    $config['upload_path']      = './uploads/nilai_un/';
	                    $config['allowed_types']    = 'xls|xlsx';
	                    $config['file_name']        =  date('Y-m-d')."_".time();

	                    $this->load->library('upload');
	                    $this->upload->initialize($config);

	                    if (!$this->upload->do_upload('file_name'))
	                    {
	                    	print_r($this->upload->display_errors());exit();
	                    }else{
	                    	$data_upload = $this->upload->data();
	                    	$file = $data_upload['full_path'];

	                    	//load the excel library
							$this->load->library('excel');
							//read file from path
							$objPHPExcel = PHPExcel_IOFactory::load($file);
							//get only the Cell Collection
							$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
							//extract to a PHP readable array format
							foreach ($cell_collection as $cell) {
							    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
							    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
							    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
							    //header will/should be in row 1 only. of course this can be modified to suit your need.
							    if ($row == 1) {
							        $header[$row][$column] = $data_value;
							    } else if($row > 6){
							        $arr_data[$row][$column] = $data_value;
							    }
							}
							//send the data in an array format
							$data['header'] = $header;
							$data['values'] = $arr_data;
							
							$list_data = "";
							$update_counter = 0;
							$insert_counter = 0;

							foreach ($data['values'] as $key => $value) {
								// init variables
								$no_peserta = $value['B'];
								$arr['no_peserta'] = $value['B'];
								$arr['nama_peserta'] = $value['C'];
								$arr['tempat_lahir'] = $value['D'];
								$arr['tanggal_lahir'] = $value['E'];
								$arr['n_mapel_01'] = $value['F'];
								$arr['n_mapel_02'] = $value['G'];
								$arr['n_mapel_03'] = $value['H'];
								$arr['n_mapel_04'] = $value['I'];
								$arr['n_mapel_total'] = $value['J'];
								$arr['sekolah_asal'] = $value['K'];
								//$arr['norm_tl'] = $arr['tanggal_lahir'];

								// check is exist or not by no peserta
								$arr_no_peserta = array("no_peserta"=>$no_peserta);
								
								if(!empty($no_peserta)){
									$data = $this->nilaiun_model->getSelectedData("master_nilai_un",$arr_no_peserta);
									if($data->num_rows()>0){
										$update_counter += 1;
										$list_data .= "No Peserta: $no_peserta berhasil diubah<br/>";
										$this->nilaiun_model->updateData("master_nilai_un",$arr,$arr_no_peserta);
									}else{
										$insert_counter += 1;
										$list_data .= "No Peserta: $no_peserta berhasil ditambahkan<br/>";
										$this->nilaiun_model->insertData("master_nilai_un",$arr);
									}
								}
							}
							$list_data .= "Total data yang diubah = <b>$update_counter</b><br/>";
							$list_data .= "Total data yang ditambahkan = <b>$insert_counter</b>";

							$this->session->set_flashdata('messages', $list_data);
							redirect("nilaiun");
	                    }
					}else{

					}

				} else {
					header('location:' . base_url());
				}
			}

			public function simpan() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {

					$up['no_peserta'] = $this->input->post('no_peserta');
					$up['nama_peserta'] = $this->input->post('nama_peserta');
					$up['tempat_lahir'] = $this->input->post('tempat_lahir');
					$up['tanggal_lahir'] = $this->input->post('tanggal_lahir');
					$up['n_mapel_01'] = $this->input->post('n_mapel_01');
					$up['n_mapel_02'] = $this->input->post('n_mapel_02');
					$up['n_mapel_03'] = $this->input->post('n_mapel_03');
					$up['n_mapel_04'] = $this->input->post('n_mapel_04');
					$up['n_mapel_total'] = $this->input->post('n_mapel_total');
					$up['sekolah_asal'] = $this->input->post('sekolah_asal');

					$id['id'] = $this->input->post('id');

					// check if from tambah or ubah function/view
					$data = $this->nilaiun_model->getSelectedData("master_nilai_un",$id);
					if($data->num_rows()>0){
						$this->nilaiun_model->updateData("master_nilai_un",$up,$id);        
					}else{
						// check no peserta if exist or not
						$no_peserta = array("no_peserta"=>$up['no_peserta']);
						$data = $this->nilaiun_model->getSelectedData("master_nilai_un",$no_peserta);
						if($data->num_rows()>0){
							$this->nilaiun_model->updateData("master_nilai_un",$up,$no_peserta);
						}else{
							$this->nilaiun_model->insertData("master_nilai_un",$up);
						}
					}

					redirect('nilaiun');
				} else {
					header('location:' . base_url());
				}
			}

			public function ubah() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {

					$d['title'] = $this->config->item('nama_aplikasi');
					$d['judul_halaman'] = "Edit Data Nilai UN";
					$d['breadcumb'] = "Pengolahan Data Nilai UN";

					$id = $this->uri->segment(3);
					$text = "SELECT * FROM master_nilai_un WHERE id='$id'";
					$data = $this->nilaiun_model->manualQuery($text);
					if ($data->num_rows() > 0) {
						foreach ($data->result() as $db) {

							$d['id'] = $db->id;
							$d['no_peserta'] = $db->no_peserta;
							$d['nama_peserta'] = $db->nama_peserta;
							$d['tempat_lahir'] = $db->tempat_lahir;
							$d['tanggal_lahir'] = $db->tanggal_lahir;
							$d['n_mapel_01'] = $db->n_mapel_01;
							$d['n_mapel_02'] = $db->n_mapel_02;
							$d['n_mapel_03'] = $db->n_mapel_03;
							$d['n_mapel_04'] = $db->n_mapel_04;
							$d['n_mapel_total'] = $db->n_mapel_total;
							$d['sekolah_asal'] = $db->sekolah_asal;

						}
					} else {
						$d['id'] = '';
						$d['no_peserta'] = '';
						$d['nama_peserta'] = '';
						$d['tempat_lahir'] = '';
						$d['tanggal_lahir'] = '';
						$d['n_mapel_01'] = '';
						$d['n_mapel_02'] = '';
						$d['n_mapel_03'] = '';
						$d['n_mapel_04'] = '';
						$d['n_mapel_total'] = '';
						$d['sekolah_asal'] = '';

					}

					$text = "SELECT * FROM master_nilai_un order by ID desc limit 500";
					$d['l_nilaiun'] = $this->nilaiun_model->manualQuery($text);
					$d['content'] = $this->load->view('nilaiun/form', $d, true);

					$this->load->view('home', $d);
				} else {
					header('location:' . base_url());
				}
			}

			public function hapus() {
				if (is_admin() || is_operator_disdik() || is_operator_un()) {
					$id = $this->uri->segment(3);
					$this->nilaiun_model->manualQuery("DELETE FROM master_nilai_un WHERE id='$id'");
					echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "nilaiun'>";
				} else {
					header('location:' . base_url());
				}
			}

		}

		/* End of file sk_belum.php */
		/* Location: ./application/controllers/sk_belum.php */
