<?php include("header.php"); ?>

    <title></title>

<?php require_once("menu.php"); ?>

<h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_VERIFY_ACCOUNT_REQUEST; ?></h2>

<p>You have <?php echo $_SESSION['verify_time']; ?> days remaining to verify your account.</p>

<form method="post" action="index.php" name="user_edit_form_password">
    <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
    <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

    <input type="submit" name="user_verify_account" value="<?php echo WORDING_VERIFY_ACCOUNT; ?>" />
</form>

<!-- Logout Link -->
<a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>

<?php include("footer.php"); ?>
