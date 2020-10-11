<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_new extends CI_Controller
{
  public function  __construct()
  {
     parent::__construct();
     $this->load->model('login_model');
     if(!$this->login_model->userLoginCheck() && !$this->input->is_ajax_request())
     {
      redirect('user_auth');
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
    $data['store_country'] = $this->store_country;
    $this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/feedback_new', $data);
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

   public function get_top_product($orderby='',$direction='',$offet,$limit,$searchterm='')
  {
    $result_set=$this->dash_model->get_top_product($orderby,$direction,$offet,$limit,$searchterm);
    echo json_encode($result_set);
  }

 }
