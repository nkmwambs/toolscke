<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function new_claim_nofication($claim_id = '')
	{
		$claim	=	$this->db->get_where('claims' , array('rec' => $claim_id))->row();
		
		$email = $this->db->get_where('users',array('cname'=>$claim->cluster,'userlevel'=>'2'))->row()->email;
		
		$email_msg		=	$claim->proNo." has submitted new claim with details as below:<br />";
		
		$email_msg		.= "======================================================================<br/>";
		
		$email_msg		.=	"Beneficiary ID and Name : ".$claim->childNo." - ".$claim->childName."<br />";
		$email_msg		.=	"Diagnosis : ".$claim->diagnosis."<br />";
		$email_msg		.=	"Amount to Reimburse : ".number_format($claim->amtReim,2)."<br />";
		$email_msg		.=	"Facility Type : ".ucfirst($claim->facClass)."<br />";
		$email_msg		.=	"Note: PFs are not able to view this claim</br>";
		
		$email_msg		.= "======================================================================<br/>";
		
		$email_sub		=	"New Medical Claim";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}
	
	function reinstated_claim_nofication($claim_id = '',$rmk="")
	{
		$claim	=	$this->db->get_where('claims' , array('rec' => $claim_id))->row();
		
		$email = $this->db->get_where('users',array('cname'=>$claim->cluster,'userlevel'=>'2'))->row()->email;
		
		if($rmk==='3'){
			$email = $this->db->select('email')->get_where('users',array('userlevel'=>'5'))->result_array();
		}
		
		$email_msg		=	$claim->proNo." has reinstated a claim with details as below:<br />";
		
		$email_msg		.= "======================================================================<br/>";
		
		$email_msg		.=	"Beneficiary ID and Name : ".$claim->childNo." - ".$claim->childName."<br />";
		$email_msg		.=	"Diagnosis : ".$claim->diagnosis."<br />";
		$email_msg		.=	"Amount to Reimburse : ".number_format($claim->amtReim,2)."<br />";
		$email_msg		.=	"Facility Type : ".ucfirst($claim->facClass)."<br />";
		$email_msg		.=	"Note: PFs are not able to view this claim</br>";		
		
		$email_msg		.= "======================================================================<br/>";
		
		$email_sub		=	"Reinstated Medical Claim";
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
	}	
	
	
	function claim_comment_nofication($claim_id = '',$declined_by_id="", $comment = "")
	{
		$claim	=	$this->db->get_where('claims' , array('rec' => $claim_id))->row();
		
		$email = $this->db->get_where('users',array('fname'=>$claim->proNo,'userlevel'=>'1','department'=>'0'))->row()->email;
		
		$declined_by = $this->db->get_where("users",array("ID"=>$declined_by_id))->row();
		
		$declining_position = $this->db->get_where("positions",array("pstID"=>$declined_by->userlevel))->row()->dsgn;
		
		$rmk ="";
		
		switch($claim->rmks):
						
				case "-1":
					$rmk = get_phrase("new");
					break;
				case "0":
					$rmk =  get_phrase("submitted");
					break;
				case "1":
					$rmk =   get_phrase("declined_by_PF");
					break;
				case "2":
					$rmk =   get_phrase("checked_by_PF");
					break;
				case "3":
					$rmk =   get_phrase("declined_by_HS");
					break;
				case "4":
					$rmk =   get_phrase("approved_by_HS");
					break;				
				default:
					$rmk =  get_phrase("paid");		
						
		endswitch;
		
		$email_msg		=	$declined_by->userfirstname." (".$declining_position.") ".$declined_by->userlastname." has commented on the claim below:<br />";
		
		$email_msg		.= "======================================================================<br/>";
		
		$email_msg		.=	"Beneficiary ID and Name : ".$claim->childNo." - ".$claim->childName."<br />";
		$email_msg		.=	"Diagnosis : ".$claim->diagnosis."<br />";
		$email_msg		.=	"Amount to Reimburse : ".number_format($claim->amtReim,2)."<br />";
		$email_msg		.=	"Facility Type : ".ucfirst($claim->facClass)."<br />";
		
		$email_msg		.=	"Claim Status : ".$rmk."<br />";
		$email_msg		.=	"Comment : ".$comment."<br />";
		$email_msg		.=	"Note: PFs are not able to view this claim</br>";	
			
		$email_msg		.= "======================================================================<br/>";
		
		$email_sub		=	"New Claim Comment on (".$rmk.") claim";
		
		$email_to		=	$email;
		
		$this->do_email($email_msg , $email_sub , $email_to);
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
		
		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"https://www.compassionkenya.com/\">&copy; 2017 Compassion Internation Inc</a></center>";
		$this->email->message($msg);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}

