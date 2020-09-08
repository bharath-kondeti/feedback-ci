<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_model extends CI_Model
{
	  public function  __construct()
	  {
	   	 parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
	    $store=$this->session->userdata('store_info');  
       $this->store_id=$store['store_id'];
      }
   

	  
    public function get_order_list($orderby='purchase_date',$direction='DESC',$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         $tf_status='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));


            $srterm=urldecode($str[0]->searchtext);
         } 
         if(isset($str[1]->order_status))
         {
           if($str[1]->order_status == 'SHI')
           $status='Shipped';
           elseif($str[1]->order_status == 'UNS')
           $status='Unshipped';
           elseif($str[1]->order_status == 'CAN')
           $status='Canceled'; 
           elseif($str[1]->order_status == 'PEN')
           $status='Pending'; 
         }
         if(isset($str[4]->tfm_status))
         {
           if($str[4]->tfm_status == 'PIC')
           $tf_status='PickedUp';
         if($str[4]->tfm_status == 'PNP')
           $tf_status='PendingPickUp';
           
       	   elseif($str[4]->tfm_status == 'DLI')
           $tf_status='Delivered';
       	   elseif($str[4]->tfm_status == 'OUT')
           $tf_status='OutForDelivery';
       	   elseif($str[4]->tfm_status == 'LBL')
           $tf_status='LabelCanceled';
       	   elseif($str[4]->tfm_status == 'RTS')
           $tf_status='ReturnedToSeller';
       	   elseif($str[4]->tfm_status == 'UDL')
           $tf_status='Undeliverable';
	       elseif($str[4]->tfm_status == 'RBB')
           $tf_status='RejectedByBuyer';

       }
         $from_date=date('Y-m-d', strtotime('-30 days'));
         $to_date=date('Y-m-d ');
         if(isset($str[2]->from_date) && !empty($str[2]->from_date))
         {
            $test_arr  = explode('-', $str[2]->from_date);
            
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) 
            {
              
                $from_date=$str[2]->from_date;
            }
         }
         if(isset($str[3]->to_date) && !empty($str[2]->to_date))
         {
            $test_arr  = explode('-', $str[3]->to_date);
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) 
            {
                $to_date=$str[3]->to_date;
            }
         }
		
         if(isset($str[5]->date_rng) && !empty($str[5]->date_rng))
         {
            if($str[5]->date_rng=='today')
            {
              $from_date=date('Y-m-d');
              $to_date=date('Y-m-d');
            }
            if($str[5]->date_rng=='7 days')
            {
              $to_date=date('Y-m-d');
              $from_date = date('Y-m-d',strtotime("-7 days"));
            }
            if($str[5]->date_rng=='30 days')
            {
              $to_date=date('Y-m-d');
              $from_date = date('Y-m-d',strtotime("-30 days"));
            }
            if($str[5]->date_rng=='this month')
            {
              $to_date=date('Y-m-d');
              $from_date = date('Y-m-01');
            }
            if($str[5]->date_rng=='last month')
            {
              $to_date= date('Y-m-d', strtotime('last day of last month'));
              $from_date =  date('Y-m-d', strtotime('first day of last month'));
            }
         }
		 
          $sort_order='purchase_date';
         if($orderby=='purchase_date')
         {
          $sort_order='purchase_date';
         }
         elseif($orderby=='seller_sku')
         {
          $sort_order='seller_sku';
         }
		 elseif($orderby=='asin')
         {
          $sort_order='asin';
         }
		 elseif($orderby=='order_no')
         {
          $sort_order='order_no';
         }
		 elseif($orderby=='buyer_name')
         {
          $sort_order='buyer_name';
         }
		 elseif($orderby=='itm_title')
         {
          $sort_order='itm_title';
         }
		  elseif($orderby=='itm_price')
         {
          $sort_order='tx.itm_price';
         }
		 elseif($orderby=='itm_qty')
         {
          $sort_order='tx.itm_qty';
         }
		 elseif($orderby=='order_status')
         {
          $sort_order='order_status';
         }

         $sqlcount="SELECT count(*) as total from amz_order_info as trx
                    WHERE store_id={$this->store_id} AND order_status <> ''";
         $sqlquery= "SELECT seller_sku,asin,REPLACE(REPLACE(itm_title,'&nbsp;&ndash;&nbsp;','-'),'&nbsp;',' ')  AS itm_title,order_no,DATE_FORMAT(purchase_date,'%Y-%m-%d') as purchase_date,DATE_FORMAT(purchase_date,'%H:%i:%s') as purchase_time,buyer_name,DATE_FORMAT(calc_shipdate,'%Y-%m-%d') as calc_shipdate,DATE_FORMAT(calc_deliverydate,'%Y-%m-%d') as calc_deliverydate,
                      tx.itm_qty AS no_of,order_status,order_tfmstatus as tfm_status,tx.itm_qty as no_of_item,
                      buyer_email,shipping_country,shipping_state,shipping_zip,shipping_city,shipping_addr1,tx.itm_price,itm_ship_price,fulfillment_channel,prod_image,tracking_number,
					  ship_type,ship_service,IF(sales_country='US','com',LOWER(sales_country)) AS sales_country,amz_domain
                      FROM amz_order_info  as tx
					  INNER JOIN supported_country AS sup ON sup.country_code=sales_country
					  LEFT JOIN customer_product AS prd ON tx.seller_sku=prd.prod_sku AND tx.asin=prd.prod_asin AND prd.store_id='".$this->store_id."'
                      WHERE tx.store_id={$this->store_id}  AND order_status <> ''";

        if(!empty($status))
        {
          $sqlquery.= " AND order_status = '".$status."'"; 
          $sqlcount.= " AND order_status = '".$status."'"; 
        }
        if(!empty($tf_status))
        {
          $sqlquery.= " AND order_tfmstatus LIKE '%".$tf_status."%'"; 
          $sqlcount.= " AND order_tfmstatus LIKE '%".$tf_status."%'"; 
        }
        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (tx.seller_sku LIKE '%".$srterm."%'  OR `asin` LIKE '%".$srterm."%' OR order_no LIKE '%".$srterm."%' OR buyer_name LIKE '%".$srterm."%' OR tx.itm_title LIKE '%".$srterm."%'   ) "; 
          $sqlcount.=" AND (trx.seller_sku LIKE '%".$srterm."%' OR `asin` LIKE '%".$srterm."%' OR order_no LIKE '%".$srterm."%' OR buyer_name LIKE '%".$srterm."%' OR trx.itm_title LIKE '%".$srterm."%'   ) "; 
        }
        if(!empty($from_date))
        {
          $from_date=$from_date." 00:00:00";
          $to_date=$to_date." 23:59:59";

          $sqlquery.=" AND  purchase_date >= ".$this->db->escape($from_date.' 00:00:00')." AND purchase_date <=".$this->db->escape($to_date.' 23:59:00');
          $sqlcount.=" AND  purchase_date >= ".$this->db->escape($from_date.' 00:00:00')." AND purchase_date <=".$this->db->escape($to_date.' 23:59:00');
        }

        $sqlquery.=" ORDER BY ".$sort_order." ".$direction." LIMIT ".$offet.",".$limit;
        
       //die($sqlquery);
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