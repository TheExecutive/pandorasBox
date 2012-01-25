<?php

class Pages extends CI_Model {
	
	function __construct() {
		//calling the model constructor
		parent::__construct();
	}
	
	function getLatestActivity($numberToDisplay = 10) {
		//will display last 10 by default
		
		//get the last ten activities and display them
		$this->db->join('pages', 'pages.pageId = activity.pageId');
		$this->db->join('users', 'users.userId = activity.userId');
		$this->db->order_by("timeOfAction", "desc"); 
		$query = $this->db->get('activity', $numberToDisplay);
		return $query->result();
	}
	
	function updateActivityLog($pageId, $userId, $actionTaken){
		//3 actions, Created, Edited, Comment Posted
		$this->load->helper('date');
		$datestring = "%Y-%m-%d %H:%i:%s";
		$formattedDate = mdate($datestring, time());
		
		//for some reason 'this' goes haywire here so I have to do it the old fashioned way
		$this->db->query(
			"insert into activity (pageId, userId, actionTaken, timeOfAction)". 
			"values(".
			$this->db->escape($pageId).", ".$this->db->escape($userId).", ".$this->db->escape($actionTaken).", ".$this->db->escape($formattedDate).")"
		);
		/*$this->pageId = $pageId;
		$this->userId = $userId;
		$this->actionTaken = $actionTaken;
		$this->timeOfAction = mdate($datestring, time());
		$this->db->insert('activity', $this);*/
	}
	
	function getAllPages() {
		//tested and working
		$query = $this->db->get('pages');
		return $query->result();
	}
	
	function getPageById($pageId) {
		//tested and working
		$query = $this->db->get_where('pages', array('pageId' => $pageId));
		return $query->row();
	}
	
	function getPageByName($pageName) {
		//tested and working
		$query = $this->db->get_where('pages', array('pageName' => $pageName));
		return $query->row();
	}
	
	function getPageCommentsByPageId($pageId, $isAscending = false){
		//tested and working
		//pass true after the Id to get the comments earliest first instead of latest first
		$this->db->join('users', 'users.userId = comments.userId');
		$this->db->join('pages', 'pages.pageId = comments.pageId');
		$this->db->order_by('commentDate', ($isAscending == true ? 'asc' : 'desc'));
		$query = $this->db->get_where('comments', array('pages.pageId' => $pageId));
		return $query->result();
	}
	
	function getPageCommentsByPageName($pageName, $isAscending = false) {
		//tested and working
		//pass true after the name to get the comments earliest first instead of latest first
		$this->db->join('pages', 'pages.pageId = comments.pageId');
		$this->db->order_by('commentDate', ($isAscending == true ? 'asc' : 'desc'));
		$query = $this->db->get_where('comments', array('pages.pageName' => $pageName));
		return $query->result();
	}
	
	function newPage($pageObject) {
		//tested and working
		//requires pageName, pageContent, and userId
		//loading the date helper
		$this->load->helper('date');
		$datestring = "%Y-%m-%d %H:%i:%s";
		
		$this->pageName = $pageObject['pageName'];
        $this->pageContent = $pageObject['pageContent'];
        $this->dateCreated = mdate($datestring, time());
		$this->dateLastEdited = mdate($datestring, time());
		$this->userIdOfCreator = $pageObject['userId'];
		$this->userIdOfLastEditor = $pageObject['userId'];
		
        $this->db->insert('pages', $this);
		
		//adding experience
		$this->Tracker->addExperience($pageObject['userId']);
		//adding to page creation count
		$this->Tracker->addPageCreationCount($pageObject['userId']);
		
		//adding to activity log
		//getting PageId
		$pageResult = $this->getPageByName($pageObject['pageName']);
		
		$this->updateActivityLog($pageResult->pageId, $pageObject['userId'], 'Created');
	}
	
	function updatePage($updatePageObject) {
		//tested and working
		//loading the date helper
		$this->load->helper('date');
		$datestring = "%Y-%m-%d %H:%i:%s";
		//this is a master updatePage function I wrote.
		//it requires pageId and userId to be in the object. Aside from that,
		//name and content is optional.
		// The function will check if the object param exists before it attempts 
		// to pass it to the database.
		
		if(isset($updatePageObject['pageName'])){
			$this->pageName = $updatePageObject['pageName'];
		}
		
		if(isset($updatePageObject['pageContent'])){
			$this->pageContent = $updatePageObject['pageContent'];
		}
		
		//these last two should exist every single time
		//so no need to add conditionals
		$this->dateLastEdited = mdate($datestring, time());
		$this->userIdOfLastEditor = $updatePageObject['userId'];

        $this->db->update('pages', $this, array('pageId' => $updatePageObject['pageId']));
		//$this->db->update('entries', $this, array('id' => $_POST['id']));
		
		//adding experience
		$this->Tracker->addExperience($updatePageObject['userId']);
		//adding to page edit count
		$this->Tracker->addPageEditCount($updatePageObject['userId']);
		//adding to activity log
		$this->updateActivityLog($updatePageObject['pageId'], $updatePageObject['userId'], 'Edited');
	}
	
	function searchPages($searchedTerm) {
		//tested and working
		$this->db->like('pageName', $searchedTerm);
		$this->db->or_like('pageContent', $searchedTerm);
		$query = $this->db->get('pages');
		return $query->result();
		
	}
	
}

?>