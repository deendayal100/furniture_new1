<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends LATETASK_Controller {
	  
	    function __construct()
  {
      parent::__construct();
   
          $this->load->model('admin/Home_model','',TRUE);
    
  }

public function index()
  {
	  
	 $data["page"] = "Home" ;
	 redirect('admin/Login');
	 
  }
  
public function english()
  {
	  
	 $data["page"] = "spanish" ;
	 $data["category"] = $this->Home_model->get_tbl_data(TBL_CATEGORY,array('status'=>1));
	 $this->load->view("index1",$data);
	 
  }  
public function save(){
    
     if($this->input->post('userSubmit')){
        //  echo "<pre>";
        //  print_r($_POST);print_r($_FILES);exit;
          $chk = $this->Home_model->get_single_row(TBL_STORE,array('email'=>$this->input->post('email')));
          if(!empty($chk)){
              	$this->session->set_flashdata('errmessage', 'Email already exist');
			    redirect('Home/');
          }
          $this->imagess("hi");
         
		    if(!empty($_FILES['image']['name']))
			{
			    
			   $image = $this->imagess('image');
		    }else{
		        $image ="";
		    }
		    if(!empty($_FILES['kyc_img']['name']))
			{
			   $kyc_img = $this->imagess('kyc_img');
		    }else{
		        $kyc_img ="";
		    }
		     if(!empty($_FILES['business_reg_img']['name']))
			{
			   $business_reg_img = $this->imagess('business_reg_img');
		    }else{
		        $business_reg_img ="";
		    }
		    
			$arr = array(
			             'category_id'=>$this->input->post('category_id'),
			             'name'=>$this->input->post('business_name'),
			             'email'=>$this->input->post('email'),
			             'phone'=>$this->input->post('contactno'),
			             'password'=>$this->input->post('password'),
                         'address'=>$this->input->post('address'),
                         'lat'=>$this->input->post('lat'),
                         'lon'=>$this->input->post('lon'),
                         'business_type'=>$this->input->post('business_type'),
                         'business_gst'=>$this->input->post('business_gst'),
                         'postal_code'=>$this->input->post('postal_code'),
                         'min_time'=>$this->input->post('mintime'),
                         'max_time'=>$this->input->post('maxtime'),
			             'image'=>$image,
			             'kyc_img'=>$kyc_img,
			             'business_reg_img'=>$business_reg_img,
			             //'status'=>1,
						 'created_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->insert(TBL_STORE,$arr);	
            if($insert){
                
                $storeData = $this->Home_model->get_single_row(TBL_STORE,array('id'=>$insert));
                
                if(!empty($storeData)){
                
                    $store_data =array(
                    'store_id'=>$storeData->id,
                    'store_name'=>$storeData->name,
                    'email'=>$storeData->email,
                    'image'=>$storeData->image,
                    'is_active'=>$storeData->is_active,
                    'logged_in'=> TRUE
                    );
                   //ser session userdata
                   $logged_in = $this->session->set_userdata('store_user',$store_data);
                }
                
				$this->session->set_flashdata('message', 'Store has been registered successfully');
			    redirect('Home/waiting');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('Home/');
			}			
			
		}
    
    
} 

 public function imagess($name)
{
              
                 if(!empty($_FILES[$name]['name']))
					{
					   
						$_FILES['file']['name'] = $_FILES[$name]['name'];
						$_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'] ;
						$_FILES['file']['size'] = $_FILES[$name]['size'] ;
						$config['upload_path'] = 'upload/stores';
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
								return $deal1image = "upload/stores/".$uploadData['file_name'];
							}else{
								return $deal1image = '';
							}
					}else{
					return	$deal1image = '' ;
					}	 
					
}
  
public function waiting()
  {
	  
	 $data["page"] = "Waiting" ;
	 $this->load->view("waiting",$data);
	 
  }
  
  public function waiting1()
  {
	  
	 $data["page"] = "Waiting" ;
	 $this->load->view("waiting1",$data);
	 
  }
  
   public function login(){
               
        $email = $this->input->post('email'); 
        $password = $this->input->post('password');
        $password = $password ;
		$storeData = $this->Home_model->get_single_row(TBL_STORE,array('email'=>$email,'password'=>$password));
		
		if(!empty($storeData)){
		    
		        $store_data =array(
                        'store_id'=>$storeData->id,
                        'store_name'=>$storeData->name,
						'email'=>$storeData->email,
						'image'=>$storeData->image,
						'is_active'=>$storeData->is_active,
                        'logged_in'=> TRUE
                       );
             //ser session userdata
			   $logged_in = $this->session->set_userdata('store_user',$store_data);
			   if($storeData->status==1){
			       redirect('store/Home');
			   }else{
			        $this->session->set_flashdata('login_failed','Your account is not approved.Please contact to admin or try after some time');
                    redirect('Home/waiting');
			   }
			   
		    
        }else{
                        //set error
                $this->session->set_flashdata('login_failed','Invalid Username or Password');
                redirect('Home/');
        }
               
        }
public function forget(){
    
    if($this->input->post('femail')){
        $userdata = $this->Home_model->get_single_row(TBL_STORE,array('email'=>$this->input->post('femail')));
        $this->sendmail($userdata);
        $this->session->set_flashdata('success','Email sent successfully');
        redirect('store/Home');
    }
    
}

	public function chkstatus() {
			$stid = $this->session->userdata["store_user"]["store_id"]; 
			$storeData = $this->Home_model->get_single_row(TBL_STORE,array('id'=>$stid));
			
			if($storeData->status==1){
			    	redirect ('store/Home');
			}else{
			    redirect ('Home/waiting');
			}
			
		}
		
	public function logout() {
				$this->session->sess_destroy();
				redirect ('Home/');
		}

public function sendmail(){
    
    
}
  
      
}

