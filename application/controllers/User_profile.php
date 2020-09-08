<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_profile extends CI_Controller {

	private $user_id;
    public function  __construct()
  {
       parent::__construct();
	  $this->load->model('login_model');

     if(!$this->login_model->userLoginCheck())
     {
       redirect('user_auth');
     }
      else
     {
        
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
		$store=$this->session->userdata('store_info'); 
        $this->store_id=$store['store_id'];
		$this->store_country=$store['store_country'];
       
     }
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/user_profile');
		$this->load->view('UI/footer');
	}
	
      public function get_profile_info()
    {
     $sql="SELECT * FROM `scr_user` WHERE scr_u_id={$this->user_id}";
     $query=$this->db->query($sql);
     $data['api_details']=$query->result_array();
	 $data['status_code']='1';
     $data['status_text']='Success';
     echo json_encode($data);
      
    }
	
	
	
	public function update_amazon_api()
  {
	  if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
         if(isset($api->user_name)  && isset($api->scr_uname)   && isset($api->scr_add_email)  && isset($api->com_name)  && isset($api->com_addr) && isset($api->mobile_no) && !empty($api->user_name) && !empty($api->scr_uname) && !empty($api->scr_add_email)  && !empty($api->com_name) && !empty($api->com_addr)  && !empty($api->mobile_no) )
         {
             if($this->update_api($api->user_name,$api->scr_uname,$api->scr_add_email,$api->com_name,$api->com_addr,$api->home_vat,$api->eur_vat,$api->mobile_no))
            {
               echo '{"status_code":"1","status_text":"Profile details updated Successfully"}';         
            }
            else
            {
                echo '{"status_code":"0","status_text":"Server Error please try again"}';     
            }
         }
         else
         {
           echo '{"status_code":"0","status_text":"Input Error"}';     
         }
      }
      else
      {
        echo '{"status_code":"0","status_text":"Input Error"}';  
      }
  }

  public function update_api($user_name,$scr_uname,$scr_add_email,$com_name,$com_addr,$home_vat,$eur_vat,$mobile_no)
    {
       $time_stamp=date("Y-m-d H:s:i");
       $sql="INSERT INTO scr_user(scr_u_id,user_name,scr_uname,scr_add_email,com_name,com_addr,home_vat,eur_vat,mobile_no) VALUES($this->user_id,'{$user_name}','{$scr_uname}','{$scr_add_email}','{$com_name}','{$com_addr}','{$home_vat}','{$eur_vat}','{$mobile_no}')
             ON DUPLICATE KEY UPDATE user_name=VALUES(user_name),scr_uname=VALUES(scr_uname),scr_add_email=VALUES(scr_add_email),com_name=VALUES(com_name),com_addr=VALUES(com_addr),home_vat=VALUES(home_vat),eur_vat=VALUES(eur_vat),mobile_no=VALUES(mobile_no);";
       if($this->db->query($sql))      
       {
          return TRUE;
       }
       else
       {
          return false;
       }
    }



	
	
	
 }
