/*  
	pandorasBox
	Author: Troy Grant
*/

(function($){
	
	var upperThird = $('#upperThirdWrapper')
		loginPanel = $('#loginPanel'),
		loginLink = $('#loginLink'),
		loginCancelLink = upperThird.find('.cancelLink'),
		signInButton = upperThird.find('.signInButton'),
		errorTooltip = $('.errorTooltip'),
		signUpPanel = $('#bigAssSignupPanel'),
		signUpButton = $('#bigSignupButton')
		shutterUp = false,
		shutterAnimating = false,
		achievementGridLis = $('#achievementGrid li')
	;
	
	
	$(document).ready(function(){
		
		//first, hide login panel and tooltip
		loginPanel.hide();
		errorTooltip.hide();
		
		//hide big panel
		signUpPanel.hide();
		
		//using style plugin
		SI.Files.stylizeAll();
		
		$("#loginLink").live("click", function() {
			//hide the signUpPanel if it's open
			errorTooltip.fadeOut();
			loginPanel.slideToggle();
			return false;
		});
		
		$(".cancelLink").live("click", function() {
			errorTooltip.fadeOut();
			loginPanel.slideToggle();
			return false;
		});
		
		
		
		//big signup button
		$('#bigSignupButton').live("click", function() {
			//slide the upper third up by 516px
			if(shutterAnimating === false){
				//don't run this code unless the shudder isn't currently animating
				if(shutterUp === false){
					shutterAnimating = true;
					upperThird.animate({
						top: '-516px'
					}, 2000, function() {
						//animation complete
						shutterAnimating = false;
					});
					signUpPanel.show();
					shutterUp = true;
				}else{
					shutterAnimating = true;
					upperThird.animate({
						top: '0px'
					}, 2000, function() {
						//animation complete
						signUpPanel.hide();
						shutterUp = false;
						shutterAnimating = false;
					});
				};
			}
			
			return false;
		});
		
		//big signup button
		$('.signupCancelLink').live("click", function() {
			//slide the upper third up by 516px
			if(shutterAnimating === false){
				//don't run this code unless the shudder isn't currently animating
				if(shutterUp === false){
					shutterAnimating = true;
					upperThird.animate({
						top: '-516px'
					}, 2000, function() {
						//animation complete
						shutterAnimating = false;
					});
					signUpPanel.show();
					shutterUp = true;
				}else{
					shutterAnimating = true;
					upperThird.animate({
						top: '0px'
					}, 2000, function() {
						//animation complete
						signUpPanel.hide();
						shutterUp = false;
						shutterAnimating = false;
					});
				};
			}
			
			return false;
		});
		
		//new user signup event
		$("#signUpPanel .signInButton").on("click", function() {
			if(signUpValid === true){
				//the button isn't clicable unless the login is valid
				submitValidClicked();
			};
			return false;
		});
		
		//checking val of avatar
		$('#signup_avatar').on("change", function() {
			var that = $(this);
			//making a display for the avatar upload, traversing
			that.parent().prev().html(that.val());
		});
		
		//validation for login
		$(".loginForm").on("keyup", function() {
			that = $(this);
			if ( that.val() !== "" && that.siblings("input").val() !== ""){
				//if both login fields have something in them, ungray the button out
				container.find("#loginPanel .signInButton").removeClass("buttondisabled");
				loginValid = true;
			}else{
				container.find("#loginPanel .signInButton").addClass("buttondisabled");
				loginValid = false;
			}
		});
		
		//login event
		signInButton.live("click", function() {
			if(loginValid === true){
				//the button isn't clickable unless the login is valid
				userLogin();
			};
			return false;
		});
		
		//achievements
		$('#achievementGrid li').on("mouseover", function(){
			that = $(this);
			var achieveName = that.children().attr('alt');
			var achieveDesc = that.children().attr('data_descrip');
			$('#achievementPanel h4').text(achieveName);
			$('.achievementDescrip').text(achieveDesc);
			
			return false;
		});
		
		
		
	}); // end document ready
	
})(jQuery); // end private scope