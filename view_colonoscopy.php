<?php include("includes/header_require_login.php"); ?>
    <title>Submitted Responses to EAB New Patient Intake Form: Date of Last Colonoscopy</title>
<?php require_once("includes/menu.php"); ?>
    <p>Please View and Check Responses to the Intake Form: Date of Last Colonoscopy</p>
    <p> <a href="download_colonoscopy.php" target="_blank"> Download Colonoscopy Data as CSV File</a> </p>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`, `Colonoscopy`.`colonoscopy`
            FROM `Patient`
            INNER JOIN `Colonoscopy`
            ON `Patient`.`patientid` = `Colonoscopy`.`patientid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $colonoscopy);
?>
    <h1>EAB Patients List: Date of Last Colonoscopy</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Date of Last Colonoscopy</th>
      </tr>

<?php
while($stmt->fetch()) {
    echo "
      <tr>
        <td>$patientid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$dob</td>
        <td>$colonoscopy</td>
      </tr>\n";
 }
$stmt->close();
$con->close();
?>
  </table>
<?php require_once("includes/footer.php"); ?>





