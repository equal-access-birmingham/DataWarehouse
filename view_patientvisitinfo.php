<?php include("includes/header_require_login.php"); ?>
    <title>Patient Visit Information</title>
<?php require_once("includes/menu.php"); ?>
    <p> <a href="download_patientvisitinfo.php" target="_blank"> Download Patient Visit Information as CSV File</a> </p>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `VisitType_add`.`patientid`, `VisitType_add`.`fname`, `VisitType_add`.`lname`, `VisitType_add`.`dob`,`VisitType_add`.`patientvisitid`, `VisitType_add`.`currentdate`, `VisitType_add`.`visittype`, `ReasonforVisit`.`reasonforvisit`, `VisitType_add`.`pstat` 
              FROM (
                  SELECT `VisitType`.`visittype`, `Patient_add`.`patientid`, `Patient_add`.`fname`, `Patient_add`.`lname`, `Patient_add`.`dob`,`Patient_add`.`patientvisitid`, `Patient_add`.`pstat`, `Patient_add`.`currentdate`, `Patient_add`.`reasonforvisitid`, `Patient_add`.`visittypeid` 
                      FROM (
                          SELECT `PatientVisit`.`patientid`, `PatientVisit`.`patientvisitid`, `PatientVisit`.`pstat`, `PatientVisit`.`currentdate`, `PatientVisit`.`reasonforvisitid`, `PatientVisit`.`visittypeid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`
                          FROM `PatientVisit`
                          INNER JOIN `Patient`
                          ON `PatientVisit`.`patientid` = `Patient`.`patientid`
                      ) AS `Patient_add`
                      INNER JOIN `VisitType`
                      ON `Patient_add`.`visittypeid` = `VisitType`.`visittypeid`
              ) AS `VisitType_add`
              INNER JOIN `ReasonforVisit`
              ON `VisitType_add`.`reasonforvisitid` = `ReasonforVisit`.`reasonforvisitid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $patientvisitid, $currentdate, $visittype, $reasonforvisit, $pstat);
?>
    <h1>EAB Patient Visit Information</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Patient Visit ID</th>
        <th>Date of Visit</th>
        <th>Visit Type</th>
        <th>Reason for Visit</th>
        <th>Chief Complaint</th>
      </tr>

<?php
while($stmt->fetch()) {
    echo "
      <tr>
        <td>$patientid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$dob</td>
        <td>$patientvisitid</td>
        <td>$currentdate</td>
        <td>$visittype</td>
        <td>$reasonforvisit</td>
        <td>$pstat</td>
      </tr>\n";
 }
$stmt->close();
$con->close();
?>
  </table>
<?php require_once("includes/footer.php"); ?>





