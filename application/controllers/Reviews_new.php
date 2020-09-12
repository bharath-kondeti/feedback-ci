<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_new extends CI_Controller
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
       $this->load->model('reviews_model');
       $this->load->model('campaign_model');
	 }

  }
  public function index()
	{
    $this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['reviews']=$this->reviews_model->get_users_reviews('1');
		//echo "<pre>"; print_r($data['reviews']); exit;
		$this->load->view('UI/reviews_new',$data);
		$this->load->view('UI/footer');
	}

  public function get_pre_data()
  {
      $to_date=date('Y-m-d');
      $frm_date = date('Y-m-d',strtotime("-30 days"));
	  $data['status_text']='Success';
      $data['status_code']='1';
      $data['revenue']=$this->reviews_model->get_revenue($frm_date,$to_date);
      $data['graph_data']=$this->reviews_model->get_graph_data($frm_date,$to_date);
	  $data['recent_ten_orders']=$this->reviews_model->get_recent_ten_orders();
      $data['cmp_info']=$this->reviews_model->get_consolidated_campaign_details($frm_date,$to_date);
      $data['metrics']=$this->campaign_model->get_campaign_metrics($frm_date,$to_date);
      $data['fbk_data']=$this->campaign_model->get_feedback_data($frm_date,$to_date);
      echo json_encode($data);
  }

  function get_reviews() {
    echo "<pre>";
    $data['status_text']='Success';
    $data['status_code']='1';
    $reviewContent = array();
    $reviews = $this->reviews_model->get_reviews($this->user_id);
    $i = 0;
    $today = date('Y-m-d');
    $sevendaysDate = date('Y-m-d', strtotime('-7 days'));
    foreach ($reviews as $review => $reviewValue) {
      $reviewContent[$i]['item_sku'] = $reviewValue['item_SKU'];
      $reviewContent[$i]['item_asin'] = $reviewValue['prod_asin'];
      $reviewContent[$i]['item_title'] = $reviewValue['prod_title'];
      $reviewContent[$i]['item_total_reviews'] = $reviewValue['total_reviews'];
      $reviewContent[$i]['item_image'] = $reviewValue['prod_image'];
      $getAllReviews = $this->reviews_model->get_all_reviews($reviewValue['item_SKU'],$this->user_id);
      $postiveCount = 0;
      $negativeCount = 0;
      $todayCount = 0;
      $sevenDaysCount = 0;
      $j = 0;
      foreach ($getAllReviews as $getReview => $value) {
        if($value['review_rating'] >= 3) {
          $postiveCount++;
        } else {
          $negativeCount++;
        }
        if($value['review_date'] == $today) {
          $todayCount++;
        }
        if($value['review_date'] >= $sevendaysDate) {
          $sevenDaysCount++;
        }
        $reviewContent[$i]['review_data'][$j] = $value;
        $j++;
      }
      $reviewContent[$i]['positive_review_count'] = $postiveCount;
      $reviewContent[$i]['today_review_count'] = $todayCount;
      $reviewContent[$i]['seven_days_count'] = $sevenDaysCount;
      $reviewContent[$i]['negative_review_count'] = $negativeCount;
      $i++;
    }

    $data['reviews'] = $reviewContent;

    echo json_encode($data);
  }

   public function get_all_reviews()
  {
    $result_set=$this->reviews_model->get_users_reviews('1');
    echo json_encode($result_set);
  }

 }
