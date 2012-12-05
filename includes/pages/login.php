			<?php
				require_once($_['fs_root'].'auth/login.php');
			?>
			<form class="form-signin" name="login" action="login" method="post">
				<?php
					if(isset($_SESSION['show_valid_register']) and $_SESSION['show_valid_register']) {
						echo $authLoc['reg_success'];
						unset($_SESSION['show_valid_register']);
					}
					$status = null;
				?>
				<h2 class="form-signin-heading"><?php echo $authLoc['form_login']; ?></h2>

				<?php login::errors($status, $authLoc, $auth); ?>

				<input
					   type="text"
					   name="username"
					   class="input-block-level"
					   placeholder="<?php echo $authLoc['form_username']; ?>"
					   maxlength="<?php echo $auth['validate_username']['max_length']; ?>"
				/>

				<input
					   type="password"
					   name="password"
					   class="input-block-level"
					   placeholder="<?php echo$authLoc['form_password']; ?>"
					   maxlength="<?php echo $auth['validate_username']['max_length']; ?>"
				/>

				<label class="checkbox">
					<input type="checkbox" name="remember-me" value="true" /> <?php echo $authLoc['login_form_remember']; ?>
				</label>
				<button class="btn btn-large btn-primary" type="submit"><?php echo $authLoc['login_form_submit']; ?></button>
				<input name="trigger_login" type="hidden" value="true">
				<hr>
				<p>Forgot your password? Click <a href="<?php tpl::wr($_); ?>">here</a> to begin account recovery.</p>
				<p>If you do not have an Arcfolder account, click <a href="<?php tpl::wr($_); ?>register">here</a> to register.</p>
			</form>
