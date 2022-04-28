<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 require_once(APPPATH.'libraries/vendor/php-excel-reader/excel_reader2.php');
 require_once(APPPATH.'libraries/vendor/SpreadsheetReader.php');
 require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
 
class Report extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 //$store_id = $this->session->userdata["store_user"]["store_id"];
				 
			  }


public function index()
  {
      if($this->input->post('search') && $this->input->post('status')!='ALL'){
       // echo "<pre>";print_r($_POST);exit;
         $status = $this->input->post('status');
         $data["postval"] = $status;
         $data["view"] = $this->db->query("select * from invoice where status='$status' group by orderno order by id")->result();
    }else{
       
         $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' group by orderno order by id")->result();
    } 
	 
	    $data["page"]="Report";
	    //$data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array());
	    
	    $this->load->view('admin/report',$data);
 }
 
}