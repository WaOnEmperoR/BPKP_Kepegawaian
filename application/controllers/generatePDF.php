<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class GeneratePDF extends CI_Controller {
		
		/**
			* @author : Hartanto Kurniawan, S.Kom, Intan Permatasari, S.Kom, Annisa Andarachmi, S.Kom
			* @keterangan : Controller
		**/
		
		public function __construct(){
			parent::__construct();
			
			$this->load->model('reporting_model');
			//include(APPPATH."libraries/FusionCharts.php");
			$this->load->library("pdf");
		}
		
		public function index()
		{
			//$id_pegawai = $this->uri->segment(3);
			//$msg = $this->load->view('tesPDF', '', TRUE);
			ob_start();
			
			// create new PDF document
			//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
			
			// create new PDF document
			$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Muhammad Saqlain Arif');
			$pdf->SetTitle('TCPDF Example 001');
			$pdf->SetSubject('TCPDF Tutorial');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
			
			// set default header data
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
			//$pdf->setFooterData(array(0,64,0), array(0,64,128)); 
			
			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
			
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
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
			//$pdf->SetFont('dejavusans', '', 14, '', true);   
			
			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage(); 
			
			// set text shadow effect
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
			
			//$html = "<html><head><title>Coba</title></head><body><h3>Hallowwsss</h3></body></html>";
			//$html = "<html><head><title>Coba</title></head><body><h3>Hallowwsssasasa</h3></table></body></html>";
			$ret_header = $this->reporting_model->get_data_single_pegawai(1);
			
			if ($ret_header->num_rows() > 0) {
				foreach ($ret_header->result() as $db) {
					$pegawai['ID_Pegawai'] = $db->ID_Pegawai;
					$pegawai['Nama_Pegawai'] = $db->Nama_Pegawai;
					$pegawai['NIK'] = $db->NIK;
					$pegawai['NIP'] = $db->NIP;
					$pegawai['Alamat'] = $db->Alamat;
					$pegawai['Jenis_Kelamin'] = $db->Jenis_Kelamin;
					$pegawai['Tempat_Lahir'] = $db->Tempat_Lahir;
					$pegawai['Tanggal_Lahir'] = date('d-m-Y', strtotime($db->Tanggal_Lahir));
					$pegawai['Agama'] = $db->Agama;
				}
			}
			
			$data['pegawai']=$pegawai;
			
			//print_r($d);exit();
			$html = $this->load->view('report/detail_pegawai', $data, TRUE);
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
			
			// ---------------------------------------------------------    
			
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			ob_end_clean(); 
			$pdf->Output('example_001.pdf', 'I');    
			
			//============================================================+
			// END OF FILE
			//============================================================+
			//$this->load->view('tesgraph');
		}
		
		public function tambahan($kd_pegawai)
		{
			$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetPrintHeader(true);
			$pdf->SetPrintFooter(true);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetPageOrientation('P');
			$pdf->SetAuthor('Kemenkominfo');
			$pdf->SetTitle('Daftar THP');
			$pdf->SetSubject('Surat Pendaftaran THP');
			$pdf->SetKeywords('Daftar THP');
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			if (@file_exists(dirname(__FILE__).'/lang/eng.php'))
			{
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			
			// set additional information
			$info = array(
			'Name' => 'PANSELNAS DIKDIN',
			'Location' => 'INDONESIA',
			'Reason' => 'Validasi Pendaftaran DIKDIN',
			'ContactInfo' => 'Kementerian PAN-RB',
			);
			
			
			$pdf->setFontSubsetting(true);
			$pdf->SetFont('Courier', '', 10, '', true);
			$helvetica=$pdf->AddFont('helvetica');        //custom font
			$courier=$pdf->AddFont('courier');      //custom font
			$calibri=$pdf->AddFont('Calibri');        //custom font
			$calibrib=$pdf->AddFont('calibrib');      //custom font
			
			//$pdf->SetFont($calibri, '', 14, '', false);
			
			$pdf->SetTopMargin(5);
			$pdf->AddPage('P', 'A4');
			//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
			
			$ret_header = $this->reporting_model->get_data_single_pegawai($kd_pegawai);
			
			if ($ret_header->num_rows() > 0) {
				foreach ($ret_header->result() as $db) {
					$pegawai['ID_Pegawai'] = $db->ID_Pegawai;
					$pegawai['Nama_Pegawai'] = $db->Nama_Pegawai;
					$pegawai['NIK'] = $db->NIK;
					$pegawai['NIP'] = $db->NIP;
					$pegawai['Alamat'] = $db->Alamat;
					$pegawai['Jenis_Kelamin'] = $db->Jenis_Kelamin;
					$pegawai['Tempat_Lahir'] = $db->Tempat_Lahir;
					$pegawai['Tanggal_Lahir'] = date('d-m-Y', strtotime($db->Tanggal_Lahir));
					$pegawai['Agama'] = $db->Agama;
				}
			}
			
			$data['pegawai']=$pegawai;
			
			$data['riwayat_pendidikan'] = $this->reporting_model->get_pendidikan_pegawai($kd_pegawai);
			$data['riwayat_diklat'] = $this->reporting_model->get_diklat_pegawai($kd_pegawai);
			$data['riwayat_sertifikasi'] = $this->reporting_model->get_sertifikasi_pegawai($kd_pegawai);
			$data['riwayat_penugasan'] = $this->reporting_model->get_penugasan_pegawai($kd_pegawai);
			//print_r($data);exit();
			$html = $this->load->view('report/detail_pegawai', $data, true);
			
			$pdf->SetTitle('Judul');
			$pdf->SetHeaderMargin(5);
			$pdf->SetTopMargin(20);
			$pdf->setFooterMargin(10);
			$pdf->setLeftMargin(5);
			$pdf->SetAuthor('Pengarang');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			
			$pdf->Output('Tes_PDF.pdf','I');
			//$pdf->Output($fileNL,'D');
			
		}
		
	}
	/* End of file tesgraph.php */
/* Location: ./application/controllers/tesgraph.php */