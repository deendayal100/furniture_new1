<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 require_once(APPPATH.'libraries/vendor/php-excel-reader/excel_reader2.php');
 require_once(APPPATH.'libraries/vendor/SpreadsheetReader.php');
 require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
 
class Failed extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 //$store_id = $this->session->userdata["store_user"]["store_id"];
				 
			  }


public function index()
  {
	if($this->input->post('search') && $this->input->post('status')!='ALL'){
         $status = $this->input->post('status');
         $data["postval"] = $status;
         $data["view"] = $this->db->query("select * from invoice where status='$status' group by orderno order by id desc")->result();
    }else{
       
         $data["view"] = $this->db->query("select * from invoice where status='DELETED' group by orderno order by id desc")->result();
    }
	$this->load->view('warehouse/Failed',$data);
 }  

 public function view($id){
    $data["view"] = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id));
    $data["orders"] = $this->Home_model->get_tbl_data(TBL_INVOICE,array('orderno'=>$data["view"]->orderno));
    $mm = $data["view"]->mobile;
    $pp = $data["view"]->phone;
    $mobile =str_replace("-","",$mm);
    $phone =str_replace("-","",$pp);
    $data["calls"] = $this->db->query("select * from calls where contact='$mobile' OR contact='$phone'")->result();
    $data["SMS"] = $this->Home_model->get_tbl_data(TBL_CALL_SMS,array('invoice_id'=>$id,'type'=>'SMS'));
    $data["comments"] = $this->Home_model->get_tbl_data(TBL_COMMENT,array('invoice_id'=>$id));
    $data["status"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno));
    $this->load->view('admin/invoice_view',$data);
 }
 
  public function restore($ord){
	$this->db->query("UPDATE invoice SET status='DELIVERED' where orderno=$ord");
	$this->session->set_flashdata('message', 'Invoice has been restored successfully');
	redirect('admin/Deleted_invoice') ;
  }
  public function delete($ord){
	$this->db->query("DELETE FROM invoice where orderno=$ord");
    //$this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$ord),array('status'=>'DELETED'));
	$this->session->set_flashdata('message', 'Invoice has been deleted permanently successfully');
	redirect('admin/Deleted_invoice') ;
  }
 
}

