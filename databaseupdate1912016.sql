USE `eabdbw`;

ALTER TABLE `PatientVisit` MODIFY `pstat` TEXT;
ALTER TABLE `SocialHistory` MODIFY `heareab` TEXT;
ALTER TABLE `ReasonforVisit` MODIFY `reasonforvisit` VARCHAR(100);

UPDATE `ReasonforVisit` SET `reasonforvisit` = "Recent Problem (<2 weeks), ex. new back pain" WHERE `reasonforvisitid` = 2;
UPDATE `ReasonforVisit` SET `reasonforvisit` = "Ongoing Problem (>2 weeks), ex. high blood pressure" WHERE `reasonforvisitid` = 3;

UPDATE `AllergyList` SET `allergylist` = "Sulfa drugs/Sulfonamides" WHERE `allergylistid` = 1;



ALTER TABLE `Patient` MODIFY `genderid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `raceid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `ethnicityid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `cityid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `stateid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `zipid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `citizenid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `emergencyrid` BIGINT UNSIGNED;
ALTER TABLE `Patient` MODIFY `languageid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `cooperid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `physicianid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `educationid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `housestatid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `insuranceid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `disabilityid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `veteranid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `employmentid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `relationshipid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `alcoholid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `foodstampid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `hometypeid` BIGINT UNSIGNED;
ALTER TABLE `SocialHistory` MODIFY `transportid` BIGINT UNSIGNED;
ALTER TABLE `PatientVisit` MODIFY `reasonforvisitid` BIGINT UNSIGNED;
ALTER TABLE `PatientVisit` MODIFY `visittypeid` BIGINT UNSIGNED;

ALTER TABLE `Patient` DROP Foreign Key `Gender.genderid_Patient.genderid`;
--ALTER TABLE `Patient` DROP CONSTRAINT `Gender.genderid_Patient.genderid`;
ALTER TABLE `Patient` ADD CONSTRAINT `Gender.genderid_Patient.genderid` 
	FOREIGN KEY(`genderid`) REFERENCES `Gender` (`genderid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `Patient` DROP Foreign Key `Race.raceid_Patient.raceid`;
--ALTER TABLE `Patient` DROP CONSTRAINT `Race.raceid_Patient.raceid`;
ALTER TABLE `Patient` ADD CONSTRAINT `Race.raceid_Patient.raceid` 
	FOREIGN KEY(`raceid`) REFERENCES `Race` (`raceid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `Patient` DROP Foreign Key `Ethnicity.ethnicityid_Patient.ethnicityid`;
--ALTER TABLE `Patient` DROP Constraint `Ethnicity.ethnicityid_Patient.ethnicityid`;
ALTER TABLE `Patient` ADD Constraint `Ethnicity.ethnicityid_Patient.ethnicityid` 
	FOREIGN KEY(`ethnicityid`) REFERENCES `Ethnicity` (`ethnicityid`) ON DELETE SET null ON UPDATE CASCADE;

ALTER TABLE `Patient` DROP Foreign Key `City.cityid_Patient.cityid`;
--ALTER TABLE `Patient` DROP Constraint `City.cityid_Patient.cityid`;
ALTER TABLE `Patient` ADD Constraint `City.cityid_Patient.cityid` 
	FOREIGN KEY(`cityid`) REFERENCES `City` (`cityid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `Patient` DROP Foreign Key `State.stateid_Patient.stateid`;
--ALTER TABLE `Patient` DROP Constraint `State.stateid_Patient.stateid`;
ALTER TABLE `Patient` ADD Constraint `State.stateid_Patient.stateid` 
	FOREIGN KEY(`stateid`) REFERENCES `State` (`stateid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `Patient` DROP Foreign Key `Zip.zipid_Patient.zipid`;
--ALTER TABLE `Patient` DROP Constraint `Zip.zipid_Patient.zipid`;
ALTER TABLE `Patient` ADD Constraint `Zip.zipid_Patient.zipid` 
	FOREIGN KEY(`zipid`) REFERENCES `Zip` (`zipid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `Patient` DROP Foreign Key `EmergencyR.emergencyrid_Patient.EmergencyRid`;
--ALTER TABLE `Patient` DROP Constraint `EmergencyR.emergencyrid_Patient.EmergencyRid`;
ALTER TABLE `Patient` ADD Constraint `EmergencyR.emergencyrid_Patient.EmergencyRid` 
	FOREIGN KEY(`emergencyrid`) REFERENCES `EmergencyR` (`emergencyrid`) ON DELETE SET null ON UPDATE CASCADE;

ALTER TABLE `Patient` DROP Foreign Key `CitizenStatus.citizenid_Patient.citizenid`;
--ALTER TABLE `Patient` DROP Constraint `CitizenStatus.citizenid_Patient.citizenid`;
ALTER TABLE `Patient` ADD Constraint `CitizenStatus.citizenid_Patient.citizenid` 
	FOREIGN KEY(`citizenid`) REFERENCES `CitizenStatus` (`citizenid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `Patient` DROP Foreign Key `PrimaryLanguage.languageid_Patient.languageid`;
--ALTER TABLE `Patient` DROP Constraint `PrimaryLanguage.languageid_Patient.languageid`;
ALTER TABLE `Patient` ADD Constraint `PrimaryLanguage.languageid_Patient.languageid` 
	FOREIGN KEY(`languageid`) REFERENCES `PrimaryLanguage` (`languageid`) ON DELETE SET null ON UPDATE CASCADE;

	--Social History Table
	
ALTER TABLE `SocialHistory` DROP Foreign Key `CooperGreen.cooperid_SocialHistory.cooperid`;
--ALTER TABLE `SocialHistory` DROP Constraint `CooperGreen.cooperid_SocialHistory.cooperid`;
ALTER TABLE `SocialHistory` ADD Constraint `CooperGreen.cooperid_SocialHistory.cooperid` 
	FOREIGN KEY(`cooperid`) REFERENCES `CooperGreen` (`cooperid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `PrimaryPhysician.physicianid_SocialHistory.physicianid`;
--ALTER TABLE `SocialHistory` DROP Constraint `PrimaryPhysician.physicianid_SocialHistory.physicianid`;
ALTER TABLE `SocialHistory` ADD Constraint `PrimaryPhysician.physicianid_SocialHistory.physicianid` 
	FOREIGN KEY(`physicianid`) REFERENCES `PrimaryPhysician` (`physicianid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `EducationLevel.educationid_SocialHistory.educationid`;
--ALTER TABLE `SocialHistory` DROP Constraint `EducationLevel.educationid_SocialHistory.educationid`;
ALTER TABLE `SocialHistory` ADD Constraint `EducationLevel.educationid_SocialHistory.educationid` 
	FOREIGN KEY(`educationid`) REFERENCES `EducationLevel` (`educationid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `HeadofHousehold.housestatid_SocialHistory.housestatid`;
--ALTER TABLE `SocialHistory` DROP Constraint `HeadofHousehold.housestatid_SocialHistory.housestatid`;
ALTER TABLE `SocialHistory` ADD Constraint `HeadofHousehold.housestatid_SocialHistory.housestatid` 
	FOREIGN KEY(`housestatid`) REFERENCES `HeadofHousehold` (`housestatid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `MedicalInsurance.insuranceid_SocialHistory.insuranceid`;
--ALTER TABLE `SocialHistory` DROP Constraint `MedicalInsurance.insuranceid_SocialHistory.insuranceid`;
ALTER TABLE `SocialHistory` ADD Constraint `MedicalInsurance.insuranceid_SocialHistory.insuranceid` 
	FOREIGN KEY(`insuranceid`) REFERENCES `MedicalInsurance` (`insuranceid`) ON DELETE SET null ON UPDATE CASCADE;

ALTER TABLE `SocialHistory` DROP Foreign Key `Disability.disabilityid_SocialHistory.disabilityid`;
--ALTER TABLE `SocialHistory` DROP Constraint `Disability.disabilityid_SocialHistory.disabilityid`;
ALTER TABLE `SocialHistory` ADD Constraint `Disability.disabilityid_SocialHistory.disabilityid` 
	FOREIGN KEY(`disabilityid`) REFERENCES `Disability` (`disabilityid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `Veteran.veteranid_SocialHistory.veteranid`;
--ALTER TABLE `SocialHistory` DROP Constraint `Veteran.veteranid_SocialHistory.veteranid`;
ALTER TABLE `SocialHistory` ADD Constraint `Veteran.veteranid_SocialHistory.veteranid` 
	FOREIGN KEY(`veteranid`) REFERENCES `Veteran` (`veteranid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `CurrentEmployment.employmentid_SocialHistory.employmentid`;
--ALTER TABLE `SocialHistory` DROP Constraint `CurrentEmployment.employmentid_SocialHistory.employmentid`;
ALTER TABLE `SocialHistory` ADD Constraint `CurrentEmployment.employmentid_SocialHistory.employmentid` 
	FOREIGN KEY(`employmentid`) REFERENCES `CurrentEmployment` (`employmentid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `RelationshipStatus.relationshipid_SocialHistory.relationshipid`;
--ALTER TABLE `SocialHistory` DROP Constraint `RelationshipStatus.relationshipid_SocialHistory.relationshipid`;
ALTER TABLE `SocialHistory` ADD Constraint `RelationshipStatus.relationshipid_SocialHistory.relationshipid` 
	FOREIGN KEY(`relationshipid`) REFERENCES `RelationshipStatus` (`relationshipid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `Alcohol.cooperid_SocialHistory.alcoholid`;
--ALTER TABLE `SocialHistory` DROP Constraint `Alcohol.cooperid_SocialHistory.alcoholid`;
ALTER TABLE `SocialHistory` ADD Constraint `Alcohol.cooperid_SocialHistory.alcoholid` 
	FOREIGN KEY(`alcoholid`) REFERENCES `Alcohol` (`alcoholid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `FoodStamp.foodstampid_SocialHistory.foodstampid`;
--ALTER TABLE `SocialHistory` DROP Constraint `FoodStamp.foodstampid_SocialHistory.foodstampid`;
ALTER TABLE `SocialHistory` ADD Constraint `FoodStamp.foodstampid_SocialHistory.foodstampid` 
	FOREIGN KEY(`foodstampid`) REFERENCES `FoodStamp` (`foodstampid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `HomeType.hometypeid_SocialHistory.hometypeid`;
--ALTER TABLE `SocialHistory` DROP Constraint `HomeType.hometypeid_SocialHistory.hometypeid`;
ALTER TABLE `SocialHistory` ADD Constraint `HomeType.hometypeid_SocialHistory.hometypeid` 
	FOREIGN KEY(`hometypeid`) REFERENCES `HomeType` (`hometypeid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `SocialHistory` DROP Foreign Key `Transport.transportid_SocialHistory.transportid`;
--ALTER TABLE `SocialHistory` DROP Constraint `Transport.transportid_SocialHistory.transportid`;
ALTER TABLE `SocialHistory` ADD Constraint `Transport.transportid_SocialHistory.transportid` 
	FOREIGN KEY(`transportid`) REFERENCES `Transport` (`transportid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `PatientVisit` DROP Foreign Key `ReasonforVisit.reasonforvisitid_PatientVisit.reasonforvisitid`;
--ALTER TABLE `PatientVisit` DROP Constraint `ReasonforVisit.reasonforvisitid_PatientVisit.reasonforvisitid`;
ALTER TABLE `PatientVisit` ADD Constraint `ReasonforVisit.reasonforvisitid_PatientVisit.reasonforvisitid` 
	FOREIGN KEY(`reasonforvisitid`) REFERENCES `ReasonforVisit` (`reasonforvisitid`) ON DELETE SET null ON UPDATE CASCADE;
	
ALTER TABLE `PatientVisit` DROP Foreign Key `VisitType.visittypeid_PatientVisit.visittypeid`;
--ALTER TABLE `PatientVisit` DROP Constraint `VisitType.visittypeid_PatientVisit.visittypeid`;
ALTER TABLE `PatientVisit` ADD Constraint `VisitType.visittypeid_PatientVisit.visittypeid` 
	FOREIGN KEY(`visittypeid`) REFERENCES `VisitType` (`visittypeid`) ON DELETE SET null ON UPDATE CASCADE;

DELETE FROM `Alcohol` WHERE alcoholid = "1" AND alcohol = "";
DELETE FROM `CitizenStatus` WHERE citizenid = "1" AND citizen = "";
DELETE FROM `City` WHERE cityid = "1" AND city = "";
DELETE FROM `CooperGreen` WHERE cooperid = "1" AND cooper = "";
DELETE FROM `CurrentEmployment` WHERE employmentid = "1" AND employment = "";
DELETE FROM `Disability` WHERE disabilityid = "1" AND disability = "";
DELETE FROM `EducationLevel` WHERE educationid = "1" AND education = "";
DELETE FROM `Ethnicity` WHERE ethnicityid = "1" AND ethnicity = "";
DELETE FROM `FoodStamp` WHERE foodstampid = "1" AND foodstamp = "";
DELETE FROM `Gender` WHERE genderid = "1" AND gender = "";
DELETE FROM `HeadofHousehold` WHERE housestatid = "1" AND housestat = "";
DELETE FROM `HomeType` WHERE hometypeid = "1" AND hometype = "";
DELETE FROM `MedicalInsurance` WHERE insuranceid = "1" AND insurance = "";
DELETE FROM `PrimaryLanguage` WHERE languageid = "1" AND language = "";
DELETE FROM `PrimaryPhysician` WHERE physicianid = "1" AND physician = "";
DELETE FROM `ReasonforVisit` WHERE reasonforvisitid = "1" AND reasonforvisit = "";
DELETE FROM `RelationshipStatus` WHERE relationshipid = "1" AND relationship = "";
DELETE FROM `State` WHERE stateid = "1" AND state = "";
DELETE FROM `Transport` WHERE transportid = "1" AND transport = "";
DELETE FROM `Veteran` WHERE veteranid = "1" AND veteran = "";
DELETE FROM `VisitType` WHERE visittypeid = "1" AND visittype = "";
DELETE FROM `Zip` WHERE zipid = "1" AND zip = "";
DELETE FROM `Race` WHERE raceid = "1" AND race = "";
DELETE FROM `EmergencyR` WHERE emergencyrid = "1" AND emergencyr = "";



