<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_model extends CI_Model
{
    public function  __construct()
    {
        parent::__construct();
        $user=$this->session->userdata('user_logged_in');
        $this->user_id=$user['id'];
        $store = $this->session->userdata('store_info');
        $this->store_id=$store['store_id'];
	}

     public function get_users_reviews($user_id)
     {
     	$qry=$this->db->query("SELECT * from fd_amazon_cust_reviews WHERE user_id=".$this->db->escape($user_id));
     	$res=$qry->result_array();
     	return $res;
     }

     public function get_reviews($user_id)
     {
        $qry=$this->db->query("SELECT cr.item_SKU, COUNT(*) as total_reviews, cp.prod_asin, cp.prod_image, REPLACE(REPLACE(cp.prod_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ') AS prod_title FROM customer_product cp
            INNER JOIN fd_amazon_cust_reviews cr ON cp.prod_sku = cr.item_SKU
            WHERE cp.store_id = {$this->store_id} AND cr.user_id = " . $this->db->escape($user_id) . " GROUP BY cr.item_SKU");
        $res=$qry->result_array();
        return $res;
     }
     public function get_all_reviews($item_sku, $user_id) {
        $qry = $this->db->query("SELECT cust_name, review_title, review_desc, date(review_date) as review_date, review_rating from fd_amazon_cust_reviews WHERE item_SKU = '".$item_sku."' AND user_id = ".$this->db->escape($user_id));
        $res=$qry->result_array();
        return $res;
     }
      public function get_users_reviews_count($user_id)
     {
     	$qry=$this->db->query("SELECT count(*) as ttl from fd_amazon_cust_reviews WHERE user_id=".$this->db->escape($user_id));
     	$res=$qry->result_array();
     	return $res;
     }

     public function check_store_not_unique($user_id,$country_code,$seller_id)
     {
        $sql="SELECT * FROM supported_country AS spt
        INNER JOIN store_manager  AS mgr ON mgr.country_code=spt.country_code AND spt.country_code=".$this->db->escape($country_code)." AND created_by=".$this->db->escape($user_id);
		//die($sql);
        $qry=$this->db->query($sql);
        $res=$qry->result_array();
        if(count($res)>0)
        {
          return true;
        }
        else
        {
          return false;
        }
     }
  }
?>
