<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/twilio-php-master/src/Twilio/autoload.php';
use Twilio\Rest\Client;
class Register extends CI_Controller {

	function __construct()
  {
    parent::__construct();
    $this->load->helper('string');
    $this->load->model('admin/Home_model','',TRUE);
    
  }
	public function index(){
		$this->load->view('register');
	}
	public function step1(){
		$order_number = $this->input->post('order_number');
		$purchase_date = $this->input->post('purchase_date');
		$date = date("Y-m-d h:i:s", time());		
		/*$insert = $this->db->query("INSERT INTO customer (order_number, purchase_date, password, created_at, updated_at) VALUES ('$order_number', '$purchase_date','$order_number', '$date', '$date')");*/

		//$checkInvoice = $this->db->query("select orderno from invoice where orderno='$order_number'")->result();
		//if($checkInvoice){
			$checkOrderAlreadyTaken = $this->db->query("select order_number from customer_orderno where order_number='$order_number'")->result();
			if(empty($checkOrderAlreadyTaken)){
				$insert = $this->db->query("INSERT INTO customer_orderno (order_number, purchase_date) VALUES ('$order_number', '$purchase_date')");
				if($insert==1){
					$lastrow = $this->db->query("select order_number from customer_orderno ORDER BY id DESC LIMIT 1")->result();
					$lastid = $lastrow[0]->order_number;
					$result=array('status'=>true,'id'=>$lastid,'date'=>$purchase_date,'message'=> 'Step 1 is completed. Fill more data..');
				}else{
					$result=array('status'=>false,'message'=> 'Something went wrong.');
				}
			}else{
			    $result=array('status'=>true,'id'=>$checkOrderAlreadyTaken[0]->order_number,'date'=>$purchase_date,'message'=> 'Step 1 is completed. Fill more data..');
				//$result=array('status'=>false,'message'=> 'Order number already taken by someone exists.');
			}			
		//}else{
		//	$result=array('status'=>false,'message'=> 'Order number not exists.');
		//}
		echo json_encode($result);
		exit;
	}
	public function information($id){
		$this->load->view('information');
	}
	public function step2(){
		$post = $this->input->post();
		$id = $this->input->post('id');
		$orderdate = $this->input->post('date');
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$tc = $this->input->post('tc');
		$dmg_itemcode = $this->input->post('dmg_itemcode');
		$item_address = $this->input->post('item_address');
		$damaged_message = $this->input->post('damaged_message');
		$firebase_id=random_string('alnum', 14).''.date('s');
		$date = date("Y-m-d h:i:s", time());
		if($tc){
			$terms = 'Yes';
		}else{
			$terms = 'No';
		}

		$taps = $_FILES['images']['name'];

		$c = 1;$cts=0;$row=0;
		foreach($taps as $key=>$ctcheck){
				 
					if(empty($ctcheck[0])){
							$row=$key;
							
							break;
					}
					if(empty($ctcheck[1])){
						 $row=$key;
						
						 break;
					}
					if(empty($ctcheck[2])){
						 $row=$key;
						
						 break;
					}
					
				$imgcount = count($ctcheck);

				// if($imgcount<3){
				// 	$row = $c;
				// }else{
				// 	$row = 'no';
				// }
				// $cts+= count($ctcheck);
				
				// $c++;
		}
		$rowcount = count($taps)*3;
		 
		if($row!=0){
			$result=array('status'=>false,'message'=> "Upload minimum 3 image in $row row");
		}else{
		    
		    $checkInvoice = $this->db->query("select orderno from invoice where orderno='$id'")->result();
		    if(!$checkInvoice){
		        $insert = $this->db->query("INSERT INTO `invoice` (`orderno`, `order_date`, `expected_del_date`, `actual_del_date`, `due_amount`, `amount_paid`, `Combo68`, `order_note`, `gps_code`, `name`, `mobile`, `phone`, `extra_mobile_no`, `txtAddress`, `city`, `Text74`, `txt_Qty_Delivered`, `txt_Quantity`, `Description`, `item_code`, `item_note`, `Text61`, `cim_approved`, `reserved`, `recieved_date`, `status`, `sent_to_rt`, `warehouse_status`, `remarks`, `own_delivery`, `express_delivery`, `driver_id`, `delivery_note_no`, `assign_date`, `driver_status`, `comment`, `created_on`, `updated_on`) VALUES ('$id', '$orderdate', '', '', '$.', '', '', '$damaged_message[1]', '', '$name', '', '$phone', '', '$address', '', '', '1', '1', '$damaged_message[1]', '$dmg_itemcode[1]', '', '', 'YES', 'YES', '', '', '', '0', '', '0', '1', '1', '', '', '', '', '$date', '$date')");
		    }
		   
			$date = date("Y-m-d h:i:s", time());
			$checkEmail = $this->db->query("select email from customer where email='$email'")->result();
			$insert = $this->db->query("INSERT INTO customer (firebase_id,name,phone,email,address,password,tc,created_at, updated_at) VALUES ('$firebase_id','$name', '$phone','$email', '$address','$id','$terms','$date','$date')");
			$lastrow = $this->db->query("select id from customer ORDER BY id DESC LIMIT 1")->result();
			$lastCustomerid = $lastrow[0]->id;
			if($lastCustomerid!=0){								
				$update = $this->db->query("UPDATE customer_orderno SET customer_id='$lastCustomerid' WHERE order_number = $id");
				if($dmg_itemcode){
					foreach($dmg_itemcode as $code){
						$check = $this->db->query("select * from customer_itemcode where dmg_itemcode='$code' and customer_id = '$lastCustomerid'  and order_number = '$id'")->result();
						if($check){
							$this->db->query("UPDATE customer_itemcode SET dmg_itemcode='$code' WHERE dmg_itemcode = '$code' and customer_id = '$lastCustomerid'  and order_number = '$id'");
						}else{
							$this->db->query("INSERT INTO customer_itemcode (customer_id, dmg_itemcode,order_number) VALUES ('$lastCustomerid', '$code','$id')");
						}
					}
				}
				if($item_address){
					foreach($item_address as $iaddres){
						$check = $this->db->query("select * from customer_itemaddress where item_address='$iaddres' and customer_id = '$lastCustomerid'  and order_number = '$id'")->result();
						if($check){
							$this->db->query("UPDATE customer_itemaddress SET item_address='$iaddres' WHERE item_address = '$iaddres' and customer_id = '$lastCustomerid'  and order_number = '$id'");
						}else{
							$this->db->query("INSERT INTO customer_itemaddress (customer_id, item_address,order_number) VALUES ('$lastCustomerid', '$iaddres','$id')");
						}
					}
				}
				if($damaged_message){
					foreach($damaged_message as $dmessage){
						$check = $this->db->query("select * from customer_damaged_message where damaged_message	='$dmessage' and customer_id = '$lastCustomerid'  and order_number = '$id'")->result();
						if($check){
							$this->db->query("UPDATE customer_damaged_message SET damaged_message	='$dmessage' WHERE damaged_message = '$dmessage' and customer_id = '$lastCustomerid'  and order_number = '$id'");
						}else{
							$this->db->query("INSERT INTO customer_damaged_message (customer_id, damaged_message,order_number) VALUES ('$lastCustomerid', '$dmessage','$id')");
						}
					}
				}
				/// updated code with multiple images
				if($_FILES['images']){
					$imgname = $_FILES['images']['name'];
					$tmp = $_FILES['images']['tmp_name']; 
					if($tmp){
						$i=0;
						foreach($tmp as $key=>$tmname){
							$filename='';
							$name = $imgname[$key];
							$tempname= $tmname;
							$v = 0;
							foreach($tempname as $autodata){
								$folderpath = $_SERVER['DOCUMENT_ROOT'].'/furniture.mu/uploads/customer_itemimage/'.$name[$v];
								if(move_uploaded_file($autodata, $folderpath)){
									$check1 = $this->db->query("select * from customer_itemimages where  customer_id = '$lastCustomerid'  and order_number = '$id' AND images='$name[$v]'")->result();
									if($check1){
										$this->db->query("UPDATE customer_itemimages SET images='$name[$v]' WHERE  customer_id = '$lastCustomerid'  and order_number = '$id'");
									}else{
										$this->db->query("INSERT INTO customer_itemimages (customer_id, images,order_number) VALUES ('$lastCustomerid', '$name[$v]','$id')");
									}
								}
								$v++;
							}
							
							$i++;
						}
					}
				}
				
				if($_FILES['invoices']){
					$imgname = $_FILES['invoices']['name'];
					$tmp = $_FILES['invoices']['tmp_name']; 
					if($tmp){
						$i=0;
						foreach($tmp as $key=>$tmname){
							$filename='';
							$name = $imgname[$key];
							$tempname = $tmname;
							$folderpath = $_SERVER['DOCUMENT_ROOT'].'/furniture.mu/uploads/customer_iteminvoices/'.$name;
							if(move_uploaded_file($tempname, $folderpath)){
								$check1 = $this->db->query("select * from customer_iteminvoice where customer_id = '$lastCustomerid'  and order_number = '$id'  AND invoices='$name'")->result();
								if($check1){
									$this->db->query("UPDATE customer_iteminvoice SET invoices='$name' WHERE  customer_id = '$lastCustomerid'  and order_number = '$id'customer_id");
								}else{
									$this->db->query("INSERT INTO customer_iteminvoice (customer_id, invoices,order_number) VALUES ('$lastCustomerid', '$name','$id')");
								}
							}
							$i++;
						}
					}
				}
				/* if($phone){
					$sid = SID;
					$token = TOKEN;
					$client = new Client($sid, $token);
					$phone = '+230'.trim('58950560');
					$client->messages->create(
					$phone,
						array(
							'from' => '+18625052945',
							'body' => 'testing From After Sale'
						)
					);
				} */
				if($email){
					$to = $email;
					$subject = "Complaint has been registered";
					 
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
										<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi '.$this->input->post('name').',</p>
										<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your Complaint has been submitted.</p>
										<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Our team will reply on this shortly.</p>
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
				}
				$result=array('status'=>true,'message'=> 'APPLICATION SUBMITTED SUCCESSFULLY ');
			}else{
				$result=array('status'=>false,'message'=> 'Something went wrong.');
			}
		}
		
		
		
		echo json_encode($result);exit;
	}
	
	public function login(){
		$email = $this->input->post('email');
		$password = $this->input->post('Password');
		
		$check = $this->db->query("select * from customer where email='$email' AND password= '$password'")->result();
		if($check){
			$_SESSION['current_customer_id'] = $check[0]->id;
			$result=array('status'=>true,'data'=>$check[0],'message'=> 'Login successfully');
		}else{
			$result=array('status'=>false,'message'=> 'Detail not matching.');
		}
		echo json_encode($result);
		exit;
	}
	
	
		public function authadmin(){
               
                        $password = $this->input->post('inputPass');
                        $password = $password ;
						$adminData = $this->Home_model->get_single_row(TBL_ADMIN,array('password'=>$password));
						
						if(!empty($adminData)){
                           $del = $this->Home_model->deleteall();
						   $this->session->set_flashdata('message', 'All data deleted successfully');
						   redirect('admin/Home/');
                        }else{
							$this->session->set_flashdata('login_failed','Invalid Username or Password');
							redirect('admin/wipe/');
                        }
               
        }

		public function logout() {
				$this->session->sess_destroy();
				redirect ('admin/Login/');
		}
		public function success(){
			$this->load->view('success');
		}
}
