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
      $store = $this->session->userdata('store_info');
      $this->store_id = $store['store_id'];
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

  /**
   * getUserPrefs: get user pref values
   * @return query_result
   */
  public function getUserPrefs()
  {
    $data = array();
    $sql = "SELECT fb_bl AS blacklistCheck, test_emails AS testEmail, store_logo_path as logoPath, sender_email as senderEmail, email_negative_fb as negEmail FROM scr_user WHERE scr_u_id = " . $this->user_id;
    $query = $this->db->query($sql);
    $res = $query->result_array();
    $data['blacklistCheck'] = $res[0]['blacklistCheck'];
    $data['testEmail'] = $res[0]['testEmail'];
    $data['logoPath'] = base_url().'uploads/'.$res[0]['logoPath'];
    $data['senderEmail'] = $res[0]['senderEmail'];
    $data['negEmail'] = $res[0]['negEmail'];

    return $data;
  }

  /**
   * getUserRequests: Getting user requests
   * @return array
   */
  public function getUserRequests()
  {
    $data = array();
    $sql = "SELECT hold_req, cancel_req FROM scr_user WHERE scr_u_id = " . $this->user_id;
    $query = $this->db->query($sql);
    $res = $query->result_array();
    $data['hold'] = $res[0]['hold_req'];
    $data['cancel'] = $res[0]['cancel_req'];

    return $data;
  }

  /**
   * getblacklist Blacklist users
   * @return array
   */
  public function getblacklist()
  {
    $sql = "SELECT * FROM buyer_blacklist WHERE bid_store_id = " . $this->store_id;
    $query = $this->db->query($sql);
    $res = $query->result_array();

    return $res;
  }
}
