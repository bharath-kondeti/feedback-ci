<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventory_model extends CI_Model
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
         $sort_order='open_date';
         if($orderby=='open_date')
         {
          $sort_order='open_date';
         }
         elseif($orderby=='prod_asin')
         {
          $sort_order='prod_asin';
         }
         elseif($orderby=='prod_sku')
         {
          $sort_order='prod_sku';
         }
         elseif($orderby=='prod_brand')
         {
          $sort_order='prod_brand';
         }
		 elseif($orderby=='prod_brand')
         {
          $sort_order='prod_brand';
         }
		 elseif($orderby=='prod_title')
         {
          $sort_order='prod_title';
         }
		 elseif($orderby=='itm_qty')
         {
          $sort_order='itm_qty';
         }
		 elseif($orderby=='itm_price')
         {
          $sort_order='itm_price';
         }
		 elseif($orderby=='is_active')
         {
          $sort_order='is_active';
         }
		 elseif($orderby=='sales_rank')
         {
          $sort_order='sales_rank';
         }
		  elseif($orderby=='fc_code')
         {
          $sort_order='fc_code';
         }
		  elseif($orderby=='bb_status')
         {
          $sort_order='bb_status';
         }
		  elseif($orderby=='sold_qty')
         {
          $sort_order='sold_qty';
         }
		   elseif($orderby=='dos')
         {
          $sort_order='dos';
         }
         if(empty($direction))
          $direction='DESC';
         $sqlcount="SELECT count(*) as total from customer_product as trx
                    WHERE store_id={$this->store_id} AND trx.is_active >= '0'  ";
         $sqlquery= "SELECT prod_image,prod_brand,REPLACE(REPLACE(prod_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ')  AS prod_title,prod_asin,prod_country,fc_code,prd.is_active,is_deleted,prod_sku,prd.itm_price,prd.itm_qty,DATE_FORMAT(open_date,'%Y-%m-%d') as open_date,act_price,profit,IFNULL(sales_rank,'----') AS sales_rank,IF(bb_belongs_to='true','Yes','No') as bb_status,ROUND(ifnull(SUM(tx.itm_qty),'---')) AS sold_qty,ROUND(IFNULL(ROUND(prd.itm_qty/SUM(tx.itm_qty)*30,'2'),'---')) AS dos,amz_domain,amz_code,review_tracking,prd.store_id
                      FROM customer_product as prd
					  INNER JOIN supported_country AS spt ON spt.country_code=prod_country
					  LEFT JOIN amz_order_info AS tx ON  tx.store_id= {$this->store_id} AND tx.store_id=prd.store_id AND seller_sku=prod_sku AND order_status='Shipped'
                      where prd.store_id={$this->store_id}  AND prd.is_active >= '0' ";

		  if(isset($str[1]->list_status))
         {
			 if($str[1]->list_status == 'ALL')
           {
              $sqlquery.=" AND prd.is_active >= '0' ";
              $sqlcount.=" AND trx.is_active >= '0' ";
           }
           if($str[1]->list_status == 'ACT')
           {
              $sqlquery.=" AND prd.is_active >= '0' AND prd.is_active=1 ";
              $sqlcount.=" AND trx.is_active >= '0' AND trx.is_active=1 ";
           }
           elseif($str[1]->list_status == 'INAC')
           {
              $sqlquery.="AND prd.is_active >= '0' AND prd.is_active=0 ";
              $sqlcount.="AND trx.is_active >= '0' AND trx.is_active=0 ";
           }
           elseif($str[1]->list_status == 'DEL')
           {
              $sqlquery.="AND prd.is_active >= '0' AND prd.is_deleted=1 ";
              $sqlcount.="AND trx.is_active >= '0' AND trx.is_deleted=1 ";
           }

         }



        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (prod_title LIKE '%".$srterm."%' OR prod_asin LIKE '%".$srterm."%' OR prod_sku LIKE '%".$srterm."%'  ) ";
          $sqlcount.=" AND (prod_title LIKE '%".$srterm."%' OR prod_asin LIKE '%".$srterm."%' OR prod_sku LIKE '%".$srterm."%'  ) ";
        }

        $sqlquery.=" GROUP BY prod_sku,prod_asin,fc_code ORDER BY ";
        $sqlquery.="".$sort_order." ".$direction;
        $sqlquery.=" LIMIT ".$offet.",".$limit;

        $query=$this->db->query($sqlquery);
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
?>
