<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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
        $this->load->model("order_model");
        $user=$this->session->userdata('user_logged_in');
        $this->user_id=$user['id'];
        $store=$this->session->userdata('store_info');
       $this->store_id=$store['store_id'];
     $this->store_country=$store['store_country'];

     }
  }
	public function index()
	{
    $data['store_country'] = $this->store_country;
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
        $this->load->view('UI/order',$data);
		$this->load->view('UI/footer');
	}

	public function get_order_list($orderby='purchase_date',$direction='DESC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->order_model->get_order_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }


}
