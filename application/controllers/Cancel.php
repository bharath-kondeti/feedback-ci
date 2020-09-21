<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancel extends CI_Controller {

  /**
   * Constructor
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->model('login_model');
    $this->load->model('preferences_model');
    if(!$this->login_model->userLoginCheck())
    {
      redirect('user_auth');
    } else
    {
      $user = $this->session->userdata('user_logged_in');
      $this->user_id = $user['id'];
    }
  }

  /**
   * Index function
   */
  public function index($value='')
  {
    $data = $this->preferences_model->getUserRequests();
    $this->load->view('UI/header');
    $this->load->view('UI/sidepanel');
    $this->load->view('UI/navigation');
    $this->load->view('UI/cancel', $data);
    $this->load->view('UI/footer');
  }

  /**
   * [hold_account: user can send hold account request]
   * @return bool
   */
  function hold_account () {
    $upq = "UPDATE scr_user SET hold_req = 1 where scr_u_id = " . $this->user_id;
    if($this->db->query($upq))
    {
      $data['status_text'] = "User Hold Request Sent.";
      $data['status_code'] = 1;
    }
    else
    {
      $data['status_text'] = "Something went wrong please try agin after sometime";
      $data['status_code'] = 0;
    }
    echo json_encode($data);
  }

  /**
   * [cancel_account user can send cancel account request]
   * @return bool
   */
  function cancel_account () {
    $upq = "UPDATE scr_user SET cancel_req = 1 where scr_u_id = " . $this->user_id;
    if($this->db->query($upq))
    {
      $data['status_text'] = "User Cancellation Request Sent.";
      $data['status_code'] = 1;
    }
    else
    {
      $data['status_text'] = "Something went wrong please try agin after sometime";
      $data['status_code'] = 0;
    }
    echo json_encode($data);
  }
}
