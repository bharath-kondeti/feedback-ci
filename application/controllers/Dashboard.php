<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function  __construct()
  {
     parent::__construct();
     $this->load->model('login_model');
     if(!$this->login_model->userLoginCheck() && !$this->input->is_ajax_request())
     {
      redirect('uauth');
     }
	 else
     {
       $user=$this->session->userdata('user_logged_in');
       $this->user_id=$user['id'];
	   $store=$this->session->userdata('store_info');
       $this->store_id=$store['store_id'];
	   $this->store_country=$store['store_country'];
       $this->load->model('dash_model');
       $this->load->model('campaign_model');
	 }

  }
  public function index()
	{
        $this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/dashboard');
		$this->load->view('UI/footer');
	}

  public function get_pre_data()
  {
    $to_date=date('Y-m-d');
    $frm_date = date('Y-m-d',strtotime("-30 days"));
	  $data['status_text']='Success';
    $data['status_code']='1';
    $data['revenue']=$this->dash_model->get_revenue($frm_date,$to_date);
    $data['graph_data']=$this->dash_model->get_graph_data($frm_date,$to_date);
	  $data['recent_ten_orders']=$this->dash_model->get_recent_ten_orders();
    $data['cmp_info']=$this->dash_model->get_consolidated_campaign_details($frm_date,$to_date);
    $data['metrics']=$this->campaign_model->get_campaign_metrics($frm_date,$to_date);
    $data['fbk_data']=$this->campaign_model->get_feedback_data($frm_date,$to_date);
    echo json_encode($data);
  }

  public function get_feedbacks($frm_date = '',$to_date = '') {
    $data['status_text']='Success';
    $data['status_code']='1';
    $fbk = array();
    if($to_date == '') {
      $to_date=date('Y-m-d');
    }
    if($frm_date == '') {
      $frm_date = date('Y-m-d',strtotime("-30 days"));
    }
    $feedbacks = $this->campaign_model->get_feedbacks($frm_date,$to_date);
    foreach ($feedbacks as $feedback => $fbk_value) {
      if($fbk_value['fbk_rating'] >= 4) {
        $fbk['positive'][$feedback] = $fbk_value;
      } else if($fbk_value['fbk_rating'] <= 2) {
        $fbk['negative'][$feedback] = $fbk_value;
      } else if($fbk_value['fbk_rating'] == 3) {
        $fbk['neutral'][$feedback] = $fbk_value;
      }
    }
    $data['fbks'] = $fbk;
    echo json_encode($data);
  }

   public function get_top_product($orderby='',$direction='',$offet,$limit,$searchterm='')
  {
    $result_set=$this->dash_model->get_top_product($orderby,$direction,$offet,$limit,$searchterm);
    echo json_encode($result_set);
  }

 }
