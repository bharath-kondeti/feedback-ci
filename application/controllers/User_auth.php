<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_auth extends CI_Controller {

    public function  __construct()
	{
	   parent::__construct();
       $this->load->library('form_validation');
	}
	public function index()
	{
        if(!$this->login_model->userLoginCheck())
	    {
			  $this->load->view('user_login');
	    }
	    else
	    {
	        $user=$this->session->userdata('user_logged_in');
			if($user['isadmin']==1 || $user['isadmin']==2 && $user['isverified']==1)
			{
   		      redirect('inventory');
			}
			else
			{
			 redirect('inventory');
			}

	    }
    }

	public function test_success()
	{
	 $this->load->view('signup_success');
	}

	public function login()
    {
         $this->form_validation->set_rules('username', 'Username ', 'required');
	     $this->form_validation->set_rules('password', 'Password ', 'required|callback_user_verify');
	     if($this->form_validation->run() == FALSE)
	     {
	          $this->load->view('user_login');
	     }
	     else
	     {
	        $user=$this->session->userdata('user_logged_in');
			//print_r($user);
			//die();
			if($user['isadmin']==1 || $user['isadmin']==2 && $user['isverified']==1)
			{
   		      redirect('inventory');
			}
			else
			{
			 redirect('inventory');
			}


	     }

    }

    public function forgot_password()
	{
        	  $this->load->view('forgot_pwd');
    }
  public function reset_password($uid,$key)
   {
   		if(!empty($uid) && !empty($key) && is_numeric($uid))
		{
		   $data=array();
		   $query=$this->db->query("SELECT scr_firstname,scr_uname,change_pwdkey FROM scr_user where scr_u_id=".$this->db->escape($uid));
		   if($query->num_rows() == 1)
	        {

	          $row = $query->row();
	          if(strcmp($row->change_pwdkey,$key)== 0)
		      {
		      	$sess['reset_id']=$uid;
		      	$sess['reset_key']=$key;
		      	$this->session->set_userdata('reset_pwd', $sess);
			    echo $this->load->view('reset_password',$data,TRUE);
			    die();
		 	  }
		  	}
			else
			{
	          $data['msg']="No Record Found Or Link May Be Borken or Changed";
			}
		   $this->load->view("action_success",$data);
	   }
	   else
		{
		 redirect('user_auth');
		}
 }
 public function reset_to_new_password()
 {
    if($this->session->userdata('reset_pwd'))
    {
    	$this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('re_pwd', 'Password', 'required|matches[pwd]');
		if($this->form_validation->run() == TRUE)
	    {
	    	$sess_user=$this->session->userdata('reset_pwd');
	    	$this->db->query("UPDATE scr_user SET scr_password=".$this->db->escape($_POST['pwd'])." WHERE scr_u_id=".$sess_user['reset_id']);
	    	$this->session->unset_userdata('reset_pwd');
	    	$data['msg']="Password has been changed please login using your new password";
	    	$this->load->view("action_success",$data);

	    }
	    else
	    {
	    	$this->load->view('reset_password');
	    }
    }
    else
    {
		$data['msg']="Session Expired please try again";
		$this->load->view("action_success",$data);
    }

 }
    public function send_reset_link()
    {
    	$this->form_validation->set_rules('email', 'email', 'required|valid_email');
	    if($this->form_validation->run() == TRUE)
	     {
			 //$sql="SELECT scr_firstname,scr_lastname,scr_u_id FROM scr_user WHERE scr_uname=".$this->db->escape($_POST['email']);
			 //die($sql);
	    	$qry=$this->db->query("SELECT scr_firstname,scr_lastname,scr_u_id FROM scr_user WHERE scr_uname=".$this->db->escape($_POST['email']));
    		$res=$qry->result_array();

    		if(!empty($res))
    		{
    		   $key=md5(uniqid(rand(), true));
    		   $data['name']=$res[0]['scr_firstname'];
		  	   $data['activate_link']=base_url()."user_auth/reset_password/".$res[0]['scr_u_id']."/".$key;
			   $msg=$this->load->view('mail/change_pwd',$data,TRUE);
			   if($this->sent_activation_link($msg,$this->input->post("email"),'Feedback Outlook - Reset Password'))
			   {
			   	// echo "Worksssssssss";
			   	$this->db->query("UPDATE scr_user SET change_pwdkey=".$this->db->escape($key)." WHERE scr_uname=".$this->db->escape($_POST['email']));
			     $data['msg']="We have sent a password link to your mail.Please reset your password.";
		        $this->load->view("mailsent_success",$data);
			   }
			   else
			   {
			   	// echo "Not worksssss";
			    $this->load->view('forgot_pwd');
			   }
    		}
    		else
    		{
    			$data['msg']="No user account is mapped to the email you had entered";
		        $this->load->view("mailsent_success",$data);
    		}
    	}
    	else
    	{
    		$this->load->view('forgot_pwd');
    	}

    }



  function user_verify($password)
	{
	  $usr = $this->input->post('username');
	  $result=$this->login_model->userLoginProcess($usr,$password);
	  if($result)
	  {
	     if($this->login_model->is_verified_user())
		 {
			 return true;
	     }
         else
		 {

            $this->session->set_userdata('resent_email', $this->input->post('username'));
		 	$err_msg="Please verify your mail from the email we have sent or <a style='color:blue' href='".base_url()."user_auth/resend_mail/'>To Resend the Activation mail please click </a>" ;

			$this->form_validation->set_message('user_verify', $err_msg);
	        return false;
		 }
	  }
	  else
	  {
	    $this->form_validation->set_message('user_verify', 'Invalid username or password');
	    return false;
	  }
	}

    public function logout()
  	{
	  $this->login_model->userLogoutProcess();
	  redirect("user_auth","refresh");
	}

    public function signup($plan_name='Micro')
	{
		$email=$this->input->post('email');

		$data['email']=$email;
		$plan_name=strtolower($plan_name);
		$plan_array=array('micro','small','medium','large','extra_large');
		if(in_array($plan_name,$plan_array))
		{
			$data['plan_name']=$plan_name;
			$data['plan_list']=$plan_array;
			$this->load->view('user_signup',$data);
		}
		else
		{
			redirect('home');
		}
	}


	public function add_user()
	{
		 $this->form_validation->set_rules('fname', 'First Name ', 'required');
	     $this->form_validation->set_rules('lname', 'Last Name ', 'required');
	     $this->form_validation->set_message('is_unique', 'The Email already exist');
	     $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[scr_user.scr_uname]');
	     $this->form_validation->set_message('matches', 'Password mismatch');

		 $this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]|matches[rpwd]');
	     $this->form_validation->set_rules('rpwd', 'confirm password', 'required');
         if($this->form_validation->run() == FALSE)
	     {

			$this->load->view('user_signup');
	     }
	     else
	     {
	     $mail_verify_key=md5(uniqid(rand(), true));
  	     $ref_key=md5(uniqid(rand(), true));
         $pl_sql="SELECT * from plan_manager where plan_id=2";
	     $pl_qry=$this->db->query($pl_sql);
	     $pln=$pl_qry->result_array();
	     $pln_id=1;
	     if(!empty($pln))
	     {
	      $pln_id=$pln[0]['plan_id'];
	     }

	       $insert_user = array('scr_firstname' =>$this->input->post('fname'),
                                'scr_lastname' =>$this->input->post('lname'),
                                'scr_is_verified' => 0,
                                'scr_is_admin' => 2,
								'scr_active' => 1,
                                'scr_uname' =>$this->input->post('email'),
								'scr_password' =>$this->input->post('pwd'),
								'mail_verify_key'=>$mail_verify_key,
								'referal_key'=>strtoupper($ref_key),
								'first_plan_id'=>$pln_id

                               );
	       $this->db->trans_start();

           $this->db->insert('scr_user', $insert_user);
           $uid=$this->db->insert_id();

	      $this->db->trans_complete();
	       $data['name']=$this->input->post("fname");
	  	   $data['activate_link']=base_url()."user_auth/mail_verify/".$uid."/".$mail_verify_key;
		   $msg=$this->load->view('mail/activation_mail',$data,TRUE);
		   if($this->sent_activation_link($msg,$this->input->post("email")))
		   {
		    $data['msg']="A verification link has been sent to your mail. Please verify by clicking the link.";
	       	// $data['msg']="Account created please sign in ";
		    $this->load->view("action_success",$data);
		   }
		   else
		   {
		   	$data['msg']="Not able to sent verification mail please contact our technical support";
		    $this->load->view('action_success',$data);
		   }
		 }

	}


	public function resend_mail($email='')
	{
       if($this->session->userdata('resent_email'))
	     {
		       $email=$this->session->userdata('resent_email');
		       $mail_verify_key=md5(uniqid(rand(), true));
		       $this->db->query("UPDATE scr_user SET mail_verify_key='".$mail_verify_key."' WHERE scr_uname='{$email}'");
		       $query=$this->db->query("SELECT scr_u_id,scr_uname,scr_firstname,scr_lastname from scr_user WHERE scr_uname='".$email."'");
		       $res=$query->result_array();
			  // die($res);
               $data['name']=$res[0]['scr_firstname'];
		  	   $data['activate_link']=base_url()."user_auth/mail_verify/".$res[0]['scr_u_id']."/".$mail_verify_key;
		  	   $msg=$this->load->view('mail/activation_mail',$data,TRUE);
			   if($this->sent_activation_link($msg,$email))
			   {
			    $data['msg']="We have sent a Verification link to your mail. Please verify by clicking the link.";
			    $this->load->view("action_success",$data);
			   }
			   else
			   {
		         $data['msg']="Something went wrong please try again";
		         $this->load->view("action_success",$data);
			   }

         }
         else
         {
         	  $sdata['msg']="Something went wrong please try again";
         	  $this->load->view("action_success",$sdata);
         }

	}

 public function mail_verify($uid,$mail_hass)
 {
		if(!empty($uid) && !empty($mail_hass) && is_numeric($uid))
		{
		   $data=array();
		   $query=$this->db->query("SELECT scr_firstname,scr_uname,mail_verify_key,first_plan_id FROM scr_user where scr_u_id=".$this->db->escape($uid));
		   if($query->num_rows() == 1)
	        {
	          $row = $query->row();
	          if (strcmp($row->mail_verify_key,$mail_hass)== 0)
		      {
			   $update=array('mail_verify_key' =>"verified",'scr_is_verified'=>1);

			   $this->db->where('scr_u_id',$uid);
			   $this->db->update('scr_user',$update);
			    if($this->create_free_plan($uid,$row->first_plan_id))
				{
		 	   	$data['msg']="Your mail has been verified successfully.";
				}
		 	   else
			   {
		 	   	$data['msg']="Your mail has been verified successfully. but not able to free subscription please contact support team.";

	  		  }



	  		  }
		  	  elseif(strcmp($row->mail_verify_key,'verified')==0)
			  {
			   $data['msg']="Your mail has already been verified and you can start using our feature.";
			  }
			  else
			  {
			   $data['msg']="Your verification mail expired create a new account";
			  }
			}
			else
			{
	          $data['msg']="No Record Found Or Link May Be Borken or Changed";
			}
		   $this->load->view("action_success",$data);
	   }
	   else
		{
		 redirect('user_auth');
		}
 }
 private function sent_activation_link($msg,$recev,$subject="Feedback Outlook- user account activation mail")
 {    //print_r($recev);
	  //die();
     $config['protocol'] = 'smtp';
     $config['smtp_host'] = "tls://email-smtp.us-east-1.amazonaws.com";
     $config['smtp_port'] = '465';
     $config['smtp_user'] = 'AKIAX2BCXESCD6UL6W4C';
     $config['smtp_pass'] = 'BNJVELo+k/v/Nn8r3QWUiMFqOZfFu/ZpSU4ABlVxo2OF';
     $config['wordwrap']=TRUE;
     $config['charset'] = "utf-8";
     $config['mailtype'] = "html";
     $config['newline'] = "\r\n";
	 $config['crlf'] = "\r\n";
	 $this->email->clear(TRUE);
     $this->email->initialize($config);
	 $this->email->from('campaign@feedbackoutlook.com');
     $this->email->to($recev);
	 $this->email->subject($subject);
     $this->email->message($msg);
     if ($this->email->send())
	  {
       return true;
      }
     else
	  {
       return FALSE;
      }

 }


 private function create_free_plan($user_id,$plan_id)
 {
 	// die($user_id);
 	$this->load->model("subscription_model");
 	$plan_count=$this->subscription_model->get_total_subscription($user_id);
 	if($plan_count > 0)
 	{
 		return true;
 	}
 	$this->db->trans_start();
 	$timestamp=date('Y-m-d H:i:s');
 	$this->subscription_model->update_user_balance($user_id,0,$timestamp,1);
 	$this->subscription_model->create_trial_plan($user_id,$plan_id,$timestamp,$timestamp);
 	$this->db->trans_complete();
	if ($this->db->trans_status() === FALSE)
	{
	  return FALSE;
	}
	else
	{
	 return true;
	}
 }

 public function referal_self_signup($rid='',$ref_hash='')
	{
		if(!empty($rid) && !empty($ref_hash))
		{
		   $query=$this->db->query("SELECT scr_u_id as ref_key,referal_key as hash_key,'SELF' as sign_up_type FROM scr_user WHERE scr_u_id=".$this->db->escape($rid)." AND referal_key=".$this->db->escape($ref_hash));
		   $data['ref_data']=$query->result_array();
		   if(empty($data['ref_data']))
		   {
		   	  redirect('user_auth/signup');
		   }
		    $key=md5(uniqid(rand(), true));
			$_SESSION['session_key'] = $key;
			$this->session->mark_as_temp('session_key', 200);

		   $this->load->view('referer_signup',$data);
		}
		else
		{
			$data['msg']="A referal link broken. please reinitate";
		    $this->load->view("action_success",$data);
		}
	}

}

