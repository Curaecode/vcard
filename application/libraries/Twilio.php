<?php 
require "twilio-php-main/src/Twilio/autoload.php";
use Twilio\Rest\Client;
class Twilio {
	private $sid;
 	private $token;
 	private $client;
 	private $from;
    public function __construct()
    {
    	$this->sid = SID_TWILIO;
		$this->token = TOKEN_TWILIO;
		$this->client = new Client($this->sid, $this->token);
		$this->from=FROM_TWILIO;
		// $this->from='+1 (262) 222-2761';
    }
    public function sendSMS($to=null,$file_path=null)
    {
		try{
		    $response=$this->client->messages->create(
			    // the number you'd like to send the message to
			    $to,
			    [
			        // A Twilio phone number you purchased at twilio.com/console
			        'from' => $this->from,
			        // the body of the text message you'd like to send
			        'body' => 'You have a new vCard.Please click to add as a contact and view your curaechoice card',
			        'mediaUrl'=>base_url().'vcards/'.$file_path,
			    ]
			);
		}
	  	catch(Exception $e)
	  	{
	    	$response =  $e->getMessage();
	  	}
	  	return $response;
  	}
    public function sendCode($to=null,$vcode=null)
    {
		try{
		    $response=$this->client->messages->create(
			    // the number you'd like to send the message to
			    $to,
			    [
			        // A Twilio phone number you purchased at twilio.com/console
			        'from' => $this->from,
			        // the body of the text message you'd like to send
			        'body' => 'Verification code: '.$vcode 
			    ]
			);
		}
	  	catch(Exception $e)
	  	{
	    	$response =  $e->getMessage();
	  	}
	  	return $response;
  	}
}