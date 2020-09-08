<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alert_manager extends CI_Controller {
    public function  __construct()
    {
       parent::__construct();
       $this->load->model('login_model');
       if(!$this->login_model->userLoginCheck())
       {
        redirect('user_auth');
       }
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
       $this->user_email=$user['uname'];
       $this->user_name=$user['fname']." ".$user['lname'];
    }
    public function index()
    {
        $this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
	    $this->load->view('UI/navigation');
        $this->load->view('UI/alert_manager');
        $this->load->view('UI/footer');
    }
    public function get_recent_alert_data()
    {
        $qry=$this-> db->query("SELECT * from alert_manager where alert_for=".$this->user_id." ORDER BY alert_on DESC limit 0,30");
        $data['alert']=$qry->result_array();
        $qry1=$this->db->query("SELECT * FROM scr_user WHERE scr_u_id=".$this->user_id);
        $data['setting']=$qry1->result_array();
        $data['status_code']=1;
        $data['status_text']='Success';
        echo json_encode($data);
    }

    public function toggle_wallet_status()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
          $status=(int)$_POST['w_status']==1?'TRUE':'FALSE';

          if($this->db->query("update scr_user SET wallet=".$status." WHERE scr_u_id=".$this->user_id))
          {
             
            echo '{"status_code":"1","status_text":"Wallet notification status updated Successful"}';               
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update status"}';               
          }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';               
    }
  }
  public function toggle_low_balance_status()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
          $status=(int)$_POST['w_status']==1?'TRUE':'FALSE';

          if($this->db->query("update scr_user SET low_balance=".$status." WHERE scr_u_id=".$this->user_id))
          {
             
            echo '{"status_code":"1","status_text":"status updated Successful"}';               
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update status"}';               
          }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';               
    }
  }
  public function toggle_plan_status()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
          $status=(int)$_POST['w_status']==1?'TRUE':'FALSE';

          if($this->db->query("update scr_user SET plan_ev=".$status." WHERE scr_u_id=".$this->user_id))
          {
             
            echo '{"status_code":"1","status_text":"status updated Successful"}';               
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update status"}';               
          }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';               
    }
  }
  public function toggle_low_inventory_status()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
          $status=(int)$_POST['w_status']==1?'TRUE':'FALSE';

          if($this->db->query("update scr_user SET low_inventory=".$status." WHERE scr_u_id=".$this->user_id))
          {
             
            echo '{"status_code":"1","status_text":"status updated Successful"}';               
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update status"}';               
          }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';               
    }
  }
   public function toggle_summary_status()
  {
    if(isset($_POST['w_status']) )
    {
          $status=!empty($_POST['w_status'])?$_POST['w_status']:'weekly';

          if($this->db->query("update scr_user SET ac_summary=".$this->db->escape($status)." WHERE scr_u_id=".$this->user_id))
          {
             
            echo '{"status_code":"1","status_text":" status updated Successful"}';               
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update status"}';               
          }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';               
    }
  }
    public function toggle_negative_feedback_status()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
          $status=(int)$_POST['w_status']==1?'TRUE':'FALSE';

          if($this->db->query("update scr_user SET neg_fbk=".$status." WHERE scr_u_id=".$this->user_id))
          {
             
            echo '{"status_code":"1","status_text":"notification status updated Successful"}';               
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to update status"}';               
          }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';               
    }
  }

 }