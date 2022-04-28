<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;

class Userdash extends CI_Controller {

	function __construct()
  {
    parent::__construct();
    
    $this->load->model('admin/Home_model','',TRUE);
    
  }
	public function index(){
		$customer_id = $_SESSION['current_customer_id'];
		
		if(!empty($customer_id)){
			$getemail =  $this->db->query("select email,firebase_id from customer where id='$customer_id'")->result();
			$data["email_id"]  = $getemail[0]->email;
			$data['firebase_id']=$getemail[0]->firebase_id;
			$data["replies"] = $this->db->query("select * from customer_order_reply where customer_id='$customer_id' ")->result();
			$data["additional_message"] = $this->db->query("select * from customer_additional_item_message where customer_id='$customer_id' ")->result();
			$data["order_container"] = $this->db->query("select * from order_uploaded_images where customer_id='$customer_id'")->result();
			$data["admin_replied"] = $this->db->query("select * from customer_response where customer_id='$customer_id'")->result();
		}else{
	      $data["replies"] = '';
	      $data["additional_message"] = '';
	      $data["order_container"] = '';
	      $data["admin_replied"] = '';
	      $data['firebase_id']='';
    	}
    	//$userData=$this->session->get_userdata('admin_user');
  	
  	$data["admin_firebase_id"]='d1641fc5f6a63cb02';
    	
		$this->load->view('userdash',$data);
	}

	public function view($id){
	   // $data['page'] = $_GET['index'];
	    $va = $this->Home_model->get_single_row(TBL_INVOICE,array('orderno'=>$id));
	    if($va){
	        $data["view"] = $va;
	    }else{
	        $data["view"] = $id;
	    }
	    
	    $mm = isset($va) ? $data["view"]->mobile : '';
	    $pp = isset($va) ? $data["view"]->phone : '';
	    $mobile =str_replace("-","",$mm);
	    $phone =str_replace("-","",$pp);
	    $data["calls"] = $this->db->query("select * from calls where contact='$mobile' OR contact='$phone'")->result();
	    $data["SMS"] = $this->Home_model->get_tbl_data(TBL_CALL_SMS,array('invoice_id'=>$id,'type'=>'SMS'));
	    $data["comments"] = $this->Home_model->get_tbl_data(TBL_COMMENT,array('invoice_id'=>$id));
	    $data["status"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>isset($va) ? $data["view"]->orderno : $id));
	    $data["driverstatus"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>isset($va) ? $data["view"]->orderno : $id,'type'=>'DRIVER'));
	    $this->load->view('userdash_invoice_view',$data);
	 }


public function sendNoty(){
	$time=date('d-m-Y h:i:s',time());
	$inputs = array(
          'sender_id'=>$this->input->post('userId'),
          'time'=>$time,
          'status'=>'unread',
        ); 
	 $insert = $this->Home_model->insert('notification',$inputs);

	echo $insert;
}


	public function handleReply(){
		/* print_r($this->input->post());
		exit; */
		$inputs = array(
          'order_number'=>$this->input->post('order_number'),
          'customer_id'=>$this->input->post('customer_id'),
          'use_aftersale_service'=>$this->input->post('use_aftersale_service'),
          'more_options'=>$this->input->post('more_options'),
          'more_options_date'=>$this->input->post('more_options_date'),
        );         
        $insert = $this->Home_model->insert('customer_response',$inputs);
        if($insert){
			if($this->input->post('email_id')){

				$custid=$this->input->post('email_id');
          $getemail =  $this->db->query("select email,phone from customer where email='$custid'")->result();

				$to = $this->input->post('email_id');
				//$to = 'pawan.appic@gmail.com';
				$subject = 'You have submitted the request';
				 
				$message = '<table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
				  <tr>
					<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
					<td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
					  <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

						<!-- START CENTERED WHITE CONTAINER -->
						<table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

						  <!-- START MAIN CONTENT AREA -->
						  <tr>
							<td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
							  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
								<tr>
								  <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
									<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi there,</p>
									<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">You have submitted the request.</p>
									<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">" Customer has 15 days to collect back the item after which a storage fee of Rs 100 per day will be charged. If the item has not yet been collected within 30 days, the company shall dispose of the item without any liabilities or refund and without notice. The company shall not be liable for any damaged caused to the item after the 30 days initial period".</p>
									<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Check status at <a href="https://aftersale.furniture/furniture.mu/Userdash/" target="_blank">link</a>.</p>
									<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Thanks</p>
								  </td>
								</tr>
							  </table>
							</td>
						  </tr>
						</table>
					  </div>
					</td>
					<td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
				  </tr>
				</table>';
				 
				$header = "From:service@furniture.mu \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";
				mail ($to,$subject,$message,$header);

				$msg="Hi there,You have submitted the request.Customer has 15 days to collect back the item after which a storage fee of Rs 100 per day will be charged. If the item has not yet been collected within 30 days, the company shall dispose of the item without any liabilities or refund and without notice. The company shall not be liable for any damaged caused to the item after the 30 days initial period. Check status at  https://aftersale.furniture/furniture.mu/Userdash/  <br> Thanks";
				 /*   SMS API CODE START */
                   
                    $sid = SID;
                    $token = TOKEN;
                    $client = new Client($sid, $token);
                    $phone = '+230'.trim($getemail[0]->phone); 
                   // $phone = '+91'.trim($this->input->post('mobileno'));
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => 'furniture.mu',
                            'body' => $message
                        )
                    );  
  
                    /*   SMS API CODE END */
		  }
        	$result = array('status'=>'true','message'=>'Your reply succesfully send');          
        }else{
        	$result = array('status'=>'false','message'=>'Something went wrong!');
        } 		 
		echo json_encode($result);die;

	}
	
}
