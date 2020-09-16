<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {
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
     $this->user_email=$user['uname'];
     $this->user_name=$user['fname']." ".$user['lname'];
     $this->load->model('razorpay_model','razorpay_api');
	 }
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/billing');
		$this->load->view('UI/footer');
	}


	 public function new_plan()
  {
	  if(isset($_POST['plan_id']) && $_POST['plan_id'] >= 0)
    {
          $qry=$this->db->query("SELECT * from plan_manager where plan_id=".$this->db->escape($_POST['plan_id']));
          $res=$qry->result_array();
          $qer=$this->db->query("SELECT * from current_balance where user_id=".$this->user_id);
          $res1=$qer->result_array();
          $sb_qr=$this->db->query("SELECT COUNT(*) AS sub_cnt FROM plan_subscriber WHERE subscribed_by=".$this->user_id." AND valid_till >= NOW()");
          $sb_res=$sb_qr->result_array();
          $chgn_count=!empty($sb_res)?$sb_res[0]['sub_cnt']:0;
          $camp_allowed=isset($res[0]['camp_allowed'])?$res[0]['camp_allowed']:'';
          $plan_amt=isset($res[0]['plan_amt'])?$res[0]['plan_amt']:0;

          $current_amt=isset($res1[0]['current_amt'])?$res1[0]['current_amt']:0;
          if(empty($res))
          {
             echo '{"status_code":"0","status_text":"Plan detail info not available"}';
             die();
          }
          elseif($plan_amt > $current_amt)
          {
            echo '{"status_code":"0","status_text":"Not enough money in your account"}';
             die();
          }
          elseif($chgn_count >= 2)
          {
            echo '{"status_code":"0","status_text":"Please contact Feedback Outlook support (support@feedbackoutlook.com) to change plan"}';
             die();
          }
          else
          {
              $sql="SELECT count(*) as ttl_cmp FROM campaign_manager WHERE created_by={$this->user_id} AND is_deleted=0";
              $qer=$this->db->query($sql);
              $qer_res=$qer->result_array();

              $created_cmp_cnt=isset($qer_res[0]['ttl_cmp'])?$qer_res[0]['ttl_cmp']:0;
              //if($plan[0]['camp_allowed'] ==-1 || $plan[0]['camp_allowed'] > $plan[0]['camp_created'] )
              if($camp_allowed!=-1 && $created_cmp_cnt > $camp_allowed )
              {
                  echo '{"status_code":"0","status_text":"Please remove some campaign as its exceeds the allowed limit for this plan "}';
                  die();
              }

          }

          $cur_bal=$current_amt-$plan_amt;
          $this->db->trans_start();
          $insert_payment=array('payment_gateway'=>'Manual','paid_on'=>date('Y-m-d H:i:s'),'amt'=>$plan_amt,'paid_by'=>$this->user_id,'cur_bal'=>$cur_bal);
          $this->db->insert('payment_details',$insert_payment);
          $pay_id=$this->db->insert_id();
          $this->db->query("UPDATE current_balance SET last_pay_id=".$pay_id.",current_amt=current_amt-".$this->db->escape($plan_amt).",updated_on=now() WHERE user_id=".$this->user_id);
          $plan_start_date=date('Y-m-d H:i:s');

          if($chgn_count > 0)
          {
            $plan_start_date=date('Y-m-d H:i:s', strtotime('+1 day'));
          }
          $vali_till_dt=date('Y-m-d H:i:s', strtotime('+1 month',strtotime(date($plan_start_date))));

          $insert_plan=array('plan_id'=>$res[0]['plan_id'],'payment_id'=>$pay_id,'subscribed_by'=>$this->user_id,'subscribed_on'=>date('Y-m-d H:i:s'),
                            'updated_on'=>$plan_start_date,'valid_till'=>$vali_till_dt);
          $this->db->insert('plan_subscriber',$insert_plan);
          $this->db->trans_complete();
         if ($this->db->trans_status() === FALSE)
         {
              echo '{"status_code":"0","status_text":"Not able to process now please try again"}';
         }
         else
         {
             $alert_type=$chgn_count>0?"Plan Changed":"New Plan";
             if($chgn_count>0)
             {
             $alert_subject="Current Plan has been Changed";
             $alert_msg="Hi, <br> Your current plan has been changed your plan change will be effect from tommorow and INR ".$plan_amt." has been deducted from your wallet and you current balance is ".$cur_bal;
             }
             else
             {
             $alert_subject="New plan has been subscribed";
             $alert_msg="Hi, <br> Your has been subscribed to a new plan and INR ".$plan_amt." has been deducted from your wallet and you current balance is ".$cur_bal;
             }



             //$sent_mail=1;
             //$timestamp=date('Y-m-d H:s:i');
             //$this->load->model('alert_model');
             //$this->alert_model->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$this->user_id,$timestamp);

             echo '{"status_code":"1","status_text":"Subscription Successful"}';
         }

    }
    else
    {
      echo '{"status_code":"0","status_text":"Something is missing please try again later"}';
    }
  }
  public function load_money()
  {
    if(isset($_POST['amount']) && !empty($_POST['amount']) && $_POST['amount'] > 0)
    {

       $qry=$this->db->query("SELECT b.company_name,b.comp_addr1 AS comp_addr,b.comp_gst,scr_firstname,scr_lastname,scr_uname,mobile_no FROM scr_user
INNER JOIN `usr_comp_info` AS b ON b.usr_id=scr_u_id
INNER JOIN amazon_profile ON scr_u_id=profile_id and scr_u_id=".$this->user_id);
       $res=$qry->result_array();
       if(!empty($res))
       {
          $msg="NAME: ".$res[0]['scr_firstname']." ".$res[0]['scr_firstname']."<br>";
          $msg.="COMPANY: ".$res[0]['company_name']."<br>";
          $msg.="COMPANY ADDRESS: ".$res[0]['comp_addr']."<br>";
          $msg.="GST NO: ".$res[0]['comp_gst']."<br>";
          $msg.="Email: ".$res[0]['scr_uname']."<br>";
          $msg.="Mobile: ".$res[0]['mobile_no']."<br>";
          $msg.="Requested Amount: ".$_POST['amount']."<br>";
          $subject="ADD Money Invoice Request";
          $this->load->library('email');
         $this->load->library('email');
         $config['protocol'] = "smtp";
         $config['smtp_host'] = "tls://email-smtp.us-east-1.amazonaws.com";
         $config['smtp_port'] = '465';
         $config['smtp_user'] = 'AKIAX2BCXESCD6UL6W4C';
         $config['smtp_pass'] = 'BNJVELo+k/v/Nn8r3QWUiMFqOZfFu/ZpSU4ABlVxo2OF';
         $config['wordwrap']=TRUE;
         $config['charset'] = "utf-8";
         $config['mailtype'] = "html";
         $config['newline'] = "\r\n";
         $config['crlf'] = "\r\n";
         $config['useragent']='FeedbackGrid Mailer';
	     $this->email->clear(TRUE);
         $this->email->initialize($config);
         $this->email->set_newline("\r\n");
         $this->email->from('campaign@feedbackoutlook.com');
          $this->email->to("support@feedbackoutlook.com");
          $this->email->subject($subject);
          $this->email->message($msg);
          if ($this->email->send())
          {
            echo '{"status_code":"1","status_text":" We got your request you will get a invoice with payment link to your registered email id, please complete payment to enjoy Proseller services."}';
          }
          else
          {
            echo '{"status_code":"0","status_text":"Not able to send Invoice request mail please try again later "}';
          }
       }
       else
       {
        echo '{"status_code":"0","status_text":"Please complete the profile details"}';
       }

    }
    else
    {
      echo '{"status_code":"0","status_text":"Something is missing please try again later"}';
    }
  }
  public function toggle_addon_status()
  {
    if(isset($_POST['addon_status']) && ((int)$_POST['addon_status']==1 ||(int)$_POST['addon_status']==0) )
    {
          $status=(int)$_POST['addon_status']==1?1:0;
          $up_sql="update scr_user SET auto_addon=".$status." WHERE scr_u_id=".$this->user_id;
          if($this->db->query($up_sql))
          {
             $msg=$status=1?'Enabled':'Disabled';
             $alert_type="ADD-ON";
             $alert_subject="Automatic ADD-ON Subscription ".$msg;
             $alert_msg="Hi, <br> Automatic Subscription for 1000 mails ADD-ON has been Successfully ".$msg." On your account";
             $sent_mail=0;
             $timestamp=date('Y-m-d H:s:i');
             $this->load->model('alert_model');
             $this->alert_model->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$this->user_id,$timestamp);
             echo '{"status_code":"1","status_text":"ADD-ON status updated Successful"}';
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

  public function buy_addon()
  {
    if(isset($_POST['amount']) && !empty($_POST['amount']) && $_POST['amount'] > 0)
    {
          $_POST['amount']=500;
          $qer=$this->db->query("SELECT * from current_balance where user_id=".$this->user_id);
          $res2=$qer->result_array();
          $current_amt=!empty($res2)?$res2[0]['current_amt']:0;
          if($current_amt <=0 || $current_amt < $_POST['amount'])
          {
             echo '{"status_code":"0","status_text":"Balance not enough for ADD-ON "}';
             die();
          }


          $this->db->trans_start();

          $qer=$this->db->query("SELECT * from addon_status where user_id=".$this->user_id);
          $res1=$qer->result_array();
          $addon_amt=!empty($res1)?$res1[0]['current_amt']:0;
          $addon_mail=!empty($res1)?(int)$res1[0]['available_email']+1000:1000;
          $remaining_mail=!empty($res1)?(int)$res1[0]['email_remaining']+1000:1000;
          $addon_bal=$_POST['amount']+$addon_amt;


          $cur_bal=$current_amt-$_POST['amount'];
          $insert_payment=array('payment_gateway'=>'ADDON_Manual','paid_on'=>date('Y-m-d H:i:s'),'amt'=>$_POST['amount'],'paid_by'=>$this->user_id,'is_debit_credit'=>0,'cur_bal'=>$cur_bal);
          $this->db->insert('payment_details',$insert_payment);
          $pay_id=$this->db->insert_id();

          $py_sql="INSERT INTO current_balance (user_id,last_pay_id,current_amt,updated_on)values(".$this->user_id.",".$pay_id.",".$cur_bal.",'".date('Y-m-d H:s:i')."') ON DUPLICATE KEY UPDATE last_pay_id=values(last_pay_id),current_amt=values(current_amt),updated_on=values(updated_on)";

          $this->db->query($py_sql);

          $ad_sql="INSERT INTO addon_status (user_id,last_pay_id,current_amt,updated_on,available_email,email_remaining)values(".$this->user_id.",".$pay_id.",".$addon_bal.",'".date('Y-m-d H:s:i')."',".$addon_mail.",".$remaining_mail.") ON DUPLICATE KEY UPDATE last_pay_id=values(last_pay_id),current_amt=values(current_amt),updated_on=values(updated_on),available_email=values(available_email),email_remaining=values(email_remaining)";

          $this->db->query($ad_sql);




          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
         {
              echo '{"status_code":"0","status_text":"Not able to process now please try again"}';
         }
         else
         {
             $alert_type="ADD-ON";
             $alert_subject="ADD-ON for 1000 mail has been added";
             $alert_msg="Hi, <br> INR ".$_POST['amount']." has been spent For 1000 mails ADD-ON you have ".$remaining_mail." in your ADD-ON and your current balance is INR ".$cur_bal;
             $sent_mail=1;
             $timestamp=date('Y-m-d H:s:i');
             $this->load->model('alert_model');
             $this->alert_model->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$this->user_id,$timestamp);


             echo '{"status_code":"1","status_text":"ADD-ON added Successful"}';
         }

    }
    else
    {
      echo '{"status_code":"0","status_text":"Something is missing please try again later"}';
    }
  }
  public function get_plan_data()
  {
    $data['status_text']='Success';
    $data['status_code']='1';
/* $sql="SELECT COUNT(camp_id) AS sent_count,(email_allowed - COUNT(camp_id)) AS remaining_email,email_allowed,plan_name,plan_amt,email_allowed,camp_allowed,DATE_FORMAT(valid_till,'%d-%m-%Y') AS valid_till,DATE_FORMAT(subscribed_on,'%d-%m-%Y') AS subscribed_on,amt,payment_gateway
FROM plan_subscriber AS pln
INNER JOIN payment_details AS pym ON pym.payment_id =pln.payment_id AND paid_by={$this->user_id} AND subscribed_by={$this->user_id} AND  valid_till >= NOW()
INNER JOIN plan_manager AS mgr ON mgr.plan_id =pln.plan_id
LEFT JOIN campaign_manager AS cpn ON pln.subscribed_by=created_by
LEFT JOIN campaign_order_list AS ORD ON cpn.cpgn_id=camp_id AND sent_on > subscribed_on AND sent_on < valid_till
group by subscribed_on
order by valid_till ASC limit 0,1
";*/
  $sql="SELECT  sent_count,remaining_email,email_allowed,plan_name,plan_amt,camp_allowed,valid_till,subscribed_on,plan_id,wallet_balance,plan_status FROM current_plan_info WHERE subscribed_by=".$this->user_id;
  $qry=$this->db->query($sql);
  $data['plan']=$qry->result_array();
//$sql4="SELECT id,status FROM razorpay_subscription_list WHERE user_id=".$this->user_id;
//$qry4=$this->db->query($sql4);
//$data['razorpay_plan']=$qry4->result_array();

    $qry1=$this->db->query("SELECT plan_name,DATE_FORMAT(paid_on,'%d-%m-%Y') AS paid_on,plan_amt,email_allowed,camp_allowed,DATE_FORMAT(subscribed_on,'%d-%m-%Y') AS subscribed_on,DATE_FORMAT(valid_till,'%d-%m-%Y') AS valid_till,amt,payment_gateway
FROM plan_subscriber AS pln
INNER JOIN payment_details AS pym ON pym.payment_id =pln.payment_id AND paid_by={$this->user_id} AND subscribed_by={$this->user_id}
INNER JOIN plan_manager AS mgr ON mgr.plan_id =pln.plan_id ORDER BY  subscribe_id DESC LIMIT 0,15");
    $data['plan_history']=$qry1->result_array();

    $qry2=$this->db->query("SELECT * from current_balance where user_id=".$this->user_id);
    $cur=$qry2->result_array();
    $data['current_bal']=!empty($cur)?$cur[0]['current_amt']:'0.00';


    $qry3=$this->db->query("SELECT pay.payment_id,amt,paid_on,payment_gateway,is_debit_credit,cur_bal,plan_name FROM payment_details AS pay
    LEFT JOIN plan_subscriber AS sub ON subscribed_by={$this->user_id} AND pay.paid_by={$this->user_id} AND sub.subscribed_by=pay.paid_by AND pay.payment_id=sub.payment_id
    LEFT JOIN plan_manager AS pln ON pln.plan_id=sub.plan_id WHERE paid_by={$this->user_id} order by payment_id desc limit 0,15");
    $data['pay_history']=$qry3->result_array();


    //$data['plan_history']=$qry1->result_array();

    $qry4=$this->db->query("SELECT IFNULL(current_amt,'0.00') as current_amt,IFNULL(available_email,'0') as available_email,IFNULL(email_remaining,0) as email_remaining,auto_addon  from scr_user LEFT join addon_status on scr_u_id=user_id where  scr_u_id=".$this->user_id);
    $data['addon']=$qry4->result_array();


    $qry5=$this->db->query("SELECT CONCAT(scr_firstname,' ',scr_lastname) AS customer_name,scr_uname,mobile_no,key_id,display_name,display_desc,display_logo,display_theme FROM scr_user
INNER JOIN razorpay_config as cnf ON 1=1 AND cnf.is_active=1 AND scr_u_id=".$this->user_id);
    $data['razorpay']=$qry5->result_array();

     $qry7=$this->db->query("SELECT * FROM scr_user WHERE scr_u_id=".$this->user_id);
     $data['setting']=$qry7->result_array();

	 $qry8=$this->db->query("SELECT * FROM plan_manager WHERE is_deprecated=0");
     $data['plan_manager']=$qry8->result_array();

    // $data['pay_history']=$qry1->result_array();




    echo json_encode($data);
  }

  public function capture_payment()
  {
    if(!empty($_POST['load_amt']) && !empty($_POST['tax_amt']) && !empty($_POST['payment_id']) && (int)$_POST['load_amt'] > 0 && (int)$_POST['tax_amt'] > 0)
    {
        $res=$this->razorpay_api->capture_payment($this->input->post('load_amt'),$this->input->post('tax_amt'),$this->input->post('payment_id'),$this->user_id);
        echo json_encode($res);
        if($res['status_code']==1)
        {
         // $this->send_notification_to_admin($res);
        }
    }
  }
  public function get_subscription_id()
  {
    if(isset($_POST['plan_id']))
    {
      $sql4="SELECT id,status FROM razorpay_subscription_list WHERE user_id=".$this->user_id;
      $qry4=$this->db->query($sql4);
      $pln_info=$qry4->result_array();
      if(isset($pln_info[0]['status']) && $pln_info[0]['status']=='active')
      {
        echo '{"status_code":"0","status_text":"Your already have a active plan"}';
        die();
      }
      $qry=$this->db->query("SELECT * FROM plan_manager WHERE plan_code=".$this->db->escape($_POST['plan_id']));
      $rs=$qry->result_array();
      if(count($rs) <=0)
      {
        echo '{"status_code":"0","status_text":"Selected plan is not available"}';
        die();
      }
      // $plan_id='plan_BqybKsLlea56Qf';
      $plan_id=$rs[0]['razorpay_planID'];
      $res=$this->razorpay_api->create_new_subscription($plan_id);
      $res=json_decode($res,true);
	  //print_r($res);
      if(isset($res['id']) && !empty($res['id']) && !empty($res['plan_id']))
      {
        $this->session->set_userdata('subscription_id',$res['id']);
        $this->session->set_userdata('plan_id',$res['plan_id']);

        $insert_subscription=array('id'=>$res['id'],'plan_id'=>$res['plan_id'],'status'=>$res['status'],'user_id'=>$this->user_id);
        $this->db->insert('razorpay_subscription',$insert_subscription);
        $data['status_code']='1';
        $data['status_text']='Success';
        $data['subscription_id']=$res['id'];
      }
      else
      {
        $data['status_code']='0';
        $data['status_text']='Not able create subscription please try again';
      }
  }
  else
  {
    $data['status_code']='0';
    $data['status_text']='Input Error';
  }
echo json_encode($data);

  }

  public function authorize_subscription()
  {

    $subscriptionId=$this->session->userdata('subscription_id');;
    if(!empty($subscriptionId) && !empty($_POST['payment_id']) && !empty($_POST['r_subscription_id']) && !empty($_POST['razorpay_signature']))
    {

        $res=$this->razorpay_api->capture_subscription($subscriptionId,$this->input->post('payment_id'),$this->input->post('r_subscription_id'),$this->input->post('razorpay_signature'),$this->user_id);
        // $subscriptionId='sub_Br0kPsErdDMZnq';
        // $payment_id='pay_Br0oRqHs2Ncvv3';
        // $r_subscription_id='sub_Br0kPsErdDMZnq';
        // $razorpay_signature='4b15063848b464f652419a184dc7e06ed63a60af09ecd254b4efc3a55d658d65';
        // $res=$this->razorpay_api->capture_subscription($subscriptionId,$payment_id,$r_subscription_id,$razorpay_signature,$this->user_id);
        echo json_encode($res);
        // if($res['status_code']==1)
        // {
        //   $this->send_notification_to_admin($res);
        // }
    }
    else
    {
     $data['status_code']='0';
     $data['status_text']='Not able to create subscription please contact support';
     echo json_encode($data);
    }

  }

  // public function test()
  // {
  //   $paid['payment_id']='dadASDASDasdad';
  //   $paid['amount']='3000';
  //   $this->send_notification_to_admin($paid);
  // }


public function toggle_subscription_status()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
          $status=(int)$_POST['w_status']==1?'TRUE':'FALSE';

          if($status=='FALSE')
		  {
          $sql="SELECT id FROM `razorpay_subscription`  WHERE status='active' and user_id=".$this->user_id." ORDER BY proseller_id DESC LIMIT 0,1";
          $qry=$this->db->query($sql);
          $res=$qry->result_array();
          if(!empty($res[0]['id']))
	      {
	      $resp=$this->razorpay_api->cancel_subscription($res[0]['id']);
		  $resp=json_decode($resp,true);
		  //print_r($resp);
		  $sql="update razorpay_subscription SET status='".$resp['status']."' WHERE id='".$resp['id']."' and user_id=".$this->user_id;
		  //print_r($sql);
          if(isset($resp['id']) && !empty($resp['id']) && !empty($resp['plan_id']))
           {
        $this->session->unset_userdata('subscription_id',$resp['id']);
        $this->session->unset_userdata('plan_id',$resp['plan_id']);
		 if($this->db->query("update razorpay_subscription SET status='".$resp['status']."' WHERE id='".$resp['id']."' and user_id=".$this->user_id))
          {
		$this->db->query("update scr_user SET subscription_status=".$status." WHERE scr_u_id=".$this->user_id);
         echo '{"status_code":"1","status_text":"Subscription to razorpay Canelled Successful"}';
		  }
		  else
		  {
	 echo '{"status_code":"0","status_text":"Not able cancel the subscription please try again"}';
		  }
      }
      else
      {
	   echo '{"status_code":"0","status_text":"Not able cancel the subscription please try again"}';
      }
	}
			  else
			  {
			  echo '{"status_code":"0","status_text":"There are no active subscription to cancel"}';
			  }
	      }
           if($status=='TRUE')
		   {
               $sql="SELECT id FROM `razorpay_subscription`  WHERE status='active' and user_id=".$this->user_id." ORDER BY proseller_id DESC LIMIT 0,1";
              $qry=$this->db->query($sql);
	          $res=$qry->result_array();

			  if(!empty($res[0]['id']))
			  {
		      echo '{"status_code":"0","status_text":"Please subscribe to a plan to activate subscription."}';
			  }
               else
		      {
	        echo '{"status_code":"0","status_text":"There are no active subscriptions"}';
		      }
		   }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';
    }
  }

  public function send_notification_to_admin($paid)
  {
    $qry=$this->db->query("SELECT b.company_name,b.comp_addr1 AS comp_addr,b.comp_gst,scr_firstname,scr_lastname,scr_uname,mobile_no FROM scr_user
INNER JOIN `usr_comp_info` AS b ON b.usr_id=scr_u_id
INNER JOIN amazon_profile ON scr_u_id=profile_id and scr_u_id=".$this->user_id);
    $res=$qry->result_array();
    if(!empty($res))
    {
       $amt=$paid['amount']/100;
      $msg="NAME: ".$res[0]['scr_firstname']." ".$res[0]['scr_firstname']."<br>";
      $msg.="COMPANY: ".$res[0]['company_name']."<br>";
      $msg.="COMPANY ADDRESS: ".$res[0]['comp_addr']."<br>";
      $msg.="GST NO: ".$res[0]['comp_gst']."<br>";
      $msg.="Email: ".$res[0]['scr_uname']."<br>";
      $msg.="Mobile: ".$res[0]['mobile_no']."<br>";
      $msg.="Paid Amount: ".$amt."<br>";
      $msg.="Payment ID: ".$paid['payment_id']."<br>";
      $subject="Payment Notification";
     $this->load->library('email');
     $config['protocol'] = "smtp";
     $config['smtp_host'] = "tls://email-smtp.us-east-1.amazonaws.com";
     $config['smtp_port'] = '465';
     $config['smtp_user'] = 'AKIAX2BCXESCD6UL6W4C';
     $config['smtp_pass'] = 'BNJVELo+k/v/Nn8r3QWUiMFqOZfFu/ZpSU4ABlVxo2OF';
     $config['wordwrap']=TRUE;
     $config['charset'] = "utf-8";
     $config['mailtype'] = "html";
     $config['newline'] = "\r\n";
     $config['crlf'] = "\r\n";
     $config['useragent']='FeedbackGrid Mailer';
	 $this->email->clear(TRUE);
     $this->email->initialize($config);
     $this->email->set_newline("\r\n");
     $this->email->from('campaign@feedbackoutlook.com');
      $this->email->to("yugandhar@lemertech.com");
      $this->email->subject($subject);
      $this->email->message($msg);
      $this->email->send();
    }


  }




}
