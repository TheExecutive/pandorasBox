<?php

class Comments extends CI_Model {
	
	function __construct() {
		//calling the model constructor
		parent::__construct();
	}
	
	function getAllComments() {
		//tested and working
		$query = $this->db->get('comments');
		return $query->result();
	}
	
	function getCommentById($commentId) {
		//tested and working
		$query = $this->db->get_where('comment', array('commentId' => $commentId));
		return $query->result();
	}
	
	function getCommentsInOrder($numberOfComments = 10, $isAscending = false) {
		//tested and working
		//this will pull back the 10 most recent comments by default.
		//pass a number to get a certain number of comments.
		//pass true to order the comments ascending instead of descending.
		$this->db->order_by('commentDate', ($isAscending == true ? 'asc' : 'desc'));
		$this->db->limit($numberOfComments);
		$query = $this->db->get('comments');
		return $query->result();
	}
	
	function postNewComment($newCommentObject) {
		//this function takes an object with a pageId, userId
		//and commentContent.
		//loading the date helper
		$this->load->helper('date');
		$datestring = "%Y-%m-%d %H:%i:%s";
		
        $this->pageId = $newCommentObject['pageId'];
		$this->userId = $newCommentObject['userId'];
		$this->commentContent = $newCommentObject['commentContent'];
		$this->commentDate = mdate($datestring, time());
		
        $this->db->insert('comments', $this);
		
		$userId = $newCommentObject['userId'];
		
		//adding to activity log
		$this->Pages->updateActivityLog($newCommentObject['pageId'], $newCommentObject['userId'], 'Comment posted');
		//adding to both postcount and experience
		$this->Tracker->addPostCountAndExperience($userId);
		
		/*I think I found a bug in CodeIgniter.
		 * These two functions I have commented out run just fine independently of each other
		 * but do not run when placed side by side. I had to combine the 
		 * two functions together in the bigger function directly above this comment in order to get
		 * the result I wanted. I assume it has something to do with the math
		 * I'm running on the database.
		 * How about some bonus points for finding a bug, Orcun? =)
		*/
		//adding to postcount
		//$this->Tracker->addPostCount($userId);
		//adding experience
		//$this->Tracker->addExperience($userId);
		
	}
	
	function updateComment($updateCommentObject) {
		//this function takes an object with a commentId, and commentContent.
		//loading the date helper
		$this->load->helper('date');
		$datestring = "%Y-%m-%d %H:%i:%s";
		
		$this->commentContent = $updateCommentObject['commentContent'];
		$this->commentEditDate = mdate($datestring, time());
		
        $this->db->update('comments', $this, array('commentId' => $updateCommentObject['commentId']));
		
		//adding experience
		$this->Tracker->addExperience($updateCommentObject['userId']);
	}
}

?>