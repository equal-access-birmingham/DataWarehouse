<?php include("includes/header_require_login.php"); ?>

    <title>Patient Demographics</title>
        
<?php require_once("includes/menu.php"); ?>


<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `PrimaryLanguage_add`.`patientid`, `PrimaryLanguage_add`.`fname`, `PrimaryLanguage_add`.`lname`, `PrimaryLanguage_add`.`dob`, `PrimaryLanguage_add`.`address_street`, `PrimaryLanguage_add`.`city`, `PrimaryLanguage_add`.`state`, `PrimaryLanguage_add`.`zip`, `PrimaryLanguage_add`.`phone_number`, `PrimaryLanguage_add`.`email_address`, `PrimaryLanguage_add`.`emergency_name`, `EmergencyR`.`emergencyr`, `PrimaryLanguage_add`.`emergency_number`, `PrimaryLanguage_add`.`gender`, `PrimaryLanguage_add`.`race`, `PrimaryLanguage_add`.`ethnicity`, `PrimaryLanguage_add`.`language`, `PrimaryLanguage_add`.`citizen`
FROM (
  SELECT `CitizenStatus_add`.`patientid`, `CitizenStatus_add`.`fname`, `CitizenStatus_add`.`lname`, `CitizenStatus_add`.`emergency_name`, `CitizenStatus_add`.`emergency_number`, `CitizenStatus_add`.`emergencyrid`,  `CitizenStatus_add`.`dob`, `CitizenStatus_add`.`address_street`, `CitizenStatus_add`.`city`, `CitizenStatus_add`.`state`, `CitizenStatus_add`.`zip`, `CitizenStatus_add`.`phone_number`, `CitizenStatus_add`.`email_address`, `CitizenStatus_add`.`gender`, `CitizenStatus_add`.`race`, `CitizenStatus_add`.`ethnicity`, `PrimaryLanguage`.`language`, `CitizenStatus_add`.`citizen`  
      FROM (
        SELECT `CitizenStatus`.`citizen`, `Zip_add`.`patientid`, `Zip_add`.`fname`, `Zip_add`.`lname`, `Zip_add`.`emergency_name`, `Zip_add`.`emergency_number`, `Zip_add`.`emergencyrid`,  `Zip_add`.`dob`, `Zip_add`.`address_street`, `Zip_add`.`phone_number`, `Zip_add`.`email_address`, `Zip_add`.`citizenid`, `Zip_add`.`languageid`, `Zip_add`.`gender`, `Zip_add`.`race`, `Zip_add`.`ethnicity`, `Zip_add`.`city`, `Zip_add`.`state`, `Zip_add`.`zip`   
          FROM (
            SELECT `Zip`.`zip`, `State_add`.`patientid`, `State_add`.`fname`, `State_add`.`lname`, `State_add`.`emergency_name`, `State_add`.`emergency_number`, `State_add`.`emergencyrid`,  `State_add`.`dob`, `State_add`.`address_street`, `State_add`.`zipid`, `State_add`.`phone_number`, `State_add`.`email_address`, `State_add`.`citizenid`, `State_add`.`languageid`, `State_add`.`gender`, `State_add`.`race`, `State_add`.`ethnicity`, `State_add`.`city`, `State_add`.`state` 
              FROM (
                SELECT `State`.`state`, `City_add`.`patientid`,`City_add`.`fname`, `City_add`.`lname`, `City_add`.`emergency_name`, `City_add`.`emergency_number`, `City_add`.`emergencyrid`,  `City_add`.`dob`, `City_add`.`address_street`, `City_add`.`stateid`, `City_add`.`zipid`, `City_add`.`phone_number`, `City_add`.`email_address`, `City_add`.`citizenid`, `City_add`.`languageid`, `City_add`.`gender`, `City_add`.`race`, `City_add`.`ethnicity`, `City_add`.`city` 
                  FROM (
                    SELECT `City`.`city`, `Ethnicity_add`.`patientid`, `Ethnicity_add`.`fname`, `Ethnicity_add`.`lname`, `Ethnicity_add`.`emergency_name`, `Ethnicity_add`.`emergency_number`, `Ethnicity_add`.`emergencyrid`,  `Ethnicity_add`.`dob`, `Ethnicity_add`.`address_street`, `Ethnicity_add`.`cityid`, `Ethnicity_add`.`stateid`, `Ethnicity_add`.`zipid`, `Ethnicity_add`.`phone_number`, `Ethnicity_add`.`email_address`, `Ethnicity_add`.`citizenid`, `Ethnicity_add`.`languageid`, `Ethnicity_add`.`gender`, `Ethnicity_add`.`race`, `Ethnicity_add`.`ethnicity`
                      FROM (
                        SELECT `Ethnicity`.`ethnicity`, `Race_add`.`patientid`, `Race_add`.`fname`, `Race_add`.`lname`, `Race_add`.`emergency_name`, `Race_add`.`emergency_number`, `Race_add`.`emergencyrid`,  `Race_add`.`ethnicityid`, `Race_add`.`dob`, `Race_add`.`address_street`, `Race_add`.`cityid`, `Race_add`.`stateid`, `Race_add`.`zipid`, `Race_add`.`phone_number`, `Race_add`.`email_address`, `Race_add`.`citizenid`, `Race_add`.`languageid`, `Race_add`.`gender`, `Race_add`.`race`
                          FROM (
                            SELECT `Race`.`race`, `Gender_add`.`patientid`, `Gender_add`.`fname`, `Gender_add`.`lname`, `Gender_add`.`emergency_name`, `Gender_add`.`emergency_number`, `Gender_add`.`emergencyrid`,  `Gender_add`.`raceid`, `Gender_add`.`ethnicityid`, `Gender_add`.`dob`, `Gender_add`.`address_street`, `Gender_add`.`cityid`, `Gender_add`.`stateid`, `Gender_add`.`zipid`, `Gender_add`.`phone_number`, `Gender_add`. `email_address`, `Gender_add`.`citizenid`, `Gender_add`.`languageid`, `Gender_add`.`gender` 
                              FROM (
                                  SELECT `Gender`.`gender`, `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`emergency_name`, `Patient`.`emergency_number`, `Patient`.`emergencyrid`, `Patient`.`genderid`, `Patient`.`raceid`, `Patient`.`ethnicityid`, `Patient`.`dob`, `Patient`.`address_street`, `Patient`.`cityid`, `Patient`.`stateid`, `Patient`.`zipid`, `Patient`.`phone_number`, `Patient`.`email_address`, `Patient`.`citizenid`,`Patient`.`languageid`
                                    FROM `Patient`
                                      LEFT JOIN `Gender`
                                      ON `Patient`.`genderid` = `Gender`.`genderid`
                                ) AS `Gender_add`
                                LEFT JOIN `Race`
                                ON `Gender_add`.`raceid` = `Race`.`raceid`
                            ) AS `Race_add`
                            LEFT JOIN `Ethnicity`
                            ON `Race_add`.`ethnicityid` = `Ethnicity`.`ethnicityid`
                      ) AS `Ethnicity_add`
                      LEFT JOIN `City`
                      ON `Ethnicity_add`.`cityid` = `City`.`cityid`
                  ) AS `City_add`
                  LEFT JOIN `State`
                  ON `City_add`.`stateid` = `State`.`stateid`
              ) AS `State_add`
              LEFT JOIN `Zip`
              ON `State_add`.`zipid` = `Zip`.`zipid`
          ) AS `Zip_add`
          LEFT JOIN `CitizenStatus`
          ON `Zip_add`.`citizenid` = `CitizenStatus`.`citizenid`
      ) AS `CitizenStatus_add`
      LEFT JOIN `PrimaryLanguage`
      ON `CitizenStatus_add`.`languageid` = `PrimaryLanguage`.`languageid`
  ) AS `PrimaryLanguage_add`
  LEFT JOIN `EmergencyR`
  ON `PrimaryLanguage_add`.`emergencyrid` = `EmergencyR`.`emergencyrid`;";

$stmt = $con->prepare($query) or die("error: " . $con->error);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $address_street, $city, $state, $zip, $phone_number, $email_address, $emergency_name, $emergencyr, $emergency_number, $gender, $race, $ethnicity, $language, $citizen);
?>
    <h1>EAB Patient Demographics</h1>
    <p> <a href="download_patientdemographics.php" target="_blank" class="btn btn-primary download-data-btn"> Download Patient Demographics Data as CSV File </a>

    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th class="text-center">Patient ID</th>
          <th class="text-center">First Name</th>
          <th class="text-center">Last Name</th>
          <th class="text-center">Date of Birth</th>
          <th class="text-center">Street Address</th>
          <th class="text-center">City</th>
          <th class="text-center">State</th>
          <th class="text-center">Zip</th>
          <th class="text-center">Phone Number</th>
          <th class="text-center">Email Address</th>
          <th class="text-center">Emergency Contact Name</th>
          <th class="text-center">Emergency Contact Relationship</th>
          <th class="text-center">Emergency Contact Phone Number</th>
          <th class="text-center">Gender</th>
          <th class="text-center">Race</th>
          <th class="text-center">Ethnicity</th>
          <th class="text-center">Language Spoken</th>
          <th class="text-center">Citizen</th>
        </tr>

<?php
while($stmt->fetch()) {
    echo "
        <tr>
          <td class=\"text-center\">$patientid</td>
          <td class=\"text-center\">$fname</td>
          <td class=\"text-center\">$lname</td>
          <td class=\"text-center\">$dob</td>
          <td class=\"text-center\">$address_street</td>
          <td class=\"text-center\">$city</td>
          <td class=\"text-center\">$state</td>
          <td class=\"text-center\">$zip</td>
          <td class=\"text-center\">$phone_number</td>
          <td class=\"text-center\">$email_address</td>
          <td class=\"text-center\">$emergency_name</td>
          <td class=\"text-center\">$emergencyr</td>
          <td class=\"text-center\">$emergency_number</td>
          <td class=\"text-center\">$gender</td>
          <td class=\"text-center\">$race</td>
          <td class=\"text-center\">$ethnicity</td>
          <td class=\"text-center\">$language</td>
          <td class=\"text-center\">$citizen</td>
        </tr>\n";
}
$stmt->close();
$con->close();
?>
    </table>
  </div>

<?php require_once("includes/footer.php"); ?>





