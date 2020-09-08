<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seller_reviews_model extends CI_Model
{
	  public function  __construct()
	  {
	   	 parent::__construct();
       $user=$this->session->userdata('user_logged_in');  
       $this->user_id=$user['id'];
	   $store=$this->session->userdata('store_info');  
       $this->store_id=$store['store_id'];
		       	
    }
    
    public function get_review_list($orderby='fbk_date',$direction='DESC',$offet,$limit,$searchterm='')
    {
         $srterm='';
         $rating='';
         $tf_status='';
		     $srasin='';
		     $prodtitle='';
         if($searchterm !='')
         {
            $str=json_decode(urldecode($searchterm));
            //print_r($str);   
            $srterm=urldecode($str[0]->searchtext);
			      $srasin=urldecode($str[7]->searchasin);
		        $prodtitle=urldecode($str[8]->searchprtitle);
		     }
         if(isset($str[1]->rating))
         {
           if($str[1]->rating == '1')
           $rating='1';
         if($str[1]->rating == '2')
           $rating='2';
         if($str[1]->rating == '3')
           $rating='3';
         if($str[1]->rating == '4')
           $rating='4';
    	   if($str[1]->rating == '5')
           $rating='5';
         }
		  
         if(isset($str[4]->tfm_status) && !empty($str[4]->tfm_status))
         {
			 //print_r($str);
            if($str[4]->tfm_status=='1')
            {
             $tf_status='1';
            }
            if($str[4]->tfm_status=='2')
            {
              $tf_status='2';
             
            }
			if($str[4]->tfm_status=='3')
            {
             $tf_status='3';
            }
			
		 }
		  if(isset($str[6]->ver_status) && !empty($str[6]->ver_status))
         {
			 if($str[6]->ver_status=='1')
            {
              $ver_status='1';
              
            }
	 
		 }
       
       
      
         // $from_date=date('Y-m-d', strtotime('-7 days'));
         $from_date="";
         $to_date=date('Y-m-d ');
		 //print_r($str[2]->from_date);
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
          $sort_order='';
         if($orderby=='fbk_date')
         {
          $sort_order="STR_TO_DATE(fbk_date, '%d-%m-%y')";
         } 
		  if($orderby=='fbk_rating')
         {
          $sort_order='fbk_rating';
         } 
		 if($orderby=='itm_title')
         {
          $sort_order='itm_title';
         } 
		  if($orderby=='impact')
         {
          $sort_order='impact';
         } 
		  if($orderby=='fbk_note')
         {
          $sort_order='fbk_note';
         } 
		 if($orderby=='prod_asin')
         {
          $sort_order='prod_asin';
         } 
		 
 
		   $sqlcount="SELECT COUNT(DISTINCT(order_id)) AS total FROM amz_feedback_data AS fbk
                    INNER JOIN amz_order_info AS trx ON trx.order_no=fbk.order_id  AND fbk_for=store_id AND fbk_for={$this->store_id}
                    INNER JOIN customer_product AS prd ON prd.prod_asin=trx.asin  
          ";
                
                         $sqlquery= "SELECT fbk.*,seller_sku,asin,fbk_comment,itm_title,fbk_status,fbk_ver,fbk_note,fbk_wip,fbk_done,fbk_date,REPLACE(prod_image,'_SL75_','_SL1500_') AS prod_image,prod_brand,prod_asin,order_no,order_id,DATE_FORMAT(purchase_date,'%Y-%m-%d') AS purchase_date,DATE_FORMAT(fbk_date,'%M %d,%Y') AS fbk_date_new,DATE_FORMAT(purchase_date,'%M %d,%Y') AS purchase_date_new,exp_ship_date,deliver_by_date,buyer_name,
                    (no_of_itm_shipped+no_of_itm_unshipped) AS no_of_item
                    FROM amz_feedback_data AS fbk
                  INNER JOIN amz_order_info AS tx ON tx.order_no=fbk.order_id  AND fbk_for=store_id AND fbk_for={$this->store_id}
                  INNER JOIN customer_product AS prd ON prd.prod_asin=tx.asin  ";
        if(!empty($rating))
        {
          $sqlquery.= " AND fbk.fbk_rating = '".$rating."'"; 
          $sqlcount.= " AND fbk.fbk_rating = '".$rating."'"; 
        }
      if(!empty($srterm) || $srterm !='')
        {
          $sqlquery.=" AND (tx.seller_sku LIKE '%".$srterm."%'  OR order_no LIKE '%".$srterm."%'  OR tx.asin LIKE '%".$srterm."%' OR buyer_name LIKE '%".$srterm."%' OR fbk_comment LIKE '%".$srterm."%'   ) "; 
          $sqlcount.=" AND (trx.seller_sku LIKE '%".$srterm."%' OR order_no LIKE '%".$srterm."%'  OR trx.asin LIKE '%".$srterm."%' OR buyer_name LIKE '%".$srterm."%' OR fbk_comment LIKE '%".$srterm."%'   ) "; 
        }
        if(!empty($from_date))
        {
          $sqlquery.=" AND  fbk_date >= ".$this->db->escape($from_date.' 00:00:00')." AND fbk_date <=".$this->db->escape($to_date.' 23:59:00');
          $sqlcount.=" AND  fbk_date >= ".$this->db->escape($from_date.' 00:00:00')." AND fbk_date <=".$this->db->escape($to_date.' 23:59:00');
        }
       if(!empty($srasin) || $srasin !='')
        {
          $sqlquery.=" AND (asin LIKE '%".$srasin."%'  ) "; 
          $sqlcount.=" AND (asin LIKE '%".$srasin."%'   ) "; 
        }
		   if(!empty($prodtitle) || $prodtitle !='')
        {
          $sqlquery.=" AND (itm_title LIKE '%".$prodtitle."%'  ) "; 
          $sqlcount.=" AND (itm_title LIKE '%".$prodtitle."%'   ) "; 
        }
        $sqlquery.="GROUP BY order_id ORDER BY ".$orderby." ".$direction." LIMIT ".$offet.",".$limit;
        
		
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