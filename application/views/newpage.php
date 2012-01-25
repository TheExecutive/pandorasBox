<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<?php $this->load->view('incs/header'); ?>
	<body>
		<div id="wrapper">
			<?php $this->load->view($panelContainer); ?>
			<div id="upperThirdWrapper" class="clearfix">
			<div id="headerWrapper">
				<div id="header">
					<?php echo validation_errors(); ?>
					<?php if(!isset($is_logged_in) || $is_logged_in == false): ?>
						<!--<h1><span class="logopandora">pandoras</span><span class='logobox'>Box</span></h1>-->
						<a href="#" id="loginLink"><span class="highlight">&gt;</span> Login</a>
					<?php else: ?>
						<a href="#" id="loginLink"><span class="highlight">&gt;</span> <?php echo $currentUser->username; ?></a>
					<?php endif; ?>
					<?php $this->load->view('incs/search'); ?>
				</div><!--End Header DIV-->
			</div><!-- end headerwrapper-->
			<div id="upperThirdContent">
					<h2 class="controlBarHeader">Control Bar</h2>
					<?php echo form_open('site/newPageSubmit', array('class' => 'newPageForm')); ?>
					<div id="controlBar">
						<p class="loggedInAs">Welcome! You're logged in as "<strong><?php echo $currentUser->username; ?></strong>",  <span class="loggedSmaller">a rank <strong><?php echo $currentUser->rankId; ?></strong> account.</span></p>
						<ul>
							<li><?php echo form_submit(array('class' => 'controlBarButton', 'name' => 'newpagesubmit', 'value' => '> Save Page')); ?></li>
							<li><?php echo anchor('site/cancelnewpage', '&gt; Cancel' , array('class' => 'controlBarButton'));?></li>
						</ul>
					</div><!--end controlBar-->
					
					<div id="latestActivityWrapperMain">
						<h3>Tips!</h3>
						<div class="latestActivityPanelMain">
							<ul class="tipsAndTricks">
								<li>Don't create a new page just for the sake of saying you did. Make sure it's a relevant topic.</li>
								<li>Never assume someone will know what you're talking about. Start off by explaining your topic like you would to a Coldfusion beginner.</li>
								<li>The more examples, the better. Give code, code, and more code.</li>
								<li>Use proper spelling and grammar. Aint nobodi gon' pay no attenshun to u if u tallkin liek dis.</li>
								<li>Most importantly, have fun!</li>
							</ul>
							
						</div><!--end latestActivityPanelMain-->
						
					</div><!--end latestActivityWrapperMain-->
					
					<div id="pageMainContentWrapper">
						<div id="pageMainContent">
							<h2>Create New Page</h2>
							<?php echo form_input(array(
								'name' => 'newpage_pagetitle',
								'id' => 'newpage_pagetitle',
								'value' => 'Enter a title.'
							)); ?>
							<?php echo form_textarea(array(
								'name' => 'newpage_pagecontent',
								'id' => 'newpage_pagecontent',
								'value' => 'Share your knowledge of the subject!'
							)); ?>
						</div><!--end pageMainContent-->
					</div><!--end pageMainContentWrapper -->
				</form>
			</div><!--end upper third content -->
			</div><!--end upperThirdWrapper-->
			
			<div id="lowerThirdWrapper" class="clearfix">
					<div id="bigWatermark">
						pandorasBox Watermark
					</div><!--end big watermark-->
			</div><!--end lowerThirdWrapper-->
			<?php $this->load->view('incs/footer'); ?>
		</div><!--End Wrapper DIV-->
	<!--JS here - If no JS, remove this -->
	<?php $this->load->view('incs/javascriptfiles'); ?>
	</body>
</html>