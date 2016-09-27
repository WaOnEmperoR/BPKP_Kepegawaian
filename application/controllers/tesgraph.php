<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Tesgraph extends CI_Controller {
		
		/**
			* @author : Hartanto Kurniawan, S.Kom, Intan Permatasari, S.Kom, Annisa Andarachmi, S.Kom
			* @keterangan : Controller
		**/
		
		public function __construct(){
			parent::__construct();
			
			include(APPPATH."libraries/FusionCharts.php");		
			$this->load->model('m_dashboard_populate');
		}
		
		public function index()
		{
			$dataXML1 = $this->get_gender_pendaftar();
			$data['caption_bar'] = "Jumlah Pendaftar by Jenis Kelamin ";
			$data['graph_bar'] = renderChart(base_url()."assets/plugins/FusionCharts/Column3D.swf ", "", $dataXML1, "StatistikBar", '100%', 400, 0,1);  
			
			$this->load->view('tesgraph', $data);
		}
		
		public function get_gender_pendaftar() {
			$jumlah = $this->m_dashboard_populate->get_peserta_by_gender();
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' xAxisName='Usia' yAxisName='Jumlah Pendaftar' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='F9690E' decimalSeparator=',' thousandSeparator='.'> ";
			$data2 = "";
			
			foreach($jumlah as $k):
			$data2 .= "<set label='$k->jenis_kelamin' value='$k->hasil'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;	
		}
	}
	/* End of file tesgraph.php */
/* Location: ./application/controllers/tesgraph.php */