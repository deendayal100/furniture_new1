<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 
			  }


public function index()
  {
	 
	    $data["page"]="User";
		$data["view"] = $this->Home_model->get_tbl_data_inorder(TBL_ADMIN,array());
	    $this->load->view('admin/users',$data);
 }

 /*      Add User   */
 
public function add()
  {     
        if($this->input->post('submit')){
        $chk = $this->Home_model->get_single_row(TBL_ADMIN,array('email'=>$this->input->post('email')));  
        if(!empty($chk)){
        	$this->session->set_flashdata('errmessage', 'Mobile no already registered');
		    redirect('admin/User/add');
        }
	     
			$arr = array(
			             'type'=>$this->input->post('user_type'),
			             'username'=>$this->input->post('name'),
			             'email'=>$this->input->post('email'),
			             //'mobile'=>$this->input->post('mobile'),
			             'password'=>$this->input->post('password'),
			             'status'=>1,
						 'created_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->insert(TBL_ADMIN,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'User has been added successfully');
			    redirect('admin/User');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/User');
			}			
			
		}
	    $data["page"]="Add User";
	    $this->load->view('admin/user_add',$data);
 }
 
 public function edit($id)
  {     
        if($this->input->post('submit')){
			
			$arr = array(
			             'type'=>$this->input->post('user_type'),
			             'username'=>$this->input->post('name'),
			             'email'=>$this->input->post('email'),
			             //'mobile'=>$this->input->post('mobile'),
			             'password'=>$this->input->post('password'),
						 'updated_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->update(TBL_ADMIN,$id,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'User has been updated successfully');
			    redirect('admin/User');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/User');
			}			
			
		}
	    $data["page"]="Edit User";
		$data["records"] = $this->Home_model->get_single_row(TBL_ADMIN,array('id'=>$id));
	    $this->load->view('admin/user_add',$data);
 }
 
  public function delete($id){
  
    $this->Home_model->delete(TBL_ADMIN,"id",$id);
	$this->session->set_flashdata('message', 'User has been deleted successfully');
	redirect('admin/User') ;
  
  }

  // public function chat(){
  // 	$user['id']=2;
  // 	$parameters = $this->input->get('q');
  // 	echo $parameters;
  // 	$userData=$this->session->get_userdata('admin_user');
  	
  // 	$data["admin_firebase_id"]=$userData["admin_user"]["firebase_id"];
  // 	$this->load->view('admin/chat',$data);
  	

  // }
  
   
}

