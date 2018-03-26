<?php
// error_reporting(E_ALL);
// ini_set("display_errors",1);

require("includes/db.php");

// Grab HTTP GET parameter
$patientid = $_GET['patientid'];

// Very different connection compared to everything else in this system, but a preferred connection type
try {
    $con = new PDO("mysql:dbname=$db_db;host=$host",$db_user, $db_pass) or die("Error: " . $con->connect_error);
} catch (PDOExeption $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Query to get all unique information regarding patient at once
$query = "SELECT
            `fname`,
            `lname`,
            `dob`,
            `gender`,
            `race`,
            `ethnicity`,
            `language`,
            `education`,
            `veteran`,
            `relationship`,
            `housestat`,
            `numfammember`,
            `numchildren`,
            `householdincome`,
            `employment`,
            `disability`,
            `foodstamp`,
            `alcohol`,
            `insurance`,
            `cooper`
        FROM
            `Patient`
                INNER JOIN
            `SocialHistory` USING (`patientid`)
                INNER JOIN
            `Gender` USING (`genderid`)
                INNER JOIN
            `Race` USING (`raceid`)
                INNER JOIN
            `Ethnicity` USING (`ethnicityid`)
                INNER JOIN
            `PrimaryLanguage` USING (`languageid`)
                INNER JOIN
            `EducationLevel` USING (`educationid`)
                INNER JOIN
            `Veteran` USING(`veteranid`)
                INNER JOIN
            `RelationshipStatus` USING (`relationshipid`)
                INNER JOIN
            `HeadofHousehold` USING (`housestatid`)
                INNER JOIN
            `CurrentEmployment` USING (`employmentid`)
                INNER JOIN
            `Disability` USING (`disabilityid`)
                INNER JOIN
            `FoodStamp` USING (`foodstampid`)
                INNER JOIN
            `Alcohol` USING (`alcoholid`)
                INNER JOIN
            `MedicalInsurance` USING (`insuranceid`)
                INNER JOIN
    	    `CooperGreen` USING (`cooperid`)
        WHERE `patientid` = :patientid;";

$stmt_patient_info = $con->prepare($query);
$stmt_patient_info->bindParam(":patientid", $patientid);
$stmt_patient_info->execute();
$patient_info = $stmt_patient_info->fetchObject();

// Query to get smoking information
$query = "SELECT
            `fname`,
            `lname`,
            `currentsmokerid`,
            `CurrentSmoker`.`startdate` as `CurrentSmokerStartDate`,
            `CurrentSmoker`.`packsperday` as `CurrentSmokerPacksPerDay`,
            `pastsmokerid`,
            `PastSmoker`.`startdate` as `PastSmokerStartDate`,
            `PastSmoker`.`quitdate` as `PastSmokerQuitDate`,
            `PastSmoker`.`packsperday` as `PastSmokerPacksPerDay`
        FROM
            `Patient`
                INNER JOIN
            `SocialHistory` USING (`patientid`)
                LEFT JOIN
            `CurrentSmoker` USING (`sid`)
                LEFT JOIN
            `PastSmoker` USING (`sid`)
        WHERE `patientid` = :patientid;";

$stmt_smoking_info = $con->prepare($query);
$stmt_smoking_info->bindParam(":patientid", $patientid);
$stmt_smoking_info->execute();
$patient_smoking_info = $stmt_smoking_info->fetchObject();

// Query to retrieve the drug information for a patient
$query = "SELECT
            `drugtype`
        FROM
            `Patient`
                INNER JOIN
            `SocialHistory` USING (`patientid`)
                INNER JOIN
            `SocialDrugs` USING (`sid`)
                INNER JOIN
            `DrugType` USING (`drugtypeid`)
        WHERE `patientid` = :patientid;";
    
$stmt_drug_info = $con->prepare($query);
$stmt_drug_info->bindParam(":patientid", $patientid);
$stmt_drug_info->execute();
// since there might be multiple drugs returned, fetching is done in the UI section below

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


/** 
 * TODO
 * health first card
 */
?>

<?php include("includes/header_require_login.php"); ?>

    <title>Equal Access Birmingham</title>

<?php require_once("includes/menu.php"); ?>

      <h1>Social Services Summary</h1>
      <div class="row">
        <div class="col-xs-6">
          <h2><?php echo $patient_info->fname . " " . $patient_info->lname; ?></h2>
        </div>
        
        <div class="col-xs-6">
          <h2><strong>DOB</strong>: <?php echo $patient_info->dob; ?></h2>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-print-6">
          <h3>Patient Demographics</h3>

          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Gender</strong></td>
                <td><?php echo $patient_info->gender; ?></td>
              </tr>
              <tr>
                <td><strong>Race</strong></td>
                <td><?php echo $patient_info->race; ?></td>
              </tr>
              <tr>
                <td><strong>Ethnicity</strong></td>
                <td><?php echo $patient_info->ethnicity; ?></td>
              </tr>
              <tr>
                <td><strong>Language</strong></td>
                <td><?php echo $patient_info->language; ?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-6 col-print-6">
          <h3>Education</h3>
          <table class="table table-striped table-condensed">
            <tr>
              <td><strong>Highest Degree</strong></td>
              <td><?php echo $patient_info->education; ?></td>
            </tr>
            <tr>
              <td><strong>Veteran</strong></td>
              <td><?php echo $patient_info->veteran; ?></td>
            </tr>
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
                <td><?php echo $patient_info->relationship; ?></td>
              </tr>
              <tr>
                <td><strong>Household Head</strong></td>
                <td><?php echo $patient_info->housestat; ?></td>
              </tr>
              <tr>
                <td><strong>Number in Household</strong></td>
                <td><?php echo $patient_info->numfammember; ?></td>
              </tr>
              <tr>
                <td><strong>Number of Children in Household</strong></td>
                <td><?php echo $patient_info->numchildren; ?></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-6 col-print-6">
          <h3>Financial Status</h3>

          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Income</strong></td>
                <td><?php echo $patient_info->householdincome; ?></td>
              </tr>
              <tr>
                <td><strong>Employment Status</strong></td>
                <td><?php echo $patient_info->employment; ?></td>
              </tr>
              <tr>
                <td><strong>Disability</strong></td>
                <td><?php echo $patient_info->disability; ?></td>
              </tr>
              <tr>
                <td><strong>SNAP (Foodstamps)</strong></td>
                <td><?php echo $patient_info->foodstamp; ?></td>
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

<?php if ($patient_smoking_info->currentsmokerid == null && $patient_smoking_info->pastsmokerid == null) { ?>

              <tr>
                <td><strong>Smoking Status</strong></td>
                <td>Non-Smoker</td>
              </tr>

<?php
} else if ($patient_smoking_info->currentsmokerid != null) {
    $pack_years = $patient_smoking_info->CurrentSmokerPacksPerDay * ((new DateTime('now'))->diff(new DateTime($patient_smoking_info->CurrentSmokerStartDate))->format('%y'));
?>
              <tr>
                <td><strong>Smoking Status</strong></td>
                <td>Current Smoker</td>
              </tr>
              <tr>
                <td><strong>Smoking Start Date</strong></td>
                <td><?php echo americanDate($patient_smoking_info->CurrentSmokerStartDate); ?></td>
              </tr>
              <tr>
                <td><strong>Packs per Day</strong></td>
                <td><?php echo $patient_smoking_info->CurrentSmokerPacksPerDay; ?></td>
              </tr>
              <tr>
                <td><strong>Pack Years</strong></td>
                <td><?php echo $pack_years; ?></td>
              </tr>

<?php
} else if ($patient_smoking_info->pastsmokerid != null) {
    $pack_years = $patient_smoking_info->PastSmokerPacksPerDay * ((new DateTime($patient_smoking_info->PastSmokerQuitDate))->diff(new DateTime($patient_smoking_info->PastSmokerStartDate))->format('%y'));    
?>

              <tr>
                <td><strong>Smoking Status</strong></td>
                <td>Past Smoker</td>
              </tr>
              <tr>
                <td><strong>Smoking Start Date</strong></td>
                <td><?php echo americanDate($patient_smoking_info->PastSmokerStartDate); ?></td>
              </tr>
              <tr>
                <td><strong>Packs per Day</strong></td>
                <td><?php echo $patient_smoking_info->PastSmokerPacksPerDay; ?></td>
              </tr>
              <tr>
                <td><strong>Smoking Quit Date</strong></td>
                <td><?php echo americanDate($patient_smoking_info->PastSmokerQuitDate); ?></td>
              </tr>
              <tr>
                <td><strong>Pack Years</strong></td>
                <td><?php echo $pack_years; ?></td>
              </tr>

<?php } ?>

              <tr>
                <td><strong>Amount of Alcohol Consumption</strong></td>
                <td><?php echo $patient_info->alcohol; ?></td>
              </tr>
              <tr>
                <td><strong>Recreational Drug Use</strong></td>
                <td>
                  <ul class="list-unstyled">

<?php while ($patient_drug_info = $stmt_drug_info->fetchObject()) { ?>

                    <li><?php echo $patient_drug_info->drugtype; ?></li>

<?php } ?>

                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-6 col-print-6">
          <h3>Healthcare Access</h3>

          <table class="table table-striped table-condensed">
            <tbody>
              <tr>
                <td><strong>Health Insurance</strong></td>
                <td><?php echo $patient_info->insurance; ?></td>
              </tr>
              <tr>
                <td><strong>Health First Card</strong></td>
                <td><?php echo $patient_info->cooper; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
        
      <div class="social-service-note"></div>
      <h3>Social Services Note (<?php echo (new DateTime("now"))->format("m/d/Y"); ?>)</h3>
      <p>Patient's primary health care location:</p>
      <form class="form-inline">
        <div class="row">
          <div class="col-xs-3">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Cooper Green
              </label>
            </div>
          </div>
          <div class="col-xs-3">
            <div class="checkbox">
              <label>
                <input type="checkbox"> UAB Charity care
              </label>
            </div>
          </div>
          <div class="col-xs-3">
            <div class="checkbox">
              <label>
                <input type="checkbox"> St. Vincent’s
              </label>
            </div>
          </div>
          <div class="col-xs-3">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Cahaba Valley
              </label>
            </div>
          </div>
        </div>
      </form>


<?php require_once("includes/footer.php"); ?>