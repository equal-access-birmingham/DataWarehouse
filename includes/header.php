<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('php-login-admin/libraries/password_compatibility_library.php');
}
// include the config
require_once('php-login-admin/config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('php-login-admin/translations/en.php');

// include the PHPMailer library
require_once('php-login-admin/libraries/PHPMailer.php');

// load the login class
require_once('php-login-admin/classes/Login.php');

// load the permissions class
require_once('php-login-admin/classes/Permissions.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// create a permissions object. it will handle permission checking and changing for the accounts
$permissions = new Permissions();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">