<?php include("includes/header_require_login.php"); ?>
    <title>Patients' Most Recent Mammogram Date</title>
<?php require_once("includes/menu.php"); ?>
    <p> <a href="download_mammogram.php" target="_blank"> Download Mammogram Data as CSV File</a> </p>


<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`, `Mammogram`.`mammogram`
            FROM `Patient`
            INNER JOIN `Mammogram`
            ON `Patient`.`patientid` = `Mammogram`.`patientid`;";
             
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $mammogram);
?>
    <h1>EAB Patients' Most Recent Mammogram Date</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Mammogram Date</th>
      </tr>

<?php
while($stmt->fetch()) {
    echo "
      <tr>
        <td>$patientid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$dob</td>
        <td>$mammogram</td>
      </tr>\n";
 }
$stmt->close();
$con->close();
?>
  </table>
<?php require_once("includes/footer.php"); ?>





