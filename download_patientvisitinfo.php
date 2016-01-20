<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$filename = "eabdbw_patientvisitinfo" . date('Ymd') . ".csv";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

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
$result = $stmt->get_result();

$first_row = true;
while ($row = $result->fetch_assoc()) {
	if ($first_row) {
		echo implode (",", array_keys($row)) . "\r\n";
		$first_row = false;
	}

	//$row = array_walk ($row, "cleanData"); //This CleanData function was part of the original code we began to use but commented it out because it caused errors.
	echo implode(",", array_values($row)) . "\r\n";

}
?>







