<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct() {
		//any constructor must contain this
		parent::__construct();
		// Your own constructor code
		$this->load->helper(array('form', 'url'));
		$this->load->model('Pages');
		$this->load->model('Users');
		$this->load->model('Comments');
		$this->load->model('Tracker');
    }
	   
	function index() {
		//index will always be the default function in a controller class.
		//loading Pages model
		
		$data['returnedActs'] = $this->Pages->getLatestActivity(3);
		$this->load->view('pages/landing', $data);
	}
	
	function login(){
		echo "suck";
	}
	
	function signup(){
		
		$uploadData = $this->Users->uploadAvatar('signup_avatar');
		//grabbing the username really quick just to make a name for the file
		$usernameForFile = $this->input->post('signup_username');
		//loading image manipulation
		$this->Users->resizeAvatar($uploadData, $usernameForFile, 100, 100);
		/*------------------------------------------------*/
		
		//first, place all the information from the form into a newUserObject.
		$newUserObject = array(
			'username' => $this->input->post('signup_username'),
			'password' => $this->input->post('signup_password'),
			'email' => $this->input->post('signup_email'),
			'avatar' => './img/avatars/' . $usernameForFile . '_avtr' . $uploadData['upload_data']['file_ext'],
			'avatarSmall' => './img/avatars/' . $usernameForFile . '_avtrsmall' . $uploadData['upload_data']['file_ext']
		);
		
	}
}


?>