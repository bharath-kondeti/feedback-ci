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
    $this->load->view('UI/header');
    $this->load->view('UI/sidepanel');
    $this->load->view('UI/navigation');
    $this->load->view('UI/cancel');
    $this->load->view('UI/footer');
  }

  /**
   * [hold_account: user can send hold account request]
   * @return bool
   */
  function hold_account () {
    $this->db->trans_start();
    $insert_hold_request = array(
      'scr_uid' => $this->user_id,
      'user_hold' => 0,
      'user_cancel' => 0,
      'user_hold_request' => 1,
      'user_cancel_request' => 0,
      'requested_on' => date('Y-m-d H:s:i'),
      'modified_on' => date('Y-m-d H:s:i')
    );
    $this->db->insert('scr_user_requests', $insert_hold_request);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      $data['status_code'] = 0;
    }
    else {
      $data['status_code'] = 1;
    }
    echo json_encode($data);
  }

  /**
   * [cancel_account user can send cancel account request]
   * @return bool
   */
  function cancel_account () {
    $this->db->trans_start();
    $insert_cancel_request = array(
      'scr_uid' => $this->user_id,
      'user_hold' => 0,
      'user_cancel' => 0,
      'user_hold_request' => 0,
      'user_cancel_request' => 1,
      'requested_on' => date('Y-m-d H:s:i'),
      'modified_on' => date('Y-m-d H:s:i')
    );
    $this->db->insert('scr_user_requests', $insert_cancel_request);
    $this->db->trans_complete();
    if ($this->db->trans_status() === FALSE) {
      $data['status_code'] = 0;
    }
    else {
      $data['status_code'] = 1;
    }
    echo json_encode($data);
  }
}
