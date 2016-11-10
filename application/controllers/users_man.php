<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');




class Users_Man extends CI_Controller {
	
	
	
	
	
	
	
	/**			* @author : Caberawit		* */
	
	
	
	public function __construct() {
		
		
		
		parent::__construct();
		
		
		
		$this->load->library('Datatables');
		
		
		
		$this->load->library('table');
		
		
		
		$this->load->database();
		
		
		
		
		$this->load->library(array('ion_auth','form_validation'));
		
		
		
		$this->load->helper(array('url','language'));
		
		
		
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		
		
		
		
		$this->lang->load('auth');
		
		
		
	}
	
	
	
	
	public function index() {
		
		
		
		if ($this->ion_auth->is_admin()) {
			
			
			
			$this->data['title'] = $this->config->item('nama_aplikasi');
			
			
			
			$this->data['judul_halaman'] = "Tabel User";
			
			
			
			$this->data['breadcumb'] = "Manajemen User";
			
			
			
			
			// 			set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			
			
			
			//l			ist the users
			$this->data['users'] = $this->ion_auth->users()->result();
			
			
			
			foreach ($this->data['users'] as $k => $user)
			{
				
				
				
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
				
				
				
			}
			
			
			
			
			$d['content'] = $this->load->view('users_man/view', $this->data, true);
			
			
			
			
			$this->load->view('home', $d);
			
			
			
		}
		
		
		else {
			
			
			
			$this->load->view('error_404');
			
			
			
		}
		
		
		
	}
	
	
	
	
	public function tambah() {
		
		
		
		if ($this->ion_auth->is_admin()) {
			
			
			
			
			
			
			
			/*$d['title'] = $this->config->item('nama_aplikasi');				$d['judul_halaman'] = "Tambah Data Tingkat Pendidikan";				$d['breadcumb'] = "Pengolahan Data Tingkat Pendidikan";								$d['ID_Tingkat_Pendidikan'] = '';				$d['Nama_Tingkat_Pendidikan'] = '';				$d['Deskripsi_Tingkat_Pendidikan'] = '';								$d['content'] = $this->load->view('tingkat_pendidikan/form', $d, true);								$this->load->view('home', $d);				} else {				header('location:' . base_url());*/
			
			
			
		}
		
		
		
	}
	
	
	
	
	public function simpan() {
		
		
		
		if ($this->ion_auth->is_admin()) {
			
			
			
			
			
			
			
			/*$id['ID_Tingkat_Pendidikan'] = $this->input->post('id');				$up['Nama_Tingkat_Pendidikan'] = $this->input->post('nama_tingkat');				$up['Deskripsi_Tingkat_Pendidikan'] = $this->input->post('deskripsi');								$data = $this->tingkat_pendidikan_model->getSelectedData("tingkat_pendidikan",$id);				echo($data->num_rows());				if($data->num_rows()>0){					$this->tingkat_pendidikan_model->updateData("tingkat_pendidikan",$up,$id);					}else{					$this->tingkat_pendidikan_model->insertData("tingkat_pendidikan",$up);				}								redirect('tingkat_pendidikan');				} else {				header('location:' . base_url());*/
			
			
			
		}
		
		
		
	}
	
	
	
	
	public function ubah($id) {
		
		
		
		if ($this->ion_auth->is_admin()) {
			
			
			
			
			$this->data['title'] = $this->config->item('nama_aplikasi');
			
			
			
			$this->data['judul_halaman'] = "Ubah Data User";
			
			
			
			$this->data['breadcumb'] = "Pengolahan Data User";
			
			
			
			
			$user = $this->ion_auth->user($id)->row();
			
			
			
			$groups=$this->ion_auth->groups()->result_array();
			
			
			
			$currentGroups = $this->ion_auth->get_users_groups($id)->result();
			
			
			
			
			// 			validate form input
			$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
			
			
			
			$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
			
			
			
			$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
			
			
			
			$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');
			
			
			
			
			if (isset($_POST) && !empty($_POST))
			{
				
				
				
				// 				do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					
					
					
					show_error($this->lang->line('error_csrf'));
					
					
					
				}
				
				
				
				
				// 				update the password if it was posted
				if ($this->input->post('password'))
				{
					
					
					
					$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
					
					
					
					$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
					
					
					
				}
				
				
				
				
				if ($this->form_validation->run() === TRUE)
				{
					
					
					
					$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
					);
					
					
					
					
					// 					update the password if it was posted
					if ($this->input->post('password'))
					{
						
						
						
						$data['password'] = $this->input->post('password');
						
						
						
					}
					
					
					
					
					// 					Only allow updating groups if user is admin
					if ($this->ion_auth->is_admin())
					{
						
						
						
						//U						pdate the groups user belongs to
						$groupData = $this->input->post('groups');
						
						
						
						
						if (isset($groupData) && !empty($groupData)) {
							
							
							
							
							$this->ion_auth->remove_from_group('', $id);
							
							
							
							
							foreach ($groupData as $grp) {
								
								
								
								$this->ion_auth->add_to_group($grp, $id);
								
								
								
							}
							
							
							
							
						}
						
						
						
					}
					
					
					
					
					// 					check to see if we are updating the user
					if($this->ion_auth->update($user->id, $data))
					{
						
						
						
						// 						redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->ion_auth->messages() );
						
						
						
						if ($this->ion_auth->is_admin())
						{
							
							
							
							redirect('auth', 'refresh');
							
							
							
						}
						
						
						
						else
						{
							
							
							
							redirect('/', 'refresh');
							
							
							
						}
						
						
						
						
					}
					
					
					
					else
					{
						
						
						
						// 						redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->ion_auth->errors() );
						
						
						
						if ($this->ion_auth->is_admin())
						{
							
							
							
							redirect('auth', 'refresh');
							
							
							
						}
						
						
						
						else
						{
							
							
							
							redirect('/', 'refresh');
							
							
							
						}
						
						
						
						
					}
					
					
					
					
				}
				
				
				
			}
			
			
			
			
			// 			display the edit user form
			$this->data['csrf'] = $this->_get_csrf_nonce();
			
			
			
			
			// 			set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			
			
			
			
			// 			pass the user to the view
			$this->data['user'] = $user;
			
			
			
			$this->data['groups'] = $groups;
			
			
			
			$this->data['currentGroups'] = $currentGroups;
			
			
			
			
			$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'class'=> 'form-control',
			'autofocus'	=> 'true',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			);
			
			
			
			$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'class'=> 'form-control',
			'autofocus'	=> 'true',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			);
			
			
			
			$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'class'	=> 'form-control',
			'autofocus'	=> 'true',
			'value' => $this->form_validation->set_value('company', $user->company),
			);
			
			
			
			$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'class'=> 'form-control',
			'autofocus'	=> 'true',
			'value' => $this->form_validation->set_value('phone', $user->phone),
			);
			
			
			
			$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'class'=> 'form-control',
			'autofocus'	=> 'true',
			'type' => 'password'
			);
			
			
			
			$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'class'=> 'form-control',
			'autofocus'	=> 'true',
			'type' => 'password'
			);
			
			
			
			//$			this->load->view('users_man/form', $this->data);
			
			$d['content'] = $this->load->view('users_man/form', $this->data, true);
			
			
			$this->load->view('home', $d);
			
			//$			this->_render_page('auth/edit_user', $this->data);
			
			
			
			
		}
		
		
		
	}
	
	
	
	
	public function hapus() {
		
		
		
		
		
		
		/*if ($this->ion_auth->is_admin()) {				$id = $this->uri->segment(3);				$this->tingkat_pendidikan_model->manualQuery("DELETE FROM tingkat_pendidikan WHERE ID_Tingkat_Pendidikan='$id'");				echo "<meta http-equiv='refresh' content='0; url=" . base_url() . "tingkat_pendidikan'>";				} else {				header('location:' . base_url());			}*/
		
		
		
	}
	
	
	
	public function _get_csrf_nonce()
	{
		
		
		$this->load->helper('string');
		
		
		$key   = random_string('alnum', 8);
		
		
		$value = random_string('alnum', 20);
		
		
		$this->session->set_flashdata('csrfkey', $key);
		
		
		$this->session->set_flashdata('csrfvalue', $value);
		
		
		
		return array($key => $value);
		
		
	}
	
	
	
	
}







/* End of file pegawai.php */






/* Location: ./application/controllers/pegawai.php */



