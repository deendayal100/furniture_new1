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
	
		$this->load->view('warehouse/login');
	}
	  public function log(){
               
                        $email = $this->input->post('inputEmail');
                        $password = $this->input->post('inputPass');
                        $password = $password ;
						$warehouseData = $this->Home_model->get_single_row(TBL_ADMIN,array('email'=>$email,'password'=>$password,'type'=>'RT'));
					
						if(!empty($warehouseData)){
                                        //create array of data
                                $warehouse_data =array(
                                        'user_id'=>$warehouseData->id,
                                        'username'=>$warehouseData->username,
										'email'=>$warehouseData->email,
										'logo'=>$warehouseData->warehouse_logo,
                                        'logged_in'=> TRUE
                                       );
                             //ser session userdata
							   $logged_in = $this->session->set_userdata('warehouse_user',$warehouse_data);
                               redirect('warehouse/Home');
                        }else{
                                        //set error
                                $this->session->set_flashdata('login_failed','Invalid Username or Password');
                                redirect('warehouse/Login/');
                        }
               
        }

		public function logout() {
				$this->session->sess_destroy();
				redirect ('warehouse/Login/');
		}
}
