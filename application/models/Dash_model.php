<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dash_model extends CI_Model
{
	  public function  __construct()
	  {
	   	 parent::__construct();
       $user=$this->session->userdata('user_logged_in');
       $this->store_id=$user['id'];
	    $store=$this->session->userdata('store_info');
        $this->store_id=$store['store_id'];
		$this->store_country=$store['store_country'];
    }


    public function get_revenue($frm_date='',$to_date='')
    {
       $sql="SELECT sum(itm_price) as revenue_total ,count(order_no) as order_count FROM `amz_order_info`
        WHERE 1 ";
       $sql.=" and store_id={$this->store_id}  and order_status='Shipped'";
       $query=$this->db->query($sql);
       return $query->result_array();
    }




    public function get_graph_data($frm_date='',$to_date='')
    {
       $sql="SELECT DATE_FORMAT(purchase_date,'%b-%d') AS order_date,count(order_no) as order_count,sum(itm_qty) as ord_qty,sum(itm_price) as total_amt FROM amz_order_info WHERE store_id= ".$this->store_id;
       $sql.=" GROUP BY order_date ORDER BY purchase_date ASC";
       $query=$this->db->query($sql);
       return $query->result_array();
    }

    public function orders_graph($frm_date='',$to_date='')
    {
       $sql="SELECT DATE_FORMAT(purchase_date,'%b-%d') AS order_date,count(order_no) as order_count FROM amz_order_info WHERE store_id= ".$this->store_id;
       $sql.=" GROUP BY order_date ORDER BY purchase_date ASC";
       $query=$this->db->query($sql);
       return $query->result_array();
    }

    public function feedback_graph($frm_date='',$to_date='')
    {
       $sql="SELECT DATE_FORMAT(fbk_date,'%b-%d') AS fbk_date,count(order_id) as fbk_count FROM amz_feedback_data WHERE fbk_for= ".$this->store_id;
       $sql.=" GROUP BY fbk_date ORDER BY fbk_date ASC";
       $query=$this->db->query($sql);
       return $query->result_array();
    }

    public function review_graph($frm_date='',$to_date='')
    {
       $sql = "SELECT DATE_FORMAT(cr.review_date,'%b-%d') AS review_date,count(cr.fd_id) as review_count FROM customer_product cp INNER JOIN fd_amazon_cust_reviews cr ON cp.prod_sku = cr.item_SKU WHERE cp.store_id = {$this->store_id} AND cr.user_id = {$this->user_id}";
       $sql.=" GROUP BY review_date ORDER BY review_date ASC";
       $query=$this->db->query($sql);
       return $query->result_array();
    }

    public function messages_graph($frm_date='',$to_date='')
    {
       $sql = "SELECT DATE_FORMAT(co.sent_on,'%b-%d') AS sent_date, count(co.camp_id) as sent_count FROM campaign_manager cm LEFT JOIN campaign_order_list co on co.camp_id = cm.cpgn_id where cm.created_by = {$this->store_id} and co.is_sent = '1'";
       $sql.=" GROUP BY co.sent_on ORDER BY co.sent_on ASC";
       $query=$this->db->query($sql);
       return $query->result_array();
    }

    public function get_top_10_product($frm_date='',$to_date='')
    {
      $sql= "SELECT prod_title,prod_asin,prod_sku,prd.itm_price,prd.itm_qty,open_date,act_price,profit,SUM(tx.itm_qty) AS sold_qty,profit*SUM(tx.itm_qty) AS total_profit
                      FROM customer_product as prd
                      INNER JOIN amz_order_info AS tx ON  store_id= {$this->store_id} AND store_id=store_id AND seller_sku=prod_sku AND order_status='Shipped' ";


                      // "-- WHERE store_id={$this->store_id} ";
      // if(!empty($frm_date) && !empty($to_date))
      //  {
      //     $frm_date=$frm_date." 00:00:00";
      //     $to_date=$to_date." 23:59:59";
      //     $sql.=" AND purchase_date >= ".$this->db->escape($frm_date)." AND purchase_date <= ".$this->db->escape($to_date);
      //  }
      $sql.=" GROUP BY prod_sku HAVING sold_qty > 0 ORDER BY sold_qty DESC limit 0,10 " ;
      $query=$this->db->query($sql);
      return $query->result_array();
    }

    public function get_consolidated_campaign_details($frm_date='',$to_date='')
    {
      $sql="SELECT IFNULL(count(*),0) as ttl_cmp FROM campaign_manager WHERE created_by=".$this->store_id." AND is_deleted=0 AND is_active=1";
      $sql1="SELECT IFNULL(COUNT(*),0) AS sent_count FROM campaign_order_list WHERE camp_id IN (SELECT cpgn_id FROM campaign_manager WHERE created_by=".$this->store_id." AND is_deleted=0 AND is_active=1) AND is_sent=1 ";
      // if(!empty($frm_date) && !empty($to_date))
      //  {
      //    $frm_date=$frm_date." 00:00:00";
      // $to_date=$to_date." 23:59:59";

      //     $sql1.=" AND trigger_on >= ".$this->db->escape($frm_date)." AND trigger_on <= ".$this->db->escape($to_date);
      //  }
      $sql2="SELECT IFNULL(COUNT(*),0) AS pending_count FROM campaign_order_list WHERE camp_id IN (SELECT cpgn_id FROM campaign_manager WHERE created_by=".$this->store_id." AND is_deleted=0 AND is_active=1) AND is_sent=0  AND dns_status=0";
      // if(!empty($frm_date) && !empty($to_date))
      //  {
      //    $frm_date=$frm_date." 00:00:00";
      // $to_date=$to_date." 23:59:59";

      //     $sql2.=" AND trigger_on >= ".$this->db->escape($frm_date)." AND trigger_on <= ".$this->db->escape($to_date);
      //  }

      $qry=$this->db->query($sql);
      $res=$qry->result_array();
      $data['total_cmp']=$res[0]['ttl_cmp'];
      $qry=$this->db->query($sql1);
      $res=$qry->result_array();
      $data['sent_count']=$res[0]['sent_count'];
      $qry=$this->db->query($sql2);
      $res=$qry->result_array();
      $data['pending_count']=$res[0]['pending_count'];
      return $data;

    }


public function get_top_product($orderby,$direction,$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            $srterm=urldecode($str[0]->searchtext);
         }
		  $sort_order='sold_qty';
         if($orderby=='sold_qty')
         {
          $sort_order='sold_qty';
         }
         elseif($orderby=='prod_asin')
         {
          $sort_order='prod_asin';
         }
         elseif($orderby=='prod_sku')
         {
          $sort_order='prod_sku';
         }
         elseif($orderby=='prod_title')
         {
          $sort_order='prod_title';
         }
		 elseif($orderby=='itm_price')
         {
          $sort_order='prd.itm_price';
         }
		 elseif($orderby=='itm_qty')
         {
          $sort_order='prd.itm_qty';
         }
		  elseif($orderby=='sales_rank')
         {
          $sort_order='sales_rank';
         }
		 elseif($orderby=='sales_rank')
         {
          $sort_order='sales_rank';
         }
		 elseif($orderby=='dos')
         {
          $sort_order='dos';
         }
         $sqlcount="SELECT count(*) AS total FROM (SELECT SUM(tx.itm_qty) AS sold_qty FROM customer_product as prd
                 INNER JOIN amz_order_info AS tx ON  prd.store_id= {$this->store_id} AND tx.store_id=prd.store_id AND seller_sku=prod_sku AND order_status='Shipped' GROUP BY prod_sku HAVING sold_qty > 0 ORDER BY sold_qty DESC  LIMIT 0,10) AS a ";
         $sqlquery= "SELECT REPLACE(REPLACE(prod_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ')  AS prod_title,prod_asin,prod_sku,sales_rank,ROUND(SUM(tx.itm_price)/SUM(tx.itm_qty),'2') as itm_price,prd.itm_qty,open_date,act_price,profit,SUM(tx.itm_qty) AS sold_qty,profit*SUM(tx.itm_qty) AS total_profit,ROUND(prd.itm_qty/SUM(tx.itm_qty)*30,'2') AS dos
                 FROM customer_product as prd
                 INNER JOIN amz_order_info AS tx ON  prd.store_id= {$this->store_id} AND tx.store_id=prd.store_id AND seller_sku=prod_sku AND order_status='Shipped' AND prod_title <> '' ";

		 // $to_date=date('Y-m-d');
   //       $frm_date = date('Y-m-d',strtotime("-31 days"));
   //       if(!empty($frm_date) && !empty($to_date))
   //        {
   //           $frm_date=$frm_date." 00:00:00";
   //           $to_date=$to_date." 23:59:59";
   //           $sqlquery.=" AND purchase_date >= ".$this->db->escape($frm_date)." AND purchase_date <= ".$this->db->escape($to_date);
   //        }
         $sqlquery.=" GROUP BY prod_sku HAVING sold_qty > 0 ORDER BY ".$sort_order." ".$direction." " ;


        $sqlquery.=" LIMIT ".$offet.",".$limit;
        $query=$this->db->query($sqlquery) ;
        $data= $query->result_array();
        $countquery=$this->db->query($sqlcount);

        $numrows= $countquery->result_array();
        if(count($data) > 0)
        {
        $result_set=array('status_code'=>'1','status_text'=>'successfully reterived','total' =>$numrows[0]['total'], 'datalist' => $data ,'searchterm' => $searchterm );
        }
        else
        {
         $result_set=array('status_code'=>'0','status_text'=>'No data found');
        }
        return $result_set;
    }

	public function get_recent_ten_orders()
	{
		$sql="SELECT *,DATE_FORMAT(`purchase_date`,'%Y-%m-%d') AS po_date,REPLACE(REPLACE(itm_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ')  AS itm_title  FROM amz_order_info WHERE store_id='".$this->store_id."' ORDER BY purchase_date DESC limit 10";
		$qry=$this->db->query($sql);
		return $qry->result_array();
	}



}
