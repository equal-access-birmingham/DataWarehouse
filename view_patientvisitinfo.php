<?php include("includes/header_require_login.php"); ?>
    <title>Patient Visit Information</title>
<?php require_once("includes/menu.php"); ?>

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
                          LEFT JOIN `Patient`
                          ON `PatientVisit`.`patientid` = `Patient`.`patientid`
                      ) AS `Patient_add`
                      LEFT JOIN `VisitType`
                      ON `Patient_add`.`visittypeid` = `VisitType`.`visittypeid`
              ) AS `VisitType_add`
              LEFT JOIN `ReasonforVisit`
              ON `VisitType_add`.`reasonforvisitid` = `ReasonforVisit`.`reasonforvisitid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $patientvisitid, $currentdate, $visittype, $reasonforvisit, $pstat);
?>
    <h1>EAB Patient Visit Information</h1>
    <p> <a href="download_patientvisitinfo.php" target="_blank" class="btn btn-primary download-data-btn"> Download Patient Visit Information as CSV File</a> </p>

    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th class="text-center">Patient ID</th>
          <th class="text-center">First Name</th>
          <th class="text-center">Last Name</th>
          <th class="text-center">Date of Birth</th>
          <th class="text-center">Patient Visit ID</th>
          <th class="text-center">Date of Visit</th>
          <th class="text-center">Visit Type</th>
          <th class="text-center">Reason for Visit</th>
          <th class="text-center">Chief Complaint</th>
        </tr>

<?php
while($stmt->fetch()) {
    echo "
        <tr>
          <td class=\"text-center\">$patientid</td>
          <td class=\"text-center\">$fname</td>
          <td class=\"text-center\">$lname</td>
          <td class=\"text-center\">$dob</td>
          <td class=\"text-center\">$patientvisitid</td>
          <td class=\"text-center\">$currentdate</td>
          <td class=\"text-center\">$visittype</td>
          <td class=\"text-center\">$reasonforvisit</td>
          <td class=\"text-center\">$pstat</td>
        </tr>\n";
 }
$stmt->close();
$con->close();
?>
    </table>
  </div>
<?php require_once("includes/footer.php"); ?>





