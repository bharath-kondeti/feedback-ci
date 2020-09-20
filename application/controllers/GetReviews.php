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

    echo "<pre>";
    print_r($data);

    $result_table = "<table border='1'>
    <thead>
      <tr>
        <th>S No</th>
        <th>Product Title</th>
        <th>Product Asin</th>
        <th>Product SKU</th>
        <th>Product Country</th>
        <th>Price</th>
        <th>Review Title</th>
        <th>Review Description</th>
        <th>Review Rating</th>
        <th>Review Date</th>
        <th>Customer Name</th>
      </tr>
    </thead>";

  }
}
