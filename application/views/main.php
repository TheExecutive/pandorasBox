<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title>pandorasBox - Easy-to-use, simple documentation for the Coldbox Coldfusion framework.</title>
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<!--Begin Metas for Accessibility-->
			<meta name="keywords" content="pandorasBox, Coldfusion, Coldbox, Framework, Documentation, Easy, Simple, Tutorials" />
			<meta name="description" content="pandorasBox is simple, easy to use documenation for beignners of the Coldbox Coldfusion framework." />
			<!--End Metas for Accessibility-->
			
			<!--CSS here -->
			<link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
	</head>	
	<body>
		<div id="wrapper">
			<div id="panelContainer">
			
				<div id="loginPanel">
					<form method="post" action="#">
					<fieldset>
					<label for="login_userName">Username</label>
					<input type="text" id="login_userName" class="loginForm" />
					<label for="login_password">Password</label>
					<input type="password" id="login_password" name="password" class="loginForm" />
					<a href="#">Forgot your password?</a>
					</fieldset>
					<a href="#" class="cancelLink">Cancel</a>
					<button type="button" class="signInButton buttondisabled">Sign In</button>
					</form>
				</div><!-- end login panel-->
			
				<div class="errorTooltip">
					<div class="errorTooltip-body">Oops! That username or password doesn't match any in our database.</div>
					<div class="errorTooltip-tip"></div>
				</div><!--End ErrorTooltip -->
			 </div><!-- end panelContainer -->
				 
			<div id="upperThirdWrapper" class="clearfix">
			<div id="headerWrapper">
				<div id="header">
					<!--<h1><span class="logopandora">pandoras</span><span class='logobox'>Box</span></h1>-->
					<a href="#" id="accountLink"><span class="highlight">&gt;</span>awesomeCoder</a>
					
					<div id="searchWrapper">
						<form method="post" action="#">
							<input type="text" class="searchInput" value="get some answers." />
							<button type="submit" class="searchButton">Search</button>
						</form>
					</div><!--end searchWrapper -->
					
				</div><!--End Header DIV-->
			</div><!-- end headerwrapper-->
			<div id="upperThirdContent">
				<h2 class="controlBarHeader">Control Bar</h2>
				<div id="controlBar">
					<p class="loggedInAs">logged in as <strong>awesomeCoder</strong>, <span class="loggedSmaller">a rank <strong>6</strong> account.</span></p>
					<ul>
						<li><button type="button" class="controlBarButton">&gt; Create New Page</button></li>
						<li><button type="button" class="controlBarButton">&gt; Edit This Page</button></li>
					</ul>
				</div><!--end sidepanel-->
				
				<div id="searchResultsWrapper">
						<h3>Search Results</h3>
						<div class="searchResultsPanel">
							
							<div class="searchResult">
								<p><a href="#" class="resultTitle">ORM</a><span class="resultInfo"> - Created on 1/22/2012</span></p>
							</div><!--end activity entry -->
							
							<div class="searchResult">
								<p><a href="#" class="resultTitle">Interceptors</a><span class="resultInfo"> - Created on 1/22/2012</span></p>
							</div><!--end activity entry -->
							
						</div><!--end searchResultsPanel-->
					</div><!--end searchResultsWrapper-->
					
					<div id="latestActivityWrapperMain">
						<h3>Latest Activity</h3>
						<div class="latestActivityPanelMain">
							
							<div class="activityEntryMain">
								<p><a href="#" class="actTitleMain">ORM</a><span class="actData"> - Created on 1/22/2012</span></p>
							</div><!--end activity entry -->
							
							<div class="activityEntryMain">
								<p><a href="#" class="actTitleMain">ORM</a><span class="actData"> - Created on 1/22/2012</span></p>
							</div><!--end activity entry -->
							
						</div><!--end searchResultsPanel-->
					</div><!--end searchResultsWrapper-->
				
			</div><!--end upper third content -->
			</div><!--end upperThirdWrapper-->
			
			<div id="lowerThirdWrapper" class="clearfix">
					<div id="bigWatermark">
						pandorasBox Watermark
					</div><!--end big watermark-->
					
					<div id="commentAreaWrapper">
						<div id="postCommentForm">
							<h3>&gt; post a <span class="orangehighlight">comment</span><span class="commentTitleSmaller"> in <span class="nameOfThread">General</span></h3>
							<form method="post" action="#">
								<textarea id="comment_post" name="comment_post" class="comment">Type your comment here.</textarea>
								<button type="submit" class="buttondisabled clearfix">Submit</button>
							</form>
						</div><!-- end Post comment form -->
						
						<div id="commentArea">
							
							<div class="commentAreaPost">
								<div class="commentProfilePic"><img src="img/testimage.gif" alt="The Executive's Profile Pic" /></div><!-- end profile pic-->
								<h4><span class="posterName">TheExecutive</span><span class="postedDate">posted 12/1/2012 - 12:22:23</span></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div><!--end commentAreaPost -->
							
							<div class="commentAreaPost">
								<div class="commentProfilePic"><img src="img/testimage.gif" alt="The Executive's Profile Pic" /></div><!-- end profile pic-->
								<h4><span class="posterName">TheExecutive</span> <span class="postedDate">posted 12/1/2012 - 12:22:23</span></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div><!--end commentAreaPost -->
							
							<div class="commentAreaPost">
								<div class="commentProfilePic"><img src="img/testimage.gif" alt="The Executive's Profile Pic" /></div><!-- end profile pic-->
								<h4><span class="posterName">TheExecutive</span> <span class="postedDate">posted 12/1/2012 - 12:22:23</span></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div><!--end commentAreaPost -->
							
							<div class="commentAreaPost">
								<div class="commentProfilePic"><img src="img/testimage.gif" alt="The Executive's Profile Pic" /></div><!-- end profile pic-->
								<h4><span class="posterName">TheExecutive</span> <span class="postedDate">posted 12/1/2012 - 12:22:23</span></h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div><!--end commentAreaPost -->

							
						</div><!--end comment Area-->
						
					</div><!--end commentAreaWrapper-->
					
			</div><!--end lowerThirdWrapper-->
				
			<div id="footer" class="clearfix">
				<div id="footerLogo">FooterLogo</div>
				<p>design, code and awesomeness by Troy Grant</p>
				<p>Individual Project - ASL1201</p>
			</div><!--End Footer DIV-->
		</div><!--End Wrapper DIV-->
		
	<!--JS here - If no JS, remove this -->
	<script type="text/javascript" src="js/jquery-1.7.1.js"></script>
	<script type="text/javascript" src="js/si.files.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>