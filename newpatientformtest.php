<?php
//error_reporting(E_ALL);
//ini_set("display_errors",1);

require("referencefiles/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db);
require("referencefiles/VariableQuery.php");
?>

<?php require_once("referencefiles/header.php"); ?>

    <title>EAB Database</title>

<?php require_once("referencefiles/menu.php"); ?>

<?php 
if (isset($_GET['submit'])) {
    
$query = "SELECT `city` from `City` WHERE (`cityid`) = (?);";
$stmt_getcity = $con->prepare($query);
$stmt_getcity->bind_param("s", $_GET['cityid']);
$stmt_getcity->execute();
$stmt_getcity->store_result();
$stmt_getcity->bind_result($city);
$stmt_getcity->fetch();
$stmt_getcity->close();

$query = "SELECT `state` from `State` WHERE (`stateid`) = (?);";
$stmt_getstate = $con->prepare($query);
$stmt_getstate->bind_param("s", $_GET['stateid']);
$stmt_getstate->execute();
$stmt_getstate->store_result();
$stmt_getstate->bind_result($state);
$stmt_getstate->fetch();
$stmt_getstate->close();

$query = "SELECT `zip` from `Zip` WHERE (`zipid`) = (?);";
$stmt_getzip = $con->prepare($query);
$stmt_getzip->bind_param("s", $_GET['zipid']);
$stmt_getzip->execute();
$stmt_getzip->store_result();
$stmt_getzip->bind_result($zip);
$stmt_getzip->fetch();
$stmt_getzip->close();

$query = "SELECT `ethnicity` from `Ethnicity` WHERE (`ethnicityid`) = (?);";
$stmt_getethnicity = $con->prepare($query);
$stmt_getethnicity->bind_param("s", $_GET['ethnicityid']);
$stmt_getethnicity->execute();
$stmt_getethnicity->store_result();
$stmt_getethnicity->bind_result($ethnicity);
$stmt_getethnicity->fetch();
$stmt_getethnicity->close();

$query = "SELECT `gender` from `Gender` WHERE (`genderid`) = (?);";
$stmt_getgender = $con->prepare($query);
$stmt_getgender->bind_param("s", $_GET['genderid']);
$stmt_getgender->execute();
$stmt_getgender->store_result();
$stmt_getgender->bind_result($gender);
$stmt_getgender->fetch();
$stmt_getgender->close();

$query = "SELECT `race` from `Race` WHERE (`raceid`) = (?);";
$stmt_getrace = $con->prepare($query);
$stmt_getrace->bind_param("s", $_GET['raceid']);
$stmt_getrace->execute();
$stmt_getrace->store_result();
$stmt_getrace->bind_result($race);
$stmt_getrace->fetch();
$stmt_getrace->close();

$query = "SELECT `language` from `PrimaryLanguage` WHERE (`languageid`) = (?);";
$stmt_getlanguage = $con->prepare($query);
$stmt_getlanguage->bind_param("s", $_GET['languageid']);
$stmt_getlanguage->execute();
$stmt_getlanguage->store_result();
$stmt_getlanguage->bind_result($language);
$stmt_getlanguage->fetch();
$stmt_getlanguage->close();

$query = "SELECT `citizen` from `CitizenStatus` WHERE (`citizenid`) = (?);";
$stmt_getcitizen = $con->prepare($query);
$stmt_getcitizen->bind_param("s", $_GET['citizenid']);
$stmt_getcitizen->execute();
$stmt_getcitizen->store_result();
$stmt_getcitizen->bind_result($citizen);
$stmt_getcitizen->fetch();
$stmt_getcitizen->close();

$query = "SELECT `cooper` from `CooperGreen` WHERE (`cooperid`) = (?);";
$stmt_getcooper = $con->prepare($query);
$stmt_getcooper->bind_param("s", $_GET['cooperid']);
$stmt_getcooper->execute();
$stmt_getcooper->store_result();
$stmt_getcooper->bind_result($cooper);
$stmt_getcooper->fetch();
$stmt_getcooper->close();

$query = "SELECT `employment` from `CurrentEmployment` WHERE (`employmentid`) = (?);";
$stmt_getemployment = $con->prepare($query);
$stmt_getemployment->bind_param("s", $_GET['employmentid']);
$stmt_getemployment->execute();
$stmt_getemployment->store_result();
$stmt_getemployment->bind_result($employment);
$stmt_getemployment->fetch();
$stmt_getemployment->close();

$query = "SELECT `physician` from `PrimaryPhysician` WHERE (`physicianid`) = (?);";
$stmt_getphysician = $con->prepare($query);
$stmt_getphysician->bind_param("s", $_GET['physicianid']);
$stmt_getphysician->execute();
$stmt_getphysician->store_result();
$stmt_getphysician->bind_result($physician);
$stmt_getphysician->fetch();
$stmt_getphysician->close();

$query = "SELECT `education` from `EducationLevel` WHERE (`educationid`) = (?);";
$stmt_geteducation = $con->prepare($query);
$stmt_geteducation->bind_param("s", $_GET['educationid']);
$stmt_geteducation->execute();
$stmt_geteducation->store_result();
$stmt_geteducation->bind_result($education);
$stmt_geteducation->fetch();
$stmt_geteducation->close();

$query = "SELECT `housestat` from `HeadofHousehold` WHERE (`housestatid`) = (?);";
$stmt_gethousestat = $con->prepare($query);
$stmt_gethousestat->bind_param("s", $_GET['housestatid']);
$stmt_gethousestat->execute();
$stmt_gethousestat->store_result();
$stmt_gethousestat->bind_result($housestat);
$stmt_gethousestat->fetch();
$stmt_gethousestat->close();

$query = "SELECT `insurance` from `MedicalInsurance` WHERE (`insuranceid`) = (?);";
$stmt_getinsurance = $con->prepare($query);
$stmt_getinsurance->bind_param("s", $_GET['insuranceid']);
$stmt_getinsurance->execute();
$stmt_getinsurance->store_result();
$stmt_getinsurance->bind_result($insurance);
$stmt_getinsurance->fetch();
$stmt_getinsurance->close();

$query = "SELECT `disability` from `Disability` WHERE (`disabilityid`) = (?);";
$stmt_getdisability = $con->prepare($query);
$stmt_getdisability->bind_param("s", $_GET['disabilityid']);
$stmt_getdisability->execute();
$stmt_getdisability->store_result();
$stmt_getdisability->bind_result($disability);
$stmt_getdisability->fetch();
$stmt_getdisability->close();

$query = "SELECT `state` from `State` WHERE (`stateid`) = (?);";
$stmt_getstate = $con->prepare($query);
$stmt_getstate->bind_param("s", $_GET['stateid']);
$stmt_getstate->execute();
$stmt_getstate->store_result();
$stmt_getstate->bind_result($state);
$stmt_getstate->fetch();
$stmt_getstate->close();

$query = "SELECT `veteran` from `Veteran` WHERE (`veteranid`) = (?);";
$stmt_getveteran = $con->prepare($query);
$stmt_getveteran->bind_param("s", $_GET['veteranid']);
$stmt_getveteran->execute();
$stmt_getveteran->store_result();
$stmt_getveteran->bind_result($veteran);
$stmt_getveteran->fetch();
$stmt_getveteran->close();

$query = "SELECT `hometype` from `HomeType` WHERE (`hometypeid`) = (?);";
$stmt_gethometype = $con->prepare($query);
$stmt_gethometype->bind_param("s", $_GET['hometypeid']);
$stmt_gethometype->execute();
$stmt_gethometype->store_result();
$stmt_gethometype->bind_result($hometype);
$stmt_gethometype->fetch();
$stmt_gethometype->close();

$query = "SELECT `foodstamp` from `FoodStamp` WHERE (`foodstampid`) = (?);";
$stmt_getfoodstamp = $con->prepare($query);
$stmt_getfoodstamp->bind_param("s", $_GET['foodstampid']);
$stmt_getfoodstamp->execute();
$stmt_getfoodstamp->store_result();
$stmt_getfoodstamp->bind_result($foodstamp);
$stmt_getfoodstamp->fetch();
$stmt_getfoodstamp->close();

$query = "SELECT `alcohol` from `Alcohol` WHERE (`alcoholid`) = (?);";
$stmt_getalcohol = $con->prepare($query);
$stmt_getalcohol->bind_param("s", $_GET['alcoholid']);
$stmt_getalcohol->execute();
$stmt_getalcohol->store_result();
$stmt_getalcohol->bind_result($alcohol);
$stmt_getalcohol->fetch();
$stmt_getalcohol->close();

$query = "SELECT `relationship` from `RelationshipStatus` WHERE (`relationshipid`) = (?);";
$stmt_getrelationship = $con->prepare($query);
$stmt_getrelationship->bind_param("s", $_GET['relationshipid']);
$stmt_getrelationship->execute();
$stmt_getrelationship->store_result();
$stmt_getrelationship->bind_result($relationship);
$stmt_getrelationship->fetch();
$stmt_getrelationship->close();

$query = "SELECT `transport` from `Transport` WHERE (`transportid`) = (?);";
$stmt_gettransport = $con->prepare($query);
$stmt_gettransport->bind_param("s", $_GET['transportid']);
$stmt_gettransport->execute();
$stmt_gettransport->store_result();
$stmt_gettransport->bind_result($transport);
$stmt_gettransport->fetch();
$stmt_gettransport->close();

$query = "SELECT `visittype` from `VisitType` WHERE (`visittypeid`) = (?);";
$stmt_getvisittype = $con->prepare($query);
$stmt_getvisittype->bind_param("s", $_GET['visittypeid']);
$stmt_getvisittype->execute();
$stmt_getvisittype->store_result();
$stmt_getvisittype->bind_result($visittype);
$stmt_getvisittype->fetch();
$stmt_getvisittype->close();

$query = "SELECT `reasonforvisit` from `ReasonforVisit` WHERE (`reasonforvisitid`) = (?);";
$stmt_getreasonforvisit = $con->prepare($query);
$stmt_getreasonforvisit->bind_param("s", $_GET['reasonforvisitid']);
$stmt_getreasonforvisit->execute();
$stmt_getreasonforvisit->store_result();
$stmt_getreasonforvisit->bind_result($reasonforvisit);
$stmt_getreasonforvisit->fetch();
$stmt_getreasonforvisit->close();

$drugs = $_GET['drugs'];
foreach ($drugs as $drug){
  $query = "SELECT `drugtype` from `DrugType` WHERE (`drugtypeid`) = (?);";
  $stmt_getdrug = $con->prepare($query);
  $stmt_getdrug->bind_param("s", $drug);
  $stmt_getdrug->execute();
  $stmt_getdrug->store_result();
  $stmt_getdrug->bind_result($nextdrug);
  $stmt_getdrug->fetch();
  $stmt_getdrug->close();
  $alldrugs = $alldrugs . " " . $nextdrug;
}

$allergies = $_GET['allergies'];
foreach ($allergies as $allergy){
  $query = "SELECT `allergylist` from `AllergyList` WHERE (`allergylistid`) = (?);";
  $stmt_getallergy = $con->prepare($query);
  $stmt_getallergy->bind_param("s", $allergy);
  $stmt_getallergy->execute();
  $stmt_getallergy->store_result();
  $stmt_getallergy->bind_result($nextallergy);
  $stmt_getallergy->fetch();
  $stmt_getallergy->close();
  $allallergies = $allallergies . " " . $nextallergy;
}

if ($_GET['smokingstatus'] == 1){
        $smokystats = "Never Smoked";}
elseif ($_GET['smokingstatus'] == 2){
        $smokystats = "Past Smoker for " . $_GET['packsperday'] . " years at " . $_GET['timesmoked'] . " packs per day until quitting in " . $_GET['quitdate'];}
elseif ($_GET['smokingstatus'] == 3){
        $smokystats = "Current Smoker for " . $_GET['packsperday'] . " years at " . $_GET['timesmoked'] . " packs per day";}
}
?>


<?php 
//START OF MODAL
if (isset($_GET['submit'])) {
    echo "
    <script>
$(document).ready(function() {
    $('#myModal').modal('toggle');
});
    </script>
    ";
}
?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Confirm Patient Information</h4>
          </div>
          <div class="modal-body">
<?php

echo "
            <ul>
              <li>First Name: " . $_GET['fname'] . "</li>
              <li>Last Name: " . $_GET['lname'] . "</li> 
              <li>DOB: " . $_GET['dob_month'] . "-" . $_GET['dob_day'] . "-" . $_GET['dob_year'] . "</li>
              <li>Address:" . $_GET['address_street'] . "</li>
              <li>City: $city " . $_GET['cityaddition'] . "</li>
              <li>State: $state " . $_GET['stateaddition'] . "</li>
              <li>Zip: $zip" . $_GET['zipaddition'] . "</li> 
              <li>Phone: " . $_GET['phone_number'] . "</li>
              <li>Email:" . $_GET['email_address'] . "</li>
              <li>Gender: $gender</li>
              <li>Ethnicity: $ethnicity</li>
              <li>Race: $race</li>
              <li>Language: $language " . $_GET['languageaddition'] . "</li>
              <li>Citizen Status: $citizen</li>
              <li>Type of Home$hometype</li>
              <li>Housing Status: $housestat</li>
              <li>Children: " . $_GET['numchildren'] . "</li>
              <li>Relationship Status: $relationship</li>
              <li>Income: " . $_GET['householdincome'] . "</li>
              <li>Employment:$employment</li>
              <li>Disability: $disability</li>
              <li>Foodstamps: $foodstamp</li>
              <li>Veteran: $veteran</li>
              <li>Education: $education</li>
              <li>Insurance: $insurance</li>
              <li>Physician: $physician</li>
              <li>Cooper Green:$cooper</li>
              <li>Smoking: $smokystats</li>
              <li>Alcohol: $alcohol</li>
              <li>Transportation: $transport</li>
              <li>Hear about EAB: " . $_GET['heareab'] . "</li>
              <li>Type of Visit: $visittype</li>
              <li>Reason for Visit: $reasonforvisit</li>
              <li>Last Mammogram: " . $_GET['mammogram_month'] . "-" . $_GET['mammogram_day'] . "-" . $_GET['mammogram_year'] . "</li>
              <li>Last Colonoscopy: " . $_GET['colonoscopy_month'] . "-" . $_GET['colonoscopy_day'] . "-" . $_GET['colonoscopy_year'] . "</li>
              <li>Last STI check: " . $_GET['STI_month'] . "-" . $_GET['STI_day'] . "-" . $_GET['STI_year'] . "</li>
              <li>Last PAP check" . $_GET['PAP_month'] . "-" . $_GET['PAP_day'] . "-" . $_GET['PAP_year'] . "</li>
              <li>Why you are here: " . $_GET['pstat'] . "</li>
              <li>Drugs: $alldrugs " . $_GET['drugaddition'] . "</li>
              <li>Allergies: $allallergies " . $_GET['allergyaddition'] . "</li>
            </ul>\n";
?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Edit Information</button>
<?php
$getArray = get_defined_vars();

echo "            <a href=\"newpatientform_do.php?";
foreach ($getArray['_GET'] as $getVar => $value) {
    echo "$getVar=$value&";
}
echo "\" class=\"btn btn-primary\">Submit Information</a>";
//END OF MODAL
?>
          </div>
        </div>
      </div>
    </div>
<?php    
if (isset($_GET['submit'])) {
require("referencefiles/VariableQuery.php");
}
?>
    

    




    
    <h1>EAB New Patient Intake Form</h1>
    <p> Please update your information in the form below.</p>
    <!-- Form for adding user -->
    <form method="get" >
      <label for ="fname">First Name:</label>
        <input type="text" name="fname" id ="fname" value="<?php echo $_GET['fname']; ?>" class="form-control"/>
      <label for ="lname">Last Name:</label>
        <input type="text" name="lname" id ="lname" value="<?php echo $_GET['lname']; ?>" class="form-control"/>
      <label>Date of Birth:</label>
      <div class="row">
      <div class="col-xs-4">
        <select name="dob_month" class="form-control"/>
        <option value=""></option>
<?php
//Array of Months
$month_array = array(
  1 =>"January",
  2 =>"February",
  3 =>"March",
  4 =>"April",
  5 =>"May",
  6 =>"June",
  7 =>"July",
  8 =>"August",
  9 =>"September",
  10 =>"October",
  11 =>"November",
  12 =>"December",
);
for ($month = 1; $month < 13; $month++) {
  echo "        <option value=\"$month\"";
    if ($_GET['dob_month'] == $month){echo "selected";}
  echo ">$month_array[$month]</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="dob_day" class="form-control">
        <option value=""></option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "        <option value=\"$day\"";
  if ($_GET['dob_day'] == $day){echo "selected";}
  echo ">$day</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="dob_year" class="form-control">
        <option value=""></option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "        <option value=\"$year\"";
  if ($_GET['dob_year'] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
        </select>
        </div>
        </div>
        <label>Address:</label>
        <input type="text" name="address_street" value="<?php echo $_GET['address_street']; ?>" class="form-control"/>
        <div class="row">
            <div class="col-xs-6"> 
                <label for="citybox">City:</label>
                <select name="cityid" id ="citybox" class="form-control"/>
<?php
while ($stmt_city->fetch()){        
    echo "          <option value=\"$cityid\"";
    if ($_GET['cityid'] == $cityid){echo "selected";}
    echo ">$city</option>";
}
?>
                </select>
            </div>
            <div class="col-xs-6">
                <label for="cityadditionbox">Other city not listed:</label>
                <input type="text" name="cityaddition" id="cityadditionbox" value="<?php echo $_GET['cityaddition']; ?>" class="form-control"/>
            </div>
        </div>
        <div class="row"> 
            <div class="col-xs-6">
                <label for="statebox">State:</label>
                <select name="stateid" id="statebox" class="form-control"/>
<?php
while ($stmt_state->fetch()){        
    echo "<option value=\"$stateid\"";
    if ($_GET['stateid'] == $stateid){echo "selected";}
    echo ">$state</option>";
}
?>
                </select>
            </div>
            <div class="col-xs-6">
                <label for="stateadditionbox">Other state not listed:</label>
                <input type="text" name="stateaddition" id="stateadditionbox" value="<?php echo $_GET['stateaddition']; ?>" class="form-control"/>
            </div>
            </div>
        <div class="row">
            <div class="col-xs-6">
                <label for="zipbox">Zip:</label>
                <select name="zipid" id="zipbox" class="form-control"/>
<?php
while ($stmt_zip->fetch()){        
    echo "<option value=\"$zipid\"";
    if ($_GET['zipid'] == $zipid){echo "selected";}
    echo ">$zip</option>";
}
?>
                </select>
            </div>
            <div class="col-xs-6">
                <label for="zipadditionbox">Other zip not listed:</label>
                <input type="text" name="zipaddition" id="zipadditionbox" value="<?php echo $_GET['zipaddition']; ?>" class="form-control"/>
            </div>
        </div>
        <label>Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $_GET['phone_number']; ?>" class="form-control"/>

        <label>Email:</label>
        <input type="text" name="email_address" value="<?php echo $_GET['email_address']; ?>" class="form-control"/>

        <label>Gender:</label>
        <select name="genderid" class="form-control"/>
<?php
while ($stmt_gender->fetch()){        
    echo "<option value=\"$genderid\"";
    if ($_GET['genderid'] == $genderid){echo "selected";}
    echo ">$gender</option>";
}
?>
        </select>
        <label>Ethnicity:</label>
      <select name="ethnicityid" class="form-control"/>
<?php
while ($stmt_ethnicity->fetch()){        
    echo "<option value=\"$ethnicityid\"";
    if ($_GET['ethnicityid'] == $ethnicityid){echo "selected";}
    echo ">$ethnicity</option>";
}
?>
        </select>
        <label>Race:</label>
        <select name="raceid" class="form-control"/>
<?php
while ($stmt_race->fetch()){        
    echo "<option value=\"$raceid\"";
    if ($_GET['raceid'] == $raceid){echo "selected";}
    echo ">$race</option>";
}
?>
        </select>
        <div class="row">
            <div class="col-xs-6"> 
                <label>What is your primary language?:</label>
                <select name="languageid" class="form-control"/>
<?php
while ($stmt_language->fetch()){        
    echo "<option value=\"$languageid\"";
    if ($_GET['languageid'] == $languageid){echo "selected";}
    echo ">$language</option>";
}
?>
                </select>
            </div>
            <div class="col-xs-6"> 
                <label>Other language not listed:</label>
                <input type="text" name="languageaddition" value="<?php echo $_GET['languageaddition']; ?>" class="form-control"/>
            </div>
        </div>
        <label>What is your Citizenship Status?:</label>
        <select name="citizenid" class="form-control"/>
<?php
while ($stmt_citizen->fetch()){        
    echo "<option value=\"$citizenid\"";
    if ($_GET['citizenid'] == $citizenid){echo "selected";}
    echo ">$citizen</option>";
}
?>
        </select>

      <!--Social History Here-->
        <label>What type of home do you live in?</label>
        <select name="hometypeid" class="form-control">
<?php
while ($stmt_hometype->fetch()){        
    echo "<option value=\"$hometypeid\"";
    if ($_GET['hometypeid'] == $hometypeid){echo "selected";}
    echo ">$hometype</option>";
}
?>
        </select> 
        <label>Are you the head of your household?</label>
        <select name="housestatid" class="form-control">
<?php
while ($stmt_housestat->fetch()){        
    echo "<option value=\"$housestatid\"";
    if ($_GET['housestatid'] == $housestatid){echo "selected";}
    echo ">$housestat</option>";
}
?>
        </select> 
        <label>Number of people in your household:</label>
        <select name="numfammember" class="form-control">
        <option value=""></option>
<?php
$numfammembers = array("1","2","3","4","5","6","7","8","9","10","11","12","13");
    for ($numfammember_count = 0; $numfammember_count <count($numfammembers); $numfammember_count++){
        echo"        <option value=\"$numfammembers[$numfammember_count]\"";
        if ($_GET['numfammember'] == $numfammembers[$numfammember_count]){echo "selected";}
        echo ">$numfammembers[$numfammember_count]</option>\n";
    }
?>
        </select> 
        <label>Number of children under 18 in your household:</label>
        <select name="numchildren" class="form-control">
          <option value="null"></option>
<?php
$numchildrens = array("0","1","2","3","4","5","6","7","8");
    for ($numchildren_count = 0; $numchildren_count <count($numchildrens); $numchildren_count++){
        echo"        <option value=\"$numchildrens[$numchildren_count]\"";
        if ($_GET['numchildren'] == $numchildrens[$numchildren_count]){echo "selected";}
        echo ">$numchildrens[$numchildren_count]</option>\n";
    }
?>
        </select> 
        <label>What is your relationship status?</label>
        <select name="relationshipid" class="form-control"/>
<?php
while ($stmt_relationship->fetch()){        
    echo "<option value=\"$relationshipid\"";
    if ($_GET['relationshipid'] == $relationshipid){echo "selected";}
    echo ">$relationship</option>";
}
?>
        </select> 
        <label>What is your monthly household income?</label>
        <input type="text" name="householdincome" value="<?php echo $_GET['householdincome']; ?>" class="form-control"> 
        <label>Are you currently employed?</label>
        <select name="employmentid" class="form-control"/>
<?php
while ($stmt_employment->fetch()){        
    echo "<option value=\"$employmentid\"";
    if ($_GET['employmentid'] == $employmentid){echo "selected";}
    echo ">$employment</option>";
}
?>
        </select> 
        <label>Are you on Disabilty?</label>
        <select name="disabilityid" class="form-control"/>
<?php
while ($stmt_disability->fetch()){        
    echo "<option value=\"$disabilityid\"";
    if ($_GET['disabilityid'] == $disabilityid){echo "selected";}
    echo ">$disability</option>";
}
?>
        </select> 
        <label>Are you part of the SNAP program formerly known as Foodstamps?</label>
        <select name="foodstampid" class="form-control"/>
<?php
while ($stmt_foodstamp->fetch()){        
    echo "<option value=\"$foodstampid\"";
    if ($_GET['foodstampid'] == $foodstampid){echo "selected";}
    echo ">$foodstamp</option>";
}
?>
        </select>
        <label>Are you a United States Military Veteran?</label>
        <select name="veteranid" class="form-control"/>
<?php
while ($stmt_veteran->fetch()){        
    echo "<option value=\"$veteranid\"";
    if ($_GET['veteranid'] == $veteranid){echo "selected";}
    echo ">$veteran</option>";
}
?>
        </select>
        <label>What is your highest level of education completed?</label>
        <select name="educationid" class="form-control">
<?php
while ($stmt_education->fetch()){        
    echo "<option value=\"$educationid\"";
    if ($_GET['educationid'] == $educationid){echo "selected";}
    echo ">$education</option>";
}
?>
        </select> 
        <label>Do you have health insurance?</label>
        <select name="insuranceid" class="form-control">
<?php
while ($stmt_insurance->fetch()){        
    echo "<option value=\"$insuranceid\"";
    if ($_GET['insuranceid'] == $insuranceid){echo "selected";}
    echo ">$insurance</option>";
}
?>
        </select> 
        <label>Do you have a primary care physican?</label>
        <select name="physicianid" class="form-control">
<?php
while ($stmt_physician->fetch()){        
    echo "<option value=\"$physicianid\"";
    if ($_GET['physicianid'] == $physicianid){echo "selected";}
    echo ">$physician</option>";
}
?>
        </select> 
        <label>Is your physician at Cooper Green?</label>
        <select name="cooperid" class="form-control">
<?php
while ($stmt_cooper->fetch()){        
    echo "<option value=\"$cooperid\"";
    if ($_GET['cooperid'] == $cooperid){echo "selected";}
    echo ">$cooper</option>";
}
?>
        </select> 
        <label>Please select your smoking status:</label>
        <select name = 'smokingstatus' class="form-control">
        <option value=""></option>
        <option value ="1" <?php if ($_GET['smokingstatus'] == 1){echo "selected";}?> >Never Smoked</option>
        <option value ="2" <?php if ($_GET['smokingstatus'] == 2){echo "selected";}?> >Past Smoker</option>
        <option value ="3" <?php if ($_GET['smokingstatus'] == 3){echo "selected";}?> >Current Smoker</option>
        </select>
        <label>If current or past smoker, for how many years have you (or did you) smoke?</label>
        <select name="timesmoked" class="form-control">
          <option value="">N/A</option>
<?php
for ($timesmoked_array = 1; $timesmoked_array < 71; $timesmoked_array++) {
    echo "        <option value=\"$timesmoked_array\"";
    if ($_GET['timesmoked'] == $timesmoked_array){echo "selected";}
    echo ">$timesmoked_array</option>\n";
}
?>
        </select>
        <label>If current or past smoker, how many packs a day do/did you smoke?</label>
        <select name="packsperday" class="form-control">
        <option value="">N/A</option>
<?php
$packsmokeds = array("0.5","1","1.5","2","2.5","3","3.5","4","4.5","5","5.5","6","6.5","7");
    for ($packsmoked_count = 0; $packsmoked_count <count($packsmokeds); $packsmoked_count++){
        echo"        <option value=\"$packsmokeds[$packsmoked_count]\"";
        if ($_GET['packsperday'] == $packsmokeds[$packsmoked_count]){echo "selected";}
        echo ">$packsmokeds[$packsmoked_count]</option>\n";
        }
?>
        </select>
        <label>If you smoked previously, what year did you quit?</label>
        <select name="quitdate" class="form-control">
        <option value="">N/A</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "        <option value=\"$year\"";
  if ($_GET['quitdate'] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
        </select>
        <label>How often do you drink alcohol?</label>
        <select name="alcoholid" class="form-control"/>
<?php
while ($stmt_alcohol->fetch()){        
  echo "<option value=\"$alcoholid\"";
  if ($_GET['alcoholid'] == $alcoholid){echo "selected";}
  echo ">$alcohol</option>";
}
?>
        </select>
        <label>How do you primarily get to clinic?</label>
        <select name="transportid" class="form-control"/>
<?php
while ($stmt_transport->fetch()){        
    echo "<option value=\"$transportid\"";
    if ($_GET['transportid'] == $transportid){echo "selected";}
    echo ">$transport</option>";
}
?>
        </select>
        <label>How did you hear about EAB?</label>
        <input type="text" name="heareab" value="<?php echo $_GET['heareab']; ?>" class="form-control"/>
        
        <label>How would you describe your visit type?</label>
        <select name="visittypeid" class="form-control"/>
<?php

while ($stmt_visittype->fetch()){        
  echo "<option value=\"$visittypeid\"";
  if ($_GET['visittypeid'] == $visittypeid){echo "selected";}
  echo ">$visittype</option>";
}
?>
        </select>
        <label>Which option best describes the reason for your visit?</label>
        <select name="reasonforvisitid" class="form-control"/>
<?php
while ($stmt_reasonforvisit->fetch()){        
  echo "<option value=\"$reasonforvisitid\"";
  if ($_GET['reasonforvisitid'] == $reasonforvisitid){echo "selected";}
  echo ">$reasonforvisit</option>";
}
?>
        </select>
        
    <label>Estimate Date of Last Mammogram:</label>
    <div class="row">
    <div class="col-xs-4">
    <select name="mammogram_month" class="form-control"/>
    <option value=""></option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "        <option value=\"$month\"";
  if ($_GET['mammogram_month'] == $month){echo "selected";}
  echo ">$month_array[$month]</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="mammogram_day" class="form-control">
        <option value=""></option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "        <option value=\"$day\"";
  if ($_GET['mammogram_day'] == $day){echo "selected";}
  echo ">$day</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="mammogram_year" class="form-control">
        <option value=""></option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "        <option value=\"$year\"";
  if ($_GET['mammogram_year'] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
        </select>
        </div>
        </div>

    <label>Estimate Date of Last Colonoscopy:</label>
    <div class="row">
    <div class="col-xs-4">
    <select name="colonoscopy_month" class="form-control"/>
    <option value=""></option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "        <option value=\"$month\"";
  if ($_GET['colonoscopy_month'] == $month){echo "selected";}
  echo ">$month_array[$month]</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="colonoscopy_day" class="form-control">
        <option value=""></option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "        <option value=\"$day\"";
  if ($_GET['colonoscopy_day'] == $day){echo "selected";}
  echo ">$day</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="colonoscopy_year" class="form-control">
        <option value=""></option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "        <option value=\"$year\"";
  if ($_GET['colonoscopy_year'] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
        </select>
        </div>
        </div>

    <label>Estimate Date of Last STI/STD Test:</label>
    <div class="row">
    <div class="col-xs-4">
    <select name="STI_month" class="form-control"/>
    <option value=""></option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "        <option value=\"$month\"";
  if ($_GET['STI_month'] == $month){echo "selected";}
  echo ">$month_array[$month]</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="STI_day" class="form-control">
        <option value=""></option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "        <option value=\"$day\"";
  if ($_GET['STI_day'] == $day){echo "selected";}
  echo ">$day</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="STI_year" class="form-control">
        <option value=""></option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "        <option value=\"$year\"";
  if ($_GET['STI_year'] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
        </select>
        </div>
        </div>

    <label>Estimate Date of Last PAP Smear:</label>
    <div class="row">
    <div class="col-xs-4">
    <select name="PAP_month" class="form-control"/>
    <option value=""></option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "        <option value=\"$month\"";
  if ($_GET['PAP_month'] == $month){echo "selected";}
  echo ">$month_array[$month]</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="PAP_day" class="form-control">
        <option value=""></option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "        <option value=\"$day\"";
  if ($_GET['PAP_day'] == $day){echo "selected";}
  echo ">$day</option>\n";
}
?>
        </select>
        </div>
        <div class="col-xs-4">
        <select name="PAP_year" class="form-control">
        <option value=""></option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "        <option value=\"$year\"";
  if ($_GET['PAP_year'] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>    
        </select>
        </div>
        </div>
        <label>What brings you to the clinic today?</label>
        <input type="text" name="pstat" value="<?php echo $_GET['pstat']; ?>" class="form-control"/>

        <label>Select any drugs that you are currently taking:</label>
<?php
$drugs = $_GET['drugs'];
$i = 1;
    while ($stmt_drugtype->fetch()){
        echo "      <label class=\"checkbox-inline\">  <input type=\"checkbox\" id =\"inlineCheckbox$i\" name = \"drugs[]\" value =\"$drugtypeid\"";
        foreach ($drugs as $drug) {
           if ($drug == $drugtypeid){echo "checked='checked'";}
        }
        echo ">$drugtype</input>\n</label>";
    $i = $i+1;}   
?>      
        <br /><br />
        <label>Other drug not listed:</label>
        <input type="text" name="drugaddition" value="<?php echo $_GET['drugaddition']; ?>" class="form-control"/>
        
        <label>Check any allergies that you experience:</label>
<?php
$allergies = $_GET['allergies'];
$i = 1;
    while ($stmt_allergylist->fetch()){
        echo "    <label class=\"checkbox-inline\">  <input type=\"checkbox\" id =\"inlineCheckbox$i\" name = \"allergies[]\" value =\"$allergylistid\"";
        foreach ($allergies as $allergy) {
           if ($allergy == $allergylistid){echo "checked='checked'";}
        }
        echo ">$allergylist</input> </label>";
        $i = $i+1; }   
?>
        <br /> <br />
        <label>Other allergy not listed:</label>
        <input type="text" name="allergyaddition" value="<?php echo $_GET['allergyaddition']; ?>" class="form-control"/>
        <br />
        <input type="submit" class="btn btn-success" name="submit" value="Submit" />
<!--- Make sure this is separate window that pops up after patient fills out most form. Check in officer will add the practicefusion PRn to this. Practice Fusion PRN  -- patientid -->
        <br /><br />

    </form>
    
<?php require_once("referencefiles/footer.php");

$stmt_city->close();
$stmt_state->close();
$stmt_zip->close();
$stmt_ethnicity->close();
$stmt_gender->close();
$stmt_race->close();
$stmt_language->close();
$stmt_citizen->close();
$stmt_cooper->close();
$stmt_physician->close();
$stmt_education->close();
$stmt_housestat->close();
$stmt_insurance->close();
$stmt_disability->close();
$stmt_veteran->close();
$stmt_hometype->close();
$stmt_transport->close();
$stmt_foodstamp->close();
$stmt_alcohol->close();
$stmt_relationship->close();
$stmt_visittype->close();
$stmt_reasonforvisit->close();
$stmt_drugtype->close();
$stmt_allergylist->close();
$con->close();
?>