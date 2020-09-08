
<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Razorpay_model extends CI_Model
{
	public function  __construct()
	{
	   parent::__construct();

      $this->environment='LIVE';

      $this->set_credentials();
	   
    }
    public function set_credentials()
    {
        $qry=$this->db->query("SELECT * FROM razorpay_config WHERE is_active=1");
        $res=$qry->result_array();
        $this->service_url='https://'.$res[0]['key_id'].":".$res[0]['auth_token']."@".$res[0]['api_url'];
        $this->api_key=$res[0]['key_id'];
        $this->auth_token=$res[0]['auth_token'];
    }
    public function create_new_plan($name,$amount,$period,$interval,$currency='INR')
    {
      echo $this->api_key." ".$this->auth_token;

        $api_call='plans';
        $payload=array('item'=>array('name'=>$name,'amount'=>$amount,'currency'=>$currency),'period'=>$period,'interval'=>$interval);
        $res=$this->send_request($api_call,'true',$payload);
        return json_decode($res);
    }
	
    public function razorpay_subscription_list($plan_id)
    {
        $api_call='subscriptions';
        $payload=array('plan_id'=>$plan_id);
        $res=$this->send_request($api_call,'false',$payload);
        return json_decode($res);
    }
	
	
    public function create_new_subscription($plan_id,$customer_notify=1,$total_count=60)
    {
        $api_call='subscriptions';
        $payload=array('plan_id'=>$plan_id,'customer_notify'=>$customer_notify,'total_count'=>$total_count);
        $res=$this->send_request($api_call,'true',$payload);
		//print_r($res);
        return $res;
    }
	
	 public function cancel_subscription($plan_id,$customer_notify=1,$total_count=60)
    {
        $api_call='subscriptions/'.$plan_id.'/cancel';
		
        //$payload=array('subscription_id'=>$plan_id,'customer_notify'=>$customer_notify,'total_count'=>$total_count);
         $res=$this->send_cancel_request($api_call);
		//print_r($res);
        return $res;
    }


    public function capture_payment($load_amt,$tax_amt,$payment_id,$user_id)
    {
        $api_call='payments/'.$payment_id.'/capture';
        $paisa=((int)$load_amt+(int)$tax_amt)*100;
        $payload=array('amount'=>$paisa);
        
        $in_sql="INSERT IGNORE INTO pay_capture_list (paid_by,pay_id,amount)values(".$user_id.",".$this->db->escape($payment_id).",".$this->db->escape($paisa).")";
        $this->db->query($in_sql);
        $res=$this->send_request($api_call,'true',$payload);
        $resp=json_decode($res);

        
// echo "<br><br><br>".$resp->captured."</br>";
        if(isset($resp->captured) && $resp->captured=='1')
        {
            // echo "<br><br><br><br><br>works<br>";

             $sl=$this->db->query('SELECT * from payment_details WHERE paid_by='.$user_id." AND ref_id=".$this->db->escape($resp->id));
             $rs=$sl->result_array();
             if(!empty($rs))
             {
                $data['status_code']=0;
                $data['status_text']='Not able to capture payment';
                return $data;
             }


             $this->db->trans_start();
             // echo "<br><br><br><br><br>trans_start<br>";
             $p_id=(string)$resp->id;
             $up_sql="UPDATE pay_capture_list SET is_captured=1 WHERE paid_by=".$user_id." AND pay_id=".$this->db->escape($p_id);
             $this->db->query($up_sql);

              $qer=$this->db->query("SELECT * from current_balance where user_id=".$user_id);
              $res1=$qer->result_array(); 
              // print_r($res1);
              $current_amt=!empty($res1)?$res1[0]['current_amt']:0;
              $cur_bal=$load_amt+$current_amt;
              // echo $cur_bal;
              $insert_payment=array('payment_gateway'=>'RAZOR','ref_id'=>$p_id,'comments'=>serialize($resp),'paid_on'=>date('Y-m-d H:i:s'),'amt'=>$load_amt,'gst_tax'=>$tax_amt,'paid_by'=>$user_id,'is_debit_credit'=>1,'cur_bal'=>$cur_bal);

              $this->db->insert('payment_details',$insert_payment);
              $pay_id=$this->db->insert_id();
              $py_sql="INSERT INTO current_balance (user_id,last_pay_id,current_amt,updated_on)values(".$user_id.",".$pay_id.",".$cur_bal.",'".date('Y-m-d H:s:i')."') ON DUPLICATE KEY UPDATE last_pay_id=values(last_pay_id),current_amt=values(current_amt),updated_on=values(updated_on)";
              $this->db->query($py_sql);

      // echo "<br><br><br><br><br>trans_end<br>";       
             $this->db->trans_complete();
             if ($this->db->trans_status() === FALSE)
             {
                // echo "<br><br><br><br><br>trans_false<br>";
                   $data['status_code']=0;
                   $data['status_text']='Not able to capture payment';
             }
             else
             {
                // echo "<br><br><br><br><br>trans_suceess<br>";
                $data['status_code']=1;
                $data['status_text']='Success';
                $data['payment_id']=$resp->id;
                $data['amount']=$resp->amount;
                $data['status']=$resp->status;
                $data['card_id']=$resp->card_id;
                $data['captured']=$resp->captured;
            }     
        }
        else
        {
            $data['status_code']=0;
            $data['status_text']='Not able to capture payment';
        }
        return $data;
    }

    public function capture_subscription($subscriptionId,$payment_id,$r_subscription_id,$razorpay_signature,$user_id)
    {
        $expectedSignature = hash_hmac('sha256', $payment_id . '|' . $subscriptionId, $this->auth_token);

        if ($expectedSignature === $razorpay_signature)
        {
            $plan_id=$this->session->userdata('plan_id');
            // $plan_id='plan_BqybKsLlea56Qf';
            $qry=$this->db->query("SELECT * FROM plan_manager WHERE razorpay_planID=".$this->db->escape($plan_id));
            $pln_info=$qry->result_array();
            $plan_amt=empty($pln_info[0]['plan_amt'])?0:$pln_info[0]['plan_amt'];

            $this->db->trans_start();

            $up_sql="UPDATE razorpay_subscription SET is_captured=1,status='active',razorpay_subscriptionID=".$this->db->escape($r_subscription_id).",razorpay_payment_id=".$this->db->escape($payment_id).",razorpay_signature=".$this->db->escape($razorpay_signature)." WHERE user_id=".$user_id." AND id=".$this->db->escape($subscriptionId);
            $this->db->query($up_sql);
            $qer=$this->db->query("SELECT * from current_balance where user_id=".$user_id);
            $res1=$qer->result_array(); 
            // print_r($res1);
            $current_amt=!empty($res1)?$res1[0]['current_amt']:0;
            $cur_bal=$plan_amt+$current_amt;
            // echo $cur_bal;
            $insert_payment=array('payment_gateway'=>'RAZOR_NEW_SUB','ref_id'=>$payment_id,'comments'=>$r_subscription_id."-".$payment_id,'paid_on'=>date('Y-m-d H:i:s'),'amt'=>$plan_amt,'gst_tax'=>0,'paid_by'=>$user_id,'is_debit_credit'=>1,'cur_bal'=>$cur_bal);

            $this->db->insert('payment_details',$insert_payment);
            $pay_id=$this->db->insert_id();
            $py_sql="INSERT INTO current_balance (user_id,last_pay_id,current_amt,updated_on)values(".$user_id.",".$pay_id.",".$cur_bal.",'".date('Y-m-d H:s:i')."') ON DUPLICATE KEY UPDATE last_pay_id=values(last_pay_id),current_amt=values(current_amt),updated_on=values(updated_on)";
            $this->db->query($py_sql);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE)
            {
                   $data['status_code']=0;
                   $data['status_text']='Not able to capture payment';
            }
            else
            {
                $data['status_code']=1;
                $data['status_text']='Success';
                $data['payment_id']=$payment_id;
                $data['amount']=$plan_amt;
				$this->db->query("update scr_user SET subscription_status='1' WHERE scr_u_id=".$this->user_id);

            }     
        }
        else
        {
          $data['status_code']=0;
          $data['status_text']='Not able to capture payment';
        }
        
        return $data;
    }

    public function send_request($api_call,$post_req='false',$payload='')
      {
        $ch = curl_init();
        $url=$this->service_url.$api_call;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        if($post_req=='true' && !empty($payload))
        {

          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));  
        }
        
        $response = curl_exec($ch);
        // print_r($response);
        curl_close($ch); 
        return $response;
      }
	  
	  
	  public function send_cancel_request($api_call)
      {
        $ch = curl_init();
        $url=$this->service_url.$api_call;
		//print_r($url);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        $response = curl_exec($ch);
        // print_r($response);
        curl_close($ch); 
        return $response;
      }




   

}