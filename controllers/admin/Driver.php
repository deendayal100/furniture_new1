<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 
			  }


public function index()
  {
	 
	    $data["page"]="Driver";
		$data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_DRIVER,array('role'=>'driver'));
	    $this->load->view('admin/drivers',$data);
 }

 /*      Add Driver   */
 
public function add()
  {     
        if($this->input->post('submit')){
        $chk = $this->Home_model->get_single_row(TBL_DRIVER,array('mobile'=>$this->input->post('mobile')));  
        if(!empty($chk)){
        	$this->session->set_flashdata('errmessage', 'Mobile no already registered');
		    redirect('admin/Driver/add');
        }
	     if(!empty($_FILES['image']['name']))
				{
					$configs['upload_path'] = 'uploads/Driver/';
					$configs['allowed_types'] = 'jpg|jpeg|png|gif';
					$configs['file_name'] = $_FILES['image']['name'];
					
			 	    //Load upload library and initialize configuration
					$this->load->library('upload',$configs);
					$this->upload->initialize($configs);
				
					if($this->upload->do_upload('image'))
					{
						$uploadData = $this->upload->data();
						$image = "uploads/Driver/".$uploadData['file_name'];
					    
					}else{
						$image = '';
					}
				}else{
				    $image="";
				}
			$arr = array(
			             'name'=>$this->input->post('name'),
			             'role'=>'driver',
			             'image'=>$image,
			             'email'=>$this->input->post('email'),
			             'mobile'=>$this->input->post('mobile'),
			             'password'=>$this->input->post('password'),
			             'truck_plate_no'=>$this->input->post('truck_plate'),
			             'status'=>1,
						 'created_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->insert(TBL_DRIVER,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'Driver has been added successfully');
			    redirect('admin/Driver');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Driver');
			}			
			
		}
	    $data["page"]="Add Driver";
	    $this->load->view('admin/driver_add',$data);
 }
 
 public function edit($id)
  {     
        if($this->input->post('submit')){
			 if(!empty($_FILES['image']['name']))
				{
					$configs['upload_path'] = 'uploads/Driver/';
					$configs['allowed_types'] = 'jpg|jpeg|png|gif';
					$configs['file_name'] = $_FILES['image']['name'];
					
			 	    //Load upload library and initialize configuration
					$this->load->library('upload',$configs);
					$this->upload->initialize($configs);
				
					if($this->upload->do_upload('image'))
					{
						$uploadData = $this->upload->data();
						$image = "uploads/Driver/".$uploadData['file_name'];
					    
					}else{
						$image = '';
					}
				}else{
				    $image = $this->input->post("old_img");
				}
			$arr = array(
			             'name'=>$this->input->post('name'),
			             'image'=>$image,
			             'email'=>$this->input->post('email'),
			             'mobile'=>$this->input->post('mobile'),
			             'truck_plate_no'=>$this->input->post('truck_plate'),
						 'updated_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->update(TBL_DRIVER,$id,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'Driver has been updated successfully');
			    redirect('admin/Driver');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Driver');
			}			
			
		}
	    $data["page"]="Edit Driver";
		$data["records"] = $this->Home_model->get_single_row(TBL_DRIVER,array('id'=>$id));
	    $this->load->view('admin/driver_add',$data);
 }
 
  public function delete($id){
  
    $this->Home_model->delete(TBL_DRIVER,"id",$id);
	$this->session->set_flashdata('message', 'Driver has been deleted successfully');
	redirect('admin/Driver') ;
  
  }
  
   
}

