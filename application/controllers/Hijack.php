<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hijack extends CI_Controller {

	 private $user_id;
  public function  __construct()
  {
       parent::__construct();
     if(!$this->login_model->userLoginCheck() && !$this->input->is_ajax_request())
     {
      redirect('uauth');
     }
   
      else
      {
        $this->load->model("hijack_alert_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
		$store=$this->session->userdata('store_info');  
        $this->store_id=$store['store_id'];
       
      }
       
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
		$this->load->view('UI/hijack',$data);
		$this->load->view('UI/footer');
	}
	
	public function get_inventory_list($orderby='',$direction='',$offet,$limit,$searchterm='')
  {
      $orderby=$orderby=='GEN'?'':$orderby;
      $result_set=$this->hijack_alert_model->get_inventory_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }
	public function brand_list()
  {
    $query=$this->db->query("SELECT prod_brand from customer_product WHERE store_id=".$this->store_id." and is_active=1  AND prod_brand <> '' GROUP by prod_brand");
    $res=$query->result_array();
    $data['status_text']="Success";
    $data['status_code']=1;
    $data['brand_list']=$res;
    echo json_encode($data);
 }


  public function set_hijack_alert()
  {
    $this->load->model('campaign_model');
    //$plan=$this->campaign_model->validate_allowed_hijack_count();
	$plan['hijack_alert']='500';
    if(isset($_POST['selected_order']))
    {
      $ord=json_decode($_POST['selected_order']);
      $plan['cur_hijack_count']=count($ord);
      if($plan['hijack_alert'] < $plan['cur_hijack_count'])
      {
        echo '{"status_code":"0","status_text":"As per your current plan you can not set more than '.$plan['hijack_alert'].' Hijack alert "}'; 
      }
      else
      {
        foreach($ord as $od)
        {
            $sql="UPDATE customer_product SET check_hijack=1 WHERE prod_asin=".$this->db->escape($od->prod_asin)." AND store_id=".$this->store_id;
            $this->db->query($sql);
        }
        echo '{"status_code":"1","status_text":"Status updated "}';   
      }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Mandatory data missing "}';
    }
  }

   public function remove_hijack_alert()
  {
    if(isset($_POST['selected_order']))
    {
      $ord=json_decode($_POST['selected_order']);
      foreach($ord as $od)
      {
          $sql="UPDATE customer_product SET check_hijack=0 WHERE prod_asin=".$this->db->escape($od->prod_asin)." AND store_id=".$this->store_id;
          $this->db->query($sql);
      }
     echo '{"status_code":"1","status_text":"Status updated "}'; 
    }
    else
    {
      echo '{"status_code":"0","status_text":"Mandatory data missing "}';
    }
  }

  
	
}
