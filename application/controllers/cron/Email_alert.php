<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_alert extends CI_Controller {
    private $rs=[];
  public function  __construct()
  {
     parent::__construct();
     $this->load->library('parser');
     $this->parser->set_delimiters('{','}');
     $this->rs['site_url']=base_url();
     $this->rs['logo']=base_url()."asset/img/logo_orginal_sqr.png";
     
    
    
  }
  


 public function send_low_balance_alert_daily()
  {

     $qry=$this->db->query("SELECT alert_name,alert_template,alert_subject FROM alert_mail_config WHERE alert_name='LOW_BALANCE'");
     $email=$qry->result_array();
     $query=$this->db->query("SELECT scr_u_id,scr_uname,scr_firstname,scr_lastname,a.plan_id, a.subscribed_on,a.valid_till, a.subscribed_by,plan_name,plan_amt,current_amt
     FROM plan_subscriber a
     INNER JOIN ( SELECT plan_id, MAX(valid_till) as valid_till,subscribed_by FROM plan_subscriber GROUP BY subscribed_by) b ON a.subscribed_by = b.subscribed_by AND a.valid_till = b.valid_till and a.valid_till >=now() and a.valid_till <= (now() + interval 9 day)
     INNER join plan_manager as mgr on mgr.plan_id=a.plan_id 
     INNER JOIN current_balance on user_id=a.subscribed_by
     INNER join scr_user on a.subscribed_by=scr_u_id ");
    $res=$query->result_array();
    foreach($res as $rs)
    {
      if($rs['current_amt'] < $rs['plan_amt'])
      {
        $msg="Hi".$rs['scr_firstname'].",
		<br> Your current balance ".$rs['current_amt']." in Feedback Outlook Wallet is too low to pay for subscribtion, please kindly recharge your wallet as your subscription going to end by 10 days ";
        if(!empty($msg))
        {
           $this->rs['msg']=$msg;
           $email_content=$this->parser->parse_string($email[0]['alert_template'],$this->rs,TRUE);
		   //print_r($email_content);
           $this->send_mail($email[0],$email_content,$rs['scr_uname']);
		   $timestamp=date('Y-m-d H:i:s');
		   $insert_alert=array('alert_type'=>$email[0]['alert_name'],'alert_head'=>$email[0]['alert_subject'],'alert_msg'=>$msg,'is_mailed'=>1,'is_read'=>0,'alert_on'=>$timestamp,'alert_for'=>$rs['scr_u_id']);
    	   $this->db->insert('alert_manager',$insert_alert);		
           sleep(5);  

        }
      }
      
      
    }
 }

 

 public function send_upgrade_notification()
 {
    $qry=$this->db->query("SELECT alert_name,alert_template,alert_subject,protocol,smtp_host,smtp_user,smtp_pass,smtp_port FROM alert_mail_config
    INNER JOIN email_config ON config_id=mail_config_id AND alert_name='UPGRADE_NOTI'");
    $email=$qry->result_array();
    $sql="select scr_uname,scr_firstname,scr_lastname,date_format(joined_on,'%Y-%m-%d') as joined,datediff(date(joined_on + interval 1 month),now()) as trial_left,(datediff(now(),date(joined_on)) % 3) as diff, date(joined_on + interval 1 month) as trial_end,subcribe, subscribed_by,subscribed_on,valid_till  from scr_user
INNER join (
select count(subscribed_by) as subcribe, subscribed_by,subscribed_on,valid_till from plan_subscriber
group by subscribed_by 
having subcribe =1) as pln on pln.subscribed_by=scr_u_id and date(subscribed_on)=date(joined_on)";
    $query=$this->db->query($sql);
    $res=$query->result_array();
    foreach($res as $rs)
    {
      if($rs['diff']==0)
      {
        $msg="Hi,".$rs['scr_firstname']."<br>";
        $msg.="we hope you are enjoying our service ,and kindly upgrade your account to get 24/7 support ";
        if($rs['trial_left'] >0)
        {
          $msg.="your account will be expired on ".$rs['trial_left']." days";
        }
        else
        {
          $msg.="Your account had been expired";
        }
        $this->rs['msg']=$msg;
        echo $email_content=$this->parser->parse_string($email[0]['alert_template'],$this->rs,TRUE);
        //$this->send_mail($email[0],$email_content,$rs['scr_uname']);
        sleep(10);
      }
      
    }
     
 }
  
  public function send_mail($config,$msg,$to)
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
	 $this->email->to($to);
     $this->email->subject($config['alert_subject']);
     $this->email->message($msg);
     if ($this->email->send())
     {
     			echo "Sent";
     }
     else
     {
     	$this->email->print_debugger();
     }
     return TRUE;
     
  }

  
  
}
