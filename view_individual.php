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
$query = "SELECT `PrimaryLanguage_add`.`fname`, `PrimaryLanguage_add`.`lname`, `PrimaryLanguage_add`.`dob`, `PrimaryLanguage_add`.`address_street`, `PrimaryLanguage_add`.`city`, `PrimaryLanguage_add`.`state`, `PrimaryLanguage_add`.`zip`, `PrimaryLanguage_add`.`phone_number`, `PrimaryLanguage_add`.`email_address`, `PrimaryLanguage_add`.`emergency_name`, `EmergencyR`.`emergencyr`, `PrimaryLanguage_add`.`emergency_number`, `PrimaryLanguage_add`.`gender`, `PrimaryLanguage_add`.`race`, `PrimaryLanguage_add`.`ethnicity`, `PrimaryLanguage_add`.`language`, `PrimaryLanguage_add`.`citizen`
FROM (
  SELECT `CitizenStatus_add`.`patientid`, `CitizenStatus_add`.`fname`, `CitizenStatus_add`.`lname`, `CitizenStatus_add`.`emergency_name`, `CitizenStatus_add`.`emergency_number`, `CitizenStatus_add`.`emergencyrid`,  `CitizenStatus_add`.`dob`, `CitizenStatus_add`.`address_street`, `CitizenStatus_add`.`city`, `CitizenStatus_add`.`state`, `CitizenStatus_add`.`zip`, `CitizenStatus_add`.`phone_number`, `CitizenStatus_add`.`email_address`, `CitizenStatus_add`.`gender`, `CitizenStatus_add`.`race`, `CitizenStatus_add`.`ethnicity`, `PrimaryLanguage`.`language`, `CitizenStatus_add`.`citizen`  
      FROM (
        SELECT `CitizenStatus`.`citizen`, `Zip_add`.`patientid`, `Zip_add`.`fname`, `Zip_add`.`lname`, `Zip_add`.`emergency_name`, `Zip_add`.`emergency_number`, `Zip_add`.`emergencyrid`,  `Zip_add`.`dob`, `Zip_add`.`address_street`, `Zip_add`.`phone_number`, `Zip_add`.`email_address`, `Zip_add`.`citizenid`, `Zip_add`.`languageid`, `Zip_add`.`gender`, `Zip_add`.`race`, `Zip_add`.`ethnicity`, `Zip_add`.`city`, `Zip_add`.`state`, `Zip_add`.`zip`   
          FROM (
            SELECT `Zip`.`zip`, `State_add`.`patientid`, `State_add`.`fname`, `State_add`.`lname`, `State_add`.`emergency_name`, `State_add`.`emergency_number`, `State_add`.`emergencyrid`,  `State_add`.`dob`, `State_add`.`address_street`, `State_add`.`zipid`, `State_add`.`phone_number`, `State_add`.`email_address`, `State_add`.`citizenid`, `State_add`.`languageid`, `State_add`.`gender`, `State_add`.`race`, `State_add`.`ethnicity`, `State_add`.`city`, `State_add`.`state` 
              FROM (
                SELECT `State`.`state`, `City_add`.`patientid`,`City_add`.`fname`, `City_add`.`lname`, `City_add`.`emergency_name`, `City_add`.`emergency_number`, `City_add`.`emergencyrid`,  `City_add`.`dob`, `City_add`.`address_street`, `City_add`.`stateid`, `City_add`.`zipid`, `City_add`.`phone_number`, `City_add`.`email_address`, `City_add`.`citizenid`, `City_add`.`languageid`, `City_add`.`gender`, `City_add`.`race`, `City_add`.`ethnicity`, `City_add`.`city` 
                  FROM (
                    SELECT `City`.`city`, `Ethnicity_add`.`patientid`, `Ethnicity_add`.`fname`, `Ethnicity_add`.`lname`, `Ethnicity_add`.`emergency_name`, `Ethnicity_add`.`emergency_number`, `Ethnicity_add`.`emergencyrid`,  `Ethnicity_add`.`dob`, `Ethnicity_add`.`address_street`, `Ethnicity_add`.`cityid`, `Ethnicity_add`.`stateid`, `Ethnicity_add`.`zipid`, `Ethnicity_add`.`phone_number`, `Ethnicity_add`.`email_address`, `Ethnicity_add`.`citizenid`, `Ethnicity_add`.`languageid`, `Ethnicity_add`.`gender`, `Ethnicity_add`.`race`, `Ethnicity_add`.`ethnicity`
                      FROM (
                        SELECT `Ethnicity`.`ethnicity`, `Race_add`.`patientid`, `Race_add`.`fname`, `Race_add`.`lname`, `Race_add`.`emergency_name`, `Race_add`.`emergency_number`, `Race_add`.`emergencyrid`,  `Race_add`.`ethnicityid`, `Race_add`.`dob`, `Race_add`.`address_street`, `Race_add`.`cityid`, `Race_add`.`stateid`, `Race_add`.`zipid`, `Race_add`.`phone_number`, `Race_add`.`email_address`, `Race_add`.`citizenid`, `Race_add`.`languageid`, `Race_add`.`gender`, `Race_add`.`race`
                          FROM (
                            SELECT `Race`.`race`, `Gender_add`.`patientid`, `Gender_add`.`fname`, `Gender_add`.`lname`, `Gender_add`.`emergency_name`, `Gender_add`.`emergency_number`, `Gender_add`.`emergencyrid`,  `Gender_add`.`raceid`, `Gender_add`.`ethnicityid`, `Gender_add`.`dob`, `Gender_add`.`address_street`, `Gender_add`.`cityid`, `Gender_add`.`stateid`, `Gender_add`.`zipid`, `Gender_add`.`phone_number`, `Gender_add`. `email_address`, `Gender_add`.`citizenid`, `Gender_add`.`languageid`, `Gender_add`.`gender` 
                              FROM (
                                  SELECT `Gender`.`gender`, `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`emergency_name`, `Patient`.`emergency_number`, `Patient`.`emergencyrid`, `Patient`.`genderid`, `Patient`.`raceid`, `Patient`.`ethnicityid`, `Patient`.`dob`, `Patient`.`address_street`, `Patient`.`cityid`, `Patient`.`stateid`, `Patient`.`zipid`, `Patient`.`phone_number`, `Patient`.`email_address`, `Patient`.`citizenid`,`Patient`.`languageid`
                                    FROM `Patient`
                                      LEFT JOIN `Gender`
                                      ON `Patient`.`genderid` = `Gender`.`genderid`
                                ) AS `Gender_add`
                                LEFT JOIN `Race`
                                ON `Gender_add`.`raceid` = `Race`.`raceid`
                            ) AS `Race_add`
                            LEFT JOIN `Ethnicity`
                            ON `Race_add`.`ethnicityid` = `Ethnicity`.`ethnicityid`
                      ) AS `Ethnicity_add`
                      LEFT JOIN `City`
                      ON `Ethnicity_add`.`cityid` = `City`.`cityid`
                  ) AS `City_add`
                  LEFT JOIN `State`
                  ON `City_add`.`stateid` = `State`.`stateid`
              ) AS `State_add`
              LEFT JOIN `Zip`
              ON `State_add`.`zipid` = `Zip`.`zipid`
          ) AS `Zip_add`
          LEFT JOIN `CitizenStatus`
          ON `Zip_add`.`citizenid` = `CitizenStatus`.`citizenid`
      ) AS `CitizenStatus_add`
      LEFT JOIN `PrimaryLanguage`
      ON `CitizenStatus_add`.`languageid` = `PrimaryLanguage`.`languageid`
  ) AS `PrimaryLanguage_add`
  LEFT JOIN `EmergencyR`
  ON `PrimaryLanguage_add`.`emergencyrid` = `EmergencyR`.`emergencyrid`
  WHERE `PrimaryLanguage_add`.`patientid` = ?;";

$stmt_demog = $con->prepare($query) or die("error: " . $con->error);
$stmt_demog->bind_param("s", $patientid) or die($con->error);
$stmt_demog->execute();
$stmt_demog->store_result();
$stmt_demog->bind_result($fname, $lname, $dob, $address_street, $city, $state, $zip, $phone_number, $email_address, $emergency_name, $emergencyr, $emergency_number, $gender, $race, $ethnicity, $language, $citizen);
$stmt_demog->fetch();

//This joins the SocialHistory Table and its foreign key subtables into the Patient Table. Adds social history information to the patient information.
//With multiple statements being run, you need to rename each statement accordingly. For instance, stmt_demog stands for the demographics information statement.
//stmt->store_result(); is necessary to include here because of the code we include farther down for the Visit Information table.
$query = "SELECT `HomeType_add`.`sid`, `HomeType_add`.`householdincome`, `HomeType_add`.`numchildren`, `HomeType_add`.`numfammember`, `HomeType_add`.`heareab`, `HomeType_add`.`cooper`, `HomeType_add`.`physician`, `HomeType_add`.`education`, `HomeType_add`.`housestat`, `HomeType_add`.`insurance`, `HomeType_add`.`disability`, `HomeType_add`.`veteran`, `HomeType_add`.`employment`, `HomeType_add`.`relationship`, `HomeType_add`.`alcohol`, `HomeType_add`.`foodstamp`, `HomeType_add`. `hometype`, `Transport`.`transport`   
          FROM (
            SELECT `HomeType`.`hometype`, `FoodStamp_add`.`sid`, `FoodStamp_add`.`householdincome`, `FoodStamp_add`.`numchildren`, `FoodStamp_add`.`numfammember`, `FoodStamp_add`.`heareab`, `FoodStamp_add`.`hometypeid`, `FoodStamp_add`.`transportid`, `FoodStamp_add`.`patientid`, `FoodStamp_add`.`fname`, `FoodStamp_add`.`lname`, `FoodStamp_add`.`dob`, `FoodStamp_add`.`cooper`, `FoodStamp_add`.`physician`, `FoodStamp_add`.`education`, `FoodStamp_add`.`housestat`, `FoodStamp_add`.`insurance`, `FoodStamp_add`.`disability`, `FoodStamp_add`.`veteran`, `FoodStamp_add`.`employment`, `FoodStamp_add`.`relationship`, `FoodStamp_add`.`alcohol`, `FoodStamp_add`.`foodstamp`                 
              FROM (
                SELECT `FoodStamp`.`foodstamp`, `Alcohol_add`.`sid`, `Alcohol_add`.`householdincome`, `Alcohol_add`.`numchildren`, `Alcohol_add`.`numfammember`, `Alcohol_add`.`heareab`, `Alcohol_add`.`foodstampid`, `Alcohol_add`.`hometypeid`, `Alcohol_add`.`transportid`, `Alcohol_add`.`patientid`, `Alcohol_add`.`fname`, `Alcohol_add`.`lname`, `Alcohol_add`.`dob`, `Alcohol_add`.`cooper`, `Alcohol_add`.`physician`, `Alcohol_add`.`education`, `Alcohol_add`.`housestat`, `Alcohol_add`.`insurance`, `Alcohol_add`.`disability`, `Alcohol_add`.`veteran`, `Alcohol_add`.`employment`, `Alcohol_add`.`relationship`, `Alcohol_add`.`alcohol` 
                  FROM (
                    SELECT `Alcohol`.`alcohol`, `Relationship_add`.`sid`, `Relationship_add`.`householdincome`, `Relationship_add`.`numchildren`, `Relationship_add`.`numfammember`, `Relationship_add`.`heareab`, `Relationship_add`.`alcoholid`, `Relationship_add`.`foodstampid`, `Relationship_add`.`hometypeid`, `Relationship_add`.`transportid`, `Relationship_add`.`patientid`, `Relationship_add`.`fname`, `Relationship_add`.`lname`, `Relationship_add`.`dob`, `Relationship_add`.`cooper`, `Relationship_add`.`physician`, `Relationship_add`.`education`, `Relationship_add`.`housestat`, `Relationship_add`.`insurance`, `Relationship_add`.`disability`, `Relationship_add`.`veteran`, `Relationship_add`.`employment`, `Relationship_add`.`relationship` 
                        FROM (                    
                          SELECT `RelationshipStatus`.`relationship`, `Employment_add`.`sid`, `Employment_add`.`householdincome`, `Employment_add`.`numchildren`, `Employment_add`.`numfammember`, `Employment_add`.`heareab`, `Employment_add`.`relationshipid`, `Employment_add`.`alcoholid`, `Employment_add`.`foodstampid`, `Employment_add`.`hometypeid`, `Employment_add`.`transportid`, `Employment_add`.`patientid`, `Employment_add`.`fname`, `Employment_add`.`lname`, `Employment_add`.`dob`, `Employment_add`.`cooper`, `Employment_add`.`physician`, `Employment_add`.`education`, `Employment_add`.`housestat`, `Employment_add`.`insurance`, `Employment_add`.`disability`, `Employment_add`.`veteran`, `Employment_add`.`employment` 
                            FROM (  
                              SELECT `CurrentEmployment`.`employment`,`Veteran_add`.`sid`, `Veteran_add`.`householdincome`, `Veteran_add`.`numchildren`, `Veteran_add`.`numfammember`, `Veteran_add`.`heareab`, `Veteran_add`.`employmentid`, `Veteran_add`.`relationshipid`, `Veteran_add`.`alcoholid`, `Veteran_add`.`foodstampid`, `Veteran_add`.`hometypeid`, `Veteran_add`.`transportid`, `Veteran_add`.`patientid`, `Veteran_add`.`fname`, `Veteran_add`.`lname`, `Veteran_add`.`dob`, `Veteran_add`.`cooper`, `Veteran_add`.`physician`, `Veteran_add`.`education`, `Veteran_add`.`housestat`, `Veteran_add`.`insurance`, `Veteran_add`.`disability`, `Veteran_add`.`veteran`  
                                FROM (
                                  SELECT `Veteran`.`veteran`, `Disability_add`.`sid`, `Disability_add`.`householdincome`, `Disability_add`.`numchildren`, `Disability_add`.`numfammember`, `Disability_add`.`heareab`, `Disability_add`.`veteranid`, `Disability_add`.`employmentid`, `Disability_add`.`relationshipid`, `Disability_add`.`alcoholid`, `Disability_add`.`foodstampid`, `Disability_add`.`hometypeid`, `Disability_add`.`transportid`, `Disability_add`.`patientid`, `Disability_add`.`fname`, `Disability_add`.`lname`, `Disability_add`.`dob`, `Disability_add`.`cooper`, `Disability_add`.`physician`, `Disability_add`.`education`, `Disability_add`.`housestat`, `Disability_add`.`insurance`, `Disability_add`.`disability`  
                                      FROM (
                                        SELECT `Disability`.`disability`, `MedicalInsurance_add`.`sid`, `MedicalInsurance_add`.`householdincome`, `MedicalInsurance_add`.`numchildren`, `MedicalInsurance_add`.`numfammember`, `MedicalInsurance_add`.`heareab`, `MedicalInsurance_add`.`disabilityid`, `MedicalInsurance_add`.`veteranid`, `MedicalInsurance_add`.`employmentid`, `MedicalInsurance_add`.`relationshipid`, `MedicalInsurance_add`.`alcoholid`, `MedicalInsurance_add`.`foodstampid`, `MedicalInsurance_add`.`hometypeid`, `MedicalInsurance_add`.`transportid`, `MedicalInsurance_add`.`patientid`, `MedicalInsurance_add`.`fname`, `MedicalInsurance_add`.`lname`, `MedicalInsurance_add`.`dob`, `MedicalInsurance_add`.`cooper`, `MedicalInsurance_add`.`physician`, `MedicalInsurance_add`.`education`, `MedicalInsurance_add`.`housestat`, `MedicalInsurance_add`.`insurance`  
                                            FROM (
                                              SELECT `MedicalInsurance`.`insurance`, `HeadofHousehold_add`.`sid`, `HeadofHousehold_add`.`householdincome`, `HeadofHousehold_add`.`numchildren`, `HeadofHousehold_add`.`numfammember`, `HeadofHousehold_add`.`heareab`, `HeadofHousehold_add`.`insuranceid`, `HeadofHousehold_add`.`disabilityid`, `HeadofHousehold_add`.`veteranid`, `HeadofHousehold_add`.`employmentid`, `HeadofHousehold_add`.`relationshipid`, `HeadofHousehold_add`.`alcoholid`, `HeadofHousehold_add`.`foodstampid`, `HeadofHousehold_add`.`hometypeid`, `HeadofHousehold_add`.`transportid`, `HeadofHousehold_add`.`patientid`, `HeadofHousehold_add`.`fname`, `HeadofHousehold_add`.`lname`, `HeadofHousehold_add`.`dob`, `HeadofHousehold_add`.`cooper`, `HeadofHousehold_add`.`physician`, `HeadofHousehold_add`.`education`, `HeadofHousehold_add`.`housestat`
                                                  FROM (
                                                    SELECT `HeadofHousehold`.`housestat`, `EducationLevel_add`.`sid`, `EducationLevel_add`.`householdincome`, `EducationLevel_add`.`numchildren`, `EducationLevel_add`.`numfammember`, `EducationLevel_add`.`heareab`, `EducationLevel_add`.`housestatid`, `EducationLevel_add`.`insuranceid`, `EducationLevel_add`.`disabilityid`, `EducationLevel_add`.`veteranid`, `EducationLevel_add`.`employmentid`, `EducationLevel_add`.`relationshipid`, `EducationLevel_add`.`alcoholid`, `EducationLevel_add`.`foodstampid`, `EducationLevel_add`.`hometypeid`, `EducationLevel_add`.`transportid`, `EducationLevel_add`.`patientid`, `EducationLevel_add`.`fname`, `EducationLevel_add`.`lname`, `EducationLevel_add`.`dob`, `EducationLevel_add`.`cooper`, `EducationLevel_add`.`physician`, `EducationLevel_add`.`education`
                                                        FROM (
                                                          SELECT `EducationLevel`.`education`, `PrimaryPhysician_add`.`sid`, `PrimaryPhysician_add`.`householdincome`, `PrimaryPhysician_add`.`numchildren`, `PrimaryPhysician_add`.`numfammember`, `PrimaryPhysician_add`.`heareab`, `PrimaryPhysician_add`.`educationid`, `PrimaryPhysician_add`.`housestatid`, `PrimaryPhysician_add`.`insuranceid`, `PrimaryPhysician_add`.`disabilityid`, `PrimaryPhysician_add`.`veteranid`, `PrimaryPhysician_add`.`employmentid`, `PrimaryPhysician_add`.`relationshipid`, `PrimaryPhysician_add`.`alcoholid`, `PrimaryPhysician_add`.`foodstampid`, `PrimaryPhysician_add`.`hometypeid`, `PrimaryPhysician_add`.`transportid`, `PrimaryPhysician_add`.`patientid`, `PrimaryPhysician_add`.`fname`, `PrimaryPhysician_add`.`lname`, `PrimaryPhysician_add`.`dob`, `PrimaryPhysician_add`.`cooper`, `PrimaryPhysician_add`.`physician`
                                                              FROM (
                                                                SELECT `PrimaryPhysician`.`physician`, `CooperGreen_add`.`sid`, `CooperGreen_add`.`householdincome`, `CooperGreen_add`.`numchildren`, `CooperGreen_add`.`numfammember`, `CooperGreen_add`.`heareab`, `CooperGreen_add`.`physicianid`, `CooperGreen_add`.`educationid`, `CooperGreen_add`.`housestatid`, `CooperGreen_add`.`insuranceid`, `CooperGreen_add`.`disabilityid`, `CooperGreen_add`.`veteranid`, `CooperGreen_add`.`employmentid`, `CooperGreen_add`.`relationshipid`, `CooperGreen_add`.`alcoholid`, `CooperGreen_add`.`foodstampid`, `CooperGreen_add`.`hometypeid`, `CooperGreen_add`.`transportid`, `CooperGreen_add`.`patientid`, `CooperGreen_add`.`fname`, `CooperGreen_add`.`lname`, `CooperGreen_add`.`dob`, `CooperGreen_add`.`cooper`
                                                                    FROM (
                                                                      SELECT `CooperGreen`.`cooper`, `Patient_add`.`sid`, `Patient_add`.`householdincome`, `Patient_add`.`numchildren`, `Patient_add`.`numfammember`, `Patient_add`.`heareab`, `Patient_add`.`cooperid`, `Patient_add`.`physicianid`, `Patient_add`.`educationid`, `Patient_add`.`housestatid`, `Patient_add`.`insuranceid`, `Patient_add`.`disabilityid`, `Patient_add`.`veteranid`, `Patient_add`.`employmentid`, `Patient_add`.`relationshipid`, `Patient_add`.`alcoholid`, `Patient_add`.`foodstampid`, `Patient_add`.`hometypeid`, `Patient_add`.`transportid`, `Patient_add`.`patientid`, `Patient_add`.`fname`, `Patient_add`.`lname`, `Patient_add`.`dob`
                                                                        FROM (
                                                                            SELECT `SocialHistory`.`sid`, `SocialHistory`.`householdincome`, `SocialHistory`.`numchildren`, `SocialHistory`.`numfammember`, `SocialHistory`.`heareab`, `SocialHistory`.`cooperid`, `SocialHistory`.`physicianid`, `SocialHistory`.`educationid`, `SocialHistory`.`housestatid`, `SocialHistory`.`insuranceid`, `SocialHistory`.`disabilityid`, `SocialHistory`.`veteranid`, `SocialHistory`.`employmentid`, `SocialHistory`.`relationshipid`, `SocialHistory`.`alcoholid`, `SocialHistory`.`foodstampid`, `SocialHistory`.`hometypeid`, `SocialHistory`.`transportid`, `Patient`.`patientid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`
                                                                            FROM `SocialHistory`
                                                                            LEFT JOIN `Patient`
                                                                            ON `Patient`.`patientid` = `SocialHistory`.`patientid`
                                                                        ) AS `Patient_add`
                                                                        LEFT JOIN `CooperGreen`
                                                                        ON `Patient_add`.`cooperid` = `CooperGreen`.`cooperid`
                                                                    ) AS `CooperGreen_add`
                                                                    LEFT JOIN `PrimaryPhysician`
                                                                    ON `CooperGreen_add`.`physicianid` = `PrimaryPhysician`.`physicianid`
                                                                ) AS `PrimaryPhysician_add`
                                                                LEFT JOIN `EducationLevel`
                                                                ON `PrimaryPhysician_add`.`educationid` = `EducationLevel`.`educationid`
                                                            ) AS `EducationLevel_add`
                                                            LEFT JOIN `HeadofHousehold`
                                                            ON `EducationLevel_add`.`housestatid` = `HeadofHousehold`.`housestatid`
                                                        ) AS `HeadofHousehold_add`
                                                        LEFT JOIN `MedicalInsurance`
                                                        ON `HeadofHousehold_add`.`insuranceid` = `MedicalInsurance`.`insuranceid`
                                                    ) AS `MedicalInsurance_add`
                                                    LEFT JOIN `Disability`
                                                    ON `MedicalInsurance_add`.`disabilityid` = `Disability`.`disabilityid`
                                                ) AS `Disability_add`
                                                LEFT JOIN `Veteran`
                                                ON `Disability_add`.`veteranid` = `Veteran`.`veteranid`
                                            ) AS `Veteran_add`
                                            LEFT JOIN `CurrentEmployment`
                                            ON `Veteran_add`.`employmentid` = `CurrentEmployment`.`employmentid`
                                        ) AS `Employment_add`
                                        LEFT JOIN `RelationshipStatus`
                                        ON `Employment_add`.`relationshipid` = `RelationshipStatus`.`relationshipid`
                                    ) AS `Relationship_add`
                                    LEFT JOIN `Alcohol`
                                    ON `Relationship_add`.`alcoholid` = `Alcohol`.`alcoholid`
                                ) AS `Alcohol_add`
                                LEFT JOIN `FoodStamp`
                                ON `Alcohol_add`.`foodstampid` = `FoodStamp`.`foodstampid`
                            ) AS `FoodStamp_add`
                            LEFT JOIN `HomeType`
                            ON `FoodStamp_add`.`hometypeid` = `HomeType`.`hometypeid`
                        ) AS `HomeType_add`
                        LEFT JOIN `Transport`
                        ON `HomeType_add`.`transportid` = `Transport`.`transportid`
                        WHERE `HomeType_add`.`patientid` = ?;";

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
$query = "SELECT `Patient_add`.`allergylistid`, `Patient_add`.`patientallergyid`, `AllergyList`.`allergylist`
            FROM (
              SELECT `Patient`.`patientid`, `PatientAllergy`.`allergylistid`, `PatientAllergy`.`patientallergyid`
                FROM `Patient`
                LEFT JOIN `PatientAllergy`
                ON `Patient`.`patientid` = `PatientAllergy`.`patientid`
            ) AS `Patient_add`
            LEFT JOIN `AllergyList`
            ON `Patient_add`.`allergylistid` = `AllergyList`.`allergylistid`
            WHERE `Patient_add`.`patientid` = ?;";

$stmt_allerg = $con->prepare($query) or die("error: " . $con->error);
$stmt_allerg->bind_param("s", $patientid) or die($con->error);
$stmt_allerg->execute();
$stmt_allerg->store_result();
$stmt_allerg->bind_result($allergylistid, $patientallergyid, $allergylist);

//Joins SocialDrugs Table and subtables. Adds the information about patient illicit drug use.
$query = "SELECT `Drugs_add`.`socialdrugsid`, `Drugs_add`.`drugtypeid`, `DrugType`.`drugtype`
            FROM (
              SELECT `SocialHistory`.`patientid`,`SocialHistory`.`sid`, `SocialDrugs`.`socialdrugsid`, `SocialDrugs`.`drugtypeid`
                FROM `SocialHistory`
                LEFT JOIN `SocialDrugs`
                ON `SocialHistory`.`sid` = `SocialDrugs`.`sid`
            ) AS `Drugs_add`
            LEFT JOIN `DrugType`
            ON `Drugs_add`.`drugtypeid` = `DrugType`.`drugtypeid`
            WHERE `Drugs_add`.`patientid` = ?;";

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
$query = "SELECT `VisitType_add`.`patientvisitid`, `VisitType_add`.`currentdate`, `VisitType_add`.`visittype`, `ReasonforVisit`.`reasonforvisit`, `VisitType_add`.`pstat` 
              FROM (
                  SELECT `VisitType`.`visittype`, `Patient_add`.`patientid`, `Patient_add`.`fname`, `Patient_add`.`lname`, `Patient_add`.`dob`,`Patient_add`.`patientvisitid`, `Patient_add`.`pstat`, `Patient_add`.`currentdate`, `Patient_add`.`reasonforvisitid`, `Patient_add`.`visittypeid` 
                      FROM (
                          SELECT `PatientVisit`.`patientid`, `PatientVisit`.`patientvisitid`, `PatientVisit`.`pstat`, `PatientVisit`.`currentdate`, `PatientVisit`.`reasonforvisitid`, `PatientVisit`.`visittypeid`, `Patient`.`fname`, `Patient`.`lname`, `Patient`.`dob`
                          FROM `PatientVisit`
                          LEFT JOIN `Patient`
                          ON `PatientVisit`.`patientid` = `Patient`.`patientid`
                      ) AS `Patient_add`
                      LEFT JOIN `VisitType`
                      ON `Patient_add`.`visittypeid` = `VisitType`.`visittypeid`
                  ) AS `VisitType_add`
                  LEFT JOIN `ReasonforVisit`
                  ON `VisitType_add`.`reasonforvisitid` = `ReasonforVisit`.`reasonforvisitid`
                  WHERE `VisitType_add`.`patientid` = ?
                  ORDER BY `VisitType_add`.`currentdate` ASC;";

$stmt = $con->prepare($query) or die("error: " . $con->error);
$stmt->bind_param("s", $patientid) or die($con->error);
$stmt->execute();
$stmt->bind_result($patientvisitid, $currentdate, $visittype, $reasonforvisit, $pstat);
$stmt->fetch();
?>

<!-- Building the tables with all the information and variables pulled from the database using the query statements above -->
    <h1><?php echo "$fname";?> <?php echo "$lname";?></h1>
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
        <th>Visit Number (since 1/10/2016) </th>
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
        <td>$visit_number</td>
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





