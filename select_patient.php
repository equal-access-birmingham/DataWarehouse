<?php
// error_reporting(E_ALL);
// ini_set("display_errors",1);

require("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->connect_error);

$fname = $_GET['fname'];
$lname = $_GET['lname'];
$dob = $_GET['dob_year'] . "-" . $_GET['dob_month'] . "-" . $_GET['dob_day'];

$query = "SELECT `patientid`, `fname`, `lname`, `dob` FROM `Patient` WHERE `fname` LIKE ? AND `lname` LIKE ?";

// Add dob selection criteria to query if present
// if (!empty($_GET['dob_year']) && !empty($_GET['dob_month']) && !empty($_GET['dob_day'])) {
//     $query .= " AND `dob` = ?;";
// }

$fname_query = $fname. "%";
$lname_query = $lname. "%";

$query_params = array();
$query_params[] = &$fname_query;
$query_params[] = &$lname_query;
if (! empty($_GET['dob_year'])) {
    $query .= " AND YEAR(`dob`) = ?";
    $query_params[] = &$_GET['dob_year'];
}

if (! empty($_GET['dob_month'])) {
    $query .= " AND MONTH(`dob`) = ?";
    $query_params[] = &$_GET['dob_month'];
}

if (! empty($_GET['dob_day'])) {
    $query .= " AND DAY(`dob`) = ?";
    $query_params[] = &$_GET['dob_day'];
}

$stmt = $con->prepare($query);

$bind_params = array_merge(array(str_repeat('s', count($query_params))), $query_params);
call_user_func_array(array(&$stmt, 'bind_param'), $bind_params);

$stmt->execute();
$stmt->bind_result($patient_id, $fname_display, $lname_display, $dob_display);

?>
<?php include("includes/header_require_login.php"); ?>

    <title>Equal Access Birmingham</title>

<?php require_once("includes/menu.php"); ?>

    <h1>Patient Search</h1>
    <p>Please search for a patient by either first name, last name, date of birth, or all 3.</p>

    <form method="get" autocomplete="off">
      <div class="form-group">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname" class="form-control"/>
      </div>

      <div class="form-group">
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" class="form-control" />
      </div>

      <div class="form-group">
        <label>Date of Birth</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="dob_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
//Array of Months
$month_array = array(
  1 =>"January",
  2 =>"February",
  3 =>"March",
  4 =>"April",
  5 =>"May",
  6 =>"June",
  7 =>"July",
  8 =>"August",
  9 =>"September",
  10 =>"October",
  11 =>"November",
  12 =>"December",
);
for ($month = 1; $month < 13; $month++) {
    echo "              <option value=\"$month\"";
    if ($_GET['dob_month'] == $month){echo "selected";}
    echo ">$month_array[$month]</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="dob_day" class="form-control">
              <option value="">-- Day --</option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "              <option value=\"$day\"";
  if ($_GET['dob_day'] == $day){echo "selected";}
  echo ">$day</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="dob_year" class="form-control">
              <option value="">-- Year --</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
    echo "              <option value=\"$year\"";
    if ($_GET['dob_year'] == $year){echo "selected";}
    echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-success" name="submit" value="Search" />
      </div>
    </form>


<?php
if (isset($_GET['submit'])) {
    echo "
    <table class=\"table table-hover table-striped\">
      <tr>
        <th class=\"text-center\">First Name</th>
        <th class=\"text-center\">Last Name</th>
        <th class=\"text-center\">Date of Birth</th>
        <th>Action</th>
      </tr>\n";

    while ($stmt->fetch()) {
        echo "      <tr>
        <td class=\"text-center\">$fname_display</td>
        <td class=\"text-center\">$lname_display</td>
        <td class=\"text-center\">$dob_display</td>
        <td>
          <a href=\"editpatientform.php?patientid=$patient_id\" class=\"btn btn-primary\">Returning Patient Form</a>
          <a href=\"view_individual.php?patientid=$patient_id\" class=\"btn btn-info\">Clinical Summary</a>
          <a href=\"social_services_summary.php?patientid=$patient_id\" class=\"btn btn-success\">Social Services Summary</a>
        </td>
      </tr>\n";
    }
    echo "
    </table>";
}


?>

<?php require_once('includes/footer.php'); ?>