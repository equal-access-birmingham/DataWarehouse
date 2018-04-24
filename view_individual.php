<!-- This page produces all the information relevant to an individual patient once they are searched for in the Returning Patient Tab (select_patient.php) -->

<?php require_once("includes/header_require_login.php"); ?>

    <title>Equal Access Birmingham</title>

<?php require_once("includes/menu.php"); ?>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$patientid = $_GET['patientid'];

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

//Joins all the subtables into the Patient Table. This produces all the demographic and contact informatio for patients.
$query = "SELECT
              `Patient`.`fname`,
              `Patient`.`lname`,
              `Patient`.`dob`,
              `Patient`.`address_street`,
              `City`.`city`,
              `State`.`state`,
              `Zip`.`zip`,
              `Patient`.`phone_number`,
              `Patient`.`email_address`,
              `Patient`.`emergency_name`,
              `EmergencyR`.`emergencyr`,
              `Patient`.`emergency_number`,
              `Gender`.`gender`,
              `Race`.`race`,
              `Ethnicity`.`ethnicity`,
              `PrimaryLanguage`.`language`,
              `CitizenStatus`.`citizen`
          FROM
              `Patient`
                LEFT JOIN
              `Gender` USING (`genderid`)
                  LEFT JOIN
              `Race` USING (`raceid`)
                  LEFT JOIN
              `Ethnicity` USING (`ethnicityid`)
                  LEFT JOIN
              `City` USING (`cityid`)
                  LEFT JOIN
              `State` USING (`stateid`)
                  LEFT JOIN
              `Zip` USING (`zipid`)
                  LEFT JOIN
              `CitizenStatus` USING (`citizenid`)
                  LEFT JOIN
              `PrimaryLanguage` USING (`languageid`)
                  LEFT JOIN
              `EmergencyR` USING (`emergencyrid`)
          WHERE `Patient`.`patientid` = ?;";

$stmt_demog = $con->prepare($query) or die("error: " . $con->error);
$stmt_demog->bind_param("s", $patientid) or die($con->error);
$stmt_demog->execute();
$stmt_demog->store_result();
$stmt_demog->bind_result($fname, $lname, $dob, $address_street, $city, $state, $zip, $phone_number, $email_address, $emergency_name, $emergencyr, $emergency_number, $gender, $race, $ethnicity, $language, $citizen);
$stmt_demog->fetch();

//This joins the SocialHistory Table and its foreign key subtables into the Patient Table. Adds social history information to the patient information.
//With multiple statements being run, you need to rename each statement accordingly. For instance, stmt_demog stands for the demographics information statement.
//stmt->store_result(); is necessary to include here because of the code we include farther down for the Visit Information table.
$query = "SELECT
              `SocialHistory`.`sid`,
              `SocialHistory`.`householdincome`,
              `SocialHistory`.`numchildren`,
              `SocialHistory`.`numfammember`,
              `SocialHistory`.`heareab`,
              `CooperGreen`.`cooper`,
              `PrimaryPhysician`.`physician`,
              `EducationLevel`.`education`,
              `HeadofHousehold`.`housestat`,
              `MedicalInsurance`.`insurance`,
              `Disability`.`disability`,
              `Veteran`.`veteran`,
              `CurrentEmployment`.`employment`,
              `RelationshipStatus`.`relationship`,
              `Alcohol`.`alcohol`,
              `FoodStamp`.`foodstamp`,
              `HomeType`. `hometype`,
              `Transport`.`transport`  
          FROM
              `Patient`
                LEFT JOIN
              `SocialHistory` USING (`patientid`)
                LEFT JOIN
              `CooperGreen` USING (`cooperid`)
                LEFT JOIN
              `PrimaryPhysician` USING (`physicianid`)
                LEFT JOIN
              `EducationLevel` USING (`educationid`)
                LEFT JOIN
              `HeadofHousehold` USING (`housestatid`)
                LEFT JOIN
              `MedicalInsurance` USING (`insuranceid`)
                LEFT JOIN
              `Disability` USING (`disabilityid`)
                LEFT JOIN
              `Veteran` USING (`veteranid`)
                LEFT JOIN
              `CurrentEmployment` USING (`employmentid`)
                LEFT JOIN
              `RelationshipStatus` USING (`relationshipid`)
                LEFT JOIN
              `Alcohol` USING (`alcoholid`)
                LEFT JOIN
              `FoodStamp` USING (`foodstampid`)
                LEFT JOIN
              `HomeType` USING (`hometypeid`)
                LEFT JOIN
              `Transport` USING (`transportid`)
          WHERE `Patient`.`patientid` = ?;";

$stmt_social = $con->prepare($query) or die("error: " . $con->error);
$stmt_social->bind_param("s", $patientid) or die($con->error);
$stmt_social->execute();
$stmt_social->store_result();
$stmt_social->bind_result($sid, $householdincome, $numchildren, $numfammember, $heareab, $health_first_card, $physician, $education, $housestat, $insurance, $disability, $veteran, $employment, $relationship, $alcohol, $foodstamp, $hometype, $transport);
$stmt_social->fetch();

//Joins Mammogram Table.
$query = "SELECT `Mammogram`.`mammogram`
            FROM `Patient`
            LEFT JOIN `Mammogram`
            ON `Patient`.`patientid` = `Mammogram`.`patientid`
            WHERE `Patient`.`patientid` = ?;";

$stmt_mam = $con->prepare($query) or die("error: " . $con->error);
$stmt_mam->bind_param("s", $patientid) or die($con->error);
$stmt_mam->execute();
$stmt_mam->store_result();
$stmt_mam->bind_result($mammogram);
$stmt_mam->fetch();

//Joins PapSmear Table
$query = "SELECT `PapSmear`.`papsmear`
            FROM `Patient`
            LEFT JOIN `PapSmear`
            ON `Patient`.`patientid` = `PapSmear`.`patientid`
            WHERE `Patient`.`patientid` = ?;";

$stmt_pap = $con->prepare($query) or die("error: " . $con->error);
$stmt_pap->bind_param("s", $patientid) or die($con->error);
$stmt_pap->execute();
$stmt_pap->store_result();
$stmt_pap->bind_result($papsmear);
$stmt_pap->fetch();

//Joins Colonoscopy Table
$query = "SELECT `Colonoscopy`.`colonoscopy`
            FROM `Patient`
            LEFT JOIN `Colonoscopy`
            ON `Patient`.`patientid` = `Colonoscopy`.`patientid`
            WHERE `Patient`.`patientid` = ?;";

$stmt_col = $con->prepare($query) or die("error: " . $con->error);
$stmt_col->bind_param("s", $patientid) or die($con->error);
$stmt_col->execute();
$stmt_col->store_result();
$stmt_col->bind_result($colonoscopy);
$stmt_col->fetch();

//Joins STI Table
$query = "SELECT `STI`.`sti`
            FROM `Patient`
            LEFT JOIN `STI`
            ON `Patient`.`patientid` = `STI`.`patientid`
            WHERE `Patient`.`patientid` = ?;";

$stmt_sti = $con->prepare($query) or die("error: " . $con->error);
$stmt_sti->bind_param("s", $patientid) or die($con->error);
$stmt_sti->execute();
$stmt_sti->store_result();
$stmt_sti->bind_result($sti);
$stmt_sti->fetch();

//Joins PatientAllergy Table and subtables. Adds the information about patient allergies.
$query = "SELECT
            `allergylistid`,
            `patientallergyid`,
            `allergylist`
        FROM
            `Patient`
                LEFT JOIN
            `PatientAllergy` USING (`patientid`)
                LEFT JOIN
            `AllergyList` USING (`allergylistid`)
        WHERE `Patient`.`patientid` = ?;";

$stmt_allerg = $con->prepare($query) or die("error: " . $con->error);
$stmt_allerg->bind_param("s", $patientid) or die($con->error);
$stmt_allerg->execute();
$stmt_allerg->store_result();
$stmt_allerg->bind_result($allergylistid, $patientallergyid, $allergylist);

//Joins SocialDrugs Table and subtables. Adds the information about patient illicit drug use.
$query = "SELECT
            `socialdrugsid`,
            `drugtypeid`,
            `drugtype`
        FROM
            `SocialHistory`
                LEFT JOIN
            `SocialDrugs` USING (`sid`)
                LEFT JOIN
            `DrugType` USING (`drugtypeid`)
        WHERE `SocialHistory`.`patientid` = ?;";

$stmt_drugs = $con->prepare($query) or die("error: " . $con->error);
$stmt_drugs->bind_param("s", $patientid) or die($con->error);
$stmt_drugs->execute();
$stmt_drugs->store_result();
$stmt_drugs->bind_result($socialdrugsid, $drugtypeid, $drugtype);

//Joins CurrentSmoker Table. Adds information about current smokers.
$query = "SELECT `CurrentSmoker`.`currentsmokerid`, `CurrentSmoker`.`startdate`, `CurrentSmoker`.`packsperday`
            FROM `SocialHistory`
            INNER JOIN `CurrentSmoker`
            ON `SocialHistory`.`sid` = `CurrentSmoker`.`sid`
            WHERE `SocialHistory`.`patientid` = ?;";

$stmt_csmoke = $con->prepare($query) or die("error: " . $con->error);
$stmt_csmoke->bind_param("s", $patientid) or die($con->error);
$stmt_csmoke->execute();
$stmt_csmoke->store_result();
$stmt_csmoke->bind_result($currentsmokerid, $startdate, $packsperday);

//Joins PastSmoker Table. Adds information about past smokers.
$query = "SELECT `PastSmoker`.`pastsmokerid`, `PastSmoker`.`startdate`, `PastSmoker`.`quitdate`, `PastSmoker`.`packsperday`
            FROM `SocialHistory`
            INNER JOIN `PastSmoker`
            ON `SocialHistory`.`sid` = `PastSmoker`.`sid`
            WHERE `SocialHistory`.`patientid` = ?;";

$stmt_psmoke = $con->prepare($query) or die("error: " . $con->error);
$stmt_psmoke->bind_param("s", $patientid) or die($con->error);
$stmt_psmoke->execute();
$stmt_psmoke->store_result();
$stmt_psmoke->bind_result($pastsmokerid, $startdate, $quitdate, $packsperday);
$stmt_csmoke->fetch() or $stmt_psmoke->fetch();

//Joins the PatientVisit Table and subtables. Adds the information about patient visit number and type. 
$query = "SELECT
            `patientvisitid`,
            `currentdate`,
            `visittype`,
            `reasonforvisit`,
            `pstat`,
            `socialservicesneeded`
        FROM
            `Patient`
                LEFT JOIN
            `PatientVisit` USING (`patientid`)
                LEFT JOIN
            `VisitType` USING (`visittypeid`)
                LEFT JOIN
            `ReasonforVisit` USING (`reasonforvisitid`)
        WHERE `Patient`.`patientid` = ?
        ORDER BY `PatientVisit`.`currentdate` DESC;";

$stmt = $con->prepare($query) or die("error: " . $con->error);
$stmt->bind_param("s", $patientid) or die($con->error);
$stmt->execute();
$stmt->bind_result($patientvisitid, $currentdate, $visittype, $reasonforvisit, $pstat, $socialservicesneeded);
$stmt->fetch();
?>


    <!-- Building the tables with all the information and variables pulled from the database using the query statements above -->
    <h1><?php echo "$fname";?> <?php echo "$lname";?></h1>

<?php
if ($socialservicesneeded && (new DateTime('now'))->diff(new DateTime($currentdate))->format("%a") == 0) {
    echo "    <p style=\"color: red\"><strong>Social services requested today</strong></p>";
}
?>

    <p><b><u>Demographic and Contact Information</b></u></p>
    <table class="table-bordered table-striped table-condensed">
      <tr>
        <td><b>Date of Birth:</b></td>
        <td><?php echo"$dob";?></td>
        <td><b>Current Age:</b></td>
        <td>
<?php
//Simple PHP age Calculator
//Calculate and returns age based on the date provided by the user.
//@param   date of birth('Format:yyyy-mm-dd').
//@return  age based on date of birth
function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}
echo ageCalculator($dob);
?>
        </td>
      </tr>
      <tr>
        <td><b>Type of Home:</b></td>
        <td><?php echo"$hometype";?></td>
        <td><b>Address:</b></td>
        <td><?php echo"$address_street";?>, <?php echo"$city";?>, <?php echo"$state";?> <?php echo"$zip";?></td>
      </tr>
      <tr>
        <td><b>Phone Number:</b></td>
        <td><?php echo"$phone_number";?></td>
        <td><b>Email Address:</b></td>
        <td><?php echo"$email_address";?></td>
      </tr>
      <tr>
        <td><b>Gender:</b></td>
        <td><?php echo"$gender";?></td>
        <td><b>Race:</b></td>
        <td><?php echo"$race";?></td>
      </tr>
      <tr>
        <td><b>Ethnicity:</b></td>
        <td><?php echo"$ethnicity";?></td>
        <td><b>Primary Language Spoken:</b></td>
        <td><?php echo"$language";?></td>
      </tr>
      <tr>
        <td><b>Citizenship Status:</b></td>
        <td><?php echo"$citizen";?></td>
        <td><b>How Heard about EAB:<b></td>
        <td><?php echo"$heareab";?></td>
      </tr>
      <tr>
        <td><b>Emergency Contact:</b></td>
        <td><?php echo"$emergency_name";?> (<?php echo"$emergencyr";?>)</td>
        <td><b>Emergency Contact Phone Number:</b></td>
        <td><?php echo"$emergency_number";?></td>
      </tr>
    </table></br>

      <p><b><u>Social Information</b></u></p>
    <table class="table-bordered table-striped table-condensed">   
      <tr>
        <td><b>Head of one's household?</b></td>
        <td><?php echo"$housestat";?></td>
        <td><b>Relationship Status:</b></td>
        <td><?php echo"$relationship";?></td>
      </tr>
      <tr>
        <td><b>Employed or not?</b></td>
        <td><?php echo"$employment";?></td>
        <td><b>Total Monthly Household Income (in U.S. dollars $):</b></td>
        <td><?php echo"$householdincome";?></td>
      </tr>
      <tr>
        <td><b>Number of People in Household including Oneself:</b></td>
        <td><?php echo"$numfammember";?></td>
        <td><b>Number of Children in Household under 18:</b></td>
        <td><?php echo"$numchildren";?></td>
      </tr>
      <tr>
        <td><b>Have insurance?</b></td>
        <td><?php echo"$insurance";?></td>
        <td><b>Health First Card?</b></td>
        <td><?php echo"$health_first_card";?></td>
      </tr>
      <tr>
        <td><b>Have a primary care provider?</b></td>
        <td><?php echo"$physician";?></td>
        <td><b>U.S. Military Veteran or not?</b></td>
        <td><?php echo"$veteran";?></td>
      </tr>
      <tr>
        <td><b>On disability?</b></td>
        <td><?php echo"$disability";?></td>
        <td><b>Receiving Foodstamps or not?</b></td>
        <td><?php echo"$foodstamp";?></td>
      </tr>
      <tr>
        <td><b>Highest Level of Education Achieved:</b></td>
        <td><?php echo"$education";?></td>
        <td><b>Method of Transport to Clinic:</b></td>
        <td><?php echo"$transport";?></td>
      </tr>
      <tr>
        <td><b>How often drink alcohol:</b></td>
        <td><?php echo"$alcohol";?></td>
        <td><b>Current and Past Drug Use:</b></td>
        <td>
          <ul class="list-unstyled">
<?php
while ($stmt_drugs->fetch()) {
    echo "          <li>$drugtype</li>\n";
}
?>
          </ul>
        </td>
      </tr>
<?php
if ($pastsmokerid == "") {$pastsmokerid == null;}
if ($currentsmokerid == "") {$currentsmokerid == null;}
if ($currentsmokerid == null && $pastsmokerid == null){ 
?>
	  <tr>
	    <td><b>Smoking Status:</b></td>
		<td>Non-Smoker</td>
	  </tr>
	</table>
	
<?php 
	}
elseif ($currentsmokerid != null) {
$packyears = (date("Y") - explode('-',$startdate)[0]) * $packsperday
?>
	  <tr>
	    <td><b>Smoking Tobacco Status:</b></td>
		<td>Current Smoker</td>
		<td><b>Packs per Day:</b></td>
		<td><?php echo $packsperday; ?></td>
	  </tr>
	  <tr>
	    <td><b>Smoking Start Date:</b></td>
		<td><?php echo $startdate; ?></td>
	    <td><b>Smoking PackYears:</b></td>
		<td><?php echo $packyears; ?></td>
	  </tr>
	</table> 
<?php
	}
elseif ($pastsmokerid != null){
$packyears = (explode('-',$quitdate)[0] - explode('-',$startdate)[0]) * $packsperday;
?>
	  <tr>
	    <td><b>Smoking Tobacco Status:</b></td>
		<td>Past Smoker</td>
		<td><b>Packs per Day:</b></td>
		<td><?php echo $packsperday; ?></td>
	  </tr>
	  <tr>
	    <td><b>Smoking Start Date:</b></td>
		<td><?php echo $startdate; ?></td>
	    <td><b>Smoking Quit Date:</b></td>
		<td><?php echo $quitdate; ?></td>
	  </tr>
	  <tr>
	    <td><b>Smoking PackYears:</b></td>
		<td><?php echo $packyears; ?></td>
	  </tr>
	</table>
<?php
	}
?>
<!-- Steve insert smoking php magic here -->
    </table></br>

      <p><b><u>Health Screenings and Maintenance</b></u></p>
    <table class="table-bordered table-striped table-condensed">   
      <tr>
        <td><b>Date of Last Mammogram:</b></td>
        <td><?php echo"$mammogram";?></td>
        <td><b>Date of Last Pap Smear:</b></td>
        <td><?php echo"$papsmear";?></td>
      </tr>
      <tr>
        <td><b>Date of Last Colonoscopy:</b></td>
        <td><?php echo"$colonoscopy";?></td>
        <td><b>Date of Last STI Test:</b></td>
        <td><?php echo"$sti";?></td>
      </tr>
    </table></br>

      <p><b><u>Medical Information</b></u></p>
    <table class="table-bordered table-striped table-condensed">  
      <tr>
        <td><b>Allergies:</b></td>
        <td>
          <ul class="list-unstyled">
<?php
while ($stmt_allerg->fetch()) {
    echo "          <li>$allergylist</li>\n";
}
?>
          </ul>
        </td>
      </tr>
  </table></br>

      <p><b><u>Visit Information</b></u></p>
    <table class="table table-bordered table-striped table-condensed">
      <tr>
        <th>Date of Visit</th>
        <th>Visit Type</th>
        <th>Reason for Visit</th>
        <th>Chief Complaint</th>
      </tr>

<?php

$visit_number = 1;

do {

    echo "
      <tr>
        <td>$currentdate</td>
        <td>$visittype</td>
        <td>$reasonforvisit</td>
        <td>$pstat</td>
      </tr>\n";

    $visit_number++;

} while($stmt->fetch());
// This do while loop allows the visit number column to be generated. The visits are already recorded sequentially and ordered by date in SQL query above. Creating the variable $visit_number and using the loop lets us add actualy visit numbers since the first initial visit.
?>

</table>

<?php
$stmt->close();
$con->close();
?>

<?php require_once("includes/footer.php"); ?>
  </body>
</html>





