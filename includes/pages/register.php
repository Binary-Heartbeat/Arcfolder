		<?php
			//require_once($_['fs_root'].'auth/register.php');

			function form_status($check, $value) {
				if($check['trigger']) {
				   if(!$check[$value]['valid']) {
						echo 'error';
					} elseif($check[$value]['valid']) {
						echo 'success';
					}
				}
			}
			function form_value($value) {
				if(isset($_POST[$value])) {
					echo 'value="'.$_POST[$value].'"'.PHP_EOL;
				}
			}
		?>
			<form class="form-horizontal well form-register" name="register" action="register" method="post">
				<h2 class="form-auth-heading"><?php echo $authLoc['form_register']; ?></h2>
				<?php register::errors($check, $authLoc, $auth); ?>

				<div class="control-group <?php form_status($check, 'username'); ?>">
					<label class="control-label" for="username"><?php echo $authLoc['form_username']; ?></label>
					<div class="controls">
						<input
							type="text"
							name="username"
							id="username"
							class="input-xlarge"
							maxlength="<?php echo $auth['validate_username']['max_length']; ?>"
							<?php form_value('username'); ?>
						/>
					</div>
				</div>

				<div class="control-group <?php form_status($check, 'password'); ?>">
					<label class="control-label" for="password"><?php echo $authLoc['form_password']; ?></label>
					<div class="controls">
						<input
							type="password"
							name="password"
							id="password"
							class="input-xlarge"
							maxlength="<?php echo $auth['validate_password']['max_length']; ?>"
						/>
					</div>
				<!--</div>-->

				<!--<div class="control-group <?php //form_status($check, 'password'); ?>">-->
					<label class="control-label" for="password_confirm"><?php echo $authLoc['form_password_again']; ?></label>
					<div class="controls">
						<input
							type="password"
							name="password_confirm"
							id="password_confirm"
							class="input-xlarge"
							maxlength="<?php echo $auth['validate_password']['max_length']; ?>"
						/>
					</div>
				</div>

				<div class="control-group <?php form_status($check, 'email'); ?>">
					<label class="control-label"><?php echo $authLoc['form_email']; ?></label>
					<div class="controls">
						<input
							type="text"
							name="email"
							class="input-xlarge"
							<?php form_value('email'); ?>
						/>
					</div>
				<!--</div>-->

				<!--<div class="control-group <?php //form_status($check, 'email'); ?>">-->
					<label class="control-label"><?php echo $authLoc['form_email_again']; ?></label>
					<div class="controls">
						<input
							type="text"
							name="email_confirm"
							class="input-xlarge"
							<?php form_value('email'); ?>
						/>
					</div>
				</div>
				<?php
					if($auth['recaptcha']['enable']) {
						echo '<div class="control-group">'.
								'<label class="control-label">'.$authLoc['form_captcha'].'</label>'.
								'<div class="controls">';
						if(isset($check['captcha']['resp'])) {
							echo recaptcha_get_html($auth['recaptcha']['public_key'], $check['captcha']['resp']->error);
						} else {
							echo recaptcha_get_html($auth['recaptcha']['public_key']);
						}
						echo '</div>'.
								'</div>';
					}
				?>

				<div class="form-actions">
					<button type="submit" class="btn btn-primary">
					<!--<button class="btn btn-large btn-primary" type="submit">-->
						<?php echo $authLoc['reg_form_submit']; ?>
					</button>
					<button type="reset" class="btn">Clear Form</button>
				</div>
				<input name="trigger_register" type="hidden" value="true">
			</form>
