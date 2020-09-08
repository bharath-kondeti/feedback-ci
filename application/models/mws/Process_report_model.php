<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Process_report_model extends CI_Model
{
  private $seller_id='';
  private $auth_token='';
  private $access_key='';
  private $secret_key='';
  private $market_id='';  
  private $ch = '';
  public function  __construct()
  {
      parent::__construct();
      
  }

  public function get_store_info($store_id='')
  {
    $sql="SELECT prf.store_id,seller_id,auth_token,access_key,secret_key,amz_code,DATEDIFF(CURDATE(),keyed_on) AS jt_days,str.country_code,country_name,mws_url,amz_code FROM amazon_profile AS prf
          INNER JOIN store_manager AS str ON str.store_id=prf.store_id AND str.is_active=1  AND prf.is_mws_work=1  AND prf.is_active='1'";
            if(!empty($store_id))
            {
              $sql.=" AND str.store_id=".$this->db->escape($store_id);  
            }
    $sql.=" INNER JOIN supported_country AS spt ON spt.country_code=str.country_code AND spt.is_active=1 
	 INNER JOIN `store_access` AS str_acs ON  str_acs.store_id=prf.store_id
     INNER JOIN scr_user ON scr_u_id=user_id
	-- INNER JOIN current_plan_info ON scr_u_id=subscribed_by AND valid_till_current > NOW()  ORDER BY str.store_id DESC ";
	//die($sql);
    $query=$this->db->query($sql);
    return $query->result_array();
  }
  
  
    public function get_store_info_mws($store_id='')
  {
    $sql="SELECT prf.store_id,seller_id,auth_token,access_key,secret_key,amz_code,DATEDIFF(CURDATE(),keyed_on) AS jt_days,str.country_code,country_name,mws_url,amz_code FROM amazon_profile AS prf
          INNER JOIN store_manager AS str ON str.store_id=prf.store_id AND str.is_active=1 ";
            if(!empty($store_id))
            {
              $sql.=" AND str.store_id=".$this->db->escape($store_id);  
            }
    $sql.=" INNER JOIN supported_country AS spt ON spt.country_code=str.country_code AND spt.is_active=1 
	         INNER JOIN `store_access` AS str_acs ON  str_acs.store_id=prf.store_id
             INNER JOIN scr_user ON scr_u_id=user_id
	        INNER JOIN current_plan_info ON scr_u_id=subscribed_by AND valid_till_current > NOW()";
	//die($sql);
    $query=$this->db->query($sql);
    return $query->result_array();
  }
  
  public function get_store_which_have_pending_report($request_id,$store_id,$limit=10)
  {
    $sql="SELECT req_id,request_id,market_id,prf.store_id,keyed_on,DATEDIFF(CURDATE(),keyed_on) AS jt_days,seller_id,auth_token,access_key,secret_key,country_name,country_code,mws_url,amz_code FROM report_feed AS fed 
           INNER JOIN amazon_profile AS prf ON report_id='' AND req_status IN ('_SUBMITTED_','_IN_PROGRESS_') AND prf.store_id=fed.store_id AND prf.is_mws_work=1 ";
    if($request_id <> 'NULL')
    {
      $sql.=" AND request_id=".$this->db->escape($request_id);
    }
    if(!empty($store_id))
    {
      $sql.=" AND store_id=".$this->db->escape($store_id);
    }      
    $sql.="INNER JOIN supported_country AS spt ON spt.amz_code=fed.market_id GROUP BY prf.store_id ";;
    $query=$this->db->query($sql);
    return $query->result_array();       
  }
  public function get_store_pending_report($store_id)
  {
    $query=$this->db->query("SELECT req_id,request_id,report_id,req_status,market_id,request_type FROM report_feed where store_id=".$store_id." AND request_id<>'' AND report_id='' AND is_processed=0 limit 0,5");  
    return $query->result_array();
  }
  public function get_store_which_have_generated_report($request_id,$store_id,$limit=10)
  {
    $sql="SELECT req_id,request_id,request_type,market_id,keyed_on,DATEDIFF(CURDATE(),keyed_on) AS jt_days,prf.store_id,seller_id,auth_token,access_key,secret_key,country_name,country_code,mws_url,amz_code,report_id FROM report_feed AS fed
          INNER JOIN amazon_profile AS prf ON  is_processed=0 AND report_id <> '' AND req_status='_DONE_' AND prf.store_id=fed.store_id AND prf.is_mws_work=1 ";
    if($request_id <> 'NULL')
    {
      $sql.=" AND request_id=".$this->db->escape($request_id);
    }
    if(!empty($store_id))
    {
      $sql.=" AND store_id=".$this->db->escape($store_id);
    }      
    $sql.="INNER JOIN supported_country AS spt ON spt.amz_code=fed.market_id ORDER BY req_id DESC";
    $query=$this->db->query($sql);
    return $query->result_array();       
  }
  public function set_credentials($usr)
  {
        $this->seller_id=$usr['seller_id'];
        $this->auth_token=$usr['auth_token'];
        $this->access_key=$usr['access_key'];
        $this->secret_key=$usr['secret_key'];
        $this->market_id=$usr['amz_code'];  
        $this->mws_site=$usr['mws_url'];
        $this->active_days=$usr['jt_days'];
        $this->ch = curl_init();
        return TRUE;
  }
  public function request_report($store_id,$report_type,$time_frame='30')
  { 
    try
    {
      
      $param['Action']=urlencode("RequestReport");
      $param['ReportType']=urlencode($report_type);
      $param['MarketplaceIdList.Id.1']=urlencode($this->market_id);
      $start_from=$time_frame;
      $start_from=$start_from+1;
      $start_from='-'.$start_from." days";  
      $param['StartDate']=gmdate('Y-m-d\TH:i:s\Z',strtotime($start_from));
       print_r($param);
	   //die();
      $curl_res=$this->create_curl_request($param);
      //print_r($curl_res);
      if($curl_res['status_code']==0)
      {
        throw new Exception($curl_res['status_text']);   
      }
      $req_res = simplexml_load_string($curl_res['payload']);
      $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
      if($httpcode != 200)
      {
          throw new Exception($req_res->Error->Message);  
      }
      $request_id=(string)$req_res->RequestReportResult->ReportRequestInfo->ReportRequestId;
      $status=(string)$req_res->RequestReportResult->ReportRequestInfo->ReportProcessingStatus;
      $insert_feed_log=array('request_id'=>$request_id,'req_status'=>$status,'store_id'=>$store_id,'request_type'=>$report_type,'market_id'=>$this->market_id); 
      $this->db->insert('report_feed',$insert_feed_log);
    }
    catch(Exception $e) 
    {
      $data['status_code']=0;
      $data['status_text']=$e->getMessage();
      return $data;
    }
 }
 
 
 public function update_report_request($store_id,$report_arr)
  { 
    try
    {
      $param=array('Action'=>urlencode("GetReportRequestList"));
      for($i=1;$i<=count($report_arr);$i++)
      {
        $param['ReportRequestIdList.Id.'.$i]=$report_arr[$i-1]['request_id'];
      }
      $curl_res=$this->create_curl_request($param);
      if($curl_res['status_code']==0)
      {
        throw new Exception($curl_res['status_text']);   
      }

      $req_res = simplexml_load_string($curl_res['payload']);
      $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
      if($httpcode != 200)
      {
          throw new Exception($req_res->Error->Message);  
      }
      
      foreach($req_res->GetReportRequestListResult->ReportRequestInfo as $report)
      {
        $status=$report->ReportProcessingStatus;
        $request_id=$report->ReportRequestId;
        $report_id=$report->GeneratedReportId;
        if($status=='_CANCELLED_' || $status == '_DONE_NO_DATA_')
        {
          $this->db->query("UPDATE report_feed SET req_status=".$this->db->escape($status)." ,report_id=".$this->db->escape($report_id).",is_processed=1 WHERE store_id=".$store_id." AND request_id=".$this->db->escape($request_id));
        }
        elseif($status=='_DONE_' || $status=='_IN_PROGRESS_')
        {
          $this->db->query("UPDATE report_feed SET req_status=".$this->db->escape($status)." ,report_id=".$this->db->escape($report_id)." WHERE store_id=".$store_id." AND request_id=".$this->db->escape($request_id));
        }
      }
      
    }
    catch(Exception $e) 
    {
      
      $data['status_code']=0;
      $data['status_text']=$e->getMessage();
      return $data;
    }
 }
 public function get_report($usr)
  { 
    try
    {
      $param=array('Action'=>urlencode("GetReport"),'ReportId'=>$usr['report_id']);
      $curl_res=$this->create_curl_request($param,$usr['store_id'],1,$usr['report_id']);
      if($curl_res['status_code']==0)
      {
        throw new Exception($curl_res['status_text']);   
      }
      $data['status_code']=1;
      $data['status_text']='Success';
      $data['report_file']=$curl_res['report_file'];
      return $data;
    }
    catch(Exception $e) 
    {
      $data['status_code']=0;
      $data['status_text']=$e->getMessage();
      return $data;
    }
 }
  
  private function create_curl_request($param,$store_id=null,$store_to_file=0,$report_id='')
  {
      $httpHeader=array();
      $httpHeader[]='Transfer-Encoding: chunked';
      $httpHeader[]='Content-Type: text/xml';
      $httpHeader[]='Expect:';
      $httpHeader[]='Accept:';
      try
      {
        curl_setopt($this->ch, CURLOPT_URL, $this->built_query_string($param));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($this->ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($this->ch, CURLOPT_POST, true);
        
        if($store_to_file==1 && $store_id != null && $report_id!='')
        {
          $rep_file=realpath('asset').DIRECTORY_SEPARATOR."amazon_report".DIRECTORY_SEPARATOR.$store_id."_".$report_id;
          global $file_handle; 
          $file_handle = fopen($rep_file, 'w+'); 
          curl_setopt($this->ch, CURLOPT_FILE, $file_handle);
          curl_setopt($this->ch, CURLOPT_WRITEFUNCTION, function ($cp, $data) {
            global $file_handle;
            $len = fwrite($file_handle, $data);
            return $len;
          });
          curl_exec($this->ch);
          fclose($file_handle);
          
        }  
        else
        {
          $response = curl_exec($this->ch);  
        }
        
        if(curl_errno($this->ch))
        {
            throw new Exception(curl_error($this->ch));
        }
        $data['status_code']=1;
        $data['status_text']='Success';
        if($store_to_file==1 && $store_id != null && $report_id!='')
        {
          $data['report_file']=$rep_file;
        }
        else
        {
          $data['payload']=$response;  
        }
        
        return $data;
      }
      catch(Exception $e) 
      {
        $data['status_code']=0;
        $data['status_text']=$e->getMessage();
        return $data;
      }  
  }
  
   public function check_access($user_id,$fetch_type='NEW')
  { 
    try
    {
      $httpHeader=array();
      $httpHeader[]='Transfer-Encoding: chunked';
      $httpHeader[]='Content-Type: text/xml';
      $httpHeader[]='Expect:';
      $httpHeader[]='Accept:';
      $param['Action']=urlencode("GetReportRequestCount");
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->built_query_string($param));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 15);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
      curl_setopt($ch, CURLOPT_POST, true);
      $response = curl_exec($ch);
      if(curl_errno($ch))
      {
          throw new Exception(curl_error($ch));
      }
      $res = simplexml_load_string($response);
     
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      if($httpcode != 200)
      {
          throw new Exception($res->Error->Message);  
      }
      $data['status_code']=1;
      $data['status_text']="Validation success";
      return $data;
    }
    catch(Exception $e) 
    {
      
      $data['status_code']=0;
      $data['status_text']=$e->getMessage();
      return $data;
    }
 }
 private function built_query_string($add_param)
 {
    $params = array(
              'AWSAccessKeyId'=> urlencode($this->access_key),
              
              'Merchant'=> urlencode($this->seller_id),
              'SignatureMethod' => urlencode("HmacSHA256"),
              'SignatureVersion'=> urlencode("2"),
              'Timestamp'=>gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z", time()),
              'Version' => urlencode("2009-01-01")
             );
    if(!empty($this->auth_token))
    {
      $params['MWSAuthToken']=urlencode($this->auth_token);
    }

    $params=array_merge($params,$add_param);
        
    $url_parts = array();
    foreach(array_keys($params) as $key)
    {
        $url_parts[] = $key . "=" . str_replace('%7E', '~', rawurlencode($params[$key]));
    }
    sort($url_parts);
    $url_string = implode("&", $url_parts);
    $string_to_sign = "POST\n".$this->mws_site."\n/\n" . $url_string;
    
    $signature = hash_hmac("sha256", $string_to_sign, $this->secret_key, TRUE);
    $signature = urlencode(base64_encode($signature));
    $url = "https://".$this->mws_site."/" . '?' . $url_string . "&Signature=" . $signature;
    return $url; 
 }
 

  
}
?>
  
