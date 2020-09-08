<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report_file_process extends CI_Model
{
  public function  __construct()
  {
      parent::__construct();
  }
  public function update_report_feed_log($store_id,$req_id)
  {
    $this->db->query("UPDATE report_feed SET is_processed=1 WHERE req_id=".$req_id);    
  }
  public function process_afn_inventory_data($store_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if($fp)
    {
     $i=0;
     while (!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        if($i>=1 && !empty($buffer[0]) && $buffer[4]=='SELLABLE')
        {
           $sku= isset($buffer[0])?$this->db->escape($buffer[0]):'';             
           $asin= isset($buffer[2])?$this->db->escape($buffer[2]):'';             
           $itm_qty=isset($buffer[5]) && !empty($buffer[5])?$this->db->escape($buffer[5]):'NULL';
           echo $sku."\t".$asin."\t".$itm_qty."\t".$buffer[4]."\n";
           if($itm_qty!='NULL')
           $bulk_data_with_qty[]="(".$sku.",".$asin.",".$itm_qty.",".$store_id.",'".$country."','FBA')";
           else
           $bulk_data_without_qty[]="(".$sku.",".$asin.",".$store_id.",'".$country."','FBA')";             
        }

        if(isset($bulk_data_with_qty) && count($bulk_data_with_qty)>=500)
        {
          $quer_qty=implode(',',$bulk_data_with_qty);
          $qi_qty="INSERT INTO `customer_product` (prod_sku,prod_asin,itm_qty,store_id,prod_country,fc_code)VALUES 
          $quer_qty 
          ON DUPLICATE KEY 
          UPDATE
          prod_sku=VALUES(prod_sku),prod_asin=VALUES(prod_asin),itm_qty=VALUES(itm_qty),prod_country=VALUES(prod_country),fc_code=VALUES(fc_code);";
          $this->db->query($qi_qty);
          unset($bulk_data_with_qty);
          unset($quer_qty);
        }
        if(isset($bulk_data_without_qty) && count($bulk_data_without_qty)>=500)
        {
          $quer_wqty=implode(',',$bulk_data_without_qty);
          $qi_wqty="INSERT INTO `customer_product` (prod_sku,prod_asin,store_id,prod_country,fc_code)VALUES 
          $quer_wqty 
          ON DUPLICATE KEY 
          UPDATE
          prod_sku=VALUES(prod_sku),prod_asin=VALUES(prod_asin),prod_country=VALUES(prod_country),fc_code=VALUES(fc_code);";
          $this->db->query($qi_wqty);
          unset($bulk_data_without_qty);
          unset($quer_wqty);
        }  
        $i++;
     }
     if(isset($bulk_data_with_qty) && count($bulk_data_with_qty)<500 && count($bulk_data_with_qty) > 0 )
        {
          $quer_qty=implode(',',$bulk_data_with_qty);
          $qi_qty="INSERT INTO `customer_product` (prod_sku,prod_asin,itm_qty,store_id,prod_country,fc_code)VALUES 
          $quer_qty 
          ON DUPLICATE KEY 
          UPDATE
          prod_sku=VALUES(prod_sku),prod_asin=VALUES(prod_asin),itm_qty=VALUES(itm_qty),prod_country=VALUES(prod_country),fc_code=VALUES(fc_code);";
          $this->db->query($qi_qty);
          unset($bulk_data_with_qty);
          unset($quer_qty);
        }
        if(isset($bulk_data_without_qty) && count($bulk_data_without_qty)<500 && count($bulk_data_without_qty)>0)
        {
          $quer_wqty=implode(',',$bulk_data_without_qty);
          $qi_wqty="INSERT INTO `customer_product` (prod_sku,prod_asin,store_id,prod_country,fc_code)VALUES 
          $quer_wqty 
          ON DUPLICATE KEY 
          UPDATE
          prod_sku=VALUES(prod_sku),prod_asin=VALUES(prod_asin),prod_country=VALUES(prod_country),fc_code=VALUES(fc_code);";
          $this->db->query($qi_wqty);
          unset($bulk_data_without_qty);
          unset($quer_wqty);
        }  

     // if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     // {
     //        $quer=implode(',',$bulk_data);
     //        $qi="INSERT INTO `customer_product` (prod_sku,prod_asin,itm_qty,store_id,prod_country,fc_code)VALUES 
     //        $quer 
     //        ON DUPLICATE KEY 
     //        UPDATE
     //        prod_sku=VALUES(prod_sku),prod_asin=VALUES(prod_asin),itm_qty=VALUES(itm_qty),prod_country=VALUES(prod_country),fc_code=VALUES(fc_code);";
     //        $this->db->query($qi);
     //        unset($bulk_data);
     //        unset($quer);
     // }
     fclose($fp);
    } 
  }
  public function process_inventory_data($store_id,$report_file,$country,$request_type)
  {
     if($request_type=='_GET_MERCHANT_LISTINGS_DATA_')
     {
         $is_active=1;
         // $this->db->query("UPDATE customer_product SET is_deleted=1 WHERE is_active=1 and store_id=".$store_id); 
         //$this->db->query("UPDATE customer_product SET is_active=-1 WHERE is_active=1 and store_id=".$store_id); 
     }
     elseif($request_type=='_GET_MERCHANT_LISTINGS_INACTIVE_DATA_')
     {
        $is_active=0; 
        // $this->db->query("UPDATE customer_product SET is_deleted=1 WHERE is_active=0 and store_id=".$store_id); 
       // $this->db->query("UPDATE customer_product SET is_active=-1 WHERE is_active=0 and store_id=".$store_id); 
     }
    $fp=fopen($report_file,'r');
    if ($fp)
    {
    
     $i=0;
     while (!feof($fp)) 
     {
            $buffer = fgetcsv($fp,0,"\t");
            if($i>=1 && !empty($buffer[3]) && $country!='FR')
            {
               $title= isset($buffer[0])?$this->db->escape($buffer[0]):'';
               $sku= isset($buffer[3])?$this->db->escape($buffer[3]):'';             
               $itm_price=isset($buffer[4])?$this->db->escape(str_replace(',','.',$buffer[4])):'';
               $itm_qty=isset($buffer[5]) && !empty($buffer[5])?$this->db->escape($buffer[5]):'NULL';
               $open_date=isset($buffer[6])?$buffer[6]:'';
			   $open_date=substr($open_date,0,20);
			   //print_r($po_date);
			   //echo "\n";
			   $open_date=str_replace('/', '-', $open_date); 
               $open_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($open_date)));
               $itm_con=isset($buffer[12])?$this->db->escape($buffer[12]):'';
               $asin=isset($buffer[16])?$this->db->escape($buffer[16]):'';
               if(isset($buffer[26]) && $buffer[26]=='DEFAULT')
               {
                $fc_code='FBM';
               }
               else
               {
               $fc_code='FBA'; 
               }
               $fullfillment_type=isset($buffer[26])?$this->db->escape($buffer[26]):'';
               if($itm_qty!='NULL')
               // $bulk_data_with_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$itm_qty.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')";
               $bulk_data_with_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$itm_qty.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')"; 
               else  
               // $bulk_data_without_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')";  
               $bulk_data_without_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')"; 
           }
           elseif($i>=1 && !empty($buffer[3]) && $country=='FR')
           {
               $title= isset($buffer[0])?$this->db->escape($buffer[0]):'';
               $sku= isset($buffer[2])?$this->db->escape($buffer[2]):'';             
               $itm_price=isset($buffer[3])?$this->db->escape(str_replace(',','.',$buffer[3])):'';
               $itm_qty=isset($buffer[4]) && !empty($buffer[4])?$this->db->escape($buffer[4]):'NULL';
               //$open_date=isset($buffer[5])?$this->db->escape($buffer[5]):'';
			   
			   $open_date=isset($buffer[5])?$buffer[5]:'';
			   $open_date=substr($open_date,0,20);
			   //print_r($po_date);
			   //echo "\n";
			   $open_date=str_replace('/', '-', $open_date); 
               $open_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($open_date)));
			   
               // $open_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($open_date)));
               $itm_con=isset($buffer[8])?$this->db->escape($buffer[8]):'';
               $asin=isset($buffer[11])?$this->db->escape($buffer[11]):'';
               if(isset($buffer[13]) && $buffer[13]=='DEFAULT')
               {
                $fc_code='FBM';
               }
               else
               {
               $fc_code='FBA'; 
               }
               $fullfillment_type=isset($buffer[13])?$this->db->escape($buffer[13]):'';
               if($itm_qty!='NULL')
               // $bulk_data_with_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$itm_qty.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')";
               $bulk_data_with_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$itm_qty.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')";
               else 
               // $bulk_data_without_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')"; 
               $bulk_data_without_qty[]="(".$title.",".$asin.",".$sku.",".$itm_price.",".$open_date.",".$itm_con.",".$store_id.",".$is_active.",'".$country."',".$fullfillment_type.",'".$fc_code."')"; 

           }
           if(isset($bulk_data_with_qty) && count($bulk_data_with_qty)>=500)
           {
              $quer_qty=implode(',',$bulk_data_with_qty);
              $qi_qty="INSERT INTO `customer_product` (prod_title,prod_asin,prod_sku,itm_price,itm_qty,open_date,itm_condition,store_id,is_active,prod_country,fullfillment_type,fc_code)VALUES 
              $quer_qty 
              ON DUPLICATE KEY 
              UPDATE
              prod_title=VALUES(prod_title),prod_asin=VALUES(prod_asin),prod_sku=VALUES(prod_sku),itm_price=VALUES(itm_price),itm_qty=VALUES(itm_qty),open_date=VALUES(open_date),itm_condition=VALUES(itm_condition),is_active=VALUES(is_active),prod_country=VALUES(prod_country),fullfillment_type=VALUES(fullfillment_type),fc_code=VALUES(fc_code);";
              $this->db->query($qi_qty);
              unset($bulk_data_with_qty);
              unset($quer_qty);
           }
           if(isset($bulk_data_without_qty) && count($bulk_data_without_qty)>=500)
           {
              $quer_wqty=implode(',',$bulk_data_without_qty);
              $qi_wqty="INSERT INTO `customer_product` (prod_title,prod_asin,prod_sku,itm_price,open_date,itm_condition,store_id,is_active,prod_country,fullfillment_type,fc_code)VALUES 
              $quer_wqty 
              ON DUPLICATE KEY 
              UPDATE
              prod_title=VALUES(prod_title),prod_asin=VALUES(prod_asin),prod_sku=VALUES(prod_sku),open_date=VALUES(open_date),itm_condition=VALUES(itm_condition),itm_price=VALUES(itm_price),is_active=VALUES(is_active),prod_country=VALUES(prod_country),fullfillment_type=VALUES(fullfillment_type),fc_code=VALUES(fc_code);";
              $this->db->query($qi_wqty);
              unset($bulk_data_without_qty);
              unset($quer_wqty);
           }  
           $i++;
    }//while ends here
    if(isset($bulk_data_with_qty) && count($bulk_data_with_qty)<500 && count($bulk_data_with_qty)>0)
           {
              $quer_qty=implode(',',$bulk_data_with_qty);
              $qi_qty="INSERT INTO `customer_product` (prod_title,prod_asin,prod_sku,itm_price,itm_qty,open_date,itm_condition,store_id,is_active,prod_country,fullfillment_type,fc_code)VALUES 
              $quer_qty 
              ON DUPLICATE KEY 
              UPDATE
              prod_title=VALUES(prod_title),itm_price=VALUES(itm_price),prod_asin=VALUES(prod_asin),prod_sku=VALUES(prod_sku),itm_qty=VALUES(itm_qty),open_date=VALUES(open_date),itm_condition=VALUES(itm_condition),is_active=VALUES(is_active),prod_country=VALUES(prod_country),fullfillment_type=VALUES(fullfillment_type),fc_code=VALUES(fc_code);";
              $this->db->query($qi_qty);
              unset($bulk_data_with_qty);
              unset($quer_qty);
           }
           if(isset($bulk_data_without_qty) && count($bulk_data_without_qty)<500 && count($bulk_data_without_qty)>0)
           {
              $quer_wqty=implode(',',$bulk_data_without_qty);
              $qi_wqty="INSERT INTO `customer_product` (prod_title,prod_asin,prod_sku,itm_price,open_date,itm_condition,store_id,is_active,prod_country,fullfillment_type,fc_code)VALUES 
              $quer_wqty 
              ON DUPLICATE KEY 
              UPDATE
              prod_title=VALUES(prod_title),itm_price=VALUES(itm_price),prod_asin=VALUES(prod_asin),prod_sku=VALUES(prod_sku),open_date=VALUES(open_date),itm_condition=VALUES(itm_condition),is_active=VALUES(is_active),prod_country=VALUES(prod_country),fullfillment_type=VALUES(fullfillment_type),fc_code=VALUES(fc_code);";
              $this->db->query($qi_wqty);
              unset($bulk_data_without_qty);
              unset($quer_wqty);
           }
        // if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
        // {
        //   $quer=implode(',',$bulk_data);
        //   $qi="INSERT INTO `customer_product` (prod_title,prod_asin,prod_sku,itm_price,itm_qty,open_date,itm_condition,store_id,is_active,prod_country,fullfillment_type,fc_code)VALUES 
        //   $quer 
        //   ON DUPLICATE KEY 
        //   UPDATE
        //   prod_title=VALUES(prod_title),prod_asin=VALUES(prod_asin),prod_sku=VALUES(prod_sku),itm_price=VALUES(itm_price),itm_qty=VALUES(itm_qty),open_date=VALUES(open_date),itm_condition=VALUES(itm_condition),is_active=VALUES(is_active),prod_country=VALUES(prod_country),fullfillment_type=VALUES(fullfillment_type),fc_code=VALUES(fc_code);";
        //   $this->db->query($qi);
        //   unset($bulk_data);
        //   unset($quer);
        // }  
      fclose($fp);  
        
      }    
  }
  public function process_order_data_by_date($store_id,$report_file,$country,$request_type)
  {
    $store_map=$this->report_process->get_all_stores_for_mapping($store_id);
    
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
       
        if($i>=1 && !empty($buffer[0]) )
        {
         
             $amz_order_id= isset($buffer[0])?$this->db->escape($buffer[0]):'';
             $last_update= isset($buffer[3])?$this->db->escape($buffer[3]):"''";             
             $order_status= isset($buffer[4])?$buffer[4]:'';
             $split_sts=explode('-',$order_status);
             $order_status=isset($split_sts[0])?trim($split_sts[0]):'';
             $order_tfmstatus=isset($split_sts[1])?trim($split_sts[1]):'';             
             if($order_status=='Cancelled')
             {
               $order_status='Canceled'; 
             }
             $order_status=!empty($order_status)?$this->db->escape($order_status):"''";
             $order_tfmstatus=!empty($order_tfmstatus)?$this->db->escape($order_tfmstatus):"''";
             $po_date=isset($buffer[2])?$this->db->escape($buffer[2]):'';
             $itm_title=isset($buffer[10])?$this->db->escape($buffer[10]):'';
             $sku=isset($buffer[11])?$this->db->escape($buffer[11]):'';
             $asin=isset($buffer[12])?$this->db->escape($buffer[12]):'';
             $itm_status=isset($buffer[13])?$this->db->escape($buffer[13]):'';
             // $itm_qty=isset($buffer[14])?$this->db->escape($buffer[14]):'NULL';
             $itm_qty=isset($buffer[14]) && !empty($buffer[14])?$this->db->escape($buffer[14]):'NULL';
             $cur_code=isset($buffer[15])?$this->db->escape($buffer[15]):'';
             $itm_price=isset($buffer[16])?$this->db->escape($buffer[16]):'';
             $itm_tax=isset($buffer[17])?$this->db->escape($buffer[17]):'';
             $ship_price=isset($buffer[18])?$this->db->escape($buffer[18]):'';
             $ship_tax=isset($buffer[19])?$this->db->escape($buffer[19]):'';
             $f_channel=isset($buffer[5])?$this->db->escape($buffer[5]):'';
             $sale_channel= $buffer[6];
             $country='';
             $cnt=explode('.',$sale_channel);
             if(count($cnt) > 1)
             {
              $contry=$cnt[count($cnt)-1];
              if($contry=='com')
              {
                  $contry='US';
              }
              $country=strtoupper($contry); 
             }
              // echo $buffer[6];
             $sale_channel= isset($buffer[6])?$this->db->escape($buffer[6]):'';          
             $country=  !empty($country)?$this->db->escape($country):'';


             $mapped_store_id="";
            
             foreach($store_map as $rs)
             {
              if(strtolower($buffer[6])==$rs['amz_domain'])
              {
                // echo " T R U E   ";
                $mapped_store_id=$rs['store_id'];
              }
             }


             

             // echo "(".$amz_order_id.",".$last_update.",".$order_status.",".$order_tfmstatus.",".$store_id.")"."\n";
             if(!empty($mapped_store_id))
             {
             $bulk_data[]="(".$amz_order_id.",".$last_update.",".$order_status.",".$order_tfmstatus.",".$mapped_store_id.",".$po_date.",".$itm_title.",".$sku.",".$asin.",".$itm_status.",".$itm_qty.",".$cur_code.",".$itm_price.",".$itm_tax.",".$ship_price.",".$sale_channel.",".$country.")";      
             }
             // else
             // {
             //  echo "\n$amz_order_id\tch\t$sale_channel\tMST$mapped_store_id";
             // }
             
         
        }

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
         // print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,last_updated,order_status,order_tfmstatus,store_id,purchase_date,itm_title,seller_sku,asin,itm_status,itm_qty,currency_code,itm_price,itm_tax,itm_ship_price,sales_channel,sales_country)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE
          order_no=VALUES(order_no),last_updated=VALUES(last_updated),order_status=VALUES(order_status),order_tfmstatus=VALUES(order_tfmstatus),store_id=VALUES(store_id),purchase_date=values(purchase_date),itm_title=values(itm_title),seller_sku=values(seller_sku),asin=values(asin),itm_status=values(itm_status),itm_qty=values(itm_qty),currency_code=values(currency_code),itm_price=values(itm_price),itm_tax=values(itm_tax),itm_ship_price=values(itm_ship_price),sales_channel=VALUES(sales_channel),sales_country=VALUES(sales_country);";
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
          //print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,last_updated,order_status,order_tfmstatus,store_id,purchase_date,itm_title,seller_sku,asin,itm_status,itm_qty,currency_code,itm_price,itm_tax,itm_ship_price,sales_channel,sales_country)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE
          order_no=VALUES(order_no),last_updated=VALUES(last_updated),order_status=VALUES(order_status),order_tfmstatus=VALUES(order_tfmstatus),store_id=VALUES(store_id),purchase_date=values(purchase_date),itm_title=values(itm_title),seller_sku=values(seller_sku),asin=values(asin),itm_status=values(itm_status),itm_qty=values(itm_qty),currency_code=values(currency_code),itm_price=values(itm_price),itm_tax=values(itm_tax),itm_ship_price=values(itm_ship_price),sales_channel=VALUES(sales_channel),sales_country=VALUES(sales_country);";
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
     }
     fclose($fp);
    }  
  }
  public function process_order_data_by_date_for_ship_table($store_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        if($i>=1 && !empty($buffer[0]) )
        {
           $amz_order_id= isset($buffer[0])?$this->db->escape($buffer[0]):'';
		   $last_update= isset($buffer[3])?$this->db->escape($buffer[3]):"''";
           $order_status= isset($buffer[4])?$buffer[4]:'';
           $split_sts=explode('-',$order_status);
           $order_status=isset($split_sts[0])?trim($split_sts[0]):'';
           $order_status=!empty($order_status)?$this->db->escape($order_status):"''";
           if($order_status==="'Shipped'")
           {
              $bulk_data[]="(".$amz_order_id.",".$order_status.",".$last_update.",".$store_id.")";         
           }
        }

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
          $quer=implode(',',$bulk_data);
          $qi="INSERT IGNORE INTO `amz_ship_date` (sh_order_id,sh_status,shipped_on,client_id)VALUES ".$quer ;
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
        $quer=implode(',',$bulk_data);
        $qi="INSERT IGNORE INTO `amz_ship_date` (sh_order_id,sh_status,shipped_on,client_id)VALUES ".$quer ;
        $this->db->query($qi);
        unset($bulk_data);
        unset($quer);
     }
     fclose($fp);
    }  
  }
  public function process_actionable_order_data($store_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
       // print_r($buffer);
        if($i>=1 && !empty($buffer[0]) )
        {
             $amz_order_id= isset($buffer[0])?$this->db->escape($buffer[0]):'';
             $item_id= isset($buffer[1])?$this->db->escape($buffer[1]):'';
             $po_date= isset($buffer[2])?$this->db->escape($buffer[2]):'';
             $ship_date=isset($buffer[5])?$this->db->escape($buffer[5]):'';
             $buyer_email=isset($buffer[7])?$this->db->escape($buffer[7]):'';
             $buyer_name=isset($buffer[8])?$this->db->escape($buffer[8]):'';
             $sku=isset($buffer[10])?$this->db->escape($buffer[10]):'';
             $itm_title=isset($buffer[11])?$this->db->escape($buffer[11]):'';
             $qty_purchased=isset($buffer[12])?$this->db->escape($buffer[12]):'';
             $qty_shipped=isset($buffer[13])?$this->db->escape($buffer[13]):'';
             $ship_name=isset($buffer[16])?$this->db->escape($buffer[16]):'';
             $ship_addr1=isset($buffer[17])?$this->db->escape($buffer[17]):'';
             $ship_addr2=isset($buffer[18])?$this->db->escape($buffer[18]):'';
             $ship_city=isset($buffer[20])?$this->db->escape($buffer[20]):'';
             $ship_state=isset($buffer[21])?$this->db->escape($buffer[21]):'';
             $ship_zip=isset($buffer[22])?$this->db->escape($buffer[22]):'';
             $ship_country=isset($buffer[23])?$this->db->escape($buffer[23]):'';
             
             // echo "(".$amz_order_id.",".$last_update.",".$order_status.",".$order_tfmstatus.",".$store_id.")"."\n";
             // $bulk_data[]="(".$amz_order_id.",".$last_update.",".$order_status.",".$order_tfmstatus.",".$store_id.",".$po_date.",".$itm_title.",".$sku.",".$asin.",".$itm_status.",".$itm_qty.",".$cur_code.",".$itm_price.",".$itm_tax.",".$ship_price.")";     
             $bulk_data[]="(".$amz_order_id.",".$item_id.",".$po_date.",".$ship_date.",".$buyer_email.",".$buyer_name.",".$sku.",".$itm_title.",".$qty_purchased.",".$qty_shipped.",".$ship_name.",".$ship_addr1.",".$ship_addr2.",".$ship_city.",".$ship_state.",".$ship_country.",".$ship_zip.",".$store_id.")";     
        }

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
         // print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,item_id,purchase_date,calc_shipdate,buyer_email,buyer_name,seller_sku,itm_title,itm_qty,no_of_itm_shipped,shipping_name,shipping_addr1,shipping_addr2,shipping_city,shipping_state,shipping_country,shipping_zip,store_id)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE 
          order_no=values(order_no),item_id=values(item_id),purchase_date=values(purchase_date),calc_shipdate=values(calc_shipdate),buyer_email=values(buyer_email),buyer_name=values(buyer_name),seller_sku=values(seller_sku),
          itm_title=values(itm_title),itm_qty=values(itm_qty),no_of_itm_shipped=values(no_of_itm_shipped),shipping_name=values(shipping_name),shipping_addr1=values(shipping_addr1),shipping_addr2=values(shipping_addr2),shipping_city=values(shipping_city),shipping_state=values(shipping_state),shipping_country=values(shipping_country),shipping_zip=values(shipping_zip),store_id=values(store_id);
          ";
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
          //print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,item_id,purchase_date,calc_shipdate,buyer_email,buyer_name,seller_sku,itm_title,itm_qty,no_of_itm_shipped,shipping_name,shipping_addr1,shipping_addr2,shipping_city,shipping_state,shipping_country,shipping_zip,store_id)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE 
          order_no=values(order_no),item_id=values(item_id),purchase_date=values(purchase_date),calc_shipdate=values(calc_shipdate),buyer_email=values(buyer_email),buyer_name=values(buyer_name),seller_sku=values(seller_sku),
          itm_title=values(itm_title),itm_qty=values(itm_qty),no_of_itm_shipped=values(no_of_itm_shipped),shipping_name=values(shipping_name),shipping_addr1=values(shipping_addr1),shipping_addr2=values(shipping_addr2),shipping_city=values(shipping_city),shipping_state=values(shipping_state),shipping_country=values(shipping_country),shipping_zip=values(shipping_zip),store_id=values(store_id);
          ";
         
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
     }
     fclose($fp);
    }  
  }
  public function process_converged_order_data($store_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        if($i>=1 && !empty($buffer[1]) )
        {
             $amz_order_id=isset($buffer[1])?$this->db->escape($buffer[1]):'';
             $order_total=isset($buffer[11])?$this->db->escape($buffer[11]):'';
             $po_date=isset($buffer[12])?$buffer[12]:null;
			 $po_date=substr($po_date,0,20);
			  //print_r($po_date);
			  //echo "\n";
			  $po_date=str_replace('/', '-', $po_date); 
			  //print_r($po_date);
			  //echo "\n";
             // $buyer_email=isset($buffer[14])?$this->db->escape($buffer[14]):'';
             // $buyer_name=isset($buffer[15])?$this->db->escape($buffer[15]):'';
             $ship_addr=isset($buffer[17])?$this->db->escape($buffer[17]):'';
             // $ship_city=isset($buffer[21])?$this->db->escape($buffer[21]):'';
             // $ship_state=isset($buffer[20])?$this->db->escape($buffer[20]):'';
             // $ship_zip=isset($buffer[21])?$this->db->escape($buffer[21]):'';
             // $ship_country=isset($buffer[22])?$this->db->escape($buffer[22]):'';
             $po_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($po_date)));
		
			 //print_r($po_date);
			 //die();
             $item_id=isset($buffer[2])?$this->db->escape($buffer[2]):'';
             $pay_date=isset($buffer[3])?$buffer[3]:null;
             $pay_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($pay_date)));
             $itm_title=isset($buffer[5])?$this->db->escape($buffer[5]):'';
             $sku=isset($buffer[7])?$this->db->escape($buffer[7]):'';
             $itm_price=isset($buffer[8])?$this->db->escape($buffer[8]):'';
             $ship_price=isset($buffer[9])?$this->db->escape($buffer[9]):'';
             $qty_purchased=isset($buffer[10])?$this->db->escape($buffer[10]):'';
             $order_total=isset($buffer[11])?$this->db->escape($buffer[11]):'';
             // $po_date=isset($buffer[12])?$this->db->escape($buffer[12]):'';
             $buyer_email=isset($buffer[14])?$this->db->escape($buffer[14]):'';
             $buyer_name=isset($buffer[15])?$this->db->escape($buffer[15]):'';
             $ship_name=isset($buffer[16])?$this->db->escape($buffer[16]):'';
             // $ship_addr1=isset($buffer[17])?$this->db->escape($buffer[17]):'';
             $ship_addr2=isset($buffer[18])?$this->db->escape($buffer[18]):'';
             $ship_city=isset($buffer[19])?$this->db->escape($buffer[19]):'';
             $ship_state=isset($buffer[20])?$this->db->escape($buffer[20]):'';
             $ship_zip=isset($buffer[21])?$this->db->escape($buffer[21]):'';
             $ship_country=isset($buffer[22])?$this->db->escape($buffer[22]):'';
             $bulk_data[]="(".$amz_order_id.",".$order_total.",".$po_date.",".$buyer_name.",".$buyer_email.",".$ship_addr.",".$ship_city.",".$ship_state.",".$ship_zip.",".$ship_country.",".$store_id.",".$item_id.",".$pay_date.",".$itm_title.",".$sku.",".$itm_price.",".$ship_price.",".$qty_purchased.",".$ship_name.",".$ship_addr2.")";     
             
             

        }

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
          // print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,order_total,purchase_date,buyer_name,buyer_email,shipping_addr1,shipping_city,shipping_state,shipping_zip,shipping_country,store_id,item_id,payment_date,itm_title,seller_sku,itm_price,itm_ship_price,itm_qty,shipping_name,shipping_addr2)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE
          order_no=VALUES(order_no),order_total=VALUES(order_total),purchase_date=VALUES(purchase_date),buyer_name=values(buyer_name),buyer_email=values(buyer_email),shipping_addr1=values(shipping_addr1),shipping_city=values(shipping_city),shipping_state=values(shipping_state),shipping_zip=values(shipping_zip),shipping_country=values(shipping_country),store_id=VALUES(store_id),
          item_id=values(item_id),payment_date=values(payment_date),itm_title=values(itm_title),seller_sku=values(seller_sku),itm_price=values(itm_price),itm_ship_price=values(itm_ship_price),itm_qty=values(itm_qty),shipping_name=values(shipping_name),shipping_addr2=values(shipping_addr2);";
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
          // print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,order_total,purchase_date,buyer_name,buyer_email,shipping_addr1,shipping_city,shipping_state,shipping_zip,shipping_country,store_id,item_id,payment_date,itm_title,seller_sku,itm_price,itm_ship_price,itm_qty,shipping_name,shipping_addr2)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE
          order_no=VALUES(order_no),order_total=VALUES(order_total),purchase_date=VALUES(purchase_date),buyer_name=values(buyer_name),buyer_email=values(buyer_email),shipping_addr1=values(shipping_addr1),shipping_city=values(shipping_city),shipping_state=values(shipping_state),shipping_zip=values(shipping_zip),shipping_country=values(shipping_country),store_id=VALUES(store_id),
          item_id=values(item_id),payment_date=values(payment_date),itm_title=values(itm_title),seller_sku=values(seller_sku),itm_price=values(itm_price),itm_ship_price=values(itm_ship_price),itm_qty=values(itm_qty),shipping_name=values(shipping_name),shipping_addr2=values(shipping_addr2);";
          
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
     }
     fclose($fp);
    }  
  }
  public function process_fba_shipments_data($store_id,$report_file,$country,$request_type)
  {
    $store_map=$this->report_process->get_all_stores_for_mapping($store_id);
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        
        if($i>=1 && !empty($buffer[0]) )
        {
          if(empty($buffer[1]))
          {
             $amz_order_id= isset($buffer[0])?$this->db->escape($buffer[0]):'';
             $amz_order_itm_id= isset($buffer[4])?$this->db->escape($buffer[4]):'';

             $pay_date= isset($buffer[7])?$this->db->escape($buffer[7]):'';             
             // $pay_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($pay_date))); 
             $ship_date= isset($buffer[8])?$this->db->escape($buffer[8]):'';             
             // $ship_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($ship_date))); 
             $track_no= isset($buffer[43])?$this->db->escape($buffer[43]):'';             
             $esp_deliv_date= isset($buffer[44])?$this->db->escape($buffer[44]):''; 
             // $esp_deliv_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($esp_deliv_date))); 

             // $order_total=isset($buffer[11])?$this->db->escape($buffer[11]):'';
             $po_date=isset($buffer[6])?$this->db->escape($buffer[6]):'';
             $buyer_email=isset($buffer[10])?$this->db->escape($buffer[10]):'';
             // $buyer_phone=isset($buffer[12])?$this->db->escape($buffer[12]):'';
             $buyer_name=isset($buffer[11])?$this->db->escape($buffer[11]):'';
             $ship_addr=isset($buffer[25])?$this->db->escape($buffer[25]):'';
             $ship_addr2=isset($buffer[26])?$this->db->escape($buffer[26]):'';
             $ship_city=isset($buffer[28])?$this->db->escape($buffer[28]):'';
             $ship_state=isset($buffer[29])?$this->db->escape($buffer[29]):'';
             $ship_zip=isset($buffer[30])?$this->db->escape($buffer[30]):'';
             $ship_country=isset($buffer[31])?$this->db->escape($buffer[31]):'';
             $ship_phone=isset($buffer[32])?$this->db->escape($buffer[32]):'';
             $sku=isset($buffer[13])?$this->db->escape($buffer[13]):'';
             $title=isset($buffer[14])?$this->db->escape($buffer[14]):'';
             $qty_shipped=isset($buffer[15])?$this->db->escape($buffer[15]):'';
             $cur_code=isset($buffer[16])?$this->db->escape($buffer[16]):'';
             $itm_price=isset($buffer[17])?$this->db->escape($buffer[17]):'';
             $itm_tax=isset($buffer[18])?$this->db->escape($buffer[18]):'';
             $ship_price=isset($buffer[19])?$this->db->escape($buffer[19]):'';
             $ship_level=isset($buffer[20])?$this->db->escape($buffer[20]):'';
             $f_channel=isset($buffer[46])?$this->db->escape($buffer[46]):'';
             // $po_date=$this->db->escape(date('Y-m-d H:i:s',strtotime($po_date)));
             $sale_channel= $buffer[47];
             $country='';
             $cnt=explode('.',$sale_channel);
             if(count($cnt) > 1)
             {

              $contry=$cnt[count($cnt)-1];
              if($contry=='com')
              {
                  $contry='US';
              }
              $country=strtoupper($contry); 
             }
             $sale_channel= isset($buffer[47])?$this->db->escape($buffer[47]):'';          
             $country=  !empty($country)?$this->db->escape($country):'';

             $mapped_store_id="";
             foreach($store_map as $rs)
             {
              if(strtolower($buffer[47])==$rs['amz_domain'])
              {
                $mapped_store_id=$rs['store_id'];
              }
             }
             if(!empty($mapped_store_id))
             {
           // echo "(".$amz_order_id.",".$pay_date.",".$ship_date.",".$track_no.",".$esp_deliv_date.",".$sale_channel.",".$mapped_store_id.",".$country.",".$po_date.",".$buyer_name.",".$buyer_email.",".$ship_addr.",".$ship_city.",".$ship_state.",".$ship_zip.",".$ship_country.",".$amz_order_itm_id.",".$ship_addr2.",".$ship_phone.",".$sku.",".$title.",".$qty_shipped.",".$cur_code.",".$itm_price.",".$itm_tax.",".$ship_price.",".$f_channel.")\n";
              $bulk_data[]="(".$amz_order_id.",".$pay_date.",".$ship_date.",".$track_no.",".$esp_deliv_date.",".$sale_channel.",".$mapped_store_id.",".$country.",".$po_date.",".$buyer_name.",".$buyer_email.",".$ship_addr.",".$ship_city.",".$ship_state.",".$ship_zip.",".$ship_country.",".$amz_order_itm_id.",".$ship_addr2.",".$ship_phone.",".$sku.",".$title.",".$qty_shipped.",".$cur_code.",".$itm_price.",".$itm_tax.",".$ship_price.",".$f_channel.")";     
             }
              
          }    
        }

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
          // print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,payment_date,calc_shipdate,tracking_number,calc_deliverydate,sales_channel,store_id,sales_country,purchase_date,buyer_name,buyer_email,shipping_addr1,shipping_city,shipping_state,shipping_zip,shipping_country,item_id,shipping_addr2,shipping_phone,seller_sku,itm_title,no_of_itm_shipped,currency_code,itm_price,itm_tax,itm_ship_price,fulfillment_channel)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE
          order_no=VALUES(order_no),payment_date=VALUES(payment_date),calc_shipdate=VALUES(calc_shipdate),tracking_number=VALUES(tracking_number),calc_deliverydate=VALUES(calc_deliverydate),sales_channel=VALUES(sales_channel),store_id=VALUES(store_id),sales_country=VALUES(sales_country),purchase_date=VALUES(purchase_date),buyer_name=values(buyer_name),buyer_email=values(buyer_email),shipping_addr1=values(shipping_addr1),shipping_city=values(shipping_city),shipping_state=values(shipping_state),shipping_zip=values(shipping_zip),shipping_country=values(shipping_country),item_id=values(item_id),
          shipping_addr2=values(shipping_addr2),shipping_phone=values(shipping_phone),seller_sku=values(seller_sku),itm_title=values(itm_title),no_of_itm_shipped=values(no_of_itm_shipped),currency_code=values(currency_code),itm_price=values(itm_price),itm_tax=values(itm_tax),itm_ship_price=values(itm_ship_price),fulfillment_channel=values(fulfillment_channel);";
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
         // print_r($bulk_data);
          $quer=implode(',',$bulk_data);
          $qi="INSERT INTO `amz_order_info` (order_no,payment_date,calc_shipdate,tracking_number,calc_deliverydate,sales_channel,store_id,sales_country,purchase_date,buyer_name,buyer_email,shipping_addr1,shipping_city,shipping_state,shipping_zip,shipping_country,item_id,shipping_addr2,shipping_phone,seller_sku,itm_title,no_of_itm_shipped,currency_code,itm_price,itm_tax,itm_ship_price,fulfillment_channel)VALUES 
          $quer 
          ON DUPLICATE KEY 
          UPDATE
          order_no=VALUES(order_no),payment_date=VALUES(payment_date),calc_shipdate=VALUES(calc_shipdate),tracking_number=VALUES(tracking_number),calc_deliverydate=VALUES(calc_deliverydate),sales_channel=VALUES(sales_channel),store_id=VALUES(store_id),sales_country=VALUES(sales_country),purchase_date=VALUES(purchase_date),buyer_name=values(buyer_name),buyer_email=values(buyer_email),shipping_addr1=values(shipping_addr1),shipping_city=values(shipping_city),shipping_state=values(shipping_state),shipping_zip=values(shipping_zip),shipping_country=values(shipping_country),item_id=values(item_id),
          shipping_addr2=values(shipping_addr2),shipping_phone=values(shipping_phone),seller_sku=values(seller_sku),itm_title=values(itm_title),no_of_itm_shipped=values(no_of_itm_shipped),currency_code=values(currency_code),itm_price=values(itm_price),itm_tax=values(itm_tax),itm_ship_price=values(itm_ship_price),fulfillment_channel=values(fulfillment_channel);";
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
     }
     fclose($fp);
    }  
  }
  public function process_fba_shipments_data_for_ship_table($store_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        if($i>=1 && !empty($buffer[0]) )
        {
          if(empty($buffer[1]))
          {
             $amz_order_id= isset($buffer[0])?$this->db->escape($buffer[0]):'';
             $ship_date= isset($buffer[8])?$this->db->escape($buffer[8]):'';             
             $bulk_data[]="(".$amz_order_id.",".$ship_date.",".$store_id.")";     
          }    
        }

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
          $quer=implode(',',$bulk_data);
          $qi="INSERT IGNORE INTO `amz_ship_date` (sh_order_id,shipped_on,client_id)VALUES ".$quer ;
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
          $quer=implode(',',$bulk_data);
          $qi="INSERT IGNORE INTO `amz_ship_date` (sh_order_id,shipped_on,client_id)VALUES ".$quer ;
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
     }
     fclose($fp);
    }  
  }
   public function process_feedback_data($user_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while (!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        if($i >= 1 && !empty($buffer[0]))
        {
          $fbk_date= isset($buffer[0])?$buffer[0]:'';
          $date = DateTime::createFromFormat('d/m/y',"$fbk_date");
          $fbk_date= $date->format('Y-m-d');
          $fbk_date=$this->db->escape($fbk_date);
          $fbk_rating= isset($buffer[1])?$this->db->escape($buffer[1]):'';
          $fbk_comment= isset($buffer[2])?$this->db->escape($buffer[2]):'';
          $fbk_response= isset($buffer[3])?$this->db->escape($buffer[3]):'';
          //$fbk_itm_arve_on_time= isset($buffer[4])?$this->db->escape($buffer[4]):'';
          //$itm_as_desc= isset($buffer[5])?$this->db->escape($buffer[5]):'';
          //$customer_service= isset($buffer[6])?$this->db->escape($buffer[6]):'';
          $order_id= isset($buffer[4])?$this->db->escape($buffer[4]):'';
          $rater_email= isset($buffer[5])?$this->db->escape($buffer[5]):'';
          $country_code=$this->db->escape($country);
          $bulk_data[]="(".$fbk_date.",".$fbk_rating.",".$fbk_comment.",".$fbk_response.",".$order_id.",".$rater_email.",".$user_id.",".$country_code.")";     
       }
            

        if(isset($bulk_data) && count($bulk_data)>=500)
        {
          $quer=implode(',',$bulk_data);
          $qi="INSERT IGNORE INTO `amz_feedback_data` (fbk_date,fbk_rating,fbk_comment,fbk_response,order_id,rater_email,fbk_for,fbk_country)VALUES 
          $quer"; 
          $this->db->query($qi);
          unset($bulk_data);
          unset($quer);
        }  
        $i++;
     }
     if(isset($bulk_data) && count($bulk_data)<500 && count($bulk_data)>0)
     {
        $quer=implode(',',$bulk_data);
        $qi="INSERT IGNORE INTO `amz_feedback_data` (fbk_date,fbk_rating,fbk_comment,fbk_response,order_id,rater_email,fbk_for,fbk_country)VALUES 
        $quer"; 
        $this->db->query($qi);
        unset($bulk_data);
        unset($quer);
     }
     fclose($fp);
    } 
  }


    public function process_report_data_for_testing($store_id,$report_file,$country,$request_type)
  {
    $fp=fopen($report_file,'r');
    if ($fp)
    {
     $i=0;
     while(!feof($fp)) 
     {
        $buffer = fgetcsv($fp,0,"\t");
        print_r($buffer);
        if($i==2)
        {
          die();
        }
        $i++;
     }
     
     fclose($fp);
    }  
  }

  public function get_all_stores_for_mapping($store_id)
  {
    $qry=$this->db->query("SELECT mgr.store_id,spt.country_code,amz_domain FROM store_manager AS mgr
INNER JOIN (SELECT created_by  FROM store_manager WHERE store_id=".$this->db->escape($store_id).") AS str ON   mgr.created_by=str.created_by
INNER JOIN supported_country  AS spt ON spt.country_code=mgr.country_code
 ");
    return $qry->result_array();
  }

  
}
?>
  
