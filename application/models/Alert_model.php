
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Alert_model extends CI_Model
{
	private $rs=[];
	public function  __construct()
	{
	   parent::__construct();
	   $this->load->library('parser');
     $this->parser->set_delimiters('{','}');
     $this->rs['site_url']=base_url();
     $this->rs['logo']=base_url()."assets/img/logo.png";
    }

    public function set_alert($type,$subject,$msg,$sent_mail,$user_id,$timestamp,$alert_name='LOW_INVENTORY')
    {
    	if($sent_mail==1 || $sent_mail=10)
    	{
    			$sent_mail=$this->send_mail($subject,$msg,$user_id,$alert_name,$sent_mail);
    	}
    	$insert_alert=array('alert_type'=>$type,'alert_head'=>$subject,'alert_msg'=>$msg,'is_mailed'=>$sent_mail,'is_read'=>0,'alert_on'=>$timestamp,'alert_for'=>$user_id);
    	$this->db->insert('alert_manager',$insert_alert);


    }
    public function notify_negative_review($user_id='')
    {
      if(empty($user_id))
      {
        echo "There is no user ID Passed";
        die();
      }

	  $qry=$this->db->query("SELECT * FROM amz_feedback_data WHERE fbk_for={$user_id} AND fbk_rating in (1,2) and notify_sent=0");
      $ng_feed=$qry->result_array();

	  $qr=$this->db->query("SELECT * from scr_user where scr_u_id=".$user_id." AND neg_fbk=1");
      $res=$qr->result_array();
      if(empty($res))
      {
		  $msg='';
           if(count($ng_feed) >0)
           {
			$msg .= '
            <!DOCTYPE html>
            <html lang="en">';
            $msg="Hi, ".$res[0]['scr_firstname']."<br>";
            $msg.=" You have got some negative feedback please have a look at it<br>";
			$msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Order ID</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Date</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Comment</th>
    </tr>
    </thead>
    <tbody>';





			foreach($ng_feed as $fd)
            {
				  $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['order_id'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['fbk_date'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['fbk_comment'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['sent_count'].'</td>';
			//$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_repricer'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_bb'].'</td>';
            $msg .='</tr>';

              // $msg.="<p>feedback For <b>Order ID :".$fd['order_id']." </b> On ".$fd['fbk_date'];
              // $msg.="<p><i>".$fd['fbk_comment']."</i><p>";
            }
			 $msg .= '</tbody></table>';
			 //$msg .= '</tbody></table>';
             $msg .= '<p>Thank you!<br></p>';
             $msg .= '</body></html>';
            $alert_type="Feedback";
            $alert_subject="Negative Feedback Notification";
            $alert_msg=$msg;
            $sent_mail=0;
            $timestamp=date('Y-m-d H:s:i');
            // $this->load->model('alert_model');
            $this->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$user_id,$timestamp);
            $up_sql="UPDATE amz_feedback_data SET notify_sent=1 where fbk_for={$user_id} AND order_id IN (";
            foreach($ng_feed as $fd)
            {
                  $up_sql.=$this->db->escape($fd['order_id']).",";
            }
            $up_sql=rtrim($up_sql,',').")";
            $this->db->query($up_sql);
          }
      }
      else
      {
		  $msg='';
          if(count($ng_feed) >0)
           {
            $msg .= '
            <!DOCTYPE html>
            <html lang="en">';
            $msg="Hi, ".$res[0]['scr_firstname']."<br>";
            $msg.=" You have got some negative feedback please have a look at it<br>";
			$msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Order ID</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Date</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Comment</th>
    </tr>
    </thead>
    <tbody>';
           foreach($ng_feed as $fd)
            {
				  $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$fd['order_id'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$fd['fbk_date'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$fd['fbk_comment'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['sent_count'].'</td>';
			//$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_repricer'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_bb'].'</td>';
            $msg .='</tr>';

              // $msg.="<p>feedback For <b>Order ID :".$fd['order_id']." </b> On ".$fd['fbk_date'];
              // $msg.="<p><i>".$fd['fbk_comment']."</i><p>";
            }
			 $msg .= '</tbody></table>';
			 //$msg .= '</tbody></table>';
             $msg .= '<p>Thank you!<br></p>';
             $msg .= '</body></html>';
            $alert_type="Feedback";
            $alert_subject="Negative Feedback Notification";
            $alert_msg=$msg;
            $sent_mail=1;
            $timestamp=date('Y-m-d H:s:i');
            $this->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$user_id,$timestamp);
            $up_sql="UPDATE amz_feedback_data SET notify_sent=1 where fbk_for={$user_id} AND order_id IN (";
            foreach($ng_feed as $fd)
            {
                  $up_sql.=$this->db->escape($fd['order_id']).",";
            }
            $up_sql=rtrim($up_sql,',').")";
            $this->db->query($up_sql);
           }
       }
    }




	 public function notify_neutral_review($user_id='')
    {
      if(empty($user_id))
      {
        echo "There is no user ID Passed";
        die();
      }

	  $qry=$this->db->query("SELECT * FROM amz_feedback_data WHERE fbk_for={$user_id} AND fbk_rating='3' and notify_sent=0");
      $ng_feed=$qry->result_array();

	  $qr=$this->db->query("SELECT * from scr_user where scr_u_id=".$user_id." AND ntr_fbk=1");
      $res=$qr->result_array();
      if(empty($res))
      {
		  $msg='';
           if(count($ng_feed) >0)
           {
			$msg .= '
            <!DOCTYPE html>
            <html lang="en">';
            $msg="Hi, ".$res[0]['scr_firstname']."<br>";
            $msg.=" You have recieved a neutral seller feedback,Please have a look at it<br>";
			$msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Order ID</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Date</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Comment</th>
    </tr>
    </thead>
    <tbody>';





			foreach($ng_feed as $fd)
            {
				  $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$fd['order_id'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$fd['fbk_date'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$fd['fbk_comment'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['sent_count'].'</td>';
			//$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_repricer'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_bb'].'</td>';
            $msg .='</tr>';

              // $msg.="<p>feedback For <b>Order ID :".$fd['order_id']." </b> On ".$fd['fbk_date'];
              // $msg.="<p><i>".$fd['fbk_comment']."</i><p>";
            }
			 $msg .= '</tbody></table>';
			 //$msg .= '</tbody></table>';
             $msg .= '<p>Thank you!<br></p>';
             $msg .= '</body></html>';
            $alert_type="Feedback";
            $alert_subject="Neutral Feedback Notification";
            $alert_msg=$msg;
            $sent_mail=0;
            $timestamp=date('Y-m-d H:s:i');
            // $this->load->model('alert_model');
            $this->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$user_id,$timestamp);
            $up_sql="UPDATE amz_feedback_data SET notify_sent=1 where fbk_for={$user_id} AND order_id IN (";
            foreach($ng_feed as $fd)
            {
                  $up_sql.=$this->db->escape($fd['order_id']).",";
            }
            $up_sql=rtrim($up_sql,',').")";
            $this->db->query($up_sql);
          }
      }
      else
      {
		  $msg='';
          if(count($ng_feed) >0)
           {
            $msg .= '
            <!DOCTYPE html>
            <html lang="en">';
            $msg="Hi, ".$res[0]['scr_firstname']."<br>";
            $msg.="You have recieved a neutral seller feedback,Please have a look at it <br>";
			$msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Order ID</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Date</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Feedback Comment</th>
    </tr>
    </thead>
    <tbody>';
           foreach($ng_feed as $fd)
            {
				  $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['order_id'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['fbk_date'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['fbk_comment'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['sent_count'].'</td>';
			//$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_repricer'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_bb'].'</td>';
            $msg .='</tr>';

              // $msg.="<p>feedback For <b>Order ID :".$fd['order_id']." </b> On ".$fd['fbk_date'];
              // $msg.="<p><i>".$fd['fbk_comment']."</i><p>";
            }
			 $msg .= '</tbody></table>';
			 //$msg .= '</tbody></table>';
             $msg .= '<p>Thank you!<br></p>';
             $msg .= '</body></html>';
            $alert_type="Feedback";
            $alert_subject="Neutral Feedback Notification";
            $alert_msg=$msg;
            $sent_mail=1;
            $timestamp=date('Y-m-d H:s:i');
            $this->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$user_id,$timestamp);
            $up_sql="UPDATE amz_feedback_data SET notify_sent=1 where fbk_for={$user_id} AND order_id IN (";
            foreach($ng_feed as $fd)
            {
                  $up_sql.=$this->db->escape($fd['order_id']).",";
            }
            $up_sql=rtrim($up_sql,',').")";
            $this->db->query($up_sql);
           }
       }
    }






	public function notify_return_order($user_id='')
    {
      if(empty($user_id))
      {
        echo "There is no user ID Passed";
        die();
      }

	  $qry=$this->db->query("SELECT * FROM amz_order_return_data WHERE ret_for={$user_id}  and notify_sent=0");
      $ng_feed=$qry->result_array();

	  $qr=$this->db->query("SELECT * from scr_user where scr_u_id=".$user_id." AND ret_order=1");
      $res=$qr->result_array();
      if(empty($res))
      {
		  $msg='';
           if(count($ng_feed) >0)
           {
			$msg .= '
            <!DOCTYPE html>
            <html lang="en">';
            $msg="Hi, ".$res[0]['scr_firstname']."<br>";
            $msg.=" You Have recieved return orders,Please have a look at it<br>";
			$msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Order ID</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Return Date</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Return Reason</th>
    </tr>
    </thead>
    <tbody>';





			foreach($ng_feed as $fd)
            {
				  $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['order_id'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['return_date'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['return_reason'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['sent_count'].'</td>';
			//$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_repricer'].'</td>';
            //$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['ttl_bb'].'</td>';
            $msg .='</tr>';

              // $msg.="<p>feedback For <b>Order ID :".$fd['order_id']." </b> On ".$fd['fbk_date'];
              // $msg.="<p><i>".$fd['fbk_comment']."</i><p>";
            }
			 $msg .= '</tbody></table>';
			 //$msg .= '</tbody></table>';
             $msg .= '<p>Thank you!<br></p>';
             $msg .= '</body></html>';
            $alert_type="Returns";
            $alert_subject="Return Order Notification";
            $alert_msg=$msg;
            $sent_mail=0;
            $timestamp=date('Y-m-d H:s:i');
            // $this->load->model('alert_model');
            $this->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$user_id,$timestamp);
            $up_sql="UPDATE amz_order_return_data SET notify_sent=1 where ret_for={$user_id} AND order_id IN (";
            foreach($ng_feed as $fd)
            {
                  $up_sql.=$this->db->escape($fd['order_id']).",";
            }
            $up_sql=rtrim($up_sql,',').")";
            $this->db->query($up_sql);
          }
      }
      else
      {
		  $msg='';
          if(count($ng_feed) >0)
           {
            $msg .= '
            <!DOCTYPE html>
            <html lang="en">';
            $msg="Hi, ".$res[0]['scr_firstname']."<br>";
            $msg.=" You Have recieved return orders,Please have a look at it<br>";
			$msg .= '<table style="font-family: "ET-modules", sans-serif;border-collapse: collapse; width: 100%;">';
    $msg .= '<thead>
    <tr>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Order ID</th>
    <th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Return Date</th>
	<th style="padding-top: 12px;padding-bottom: 12px;text-align: left;background: #33c4d4;color: white;border: 1px solid black;
    padding: 8px;">Return Reason</th>
    </tr>
    </thead>
    <tbody>';





			foreach($ng_feed as $fd)
            {
				  $msg .='<tr>';
            $msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['order_id'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['return_date'].'</td>';
			$msg .='<td style="border: 1px solid #ddd;padding: 8px;color:black;font-weight:600;">'.$dt['return_reason'].'</td>';
            $msg .='</tr>';

             }
			 $msg .= '</tbody></table>';
			 //$msg .= '</tbody></table>';
             $msg .= '<p>Thank you!<br></p>';
             $msg .= '</body></html>';
            $alert_type="Returns";
            $alert_subject="Return Order Notification";
            $alert_msg=$msg;
            $sent_mail=1;
            $timestamp=date('Y-m-d H:s:i');
            $this->set_alert($alert_type,$alert_subject,$alert_msg,$sent_mail,$user_id,$timestamp);
            $up_sql="UPDATE amz_order_return_data SET notify_sent=1 where ret_for={$user_id} AND order_id IN (";
            foreach($ng_feed as $fd)
            {
                  $up_sql.=$this->db->escape($fd['order_id']).",";
            }
            $up_sql=rtrim($up_sql,',').")";
            $this->db->query($up_sql);
           }
       }
    }





    private function send_mail($subject,$msg,$user_id,$alert_name='LOW_INVENTORY',$do_not_cc_admin=1)
	{
		$qry=$this->db->query("SELECT alert_name,alert_template,alert_subject FROM alert_mail_config WHERE  alert_name='{$alert_name}'");
       $email=$qry->result_array();
      $this->rs['msg']=$msg;
      $email_content=$this->parser->parse_string($email[0]['alert_template'],$this->rs,TRUE);


		$qry=$this->db->query("SELECT scr_uname FROM `amazon_profile` AS a INNER JOIN `store_access` AS b ON a.store_id=b.store_id
INNER JOIN scr_user AS c ON c.scr_u_id=b.user_id AND a.store_id=".$user_id);
		$res=$qry->result_array();
		if(empty($res))
		{
			return 2;
		}
		print_r($res);
		//die();
	 $this->load->library('email');
     $config['protocol'] = 'smtp';
     $config['smtp_host'] = "tls://email-smtp.us-east-1.amazonaws.com";
     $config['smtp_port'] = '465';
     $config['smtp_user'] = 'AKIAX2BCXESCD6UL6W4C';
     $config['smtp_pass'] = 'BNJVELo+k/v/Nn8r3QWUiMFqOZfFu/ZpSU4ABlVxo2OF';
     $config['wordwrap']=TRUE;
     $config['charset'] = "utf-8";
     $config['mailtype'] = "html";
     $config['newline'] = "\r\n";
	 $config['crlf'] = "\r\n";
     $this->email->initialize($config);
     $this->email->from('campaign@feedbackoutlook.com');
     $this->email->to($res[0]['scr_uname']);
     $this->email->subject($subject);
     $this->email->message($email_content);
	    if ($this->email->send())
	    {
	       return 1;
	    }
	    else
	    {
	      return 2;
	    }


	}

  public function SaveReadCount($cid) {
    $up_sql = "UPDATE campaign_manager SET read_count = read_count + 1 where cpgn_id = '".$cid."'";
    $this->db->query($up_sql);
  }

}
