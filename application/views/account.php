<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<title><?php echo $pageTitle; ?></title>
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
				<h2 class="accountTitle">Your account</h2>
				<div id="accountSidePanel">
					<ul>
						<li><a href="#">&gt; Edit Description</a></li>
						<li><a href="#">&gt; Upload New Avatar</a></li>
						<li><a href="#">&gt; Back to Main Page</a></li>
					</ul>
				</div><!--end sidepanel-->
				
				<div id="accountMainPanel">
					<div id="rankAndExperienceInfo">
						<p class="rankTitle">Rank: <br /><span class="rankName">Executive ***</span></p>
						<p class="rankDescrip">This is a special rank given to all admins. Don't feel bad. You might be this cool too, someday.</p>
						<p class="rankTitle">Experience: <span class="rankNumberMed">100pts.</span></p>
						<p class="rankTitleSecondary">Posts: <span class="rankNumberMed">4</span></p>
						<p class="rankTitleSecondary">Pages Created: <span class="rankNumberMed">34</span></p>
						<p class="rankTitleSecondary">Edits Made: <span class="rankNumberMed">12</span></p>
					</div><!--end rank And experience info-->
					
					<div id="accountMainInfo">
						<img id="accountAvatarPhoto" src="#" alt="avatar photo" />
						<h3 class="accountName">awesomeCoder</h3>
						<p class="accountDescrip">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
					</div><!-- end account main info -->
					
				</div><!-- end accountMainPanel-->
			</div><!--end upper third content -->
			</div><!--end upperThirdWrapper-->
			
				<div id="lowerThirdWrapper" class="clearfix">
					<div id="achievementPanel">
						<h3>Achievements</h3>
						<ul id="achievementGrid">
							<li>Achievement</li>
							<li>Achievement</li>
							<li>Achievement</li>
							<li>Achievement</li>
							<li>Achievement</li>
							<li>Achievement</li>
							<li>Achievement</li>
							<li>Achievement</li>
						</ul>
						<h4>Your achievements are listed here.</h4>
						<p class="achievementDescrip clearfix">Click on any achievement you've earned to get details.</p>
					</div><!--end achievement panel -->
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