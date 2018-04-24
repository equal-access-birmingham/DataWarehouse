<?php require_once("includes/header_require_admin.php"); ?>

    <title>EAB Data Warehouse</title>

<?php require_once("includes/menu.php"); ?>

<?php
// Include registration class file
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once("php-login-admin/classes/Registration.php");

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();
?>

<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful) { ?>
      <form method="post" action="register.php" name="registerform" autocomplete="off">
        <div class="form-group">
          <label for="user_email"><?php echo WORDING_REGISTRATION_EMAIL; ?></label>
          <input id="user_email" class="form-control" type="email" name="user_email" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-default" name="register" value="<?php echo WORDING_REGISTER; ?>" />
        </div>
      </form>
<?php } ?>

    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php require_once("includes/footer.php"); ?>

