<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Buyers_model extends CI_Model
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
         $sort_order='purchase_date';
         if($orderby=='purchase_date')
         {
          $sort_order='a.purchase_date';
         }
         elseif($orderby=='order_no')
         {
          $sort_order='a.order_no';
         }
		  elseif($orderby=='buyer_email')
         {
          $sort_order='b.buyer_email';
         }
		 
		  elseif($orderby=='ttl_orders')
         {
          $sort_order='ttl_orders';
         }
		 
		  elseif($orderby=='po_date')
         {
          $sort_order='a.purchase_date';
         }
		  elseif($orderby=='scd_count')
         {
          $sort_order='scd_count';
         }
		 elseif($orderby=='sent_count')
         {
          $sort_order='sent_count';
         }
		 elseif($orderby=='sent_count')
         {
          $sort_order='sent_count';
         }
         
         if(empty($direction))
          $direction='DESC';
         $sqlcount="SELECT count(*) as total FROM ( SELECT c.order_no FROM amz_order_info AS c LEFT JOIN `buyer_camp_data` AS b ON c.buyer_email=b.buyer_email 
                   ";
         $sqlquery= "
SELECT *,d.c as ttl_orders,DATE_FORMAT(purchase_date,'%Y-%m-%d') as purchase_date_new,a.buyer_email as buyer_email_new,IFNULL(scd_count,'0') as scd_count_new,IFNULL(sent_count,'0') as sent_count_new,IFNULL(read_count,'0') as read_count_new,REPLACE(a.buyer_email,'@marketplace.amazon.in','') AS buyer_email_new2,store_location as store_country FROM amz_order_info AS a LEFT JOIN `buyer_camp_data` AS b ON a.buyer_email=b.buyer_email inner join store_manager as c on a.store_id=c.store_id
inner join buyer_orders AS d on a.order_no=d.order_no AND a.seller_sku=d.seller_sku 
";

 if(isset($str[1]->repeat_status))
         {
			 if($str[1]->repeat_status == 'YES')
           {
              $sqlquery.=" INNER JOIN repeated_buyers as f on a.buyer_email=f.buyer_email ";
              $sqlcount.=" INNER JOIN repeated_buyers as f on c.buyer_email=f.buyer_email ";
           }
           
         }
		 
		 $sqlcount.="  WHERE c.store_id={$this->store_id} AND c.buyer_email <> '' AND c.buyer_email is NOT NULL ";

         $sqlquery.=" WHERE a.store_id={$this->store_id} AND a.buyer_email <> '' AND a.buyer_email is NOT NULL  ";
		 
		 
		  if(isset($str[1]->repeat_status))
         {
			 
           if($str[1]->repeat_status == 'NO')
           {
              $sqlquery.=" AND a.buyer_email NOT IN (select buyer_email from repeated_buyers)";
              $sqlcount.=" AND c.buyer_email NOT IN (select buyer_email from repeated_buyers)";
           }
         }
		 
		 

        if(isset($str[2]->open_status))
         {
			 if($str[2]->open_status == 'YES')
           {
              $sqlquery.=" AND read_count > '0' ";
              $sqlcount.=" AND read_count > '0' ";
           }
           if($str[2]->open_status == 'NO')
           {
              $sqlquery.=" AND read_count <= '0' ";
              $sqlcount.=" AND read_count <= '0' ";
           }
         }
		 
		 
		 if(isset($str[3]->click_status))
         {
			 if($str[3]->click_status == 'YES')
           {
              $sqlquery.=" AND click_count > '0' ";
              $sqlcount.=" AND click_count > '0' ";
           }
           if($str[3]->click_status == 'NO')
           {
              $sqlquery.=" AND click_count <= '0' ";
              $sqlcount.=" AND click_count <= '0' ";
           }
         }
		 
		

		

	 
        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (seller_sku LIKE '%".$srterm."%' OR buyer_email LIKE '%".$srterm."%' OR asin LIKE '%".$srterm."%'  ) "; 
          $sqlcount.=" AND (seller_sku LIKE '%".$srterm."%' OR buyer_email LIKE '%".$srterm."%' OR asin LIKE '%".$srterm."%'  ) "; 
        }
		
		 $sqlcount.=" AND c.store_id='".$this->store_id."'  GROUP BY c.buyer_email ) AS a";

         $sqlquery.="  AND a.store_id='".$this->store_id."'  GROUP BY a.buyer_email ORDER BY ";
        //if(!empty($sort_order))
          $sqlquery.="".$sort_order." ".$direction;
        $sqlquery.=" LIMIT ".$offet.",".$limit;
		//die($sqlcount);
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
	
	
	
	
	
	
	 public function get_order_list($buyer_email,$orderby,$direction,$offet,$limit,$searchterm='')
    {
         $srterm='';
         $status='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            $srterm=urldecode($str[0]->searchtext);
         }
         $sort_order='purchase_date';
         if($orderby=='purchase_date')
         {
          $sort_order='a.purchase_date';
         }
         elseif($orderby=='prod_asin')
         {
          $sort_order='prod_asin';
         }
         
         if(empty($direction))
          $direction='DESC';
         $sqlcount="SELECT count(*) as total FROM amz_order_info WHERE store_id='".$this->store_id."' AND buyer_email=CONCAT('".$buyer_email."','@marketplace.amazon.in')";
         $sqlquery= "SELECT *,DATE_FORMAT(purchase_date,'%Y-%m-%d') as purchase_date_new FROM amz_order_info WHERE store_id='".$this->store_id."' AND buyer_email=CONCAT('".$buyer_email."','@marketplace.amazon.in')";

 
		

		

	 
        if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (seller_sku LIKE '%".$srterm."%' OR buyer_email LIKE '%".$srterm."%' OR asin LIKE '%".$srterm."%'  ) "; 
          $sqlcount.=" AND (seller_sku LIKE '%".$srterm."%' OR buyer_email LIKE '%".$srterm."%' OR asin LIKE '%".$srterm."%'  ) "; 
        }
		

        $sqlquery.="  ORDER BY ";
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
?>
