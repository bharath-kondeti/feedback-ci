<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Campaign_model extends CI_Model
{
  public function  __construct()
  {
   		parent::__construct();
      $user=$this->session->userdata('user_logged_in');
      $this->user_id=$user['id'];
	  $store=$this->session->userdata('store_info');
     $this->store_id=$store['store_id'];
  }
  public function get_campaign_orders($context,$orderby='camp_id',$direction,$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         $tf_status='';
	     if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            $srterm=urldecode($str[0]->searchtext);

         }

		 $from_date="";
         $to_date=date('Y-m-d');
         if(isset($str[2]->from_date))
         {
            $test_arr  = explode('-', $str[2]->from_date);
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0]))
            {
                $from_date=$str[2]->from_date;
            }
         }
         if(isset($str[3]->to_date))
         {
            $test_arr  = explode('-', $str[3]->to_date);
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0]))
            {
                $to_date=$str[3]->to_date;
            }
         }

         // print_r($str);
         // die();


         $sqlcount="SELECT count(*) as total from campaign_order_list
         INNER JOIN campaign_manager on created_by=".$this->store_id." AND cpgn_id=camp_id and is_deleted=0 and is_active=1 ";

          $sqlquery= "SELECT  trigger_on,cpgn_name as campaign_name,camp_id as campaign_id,dns_reason,is_sent,is_read,is_clicked,dns_status,dns_reason,seller_sku,asin,itm_title,
         order_no,DATE_FORMAT(purchase_date,'%Y-%m-%d') as purchase_date,DATE_FORMAT(calc_shipdate,'%Y-%m-%d') as calc_shipdate,DATE_FORMAT(calc_deliverydate,'%Y-%m-%d') as lst_delive_date,buyer_name,fbk_rating,fbk_comment,
                      itm_qty AS no_of_item,order_status,order_tfmstatus as tfm_status,is_sent,concat('Normal') as type
                      FROM  campaign_order_list
                      INNER JOIN campaign_manager on created_by=".$this->store_id." AND cpgn_id=camp_id and is_deleted=0  and is_active=1 ";
         if($context=='sent_mail' && (empty($srterm)))
         {

          $sqlquery.=" AND is_sent=1  AND trigger_on > now() - INTERVAL 1 MONTH ";
          $sqlcount.=" AND is_sent=1  AND trigger_on > now() - INTERVAL 1 MONTH ";
          // $sqlquery.=" AND trigger_on < now()  ";

         }
         elseif($context=='schduled_mail' && (empty($srterm)))
         {
          $sqlquery.=" AND is_sent=0 AND dns_status= 0 and trigger_on > now() ";
          $sqlcount.=" AND is_sent=0 AND dns_status = 0 and trigger_on > now() ";
         }
         // elseif($context=='schduled_mail')
         // {
         //  $sqlquery.=" AND is_sent=0 AND trigger_on < now() + INTERVAL 1 MONTH ";
         //  $sqlcount.=" AND is_sent=0 AND trigger_on < now() + INTERVAL 1 MONTH ";
         // }

         $sqlquery.=" INNER join campaign_asin on cmp_id=cpgn_id
                    INNER JOIN amz_order_info AS tx ON order_no=camp_order_no and store_id=".$this->store_id." AND tx.asin=cmp_asin AND tx.seller_sku=cmp_sku  ";

         $sqlcount.=" INNER join campaign_asin on cmp_id=cpgn_id
                    INNER JOIN amz_order_info AS tx ON order_no=camp_order_no and store_id=".$this->store_id." AND tx.asin=cmp_asin AND tx.seller_sku=cmp_sku  ";

         if($context=='blocked_mail')
         {
          $sqlquery.=" AND ((dns_status=1 AND is_sent=0) OR order_status <> 'Shipped')  AND trigger_on > now() - INTERVAL 1 MONTH ";
          $sqlcount.=" AND ((dns_status=1 AND is_sent=0) OR order_status <> 'Shipped')  AND trigger_on > now() - INTERVAL 1 MONTH ";
         }




        if(isset($str[1]->camp_id) && $str[1]->camp_id > 0  )
        {
          $sqlquery.= " AND camp_id = ".$str[1]->camp_id;
          $sqlcount.= " AND camp_id = ".$str[1]->camp_id;
        }
		if(isset($str[5]->tfm_status))
          {
            if($str[5]->tfm_status == 'SNT')
			{
				$sqlquery.=" AND is_sent=1 ";
				$sqlcount.=" AND is_sent=1 ";
			}
			elseif($str[5]->tfm_status == 'NST')
			{
				$sqlquery.=" AND is_sent=0 ";
				$sqlcount.=" AND is_sent=0 ";
			}
		  }

        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (tx.seller_sku LIKE '%".$srterm."%' OR order_no LIKE '%".$srterm."%' OR buyer_name LIKE '%".$srterm."%' OR calc_shipdate LIKE '%".$srterm."%' OR calc_deliverydate LIKE '%".$srterm."%' OR purchase_date LIKE '%".$srterm."%' ) ";
          $sqlcount.=" AND (tx.seller_sku LIKE '%".$srterm."%' OR order_no LIKE '%".$srterm."%' OR buyer_name LIKE '%".$srterm."%' OR calc_shipdate LIKE '%".$srterm."%' OR calc_deliverydate LIKE '%".$srterm."%' OR purchase_date LIKE '%".$srterm."%' ) ";
        }
        if(!empty($from_date))
        {
          $from_date=$from_date." 00:00:00";
          $to_date=$to_date." 23:59:59";

          $sqlquery.=" AND  purchase_date >= ".$this->db->escape($from_date)." AND purchase_date <=".$this->db->escape($to_date);
          $sqlcount.=" AND  purchase_date >= ".$this->db->escape($from_date)." AND purchase_date <=".$this->db->escape($to_date);
        }
        $sqlquery.=" LEFT JOIN amz_feedback_data ON order_id=camp_order_no and fbk_for=".$this->store_id;

        $sqlquery.=" GROUP BY camp_id,camp_order_no,cmp_sku,cmp_asin ORDER BY ";
        if($context=='sent_mail' || $context=='blocked_mail')
         {
          $sqlquery.=" trigger_on DESC  ";
         }
        if($context=='schduled_mail')
         {
          $sqlquery.=" trigger_on ASC  ";
         }

        $sqlquery.=" LIMIT ".$offet.",".$limit;

        $query=$this->db->query($sqlquery) ;
        $data= $query->result_array();
        $countquery=$this->db->query($sqlcount);
        $numrows= $countquery->result_array();
		$total=$numrows[0]['total'];

        if(count($data) > 0)
        {
        $result_set=array('status_code'=>'1','status_text'=>'successfully reterived','total' =>$total, 'datalist' => $data ,'searchterm' => $searchterm );
        }
        else
        {
         $result_set=array('status_code'=>'0','status_text'=>'No data found');
        }
        return $result_set;
    }

  public function get_campaign_list($frm_date='',$to_date='',$cmp_status='',$sort_order='cpgn_id',$dir='ASC')
  {
	  //print_r($sort);
	  $sql="SELECT cpgn_id as campaign_id,fbk_order as feedback_status,cpgn_desc as campaign_desc,is_active,cpgn_name as campaign_name,sum(IF(is_sent=1,1,0)) as sent_count,count(camp_order_no) as total_mail, cpgn_goal_type as camp_goaltype, cpgn_status as camp_status from campaign_manager left join campaign_order_list on camp_id=cpgn_id where created_by =".$this->store_id." AND is_deleted='0'";
      if(!empty($frm_date) && !empty($to_date))
       {
        $frm_date=$frm_date." 00:00:00";
        $to_date=$to_date." 23:59:59";
        $sql.=" AND trigger_on >= ".$this->db->escape($frm_date)." AND trigger_on <= ".$this->db->escape($to_date);
       }
	    if($cmp_status!='ALL' && $cmp_status=='ACT')
       {

        $sql.=" AND is_active='1' AND is_deleted='0'";
       }
	    if($cmp_status!='ALL' && $cmp_status=='IACT')
       {

        $sql.=" AND is_active='0' AND is_deleted='0'";
       }
	   if($cmp_status!='ALL' && $cmp_status=='DEL')
       {

        $sql.=" AND is_deleted='1'";
       }
	   if(!empty($sort_order))
       {
      $sql.=" Group by cpgn_id ORDER BY ".$sort_order." ".$dir."  ";
	   }
	   if(empty($sort_order))
       {
      $sql.=" Group by cpgn_id ORDER BY cpgn_id ".$dir."  ";
	   }
       //die($sql);
      $query=$this->db->query($sql);
	  return $query->result_array();
  }

    public function get_template_list()
  {
    $query=$this->db->query("SELECT template_id,template_content,template_name ,subject,is_default FROM email_template  WHERE (created_by=".$this->user_id." OR is_default=1) AND is_active=1 and is_deleted=0 ORDER BY created_on ASC") ;
    return $query->result_array();
  }

 public function get_brand_list($country_code='')
  {
    $sql="SELECT prod_brand from customer_product WHERE store_id=".$this->store_id." AND prod_brand<>'' AND prod_country=".$this->db->escape($country_code)." GROUP by prod_brand";
    $query=$this->db->query($sql);
    return $query->result_array();
  }
  public function get_country_list()
  {
    $query=$this->db->query("SELECT REPLACE(prod_country,'CO.UK','UK') AS prod_country from customer_product WHERE store_id=".$this->store_id." and is_active=1 GROUP by prod_country");
    return $query->result_array();
  }
  public function get_product_list($country_code='',$brand_code='',$key_word='',$fc_code='')
  {
    $sql="SELECT * from customer_product WHERE store_id=".$this->store_id." AND is_active=1 AND prod_brand<>''";
    if(!empty($key_word))
    {
		$key_word=str_replace("'","\'",$key_word);
      $sql.=" AND (prod_sku=".$this->db->escape($key_word)." OR prod_asin=".$this->db->escape($key_word)." OR prod_title LIKE '%".$key_word."%')";
    }
    if(!empty($country_code))
    {
      $sql.=" AND prod_country=".$this->db->escape($country_code);
    }
    if(!empty($brand_code) && $brand_code!='ALL')
    {

      $sql.=" AND prod_brand=".$this->db->escape($brand_code);
    }
	if(!empty($fc_code) && $fc_code!='ALL')
    {

      $sql.=" AND fc_code=".$this->db->escape($fc_code);
    }
    $query=$this->db->query($sql);
    return $query->result_array();
  }

 public function get_brand_product($brand)
  {
    $sql="SELECT * from customer_product WHERE store_id=".$this->store_id." AND is_active=1 AND is_deleted=0 AND prod_brand<>''";
    if($brand!='ALL')
      $sql.="AND prod_brand=".$this->db->escape($brand);

    $query=$this->db->query($sql);
    return $query->result_array();
  }
   public function get_country_product($country,$brand='')
  {
    $sql="SELECT * from customer_product WHERE store_id=".$this->store_id." AND is_active=1 AND is_deleted=0 AND prod_brand<>''";
    if($country!='ALL')
      $sql.=" AND prod_country=".$this->db->escape($country);
    if(!empty($brand))
      $sql.=" AND prod_brand=".$this->db->escape($brand);


    $query=$this->db->query($sql);
    return $query->result_array();
  }


  public function get_seleted_product($campaign_id)
  {
    $sql="SELECT  prd.* FROM campaign_asin
         INNER JOIN customer_product AS prd ON cmp_id=".$campaign_id." AND prod_sku=cmp_sku AND prod_asin=cmp_asin AND prod_country=cmp_country AND fc_code=cmp_fc";
    $query=$this->db->query($sql);
    return $query->result_array();
  }



  public function create_new_campaign($post,$asin)
  {
    $this->db->trans_start();
    $insert_campaign = array(
      'cpgn_name' => $post->camp_name,
      'cpgn_desc'=>$post->camp_desc,
      'cpgn_type' => $post->camp_type,
      'cpgn_fullfill' => $post->camp_fulfill,
      'cpgn_hour' => $post->camp_hour,
      'cpgn_min' => $post->camp_min,
      'cpgn_day' => $post->camp_trigger_day,
      'cpgn_days' => $post->camp_days,
      'cpgn_am_pm' => $post->camp_am_pm,
      'cpgn_trigger' => $post->camp_trigger,
      'cpgn_brand' => $post->camp_brand,
      'cpgn_country' => $post->camp_country,
      'cpgn_templateID' => $post->template_id,
      'created_by' => $this->store_id,
      'fbk_order' => $post->feedback_status,
      'created_on' => date('Y-m-d H:s:i'),
      'modified_on' => date('Y-m-d H:s:i'),
      'cpgn_goal_type' => $post->camp_goaltype,
      'cpgn_status' => $post->camp_status
    );
    $this->db->insert('campaign_manager',$insert_campaign);
    $camp_id=$this->db->insert_id();
    foreach($asin as $as) {
      $insert_asin[] = array(
        'cmp_id' => $camp_id,
        'cmp_asin' => $as->prod_asin,
        'cmp_country' => $post->camp_country,
        'cmp_sku' => $as->prod_sku,
        'cmp_fc' => $as->fc_code
      );
    }
    $this->db->insert_batch('campaign_asin',$insert_asin);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

  public function update_campaign($post,$asin)
  {
    $this->db->trans_start();
    $update_campaign = array(
      'cpgn_name' => $post->camp_name,
      'cpgn_desc' => $post->camp_desc,
      'cpgn_type' => $post->camp_type,
      'cpgn_fullfill' => $post->camp_fulfill,
      'cpgn_hour' => $post->camp_hour,
      'cpgn_min' => $post->camp_min,
      'cpgn_day' => $post->camp_trigger_day,
      'cpgn_days' => $post->camp_days,
      'cpgn_am_pm' => $post->camp_am_pm,
      'cpgn_trigger' => $post->camp_trigger,
      'cpgn_brand' => $post->camp_brand,
      'cpgn_country' => $post->camp_country,
      'cpgn_templateID' => $post->template_id,
      'created_by' => $this->store_id,
      'fbk_order' => $post->feedback_status,
      'modified_on' => date('Y-m-d H:s:i'),
      'cpgn_goal_type' => $post->camp_goaltype,
      'cpgn_status' => $post->camp_status
    );
    $this->db->where('cpgn_id', $post->cpgn_id);
    $this->db->update('campaign_manager',$update_campaign);
    $this->db->query("DELETE FROM campaign_asin WHERE cmp_id=".$this->db->escape($post->cpgn_id));
    foreach($asin as $as) {
      $insert_asin[] = array(
        'cmp_id' => $post->cpgn_id,
        'cmp_asin' => $as->prod_asin,
        'cmp_country' => $post->camp_country,
        'cmp_sku' => $as->prod_sku,
        'cmp_fc' => $as->fc_code
      );
    }
    $this->db->insert_ignore_batch('campaign_asin',$insert_asin);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }

   public function get_campaign_metrics($frm_date='',$to_date='')
    {
      $sql="SELECT count(*) as ttl_cmp FROM campaign_manager WHERE created_by={$this->store_id}  AND is_deleted='0' ";
      $sql1="SELECT COUNT(*) AS sent_count FROM campaign_order_list WHERE camp_id IN (SELECT cpgn_id FROM campaign_manager WHERE created_by={$this->store_id} AND is_deleted=0 AND is_active=1) AND is_sent=1";
      $sql2="SELECT COUNT(*) AS pending_count FROM campaign_order_list WHERE camp_id IN (SELECT cpgn_id FROM campaign_manager WHERE created_by={$this->store_id} AND is_deleted=0 AND is_active=1) AND is_sent=0 AND trigger_on > NOW() AND dns_status=0";
      $sql3="SELECT count(*) as ttl_inac FROM campaign_manager WHERE created_by={$this->store_id} AND is_active=0 and is_deleted=0";
	   $sql4="SELECT COUNT(*)+3  AS ttl_temp FROM `email_template` WHERE created_by={$this->store_id} AND is_deleted='0'";
      $qry=$this->db->query($sql);
      $res=$qry->result_array();
      $data['total_cmp']=$res[0]['ttl_cmp'];
      $qry=$this->db->query($sql1);
      $res=$qry->result_array();
      $data['sent_count']=$res[0]['sent_count'];
      $qry=$this->db->query($sql2);
      $res=$qry->result_array();
      $data['pending_count']=$res[0]['pending_count'];
      $qry=$this->db->query($sql3);
      $res=$qry->result_array();
      $data['inactive']=$res[0]['ttl_inac'];
	   $qry=$this->db->query($sql4);
      $res=$qry->result_array();
      $data['ttl_temp']=$res[0]['ttl_temp'];
      return $data;
    }
    public function get_feedback_data($frm_date='',$to_date='')
    {
      $sql="SELECT IFNULL(SUM(IF(fbk_rating >= 4,1,0 )),0) as positive_count ,IFNULL(SUM(IF(fbk_rating <= 2,1,0 )),0) as negative_count, IFNULL(SUM(IF(fbk_rating = 3,1,0 )),0) as neutral_count, count(order_id) as feedback_count, ROUND(AVG(fbk_rating),2) as avg_feedback, IFNULL(SUM(IF(fbk_rating = 1,1,0 )),0) as one_star, IFNULL(SUM(IF(fbk_rating = 2,1,0 )),0) as two_star, IFNULL(SUM(IF(fbk_rating = 3,1,0 )),0) as three_star, IFNULL(SUM(IF(fbk_rating = 4,1,0 )),0) as four_star, IFNULL(SUM(IF(fbk_rating = 5,1,0 )),0) as five_star FROM amz_feedback_data as tx
            WHERE fbk_for={$this->store_id}";
       // if(!empty($frm_date) && !empty($to_date))
       // {
       //  $frm_date=$frm_date." 00:00:00";
       //  $to_date=$to_date." 23:59:59";
       //  $sql.=" AND fbk_date >= ".$this->db->escape($frm_date)." AND fbk_date <= ".$this->db->escape($to_date);
       // }
       $query=$this->db->query($sql);
       return $query->result_array();
    }
    public function check_plan_details()
    {
      $sql="SELECT subscribe_id,sub.plan_id,payment_id,valid_till,camp_allowed,camp_created FROM plan_subscriber AS  sub
            INNER JOIN plan_manager AS plr ON plr.plan_id=sub.plan_id AND  subscribed_by={$this->store_id}
            INNER JOIN (SELECT COUNT(*) AS camp_created FROM campaign_manager WHERE created_by ={$this->store_id} AND is_deleted=0) AS cpn ON 1=1
            ORDER BY valid_till DESC LIMIT 0,1";
      $qry=$this->db->query($sql);
      $plan=$qry->result_array();
      if($plan[0]['camp_allowed'] > $plan[0]['camp_created'] )
      {
        return 1;
      }
      else
      {
        return 2;
      }
    }
    public function validate_allowed_hijack_count()
    {
      $sql="SELECT subscribe_id,sub.plan_id,payment_id,valid_till,hijack_alert,cur_hijack_count FROM plan_subscriber AS  sub
            INNER JOIN plan_manager AS plr ON plr.plan_id=sub.plan_id AND  subscribed_by={$this->store_id}
            INNER JOIN (SELECT COUNT(*) AS cur_hijack_count FROM customer_product WHERE store_id ={$this->store_id} AND check_hijack=1) AS cpn ON 1=1
            ORDER BY valid_till DESC LIMIT 0,1";
      $qry=$this->db->query($sql);
      $plan=$qry->result_array();
      return $plan[0];
    }

	public function get_recent_orders()
    {
      $sql="SELECT  order_no FROM amz_order_info where order_status='Shipped' AND buyer_email <> '' AND  store_id ='".$this->store_id."' ORDER BY purchase_date DESC LIMIT 0,5";
      $query=$this->db->query($sql);
       return $query->result_array();
    }


  public function get_feedbacks($frm_date='', $to_date='', $order_or_email = '', $search_term = '')
  {
    $sql = "SELECT tx.fbk_date, tx.order_id, tx.fbk_rating, tx.rater_email, tx.fbk_comment, ao.asin, REPLACE(REPLACE(cp.prod_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ') AS itm_title, ao.seller_sku, cp.prod_country, tx.fbk_country, cp.prod_image
      FROM amz_feedback_data as tx
      INNER JOIN amz_order_info as ao ON tx.order_id = ao.order_no
      INNER JOIN customer_product cp ON cp.store_id = {$this->store_id} and ao.seller_sku = cp.prod_sku and cp.prod_country = tx.fbk_country and ao.asin = cp.prod_asin WHERE tx.fbk_for = {$this->store_id} AND cp.is_active >= 0 ";
    if(!empty($frm_date) && !empty($to_date)) {
      $frm_date=$frm_date." 00:00:00";
      $to_date=$to_date." 23:59:59";
      $sql.=" AND fbk_date >= ".$this->db->escape($frm_date)." AND fbk_date <= ".$this->db->escape($to_date);
    }
    if(!empty($order_or_email) && $search_term == 'order') {
      $sql.=" AND order_id = '".$order_or_email."'";
    }
    if(!empty($order_or_email) && $search_term == 'email') {
      $sql.=" AND rater_email = '".$order_or_email."'";
    }
    $query=$this->db->query($sql);
    return $query->result_array();
  }

  public function get_reviews_overview() {
    $qry=$this->db->query("SELECT IFNULL(SUM(IF(review_rating >= 4,1,0 )),0) as positive_count ,IFNULL(SUM(IF(review_rating <= 2,1,0 )),0) as negative_count, IFNULL(SUM(IF(review_rating = 3,1,0 )),0) as neutral_count, COUNT(review_rating) as total_review_count, ROUND(AVG(review_rating),2) as avg_review FROM customer_product cp INNER JOIN fd_amazon_cust_reviews cr ON cp.prod_sku = cr.item_SKU WHERE cp.store_id = {$this->store_id} AND cr.user_id = " . $this->db->escape($this->user_id));
    $res=$qry->result_array();
    return $res;
  }

  public function get_reviews_breakdown() {
    $qry=$this->db->query("SELECT review_rating FROM customer_product cp INNER JOIN fd_amazon_cust_reviews cr ON cp.prod_sku = cr.item_SKU WHERE cp.store_id = {$this->store_id} AND cr.user_id = " . $this->db->escape($this->user_id));
    $res=$qry->result_array();
    return $res;
  }
}
?>

