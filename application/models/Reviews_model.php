<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_model extends CI_Model
{
     public function  __construct()
     {
   		parent::__construct();
       	
	 }
		
     public function get_users_reviews($user_id)
     {
     	$qry=$this->db->query("SELECT * from fd_amazon_cust_reviews WHERE user_id=".$this->db->escape($user_id));
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
