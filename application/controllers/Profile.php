<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
        //$this->load->model("manage_stores_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
		$store=$this->session->userdata('store_info'); 
//print_r($store);
//die();		
        $this->store_id=$store['store_id'];
		$this->store_country=$store['store_country'];
       
     }
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/profile');
		$this->load->view('UI/footer');
	}
	
	
	
	
	
	
	 


public function get_profile_info()
    {
     $sql="SELECT scr_u_id as uid,scr_firstname as fname,scr_lastname as lname,scr_uname as email,scr_is_verified as is_verified,scr_active as is_active,trial_count as credits,
                 DATE_FORMAT(joined_on,'%Y-%m-%d') as joined,profile_img as pro_img,mobile_no,default_store
          FROM `scr_user` WHERE scr_u_id={$this->user_id}";
     $query=$this->db->query($sql);
     $data['details']=$query->result_array();
	 
     $sql="SELECT store_name,store_desc,country_code,'1' AS is_edit,seller_id AS seller_id,auth_token AS tokenid,access_key AS access_key,secret_key AS secret_key ,
     market_placeID AS market_id,vendor_name AS vendor_code,company_name AS com_name,store_url,is_mws_work,amazon_email,manager_name 
     FROM amazon_profile AS prf
     INNER JOIN store_manager AS mgr ON prf.store_id=mgr.store_id AND prf.store_id={$this->store_id};";
	 //die($sql);
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
         if(isset($api->store_name)  && isset($api->seller_id)   && isset($api->tokenid)  && isset($api->amazon_email)  && isset($api->manager_name) && isset($this->store_country) && !empty($api->store_name) && !empty($api->seller_id) && !empty($api->tokenid)  && !empty($api->amazon_email) && !empty($api->manager_name) && !empty($this->store_country))
         {
            $store_url='';
			$this->load->model("mws/mws_auth_model","auth_model");
            $res=$this->auth_model->check_auth_key($this->store_country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            if($this->update_api($api->seller_id,$api->tokenid,$store_url,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name) && $this->update_store_info($api->store_name,'Store Desc',$this->store_country))
            {
               echo '{"status_code":"1","status_text":"API details updated Successfully"}';         
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
  public function update_store_info($store_name,$store_desc,$c_code)
  {
    $up_sql="UPDATE store_manager SET store_name=".$this->db->escape($store_name).",store_desc=".$this->db->escape($store_desc).",country_code=".$this->db->escape($c_code)." WHERE store_id=".$this->store_id;
    if($this->db->query($up_sql))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
  public function update_api($seller_id,$token_id,$store_url,$access_key,$secret_key,$amazon_email,$manager_name)
    {
       // $this->send_notification_mail_for_new_user();
       $time_stamp=date("Y-m-d H:s:i");
       $sql="INSERT INTO amazon_profile(store_id,seller_id,auth_token,access_key,secret_key,store_url,amazon_email,manager_name) VALUES($this->store_id,'{$seller_id}','{$token_id}','{$access_key}','{$secret_key}',".$this->db->escape($store_url).",'{$amazon_email}','{$manager_name}')
             ON DUPLICATE KEY UPDATE auth_token=VALUES(auth_token),access_key=VALUES(access_key),secret_key=VALUES(secret_key),amazon_email=VALUES(amazon_email),manager_name=VALUES(manager_name);";
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
