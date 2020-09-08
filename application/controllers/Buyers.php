<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyers extends CI_Controller {

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
        $this->load->model("buyers_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
       
     }
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
		$this->load->view('UI/buyers',$data);
		$this->load->view('UI/footer');
	}
	
	
	public function get_inventory_list($orderby='pro_id',$direction='ASC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->buyers_model->get_inventory_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }
  
  
  public function get_order_list($buyer_email='',$orderby='pro_id',$direction='ASC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->buyers_model->get_order_list($buyer_email,$orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }
  
  public function test_email()
  {
	  if(empty($_POST['buyer_email']))
	  {
		  echo '{"status_code":"0","status_text":"Buyer Email Is Empty.Please Contact Support"}';
		  die();
	  }
	  if(empty($_POST['subject']))
	  {
		  echo '{"status_code":"0","status_text":"Subject Should Not Be Empty"}';
		  die();
	  }
	  if(empty($_POST['message']))
	  {
		  echo '{"status_code":"0","status_text":"Message Should Not Be Empty"}';
		  die();
	  }
       
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
     $this->email->from("campaign@feedbackoutlook.com");
     $this->email->to($_POST['buyer_email']);
     $this->email->subject($_POST['subject']);
     $this->email->message($_POST['message']);

  if ($this->email->send()) 
  {
    echo '{"status_code":"1","status_text":"Message to this email has been sent"}';
  }
  else
  {
    echo '{"status_code":"0","status_text":"Not able to send mail "}';
  }
  
  
}
 

	
	
}
