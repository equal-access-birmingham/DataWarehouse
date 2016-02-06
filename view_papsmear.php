<?php include("includes/header_require_login.php"); ?>

    <title>Patients' Most Recent Pap Smear Date</title>

<?php require_once("includes/menu.php"); ?>

    <p> <a href="download_papsmear.php" target="_blank"> Download Pap Smear Data as CSV File</a> </p>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`, `PapSmear`.`papsmear`
            FROM `Patient`
            LEFT JOIN `PapSmear`
            ON `Patient`.`patientid` = `PapSmear`.`patientid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $papsmear);
?>
    <h1>EAB Patients' Most Recent Pap Smear Date</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Date of Last Pap Smear</th>
      </tr>

<?php
while($stmt->fetch()) {
    echo "
      <tr>
        <td>$patientid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$dob</td>
        <td>$papsmear</td>
      </tr>\n";
 }
$stmt->close();
$con->close();
?>
  </table>
<?php require_once("includes/footer.php"); ?>




