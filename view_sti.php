<?php include("includes/header_require_login.php"); ?>

    <title>Patients' Most Recent STI Testing Date</title>

<?php require_once("includes/menu.php"); ?>

    <p><a href="download_sti.php" target="_blank" class="btn btn-primary">Download STI Data as CSV File</a></p>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`, `STI`.`sti`
            FROM `Patient`
            LEFT JOIN `STI`
            ON `Patient`.`patientid` = `STI`.`patientid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $sti);
?>
    <h1>EAB Patients' Most Recent STI Testing Date</h1>
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th class="text-center">Patient ID</th>
          <th class="text-center">First Name</th>
          <th class="text-center">Last Name</th>
          <th class="text-center">Date of Birth</th>
          <th class="text-center">Date of Last Known Sexual Transmitted Infection</th>
        </tr>

<?php
while($stmt->fetch()) {
    echo "
        <tr>
          <td class=\"text-center\">$patientid</td>
          <td class=\"text-center\">$fname</td>
          <td class=\"text-center\">$lname</td>
          <td class=\"text-center\">$dob</td>
          <td class=\"text-center\">$sti</td>
        </tr>\n";
 }
$stmt->close();
$con->close();
?>
    </table>
  </div>
<?php require_once("includes/footer.php"); ?>




