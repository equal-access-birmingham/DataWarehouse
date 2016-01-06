<?php
//error_reporting(E_ALL);
//ini_set("display_errors",1);

include("includes/header_require_login.php");
//getting info supplied by select_patient.php
$patientid = $_GET['patientid'];
//use later in generating questions
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
//open DB conneciton
require("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db);
//accesses tables in database to create select options
$query = "SELECT `cityid`, `city` FROM `City`;";
$stmt_city = $con->prepare($query);
$stmt_city->execute();
$stmt_city->store_result();
$stmt_city->bind_result($cityid, $city);

$query = "SELECT `stateid`, `state` FROM `State`;";
$stmt_state = $con->prepare($query);
$stmt_state->execute();
$stmt_state->store_result();
$stmt_state->bind_result($stateid,$state);
        
$query = "SELECT `zipid`, `zip` FROM `Zip`;";
$stmt_zip = $con->prepare($query);
$stmt_zip->execute();
$stmt_zip->store_result();
$stmt_zip->bind_result($zipid,$zip);
		
$query = "SELECT `hometypeid`, `hometype` FROM `HomeType`;";
$stmt_hometype = $con->prepare($query);
$stmt_hometype->execute();
$stmt_hometype->store_result();
$stmt_hometype->bind_result($hometypeid,$hometype);
		
$query = "SELECT `emergencyrid`, `emergencyr` FROM `EmergencyR`;";
$stmt_emergencyr = $con->prepare($query);
$stmt_emergencyr->execute();
$stmt_emergencyr->store_result();
$stmt_emergencyr->bind_result($emergencyrid,$emergencyr);

$query = "SELECT `reasonforvisitid`, `reasonforvisit` FROM `ReasonforVisit`;";
$stmt_reasonforvisit = $con->prepare($query);
$stmt_reasonforvisit->execute();
$stmt_reasonforvisit->store_result();
$stmt_reasonforvisit->bind_result($reasonforvisitid,$reasonforvisit);

$query = "SELECT `transportid`, `transport` FROM `Transport`;";
$stmt_transport = $con->prepare($query);
$stmt_transport->execute();
$stmt_transport->store_result();
$stmt_transport->bind_result($transportid,$transport);
//uses patientid retrived earlier to find more information from patient table about the person in question
$query = "SELECT `fname`, `lname`, `dob`, `address_street`, `cityid`, `stateid`, `zipid`, `emergency_name`, `emergency_number`, `emergencyrid`, `phone_number`, `email_address` from `Patient` WHERE (`patientid`) = (?);";
$stmt_patient = $con->prepare($query) or die("Error: " . $con->error);
$stmt_patient->bind_param("s", $patientid);
$stmt_patient->execute();
$stmt_patient->store_result();
$stmt_patient->bind_result($fname, $lname, $dob, $address_streetselect, $cityidselect, $stateidselect, $zipidselect, $emergency_nameselect, $emergency_numberselect, $emergencyridselect, $phone_numberselect, $email_addressselect);
$stmt_patient->fetch();
//uses patientid retrieved earlier to find more information from social history table about person in question
$query = "SELECT `hometypeid` from `SocialHistory` WHERE `patientid` = ?;";
$stmt_social = $con->prepare($query);
$stmt_social->bind_param("s", $patientid);
$stmt_social->execute();
$stmt_social->store_result();
$stmt_social->bind_result($hometypeidselect);
$stmt_social->fetch();
//uses patientid retrieved earlier to find more information from mammogram table about person in question
$query = "SELECT `mammogram` from `Mammogram` WHERE `patientid` = ?;";
$stmt_mamm = $con->prepare($query);
$stmt_mamm->bind_param("s", $patientid);
$stmt_mamm->execute();
$stmt_mamm->store_result();
$stmt_mamm->bind_result($mammodate);
$stmt_mamm->fetch();
//uses patientid retrieved earlier to find more information from sti table about person in question
$query = "SELECT `sti` from `STI` WHERE `patientid` = ?;";
$stmt_sti = $con->prepare($query);
$stmt_sti->bind_param("s", $patientid);
$stmt_sti->execute();
$stmt_sti->store_result();
$stmt_sti->bind_result($stidate);
$stmt_sti->fetch();
//uses patientid retrieved earlier to find more information from colonoscopy table about person in question
$query = "SELECT `colonoscopy` from `Colonoscopy` WHERE `patientid` = ?;";
$stmt_colo = $con->prepare($query);
$stmt_colo->bind_param("s", $patientid);
$stmt_colo->execute();
$stmt_colo->store_result();
$stmt_colo->bind_result($colodate);
$stmt_colo->fetch();
//uses patientid retrieved earlier to find more information from papsmear table about person in question
$query = "SELECT `papsmear` from `PapSmear` WHERE `patientid` = ?;";
$stmt_pap = $con->prepare($query);
$stmt_pap->bind_param("s", $patientid);
$stmt_pap->execute();
$stmt_pap->store_result();
$stmt_pap->bind_result($papdate);
$stmt_pap->fetch();

require_once("includes/menu.php");
//show the person their name and birth date
echo "
      <h3> Name: $fname $lname </h3>
      <h3> Date of Birth: $dob </h3><br />
	  <h4>Asterisks indicate required fields.</h4>";
 ?>
      <!-- Open the form - EVERYTHING BELOW THIS LINE IS EDITED IN THE DATABASE UPON SUBMISSION-->
	  <form method="get" action="editpatientformdo.php">
	    <!-- transfer patient id using the form but hide from user -->
        <input type="text" name="patientid" value="<?php echo $patientid; ?>" style="display: none;" />
		<!-- Ask them about Chief Complaint -->
	    <label>*In your own words, What brings you to the clinic today?</label>
        <input type="text" name="pstat" value="<?php echo $_GET['pstat']; ?>" class="form-control"/>
				<!-- Ask them about Acute/Chronic etc. care -->
        <label>*Which option best describes the reason for your visit?</label>
        <select name="reasonforvisitid" class="form-control"/>
<?php
while ($stmt_reasonforvisit->fetch()){        
  echo "          <option value=\"$reasonforvisitid\"";
  if ($_GET['reasonforvisitid'] == $reasonforvisitid){echo "selected";}
  echo ">$reasonforvisit</option>\n";
}
?>
        </select>
		<!-- Ask them about ransoportation to the clinic -->
        <label>*How do you primarily get to clinic?</label>
        <select name="transportid" class="form-control"/>
<?php
while ($stmt_transport->fetch()){        
    echo "        <option value=\"$transportid\"";
    if ($_GET['transportid'] == $transportid){echo "selected";}
    echo ">$transport</option>\n";
}
?>
        </select><br />
		<h4>Please review the information below and update it if necessary:</h4>
		<!-- Ask them about type of home -->
        <label>*What type of home do you live in?</label>
        <select name="hometypeid" class="form-control">
<?php
while ($stmt_hometype->fetch()){        
    echo "          <option value=\"$hometypeid\"";
    if ($hometypeidselect == $hometypeid){echo "selected";}//automatically select the information that is in the database
    echo ">$hometype</option>\n";
}
?>
        </select> 
		<!-- Ask them about Address -->
        <label>Address:</label>
        <input type="text" name="address_street" value="<?php echo $address_streetselect; ?>" class="form-control"/><!-- automatically select the information that is in the database -->
        <div class="row">
          <div class="col-xs-6"> 
		    <!-- Ask them about City -->
            <label for="citybox">City:</label>
            <select name="cityid" id ="citybox" class="form-control"/>
<?php
while ($stmt_city->fetch()){        
    echo "              <option value=\"$cityid\"";
    if ($cityidselect == $cityid){echo "selected";}//automatically select the information that is in the database
    echo ">$city</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-6">
		    <!-- Ask them about City Addition -->
            <label for="cityadditionbox">Other city not listed:</label>
            <input type="text" name="cityaddition" id="cityadditionbox" value="<?php echo $_GET['cityaddition']; ?>" class="form-control"/><!-- automatically select the information that is in the database -->
          </div>
        </div>
        <div class="row"> 
          <div class="col-xs-6">
		    <!-- Ask them about State -->
            <label for="statebox">State:</label>
            <select name="stateid" id="statebox" class="form-control"/>		
<?php
while ($stmt_state->fetch()){        
    echo "              <option value=\"$stateid\"";
    if ($stateidselect == $stateid){echo "selected";}//automatically select the information that is in the database
    echo ">$state</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-6">
            <label for="stateadditionbox">Other state not listed:</label>
            <input type="text" name="stateaddition" id="stateadditionbox" value="<?php echo $_GET['stateaddition']; ?>" class="form-control"/><!-- automatically select the information that is in the database -->
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
		    <!-- Ask them about Zip -->
            <label for="zipbox">Zip:</label>
            <select name="zipid" id="zipbox" class="form-control"/>
<?php
while ($stmt_zip->fetch()){        
    echo "              <option value=\"$zipid\"";
    if ($zipidselect == $zipid){echo "selected";}
    echo ">$zip</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-6">
		    <!-- Ask them about Zip Addition -->
            <label for="zipadditionbox">Other zip not listed:</label>
            <input type="text" name="zipaddition" id="zipadditionbox" value="<?php echo $_GET['zipaddition']; ?>" class="form-control"/>
          </div>
        </div>
		<!-- Ask them about Phone Number -->
        <label>Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $phone_numberselect; ?>" class="form-control"/>
        <!-- Ask them about Email -->
		<label>Email:</label>
        <input type="text" name="email_address" value="<?php echo $email_addressselect; ?>" class="form-control"/>
        <div class="row"> 
          <div class="col-xs-4">
		    <!-- Ask them about Emergency Contact Name -->
            <label for="emergencyname">*Emergency Contact Name:</label>
            <input type="text" name="emergency_name" id="emergencyname" value="<?php echo $emergency_nameselect; ?>" class="form-control"/>
          </div>
          <div class="col-xs-4">
		    <!-- Ask them about Emergency Contact Relationship -->
            <label for="emergencyr">*Relation:</label>
            <select name="emergencyrid" id ="emergencyr" class="form-control"/>

<?php
while ($stmt_emergencyr->fetch()){        
    echo "              <option value=\"$emergencyrid\"";
    if ($emergencyridselect == $emergencyrid){echo "selected";}
    echo ">$emergencyr</option>\n";
}
?>
            </select>
          </div>
          <div class="col-xs-4">
		    <!-- Ask them about Emergency Contact Phone Number -->
            <label for="emergencynumber">*Phone Number:</label>
            <input type="text" name="emergency_number" id="emergencynumber" value="<?php echo $emergency_numberselect; ?>" class="form-control"/>
          </div>
        </div>
		<!-- Ask them about Mammogram -->
        <label>Estimate Date of Last Mammogram:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="mammogram_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (explode('-',$mammodate)[1] == $month){echo "selected";}
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
  if (explode('-',$mammodate)[2] == $day){echo "selected";}
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
  if (explode('-',$mammodate)[0] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
		<!-- Ask them about Colonoscopy -->
        <label>Estimate Date of Last Colonoscopy:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="colonoscopy_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (explode('-',$colodate)[1] == $month){echo "selected";}
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
  if (explode('-',$colodate)[2] == $day){echo "selected";}
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
  if (explode('-',$colodate)[0] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
		<!-- Ask them about STI/STD -->
        <label>Estimate Date of Last STI/STD Test:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="STI_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (explode('-',$stidate)[1] == $month){echo "selected";}
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
  if (explode('-',$stidate)[2] == $day){echo "selected";}
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
  if (explode('-',$stidate)[0] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
        <label>Estimate Date of Last PAP Smear:</label>
		<!-- Ask them about PAP Smear -->
        <div class="row">
          <div class="col-xs-4">
            <select name="PAP_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (explode('-',$papdate)[1] == $month){echo "selected";}
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
  if (explode('-',$papdate)[2] == $day){echo "selected";}
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
  if (explode('-',$papdate)[0] == $year){echo "selected";}
  echo ">$year</option>\n";
}
?>    
            </select>
          </div>
        </div>
        <br />
        <input type="submit" class="btn btn-success" name="submit" value="Submit" /> 
        <br />
        <br />
      </form>

<?php 
//close out of all the statements and connection opened earlier
$stmt_city->close();
$stmt_state->close();
$stmt_zip->close();
$stmt_hometype->close();
$stmt_emergencyr->close();
$stmt_reasonforvisit->close();
$stmt_transport->close();
$stmt_patient->close();
$stmt_social->close();
$stmt_mamm->close();
$stmt_sti->close();
$stmt_colo->close();
$stmt_pap->close();
$con->close();
?>
<?php require_once("includes/footer.php"); ?>

