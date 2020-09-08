<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_api extends CI_Controller 
{
  public function  __construct()
	{
	     parent::__construct();
       $this->load->model('mws/process_report_model','report_api');
  }


  public function request_report($report_type='_GET_MERCHANT_LISTINGS_DATA_',$time_from='29',$store_id='')
  {
	
    $users=$this->report_api->get_store_info($store_id);
	print_r($users);
    if(count($users) > 0)
    {

      foreach($users as $usr)
      {
			
		$this->report_api->set_credentials($usr);
        $res=$this->report_api->request_report($usr['store_id'],$report_type,$time_from);
    	}
		
    }

  }
  
   public function check_mws($report_type='_GET_MERCHANT_LISTINGS_DATA_',$time_from='30',$store_id='')
  {
        $users=$this->report_api->get_store_info_mws($store_id);
        if(count($users) > 0)
        {
      foreach($users as $usr)
      {
        $this->report_api->set_credentials($usr);
        $res=$this->report_api->check_access($usr['store_id']); 
		 //echo "'".$res['status_text']."'"; 
        if($res['status_text']=='Access to Reports.GetReportRequestCount is denied' || $res['status_text']=='Access denied' )
            {
             $sql="UPDATE amazon_profile set is_mws_work='0' where store_id='".$usr['store_id']."'";
             $this->db->query($sql);
             echo 'Failure';
             echo "\t"; 				
             echo "'".$usr['store_id']."'"; 
			 echo "\t";
			 echo "'".$res['status_text']."'"; 
			 echo "\t";
             echo date('Y-m-d H:i:s');			
             echo "\n"; 				 
          }
		  else
		  {
			$sql="UPDATE amazon_profile set is_mws_work='1' where store_id='".$usr['store_id']."'";
            $this->db->query($sql); 
			echo 'Success';
            echo "\t"; 				
            echo "'".$usr['store_id']."'"; 
			echo "\t";
            echo date('Y-m-d H:i:s');			
            echo "\n"; 			  
		  }
      }
    }	  
	  
  }
 
  public function update_report_status($request_id='NULL',$store_id='')
  {
    $users=$this->report_api->get_store_which_have_pending_report($request_id,$store_id);
    if(count($users) > 0)
    {
      foreach($users as $usr)
      {
        $this->report_api->set_credentials($usr);
        $rep=$this->report_api->get_store_pending_report($usr['store_id']);
        if(count($rep)>0)
        {
          $this->report_api->set_credentials($usr);
          $res=$this->report_api->update_report_request($usr['store_id'],$rep);     
         }
      }
    }
  }

  public function get_report($request_id='NULL',$store_id='')
  {
    $users=$this->report_api->get_store_which_have_generated_report($request_id,$store_id);
    if(count($users) > 0)
    {
      foreach($users as $usr)
      {
        $this->report_api->set_credentials($usr);
        $res=$this->report_api->get_report($usr);
        if(is_file($res['report_file']))
        {
          $this->load->model('mws/report_file_process','report_process');
          if($usr['request_type'] == '_GET_MERCHANT_LISTINGS_DATA_' || $usr['request_type'] == '_GET_MERCHANT_LISTINGS_INACTIVE_DATA_' )
          {
              echo "IF 1\n";
              $this->report_process->process_inventory_data($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
          elseif($usr['request_type']=='_GET_AFN_INVENTORY_DATA_')
          {
            echo "IF 2\n";
              $this->report_process->process_afn_inventory_data($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
           elseif($usr['request_type']=='_GET_SELLER_FEEDBACK_DATA_')
           {
               echo "IF 3\n";
               $this->report_process->process_feedback_data($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
           }

          elseif($usr['request_type']=='_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_')
          {
            echo "IF 4.1\n";
              $this->report_process->process_order_data_by_date($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
              $this->report_process->process_order_data_by_date_for_ship_table($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
          elseif($usr['request_type']=='_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_')
          {
            echo "IF 4.2\n";
              $this->report_process->process_order_data_by_date($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
              $this->report_process->process_order_data_by_date_for_ship_table($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
          elseif($usr['request_type']=='_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_')
          {
             echo "IF 4.3\n";
              $this->report_process->process_fba_shipments_data($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
          elseif($usr['request_type']=='_GET_CONVERGED_FLAT_FILE_ORDER_REPORT_DATA_')
          {
            echo "IF 4\n";
              $this->report_process->process_converged_order_data($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
          elseif($usr['request_type']=='_GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_')
          {
            echo "IF 5\n";
              $this->report_process->process_actionable_order_data($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);
          }
		 
          else
          {
            echo "IF 6\n";
              $this->report_process->process_report_data_for_testing($usr['store_id'],$res['report_file'],$usr['country_code'],$usr['request_type']);    
          }
          $this->report_process->update_report_feed_log($usr['store_id'],$usr['req_id']);
        }
      }
    }

  }



}
