<?php include("includes/header_require_login.php"); ?>

  	<title>Patient Social History</title>

<?php require_once("includes/menu.php"); ?>

    <p> <a href="download_patientsocialhistory.php" target="_blank"> Download Patient Social History Data as CSV File </a> </p>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("includes/db.php");

$con = new mysqli($host, $db_user, $db_pass, $db_db) or die("Error: " . $con->error);

$query = "SELECT `HomeType_add`.`patientid`, `HomeType_add`.`fname`, `HomeType_add`.`lname`, `HomeType_add`.`dob`, `HomeType_add`.`sid`, `HomeType_add`.`householdincome`, `HomeType_add`.`numchildren`, `HomeType_add`.`numfammember`, `HomeType_add`.`heareab`, `HomeType_add`.`cooper`, `HomeType_add`.`physician`, `HomeType_add`.`education`, `HomeType_add`.`housestat`, `HomeType_add`.`insurance`, `HomeType_add`.`disability`, `HomeType_add`.`veteran`, `HomeType_add`.`employment`, `HomeType_add`.`relationship`, `HomeType_add`.`alcohol`, `HomeType_add`.`foodstamp`, `HomeType_add`. `hometype`, `Transport`.`transport`   
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
                        ON `HomeType_add`.`transportid` = `Transport`.`transportid`;";

$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($patientid, $fname, $lname, $dob, $sid, $householdincome, $numchildren, $numfammember, $heareab, $cooper, $physician, $education, $housestat, $insurance, $disability, $veteran, $employment, $relationship, $alcohol, $foodstamp, $hometype, $transport);
?>
    <h1>EAB Patient Social History Information</h1>
    <table class="table table-bordered table-striped">
      <tr>
        <th>Patient ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Social ID</th>
        <th>Household Income</th>
        <th>Number of Children in Household under 18</th>
        <th>Number of People in Household including Oneself</th>
        <th>How Heard About EAB</th>
        <th>Have a phhysician at Cooper Green?</th>
        <th>Have a primary care provider?</th>
        <th>Highest Level of Education Achieved</th>
        <th>Head of one's Household?</th>
        <th>Have insurance?</th>
        <th>On disability?</th>
        <th>Veteran or not?</th>
        <th>Employed or not?</th>
        <th>Relationship Status</th>
        <th>Drinking Alcohol Status</th>
        <th>Receiving foodstamps or not?</th>
        <th>Type of Home</th>
        <th>Method of Transport to Clinic</th>                                               
      </tr>

<?php
while($stmt->fetch()) {
    echo "
      <tr>
        <td>$patientid</td>
        <td>$fname</td>
        <td>$lname</td>
        <td>$dob</td>
        <td>$sid</td>
        <td>$householdincome</td>
        <td>$numchildren</td>
        <td>$numfammember</td>
        <td>$heareab</td>
        <td>$cooper</td>
        <td>$physician</td>
        <td>$education</td>
        <td>$housestat</td>
        <td>$insurance</td>
        <td>$disability</td>
        <td>$veteran</td>
        <td>$employment</td>
        <td>$relationship</td>
        <td>$alcohol</td>
        <td>$foodstamp</td>
        <td>$hometype</td>
        <td>$transport</td>
      </tr>\n";
 }
$stmt->close();
$con->close();
?>
	</table>
<?php require_once("includes/footer.php"); ?>