<div id="panelContainer">
			
	<div id="loginPanel">
		<?php echo form_open('main/login');?>
		<fieldset>
		<label for="login_userName">Username</label>
		<input type="text" id="login_username" name="login_username"  class="loginForm" />
		<label for="login_password">Password</label>
		<input type="password" id="login_password" name="login_password" class="loginForm" />
		<a href="#">Forgot your password?</a>
		</fieldset>
		<a href="#" class="cancelLink">Cancel</a>
		<button type="submit" class="signInButton buttondisabled">Sign In</button>
		</form>
	</div><!-- end login panel-->

	<div class="errorTooltip">
		<div class="errorTooltip-body">Oops! That username or password doesn't match any in our database.</div>
		<div class="errorTooltip-tip"></div>
	</div><!--End ErrorTooltip -->
 </div><!-- end panelContainer -->