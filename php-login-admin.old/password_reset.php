<?php

// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
// include the config
require_once('config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/en.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// the user has just successfully entered a new password
// so we show the index page = the login page
if ($login->passwordResetWasSuccessful() == true && $login->passwordResetLinkIsValid() != true) {
include('_header.php');?>

<form method="post" action="index.php" name="loginform">
    <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
    <input id="user_name" type="text" name="user_name" required />
    <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
    <input id="user_password" type="password" name="user_password" autocomplete="off" required />
    <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
    <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
    <input type="submit" name="login" value="<?php echo WORDING_LOGIN; ?>" />
</form>

<a href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>
<a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>

<?php include('_footer.php');
} 

else {
    // show the request-a-password-reset or type-your-new-password form
include('views/_header');
//include('../includes/menu.php');

if ($login->passwordResetLinkIsValid() == true) { ?>
<form method="post" action="password_reset.php" name="new_password_form">
    <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
    <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <input type="submit" name="submit_new_password" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" />
</form>
<!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
<?php } else { ?>
<form method="post" action="password_reset.php" name="password_reset_form">
    <label for="user_name">Enter Your Username</label>
	  <div class="row">
        <div class="col-xs-4">
		  <input id="user_name" type="text" class="form-control" name="user_name" required />
	    </div>
        <input type="submit" class="btn btn-success" name="request_password_reset" value="Reset Password" />
      </div>
</form>
<?php } ?>

<a href="index.php">Back To Login</a>

<?php include('views/_footer.php');
}?>
