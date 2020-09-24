<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_campaign extends CI_Controller
{
  public function  __construct()
  {
     parent::__construct();
     $this->load->model('login_model');
     if(!$this->login_model->userLoginCheck())
     {
      redirect('user_auth');
     }
	else
	{
	 $user=$this->session->userdata('user_logged_in');
	 $this->user_id=$user['id'];
	 $this->load->model('campaign_model');
	 $store=$this->session->userdata('store_info');
	 $this->store_id=$store['store_id'];
	 $this->store_country=$store['store_country'];
	}


  }
  public function index()
  {
	  $data['store_country']=$this->store_country;
	  $data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
      $this->load->view('UI/header',$data);
	  $this->load->view('UI/navigation');
	  $this->load->view('UI/sidepanel');
      $this->load->view('UI/manage_campaign',$data);
      $this->load->view('UI/footer');
  }


   public function get_pre_data($offset='',$limit='')
  {
    $to_date=date('Y-m-d');
    $frm_date = date('Y-m-d',strtotime("-30 days"));
    $data['status_text']='Success';
    $data['status_code']='1';
    $data['campaign_list'] = $this->campaign_model->get_campaign_list($offset,$limit);
    $countdata =$this->campaign_model->get_campaign_count();
    $data['page_count'] = sizeof($data['campaign_list']);
    $data['total_records'] = sizeof($countdata);
    $data['brand_list']=$this->campaign_model->get_brand_list($this->store_country);
  	$data['country_list']=$this->campaign_model->get_country_list();
    $data['template_list']=$this->campaign_model->get_template_list();
    $data['recent_orders']=$this->campaign_model->get_recent_orders();
    $data['metrics']=$this->campaign_model->get_campaign_metrics();
    $data['user_folders']=$this->campaign_model->get_user_folders();
    echo json_encode($data);
  }

  public function get_product_list($offset='',$limit='') {
    $data = array();
    $data['product_list'] = $this->campaign_model->get_product_list($this->store_country,$offset,$limit);
    $count = $this->campaign_model->get_product_count($this->store_country,$offset,$limit);
    $data['total_records'] = $count[0]['total_count'];
    $data['page_count'] = sizeof($data['product_list']);
    echo json_encode($data);
  }


  public function get_campaign_data()
  {
    $qry=$this->db->query('SELECT cpgn_id,cpgn_name FROM campaign_manager WHERE created_by='.$this->store_id." AND is_deleted=0");
    $data['payload']=$qry->result_array();
    $data['status_text']='Success';
    $data['status_code']=1;

    echo json_encode($data);
  }

  public function get_campaign_users()
  {
    if(!empty($_POST['campaign_id']))
    {
       $data['payload']=$this->campaign_model->get_campaign_users($this->input->post('campaign_id'));
       $data['status_text']='Success';
       $data['status_code']='1';
       echo json_encode($data);
    }
  }
  public function get_products($offset='',$limit='')
  {
    if(!empty($_POST['brand']))
    {
       $data['payload']=$this->campaign_model->get_product_list($this->input->post('country'),$this->input->post('brand'),$this->input->post('key_word'),$this->input->post('fc_code'),$offset,$limit);
       $data['page_count'] = sizeof($data['payload']);
       $countdata =$this->campaign_model->get_campaign_count($this->input->post('country'),$this->input->post('brand'),$this->input->post('key_word'),$this->input->post('fc_code'));
       $data['total_records'] = sizeof($countdata);
       $data['status_text']='Success';
       $data['status_code']='1';
       echo json_encode($data);
    }
  }



  public function create_campaign()
  {
    if(isset($_POST['camp_data']) && isset($_POST['asin']))
    {
        $post=json_decode($_POST['camp_data']);
        $asin=json_decode($_POST['asin']);
        if(!isset($post->camp_name) || empty($post->camp_name))
        {
          echo '{"status_code":"0","status_text":"Campaign Name is not provided"}';
          die();
        }
         elseif(!isset($post->camp_country) || empty($post->camp_country))
        {
          echo '{"status_code":"0","status_text":"Campaign country is empty"}';
          die();
        }
        elseif(!isset($post->camp_brand) || empty($post->camp_brand))
        {
          echo '{"status_code":"0","status_text":"Campaign brand is empty"}';
          die();
        }
        elseif(count($asin) <= 0)
        {
          echo '{"status_code":"0","status_text":"Please choose atleast one product for campaign"}';
          die();
        }
        elseif(!isset($post->camp_type) || empty($post->camp_type))
        {
          echo '{"status_code":"0","status_text":"Campaign customer type is empty"}';
          die();
        }
        elseif(!isset($post->camp_fulfill) || empty($post->camp_fulfill))
        {
          echo '{"status_code":"0","status_text":"Campaign fullfillment channel type is empty"}';
          die();
        }
        elseif(!isset($post->camp_fulfill) || empty($post->camp_fulfill))
        {
          echo '{"status_code":"0","status_text":"Campaign fullfillment channel type is empty"}';
          die();
        }
        elseif(!isset($post->camp_trigger) || empty($post->camp_trigger))
        {
          echo '{"status_code":"0","status_text":"Campaign trigger event not selected"}';
          die();
        }
        elseif(!isset($post->camp_days)  && $post->camp_ord_in!='1' || $post->camp_days < 0 )
        {
		  echo '{"status_code":"0","status_text":"Campaign trigger days should be positive number"}';
          die();
        }
        elseif(!isset($post->camp_hour) && $post->camp_ord_in!='1'  || $post->camp_hour < 0 || $post->camp_hour >12)
        {
	      echo '{"status_code":"0","status_text":"Campaign trigger hour not in range [0-12]"}';
          die();
        }
        elseif(!isset($post->camp_am_pm) &&  $post->camp_ord_in!='1' || ($post->camp_am_pm!='1' && $post->camp_am_pm!='2') )
        {
          echo '{"status_code":"0","status_text":"Please select AM/PM on campaign sceduler"}';
          die();
        }
        elseif(!isset($post->camp_am_pm) && $post->camp_ord_in!='1'  || ($post->camp_am_pm!='1' && $post->camp_am_pm!='2') )
        {
          echo '{"status_code":"0","status_text":"Please select AM/PM on campaign scheduler properly "}';
          die();
        }

        elseif(!isset($post->feedback_status) || $post->feedback_status < 0 || $post->feedback_status >3)
        {
          echo '{"status_code":"0","status_text":"Please select feedback option in campaign scheduler properly "}';
          die();
        }
        elseif(!isset($post->feedback_status) || $post->feedback_status < 0 || $post->feedback_status >3)
        {
          echo '{"status_code":"0","status_text":"Please select feedback option in campaign scheduler properly "}';
          die();
        }
        elseif(!isset($post->template_id) || empty($post->template_id))
        {
          echo '{"status_code":"0","status_text":"Please select email template for campaign"}';
          die();
        }
        elseif((int)$post->camp_trigger==1  && (int)$post->feedback_status==2)
        {
          echo '{"status_code":"0","status_text":"To send Feedback received order campaign trigger should not be after shipped"}';
          die();
        }

        else
        {
             if(!empty($post->cpgn_id))
            {
              if($this->campaign_model->update_campaign($post,$asin))
              {
                   $data['status_text']="Campaign updated Successfully";
                   $data['status_code']=1;
                   $data['campaign_list']=$this->campaign_model->get_campaign_list();
                   echo json_encode($data);
              }
              else
              {
                echo '{"status_code":"0","status_text":"Not able to update campaign please try again later"}';
              }
            }
            else
            {
                if($this->campaign_model->create_new_campaign($post,$asin))
                 {
                       $data['status_text']="Campaign created Successfully";
                       $data['status_code']=1;
                       $data['campaign_list']=$this->campaign_model->get_campaign_list();
                       echo json_encode($data);
                 }
                 else
                 {
                  echo '{"status_code":"0","status_text":"Not able to create campaign please try again later"}';
                 }
            }
        }


    }
    else
    {
      echo '{"status_code":"0","status_text":"Data corrupted on transit please refresh and resubmit the data"}';
      die();
    }
  }






	public function change_state()
  {
    if(isset($_POST['w_status']) && ((int)$_POST['w_status']==1 ||(int)$_POST['w_status']==0) )
    {
		$status=(int)$_POST['w_status']==1?'1':'0';
       $ufql="UPDATE campaign_manager set is_active=".$status." where cpgn_id=".$this->db->escape($_POST['campaign_id'])." AND created_by=".$this->store_id;

        if($this->db->query($ufql))
        {
          $data['status_text']="Campaign Successfully updated";
          $data['status_code']=1;
          $data['campaign_list']=$this->campaign_model->get_campaign_list();
        }
        else
        {
          $data['status_text']="Something went wrong please try agin after sometime";
          $data['status_code']=0;
          $data['campaign_list']=$this->campaign_model->get_campaign_list();

        }
        echo json_encode($data);
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';
    }
  }


  public function change_status()
  {
    if(isset($_POST['w_status']))
    {
    $status=(int)$_POST['w_status'];
       $ufql="UPDATE campaign_manager set cpgn_status=".$status." where cpgn_id=".$this->db->escape($_POST['campaign_id'])." AND created_by=".$this->store_id;

        if($this->db->query($ufql))
        {
          $data['status_text']="Campaign Successfully updated";
          $data['status_code']=1;
          $data['campaign_list']=$this->campaign_model->get_campaign_list();
        }
        else
        {
          $data['status_text']="Something went wrong please try agin after sometime";
          $data['status_code']=0;
          $data['campaign_list']=$this->campaign_model->get_campaign_list();

        }
        echo json_encode($data);
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';
    }
  }

  public function delete_campaign()
    {
      if(isset($_POST['campaign_id']) && !empty($_POST['campaign_id']))
      {
        $ufql="UPDATE campaign_manager set is_deleted=1 where cpgn_id=".$this->db->escape($_POST['campaign_id']);
        if($this->db->query($ufql))
        {
          $data['status_text']="Campaign Successfully deleted";
          $data['status_code']=1;
          $data['campaign_list']=$this->campaign_model->get_campaign_list();
        }
        else
        {
          $data['status_text']="Something went wrong please try agin after sometime";
          $data['status_code']=0;
          $data['campaign_list']=$this->campaign_model->get_campaign_list();

        }
        echo json_encode($data);
      }
      else
      {
        echo '{"status_code":"0","status_text":"Input error"}';
      }
    }

    public function edit_campaign()
    {
      if(isset($_POST['campaign_id']) && !empty($_POST['campaign_id']))
      {
        $qry=$this->db->query("SELECT cpgn_id, cpgn_name AS camp_name, fbk_order as feedback_status, cpgn_desc AS camp_desc, cpgn_type AS camp_type, cpgn_brand AS camp_brand, cpgn_country AS camp_country, cpgn_fullfill AS camp_fulfill, IF(cpgn_fullfill='1','ALL',IF(cpgn_fullfill='2','FBA','FBM')) AS fc_code,cpgn_trigger AS camp_trigger, cpgn_am_pm AS camp_am_pm, cpgn_day AS camp_trigger_day, cpgn_days AS camp_days, cpgn_hour AS camp_hour,cpgn_min AS camp_min,cpgn_if_no_review AS camp_review, cpgn_templateID as tmp_id, template_id, template_name, template_content, subject, cpgn_goal_type AS camp_goaltype, cpgn_status AS camp_status FROM campaign_manager INNER JOIN email_template on template_id=cpgn_templateID WHERE cpgn_id=".$this->db->escape($_POST['campaign_id']));
        $res=$qry->result_array();

        if(count($res) > 0)
        {
          $data['status_text']="Retrived";
          $data['status_code']=1;
          $data['campaign_detail'] = $res;
          $data['other_product'] = $this->campaign_model->get_product_list($res[0]['camp_country'],$res[0]['camp_brand']);
          $data['brand_list'] = $this->campaign_model->get_brand_list($res[0]['camp_country']);
          $data['selected_product'] = $this->campaign_model->get_seleted_product($res[0]['cpgn_id']);
        }
        else
        {
          $data['status_text']="There is no campaign found";
          $data['status_code']=0;
        }
        echo json_encode($data);
      }
      else
      {
        echo '{"status_code":"0","status_text":"Input error"}';
      }
    }

   public function preview_email()
  {
	  if(empty($_POST['order_id']))
	  {
		  echo '{"status_code":"0","status_text":"Any one order ID is needed to preview"}';
		  die();
	  }
	  elseif(empty($_POST['template_id']))
	  {
		  echo '{"status_code":"0","status_text":"Please choose a template"}';
		  die();
	  }
    if(!empty($_POST['order_id']) && !empty($_POST['template_id']))
    {
      $five_star_img=base_url()."asset/img/fivestar_icon.png";
      $sql="SELECT template_content,subject,itm_title as product_name,order_no as order_number,DATE_FORMAT(purchase_date,'%Y-%m-%d')  as order_date,buyer_name as customer_fullname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_firstname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_lastname,buyer_email,asin ,itm_title,prod_image,sales_country
            FROM email_template
            INNER JOIN amz_order_info AS tnx ON order_no=".$this->db->escape($_POST['order_id'])." AND template_id=".$this->db->escape($_POST['template_id'])." AND tnx.store_id=".$this->store_id."
            INNER JOIN customer_product ON tnx.seller_sku=prod_sku AND tnx.store_id=".$this->store_id;
      $query=$this->db->query($sql);
      $res=$query->result_array();
      if(empty($res))
      {
        echo '{"status_code":"0","status_text":"Order ID not found "}';
        die();
      }


  $str_sql="SELECT store_id,amz_code as marketplaceID,vendor_name,amz_domain,company_name,CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:15px'  href='http://www.\",amz_domain,\"/s?ie=UTF8&me=\",seller_id,\"'>Store Front URL</a>\") AS store_url,
  CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:15px'  href='https://www.\",amz_domain,\"/gp/feedback/leave-consolidated-feedback.html?ie=UTF8&isCBA=&marketplaceID=\",amz_code,\"&mode=eligibility&orderID=\",\"".$res[0]['order_number']."\",\"&ref_=fb_multi_cfb&'>Leave us feedback</a>\") AS feedback_url,
  CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:15px'  href='https://www.\",amz_domain,\"/review/create-review/ref=oss_rev?_encoding=UTF8&asin=\",\"{$res[0]['asin']}\",\"'>Leave us review</a>\") AS review_url
  FROM amazon_profile
INNER JOIN supported_country ON store_id=".$this->store_id." AND country_code=".$this->db->escape($res[0]['sales_country'])."
";
  $str=$this->db->query($str_sql);
  $store_info=$str->result_array();
  $store_info[0]['review_url_with_product_img']='<br><br><table class="divProductReviewTable" cellpadding="4"><tbody><tr><td width="30%"><a href="https://www.'.$store_info[0]['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$res[0]['asin'].'" target="_blank" title="Leave Product Review"><img src="'.$res[0]['prod_image'].'" alt="'.$res[0]['asin'].'"></a></td><td width="70%">'.$res[0]['itm_title'].'<br>&nbsp;<br><a href="https://www.'.$store_info[0]['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$res[0]['asin'].'" target="_blank" title="Leave Product Review">Leave Product Review</a><br><a href="https://www.'.$store_info[0]['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$res[0]['asin'].'" target="_blank" title="Leave Product Review"><img src="'.$five_star_img.'"></a></td></tr></tbody></table><br><br>';
  $this->load->library('parser');
  $this->parser->set_delimiters('{{','}}');
  $msg=$res[0]['template_content'];
   $dt=array_merge($res[0],$store_info[0]);
  $msg=$this->parser->parse_string($msg,$dt,TRUE);
  $data['status_code']=1;
  $data['status_text']="Success";
  $data['email_content']=$msg;
  echo json_encode($data);

}

else
{
  echo '{"status_code":"0","status_text":"Somedata missing"}';
}

}

public function test_email()
  {
	  if(empty($_POST['order_id']))
	  {
		  echo '{"status_code":"0","status_text":"Any one order ID is needed to preview"}';
		  die();
	  }
	  elseif(empty($_POST['template_id']))
	  {
		  echo '{"status_code":"0","status_text":"Please choose a template"}';
		  die();
	  }elseif(empty($_POST['email']))
	  {
		  echo '{"status_code":"0","status_text":"Test Email Id is needed to send mail"}';
		  die();
	  }
	  elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	  {
		  echo '{"status_code":"0","status_text":"Test Email Id is invalid "}';
		  die();
	  }
    if(!empty($_POST['order_id']) && !empty($_POST['template_id']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
      $five_star_img=base_url()."asset/img/fivestar_icon.png";
      $sql="SELECT template_content,subject,itm_title as product_name,order_no as order_number,DATE_FORMAT(purchase_date,'%Y-%m-%d')  as order_date,buyer_name as customer_fullname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_firstname,SUBSTRING_INDEX(buyer_name, ' ', 1) as customer_lastname,buyer_email,asin ,itm_title,prod_image,sales_country
            FROM email_template
            INNER JOIN amz_order_info AS tnx ON order_no=".$this->db->escape($_POST['order_id'])." AND template_id=".$this->db->escape($_POST['template_id'])." AND tnx.store_id=".$this->store_id."
            INNER JOIN customer_product ON tnx.seller_sku=prod_sku AND tnx.store_id=".$this->store_id;
$query=$this->db->query($sql);
$res=$query->result_array();
if(empty($res))
{
  echo '{"status_code":"0","status_text":"Order ID not found "}';
  die();
}

  $str_sql="SELECT store_id,amz_code as marketplaceID,vendor_name,amz_domain,company_name,CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:15px'  href='http://www.\",amz_domain,\"/s?ie=UTF8&me=\",seller_id,\"'>Store Front URL</a>\") AS store_url,
  CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:15px'  href='https://www.\",amz_domain,\"/gp/feedback/leave-consolidated-feedback.html?ie=UTF8&isCBA=&marketplaceID=\",amz_code,\"&mode=eligibility&orderID=\",\"".$res[0]['order_number']."\",\"&ref_=fb_multi_cfb&'>Leave us feedback</a>\") AS feedback_url,
  CONCAT(\"<a style='color: #fff;background-color: #4fc6e1;border:5px solid #4fc6e1;font-size:15px'  href='https://www.\",amz_domain,\"/review/create-review/ref=oss_rev?_encoding=UTF8&asin=\",\"{$res[0]['asin']}\",\"'>Leave us review</a>\") AS review_url

FROM amazon_profile
INNER JOIN supported_country ON store_id=".$this->store_id." AND country_code=".$this->db->escape($res[0]['sales_country'])."  ";
  $str=$this->db->query($str_sql);
  $store_info=$str->result_array();
  $store_info[0]['review_url_with_product_img']='<br><br><table class="divProductReviewTable" cellpadding="4"><tbody><tr><td width="30%"><a href="https://www.'.$store_info[0]['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$res[0]['asin'].'" target="_blank" title="Leave Product Review"><img src="'.$res[0]['prod_image'].'" alt="'.$res[0]['asin'].'"></a></td><td width="70%">'.$res[0]['itm_title'].'<br>&nbsp;<br><a href="https://www.'.$store_info[0]['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$res[0]['asin'].'" target="_blank" title="Leave Product Review">Leave Product Review</a><br><a href="https://www.'.$store_info[0]['amz_domain'].'/gp/customer-reviews/review-your-purchases?asins='.$res[0]['asin'].'" target="_blank" title="Leave Product Review"><img src="'.$five_star_img.'"></a></td></tr></tbody></table><br><br>';

  $this->load->library('parser');
  $this->parser->set_delimiters('{{','}}');
  $msg=$res[0]['template_content'];
  $subject=$res[0]['subject'];
  $dt=array_merge($res[0],$store_info[0]);
  $msg=$this->parser->parse_string($msg,$dt,TRUE);

   $this->load->library('email');


    $this->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = "tls://email-smtp.us-east-1.amazonaws.com";
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'AKIAX2BCXESCD6UL6W4C';
    $config['smtp_pass'] = 'BNJVELo+k/v/Nn8r3QWUiMFqOZfFu/ZpSU4ABlVxo2OF';
    $config['wordwrap']=TRUE;
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
	$config['crlf'] = "\r\n";
    $this->email->initialize($config);
    $this->email->from('campaign@feedbackoutlook.com');
    $this->email->to($_POST['email']);
    $this->email->subject($subject);
    $this->email->message($msg);
   if ($this->email->send())
  {
    echo '{"status_code":"1","status_text":"Test mail has been sent"}';
  }
  else
  {
    echo '{"status_code":"0","status_text":"Not able to send mail "}';
  }
}
else
{
  echo '{"status_code":"0","status_text":"Somedata missing"}';
}
}


  public function perform_action() {
    $action = $_POST['action_name'];
    $camps = $_POST['campaign_ids'];

    $data  = array();

    //Archive
    if($action == 'archive') {
      foreach ($camps as $camp) {
        $uqry = "UPDATE campaign_manager SET is_archieve = 1, is_deleted = 0 WHERE cpgn_id = " . $camp;
        $this->db->query($uqry);
      }
      $data['status_text'] = "Campaign(s) archived successfully";
      $data['status_code'] = 1;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }

    //Delete
    if($action == 'delete') {
      foreach ($camps as $camp) {
        $uqry = "UPDATE campaign_manager SET is_deleted = 1, is_archieve = 0 WHERE cpgn_id = " . $camp;
        $this->db->query($uqry);
      }
      $data['status_text'] = "Campaign(s) deleted successfully";
      $data['status_code'] = 1;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }

    //Pause
    if($action == 'pause') {
      foreach ($camps as $camp) {
        $uqry = "UPDATE campaign_manager SET cpgn_status = 4 WHERE cpgn_id = " . $camp;
        $this->db->query($uqry);
      }
      $data['status_text'] = "Campaign(s) paused successfully";
      $data['status_code'] = 1;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }

    //Draft
    if($action == 'start') {
      foreach ($camps as $camp) {
        $uqry = "UPDATE campaign_manager SET cpgn_status = 1 WHERE cpgn_id = " . $camp;
        $this->db->query($uqry);
      }
      $data['status_text'] = "Campaign(s) started successfully";
      $data['status_code'] = 1;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }

    //Move to Folder
    if(is_numeric($action)) {
      foreach ($camps as $camp) {
        $uqry = "UPDATE campaign_manager SET folder_id =" . $action . " WHERE cpgn_id = " . $camp;
        $this->db->query($uqry);
      }
      $data['status_text'] = "Campaign(s) moved successfully";
      $data['status_code'] = 1;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }
    echo json_encode($data);
  }

  public function new_folder() {
    $folder_name = $_POST['folder_name'];
    $this->db->trans_start();
    $insq = "INSERT INTO scr_user_c_folders (user_id, folder_name) VALUES (".$this->user_id.", '".$folder_name."')";
    $this->db->query($insq);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      $data['status_text'] = "Something wrong. Please check.";
      $data['status_code'] = 0;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }
    else {
      $data['status_text'] = "Folder added successfully";
      $data['status_code'] = 1;
      $data['campaign_list'] = $this->campaign_model->get_campaign_list();
    }
    echo json_encode($data);
  }
}
