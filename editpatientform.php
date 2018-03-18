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


//PULLING IN INFORMATION FOR FOR THE MODAL
if (isset($_GET['submit'])) {
    $query = "SELECT `fname`, `lname`, `dob` from `Patient` WHERE (`patientid`) = (?);";
    $stmt_patient = $con->prepare($query) or die("Error: " . $con->error);
    $stmt_patient->bind_param("s", $patientid);
    $stmt_patient->execute();
    $stmt_patient->store_result();
    $stmt_patient->bind_result($fname, $lname, $dob);
    $stmt_patient->fetch();

    $query = "SELECT `reasonforvisit` from `ReasonforVisit` WHERE (`reasonforvisitid`) = (?);";
    $stmt_getreasonforvisit = $con->prepare($query);
    $stmt_getreasonforvisit->bind_param("s", $_GET['reasonforvisitid']);
    $stmt_getreasonforvisit->execute();
    $stmt_getreasonforvisit->store_result();
    $stmt_getreasonforvisit->bind_result($reasonforvisit);
    $stmt_getreasonforvisit->fetch();
    $stmt_getreasonforvisit->close();

    $query = "SELECT `hometype` from `HomeType` WHERE (`hometypeid`) = (?);";
    $stmt_gethometype = $con->prepare($query);
    $stmt_gethometype->bind_param("s", $_GET['hometypeid']);
    $stmt_gethometype->execute();
    $stmt_gethometype->store_result();
    $stmt_gethometype->bind_result($hometype);
    $stmt_gethometype->fetch();
    $stmt_gethometype->close();

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

    $query = "SELECT `emergencyr` from `EmergencyR` WHERE (`emergencyrid`) = (?);";
    $stmt_getemergencyr = $con->prepare($query);
    $stmt_getemergencyr->bind_param("s", $_GET['emergencyrid']);
    $stmt_getemergencyr->execute();
    $stmt_getemergencyr->store_result();
    $stmt_getemergencyr->bind_result($emergencyr);
    $stmt_getemergencyr->fetch();
    $stmt_getemergencyr->close();

    $query = "SELECT `transport` from `Transport` WHERE (`transportid`) = (?);";
    $stmt_gettransport = $con->prepare($query);
    $stmt_gettransport->bind_param("s", $_GET['transportid']);
    $stmt_gettransport->execute();
    $stmt_gettransport->store_result();
    $stmt_gettransport->bind_result($transport);
    $stmt_gettransport->fetch();
    $stmt_gettransport->close();

    $query = "SELECT `cooper` FROM `CooperGreen` WHERE `cooperid` = ?;";
    $stmt_gethealthfirst = $con->prepare($query);
    $stmt_gethealthfirst->bind_param("s", $_GET['health_first_card']);
    $stmt_gethealthfirst->execute();
    $stmt_gethealthfirst->store_result();
    $stmt_gethealthfirst->bind_result($healthfirst);
    $stmt_gethealthfirst->fetch();
    $stmt_gethealthfirst->close();
}

require_once("includes/menu.php");
//show the person their name and birth date
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
// set social services boolean to human-readable
$social_services = null;
if ($_GET['social_services'] == "0") {
    $social_services = "no";
} else if ($_GET['social_services'] == "1") {
    $social_services = "yes";
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
                <li>Name: $fname $lname</li>
                <li>DOB: $dob</li>
                <li>Why you are here: " . $_GET['pstat'] . "</li>
                <li>Reason for Visit: $reasonforvisit</li>
                <li>Social Services Needed: $social_services</li>

                <li>Type of Home: $hometype</li>
                <li>Address:" . $_GET['address_street'] . " $city" . $_GET['cityaddition'] . ", " . " $state " . $_GET['stateaddition'] . " " . " $zip " . $_GET['zipaddition'] . "</li>
                <li>Phone: " . $_GET['phone_number'] . "</li>
                <li>Email:" . $_GET['email_address'] . "</li>
                <li>Emergency Contact:". $_GET['emergency_name'] . "  Relation:" . $emergencyr . "  Number:" . $_GET['emergency_number'] . "</li>
                <li>Transportation: $transport</li>
                <li>Health First Card: " . $healthfirst . "</li>
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
foreach ($_GET as $get => $value) {
    if (is_array($value)){
        foreach($value as $array_value) {
            $query_string .= $get . "[]=" . $array_value . "&";
        }
    } else {
        $query_string .= $get . "=" . $value . "&";
    }
}
//$query_string = urlencode($query_string);
echo "              <a href=\"editpatientformdo.php?$query_string\" class=\"btn btn-primary btn-lg\">Submit Information</a>";
//END OF MODAL
?>
            </div>
          </div>
        </div>
      </div>
<?php
//accesses tables in database to create select options
$query = "SELECT `cityid`, `city` FROM `City` ORDER BY `city`;";
$stmt_city = $con->prepare($query);
$stmt_city->execute();
$stmt_city->store_result();
$stmt_city->bind_result($cityid, $city);

$query = "SELECT `stateid`, `state` FROM `State` ORDER BY `state`;";
$stmt_state = $con->prepare($query);
$stmt_state->execute();
$stmt_state->store_result();
$stmt_state->bind_result($stateid,$state);
        
$query = "SELECT `zipid`, `zip` FROM `Zip` ORDER BY `zip`;";
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

$query = "SELECT `cooperid`, `cooper` from `CooperGreen`;";
$stmt_health_first = $con->prepare($query);
$stmt_health_first->execute();
$stmt_health_first->store_result();
$stmt_health_first->bind_result($healthfirstid, $healthfirst);

// PULLING IN INFORMATION TO SET DEFAULT SELECTIONS
//uses patientid retrived earlier to find more information from patient table about the person in question
$query = "SELECT `fname`, `lname`, `dob`, `address_street`, `cityid`, `stateid`, `zipid`, `emergency_name`, `emergency_number`, `emergencyrid`, `phone_number`, `email_address` from `Patient` WHERE (`patientid`) = (?);";
$stmt_patient = $con->prepare($query) or die("Error: " . $con->error);
$stmt_patient->bind_param("s", $patientid);
$stmt_patient->execute();
$stmt_patient->store_result();
$stmt_patient->bind_result($fname, $lname, $dob, $address_streetselect, $cityidselect, $stateidselect, $zipidselect, $emergency_nameselect, $emergency_numberselect, $emergencyridselect, $phone_numberselect, $email_addressselect);
$stmt_patient->fetch();
//uses patientid retrieved earlier to find more information from social history table about person in question
$query = "SELECT `hometypeid`, `transportid`, `cooperid` from `SocialHistory` WHERE `patientid` = ?;";
$stmt_social = $con->prepare($query);
$stmt_social->bind_param("s", $patientid);
$stmt_social->execute();
$stmt_social->store_result();
$stmt_social->bind_result($hometypeidselect, $transportidselect, $healthfirstidselect);
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

echo "
      <h3 style=\"display: inline-block\"> Name: $fname $lname </h3>
      <h3 class=\"pull-right\"> Date of Birth: $dob </h3><br />
      <h4>Asterisks indicate required fields.</h4>";
 ?>
      <!-- Open the form - EVERYTHING BELOW THIS LINE IS EDITED IN THE DATABASE UPON SUBMISSION-->
      <form method="get" action="editpatientform.php" autocomplete="off">
      <!-- transfer patient id using the form but hide from user -->
        <input type="text" name="patientid" value="<?php echo $patientid; ?>" style="display: none;" />
        
        <!-- Ask them about Chief Complaint -->
        <div class="form-group">
          <label>*In your own words, What brings you to the clinic today?</label>
          <input required type="text" name="pstat" value="<?php echo $_GET['pstat']; ?>" class="form-control"/>
        </div>


          <!-- Ask them about Acute/Chronic etc. care -->
        <div class="form-group">
          <label>*Which option best describes the reason for your visit?</label>
          <select required name="reasonforvisitid" class="form-control"/>
            <option value=""></option>
<?php
while ($stmt_reasonforvisit->fetch()){        
  echo "            <option value=\"$reasonforvisitid\"";
  if ($_GET['reasonforvisitid'] == $reasonforvisitid){echo "selected";}
  echo ">$reasonforvisit</option>\n";
}
?>
          </select>
        </div>

        <!-- Social Services Needed -->
        <!-- boolean in the database so just hard-coded her -->
        <div class="form-group">
          <label>Do you need social services today (e.g. transportation, employment, housing)?</label>
          <select name="social_services" class="form-control" required>
            <option value=""></option>
            <option value="1" <?php if ($social_services == "yes") echo "selected"; ?>>Yes</option>
            <option value="0" <?php if ($social_services == "no") echo "selected"; ?>>No</option>
          </select>
        </div>

        <h4>Please review the information below and update it if necessary:</h4>
        
        <!-- Ask them about type of home -->
        <div class="form-group">
          <label>*What type of home do you live in?</label>
          <select required name="hometypeid" class="form-control">
<?php
while ($stmt_hometype->fetch()){        
    echo "            <option value=\"$hometypeid\"";
    if (isset($_GET['submit'])) {
    if ($_GET['hometypeid'] == $hometypeid){echo "selected";}
  }
  else{
    if ($hometypeidselect == $hometypeid){echo "selected";}//automatically select the information that is in the database
  }
    echo ">$hometype</option>\n";
}
?>
          </select>
        </div>
        
        <!-- Ask them about Address -->
        <div class="form-group">
          <label>Address:</label>
          <input type="text" name="address_street" value="<?php
    if (isset($_GET['submit'])) {echo $_GET['address_street'];}	
    else{echo $address_streetselect;} ?>" class="form-control"/><!-- automatically select the information that is in the database -->
        </div>

        <!-- Ask them about City -->
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6"> 
              <label for="citybox">City:</label>
              <select name="cityid" id ="citybox" class="form-control"/>
                <option value=""></option>
<?php
while ($stmt_city->fetch()){        
    echo "                <option value=\"$cityid\"";
  if (isset($_GET['submit'])) {
    if ($_GET['cityid'] == $cityid){echo "selected";}
  }	
  else{
    if ($cityidselect == $cityid){echo "selected";}//automatically select the information that is in the database
  }
    echo ">$city</option>\n";
}
?>
                </select>
              </div>

            <!-- Ask them about City Addition -->
            <div class="col-xs-6">
              <label for="cityadditionbox">Other city not listed:</label>
              <input type="text" name="cityaddition" id="cityadditionbox" value="<?php echo $_GET['cityaddition']; ?>" class="form-control"/><!-- automatically select the information that is in the database -->
            </div>
          </div>
        </div>
          
          <!-- Ask them about State -->
        <div class="form-group">
          <div class="row"> 
            <div class="col-xs-6">
              <label for="statebox">State:</label>
              <select name="stateid" id="statebox" class="form-control"/>	
                <option value=""></option>			
<?php
while ($stmt_state->fetch()){        
    echo "                <option value=\"$stateid\"";
  if (isset($_GET['submit'])) {
    if ($_GET['stateid'] == $stateid){echo "selected";}
  }	
  else{	
    if ($stateidselect == $stateid){echo "selected";}//automatically select the information that is in the database
  }
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
        </div>

        <!-- Ask them about Zip -->
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              <label for="zipbox">Zip:</label>
              <select name="zipid" id="zipbox" class="form-control"/>
                <option value=""></option>
<?php
while ($stmt_zip->fetch()){        
    echo "                <option value=\"$zipid\"";
  if (isset($_GET['submit'])) {
    if ($_GET['zipid'] == $zipid){echo "selected";}
  }	
  else{	
    if ($zipidselect == $zipid){echo "selected";}
  }
    echo ">$zip</option>\n";
}
?>
              </select>
            </div>

            <!-- Ask them about Zip Addition -->
            <div class="col-xs-6">
              <label for="zipadditionbox">Other zip not listed:</label>
              <input type="text" name="zipaddition" id="zipadditionbox" value="<?php echo $_GET['zipaddition']; ?>" class="form-control"/>
            </div>
          </div>
        </div>

        <!-- Ask them about Phone Number -->
        <div class="form-group">
          <label>Phone Number:</label>
          <input type="text" name="phone_number" value="<?php 
    if (isset($_GET['submit'])) {echo $_GET['phone_number'];}
    else{echo $phone_numberselect;} ?>" placeholder="xxx-xxx-xxxx" class="form-control"/>
        </div>
          
        <!-- Ask them about Email -->
        <div class="form-group">
          <label>Email:</label>
          <input type="text" name="email_address" value="<?php 
    if (isset($_GET['submit'])) {echo $_GET['phone_number'];}
    else{echo $email_addressselect;} ?>" class="form-control"/>
        </div>

        <div class="form-group">
          <label>Emergency Contact Information:</label>
          <div class="row"> 

            <!-- Ask them about Emergency Contact Name -->
            <div class="col-xs-4">
              <label for="emergencyname">Name:</label>
              <input type="text" name="emergency_name" id="emergencyname" value="<?php
        if (isset($_GET['submit'])) {echo $_GET['emergency_name'];}
        else{echo $emergency_nameselect;} ?>" class="form-control"/>
            </div>

            <div class="col-xs-4">
              <!-- Ask them about Emergency Contact Relationship -->
              <label for="emergencyr">Relation:</label>
              <select name="emergencyrid" id ="emergencyr" class="form-control"/>
                <option value=""></option>

<?php
while ($stmt_emergencyr->fetch()){        
    echo "                <option value=\"$emergencyrid\"";
  if (isset($_GET['submit'])) {
    if ($_GET['emergencyrid'] == $emergencyrid){echo "selected";}
  }	
  else{	
    if ($emergencyridselect == $emergencyrid){echo "selected";}
  }
    echo ">$emergencyr</option>\n";
}
?>
              </select>
            </div>

            <!-- Ask them about Emergency Contact Phone Number -->
            <div class="col-xs-4">
              <label for="emergencynumber">Phone Number:</label>
              <input type="text" name="emergency_number" id="emergencynumber" placeholder="xxx-xxx-xxxx" value="<?php 
      if (isset($_GET['submit'])) {echo $_GET['emergency_number'];}
      else{echo $emergency_numberselect;} ?>" class="form-control"/>
            </div>
          </div>
        </div>

      <h3>Healthcare Access</h3>  

      <!-- Ask them about transportation to the clinic -->
      <div class="form-group">
        <label>*How do you primarily get to clinic?</label>
        <select required name="transportid" class="form-control"/>
<?php
while ($stmt_transport->fetch()){        
    echo "          <option value=\"$transportid\"";
  if (isset($_GET['submit'])) {
    if ($_GET['transportid'] == $transportid){echo "selected";}
  }	
  else{
    if ($transportidselect == $transportid){echo "selected";}
  }
    echo ">$transport</option>\n";
}
?>
        </select>
      </div>

      <!-- TODO: add functionallity -->
      <div class="form-group">
        <label>Do you have a Health First card?</label>
        <select name="health_first_card" class="form-control" required>

<?php
while ($stmt_health_first->fetch()) {
    echo "          <option value=\"$healthfirstid\" ";
    
    if (isset($_GET['submit'])) {
        if ($_GET['health_first_card'] == $healthfirstid) echo "selected";
    } else {
        if ($healthfirstidselect == $healthfirstid) echo "selected";
    }

    echo ">$healthfirst</option>\n";
}
?>

        </select>
      </div>


      <h3>Medical History</h3>

      <!-- Ask them about Mammogram -->
      <div class="form-group">
        <label>Estimate Date of Last Mammogram:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="mammogram_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {
    if ($_GET['mammogram_month'] == $month){echo "selected";}
  }	
  else{	
    if (explode('-',$mammodate)[1] == $month){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['mammogram_day'] == $day){echo "selected";}
  }	
  else{
    if (explode('-',$mammodate)[2] == $day){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['mammogram_year'] == $year){echo "selected";}
  }	
  else{	
    if (explode('-',$mammodate)[0] == $year){echo "selected";}
  }
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
      </div>


      <div class="form-group">
        <label>Estimate Date of Last PAP Smear:</label>

        <!-- Ask them about PAP Smear -->
        <div class="row">
          <div class="col-xs-4">
            <select name="PAP_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {
    if ($_GET['PAP_month'] == $month){echo "selected";}
  }	
  else{		
    if (explode('-',$papdate)[1] == $month){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['PAP_day'] == $day){echo "selected";}
  }	
  else{	
    if (explode('-',$papdate)[2] == $day){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['PAP_year'] == $year){echo "selected";}
  }	
  else{		
    if (explode('-',$papdate)[0] == $year){echo "selected";}
  }
  echo ">$year</option>\n";
}
?>    
            </select>
          </div>
        </div>
      </div>

      <!-- Ask them about Colonoscopy -->
      <div class="form-group">
        <label>Estimate Date of Last Colonoscopy:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="colonoscopy_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {
    if ($_GET['colonoscopy_month'] == $month){echo "selected";}
  }	
  else{	
    if (explode('-',$colodate)[1] == $month){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['colonoscopy_day'] == $day){echo "selected";}
  }	
  else{	
    if (explode('-',$colodate)[2] == $day){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['colonoscopy_year'] == $year){echo "selected";}
  }	
  else{	
    if (explode('-',$colodate)[0] == $year){echo "selected";}
  }
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
      </div>

      <!-- Ask them about STI/STD -->
      <div class="form-group">
        <label>Estimate Date of Last STI/STD Test:</label>
        <div class="row">
          <div class="col-xs-4">
            <select name="STI_month" class="form-control"/>
              <option value="">-- Month --</option>
<?php
for ($month = 1; $month < 13; $month++) {
  echo "              <option value=\"$month\"";
  if (isset($_GET['submit'])) {
    if ($_GET['STI_month'] == $month){echo "selected";}
  }	
  else{	
    if (explode('-',$stidate)[1] == $month){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['STI_day'] == $day){echo "selected";}
  }	
  else{		
    if (explode('-',$stidate)[2] == $day){echo "selected";}
  }
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
  if (isset($_GET['submit'])) {
    if ($_GET['STI_year'] == $year){echo "selected";}
  }	
  else{		
    if (explode('-',$stidate)[0] == $year){echo "selected";}
  }
  echo ">$year</option>\n";
}
?>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-success" name="submit" value="Submit" /> 
      </div>
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

