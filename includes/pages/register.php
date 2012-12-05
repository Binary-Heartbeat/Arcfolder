		<?php
			require_once($_['fs_root'].'auth/register.php');

			function form_style_open($reg, $check) {
				if($reg['trigger']) {
				   if(!$reg[$check]['valid']) {
						echo '<div class="control-group error">'.PHP_EOL;
					} elseif($reg[$check]['valid']) {
						echo '<div class="control-group success">'.PHP_EOL;
					}
					echo '<div class="controls">'.PHP_EOL;
				}
			}
			function form_style_close($reg, $check) {
				if($reg['trigger']) {
					echo '</div>'.PHP_EOL;
					echo '</div>'.PHP_EOL;
				} else {
					//echo '<br/>';
				}
			}
			function form_style_id($reg, $check) {
				if($reg['trigger']) {
					if(!$reg[$check]['valid']) {
						echo'id="inputError"'.PHP_EOL;
					} elseif($reg[$check]['valid']) {
						echo'id="inputSuccess"'.PHP_EOL;
					}
				}
			}
			function form_style_value($check) {
				if(isset($_POST[$check])) {
					echo 'value="'.$_POST[$check].'"'.PHP_EOL;
				}
			}
		?>
			<form class="form-signin" name="register" action="register" method="post">
				<h2 class="form-signin-heading"><?php echo $authLoc['form_register']; ?></h2>
				<?php register::errors($reg, $authLoc, $auth); ?>

				<?php form_style_open($reg,'username'); ?>
				<input
					type="text"
					name="username"
					class="input-block-level"
					placeholder="<?php echo $authLoc['form_username']; ?>"
					maxlength="<?php echo $auth['validate_username']['max_length']; ?>"
					<?php form_style_value('username'); ?>
					<?php form_style_id($reg,'username'); ?>
				/>
				<?php form_style_close($reg,'username'); ?>

				<?php form_style_open($reg,'password'); ?>
				<input
					type="password"
					name="password"
					class="input-block-level"
					placeholder="<?php echo $authLoc['form_password']; ?>"
					maxlength="<?php echo $auth['validate_password']['max_length']; ?>"
					<?php form_style_id($reg,'password'); ?>
				/>
				<?php form_style_close($reg,'password'); ?>

				<?php form_style_open($reg,'password'); ?>
				<input
					type="password"
					name="password_confirm"
					class="input-block-level"
					placeholder="<?php echo $authLoc['form_password_again']; ?>"
					maxlength="<?php echo $auth['validate_password']['max_length']; ?>"
					<?php form_style_id($reg,'password'); ?>
				/>
				<?php form_style_close($reg,'password'); ?>

				<?php form_style_open($reg,'email'); ?>
				<input
					type="text"
					name="email"
					class="input-block-level"
					placeholder="<?php echo $authLoc['form_email']; ?>"
					<?php form_style_value('email'); ?>
					<?php form_style_id($reg,'email'); ?>
				/>
				<?php form_style_close($reg,'email'); ?>

				<?php form_style_open($reg,'email'); ?>
				<input
					type="text"
					name="email_confirm"
					class="input-block-level"
					placeholder="<?php echo $authLoc['form_email_again']; ?>"
					<?php form_style_id($reg,'email'); ?>
				/>
				<?php form_style_close($reg,'email'); ?>

				<?php
					if(isset($resp)) {
						echo recaptcha_get_html($auth['recaptcha']['public_key'], $resp->error);
					} else {
						echo recaptcha_get_html($auth['recaptcha']['public_key']);
					}
				?>
				<br/>
				<button class="btn btn-large btn-primary" type="submit">
					<?php echo $authLoc['reg_form_submit']; ?>
				</button>
				<input name="trigger_register" type="hidden" value="true">
			</form>
