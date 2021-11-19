<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Pdfexample extends CI_Controller{
	function __construct() { 
		parent::__construct();
	} 
	function index(){
		$this->load->library('Pdf');
		/* $pageLayout = array($width, $height); //  or array($height, $width) 
			$pdf = new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false); */

		$pdf = new Pdf('p', 'mm', 'A6', true, 'UTF-8', false);
		// add a page
		$pdf->AddPage();

		 

		 $html = <<<EOF
<div class="print-format" style="display: flex; flex-direction: column;">  <div transform:="" scale(0.334,0.334);="" margin:0px="" auto;="" background:#f3fafb;"="">
<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
<tbody><tr>
<td>
	<table cellspacing="0" cellpadding="0" border="0" bgcolor="#fff" align="center" height="100%" width="100%">
	<tbody>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" height="232" width="100%" style="background-repeat: no-repeat;background-size: cover;background-position: right top;background-image: url(/files/dscbg.jpg);">
				<tbody>
				<tr>
				<td align="left" valign="middle" bgcolor="#fff" style="padding:15px  !important;background: rgba(39, 169, 225, 0.4);">
				</td>
				</tr>
				</tbody>
			</table>
		</td>
		</tr>

		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" height="232" style="margin-top:-135px;" width="250">
			<tbody>
				<tr>
				<td align="center" valign="middle" bgcolor="#fff" style="padding:0px  !important; background:none;"><img style="border-radius: 5px;border: 10px solid #fff;display: block;" height="240" alt="user" src="/files/haroon_profile.jpg">
				</td>
				</tr>
			</tbody>
			</table>
		</td>
		</tr>

		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tbody>
				<tr>
					<th colspan="5" align="center" style="padding:15px; text-align: center;">
					<h1 style="margin:10px 0px; font-size:60px; font-weight:bold; line-height:60px; color:#212121;">Muhammad Abbas</h1>
					<p style="margin:5px 0px 0px 0px; font-size:24px; text-transform:uppercase; font-weight:600; line-height:23px; color:#212121; padding:5px 0px;">Senior Software Engineer</p>
					</th>
				</tr>
				<tr>
					<td colspan="5" style="padding:15px 15px;"></td>
				</tr>
				<tr style="font-size:25px;">
					<td style="padding:8px 10px  !important;" width="15%"></td>
					<td style="padding:8px 10px  !important;" width="30%">Employee ID</td>
					<td style="padding:8px 10px  !important;" width="10%">:</td>
					<td style="padding:8px 10px  !important;" width="40%"><strong>EMP-MM-00013</strong></td>
					<td style="padding:8px 10px  !important;" width="5%"></td>
				</tr>
				<tr style="font-size:25px;">
					<td style="padding:8px 10px  !important;" width="15%"></td>
					<td style="padding:8px 10px  !important;" width="30%">CNIC</td>
					<td style="padding:8px 10px  !important;" width="10%">:</td>
					<td style="padding:8px 10px  !important;" width="40%"><strong>37405-5251901-5</strong></td>
					<td style="padding:8px 10px  !important;" width="5%"></td>
				</tr>
				<tr style="font-size:25px;">
					<td style="padding:8px 10px  !important;" width="15%"></td>
					<td style="padding:8px 10px  !important;" width="30%">Project Center</td>
					<td style="padding:8px 10px  !important;" width="10%">:</td>
					<td style="padding:8px 10px  !important;" width="40%"><strong>Head Office</strong></td>
					<td style="padding:8px 10px  !important;" width="5%"></td>
				</tr>
				<tr style="font-size:25px;">
					<td style="padding:8px 10px  !important;" width="20%"></td>
					<td style="padding:8px 10px  !important;" width="30%">Blood Group</td>
					<td style="padding:8px 10px  !important;" width="10%">:</td>
					<td style="padding:8px 10px  !important;" width="30%"><strong>A+</strong></td>
					<td style="padding:8px 10px  !important;" width="10%"></td>
				</tr>
				<tr style="font-size:25px;">
					<td style="padding:8px 10px !important;" width="20%"></td>
					<td style="padding:8px 10px !important;" width="30%">Emergency No.</td>
					<td style="padding:8px 10px !important;" width="10%">:</td>
					<td style="padding:8px 10px !important;" width="30%"><strong>03325994882</strong></td>
					<td style="padding:8px 10px !important;" width="10%"></td>
				</tr>
				<tr style="font-size:25px;">
					<td style="padding:8px 10px  !important;" width="20%"></td>
					<td style="padding:8px 10px  !important;" width="30%">Expiry Date</td>
					<td style="padding:8px 10px  !important;" width="10%">:</td>
					<td style="padding:8px 10px  !important;" width="30%"><strong style="color:red;">31.12.2020</strong></td>
					<td style="padding:8px 10px  !important;" width="10%"></td>
				</tr>
				<tr>
					<td colspan="5" style="padding: 13px  !important;"></td>
				</tr>

			</tbody>
			</table>
		</td>
		</tr>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-top:1px solid #dae4f5; border-bottom:8px solid #4e4e4e;background-repeat: no-repeat;background-size: cover;background-position: right top;background-image: url(files/bottom-b-bg.png);">
			<tbody>
			<tr>
				<td align="center" valign="middle" style="padding:15px 0px !important;line-height: 20px; color:#fff;font-family:Arial;font-size:20px">This card is the property of MicroMerger (Pvt.) Ltd. <br>If found please return to:<br>Plot No. 395-396 I-9/3 (Service Road North),<br>Islamabad, Pakistan. Phone: 051 8444 777<br> www.micromerger.com
				</td>
										
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
		<tr>
		<td align="center" style="background:#f3fafb;" valign="top">
			<table cellspacing="0" cellpadding="0" border="0" width="100%" style=" background:#e9f7fe;">
			<tbody>
			<tr>
				<td align="left" valign="top" style="padding:20px 10px !important;">
					<img height="55" alt="Micromerger" src="files/mm96ab19.png">
				</td>
				<td align="right" valign="top" style="padding:20px 10px !important;">
					<img height="55" alt="Data Support Center" src="files/dscFront.png">
				</td>
										
			</tr>
			</tbody>
			</table>
		</td>
		</tr>
	</tbody>
	</table>
</td>
</tr>
</tbody></table>
</div></div>
EOF;
		// output the HTML content
		  $pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('pdfexample.pdf', 'I');  
		 
    }
}
?>