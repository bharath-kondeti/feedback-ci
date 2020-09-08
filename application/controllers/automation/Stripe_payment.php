<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripe_payment extends CI_Controller 
{
  public function  __construct()
	{
	     parent::__construct();
		 
		 $this->load->helper('url');
         $this->load->library('stripe_lib');
        
  }




public function create_product() 
{
	
$configProduct = array(
            'product_name' => 'Monthly membership base fee Plan',
            'product_type' => 'service'
        );
$result = $this->stripe_lib->createSubscriptionProduct($configProduct);
print_r($result);
//prod_GoSmamTZv3MUld
$prod_id = $result->id;	
echo "\n";
//$configPlan = array(
//			'product_id' => $prod_id,
//			'plan_nickname' => 'Extra Large',
//			'plan_interval' => 'month', // day, week, month, and year
//			'plan_interval_count' => '1', // 1 Month for example
//			'amount_cent' => '5000', // => 2.99 in centesimi
//			'currency' => 'INR' // currency iso code
//		);
//		$result = $this->stripe_lib->createPlanWithProductID($configPlan);
//		print_r($result);
//		$idPlan = $result->id;
//		print_r($idPlan);
//}
//prod_GQgw4Cxee8IBKn  ---   plan_GQgwkKpFjS8dHE  --- Micro
//prod_GQgxlrqSx1GbAz  ---   plan_GQgxsUY26saoJe  --- Small
//prod_GQhYIshi3bTdvh  ---   plan_GQhYwPvmtsabCK  --- Small
//prod_GQhYGW70UJKibW  ---   plan_GQhYbHqyIVzPFm  --- Small

}

public function create_plan_with_product() 
{
$prod_id ='prod_Gr63GIxaTrLu0b';		
$configPlan = array(
            'product_id' => $prod_id,
            'plan_nickname' => 'Small', // IDPLAN ABO
            'plan_interval' => 'month', // day, week, month, and year
            'plan_interval_count' => '1', // 1 Month for example
            'amount_cent' => '200', // => 2.99 in centesimi
            'currency' => 'EUR' // currency iso code
        );
        $result = $this->stripe_lib->createPlanWithProductID($configPlan);
		print_r($result);
		
        //$idPlan = $result->id;
}

public function get_all_plans() 
{
//$prod_id ='prod_GQQ5jqY5kTQOl3';		
$configPlan = array(
            //'product_id' => $prod_id,
            //'plan_nickname' => '', // IDPLAN ABO
            'limit' => '10', // day, week, month, and year
            //'plan_interval_count' => '', // 1 Month for example
            //'amount_cent' => '500', // => 2.99 in centesimi
            //'currency' => 'INR' // currency iso code
        );
        $result = $this->stripe_lib->getallPlan($configPlan);
		print_r($result);
		
        //$idPlan = $result->id;
}

public function list_product() 
{
	
$configProduct = array(
            'limit' => '10'
        );
$result = $this->stripe_lib->getSubscriptionProduct($configProduct);
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}

public function list_subscriptions() 
{
	
$configList = array(
            'limit' => '10'
        );
$result = $this->stripe_lib->getSubscriptionList($configList);
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}

public function create_webhook() 
{
	
$configList = array(
               'url' => 'https://featherpet.com/feedback_email_system/Stripe_live/index',
 'enabled_events' => [
 'charge.failed',
 'charge.succeeded',
 'customer.subscription.created',
 'customer.subscription.updated',
 'customer.subscription.deleted',
  ]
        );
$result = $this->stripe_lib->createWebHook($configList);
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}
  
  
  public function delete_webhook() 
{

$result = $this->stripe_lib->deleteWebhook('we_1GJNx0F5r2G7KAIlEbQPkBuR');
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}

public function list_webhooks() 
{
	
$configList = array(
            'limit' => '10'
        );
$result = $this->stripe_lib->getWebhookList($configList);
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}

public function cancel_subscription() 
{

$result = $this->stripe_lib->cancelSubscriptionWithID('sub_GqZj49y1vOzG4p');
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}

public function update() 
{
	
$configList = array(
            'limit' => '10'
        );
$result = $this->stripe_lib->updateSubscription($configList);
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}


public function create_charge() 
{
	
$configList = array(
            'limit' => '10'
        );
$result = $this->stripe_lib->createCharge($configList);
print_r($result);
//prod_GQQ5jqY5kTQOl3
//$prod_id = $result->id;	
}

  
}