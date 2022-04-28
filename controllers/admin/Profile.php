<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	        function __construct()
			  {
				parent::__construct();
				
				 $this->load->model('admin/Home_model');
				 
			  }

public function index()
  {
      if($this->input->post('submit')=="save")
      {
          $update=$this->Home_model->update('admin_user',1,array('radius'=>$this->input->post('radius')));
          if($update)
          {
              	$this->session->set_flashdata('message', 'Request radius set');
			    redirect('admin/Profile');
          }else{
              	$this->session->set_flashdata('message', 'Something wrong');
			    redirect('admin/Profile');
          }
      }
      $data['profile']=$this->Home_model->get_single_row('admin_user',array('id'=>1));
	    $this->load->view('admin/profile',$data);
 }
}