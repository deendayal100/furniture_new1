<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 //$store_id = $this->session->userdata["store_user"]["store_id"];
				 
			  }


public function index()
  {
	 
	    $data["page"]="Category";
	    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_ORDER,array());
	    $this->load->view('store/orders',$data);
 }


   
}

