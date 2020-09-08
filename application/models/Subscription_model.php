<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscription_model extends CI_Model
{
  	public function  __construct()
  	{
  	   parent::__construct();
    }

    public function get_plan_info_by_id($plan_id=0)
    {
    	  $qry=$this->db->query("SELECT * from plan_manager where plan_id=".$this->db->escape($plan_id));
        $res=$qry->result_array();
        return isset($res[0])?$res[0]:[];
    }

    public function get_current_balance($user_id)
    {
    	$qer=$this->db->query("SELECT * from current_balance where user_id=".$user_id);
        $res=$qer->result_array();
       	return isset($res[0])?$res[0]:[];
    }
    public function get_active_subscription($user_id)
    {
       $sb_qr=$this->db->query("SELECT COUNT(*) AS sub_cnt FROM plan_subscriber WHERE subscribed_by=".$user_id." AND valid_till >= CURDATE()");
       $sb_res=$sb_qr->result_array();
       return !empty($sb_res)?$sb_res[0]['sub_cnt']:0;
    }
    public function get_total_subscription($user_id)
    {
       $sb_qr=$this->db->query("SELECT COUNT(*) AS sub_cnt FROM plan_subscriber WHERE subscribed_by=".$user_id);
       $sb_res=$sb_qr->result_array();
       return !empty($sb_res)?$sb_res[0]['sub_cnt']:0;	
    }
          

    public function create_trial_plan($user_id,$plan_id=0,$timestamp,$plan_start_date)
    {
        $res=$this->get_plan_info_by_id($plan_id);
        // $plan_amt=isset($res[0]['plan_amt'])?$res[0]['plan_amt']:0;
        $plan_amt=0;
        $vali_till_dt=date('Y-m-d H:i:s', strtotime('+1 month',strtotime(date($plan_start_date))));
        $is_credit=0;
        $pay_id=$this->update_user_balance($user_id,$plan_amt,$timestamp,$is_credit);
        $insert_plan=array('plan_id'=>$plan_id,'payment_id'=>$pay_id,'subscribed_by'=>$user_id,'subscribed_on'=>$timestamp,
                            'updated_on'=>$plan_start_date,'valid_till'=>$vali_till_dt);
        $this->db->insert('plan_subscriber',$insert_plan);
    }
    public function create_plan($user_id,$plan_id=0,$timestamp,$plan_start_date)
    {
    	  $res=$this->get_plan_info_by_id($plan_id);
        $plan_amt=isset($res['plan_amt'])?$res['plan_amt']:0;
    	  $vali_till_dt=date('Y-m-d 00:00:00', strtotime('+1 month',strtotime(date($plan_start_date))));
    	  $is_credit=0;
        $pay_id=$this->update_user_balance($user_id,$plan_amt,$timestamp,$is_credit);
        $insert_plan=array('plan_id'=>$plan_id,'payment_id'=>$pay_id,'subscribed_by'=>$user_id,'subscribed_on'=>$timestamp,
                            'updated_on'=>$plan_start_date,'valid_till'=>$vali_till_dt);
        $this->db->insert('plan_subscriber',$insert_plan);
    }

    public function insert_payment_details($gateway,$timestamp,$amt,$user_id,$cur_bal,$is_credit=0)
    {
    	  $insert_payment=array('payment_gateway'=>$gateway,'paid_on'=>$timestamp,'amt'=>$amt,'paid_by'=>$user_id,'cur_bal'=>$cur_bal,'is_debit_credit'=>$is_credit);
          $this->db->insert('payment_details',$insert_payment);
          $pay_id=$this->db->insert_id();
          return  $pay_id;
    }


    public function update_user_balance($user_id,$amount=0,$timestamp,$is_credit=0)
    {
          $res=$this->get_current_balance($user_id);
          $current_amt=!empty($res)?$res['current_amt']:0;
          if($is_credit==0)
          {
          	$cur_bal=$current_amt-$amount;
          }
          else
          {
          	$cur_bal=$amount+$current_amt;	
          }
          $pay_id=$this->insert_payment_details("Auto",$timestamp,$amount,$user_id,$cur_bal,$is_credit);
          $py_sql="INSERT INTO current_balance (user_id,last_pay_id,current_amt,updated_on)values(".$user_id.",".$pay_id.",".$cur_bal.",'".$timestamp."') ON DUPLICATE KEY UPDATE last_pay_id=values(last_pay_id),current_amt=values(current_amt),updated_on=values(updated_on)";
          $this->db->query($py_sql);
		  //$sql="UPDATE scr_user SET plan_expired='0' WHERE scr_u_id='".$user_id."'";
		  //$this->db->query($sql);
          return $pay_id;
    }
 
}