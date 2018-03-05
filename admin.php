<?php require_once("includes/header_require_admin.php"); ?>

    <title>EAB Database</title>

<?php require_once("includes/menu.php"); ?>

<?php
if($permissions->confirm_action_prompt)
{
  // This is just one way to trigger the $_POST['confirm_action'] variable in the Permissions class
  echo "
      <form method=\"post\" action=\"admin.php\">
        <input type=\"submit\" name=\"confirm_action\" value=\"Confirm\" />
        <input type=\"submit\" name=\"dismiss_action\" value=\"No, Go Back!\" />
      </form>
  ";
}
?>

      <h2 style="margin-bottom: 30px"><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_ADMIN_EDIT_ACCOUNTS; ?></h2>


      <!-- Table of all users encapsulated by a form to allow checkboxes for quickly modifying account permissions -->
      <form method="post" action="admin.php">
        <div class="form-group" style="display: inline-block">
          <a href="register.php" class="btn btn-info btn-sm"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>
        </div>
        <div class="form-group pull-right">
          <input type="submit" class="btn btn-info btn-sm" name="update_accounts" value="<?php echo WORDING_UPDATE; ?>" /> 
        </div>
        
        <div class="table-responsive">
          <table class="table table-striped">
            <tr>
              <th class="text-center">User Name</th>
              <th class="text-center">User Email</th>
              <th class="text-center">User Registration Date</th>
              <th class="text-center">Admin</th>
              <th class="text-center">Reset Account</th>
              <th class="text-center">Delete Account</th>
            </tr>
<?php
// Creates table
foreach($permissions->getEachUsersData() as $data)
{
    echo "
            <tr>
              <td class=\"text-center\">$data->user_name</td>
              <td class=\"text-center\">$data->user_email</td>
              <td class=\"text-center\">$data->user_registration_datetime</td>\n";
  
    // Automatically checks admins so that they can be unchecked to remove admin privilege
    echo "            <td class=\"text-center\"><input type=\"checkbox\" name=\"admin[]\" value=\"$data->user_id\" ";
    if($data->admin == 1) echo "checked";
    echo " /></td>\n";

    // Creates checkbox arrays for "reset_account" and "delete_account" so that multiple actions can be selected at once
    echo "
              <td class=\"text-center\"><input type=\"checkbox\" name=\"reset_account[]\" value=\"$data->user_id\" /></td>
              <td class=\"text-center\"><input type=\"checkbox\" name=\"delete_account[]\" value=\"$data->user_id\" /></td>
            </tr>\n";
}
?>
          </table>
        </div>
      </form>

      <br />

      <!-- backlink -->
      <a href="index.php" class="btn btn-warning btn-sm"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
      
<?php require_once("includes/footer.php"); ?>