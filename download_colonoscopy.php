<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$filename = "eabdbw_colonoscopy" . date('Ymd') . ".csv";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`, `Colonoscopy`.`colonoscopy`
            FROM `Patient`
            LEFT JOIN `Colonoscopy`
            ON `Patient`.`patientid` = `Colonoscopy`.`patientid`;";
             
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





