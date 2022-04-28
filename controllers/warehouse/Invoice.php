<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
class Invoice extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				  $this->load->model('admin/Home_model');
			  }


public function index()
  {
     if($this->input->post('assign')){
         //echo "<pre>"; print_r($_POST);exit;
         $arr = array(
                     'order_no'=>$this->input->post('orderno'),
                     'driver_id'=>$this->input->post('driver_id'),
                     'status'=>'Assigned',
                     
                     'created_on'=>date('Y-m-d H:i:s')
                     );
        $insert = $this->Home_model->insert(TBL_ASSIGN,$arr);    
        if($insert){
          $upArr = array('driver_id'=>$this->input->post('driver_id'),
                      'assign_date'=>date('Y-m-d H:i:s'),
                      'driver_status'=>'Assigned'
                      
                     );   
          $updt = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$this->input->post('orderno')),$upArr);                
          $this->session->set_flashdata('message', 'Driver assigned successfully');
          redirect('warehouse/Invoice');
        }else{
          $this->session->set_flashdata('errmessage', 'Some problem occurred');
          redirect('warehouse/Invoice');
        }
     }
     if($this->input->post('receivedbyrt')){ 
          //echo "<pre>";print_r($_POST);exit;
          $invoice = $this->input->post('invoice');
          if(!empty($invoice)){
            foreach($invoice as $inv){
              $this->Home_model->update_where(TBL_INVOICE,array("orderno"=>$inv),array("status"=>"RECEIVED BY RT"));    
            }
          }
          $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' group by orderno order by id")->result();
    }
     if($this->input->post('search') && $this->input->post('status')!='ALL'){
       // echo "<pre>";print_r($_POST);exit;
         $status = $this->input->post('status');
         $data["postval"] = $status;
		 if($status=='Not delivered'){
			 //$data["view"] = $this->db->query("select * from invoice where driver_status='$status' group by orderno")->result();
			 $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('driver_status'=>"Not delivered"));
		 }else{
			$data["view"] = $this->db->query("select * from invoice where sent_to_rt=1 and status='$status' group by orderno")->result();
		 }
    }else{
       
         $data["view"] = $this->db->query("select * from invoice where sent_to_rt=1 and status!='VOID' and status!='DELETED' and status!='POSTED' group by orderno")->result();
    } 
    $data["page"]="Category";
    $data["expressdel"] = $this->db->query("select * from invoice where sent_to_rt=1 and status!='VOID' and status!='DELETED' and express_delivery=1  and (status!='SENT TO PL' || status!='DELIVERED' || status!='FROM DRIVER')   group by orderno")->result();
    $data["drivers"] = $this->Home_model->get_tbl_data_inorder(TBL_DRIVER,array());
    $this->load->view('warehouse/invoice',$data);
 }
 
 public function new(){
    if($this->input->post('receivedbyrt')){ 
          //
          $invoice = $this->input->post('invoice');
		  //echo "<pre>";print_r($invoice);exit;
          if(!empty($invoice)){
            foreach($invoice as $inv){
              //$this->Home_model->update_where(TBL_INVOICE,array("orderno"=>$inv),array("status"=>"RECEIVED BY RT")); 

				$this->db->query("UPDATE invoice SET status='RECEIVED BY RT' where orderno=$inv");
				$this->db->query("UPDATE status_txn SET status='RECEIVED BY RT' where orderno=$inv AND status='SENT TO RT'");
			  
            }
          }
          	$this->session->set_flashdata('message', 'RECEIVED BY RT successfully');
			redirect('warehouse/Invoice/');
          
    }
    $data["page"]="Category";
	$data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>"SENT TO RT"));
    $this->load->view('warehouse/invoice',$data);
} 

public function scheduled(){
    if($this->input->post('search')){ 
      //echo "<pre>";print_r($_POST);exit;
      $date = $this->input->post('scheduled_date');
      $data["searchArr"] = array('searchdate'=>$date);
      $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('actual_del_date'=>$date,'status'=>'DEL SCHEDULED'));
    }else{
        $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('actual_del_date>'=>"",'status'=>'DEL SCHEDULED'));
    }
    $data["page"]="Scheduled";
	
    $this->load->view('warehouse/invoice',$data);
} 

public function withdriver(){
    
    $data["page"]="Scheduled";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>"WITH DRIVER"));
    $this->load->view('warehouse/invoice',$data);
} 
public function delivered(){
    
    $data["page"]="Scheduled";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>"DELIVERED",'driver_status'=>"Delivered"));
    $this->load->view('warehouse/invoice',$data);
} 
public function failed(){
    $data["page"]="Failed";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('driver_status'=>"Not delivered"));
    $this->load->view('warehouse/invoice',$data);
}
public function delbydriver(){
    $data["page"]="Delbydriver";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>"FROM DRIVER",'driver_status'=>"Delivered"));
    $this->load->view('warehouse/invoice',$data);
}
 
 public function add(){
    if($this->input->post('submit')){
      $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        $i = 0 ;
        while (($Row = fgetcsv($file, 10000, ",")) !== FALSE) {
            if($i==0){ $i++; continue; }
            if($Row[0]==""){ $i++; continue; }
            $rr = $Row[0];
            //print_r($Row);exit;
           
            if(!empty($this->Home_model->get_single_row(TBL_INVOICE,array('orderno'=>$Row[0])))){
              $alldta=$this->db->query("select * from invoice where orderno='$rr' and (status!='VOID' || status!='DELETE')")->result();
              if($alldta){
              foreach($alldta as $al){
                   $arr = array(
                             'orderno'=>$Row[0],
                             'order_date'=>$Row[1],
                             'txt_Quantity'=>$Row[2],
                             'due_amount'=>$Row[3],
                             'amount_paid'=>$Row[4],
                             'Combo68'=>$Row[5],
                             'order_note'=>$Row[6],
                             'gps_code'=>$Row[7],
                             'name'=>$Row[8],
                             'phone'=>$Row[9],
                             'mobile'=>$Row[10],
                             'txtAddress'=>$Row[11],
                             'city'=>$Row[12],
                             'Description '=>$Row[13],
                             'item_code'=>$Row[14],
                             'txt_Qty_Delivered'=>$Row[15],
                             'location'=>$Row[16],
                             'status'=>'RECEIVED BY RT',
							 'sent_to_rt'=>1,
                             //'item_note'=>$Row[16],
                             //'created_on'=>date('Y-m-d H:i:s')
                             ); 
                  $upd = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$this->input->post('orderno')),$arr);
              }
            }else{
         
              $arr = array(
                             'orderno'=>$Row[0],
                             'order_date'=>$Row[1],
                             'txt_Quantity'=>$Row[2],
                             'due_amount'=>$Row[3],
                             'amount_paid'=>$Row[4],
                             'Combo68'=>$Row[5],
                             'order_note'=>$Row[6],
                             'gps_code'=>$Row[7],
                             'name'=>$Row[8],
                             'phone'=>$Row[9],
                             'mobile'=>$Row[10],
                             'txtAddress'=>$Row[11],
                             'city'=>$Row[12],
                             'Description '=>$Row[13],
                             'item_code'=>$Row[14],
                             'txt_Qty_Delivered'=>$Row[15],
                             'location'=>$Row[16],
                             'status'=>'RECEIVED BY RT',
							 'sent_to_rt'=>1,
                             //'item_note'=>$Row[16],
                             'created_on'=>date('Y-m-d H:i:s')
                             );
                 $ss[] = $arr;
            //   $insert = $this->Home_model->insert(TBL_INVOICE,$arr);  
           	
            }  
        }
       else{
             $arr = array(
                             'orderno'=>$Row[0],
                             'order_date'=>$Row[1],
                             'txt_Quantity'=>$Row[2],
                             'due_amount'=>$Row[3],
                             'amount_paid'=>$Row[4],
                             'Combo68'=>$Row[5],
                             'order_note'=>$Row[6],
                             'gps_code'=>$Row[7],
                             'name'=>$Row[8],
                             'phone'=>$Row[9],
                             'mobile'=>$Row[10],
                             'txtAddress'=>$Row[11],
                             'city'=>$Row[12],
                             'Description '=>$Row[13],
                             'item_code'=>$Row[14],
                             'txt_Qty_Delivered'=>$Row[15],
                             'location'=>$Row[16],
                             'status'=>'RECEIVED BY RT',
                             'sent_to_rt'=>1,
                             'created_on'=>date('Y-m-d H:i:s')
                             );
                             
                $ss[] = $arr;             
                 
               //$insert = $this->Home_model->insert(TBL_INVOICE,$arr);  
               
        }
        }
        if(!empty($ss)){
            $insert = $this->db->insert_batch(TBL_INVOICE, $ss);
        }
        
         if($insert){
				$this->session->set_flashdata('message', 'Invoice has been added successfully');
			    redirect('warehouse/Invoice/own');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('warehouse/Invoice/own');
			}
    }
    }
   $data["page"]="Add";
   $this->load->view('warehouse/invoiceadd',$data);
}
 

  public function view($id){
    $data["view"] = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id));
    $data["orders"] = $this->Home_model->get_tbl_data(TBL_INVOICE,array('orderno'=>$data["view"]->orderno));
    $mm = $data["view"]->mobile;
    $pp = $data["view"]->phone;
    $mobile =str_replace("-","",$mm);
    $phone =str_replace("-","",$pp);
    $data["calls"] = $this->db->query("select * from calls where contact='$mobile' OR contact='$phone'")->result();
    $data["SMS"] = $this->Home_model->get_tbl_data(TBL_CALL_SMS,array('orderno'=>$data["view"]->orderno,'type'=>'SMS'));
    $data["comments"] = $this->Home_model->get_tbl_data(TBL_COMMENT,array('invoice_id'=>$id));
    $data["status"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno));
    $data["driverstatus"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno,'type'=>'DRIVER'));

     //change by vinod
      $data["complain"] = $this->Home_model->get_tbl_data('customer',array('password'=>$data["view"]->orderno));
      $data["id"] = $data["view"]->orderno;
     
     // $data['assign'] = $this->Home_model->get_tbl_data('assign',array('order_no'=>$data["status"][0]->orderno));
    // echo "<pre>";
    //   print_r($data["status"]);
    //   exit();

       $i=0;
    foreach($data["status"] as  $status)
    {
        $assign_data =$this->Home_model->get_tbl_data(TBL_ASSIGN,array('id'=>$status->assign_id));
        if(!empty($assign_data[0]->driver_id))
        {
             $driver_data =$this->Home_model->get_tbl_data(TBL_DRIVER,array('id'=>$assign_data[0]->driver_id));
            $data["status"][$i]->driver_name =$driver_data[0]->name; 
        }
        else
        {
             $data["status"][$i]->driver_name='';
        }
        $i++;
    }
    
  
     foreach($data["status"] as  $status)
    {
        $assign_data =$this->Home_model->get_tbl_data(TBL_ASSIGN,array('id'=>$status->assign_id));
        if( !empty($assign_data[0]->driver_id) &&  $assign_data[0]->driver_id!=0)
        {
            $data["staffDetails"] =$this->Home_model->get_tbl_data(TBL_DRIVER,array('id'=>$assign_data[0]->driver_id));
        }
    }
    // echo "<pre>";
    // print_r($data['status']);
    // exit;
    $this->load->view('warehouse/invoice_view',$data);
 }
 
 public function getdriverinfo(){
    $id = $this->input->post('driver_id'); 
    $data['driver'] = $this->Home_model->get_single_row(TBL_DRIVER,array('id'=>$id));
    $this->load->view('warehouse/ajx',$data);
 }
 public function edit($id){
    $invoicedata = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id)); 
    if($this->input->post('submit')){
        $own_del = $this->input->post('own_delivery');
       $exp_del = $this->input->post('express_delivery');
       if($own_del==1 && $exp_del==1){
           $this->session->set_flashdata('errmessage', 'Please choose own delivery or express delivery');
		   redirect('warehouse/Invoice/edit/'.$id);
       }
        $arr = array(
                     'actual_del_date'=>$this->input->post('delivery_date'),
                    // 'status'=>$this->input->post('status'),
                     'remarks'=>$this->input->post('remark'),
                     'mobile'=>$this->input->post('mobile'),
                     'phone'=>$this->input->post('phone'),
                     'extra_mobile_no'=>$this->input->post('extra_mobile_no')?:'',
                     'own_delivery'=>$this->input->post('own_delivery'),
                     'express_delivery'=>$this->input->post('express_delivery'),
                     'updated_on'=>date('Y-m-d H:i:s')
                     );
         
                   $upd = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$invoicedata->orderno),$arr);
                   if($upd){
                      
                        $this->session->set_flashdata('message', 'Invoice has been updated successfully');
                        redirect('warehouse/Invoice/edit/'.$id);
                   }else{
                       $this->session->set_flashdata('errmessage', 'Some problem occurred');
                       redirect('warehouse/Invoice/edit/'.$id);
                   }
    }
    
      if($this->input->post('statussubmit')){
        $status = $this->input->post('status');
        if($status=="DEL TODAY"){
            $del_date = date('Y-m-d');
            $arr = array(
                     'status'=>$this->input->post('status'),
                     'actual_del_date'=>$del_date
                     );
        }elseif($status=="DEL TOMORROW"){
            $del_date = date("Y-m-d", time() + 86400);
            $arr = array(
                     'status'=>$this->input->post('status'),
                     'actual_del_date'=>$del_date
                     );
        }elseif($status=="DEL SCHEDULED"){
            $del_date = $this->input->post('delivery_date');
            $arr = array(
                     'status'=>$this->input->post('status'),
                     'actual_del_date'=>$del_date
                     );
        }else{
            $del_date = $invoicedata->actual_del_date;
        }
        //if($status=="WITH DRIVER" && $invoicedata->driver_id==0){
			if($status=="WITH DRIVER"){
				$checkwea = $this->Home_model->get_tbl_data_inorder(TBL_ASSIGN,array('delivery_note_no'=>$this->input->post('delivery_note_no')));
				if($checkwea){
					$this->session->set_flashdata('errmessage', 'Please enter another delivery note number, this number already exists');
					redirect('warehouse/Invoice/edit/'.$id);
				}else{
					$asgnAr = array(
                     'order_no'=>$invoicedata->orderno,
                     'driver_id'=>$this->input->post('driver_id'),
                     'status'=>'Assigned',
                     'delivery_note_no'=>$this->input->post('delivery_note_no'),
                     'cancel_status'=>1,
                     'created_on'=>date('Y-m-d H:i:s')
                     );
					$insert = $this->Home_model->insert(TBL_ASSIGN,$asgnAr);    
					if($insert){
					  $asupArr = array('driver_id'=>$this->input->post('driver_id'),
								  'assign_date'=>date('Y-m-d H:i:s'),
								  'driver_status'=>'Assigned',
								  'delivery_note_no'=>$this->input->post('delivery_note_no')
								 );   
					  $updt = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$invoicedata->orderno),$asupArr);  
					  $instxn = $this->Home_model->insert(TBL_STATUS_TXN,array('type'=>'DRIVER','assign_id'=>$insert,'orderno'=>$invoicedata->orderno,'status'=>'Assigned','created_on'=>date('Y-m-d h:i:s')));
					  $arr = array('status'=>$this->input->post('status'));
				}
			
			} 
        }else{
            $arr = array('status'=>$this->input->post('status'));
             //$this->session->set_flashdata('errmessage', 'Driver already assigned');
             //redirect('warehouse/Invoice/edit/'.$id);
        }
        
        // print_r($arr);exit;
                   $upd = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$invoicedata->orderno),$arr);
                   if($upd){
                        $stArr = array("invoice_id"=>$id,"orderno"=>$invoicedata->orderno,"status"=>$this->input->post('status'),"created_on"=>date('Y-m-d H:i:s'));
                        $ins = $this->Home_model->insert(TBL_STATUS_TXN,$stArr);
                        $this->session->set_flashdata('message', 'Invoice has been updated successfully');
                        redirect('warehouse/Invoice/edit/'.$id);
                   }else{
                       $this->session->set_flashdata('errmessage', 'Some problem occurred');
                       redirect('warehouse/Invoice/edit/'.$id);
                   }
    }
     if($this->input->post('callsubmit')){
       
        $arr = array(
                     'master'=>'RT',
                     'invoice_id'=>$id,   
                     'orderno'=>$invoicedata->orderno,
                     'type'=>'CALL',
                     'date'=>$this->input->post('call_date'),
                     'time'=>$this->input->post('call_time'),
                     'remark'=>$this->input->post('remark'),
                     'file'=>$this->input->post('file')?:'',
                     'created_on'=>date('Y-m-d H:i:s')
                     );
         
                   $insert = $this->Home_model->insert(TBL_CALL_SMS,$arr);
                   if($insert){
                        $this->session->set_flashdata('message', 'Call details has been updated successfully');
                        redirect('warehouse/Invoice/edit/'.$id);
                   }else{
                       $this->session->set_flashdata('errmessage', 'Some problem occurred');
                       redirect('warehouse/Invoice/edit/'.$id);
                   }
        
    }
    if($this->input->post('smssubmit')){
        $msglist = $this->input->post('remark');
        $text_msg = $this->input->post('text_msg');
        if($msglist==""){
            $msg = $text_msg; 
        }else{
            $msg = $msglist;
        }
        $arr = array(
                     'master'=>'RT',
                     'invoice_id'=>$id,    
                     'orderno'=>$invoicedata->orderno,
                     'type'=>'SMS',
                     'date'=>$this->input->post('sms_date'),
                     'time'=>$this->input->post('sms_time'),
                     'remark'=>$msg,
                     'created_on'=>date('Y-m-d H:i:s')
                     );
         
                   $insert = $this->Home_model->insert(TBL_CALL_SMS,$arr);
                   if($insert){
                    $invicedata = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id));   
                   
                   /*   SMS API CODE START */
                   
                    $sid = SID;
                    $token = TOKEN;
                    $client = new Client($sid, $token);
                    $phone = '+230'.trim($this->input->post('mobileno'));  
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => 'TFPPL',
                            'body' => $msg
                        )
                    );  
  
                    /*   SMS API CODE END */   
                       
                        $this->session->set_flashdata('message', 'SMS has been sent successfully');
                        redirect('warehouse/Invoice/edit/'.$id);
                   }else{
                       $this->session->set_flashdata('errmessage', 'Some problem occurred');
                       redirect('warehouse/Invoice/edit/'.$id);
                   }
        
    }
     if($this->input->post('commentsubmit')){
       $chk = $this->Home_model->get_single_row(TBL_COMMENT,array('orderno'=>$invoicedata->orderno,'type'=>'RT'));  
       if(empty($chk)){
           $arr = array("invoice_id"=>$id,"type"=>'RT',"orderno"=>$invoicedata->orderno,"comment"=>$this->input->post('comment'),"created_on"=>date('Y-m-d H:i:s'));
           $ins = $this->Home_model->insert(TBL_COMMENT,$arr); 
       }else{
          $arr = array("invoice_id"=>$id,"type"=>'RT',"orderno"=>$invoicedata->orderno,"comment"=>$this->input->post('comment'));
          $ins = $this->Home_model->update(TBL_COMMENT,$chk->id,$arr);
       }
      
       if($ins){
        $this->session->set_flashdata('message', 'Comment has been added successfully');
         redirect('warehouse/Invoice/edit/'.$id);
       }else{
        $this->session->set_flashdata('errmessage', 'Database problem occured');
        redirect('warehouse/Invoice/edit/'.$id);   
       }
     }       
  $data["page"]="Edit";
  $data["view"] = $invoicedata;
  $data["drivers"] = $this->Home_model->get_tbl_data_inorder(TBL_DRIVER,array('role'=>'driver'));
  $this->load->view('warehouse/invoicedit',$data);
}

public function files($name,$index)
{
 if(!empty($_FILES[$name]['name'][$index]))
	{
	   
		$_FILES['file']['name'] = $_FILES[$name]['name'][$index];
		$_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$index] ;
		$_FILES['file']['size'] = $_FILES[$name]['size'][$index] ;
		$config['upload_path'] = 'upload/slider/';
		$config['allowed_types'] = '*';
        
	 	$config['file_name'] = $_FILES['file']['name'];
		
		
		$photo=explode('.',$_FILES[$name]['name'][$index]); 
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
				return $deal1image = "upload/slider/".$uploadData['file_name'];
			}else{
			    // echo $this->upload->display_errors(); die();
				return $deal1image = '';
			}
	}else{
	return	$deal1image = '' ;
	}	 
					
}

  public function delete($ord){
  
    //$this->Home_model->delete(TBL_INVOICE,"id",$id);
	 $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$ord),array('status'=>'DELETED'));
	$this->session->set_flashdata('message', 'Invoice has been deleted successfully');
	redirect('admin/Invoice') ;
  
  }
  
  public function cancel($page,$id,$ord){
    $arr = array('cancel_status'=>0);
    $up =  $this->Home_model->update_where(TBL_ASSIGN,array('id'=>$id),$arr);
    if($page=="edit"){ $send="edit"; }else{ $send = "view"; }
    if($up){
        $invoice = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$ord));
        $upd = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$invoice->orderno),array('driver_id'=>0,'status'=>'DEL SCHEDULED'));
        $stArr = array("invoice_id"=>$id,"orderno"=>$invoice->orderno,"status"=>'Cancel','type'=>'DRIVER',"created_on"=>date('Y-m-d H:i:s'));
        $ins = $this->Home_model->insert(TBL_STATUS_TXN,$stArr);
        $this->session->set_flashdata('message', 'Driver has been cancelled successfully');
        redirect('warehouse/Invoice/'.$send.'/'.$ord) ;
    }else{
        $this->session->set_flashdata('errmessage', 'Databse error occured');
        redirect('warehouse/Invoice/'.$send.'/'.$ord) ;
    }
      
      
      
  }

  public function own(){
    
    $data["page"]="Own";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>'Own Delivered'));
    // echo "<pre>";
    // print_r($data["view"]);
    // exit;

    $this->load->view('warehouse/invoiceActivities',$data);
}
  

  

 
 


   
}

