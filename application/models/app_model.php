<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
     * @author : Tim CA-BKN
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/

	public function getAllData($table)
	{
		return $this->db->get($table);
	}

	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}

	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}

	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}

	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}

	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}

	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	public function CariLevel($id){
	$t = "SELECT * FROM tbl_level WHERE id_level='$id'";
	$d = $this->app_model->manualQuery($t);
	$r = $d->num_rows();
	if($r>0){
		foreach($d->result() as $h){
			$hasil = $h->level;
		}
	}else{
		$hasil = '';
	}
	return $hasil;
}

	public function CariCabang($id){
	$t = "SELECT * FROM tbl_cabang WHERE cabang_id='$id'";
	$d = $this->app_model->manualQuery($t);
	$r = $d->num_rows();
	if($r>0){
		foreach($d->result() as $h){
			$hasil = $h->cabang_name;
		}
	}else{
		$hasil = '';
	}
	return $hasil;
}
	public function CariUserPengguna(){
			$id = $this->session->userdata('username');
			$t = "SELECT * FROM tbl_login WHERE username='$id'";
			$d = $this->app_model->manualQuery($t);
			$r = $d->num_rows();
			if($r>0){
					foreach($d->result() as $h){
							$hasil = $h->username;
					}
			}else{
					$hasil = '';
			}
			return $hasil;
	}

	public function CariUserCabang(){
			$id = $this->session->userdata('username');
			$t = "SELECT * FROM tbl_login WHERE username='$id'";
			$d = $this->app_model->manualQuery($t);
			$r = $d->num_rows();
			if($r>0){
					foreach($d->result() as $h){
							$hasil = $h->cabang_id;
					}
			}else{
					$hasil = '';
			}
			return $hasil;
	}



	public function CariNamaPengguna(){
	$id = $this->session->userdata('id_pengguna');
	$t = "SELECT * FROM pegawai WHERE id_pegawai='$id'";
	$d = $this->app_model->manualQuery($t);
	$r = $d->num_rows();
	if($r>0){
		foreach($d->result() as $h){
			$hasil = $h->Nama_Pegawai;
		}
	}else{
		$hasil = '';
	}
	return $hasil;
}

public function CariFotoPengguna(){
	$id = $this->session->userdata('username');
	$t = "SELECT * FROM tbl_login WHERE username='$id'";
	$d = $this->app_model->manualQuery($t);
	$r = $d->num_rows();
	if($r>0){
		foreach($d->result() as $h){
			$hasil = $h->foto;
		}
	}else{
		$hasil = '';
	}
	return $hasil;
}

	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'/'.$exp[1].'/'.$exp[0];
		}
		return $date;
	}

	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}

	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}

	public function tgl_indo($tgl){
            $jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;
	}

	public function getBulan($bln){
		switch ($bln){
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}

    function nama_hari($tgl)   {

        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
        $nama_hari = "";

        if($nama=="Sunday") {$nama_hari="Minggu";}
        else if($nama=="Monday") {$nama_hari="Senin";}
        else if($nama=="Tuesday") {$nama_hari="Selasa";}
        else if($nama=="Wednesday") {$nama_hari="Rabu";}
        else if($nama=="Thursday") {$nama_hari="Kamis";}
        else if($nama=="Friday") {$nama_hari="Jumat";}
        else if($nama=="Saturday") {$nama_hari="Sabtu";}

        return $nama_hari;

    }

	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('tbl_login', array('username' => $u, 'password' => $p));

		if(count($q_cek_login->result())>0)
		{
			echo(count($q_cek_login->result()));
			//exit();
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'aingLoginYeuh';
						$sess_data['username'] = $qad->username;
						//$sess_data['id_level'] = $qad->id_level;
						$sess_data['id_pengguna'] = $qad->id_pengguna;

						$pegawai = $this->db->get_where('pegawai', array('id_pegawai' => $qad->id_pengguna))->row();

						$sess_data['id_kantor'] = $pegawai->id_kantor;
						$sess_data['email'] = $qad->email;
						$sess_data['level'] = $qad->level;
						$this->session->set_userdata($sess_data);
					}
					echo("here");
					//exit();
					header('location:'.base_url().'home');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url());
		}

	}

}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */
