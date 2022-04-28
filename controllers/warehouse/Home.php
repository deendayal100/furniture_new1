<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 
			  }

public function index()
  {
	   
	    $data["page"]="Dashboard";
	    $data["sent_to_rt"] = $this->db->query("select * from invoice where status='SENT TO RT' group by orderno order by id")->result();
	    $data["item_to_pl"] = $this->db->query("select * from invoice where status='SENT TO PL' group by orderno order by id")->result();
	    $this->load->view('warehouse/home',$data);
 }
 
public function calls()
  {
	   if($this->input->post('userSubmit')){
	       //echo "<pre>";
	       //print_r($_FILES);exit;
	       if($_FILES["recordings"]["name"])
		   {
		         
			   foreach($_FILES["recordings"]["name"] as $filimgs => $fil)
			   {
				  $filed = $this->files("recordings",$filimgs) ; 
				  if($filed)
				  {
				   // $contact = substr($fil,0,8); 
				     $conArr = explode("t",$fil);
				     $arr = array('contact'=>$conArr[0],'name'=>$fil,'path'=>$filed,'created_on'=>date('Y-m-d H:i:s')); 
				     $insert = $this->Home_model->insert(TBL_CALLS,$arr);
				  }
			   } 
			   if($insert){
                    $this->session->set_flashdata('message', 'Recordings uploaded successfully');
                    redirect('warehouse/Home/calls');
			   }else{
			        $this->session->set_flashdata('errmessage', 'Some problem occured');
                    redirect('warehouse/Home/calls');
			   }
			   
		     }
	       
	   }
	    $data["page"]="Add calls";
	    $this->load->view('warehouse/addcalls',$data);
 } 
 
 public function files($name,$index)
{
                 if(!empty($_FILES[$name]['name'][$index]))
					{
					   
						$_FILES['file']['name'] = $_FILES[$name]['name'][$index];
						$_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$index] ;
						$_FILES['file']['size'] = $_FILES[$name]['size'][$index] ;
						$config['upload_path'] = 'uploads/calls/';
						$config['allowed_types'] = '*';
                        $config['file_name'] = $_FILES['file']['name'];
						
						
						$photo=explode('.',$_FILES[$name]['name'][$index]); 
						$ext = strtolower($photo[count($photo)-1]); 
						if (!empty($_FILES[$name]['name'])) { 
						
							$curr_time = time(); 
							$filename= "recording_".time()."_".$index.".mp3.".$ext; 
							} 
						 $config['file_name'] = $filename; 
						
						//Load upload library and initialize configuration
						$this->load->library('upload',$config);
						$this->upload->initialize($config);
						
							if($this->upload->do_upload('file'))
							{
								 $uploadData = $this->upload->data();
								return $deal1image = "uploads/calls/".$uploadData['file_name'];
							}else{
							    // echo $this->upload->display_errors(); die();
								return $deal1image = '';
							}
					}else{
					return	$deal1image = '' ;
					}	 
					
}

  

      
}

