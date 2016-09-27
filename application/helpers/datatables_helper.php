<?php 
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */



function get_btn_prov($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url().'provinsi/edit/'.$id.'"><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a> | ';
    $html .='<a href="'.  base_url().'provinsi/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>';
    $html.='</span>';
    
    return $html;
}


function get_btn_kec($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url().'kecamatan/edit/'.$id.'"><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a> | ';
    $html .='<a href="'.  base_url().'kecamatan/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>';
    $html.='</span>';
    
    return $html;
}



function get_btn_kel($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url().'kelurahan/edit/'.$id.'"><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a> | ';
    $html .='<a href="'.  base_url().'kelurahan/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>';
    $html.='</span>';
    
    return $html;
}


function get_btn_kabkota($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
    $html .='<a href="'.  base_url().'kabkota/edit/'.$id.'"><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a> | ';
    $html .='<a href="'.  base_url().'kabkota/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>';
    $html.='</span>';
    
    return $html;
}


function get_btn_registrasi($id)
{
    $ci= & get_instance();
	/*
    $html='<span class="actions">';
	$html .='<a href="'.  base_url().'permohonan/tambah/'.$id.'"><button class="btn-inverse btn-sm" title="detail"><i class="fa fa-edit"></i> Detail </button></a>';
    $html .='<a href="'.  base_url().'registrasi/edit/'.$id.'"><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a>';
    $html .='<a href="'.  base_url().'registrasi/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>';
    $html.='</span>';
    */
	
	//$query = $ci->db->get("tbl_jenis_header")->result();
	$text = "select jen_kode, jen_url, jen_nama from tbl_jenis_header order by jen_nama asc";
	$result = $ci->db->query($text)->result_array();
	
	$html='
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<ul class="nav navbar-nav">
		  <li class="dropdown"><a class="btn-inverse btn-sm" data-toggle="dropdown" href="#">Pengajuan<span class="caret"></span></a>
			<ul class="dropdown-menu">';
			
			foreach($result as $row){
				$html .= '<li><a href="'.  base_url().$row['jen_url'].'/pengajuan/'.$id.'">'.$row['jen_nama'].'</a></li>';
			}
			/*	
			  <li><a href="'.  base_url().'sia/pengajuan/'.$id.'">Izin Apotek</a></li>
			  <li><a href="'.  base_url().'klinik_baru/pengajuan/'.$id.'">Izin Klinik - Baru</a></li>
			  <li><a href="'.  base_url().'imb_baru/pengajuan/'.$id.'">Izin Mendirikan Bangunan - Baru</a></li>
			  <li><a href="'.  base_url().'iplc/pengajuan/'.$id.'">Izin Pembuangan Limbah Cair ke Lingkungan</a></li>
			  <li><a href="'.  base_url().'ir_pemindahtangan/pengajuan/'.$id.'">Izin Reklame - Pemindahtanganan</a></li>
			  <li><a href="'.  base_url().'ir_perpanjangan/pengajuan/'.$id.'">Izin Reklame - Perpanjangan</a></li>
			  <li><a href="'.  base_url().'irnp_baru/pengajuan/'.$id.'">Izin Reklame Non Permanen - Baru</a></li>
			  <li><a href="'.  base_url().'irp_baru/pengajuan/'.$id.'">Izin Reklame Permanen- Baru</a></li>
			  <li><a href="'.  base_url().'iujk_baru/pengajuan/'.$id.'">Izin Usaha Jasa Konstruksi - Baru</a></li>
			  <li><a href="'.  base_url().'iujk_perpanjangan/pengajuan/'.$id.'">Izin Usaha Jasa Konstruksi - Perpanjangan</a></li>
			  <li><a href="'.  base_url().'iujk_perubahan/pengajuan/'.$id.'">Izin Usaha Jasa Konstruksi - Perubahan</a></li>
			  <li><a href="'.  base_url().'iuphpb/pengajuan/'.$id.'">Izin Usaha Penggilingan Padi, Huller, dan Penyosohan Beras</a></li>
			  <li><a href="'.  base_url().'iuphpm/pengajuan/'.$id.'">Izin Usaha Penggilingan Padi, Huller, dan Penyosohan Beras Mobil</a></li>
			  <li><a href="'.  base_url().'siup_pkcp/pengajuan/'.$id.'">Izin Usaha Perdagangan  - Pembukaan Kantor Cabang/Perwakilan</a></li>
			  <li><a href="'.  base_url().'siup_pu/pengajuan/'.$id.'">Izin Usaha Perdagangan - Pendaftaran Ulang</a></li>
			  <li><a href="'.  base_url().'siup_u/pengajuan/'.$id.'">Izin Usaha Perdagangan - Perubahan</a></li>
			  <li><a href="'.  base_url().'siup_cvf_baru/pengajuan/'.$id.'">Izin Usaha Perdagangan CV/F - Baru</a></li>
			  <li><a href="'.  base_url().'siup_k_baru/pengajuan/'.$id.'">Izin Usaha Perdagangan Koperasi - Baru</a></li>
			  <li><a href="'.  base_url().'siup_p_baru/pengajuan/'.$id.'">Izin Usaha Perdagangan Perorangan - Baru</a></li>
			  <li><a href="'.  base_url().'siup_pt_baru/pengajuan/'.$id.'">Izin Usaha Perdagangan PT - Baru</a></li>
			  <li><a href="'.  base_url().'iup/pengajuan/'.$id.'">Izin Usaha Peternakan</a></li>
			  <li><a href="'.  base_url().'tdg_baru/pengajuan/'.$id.'">Tanda Daftar Gudang - Baru</a></li>
			  <li><a href="'.  base_url().'tdp_pembaharuan/pengajuan/'.$id.'">Tanda Daftar Perusahaan - Pembaharuan</a></li>
			  <li><a href="'.  base_url().'tdpcv_baru/pengajuan/'.$id.'">Tanda Daftar Perusahaan CV - Baru</a></li>
			  <li><a href="'.  base_url().'tdpf_baru/pengajuan/'.$id.'">Tanda Daftar Perusahaan Firma - Baru</a></li>
			  <li><a href="'.  base_url().'tdpkan_baru/pengajuan/'.$id.'">Tanda Daftar Perusahaan Kantor - Baru</a></li>
			  <li><a href="'.  base_url().'tdpkop_baru/pengajuan/'.$id.'">Tanda Daftar Perusahaan Koperasi - Baru</a></li>
			  <li><a href="'.  base_url().'tdpper_perubahan/pengajuan/'.$id.'">Tanda Daftar Perusahaan Koperasi/CV/Firma/Perorangan/Perusahan Lain - Perubahan</a></li>
			  <li><a href="'.  base_url().'tdpp_baru/pengajuan/'.$id.'">Tanda Daftar Perusahaan Perorangan - Baru</a></li>
			  <li><a href="'.  base_url().'tdppl_baru/pengajuan/'.$id.'">Tanda Daftar Perusahaan Perusahaan Lain - Baru</a></li>
			*/
			$html .='</ul>
		  </li>
		  <li><a href="'.  base_url().'registrasi/edit/'.$id.'"><button class="btn-inverse btn-sm" title="ubah"><i class="fa fa-edit"></i> Ubah </button></a></li>
		  <li><a href="'.  base_url().'registrasi/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a></li>
		</ul>
	  </div>
	</nav>';
	 
	
    return $html;
}

function get_btn_imb_baru($id)
{
    $ci= & get_instance();
    $html='<span class="actions">';
	$html .='<a href="'.  base_url().'imb_baru/pengajuan/'.$id.'"><button class="btn-inverse btn-sm" title="pengajuan"><i class="fa fa-edit"></i> Pengajuan </button></a>';
    $html .='<a href="'.  base_url().'imb_baru/pengambilan/'.$id.'"><button class="btn-inverse btn-sm" title="pengambilan"><i class="fa fa-edit"></i> Pengambilan </button></a>';
    $html .='<a href="'.  base_url().'imb_baru/hapus/'.$id.'"><button class="btn-danger btn-sm" title="hapus" onClick="return confirm(\'Anda yakin ingin menghapus data ini?\')"><i class="fa fa-trash-o"></i> Hapus</button></a>';
    $html.='</span>';
    
    return $html;
}