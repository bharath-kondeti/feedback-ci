<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blacklist extends CI_Controller {

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
    $data['result'] = $this->preferences_model->getblacklist();
    $this->load->view('UI/header');
    $this->load->view('UI/sidepanel');
    $this->load->view('UI/navigation');
    $this->load->view('UI/blacklist',$data);
    $this->load->view('UI/footer');
  }
}
