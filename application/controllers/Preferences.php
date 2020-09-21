<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preferences extends CI_Controller {

  /**
   * Constructor
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->model('preferences_model');
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
    $data = $this->preferences_model->getUserPrefs();
    $this->load->view('UI/header');
    $this->load->view('UI/sidepanel');
    $this->load->view('UI/navigation');
    $this->load->view('UI/preferences', $data);
    $this->load->view('UI/footer');
  }

  /**
   * save_preferences: Save user preferences
   * @param $app_email
   * @param $test_email
   * @param $neg_emails
   * @param $black_val
   * @return json
   */
  public function save_preferences($app_email = '', $test_email  = '', $neg_emails  = '', $black_val  = '')
  {
    $upref = "UPDATE scr_user SET email_negative_fb = '".$neg_emails."', test_emails = '".$test_email."', sender_email = '".$app_email."', fb_bl = '".$black_val."' where scr_u_id = " . $this->user_id;
    if($this->db->query($upref))
    {
      $data['status_text'] = "User preferences updated.";
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
   * save_logo: Save user logo
   * @param $img
   * @return json
   */
  public function save_logo()
  {
    $filename = $_FILES['logo_image']['name'];
    $location = 'uploads/';
    if (!is_dir($location)) {
      mkdir($location, 0777, true);
    }
    move_uploaded_file($_FILES['logo_image']['tmp_name'], $location.$filename);
    $uplogo = "UPDATE scr_user SET store_logo_path = '".$filename."' where scr_u_id = " . $this->user_id;
    if($this->db->query($uplogo))
    {
      $data['status_text'] = "File successfully uploaded.";
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
   * getUserPref: Getting user preferences
   * @return json
   */
  public function getUserPref()
  {
    $data = array();
    $data['status_text'] = 'Success';
    $data['status_code'] = '1';
    $data['user_pref'] = $this->preferences_model->getUserPref();
    $data['uploads_dir'] = base_url().'uploads/';
    echo json_encode($data);
  }

}
