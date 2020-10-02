<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_referal extends CI_Controller {
  public function  __construct()
  {
     parent::__construct();
     $this->load->model('login_model');
     if(!$this->login_model->userLoginCheck() && !$this->input->is_ajax_request())
     {
      redirect('user_auth');
     }
     elseif(!$this->login_model->userLoginCheck() && $this->input->is_ajax_request())
     {
         echo '{"status_code":"303","status_text":"User session expired"}';  
         die();       
     }
     
     else
     {
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
     }
     
  }
  public function index()
  {
      
      
      $query=$this->db->query("SELECT refered_fname,refered_mail,is_signup,is_credited,DATE_FORMAT(refered_on,'%Y-%m-%d') as ref_on,DATE_FORMAT(credited_on,'%Y-%m-%d') as credited_on FROM referal_hub where ref_by_user_id=".$this->user_id."  ORDER BY refered_on DESC");
      $data['referals']=$query->result_array();
      $query=$this->db->query("SELECT referal_key FROM scr_user WHERE scr_u_id=".$this->user_id);
      $ref=$query->result_array();
      $data['ref_key']=$ref[0]['referal_key'];
      $this->load->view('UI/header');
      $this->load->view('UI/sidepanel');
	    $this->load->view('UI/navigation');
      $this->load->view('UI/manage_referal',$data);
      $this->load->view('UI/footer');
  }
  public function send_referal_link()
  {
     if(!empty($_POST['ref_fname']) && !empty($_POST['ref_lname']) && !empty($_POST['ref_mail']) && !empty($_POST['ref_msg']) && filter_var($_POST['ref_mail'], FILTER_VALIDATE_EMAIL))
     {

          $query=$this->db->query("SELECT referal_key from scr_user where scr_u_id=".$this->user_id);
          $res=$query->result_array();
          if(empty($res[0]['referal_key']))
          {
            $referal_verify_key=md5(uniqid(rand(), true)); 
            $this->db->query("UPDATE scr_user SET referal_key='".$referal_verify_key."' WHERE scr_u_id=".$this->user_id);
          }
          else
          {
            $referal_verify_key=$res[0]['referal_key'];
          }
          $insert_user = array('ref_by_user_id' =>$this->user_id,
                                'refered_mail' =>$this->input->post('ref_mail'),
                                'refered_hash_id' => $referal_verify_key,
                                'refered_fname' =>$this->input->post("ref_fname"),
                                'refered_lname' =>$this->input->post("ref_lname"),
                                'refered_msg' =>$this->input->post('ref_msg'),
                               );
         $this->db->trans_start();
     
           $this->db->insert('referal_hub', $insert_user);
           $rid=$this->db->insert_id();

         $this->db->trans_complete();
         $data['name']=$this->input->post("ref_fname");
         $data['msg']=$this->input->post("ref_msg");
         $data['referal_link']=base_url()."user_auth/referal_signup/".$rid."/".$referal_verify_key;
       $msg=$this->load->view('mail/referal_mail',$data,TRUE);
       if($this->sent_ref_link($msg,$this->input->post("ref_mail")))
       {
        echo '{"status_code":"1","status_text":"referal_mail has been sent"}';  
       }
       else
       {
        echo '{"status_code":"0","status_text":"Not able to sent mail please try again"}';  
       }
     }
     else
     {
      echo '{"status_code":"0","status_text":"Input error please try again"}';  
     }
  }
  
   private function sent_ref_link($msg,$recev)
    {

             
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
             $this->email->to($recev);
             $this->email->subject("Referal link for Feedback Outlook");
             $this->email->message($msg);
             if($this->email->send())
             {
              return TRUE;
             }
             else
             {
              return False;
             }
        

    }
 
  
}