<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {
public function  __construct()
    {
     parent::__construct();
	  $log_file=FCPATH.DIRECTORY_SEPARATOR."log_data".DIRECTORY_SEPARATOR."paypal_details.txt";
      $this->log_handle=fopen($log_file, "a");
	  chmod($log_file, 0777); 
     
    }
	
	public function paypal_success() 
	{
	$this->load->view('paypal/paypal_success');
	}
	
	public function paypal_cancel() 
	{
		
	$this->load->view('paypal/paypal_cancel');
		
	}
	
	public function get_webhook_data() 
	{
   //echo"\n";
   $json = file_get_contents('php://input');
   //print_r($json);
 //fwrite($this->log_handle, $json); 
 // echo"\n";   
 $subscription_deatils = json_decode($json, true);
 print_r($subscription_deatils);
 fwrite($this->log_handle, $subscription_deatils);   
 echo"\n";echo"\n";echo"\n";echo"\n";echo"\n";echo"\n";
 
 if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.ACTIVATED') 
	{
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	   $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
	if($subscription_deatils['event_type']=='PAYMENT.SALE.COMPLETED') 
	{
		 $sql_pay="INSERT IGNORE INTO payment_details_new(`subscribe_id`,`event_type`,`summary`,`pay_id`,`amount`,`billing_agreement_id`,receipt_id) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['amount']['total']).",".$this->db->escape($subscription_deatils['resource']['billing_agreement_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['receipt_id']).")"; 
			 //print_r($sql);
	  $this->db->query($sql_pay);
	
	 $sql="SELECT * FROM `paypal_subscription_details`  WHERE status='ACTIVE' AND subscribe_id=".$this->db->escape($subscription_deatils['resource']['billing_agreement_id'])."";
     $qry=$this->db->query($sql);
     $res=$qry->result_array();
     if(count($res) > 0 ) 
	 {
	 $sql_pln="SELECT * FROM `plan_manager`  WHERE paypal_planID=".$this->db->escape($res[0]['plan_id'])."";
     $qry_pln=$this->db->query($sql_pln);
     $res_pln=$qry_pln->result_array();	
	 
	 $plan_amt=isset($res_pln[0]['plan_amt'])?$res_pln[0]['plan_amt']:0;
	 
	 $this->db->trans_start();
     $insert_payment=array('ref_id'=>$subscription_deatils['resource']['id'],'payment_gateway'=>'PAYPAL_SUBSCRIPTION','paid_on'=>date('Y-m-d H:i:s'),'amt'=>$plan_amt,'paid_by'=>$res[0]['added_by']);
     $this->db->insert('payment_details',$insert_payment);
     $pay_id=$this->db->insert_id();
	 //if(!empty($pay_id)) 
	 //{
     //$this->db->query("UPDATE current_balance SET last_pay_id=".$pay_id.",current_amt=current_amt-".$this->db->escape($plan_amt).",updated_on=now() WHERE user_id=".$this->user_id);
     //$plan_start_date=date('Y-m-d H:i:s');
     //$vali_till_dt=date('Y-m-d H:i:s', strtotime('+1 month',strtotime(date($plan_start_date))));
     //$insert_plan=array('plan_id'=>$res_pln[0]['plan_id'],'payment_id'=>$pay_id,'subscribed_by'=>$res[0]['added_by'],'subscribed_on'=>date('Y-m-d H:i:s'),
     //                  'updated_on'=>$plan_start_date,'valid_till'=>$vali_till_dt);
     //$this->db->insert('plan_subscriber',$insert_plan);
     $this->db->trans_complete();
	 
	  if ($this->db->trans_status() === FALSE)
         {
              echo 'Not able to process now please try again';              
         }
         else
         {
             echo 'Subscription Successful';               
         }
    //}		
		 
	 }
	 
	
	}
 
 
 
//  $sql="INSERT INTO paypal_webhook_details(status,status_update_time,subscribe_id,plan_id,start_time,name,surname,email_address,create_time,link_1,link_2,link_3)
//         VALUES(".$this->db->escape($subscription_deatils->status).",
//		 ".$this->db->escape(date('Y-m-d H:i:s',strtotime($subscription_deatils->status_update_time)))."
//		 ,".$this->db->escape($subscription_deatils->id).",".$this->db->escape($subscription_deatils->plan_id).",
//		 ".$this->db->escape(date('Y-m-d H:i:s',strtotime($subscription_deatils->start_time)))."
//		 ,".$this->db->escape($subscription_deatils->subscriber->name->given_name).",".$this->db->escape($subscription_deatils->subscriber->name->surname).",
//		 ".$this->db->escape($subscription_deatils->subscriber->email_address).",
//		 ".$this->db->escape(date('Y-m-d H:i:s',strtotime($subscription_deatils->create_time))).",
//		 ".$this->db->escape($subscription_deatils->links[0]->href).",".$this->db->escape($subscription_deatils->links[1]->href).",
//		 ".$this->db->escape($subscription_deatils->links[2]->href).")
//		 ON DUPLICATE KEY UPDATE status=VALUES(status),status_update_time=VALUES(status_update_time),subscribe_id=VALUES(subscribe_id),start_time=VALUES(start_time)
//		 ,name=VALUES(name),surname=VALUES(surname),email_address=VALUES(email_address),create_time=VALUES(create_time),link_1=VALUES(link_1),link_2=VALUES(link_2),link_3=VALUES(link_3)";
//		print_r($sql);
		// $this->db->query($sql);
		 
		 
	}
	
 public function webhook_data_parsing() 
 {
	 
	$json='{"id":"WH-TY567577T725889R5-1E6T55435R66166TR","create_time":"2018-19-12T22:20:32.000Z","resource_type":"subscription","event_type":"BILLING.SUBSCRIPTION.CREATED","summary":"A billing subscription was created.","resource":{"quantity":"20","subscriber":{"name":{"given_name":"John","surname":"Doe"},"email_address":"customer@example.com","shipping_address":{"name":{"full_name":"John Doe"},"address":{"address_line_1":"2211 N First Street","address_line_2":"Building 17","admin_area_2":"San Jose","admin_area_1":"CA","postal_code":"95131","country_code":"US"}}},"create_time":"2018-12-10T21:20:49Z","shipping_amount":{"currency_code":"USD","value":"10.00"},"start_time":"2018-11-01T00:00:00Z","update_time":"2018-12-10T21:20:49Z","billing_info":{"outstanding_balance":{"currency_code":"USD","value":"10.00"},"cycle_executions":[{"tenure_type":"TRIAL","sequence":1,"cycles_completed":1,"cycles_remaining":0,"current_pricing_scheme_version":1},{"tenure_type":"REGULAR","sequence":2,"cycles_completed":1,"cycles_remaining":0,"current_pricing_scheme_version":1}],"last_payment":{"amount":{"currency_code":"USD","value":"500.00"},"time":"2018-12-01T01:20:49Z"},"next_billing_time":"2019-01-01T00:20:49Z","final_payment_time":"2020-01-01T00:20:49Z","failed_payments_count":2},"links":[{"href":"https://www.paypal.com/webapps/billing/subscriptions?ba_token=BA-4GH39689T3856352J","rel":"approve","method":"GET"},{"href":"https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G","rel":"self","method":"GET"},{"href":"https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G","rel":"edit","method":"PATCH"},{"href":"https://api.paypal.com/v1/billing/subscriptions/I-BW452GLLEP1G/activate","rel":"activate","method":"POST"}],"id":"I-BW452GLLEP1G","plan_id":"P-5ML4271244454362WXNWU5NQ","auto_renewal":true,"status":"APPROVAL_PENDING","status_update_time":"2018-12-10T21:20:49Z"},"links":[{"href":"https://api.paypal.com/v1/notifications/webhooks-events/TY567577T725889R5-1E6T55435R66166TR","rel":"self","method":"GET","encType":"application/json"},{"href":"https://api.paypal.com/v1/notifications/webhooks-events/WH-TY567577T725889R5-1E6T55435R66166TR/resend","rel":"resend","method":"POST","encType":"application/json"}],"event_version":"1.0","resource_version":"2.0"}'; 
    //$json='{"id":"WH-7161175880301431B-6AG39655UY5521154","event_version":"1.0","create_time":"2020-01-04T20:37:24.000Z","resource_type":"subscription","resource_version":"2.0","event_type":"BILLING.SUBSCRIPTION.CANCELLED","summary":"Subscription cancelled","resource":{"status_change_note":"For plan Upgrade","quantity":"1","subscriber":{"name":{"given_name":"Test","surname":"User"},"email_address":"yugandhar@lemertech.com","shipping_address":{"address":{"address_line_1":"100 W California Blvd","address_line_2":"Pasadena","admin_area_2":"CA","admin_area_1":"CA","postal_code":"91105","country_code":"US"}}},"create_time":"2020-01-04T12:37:24Z","shipping_amount":{"currency_code":"USD","value":"0.0"},"start_time":"2020-01-04T08:00:00Z","update_time":"2020-01-04T12:41:58Z","billing_info":{"outstanding_balance":{"currency_code":"USD","value":"0.0"},"cycle_executions":[{"tenure_type":"TRIAL","sequence":1,"cycles_completed":0,"cycles_remaining":1},{"tenure_type":"REGULAR","sequence":2,"cycles_completed":0,"cycles_remaining":12,"current_pricing_scheme_version":1}],"failed_payments_count":0},"links":[{"href":"https://node-sb-subscriptionmgmtserv-vip.slc.paypal.com:19472/v1/billing/subscriptions/I-VV6WEHD3E1TR","rel":"self","method":"GET"}],"id":"I-VV6WEHD3E1TR","plan_id":"P-0EL48968MH373725FLYCMMBI","status":"CANCELLED","status_update_time":"2020-01-04T12:41:58Z"},"links":[{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7161175880301431B-6AG39655UY5521154","rel":"self","method":"GET"},{"href":"https://api.sandbox.paypal.com/v1/notifications/webhooks-events/WH-7161175880301431B-6AG39655UY5521154/resend","rel":"resend","method":"POST"}]}';
	$subscription_deatils = json_decode($json, true);
    
	
	if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.ACTIVATED') 
	{
		print_r($subscription_deatils); 
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	  $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
		
	}
	
	if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.CREATED') 
	{
		  print_r($subscription_deatils); 
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	  $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
	if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.RE-ACTIVATED') 
	{
		print_r($subscription_deatils); 
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
//	  $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
//			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
//			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
//	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
	if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.UPDATED') 
	{
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	   $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
	if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.PAYMENT.FAILED') 
	{
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	   $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
	if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.EXPIRED') 
	{
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	   $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
if($subscription_deatils['event_type']=='BILLING.SUBSCRIPTION.RENEWED') 
	{
	      $sql="INSERT IGNORE INTO paypal_webhook_details(`id`,`event_type`,`summary`,`subscriber_email`,`subscriber_fname`,`subscriber_lname`,address_line_1,address_line_2,admin_area_2
	         ,admin_area_1,postal_code,country_code,subscribe_id,plan_id,subscription_status,billing_info,link_info_1,link_info_2) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['email_address'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['given_name']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['name']['surname'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_1']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['address_line_2'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_2']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['admin_area_1'])."
			 ,".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['postal_code']).",".$this->db->escape($subscription_deatils['resource']['subscriber']['shipping_address']['address']['country_code'])."
			 ,".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['plan_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['status']).",".$this->db->escape(serialize($subscription_deatils['resource']['billing_info']))."
			 ,".$this->db->escape(serialize($subscription_deatils['resource']['links'])).",".$this->db->escape(serialize($subscription_deatils['links'])).")"; 
	  $this->db->query($sql);
	  
	   $sql_sub="INSERT INTO paypal_subscription_details(subscribe_id,status) 
			 VALUES(".$this->db->escape($subscription_deatils['resource']['id']).",".$this->db->escape($subscription_deatils['resource']['status']).")
			 ON DUPLICATE KEY UPDATE status=VALUES(status)"; 
	  $this->db->query($sql_sub);
    //print_r($sql);	  
		
	}
	
	if($subscription_deatils['event_type']=='PAYMENT.SALE.COMPLETED') 
	{
		 $sql_pay="INSERT IGNORE INTO payment_details_new(`subscribe_id`,`event_type`,`summary`,`pay_id`,`amount`,`billing_agreement_id`,receipt_id) 
			 VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['event_type'])."
			 ,".$this->db->escape($subscription_deatils['summary']).",".$this->db->escape($subscription_deatils['resource']['id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['amount']['total']).",".$this->db->escape($subscription_deatils['resource']['billing_agreement_id'])."
			 ,".$this->db->escape($subscription_deatils['resource']['receipt_id']).")"; 
			 //print_r($sql);
	  $this->db->query($sql_pay);
	
	 $sql="SELECT * FROM `paypal_subscription_details`  WHERE status='ACTIVE' AND subscribe_id=".$this->db->escape($subscription_deatils['resource']['billing_agreement_id'])."";
     $qry=$this->db->query($sql);
     $res=$qry->result_array();
     if(count($res) > 0 ) 
	 {
	 $sql_pln="SELECT * FROM `plan_manager`  WHERE paypal_planID=".$this->db->escape($res[0]['plan_id'])."";
     $qry_pln=$this->db->query($sql_pln);
     $res_pln=$qry_pln->result_array();	
	 
	 $plan_amt=isset($res_pln[0]['plan_amt'])?$res_pln[0]['plan_amt']:0;
	 
	 $this->db->trans_start();
     $insert_payment=array('ref_id'=>$subscription_deatils['resource']['id'],'payment_gateway'=>'PAYPAL_SUBSCRIPTION','paid_on'=>date('Y-m-d H:i:s'),'amt'=>$plan_amt,'paid_by'=>$res[0]['added_by']);
     $this->db->insert('payment_details',$insert_payment);
     $pay_id=$this->db->insert_id();
	 //if(!empty($pay_id)) 
	 //{
     //$this->db->query("UPDATE current_balance SET last_pay_id=".$pay_id.",current_amt=current_amt-".$this->db->escape($plan_amt).",updated_on=now() WHERE user_id=".$this->user_id);
     //$plan_start_date=date('Y-m-d H:i:s');
     //$vali_till_dt=date('Y-m-d H:i:s', strtotime('+1 month',strtotime(date($plan_start_date))));
     //$insert_plan=array('plan_id'=>$res_pln[0]['plan_id'],'payment_id'=>$pay_id,'subscribed_by'=>$res[0]['added_by'],'subscribed_on'=>date('Y-m-d H:i:s'),
     //                  'updated_on'=>$plan_start_date,'valid_till'=>$vali_till_dt);
     //$this->db->insert('plan_subscriber',$insert_plan);
     $this->db->trans_complete();
	 
	  if ($this->db->trans_status() === FALSE)
         {
              echo 'Not able to process now please try again';              
         }
         else
         {
             echo 'Subscription Successful';               
        }
    }		
		 
	}
}	 
	
	
}
