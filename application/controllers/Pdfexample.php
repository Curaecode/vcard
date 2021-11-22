<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdfexample extends CI_Controller{
	function __construct() { 
		parent::__construct();
		$this->load->model("admin/model");
	} 
	function index($id=1){ 
		 
		$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
		$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
		$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
	   
		$last_data=$this->model->getLastData2("contacts",$id);
		$company_id= $last_data->company_id;
		$contract_number= $last_data->contract_number;
		$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
		$data['contact']=$last_data;
		
		$this->db->select('*');
		$this->db->where('is_card',1);
		$query = $this->db->get( 'care_coordination' );
		$data['providers'] = $query->result();
		 
		$html =$this->load->view('card/indexmpdf',$data,true);
		$stylesheet =$this->load->view('card/stylesheet',[],true);   
		 
		$this->load->library('m_pdf'); 
		$pdf = $this->m_pdf->load();
		$pdf->debug = true; 
		$pdf->WriteHTML($stylesheet,1);
		$pdf->WriteHTML($html);  
		$file_name='example';		
		$pdf->Output();
    }
	function tcpdf($id=1){
		$this->load->library('pdf');
		/* $pageLayout = array($width, $height); //  or array($height, $width) 
			$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false); */

		$pdf = new Pdf('p', 'mm', 'A4', true, 'UTF-8', false);
		 
		$pdf->AddPage();
		$data['showname']=$this->model->getDatarow("config","where isVisible=1 AND name='showname'"); 
		$data['showdependent']=$this->model->getDatarow("config","where isVisible=1 AND name='showdependent'"); 
		$data['image']=$this->model->getDatarow("config","where isVisible=1 AND name='image'"); 
	   
		$last_data=$this->model->getLastData2("contacts",$id);
		$company_id= $last_data->company_id;
		$contract_number= $last_data->contract_number;
		$data['dependent']=$this->model->getdependents("contact_dependant",$contract_number);
		$data['contact']=$last_data;
		
		$this->db->select('*');
		$this->db->where('is_card',1);
		$query = $this->db->get( 'care_coordination' );
		$data['providers'] = $query->result();
		 
		 $html =$this->load->view('card/index',$data,true);  
		  
		  // output the HTML content
		/*   $pdf->writeHTML($html, true, false, true, false, ''); */
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('pdfexample.pdf', 'I');    
		 
    }
}
?>