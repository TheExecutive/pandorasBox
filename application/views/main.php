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
				<?php if(!isset($is_logged_in) || $is_logged_in == false): ?>
					<h2 class="controlBarHeader">Control Bar</h2>
					<div id="controlBar">
						<p class="loggedInAs">Welcome, <strong>Guest!</strong> This is the Control Bar. Sign up to see all the cool things you can do with it!</p>
					</div><!--end controlBar-->
				<?php else: ?>
					<h2 class="controlBarHeader">Control Bar</h2>
					<div id="controlBar">
						<p class="loggedInAs">Welcome! You're logged in as "<strong><?php echo $currentUser->username; ?></strong>",  <span class="loggedSmaller">a rank <strong><?php echo $currentUser->rankId; ?></strong> account.</span></p>
						<ul>
							<li><button type="button" class="controlBarButton">&gt; Create New Page</button></li>
							<li><button type="button" class="controlBarButton">&gt; Edit This Page</button></li>
						</ul>
					</div><!--end controlBar-->
				<?php endif; ?>
				
				<?php if(isset($searchResults) && $searchResults != false): ?>
				<div id="searchResultsWrapper">
						<h3>Search Results</h3>
						<div class="searchResultsPanel">
						
						<?php foreach ($searchResults as $searchResult): ?>
							<div class="searchResult">
								<p><a href="#" class="resultTitle"><?php echo $searchResult->pageName; ?></a><span class="resultInfo"> - Created <?php echo $searchResult->dateCreated; ?></span></p>
							</div><!--end activity entry -->
						<?php endforeach;?>
							
						</div><!--end searchResultsPanel-->
					</div><!--end searchResultsWrapper-->
				<?php endif; ?>
				
					<div id="latestActivityWrapperMain">
						<h3>Latest Activity</h3>
						<div class="latestActivityPanelMain">
							
							<?php foreach ($returnedActs as $act): ?>
								<div class="activityEntryMain">
									<p><a href="#" class="actTitleMain"><?php echo $act->pageName; ?></a><span class="actData"> - <?php echo $act->actionTaken; ?> by <?php echo $act->username; ?></span></p>
								</div><!--end activity entry -->
							<?php endforeach;?>
							
							
						</div><!--end latestActivityPanelMain-->
					</div><!--end latestActivityWrapperMain-->
				
			</div><!--end upper third content -->
			</div><!--end upperThirdWrapper-->
			
			<div id="lowerThirdWrapper" class="clearfix">
					<div id="bigWatermark">
						pandorasBox Watermark
					</div><!--end big watermark-->
					
					<div id="commentAreaWrapper">
						<?php if(isset($is_logged_in) && $is_logged_in == true): ?>
							<!--The ability to post comments doesn't show up if you're not logged in-->
							<div id="postCommentForm">
								<h3>&gt; post a <span class="orangehighlight">comment</span><span class="commentTitleSmaller"> in <span class="nameOfThread"><?php echo $pageData->pageName; ?></span></h3>
								<?php echo form_open('site/postComment'); ?>
								<?php echo form_hidden('pageId', $pageData->pageId ); ?>
									<textarea id="comment_post" name="comment_post" class="comment">Type your comment here.</textarea>
									<button type="submit" class="buttondisabled clearfix">Submit</button>
								</form>
							</div><!-- end Post comment form -->
						<?php else: ?>
							<div id="postCommentForm">
								<h3>&gt; view <span class="orangehighlight">comments</span><span class="commentTitleSmaller"> in <span class="nameOfThread"><?php echo $pageData->pageName; ?></span></h3>
							</div><!-- end Post comment form -->
						<?php endif; ?>
						
						<div id="commentArea">
							
							<?php foreach ($pageComments as $comment): ?>
								<div class="commentAreaPost">
									<div class="commentProfilePic"><?php echo img($comment->avatarSmall)?></div><!-- end profile pic-->
									<h4><span class="posterName"><?php echo $comment->username; ?></span><span class="postedDate">posted <?php echo $comment->commentDate; ?></span></h4>
									<p class="noPadding"><?php echo $comment->commentContent; ?></p>
								</div><!--end commentAreaPost -->
							<?php endforeach;?>
							
						</div><!--end comment Area-->
						
					</div><!--end commentAreaWrapper-->
					
			</div><!--end lowerThirdWrapper-->
				
			<?php $this->load->view('incs/footer'); ?>
		</div><!--End Wrapper DIV-->
		
	<!--JS here - If no JS, remove this -->
	<?php $this->load->view('incs/javascriptfiles'); ?>
	</body>
</html>