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
					<!--<h1><span class="logopandora">pandoras</span><span class='logobox'>Box</span></h1>-->
					<a href="#" id="accountLink"><span class="highlight">&gt;</span><?php echo $currentUser->username; ?></a>
					
					<?php $this->load->view('incs/search'); ?>
					
				</div><!--End Header DIV-->
			</div><!-- end headerwrapper-->
			<div id="upperThirdContent">
				<h2 class="accountTitle"><?php echo $currentUser->username ?>'s account</h2>
					<h2 class="controlBarHeader">Control Bar</h2>
					<div id="controlBar">
						<p class="loggedInAs">Welcome! You're logged in as "<strong><?php echo $currentUser->username; ?></strong>",  <span class="loggedSmaller">a rank <strong><?php echo $currentUser->rankId; ?></strong> account.</span></p>
						<ul>
							<li><?php echo anchor('site/editAccount/'.$pageData->pageId, '&gt; Edit Description' , array('class' => 'controlBarButton'));?></li>
							<li><?php echo anchor('site/page/'.$pageData->pageId, '&gt; Back' , array('class' => 'controlBarButton'));?></li>
						</ul>
					</div><!--end controlBar-->
				<div id="accountSidePanel">
					
				</div><!--end sidepanel-->
				
				<div id="accountMainPanel">
					<div id="rankAndExperienceInfo">
						<p class="rankTitle">Rank: <br /><span class="rankName"><?php echo $currentUserRankInfo->rankName ?></span></p>
						<p class="rankDescrip"><?php echo $currentUserRankInfo->rankDescription ?></p>
						<p class="rankTitle">Experience: <span class="rankNumberMed"><?php echo $currentUserRankInfo->experience ?>pts.</span></p>
						<p class="rankTitleSecondary">Posts: <span class="rankNumberMed"><?php echo $currentUserRankInfo->postCount ?></span></p>
						<p class="rankTitleSecondary">Pages Created: <span class="rankNumberMed"><?php echo $currentUserRankInfo->pageCreationCount?></span></p>
						<p class="rankTitleSecondary">Edits Made: <span class="rankNumberMed"><?php echo $currentUserRankInfo->pageEditCount ?></span></p>
					</div><!--end rank And experience info-->
					
					<div id="accountMainInfo">
						<?php echo img(array('src' => $currentUserRankInfo->avatar, 'id' => 'accountAvatarPhoto', 'alt' => $currentUserRankInfo->username."'s avatar photo"))?>
						<h3 class="accountName"><?php echo $currentUserRankInfo->username ?></h3>
						<p class="accountDescrip"><?php echo $currentUserRankInfo->description ?></p>
					</div><!-- end account main info -->
					
				</div><!-- end accountMainPanel-->
			</div><!--end upper third content -->
			</div><!--end upperThirdWrapper-->
			
				<div id="lowerThirdWrapper" class="clearfix">
					<div id="achievementPanel">
						<h3>Achievements</h3>
						<ul id="achievementGrid">
							<?php foreach ($currentUserAchievements as $achievement):?>
							<li><?php echo img(array('src' => $achievement->achievementIcon, 'class' => 'achievementimage', 'alt' => $achievement->achievementName, 'data_descrip' => $achievement->achievementDescription  ))?></li>
							<?php endforeach;?>
						</ul>
						<h4>Your achievements are listed here.</h4>
						<p class="achievementDescrip clearfix">Hover your mouse over any achievement you've earned to get details.</p>
					</div><!--end achievement panel -->
				</div><!--end lowerThirdWrapper-->
			<?php $this->load->view('incs/footer');?>
		</div><!--End Wrapper DIV-->
	<!--JS here - If no JS, remove this -->
	<?php $this->load->view('incs/javascriptfiles');?>
	</body>
</html>