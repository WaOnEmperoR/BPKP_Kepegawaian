<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class TesPDF extends CI_Controller {
		
		/**
			* @author : Hartanto Kurniawan, S.Kom, Intan Permatasari, S.Kom, Annisa Andarachmi, S.Kom
			* @keterangan : Controller
		**/
		
		public function __construct(){
			parent::__construct();
			
			//include(APPPATH."libraries/FusionCharts.php");
			$this->load->library("pdf");
		}
		
		public function index()
		{
			//$msg = $this->load->view('tesPDF', '', TRUE);
			//$cetak = "<html><head><title>Coba</title></head><body><h3>Hallowwsss</h3></body></html>";
			ob_start();
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
			
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Muhammad Saqlain Arif');
			$pdf->SetTitle('TCPDF Example 001');
			$pdf->SetSubject('TCPDF Tutorial');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
			
			// set default header data
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
			//$pdf->setFooterData(array(0,64,0), array(0,64,128)); 
			
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
			$this->pdf->setPrintHeader(false);
			$this->pdf->setPrintFooter(false);
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
			
			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
			
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
			$pdf->SetFont('dejavusans', '', 14, '', true);   
			
			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage(); 
			
			// set text shadow effect
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
			
			//$html = "<html><head><title>Coba</title></head><body><h3>Hallowwsss</h3></body></html>";
			//$html = "<html><head><title>Coba</title></head><body><h3>Hallowwsssasasa</h3></table></body></html>";
			$html = $this->load->view('tesPDF', '', TRUE);
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
		
	}
	/* End of file tesgraph.php */
/* Location: ./application/controllers/tesgraph.php */