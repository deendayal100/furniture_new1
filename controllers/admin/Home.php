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
	     $data["item_to_pl"] = $this->db->query("select * from invoice where status='SENT TO PL' group by orderno order by id")->result();
	     $data["rec_by_pl"] = $this->db->query("select * from invoice where status='RECEIVED BY PL' group by orderno order by id")->result();
	    $this->load->view('admin/home',$data);
 }
 public function wipeout(){
   $del = $this->Home_model->deleteall();
   $this->session->set_flashdata('message', 'All data deleted successfully');
   redirect('admin/Home/');
 }
 public function wipe(){
   $this->load->view('admin/wipe');
 }
 public function calls()
  {
	   if($this->input->post('userSubmit')){
	      
	       if($_FILES["recordings"]["name"])
		   {
		          echo "<pre>";
	    //   print_r($_FILES);exit;
			   foreach($_FILES["recordings"]["name"] as $filimgs => $fil)
			   {
				  $filed = $this->files("recordings",$filimgs) ; 
				  if($filed)
				  {
				   // $contact = substr($fil,0,8); 
				     $conArr = explode("t",$fil);
				    //  print_r($conArr);
				    //  exit;
				     $arr = array('master'=>"PL",'contact'=>substr($conArr[0], 3),'name'=>$fil,'path'=>$filed,'created_on'=>date('Y-m-d H:i:s')); 
				    //  print_r($arr);
				    //  exit;
				     $insert = $this->Home_model->insert(TBL_CALLS,$arr);
				  }
			   } 

			   if($insert){
                    $this->session->set_flashdata('message', 'Recordings inserted successfully');
                    redirect('admin/Home/calls');
			   }else{
			        $this->session->set_flashdata('errmessage', 'Some problem occured');
                    redirect('admin/Home/calls');
			   }
			   
		     }
	       
	   }
	    $data["page"]="Add calls";
	    $this->load->view('admin/addcalls',$data);
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

  
 
 
 
 public function minprice(){
       if($this->input->post('submit')){
          
		    $arr = array(
			             'min_price'=>$this->input->post('min_price'),
						 'updated_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->update(TBL_PRICERANGE,1,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'Minimum Price has been updated successfully');
			    redirect('admin/Home/minprice');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Home/minprice');
			}			
			
		}
      $data["records"] = $this->Home_model->get_single_row(TBL_PRICERANGE,array());
	  $this->load->view('admin/minprice',$data);
 }
 
 public function cityadd(){
       if($this->input->post('submit')){
          $country_id = $this->input->post('country_id');
          $state_id = $this->input->post('state_id');
          $city = $this->input->post('city');
          if(!empty($city)){
              foreach($city as $ct){
               $arr = array(
		             'state_id'=>$this->input->post('state_id'),
					 'name'=>$ct
					);
		        $insert = $this->Home_model->insert('cities',$arr);	
              }
          }
		   
            if($insert){
				$this->session->set_flashdata('message', 'Minimum Price has been updated successfully');
			    redirect('admin/Home/cityadd');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Home/cityadd');
			}			
			
		}
      $data["countries"] = $this->Home_model->get_tbl_data("countries",array());
      $this->load->view('admin/cityadd',$data);
 }
 
 public function getstate($id=0){
	    
		if($id>0){
			
			$states = $this->Home_model->get_tbl_data("states",array("country_id"=>$id));
			
			$output = '<option value="">Select State</option>';
			
			foreach($states as $state){
				
				$output .= '<option value="'.$state->id.'">'.$state->name.'</option>';
				
				}
				
				echo $output;
			
			}
			die();
	}
	
	public function contact(){
	    
	    $data["view"] = $this->Home_model->get_tbl_data_inorder("contact",array());
	    $this->load->view('admin/contact',$data);
	}
	

 


      
}

