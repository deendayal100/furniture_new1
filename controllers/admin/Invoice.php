<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 require_once(APPPATH.'libraries/vendor/php-excel-reader/excel_reader2.php');
 require_once(APPPATH.'libraries/vendor/SpreadsheetReader.php');
 require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
 
class Invoice extends CI_Controller {
	
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
         $data["view"] = $this->db->query("select * from invoice where status='$status' group by orderno order by id desc")->result();
    }elseif($this->input->post('senttort')){ 
          //echo "<pre>";print_r($_POST);exit;
          $invoice = $this->input->post('invoice');
          if(!empty($invoice)){
            foreach($invoice as $inv){
              $this->Home_model->update_where(TBL_INVOICE,array("orderno"=>$inv),array("status"=>"SENT TO RT","sent_to_rt"=>1));    
            }
          }
          $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' group by orderno order by id desc")->result();
    }elseif($this->input->post('own')){ 
          $own = $this->input->post('ids');
		  $exp = explode(',',$own);
          if(!empty($exp)){
			  
            foreach($exp as $inv){
              $this->Home_model->update_where(TBL_INVOICE,array("id"=>$inv),array("own_delivery"=>1));    
            }
          }
          $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' group by orderno order by id desc")->result();
    }else{	   
	   //$this->db->query("UPDATE invoice SET status='WITH DRIVER' where driver_status='Assigned' OR driver_status='On the way' OR driver_status='Not delivered'");
	   
         $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' group by orderno order by id desc")->result();
    } 
	
	

	
	    $data["page"]="Category";
	    $data["returninvoice"] = $this->db->query("select * from invoice where status='SENT TO PL' OR status='CHANGE OF ITEMS' group by orderno order by id desc")->result();
	    
	    $this->load->view('admin/invoice',$data);
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
        $data["view"] = $this->db->query("select * from invoice where actual_del_date> '' group by orderno order by id DESC")->result();
        //$this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('actual_del_date>'=>"", 'order'=>"id desc"));
    }
    $data["page"]="Scheduled";
	
    $this->load->view('admin/complete',$data);
} 
public function own(){
    
    $data["page"]="Own";
    $data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_INVOICE,array('status'=>'Own Delivered'));
    $this->load->view('admin/invoice',$data);
}
public function add1()
  {
    
	 if($this->input->post('submit')){
	      
	  //echo "<pre>";print_r($_FILES);exit;   
	   $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','text/csv'];
 // echo "<pre>";print_r($_FILES);exit;  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
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
          // echo "<pre>";
          // print_r($Row);
          // echo "</pre>";
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
                             'location'=>$Row[16],
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
                             'location'=>$Row[16],
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
                             'location'=>$Row[16],
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
                   
                   /*   SMS API CODE START 
                   
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
                    );  */
                    $sid = SID;
            		$token = TOKEN;
            		$client = new Client($sid, $token);
            		$phone = '+230'.trim($this->input->post('mobileno')); 
            		$client->messages->create(
            		$phone,
            			array(
            				'from' => 'FURNITURE.MU',
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
 
 public function view($id){
   // $data['page'] = $_GET['index'];
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
  
    $this->load->view('admin/invoice_view',$data);
 }
 
 
  public function delete($ord){
  
   // $this->Home_model->delete(TBL_INVOICE,"orderno",$ord);
    $this->Home_model->update_where(TBL_INVOICE,array('orderno'=>$ord),array('status'=>'DELETED'));
	$this->session->set_flashdata('message', 'Invoice has been deleted successfully');
	redirect('admin/Invoice') ;
  
  }
  
  public function posted(){
      $data["page"] = "Posted";
      $data["view"] = $this->db->query("select * from invoice where status='POSTED' group by orderno order by id desc")->result();
      $this->load->view('admin/complete',$data);
      
  }
  public function current(){
      $data["page"] = "Current";
      $data["view"] = $this->db->query("select * from invoice where status!='VOID' and status!='DELETED' and status!='POSTED' group by orderno order by id desc")->result();
      $this->load->view('admin/complete',$data);
      
  }
   public function void(){
      $data["page"] = "Void";
      $data["view"] = $this->db->query("select * from invoice where status='VOID' group by orderno order by id desc")->result();
      $this->load->view('admin/complete',$data);
      
  }
   public function deleted(){
      $data["page"] = "Deleted";
      $data["view"] = $this->db->query("select * from invoice where status='DELETED' group by orderno order by id desc")->result();
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
                            'from' => 'FURNITURE.MU',
                            'body' => 'test msg from api'
                        )
                    );
     
                    /*   SMS API CODE END */   
  }
 
    
    public function complaint_view($id)
    {
    $data['staffDetails']='';
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
	  $data["driverstatus"] = $this->Home_model->get_tbl_data(TBL_STATUS_TXN,array('orderno'=>$data["view"]->orderno,'type'=>'DRIVER'));

      //change by vinod
      $data["complain"] = $this->Home_model->get_tbl_data('customer',array('password'=>$data["view"]->orderno));
      $data["id"] = $data["view"]->orderno;
   // echo "<pre>";
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
    // print_r($data["staffDetails"]);
    // exit;
    $this->load->view('admin/complaint_invoice_view',$data);
    }

   
}

