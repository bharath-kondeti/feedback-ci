<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_subscription extends CI_Controller {
  public function  __construct()
  {
     parent::__construct();
     
     //$this->load->model('automation/amazon_research_model');
  }
  public function get_access_token()
  {

 $sql="SELECT * FROM paypal_api_details WHERE is_active='1'";
 $qry=$this->db->query($sql);
 $res=$qry->result_array();
if(count($res) > 0 ) 
{ 
$ch = curl_init();
//$clientId = "AW-b8IpsLfSMH61ImSZMCnUVV67Id41L-yJU5HzQ_debMP79ex0j7Af7zwrs6zjGnsWn4ZbLyA2OtntA";
//$secret = "EFqpabqeTwkl3Z4mIZTXeVxHG3LQ1YPdT03dgIGsasKlGLgS4HCeHi1HjQ8JZHuRiDxzJfX6y1OoAfz_";
curl_setopt($ch, CURLOPT_URL, $res[0]['paypal_url']);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSLVERSION , 6); //NEW ADDITION
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $res[0]['client_id'].":".$res[0]['secret_key']);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);
//print_r($result);
if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
    print_r($json->access_token);
	$sql="INSERT INTO paypal_access_token_details(access_token,app_id,expires_in) VALUES(".$this->db->escape($json->access_token).",".$this->db->escape($json->app_id).",".$this->db->escape($json->expires_in).")
	      ON DUPLICATE KEY UPDATE expires_in=VALUES(expires_in)";
    $this->db->query($sql);		  
}
  curl_close($ch);
  }
 }
 
 
  public function create_product()
  { 
 $sql="SELECT * FROM paypal_api_details WHERE is_active='1'";
 $qry=$this->db->query($sql);
 $res=$qry->result_array();
if(count($res) > 0 ) 
{

 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();

$post_data='{"name": "Plan Service",  "description": "Plan service","type": "SERVICE"}';
 
$ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v1/catalogs/products');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
//$headers[] = 'Paypal-Request-Id: PROD-22';
//print_r($headers);
//die();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$createProduct = json_decode($result);
print_r($createProduct);
 
	
}


  }
 
public function create_plan() 
{
	
 $sql="SELECT * FROM paypal_api_details WHERE is_active='1'";
 $qry=$this->db->query($sql);
 $res=$qry->result_array();
if(count($res) > 0 ) 
{

 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();
 
 
 $req_id='PLAN-'.rand().'-256';
 
 $post_data='{
      "product_id": "PROD-71A74940VL1204455",
      "name": "Small",
      "description": "Small",
      "billing_cycles": [
        {
          "frequency": {
            "interval_unit": "MONTH",
            "interval_count": 1
          },
          "tenure_type": "TRIAL",
          "sequence": 1,
          "total_cycles": 1
        },
        {
          "frequency": {
            "interval_unit": "MONTH",
            "interval_count": 1
          },
          "tenure_type": "REGULAR",
          "sequence": 2,
          "total_cycles": 12,
          "pricing_scheme": {
            "fixed_price": {
              "value": "2",
              "currency_code": "EUR"
            }
          }
        }
      ],
      "payment_preferences": {
        "auto_bill_outstanding": true,
        "setup_fee": {
          "value": "2",
          "currency_code": "EUR"
        },
        "setup_fee_failure_action": "CONTINUE",
        "payment_failure_threshold": 3
      },
      "taxes": {
        "percentage": "10",
        "inclusive": false
      }
    }';
 
 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v1/billing/plans');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
 curl_setopt($ch, CURLOPT_POST, 1);
 $headers = array();
 $headers[] = 'Accept: application/json';
 $headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
 $headers[] = 'PayPal-Request-Id : '. $req_id;
 $headers[] = 'Prefer: return=representation';
 $headers[] = 'Content-Type: application/json';
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 print_r($ch);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$plan_deatils = json_decode($result);
print_r($plan_deatils);
 
	}
	
}

public function get_subscription_status() 
{
 $sql="SELECT * FROM paypal_subscription_details WHERE subscribe_id='I-KFWJLJR365GM'  ORDER BY id DESC LIMIT 1";
 $qry=$this->db->query($sql);
 $res=$qry->result_array();
 if(count($res) > 0 ) 
 {


 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();
foreach ($res as $rs) 
{
 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/billing/subscriptions/'.$rs['subscribe_id']);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
 //curl_setopt($ch, CURLOPT_POST, 1);
 $headers = array();
 //$headers[] = 'Accept: application/json';
  $headers[] = 'Content-Type: application/json';
 $headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
 //$headers[] = 'PayPal-Request-Id : '. $req_id;
 //$headers[] = 'Prefer: return=representation';

 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 print_r($ch);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$sub_deatils = json_decode($result);
//    print_r($sub_deatils);
$sql="UPDATE paypal_subscription_details SET status='".$sub_deatils->status."' WHERE subscribe_id='".$rs['subscribe_id']."'";
$this->db->query($sql);
  }	
 }	
}


public function capture_subscription_values() 
{
 $sql="SELECT * FROM paypal_subscription_details WHERE subscribe_id='I-NBP9EMXDYVEE'  ORDER BY id DESC LIMIT 1";
 $qry=$this->db->query($sql);
 $res=$qry->result_array();
 if(count($res) > 0 ) 
 {


 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();
foreach ($res as $rs) 
{
 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/billing/subscriptions/I-NBP9EMXDYVEE/capture');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
 //curl_setopt($ch, CURLOPT_POST, 1);
 $headers = array();
 //$headers[] = 'Accept: application/json';
  $headers[] = 'Content-Type: application/json';
 $headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
 //$headers[] = 'PayPal-Request-Id : '. $req_id;
 //$headers[] = 'Prefer: return=representation';

 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//print_r($ch);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
 print_r($result);
$sub_deatils = json_decode($result);
    print_r($sub_deatils);
//$sql="UPDATE paypal_subscription_details SET status='".$sub_deatils->status."' WHERE subscribe_id='".$rs['subscribe_id']."'";
//$this->db->query($sql);
  }	
 }	
}


public function get_active_subscription_status() 
{
 $sql="SELECT * FROM paypal_subscription_details WHERE status ='ACTIVE'  ORDER BY id DESC LIMIT 1";
 $qry=$this->db->query($sql);
 $res=$qry->result_array();
 if(count($res) > 0 ) 
 {


 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();
foreach ($res as $rs) 
{
 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/billing/subscriptions/'.$rs['subscribe_id']);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
 //curl_setopt($ch, CURLOPT_POST, 1);
 $headers = array();
 //$headers[] = 'Accept: application/json';
  $headers[] = 'Content-Type: application/json';
 $headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
 //$headers[] = 'PayPal-Request-Id : '. $req_id;
 //$headers[] = 'Prefer: return=representation';

 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 print_r($ch);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$sub_deatils = json_decode($result);
 print_r($sub_deatils);
//$sql="UPDATE paypal_subscription_details SET status='".$sub_deatils->status."' WHERE subscribe_id='".$rs['subscribe_id']."'";
//$this->db->query($sql);
  }	
 }	
}


 public function create_webhook()
 {

 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();

$post_data='{
  "url": "https://featherpet.com/feedback_email_system/paypal_live/get_webhook_data/",
  "event_types": [
    {
      "name": "PAYMENT.SALE.COMPLETED"
    },
	{
      "name": "PAYMENT.SALE.REFUNDED"
    },
	{
      "name": "PAYMENT.SALE.REVERSED"
    },
	{
      "name": "BILLING.SUBSCRIPTION.CREATED"
    },
	{
      "name": "BILLING.SUBSCRIPTION.ACTIVATED"
    },
	{
      "name": "BILLING.SUBSCRIPTION.UPDATED"
    },
	{
      "name": "BILLING.SUBSCRIPTION.EXPIRED"
    },
	{
      "name": "BILLING.SUBSCRIPTION.CANCELLED"
    },
    {
      "name": "BILLING.SUBSCRIPTION.SUSPENDED"
    }
  ]
}';
//96Y39753EP516714M
$ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v1/notifications/webhooks');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
//$headers[] = 'Paypal-Request-Id: PROD-22';
//print_r($headers);
//die();
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$createProduct = json_decode($result);
print_r($createProduct);
 
	
}

public function get_cpatured_payment_details()
{
	
 $sql1="SELECT * FROM paypal_access_token_details WHERE expires_in <> '0' ORDER BY id DESC LIMIT 1";
 $qry1=$this->db->query($sql1);
 $res1=$qry1->result_array();

 $ch = curl_init();curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.paypal.com/v1/payments/capture/7RJ63384RR962474D/');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
 //curl_setopt($ch, CURLOPT_POST, 1);
 $headers = array();
 //$headers[] = 'Accept: application/json';
  $headers[] = 'Content-Type: application/json';
 $headers[] = 'Authorization: Bearer '.$res1[0]['access_token'];
 //$headers[] = 'PayPal-Request-Id : '. $req_id;
 //$headers[] = 'Prefer: return=representation';

 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 print_r($ch);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$sub_deatils = json_decode($result);
 print_r($sub_deatils);

 }

	

 
}

