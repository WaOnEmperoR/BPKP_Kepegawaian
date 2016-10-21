<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Home extends CI_Controller {
		
		/**
			* @author : Caberawit
			* @keterangan : Controller untuk dashboard
		**/
		function __construct(){
			parent::__construct();
			
			include(APPPATH."libraries/FusionCharts.php");	
			$this->load->model('m_dashboard_populate');
			$this->load->model('mitensilan_dashboard_model');
		}
		
		public function index()
		{
			// Load the tables library
			$this->load->library('table');
			
			$cek = $this->session->userdata('logged_in');
			$pelayanan = $this->mitensilan_dashboard_model->Get_Pelayanan_Yearly()->result();
			
			$graph['yearly_service']=json_encode($pelayanan);
			
			//print_r($graph['yearly_service']);
			
			//exit();
			
			if(!empty($cek)){
				
				$d['judul']     ="Home";
				$d['title']     = $this->config->item('nama_aplikasi');
				$d['graph']		= $graph;

				$d['content'] = $this->load->view('dashboard_mitensilan', $d, true);
				//$d['content'] = "<p>Halo Cest</p>";
				//echo("Here---");exit();
				
				$this->load->view('home',$d);
				
				}else{
				header('location:'.base_url().'login');
			}
		}
		
		public function get_top5_school($id_jenjang) {
			$hasil = $this->m_dashboard_populate->top5_sekolah_favorit($id_jenjang);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Jumlah Pendaftar' xAxisName='Nama Sekolah' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#fcc02d' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' showyaxisvalues='0' thousandSeparator='.' showRealTimeValue='1' refreshInterval='5'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_sekolah' value='$k->jumlah'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;	
		}
		
		public function get_down5_school($id_jenjang) {
			//echo($id_jenjang);exit();
			$hasil = $this->m_dashboard_populate->top5_sekolah_least_favourite($id_jenjang);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Jumlah Pendaftar' xAxisName='Nama Sekolah' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#fcc02d' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' showyaxisvalues='0' thousandSeparator='.' showRealTimeValue='1' refreshInterval='5'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_sekolah' value='$k->jumlah'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;	
		}
		
		public function get_rata2_nem_sma($id_jenjang)
		{
			$hasil = $this->m_dashboard_populate->top5_rata2_nem($id_jenjang);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Rata-rata Nilai UN' xAxisName='Nama Sekolah' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#3A803D' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' thousandSeparator='.' showRealTimeValue='1' refreshInterval='5'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_sekolah' value='$k->rata2_nem'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;		
		}
		
		public function get_max_nem_sma($id_jenjang)
		{
			$hasil = $this->m_dashboard_populate->top5_max_nem($id_jenjang);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Nilai UN Tertinggi' xAxisName='Nama Sekolah' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#3A803D' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' thousandSeparator='.' showRealTimeValue='1' refreshInterval='1'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_sekolah' value='$k->max_nem'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;		
		}
		
		public function get_min_nem_sma($id_jenjang)
		{
			$hasil = $this->m_dashboard_populate->top5_min_nem($id_jenjang);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Nilai UN Terendah' xAxisName='Nama Sekolah' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#3A803D' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' thousandSeparator='.' showRealTimeValue='1' refreshInterval='1'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_sekolah' value='$k->min_nem'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;		
		}
		
		public function get_percentage_gender($id_sekolah)
		{
			$hasil = $this->m_dashboard_populate->persentase_gender($id_sekolah);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' subcaption='Last Year' startingangle='120' showlabels='0' showlegend='1' enablemultislicing='0' slicingdistance='15' showpercentvalues='1' showpercentintooltip='0'  pieRadius='150' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' thousandSeparator='.' theme='fint'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->jenis_kelamin' value='$k->hasil'/>";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;		
		}
		
		public function get_usia_graph($id_sekolah)
		{
			$hasil = $this->m_dashboard_populate->grouping_by_usia($id_sekolah);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Jumlah Pendaftar' xAxisName='Usia' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='0' placeValuesInside='1' pieRadius='150' decimalSeparator=',' basefontcolor='#000000' plotgradientcolor='' thousandSeparator='.' showRealTimeValue='1' refreshInterval='1' > ";
			$data2 = "";
			
			foreach($hasil as $k):
			//echo($k->umur.' - '.$k->jumlah);exit();
			$data2 .= "<set label='$k->umur' value='$k->jumlah'/>";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;
		}
		
		public function top5_highest_school($id_sekolah, $id_jalur)
		{
			//echo("--> ".$id_sekolah." - ".$id_jalur." - ".$identitas);
			$hasil = $this->m_dashboard_populate->top5_nem_sekolah($id_sekolah, $id_jalur);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Nilai UN' xAxisName='Nama Pendaftar' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#8ae32b' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' thousandSeparator='.' showRealTimeValue='1' refreshInterval='1'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_siswa' value='$k->nem'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;		
		}
		
		public function top5_lowest_school($id_sekolah, $id_jalur)
		{
			$hasil = $this->m_dashboard_populate->low5_nem_sekolah($id_sekolah, $id_jalur);
			
			$data1 = "<chart subcaption='(Klik kanan untuk export grafik)' exportEnabled='1' exportAtClient='0' exportHandler='http://107.21.74.91/' html5ExportHandler='http://107.21.74.91/' yAxisName='Nilai UN' xAxisName='Nama Pendaftar' numberPrefix='' numberSuffix=' ' formatNumberScale='0' showValues='1' rotateValues='1' placeValuesInside='1' pieRadius='150' paletteColors='#bf0d0d' decimalSeparator=',' basefontcolor='#194920' plotgradientcolor='' thousandSeparator='.' showRealTimeValue='1' refreshInterval='1'> ";
			$data2 = "";
			
			foreach($hasil as $k):
			$data2 .= "<set label='$k->nm_siswa' value='$k->nem'  />";
			endforeach;
			
			$dataXML = $data1 . $data2 . "</chart>";
			
			return $dataXML;		
		}
		
		public function get_pass_psb_reg($id_sekolah)
		{
		}
		
		
	}
	
	/* End of file home.php */
	/* Location: ./application/controllers/home.php */
