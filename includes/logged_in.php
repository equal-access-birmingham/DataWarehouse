<?php include("header.php"); ?>

    <title></title>

<?php require_once("menu.php"); ?>

<?php
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo  "<h2>You are logged in as: " . $_SESSION['user_name'] . "</h2><br />";
?>

<div class="starter-template">
<?php if($login->isUserVerified() == false) echo "    <a href=\"verify_account.php\" class=\"btn btn-primary\">Verify Your Account</a>\n"; ?>
<?php if($login->isUserVerified() == true) echo "    <a href=\"edit.php\" class=\"btn btn-primary\">Edit User Data</a>\n"; ?>
<?php if($permissions->isUserAdmin() == true) echo "    <a href=\"admin.php\" class=\"btn btn-primary\">Admin</a>\n"; ?>
<a href="index.php?logout" class="btn btn-primary" >Logout</a>
</div>
<?php include("footer.php"); ?>
