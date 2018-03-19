<?php
error_reporting(E_ALL);
ini_set("displayed_errors",1);
//LOADING ALL VARIABLES FROM URL

// extract drugs from text (optionally enclosed by quotation marks)
preg_match_all('/"[^"]+?"(?=,?)|[^",]+(?=,?)/', $_GET['drugs'], $matches);
$drugs = $matches[0];

// extract allergies from get string (optionally enclosed by quotation marks)
preg_match_all('/"[^"]+?"(?=,?)|[^",]+(?=,?)/', $_GET['allergies'], $matches);
$allergies = $matches[0];

print_r($drugs);
print_r($allergies);
exit;
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$dob = $_GET['dob_year'] . "-" . $_GET['dob_month'] . "-" . $_GET['dob_day'];
$dobcheck1 = $_GET['dob_year'];
$dobcheck2 = $_GET['dob_month'];
$dobcheck3 = $_GET['dob_day'];
$address_street = $_GET['address_street'];

$cityid = $_GET['cityid'];
if ($cityid == "") $cityid = null;

$stateid = $_GET['stateid'];
if ($stateid == "") $stateid = null;

$zipid = $_GET['zipid'];
if ($zipid == "") $zipid = null;

$phone_number = $_GET['phone_number'];
$email_address = $_GET['email_address'];

$genderid = $_GET['genderid'];
if ($genderid == "") $genderid = null;

$ethnicityid = $_GET['ethnicityid'];
if ($zipid == "") $zipid = null;

$raceid = $_GET['raceid'];
if ($raceid == "") $raceid = null;
 
$languageid = $_GET['languageid']; 
if ($languageid == "") $languageid = null;
 
$citizenid = $_GET['citizenid']; 
if ($citizenid == "") $citizenid = null;
 
$hometypeid = $_GET['hometypeid']; 
if ($hometypeid == "") $hometypeid = null;
 
$housestatid = $_GET['housestatid']; 
if ($housestatid == "") $housestatid = null;
 
$numfammember = $_GET['numfammember'];
if ($numfammember == "") $numfammember = null;

$numchildren = $_GET['numchildren'];
if ($numchildren == "") $numchildren = null;

$relationshipid = $_GET['relationshipid'];
if ($relationshipid == "") $relationshipid = null;

$householdincome = $_GET['householdincome'];

$employmentid = $_GET['employmentid'];
if ($employmentid == "") $employmentid = null;

$disabilityid = $_GET['disabilityid'];
if ($disabilityid == "") $disabilityid = null;

$foodstampid = $_GET['foodstampid'];
if ($foodstampid == "") $foodstampid = null;

$veteranid = $_GET['veteranid'];
if ($veteranid == "") $veteranid = null;

$educationid = $_GET['educationid'];
if ($educationid == "") $educationid = null;

$insuranceid = $_GET['insuranceid'];
if ($insuranceid == "") $insuranceid = null;

$physicianid = $_GET['physicianid'];
if ($physicianid == "") $physicianid = null;

$health_first_id = $_GET['health_first_id'];
if ($health_first_id == "") $health_first_id = null;

$social_services = $_GET['social_services'];
if ($social_services == "") $social_services = null;

$timesmoked = $_GET['timesmoked'];
if ($timesmoked == "") $timesmoked = null;

$packsperday = $_GET['packsperday'];
if ($packsperday == "") $packsperday = null;

$alcoholid = $_GET['alcoholid'];
if ($alcoholid == "") $alcoholid = null;

$transportid = $_GET['transportid'];
if ($transportid == "") $transportid = null;

$heareab = $_GET['heareab'];
$reasonforvisitid = $_GET['reasonforvisitid'];
if ($reasonforvisitid == "") $reasonforvisitid = null;

$mammogram = $_GET['mammogram_year'] . "-" . $_GET['mammogram_month'] . "-" . $_GET['mammogram_day'];
$colonoscopy = $_GET['colonoscopy_year'] . "-" . $_GET['colonoscopy_month'] . "-" . $_GET['colonoscopy_day'];
$sti = $_GET['STI_year'] . "-" . $_GET['STI_month'] . "-" . $_GET['STI_day'];
$papsmear = $_GET['PAP_year'] . "-" . $_GET['PAP_month'] . "-" . $_GET['PAP_day'];
$submit = $_GET['Submit'];
$pstat = $_GET['pstat'];
$currentdate = date("Ymd");
$visittypeid = 2;
$emergency_name = $_GET['emergency_name'];

$emergencyrid = $_GET['emergencyrid'];
if ($emergencyrid == "") $emergencyrid = null;

$emergency_number = $_GET['emergency_number'];

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db);

// This query counts the number of entries in the table that have the submitted fname, lname, dob, and street address
$query = "SELECT COUNT(*) FROM `Patient` WHERE fname = ? and lname = ? and dob = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("sss", $fname, $lname, $dob);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

//requiring that the necessary fields were filled in and error check that ensures duplicate individuals don't get added to the roster  
if ($fname && $lname && $dobcheck1 && $dobcheck2 && $dobcheck3 && $genderid && $ethnicityid && $raceid && $languageid && $citizenid && $hometypeid && $housestatid && $numfammember && $numchildren !== "null" && $relationshipid && $householdincome !== "null" && $employmentid && $disabilityid && $foodstampid && $veteranid && $educationid && $insuranceid && $physicianid && $health_first_id && ! is_null($social_services) && $alcoholid && $transportid && $heareab && $reasonforvisitid && $pstat && !$count){

    //calculating info based on reported smoking history
    $smokingstatus = $_GET["smokingstatus"];

    if ($smokingstatus == 2){ 
    //calculating start date and quit date for pastsmoker
        $quitdatecalc = $_GET["quitdate"];
        $startdatecalc = $quitdatecalc - $timesmoked;
        $startdate = "$startdatecalc".date("md");
        $quitdate = "$quitdatecalc".date("md");
    }
    elseif ($smokingstatus == 3){
    //calculating start date for currentsmoker
        $startdatecalc = date("Y") - $timesmoked;
        $startdate = "$startdatecalc".date("md");
    }
    //Pre-loading additions submitted by patient
    $cityaddition = strtolower($_GET["cityaddition"]);
    $stateaddition = strtolower($_GET["stateaddition"]);
    $zipaddition = $_GET["zipaddition"];
    $drugaddition = strtolower($_GET["drugaddition"]);
    $allergyaddition = strtolower($_GET["allergyaddition"]);
    $languageaddition = strtolower($_GET["languageaddition"]);    
    

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
        
        if ($iscitythere == 0){   //if city is not in database
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

    // ADDING NEW LANGUAGE TO PRIMARYLANGUAGE TABLE -- SAME AS DOCUMENTED ABOVE
    if ($languageaddition) {
        $languageaddition = ucwords($languageaddition);
            
        $query = "SELECT COUNT(`language`) from `PrimaryLanguage` WHERE (`language`) = (?);";
        $stmt_languagecount = $con->prepare($query);
        $stmt_languagecount->bind_param("s", $languageaddition);
        $stmt_languagecount->execute();
        $stmt_languagecount->store_result();
        $stmt_languagecount->bind_result($islanguagethere);
        $stmt_languagecount->fetch();
        $stmt_languagecount->close();
        
        if ($islanguagethere == 0){
            $query = "INSERT INTO `PrimaryLanguage` (`language`) VALUES (?)";
            $stmt_languageinsert = $con->prepare($query);
            $stmt_languageinsert->bind_param("s", $languageaddition);
            $stmt_languageinsert->execute();
            $stmt_languageinsert->close();
            
            $query = "SELECT `languageid` from `PrimaryLanguage` WHERE (`language`) = (?);";
            $stmt_newlanguageid = $con->prepare($query);
            $stmt_newlanguageid->bind_param("s", $languageaddition);
            $stmt_newlanguageid->execute();
            $stmt_newlanguageid->store_result();
            $stmt_newlanguageid->bind_result($languageid);
            $stmt_newlanguageid->fetch();
            $stmt_newlanguageid->close();
        }
        elseif ($islanguagethere == 1){
            $query = "SELECT `languageid` from `PrimaryLanguage` WHERE (`language`) = (?);";
            $stmt_getlanguageid = $con->prepare($query);
            $stmt_getlanguageid->bind_param("s", $languageaddition);
            $stmt_getlanguageid->execute();
            $stmt_getlanguageid->store_result();
            $stmt_getlanguageid->bind_result($languageid);
            $stmt_getlanguageid->fetch();
            $stmt_getlanguageid->close();
        }
    }

    // ADDING NEW DRUGTYPES TO DRUGTYPE TABLE -- SAME AS DOCUMENTED ABOVE
    // if ($drugaddition) {
    //     $drugaddition = ucwords($drugaddition);
        
    //     $query = "SELECT COUNT(`drugtype`) from `DrugType` WHERE (`drugtype`) = (?);";
    //     $stmt_drugcount = $con->prepare($query);
    //     $stmt_drugcount->bind_param("s", $drugaddition);
    //     $stmt_drugcount->execute();
    //     $stmt_drugcount->store_result();
    //     $stmt_drugcount->bind_result($isdrugthere);
    //     $stmt_drugcount->fetch();
    //     $stmt_drugcount->close();
        
    //     if ($isdrugthere == 0){
    //         $query = "INSERT INTO `DrugType` (`drugtype`) VALUES (?)";
    //         $stmt_druginsert = $con->prepare($query);
    //         $stmt_druginsert->bind_param("s", $drugaddition);
    //         $stmt_druginsert->execute();
    //         $stmt_druginsert->close();
            
    //         $query = "SELECT `drugtypeid` from `DrugType` WHERE (`drugtype`) = (?);";
    //         $stmt_newdrugid = $con->prepare($query);
    //         $stmt_newdrugid->bind_param("s", $drugaddition);
    //         $stmt_newdrugid->execute();
    //         $stmt_newdrugid->store_result();
    //         $stmt_newdrugid->bind_result($drugs[]);
    //         $stmt_newdrugid->fetch();
    //         $stmt_newdrugid->close();
    //     }
    //     elseif ($isdrugthere == 1){
    //         $query = "SELECT `drugtypeid` from `DrugType` WHERE (`drugtype`) = (?);";
    //         $stmt_getdrugid = $con->prepare($query);
    //         $stmt_getdrugid->bind_param("s", $drugaddition);
    //         $stmt_getdrugid->execute();
    //         $stmt_getdrugid->store_result();
    //         $stmt_getdrugid->bind_result($drugs[]);
    //         $stmt_getdrugid->fetch();
    //         $stmt_getdrugid->close();
    //     }
    // }

    // // ADDING NEW ALLERGY TO ALLERGYLIST TABLE -- SAME AS DOCUMENTED ABOVE
    // if ($allergyaddition) {
    //     $allergyaddition = ucwords($allergyaddition);
        
    //     $query = "SELECT COUNT(`allergylist`) from `AllergyList` WHERE (`allergylist`) = (?);";
    //     $stmt_allergycount = $con->prepare($query);
    //     $stmt_allergycount->bind_param("s", $allergyaddition);
    //     $stmt_allergycount->execute();
    //     $stmt_allergycount->store_result();
    //     $stmt_allergycount->bind_result($isallergythere);
    //     $stmt_allergycount->fetch();
    //     $stmt_allergycount->close();
        
    //     if ($isallergythere == 0){
    //         $query = "INSERT INTO `AllergyList` (`allergylist`) VALUES (?)";
    //         $stmt_allergyinsert = $con->prepare($query);
    //         $stmt_allergyinsert->bind_param("s", $allergyaddition);
    //         $stmt_allergyinsert->execute();
    //         $stmt_allergyinsert->close();
            
    //         $query = "SELECT `allergylistid` from `AllergyList` WHERE (`allergylist`) = (?);";
    //         $stmt_newallergyid = $con->prepare($query);
    //         $stmt_newallergyid->bind_param("s", $allergyaddition);
    //         $stmt_newallergyid->execute();
    //         $stmt_newallergyid->store_result();
    //         $stmt_newallergyid->bind_result($allergies[]);
    //         $stmt_newallergyid->fetch();
    //         $stmt_newallergyid->close();
    //     }
    //     elseif ($isallergythere == 1){
    //         $query = "SELECT `allergylistid` from `AllergyList` WHERE (`allergylist`) = (?);";
    //         $stmt_getallergyid = $con->prepare($query);
    //         $stmt_getallergyid->bind_param("s", $allergyaddition);
    //         $stmt_getallergyid->execute();
    //         $stmt_getallergyid->store_result();
    //         $stmt_getallergyid->bind_result($allergies[]);
    //         $stmt_getallergyid->fetch();
    //         $stmt_getallergyid->close();
    //     }
    // }


    //INSERT PATIENT DATA THAT WAS SUBMITED INTO PATIENT TABLE

    $query = "INSERT INTO `Patient` (`fname`, `lname`, `genderid`, `raceid`, `ethnicityid`, `dob`, `address_street`, `cityid`, `stateid`, `zipid`, `emergencyrid`, `phone_number`, `email_address`, `emergency_name`, `emergency_number`, `citizenid`, `languageid`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt_patient = $con->prepare($query);
    $stmt_patient->bind_param("sssssssssssssssss", $fname, $lname, $genderid, $raceid, $ethnicityid, $dob, $address_street, $cityid, $stateid, $zipid, $emergencyrid, $phone_number, $email_address, $emergency_name, $emergency_number, $citizenid, $languageid);
    $stmt_patient->execute();
    $stmt_patient->store_result();
    $stmt_patient->close();

    // find the patientid for the patient just submitted
    $query = "SELECT `patientid` from `Patient` WHERE (`fname`, `lname`, `dob`) = (?, ?, ?);";
    $stmt_patientid = $con->prepare($query);
    $stmt_patientid->bind_param("sss", $fname, $lname, $dob);
    $stmt_patientid->execute();
    $stmt_patientid->store_result();
    $stmt_patientid->bind_result($patientid);
    $stmt_patientid->fetch();
    $stmt_patientid->close();

    //INSERT SOCIAL HISTORY DATA THAT WAS SUMBITTED INTO SOCIAL HISTORY TABLE USING PATIENTID JUST FOUND
    $query = "INSERT INTO `SocialHistory` (`householdincome`, `numchildren`, `numfammember`, `heareab`, `cooperid`, `physicianid`, `educationid`, `housestatid`, `insuranceid`, `disabilityid`, `veteranid`, `employmentid`, `relationshipid`, `alcoholid`, `foodstampid`, `hometypeid`, `transportid`, `patientid`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt_socialhistory = $con->prepare($query);
    $stmt_socialhistory->bind_param("ssssssssssssssssss", $householdincome, $numchildren, $numfammember, $heareab, $health_first_id, $physicianid, $educationid, $housestatid, $insuranceid, $disabilityid, $veteranid, $employmentid, $relationshipid, $alcoholid, $foodstampid, $hometypeid, $transportid, $patientid);
    $stmt_socialhistory->execute();
    $stmt_socialhistory->store_result();
    $stmt_socialhistory->close();

    // find the sid for the patient just submitted
    $query = "SELECT `sid` from `SocialHistory` WHERE (`householdincome`, `numchildren`, `numfammember`, `heareab`, `cooperid`, `physicianid`, `educationid`, `housestatid`, `insuranceid`, `disabilityid`, `veteranid`, `employmentid`, `relationshipid`, `alcoholid`, `foodstampid`, `hometypeid`, `transportid`, `patientid`) = (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt_sid = $con->prepare($query);
    $stmt_sid->bind_param("ssssssssssssssssss", $householdincome, $numchildren, $numfammember, $heareab, $health_first_id, $physicianid, $educationid, $housestatid, $insuranceid, $disabilityid, $veteranid, $employmentid, $relationshipid, $alcoholid, $foodstampid, $hometypeid, $transportid, $patientid);
    $stmt_sid->execute();
    $stmt_sid->store_result();
    $stmt_sid->bind_result($sid);
    $stmt_sid->fetch();
    $stmt_sid->close();

    // store patient visit info in PatientVisit table using patientid found previously
    $query = "INSERT INTO `PatientVisit` (`pstat`, `currentdate`, `reasonforvisitid`, `visittypeid`, `patientid`, `socialservicesneeded`) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt_patientvisit = $con->prepare($query);
    $stmt_patientvisit->bind_param("ssssss", $pstat, $currentdate, $reasonforvisitid, $visittypeid, $patientid, $social_services);
    $stmt_patientvisit->execute();
    $stmt_patientvisit->store_result();
    $stmt_patientvisit->close();

    // store patient allergy information in PatientAllergy table using patientid found previously
    $query = "SELECT `allergylistid`, COUNT(*) FROM `AllergyList` WHERE `allergylist` = ?;";
    $stmt_allergy_exists = $con->prepare($query);
    $stmt_allergy_exists->bind_param("s", $allergy);

    $query = "INSERT INTO `AllergyList` (`allergylist`) VALUES (?);";
    $stmt_insert_new_allergy = $con->prepare($query);
    $stmt_insert_new_allergy->bind_param("s", $allergy);

    $query = "INSERT INTO `PatientAllergy` (`allergylistid`, `patientid`) VALUES (?, ?);";
    $stmt_patientallergy = $con->prepare($query);
    $stmt_patientallergy->bind_param("ss", $allergy, $patientid); 
    
    foreach ($allergies as $allergy) { // for each allergy in the array "allergies" defined at the top
        // Standardize allergy names and remove optional quotation marks
        $allergy = ucwords(str_replace("\"", "", $allergy));

        $stmt_allergy_exists->execute();
        $stmt_allergy_exists->store_result();
        $stmt_allergy_exists->bind_result($allergylistid, $allergy_count);

        if (! $allergy_count) {
            $stmt_insert_new_allergy->execute();
            $allergylistid = $con->insert_id;
        }

        $stmt_patientallergy->execute(); //store the drug in the array w/ the person's patientid in the Patient Allergy Table
        $stmt_patientallergy->store_result();
    }
    $stmt_patientallergy->close();
    //store the smoking status and values calculated for each one previously while using sid found previously
    if ($smokingstatus == 3){
        $query = "INSERT INTO `CurrentSmoker` (`sid`, `startdate`, `packsperday`) VALUES (?, ?, ?);";
        $stmt_currentsmoker = $con->prepare($query);
        $stmt_currentsmoker->bind_param("sss", $sid, $startdate, $packsperday);
        $stmt_currentsmoker->execute();
        $stmt_currentsmoker->store_result();
        $stmt_currentsmoker->close();
    }

    if ($smokingstatus == 2){
        $query = "INSERT INTO `PastSmoker` (`sid`, `startdate`, `quitdate`, `packsperday`) VALUES (?, ?, ?, ?);";
        $stmt_pastsmoker = $con->prepare($query);
        $stmt_pastsmoker->bind_param("ssss", $sid, $startdate, $quitdate, $packsperday);
        $stmt_pastsmoker->execute();
        $stmt_pastsmoker->store_result();
        $stmt_pastsmoker->close();
    }

    //store drug informaiton in SocialDrugs table using sid found previously
    $query = "SELECT `drugtypeid`, COUNT(*) FROM `DrugType` WHERE `drugtype` = ?;";
    $stmt_drug_exists = $con->prepare($query);
    $stmt_drug_exists->bind_param("s", $drug);

    $query = "INSERT INTO `DrugType` (`drugtype`) VALUES (?);";
    $stmt_insert_new_drug = $con->prepare($query);
    $stmt_insert_new_drug->bind_param("s", $drug);

    $query = "INSERT INTO `SocialDrugs` (`drugtypeid`, `sid`) VALUES (?, ?);";
    $stmt_socialdrugs = $con->prepare($query);
    $stmt_socialdrugs->bind_param("ss", $drug_id, $sid);
    foreach ($drugs as $drug) { //for each drug in the array "drugs" defined at the top
        // get rid of quotation marks if they are there
        $drug = ucwords(str_replace("\"", "", $drug));

        $stmt_drug_exists->execute();
        $stmt_drug_exists->store_result();
        $stmt_drug_exists->bind_result($drug_id, $drug_count);

        if (! $drug_count) {
            $stmt_insert_new_drug->execute();
            $drug_id = $con->insert_id;
        }

        $stmt_socialdrugs->execute(); //store the drug in the array w/ the person's sid (social history id) in the Social Drugs Table
        $stmt_socialdrugs->store_result();
    }
    $stmt_socialdrugs->close();

    //store mammogram date using patientid found previously
    $query = "INSERT INTO `Mammogram` (`patientid`, `mammogram`) VALUES (?, ?);";
    $stmt_mammogram = $con->prepare($query);
    $stmt_mammogram->bind_param("ss", $patientid, $mammogram);
    $stmt_mammogram->execute();
    $stmt_mammogram->store_result();
    $stmt_mammogram->close();

    //store STI date using patientid found previously
    $query = "INSERT INTO `STI` (`patientid`, `sti`) VALUES (?, ?);";
    $stmt_sti = $con->prepare($query);
    $stmt_sti->bind_param("ss", $patientid, $sti);
    $stmt_sti->execute();
    $stmt_sti->store_result();
    $stmt_sti->close();

    //store colonoscopy date using patientid found previously
    $query = "INSERT INTO `Colonoscopy` (`patientid`, `colonoscopy`) VALUES (?, ?);";
    $stmt_colonoscopy = $con->prepare($query);
    $stmt_colonoscopy->bind_param("ss", $patientid, $colonoscopy);
    $stmt_colonoscopy->execute();
    $stmt_colonoscopy->store_result();
    $stmt_colonoscopy->close();

    //store mammogram date using patientid found previously
    $query = "INSERT INTO `PapSmear` (`patientid`, `papsmear`) VALUES (?, ?);";
    $stmt_papsmear = $con->prepare($query);
    $stmt_papsmear->bind_param("ss", $patientid, $papsmear);
    $stmt_papsmear->execute();
    $stmt_papsmear->store_result();
    $stmt_papsmear->close();
}
?>

<?php include("includes/header_require_login.php"); ?> 

      <title>EAB Database</title>

<?php require_once("includes/menu.php"); ?>
<?php
if ($fname && $lname && $dobcheck1 && $dobcheck2 && $dobcheck3 && $genderid && $ethnicityid && $raceid && $languageid && $citizenid && $hometypeid && $housestatid && $numfammember && $numchildren !== "null" && $relationshipid && $householdincome !== "null" && $employmentid && $disabilityid && $foodstampid && $veteranid && $educationid && $insuranceid && $physicianid && $health_first_id && ! is_null($social_services) && $alcoholid && $transportid && $heareab && $reasonforvisitid && $pstat){
    if (!$count){
        echo "    <h1>Your information has been recorded. Please take the tablet to the receptionist.</h1>"; //if all required fields have been filled, display this
    }
    else {
      echo"    <h1>Please do not refresh the page. Please take the tablet to the receptionist.</h1>";
    }
}
else{
    echo"    <h1>You missed a required field. Please fill in all required fields.</h1>"; //if the fields were not filled, display this
    echo"    <INPUT Type=\"button\" class=\"btn btn-success btn-lg\" VALUE=\"Return to Form\" onClick=\"history.go(-1);return true;\">";
}
?>
<?php require_once("includes/footer.php"); ?>