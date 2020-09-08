<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_Password extends CI_Controller {
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
      
     }
  }
  public function index()
  {
      $this->load->view('UI/header');
	  $this->load->view('UI/sidepanel');
	  $this->load->view('UI/navigation');
      $this->load->view('UI/change_password');
      $this->load->view('UI/footer');
  }
  public function update_password()
  {
      if(isset($_POST['pwd_detail']))
      {
         $pwd=json_decode($_POST['pwd_detail']);
         if(isset($pwd->cur_pwd)   && isset($pwd->new_pwd) && isset($pwd->reenter_pwd) && !empty($pwd->cur_pwd)   && !empty($pwd->new_pwd) && !empty($pwd->reenter_pwd) )
         {
            $qry=$this->db->query("SELECT * from scr_user where scr_u_id=".$this->user_id);
            $res=$qry->result_array();

             if($res[0]['scr_password'] != $pwd->cur_pwd)
             {
                 echo '{"status_code":"0","status_text":"Current password is not correct"}'; 
             }
             elseif($pwd->new_pwd!=$pwd->reenter_pwd)
             {
                 echo '{"status_code":"0","status_text":"Re Entered Password not matches "}'; 
             }
             else
             {    
                  $data = array('scr_password' => $pwd->new_pwd);
                 if($this->db->update('scr_user', $data, "scr_u_id = ".$this->user_id))
                  echo '{"status_code":"1","status_text":"Password updated Successfully"}'; 
                 else
                  echo '{"status_code":"0","status_text":"Not able to update password"}'; 

             }
			 
              
         }
		 else
		 {
		echo '{"status_code":"0","status_text":"Input Error"}';	 
		 }
      }
  }
 

  public function get_profile_info()
  {
     $sql="SELECT scr_u_id as uid,scr_firstname as fname,scr_lastname as lname,scr_uname as email,scr_is_verified as is_verified,scr_active as is_active,trial_count as credits,
                 DATE_FORMAT(joined_on,'%Y-%m-%d') as joined,profile_img as pro_img,mobile_no
          FROM `scr_user` WHERE scr_u_id={$this->user_id}";
     $query=$this->db->query($sql);
     $data['details']=$query->result_array();
    
    
     $data['status_code']='1';
     $data['status_text']='Success';
     echo json_encode($data);
      
    
  }  
  
    
}

