<html>
  <head>
  	<title>Submitted Responses to EAB New Patient Intake Form</title>
  </head>
  <body>
  	<p>Please View and Check Responses to the Intake Form</p>
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("referencefiles/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `PapSmear`.`papsmear`, `Colonoscopy_add`.`patientid`, `Colonoscopy_add`.`fname`, `Colonoscopy_add`.`lname`, `Colonoscopy_add`.`dob`, `Colonoscopy_add`.`address_street`, `Colonoscopy_add`.`phone_number`, `Colonoscopy_add`.`email_address`, `Colonoscopy_add`.`gender`, `Colonoscopy_add`.`race`, `Colonoscopy_add`.`ethnicity`, `Colonoscopy_add`.`city`, `Colonoscopy_add`.`state`,`Colonoscopy_add`.`zip`, `Colonoscopy_add`.`citizen`, `Colonoscopy_add`.`language`,`Colonoscopy_add`.`mammogram`, `Colonoscopy_add`.`sti`, `Colonoscopy_add`.`colonoscopy`
          FROM (
            SELECT `Colonoscopy`.`colonoscopy`, `STI_add`.`patientid`, `STI_add`.`fname`, `STI_add`.`lname`, `STI_add`.`dob`, `STI_add`.`address_street`, `STI_add`.`phone_number`, `STI_add`.`email_address`, `STI_add`.`gender`, `STI_add`.`race`, `STI_add`.`ethnicity`, `STI_add`.`city`, `STI_add`.`state`,`STI_add`.`zip`, `STI_add`.`citizen`, `STI_add`.`language`,`STI_add`.`mammogram`, `STI_add`.`sti`
              FROM (
                SELECT `STI`.`sti`, `Mammogram_add`.`patientid`,  `Mammogram_add`.`fname`,  `Mammogram_add`.`lname`,  `Mammogram_add`.`dob`,  `Mammogram_add`.`address_street`,  `Mammogram_add`.`phone_number`,  `Mammogram_add`.`email_address`,  `Mammogram_add`.`gender`,  `Mammogram_add`.`race`,  `Mammogram_add`.`ethnicity`,  `Mammogram_add`.`city`,  `Mammogram_add`.`state`, `Mammogram_add`.`zip`,  `Mammogram_add`.`citizen`,  `Mammogram_add`.`language`, `Mammogram_add`.`mammogram`
                  FROM (
                      SELECT `Mammogram`.`mammogram`, `PrimaryLanguage_add`.`patientid`,  `PrimaryLanguage_add`.`fname`,  `PrimaryLanguage_add`.`lname`,  `PrimaryLanguage_add`.`dob`,  `PrimaryLanguage_add`.`address_street`,  `PrimaryLanguage_add`.`phone_number`,  `PrimaryLanguage_add`.`email_address`,  `PrimaryLanguage_add`.`gender`,  `PrimaryLanguage_add`.`race`,  `PrimaryLanguage_add`.`ethnicity`,  `PrimaryLanguage_add`.`city`,  `PrimaryLanguage_add`.`state`, `PrimaryLanguage_add`.`zip`,  `PrimaryLanguage_add`.`citizen`,  `PrimaryLanguage_add`.`language`      
                          FROM (
                            SELECT `PrimaryLanguage`.`language`, `CitizenStatus_add`.`patientid`, `CitizenStatus_add`.`fname`, `CitizenStatus_add`.`lname`, `CitizenStatus_add`.`dob`, `CitizenStatus_add`.`address_street`, `CitizenStatus_add`.`phone_number`, `CitizenStatus_add`.`email_address`, `CitizenStatus_add`.`gender`, `CitizenStatus_add`.`race`, `CitizenStatus_add`.`ethnicity`, `CitizenStatus_add`.`city`, `CitizenStatus_add`.`state`, `CitizenStatus_add`.`zip`, `CitizenStatus_add`.`citizen`  
                          FROM (
                            SELECT `CitizenStatus`.`citizen`, `Zip_add`.`patientid`, `Zip_add`.`fname`, `Zip_add`.`lname`, `Zip_add`.`dob`, `Zip_add`.`address_street`, `Zip_add`.`phone_number`, `Zip_add`.`email_address`, `Zip_add`.`citizenid`, `Zip_add`.`languageid`, `Zip_add`.`gender`, `Zip_add`.`race`, `Zip_add`.`ethnicity`, `Zip_add`.`city`, `Zip_add`.`state`, `Zip_add`.`zip`   
                              FROM (
                                SELECT `Zip`.`zip`, `State_add`.`patientid`, `State_add`.`fname`, `State_add`.`lname`, `State_add`.`dob`, `State_add`.`address_street`, `State_add`.`zipid`, `State_add`.`phone_number`, `State_add`.`email_address`, `State_add`.`citizenid`, `State_add`.`languageid`, `State_add`.`gender`, `State_add`.`race`, `State_add`.`ethnicity`, `State_add`.`city`, `State_add`.`state` 
                                  FROM (
                                    SELECT `State`.`state`, `City_add`.`patientid`,`City_add`.`fname`, `City_add`.`lname`, `City_add`.`dob`, `City_add`.`address_street`, `City_add`.`stateid`, `City_add`.`zipid`, `City_add`.`phone_number`, `City_add`.`email_address`, `City_add`.`citizenid`, `City_add`.`languageid`, `City_add`.`gender`, `City_add`.`race`, `City_add`.`ethnicity`, `City_add`.`city` 
                                      FROM (
                                        SELECT `City`.`city`, `Ethnicity_add`.`patientid`, `Ethnicity_add`.`fname`, `Ethnicity_add`.`lname`, `Ethnicity_add`.`dob`, `Ethnicity_add`.`address_street`, `Ethnicity_add`.`cityid`, `Ethnicity_add`.`stateid`, `Ethnicity_add`.`zipid`, `Ethnicity_add`.`phone_number`, `Ethnicity_add`.`email_address`, `Ethnicity_add`.`citizenid`, `Ethnicity_add`.`languageid`, `Ethnicity_add`.`gender`, `Ethnicity_add`.`race`, `Ethnicity_add`.`ethnicity`
                                          FROM (
                                            SELECT `Ethnicity`.`ethnicity`, `Race_add`.`patientid`, `Race_add`.`fname`, `Race_add`.`lname`, `Race_add`.`ethnicityid`, `Race_add`.`dob`, `Race_add`.`address_street`, `Race_add`.`cityid`, `Race_add`.`stateid`, `Race_add`.`zipid`, `Race_add`.`phone_number`, `Race_add`.`email_address`, `Race_add`.`citizenid`, `Race_add`.`languageid`, `Race_add`.`gender`, `Race_add`.`race`
                                              FROM (
                                                SELECT `Race`.`race`, `Gender_add`.`patientid`, `Gender_add`.`fname`, `Gender_add`.`lname`, `Gender_add`.`raceid`, `Gender_add`.`ethnicityid`, `Gender_add`.`dob`, `Gender_add`.`address_street`, `Gender_add`.`cityid`, `Gender_add`.`stateid`, `Gender_add`.`zipid`, `Gender_add`.`phone_number`, `Gender_add`. `email_address`, `Gender_add`.`citizenid`, `Gender_add`.`languageid`, `Gender_add`.`gender` 
                                                  FROM (
                                                      SELECT `Gender`.`gender`, `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`genderid`, `Patient`.`raceid`, `Patient`.`ethnicityid`, `Patient`.`dob`, `Patient`.`address_street`, `Patient`.`cityid`, `Patient`.`stateid`, `Patient`.`zipid`, `Patient`.`phone_number`, `Patient`.`email_address`, `Patient`.`citizenid`,`Patient`.`languageid`
                                                        FROM `Patient`
                                                          INNER JOIN `Gender`
                                                          ON `Patient`.`genderid` = `Gender`.`genderid`
                                                    ) AS `Gender_add`
                                                    INNER JOIN `Race`
                                                    ON `Gender_add`.`raceid` = `Race`.`raceid`
                                                ) AS `Race_add`
                                                INNER JOIN `Ethnicity`
                                                ON `Race_add`.`ethnicityid` = `Ethnicity`.`ethnicityid`
                                          ) AS `Ethnicity_add`
                                          INNER JOIN `City`
                                          ON `Ethnicity_add`.`cityid` = `City`.`cityid`
                                      ) AS `City_add`
                                      INNER JOIN `State`
                                      ON `City_add`.`stateid` = `State`.`stateid`
                                  ) AS `State_add`
                                  INNER JOIN `Zip`
                                  ON `State_add`.`zipid` = `Zip`.`zipid`
                              ) AS `Zip_add`
                              INNER JOIN `CitizenStatus`
                              ON `Zip_add`.`citizenid` = `CitizenStatus`.`citizenid`
                          ) AS `CitizenStatus_add`
                          INNER JOIN `PrimaryLanguage`
                          ON `CitizenStatus_add`.`languageid` = `PrimaryLanguage`.`languageid`
                            ) AS `PrimaryLanguage_add`
                            Inner JOIN `Mammogram`
                            ON `PrimaryLanguage_add`.`patientid` = `Mammogram`.`patientid`
                            ) AS `Mammogram_add`
                      INNER JOIN `STI`
                      ON `Mammogram_add`.`patientid` = `STI`.`patientid`
                                        ) AS `STI_add`
                    INNER JOIN `Colonoscopy`
                    ON `STI_add`.`patientid` = `Colonoscopy`.`patientid`
                                    ) AS `Colonoscopy_add`
                  INNER JOIN `PapSmear`
                  ON `Colonoscopy_add`.`patientid` = `PapSmear`.`patientid`;";

$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($papsmear, $patientid, $fname, $lname, $dob, $address_street, $phone_number, $email_address, $gender, $race, $ethnicity, $city, $state, $zip, $citizen, $language, $mammogram, $sti, $colonoscopy);
?>
    <h1>EAB Patients List</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Date of Last Pap Smear</th>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Street Address</th>
        <th>Phone Number</th>
        <th>Email Address</th>
        <th>Gender</th>
        <th>Race</th>
        <th>Ethnicity</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Citizenship Status</th>
        <th>Language Spoken</th>
        <th>Date of Last Mammogram</th>
        <th>Date of Last STI Testing</th>
        <th>Date of Last Colonoscopy</th>
      </tr>

<?php
while($stmt->fetch()) {
    echo "
      <tr>
        <td>$papsmear</td>
        <td>$patientid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$dob</td>
        <td>$address_street</td>
        <td>$phone_number</td>
        <td>$email_address</td>
        <td>$gender</td>
        <td>$race</td>
        <td>$ethnicity</td>
        <td>$city</td>
        <td>$state</td>
        <td>$zip</td>
        <td>$citizen</td>
        <td>$language</td>
        <td>$mammogram</td>
        <td>$sti</td>
        <td>$colonoscopy</td>
      </tr>\n";
 }
$stmt->close();
$con->close();
?>
	</table>





