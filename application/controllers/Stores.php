<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stores extends CI_Controller {
  public function  __construct()
  {
     parent::__construct();
     $this->load->model('login_model');
     if(!$this->login_model->userLoginCheck())
     {
      redirect('user_auth');
     }
     $user=$this->session->userdata('user_logged_in');  
     $this->user_id=$user['id'];
     // $this->load->model('store_model');
     
  }
  // public function index()
  // {
  //     $this->load->view('UI/header');
  //     $this->load->view('UI/dashboard');
  //     $this->load->view('UI/footer');
  // }

public function change_store($store_id)
{
  $sql="SELECT * FROM store_access AS acs
  INNER JOIN  store_manager AS mgr ON mgr.store_id=acs.store_id AND acs.store_id=".$this->db->escape($store_id)." AND user_id=".$this->user_id;
  $sql.=" INNER JOIN supported_country AS spt ON spt.country_code=mgr.country_code ";                    
  $qry=$this->db->query($sql);
  

  $res=$qry->result_array();//print_r($res);
  //die();
  if(count($res) > 0 )
  {
    $store_info=array('store_id'=>$res[0]['store_id'],'store_name'=>$res[0]['store_name'],'store_location'=>$res[0]['store_location'],'currency_code'=>$res[0]['currency_code'],'store_country'=>$res[0]['country_code']);
    // print_r($this->session->all_userdata());
    $this->session->unset_userdata('store_info');
    // print_r($this->session->all_userdata());

    $this->session->set_userdata('store_info', $store_info);
    // print_r($this->session->all_userdata());
    // die();
    redirect('dashboard');
  }
  else
  {
    show_404();
  }
}
  
  
}