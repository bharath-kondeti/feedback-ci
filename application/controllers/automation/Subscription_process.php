<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription_process extends CI_Controller 
{
  public function  __construct()
	{
	     parent::__construct();
		 
		
  }



public function update_subscription_status() 
{

$sql="SELECT * FROM stripe_webhook_details_new  WHERE event_type='customer.subscription.updated' AND  id IN (select stripe_sub_id  FROM stripe_subscription)  ORDER BY added_on desc";
$qry=$this->db->query($sql);
$res=$qry->result_array();

if(count($res) > 0 ) 
{
	
	foreach ($res as $rs) 
	{
	
    $up_sub="UPDATE stripe_subscription SET sub_status='".$rs['status']."' WHERE  stripe_sub_id='".$rs['stripe_sub_id']."'";
    $this->db->query($sql);	
		
	}
	
}


public function insert_payment_details() 
{
$date=date('Y-m-d H:i:s',strtotime('-10 MINUTES'));
$sql="SELECT * FROM stripe_webhook_details as a inner join stripe_subscription ON a.customer_id=b.customer_id WHERE event_type='charge.succeded' AND added_on > '".$data."' ORDER BY added_on desc ";
$qry=$this->db->query($sql);
$res=$qry->result_array();

if(count($res) > 0 ) 
{
	
	foreach ($res as $rs) 
	{
	
     $up_sub="INSERT IGNORE INTO payment_details(ref_id,amt,paid_by,is_debit_credit) VALUES(".$this->db->escape($rs['id']).",".$this->db->escape($rs['id']).",".$this->db->escape($rs['added_by']).",'1')";
	 $this->db->query($up_sub);
		
	}
	
}

}


  
}