<?php

class Tracker extends CI_Model {
	
	function __construct() {
		//calling the model constructor
		parent::__construct();
	}
	
	function addExperience($userId, $expToAdd = 10) {
		//update users set experience = experience + 1 where userId = 1
		$this->db->set('experience', 'experience + ' . $expToAdd, false); 
		//false tells it not to escape the query, meaning it will write
		//VALUES (field+1) instead of VALUES ('field+1'), we don't want it escaped
		//in this case, since we're doing math
		$this->db->update('users', $this, array('userId' => $userId));
		
		$this->checkForRewards($userId);
	}
	
	function promoteRank($userId, $rankToAdd = 1) {
		$this->db->set('rankId', 'rankId + ' . $rankToAdd, false); 
		//false tells it not to escape the query
		$this->db->update('users', $this, array('userId' => $userId)); 
		
		$this->checkForRewards($userId);
	}
	
	function addPostCount($userId, $postNumToAdd = 1) {
		$this->db->set('postCount', 'postCount + ' . $postNumToAdd, false); 
		//false tells it not to escape the query
		$this->db->update('users', $this, array('userId' => $userId)); 
		$this->checkForRewards($userId);
	}
	
	function addPostCountAndExperience($userId, $postNumToAdd = 1, $expToAdd = 10){
		$this->db->set('postCount', 'postCount + ' . $postNumToAdd, false);
		$this->db->set('experience', 'experience + ' . $expToAdd, false); 
		//false tells it not to escape the query, meaning it will write
		//VALUES (field+1) instead of VALUES ('field+1'), we don't want it escaped
		//in this case, since we're doing math
		$this->db->update('users', $this, array('userId' => $userId)); 
		$this->checkForRewards($userId);
	}
	
	function addPageCreationCount($userId, $pcNumToAdd = 1) {
		$this->db->set('pageCreationCount', 'pageCreationCount + ' . $pcNumToAdd, false); 
		//false tells it not to escape the query
		$this->db->update('users', $this, array('userId' => $userId));
		
		$this->checkForRewards($userId);
	}
	
	function addPageEditCount($userId, $peNumToAdd = 1) {
		$this->db->set('pageEditCount', 'pageEditCount + ' . $peNumToAdd, false); 
		//false tells it not to escape the query
		$this->db->update('users', $this, array('userId' => $userId));
		
		$this->checkForRewards($userId);
	}
	
	function awardAchievement($userId, $achievementName){
		$this->userId = $userId;
		$this->achievementName = $achievementName;
		
        $this->db->insert('userAchievements', $this);
	}
	
	function checkForRewards($userId){
		//Users model
		$usersQuery = $this->Users->getUserById($userId);
		//print_r($usersQuery[0]->username); this works, reference this
		
		//checking for increase in rank
		switch ($usersQuery->experience){
			case 100:
				$this->promoteRank($userId);
				break;
			case 200:
				$this->promoteRank($userId);
				break;
			case 300:
				$this->promoteRank($userId);
				break;
			case 400:
				$this->promoteRank($userId);
				break;
			case 500:
				$this->promoteRank($userId);
				break;
		};
		
		//checkingforAchievements
		$achieveQuery = $this->Users->getUserAchievements($userId);
		//echo $achieveQuery[1]->achievementDescription;
		
		//starting with an array of falses
		$achieveBooleanArray = array(
			'has_OpeningPandorasBox' => false,
			'has_First' => false,
			'has_Scribe' => false,
			'has_VisualAid' => false,
			'has_TheSocialNetwork' => false,
			'has_Contributor' => false,
			'has_Customado' => false,
			'has_MonaLisa' => false
		);
		foreach ($achieveQuery as $row) {
			//for each achievement earned
			switch ($row->achievementName){
				case 'Opening PandorasBox':
					$achieveBooleanArray['has_OpeningPandorasBox'] = true;
					break;
				case 'First!':
					$achieveBooleanArray['has_First'] = true;
					break;
				case 'Scribe':
					$achieveBooleanArray['has_Scribe'] = true;
					break;
				case 'Visual Aid':
					$achieveBooleanArray['has_VisualAid'] = true;
					break;
				case 'The Social Network':
					$achieveBooleanArray['has_TheSocialNetwork'] = true;
					break;
				case 'Contributor':
					$achieveBooleanArray['has_Contributor'] = true;
					break;
				case 'Customado':
					$achieveBooleanArray['has_Customado'] = true;
					break;
				case 'Mona Lisa':
					$achieveBooleanArray['has_MonaLisa'] = true;
					break;
			};
		};
		
		//the array now contains trues or falses based on this users achievements.
		//we now can use it to make sure we don't give duplicate achievements.
		//print_r($achieveBooleanArray);
		
		//Opening PandorasBox will be awarded on new user signup, no need to check for it.
		
		//checking for First!
		if($usersQuery->postCount >= 1 && $achieveBooleanArray['has_First'] == false) {
			//if the postcount is greater than or equal to one 
			//and they don't have the achievement already
			$this->awardAchievement($userId, 'First!');
		}
		
		//checking for Scribe
		if($usersQuery->pageEditCount >= 1 && $achieveBooleanArray['has_Scribe'] == false) {
			//if the pageEditCount is greater than or equal to one 
			//and they don't have the achievement already
			$this->awardAchievement($userId, 'Scribe');
		}
		
		//Visual Aid will be awarded on avatar upload, no need to check for it here.
		
		//checking for The Social Network
		if($usersQuery->postCount >= 5 && $achieveBooleanArray['has_TheSocialNetwork'] == false) {
			//if the pageEditCount is greater than or equal to 5
			//and they don't have the achievement already
			$this->awardAchievement($userId, 'The Social Network');
		}
		
		//checking for Contributor
		if($usersQuery->pageEditCount >= 5 && $achieveBooleanArray['has_Contributor'] == false) {
			//if the pageEditCount is greater than or equal to 5
			//and they don't have the achievement already
			$this->awardAchievement($userId, 'Contributor');
		}
		
		//Customado will be awarded on the first edit, no need to check for it.
		
		//checking for Mona Lisa
		if($usersQuery->pageCreationCount >= 5 && $achieveBooleanArray['has_MonaLisa'] == false) {
			//if the pageEditCount is greater than or equal to 5
			//and they don't have the achievement already
			$this->awardAchievement($userId, 'Mona Lisa');
		}
	}
	
}

?>