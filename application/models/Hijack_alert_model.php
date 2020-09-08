<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hijack_alert_model extends CI_Model
{
	  public function  __construct()
	  {
	   	 parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->store_id=$user['id'];
	    $store=$this->session->userdata('store_info');  
       $this->store_id=$store['store_id'];
    }
    
	public function get_inventory_list($orderby,$direction,$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            
            $srterm=urldecode($str[0]->searchtext);
         }

         $sort_order='is_active';
         if($orderby=='qty')
         {
          $sort_order='itm_qty';
         }
         elseif($orderby=='price')
         {
          $sort_order='itm_price';
         }
         elseif($orderby=='is_active')
         {
          $sort_order='is_active';
         }
         elseif($orderby=='profit')
         {
          $sort_order='total_profit';
         }
		 elseif($orderby=='prod_sku')
         {
          $sort_order='prod_sku';
         }
		 elseif($orderby=='prod_asin')
         {
          $sort_order='prod_asin';
         }
		 elseif($orderby=='prod_brand')
         {
          $sort_order='prod_brand';
         }
		 elseif($orderby=='prod_title')
         {
          $sort_order='prod_title';
         }
		 elseif($orderby=='last_hijack_check')
         {
          $sort_order='last_hijack_check';
         }
         if(empty($direction))
          $direction='DESC';
         $sqlcount="SELECT count(*) as total from customer_product as trx
         			WHERE store_id={$this->store_id}";
         $sqlquery= "SELECT prod_image,prod_brand,prod_country,REPLACE(REPLACE(prod_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ')  AS prod_title,prod_asin,prd.is_active,is_deleted,prod_sku,check_hijack,prd.itm_price,prd.itm_qty,DATE_FORMAT(open_date,'%Y-%m-%d') AS open_date,act_price,profit,last_hijack_check,hijacked_count,IF(bb_belongs_to='true','Yes','No') as bb_status,amz_domain 
                      FROM customer_product as prd
					  INNER JOIN supported_country AS sup ON sup.country_code=prod_country
                      where store_id={$this->store_id}";

        if(isset($str[1]->list_status))
        {
           if($str[1]->list_status == 'ACT')
           {
              $sqlquery.=" AND check_hijack=1 ";
              $sqlcount.=" AND check_hijack=1 ";
           }
           elseif($str[1]->list_status == 'INAC')
           {
              $sqlquery.=" AND check_hijack=0 ";
              $sqlcount.=" AND check_hijack=0 ";
           }
        }
        if(isset($str[2]->is_hijacked))
        {
           if($str[2]->is_hijacked == 'YES')
           {
              $sqlquery.=" AND hijacked_count>0 ";
              $sqlcount.=" AND hijacked_count>0 ";
           }
           elseif($str[2]->is_hijacked == 'NO')
           {
              $sqlquery.=" AND hijacked_count=0 ";
              $sqlcount.=" AND hijacked_count=0 ";
           }
        }
		if(isset($str[4]->active_status))
        {
           if($str[4]->active_status == 'ACT')
           {
              $sqlquery.=" AND is_active=1 ";
              $sqlcount.=" AND is_active=1 ";
           }
           elseif($str[4]->active_status == 'INAC')
           {
              $sqlquery.=" AND is_active=0 ";
              $sqlcount.=" AND is_active=0 ";
           }
        }
        if(isset($str[3]->brand))
        {
           if($str[3]->brand != 'ALL' && !empty($str[3]->brand))
           {
              $sqlquery.=" AND prod_brand=".$this->db->escape($str[3]->brand);
              $sqlcount.=" AND prod_brand=".$this->db->escape($str[3]->brand);
           }
        }
        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (prod_title LIKE '%".$srterm."%' OR prod_asin LIKE '%".$srterm."%' OR prod_sku LIKE '%".$srterm."%'  ) "; 
          $sqlcount.=" AND (prod_title LIKE '%".$srterm."%' OR prod_asin LIKE '%".$srterm."%' OR prod_sku LIKE '%".$srterm."%'  ) "; 
        }

        $sqlquery.=" GROUP BY prod_sku ORDER BY ";
        $sqlquery.="".$sort_order." ".$direction;
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
    
 
}