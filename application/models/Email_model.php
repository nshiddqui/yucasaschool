<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

	function account_opening_email($account_type = '' , $email = '', $password = '')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
        $email_msg='<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Welcome to '.$system_name.'</title>
</head>
<body style="font-family: Roboto, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;margin:0 auto;">
  <div style="width: 100%;margin: 0 auto;text-align: center;background-color: #2e3e65;margin-bottom: 10px;padding-top: 10px;font-family: Roboto, sans-serif;"> <a href="'.base_url('/').'" title="UnityERP"> <img src="'.base_url('/uploads/logo.png').'" alt="Educationinsta" style="border: none;font-family: Roboto, sans-serif;height: auto;margin: 0 auto;margin-bottom: 20px;width:120px;"> </a> </div>
  <h2 style="margin-top: 0px; margin-bottom: 20px;font-family: Roboto, sans-serif;text-align: center;">Welcome to  '.$system_name.'</h2>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD;font-family: Roboto, sans-serif;">
    <thead>
      <tr>
        <td style="font-size: 12px;border-left: 1px solid #2e3e65; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; background-color: #2e3e65; font-weight: bold; text-align: left; padding: 7px; color: #fff;font-family: Roboto, sans-serif;" colspan="4">Login Detail</td>
      </tr>
    </thead>
    <tbody>
    <tr>

      <tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Your account type</td>
        <td  style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">: '.$account_type.'</td>
      </tr>
    </tr>
      
    <tr>
	<tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Your login Username</td>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  text-align: left; padding: 7px; font-family: Roboto, sans-serif;">: '.$email.'</td>
      </tr>
	  
	  <tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Your login password</td>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  text-align: left; padding: 7px; font-family: Roboto, sans-serif;">:  '. $password .'</td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Login Here</td>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  text-align: left; padding: 7px; font-family: Roboto, sans-serif;">: '.base_url('/').'</td>
      </tr>
	</tr>
	<tr>
		<td colspan="2" style="text-align:center;border: 1px solid #2e3e65;padding:20px;">
			<img src="'.base_url('/uploads/edurama-logo.png').'" style="width:120px;margin-left:-50px;">
		</td>
	</tr>
    </tbody>
  </table>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;font-family: Roboto, sans-serif;">
    <thead>
      <tr>
        <td style="font-size: 12px;border-left: 1px solid #2e3e65; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; background-color: #2e3e65; font-weight: bold; text-align: left; padding: 7px; color: #fff;font-family: Roboto, sans-serif;text-align:center;" colspan="4"><a href="'.base_url('/').'" style="color:#fff;text-decoration:none;">&copy; 2018 |  '.$system_name.'</a></td>
      </tr>
    </thead>
  </table>
</div>
</body>
</html>';






		//$email_msg		=	"Welcome to ".$system_name."<br />";
		//$email_msg		.=	"Your account type : ".$account_type."<br />";
	//	$email_msg		.=	"Your login password : ". $password ."<br />";
	//	$email_msg		.=	"Login Here : ".base_url()."<br />";

		$email_sub		=	"Account opening email";
		$email_to		=	$email;

		$this->do_email($email_msg , $email_sub , $email_to);
	}

	function password_reset_email($new_password = '' , $account_type = '' , $email = '')
	{
	    $system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		$query			=	$this->db->get_where($account_type , array('email' => $email));
		if($query->num_rows() > 0)
		{
          $email_msg='<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>

<title>Your Password Sucessfully Reset</title>
</head>
<body style="font-family: Roboto, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;margin:0 auto;">
  <div style="width: 100%;margin: 0 auto;text-align: center;background-color: #2e3e65;margin-bottom: 10px;padding-top: 10px;font-family: Roboto, sans-serif;"> <a href="'.base_url('/').'" title="UnityERP"> <img src="'.base_url('/uploads/logo.png').'" alt="Educationinsta" style="border: none;font-family: Roboto, sans-serif;height: auto;margin: 0 auto;margin-bottom: 20px;width:120px;"> </a> </div>
  <h2 style="margin-top: 0px; margin-bottom: 20px;font-family: Roboto, sans-serif;text-align: center;">Password Sucessfully Reset</h2>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD;font-family: Roboto, sans-serif;">
    <thead>
      <tr>
        <td style="font-size: 12px;border-left: 1px solid #2e3e65; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; background-color: #2e3e65; font-weight: bold; text-align: left; padding: 7px; color: #fff;font-family: Roboto, sans-serif;" colspan="4">Reset Detail</td>
      </tr>
    </thead>
    <tbody>
    <tr>
	 
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Your account type</td>
        <td  style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">: '.$account_type.'</td>
      </tr>
    </tr>
      
    <tr>
	  <tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Your New login Password</td>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  text-align: left; padding: 7px; font-family: Roboto, sans-serif;">: '.$new_password.'</td>
      </tr>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65;border-left: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  font-weight: bold; text-align: left; padding: 7px; font-family: Roboto, sans-serif;">Login Here</td>
        <td style="font-size: 12px; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65;  text-align: left; padding: 7px; font-family: Roboto, sans-serif;">: '.base_url('/').'</td>
      </tr>
	</tr>
	<tr>
		<td colspan="2" style="text-align:center;border: 1px solid #2e3e65;padding:20px;">
			<img src="'.base_url('/uploads/logo.png').'" style="width:120px;margin-left:-50px;">
		</td>
	</tr>
    </tbody>
  </table>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;font-family: Roboto, sans-serif;">
    <thead>
      <tr>
        <td style="font-size: 12px;border-left: 1px solid #2e3e65; border-right: 1px solid #2e3e65; border-bottom: 1px solid #2e3e65; background-color: #2e3e65; font-weight: bold; text-align: left; padding: 7px; color: #fff;font-family: Roboto, sans-serif;text-align:center;" colspan="4"><a href="'.base_url('/').'" style="color:#fff;text-decoration:none;">'.$system_name.'</a></td>
      </tr>
    </thead>
  </table>
</div>
</body>
</html>';
	     	//	$email_msg	=	"Your account type is : ".$account_type."<br />";
			//$email_msg	.=	"Your password is : ".$new_password."<br />";

			$email_sub	=	"Password reset request";
			$email_to	=	$email;
			$this->do_email($email_msg , $email_sub , $email_to);
			return true;
		}
		else
		{
			return false;
		}
	}

	function contact_message_email($email_from, $email_to, $email_message) {
		$email_sub = "Message from School Website";
		$this->do_email($email_message, $email_sub, $email_to, $email_from);
	}

    function personal_message_email($email_from, $email_to, $email_message) {
        $email_sub = "Message from School Website";
        $this->do_email($email_message, $email_sub, $email_to, $email_from);
    }

	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{

		$config = array();
        $config['useragent']	= "CodeIgniter";
        $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']		= "smtp";
        $config['smtp_host']	= "localhost";
        $config['smtp_port']	= "25";
        $config['mailtype']		= 'html';
        $config['charset']		= 'utf-8';
        $config['newline']		= "\r\n";
        $config['wordwrap']		= TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		if($from == NULL)
			$from		=	$this->db->get_where('settings' , array('type' => 'system_email'))->row()->description;

		$this->email->from($from, $system_name);
		$this->email->from($from, $system_name);
		$this->email->to($to);
		$this->email->subject($sub);

	//	$msg	=	$msg."<br /><br /><br /></br><br /><hr /><center><a href=\"https://www.edurama.in\">&copy; 2018 | Edurama Unity ERP</a></center>";
		$this->email->message($msg);

		$this->email->send();

		//echo $this->email->print_debugger();
	}
}
