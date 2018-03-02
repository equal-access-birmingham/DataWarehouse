<?php require_once("includes/header.php"); ?>
<?php require_once("includes/menu.php"); ?>
<?php
// the user has just successfully entered a new password
// so we show the index page = the login page

if ($login->passwordResetWasSuccessful() == true && $login->passwordResetLinkIsValid() != true) {
?>

    <form method="post" action="index.php" name="loginform" autocomplete="off">
      <label for="user_name">Username</label>
      <input id="user_name" class="form-control" type="text" name="user_name" required />
  
      <label for="user_password">Password</label>
      <input id="user_password" class="form-control" type="password" name="user_password" autocomplete="off" required />
      <br />
      <input type="submit" class="btn btn-success" name="login" value="Log In" />
    </form>
    <br />

    <a href="password_reset.php" class="btn btn-warning btn-xs">I forgot my password</a>

<?php
} else {
	if ($login->passwordResetLinkIsValid() == true) { ?>
	
    <form method="post" action="password_reset.php" name="new_password_form" autocomplete="off">
      <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
      <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />
  
      <label for="user_password_new">New Password</label>
      <input id="user_password_new" class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
  
      <label for="user_password_repeat">Re-enter Password</label>
      <input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
      <br />

    	<input type="submit" class="btn btn-success" name="submit_new_password" value="Submit" />
    </form>

<!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
<?php } else { ?>

    <form method="post" action="password_reset.php" name="password_reset_form" autocomplete="off">
      <label for="user_name">Enter Your Username</label>
      <div class="row">
        <div class="col-xs-4">
          <input id="user_name" type="text" class="form-control" name="user_name" required />
        </div>
        <div class="col-xs-4">
          <input type="submit" class="btn btn-success" name="request_password_reset" value="Reset Password" />
        </div>
      </div>
    </form>

<?php } ?>
    <br />
    <a href="index.php" class="btn btn-warning btn-sm">Back to Login</a>

<?php
} 
?>
<?php include('includes/footer.php'); ?>