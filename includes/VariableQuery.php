<?php
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

$query = "SELECT `ethnicityid`, `ethnicity` FROM `Ethnicity`;";
$stmt_ethnicity = $con->prepare($query);
$stmt_ethnicity->execute();
$stmt_ethnicity->store_result();
$stmt_ethnicity->bind_result($ethnicityid,$ethnicity);

$query = "SELECT `genderid`, `gender` FROM `Gender`;";
$stmt_gender = $con->prepare($query);
$stmt_gender->execute();
$stmt_gender->store_result();
$stmt_gender->bind_result($genderid,$gender);

$query = "SELECT `raceid`, `race` FROM `Race`;";
$stmt_race = $con->prepare($query);
$stmt_race->execute();
$stmt_race->store_result();
$stmt_race->bind_result($raceid,$race);

$query = "SELECT `languageid`, `language` FROM `PrimaryLanguage`;";
$stmt_language = $con->prepare($query);
$stmt_language->execute();
$stmt_language->store_result();
$stmt_language->bind_result($languageid,$language);

$query = "SELECT `citizenid`, `citizen` FROM `CitizenStatus`;";
$stmt_citizen = $con->prepare($query);
$stmt_citizen->execute();
$stmt_citizen->store_result();
$stmt_citizen->bind_result($citizenid,$citizen);

$query = "SELECT `cooperid`, `cooper` FROM `CooperGreen`;";
$stmt_cooper = $con->prepare($query);
$stmt_cooper->execute();
$stmt_cooper->store_result();
$stmt_cooper->bind_result($cooperid,$cooper);

$query = "SELECT `employmentid`, `employment` FROM `CurrentEmployment`;";
$stmt_employment = $con->prepare($query);
$stmt_employment->execute();
$stmt_employment->store_result();
$stmt_employment->bind_result($employmentid,$employment);

$query = "SELECT `physicianid`, `physician` FROM `PrimaryPhysician`;";
$stmt_physician = $con->prepare($query);
$stmt_physician->execute();
$stmt_physician->store_result();
$stmt_physician->bind_result($physicianid,$physician);

$query = "SELECT `educationid`, `education` FROM `EducationLevel`;";
$stmt_education = $con->prepare($query);
$stmt_education->execute();
$stmt_education->store_result();
$stmt_education->bind_result($educationid,$education);

$query = "SELECT `housestatid`, `housestat` FROM `HeadofHousehold`;";
$stmt_housestat = $con->prepare($query);
$stmt_housestat->execute();
$stmt_housestat->store_result();
$stmt_housestat->bind_result($housestatid,$housestat);

$query = "SELECT `insuranceid`, `insurance` FROM `MedicalInsurance`;";
$stmt_insurance = $con->prepare($query);
$stmt_insurance->execute();
$stmt_insurance->store_result();
$stmt_insurance->bind_result($insuranceid,$insurance);

$query = "SELECT `disabilityid`, `disability` FROM `Disability`;";
$stmt_disability = $con->prepare($query);
$stmt_disability->execute();
$stmt_disability->store_result();
$stmt_disability->bind_result($disabilityid,$disability);

$query = "SELECT `veteranid`, `veteran` FROM `Veteran`;";
$stmt_veteran = $con->prepare($query);
$stmt_veteran->execute();
$stmt_veteran->store_result();
$stmt_veteran->bind_result($veteranid,$veteran);

$query = "SELECT `hometypeid`, `hometype` FROM `HomeType`;";
$stmt_hometype = $con->prepare($query);
$stmt_hometype->execute();
$stmt_hometype->store_result();
$stmt_hometype->bind_result($hometypeid,$hometype);

$query = "SELECT `foodstampid`, `foodstamp` FROM `FoodStamp`;";
$stmt_foodstamp = $con->prepare($query);
$stmt_foodstamp->execute();
$stmt_foodstamp->store_result();
$stmt_foodstamp->bind_result($foodstampid,$foodstamp);

$query = "SELECT `alcoholid`, `alcohol` FROM `Alcohol`;";
$stmt_alcohol = $con->prepare($query);
$stmt_alcohol->execute();
$stmt_alcohol->store_result();
$stmt_alcohol->bind_result($alcoholid,$alcohol);

$query = "SELECT `relationshipid`, `relationship` FROM `RelationshipStatus`;";
$stmt_relationship = $con->prepare($query);
$stmt_relationship->execute();
$stmt_relationship->store_result();
$stmt_relationship->bind_result($relationshipid,$relationship);

$query = "SELECT `transportid`, `transport` FROM `Transport`;";
$stmt_transport = $con->prepare($query);
$stmt_transport->execute();
$stmt_transport->store_result();
$stmt_transport->bind_result($transportid,$transport);

$query = "SELECT `reasonforvisitid`, `reasonforvisit` FROM `ReasonforVisit`;";
$stmt_reasonforvisit = $con->prepare($query);
$stmt_reasonforvisit->execute();
$stmt_reasonforvisit->store_result();
$stmt_reasonforvisit->bind_result($reasonforvisitid,$reasonforvisit);

$query = "SELECT `drugtypeid`, `drugtype` FROM `DrugType`;";
$stmt_drugtype = $con->prepare($query);
$stmt_drugtype->execute();
$stmt_drugtype->store_result();
$stmt_drugtype->bind_result($drugtypeid,$drugtype);

$query = "SELECT `allergylistid`, `allergylist` FROM `AllergyList`;";
$stmt_allergylist = $con->prepare($query);
$stmt_allergylist->execute();
$stmt_allergylist->store_result();
$stmt_allergylist->bind_result($allergylistid,$allergylist);

$query = "SELECT `emergencyrid`, `emergencyr` FROM `EmergencyR`;";
$stmt_emergencyr = $con->prepare($query);
$stmt_emergencyr->execute();
$stmt_emergencyr->store_result();
$stmt_emergencyr->bind_result($emergencyrid,$emergencyr);
?>