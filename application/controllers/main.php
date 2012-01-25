<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct() {
		//any constructor must contain this
		parent::__construct();
		
		//start session
		$this->load->library('session');
		
		
		//form helper, and url helper
		$this->load->helper(array('form', 'url', 'html'));
		
		//models
		$this->load->model('Pages');
		$this->load->model('Users');
		$this->load->model('Comments');
		$this->load->model('Tracker');
    }
	   
	function index() {
		
		$this->checkLoggedInIndex(); //has to be in the index for some reason
		
		//index will always be the default function in a controller class.
		//loading Pages model
		//$this->session->sess_destroy();
		
		//check session at the beginning
		/*$isloggedIn = $this->session->userdata('is_logged_in');
		if(!isset($isloggedIn) || $isloggedIn != true) {
			//if no user is logged in, kill any remaining session vars
			//and set is_logged_in to false
			echo 'death to sessions';
			$this->session->sess_destroy();
			$this->session->set_userdata('is_logged_in', false);
		};*/
		
		$data['pageTitle'] = 'pandorasBox - Easy-to-use, simple documentation for the Coldbox Coldfusion framework.';
		$data['panelContainer'] = 'incs/panelcontainer';
		$data['returnedActs'] = $this->Pages->getLatestActivity();
		
		$this->load->view('landing', $data);
	}
	
	function login(){
		//first, create login object
		$loginObject = array(
			'username' => $this->input->post('login_username'),
			'password' => $this->input->post('login_password')
		);
		//pass login object to checking function
		$loggedInUserData = $this->Users->checkAndGetUser($loginObject);
		//if there is no user by that Username and pass it will return false
		
		if($loggedInUserData == false){
			echo 'bad user';
		}else{
			//start session
			$this->load->library('session');
			
			//saving the user data returned into a variable called
			//currentUser, and setting it to a session variable
			$currentUser = $loggedInUserData;
			$this->session->set_userdata('currentUser', $currentUser);
			//adding the variable 'is_logged_in' to the session
			$this->session->set_userdata('is_logged_in', true);
			
			/*use this to get back all session info
			var_dump($this->session->all_userdata());*/
			
			//dumping the entire session into currentUser
			$data['currentUser'] = $this->session->userdata('currentUser');
			$data['is_logged_in'] = $this->session->userdata('is_logged_in');
			
			//load the main page
			redirect('site/index');
		}
	}
	
	function signup(){
		///valiation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="serverSideValidation">', '</div>');
		//validation
		//field name, error message, validation rules
		$this->form_validation->set_rules('signup_username', 'username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('signup_password', 'password', 'required');
		$this->form_validation->set_rules('signup_email', 'email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_message('is_unique', "Oops! It looks like someone already took that %s. Pick another.");
		
		//running signup validation
		if($this->form_validation->run() == false){
			//CI will show the errors and redirect back to the index
			$this->index();
		}else{
			//rock on
			//begin upload process
			$uploadData = $this->Users->uploadAvatar('signup_avatar');
			if($uploadData != false){
				//if an avatar has been selected
				
				//grabbing the username really quick just to make a name for the file
				$usernameForFile = $this->input->post('signup_username');
				//loading image manipulation
				$this->Users->resizeAvatar($uploadData, $usernameForFile, 100, 100);
				
				//place all the information from the form into a newUserObject
				//including avatar paths.
				$newUserObject = array(
					'username' => $this->input->post('signup_username'),
					'password' => $this->input->post('signup_password'),
					'email' => $this->input->post('signup_email'),
					'avatar' => './img/avatars/' . $usernameForFile . '_avtr' . $uploadData['upload_data']['file_ext'],
					'avatarSmall' => './img/avatars/' . $usernameForFile . '_avtrsmall' . $uploadData['upload_data']['file_ext']
				);
			}else{
				//if no avatar, place all the information from the form into a newUserObject
				//but leave the avatar fields blank.
				$newUserObject = array(
					'username' => $this->input->post('signup_username'),
					'password' => $this->input->post('signup_password'),
					'email' => $this->input->post('signup_email'),
					'avatar' => '',
					'avatarSmall' => ''
				);
				
			};
			
			//after all that's done
			//send it to the newUser function in models
			$this->Users->newUser($newUserObject);
			
			//get the new user back out again by using the getUserByUsername function
			$loggedInUserData = $this->Users->getUserByUsername($newUserObject['username']);
			
			//saving the user data returned into a variable called
			//currentUser, and setting it to a session variable
			$currentUser = $loggedInUserData;
			$this->session->set_userdata('currentUser', $currentUser);
			//adding the variable 'is_logged_in' to the session
			$this->session->set_userdata('is_logged_in', true);
			
			/*use this to get back all session info
			var_dump($this->session->all_userdata());*/
			
			//dumping the entire session into currentUser
			$data['currentUser'] = $this->session->userdata('currentUser');
			$data['is_logged_in'] = $this->session->userdata('is_logged_in');
			//load the main page
			redirect('site/index');
		};
		
	}

	function checkLoggedInIndex(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(isset($is_logged_in) && $is_logged_in == true){
			//if they're logged in, get them off of the landing page
			redirect('site/index');
		};
		
	}
}
?>