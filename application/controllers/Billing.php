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
	 $this->fname=$user['fname'];
	 $this->lname=$user['lname'];
     $this->user_name=$user['fname']." ".$user['lname'];
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


	public function capture_payment()
  {

         $data['plan_id']=$this->input->post('plan_id');
         $data['token']=$this->input->post('payment_id');

   if(!empty($data['plan_id']) && !empty($data['token']))
        {

	       $sql1="SELECT * FROM plan_manager where plan_id='".$data['plan_id']."'";
		   $qry1=$this->db->query($sql1);
		   $res1=$qry1->result_array();
		   //print_r($res1);
		   //die();
		   $plan_amt=isset($res1[0]['plan_amt'])?$res1[0]['plan_amt']:0;

		   $qer=$this->db->query("SELECT * from current_balance where user_id=".$this->user_id);
            $res2=$qer->result_array();
		   $current_amt=isset($res2[0]['current_amt'])?$res2[0]['current_amt']:0;
		   $cur_bal=$current_amt-$plan_amt;

           $configCustomer = array(
			'customer_description' => 'Customer Name: '.$this->user_name,
			'email_customer' => $this->user_email,
			'source_payment_token' =>  $data['token']
		);
		$result = $this->stripe_lib->createCustomerWithPaymentSource($configCustomer);
		$idCustomer = $result->id;

        $trialEnd = $this->AddTime('+30 days');
		$configSubscription = array(
			'customer_id' => $idCustomer,
			'id_plan' => $res1[0]['stripe_plan_id']
			//'timestump_trial_end' => $trialEnd
		);
		$result = $this->stripe_lib->createSubscriptionWithPlanAndCustomer($configSubscription);
		//$result = json_encode($result);
        //print_r($result);
		//die();

		if (isset($result->id) && empty($result->id))
         {
			  echo '{"status_code":"1","status_text":"Not able to subscribe now please try again"}';
          }
         else
         {
			  $sql="INSERT INTO stripe_subscription(stripe_sub_id,sub_start,sub_status,sub_trail_start,sub_trail_end,current_period_start,current_period_end,plan_name,added_by,customer_id)
		      VALUES(".$this->db->escape($result->id).",".$this->db->escape($result->created).",".$this->db->escape($result->status).",
			  ".$this->db->escape($result->trial_start).",".$this->db->escape($result->trial_end)."
			  ,".$this->db->escape($result->current_period_start).",".$this->db->escape($result->current_period_end).",".$this->db->escape($result->plan->nickname)."
			  ,".$this->db->escape($this->user_id).",".$this->db->escape($idCustomer).")";
         $this->db->query($sql);

           echo '{"status_code":"1","status_text":"Subsciption Was Successfull"}';


         }



  }
  else
  {
  echo '{"status_code":"0","status_text":"Plan detail info not available"}';
  die();

  }

  }


//  public function new_plan($plan_id='')
//  {
//	  //print_r($plan_id);
//	  //die();
//	       $sql="SELECT * FROM stripe_subscription where added_by='".$this->user_id."' AND is_active='1'";
//		   $qry=$this->db->query($sql);
//		   $res=$qry->result_array();
//
//
//        if(count($res) > 0)
//        {
//      	echo "<script>
//       alert('Subsciption Already is Active.Please Unsubscribe');
//       window.location.href='http://localhost/feedbackgrid_org/subscribe/';
//       </script>";
//	    }
//
//
//        else
//        {
//		 $token = $this->input->post();
//         $data['plan_id']=$plan_id;
//         $data['token']=$token['stripeToken'];
//
//        if(!empty($data['plan_id']) && !empty($data['token']))
//        {
//
//	       $sql1="SELECT * FROM plan_manager where plan_id='".$data['plan_id']."'";
//		   $qry1=$this->db->query($sql1);
//		   $res1=$qry1->result_array();
//		   //print_r($res1);
//		   //die();
//		   $plan_amt=isset($res1[0]['plan_amt'])?$res1[0]['plan_amt']:0;
//
//		   $qer=$this->db->query("SELECT * from current_balance where user_id=".$this->user_id);
//            $res2=$qer->result_array();
//		   $current_amt=isset($res2[0]['current_amt'])?$res2[0]['current_amt']:0;
//		   $cur_bal=$current_amt-$plan_amt;
//
//           $configCustomer = array(
//			'customer_description' => 'Customer Name: '.$this->user_name,
//			'email_customer' => $this->user_email,
//			'source_payment_token' =>  $data['token']
//		);
//		$result = $this->stripe_lib->createCustomerWithPaymentSource($configCustomer);
//		$idCustomer = $result->id;
//
//        $trialEnd = $this->AddTime('+30 days');
//		$configSubscription = array(
//			'customer_id' => $idCustomer,
//			'id_plan' => $res1[0]['stripe_plan_id']
//			//'timestump_trial_end' => $trialEnd
//		);
//		$result = $this->stripe_lib->createSubscriptionWithPlanAndCustomer($configSubscription);
//		//$result = json_encode($result);
//        //print_r($result);
//		//die();
//
//		if (isset($result->id) && empty($result->id))
//         {
//              echo "<script>
//       alert('Not able to process now please try again');
//       window.location.href='http://localhost/feedbackgrid_org/subscribe/';
//       </script>";
//         }
//         else
//         {
//			  $sql="INSERT INTO stripe_subscription(stripe_sub_id,sub_start,sub_status,sub_trail_start,sub_trail_end,current_period_start,current_period_end,plan_name,added_by,customer_id)
//		      VALUES(".$this->db->escape($result->id).",".$this->db->escape($result->created).",".$this->db->escape($result->status).",
//			  ".$this->db->escape($result->trial_start).",".$this->db->escape($result->trial_end)."
//			  ,".$this->db->escape($result->current_period_start).",".$this->db->escape($result->current_period_end).",".$this->db->escape($result->plan->nickname)."
//			  ,".$this->db->escape($this->user_id).",".$this->db->escape($idCustomer).")";
//         $this->db->query($sql);
//           echo "<script>
//       alert('Subscribed Successfully');
//       window.location.href='http://localhost/feedbackgrid_org/subscribe/';
//       </script>";
//
//
//         }
//
//
//
//  }
//  else
//  {
//  echo '{"status_code":"0","status_text":"Plan detail info not available"}';
//  die();
//
//  }
//  }
//
//  }


           public function cancel_stripe_subscription() {
	       $sql="SELECT * FROM stripe_subscription where added_by='".$this->user_id."' AND is_active='1' ORDER BY subscribe_id DESC LIMIT 1";
		   $qry=$this->db->query($sql);
		   $res=$qry->result_array();
	 if(count($res > 0) )
	 {
		$idSubscription =$res[0]['stripe_sub_id']; // SUBSCRIPTION ID DA CANCELLARE
		$result = $this->stripe_lib->cancelSubscriptionWithID($idSubscription);
		if(!empty($result['id']))
		{
			//print_r($result);
		$this->db->query("UPDATE stripe_subscription SET sub_status='canceled',is_active='0',canceled_id=".$this->db->escape($result['id']).",canceled_on='".date('Y-m-d H:i:s')."' WHERE stripe_sub_id='".$res[0]['stripe_sub_id']."'");
        echo '{"status_code":"1","status_text":"Subsciption Cancelled Successfully"}';
  	 	}
		else
		{
		echo '{"status_code":"0","status_text":"Server Error Please Try Again Later"}';
 			}
	   }
	   else
	   {
		echo '{"status_code":"0","status_text":"No Active Subscription"}';
	   }
	}

	// Helper => To timeStump + 7DAYS
	private function AddTime($time) {
		$newdate = strtotime($time, time());
		//$newdate = strtotime('+3 minutes', time());
		return $newdate;
	}

	/* HELPER CONVERT DATE */
	private function convertDate($date) {
		// CONVERTI FORMATO DATA
		$data_ricevuta = strtotime($date); // convert string to timestamp
		$data_convertita = date("Y-m-d H:i:s", $data_ricevuta); // convert timestamp to Server Format
		return $data_convertita;
	}
	// converti la data in dateShop
	private function createDateShop($date) {
		$data_ricevuta = strtotime($date); // convert string to timestamp
		$data_convertita = date("d/m/Y", $data_ricevuta); // convert timestamp to Server Format 31/08/2018
		return $data_convertita;
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

	 $sql9="SELECT *,COUNT(*) AS ttl,CONCAT(UCASE(LEFT(sub_status, 1)),
                             SUBSTRING(sub_status, 2)) AS sub_status_new,DATE_FORMAT(FROM_UNIXTIME(current_period_start), '%Y-%m-%d') AS 'start_date',
DATE_FORMAT(FROM_UNIXTIME(current_period_end), '%Y-%m-%d') AS 'end_date',IF(sub_status='active','Active','Inactive') AS status_new2 FROM stripe_subscription WHERE added_by=".$this->user_id." AND is_active='1' ORDER BY subscribe_id DESC LIMIT 1";
$qry9=$this->db->query($sql9);
$data['stripe_plan']=$qry9->result_array();


$qry10=$this->db->query("SELECT CONCAT(scr_firstname,' ',scr_lastname) AS customer_name,scr_uname,mobile_no,display_logo FROM scr_user
INNER JOIN stripe_config as cnf ON 1=1 AND cnf.is_active=1 AND scr_u_id=".$this->user_id);
    $data['stripe']=$qry10->result_array();

$qry11=$this->db->query("SELECT *,COUNT(*) AS ttl,CONCAT(UCASE(LEFT(status, 1)),
                             SUBSTRING(status, 2)) AS sub_status_new2,IF(status='ACTIVE','Active','Inactive') AS status_new FROM paypal_subscription_details AS a inner join plan_manager as b on b.paypal_planID=a.plan_id WHERE  added_by='".$this->user_id."' AND status <> 'APPROVAL_PENDING' ORDER BY id DESC LIMIT 1");
     $data['paypal_details']=$qry11->result_array();

	 echo json_encode($data);
  }


  public function new_plan()
  {
	  if(isset($_POST['plan_id']) && $_POST['plan_id'] >= 0)
    {
          $qry=$this->db->query("SELECT * from plan_manager where plan_id=".$this->db->escape($_POST['plan_id']));
          $res=$qry->result_array();
		  $sql_token="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
	      $qry_token=$this->db->query($sql_token);
		  $res_token=$qry_token->result_array();
		   if(empty($res))
          {
             echo '{"status_code":"0","status_text":"Plan detail info not available"}';
             die();
          }
		  else if(empty($res_token))
          {
             echo '{"status_code":"0","status_text":"Plan detail info not available"}';
             die();
         }
         $req_id='SUBSCRIPTION-'.rand().'-321';

         $post_data='
		 {
	  "plan_id": "'.$res[0]['paypal_planID'].'",
	  "subscriber": {
        "name": {
          "given_name": "'.$this->fname.'",
          "surname": "'.$this->lname.'"
        },
        "email_address": "'.$this->user_email.'"
      },
      "application_context": {
        "brand_name": "FeedbackOutlook",
        "locale": "en-US",
        "shipping_preference": "SET_PROVIDED_ADDRESS",
        "user_action": "SUBSCRIBE_NOW",
        "payment_method": {
          "payer_selected": "PAYPAL",
          "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
        },
       "return_url": "http://35.171.8.128/app/paypal/paypal_success",
       "cancel_url": "http://35.171.8.128/app/paypal/paypal_cancel"
	  }
     }';
		 //print_r($post_data);
		 //die();
		  //"start_time": "2019-12-28T02:32:24Z",
		 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/billing/subscriptions");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
         curl_setopt($ch, CURLOPT_POST, 1);
         $headers = array();
         $headers[] = "Accept: application/json";
         $headers[] = "Authorization: Bearer ".$res_token[0]['access_token'];
         $headers[] = "PayPal-Request-Id : ". $req_id;
         $headers[] = "Prefer: return=representation";
         $headers[] = "Content-Type: application/json";
	      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 // var_dump($ch);
		  //die();
         $result = curl_exec($ch);
         if (curl_errno($ch)) {
            echo '{"status_code":"0","status_text":"Subscription Failed.Please Contact Support"}';
            die();
         }
         curl_close($ch);
		 $subscription_deatils = json_decode($result);
          if(isset($subscription_deatils->id))
  {
         $sql="INSERT INTO paypal_subscription_details(added_by,status,status_update_time,subscribe_id,plan_id,start_time,name,surname,email_address,create_time,link_1,link_2,link_3)
         VALUES('".$this->user_id."',".$this->db->escape($subscription_deatils->status).",
		 ".$this->db->escape(date('Y-m-d H:i:s',strtotime($subscription_deatils->status_update_time)))."
		 ,".$this->db->escape($subscription_deatils->id).",".$this->db->escape($subscription_deatils->plan_id).",
		 ".$this->db->escape(date('Y-m-d H:i:s',strtotime($subscription_deatils->start_time)))."
		 ,".$this->db->escape($subscription_deatils->subscriber->name->given_name).",".$this->db->escape($subscription_deatils->subscriber->name->surname).",
		 ".$this->db->escape($subscription_deatils->subscriber->email_address).",
		 ".$this->db->escape(date('Y-m-d H:i:s',strtotime($subscription_deatils->create_time))).",
		 ".$this->db->escape($subscription_deatils->links[0]->href).",".$this->db->escape($subscription_deatils->links[1]->href).",
		 ".$this->db->escape($subscription_deatils->links[2]->href).")
		 ON DUPLICATE KEY UPDATE status=VALUES(status),status_update_time=VALUES(status_update_time),subscribe_id=VALUES(subscribe_id),start_time=VALUES(start_time)
		 ,name=VALUES(name),surname=VALUES(surname),email_address=VALUES(email_address),create_time=VALUES(create_time),link_1=VALUES(link_1),link_2=VALUES(link_2),link_3=VALUES(link_3)";
		 $this->db->query($sql);

		  $data['status_code']=1;
          $data['status_text']='Success';
          //$data['exported_file']=$hash_name;
          $data['download_url']=$subscription_deatils->links[0]->href;
		   echo json_encode($data);

 }
	else
	{
		  echo '{"status_code":"0","status_text":"Subscription Failed.Please Contact Support"}';
        // die();
	}


	}
  }

	public function cancel_paypal_subscription()
	{

	 $qry9=$this->db->query("SELECT * FROM paypal_subscription_details AS a inner join plan_manager as b on b.paypal_planID=a.plan_id
		 WHERE status='ACTIVE' AND added_by='".$this->user_id."'");
         $res=$qry9->result_array();
		 if(count($res) > 0 )
		 {
			 //print_r($res);
			 //die();
			  $sql_token="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
	      $qry_token=$this->db->query($sql_token);
		  $res_token=$qry_token->result_array();
			  $post_data='{
      "reason": "For plan Upgrade"
    }';
		 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v1/billing/subscriptions/'.$res[0]['subscribe_id'].'/cancel');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
 curl_setopt($ch, CURLOPT_POST, 1);
 $headers = array();
 $headers[] = 'Content-Type: application/json';
 $headers[] = 'Authorization: Bearer '.$res_token[0]['access_token'];
 //$headers[] = 'PayPal-Request-Id : '. $req_id;
 //$headers[] = 'Prefer: return=representation';

 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 //print_r($ch);
$result = curl_exec($ch);
if (curl_errno($ch)) {
   echo '{"status_code":"0","status_text":"Subscription cancellation Failed.Please Contact Support"}';
            die();
}
curl_close($ch);
$cancel_deatils = json_decode($result);
$sql="UPDATE paypal_subscription_details set status='CANCELLED' where subscribe_id='".$res[0]['subscribe_id']."'";
$this->db->query($sql);
 echo '{"status_code":"1","status_text":"Subscription Cancelled Successfully"}';

		 }
          else
		  {
 echo '{"status_code":"0","status_text":"Subscription cancellation Failed.Please Contact Support"}';

		  }
	}








}
