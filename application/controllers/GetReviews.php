<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * GetReviews class
 */
class GetReviews extends CI_Controller
{

  /**
   * Constructor
   */
  public function  __construct()
  {
    parent::__construct();
    $this->load->model('login_model');
    if(!$this->login_model->userLoginCheck() && !$this->input->is_ajax_request())
    {
      redirect('user_auth');
    }
    else
    {
      $user = $this->session->userdata('user_logged_in');
      $this->user_id = $user['id'];
      $store=$this->session->userdata('store_info');
      $this->store_id = $store['store_id'];
      $this->store_country = $store['store_country'];
      $this->load->model('inventory_model');
    }
  }

  public function getTrackedReviews()
  {
    $data = $this->inventory_model->getTrackedReviews();
  }
}
