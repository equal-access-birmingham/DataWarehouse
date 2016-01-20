<?php require_once("includes/header.php"); ?>

    <title>EAB Database</title>

<?php require_once("includes/menu.php"); ?>

<?php
// if the user is not logged in
if ($login->isUserLoggedIn() == false) {
?>

      <form method="post" action="index.php" name="loginform">
        <div class="form-group">
          <label for="user_name">Username</label>
          <input id="user_name" type="text" class="form-control" name="user_name" required />
        </div>

        <div class="form-group">
          <label for="user_password">Password</label>
          <input id="user_password" type="password" class="form-control" name="user_password" autocomplete="off" required />
        </div>

          <!--input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" /-->
          <!--label for="user_rememberme">Keep me logged in (for 2 weeks)</label-->

        <div class="form-group">
          <input type="submit" class="btn btn-success" name="login" value="<?php echo WORDING_LOGIN; ?>" />
        </div>
      </form>
      <br />
      <a href="password_reset.php" class="btn btn-info btn-xs"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>

<?php
} else {

    // if the user is logged in and not verified
    if ($login->isUserVerified() == false) {
?>

      <h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_VERIFY_ACCOUNT_REQUEST; ?></h2>

      <p>You have <?php echo $_SESSION['verify_time']; ?> days remaining to verify your account.</p>

      <form method="post" action="index.php" name="user_edit_form_password">
        <div class="form-group">
          <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
          <input id="user_password_old" class="form-control" type="password" name="user_password_old" autocomplete="off" />
        </div>

        <div class="form-group">
          <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
          <input id="user_password_new"class="form-control"  type="password" name="user_password_new" autocomplete="off" />
        </div>

        <div class="form-group">
          <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
          <input id="user_password_repeat"class="form-control"  type="password" name="user_password_repeat" autocomplete="off" />
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-success" name="user_verify_account" value="<?php echo WORDING_VERIFY_ACCOUNT; ?>" />
        </div>
      </form>

      <!-- Logout Link -->
      <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>


<?php
    // if the user is logged in and verifed
    } else {
?>
      <div class="row">
        <a href="newpatientform.php" class="btn btn-lg btn-success btn-block btn-space text-center ">New Patient</a>
      </div>

      <div class="row">
        <a href="select_patient.php" class="btn btn-lg btn-success btn-block btn-space text-center">Returning Patient</a>
      </div>

      <div class="row">
        <a href="index.php?logout" class="btn btn-sm btn-warning text-center">Log Out</a>
      </div>

<?php
    }
}
?>

<?php require_once("includes/footer.php"); ?>