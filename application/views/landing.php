<?php doctype('html5');?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<?php $this->load->view('incs/header');?>
	<body>
		<div id="wrapper">
			<?php echo $this->message->display(); ?>
			<?php echo validation_errors();?>
			<?php $this->load->view($panelContainer);?>
			
			<div id="upperThirdWrapper" class="clearfix">
			<div id="headerWrapper">
				<div id="header">
					<?php if(!isset($is_logged_in) || $is_logged_in == false):?>
						<!--<h1><span class="logopandora">pandoras</span><span class='logobox'>Box</span></h1>-->
						<a href="#" id="loginLink"><span class="highlight">&gt;</span> Login</a>
					<?php else:?>
						<a href="#" id="loginLink"><span class="highlight">&gt;</span> <?php $currentUser->username; ?></a>
					<?php endif;?>
					<?php $this->load->view('incs/search');?>
				</div><!--End Header DIV-->
			</div><!-- end headerwrapper-->
			<div id="upperThirdContent">
					<div id="typography">
						<h2>
							<span class="tpgraphic">pandorasBox Graphic</span>
							<span class="tpsmall">It&#8217;s like</span>
							<span class="tpthincaps">Coldbox</span>
							<span class="tpcolorcaps">Documentation</span>
							<span class="tpdarksmall">But in</span>
							<span class="tpbig">English<span class="tpperiod">.</span></span>
							<span class="tpasterisk">&#42;</span>
							<span class="tpcomment">&#42;or Spanish, French, Portuguese, Italian, etc.</span>
						</h2>
					</div><!--end typography-->
					
					<div id="latestActivityWrapper">
						<h3>Latest Activity</h3>
						<div class="latestActivityPanel">
							
							<?php foreach ($returnedActs as $act):?>
								<div class="activityEntryMain">
									<p><?php echo anchor('site/page/'. $act->pageId, $act->pageName , array('class' => 'actTitleMain'));?><span class="actData"> - <?php echo $act->actionTaken; ?> by <?php echo $act->username; ?></span></p>
								</div><!--end activity entry -->
							<?php endforeach;?>
							
						</div><!--end latestActivityPanel -->
					</div><!--end latestActivityWrapper-->
			</div><!--end upper third content -->
				</div><!--end upperThirdWrapper-->
				
				<div id="bigAssSignupPanel" class="clearfix">
					<div id="signupPanelInner">
						<div id="innerHeaderLogo">
							Inner Logo.
						</div><!--Close Inner-->
						<h2>Your window <br />to an <span class="easier">easier</span> framework.</h2>
						
						<div id="signUpFormPanel">
							<p class="requiredNotice">&#42; Indicates Required Field</p>
							<!--<form method="post" action="#" enctype="multipart/form-data">-->
								
								<?php echo form_open_multipart('main/signup');?>
								<fieldset>
									<label for="signup_userName">Username &#42;</label>
									<input type="text" id="signup_username" name="signup_username" class="signupForm username" />
									<label for="signup_password">Password &#42;</label>
									<input type="password" id="signup_password" name="signup_password" class="signupForm password" />
									<label for="signup_email">Email &#42;</label>
									<input type="text" id="signup_email" name="signup_email" class="signupForm email" />
									<label for="signup_avatar">Avatar</label>
									<label class="avatarFileNameDisplay">.jpg, .gif, or .png</label>
									<label class="cabinet">
										<input type="file" id="signup_avatar" name="signup_avatar" class="signupForm avatar file" />
									</label>
								</fieldset>
								<a href="#" class="signupCancelLink">Cancel</a>
								<button type="submit" class="signUpButton buttondisabled clearfix">Submit</button>
							</form>
						</div><!-- End Signup Panel -->
					</div><!-- signupPanelInner-->
					
				</div><!--end big ass signup -->
			
				<div id="middleThirdWrapper" class="clearfix">
					<div id="signUpMiddleStrip">
						<p id="ctaText">
							<span class="orangehighlight">Search</span> our easy-to-use, easy-to-understand Coldbox docs, or <span class="orangehighlight">Sign up</span> to create and edit them yourself!
						</p>
						<a id="bigSignupButton" href="#">&gt; Signup</a>
					</div><!--end signup middle strip -->
				</div><!--end middle third wrapper-->
				
				<div id="lowerThirdWrapper" class="clearfix">
					
					<div id="bigWatermark">
						pandorasBox Watermark
					</div><!--end big watermark-->
					
					<div id="logoArea">
						Logos go here
					</div><!-- end logo area -->
					
					<div id="sidetext">
						<h3>You&#8217;re not a <span class="orangehighlight">genius.</span><br/>We get that.</h3>
						<p>Beginning Coldfusion developer? Giving MVC frameworks a try? Great. 
							So you download Coldbox, and you take a look at some of the docs. 
							Wait - interceptors? Auto-aspect binding? ORM? Don't worry, we're here to help. 
							Our Coldbox documentation is written with beginning CF developers in mind. And if you're already a CF guru, 
							go ahead and sign up to create/edit pages and share your genius with the rest of the world.
						<a class="textSignUpLink" href="#" >&gt;Sign Up!</a>
						</p>
					</div><!--end sidetext-->
				</div><!--end lowerThirdWrapper-->
			<?php $this->load->view('incs/footer');?>
		</div><!--End Wrapper DIV-->
	<!--JS here - If no JS, remove this -->
	<?php $this->load->view('incs/javascriptfiles');?>
	</body>
</html>