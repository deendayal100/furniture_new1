<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 
			  }


public function index()
  {
	 
	    $data["page"]="Category";
		$data["view"] = $this->Home_model->get_tbl_data(TBL_CATEGORY,array());
	    $this->load->view('admin/category',$data);
 }

 /*      Add Category   */
 
public function add()
  {     
        if($this->input->post('submit')){
	     if(!empty($_FILES['image']['name']))
				{
					$configs['upload_path'] = 'upload/maincategory/';
					$configs['allowed_types'] = 'jpg|jpeg|png|gif';
					$configs['file_name'] = $_FILES['image']['name'];
					
			 	    //Load upload library and initialize configuration
					$this->load->library('upload',$configs);
					$this->upload->initialize($configs);
				
					if($this->upload->do_upload('image'))
					{
						$uploadData = $this->upload->data();
						$image = "upload/maincategory/".$uploadData['file_name'];
					    
					}else{
						$image = '';
					}
				}
			$arr = array(
			             'name'=>$this->input->post('name'),
			             'image'=>$image,
			             'status'=>1,
						 'created_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->insert(TBL_CATEGORY,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'Category has been added successfully');
			    redirect('admin/Category/add');
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Category/add');
			}			
			
		}
	    $data["page"]="Add Category";
	    $this->load->view('admin/category_add',$data);
 }
 
 public function edit($id)
  {     
        if($this->input->post('submit')){
			 if(!empty($_FILES['image']['name']))
				{
					$configs['upload_path'] = 'upload/maincategory/';
					$configs['allowed_types'] = 'jpg|jpeg|png|gif';
					$configs['file_name'] = $_FILES['image']['name'];
					
			 	    //Load upload library and initialize configuration
					$this->load->library('upload',$configs);
					$this->upload->initialize($configs);
				
					if($this->upload->do_upload('image'))
					{
						$uploadData = $this->upload->data();
						$image = "upload/maincategory/".$uploadData['file_name'];
					    
					}else{
						$image = '';
					}
				}else{
				    $image = $this->input->post("old_img");
				}
			$arr = array(
			             'name'=>$this->input->post('name'),
			             'image'=>$image,
						 'updated_on'=>date('Y-m-d h:i:s')
						);
			$insert = $this->Home_model->update(TBL_CATEGORY,$id,$arr);	
            if($insert){
				$this->session->set_flashdata('message', 'Category has been updated successfully');
			    redirect('admin/Category/edit/'.$id);
			}else{
				$this->session->set_flashdata('errmessage', 'Some problem occured please try after some time');
			    redirect('admin/Category/edit/'.$id);
			}			
			
		}
	    $data["page"]="Edit Category";
		$data["records"] = $this->Home_model->get_single_row(TBL_CATEGORY,array('id'=>$id));
	    $this->load->view('admin/category_edit',$data);
 }
 
  public function delete($id){
  
    $this->Home_model->delete(TBL_CATEGORY,"id",$id);
	$this->session->set_flashdata('message', 'Category has been deleted successfully');
	redirect('admin/Category') ;
  
  }
  
   
}

