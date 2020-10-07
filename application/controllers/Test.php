<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
  public function  __construct() {
    parent::__construct();
    $this->load->model('login_model');
    if(!$this->login_model->userLoginCheck()) {
      redirect('user_auth');
    } else {
      $user=$this->session->userdata('user_logged_in');
      $this->user_id=$user['id'];
      $this->user_email=$user['uname'];
      $this->user_name=$user['fname']." ".$user['lname'];
      $this->load->model('razorpay_model','razorpay_api');
    }
  }

  public function index() {
    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.gmail.com',
      'smtp_port' => '465',
      'smtp_user' => 'bharathkumarkondeti@gmail.com',
      'smtp_pass' => 'Chintu@9793',
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n",
      'wordwrap' => TRUE
    );
    $message = "This is mail body which is send to recipient for Testing";

    $message = $message."<html><a href='http://localhost/new-project/et?cid=1'>Test</a></html>";

    $this->load->library('email', $config);
    $this->email->initialize($config);
    $this->email->from('mailidforphotos@gmail.com','Photos Kumar');
    $this->email->to('bharath122334@gmail.com');
    $this->email->subject('Test Mail');
    $this->email->message($message);

    if($this->email->send())
      echo 'Email sent.';
    else
      show_error($this->email->print_debugger());
    }
}
