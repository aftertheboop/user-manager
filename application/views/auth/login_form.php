<?php
extract($data);

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
        'class' => 'form-control input-lg',
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
        'class' => 'form-control input-lg',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div class="container">
    <div class="col-lg-4 col-md-4 col-sm-3 hidden-xs"></div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
<h1>Please Log In</h1>
<?php echo form_open($this->uri->uri_string()); ?>
<div class="form-group">
    <?php echo form_label($login_label, $login['id']); ?>
    <?php echo form_input($login); ?>
    <label class="error"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></label>
</div>
<div class="form-group">
    <?php echo form_label('Password', $password['id']); ?>
    <?php echo form_password($password); ?>
    <label class="error"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></label>
</div>


	<?php if ($show_captcha) {
            ?>
<div class="form-group">
    <table>
            <?php
		if ($use_recaptcha) { ?>
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</td>
		<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
		<?php echo $recaptcha_html; ?>
	</tr>
	<?php } else { ?>
	<tr>
		<td colspan="3">
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
		<td><?php echo form_input($captcha); ?></td>
		<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
	</tr>
	<?php } ?>
    </table>
</div>
	<?php } ?>
<div class="form-group">
    <?php echo form_checkbox($remember); ?>
    <?php echo form_label('Remember me', $remember['id']); ?>
    <?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?>
    <?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>
</div>
<div class="form-group">
<?php echo form_submit('submit', 'Let me in', array('class' => 'btn btn-primary btn-lg pull-right')); ?>
</div>
<?php echo form_close(); ?>
    </div>
</div>