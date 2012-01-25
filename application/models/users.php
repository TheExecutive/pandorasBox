<?php
class Users extends CI_Model {
	
	function __construct() {
		//calling the model constructor
		parent::__construct();
		$this->load->library('image_lib');//loading image manip in the constructor
	}
	
	function getAllUsers() {
		//tested and working
		$query = $this->db->get('users');
		return $query->result();
	}
	
	function getUserById($userId) {
		//tested and working
		$query = $this->db->get_where('users', array('userId' => $userId));
    	return $query->result();
		//return $query->result_array();
	}
	
	function getUserByUsername($username) {
		//tested and working
		$query = $this->db->get_where('users', array('username' => $username));
		return $query->result();
	}
	
	function getUserAchievements($userId) {
		//tested and working
  		$this->db->from('userAchievements');
		$this->db->join('achievements', 'userAchievements.achievementName = achievements.achievementName');
		$this->db->where('userAchievements.userId', $userId);
    	$query = $this->db->get();
		
		return $query->result();
	}
	
	function getUserCommentsById($userId) {
		//this is tested and working
		$this->db->join('users', 'users.userId = comments.userId');
		$query = $this->db->get_where('comments', array('users.userId' => $userId));
		return $query->result();
	}
	
	function getUserCommentsByUsername($username) {
		//this is tested and working
		$this->db->join('users', 'users.userId = comments.userId');
		$query = $this->db->get_where('comments', array('users.username' => $username));
		return $query->result();
	}
	
	function uploadAvatar($uploadFormName){
		//configging the upload handler
		$config['upload_path'] = './img/avatars/';
		$config['allowed_types'] = 'gif|jpg|png';
		//loading the uploader based on the config options
		$this->load->library('upload', $config);
		
		//run the upload. by default, the function expect the name on the form
		//to be "userfile". I am changing it to signup_avatar, because that's
		//what it's called on my form.
		$this->upload->do_upload($uploadFormName);

		$uploadData = array('upload_data' => $this->upload->data());

		return $uploadData;
	}
	
	function resizeAvatar($uploadData, $usernameForFile, $width, $height){
		
		 /* Configuration for the thumbnail */
        $config['image_library'] = 'gd2';
        $config['source_image'] = './img/avatars/' . $uploadData['upload_data']['orig_name'];
		$config['new_image'] = './img/avatars/' . $usernameForFile . '_avtrsmall' . $uploadData['upload_data']['file_ext'];
        $config['maintain_ratio'] = FALSE;
        $config['width']     = 75;
        $config['height']    = 75;
        $config['create_thumb'] = FALSE;
    
        /* Initialize the configuration */
        $this->image_lib->initialize($config);
        
        /* Handle the resizing, if something went wrong, print the error and return false */
        if ( ! $this->image_lib->resize()){
            echo $this->image_lib->display_errors();
            return false;
        }
        
        /* Well, it does... something */
        $this->image_lib->clear();
        
        /* Settings for the big file */
        $config_big['image_library'] = 'gd2';
        $config_big['source_image'] = './img/avatars/' . $uploadData['upload_data']['orig_name'];
		$config_big['new_image'] = './img/avatars/' . $usernameForFile . '_avtr' . $uploadData['upload_data']['file_ext'];
        $config_big['maintain_ratio'] = FALSE;
        $config_big['width']     = 100;
        $config_big['height']    = 100;
        $config_big['create_thumb']    = FALSE;

        /* Init the config */
        $this->image_lib->initialize($config_big);
        
        /* Resize it */
        if ( ! $this->image_lib->resize()){
            echo $this->image_lib->display_errors();
            return false;
        }
        
        //Return true and dance
        return true;
	}
	
	function newUser($newUserObject, $createAdmin = false) {
		//this is tested and working.
		//this will create a new user. Pass true as the second
		//argument if I want the new user to have admin privileges.
		
		$this->userTypeId = ($createAdmin == true ? 1 : 2);
        $this->username = $newUserObject['username'];
		$this->password = $newUserObject['password'];
		$this->email = $newUserObject['email'];
		$this->avatar = $newUserObject['avatar'];
		$this->avatarSmall = $newUserObject['avatarSmall'];
		$this->experience = 100;
		$this->rankId = ($createAdmin == true ? 6 : 1); //admins are automatically rank 6
		$this->postCount = 0;
		$this->pageCreationCount = 0;
		$this->pageEditCount = 0;
		
        $this->db->insert('users', $this);
		
		//now that the user is created, get the Id
		$newUser = $this->getUserByUsername($newUserObject['username']);
		
		//use the id to award PandorasBox
		$this->Tracker->awardAchievement($newUser[0]->userId, 'Opening PandorasBox');
		
	}
	
	function checkAndGetUser($loginObject){
		$this->db->where('username', $loginObject['username']);
		$this->db->where('password', $loginObject['password']); 
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0){
			return $query->row();
			//saying query->row() instead of query->result because we're only expecting one row
		}else{
			return false;
		}
		
	}
	
	function updateUser($updateUserObject) {
		//this is tested and working.
		//this is a master updateUser function I wrote. I can pass it whatever I want 
		//as long as 'userId' is one of the keys and is not null.
		// The function will check if the object param exists before it attempts 
		// to pass it to the database.
		
		//you cannot update your username, usertype, or password as of version 1.0.
		
		if(isset($updateUserObject['email'])){
			$this->email = $updateUserObject['email'];
		}

		if(isset($updateUserObject['description'])){
			$this->description = $updateUserObject['description'];
		}
		
		if(isset($updateUserObject['avatar'])){
			$this->avatar = $updateUserObject['avatar'];
		}
		
		if(isset($updateUserObject['avatarSmall'])){
			$this->avatar = $updateUserObject['avatarSmall'];
		}
		
		if(isset($updateUserObject['firstname'])){
			$this->firstname = $updateUserObject['firstname'];
		}
		
		if(isset($updateUserObject['lastname'])){
			$this->lastname = $updateUserObject['lastname'];
		}
		
		if(isset($updateUserObject['experience'])){
			$this->experience = $updateUserObject['experience'];
		}
		
		if(isset($updateUserObject['rankId'])){
			$this->rankId = $updateUserObject['rankId'];
		}
		
		if(isset($updateUserObject['postCount'])){
			$this->postCount = $updateUserObject['postCount'];
		}
		
		if(isset($updateUserObject['pageCreationCount'])){
			$this->pageCreationCount = $updateUserObject['pageCreationCount'];
		}
		
		if(isset($updateUserObject['pageEditCount'])){
			$this->pageEditCount = $updateUserObject['pageEditCount'];
		}
		
		$this->db->update('users', $this, array('userId' => $updateUserObject['userId']));
		
		//check for Customado
		$achieveQuery = $this->Users->getUserAchievements($updateUserObject['userId']);
		$hasCustomado = false; //set as false to start
		foreach ($achieveQuery as $row){
			if($row->achievementName == 'Customado'){
				//if the achievement already exists, change it to true
				$hasCustomado = true;
			};
		};
		
		if($hasCustomado == false){
			$this->Tracker->awardAchievement($updateUserObject['userId'], 'Customado');
		};
		
	}
	
}
?>