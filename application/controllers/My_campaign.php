<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_campaign extends CI_Controller {
  private $user_id;
  public function  __construct()
  {
       parent::__construct();
     if(!$this->login_model->userLoginCheck())
     {
        redirect('user_auth');
     }
     else
      {
        $this->load->model("campaign_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
      }
       
  }

  public function index()
  {
    $this->load->view('UI/header');
	$this->load->view('UI/navigation');
	$this->load->view('UI/sidepanel');
	$data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
    $this->load->view('UI/my_campaign',$data);
    $this->load->view('UI/footer');
  }
  public function get_campaign_order($context,$orderby='camp_id',$direction='DESC',$offet=0,$limit=25,$searchterm='')
  {
     if($context!='schduled_mail' && $context!='sent_mail' && $context !='blocked_mail')
     {
        $context='sent_mail'; 
     }
     
     $result_set=$this->campaign_model->get_campaign_orders($context,$orderby,$direction,$offet,$limit,$searchterm);
     echo json_encode($result_set);
  }
  public function get_pre_data()
  {
    $data['status_text']='Success';
    $data['status_code']='1';
    $data['campaign_list']=$this->campaign_model->get_campaign_list();
	echo json_encode($data);
  }
  
   
  public function mark_as_dns()
  {
    if(isset($_POST['selected_order']))
    {
      $ord=json_decode($_POST['selected_order']);
      foreach($ord as $od)
      {
		  if($od->type=="Normal")
		  {
          $sql="UPDATE campaign_order_list SET dns_status=1 WHERE camp_id=".$this->db->escape($od->campaign_id)." AND camp_order_no=".$this->db->escape($od->order_no)." AND is_sent=0";
          $this->db->query($sql);
		  }
		  else
		  {
         $sql="UPDATE adhoc_campaign_order_list SET dns_status=1 WHERE camp_id=".$this->db->escape($od->campaign_id)." AND camp_order_no=".$this->db->escape($od->order_no)." AND is_sent=0";
          $this->db->query($sql);	  
		  }
      }
     echo '{"status_code":"1","status_text":"Status updated "}'; 
    }
    else
    {
      echo '{"status_code":"0","status_text":"Mandatory data missing "}';
    }
  }
   public function rmv_dns()
  {
    if(isset($_POST['selected_order']))
    {
      $ord=json_decode($_POST['selected_order']);
      foreach($ord as $od)
      {
		  if($od->type=="Normal")
		  {
          $sql="UPDATE campaign_order_list SET dns_status=0 WHERE camp_id=".$this->db->escape($od->campaign_id)." AND camp_order_no=".$this->db->escape($od->order_no)." AND is_sent=0";
          $this->db->query($sql);
		  }
		  else
		  {
		  $sql="UPDATE adhoc_campaign_order_list SET dns_status=0 WHERE camp_id=".$this->db->escape($od->campaign_id)." AND camp_order_no=".$this->db->escape($od->order_no)." AND is_sent=0";
          $this->db->query($sql);	  
		  }
      }
     echo '{"status_code":"1","status_text":"Status updated "}'; 
    }
    else
    {
      echo '{"status_code":"0","status_text":"Mandatory data missing "}';
    }
  }
public function send_now()
{
   if(isset($_POST['cmp']) && !empty($_POST['cmp']))
   {
      $data=json_decode($_POST['cmp']);
	  $fail=0;
      foreach($data as $dt)
      {
        $count=$this->sendmail($dt->order_no,$dt->campaign_id,$dt->type);
        if(!$count)
          $fail++;
        sleep(3);
      }
      $data['status_code']=1;
      $data['status_text']="Succesfully Sent  \n Failed Message Count Is ".$fail;
      echo json_encode($data);


   }
   else
   {
    echo '{"status_code":"0","status_text":"Email Not Sent "}';
   }
}
  private function sendmail($order_no,$campaign_id,$type)
  {
    if(!empty($order_no) && !empty($campaign_id))
    {
		if($type=='Normal')
		{
      $sql="SELECT template_content,subject,cpgn_attachment,cpgn_template,cpgn_id,cpgn_name ,is_sent,itm_title as product_name,camp_order_no as order_number,DATE_FORMAT(purchase_date,'%Y-%m-%d')  as order_date,buyer_name as customer_fullname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_firstname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_lastname,buyer_email, cm.is_deleted,cm.is_active,IFNULL(attach_1,'') AS attach_1,IFNULL(attach_2,'') AS attach_2,IFNULL(attach_3,'') AS attach_3,IFNULL(attach_4,'') AS attach_4 ,IFNULL(attach_5,'') AS attach_5 FROM campaign_manager as cm
      INNER join email_template on template_id=cpgn_templateID
INNER JOIN campaign_order_list ON camp_id=cpgn_id AND camp_id=".$this->db->escape($campaign_id)." AND camp_order_no=".$this->db->escape($order_no)."
INNER JOIN amz_order_info AS tnx ON order_no=camp_order_no and customer_id={$this->user_id}
LEFT JOIN email_attach ON cm.cpgn_templateID=temp_id AND cm.created_by=email_attach.user_id
WHERE cpgn_id=".$this->db->escape($campaign_id)." AND cm.created_by=".$this->user_id;
		}
		else
		{
		 $sql="SELECT template_content,subject,cpgn_attachment,cpgn_template,cpgn_id,cpgn_name ,is_sent,itm_title as product_name,camp_order_no as order_number,DATE_FORMAT(purchase_date,'%Y-%m-%d')  as order_date,buyer_name as customer_fullname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_firstname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_lastname,buyer_email, cm.is_deleted,cm.is_active,IFNULL(attach_1,'') AS attach_1,IFNULL(attach_2,'') AS attach_2,IFNULL(attach_3,'') AS attach_3,IFNULL(attach_4,'') AS attach_4 ,IFNULL(attach_5,'') AS attach_5 FROM adhoc_campaign_manager as cm
      INNER join email_template on template_id=cpgn_templateID
INNER JOIN adhoc_campaign_order_list ON camp_id=cpgn_id AND camp_id=".$this->db->escape($campaign_id)." AND camp_order_no=".$this->db->escape($order_no)."
INNER JOIN amz_order_info AS tnx ON order_no=camp_order_no and customer_id={$this->user_id}
LEFT JOIN email_attach ON cm.cpgn_templateID=temp_id AND cm.created_by=email_attach.user_id
WHERE cpgn_id=".$this->db->escape($campaign_id)." AND cm.created_by=".$this->user_id;	
			
		}
$query=$this->db->query($sql);
$res=$query->result_array();
if($res[0]['is_sent']==1)
{
  // echo '{"status_code":"0","status_text":"This campaign has been sent already "}';
  return false;
  // $data['status_code']=0;
  
}
if($res[0]['is_active']==1 && $res[0]['is_deleted']==0)
{

  $str_sql="SELECT market_placeID,vendor_name,company_name,CONCAT(\"<a href='\",store_url,\"'>Store Front URL</a>\") AS store_url,
  CONCAT(\"<a href='https://www.amazon.in/gp/feedback/leave-consolidated-feedback.html?ie=UTF8&isCBA=&marketplaceID=\",market_placeID,\"&mode=eligibility&orderID=\",\"".$res[0]['order_number']."\",\"&ref_=fb_multi_cfb&'>Leave us feedback</a>\") AS feedback_url,IF(image_1 !='',CONCAT(\"<img width='\",image_1_width,\"' height='\",image_1_height,\"' src='\",image_1,\"'>\"),CONCAT(\"<h4 style='color:red'>No Image Found</h4>\")) AS logo_image1,
  IF(image_2 !='',CONCAT(\"<img width='\",image_2_width,\"' height='\",image_2_height,\"' src='\",image_2,\"'>\"),CONCAT(\"<h4 style='color:red'>No Image Found</h4>\")) AS logo_image2,
  IF(image_3 !='',CONCAT(\"<img width='\",image_3_width,\"' height='\",image_3_height,\"' src='\",image_3,\"'>\"),CONCAT(\"<h4 style='color:red'>No Image Found</h4>\")) AS logo_image3,
  IF(image_4 !='',CONCAT(\"<img width='\",image_4_width,\"' height='\",image_4_height,\"' src='\",image_4,\"'>\"),CONCAT(\"<h4 style='color:red'>No Image Found</h4>\")) AS logo_image4,
  IF(image_5 !='',CONCAT(\"<img width='\",image_5_width,\"' height='\",image_5_height,\"' src='\",image_5,\"'>\"),CONCAT(\"<h4 style='color:red'>No Image Found</h4>\")) AS logo_image5 
  FROM amazon_profile LEFT JOIN email_logo on user_id=".$this->user_id." 
   WHERE profile_id=".$this->user_id." ";
  //die($str_sql);
  $str=$this->db->query($str_sql);
  $store_info=$str->result_array();
  $this->load->library('parser');
  $this->parser->set_delimiters('{{','}}');
  $msg=$res[0]['template_content'];
  $error=0;
  
  $used_coupon_code='0';
  if($error==0)
  {
  $subject=$res[0]['subject'];
  $buyer_email=$res[0]['buyer_email'];
  
  $dt=array_merge($res[0],$store_info[0]);
  $msg=$this->parser->parse_string($msg,$dt,TRUE);
  $this->load->library('email');
  $config['protocol'] = "smtp";
  $config['smtp_host'] = "tls://email-smtp.us-east-1.amazonaws.com";
  $config['smtp_port'] = '465';
  $config['smtp_user'] = 'AKIAX2BCXESCD6UL6W4C';
  $config['smtp_pass'] = 'BNJVELo+k/v/Nn8r3QWUiMFqOZfFu/ZpSU4ABlVxo2OF';
  $config['wordwrap']=TRUE;
  $config['charset'] = "utf-8";
  $config['mailtype'] = "html";
  $config['newline'] = "\r\n";
  $config['crlf'] = "\r\n";
  $config['useragent']='Proseller Mailer';
  $this->email->initialize($config);
  $this->email->from('campaign@feedbackoutlook.com');
  $this->email->to($buyer_email);
  $this->email->subject($subject);
  $this->email->message($msg);
  if ($this->email->send()) 
  {
    $uql="UPDATE campaign_order_list SET  status_msg='NO_ISSUE',used_coupon_id=".$used_coupon_code.",is_sent=1,sent_on='".date("Y-m-d H:i:s")."'  where camp_id=".$this->db->escape($campaign_id)." AND camp_order_no=".$this->db->escape($order_no);
        $this->db->query($uql);
        return TRUE;
  }
  else 
  {
    return FALSE;
  }
}
  


}
else
{
  return FALSE;
}

    }
}

 
 
}


