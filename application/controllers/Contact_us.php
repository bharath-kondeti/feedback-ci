<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends CI_Controller {
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
     $this->load->model('campaign_model');
     }
  }
  public function index()
  {
      $this->load->view('UI/header');
	  $this->load->view('UI/sidepanel');
	  $this->load->view('UI/navigation');
      $this->load->view('UI/contact_us');
      $this->load->view('UI/footer');
  }


 
 
  public function save_template()
  {
    if(!empty($_POST['template_data']))
    {
       $post=json_decode($_POST['template_data']);
	   $subject=$post->subject;
	   $message=$post->template_ui;
	   $sql="SELECT scr_uname FROM scr_user where scr_u_id='".$this->user_id."'";
	   $query=$this->db->query($sql);
	   $res=$query->result_array();
	   $email=$res[0]['scr_uname'];
	   //$email='yugandhar@lemertech.com';
	   //print_r($res[0]['scr_uname']);
	        $msg="<p>Email: ".$email."</p>";
           $msg.="<p>Subject: ".$subject."</p>";
		   $msg.="<p>Message: ".$message."</p>";
   // $msg=$this->parser->parse_string($msg,$dt,TRUE);
       $this->load->library('email');
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
       $this->email->initialize($config);
       $this->email->from('campaign@feedbackoutlook.com');
       $this->email->to('yugandhar@lemertech.com');
      $this->email->subject($subject);
      $this->email->message($msg);
      if ($this->email->send()) 
      {
        $uql="INSERT INTO support_email(`sender_email`,`subject`,`content`,`added_by`) VALUES('".$email."','".$subject."','".$message."','".$this->user_id."')";
        $this->db->query($uql);
            echo '{"status_code":"1","status_text":"We received your message, will get back to you soon."}'; 
      }
      else 
      {
         echo '{"status_code":"0","status_text":"Not able to message!"}'; 
		// print_r($this->email->print_debugger());
      }
	   
	 }
	    else
        {
          echo '{"status_code":"0","status_text":"Server Error!"}';         
        }
     
  }

 
  
}