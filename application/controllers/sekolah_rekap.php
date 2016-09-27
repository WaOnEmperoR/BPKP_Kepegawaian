<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah_rekap extends CI_Controller {
 
    /**
     * @author : Caberawit
     * @keterangan : Controller untuk dashboard
     **/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_rekap_model');
        $this->load->library('Datatables');
        $this->load->library('table');
        $this->load->database();
				require_once('application/libraries/tcpdf/tcpdf.php');
    }

    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $d['judul']     ="Home";
            $d['title']     = $this->config->item('nama_aplikasi');
			$d['judul_halaman'] = "Rekap Peringkat Siswa";
            $d['breadcumb']     = "Rekap Siswa";

            $id_kantor = (is_operator_sekolah()|| is_kepala_sekolah()) ? $this->session->userdata('id_kantor') : '';
					
						//echo $id_kantor;exit();
            $d['list_pelamar'] = $this->sekolah_rekap_model->get_all_list($id_kantor);
            $get_kuota = $this->sekolah_rekap_model->get_kuota($id_kantor);
            $d['total_kuota'] = !empty($get_kuota) ? $get_kuota['jumlah'] : 0;
            $get_total_pelamar = $this->sekolah_rekap_model->get_total_pelamar($id_kantor);
            $d['total_pelamar'] = !empty($get_total_pelamar) ? $get_total_pelamar['jumlah'] : 0;
            $get_total_siswa = $this->sekolah_rekap_model->get_total_siswa($id_kantor);
            $d['total_siswa'] = !empty($get_total_siswa) ? $get_total_siswa['jumlah'] : 0;
            $get_total_siswi = $this->sekolah_rekap_model->get_total_siswi($id_kantor);
            $d['total_siswi'] = !empty($get_total_siswi) ? $get_total_siswi['jumlah'] : 0;
            $get_max_nem = $this->sekolah_rekap_model->get_max_nem($id_kantor);
            $d['nem_max'] = !empty($get_max_nem) ? $get_max_nem['jumlah'] : 0;
            $get_avg_nem = $this->sekolah_rekap_model->get_avg_nem($id_kantor);
            $d['nem_avg'] = !empty($get_avg_nem) ? $get_avg_nem['jumlah'] : 0;
            $get_min_nem = $this->sekolah_rekap_model->get_min_nem($id_kantor);
            $d['nem_min'] = !empty($get_min_nem) ? $get_min_nem['jumlah'] : 0;

            $d['content']    = $this->load->view('backend_sekolah/rekap_siswa',$d,true);
            $this->load->view('home',$d);

        }else{
           header('location:'.base_url().'login');
        }
    }


		public function cetak_rekap()
    {
        $cek = $this->session->userdata('logged_in');
        if(!empty($cek)){

            $id_kantor = (is_operator_sekolah()|| is_kepala_sekolah()) ? $this->session->userdata('id_kantor') : '';
					
						//echo $id_kantor;exit();
            $list_pelamar = $this->sekolah_rekap_model->get_all_list($id_kantor);
						$nama_sekolah = $this->sekolah_rekap_model->get_nama_sekolah($id_kantor);
					//print_r($nama_sekolah);exit();
			$text ='																				

<table border="0" width="648" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td rowspan="2" valign="top" width="114">
<p><a name="OLE_LINK1"></a><img src="'.base_url().'assets/img/header.jpg" width="74" height="80" /> </p>
</td>
<td valign="top" width="534">
<p align="center"><strong>PEMERINTAH KOTA TANGERANG SELATAN</strong><br>
<strong>DINAS PENDIDIKAN</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="534">
<p align="center"><span lang="SV">Jl. </span><span lang="IN">Kencana Buana Loka Sektor 12 BSD Kota Tangerang </span><span lang="SV">S</span><span lang="IN">elatan</span><br>
<span lang="IN">Provinsi Banten </span><span lang="SV">Telp. (021) </span><span lang="IN">7587516</span><span lang="SV">8</span></p>
</td>
</tr>
</tbody>
</table>

<hr />
<p align="center">
<strong>DAFTAR KELULUSAN SISWA</strong><br>
<strong>'.$nama_sekolah[nm_sekolah].'</strong><br>
<strong>TAHUN PELAJARAN 2016/2017</strong></p>
<br><br>

<table border="1" >
	<thead>
		<tr>
		  <th width="5%" align="center">No</th>
		  <th width="35%" align="center">Nomor Induk Siswa Nasional (NISN)</th>
		  <th width="35%" align="center">Nama</th>
		  <th width="15%" align="center">Tanggal Lahir</th>
		  <th width="10%" align="center">Nilai</th>
		</tr>
	</thead>
	<tbody>';
		$no=1;
		foreach ($list_pelamar as $db) :
    	$text .='<tr>
                <td align="center" width="5%">'. $no.'</td>
                <td align="center" width="35%">'.$db['nisn'].'</td>
                <td align="center" width="35%">'.$db['nm_siswa'].'</td>
              	<td align="center" width="15%">'.$db['tgl_lahir_siswa'].'</td>
                <td align="center" width="10%">'.$db['nem'].'</td>
                </tr>';
                
        $no++;
     endforeach;
               $text .='</tbody>
													</table>'; 
			$this->cetak_pdf($text);
		}
    else
		{
           header('location:'.base_url().'login');
    }
	}

	public function cetak_pdf($text)
  {
        $cek = $this->session->userdata('logged_in');
       if(!empty($cek))
			{
		/**
		 * Creates an example PDF TEST document using TCPDF
		 * @package com.tecnick.tcpdf
		 * @abstract TCPDF - Example: Default Header and Footer
		 * @author Nicola Asuni
		 * @since 2008-03-04
		 */

		// Include the main TCPDF library (search for installation path).
		

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('PPDB Tangsel');
		$pdf->SetTitle('Daftar Kelulusan Siswa');
		$pdf->SetSubject('Daftar Kelulusan Siswa');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('times', '', 11, '', false);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();

		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		// Set some content to print
		

		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $text, 0, 1, 0, true, '', true);

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		ob_end_clean();
		$pdf->Output('Daftar_Kelulusan_Siswa.pdf', 'D');
		
		}
	}


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
