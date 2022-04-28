<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
class Main extends CI_Controller {
	  
	  function  __construct() {
        parent::__construct();
		 
		 $this->load->model('admin/Home_model','Apimodel',TRUE);
         $this->load->library('form_validation');
         
    }

public function index(){
      echo "Silence is Golden";
  }
  
/*      1)  Login start   */

 public function login()
  {
    $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
	$this->form_validation->set_rules('password', 'Password', 'trim|required');
//	$this->form_validation->set_rules('fcm_token', 'Fcm Token', 'trim|required');
	if($this->form_validation->run() == FALSE)
    {
        $message = strip_tags(validation_errors());
        $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
        
    }
    else
    {
	  $phone = $this->input->post("phone") ;
	  $password = $this->input->post("password");
      $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('mobile'=>$phone,'password'=>$password));
      if($checkuser)
      {
       
        //$updt = $this->Apimodel->update(TBL_DRIVER,$checkuser->id,array('fcm_token'=>$this->input->post("fcm_token")));
            $driverdta = $this->Apimodel->get_single_row(TBL_DRIVER,array('id'=>$checkuser->id));
            $result = array('status'=>TRUE, 'message'=>"User data", 'data'=>$driverdta);
       }
       else
       {
	        $result = array('status'=>TRUE, 'message'=>"Not registered");
	   }
	}
	
	echo json_encode($result) ;
  }
/*        Login end   */
 
/*      2)  show order start      */ 

 public function orders(){
	 
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	    if($this->form_validation->run() == FALSE){
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }else{
            $driverid = $this->input->post("driver_id") ;
            $status = $this->input->post("status") ;
            $driverdata = $this->Apimodel->get_single_row(TBL_DRIVER,array('id'=>$driverid));
            if(!empty($driverdata)){
                $nul = 'NULL';
              if($status=="DELIVERED"){
                  $orderdata = $this->db->query("select * from assign where driver_id=$driverid and delivery_note_no!='From Customer' and cancel_status=1 and dn_submit is NULL and ( status='Delivered' OR status='Not delivered')")->result();
              }else{
                  $orderdata = $this->db->query("select * from assign where driver_id=$driverid and delivery_note_no!='From Customer' and cancel_status=1 and dn_submit is NULL and ( status='Assigned' || status='On the way')")->result();
              }
              if(!empty($orderdata)){
                  foreach($orderdata as $ord){
                      $comment = $this->Apimodel->get_single_row(TBL_COMMENT,array('orderno'=>$ord->order_no,'type'=>'RT'));
                      if(!empty($comment)){
                        $comm = $comment->comment;  
                      }else{
                          $comm = "";
                      }
                      $invoicedata = $this->Apimodel->get_single_row(TBL_INVOICE,array('orderno'=>$ord->order_no));
                       if($invoicedata){
                       	$val["assign_id"] = $ord->id;
	                      $val["orderno"] = $invoicedata->orderno;
	                      $val["order_date"] = $invoicedata->order_date;
	                      $val["quantity_to_deliver"] = $invoicedata->txt_Quantity;
	                      $val["detail"] = $invoicedata->Description ;
	                      $val["order_note"] = $invoicedata->order_note;
	                      $val["customer_name"] = $invoicedata->name;
	                      $val["mobile"] = $invoicedata->mobile;
	                      $val["phone"] = $invoicedata->phone;
	                      $val["address"] = $invoicedata->txtAddress;
	                      $val["image"] = $ord->image;
	                      $val["delivery_address"] = $ord->delivery_address 	;
	                      $val["del_lat"] = $ord->del_lat;
	                      $val["del_lon"] = $ord->del_lon;
	                      $val["status"] = $ord->status;
	                      $val["gpslink"] = $invoicedata->gps_code;
	                      $val["comment"] = $comm;
	                      $val["delivery_note_no"] = $ord->delivery_note_no;
	                      $arr[] = $val;
                       }
                      
                  }
                  $result = array('status'=>TRUE, 'message'=>'Order list','data'=>$arr);  
              }else{
                  $result = array('status'=>FALSE, 'message'=>'No order found');  
              }
            }else{	
              $result = array('status'=>FALSE, 'message'=>'Driver not found');  
            }
    }
        echo json_encode($result);
        //return $this->response($result);
        die();
 }
	public function aftersaleOrders(){
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	    if($this->form_validation->run() == FALSE){
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
        }else{
            $driverid = $this->input->post("driver_id") ;
            $status = $this->input->post("status") ;
            $driverdata = $this->Apimodel->get_single_row(TBL_DRIVER,array('id'=>$driverid));
            if(!empty($driverdata)){
                $nul = 'NULL';
              if($status=="DELIVERED"){
                  $orderdata = $this->db->query("select * from assign where driver_id=$driverid and delivery_note_no='From Customer' and cancel_status=1 and dn_submit is NULL and ( status='Delivered' OR status='Not delivered')")->result();
              }else{
                  $orderdata = $this->db->query("select * from assign where driver_id=$driverid and delivery_note_no='From Customer' and cancel_status=1 and dn_submit is NULL and ( status='Assigned' || status='On the way')")->result();
              }
              if(!empty($orderdata)){
                  foreach($orderdata as $ord){
                      $comment = $this->Apimodel->get_single_row(TBL_COMMENT,array('orderno'=>$ord->order_no,'type'=>'RT'));
                      if(!empty($comment)){
                        $comm = $comment->comment;  
                      }else{
                          $comm = "";
                      }
                      $invoicedata = $this->Apimodel->get_single_row(TBL_INVOICE,array('orderno'=>$ord->order_no));
                      $val["assign_id"] = $ord->id;
                      $val["orderno"] = isset($invoicedata) ? $invoicedata->orderno : '';
                      $val["order_date"] = isset($invoicedata) ? $invoicedata->order_date : '';
                      $val["quantity_to_deliver"] = isset($invoicedata) ? $invoicedata->txt_Quantity : '';
                      $val["detail"] = isset($invoicedata) ? $invoicedata->Description : '';
                      $val["order_note"] = isset($invoicedata) ? $invoicedata->order_note : '';
                      $val["customer_name"] = isset($invoicedata) ? $invoicedata->name : '';
                      $val["mobile"] = isset($invoicedata) ? $invoicedata->mobile : '';
                      $val["phone"] = isset($invoicedata) ? $invoicedata->phone : '';
                      $val["address"] = isset($invoicedata) ? $invoicedata->txtAddress : '';
                      $val["image"] = $ord->image;
                      $val["delivery_address"] = $ord->delivery_address 	;
                      $val["del_lat"] = $ord->del_lat;
                      $val["del_lon"] = $ord->del_lon;
                      $val["status"] = $ord->status;
                      $val["gpslink"] = isset($invoicedata) ? $invoicedata->gps_code : '';
                      $val["comment"] = $comm;
                      $val["delivery_note_no"] = $ord->delivery_note_no;
                      if($invoicedata){
                      $arr[] = $val;
                      }
                  }
                  $result = array('status'=>TRUE, 'message'=>'Order list','data'=>isset($arr) ? $arr : []);  
              }else{
                  $result = array('status'=>FALSE, 'message'=>'No order found');  
              }
            }else{	
              $result = array('status'=>FALSE, 'message'=>'Driver not found');  
            }
    }
        echo json_encode($result);
	}
 public function mobilelist(){
		$order_id = $this->input->post("order_id");
		$orderdata = $this->db->query("select mobile from invoice where orderno=$order_id")->result();
		if(!empty($orderdata)){
			foreach($orderdata as $ord){
				$val["mobile"] = $ord->mobile;
				$arr[] = $val;
			}
			$result = array('status'=>TRUE, 'message'=>'Order list','data'=>$arr);  
		}else{
			$result = array('status'=>FALSE, 'message'=>'No order found');  
		}
        echo json_encode($result);
 }
 
 /*        show order End   */
 
 /*      3)  change status start      */ 
	public function aftersaleChangestatus(){
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    $this->form_validation->set_rules('orderno', 'Order number', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	    $this->form_validation->set_rules('assign_id', 'assign_id', 'trim|required');
	    if($this->form_validation->run() == FALSE){
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
        }else{
            $driver_id = $this->input->post("driver_id") ;
            $status = $this->input->post("status") ;
            $orderno = $this->input->post("orderno") ;
            $msg = $this->input->post("msg") ;
            $assign_id = $this->input->post("assign_id") ;
            $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('id='=>$driver_id));
            $assign = $this->Apimodel->get_single_row(TBL_ASSIGN,array('id='=>$assign_id));
            if($checkuser){
             if($status=="Not Completed" || $status=="Completed"){
				if(!empty($_FILES['image']['name'])){
					$filename = $_FILES["image"]["name"]; 
					$tempname = $_FILES["image"]["tmp_name"];
					$file_size =$_FILES['image']['size'];
					$folder = "uploads/Driver/from_customer/".$filename;
					if (move_uploaded_file($tempname, $folder))  { 
						$image = "uploads/Driver/from_customer/$filename";				
					}else{ 
						$image = ""; 
					}
				}else{
				  $image ="";  
				} 
				if(!empty($_FILES['image1']['name'])){
					$filename = $_FILES["image1"]["name"]; 
					$tempname = $_FILES["image1"]["tmp_name"];
					$file_size =$_FILES['image1']['size'];
					$folder = "uploads/Driver/from_customer/".$filename;
					if (move_uploaded_file($tempname, $folder))  { 
						$image1 = "uploads/Driver/from_customer/$filename";				
					}else{ 
						$image1 = ""; 
					}
				}else{
				  $image1="";
				} 
				if(!empty($_FILES['image2']['name'])){
					$filename = $_FILES["image2"]["name"]; 
					$tempname = $_FILES["image2"]["tmp_name"];
					$file_size =$_FILES['image2']['size'];
					$folder = "uploads/Driver/from_customer/".$filename;
					if (move_uploaded_file($tempname, $folder))  { 
						$image2 = "uploads/Driver/from_customer/$filename";				
					}else{ 
						$image2 = ""; 
					}
				}else{
				  $image2="";
				}   
				if(!empty($_FILES['image3']['name'])){
					$filename = $_FILES["image3"]["name"]; 
					$tempname = $_FILES["image3"]["tmp_name"];
					$file_size =$_FILES['image3']['size'];
					$folder = "uploads/Driver/from_customer/".$filename;
					if (move_uploaded_file($tempname, $folder))  { 
						$image3 = "uploads/Driver/from_customer/$filename";				
					}else{ 
						$image3 = ""; 
					}
				}else{
				  $image3="";
				}
				if(!empty($_FILES['image4']['name'])){
					$filename = $_FILES["image4"]["name"]; 
					$tempname = $_FILES["image4"]["tmp_name"];
					$file_size =$_FILES['image4']['size'];
					$folder = "uploads/Driver/from_customer/".$filename;
					if (move_uploaded_file($tempname, $folder))  { 
						$image4 = "uploads/Driver/from_customer/$filename";				
					}else{ 
						$image4 = ""; 
					}
				}else{
				  $image4="";
				}
				if(!empty($_FILES['image5']['name'])){
					$filename = $_FILES["image5"]["name"]; 
					$tempname = $_FILES["image5"]["tmp_name"];
					$file_size =$_FILES['image5']['size'];
					$folder = "uploads/Driver/from_customer/".$filename;
					if (move_uploaded_file($tempname, $folder))  { 
						$image5 = "uploads/Driver/from_customer/$filename";				
					}else{ 
						$image5 = ""; 
					}
				}else{
				  $image5="";
				}
				if($status=="Not Completed"){
					$res = $this->input->post('reason');
					$makestatus = 'FROM DRIVER';
				}else{
					$res = "";
					$makestatus = $status;
				}
				$usd = array(
				   "status" => $status,
				   "image" =>$image,
				   "image1" =>$image1,
				   "image2" =>$image2,
				   "image3" =>$image3,
				   "image4" =>$image4,
				   "image5" =>$image5,
				   "record_time" =>date('Y-m-d H:i:s'),
				   "delivery_time"=>date('Y-m-d H:i:s'),
				   "del_lat"=>$this->input->post('current_lat'),
				   "del_lon"=>$this->input->post('current_lon'),
				   "reason"=>$res,
				   "delivery_address"=>$this->input->post('current_address')
				) ;
             }else{
				$img ='';
				$usd = array("status" => $status,"image" =>$img) ;
             } 
			
            if($this->Apimodel->update_where(TBL_ASSIGN,array('order_no'=>$orderno),$usd)){
				$instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'ORDER','assign_id'=>$assign_id,'orderno'=>$assign->order_no,'status'=>$status,'created_on'=>date('Y-m-d h:i:s')));
				
				if($status=="Not Completed"){
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status,"status"=>'UNDELIVERED'));
				}else if($status=="Completed"){
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status,"status"=>'FROM DRIVER'));
				}else{
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status));
				}
                $result = array('status'=>TRUE, 'message'=>'Changed Successfully','data'=>$usd); 
            }else{
                $result = array('status'=>FALSE, 'message'=>'Update Failed');  
            }
			
		}else{		
           $result = array('status'=>FALSE, 'message'=>"No user found");
        }
		}
        echo json_encode($result);
	}
	
 public function changestatus(){
	 
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    $this->form_validation->set_rules('orderno', 'Order number', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	    
	    $this->form_validation->set_rules('assign_id', 'assign_id', 'trim|required');
	    if($this->form_validation->run() == FALSE)
        {
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }
        else
        {
            $driver_id = $this->input->post("driver_id") ;
            $status = $this->input->post("status") ;
            $orderno = $this->input->post("orderno") ;
            $msg = $this->input->post("msg") ;
            $assign_id = $this->input->post("assign_id") ;
            $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('id='=>$driver_id));
            $assign = $this->Apimodel->get_single_row(TBL_ASSIGN,array('id='=>$assign_id));
            if($checkuser){
             if($status=="Not delivered" || $status=="Delivered"){
				 if(!empty($_FILES['image']['name']))
				{
				  $image =  $this->image('image','Driver/not_delivered/'); 
				}else{
				  $image ="";  
				} 
				if(!empty($_FILES['image1']['name']))
				{
				  $image1 =  $this->image('image1','Driver/not_delivered/');
				}else{
				  $image1="";
				} 
				if(!empty($_FILES['image2']['name']))
				{
				  $image2 =  $this->image('image2','Driver/not_delivered/');
				}else{
				  $image2="";
				}   
				 if(!empty($_FILES['image3']['name']))
				{
				  $image3 =  $this->image('image3','Driver/not_delivered/');
				}else{
				  $image3="";
				}
				if(!empty($_FILES['image4']['name']))
				{
				  $image4 =  $this->image('image4','Driver/not_delivered/');
				}else{
				  $image4="";
				}
				if(!empty($_FILES['image5']['name']))
				{
				  $image5 =  $this->image('image5','Driver/not_delivered/');
				}else{
				  $image5="";
				}
				if($status=="Not delivered"){
					$res = $this->input->post('reason');
					$makestatus = 'FROM DRIVER';
				}else{
					$res = "";
					$makestatus = $status;
				}
				 $usd = array(
							   "status" => $status,
							   "image" =>$image,
							   "image1" =>$image1,
							   "image2" =>$image2,
							   "image3" =>$image3,
							   "image4" =>$image4,
							   "image5" =>$image5,
							   "record_time" =>date('Y-m-d H:i:s'),
							   "delivery_time"=>date('Y-m-d H:i:s'),
							   "del_lat"=>$this->input->post('current_lat'),
							   "del_lon"=>$this->input->post('current_lon'),
							   "reason"=>$res,
							   "delivery_address"=>$this->input->post('current_address')
							  ) ;
             }else{
                 $img ='';
                  $usd = array(
			               "status" => $status,
			               "image" =>$img,
						  ) ;
             } 
			
            if($this->Apimodel->update_where(TBL_ASSIGN,array('order_no'=>$orderno),$usd))
            {
               /* $instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'ORDER','assign_id'=>$assign_id,'orderno'=>$assign->order_no,'status'=>$status,'created_on'=>date('Y-m-d h:i:s')));
			   $instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'DRIVER','assign_id'=>$assign_id,'orderno'=>$assign->order_no,'status'=>$status,'created_on'=>date('Y-m-d h:i:s')));
				if($status=="Not delivered"){
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status,"status"=>'UNDELIVERED'));
				}else if($status=="Delivered"){
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status,"status"=>'DELIVERED'));
				}else{
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status));
				} */
				
				$instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'ORDER','assign_id'=>$assign_id,'orderno'=>$assign->order_no,'status'=>$status,'created_on'=>date('Y-m-d h:i:s')));
				
				if($status=="Not delivered"){
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status,"status"=>'UNDELIVERED'));
				}else if($status=="Delivered"){
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status,"status"=>'FROM DRIVER'));
				}else{
					$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status));
				}
				
                $result = array('status'=>TRUE, 'message'=>'Changed Successfully','data'=>$usd); 
            }
            else
            {
                $result = array('status'=>FALSE, 'message'=>'Update Failed');  
            }
			
		}else
        {		
           $result = array('status'=>FALSE, 'message'=>"No user found");
        }
    }
        echo json_encode($result);
 }
 
   public function image($name,$path)
{
     if(!empty($_FILES[$name]['name']))
		{
			$_FILES['file']['name'] = $_FILES[$name]['name'];
			$_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'] ;
			$_FILES['file']['size'] = $_FILES[$name]['size'] ;
			$config['upload_path'] = 'uploads/'.$path;
			$config['allowed_types'] = 'png|gif|jpg|jpeg';
		 	$config['file_name'] = $_FILES['file']['name'];
			
			
			$photo=explode('.',$_FILES[$name]['name']); 
			$ext = strtolower($photo[count($photo)-1]); 
			if (!empty($_FILES[$name]['name'])) { 
			
				$curr_time = time(); 
				$filename= $this->input->post('name')."_image_".time().".".$ext; 
				} 
			 $config['file_name'] = $filename; 
			
			//Load upload library and initialize configuration
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
				if($this->upload->do_upload('file'))
				{
					 $uploadData = $this->upload->data();
					return $deal1image = "uploads/".$path.$uploadData['file_name'];
				}else{
					return $deal1image = '';
				}
		}else{
		return	$deal1image = '' ;
		}	 
					
}
 
 /*       change status End   */
 /* public function sendmsg(){
	 
	    $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
	    $this->form_validation->set_rules('message', 'Message', 'trim|required');
	    if($this->form_validation->run() == FALSE)
        {
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }
        else
        {
            $mobile = $this->input->post("mobile") ;
            $msg = $this->input->post("message") ;
            $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('id='=>$driver_id));
            if($checkuser)
            {
             
			 $usd = array(
			               "orderno"=>$orderno,    
			               "master" => 'DRIVER',
			               "type"=>'SMS',
			               "date"=>date('Y-m-d'),
			               "time"=>date('H:i:s'),
			               "remark" =>$msg,
			               "created_on"=>date('Y-m-d H:i:s')
						  ) ;
            if($this->Apimodel->insert(TBL_CALL_SMS,$usd))
            {
                $result = array('status'=>TRUE, 'message'=>'Changed Successfully','data'=>$usd); 
            }
            else
            {
                $result = array('status'=>FALSE, 'message'=>'Update Failed');  
            }
			
		}else
        {		
           $result = array('status'=>FALSE, 'message'=>"No user found");
        }
    }
        echo json_encode($result);
 } */
 public function sendmsg(){
	 
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
	    $this->form_validation->set_rules('orderno', 'Order number', 'trim|required');
	    $this->form_validation->set_rules('message', 'Message', 'trim|required');
	    if($this->form_validation->run() == FALSE)
        {
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }
        else
        {
            $driver_id = $this->input->post("driver_id") ;
            $mobile = $this->input->post("mobile") ;
			$orderno = $this->input->post("orderno") ;
            $msg = $this->input->post("message") ;
			
			$sid = SID;
			$token = TOKEN;
			$client = new Client($sid, $token);
			$phone = '+230'.trim($mobile); 
			$client->messages->create(
			$phone,
				array(
					'from' => 'FURNITUR.MU',
					'body' => $msg
				)
			);
            $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('id='=>$driver_id));
            if($checkuser)
            {
             
			 $usd = array(
			               "orderno"=>$orderno,    
			               "master" => 'DRIVER',
			               "type"=>'SMS',
						   "mobile"=>$mobile,
			               "date"=>date('Y-m-d'),
			               "time"=>date('H:i:s'),
			               "remark" =>$msg,
			               "created_on"=>date('Y-m-d H:i:s')
						  ) ;
            if($this->Apimodel->insert(TBL_CALL_SMS,$usd))
            {
                $result = array('status'=>TRUE, 'message'=>'Changed Successfully','data'=>$usd); 
            }
            else
            {
                $result = array('status'=>FALSE, 'message'=>'Update Failed');  
            }
			
		}else
        {		
           $result = array('status'=>FALSE, 'message'=>"No user found");
        }
    }
        echo json_encode($result);
 }
 public function testmsg(){
       /*   SMS API CODE START */
                    echo SID;
		$sid = SID;
		$token = TOKEN;
		$client = new Client($sid, $token);
		$phone = '+23058950560'; 
		$client->messages->create(
		$phone,
			array(
				'from' => 'FURNITURE.MU',
				'body' => 'test msg from api'
			)
		); 
		/*$to = "pawan.appic@gmail.com";
        $subject = "Your complaint reviewed by our team";
			 
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
								<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your complaint has been reviewed by our team.</p>
								<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">To check the status of your complaint click on <a href="http://aftersale.furniture/Register/" target="_blank">link</a>.</p>
								<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Username - Email given at the time of registration<br>Password - Order ID</p>
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
         
		$header = "From:info@promo.mu \r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
         
		$retval = mail ($to,$subject,$message,$header);
         
		if( $retval == true ) {
            echo "Message sent successfully...";
		}else {
            echo "Message could not be sent...";
		}*/
		/*   SMS API CODE END */   
  }
  public function dn_submit(){
	 
	    $this->form_validation->set_rules('driver_id', 'driver_id', 'trim|required');
	    $this->form_validation->set_rules('assign_id', 'assign_id', 'trim|required');
	    if($this->form_validation->run() == FALSE)
        {
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }
        else
        {
            $driver_id = $this->input->post("driver_id") ;
            $assign_id = $this->input->post("assign_id") ;
            $assign = $this->Apimodel->get_single_row(TBL_ASSIGN,array('id='=>$assign_id));
            if($assign)
            {
               if($assign->status=='Not delivered'){
                   $usd = array(
			               "dn_submit"=>'YES', 
			               "cancel_status"=>0
			              ) ; 
			    $up = $this->Apimodel->update(TBL_ASSIGN,$assign_id,$usd);             
                $invoice = $this->Apimodel->get_single_row(TBL_ASSIGN,array('id'=>$assign->id));
                $upd = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$invoice->order_no),array('driver_id'=>0,'status'=>'DEL SCHEDULED'));         
                }else{
                    
                    $usd = array(
			               "dn_submit"=>'YES'
			              ) ; 
			         $up = $this->Apimodel->update(TBL_ASSIGN,$assign_id,$usd);    
                }    
             
            if($up)
            {
               $instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'DRIVER','assign_id'=>$assign_id,'orderno'=>$assign->order_no,'status'=>'DN Submit','created_on'=>date('Y-m-d h:i:s')));
                $result = array('status'=>TRUE, 'message'=>'Submitted Successfully'); 
            }
            else
            {
                $result = array('status'=>FALSE, 'message'=>'Update Failed');  
            }
			
		}else
        {		
           $result = array('status'=>FALSE, 'message'=>"No order found");
        }
    }
        echo json_encode($result);
 }
 
 public function dnlist(){
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    if($this->form_validation->run() == FALSE){
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }else{
            $driverid = $this->input->post("driver_id") ;
			//echo "select * from assign where driver_id=$driverid and dn_submit='YES'";exit;
				$orderdata = $this->db->query("select * from assign where driver_id=$driverid and dn_submit='YES'")->result();
              if(!empty($orderdata)){
                  foreach($orderdata as $ord){
                      $comment = $this->Apimodel->get_single_row(TBL_COMMENT,array('orderno'=>$ord->order_no,'type'=>'RT'));
                      if(!empty($comment)){
						$comm = $comment->comment;  
                      }else{
						$comm = "";
                      }
                      $invoicedata = $this->Apimodel->get_single_row(TBL_INVOICE,array('orderno'=>$ord->order_no));
                      $val["assign_id"] = $ord->id;
                      $val["orderno"] = $invoicedata->orderno;
                      $val["order_date"] = $invoicedata->order_date;
                      $val["quantity_to_deliver"] = $invoicedata->txt_Quantity;
                      $val["detail"] = $invoicedata->Description ;
                      $val["order_note"] = $invoicedata->order_note;
                      $val["customer_name"] = $invoicedata->name;
                      $val["mobile"] = $invoicedata->mobile;
                      $val["phone"] = $invoicedata->phone;
                      $val["address"] = $invoicedata->txtAddress;
                      $val["image"] = $ord->image;
                      $val["delivery_address"] = $ord->delivery_address 	;
                      $val["del_lat"] = $ord->del_lat;
                      $val["del_lon"] = $ord->del_lon;
                      $val["status"] = $ord->status;
                      $val["gpslink"] = $invoicedata->gps_code;
                      $val["comment"] = $comm;
                      $val["delivery_note_no"] = $ord->delivery_note_no;
                      $arr[] = $val;
                  }
                  $result = array('status'=>TRUE, 'message'=>'Order list','data'=>$arr);  
              }else{
                  $result = array('status'=>FALSE, 'message'=>'No order found');  
              }
           
    }
        echo json_encode($result);
 }

//##############################Vinod############################################################
 public function searchInvoice(){
   	  $invoice = $this->input->get("key") ;
	 
      $checkuser = $this->Apimodel->get_single_row(TBL_INVOICE,array('orderno'=>$invoice));
      if($checkuser){
      	 $result = array('status'=>TRUE, 'message'=>'Invoice ID Present','data'=>array('name'=>$checkuser->name,'status'=>$checkuser->status)); 
      	}else{
      		 $result = array('status'=>false, 'message'=>'Invoice ID Not Exist'); 
      	}
      	echo json_encode($result);

 }

 public function changestatusStaff(){
	 
	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    $this->form_validation->set_rules('orderno', 'Order number', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	    if($this->form_validation->run() == FALSE)
        {
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
            
        }
        else
        {

            $driver_id = $this->input->post("driver_id") ;
            $status = $this->input->post("status") ;
            $orderno = $this->input->post("orderno") ;
            $msg = $this->input->post("msg") ;
            // print_r($this->input->post());
            // die;
            $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('id='=>$driver_id));
            // $assign = $this->Apimodel->get_single_row(TBL_ASSIGN,array('id='=>$assign_id));
           
            if($checkuser){
            			 if($status=="Own Delivered" || $status=="Delivered"){

											 if(!empty($_FILES['image']['name']))
											{
											  $image =  $this->image('image','Driver/staff/'); 
											}else{
											  $image ="";  
											} 
											if(!empty($_FILES['image1']['name']))
											{
											  $image1 =  $this->image('image1','Driver/staff/');
											}else{
											  $image1="";
											} 
											if(!empty($_FILES['image2']['name']))
											{
											  $image2 =  $this->image('image2','Driver/staff/');
											}else{
											  $image2="";
											}   
											 if(!empty($_FILES['image3']['name']))
											{
											  $image3 =  $this->image('image3','Driver/staff/');
											}else{
											  $image3="";
											}
											if(!empty($_FILES['image4']['name']))
											{
											  $image4 =  $this->image('image4','Driver/staff/');
											}else{
											  $image4="";
											}
											if(!empty($_FILES['image5']['name']))
											{
											  $image5 =  $this->image('image5','Driver/staff/');
											}else{
											  $image5="";
											}
											if($status=="Own Delivered"){
												$res = $this->input->post('reason');
												$makestatus = 'FROM STAFF';
											}else{
												$res = "";
												$makestatus = $status;
											}
											
											 $usd = array(
											 	'driver_id'=>$driver_id,
											 				'order_no'=>$orderno,
														   "status" => $status,
														   "image" =>$image,
														   "image1" =>$image1,
														   "image2" =>$image2,
														   "image3" =>$image3,
														   "image4" =>$image4,
														   "image5" =>$image5,
														   "record_time" =>date('Y-m-d H:i:s'),
														   "delivery_time"=>date('Y-m-d H:i:s'),
														   "del_lat"=>$this->input->post('current_lat'),
														   "del_lon"=>$this->input->post('current_lon'),
					   								   'cancel_status'=>'1',
														   "reason"=>$res,
														   "delivery_address"=>$this->input->post('current_address')
														  ) ;
							             }else{
							                 $img ='';
							                  $usd = array(
										               "status" => $status,
										               "image" =>$img,
													  ) ;
							             } 
									
							            if($last_assign_id=$this->Apimodel->insert(TBL_ASSIGN,$usd))
							            {
							            	
							            	$instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'STAFF','assign_id'=>$last_assign_id, 'orderno'=>$orderno,'status'=>$status,'created_on'=>date('Y-m-d h:i:s')));
														
														if($status=="Own Delivered"){

															$invoice = $this->Apimodel->get_single_row(TBL_INVOICE,array('orderno='=>$orderno));
															if($invoice){
																	$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("own_delivery"=>'1', "driver_status"=>$status,"status"=>'OWN DELIVERED'));
															}else{
																$arr = array(
						                             'orderno'=>$orderno,
						                             'order_date'=>date('Y-m-d h:i:s'),
						                             'txt_Quantity'=>'',
						                             'due_amount'=>'',
						                             'amount_paid'=>'',
						                             'Combo68'=>'',
						                             'order_note'=>'',
						                             'gps_code'=>'',
						                             'name'=>'',
						                             'txtAddress'=>'',
						                             'txt_Qty_Delivered'=>'',
						                             'Description '=>'',
						                             'status'=>'OWN DELIVERED',
						                             //'Text61'=>$Row[17],
						                             'created_on'=>date('Y-m-d H:i:s')
						                             );
																	$this->Apimodel->insert(TBL_INVOICE,$arr);
															}
															

														}else if($status=="Delivered"){
															$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("own_delivery"=>'0',"driver_status"=>$status,"status"=>'FROM OWN DRIVER'));
														}else{
															$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("own_delivery"=>'0',"driver_status"=>$status));
														}
														
										                $result = array('status'=>TRUE, 'message'=>'Changed Successfully','data'=>$usd); 
							            }
							            else
							            {
							                $result = array('status'=>FALSE, 'message'=>'Update Failed');  
							            }
			
		}else
        {		
           $result = array('status'=>FALSE, 'message'=>"No user found");
        }
    }
        echo json_encode($result);
 }

//##############################akhil############################################################
  /*       insert status start      */ 

	public function aftersaleChangestatusStaff(){

	    $this->form_validation->set_rules('driver_id', 'Driver Id', 'trim|required');
	    $this->form_validation->set_rules('orderno', 'Order number', 'trim|required');
	    $this->form_validation->set_rules('status', 'Status', 'trim|required');
	 //   $this->form_validation->set_rules('assign_id', 'assign_id', 'trim|required');
	    if($this->form_validation->run() == FALSE){
            $message = strip_tags(validation_errors());
            $result = array('status'=>FALSE, 'message'=>$message, 'error'=>"");
        }else{

            $driver_id = $this->input->post("driver_id") ;
            $status = $this->input->post("status") ;
            $orderno = $this->input->post("orderno") ;
            $msg = $this->input->post("msg") ;
     //       $assign_id = $this->input->post("assign_id") ;
            $checkuser = $this->Apimodel->get_single_row(TBL_DRIVER,array('id='=>$driver_id));
           //  print_r($checkuser);
           // die;
       //     $assign = $this->Apimodel->get_single_row(TBL_ASSIGN,array('id='=>$assign_id));
            if($checkuser){
             if($status=="Own Delivered" || $status=="Delivered"){
								if(!empty($_FILES['image']['name'])){
									$filename = $_FILES["image"]["name"]; 
									$tempname = $_FILES["image"]["tmp_name"];
									$file_size =$_FILES['image']['size'];
									$folder = "uploads/Driver/from_staff/".$filename;
									if (move_uploaded_file($tempname, $folder))  { 
										$image = "uploads/Driver/from_staff/$filename";				
									}else{ 
										$image = ""; 
									}
								}else{
								  $image ="";  
								} 
								if(!empty($_FILES['image1']['name'])){
									$filename = $_FILES["image1"]["name"]; 
									$tempname = $_FILES["image1"]["tmp_name"];
									$file_size =$_FILES['image1']['size'];
									$folder = "uploads/Driver/from_staff/".$filename;
									if (move_uploaded_file($tempname, $folder))  { 
										$image1 = "uploads/Driver/from_staff/$filename";				
									}else{ 
										$image1 = ""; 
									}
								}else{
								  $image1="";
								} 
								if(!empty($_FILES['image2']['name'])){
									$filename = $_FILES["image2"]["name"]; 
									$tempname = $_FILES["image2"]["tmp_name"];
									$file_size =$_FILES['image2']['size'];
									$folder = "uploads/Driver/from_staff/".$filename;
									if (move_uploaded_file($tempname, $folder))  { 
										$image2 = "uploads/Driver/from_staff/$filename";				
									}else{ 
										$image2 = ""; 
									}
								}else{
								  $image2="";
								}   
								if(!empty($_FILES['image3']['name'])){
									$filename = $_FILES["image3"]["name"]; 
									$tempname = $_FILES["image3"]["tmp_name"];
									$file_size =$_FILES['image3']['size'];
									$folder = "uploads/Driver/from_staff/".$filename;
									if (move_uploaded_file($tempname, $folder))  { 
										$image3 = "uploads/Driver/from_staff/$filename";				
									}else{ 
										$image3 = ""; 
									}
								}else{
								  $image3="";
								}
								if(!empty($_FILES['image4']['name'])){
									$filename = $_FILES["image4"]["name"]; 
									$tempname = $_FILES["image4"]["tmp_name"];
									$file_size =$_FILES['image4']['size'];
									$folder = "uploads/Driver/from_staff/".$filename;
									if (move_uploaded_file($tempname, $folder))  { 
										$image4 = "uploads/Driver/from_staff/$filename";				
									}else{ 
										$image4 = ""; 
									}
								}else{
								  $image4="";
								}
								if(!empty($_FILES['image5']['name'])){
									$filename = $_FILES["image5"]["name"]; 
									$tempname = $_FILES["image5"]["tmp_name"];
									$file_size =$_FILES['image5']['size'];
									$folder = "uploads/Driver/from_staff/".$filename;
									if (move_uploaded_file($tempname, $folder))  { 
										$image5 = "uploads/Driver/from_staff/$filename";				
									}else{ 
										$image5 = ""; 
									}
								}else{
								  $image5="";
								}
								if($status=="Own Delivered"){
									$res = $this->input->post('reason');
									$makestatus = 'FROM STAFF';
								}else{
									$res = "";
									$makestatus = $status;
								}
								$usd = array(
									'driver_id'=>$driver_id,
									'order_no'=>$orderno,
								   "status" => $status,
								   "image" =>$image,
								   "image1" =>$image1,
								   "image2" =>$image2,
								   "image3" =>$image3,
								   "image4" =>$image4,
								   "image5" =>$image5,
								   'cancel_status'=>'1',
								   "record_time" =>date('Y-m-d H:i:s'),
								   "delivery_time"=>date('Y-m-d H:i:s'),
								   "del_lat"=>$this->input->post('current_lat'),
								   "del_lon"=>$this->input->post('current_lon'),
								   "reason"=>$res,
								   "delivery_address"=>$this->input->post('current_address')
								) ;
			
             }else{
								$img ='';
								$usd = array("status" => $status,"image" =>$img) ;
             } 

         if($last_assign_id=$this->Apimodel->insert(TBL_ASSIGN,$usd)){
          //  	echo $last_assign_id;
									$instxn = $this->Apimodel->insert(TBL_STATUS_TXN,array('type'=>'STAFF', 'assign_id'=>$last_assign_id,'orderno'=>$orderno,'status'=>$status,'created_on'=>date('Y-m-d h:i:s')));
									 $invoice = $this->Apimodel->get_single_row(TBL_INVOICE,array('orderno='=>$orderno));
										
									if($status=="Own Delivered"){
										 if(!empty($invoice) && isset($invoice))
										 {
										 	$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno), array("own_delivery"=>'1', "driver_status"=>$status,"status"=>'OWN DELIVERED'));
										 }
										 else
										 {
											$mainup = $this->Apimodel->insert(TBL_INVOICE,array('orderno'=>$orderno,"own_delivery"=>'1',"driver_status"=>$status,"status"=>'OWN DELIVERED')); 	
										 }

										
									}else if($status=="Delivered"){

										if(!empty($invoice) && isset($invoice))
										 {
										 	$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno), array("own_delivery"=>'0',"driver_status"=>$status,"status"=>'FROM DELIVERED'));
										 }
										 else
										 {
											$mainup = $this->Apimodel->insert(TBL_INVOICE,array('orderno'=>$orderno,"own_delivery"=>'0',"driver_status"=>$status,"status"=>'FROM DELIVERED')); 	
										 }
							
									}else{
										$mainup = $this->Apimodel->update_where(TBL_INVOICE,array('orderno'=>$orderno),array("driver_status"=>$status));
									}
					                $result = array('status'=>TRUE, 'message'=>'Insert Successfully','data'=>$usd); 
            }else{
                $result = array('status'=>FALSE, 'message'=>'Insert Failed');  
            }
			
		}else{		
           $result = array('status'=>FALSE, 'message'=>"No user found");
        }
		}
        echo json_encode($result);
	}
   
 
}