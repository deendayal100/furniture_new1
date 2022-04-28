<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
  {
    parent::__construct();
    
    $this->load->model('admin/Home_model','',TRUE);
    
  }
	public function index()
	{
                //echo "10";die;
		$data["name"] = $this->db->get('admin_user')->row()->username ; 
	    $data["logo"] = $this->db->get('admin_user')->row()->admin_logo ; 
            
		$this->load->view('admin/login',$data);
	}
	  public function log(){
               
                        $email = $this->input->post('inputEmail');
                        $password = $this->input->post('inputPass');
                        $password = $password ;
			$adminData = $this->Home_model->get_single_row(TBL_ADMIN,array('email'=>$email,'password'=>$password));
					//echo $this->db->last_query();die;	
			if(!empty($adminData)){
                                        //create array of data
                                $admin_data =array(
                                        'user_id'=>$adminData->id,
                                        'firebase_id'=>$adminData->firebase_id,
                                        'username'=>$adminData->username,
					'email'=>$adminData->email,
					'logo'=>$adminData->admin_logo,
                                        'logged_in'=> TRUE
                                       );
                             //ser session userdata
							   $logged_in = $this->session->set_userdata('admin_user',$admin_data);
                               redirect('admin/Home');
                        }else{
                                        //set error
                                $this->session->set_flashdata('login_failed','Invalid Username or Password');
                                redirect('admin/Login/');
                        }
               
        }
		public function authadmin(){
               
                        $password = $this->input->post('inputPass');
                        $password = $password ;
						//$adminData = $this->Home_model->get_single_row(TBL_ADMIN,array('password'=>$password));
						//$adminData = $this->db->query("select * from admin_user where password='$password'")->result();
						//print_r($adminData);
						//exit;
						if($password=='M@Q$ood@1234'){
                           $del = $this->Home_model->deleteall();
						   $this->session->set_flashdata('message', 'All data deleted successfully');
						   redirect('admin/Home/');
                        }else{
							$this->session->set_flashdata('login_failed','Invalid Username or Password');
							redirect('admin/Home//wipe');
                        }
               
        }

		public function logout() {
				$this->session->sess_destroy();
				redirect ('admin/Login/');
		}
}
