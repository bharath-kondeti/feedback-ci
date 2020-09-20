<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Prefernces Model
 * Transactions related to user preferences
 */
class Preferences_model extends CI_Model
{

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
   * getUserPref: get user pref values
   * @return query_result
   */
  public function getUserPref()
  {
    $sql = "SELECT fb_bl AS blacklistCheck, test_emails AS testEmails, store_logo_path as logoPath, sender_email as senderEmail, email_negative_fb as negEmail FROM scr_user WHERE scr_u_id = " . $this->user_id;
    $query = $this->db->query($sql);
    return $query->result_array();
  }


  public function getUserRequests()
  {
    return 'Test';
  }
}