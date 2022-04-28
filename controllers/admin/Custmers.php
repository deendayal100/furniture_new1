<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 require_once(APPPATH.'libraries/vendor/php-excel-reader/excel_reader2.php');
 require_once(APPPATH.'libraries/vendor/SpreadsheetReader.php');
 require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
 
class Custmers extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Home_model');		 
	}

	public function index(){
		/*$data["view"] = $this->db->query("select customer.* , invoice.id as invoice_id from customer left join invoice on customer.order_number = invoice.orderno group by id order by id desc")->result();*/
    $data["view"] = $this->db->query("select customer.name,customer.email,customer.phone,customer.id,customer.address,customer.tc ,customer_orderno.order_number,customer_orderno.purchase_date, invoice.id as invoice_id from customer left join customer_orderno  on customer.id = customer_orderno.customer_id    left join  invoice on customer_orderno.order_number = invoice.orderno order by id desc")->result();

   /* echo '<pre>';
    print_r($data);
    echo '</pre>';*/
		$this->load->view('admin/custmers',$data);
	}
	public function view($id){
	    
    $data['session_user_id'] = $this->session->userdata('user_id');

		//$data["view"] = $this->db->query("select * from customer where id=$id")->result();
    $lastrow = $this->db->query("select customer_id from customer_orderno where order_number = '$id' ORDER BY id DESC LIMIT 1")->result();
    if(!empty($lastrow) && isset($lastrow))
    {
        
    
    $lastCustid = $lastrow[0]->customer_id;
    $data["view"] = $this->db->query("select customer.name,customer.email,customer.phone,customer.password,customer.id,customer.address,customer.created_at,customer.tc ,customer_damaged_message.damaged_message,customer_orderno.order_number,customer_orderno.purchase_date from customer left join customer_orderno  on customer.id = customer_orderno.customer_id  left join customer_damaged_message  on customer.id = customer_damaged_message.customer_id where customer_orderno.order_number=$id order by id desc")->result();
		$data["itemcodes"] = $this->db->query("select * from customer_itemcode  join customer_damaged_message  on customer_itemcode.customer_id = customer_damaged_message.customer_id where customer_itemcode.customer_id = '$lastCustid'  and customer_itemcode.order_number = '$id'")->result();
		$data["itemaddress"] = $this->db->query("select * from customer_itemaddress where customer_id = '$lastCustid'  and order_number = '$id'")->result();
    $data["newcust"] = $this->db->query("select order_number from customer_order_reply")->result(); 
    $data['invoice_status']="false";
   
    }
else
{

    $data['invoice_status']="true";
    $images= $this->Home_model->get_tbl_data(TBL_ASSIGN,array('order_no'=>$id));
    $data['images'] =$images;
    echo $driver_id = $images[0]->driver_id;
    $driver_data = $this->Home_model->get_tbl_data(TBL_DRIVER,array('id'=>$driver_id));
    $data['images'][0]->name=$driver_data[0]->name;
    $data['images'][0]->mobile=$driver_data[0]->mobile;
    $data['images'][0]->email=$driver_data[0]->email;
  $image_data =$this->Home_model->get_tbl_data(TBL_INVOICE,array('orderno'=>$id));
 
}
     $data["invoice"] = $this->Home_model->get_tbl_data(TBL_INVOICE,array('orderno'=>$id));
    
    //change by vinod
    
      // echo var_dump($data['invoice']);
      // exit;
     // $data["id"] = $data["view"]->orderno;
//      echo "<pre>";
     
  //  print_r($data['images']);
    //exit;
		$this->load->view('admin/custmers_view',$data);
	}
	public function delete($id){
		$this->db->query("DELETE FROM customer WHERE id=$id");
		$this->db->query("DELETE FROM customer_itemaddress WHERE customer_id=$id");
		$this->db->query("DELETE FROM customer_itemcode WHERE customer_id=$id");
		$this->db->query("DELETE FROM customer_itemimages WHERE customer_id=$id");
		$this->db->query("DELETE FROM customer_iteminvoice WHERE customer_id=$id");
	    $this->session->set_flashdata('message', 'Custmers has been deleted successfully');
	    redirect('admin/Custmers') ;
    }
public function new(){
    if($this->input->post('senttort')){ 
          $invoice = $this->input->post('invoice');
          if(!empty($invoice)){
            foreach($invoice as $inv){
              $this->Home_model->update_where(TBL_INVOICE,array("orderno"=>$inv),array("status"=>"SENT TO RT","sent_to_rt"=>1));    
            }
          }
          	$this->session->set_flashdata('message', 'SENT TO RT successfully');
			redirect('admin/Invoice/');
          
    }
    $data["page"]="New";
	$data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' group by orderno order by id DESC LIMIT 50")->result();
	//$data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>""));
    $this->load->view('admin/new',$data);
} 
 
public function scheduled(){
    if($this->input->post('search')){ 
      //echo "<pre>";print_r($_POST);exit;
      $date = $this->input->post('scheduled_date');
      $data["searchArr"] = array('searchdate'=>$date);
      $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('actual_del_date'=>$date));
    }else{
        $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('actual_del_date>'=>""));
    }
    $data["page"]="Scheduled";
	
    $this->load->view('admin/complete',$data);
} 
public function own(){
    
    $data["page"]="Own";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('own_delivery'=>1));
    $this->load->view('admin/invoice',$data);
}
public function add1()
  {
    
	 if($this->input->post('submit')){
	      
	  //echo "<pre>";print_r($_FILES);exit;   
	   $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/csv'];
 // echo "<pre>";print_r($_FILES);exit;  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'furniture.mu/uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
       // echo "<pre>"; print_r($_FILES);
         echo  $fileName = $_FILES["file"]["tmp_name"]; 
    
      if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "rt");
        
        while (($Row = fgetcsv($file, 10000, ",")) !== FALSE) {
            echo $Row[0]; "<br>"; exit;
            $arr = array(
                             'orderno'=>$Row[0],
                             'order_date'=>$Row[1],
                             'txt_Quantity'=>$Row[2],
                             'due_amount'=>$Row[3],
                             'amount_paid'=>$Row[4],
                             'Combo68'=>$Row[5],
                             'order_note'=>$Row[6],
                             'gps_code'=>$row[7],
                             'name'=>$Row[8],
                             'txtAddress'=>$Row[9],
                             'txt_Qty_Delivered'=>$Row[11],
                             'Description '=>$Row[10],
                             //'Text61'=>$Row[17],
                             'created_on'=>date('Y-m-d H:i:s')
                             );
                 
               $insert = $this->Home_model->insert(TBL_INVOICE,$arr);  
            
        }
        
    }
        
        
      /*  $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
              if($Row[1]){ $Row++; continue; }
              
              if($Row[4]!=""){
                 echo $Row[4]; echo "<br>";  
                 $arr = array(
                             'orderno'=>$Row[4],
                             'order_date'=>$Row[5],
                             'Total_No_PCs'=>$Row[6],
                             'due_amount'=>$Row[7],
                             'amount_paid'=>$Row[8],
                             'Combo68'=>$Row[9],
                             'order_note'=>$Row[10],
                             'name'=>$Row[11],
                             'txtAddress'=>$Row[12],
                             'Text74'=>$Row[13],
                             'txt_Qty_Delivered'=>$Row[14],
                             'txt_Quantity'=>$Row[15],
                             'Description '=>$Row[16],
                             'Text61'=>$Row[17],
                             'created_on'=>date('Y-m-d H:i:s')
                             );
                 
               $insert = $this->Home_model->insert(TBL_INVOICE,$arr);  
                 
                 
             }
            }
        
         }
         
         redirect('admin/Invoice'); */
        
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
	     
	 }
	    $data["page"]="Add";
	    $this->load->view('admin/invoiceadd',$data);
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
                             //'expected_del_date'=>$Row[16],
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
                             //'expected_del_date'=>$Row[16],
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
                             //'expected_del_date'=>$Row[16],
                             //'item_note'=>$Row[16],
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
			    redirect('admin/Invoice/');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Invoice/');
			}
    }
    }
   $data["page"]="Add";
   $this->load->view('admin/invoiceadd',$data);
}

public function edit($id){
    $invoicedata = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id)); 
    if($this->input->post('submit')){
       $own_del = $this->input->post('own_delivery');
       $exp_del = $this->input->post('express_delivery');
       if($own_del==1 && $exp_del==1){
           $this->session->set_flashdata('errmessage', 'Please choose own delivery or express delivery');
		   redirect('admin/Invoice/edit/'.$id);
       }
       $arr = array(
                     'order_date'=>$this->input->post('order_date'),
                     'due_amount'=>$this->input->post('due_amount'),
                     'amount_paid'=>$this->input->post('amount_paid'),
                     'Combo68'=>$this->input->post('Combo68'),
                     'order_note'=>$this->input->post('order_note'),
                     'name'=>$this->input->post('name'),
                     'mobile'=>$this->input->post('mobile'),
                     'phone'=>$this->input->post('phone'),
                     'txtAddress'=>$this->input->post('txtAddress'),
                     'expected_del_date'=>$this->input->post('expected_del_date'),
                     'txt_Qty_Delivered'=>$this->input->post('txt_Qty_Delivered'),
                     'txt_Quantity'=>$this->input->post('txt_Quantity'),
                     'Description '=>$this->input->post('Description'),
                     'cim_approved'=>$this->input->post('cim_approved'),
                     'reserved'=>$this->input->post('reserved'),
                     'recieved_date'=>$this->input->post('recieved_date'),
                     'extra_mobile_no'=>$this->input->post('extra_mobile_no')?:'',
                     'own_delivery'=>$this->input->post('own_delivery'),
                     'express_delivery'=>$this->input->post('express_delivery'),
                     'updated_on'=>date('Y-m-d H:i:s')
                     );
                  
                   $insert = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$this->input->post('orderno')),$arr);
        
    }
    if($this->input->post('statussubmit')){
         if($this->input->post('status')=="SENT TO RT"){
                       $arr1 = array('sent_to_rt'=>1);    
                       $updte = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$this->input->post('orderno')),$arr1);
                   }
                   $arr = array('status'=>$this->input->post('status'));
                   $mainup = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$this->input->post('orderno')),$arr);
                   $stArr = array("invoice_id"=>$id,"orderno"=>$this->input->post('orderno'),"status"=>$this->input->post('status'),"created_on"=>date('Y-m-d H:i:s'));
                   $ins = $this->Home_model->insert(TBL_STATUS_TXN,$stArr);
                   
    }
    
       if($this->input->post('commentsubmit')){
         
           $arr = array("invoice_id"=>$id,"type"=>'PL',"orderno"=>$invoicedata->orderno,"comment"=>$this->input->post('comment'),"created_on"=>date('Y-m-d H:i:s'));
           $ins = $this->Home_model->insert(TBL_COMMENT,$arr);
           if($ins){
            $this->session->set_flashdata('message', 'Comment has been added successfully');
            redirect('admin/Invoice/edit/'.$id);
           }else{
            $this->session->set_flashdata('errmessage', 'Database problem occured');
            redirect('admin/Invoice/edit/'.$id);   
           }
                   
    }
    
     if($this->input->post('callsubmit')){
       
        $arr = array(
                     'master'=>'PL',
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
                        redirect('admin/Invoice/edit/'.$id);
                   }else{
                       $this->session->set_flashdata('errmessage', 'Some problem occurred');
                       redirect('admin/Invoice/edit/'.$id);
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
                     'master'=>'PL',
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
                   // $phone = '+91'.trim($this->input->post('mobileno'));
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => 'FURNITUREMU',
                            'body' => $msg
                        )
                    );  
  
                    /*   SMS API CODE END */   
                       
                        $this->session->set_flashdata('message', 'SMS has been sent successfully');
                        redirect('admin/Invoice/edit/'.$id);
                   }else{
                       $this->session->set_flashdata('errmessage', 'Some problem occurred');
                       redirect('admin/Invoice/edit/'.$id);
                   }
        
    }
    
  $data["page"]="Edit";
  $data["view"] = $this->Home_model->get_single_row(TBL_INVOICE,array('id'=>$id));
  $this->load->view('admin/invoicedit',$data);
}

public function send($id){
     
   $arr = array('sent_to_rt'=>1);    
   $updte = $this->Home_model->update(TBL_INVOICE,$id,$arr);
   $this->session->set_flashdata('message', 'Invoice has been sent successfully');
   redirect('admin/Invoice/');
 }
   
  public function posted(){
      $data["page"] = "Posted";
      $data["view"] = $this->db->query("select * from invoice where status='POSTED' group by orderno order by id")->result();
      $this->load->view('admin/complete',$data);
      
  }
  public function current(){
      $data["page"] = "Current";
      $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' and status!='POSTED' group by orderno order by id")->result();
      $this->load->view('admin/complete',$data);
      
  }
   public function void(){
      $data["page"] = "Void";
      $data["view"] = $this->db->query("select * from invoice where status='VOID' group by orderno order by id")->result();
      $this->load->view('admin/complete',$data);
      
  }
   public function deleted(){
      $data["page"] = "Deleted";
      $data["view"] = $this->db->query("select * from invoice where status='DELETED' group by orderno order by id")->result();
      $this->load->view('admin/complete',$data);
      
  }
  
  public function testmsg(){
       /*   SMS API CODE START */
                   
                    $sid = SID;
                    $token = TOKEN;
                    $client = new Client($sid, $token);
                    $phone = '8949121695'; 
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => '+18625052945',
                            'body' => 'test msg from api'
                        )
                    );  
  
                    /*   SMS API CODE END */   
  }

  public function adminChat(){
    if($this->input->post()){

      $checkOrderId = $this->Home_model->get_single_row('conversation',array('order_id'=>$this->input->post('order_id')));
      if(empty($checkOrderId)){
        $inputs = array(
          'order_id'=>$this->input->post('order_id'),
          'customer_id'=>$this->input->post('customer_id'),
          'type'=>$this->input->post('type'),
          'message'=>$this->input->post('message')
        );         
        $insert = $this->Home_model->insert('conversation',$inputs);
        if($insert){
          $getdata = $this->Home_model->get_single_row('conversation',array('order_id'=>$this->input->post('order_id')));
          $htmlii  = $getdata->id;
          $html = '';
          $html .= "<div class='row'><div class='col-md-6'></div>"; 
          $html .= "<div class='col-md-6'>".$getdata->message."</div></div>"; 
          $result = array('status'=>'true','message'=>'Ok','answer'=>$html,'htmlii'=>$htmlii);
        }
      }else{
        $inputs = array(
          'message_id'=>$this->input->post('message_id'),
          'customer_id'=>$this->input->post('customer_id'),
          'type'=>$this->input->post('type'),
          'reply'=>$this->input->post('message')
        );         
        $insert = $this->Home_model->insert('conversation_replies',$inputs);
        if($insert){
          $getdata = $this->Home_model->get_tbl_data('conversation_replies',array('message_id'=>$this->input->post('message_id')));
          $html = '';
          foreach($getdata as $getd){
            $html .= "<div class='row'><div class='col-md-6'>";
            if($getd->type == 'admin'){ 
              $html .= $getd->reply;
            }
            $html .= "</div>";
            $html .= "<div class='col-md-6'>";
            if($getd->type == 'customer'){ 
              $html .= $getd->reply;
            }
            $html .= "</div></div>";            
          }         
         
          $result = array('status'=>'true','message'=>'Ok','answer'=>$html);
        }

      }
    
    }else{
      $result = array('status'=>'false','message'=>'Question is required');
    }
    echo json_encode($result);die;
  }

  public function replyUs($orderno = '',$custid = ''){
    $data["page"] = "Reply Us";
	$getemail =  $this->db->query("select email,phone from customer where id='$custid'")->result();
    $data["customer_id"]  = $custid;
	$data["email_id"]  = $getemail[0]->email;
    $data["order_number"] = $orderno;
    if(!empty($orderno)&&!empty($custid)){
      $data["total_item"] = $this->db->query("select * from customer_itemcode where customer_id='$custid' and order_number = '$orderno'")->result();
    }else{
       $data["total_item"] = '';

    }
    $to = $getemail[0]->email;
	$subject = "Your complaint has been reviewed";
	 
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
						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">To check the status of your complaint click on <a href="https://aftersale.furniture/furniture.mu/Register/" target="_blank">link</a>.</p>
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
	 
	$header = "From:service@furniture.mu \r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html\r\n";
	mail ($to,$subject,$message,$header);

         $msg="Hi there,Your complaint has been reviewed by our team.  To check the status of your complaint click on  https://aftersale.furniture/furniture.mu/Register/  Username - Email given at the time of registration  Password - Order ID <br> Thanks";
    /*   SMS API CODE START */
                   
                    $sid = SID;
                    $token = TOKEN;
                    $client = new Client($sid, $token);
                    $phone = '+230'.trim($getemail[0]->phone); // '+230'.trim($getemail[0]->phone);
                    //$phone = '+91'.trim($this->input->post('mobileno'));
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => 'FURNITUREMU',
                            'body' => $msg
                        )
                    );  
  
                    /*   SMS API CODE END */   

    $data["view"] = $this->db->query("select * from invoice where status='DELETED' group by orderno order by id")->result();
    $this->load->view('admin/reply_customers',$data);
  }

  public function customerReplyHandle(){
    if($this->input->post()){
     
		if(!empty($this->input->post('not_covered_by_warranty'))){
	    	$covered = implode(', ', $this->input->post('not_covered_by_warranty'));
		}else{
		    $covered = '';
		}
		$inputs = array(
          'order_number'=>$this->input->post('order_number_rep_id'),
          'customer_id'=>$this->input->post('customer_rep_id'),
          'covered_by_warranty'=>$this->input->post('covered_by_warranty'),
          'not_covered_by_warranty'=>$covered,
		  'no_gurantee_option'=>$this->input->post('no_gurantee_option')!=null ? implode(', ', $this->input->post('no_gurantee_option')) : '',
          'simple_message'=>$this->input->post('simple_message'),
          'use_aftersale_service'=>$this->input->post('use_aftersale_service'),
          'more_options'=>$this->input->post('more_options'),
		);    
      //$items = $this->input->post('items');  
      $number = count($_POST["items"]);  
      if($number > 0)  {  
          for($i=0; $i<$number; $i++)  {  
            if(trim($_POST["items"][$i] != ''))    {  
              $inputs2 = array(
                'order_number'=>$this->input->post('order_number_rep_id'),
                'customer_id'=>$this->input->post('customer_rep_id'),
                'item_message '=>$_POST["items"][$i]                   
              );    
              $insert = $this->Home_model->insert('customer_additional_item_message',$inputs2);                 
            }  
          }             
      } 
      $insert = $this->Home_model->insert('customer_order_reply',$inputs);
	  if($this->input->post('email_id')){
                    $custid=$this->input->post('email_id');
          $getemail =  $this->db->query("select email,phone from customer where email='$custid'")->result();
		  $to = $this->input->post('email_id');
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
								<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">To check the status of your complaint click on <a href="https://aftersale.furniture/furniture.mu/Register/" target="_blank">link</a>.</p>
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
			 
			$header = "From:service@furniture.mu \r\n";
			$header .= "MIME-Version: 1.0\r\n";
			$header .= "Content-type: text/html\r\n";
			mail ($to,$subject,$message,$header);
                $msg="Hi there,Your complaint has been reviewed by our team.  To check the status of your complaint click on  https://aftersale.furniture/furniture.mu/Register/  Username - Email given at the time of registration  Password - Order ID <br> Thanks";

            /*   SMS API CODE START */
                   
                    $sid = SID;
                    $token = TOKEN;
                    $client = new Client($sid, $token);
                    $phone = '+230'.trim($getemail[0]->phone); //'+230'.trim($getemail[0]->phone); 
                   // $phone = '+91'.trim($this->input->post('mobileno'));
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => 'FURNITUREMU',
                            'body' => $msg
                        )
                    );  
  
                    /*   SMS API CODE END */
	  }
      $result = array('status'=>'true','message'=>'Ok');   
    }else{
      $result = array('status'=>'false','message'=>'Question is required');
    }
    echo json_encode($result);die;
  }

   public function uploadImageHandle(){
    if($this->input->post()){
      $inputs = array(
          'order_number'=>$this->input->post('order_number_rep_id'),
          'customer_id'=>$this->input->post('customer_rep_id'),
          'image_name'=>$this->input->post('image_name'),
          'order_message'=>$this->input->post('order_message'),
          'order_image'=>$_FILES['order_image']['name'],
      );  
      $folderpath = $_SERVER['DOCUMENT_ROOT'].'/furniture.mu/uploads/order_images/'.$_FILES['order_image']['name'];
      if(move_uploaded_file($_FILES['order_image']['tmp_name'], $folderpath)){

      }
      $insert = $this->Home_model->insert('order_uploaded_images',$inputs);
      $custid = $this->input->post('customer_rep_id');
      $orderno = $this->input->post('order_number_rep_id');

      $images = $this->db->query("select * from order_uploaded_images where customer_id='$custid' and order_number = '$orderno'")->result();

      $html ='';
      if(!empty($images)){
        $i = 1;
        foreach($images as $img){
          $html .= "<tr>";
          $html .= "<td>".$i."</td>";
          $html .= "<td>".$img->image_name."</td>";
          $html .= "<td><img src='".base_url('uploads/order_images/') .$img->order_image ."' style='width: 100px;border: 1px solid #ccc;border-radius: 5px;padding: 5px;height: 100px; '></td>";
          $html .= "<td>".$img->order_message."</td>";
          $html .= "</tr>";
          $i++;
        }        
      }


      $result = array('status'=>'true','message'=>'Ok','html'=>$html);   
    }else{
      $result = array('status'=>'false','message'=>'Question is required');
    }
    echo json_encode($result);die;
  }

  public function newCustomer(){
      $tring = $this->db->query("select customer.name,customer.email,customer.phone,customer.id,customer.address,customer.tc ,customer.created_at,customer_orderno.order_number,customer_orderno.purchase_date, invoice.id as invoice_id from customer left join customer_orderno on customer.id = customer_orderno.customer_id left join  invoice on customer_orderno.order_number = invoice.orderno GROUP BY id order by id desc")->result();
      
      $data["view"] = $tring;
      $data["newcust"] = $this->db->query("select order_number from customer_order_reply")->result(); 
    $this->load->view('admin/new_customers',$data);
  }

  public function repliedCustomer(){
     $data["view"] = $this->db->query("select customer.name,customer.email,customer.phone,customer.id,customer.address,customer.tc ,customer.created_at,customer_orderno.order_number,customer_orderno.purchase_date, invoice.id as invoice_id from customer left join customer_orderno  on customer.id = customer_orderno.customer_id left join  invoice on customer_orderno.order_number = invoice.orderno GROUP BY id order by id desc")->result();   
      $data["newcust"] = $this->db->query("select order_number from customer_order_reply")->result(); 
    $this->load->view('admin/replied_customers',$data);
  }

  public function allCustomer(){
     $data["view"] = $this->db->query("select customer.name,customer.firebase_id,customer.email,customer.phone,customer.id,customer.address,customer.created_at,customer.tc ,customer_orderno.order_number,customer_orderno.purchase_date, invoice.id as invoice_id ,notification.sender_id,notification.status,COUNT(notification.sender_id) message from customer left join customer_orderno on customer.id = customer_orderno.customer_id left join invoice on customer_orderno.order_number = invoice.orderno left JOIN notification on customer.firebase_id = notification.sender_id GROUP BY id order by id desc")->result();
        
     // echo(var_dump($data));
     // exit;
      $data["newcust"] = 0;//$this->db->query("select order_number from customer_order_reply")->result(); 
    $this->load->view('admin/all_customers',$data);
  }

  public function responseCustomer(){
    $data["view"] = $this->db->query("select customer.name,customer.email,customer.phone,customer.id,customer.address,customer.created_at,customer.tc ,customer_response.order_number,customer_response.more_options, invoice.id as invoice_id from customer left join customer_response  on customer.id = customer_response.customer_id left join  invoice on customer_response.order_number = invoice.orderno GROUP BY id order by id desc")->result();   
      $data["newcust"] = $this->db->query("select order_number from customer_order_reply")->result(); 
    $this->load->view('admin/customer_response',$data);
  }

  public function viewReplied($orderno = '',$custid = ''){
    $data["page"] = "View Reply";
    $data["customer_id"]  = $custid;
    $data["order_number"] = $orderno;
    if(!empty($orderno)&&!empty($custid)){
      $data["replies"] = $this->db->query("select * from customer_order_reply where customer_id='$custid' and order_number = '$orderno'")->result();
      $data["additional_message"] = $this->db->query("select * from customer_additional_item_message where customer_id='$custid' and order_number = '$orderno'")->result();
       $data["order_container"] = $this->db->query("select * from order_uploaded_images where customer_id='$custid' and order_number = '$orderno'")->result();
    }else{
      $data["replies"] = '';
      $data["additional_message"] = '';
      $data["order_container"] = '';
    }
    $data["view"] = $this->db->query("select * from invoice where status='DELETED' group by orderno order by id")->result();
    $this->load->view('admin/view_customer_replied',$data);
  }

  public function viewResponse($orderno = '',$custid = ''){
    $data["page"] = "View Response";
	$getemail =  $this->db->query("select email from customer where id='$custid'")->result();
	$data["email_id"]  = $getemail[0]->email;
    $data["customer_id"]  = $custid;
    $data["order_number"] = $orderno;
    if(!empty($orderno)&&!empty($custid)){
		$data["replies"] = $this->db->query("select * from customer_order_reply where customer_id='$custid' and order_number = '$orderno'")->result();
		
		$data["setweb"] = $this->db->query("select use_aftersale_service from customer_response where customer_id='$custid' and order_number = '$orderno'")->result();
		
		$data["response"] = $this->db->query("select * from customer_response where customer_id='$custid' and order_number = '$orderno'")->result();
		$data["additional_message"] = $this->db->query("select * from customer_additional_item_message where customer_id='$custid' and order_number = '$orderno'")->result();
		$data["order_container"] = $this->db->query("select * from order_uploaded_images where customer_id='$custid' and order_number = '$orderno'")->result();
    }else{
      $data["replies"] = '';
      $data["response"] = '';
      $data["additional_message"] = '';
      $data["order_container"] = '';
    }
    $data["view"] = $this->db->query("select * from invoice where status='DELETED' group by orderno order by id")->result();
    $this->load->view('admin/view_customer_response',$data);
  }


  public function customerReplyUpdate(){
    if($this->input->post()){

    
        $inputs = array(        
          'admin_more_options_date'=>$this->input->post('more_options_date'),
          'simple_message'=>$this->input->post('simple_message'),
          'admin_replied'=>'Yes'
        );  

        $mainup = $this->Home_model->update_where('customer_response',array('order_number'=>$this->input->post('order_number_rep_id'),'customer_id'=>$this->input->post('customer_rep_id')),$inputs);
    
		if($this->input->post('email_id')){
            $custid=$this->input->post('email_id');
          $getemail =  $this->db->query("select email,phone from customer where email='$custid'")->result();

		  $to = $this->input->post('email_id');
			$subject = "Your complaint status has been updated";
			 
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
								<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your complaint status has been updated,</p>
								<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Click on this link to check the latest updates on that <a href="https://aftersale.furniture/furniture.mu/Register/" target="_blank">link</a>.</p>
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

            $msg="Hi there,Your complaint status has been updated,Click on this link to check the latest updates on that  https://aftersale.furniture/furniture.mu/Register/   Thanks";
            /*   SMS API CODE START */
                   
                    $sid = SID;
                    $token = TOKEN;
                    $client = new Client($sid, $token);
                    $phone = '+230'.trim($getemail[0]->phone); //'+230'.trim($getemail[0]->phone); 
                   // $phone = '+91'.trim($this->input->post('mobileno'));
                    $client->messages->create(
                    $phone,
                        array(
                            'from' => 'FURNITUREMU',
                            'body' => $message
                        )
                    );  
  
                    /*   SMS API CODE END */
	  }
	 
      $result = array('status'=>'true','message'=>'Ok');   
    }else{
      $result = array('status'=>'false','message'=>'Question is required');
    }
    echo json_encode($result);die;
  }
	
	public function repliedInvoices(){
		$data["view"] = $this->db->query("select * from customer_order_reply group by order_number order by id")->result();   
		$this->load->view('admin/repliedInvoices',$data);
	}
	public function repliedInvoiceView($id){
		print_r($this->input->post());
		if($this->input->post('updatedriver')){
			$orderid = $this->input->post('order_number');
			$driver = $this->input->post('driver');
			$status = $this->input->post('status');
			if(!$driver){
				$this->session->set_flashdata('message', 'Driver id not found.','danger');
				redirect('admin/Custmers/repliedInvoiceView/'.$orderid);
			}else if(!$status){
				$this->session->set_flashdata('message', 'Status not found.','danger');
				redirect('admin/Custmers/repliedInvoiceView/'.$orderid);
			}else{
				if($status=="WITH DRIVER"){
					$asgnAr = array(
						'order_no'=>$orderid,
						'driver_id'=>$driver,
						'status'=>'Assigned',
						'delivery_note_no'=>'From Customer',
						'cancel_status'=>1,
						'created_on'=>date('Y-m-d H:i:s')
					);

          $assignwerb = $this->db->query("select * from assign where order_no='".$orderid."'  ORDER BY `id` DESC ")->result();
          if($assignwerb){ 
            foreach($assignwerb as $key=>$val){
              if($val->driver_id == $driver){
                 $this->db->query("DELETE FROM assign WHERE driver_id=$val->driver_id");
              }             
              $dd = array('status'=>'Not delivered');
              $updt = $this->Home_model->update_where(TBL_ASSIGN,array('order_no'=>$val->order_no),$dd);
            }
          }

					$insert = $this->Home_model->insert(TBL_ASSIGN,$asgnAr);    
					if($insert){
						$asupArr = array('driver_id'=>$driver,
									  'assign_date'=>date('Y-m-d H:i:s'),
									  'driver_status'=>'Assigned',
									  'delivery_note_no'=>'From Customer'
									 );   
						$updt = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$orderid),$asupArr);  
						
						$instxn = $this->Home_model->insert(TBL_STATUS_TXN,array('type'=>'DRIVER','assign_id'=>$insert,'orderno'=>'From Customer','status'=>'Assigned','created_on'=>date('Y-m-d h:i:s')));
						$arr = array('status'=>$status);
					}
				}else{
					$arr = array('status'=>$status);
				}
				$upd = $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$orderid),$arr);
				if($upd){
					$stArr = array("invoice_id"=>$id,"orderno"=>$orderid,"status"=>$status,"created_on"=>date('Y-m-d H:i:s'));
					$ins = $this->Home_model->insert(TBL_STATUS_TXN,$stArr);
					$this->session->set_flashdata('message', 'Assigned Successfully');
					redirect('admin/Custmers/repliedInvoices/');
			   }else{
				   $this->session->set_flashdata('errmessage', 'Some problem occurred');
				   redirect('admin/Custmers/repliedInvoices/');
			   }
			}			
		}
		$data["ticket"] = $this->db->query("select id,order_number from customer_order_reply where order_number = '$id'")->result();
		$data["drivers"] = $this->db->query("select id,name from drivers")->result();
		$this->load->view('admin/repliedInvoiceView',$data);
	}
	/* public function updatedriver(){
		echo 'dddddddddddddddd';
		print_r($this->input->post());
		exit;
		
		
	} */


  public function customerInvoice($id){
   // $data['page'] = $_GET['index'];
    $data["view"] = $this->Home_model->get_single_row(TBL_INVOICE,array('orderno'=>$id));
    $data["orders"] = $this->Home_model->get_tbl_data(TBL_INVOICE,array('orderno'=>$data["view"]->orderno));
    $mm = $data["view"]->mobile;
    $pp = $data["view"]->phone;
    $mobile =str_replace("-","",$mm);
    $phone =str_replace("-","",$pp);
    $data["calls"] = $this->db->query("select * from calls where contact='$mobile' OR contact='$phone'")->result();
    $data["SMS"] = $this->Home_model->get_tbl_data(TBL_CALL_SMS,array('invoice_id'=>$id,'type'=>'SMS'));
    $data["comments"] = $this->Home_model->get_tbl_data(TBL_COMMENT,array('invoice_id'=>$id));
    $data["status"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno));
    $data["driverstatus"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno,'type'=>'DRIVER'));
    $this->load->view('admin/customers_invoice_view',$data);
 }
 
 public function chat(){
    $user['id']=2;
    $parameters = $this->input->get('q');
    $data['customer']=$this->Home_model->get_single_row('customer',array('firebase_id'=>$parameters));
        
    $userData=$this->session->get_userdata('admin_user');
    
    $data["admin_firebase_id"]=$userData["admin_user"]["firebase_id"];
    $this->load->view('chat',$data);
    

  }
  public function read(){
    $id=$this->input->post('userId');
    $this->db->query("DELETE FROM notification WHERE sender_id='$id'");
    echo 'message read';
  }
  
  public function complaint()
  {
        $result= $this->db->query("SELECT assign.*,
        status_txn.type as status_type,
        invoice.id as invoice_id,
        invoice.name as invoice_name,
        invoice.phone as invoice_phone,
        drivers.name as driver_name
        FROM assign 
        INNER join drivers on drivers.id = assign.driver_id
        INNER join status_txn on status_txn.assign_id = assign.id
        INNER join invoice on invoice.orderno = assign.order_no
        where assign.status ='Own Delivered'")->result();
    
      //  echo "<pre>";
  $data["page"]="Complaint";
    $data['view']=$result;
  //  print_r($data);
  //      exit;
         $this->load->view('admin/complaint',$data);
    
      
  }
   
}

