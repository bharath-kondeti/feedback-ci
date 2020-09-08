<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	private $user_id;
    public function  __construct()
  {
       parent::__construct();
	  $this->load->model('login_model');

     if(!$this->login_model->userLoginCheck())
     {
       redirect('user_auth');
     }
      else
     {
        $this->load->model("inventory_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
       
     }
  }
	
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$data['store_count']=$this->common_model->get_users_stores_count($this->user_id);
		$this->load->view('UI/inventory',$data);
	    $this->load->view('UI/footer');
	}

	public function get_inventory_list($orderby='pro_id',$direction='ASC',$offet,$limit,$searchterm='')
  {
      $result_set=$this->inventory_model->get_inventory_list($orderby,$direction,$offet,$limit,$searchterm);
      echo json_encode($result_set);
  }
	
	
	

	
	
}
