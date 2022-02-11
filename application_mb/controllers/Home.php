<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	}
	public function index()
	{
		redirect(admin_url());
	}
	
	public function hospital()
	{
		$result = $this->db->query("Select * from care_coordination where id='1'")->row();
		$data['url']=$result->embed;
		$this->load->view('qrcode/hospitals',$data);  
	}
	function testmail(){
		 
		$vcard_name='';
		$vcard_image=''; 
		$returned = $this->sendmail('haroon@ex3gen.com','Haroon',$vcard_name,$vcard_image); 
		 
		print_r($returned);
	}
	function sendmail($tomail='',$toname='',$url='',$cardimage=''){
        $body = '<table width="100%" align="center" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="center" valign="top" style="margin: 0; padding: 0;">
							<table width="600" align="center" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0"
								   style="font-family:Arial, Helvetica, sans-serif;">
								

								<tr>
									<td style="text-align: left;">

										<h1 style="font-weight: bold; font-size: 1.375em; color: #D1AC50; line-height: 38px;">To Our Valued Curaechoice Members,</h1>

										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">Welcome to the Curaechoice program!  As most of you now know, the new Curaechoice benefits program is actively being rolled out to all team members.  As a part of this rollout, digital Curaechoice vCards are being sent to every team member that has an up to date cell number on file.</p>
										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">If you are receiving this email, it appears your cell number is not current.  To ensure that you receive your digital vCard, we have enclosed your Curaechoice vCard as an attachment within this email.  Please open up your attached vCard and save this vCard onto your phone.  Having your vCard on your phone will provide you with immediate access to your vCard when utilizing the Curaechoice program.   If you encounter an issue in accessing your vCard, please email us at support@curaechoice.com.  <br></p>
										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">We are excited to have you as a part of the Curaechoice member family.  We hope that you will find your participation in the Curaechoice program to be an incredibly positive and impactful experience for you and your loved ones. <br><br></p>
										<p style="font-size: 1.375em; color: #162C53; line-height: 28px;">We thank you for the opportunity to serve you as your ally in care coordination.<br><br> </p>
									</td>
								</tr>
								 
								<tr>
									<td align="left" valign="top" style="margin: 0; padding: 0;">
										 <p style="font-size: 1.375em; color: #162C53; line-height: 28px;">Sincerely, <br>
										Your Curaechoice Support Team </p>
									</td>
								</tr>
								<tr>
									<td align="center" valign="top" style="margin: 0; padding: 0;">
										<img style="display: block;max-width:100%" src="'.base_url().'resources/img/image_logo.png" alt="" width="370" height="140">
									</td>
								</tr>
								 
								<tr>
									<td align="center" valign="top" style="margin: 0; padding: 0;">
										 <p style="font-size:10px;line-height:13px;letter-spacing:-0.01em;margin:0px;padding:0;color: #727272;">You are subscribed as '.$tomail.'. To ensure delivery of Curaehchoice vCard to your inbox, please add support@curaechoice.com to your address book.</p>
									</td>
								</tr>								
							</table>
						</td>
					</tr>
				</table>';
		$mainsubject="CuraeChoice vcard.";
        $message = 'This is test email.\nThis is test email.\nThis is test email.\n';
		
		 

		/* try{
			$post = array('from' => 'support@curaechoice.com',
			'fromName' => 'Curaechoice',
			'apikey' => '00D63CA7E118D2617832E4E6A86774A914B69CD7EB79BBF868FBCF3C08AD3003EB192494F7F5679D5E11DFB254DBE125',
			'subject' => $mainsubject,
			'to' => $tomail,
			'bodyHtml' => $body,
			'bodyText' => strip_tags($body),
			'file_1' => new CurlFile($file_name_with_full_path, $filetype, $filename),
			'isTransactional' => false);
			
			$ch = curl_init();
			curl_setopt_array($ch, array(
				CURLOPT_URL => $weburl,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $post,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
				CURLOPT_SSL_VERIFYPEER => false
			));
			
			$result=curl_exec ($ch);
			curl_close ($ch); 

			 $data["message"] = "Message sent correctly!";
			 $data["status"] = true;	
		} catch(Exception $ex){ 
			 $data["message"] = "Error: " . $ex->getMessage(); ;
             $data["status"] = false;
		} */
	
 
		  $this->load->library('My_PHPMailer');
		 
		$mail = new PHPMailer(); 
		 $mail->IsSMTP(true);  
		$mail->SMTPAuth = true;  
		$mail->SMTPSecure = "STARTTLS";
        $mail->Host       = "smtp.elasticemail.com";      // setting GMail as our SMTP server
        $mail->Port       = 587;                   // SMTP port to connect to GMail
		$mail->SMTPDebug = 1;
        $mail->Username   = "support@curaechoice.com";  // user email address
        $mail->Password   = "AFE78A029B1CC384813FCA963E1296099635";            // password in GMail
        $mail->SetFrom('support@curaechoice.com', 'Curaechoice');  //Who is sending the email
        $mail->AddReplyTo("support@curaechoice.com","Curaechoice");  //email address that receives the response
        $mail->Subject    = $mainsubject;
        $mail->Body      = $body;
        $mail->AltBody    = strip_tags($body); 
        $mail->AddAddress($tomail, $toname);
        $mail->AddReplyTo('support@curaechoice.com', 'Curaechoice');
  
		
		  
         if(!$mail->Send()) {
             $data["message"] = "Error: " . $mail->ErrorInfo;
             $data["status"] = false;
        } else {
             $data["message"] = "Message sent correctly!";
			 $data["status"] = true;
        }  	
		return $data;
    }
}
