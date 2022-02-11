<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		 parent::__construct();		
		$this->load->model("admin/model");
	
	}
	public function index(){
		if(admin())
			redirect(base_url().'admin/dashboard');
	
		$data['title']="Login";
		$formData=escapeArray($this->input->post());
		// $data=array();
		if(isset($formData['password'])){
			
				$hash=$this->model->getPassword($formData['email']);
				if(!empty($hash)){
					if(password_verify($formData['password'],$hash->password)){
						$this->session->set_userdata('adminId', $hash->id);
						$this->session->set_userdata('adminType', $hash->type);
						if($hash->type > 0){
							redirect(base_url().'admin/dashboard#contacts');
						}else{
							redirect(base_url().'admin/dashboard#contacts');
						}
						
					//redirect(base_url().'admin/dashboard#users');
				}
					else{
						$data['msg']="<div class='alert alert-danger'>Wrong Password.</div>";
					}
				}
				else{
					$data['msg']="<div class='alert alert-danger'>Wrong Username or Email.</div>";
					
				}
			
		}
		$this->load->view('codebase/login.php',$data);
	}
	public function logout(){
		$this->session->unset_userdata("adminId");
		redirect(base_url().'admin/login');
	
	}
	/* public function forgetPassword(){
		if(admin())
			redirect(base_url().'admin/dashboard');
	
		$data['title']="Forget Password";
		$formData=escapeArray($this->input->post());
		if(isset($formData['email'])){
			$id=$this->model->getData("admin","where email='".$formData['email']."'");
			$id=isset($id[0]->id)?$id[0]->id:"";
			
			if(!empty($id)){
				$id=encrypt($id);
				$url=admin_url()."login/resetPassword/".$id;
				// $msg="Your password reset link is given below <br> $url";
				// if(sendEmail($formData['email'],$msg,"ForgetPassword"))
					// $data['msg']="<div class='alert alert-success'>Email Has been sent successfully.</div>";
				redirect($url);
				die;
			}
			else{
				$data['msg']="<div class='alert alert-danger'>Your Email is wrong.</div>";
				
			}
			
		}
		$this->load->view('codebase/forgetPassword',$data);
	}
	public function resetPassword($id){
		
		if(admin())
			redirect(base_url().'admin/dashboard');
	
		$id=decrypt($id);
		count($this->model->getData("admin","where id=$id"))==0?
		redirect(base_url().'admin/login'):"";
		$data['title']="Reset Password";
		$formData=escapeArray($this->input->post());
		if(isset($formData['password'])){
			if($formData['password']==$formData['cpassword']){
						if($this->model->updateData("admin",$id,array("password"=>password_hash($formData['password'],PASSWORD_DEFAULT))))
							$data['msg']="<div class='alert alert-success'>Your Password is updated successfully.</div>";
						redirect(base_url().'admin/login');
			}
			else
				$data['msg']="<div class='alert alert-danger'>Your New password does not match.</div>";
			
		}
		$this->load->view('codebase/resetPassword',$data);
	} */
}
