<?php
//error_reporting(E_ALL);
//ini_set("display_errors",1);

//LOAD DATABASE INFORMATION
require("includes/db.php");
//ESTABLISH CONNECTION TO DATABASE
$con = new mysqli($host, $db_user, $db_pass, $db_db);
//LOAD QUERY TO FILL IN OPTIONS ON FORM
require("includes/VariableQuery.php");
?>
<?php include("includes/header_require_login.php"); ?>
      <title>EAB Database</title>
<?php require_once("includes/menu.php"); ?>
<?php 
//LOAD DATA TO DISPLAY IN MODAL FROM DATABASE
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

$query = "SELECT `reasonforvisit` from `ReasonforVisit` WHERE (`reasonforvisitid`) = (?);";
$stmt_getreasonforvisit = $con->prepare($query);
$stmt_getreasonforvisit->bind_param("s", $_GET['reasonforvisitid']);
$stmt_getreasonforvisit->execute();
$stmt_getreasonforvisit->store_result();
$stmt_getreasonforvisit->bind_result($reasonforvisit);
$stmt_getreasonforvisit->fetch();
$stmt_getreasonforvisit->close();

$query = "SELECT `emergencyr` from `EmergencyR` WHERE (`emergencyrid`) = (?);";
$stmt_getemergencyr = $con->prepare($query);
$stmt_getemergencyr->bind_param("s", $_GET['emergencyrid']);
$stmt_getemergencyr->execute();
$stmt_getemergencyr->store_result();
$stmt_getemergencyr->bind_result($emergencyr);
$stmt_getemergencyr->fetch();
$stmt_getemergencyr->close();

$i = 1;
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
  if ($i == 1){
	$alldrugs .= $nextdrug;
  }
  else{
  $alldrugs .=  ", " . $nextdrug;
  }
  $i = $i+1;
}

$i=1;
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
  if ($i == 1){
	$allallergies .= $nextallergy;
  }
  else{
  $allallergies .=  ", " . $nextallergy;
  }
  $i = $i+1;
}

if ($_GET['smokingstatus'] == 1){
  $smokystats = "Never Smoked";
  }
elseif ($_GET['smokingstatus'] == 2){
  $smokystats = "Past Smoker for " . $_GET['packsperday'] . " years at " . $_GET['timesmoked'] . " packs per day until quitting in " . $_GET['quitdate'];
  }
elseif ($_GET['smokingstatus'] == 3){
  $smokystats = "Current Smoker for " . $_GET['packsperday'] . " years at " . $_GET['timesmoked'] . " packs per day";
  }
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
                <li>Name: " . $_GET['fname'] . " " . $_GET['lname'] . "</li>
                <li>DOB: " . $_GET['dob_month'] . "-" . $_GET['dob_day'] . "-" . $_GET['dob_year'] . "</li>
				<li>Gender: $gender</li>
                <li>Ethnicity: $ethnicity</li>
                <li>Race: $race</li>
				<li>Type of Home: $hometype</li>
                <li>Address:" . $_GET['address_street'] . " $city" . $_GET['cityaddition'] . ", " . " $state " . $_GET['stateaddition'] . " " . " $zip " . $_GET['zipaddition'] . "</li>
                <li>Phone: " . $_GET['phone_number'] . "</li>
                <li>Email:" . $_GET['email_address'] . "</li>
                <li>Emergency Contact:". $_GET['emergency_name'] . "  Relation:" . $emergencyr . "  Number:" . $_GET['emergency_number'] . "</li>
				<li>Why you are here: " . $_GET['pstat'] . "</li>
				<li>Reason for Visit: $reasonforvisit</li>
				<li>Transportation: $transport</li>
                <li>Language: $language " . $_GET['languageaddition'] . "</li>
                <li>Citizen Status: $citizen</li>
                <li>Housing Status: $housestat</li>
				<li>People in household (including yourself): " . $_GET['numfammember'] . "</li>
                <li>Children under 18 in household: " . $_GET['numchildren'] . "</li>
                <li>Relationship Status: $relationship</li>
                <li>Total monthly household income: $" . $_GET['householdincome'] . "</li>
                <li>Employed:$employment</li>
                <li>Disability: $disability</li>
                <li>Foodstamps: $foodstamp</li>
                <li>Veteran: $veteran</li>
                <li>Education: $education</li>
                <li>Insurance: $insurance</li>
                <li>Primary Care Physician: $physician</li> 
                <li>Physician at Cooper Green:$cooper</li>
                <li>Smoking: $smokystats</li>
                <li>Alcohol: $alcohol</li>
				<li>Substances: $alldrugs " . $_GET['drugaddition'] . "</li>
                <li>Allergies: $allallergies " . $_GET['allergyaddition'] . "</li>
                <li>How you heard about EAB: " . $_GET['heareab'] . "</li>
                <li>Last Mammogram: " . $_GET['mammogram_month'] . "-" . $_GET['mammogram_day'] . "-" . $_GET['mammogram_year'] . "</li>
                <li>Last Colonoscopy: " . $_GET['colonoscopy_month'] . "-" . $_GET['colonoscopy_day'] . "-" . $_GET['colonoscopy_year'] . "</li>
                <li>Last STI check: " . $_GET['STI_month'] . "-" . $_GET['STI_day'] . "-" . $_GET['STI_year'] . "</li>
                <li>Last PAP check:" . $_GET['PAP_month'] . "-" . $_GET['PAP_day'] . "-" . $_GET['PAP_year'] . "</li>
              </ul>\n";
?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Edit Information</button>
<?php
$query_string = "";
foreach ($_GET as $get => $value){
  if (is_array($value)){
	foreach($value as $array_value){
	  $query_string .= $get . "[]=" . urlencode($array_value) . "&";
	}
  } else {
	$query_string .= $get . "=" . urlencode($value) . "&";
	}
}
//$query_string = urlencode($query_string); 
echo "              <a href=\"newpatientform_do.php?$query_string\" class=\"btn btn-primary btn-lg\">Submit Information</a>";
//END OF MODAL
?>
            </div>
          </div>
        </div>
      </div>
<!--BEGINNING OF INTAKE FORM -->  
      <h1>EAB New Patient Intake Form</h1>
      <p> Please update your information in the form below. Asterisks indicate required field.</p>
      <!-- PATIENT TABLE INFO -->
      <form method="get" autocomplete="off">
	    <!-- First Name -->
        <label for ="fname">*First Name:</label>
        <input required type="text" name="fname" id ="fname" value="<?php if (isset($_GET['submit'])) {echo $_GET['fname'];} ?>" class="form-control"/>
		<!-- Last Name -->
        <label for ="lname">*Last Name:</label>
        <input required type="text" name="lname" id ="lname" value="<?php if (isset($_GET['submit'])) { echo $_GET['lname'];} ?>" class="form-control"/>
		<!-- Date of Birth -->
        <label>*Date of Birth:</label>
        <div class="row">
          <div class="col-xs-4">
            <select required name="dob_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
//BIRTH DATE BEGINNING
//Array of Months - also used in other date variables besides DOB
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
  echo "              <option value=\"$month\"";
    if (isset($_GET['submit'])) {if ($_GET['dob_month'] == $month){echo "selected";}}
  echo ">$month_array[$month]</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select required name="dob_day" class="form-control">
              <option value="">-- Day --</option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "              <option value=\"$day\"";
  if (isset($_GET['submit'])) {if ($_GET['dob_day'] == $day){echo "selected";}}
  echo ">$day</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select required name="dob_year" class="form-control" >
              <option value="">-- Year --</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "              <option value=\"$year\"";
  if (isset($_GET['submit'])) {if ($_GET['dob_year'] == $year){echo "selected";}}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
		<!-- Gender -->
        <label>*Gender:</label>
        <select required name="genderid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_gender->fetch()){        
  echo "          <option value=\"$genderid\"";
  if (isset($_GET['submit'])) {if ($_GET['genderid'] == $genderid){echo "selected";}} //automatically have the information filled out after form submit so that they can edit information
  echo ">$gender</option>\n";
}
?>
        </select>
		<!-- Ethnicity -->
        <label>*Ethnicity:</label>
        <select required name="ethnicityid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_ethnicity->fetch()){        
  echo "          <option value=\"$ethnicityid\"";
  if (isset($_GET['submit'])) {if ($_GET['ethnicityid'] == $ethnicityid){echo "selected";}}
  echo ">$ethnicity</option>\n";
}
?>
        </select>
		<!-- Race -->
        <label>*Race:</label>
        <select required name="raceid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_race->fetch()){        
  echo "          <option value=\"$raceid\"";
  if (isset($_GET['submit'])) {if ($_GET['raceid'] == $raceid){echo "selected";}}
  echo ">$race</option>\n";
}
?>
        </select>
		<!-- END DATE OF BIRTH -->
		<!-- Type of Home -->
        <label>*What type of home do you live in?</label>
        <select required name="hometypeid" class="form-control">
		  <option value=""></option>
<?php
while ($stmt_hometype->fetch()){        
  echo "          <option value=\"$hometypeid\"";
  if (isset($_GET['submit'])) {if ($_GET['hometypeid'] == $hometypeid){echo "selected";}}
  echo ">$hometype</option>\n";
}
?>
        </select> 
		<!-- Address -->
        <label>Address: (If listed Homeless Shelter above, please include address of shelter or name.)</label>
        <input type="text" name="address_street" value="<?php if (isset($_GET['submit'])) {echo $_GET['address_street'];} ?>" class="form-control"/>
		<!-- City -->
        <div class="row">
          <div class="col-xs-6"> 
            <label for="citybox">City:</label>
            <select name="cityid" id ="citybox" class="form-control"/>
			  <option value=""></option>
<?php
while ($stmt_city->fetch()){        
  echo "                <option value=\"$cityid\"";
  if (isset($_GET['submit'])) {if ($_GET['cityid'] == $cityid){echo "selected";}}
  echo ">$city</option>\n";
}
?>
            </select>
          </div>
		  <!-- City Addition -->
          <div class="col-xs-6">
            <label for="cityadditionbox">Other city not listed:</label>
            <input type="text" name="cityaddition" id="cityadditionbox" value="<?php if (isset($_GET['submit'])) {echo $_GET['cityaddition'];} ?>" class="form-control"/>
          </div>
        </div>
				<!-- State -->
        <div class="row"> 
          <div class="col-xs-6">
            <label for="statebox">State:</label>
            <select name="stateid" id="statebox" class="form-control"/>
			  <option value=""></option>
<?php
while ($stmt_state->fetch()){        
  echo "              <option value=\"$stateid\"";
  if (isset($_GET['submit'])) {if ($_GET['stateid'] == $stateid){echo "selected";}}//automatically have the information filled out after form submit so that they can edit information
  echo ">$state</option>\n";
}
?>
            </select>
          </div>
		  <!-- State Addition -->
          <div class="col-xs-6">
            <label for="stateadditionbox">Other state not listed:</label>
            <input type="text" name="stateaddition" id="stateadditionbox" value="<?php if (isset($_GET['submit'])) {echo $_GET['stateaddition'];} ?>" class="form-control"/>
          </div>
        </div>
		<!-- Zip -->
        <div class="row">
          <div class="col-xs-6">
            <label for="zipbox">Zip:</label>
            <select name="zipid" id="zipbox" class="form-control"/>
			  <option value=""></option>
<?php
while ($stmt_zip->fetch()){        
  echo "              <option value=\"$zipid\"";
  if (isset($_GET['submit'])) {if ($_GET['zipid'] == $zipid){echo "selected";}}//automatically have the information filled out after form submit so that they can edit information
  echo ">$zip</option>\n";
}
?>
            </select>
          </div>
		  <!-- Zip Addition -->
          <div class="col-xs-6">
            <label for="zipadditionbox">Other zip not listed:</label>
            <input type="text" name="zipaddition" id="zipadditionbox" value="<?php if (isset($_GET['submit'])) {echo $_GET['zipaddition'];} ?>" class="form-control"/><!-- automatically have the information filled out after form submit so that they can edit information -->
          </div>
        </div>
		<!-- Phone Number -->
        <label>Phone Number:</label>
        <input type="text" name="phone_number" placeholder="xxx-xxx-xxxx" value="<?php if (isset($_GET['submit'])) {echo $_GET['phone_number'];} ?>" class="form-control"/><!-- automatically have the information filled out after form submit so that they can edit information -->
		<!-- Email -->
        <label>Email:</label>
        <input type="text" name="email_address" value="<?php if (isset($_GET['submit'])) {echo $_GET['email_address'];} ?>" class="form-control"/><!-- automatically have the information filled out after form submit so that they can edit information -->
		<!-- Emergency Contact Name -->
        <div class="row">
		  <div class="container">
		    <label>Emergency Contact Information:</label>
		  </div>
	  	  <div class="col-xs-4">
	  	    <label for="emergencyname">Name:</label>
              <input type="text" name="emergency_name" id="emergencyname" value="<?php if (isset($_GET['submit'])) {echo $_GET['emergency_name'];} ?>" class="form-control"/>
	  	  </div>
		  <!-- Emergency Contact Relation -->
	  	  <div class="col-xs-4">
	        <label for="emergencyr">Relation:</label>
            <select name="emergencyrid" id ="emergencyr" class="form-control"/>
			  <option value=""></option>
			
<?php
while ($stmt_emergencyr->fetch()){        
  echo "            <option value=\"$emergencyrid\"";
  if (isset($_GET['submit'])) {if ($_GET['emergencyrid'] == $emergencyrid){echo "selected";}}//automatically have the information filled out after form submit so that they can edit information
  echo ">$emergencyr</option>\n";
}
?>
            </select>
	  	  </div>
		  <!-- Phone Number -->
	  	  <div class="col-xs-4">
	  	    <label for="emergencynumber">Phone Number:</label>
              <input type="text" name="emergency_number" placeholder="xxx-xxx-xxxx" id="emergencynumber" value="<?php if (isset($_GET['submit'])) {echo $_GET['emergency_number'];} ?>" class="form-control"/>
	  	  </div>
        </div>		
		<!-- Chief Complaint/ What brings you in? -->
        <label>*In your own words, what brings you to the clinic today?</label>
        <input required type="text" name="pstat" value="<?php if (isset($_GET['submit'])) {echo $_GET['pstat'];} ?>" class="form-control"/>
		<!-- Reason for Visit (Acute/Chronic) -->		
        <label>*Which option best describes the reason for your visit?</label>
        <select required name="reasonforvisitid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_reasonforvisit->fetch()){        
  echo "          <option value=\"$reasonforvisitid\"";
  if (isset($_GET['submit'])) {if ($_GET['reasonforvisitid'] == $reasonforvisitid){echo "selected";}}
  echo ">$reasonforvisit</option>\n";
}
?>
        </select>
<!-- How did you Travel -->
        <label>*How do you primarily get to EAB clinic to see the doctor?</label>
        <select required name="transportid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_transport->fetch()){        
  echo "          <option value=\"$transportid\"";
  if (isset($_GET['submit'])) {if ($_GET['transportid'] == $transportid){echo "selected";}}
  echo ">$transport</option>\n";
}
?>
        </select>		
		<!-- Primary Language -->
        <div class="row">
          <div class="col-xs-6"> 
            <label>*What is your primary language?:</label>
            <select required name="languageid" class="form-control"/>
			  <option value=""></option>
<?php
while ($stmt_language->fetch()){        
  echo "              <option value=\"$languageid\"";
  if (isset($_GET['submit'])) {if ($_GET['languageid'] == $languageid){echo "selected";}}
  echo ">$language</option>\n";
}
?>
            </select>
          </div>
		  <!-- Language Addition -->
          <div class="col-xs-6"> 
            <label>Other language not listed:</label>
            <input type="text" name="languageaddition" value="<?php if (isset($_GET['submit'])) {echo $_GET['languageaddition'];} ?>" class="form-control"/>
          </div>
        </div>
		<!-- Citizen Status -->
        <label>*What is your Citizenship Status?:</label>
        <select required name="citizenid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_citizen->fetch()){        
  echo "          <option value=\"$citizenid\"";
  if (isset($_GET['submit'])) {if ($_GET['citizenid'] == $citizenid){echo "selected";}}
  echo ">$citizen</option>\n";
}
?>
        </select>
		<!-- Head of Household -->
        <label>*Are you the head of your household?</label>
        <select required name="housestatid" class="form-control">
		  <option value=""></option>
<?php
while ($stmt_housestat->fetch()){        
  echo "          <option value=\"$housestatid\"";
  if (isset($_GET['submit'])) {if ($_GET['housestatid'] == $housestatid){echo "selected";}}
  echo ">$housestat</option>\n";
}
?>
        </select>
        <!-- Number of People in Household -->		
        <label>*How many people are in your household including yourself?</label>
        <select required name="numfammember" class="form-control">
          <option value=""></option>
<?php
$numfammembers = array("1","2","3","4","5","6","7","8","9","10","11","12","13");
for ($numfammember_count = 0; $numfammember_count <count($numfammembers); $numfammember_count++){
  echo"          <option value=\"$numfammembers[$numfammember_count]\"";
  if (isset($_GET['submit'])) {if ($_GET['numfammember'] == $numfammembers[$numfammember_count]){echo "selected";}}
  echo ">$numfammembers[$numfammember_count]</option>\n";
}
?>
        </select> 
		<!-- Children under 18 -->
        <label>*How many children under 18 are in your household?</label>
        <select required name="numchildren" class="form-control">
          <option value=""></option>
<?php
$numchildrens = array("0","1","2","3","4","5","6","7","8");
for ($numchildren_count = 0; $numchildren_count <count($numchildrens); $numchildren_count++){
  echo"          <option value=\"$numchildrens[$numchildren_count]\"";
  if (isset($_GET['submit'])) {if ($_GET['numchildren'] == $numchildrens[$numchildren_count]){echo "selected";}}
  echo ">$numchildrens[$numchildren_count]</option>\n";
}
?>
        </select> 
		<!-- Relationship Status -->
        <label>*What is your relationship status?</label>
        <select required name="relationshipid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_relationship->fetch()){        
  echo "          <option value=\"$relationshipid\"";
  if (isset($_GET['submit'])) {if ($_GET['relationshipid'] == $relationshipid){echo "selected";}}
  echo ">$relationship</option>\n";
}
?>
        </select> 
		<!-- Household Income -->
        <label>*What is your total monthly household income (in U.S. dollars $)?</label>
        <input required type="text" name="householdincome" value="<?php if (isset($_GET['submit'])) {echo $_GET['householdincome'];} ?>" class="form-control"> 
        <label>*Are you currently employed?</label>
        <select required name="employmentid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_employment->fetch()){        
  echo "          <option value=\"$employmentid\"";
  if (isset($_GET['submit'])) {if ($_GET['employmentid'] == $employmentid){echo "selected";}}
  echo ">$employment</option>\n";
}
?>
        </select> 
		<!-- Disability -->
        <label>*Are you on Disabilty?</label>
        <select required name="disabilityid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_disability->fetch()){        
  echo "          <option value=\"$disabilityid\"";
  if (isset($_GET['submit'])) {if ($_GET['disabilityid'] == $disabilityid){echo "selected";}}
  echo ">$disability</option>\n";
}
?>
        </select> 
		<!-- Foodstamps -->
        <label>*Are you part of the SNAP program formerly known as Foodstamps?</label>
        <select required name="foodstampid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_foodstamp->fetch()){        
  echo "          <option value=\"$foodstampid\"";
  if (isset($_GET['submit'])) {if ($_GET['foodstampid'] == $foodstampid){echo "selected";}}
  echo ">$foodstamp</option>\n";
}
?>
        </select>
		<!-- US Veteran -->
        <label>*Are you a United States Military Veteran?</label>
        <select required name="veteranid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_veteran->fetch()){        
  echo "          <option value=\"$veteranid\"";
  if (isset($_GET['submit'])) {if ($_GET['veteranid'] == $veteranid){echo "selected";}}
  echo ">$veteran</option>\n";
}
?>
        </select>
		<!-- Level of Education -->
        <label>*What is your highest level of education completed?</label>
        <select required name="educationid" class="form-control">
		  <option value=""></option>
<?php
while ($stmt_education->fetch()){        
  echo "          <option value=\"$educationid\"";
  if (isset($_GET['submit'])) {if ($_GET['educationid'] == $educationid){echo "selected";}}
  echo ">$education</option>\n";
}
?>
        </select>
		<!-- Health Insurance -->		
        <label>*Do you have health insurance?</label>
        <select required name="insuranceid" class="form-control">
		  <option value=""></option>
<?php
while ($stmt_insurance->fetch()){        
  echo "          <option value=\"$insuranceid\"";
  if (isset($_GET['submit'])) {if ($_GET['insuranceid'] == $insuranceid){echo "selected";}}
  echo ">$insurance</option>\n";
}
?>
        </select> 
		<!-- Primary Care Phsician -->
        <label>*Do you have a primary care physican? (not counting EAB/this clinic)</label>
        <select required name="physicianid" class="form-control">
		  <option value=""></option>
<?php
while ($stmt_physician->fetch()){        
  echo "          <option value=\"$physicianid\"";
  if (isset($_GET['submit'])) {if ($_GET['physicianid'] == $physicianid){echo "selected";}}
  echo ">$physician</option>\n";
}
?>
        </select> 
		<!-- Cooper Green -->
        <label>*Is your physician at Cooper Green?</label>
        <select required name="cooperid" class="form-control">
		  <option value=""></option>
<?php
while ($stmt_cooper->fetch()){        
  echo "          <option value=\"$cooperid\"";
  if (isset($_GET['submit'])) {if ($_GET['cooperid'] == $cooperid){echo "selected";}}
  echo ">$cooper</option>\n";
}
?>
        </select> 
		<!-- Choose Smoking Status -->
        <label>Do you smoke tobacco?</label>
        <select name = 'smokingstatus' class="form-control">
          <option value=""></option>\n
          <option value ="1" <?php if (isset($_GET['submit'])) {if ($_GET['smokingstatus'] == 1){echo "selected";}}?> >Never Smoked</option>\n
          <option value ="2" <?php if (isset($_GET['submit'])) {if ($_GET['smokingstatus'] == 2){echo "selected";}}?> >Past Smoker</option>\n
          <option value ="3" <?php if (isset($_GET['submit'])) {if ($_GET['smokingstatus'] == 3){echo "selected";}}?> >Current Smoker</option>\n
        </select>
		<!-- Number of Years Smoked -->
        <label>If you currently smoke tobacco or have smoked tobacco in the past, for how many years have you (or did you) smoke?</label>
        <select name="timesmoked" class="form-control">
          <option value="">N/A</option>
<?php
for ($timesmoked_array = 1; $timesmoked_array < 71; $timesmoked_array++) {
  echo "          <option value=\"$timesmoked_array\"";
  if (isset($_GET['submit'])) {if ($_GET['timesmoked'] == $timesmoked_array){echo "selected";}}
  echo ">$timesmoked_array</option>\n";
}
?>
        </select>
		<!-- Packs Per Day -->
        <label>If you currently smoke tobacco or have smoked tobacco in the past, how many packs a day do you (or did you) smoke?</label>
        <select name="packsperday" class="form-control">
          <option value="">N/A</option>
<?php
$packsmokeds = array("0.5","1","1.5","2","2.5","3","3.5","4","4.5","5","5.5","6","6.5","7");
for ($packsmoked_count = 0; $packsmoked_count <count($packsmokeds); $packsmoked_count++){
  echo"          <option value=\"$packsmokeds[$packsmoked_count]\"";
  if (isset($_GET['submit'])) {if ($_GET['packsperday'] == $packsmokeds[$packsmoked_count]){echo "selected";}}
  echo ">$packsmokeds[$packsmoked_count]</option>\n";
}
?>
        </select>
		<!-- Year Quit Smoking -->
        <label>If you smoked tobacco previously, what year did you quit?</label>
        <select name="quitdate" class="form-control">
          <option value="">N/A</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "          <option value=\"$year\"";
  if (isset($_GET['submit'])) {if ($_GET['quitdate'] == $year){echo "selected";}}
  echo ">$year</option>\n";
}
?>
        </select>
		<!-- Alcohol -->
        <label>*How often do you drink alcohol?</label>
        <select required name="alcoholid" class="form-control"/>
		  <option value=""></option>
<?php
while ($stmt_alcohol->fetch()){        
  echo "          <option value=\"$alcoholid\"";
  if (isset($_GET['submit'])) {if ($_GET['alcoholid'] == $alcoholid){echo "selected";}}
  echo ">$alcohol</option>\n";
}
?>
        </select>
	    <br />
        <!-- Drugs Taken -->
        <label>Please select any drugs or substances that you have used in the past or are currently using:</label>
<?php
if (isset($_GET['submit'])) {$drugs = $_GET['drugs'];}
$i = 1;
while ($stmt_drugtype->fetch()){
  echo "        <label class=\"checkbox-inline\">\n        <input type=\"checkbox\" id =\"inlineCheckbox$i\" name = \"drugs[]\" value =\"$drugtypeid\"";
  if (isset($_GET['submit'])) {
    foreach ($drugs as $drug) {
      if ($drug == $drugtypeid){echo "checked='checked'";}
    }
  }
  echo ">$drugtype</input></label>\n";
  $i = $i+1;
}   
?>      
        <br />
		<!-- Drug Addition -->
        <label>Other drug or substance not listed:</label>
        <input type="text" name="drugaddition" value="<?php if (isset($_GET['submit'])) {echo $_GET['drugaddition'];} ?>" class="form-control"/>
        <!-- Allergies -->
        <br />
        <label>Please select any allergies that you experience:</label>
<?php
if (isset($_GET['submit'])) {$allergies = $_GET['allergies'];}
$i = 1;
while ($stmt_allergylist->fetch()){
  echo "        <label class=\"checkbox-inline\">\n        <input type=\"checkbox\" id =\"inlineCheckbox$i\" name = \"allergies[]\" value =\"$allergylistid\"";
  if (isset($_GET['submit'])) {
    foreach ($allergies as $allergy) {
      if ($allergy == $allergylistid){echo "checked='checked'";}
    }
  }
  echo ">$allergylist</input></label>\n";
  $i = $i+1; }   
?>
	    <br />
		<!-- Allergy Addition -->
        <label>Other allergy not listed:</label>
        <input type="text" name="allergyaddition" value="<?php if (isset($_GET['submit'])) {echo $_GET['allergyaddition'];} ?>" class="form-control"/>
        <!-- How did you hear? -->
        <label>*How did you hear about EAB?</label>
        <input required type="text" name="heareab" value="<?php if (isset($_GET['submit'])) {echo $_GET['heareab'];} ?>" class="form-control"/>
		<h3>Please answer the questions below if they apply to you:</h3>
		<!-- MAMMOGRAM DATE -->
        <label>Estimate Date of Last Mammogram:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="mammogram_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {if ($_GET['mammogram_month'] == $month){echo "selected";}}
  echo ">$month_array[$month]</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="mammogram_day" class="form-control">
              <option value="">-- Day --</option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "              <option value=\"$day\"";
  if (isset($_GET['submit'])) {if ($_GET['mammogram_day'] == $day){echo "selected";}}
  echo ">$day</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="mammogram_year" class="form-control">
              <option value="">-- Year --</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "              <option value=\"$year\"";
  if (isset($_GET['submit'])) {if ($_GET['mammogram_year'] == $year){echo "selected";}}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
        <!-- PAP Date -->
        <label>Estimate Date of Last PAP Smear:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="PAP_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {if ($_GET['PAP_month'] == $month){echo "selected";}}
  echo ">$month_array[$month]</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="PAP_day" class="form-control">
              <option value="">-- Day --</option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "              <option value=\"$day\"";
  if (isset($_GET['submit'])) {if ($_GET['PAP_day'] == $day){echo "selected";}}
  echo ">$day</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="PAP_year" class="form-control">
              <option value="">-- Year --</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "              <option value=\"$year\"";
  if (isset($_GET['submit'])) {if ($_GET['PAP_year'] == $year){echo "selected";}}
  echo ">$year</option>\n";
}
?>    
            </select>
          </div>
        </div>        
		<!-- COLONOSCOPY DATE -->
        <label>Estimate Date of Last Colonoscopy:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="colonoscopy_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {if ($_GET['colonoscopy_month'] == $month){echo "selected";}}
  echo ">$month_array[$month]</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="colonoscopy_day" class="form-control">
              <option value="">-- Day --</option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "              <option value=\"$day\"";
  if (isset($_GET['submit'])) {if ($_GET['colonoscopy_day'] == $day){echo "selected";}}
  echo ">$day</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="colonoscopy_year" class="form-control">
              <option value="">-- Year --</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "              <option value=\"$year\"";
  if (isset($_GET['submit'])) {if ($_GET['colonoscopy_year'] == $year){echo "selected";}}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
        <!-- STI Date -->
        <label>Estimate Date of Last STI/STD Test:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="STI_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {if ($_GET['STI_month'] == $month){echo "selected";}}
  echo ">$month_array[$month]</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="STI_day" class="form-control">
              <option value="">-- Day --</option>
<?php
for ($day = 1; $day < 32; $day++) {
  echo "              <option value=\"$day\"";
  if (isset($_GET['submit'])) {if ($_GET['STI_day'] == $day){echo "selected";}}
  echo ">$day</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
            <select name="STI_year" class="form-control">
              <option value="">-- Year --</option>
<?php
$year = date("Y");
$year_past = $year - 120;
for ($year; $year > $year_past; $year--){
  echo "              <option value=\"$year\"";
  if (isset($_GET['submit'])) {if ($_GET['STI_year'] == $year){echo "selected";}}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
        <br />
        <input type="submit" class="btn btn-success btn-lg" name="submit" value="Submit" />
<!--- Make sure this is separate window that pops up after patient fills out most form. Check in officer will add the practicefusion PRn to this. Practice Fusion PRN  -- patientid -->
        <br />
	    <br />
      </form>
<?php require_once("includes/footer.php");
//closing out of all the open statement and connection
$stmt_city->close();
$stmt_state->close();
$stmt_zip->close();
$stmt_ethnicity->close();
$stmt_gender->close();
$stmt_race->close();
$stmt_language->close();
$stmt_citizen->close();
$stmt_cooper->close();
$stmt_employment->close();
$stmt_physician->close();
$stmt_education->close();
$stmt_housestat->close();
$stmt_insurance->close();
$stmt_disability->close();
$stmt_veteran->close();
$stmt_hometype->close();
$stmt_foodstamp->close();
$stmt_alcohol->close();
$stmt_relationship->close();
$stmt_transport->close();
$stmt_reasonforvisit->close();
$stmt_drugtype->close();
$stmt_allergylist->close();
$stmt_emergencyr->close();
$con->close();
?>
