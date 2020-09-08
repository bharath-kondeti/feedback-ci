<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends CI_Controller {

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
        $this->load->model("campaign_model");   
        $user=$this->session->userdata('user_logged_in');  
        $this->user_id=$user['id'];
		$store=$this->session->userdata('store_info');  
	    $this->store_id=$store['store_id'];
	    $this->store_country=$store['store_country'];
       
     }
  }
	public function index()
	{
		$this->load->view('UI/header');
		$this->load->view('UI/sidepanel');
		$this->load->view('UI/navigation');
		$this->load->view('UI/template');
		$this->load->view('UI/footer');
	}
	
	
	 public function get_pre_data()
  {
    $data['status_text']='Success';
    $data['status_code']='1';
    $data['template_list']=$this->campaign_model->get_template_list();
	echo json_encode($data);
  }
  
  
  public function edit_template()
    {
      if(isset($_POST['template_id']) && !empty($_POST['template_id']))
      {
        $qry=$this->db->query("SELECT * from  email_template WHERE template_id=".$this->db->escape($_POST['template_id']));
        $res=$qry->result_array();

        if(count($res) > 0)
        {
          $data['status_text']="Retrived";
          $data['status_code']=1;
          $data['template_detail']=$res;
          
        }
        else
        {
          $data['status_text']="There is no campaign found";
          $data['status_code']=0;
        }
        echo json_encode($data);
      }
      else
      {
        echo '{"status_code":"0","status_text":"Input error"}';
      }
    }
	
	 public function delete_template()
  {
    if(isset($_POST['template_id']) && !empty($_POST['template_id']))
    {
      $this->db->trans_start();
      $this->db->query("UPDATE email_template SET is_deleted=1 WHERE created_by=".$this->user_id." AND template_id=".$this->db->escape($_POST['template_id']));
      $this->db->query("UPDATE campaign_manager SET is_active=0 WHERE created_by=".$this->store_id." AND cpgn_templateID=".$this->db->escape($_POST['template_id']));
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
      {
        echo '{"status_code":"0","status_text":"Something went wrong"}';
      } 
      else
      {
        echo '{"status_code":"1","status_text":"Templated deleted"}';
      }
      

    }
    else
    {
      echo '{"status_code":"0","status_text":"Mantatory data missing"}';
    }
  }
	public function save_template()
  {
	  if(isset($_POST['template_data']))
    {
      $post=json_decode($_POST['template_data']);
	  if( isset($post->subject) && isset($post->template_ui) && isset($post->template_name))
      {
        if( !empty($post->subject) && !empty($post->template_ui) && !empty($post->template_name))
        {
          $sql="SELECT count(*) ttl from email_template where created_by={$this->user_id} AND template_name=".$this->db->escape($post->template_name);
          if(isset($post->tmp_id) && !empty($post->tmp_id) && $post->tmp_id > 0)
            {
              $sql.=" AND template_id <> ".$this->db->escape($post->tmp_id);
            }
           
          $qry=$this->db->query($sql);
          $res=$qry->result_array();
          if(!empty($res) && $res[0]['ttl'] > 0)
          {
            echo '{"status_code":"0","status_text":"Template name already exist"}';         
            die();
          }
          $this->db->trans_start();
          if(isset($post->tmp_id) && !empty($post->tmp_id) && $post->tmp_id > 0)
            {
                $this->db->query("UPDATE email_template SET template_name=".$this->db->escape($post->template_name).",subject=".$this->db->escape($post->subject).",template_content=".$this->db->escape($post->template_ui)." WHERE template_id=".$this->db->escape($post->tmp_id)." AND created_by=".$this->user_id);
            }
            else
            {

              $insert_template=array('subject'=>$post->subject,'template_name'=>$post->template_name,'template_content'=>$post->template_ui,'created_on'=>date('Y-m-d H:i:s'),'created_by'=>$this->user_id);
              $this->db->insert('email_template',$insert_template);
            }
           $this->db->trans_complete();
           if ($this->db->trans_status() === FALSE)
           {
                echo '{"status_code":"0","status_text":"Duplicate template Entry / Something went wrong try again later "}';         
           }
           else
           {
                   $data['status_code']=1;
                   $data['status_text']=1;
                   $data['payload']=$this->campaign_model->get_template_list();
                     echo '{"status_code":"1","status_text":"Successfully updated"}';         
           }
            
            
        }
        else
        {
          echo '{"status_code":"0","status_text":"Mandatory data missing 1"}';         
        }
      }
      else
      {
        echo '{"status_code":"0","status_text":"Mandatory data missing 2"}';         
      }
    }
    else
    {
      echo '{"status_code":"0","status_text":"Mandatory data missing 3 "}';         
    }
  }
  
	
	
	
	
	
}
