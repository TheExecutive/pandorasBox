<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	
	public function __construct() {
		//any constructor must contain this
		parent::__construct();
		//check if logged in or not
		//$this->checkLoggedIn();
		
		//session
		$this->load->library('session');
		
		//type
		$this->load->library('typography');
		
		//form helper, and url helper
		$this->load->helper(array('form', 'url', 'html'));
		
		//models
		$this->load->model('Pages');
		$this->load->model('Users');
		$this->load->model('Comments');
		$this->load->model('Tracker');
    }
	   
	function index() {
		//index will always be the default function in a controller class.
		//loading Pages model
		$data['pageTitle'] = 'pandorasBox - Main Page';
		$data['panelContainer'] = 'incs/panelcontainer';
		$data['currentUser'] = $this->session->userdata('currentUser');
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['returnedActs'] = $this->Pages->getLatestActivity();
		
		$searchResultsFlash = $this->session->flashdata('searchResults');
		if(isset($searchResultsFlash) && $searchResultsFlash != false ){
			$data['searchResults'] = $searchResultsFlash;
		};
		
		//save the pageId in the session to a variable
		$pageIdFlash = $this->session->flashdata('selectedPageId');
		
		if(isset($pageIdFlash) && $pageIdFlash != false ){
			//if there is a number in the session
			$data['pageData'] = $this->Pages->getPageById($pageIdFlash);
			$data['pageComments'] = $this->Pages->getPageCommentsByPageId($pageIdFlash);
			$this->load->view('main', $data);
		}else{
			//the General page will be loaded by default, it's ID is 1.
			$data['pageData'] = $this->Pages->getPageById(1);
			$data['pageComments'] = $this->Pages->getPageCommentsByPageId(1);
			$this->load->view('main', $data);
		}
		
		//$this->session->unset_userdata('searchResults');
	}
	
	function checkLoggedIn(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true){
			//not sure this will work or not
			redirect('site/index');
		};
		
	}
	
	function postComment(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="serverSideValidation">', '</div>');
		//validation
		//field name, error message, validation rules
		$this->form_validation->set_rules('comment_post', 'comment', 'required');
		$this->form_validation->set_message('required', "Your %s can't be blank.");
		
		if($this->form_validation->run() == false){
			//CI will show the errors and redirect back to the index
			$this->index();
		}else{
			$currentUser = $this->session->userdata('currentUser');
			//creating comment object
			$newCommentObject = array(
				"pageId" => $this->input->post('pageId'),
				"userId" => $currentUser->userId,
				"commentContent" => $this->typography->auto_typography($this->input->post('comment_post'), true)
				//running the comment post through typography plugin in order to get formatted line breaks
				//the true is to reduce line breaks
			);
			//passing it to function
			//var_dump($newCommentObject);
			
			$this->Comments->postNewComment($newCommentObject);
			
			//flash the page I'm on and send it to the index
			$this->session->set_flashdata('selectedPageId', $newCommentObject['pageId']);
			
			redirect('site/index');
		}
		
		
	}
	
	function search(){
		//validation for search
		///valiation
		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="serverSideValidation">', '</div>');
		//validation
		//field name, error message, validation rules
		$this->form_validation->set_rules('search_term', 'search', 'required');
		$this->form_validation->set_message('required', "You can't %s for nothing! It's like dividing by zero.");
		//first, get the search tearm out of the form.
		$termToSearch = $this->input->post('search_term');
		
		//searching
		$searchResults = $this->Pages->searchPages($termToSearch);
		
		//flashdata is session data that will only be stored for the next
		//server request, then it is autodeleted.
		$this->session->set_flashdata('searchResults', $searchResults);
		redirect('site/index');
		echo 'this is running';
	}
	
	function page(){
		//this function will change the main page based on the ID in the url being passed
		//grab the page id from the url by using the uri (not a typo) helper. 
		//the page clicked is stored in the third segment of the uri.
		$pageId = $this->uri->segment(3);
		
		//flash the clicked page in session
		$this->session->set_flashdata('selectedPageId', $pageId);
		//and finally, redirect
		redirect('site/index');
	}
	
	function newPage(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		//this function will run to pull up the view for creating a new form.
		$data['pageTitle'] = 'pandorasBox - Create New Page';
		$data['panelContainer'] = 'incs/panelcontainer';
		$data['currentUser'] = $this->session->userdata('currentUser');
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$this->load->view('newpage', $data);
	}
	
	function cancelNewPage(){
		redirect('site/index');
	}
	
	function cancelEditPage(){
		redirect('site/index');
	}
	
	function newPageSubmit(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		$currentUser = $this->session->userdata('currentUser');
		//creating a new page object
		$newPageObj = array(
			'pageName' => $this->input->post('newpage_pagetitle'),
			'pageContent' => $this->typography->auto_typography($this->input->post('newpage_pagecontent'), true),
			'userId' => $currentUser->userId
		);
		
		//passing it to the function in pages
		$this->Pages->newPage($newPageObj);
		//get the page back out so it can be loaded
		$pageJustMade = $this->Pages->getPageByName($newPageObj['pageName']); //COME BACK AND VALIDATE THIS SO IT'S UNIQUE LATER
		
		//flash it and send it to the index
		$this->session->set_flashdata('selectedPageId', $pageJustMade->pageId);
		//send it back to the top
		redirect('site/index');
	}

	function editPage(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		//this function will run to pull up the view for creating a new form.
		$data['pageTitle'] = 'pandorasBox - Create New Page';
		$data['panelContainer'] = 'incs/panelcontainer';
		$data['currentUser'] = $this->session->userdata('currentUser');
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		$data['pageData'] = $this->Pages->getPageById($this->uri->segment(3));
		$data['pageComments'] = $this->Pages->getPageCommentsByPageId($this->uri->segment(3));
		
		$this->load->view('editpage', $data);
		
		//this function will change the main page based on the ID in the url being passed
		//grab the page id from the url by using the uri (not a typo) helper. 
		//the page clicked is stored in the third segment of the uri.
	}
	
	function editPageSubmit(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		$currentUser = $this->session->userdata('currentUser');
		//creating a update page object
		$pageId = $this->uri->segment(3);
		$updatePageObj = array(
			'pageId' => $pageId,
			'pageName' => $this->input->post('editpage_pagetitle'),
			'pageContent' => $this->typography->auto_typography($this->input->post('editpage_pagecontent'), true),
			'userId' => $currentUser->userId
		);
		
		//passing it to the function in pages
		$this->Pages->updatePage($updatePageObj);
		
		//flash it and send it the pageId to the index to be loaded
		$this->session->set_flashdata('selectedPageId', $pageId);
		//send it back to the top
		redirect('site/index');
	}
	
	function account(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		$data['pageTitle'] = 'pandorasBox - Create New Page';
		$data['panelContainer'] = 'incs/panelcontainer';
		$data['currentUser'] = $this->session->userdata('currentUser');
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		
		$user = $this->session->userdata('currentUser');
		$userId = $user->userId;
		
		$pageIdIWasOn = $this->uri->segment(3);
		$data['pageData'] = $this->Pages->getPageById($pageIdIWasOn);
		
		$data['currentUserAchievements'] = $this->Users->getUserAchievements($userId);
		$data['currentUserRankInfo'] = $this->Users->getUserAndRank($userId);
		$this->load->view('account', $data);
	}
	
	function editAccount(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		$data['pageTitle'] = 'pandorasBox - Create New Page';
		$data['panelContainer'] = 'incs/panelcontainer';
		$data['currentUser'] = $this->session->userdata('currentUser');
		$data['is_logged_in'] = $this->session->userdata('is_logged_in');
		
		$user = $this->session->userdata('currentUser');
		$userId = $user->userId;
		
		$pageIdIWasOn = $this->uri->segment(3);
		$data['pageData'] = $this->Pages->getPageById($pageIdIWasOn);
		
		$data['currentUserAchievements'] = $this->Users->getUserAchievements($userId);
		$data['currentUserRankInfo'] = $this->Users->getUserAndRank($userId);
		$this->load->view('editaccount', $data);
		
	}

	function editDescriptionSubmit(){
		//this page is protected, so check if logged in or not
		$this->checkLoggedIn();
		
		$currentUser = $this->session->userdata('currentUser');
		//creating a update page object
		$pageId = $this->uri->segment(3);
		$updateUserObj = array(
			'userId' => $currentUser->userId,
			'description' => $this->input->post('editaccount_description')
		);
		
		//passing it to the function in users
		$this->Users->updateUser($updateUserObj);
		
		//flash it and send it the pageId to the index to be loaded
		$this->session->set_flashdata('selectedPageId', $pageId);
		//send it back to the top
		redirect('site/index');
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('main/index');
	}
}
?>