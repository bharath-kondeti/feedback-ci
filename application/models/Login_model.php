<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
	{
	      public function  __construct()
		  {
		   		parent::__construct();
		       	
	   	  }

	 public function userLoginProcess($username,$password)
         {
     	 	$sql="SELECT scr_u_id,scr_firstname,scr_lastname,scr_uname,scr_password,scr_is_admin,scr_is_verified
									 FROM scr_user  AS usr
									 WHERE scr_active='1' AND scr_uname=".$this->db->escape($username)." AND scr_password=".$this->db->escape($password);
									 
			$query=$this->db->query($sql);
		     
	          if($query -> num_rows() == 1)
	          {
	            $result = $query->result();
        	    if($result)
	            {
		             $sess_array = array();
		             foreach($result as $row)
		             {
		             	 $sess_array = array('uname' => $row->scr_uname,
		                 	                 'fname' => $row->scr_firstname,
		                 	                 'lname' => $row->scr_lastname,
		                 	                 'id' => $row->scr_u_id,
		                 	                 'isadmin'=>$row->scr_is_admin,
		                 	                 'isverified'=>$row->scr_is_verified,
		                 	                 );

			         }	
					 
					 
					  
			          $sql="SELECT scr_u_id,scr_firstname,scr_lastname,scr_uname,scr_password,scr_is_admin,scr_is_verified,default_store,store_name,mgr.store_id,store_location,spt.currency_code,mgr.country_code
									 FROM scr_user  AS usr
									 INNER JOIN store_access AS acs ON scr_u_id=".$row->scr_u_id." AND acs.store_id=default_store AND user_id=scr_u_id 
									 INNER JOIN store_manager AS mgr ON acs.store_id=mgr.store_id";

					   $sql.=" INNER JOIN supported_country AS spt ON spt.country_code=mgr.country_code "; 
					  			   
					  $qry=$this->db->query($sql);
					  $str_res=$qry->result_array();
					  
					  
					  $store_info=array('store_id'=>0,'store_name'=>'','store_location'=>'','currency_code'=>'','store_country'=>'');
					  if(!empty($str_res))
					  {
					  	 $store_info=array('store_id'=>$str_res[0]['store_id'],'store_name'=>$str_res[0]['store_name'],'store_location'=>$str_res[0]['store_location'],'currency_code'=>$str_res[0]['currency_code'],'store_country'=>$str_res[0]['country_code']);
						
												   
						   
					  }				 
			
		             	
		             $this->session->set_userdata('user_logged_in', $sess_array);
		             $this->session->set_userdata('store_info', $store_info);

				     return TRUE;
	            }
	          }
	         else
	         {
	           return false;
	         }
	     }
		
	
	  
		
	public function userLogoutProcess()
	{
		   $this->session->unset_userdata('user_logged_in');
		   $this->session->unset_userdata('staff_logged_in');
		   $this->session->unset_userdata('inv_not_added');
			 $this->session->unset_userdata('ord_not_added');
			  $this->session->unset_userdata('prod_not_added');
			   $this->session->unset_userdata('buyer_not_added');
			    $this->session->unset_userdata('finance_not_added');
		   //$this->session->sess_destroy();
	}
	public function userLoginCheck()
	{
	     if($this->session->userdata('user_logged_in'))
	     {
		     $user=$this->session->userdata('user_logged_in');
		     if($user['isverified']==1)
		     {
			    return true;
		     }
		     else
		     {
		 	    return false;
		     }
	     }
	     else
	     {
	     	return false;
	     }	 
		
	}
	
	public function is_profile_updated()
	{
		 $user=$this->session->userdata('user_logged_in');
		 if(empty($user))
		 {
		     return false;
		 }
		 $qry=$this->db->query("SELECT * FROM store_access AS acl
								INNER JOIN amazon_profile AS prf ON prf.store_id=acl.store_id AND acl.user_id=".$user['id']);
		 $res=$qry->result_array();
		 if(count($res) > 0)
	     {
		        return true;
		 }
	     else
	     {
	     	return false;
	     }	 
		
	}
	public function is_store_updated()
	{
		 $user=$this->session->userdata('user_logged_in');
		 if(empty($user))
		 {
		     return false;
		 }
		 $qry=$this->db->query("SELECT * FROM store_access AS acl INNER JOIN store_manager as sm ON acl.store_id=sm.store_id
								INNER JOIN amazon_profile AS prf ON prf.store_id=acl.store_id AND acl.user_id=".$user['id']." AND  store_name  <> ''" );
		 $res=$qry->result_array();
		 if(count($res) > 0)
	     {
		        return true;
		 }
	     else
	     {
	     	return false;
	     }	 
		
	}
	
	
		
	public function is_plan_subscribed()
	{
		 $user=$this->session->userdata('user_logged_in');
		 if(empty($user))
		 {
		     return false;
		 }
		 
		 $qry=$this->db->query("SELECT * FROM current_plan_info WHERE subscribed_by=".$user['id']." AND valid_till > now()");
		 $res=$qry->result_array();
		 if(count($res) > 0)
	     {
		        return true;
		 }
	     else
	     {
	     	return false;
	     }	 
		
	}
	
	public function adminLoginCheck()
	{
		if($this->session->userdata('user_logged_in'))
	     {
		     $user=$this->session->userdata('user_logged_in');
		     // if($user['id']==24)
		     if($user['isadmin']==1 && $user['isverified']==1)
		     {
			    return true;
		     }
		     else
		     {
		 	    return false;
		     }
	     }
	     else
	     {
	     	return false;
	     }
	}

	public function customerLoginCheck()
	{
		if($this->session->userdata('user_logged_in'))
	     {
		     $user=$this->session->userdata('user_logged_in');
		     if($user['isadmin']==2 && $user['isverified']==1)
		     {
			    return true;
		     }
		     else
		     {
		 	    return false;
		     }
	     }
	     else
	     {
	     	return false;
	     }
	}
	public function is_verified_user()
	{
		if($this->session->userdata('user_logged_in'))
	     {
		     $user=$this->session->userdata('user_logged_in');
		     if($user['isverified']==1)
		     {
			    return true;
		     }
		     else
		     {
		 	    return false;
		     }
	     }
	     else
	     {
	     	return false;
	     }
	}


	   public function user_exit($mail)

	   {

	      $query=$this->db->query("SELECT scr_u_id,scr_firstname,scr_uname,scr_lastname FROM Scr_user  where scr_uname=".$this->db->escape($mail).

		                          " AND scr_active=0");

		  if($query->num_rows()==0)

		  {

    		  return FALSE;

		  }

		  else

		  {

		     return $query->result_array();

		  }

	   }   

  }
?>
