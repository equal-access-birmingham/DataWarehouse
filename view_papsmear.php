<html>
  <head>
    <title>Submitted Responses to EAB New Patient Intake Form: Date of Last Pap Smear</title>
  </head>
  <body>
    <p>Please View and Check Responses to the Intake Form: Date of Last Pap Smear</p>
    <p> <a href="download_papsmear.php" target="_blank"> Download Pap Smear Data as CSV File</a> </p>
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("referencefiles/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`, `PapSmear`.`papsmear`
            FROM `Patient`
            INNER JOIN `PapSmear`
            ON `Patient`.`patientid` = `PapSmear`.`patientid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $papsmear);
?>
    <h1>EAB Patients List: Date of Last Pap Smear</h1>
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





