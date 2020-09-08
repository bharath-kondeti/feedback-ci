<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign_mail_transport extends CI_Controller {
  public function  __construct()
  {
     parent::__construct();
	 
        $this->load->library('parser');
        $this->parser->set_delimiters('{{','}}');
		$log_file=FCPATH.DIRECTORY_SEPARATOR."log_data".DIRECTORY_SEPARATOR."".date("M_Y")."_campaign_mail_log.txt";
        $this->log_handle=fopen($log_file, "a");
		

  
  }

  public function agent()
  {
    $savestring="[".date("Y-m-d H:i:s")."] [LOG] Campaign transport process started: ".PHP_EOL;
    fwrite($this->log_handle, $savestring);
    $now=date("Y-m-d H:i:00");
    $now_before=date("Y-m-d H:i:00",strtotime("-20 minutes"));
    $sql="SELECT store_access.user_id,tnx.store_id,amz_domain,amz_code as marketplaceID,vendor_name,company_name,seller_id,CONCAT(\"<a href='http://www.\",amz_domain,\"/s?ie=UTF8&me=\",seller_id,\"'>Store Front URL</a>\") AS store_url,
  CONCAT(\"<a href='https://www.\",amz_domain,\"/gp/feedback/leave-consolidated-feedback.html?ie=UTF8&isCBA=&marketplaceID=\",amz_code,\"&mode=eligibility&orderID=\",camp_order_no,\"&ref_=fb_multi_cfb&'>Leave us feedback</a>\") AS feedback_url,
  CONCAT(\"<a href='https://www.\",amz_domain,\"/review/create-review/ref=oss_rev?_encoding=UTF8&asin=\",asin,\"'>Leave us review</a>\") AS review_url,
	CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:14px' href='https://www.\",amz_domain,\"/dp/\",asin,\"'>itm_title</a>\") AS product_title_with_link,camp_id,camp_order_no,is_sent,trigger_on,dns_status,template_content,cpgn_attachment,subject, 
itm_title AS product_name,camp_order_no AS order_number,DATE_FORMAT(purchase_date,'%Y-%m-%d')  AS order_date,
IF(buyer_name='','Customer',buyer_name) AS customer_fullname,IF(buyer_name='','Customer',SUBSTRING_INDEX(buyer_name, ' ', 1)) AS customer_firstname,
SUBSTRING_INDEX(buyer_name, ' ', 1) AS customer_lastname,buyer_email,asin,itm_title,prod_image
FROM campaign_order_list 
INNER JOIN campaign_manager AS mgr ON camp_id=cpgn_id AND is_active=1 AND is_deleted=0   AND dns_status=0 AND  is_sent=0 AND trigger_on='".$now."'
INNER JOIN email_template ON template_id=cpgn_templateID
INNER JOIN amz_order_info AS tnx ON order_no=camp_order_no AND seller_sku=camp_sku AND tnx.store_id=mgr.created_by and buyer_email <>''
INNER JOIN customer_product ON tnx.seller_sku=prod_sku AND customer_product.store_id=mgr.created_by  AND prod_country=sales_country
INNER JOIN amazon_profile ON amazon_profile.store_id=mgr.created_by 
INNER JOIN store_access ON store_access.store_id=amazon_profile.store_id 
INNER JOIN supported_country ON country_code=sales_country
WHERE camp_order_no NOT IN (SELECT order_id FROM amz_feedback_data WHERE fbk_rating IN (1,2))
AND ((order_tfmstatus!='Rejected by Buyer' AND order_tfmstatus!='Returned to Seller' AND order_tfmstatus!='Returning to Seller'))";
die($sql);


    $query=$this->db->query($sql);
    $res=$query->result_array();
    $five_star_img=base_url()."asset/img/fivestar_icon.png";
    $web_beacon=base_url()."asset/img/web_beacon.jpg";	
    if(count($res) > 0)
    {
      $savestring="[".date("Y-m-d H:i:s")."] [LOG] There are ".count($res)." mail need to be sent: ".PHP_EOL;
      fwrite($this->log_handle, $savestring);
        foreach($res as $rs)
        {
              $plan_flag=$this->get_plan_info($rs['user_id']);
              $rs['review_url_with_product_img']='<br><br><table class="divProductReviewTable" cellpadding="4"><tbody><tr><td width="30%"><a href="https://www.'.$rs['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$rs['asin'].'" target="_blank" title="Leave Product Review"><img src="'.$rs['prod_image'].'" alt="'.$rs['asin'].'"></a></td><td width="70%">'.$rs['itm_title'].'<br>&nbsp;<br><a href="https://www.'.$rs['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$rs['asin'].'" target="_blank" title="Leave Product Review">Leave Product Review</a><br><a href="https://www.'.$rs['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$rs['asin'].'" target="_blank" title="Leave Product Review"><img src="'.$five_star_img.'"></a></td></tr></tbody></table><br><br>';
						 
						
		 
              $dt=$rs['template_content'];
              $processed_to_sent=1;
              
			 
	
            $msg=$this->parser->parse_string($dt,$rs,TRUE);
			//print_r($msg);
			//die();
			
            echo $rs['camp_id']."\t".$rs['camp_order_no']."\t";
            if($processed_to_sent==1)
            {
              if($plan_flag['sent_from_mail_credit'] == 1 || $plan_flag['sent_from_addon'] ==1 )
              $this->send_mail($rs['buyer_email'],$rs['subject'],$msg,$rs['camp_id'],$rs['camp_order_no']);
              else
              {
                $savestring="[".date("Y-m-d H:i:s")."] [LOG] There is no mail credit availabel for : "."[".$rs['store_id']."]".PHP_EOL;
                $this->db->query("UPDATE campaign_order_list SET status_msg='NO_VALID_PLAN_AVAILABLE' WHERE camp_id='".$rs['camp_id']."' AND camp_order_no='".$rs['camp_order_no']."'");
                fwrite($this->log_handle, $savestring);
              }
              if($plan_flag['sent_from_addon']==1)
              {
                $this->db->query("UPDATE addon_status SET email_remaining=email_remaining-1 where user_id=".$rs['store_id']);
              }
            }
            
        }
     }
     else
     {
      $savestring="[".date("Y-m-d H:i:s")."] [LOG] There is no mail pending to be sent: ".PHP_EOL;
      fwrite($this->log_handle, $savestring);
     }
     $savestring="[".date("Y-m-d H:i:s")."] [LOG] Campaign transport process completed: ".PHP_EOL;
     fwrite($this->log_handle, $savestring);   
   //  $this->re_send();
     $savestring="___________________________________________________________________________________________".PHP_EOL;
     fwrite($this->log_handle, $savestring);   
     fclose($this->log_handle); 
  }


  public function get_plan_info($user_id,$iteration=0)
  {
    $plan['sent_from_mail_credit']=0;
    $plan['sent_from_addon']=0;
    
    $sq_qry=$this->db->query("SELECT * FROM current_plan_info WHERE subscribed_by=".$user_id);
    $result=$sq_qry->result_array();
    if(count($result) > 0)
    {
      $res=$result[0];
      $current_date = new DateTime(date("Y-m-d"));
      $plan_valid    = new DateTime($res['valid_till']);
      if(($current_date <= $plan_valid ) && ((int)$res['sent_count'] < (int)$res['email_allowed']))
      {
          $plan['sent_from_mail_credit']=1;
      }
      elseif(($current_date < $plan_valid ) && ((int)$res['sent_count'] >= (int)$res['email_allowed']) && ((int)$res['addon_email_remaining'] > 0))
      {
         $plan['sent_from_mail_credit']=0;
         $plan['sent_from_addon']=1;
      }
    }
     return $plan;

  }

  public function send_mail($customer_email='prabhubreaker@gmail.com',$subject='',$message='',$campaign_id,$order_no)
  {
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
     $this->email->to($customer_email);
	 //$this->email->cc('yugandhar@lemertech.com');
     $this->email->subject($subject);
        
     $this->email->message($message);
	
     if ($this->email->send())
     {
        $uql="UPDATE campaign_order_list SET status_msg='NO_ISSUE',is_sent=1,sent_on='".date("Y-m-d H:i:s")."' where camp_id=".$this->db->escape($campaign_id)." AND camp_order_no=".$this->db->escape($order_no);
        //echo $uql;
        $this->db->query($uql);
	  $savestring="[".date("Y-m-d H:i:s")."] [LOG] Mail sent : [".$campaign_id."]-[".$order_no."]"."[".$uql."]".PHP_EOL;
        fwrite($this->log_handle, $savestring);
        echo "sent"."\n";
     }
     else
     {
        $uql="UPDATE campaign_order_list SET status_msg='SMTP_ERROR' where camp_id=".$this->db->escape($campaign_id)." AND camp_order_no=".$this->db->escape($order_no);
        $this->db->query($uql);
        $savestring="[".date("Y-m-d H:i:s")."] [LOG] Not able to  sent  mail: [".$campaign_id."]-[".$order_no."]".PHP_EOL;
        fwrite($this->log_handle, $savestring);
        $savestring="[".date("Y-m-d H:i:s")."] [LOG] Subject: [".$subject."][".$message."]".PHP_EOL;
        fwrite($this->log_handle, $savestring);
     
        $savestring=$this->email->print_debugger();
        fwrite($this->log_handle, $savestring);
        echo "Not sent"."\n";
     }
  }
  
  
}
