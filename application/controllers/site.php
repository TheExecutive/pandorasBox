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
		
		$test = $this->session->flashdata('searchResults');
		if(isset($test)){
			$data['searchResults'] = $test;
		};
		
		//the General page will be loaded by default, it's ID is 1.
		$data['pageData'] = $this->Pages->getPageById(1);
		$data['pageComments'] = $this->Pages->getPageCommentsByPageId(1);
		$this->load->view('main', $data);
		
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
		//var_dump($this->session->userdata('currentUser'));
		$currentUser = $this->session->userdata('currentUser');
		//var_dump($currentUser->userId);
		//var_dump($this->input->post('pageId'));
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
		redirect('site/index');
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
		
	}
	
}
?>