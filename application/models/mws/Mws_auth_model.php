<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mws_auth_model extends CI_Model
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

  public function check_auth_key($country_code,$seller_id,$auth_token)
  {
    $sql="SELECT * FROM supported_country WHERE country_code=".$this->db->escape($country_code);
    $query=$this->db->query($sql);
    $res=$query->result_array();
    if(!empty($res))
    {
		//print_r($res);
		//die();
      $this->seller_id=$seller_id;
      $this->auth_token=$auth_token;
      $this->access_key=$res[0]['acs_key'];
      $this->secret_key=$res[0]['default_key'];
      $this->market_id=$res[0]['amz_code'];  
      $this->mws_site=$res[0]['mws_url'];
      $this->ch = curl_init();  
      $data=$this->check_access();
      $data['access_key']=$res[0]['acs_key'];
      $data['secret_key']=$res[0]['default_key'];
      
    }
    else
    {
      $data['status_code']=0;
      $data['status_text']="Country Not available";
    }
    return $data;
  }
 public function check_access()
  { 
    try
    {
      $param=array('Action'=>urlencode("GetReportList"));
      $curl_res=$this->create_curl_request($param);
      if($curl_res['status_code']==0)
      {
        throw new Exception($curl_res['status_text']);   
      }

      $req_res = simplexml_load_string($curl_res['payload']);
	  //print_r($req_res);
	  //die();
      $httpcode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
      if($httpcode != 200)
      {
          throw new Exception($req_res->Error->Code." On MWS Request");  
      }
      
      $data['status_code']=1;
      $data['status_text']="MWS credentails is valid";
      
    }
    catch(Exception $e) 
    {
      
      $data['status_code']=0;
      $data['status_text']='Seller ID or MWS Auth Token Is Invalid';
      
    }
    return $data;
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
  
