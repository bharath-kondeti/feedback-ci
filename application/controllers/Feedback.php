<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {

	private $user_id;
  public function  __construct()
  {
       parent::__construct();
      if(!$this->login_model->userLoginCheck())
      {
        redirect('user_auth');
      }
      elseif($this->login_model->userLoginCheck() && $this->session->userdata('finance_not_added')=='yes')
     {
      redirect('progress');
     }
      else
      {
        $this->load->model("Seller_reviews_model");
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
		$this->load->view('UI/feedback',$data);
		$this->load->view('UI/footer');
	}

public function get_review_list($orderby='',$direction='DESC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->Seller_reviews_model->get_review_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }


}
