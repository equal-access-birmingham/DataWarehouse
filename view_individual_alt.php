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
            `pstat`
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
$stmt->bind_result($patientvisitid, $currentdate, $visittype, $reasonforvisit, $pstat);
$stmt->fetch();

//Simple PHP age Calculator
//Calculate and returns age based on the date provided by the user.
//@param   date of birth('Format:yyyy-mm-dd').
//@return  age based on date of birth
function ageCalculator($dob){
  if (!empty($dob)) {
      $birthdate = new DateTime($dob);
      $today   = new DateTime('today');
      $age = $birthdate->diff($today)->y;
      return $age;
  } else {
      return 0;
  }
}

/**
 * Takes a SQL format date and outputs an American-styled date
 * @param {String} $date SQL format date
 * @return {String} The American-styled date
 */
function americanDate($date) {
    list($year, $month, $day) = explode("-", $date);
    
    // removes leading zeros!!!
    $year = ltrim($year, "0");
    $month = ltrim($month, "0");
    $day = ltrim($day, "0");
    return "$month/$day/$year";
}
?>

<!-- Building the tables with all the information and variables pulled from the database using the query statements above -->
        <h1>Clinical Summary</h1>

        <div class="row">
          <div class="col-sm-6 col-print-6">
            <h2><?php echo $fname; ?> <?php echo $lname; ?></h2>
          </div>

          <div class="col-sm-6 col-print-6">
            <h2><strong>DOB</strong>:<?php echo $dob; ?></h2>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-print-6">
            <h3>Contact Information</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Address</strong></td>
                  <td><?php echo$address_street;?>, <?php echo $city;?>, <?php echo $state;?> <?php echo $zip;?></td>
                </tr>
                <tr>
                  <td><strong>Phone Number</strong></td>
                  <td><?php echo $phone_number; ?></td>
                </tr>
                <tr>
                  <td><strong>Email</strong></td>
                  <td><?php echo $email_address; ?></td>
                </tr>
                <tr>
                  <td><strong>Home Type</strong></td>
                  <td><?php echo $hometype; ?></td>
                </tr>
                <tr>
                  <td><strong>Emergency Contact</strong></td>
                  <td><?php echo "$emergency_name ($emergencyr)"; ?></td>
                </tr>
                <tr>
                  <td><strong>Emergency Contact Phone Number</strong></td>
                  <td><?php echo $emergency_number; ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-sm-6 col-print-6">
            <h3>Demographic Information</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Age</strong></td>
                  <td><?php echo ageCalculator($dob);?></td>
                </tr>
                <tr>
                  <td><strong>Gender</strong></td>
                  <td><?php echo $gender;?></td>
                </tr>
                <tr>
                  <td><strong>Race</strong></td>
                  <td><?php echo $race; ?></td>
                </tr>
                <tr>
                  <td><strong>Ethnicity</strong></td>
                  <td><?php echo $ethnicity; ?></td>
                </tr>
                <tr>
                  <td><strong>Primary Language</strong></td>
                  <td><?php echo $language; ?></td>
                </tr>
                <tr>
                  <td><strong>Citizenship Status</strong></td>
                  <td><?php echo $citizen; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-print-6">
            <h3>Household</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Relationship Status</strong></td>
                  <td><?php echo $relationship;?></td>
                </tr>
                <tr>
                  <td><strong>Household Head</strong></td>
                  <td><?php echo $housestat; ?></td>
                </tr>
                <tr>
                  <td><strong>Number in Household</strong></td>
                  <td><?php echo $numfammember; ?></td>
                </tr>
                <tr>
                  <td><strong>Number of Children in Household</strong></td>
                  <td><?php echo $numchildren; ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-sm-6 col-print-6">
            <h3>Financial Status</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Monthly Income</strong></td>
                  <td><?php echo $householdincome;?></td>
                </tr>
                <tr>
                  <td><strong>Employment Status</strong></td>
                  <td><?php echo $employment;?></td>
                </tr>
                <tr>
                  <td><strong>Disability</strong></td>
                  <td><?php echo $disability; ?></td>
                </tr>
                <tr>
                  <td><strong>SNAP (Foodstamps)</strong></td>
                  <td><?php echo $foodstamp; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-print-6">
            <h3>Healthcare Access</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Insurance</strong></td>
                  <td><?php echo $insurance;?></td>
                </tr>
                <tr>
                  <td><strong>Primary Care Physician</strong></td>
                  <td><?php echo $physician; ?></td>
                </tr>
                <tr>
                  <td><strong>Health First Card</strong></td>
                  <td><?php echo $health_first_card; ?></td>
                </tr>
                <tr>
                  <td><strong>Method of Transportation to Clinic</strong></td>
                  <td><?php echo $transport; ?></td>
                </tr>
                <tr>
                  <td><strong>Method of Hearing about EAB</strong></td>
                  <td><?php echo $heareab; ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-sm-6 col-print-6">
            <h3>Education</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Highest Education Level</strong></td>
                  <td><?php echo $education;?></td>
                </tr>
                <tr>
                  <td><strong>Veteran Status</strong></td>
                  <td><?php echo $veteran;?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-print-6">
            <h3>Smoking, Alcohol, and Recreational Drugs</h3>
            <table class="table table-striped table-condensed">
              <tbody>

<?php 
$packyears = (date("Y") - explode('-',$startdate)[0]) * $packsperday;

if ($pastsmokerid == "" && $currentsmokerid == "") {
?>

                <tr>
                  <td><strong>Smoking Status</strong></td>
                  <td>Non-Smoker</td>
                </tr>

<?php } else if ($currentsmokerid != "") { ?>

                <tr>
                  <td><strong>Smoking Status</strong></td>
                  <td>Current Smoker</td>
                </tr>
                <tr>
                  <td><strong>Packs per Day</strong></td>
                  <td><?php echo $packsperday; ?></td>
                </tr>
                <tr>
                  <td><strong>Smoking Start Date</strong></td>
                  <td><?php echo $startdate; ?></td>
                </tr>
                <tr>
                  <td><strong>Smoking Pack Years</strong></td>
                  <td><?php echo $packyears; ?></td>
                </tr>

<?php } else if ($pastsmokerid != "") { ?>

                <tr>
                  <td><strong>Smoking Status</strong></td>
                  <td>Past Smoker</td>
                </tr>
                <tr>
                  <td><strong>Packs per Day</strong></td>
                  <td><?php echo $packsperday; ?></td>
                </tr>
                <tr>
                  <td><strong>Smoking Start Date</strong></td>
                  <td><?php echo $startdate; ?></td>
                </tr>
                <tr>
                  <td><strong>Smoking Quit Date</strong></td>
                  <td><?php echo $quitdate; ?></td>
                </tr>
                <tr>
                  <td><strong>Smoking Pack Years</strong></td>
                  <td><?php echo $packyears; ?></td>
                </tr>

<?php } ?>

                <tr>
                  <td><strong>Alcohol Consumption Frequency</strong></td>
                  <td><?php echo $alcohol; ?></td>
                </tr>
                <tr>
                  <td><strong>Recreational Drugs Used</strong></td>
                  <td>
                    <ul class="list-unstyled">

<?php while ($stmt_drugs->fetch()) { ?>
                      <li><?php echo $drugtype; ?></li>
<?php } ?>
                    </ul>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-sm-6 col-print-6">
            <h3>Education</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Highest Education Level</strong></td>
                  <td><?php echo $education; ?></td>
                </tr>
                <tr>
                  <td><strong>Veteran Status</strong></td>
                  <td><?php echo $veteran; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-print-6">
            <h3>Health History and Maintenance</h3>
            <table class="table table-striped table-condensed">
              <tbody>
                <tr>
                  <td><strong>Allergies</strong></td>
                  <td>
                    <ul class="list-unstyled">

<?php while ($stmt_allerg->fetch()) { ?>
                      <li><?php echo $allergylist;?></li>
<?php } ?>

                    </ul>
                  </td>
                </tr>
                <tr>
                  <td><strong>Date of Last Mammogram</strong></td>
                  <td><?php echo americanDate($mammogram); ?></td>
                </tr>
                <tr>
                  <td><strong>Date of Last Colonoscopy</strong></td>
                  <td><?php echo americanDate($colonoscopy); ?></td>
                </tr>
                <tr>
                  <td><strong>Date of Last Pap Smear</strong></td>
                  <td><?php echo americanDate($papsmear); ?></td>
                </tr>
                <tr>
                  <td><strong>Date of Last STI Test</strong></td>
                  <td><?php echo americanDate($sti); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <h3>Previous Visits</h3>
        <table class="table table-striped table-condensed">
          <thead>
            <tr>
              <th>Visit Date</th>
              <th>Visit Type</th>
              <th>Visit Reason</th>
              <th>Chief Complaint</th>
            </tr>
          </thead>
          <tbody>

<?php while ($stmt->fetch()) { ?>

            <tr>
              <td><?php echo $currentdate; ?></td>
              <td><?php echo $visittype; ?></td>
              <td><?php echo $reasonforvisit; ?></td>
              <td><?php echo $pstat; ?></td>
            </tr>

<?php } ?>

          </tbody>
        </table>


<?php
$stmt->close();
$con->close();
?>

<?php require_once("includes/footer.php"); ?>
</body>
</html>





