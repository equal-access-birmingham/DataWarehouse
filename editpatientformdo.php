<?php
//pulling variables from URL
$patientid = $_GET['patientid'];
$hometypeid = $_GET['hometypeid'];
$address_street = $_GET['address_street'];
$cityid = $_GET['cityid'];
$stateid = $_GET['stateid'];
$zipid = $_GET['zipid'];
$emergency_name = $_GET['emergency_name'];
$emergencyrid = $_GET['emergencyrid'];
$emergency_number = $_GET['emergency_number'];
$mammogram = $_GET['mammogram_year'] . "-" . $_GET['mammogram_month'] . "-" . $_GET['mammogram_day'];
$colonoscopy = $_GET['colonoscopy_year'] . "-" . $_GET['colonoscopy_month'] . "-" . $_GET['colonoscopy_day'];
$sti = $_GET['STI_year'] . "-" . $_GET['STI_month'] . "-" . $_GET['STI_day'];
$papsmear = $_GET['PAP_year'] . "-" . $_GET['PAP_month'] . "-" . $_GET['PAP_day'];
$visittypeid = 3;
$reasonforvisitid = $_GET['reasonforvisitid'];
$transportid = $_GET['transportid'];
$pstat = $_GET['pstat'];
$currentdate = date("Ymd");
$phone_number = $_GET['phone_number'];
$email_address = $_GET['email_address'];
$submit = $_GET['Submit'];

$cityaddition = strtolower($_GET["cityaddition"]);
$stateaddition = strtolower($_GET["stateaddition"]);
$zipaddition = $_GET["zipaddition"];

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db);
// This query counts the number of entries in the table that have the submitted chief complaint, date, person, and reason for visit
$query = "SELECT COUNT(*) FROM `PatientVisit` WHERE patientid = ? and currentdate = ? and pstat = ? and reasonforvisitid = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ssss", $patientid, $currentdate, $pstat, $reasonforvisitid);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

//requiring that the necessary fields were filled in
if ($hometypeid && $reasonforvisitid && $pstat && $visittypeid && $emergency_name && $emergencyrid && $emergency_number && $transportid && !$count){
// ADDING NEW CITY TO CITY TABLE IN DATABASE
if ($cityaddition) {
  //preloading input (was already lower case) and changing it so first letter of each word is capital
  $cityaddition = ucwords($cityaddition);
  //finding that string made above in city table of database  
  $query = "SELECT COUNT(`city`) from `City` WHERE (`city`) = (?);";
  $stmt_citycount = $con->prepare($query);
  $stmt_citycount->bind_param("s", $cityaddition);
  $stmt_citycount->execute();
  $stmt_citycount->store_result();
  $stmt_citycount->bind_result($iscitythere);
  $stmt_citycount->fetch();
  $stmt_citycount->close();

  if ($iscitythere == 0){ //if city is not in database
    //put a new row in the database with city submitted
    $query = "INSERT INTO `City` (`city`) VALUES (?)";
    $stmt_cityinsert = $con->prepare($query);
    $stmt_cityinsert->bind_param("s", $cityaddition);
    $stmt_cityinsert->execute();
    $stmt_cityinsert->close();
    //get the cityid of the city just added
    $query = "SELECT `cityid` from `City` WHERE (`city`) = (?);";
    $stmt_newcityid = $con->prepare($query);
    $stmt_newcityid->bind_param("s", $cityaddition);
    $stmt_newcityid->execute();
    $stmt_newcityid->store_result();
    $stmt_newcityid->bind_result($cityid);
    $stmt_newcityid->fetch();
    $stmt_newcityid->close();
    }
  elseif ($iscitythere == 1){ //if the city was already in the database
    // don't add anything but return the cityid of the city in the database (this corrects for user error especially with capitalization)
	$query = "SELECT `cityid` from `City` WHERE (`city`) = (?);";
    $stmt_getcityid = $con->prepare($query);
    $stmt_getcityid->bind_param("s", $cityaddition);
    $stmt_getcityid->execute();
    $stmt_getcityid->store_result();
    $stmt_getcityid->bind_result($cityid);
    $stmt_getcityid->fetch();
    $stmt_getcityid->close();
  }
}

// ADDING NEW STATE TO STATE TABLE -- SAME AS DOCUMENTED ABOVE
if ($stateaddition) {
  $stateaddition = ucwords($stateaddition);
    
  $query = "SELECT COUNT(`state`) from `State` WHERE (`state`) = (?);";
  $stmt_statecount = $con->prepare($query);
  $stmt_statecount->bind_param("s", $stateaddition);
  $stmt_statecount->execute();
  $stmt_statecount->store_result();
  $stmt_statecount->bind_result($isstatethere);
  $stmt_statecount->fetch();
  $stmt_statecount->close();

  if ($isstatethere == 0){
      
    $query = "INSERT INTO `State` (`state`) VALUES (?)";
    $stmt_stateinsert = $con->prepare($query);
    $stmt_stateinsert->bind_param("s", $stateaddition);
    $stmt_stateinsert->execute();
    $stmt_stateinsert->close();
    
    $query = "SELECT `stateid` from `State` WHERE (`state`) = (?);";
    $stmt_newstateid = $con->prepare($query);
    $stmt_newstateid->bind_param("s", $stateaddition);
    $stmt_newstateid->execute();
    $stmt_newstateid->store_result();
    $stmt_newstateid->bind_result($stateid);
    $stmt_newstateid->fetch();
    $stmt_newstateid->close();
  }
  elseif ($isstatethere == 1){
    $query = "SELECT `stateid` from `State` WHERE (`state`) = (?);";
    $stmt_getstateid = $con->prepare($query);
    $stmt_getstateid->bind_param("s", $stateaddition);
    $stmt_getstateid->execute();
    $stmt_getstateid->store_result();
    $stmt_getstateid->bind_result($stateid);
    $stmt_getstateid->fetch();
    $stmt_getstateid->close();
  }
}

// ADDING NEW ZIP TO ZIP TABLE -- SAME AS DOCUMENTED ABOVE
if ($zipaddition) {
    
  $query = "SELECT COUNT(`zip`) from `Zip` WHERE (`zip`) = (?);";
  $stmt_zipcount = $con->prepare($query);
  $stmt_zipcount->bind_param("s", $zipaddition);
  $stmt_zipcount->execute();
  $stmt_zipcount->store_result();
  $stmt_zipcount->bind_result($iszipthere);
  $stmt_zipcount->fetch();
  $stmt_zipcount->close();
  
  if ($iszipthere == 0){
      
    $query = "INSERT INTO `Zip` (`zip`) VALUES (?)";
    $stmt_zipinsert = $con->prepare($query);
    $stmt_zipinsert->bind_param("s", $zipaddition);
    $stmt_zipinsert->execute();
    $stmt_zipinsert->close();
    
    $query = "SELECT `zipid` from `Zip` WHERE (`zip`) = (?);";
    $stmt_newzipid = $con->prepare($query);
    $stmt_newzipid->bind_param("s", $zipaddition);
    $stmt_newzipid->execute();
    $stmt_newzipid->store_result();
    $stmt_newzipid->bind_result($zipid);
    $stmt_newzipid->fetch();
    $stmt_newzipid->close();
  }
  elseif ($iszipthere == 1){
    $query = "SELECT `zipid` from `Zip` WHERE (`zip`) = (?);";
    $stmt_getzipid = $con->prepare($query);
    $stmt_getzipid->bind_param("s", $zipaddition);
    $stmt_getzipid->execute();
    $stmt_getzipid->store_result();
    $stmt_getzipid->bind_result($zipid);
    $stmt_getzipid->fetch();
    $stmt_getzipid->close();
  }
}
//changing PATIENT TABLE information to match the information submitted in editpatientform.php
$query = "UPDATE `Patient` SET `address_street` = ?, `cityid` = ?, `stateid` = ?, `zipid` = ?, `phone_number` = ?, `email_address` = ?, `emergency_name` = ?, `emergency_number` = ?, `emergencyrid` = ? WHERE `patientid` = ?;";
$stmt_city = $con->prepare($query) or die("Error: " . $con->error);
$stmt_city->bind_param("ssssssssss",$address_street, $cityid, $stateid, $zipid, $phone_number, $email_address, $emergency_name, $emergency_number, $emergencyrid, $patientid);
$stmt_city->execute();
$stmt_city->close();
//changing SOCIAL HISTORY TABLE information to match the information submitted in editpatientform.php
$query = "UPDATE `SocialHistory` SET `hometypeid` = ? WHERE `patientid` = ?;";
$stmt_hometype = $con->prepare($query) or die("Error: " . $con->error);
$stmt_hometype->bind_param("ss",$hometypeid, $patientid);
$stmt_hometype->execute();
$stmt_hometype->close();
//changing MAMMOGRAM TABLE information to match the information submitted in editpatientform.php
$query = "UPDATE `Mammogram` SET `mammogram` = ? WHERE `patientid` = ?;";
$stmt_mammogram = $con->prepare($query) or die("Error: " . $con->error);
$stmt_mammogram->bind_param("ss",$mammogram, $patientid);
$stmt_mammogram->execute();
$stmt_mammogram->close();
//changing COLONOSCOPY TABLE information to match the information submitted in editpatientform.php
$query = "UPDATE `Colonoscopy` SET `colonoscopy` = ? WHERE `patientid` = ?;";
$stmt_colonoscopy = $con->prepare($query) or die("Error: " . $con->error);
$stmt_colonoscopy->bind_param("ss",$colonoscopy, $patientid);
$stmt_colonoscopy->execute();
$stmt_colonoscopy->close();
//changing STI information to match the information submitted in editpatientform.php
$query = "UPDATE `STI` SET `sti` = ? WHERE `patientid` = ?;";
$stmt_sti = $con->prepare($query) or die("Error: " . $con->error);
$stmt_sti->bind_param("ss",$sti, $patientid);
$stmt_sti->execute();
$stmt_sti->close();
//changing PAPSMEAR TABLE information to match the information submitted in editpatientform.php
$query = "UPDATE `PapSmear` SET `papsmear` = ? WHERE `patientid` = ?;";
$stmt_papsmear = $con->prepare($query) or die("Error: " . $con->error);
$stmt_papsmear->bind_param("ss",$papsmear, $patientid);
$stmt_papsmear->execute();
$stmt_papsmear->close();
//ADDING NEW INFORMATION to Patient Visit Table for info that changes every visit e.g. chief complaint from information submitted in editpatientform.php
$query = "INSERT INTO `PatientVisit` (`pstat`, `currentdate`, `reasonforvisitid`, `visittypeid`, `patientid`) VALUES (?, ?, ?, ?, ?);";
$stmt_patientvisit = $con->prepare($query);
$stmt_patientvisit->bind_param("sssss", $pstat, $currentdate, $reasonforvisitid, $visittypeid, $patientid);
$stmt_patientvisit->execute();
$stmt_patientvisit->store_result();
$stmt_patientvisit->close();
}
?>
<?php include("includes/header_require_login.php"); ?>
      <title>EAB Database</title>       
<?php require_once("includes/menu.php"); ?>
<?php
  //requiring that the necessary fields were filled in
  if ($hometypeid && $reasonforvisitid && $pstat && $visittypeid && $emergency_name && $emergencyrid && $emergency_number && $transportid){
        if (!$count){
			echo "<h1>Your information has been recorded. Please take the tablet to the receptionist.</h1>"; //if all required fields have been filled, display this
		}
		else {
			echo"<h1>Please do not refresh the page. Please take the tablet to the receptionist.</h1>";
		}
    }
    else{ //if they didn't fill in the necessary info
        echo"      <h1>You missed a required field. Please fill in all required fields.</h1>";
    }
?>
<?php require_once("includes/footer.php"); ?>