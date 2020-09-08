<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_api extends CI_Controller 
{
  public function  __construct()
	{
	     parent::__construct();
       $this->load->model('mws/process_product_api','product_api');
  }

public function product_match($store_id='')
  {
    $users=$this->product_api->get_store_info($store_id);
    if(count($users) > 0)
    {
      foreach($users as $usr)
      {
     $this->product_api->set_credentials($usr);
        $prod_list=$this->product_api->get_product_to_match($usr['store_id'],$usr['country_code']);
        if(!empty($prod_list))
         {
           foreach($prod_list as $prd)
           {
              if(!empty($prd['prod_asin']))
              {
                 $res=$this->product_api->fetch_product_details($usr['store_id'],$prd['prod_asin'],$usr['amz_code'],$usr['country_code']);
                 if($res['status_code']==1)
                  {
                    echo  $res['payload']['lm_asin']."\t".$res['payload']['brand']."\t".$res['payload']['rank_catID']."\t".$res['payload']['sales_rank']."\t".$usr['country_code']."\n";
                      $this->db->query("UPDATE customer_product SET prod_brand=".$this->db->escape($res['payload']['brand']).", prod_image=".$this->db->escape($res['payload']['image']).",rank_catID=".$this->db->escape($res['payload']['rank_catID']).", sales_rank=".$this->db->escape($res['payload']['sales_rank'])." WHERE store_id=".$usr['store_id']." AND prod_asin=".$this->db->escape($prd['prod_asin']));
		               
                  }
              }
           }
         }        
      }
    }
  }
 
 public function check_hijack($user_id='')
  {
    $users=$this->product_api->get_store_info($user_id);
    if(count($users) > 0)
    {
      foreach($users as $usr)
      {
        $this->product_api->set_credentials($usr);
        $prod_list=$this->product_api->get_product_to_hijack_check($usr['store_id'],$usr['country_code']);
        if(!empty($prod_list))
        {
           foreach($prod_list as $prd)
           {
              if(!empty($prd['prod_asin']))
              {
                 $res=$this->product_api->check_hijack_details($usr['store_id'],$prd['prod_asin'],$usr['amz_code'],$usr['country_code']);
                 sleep(1);
                 if($res['status_code']==1)
                 {
                     echo $usr['store_id']."\t".$prd['prod_asin']."\t".$res['hijack_count']."\n";
                     $is_alert_sent=$res['hijack_count']==0?0:$prd['is_alert_sent'];
                     $this->db->query("UPDATE customer_product SET hijacked_count=".$this->db->escape($res['hijack_count']).",last_hijack_check=now(),is_alert_sent=".$this->db->escape($is_alert_sent)." WHERE check_hijack=1 AND prod_asin=".$this->db->escape($prd['prod_asin'])." AND prod_country=".$this->db->escape($usr['country_code']));
                 }

              }
           }
           $this->send_alert_mail($usr['store_id']);  
        }
      }
    }
  }
  
  
  

 public function send_alert_mail($user_id)
  {
    $qry=$this->db->query("SELECT * FROM customer_product WHERE store_id={$user_id} AND check_hijack = 1 and hijacked_count>0 and is_alert_sent<>1");
    $ng_feed=$qry->result_array();
    $qr=$this->db->query("SELECT * from scr_user as a  INNER join store_access as b on b.user_id=a.scr_u_id where   store_id=".$user_id." limit 1 ");
    $res=$qr->result_array();
  
     if(count($ng_feed) >0  && count($res) > 0)
       {
      
        $msg="Hi, ".$res[0]['scr_firstname']."<br>";
        $msg.=" You have got some ASIN been hijacked by some other seller, please have a look at it<br>";

        foreach($ng_feed as $fd)
        {
           $msg.="<p><b>Title :".$fd['prod_title']." </b> ";
           $msg.="<p><b>SKU :".$fd['prod_sku']." </b> ";
           $msg.="<p><b>ASIN :".$fd['prod_asin']." </b> Last check On ".$fd['last_hijack_check'];
        }
		
        $alert_type="Hijack Alert";
        $alert_subject="Hijack Alert Notification Mail";
        $alert_msg=$msg;
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
        $this->email->to('yugandhar@lemertech.com');
        $this->email->subject($alert_subject);
        $this->email->message($alert_msg);
       if ($this->email->send()) 
       {
           echo '{"status_code":"1","status_text":"Test mail has been sent"}';
		   
		    $up_sql="UPDATE customer_product SET is_alert_sent=1 where store_id={$user_id} AND prod_asin IN (";
        foreach($ng_feed as $fd)
        {
              $up_sql.=$this->db->escape($fd['prod_asin']).",";
        } 
        $up_sql=rtrim($up_sql,',').")";
        $this->db->query($up_sql);
       }
       else
       {
       echo '{"status_code":"0","status_text":"Not able to send mail "}';
        }
  
		
		 }
}

  
  
}
