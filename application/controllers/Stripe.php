<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends CI_Controller {
public function  __construct()
    {
     parent::__construct();
	  $log_file=FCPATH.DIRECTORY_SEPARATOR."log_data".DIRECTORY_SEPARATOR."stripe_details_".date('Y_m_d_H').".txt";
	  
	  $this->log_handle=fopen($log_file, "a");
	  chmod($log_file, 0777); 
	  
     
    }
	
public function index() 
{
  $payload =file_get_contents('php://input');
  //fwrite($this->log_handle, $payload);        
  //$event = json_decode($payload, true);
  //print_r($event);
    fwrite($this->log_handle, $payload); 
  $subscription_deatils = json_decode($payload, true);

if($subscription_deatils['type']=='charge.succeeded') 
	{
		$sql="INSERT IGNORE INTO  stripe_webhook_details(event_id,event_type,id,amount,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['amount']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}
if($subscription_deatils['type']=='charge.failed') 
	{
		$sql="INSERT IGNORE INTO  stripe_webhook_details(event_id,event_type,id,amount,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['amount']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}	
	
if($subscription_deatils['type']=='customer.subscription.updated') 
	{
		print_r($subscription_deatils);
		$sql="INSERT IGNORE INTO  stripe_webhook_details_new(event_id,event_type,id,status,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['status']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['data']['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}	
	
if($subscription_deatils['type']=='customer.subscription.created') 
	{
		print_r($subscription_deatils);
		$sql="INSERT IGNORE INTO  stripe_webhook_details_new(event_id,event_type,id,status,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['status']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['data']['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}

if($subscription_deatils['type']=='customer.subscription.deleted') 
	{
		print_r($subscription_deatils);
		$sql="INSERT IGNORE INTO  stripe_webhook_details_new(event_id,event_type,id,status,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['status']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['data']['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}
 //echo"\n";echo"\n";echo"\n";echo"\n";echo"\n";echo"\n";
}

public function webhook_data_parsing() 
 {
	 
	$json='{
  "id": "evt_1GIqgtF5r2G7KAIlGOKx2MEh",
  "object": "event",
  "api_version": "2019-12-03",
  "created": 1583303207,
  "data": {
    "object": {
      "id": "sub_GqXD930cCjoNdI",
      "object": "subscription",
      "application_fee_percent": null,
      "billing_cycle_anchor": 1583303207,
      "billing_thresholds": null,
      "cancel_at": null,
      "cancel_at_period_end": false,
      "canceled_at": null,
      "collection_method": "charge_automatically",
      "created": 1583301102,
      "current_period_end": 1585981607,
      "current_period_start": 1583303207,
      "customer": "cus_GqXDDiCgCzs2fL",
      "days_until_due": null,
      "default_payment_method": null,
      "default_source": null,
      "default_tax_rates": [

      ],
      "discount": null,
      "ended_at": null,
      "items": {
        "object": "list",
        "data": [
          {
            "id": "si_GqXDqdau4OKRQt",
            "object": "subscription_item",
            "billing_thresholds": null,
            "created": 1583301103,
            "metadata": {
            },
            "plan": {
              "id": "plan_GoSnMNFKARZefM",
              "object": "plan",
              "active": true,
              "aggregate_usage": null,
              "amount": 500,
              "amount_decimal": "500",
              "billing_scheme": "per_unit",
              "created": 1582823396,
              "currency": "inr",
              "interval": "month",
              "interval_count": 1,
              "livemode": false,
              "metadata": {
              },
              "nickname": "Micro",
              "product": "prod_GoSmamTZv3MUld",
              "tiers": null,
              "tiers_mode": null,
              "transform_usage": null,
              "trial_period_days": null,
              "usage_type": "licensed"
            },
            "quantity": 1,
            "subscription": "sub_GqXD930cCjoNdI",
            "tax_rates": [

            ]
          }
        ],
        "has_more": false,
        "total_count": 1,
        "url": "/v1/subscription_items?subscription=sub_GqXD930cCjoNdI"
      },
      "latest_invoice": "in_1GIqgtF5r2G7KAIlTy5oDOxa",
      "livemode": false,
      "metadata": {
      },
      "next_pending_invoice_item_invoice": null,
      "pending_invoice_item_interval": null,
      "pending_setup_intent": null,
      "pending_update": null,
      "plan": {
        "id": "plan_GoSnMNFKARZefM",
        "object": "plan",
        "active": true,
        "aggregate_usage": null,
        "amount": 500,
        "amount_decimal": "500",
        "billing_scheme": "per_unit",
        "created": 1582823396,
        "currency": "inr",
        "interval": "month",
        "interval_count": 1,
        "livemode": false,
        "metadata": {
        },
        "nickname": "Micro",
        "product": "prod_GoSmamTZv3MUld",
        "tiers": null,
        "tiers_mode": null,
        "transform_usage": null,
        "trial_period_days": null,
        "usage_type": "licensed"
      },
      "quantity": 1,
      "schedule": null,
      "start_date": 1583301102,
      "status": "active",
      "tax_percent": null,
      "trial_end": 1583303206,
      "trial_start": 1583301102
    },
    "previous_attributes": {
      "billing_cycle_anchor": 1585889502,
      "current_period_end": 1585889502,
      "current_period_start": 1583301102,
      "latest_invoice": "in_1GIq8wF5r2G7KAIlSwXpVgnE",
      "status": "trialing",
      "trial_end": 1585889502
    }
  },
  "livemode": false,
  "pending_webhooks": 1,
  "request": {
    "id": "req_wgja0MWGKwb938",
    "idempotency_key": null
  },
  "type": "customer.subscription.updated"
}';
$subscription_deatils = json_decode($json, true);

//print_r($subscription_deatils);

if($subscription_deatils['type']=='charge.succeeded') 
	{
		$sql="INSERT IGNORE INTO  stripe_webhook_details(event_id,event_type,id,amount,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['amount']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}
	
if($subscription_deatils['type']=='customer.subscription.updated') 
	{
		print_r($subscription_deatils);
		$sql="INSERT IGNORE INTO  stripe_webhook_details_new(event_id,event_type,id,status,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['status']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['data']['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}	
	
if($subscription_deatils['type']=='customer.subscription.created') 
	{
		print_r($subscription_deatils);
		$sql="INSERT IGNORE INTO  stripe_webhook_details_new(event_id,event_type,id,status,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['status']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['data']['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}

if($subscription_deatils['type']=='customer.subscription.deleted') 
	{
		print_r($subscription_deatils);
		$sql="INSERT IGNORE INTO  stripe_webhook_details_new(event_id,event_type,id,status,object,customer_id)
		      VALUES(".$this->db->escape($subscription_deatils['id']).",".$this->db->escape($subscription_deatils['type']).",".$this->db->escape($subscription_deatils['data']['object']['id']).",".$this->db->escape($subscription_deatils['data']['object']['status']).",".$this->db->escape($subscription_deatils['data']['object']['object']).",".$this->db->escape($subscription_deatils['data']['object']['customer']).")";
			  print_r($sql);
		$this->db->query($sql);
        		
		
	}	
	
	
 }
 
	
}
