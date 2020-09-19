<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preferences extends CI_Controller {

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
      $user=$this->session->userdata('user_logged_in');
      $this->user_id=$user['id'];
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
    $this->load->view('UI/preferences');
    $this->load->view('UI/footer');
  }
  function save_preferences($app_email,$test_email,$neg_emails,$black_val) {
    
  }
}
