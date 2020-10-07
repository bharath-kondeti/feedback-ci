<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
    $data['orders_graph']=$this->dash_model->orders_graph($frm_date,$to_date);
    $data['feedback_graph']=$this->dash_model->feedback_graph($frm_date,$to_date);
    $data['review_graph']=$this->dash_model->review_graph($frm_date,$to_date);
    $data['messages_graph']=$this->dash_model->messages_graph($frm_date,$to_date);
	  $data['recent_ten_orders']=$this->dash_model->get_recent_ten_orders();
    $data['cmp_info']=$this->dash_model->get_consolidated_campaign_details($frm_date,$to_date);
    $data['metrics']=$this->campaign_model->get_campaign_metrics($frm_date,$to_date);
    $data['fbk_data']=$this->campaign_model->get_feedback_data($frm_date,$to_date);
    $data['reviews_data'] = $this->campaign_model->get_reviews_overview();
    $review_breakdown = $this->campaign_model->get_reviews_breakdown();
    $one_star = 0;
    $two_star = 0;
    $three_star = 0;
    $four_star = 0;
    $five_star = 0;
    foreach ($review_breakdown as $key => $review) {
      if((float)$review['review_rating'] > 0 && (float)$review['review_rating'] <= 1.5 ) {
        $one_star++;
      }
      if((float)$review['review_rating'] > 1.5 && (float)$review['review_rating'] <= 2.5 ) {
        $two_star++;
      }
      if((float)$review['review_rating'] > 2.5 && (float)$review['review_rating'] <= 3.5 ) {
        $three_star++;
      }
      if((float)$review['review_rating'] > 3.5 && (float)$review['review_rating'] <= 4.5 ) {
        $four_star++;
      }
      if((float)$review['review_rating'] > 4.5 && (float)$review['review_rating'] <= 5 ) {
        $five_star++;
      }
    }
    $data['breakdown']['one_star'] = $one_star;
    $data['breakdown']['two_star'] = $two_star;
    $data['breakdown']['three_star'] = $three_star;
    $data['breakdown']['four_star'] = $four_star;
    $data['breakdown']['five_star'] = $five_star;
    echo json_encode($data);
  }

  public function get_feedbacks($frm_date = '', $to_date = '', $order_or_email = '', $search_term = '',$offet, $limit) {
    $data['status_text']='Success';
    $data['status_code']='1';
    $fbk = array();
    if($to_date == '') {
      $to_date=date('Y-m-d');
    }
    if($frm_date == '') {
      $frm_date = date('Y-m-d',strtotime("-30 days"));
    }
    $feedbacks = $this->campaign_model->get_feedbacks($frm_date, $to_date, $order_or_email, $search_term, $offet, $limit);
    $fb_count = $this->campaign_model->get_fb_count($frm_date, $to_date, $order_or_email, $search_term, $offet, $limit);
    $count = 0;
    foreach ($feedbacks as $feedback => $fbk_value) {
      $count++;
      if($fbk_value['fbk_rating'] >= 4) {
        $fbk['positive'][$feedback] = $fbk_value;
      } else if($fbk_value['fbk_rating'] <= 2) {
        $fbk['negative'][$feedback] = $fbk_value;
      } else if($fbk_value['fbk_rating'] == 3) {
        $fbk['neutral'][$feedback] = $fbk_value;
      }
    }
    $data['total_records'] = (int)$fb_count[0]['count'];
    $data['page_count'] = $count;
    $data['fbks'] = $fbk;
    echo json_encode($data);
  }

   public function get_top_product($orderby='',$direction='',$offet,$limit,$searchterm='')
  {
    $result_set=$this->dash_model->get_top_product($orderby,$direction,$offet,$limit,$searchterm);
    echo json_encode($result_set);
  }

 }
