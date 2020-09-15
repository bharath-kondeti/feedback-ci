<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	private $user_id;
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
        $this->load->model("inventory_model");
        $user=$this->session->userdata('user_logged_in');
        $this->user_id=$user['id'];

     }
  }

	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
		$this->load->view('UI/inventory',$data);
	    $this->load->view('UI/footer');
	}

	public function get_inventory_list($orderby='pro_id',$direction='ASC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->inventory_model->get_inventory_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }

  public function change_status()
  {
    if(isset($_POST['status']) && ((int)$_POST['status']==1 ||(int)$_POST['status']==0) )
    {
    $status=(int)$_POST['status']==1?'1':'0';
       $ufql="UPDATE customer_product set review_tracking=".$status." where prod_asin=".$this->db->escape($_POST['asin'])." AND store_id=".$_POST['storeid'];

        if($this->db->query($ufql))
        {
          $data['status_text']="Review Tracking Updated";
          $data['status_code']=1;
          //$data['campaign_list']=$this->campaign_model->get_campaign_list();
        }
        else
        {
          $data['status_text']="Something went wrong please try agin after sometime";
          $data['status_code']=0;
          //$data['campaign_list']=$this->campaign_model->get_campaign_list();

        }
        echo json_encode($data);
    }
    else
    {
      echo '{"status_code":"0","status_text":"Input Error"}';
    }
  }
}
