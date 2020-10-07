<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class et extends CI_Controller {

  public function  __construct()
  {
     parent::__construct();
     $this->load->model('alert_model');
  }

  public function index() {
    $cid = $_GET['cid'];
    $this->alert_model->SaveReadCount($cid);
  }

}
