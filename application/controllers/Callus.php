<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Callus extends CI_Controller{
	function __construct() { 
		parent::__construct();
		$this->load->model("admin/model");
	} 
	function index($id=1){
		 ?>
		 <script>
			window.location.href='tel:+18006469823';
		 </script>
		 <?php /* redirect('tel:+18006469823'); */
    }
}
?>