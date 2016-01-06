USE `eabdbw`;

CREATE TABLE IF NOT EXISTS `Gender` (
`genderid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`gender` VARCHAR(50)
);
INSERT INTO `Gender`(gender) VALUES
  (""),
  ("Male"),
  ("Female"),
  ("Transgender");


CREATE TABLE IF NOT EXISTS `Race` (
`raceid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`race` VARCHAR(50)
);
INSERT INTO `Race`(race) VALUES 
  (""),
  ("White"),
  ("Black or African American"),
  ("American Indian or Alaska Native"),
  ("Asian"),
  ("Native Hawaiian or Other Pacific Islander"),
  ("Hispanic");


CREATE TABLE IF NOT EXISTS `Ethnicity` (
`ethnicityid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`ethnicity` VARCHAR(50)
);
INSERT INTO `Ethnicity`(ethnicity) VALUES
  (""),
  ("Hispanic"),
  ("Non-Hispanic");


CREATE TABLE IF NOT EXISTS `CitizenStatus` (
`citizenid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`citizen` VARCHAR(50)
);
INSERT INTO `CitizenStatus`(citizen) VALUES
  (""),
  ("US Citizen"),
  ("Permanent Resident"),
  ("Undocumented Resident");


CREATE TABLE IF NOT EXISTS `City` (
`cityid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`city` VARCHAR(50)
);
INSERT INTO `City`(city) VALUES
  (""),
  ("Birmingham"),
  ("Montgomery"),
  ("Huntsville"),
  ("Mobile");


CREATE TABLE IF NOT EXISTS `State` (
`stateid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`state` VARCHAR(50)
);
INSERT INTO `State`(state) VALUES
  (""),
  ("Alabama"),
  ("Georgia"),
  ("Tennessee"),
  ("Florida"),
  ("Mississippi");


CREATE TABLE IF NOT EXISTS `Zip` (
`zipid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`zip` VARCHAR(50)
);
INSERT INTO `Zip`(zip) VALUES
  (""),
  ("35205"),
  ("35233"),
  ("35203"),
  ("35234"),
  ("35204"),
  ("35222");


CREATE TABLE IF NOT EXISTS `PrimaryLanguage` (
`languageid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`language` VARCHAR(50)
);
INSERT INTO `PrimaryLanguage`(language) VALUES
  (""),
  ("English"),
  ("Spanish"),
  ("Mandarin");

CREATE TABLE IF NOT EXISTS `AllergyList` (
`allergylistid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`allergylist` VARCHAR(50)
);
INSERT INTO `AllergyList`(allergylist) VALUES
  ("Sulfa drugs/Sulfonamidies"),
  ("Penicillin"),
  ("Tetracycline"),
  ("Codeine"),
  ("Phenytoin"),
  ("Statins"),
  ("Other Antibiotic Drugs"),
  ("Severe Food Allergy");

CREATE TABLE IF NOT EXISTS `EmergencyR` (
`emergencyrid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`emergencyr` VARCHAR(50)
);
INSERT INTO `EmergencyR`(emergencyr) VALUES
  (""),
  ("Sibling"),
  ("Parent"),
  ("Child"),
  ("Grandparent"),
  ("Grandchild"),
  ("Cousin"),
  ("Friend"),
  ("Other Relative");


CREATE TABLE IF NOT EXISTS `Patient` (
`patientid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`fname` VARCHAR(50),
`lname` VARCHAR(50),
`genderid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Gender.genderid_Patient.genderid` FOREIGN KEY(`genderid`) REFERENCES `Gender` (`genderid`),
`raceid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Race.raceid_Patient.raceid` FOREIGN KEY(`raceid`) REFERENCES `Race` (`raceid`),
`ethnicityid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Ethnicity.ethnicityid_Patient.ethnicityid` FOREIGN KEY(`ethnicityid`) REFERENCES `Ethnicity` (`ethnicityid`),
`dob` DATE,
`address_street` VARCHAR(50),
`cityid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `City.cityid_Patient.cityid` FOREIGN KEY(`cityid`) REFERENCES `City` (`cityid`),
`stateid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `State.stateid_Patient.stateid` FOREIGN KEY(`stateid`) REFERENCES `State` (`stateid`),
`zipid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Zip.zipid_Patient.zipid` FOREIGN KEY(`zipid`) REFERENCES `Zip` (`zipid`),
`emergencyrid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `EmergencyR.emergencyrid_Patient.EmergencyRid` FOREIGN KEY(`emergencyrid`) REFERENCES `EmergencyR` (`emergencyrid`),
`phone_number` VARCHAR(50),
`email_address` VARCHAR(50),
`emergency_name` VARCHAR(50),
`emergency_number` VARCHAR(50),
`citizenid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `CitizenStatus.citizenid_Patient.citizenid` FOREIGN KEY(`citizenid`) REFERENCES `CitizenStatus` (`citizenid`),
`languageid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `PrimaryLanguage.languageid_Patient.languageid` FOREIGN KEY(`languageid`) REFERENCES `PrimaryLanguage` (`languageid`)
);

CREATE TABLE IF NOT EXISTS `PatientAllergy` (
`patientallergyid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`allergylistid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `AllergyList.allergylistid_PatientAllergy.patientallergyid` FOREIGN KEY(`allergylistid`) REFERENCES `AllergyList` (`allergylistid`),
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_PatientAllergy.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`)
);

CREATE TABLE IF NOT EXISTS `Mammogram` (
`mammogramid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_Mammogram.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`),
`mammogram` DATE
);

CREATE TABLE IF NOT EXISTS `Colonoscopy` (
`colonoscopyid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_Colonoscopy.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`),
`colonoscopy` DATE
);

CREATE TABLE IF NOT EXISTS `PapSmear` (
`papsmearid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_PapSmear.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`),
`papsmear` DATE
);

CREATE TABLE IF NOT EXISTS `STI` (
`stiid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_STI.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`),
`sti` DATE
);



CREATE TABLE IF NOT EXISTS `ReasonforVisit` (
`reasonforvisitid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`reasonforvisit` VARCHAR(50)
);
INSERT INTO `ReasonforVisit`(reasonforvisit) VALUES
  (""),
  ("Acute Care Managment e.g. Infection, Muscle Pain"),
  ("Chronic Care Management e.g. Blood Pressure, Diabetes"),
  ("Smoking/Alcohol/Drug Cessation"),
  ("Mental Health");

CREATE TABLE IF NOT EXISTS `VisitType` (
`visittypeid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`visittype` VARCHAR(50)
);
INSERT INTO `VisitType`(visittype) VALUES
  (""),
  ("New Patient"),
  ("Returning Patient");


CREATE TABLE IF NOT EXISTS `PatientVisit` (
`patientvisitid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`pstat` VARCHAR(50),
`currentdate` DATE,
`reasonforvisitid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `ReasonforVisit.reasonforvisitid_PatientVisit.reasonforvisitid` FOREIGN KEY(`reasonforvisitid`) REFERENCES `ReasonforVisit` (`reasonforvisitid`),
`visittypeid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `VisitType.visittypeid_PatientVisit.visittypeid` FOREIGN KEY(`visittypeid`) REFERENCES `VisitType` (`visittypeid`),
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_PatientVisit.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`)
);





CREATE TABLE IF NOT EXISTS `CooperGreen` (
`cooperid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`cooper` VARCHAR(50)
);
INSERT INTO `CooperGreen`(cooper) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `PrimaryPhysician` (
`physicianid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`physician` VARCHAR(50)
);
INSERT INTO `PrimaryPhysician`(physician) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `EducationLevel` (
`educationid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`education` VARCHAR(50)
);
INSERT INTO `EducationLevel`(education) VALUES
  (""),
  ("Some High School"),
  ("High School Diploma"),
  ("GED"),
  ("Some College"),
  ("College"),
  ("Post-graduate");


CREATE TABLE IF NOT EXISTS `HeadofHousehold` (
`housestatid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`housestat` VARCHAR(50)
);
INSERT INTO `HeadofHousehold`(housestat) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `MedicalInsurance` (
`insuranceid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`insurance` VARCHAR(50)
);
INSERT INTO `MedicalInsurance`(insurance) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `Disability` (
`disabilityid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`disability` VARCHAR(50)
);
INSERT INTO `Disability`(disability) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `Veteran` (
`veteranid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`veteran` VARCHAR(50)
);
INSERT INTO `Veteran`(veteran) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `CurrentEmployment` (
`employmentid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`employment` VARCHAR(50)
);
INSERT INTO `CurrentEmployment`(employment) VALUES
  (""),
  ("Yes"),
  ("No");


CREATE TABLE IF NOT EXISTS `RelationshipStatus` (
`relationshipid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`relationship` VARCHAR(50)
);
INSERT INTO `RelationshipStatus`(relationship) VALUES
  (""),
  ("Never married"),
  ("Married/Partnered"),
  ("Separated"),
  ("Divorced"),
  ("Widowed");


CREATE TABLE IF NOT EXISTS `Alcohol` (
`alcoholid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`alcohol` VARCHAR(50)
);
INSERT INTO `Alcohol`(alcohol) VALUES
  (""),
  ("Never"),
  ("Quit"),
  ("Rarely"),
  ("Moderate"),
  ("Daily");

  
CREATE TABLE IF NOT EXISTS `FoodStamp` (
`foodstampid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`foodstamp` VARCHAR(50)
);
INSERT INTO `FoodStamp`(foodstamp) VALUES
  (""),
  ("Yes"),
  ("No");

CREATE TABLE IF NOT EXISTS `HomeType` (
`hometypeid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`hometype` VARCHAR(50)
);
INSERT INTO `HomeType`(hometype) VALUES
  (""),
  ("Homeless"),
  ("Homeless Shelter"),
  ("Rental House/Apartment"),
  ("Personal Residence");

CREATE TABLE IF NOT EXISTS `Transport` (
`transportid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`transport` VARCHAR(50)
);
INSERT INTO `Transport`(transport) VALUES
  (""),
  ("Walk/Bike"),
  ("Public Transportation"),
  ("Personal Vehicle"),
  ("Ride from Friend/Family");

CREATE TABLE IF NOT EXISTS `SocialHistory` (
`sid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`householdincome` BIGINT,
`numchildren` BIGINT,
`numfammember` BIGINT,
`heareab` VARCHAR(50),
`cooperid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `CooperGreen.cooperid_SocialHistory.cooperid` FOREIGN KEY(`cooperid`) REFERENCES `CooperGreen` (`cooperid`),
`physicianid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `PrimaryPhysician.physicianid_SocialHistory.physicianid` FOREIGN KEY(`physicianid`) REFERENCES `PrimaryPhysician` (`physicianid`),
`educationid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `EducationLevel.educationid_SocialHistory.educationid` FOREIGN KEY(`educationid`) REFERENCES `EducationLevel` (`educationid`),
`housestatid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `HeadofHousehold.housestatid_SocialHistory.housestatid` FOREIGN KEY(`housestatid`) REFERENCES `HeadofHousehold` (`housestatid`),
`insuranceid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `MedicalInsurance.insuranceid_SocialHistory.insuranceid` FOREIGN KEY(`insuranceid`) REFERENCES `MedicalInsurance` (`insuranceid`),
`disabilityid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Disability.disabilityid_SocialHistory.disabilityid` FOREIGN KEY(`disabilityid`) REFERENCES `Disability` (`disabilityid`),
`veteranid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Veteran.veteranid_SocialHistory.veteranid` FOREIGN KEY(`veteranid`) REFERENCES `Veteran` (`veteranid`),
`employmentid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `CurrentEmployment.employmentid_SocialHistory.employmentid` FOREIGN KEY(`employmentid`) REFERENCES `CurrentEmployment` (`employmentid`),
`relationshipid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `RelationshipStatus.relationshipid_SocialHistory.relationshipid` FOREIGN KEY(`relationshipid`) REFERENCES `RelationshipStatus` (`relationshipid`),
`alcoholid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Alcohol.cooperid_SocialHistory.alcoholid` FOREIGN KEY(`alcoholid`) REFERENCES `Alcohol` (`alcoholid`),
`foodstampid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `FoodStamp.foodstampid_SocialHistory.foodstampid` FOREIGN KEY(`foodstampid`) REFERENCES `FoodStamp` (`foodstampid`),
`hometypeid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `HomeType.hometypeid_SocialHistory.hometypeid` FOREIGN KEY(`hometypeid`) REFERENCES `HomeType` (`hometypeid`),
`transportid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Transport.transportid_SocialHistory.transportid` FOREIGN KEY(`transportid`) REFERENCES `Transport` (`transportid`),
`patientid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `Patient.patientid_SocialHistory.patientid` FOREIGN KEY(`patientid`) REFERENCES `Patient` (`patientid`)
);

CREATE TABLE IF NOT EXISTS `PastSmoker` (
`pastsmokerid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`sid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `SocialHistory.sid_PastSmoker.sid` FOREIGN KEY(`sid`) REFERENCES `SocialHistory` (`sid`),
`startdate` DATE,
`quitdate` DATE,
`packsperday` INT
);

CREATE TABLE IF NOT EXISTS `CurrentSmoker` (
`currentsmokerid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`sid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `SocialHistory.sid_CurrentSmoker.sid` FOREIGN KEY(`sid`) REFERENCES `SocialHistory` (`sid`),
`startdate` DATE,
`packsperday` INT
);


CREATE TABLE IF NOT EXISTS `DrugType` (
`drugtypeid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`drugtype` VARCHAR(50)
);
INSERT INTO `DrugType`(drugtype) VALUES 
  ("Ecstacy"),
  ("Heroin"),
  ("Cocaine"),
  ("PCP"),
  ("Amphetamines"),
  ("Marijuana"); 


CREATE TABLE IF NOT EXISTS `SocialDrugs` (
`socialdrugsid` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
`drugtypeid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `DrugType.drugtypeid_SocialDrugs.drugtypeid` FOREIGN KEY(`drugtypeid`) REFERENCES `DrugType` (`drugtypeid`),
`sid` BIGINT UNSIGNED NOT NULL,
CONSTRAINT `SocialHistory.sid_SocialDrugs.sid` FOREIGN KEY(`sid`) REFERENCES `SocialHistory` (`sid`)
);