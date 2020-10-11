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
    $data['store_country'] = $this->store_country;
    $this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['reviews']=$this->reviews_model->get_users_reviews('1');
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

  function get_reviews($offset = '', $limit = '') {
    $data['status_text']='Success';
    $data['status_code']='1';
    $reviewContent = array();
    $reviews = $this->reviews_model->get_reviews($this->user_id, $offset, $limit);
    $review_count = $this->reviews_model->get_reviews_count($this->user_id);
    $total_records = sizeof($review_count);
    $i = 0;
    $today = date('Y-m-d');
    $sevendaysDate = date('Y-m-d', strtotime('-7 days'));
    $page_count = 0;
    foreach ($reviews as $review => $reviewValue) {
      $page_count++;
      $reviewContent[$i]['item_sku'] = $reviewValue['item_SKU'];
      $reviewContent[$i]['item_asin'] = $reviewValue['prod_asin'];
      $reviewContent[$i]['item_title'] = $reviewValue['prod_title'];
      $reviewContent[$i]['item_total_reviews'] = $reviewValue['total_reviews'];
      $reviewContent[$i]['item_image'] = $reviewValue['prod_image'];
      $reviewContent[$i]['expanded'] = false;
      $getAllReviews = $this->reviews_model->get_all_reviews($reviewValue['item_SKU'],$this->user_id);
      $postiveCount = 0;
      $negativeCount = 0;
      $todayCount = 0;
      $sevenDaysCount = 0;
      $j = 0;
      $totalRating = 0;
      $one_star = 0;
      $two_star = 0;
      $three_star = 0;
      $four_star = 0;
      $five_star = 0;
      foreach ($getAllReviews as $getReview => $value) {
        $totalRating = $totalRating + (float)$value['review_rating'];
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
        if((float)$value['review_rating'] > 0 && (float)$value['review_rating'] <= 1.5 ) {
          $one_star++;
        }
        if((float)$value['review_rating'] > 1.5 && (float)$value['review_rating'] <= 2.5 ) {
          $two_star++;
        }
        if((float)$value['review_rating'] > 2.5 && (float)$value['review_rating'] <= 3.5 ) {
          $three_star++;
        }
        if((float)$value['review_rating'] > 3.5 && (float)$value['review_rating'] <= 4.5 ) {
          $four_star++;
        }
        if((float)$value['review_rating'] > 4.5 && (float)$value['review_rating'] <= 5 ) {
          $five_star++;
        }
        $reviewContent[$i]['review_data'][$j] = $value;
        $j++;
      }
      $reviewContent[$i]['one_star'] = $one_star;
      $reviewContent[$i]['two_star'] = $two_star;
      $reviewContent[$i]['three_star'] = $three_star;
      $reviewContent[$i]['four_star'] = $four_star;
      $reviewContent[$i]['five_star'] = $five_star;
      $reviewContent[$i]['positive_review_count'] = $postiveCount;
      $reviewContent[$i]['today_review_count'] = $todayCount;
      $reviewContent[$i]['seven_days_count'] = $sevenDaysCount;
      $reviewContent[$i]['negative_review_count'] = $negativeCount;
      $reviewContent[$i]['avg_count'] = round(($totalRating/$reviewValue['total_reviews']),2);
      $i++;
    }
    $data['page_count'] = $page_count;
    $data['total_records'] = $total_records;
    $data['reviews'] = $reviewContent;

    echo json_encode($data);
  }

   public function get_all_reviews()
  {
    $result_set=$this->reviews_model->get_users_reviews('1');
    echo json_encode($result_set);
  }

 }
