<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Campaign_orders extends CI_Controller {
  public function  __construct()
  {
     parent::__construct();
  }
  public function match_campaign_orders()
  {
    $query=$this->db->query("SELECT * FROM amazon_profile WHERE is_active=1");
    $user=$query->result_array();
    if(count($user) > 0)
    {
      foreach($user as $usr)
      {
        $this->match_order_by_user($usr['store_id']);
      }
    }
  }
  public function match_order_by_user($user_id,$campaign_id=0)
  {
    echo "\n\n\n";
    $sql_qry="SELECT cpgn_id,cpgn_type,cpgn_fullfill,cpgn_hour,cpgn_min,cpgn_days,cpgn_day,cpgn_am_pm,cpgn_trigger,cpgn_if_no_review,cpgn_attachment,created_by,fbk_order,created_on,joined_on,DATEDIFF(CURDATE(),joined_on) AS diff FROM campaign_manager 
    INNER JOIN `store_access` AS b ON created_by=b.store_id 
    INNER JOIN scr_user ON scr_u_id=user_id  ";
    if($campaign_id != 0)
    {
      $sql_qry.=" AND cpgn_id=".$this->db->escape($campaign_id);
    }
    $sql_qry.=" AND created_by=".$user_id." AND is_active='1' AND is_deleted=0 ";
    echo $sql_qry;
    echo "\n\n\n";
    //die();
    $query=$this->db->query($sql_qry);
    $res=$query->result_array();
    // print_r($res);
    if(count($res) > 0)
    {
      foreach($res as $camp)
      {
          // echo "CAMP ID:".$camp['cpgn_id']."\t".$camp['created_on']."\t";
          $hour_add=(int)$camp['cpgn_am_pm']==2?12:0;
          $dat_add=(int)$camp['cpgn_days']>0?$camp['cpgn_days']:0;

            $ft_days=(int)$camp['diff'] > (int)$camp['cpgn_days']?$camp['cpgn_days']+1:(int)$camp['diff']+1;
            $no_of_day_to_fetch_from="-".$ft_days." days ";
           $fetch_from=date('Y-m-d 00:00:00',strtotime($no_of_day_to_fetch_from, strtotime(date("Y-m-d"))));
		   
		   $fetch_from_new=date('Y-m-d 00:00:00',strtotime('-30 days', strtotime(date("Y-m-d"))));
		   $fetch_from_pending=date('Y-m-d 00:00:00',strtotime('-10 days', strtotime(date("Y-m-d"))));
           if($camp['cpgn_trigger']=='1' || $camp['cpgn_trigger']=='2' || $camp['cpgn_trigger']=='3' ) 
		   {
           $sql="SELECT order_no,seller_sku,last_updated,purchase_date,shipped_on,IFNULL(calc_deliverydate,DATE_ADD(shipped_on, INTERVAL 5 DAY)) AS calc_deliverydate ";
           if($camp['fbk_order']==2 || $camp['cpgn_trigger']=='5')
           {
            $sql.=",fbk_date";
           }
           $sql.=" FROM campaign_asin";
           $sql.=" INNER JOIN amz_order_info AS odr ON cmp_id=".$camp['cpgn_id']."  AND odr.asin=cmp_asin AND odr.seller_sku=cmp_sku   AND sales_country=cmp_country AND IF(odr.fulfillment_channel='AFN','FBA','FBM')=cmp_fc AND store_id=".$user_id." AND buyer_email IS NOT NULL ";
		   print_r($camp['cpgn_trigger']);
		   //die();
		   
           $sql.=" INNER JOIN amz_ship_date as shp on sh_order_id=order_no AND shipped_on >'".$fetch_from."'";
		   }
		   if($camp['cpgn_trigger']=='5') 
		   {
			  $sql="SELECT order_no,last_updated,purchase_date";
           if($camp['fbk_order']==2 || $camp['cpgn_trigger']=='5')
           {
            $sql.=",fbk_date";
           }
           $sql.=" FROM campaign_asin";
           $sql.=" INNER JOIN amz_order_info AS odr ON cmp_id=".$camp['cpgn_id']."  AND odr.asin=cmp_asin AND odr.seller_sku=cmp_sku   AND sales_country=cmp_country AND IF(odr.fulfillment_channel='AFN','FBA','FBM')=cmp_fc AND store_id=".$user_id." AND buyer_email IS NOT NULL ";  
		   }
		   if($camp['cpgn_trigger']=='4') 
		   {
			  $sql="SELECT order_no,last_updated,purchase_date";
           if($camp['fbk_order']==2)
           {
            $sql.=",fbk_date";
           }
           $sql.=" FROM campaign_asin";
           $sql.=" INNER JOIN amz_order_info AS odr ON cmp_id=".$camp['cpgn_id']."  AND odr.asin=cmp_asin AND odr.seller_sku=cmp_sku   AND sales_country=cmp_country AND IF(odr.fulfillment_channel='AFN','FBA','FBM')=cmp_fc AND store_id=".$user_id." AND buyer_email IS NOT NULL  AND purchase_date > '".$fetch_from_pending."' ";  
		   }
		   if($camp['cpgn_trigger']=='5' ) 
		   {
           $sql.=" INNER JOIN amz_feedback_data ON  order_id=order_no AND fbk_for='".$user_id."' AND fbk_rating in (1,2) AND fbk_date > '".$fetch_from_new."'";
		   }
		   //print_r($sql);
		   //die();
           if($camp['cpgn_fullfill'] == '2')
           {
             $sql.=" AND odr.fulfillment_channel = 'AFN'";
           }
           if($camp['cpgn_fullfill'] == '3')
           {
             $sql.=" AND odr.fulfillment_channel = 'MFN'";
           }

            
           if($camp['cpgn_trigger']==4)
           {
              $sql.=" INNER JOIN (SELECT COUNT(*) AS c,buyer_email FROM `buyer_info` WHERE store_id=".$user_id." AND buyer_email <> '' GROUP BY buyer_email HAVING c > 1) as rpt ON rpt.buyer_email= odr.buyer_email ";
           }
            


         if($camp['cpgn_trigger']=='1')
             $sql.=" AND ((order_tfmstatus='PickedUp' AND order_status='Shipped') OR (order_status='Shipped'))";
          elseif($camp['cpgn_trigger']=='2')
             $sql.=" AND ((order_tfmstatus LIKE '%Delivered%' AND order_status='Shipped') OR (order_status='Shipped'))";
          elseif($camp['cpgn_trigger']=='4')
		   $sql.=" AND (order_status='Pending')";
		  
          if($camp['fbk_order']==2  &&  $camp['cpgn_trigger']=='1')
          {
            $sql.="RIGHT OUTER JOIN amz_feedback_data ON order_id=order_no 
                  WHERE  order_no IS NOT NULL
                  ";
          }
          if($camp['fbk_order']==0  &&  $camp['cpgn_trigger']=='1' )
          {
            $sql.="LEFT OUTER JOIN amz_feedback_data ON order_id=order_no 
                  WHERE  order_id IS NULL
                  ";
          }
		  if($camp['fbk_order']==2  &&  $camp['cpgn_trigger']=='2')
          {
            $sql.="RIGHT OUTER JOIN amz_feedback_data ON order_id=order_no 
                  WHERE  order_no IS NOT NULL
                  ";
          }
          if($camp['fbk_order']==0  &&  $camp['cpgn_trigger']=='2' )
          {
            $sql.="LEFT OUTER JOIN amz_feedback_data ON order_id=order_no 
                  WHERE  order_id IS NULL
                  ";
          }
         $qry=$this->db->query($sql);
         echo "\n\n\n";
         echo $sql;
         echo "\n\n\n";
         //die();
         $order=$qry->result_array();
         foreach($order as $ord)
         {
             $min_to_add=(($dat_add*1440)+(($hour_add+$camp['cpgn_hour'])*60))+$camp['cpgn_min'];
            if($camp['cpgn_trigger']==2)
             {
             $cur_date=date('Y-m-d 00:00:00',strtotime($ord['calc_deliverydate']));
			 }
             if($camp['cpgn_trigger']==1)
             {
               $cur_date=date('Y-m-d 00:00:00',strtotime($ord['shipped_on']));
             }
			 
			 if($camp['cpgn_trigger']==4)
             {
               $cur_date=date('Y-m-d 00:00:00',strtotime($ord['purchase_date']));
             }
              
             if($camp['fbk_order']==2)
             $cur_date=date('Y-m-d 00:00:00',strtotime($ord['fbk_date']));
		     if($camp['cpgn_trigger']==5)
             $cur_date=date('Y-m-d 00:00:00',strtotime($ord['fbk_date']));
            if($camp['cpgn_day']=='ALL')
			{
             $trigger_on = date('Y-m-d H:i:00',strtotime("+".$min_to_add." minutes", strtotime(date($cur_date))));
 
			 if(strtotime(date('Y-m-d H:i:00')) > strtotime($trigger_on))
              {
                $hr_add=((($hour_add+$camp['cpgn_hour'])*60))+$camp['cpgn_min'];
                $hr_tm=date('H:i:00',strtotime("+".$hr_add." minutes", strtotime(date('00:00:00'))));
                
                if(strtotime($hr_tm) > strtotime(date('H:i:00'))) 
                {
                  $add_days="+0 days";
                }
                else
                {
                  $add_days="+1 days"; 
                }

                $trigger_on_without_hr= date('Y-m-d 00:00:00',strtotime($add_days));
                $trigger_on= date('Y-m-d H:i:00',strtotime("+".$hr_add." minutes", strtotime(date($trigger_on_without_hr))));
              }
			}
		
             
             $bulk_data[]="(".$camp['cpgn_id'].",'".$ord['order_no']."','".$ord['seller_sku']."','".$trigger_on."')";
             
             if(isset($bulk_data) && count($bulk_data)>=500)
              {
                $quer=implode(',',$bulk_data);
                $qi="INSERT IGNORE INTO campaign_order_list (camp_id,camp_order_no,camp_sku,trigger_on)VALUES". 
                $quer;
                $this->db->query($qi);
                unset($bulk_data);
                unset($quer);
              }
         }
         if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
          {
                $quer=implode(',',$bulk_data);
                $qi="INSERT IGNORE INTO campaign_order_list (camp_id,camp_order_no,camp_sku,trigger_on)VALUES". 
                $quer;
                $this->db->query($qi);
                unset($bulk_data);
                unset($quer);
          }
    }
   }
  }
  
  
}
