<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_stores extends CI_Controller {

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
       
     }
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/manage_stores_new');
		$this->load->view('UI/footer');
	}
	
	
	public function delete_store() 
	{
	 
	$sql="SELECT * FROM scr_user as a INNER JOIN store_access as b ON a.scr_u_id=b.user_id INNER JOIN amazon_profile AS c on c.store_id=b.store_id  INNER JOIN store_manager AS d ON c.store_id=b.store_id WHERE d.store_location='".$_POST['country_code']."' AND a.scr_u_id='".$this->user_id."'  GROUP BY scr_u_id";
    $qry=$this->db->query($sql);
    $res=$qry->result_array();
	if(count($res) > '0') 
	{
		$sql="DELETE FROM store_manager where store_id='".$res[0]['store_id']."'";
		$this->db->query($sql);
		$sql="DELETE FROM store_access where store_id='".$res[0]['store_id']."'";
		$this->db->query($sql);
		$sql="DELETE FROM amazon_profile where store_id='".$res[0]['store_id']."'";
		$this->db->query($sql);
	    echo '{"status_code":"1","status_text":"Store Data Deleted Successfully"}'; 
	}	
    else 
	{
	  echo '{"status_code":"0","status_text":"Store Not added to delete"}'; 	
	}		
		
	}
	
	
	public function edit_store() 
	{
	 
     $sql="SELECT str_acc.store_id,store_name,store_desc,country_code,'1' AS is_edit,seller_id AS seller_id,auth_token AS tokenid,access_key AS access_key,secret_key AS secret_key ,
     market_placeID AS market_id,vendor_name AS vendor_code,company_name AS com_name,store_url,is_mws_work,amazon_email,manager_name 
     FROM amazon_profile AS prf
     INNER JOIN store_manager AS mgr ON prf.store_id=mgr.store_id 
	 INNER JOIN store_access AS str_acc ON mgr.store_id=str_acc.store_id AND str_acc.user_id='".$this->user_id."'   AND mgr.country_code='".$_POST['country_code']."'";
     $query=$this->db->query($sql);
	 $res=$query->result_array();
	 if(count($res) > 0 ) 
	 { 
     $data['status_code']='1';
     $data['store_detail']=$query->result_array();
	 echo json_encode($data);	
	 }
	 else
	 {
	 $data['status_code']='0';
     $data['status_text']='Store Not added to edit';
	 
     echo json_encode($data);	
	}
		
		
	}		
	
	
	
	
	 public function add_new_store()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='IN';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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



 public function add_new_store_us()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
          //die();
         if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='US';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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



public function add_new_store_uk()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
          //die();
         if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='UK';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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


public function add_new_store_it()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
          //die();
         if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='IT';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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


public function add_new_store_de()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
          //die();
         if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='DE';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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



public function add_new_store_fr()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
          //die();
         if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='FR';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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
  
  
  
  public function add_new_store_es()
  {
	
      if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
          //die();
         if(isset($api->seller_id)   && isset($api->tokenid) && isset($api->store_name)   && isset($api->amazon_email)  && isset($api->manager_name) && !empty($api->seller_id) && !empty($api->tokenid) && !empty($api->store_name) && !empty($api->amazon_email) && !empty($api->manager_name) )
         {
            $store_url='';
			$store_name='';
			$store_desc='Store Desc';
		    $country='ES';
            $this->load->model("mws/mws_auth_model","auth_model");
            if($this->common_model->check_store_not_unique($this->user_id,$country,$api->seller_id))
            {
              echo '{"status_code":"0","status_text":"Seller info already exist"}'; 
              die();
            }
            $res=$this->auth_model->check_auth_key($country,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            
            if($this->new_store($api->seller_id,$api->tokenid,$store_url,$api->store_name,$store_desc,$country,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name))
            {
               echo '{"status_code":"1","status_text":"API details updated "}'; 
                  			   
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
	
	
	
	public function new_store($seller_id,$token_id,$store_url,$store_name,$store_desc,$c_code,$access_key,$secret_key,$amazon_email,$manager_name)
  {
    $this->db->trans_start();
    $store=array('store_name'=>$store_name,'store_desc'=>$store_desc,'country_code'=>$c_code,'created_by'=>$this->user_id);
    
    $this->db->insert('store_manager',$store);
    $store_id=$this->db->insert_id();
    
    $api=array('profile_name'=>$seller_id,'seller_id'=>$seller_id,'auth_token'=>$token_id,'access_key'=>$access_key,'secret_key'=>$secret_key,'store_url'=>$store_url,'store_id'=>$store_id,'amazon_email'=>$amazon_email,'manager_name'=>$manager_name);
    $this->db->insert('amazon_profile',$api);

    $acl=array('store_id'=>$store_id,'user_id'=>$this->user_id);
    $this->db->insert('store_access',$acl);
    if(empty($this->store_id))
    {
      $this->db->query("UPDATE scr_user SET default_store=".$store_id." WHERE scr_u_id=".$this->user_id);      
    }
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE)
    {
        return FALSE;
    }
    else
    {
        // $this->send_feed_ti_change_min_max_price($rule_id);
       
		$sql="SELECT * FROM store_access AS acs
  INNER JOIN  store_manager AS mgr ON mgr.store_id=acs.store_id AND acs.store_id=".$this->db->escape($store_id)." AND user_id=".$this->user_id;
  $sql.=" INNER JOIN supported_country AS spt ON spt.country_code=mgr.country_code ";                    
  $qry=$this->db->query($sql);
  

  $res=$qry->result_array();
 // print_r($res);
  
  if(count($res) > 0 )
  {
    $store_info=array('store_id'=>$res[0]['store_id'],'store_name'=>$res[0]['store_name'],'store_location'=>$res[0]['store_location'],'currency_code'=>$res[0]['currency_code'],'store_country'=>$res[0]['country_code']);
    // print_r($this->session->all_userdata());
    $this->session->unset_userdata('store_info');
    // print_r($this->session->all_userdata());

    $this->session->set_userdata('store_info', $store_info);
	 return TRUE;
    
  }
		
		
    }
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


public function get_store_info()
    {
	
     $sql="SELECT store_name,store_desc,country_code,'1' AS is_edit,seller_id AS seller_id,auth_token AS tokenid,access_key AS access_key,secret_key AS secret_key ,
     market_placeID AS market_id,vendor_name AS vendor_code,company_name AS com_name,store_url,is_mws_work,amazon_email,manager_name 
     FROM amazon_profile AS prf
     INNER JOIN store_manager AS mgr ON prf.store_id=mgr.store_id 
	 INNER JOIN store_access AS str_acc ON mgr.store_id=str_acc.store_id AND str_acc.user_id='".$this->user_id."'   AND mgr.country_code='".$_POST['country']."'";
	 //die($sql);
     $query=$this->db->query($sql);
	 $res=$query->result_array();
	 if(count($res) > 0 ) 
	 { 
     $data['api_details']=$query->result_array();
	 }
	 else
	 {
	 $sql="SELECT count(*) as ttl,'0' AS is_edit FROM amazon_profile AS prf
     INNER JOIN store_manager AS mgr ON prf.store_id=mgr.store_id 
	 INNER JOIN store_access AS str_acc ON mgr.store_id=str_acc.store_id AND str_acc.user_id='".$this->user_id."'   AND mgr.country_code='".$_POST['country']."'";
	 //die($sql);
     $query=$this->db->query($sql);	 
	 $data['api_details']=$query->result_array();
	 }
	 $data['status_code']='1';
     //$data['status_text']='Success';
     echo json_encode($data);	
		
		
	}	




public function update_amazon_api()
  {
	 
	  if(isset($_POST['api_detail']))
      {
         $api=json_decode($_POST['api_detail']);
		  //print_r($api);
		  //die();
         if(isset($api->store_name)  && isset($api->seller_id)   && isset($api->tokenid)  && isset($api->amazon_email)  && isset($api->manager_name) && isset($api->country_code) && !empty($api->store_name) && !empty($api->seller_id) && !empty($api->tokenid)  && !empty($api->amazon_email) && !empty($api->manager_name) && !empty($api->country_code))
         {
            $store_url='';
			$this->load->model("mws/mws_auth_model","auth_model");
            $res=$this->auth_model->check_auth_key($api->country_code,$api->seller_id,$api->tokenid);
            if($res['status_code']=='0')
            {
              echo '{"status_code":"0","status_text":"'.$res['status_text'].'"}'; 
              die();          
            }
            if($this->update_api($api->seller_id,$api->tokenid,$store_url,$res['access_key'],$res['secret_key'],$api->amazon_email,$api->manager_name,$api->store_id) && $this->update_store_info($api->store_name,'Store Desc',$api->country_code,$api->store_id))
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
  public function update_store_info($store_name,$store_desc,$c_code,$store_id)
  {
    $up_sql="UPDATE store_manager SET store_name=".$this->db->escape($store_name).",store_desc=".$this->db->escape($store_desc).",country_code=".$this->db->escape($c_code)." WHERE store_id=".$store_id;
    if($this->db->query($up_sql))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
  public function update_api($seller_id,$token_id,$store_url,$access_key,$secret_key,$amazon_email,$manager_name,$store_id)
    {
       $time_stamp=date("Y-m-d H:s:i");
       $sql="INSERT INTO amazon_profile(store_id,seller_id,auth_token,access_key,secret_key,store_url,amazon_email,manager_name) VALUES($store_id,'{$seller_id}','{$token_id}','{$access_key}','{$secret_key}',".$this->db->escape($store_url).",'{$amazon_email}','{$manager_name}')
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
