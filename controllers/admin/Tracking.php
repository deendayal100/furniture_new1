<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tracking extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
			  }


public function index()
  {
	 
	    $data["page"]="Tracking";
	    $data["view"] = $this->db->query("select * from invoice where sent_to_rt=1 group by orderno")->result();
	    $this->load->view('admin/tracking',$data);
 }
 
 public function view($id){
    $data["view"] = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id));
    $data["orders"] = $this->Home_model->get_tbl_data(TBL_INVOICE,array('orderno'=>$data["view"]->orderno));
    $data["calls"] = $this->Home_model->get_tbl_data(TBL_CALL_SMS,array('invoice_id'=>$id,'type'=>'CALL'));
    $data["SMS"] = $this->Home_model->get_tbl_data(TBL_CALL_SMS,array('invoice_id'=>$id,'type'=>'SMS'));
    $data["comments"] = $this->Home_model->get_tbl_data(TBL_COMMENT,array('invoice_id'=>$id));
    $data["status"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno));
    $this->load->view('admin/traking_view',$data);
 }
 


   
}

