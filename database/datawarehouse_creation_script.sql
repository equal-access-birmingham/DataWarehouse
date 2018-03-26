-- MySQL Script generated by MySQL Workbench
-- Sun 18 Mar 2018 03:06:48 PM CDT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema datawarehousedb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `Alcohol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Alcohol` ;

CREATE TABLE IF NOT EXISTS `Alcohol` (
  `alcoholid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alcohol` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`alcoholid`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `AllergyList`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `AllergyList` ;

CREATE TABLE IF NOT EXISTS `AllergyList` (
  `allergylistid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `allergylist` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`allergylistid`))
ENGINE = InnoDB
AUTO_INCREMENT = 89
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `CitizenStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CitizenStatus` ;

CREATE TABLE IF NOT EXISTS `CitizenStatus` (
  `citizenid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `citizen` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`citizenid`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `City`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `City` ;

CREATE TABLE IF NOT EXISTS `City` (
  `cityid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`cityid`))
ENGINE = InnoDB
AUTO_INCREMENT = 54
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `EmergencyR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EmergencyR` ;

CREATE TABLE IF NOT EXISTS `EmergencyR` (
  `emergencyrid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `emergencyr` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`emergencyrid`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Ethnicity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ethnicity` ;

CREATE TABLE IF NOT EXISTS `Ethnicity` (
  `ethnicityid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ethnicity` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`ethnicityid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Gender`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gender` ;

CREATE TABLE IF NOT EXISTS `Gender` (
  `genderid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gender` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`genderid`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `PrimaryLanguage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PrimaryLanguage` ;

CREATE TABLE IF NOT EXISTS `PrimaryLanguage` (
  `languageid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`languageid`))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Race`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Race` ;

CREATE TABLE IF NOT EXISTS `Race` (
  `raceid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `race` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`raceid`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `State`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `State` ;

CREATE TABLE IF NOT EXISTS `State` (
  `stateid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`stateid`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Zip`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Zip` ;

CREATE TABLE IF NOT EXISTS `Zip` (
  `zipid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `zip` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`zipid`))
ENGINE = InnoDB
AUTO_INCREMENT = 68
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Patient`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Patient` ;

CREATE TABLE IF NOT EXISTS `Patient` (
  `patientid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(50) NULL DEFAULT NULL,
  `lname` VARCHAR(50) NULL DEFAULT NULL,
  `genderid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `raceid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `ethnicityid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `address_street` VARCHAR(50) NULL DEFAULT NULL,
  `cityid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `stateid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `zipid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `emergencyrid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `phone_number` VARCHAR(50) NULL DEFAULT NULL,
  `email_address` VARCHAR(50) NULL DEFAULT NULL,
  `emergency_name` VARCHAR(50) NULL DEFAULT NULL,
  `emergency_number` VARCHAR(50) NULL DEFAULT NULL,
  `citizenid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `languageid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`patientid`),
  INDEX `Gender.genderid_Patient.genderid` (`genderid` ASC),
  INDEX `Race.raceid_Patient.raceid` (`raceid` ASC),
  INDEX `Ethnicity.ethnicityid_Patient.ethnicityid` (`ethnicityid` ASC),
  INDEX `City.cityid_Patient.cityid` (`cityid` ASC),
  INDEX `State.stateid_Patient.stateid` (`stateid` ASC),
  INDEX `Zip.zipid_Patient.zipid` (`zipid` ASC),
  INDEX `EmergencyR.emergencyrid_Patient.EmergencyRid` (`emergencyrid` ASC),
  INDEX `CitizenStatus.citizenid_Patient.citizenid` (`citizenid` ASC),
  INDEX `PrimaryLanguage.languageid_Patient.languageid` (`languageid` ASC),
  CONSTRAINT `CitizenStatus.citizenid_Patient.citizenid`
    FOREIGN KEY (`citizenid`)
    REFERENCES `CitizenStatus` (`citizenid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `City.cityid_Patient.cityid`
    FOREIGN KEY (`cityid`)
    REFERENCES `City` (`cityid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `EmergencyR.emergencyrid_Patient.EmergencyRid`
    FOREIGN KEY (`emergencyrid`)
    REFERENCES `EmergencyR` (`emergencyrid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Ethnicity.ethnicityid_Patient.ethnicityid`
    FOREIGN KEY (`ethnicityid`)
    REFERENCES `Ethnicity` (`ethnicityid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Gender.genderid_Patient.genderid`
    FOREIGN KEY (`genderid`)
    REFERENCES `Gender` (`genderid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `PrimaryLanguage.languageid_Patient.languageid`
    FOREIGN KEY (`languageid`)
    REFERENCES `PrimaryLanguage` (`languageid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Race.raceid_Patient.raceid`
    FOREIGN KEY (`raceid`)
    REFERENCES `Race` (`raceid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `State.stateid_Patient.stateid`
    FOREIGN KEY (`stateid`)
    REFERENCES `State` (`stateid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Zip.zipid_Patient.zipid`
    FOREIGN KEY (`zipid`)
    REFERENCES `Zip` (`zipid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 588
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Colonoscopy`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Colonoscopy` ;

CREATE TABLE IF NOT EXISTS `Colonoscopy` (
  `colonoscopyid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  `colonoscopy` DATE NULL DEFAULT NULL COMMENT 'Date of the patient\'s most recent colonoscopy',
  PRIMARY KEY (`colonoscopyid`),
  INDEX `Patient.patientid_Colonoscopy.patientid` (`patientid` ASC),
  CONSTRAINT `Patient.patientid_Colonoscopy.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `CooperGreen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CooperGreen` ;

CREATE TABLE IF NOT EXISTS `CooperGreen` (
  `cooperid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cooper` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`cooperid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COMMENT = 'Table semantics changed to ask about health first card (UAB-specific)';


-- -----------------------------------------------------
-- Table `CurrentEmployment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CurrentEmployment` ;

CREATE TABLE IF NOT EXISTS `CurrentEmployment` (
  `employmentid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employment` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`employmentid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Disability`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Disability` ;

CREATE TABLE IF NOT EXISTS `Disability` (
  `disabilityid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `disability` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`disabilityid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `EducationLevel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EducationLevel` ;

CREATE TABLE IF NOT EXISTS `EducationLevel` (
  `educationid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `education` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`educationid`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `FoodStamp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FoodStamp` ;

CREATE TABLE IF NOT EXISTS `FoodStamp` (
  `foodstampid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `foodstamp` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`foodstampid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `HeadofHousehold`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `HeadofHousehold` ;

CREATE TABLE IF NOT EXISTS `HeadofHousehold` (
  `housestatid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `housestat` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`housestatid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `HomeType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `HomeType` ;

CREATE TABLE IF NOT EXISTS `HomeType` (
  `hometypeid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `hometype` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`hometypeid`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `MedicalInsurance`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MedicalInsurance` ;

CREATE TABLE IF NOT EXISTS `MedicalInsurance` (
  `insuranceid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `insurance` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`insuranceid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `PrimaryPhysician`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PrimaryPhysician` ;

CREATE TABLE IF NOT EXISTS `PrimaryPhysician` (
  `physicianid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `physician` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`physicianid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `RelationshipStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `RelationshipStatus` ;

CREATE TABLE IF NOT EXISTS `RelationshipStatus` (
  `relationshipid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `relationship` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`relationshipid`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Transport`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Transport` ;

CREATE TABLE IF NOT EXISTS `Transport` (
  `transportid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `transport` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`transportid`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Veteran`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Veteran` ;

CREATE TABLE IF NOT EXISTS `Veteran` (
  `veteranid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `veteran` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`veteranid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `SocialHistory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SocialHistory` ;

CREATE TABLE IF NOT EXISTS `SocialHistory` (
  `sid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `householdincome` BIGINT(20) NULL DEFAULT NULL,
  `numchildren` BIGINT(20) NULL DEFAULT NULL,
  `numfammember` BIGINT(20) NULL DEFAULT NULL,
  `heareab` TEXT NULL DEFAULT NULL,
  `cooperid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `physicianid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `educationid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `housestatid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `insuranceid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `disabilityid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `veteranid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `employmentid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `relationshipid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `alcoholid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `foodstampid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `hometypeid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `transportid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`sid`),
  INDEX `Patient.patientid_SocialHistory.patientid` (`patientid` ASC),
  INDEX `CooperGreen.cooperid_SocialHistory.cooperid` (`cooperid` ASC),
  INDEX `PrimaryPhysician.physicianid_SocialHistory.physicianid` (`physicianid` ASC),
  INDEX `EducationLevel.educationid_SocialHistory.educationid` (`educationid` ASC),
  INDEX `HeadofHousehold.housestatid_SocialHistory.housestatid` (`housestatid` ASC),
  INDEX `MedicalInsurance.insuranceid_SocialHistory.insuranceid` (`insuranceid` ASC),
  INDEX `Disability.disabilityid_SocialHistory.disabilityid` (`disabilityid` ASC),
  INDEX `Veteran.veteranid_SocialHistory.veteranid` (`veteranid` ASC),
  INDEX `CurrentEmployment.employmentid_SocialHistory.employmentid` (`employmentid` ASC),
  INDEX `RelationshipStatus.relationshipid_SocialHistory.relationshipid` (`relationshipid` ASC),
  INDEX `Alcohol.cooperid_SocialHistory.alcoholid` (`alcoholid` ASC),
  INDEX `FoodStamp.foodstampid_SocialHistory.foodstampid` (`foodstampid` ASC),
  INDEX `HomeType.hometypeid_SocialHistory.hometypeid` (`hometypeid` ASC),
  INDEX `Transport.transportid_SocialHistory.transportid` (`transportid` ASC),
  CONSTRAINT `Alcohol.cooperid_SocialHistory.alcoholid`
    FOREIGN KEY (`alcoholid`)
    REFERENCES `Alcohol` (`alcoholid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `CooperGreen.cooperid_SocialHistory.cooperid`
    FOREIGN KEY (`cooperid`)
    REFERENCES `CooperGreen` (`cooperid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `CurrentEmployment.employmentid_SocialHistory.employmentid`
    FOREIGN KEY (`employmentid`)
    REFERENCES `CurrentEmployment` (`employmentid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Disability.disabilityid_SocialHistory.disabilityid`
    FOREIGN KEY (`disabilityid`)
    REFERENCES `Disability` (`disabilityid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `EducationLevel.educationid_SocialHistory.educationid`
    FOREIGN KEY (`educationid`)
    REFERENCES `EducationLevel` (`educationid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `FoodStamp.foodstampid_SocialHistory.foodstampid`
    FOREIGN KEY (`foodstampid`)
    REFERENCES `FoodStamp` (`foodstampid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `HeadofHousehold.housestatid_SocialHistory.housestatid`
    FOREIGN KEY (`housestatid`)
    REFERENCES `HeadofHousehold` (`housestatid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `HomeType.hometypeid_SocialHistory.hometypeid`
    FOREIGN KEY (`hometypeid`)
    REFERENCES `HomeType` (`hometypeid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `MedicalInsurance.insuranceid_SocialHistory.insuranceid`
    FOREIGN KEY (`insuranceid`)
    REFERENCES `MedicalInsurance` (`insuranceid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Patient.patientid_SocialHistory.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `PrimaryPhysician.physicianid_SocialHistory.physicianid`
    FOREIGN KEY (`physicianid`)
    REFERENCES `PrimaryPhysician` (`physicianid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `RelationshipStatus.relationshipid_SocialHistory.relationshipid`
    FOREIGN KEY (`relationshipid`)
    REFERENCES `RelationshipStatus` (`relationshipid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Transport.transportid_SocialHistory.transportid`
    FOREIGN KEY (`transportid`)
    REFERENCES `Transport` (`transportid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `Veteran.veteranid_SocialHistory.veteranid`
    FOREIGN KEY (`veteranid`)
    REFERENCES `Veteran` (`veteranid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 580
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `CurrentSmoker`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `CurrentSmoker` ;

CREATE TABLE IF NOT EXISTS `CurrentSmoker` (
  `currentsmokerid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid` BIGINT(20) UNSIGNED NOT NULL,
  `startdate` DATE NULL DEFAULT NULL,
  `packsperday` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`currentsmokerid`),
  INDEX `SocialHistory.sid_CurrentSmoker.sid` (`sid` ASC),
  CONSTRAINT `SocialHistory.sid_CurrentSmoker.sid`
    FOREIGN KEY (`sid`)
    REFERENCES `SocialHistory` (`sid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `DrugType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DrugType` ;

CREATE TABLE IF NOT EXISTS `DrugType` (
  `drugtypeid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `drugtype` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`drugtypeid`))
ENGINE = InnoDB
AUTO_INCREMENT = 29
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `Mammogram`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Mammogram` ;

CREATE TABLE IF NOT EXISTS `Mammogram` (
  `mammogramid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  `mammogram` DATE NULL DEFAULT NULL COMMENT 'Date of patient\'s most recent mammogram',
  PRIMARY KEY (`mammogramid`),
  INDEX `Patient.patientid_Mammogram.patientid` (`patientid` ASC),
  CONSTRAINT `Patient.patientid_Mammogram.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `PapSmear`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PapSmear` ;

CREATE TABLE IF NOT EXISTS `PapSmear` (
  `papsmearid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  `papsmear` DATE NULL DEFAULT NULL COMMENT 'Date of the patient\'s most recent pap smear',
  PRIMARY KEY (`papsmearid`),
  INDEX `Patient.patientid_PapSmear.patientid` (`patientid` ASC),
  CONSTRAINT `Patient.patientid_PapSmear.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `PastSmoker`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PastSmoker` ;

CREATE TABLE IF NOT EXISTS `PastSmoker` (
  `pastsmokerid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sid` BIGINT(20) UNSIGNED NOT NULL,
  `startdate` DATE NULL DEFAULT NULL,
  `quitdate` DATE NULL DEFAULT NULL,
  `packsperday` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`pastsmokerid`),
  INDEX `SocialHistory.sid_PastSmoker.sid` (`sid` ASC),
  CONSTRAINT `SocialHistory.sid_PastSmoker.sid`
    FOREIGN KEY (`sid`)
    REFERENCES `SocialHistory` (`sid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `PatientAllergy`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PatientAllergy` ;

CREATE TABLE IF NOT EXISTS `PatientAllergy` (
  `patientallergyid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `allergylistid` BIGINT(20) UNSIGNED NOT NULL,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`patientallergyid`),
  INDEX `AllergyList.allergylistid_PatientAllergy.patientallergyid` (`allergylistid` ASC),
  INDEX `Patient.patientid_PatientAllergy.patientid` (`patientid` ASC),
  CONSTRAINT `AllergyList.allergylistid_PatientAllergy.patientallergyid`
    FOREIGN KEY (`allergylistid`)
    REFERENCES `AllergyList` (`allergylistid`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `Patient.patientid_PatientAllergy.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ReasonforVisit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ReasonforVisit` ;

CREATE TABLE IF NOT EXISTS `ReasonforVisit` (
  `reasonforvisitid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reasonforvisit` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`reasonforvisitid`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `VisitType`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `VisitType` ;

CREATE TABLE IF NOT EXISTS `VisitType` (
  `visittypeid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `visittype` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`visittypeid`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COMMENT = 'Basic table that provides core system functionallity.  DO NOT CHANGE THIS TABLE!!!!';


-- -----------------------------------------------------
-- Table `PatientVisit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PatientVisit` ;

CREATE TABLE IF NOT EXISTS `PatientVisit` (
  `patientvisitid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pstat` TEXT NULL DEFAULT NULL,
  `currentdate` DATE NULL DEFAULT NULL,
  `reasonforvisitid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `visittypeid` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  `socialservicesneeded` TINYINT NULL COMMENT 'boolean indicating whether social services was desired during the visit',
  PRIMARY KEY (`patientvisitid`),
  INDEX `Patient.patientid_PatientVisit.patientid` (`patientid` ASC),
  INDEX `ReasonforVisit.reasonforvisitid_PatientVisit.reasonforvisitid` (`reasonforvisitid` ASC),
  INDEX `VisitType.visittypeid_PatientVisit.visittypeid` (`visittypeid` ASC),
  CONSTRAINT `Patient.patientid_PatientVisit.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ReasonforVisit.reasonforvisitid_PatientVisit.reasonforvisitid`
    FOREIGN KEY (`reasonforvisitid`)
    REFERENCES `ReasonforVisit` (`reasonforvisitid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `VisitType.visittypeid_PatientVisit.visittypeid`
    FOREIGN KEY (`visittypeid`)
    REFERENCES `VisitType` (`visittypeid`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `STI`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `STI` ;

CREATE TABLE IF NOT EXISTS `STI` (
  `stiid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `patientid` BIGINT(20) UNSIGNED NOT NULL,
  `sti` DATE NULL DEFAULT NULL COMMENT 'Date of patient\'s last STI test',
  PRIMARY KEY (`stiid`),
  INDEX `Patient.patientid_STI.patientid` (`patientid` ASC),
  CONSTRAINT `Patient.patientid_STI.patientid`
    FOREIGN KEY (`patientid`)
    REFERENCES `Patient` (`patientid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `SocialDrugs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SocialDrugs` ;

CREATE TABLE IF NOT EXISTS `SocialDrugs` (
  `socialdrugsid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `drugtypeid` BIGINT(20) UNSIGNED NOT NULL,
  `sid` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`socialdrugsid`),
  INDEX `DrugType.drugtypeid_SocialDrugs.drugtypeid` (`drugtypeid` ASC),
  INDEX `SocialHistory.sid_SocialDrugs.sid` (`sid` ASC),
  CONSTRAINT `DrugType.drugtypeid_SocialDrugs.drugtypeid`
    FOREIGN KEY (`drugtypeid`)
    REFERENCES `DrugType` (`drugtypeid`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `SocialHistory.sid_SocialDrugs.sid`
    FOREIGN KEY (`sid`)
    REFERENCES `SocialHistory` (`sid`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Alcohol`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Alcohol` (`alcoholid`, `alcohol`) VALUES (DEFAULT, 'Never');
INSERT INTO `Alcohol` (`alcoholid`, `alcohol`) VALUES (DEFAULT, 'Quit');
INSERT INTO `Alcohol` (`alcoholid`, `alcohol`) VALUES (DEFAULT, 'Rarely');
INSERT INTO `Alcohol` (`alcoholid`, `alcohol`) VALUES (DEFAULT, 'Moderate');
INSERT INTO `Alcohol` (`alcoholid`, `alcohol`) VALUES (DEFAULT, 'Daily');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CitizenStatus`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `CitizenStatus` (`citizenid`, `citizen`) VALUES (DEFAULT, 'US Citizen');
INSERT INTO `CitizenStatus` (`citizenid`, `citizen`) VALUES (DEFAULT, 'Permanent');
INSERT INTO `CitizenStatus` (`citizenid`, `citizen`) VALUES (DEFAULT, 'Undocumented Resident');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ethnicity`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Ethnicity` (`ethnicityid`, `ethnicity`) VALUES (DEFAULT, 'Hispanic');
INSERT INTO `Ethnicity` (`ethnicityid`, `ethnicity`) VALUES (DEFAULT, 'Non-Hispanic');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Gender`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Gender` (`genderid`, `gender`) VALUES (DEFAULT, 'Male');
INSERT INTO `Gender` (`genderid`, `gender`) VALUES (DEFAULT, 'Female');
INSERT INTO `Gender` (`genderid`, `gender`) VALUES (DEFAULT, 'Transgender');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Race`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Race` (`raceid`, `race`) VALUES (DEFAULT, 'White');
INSERT INTO `Race` (`raceid`, `race`) VALUES (DEFAULT, 'Black or African American');
INSERT INTO `Race` (`raceid`, `race`) VALUES (DEFAULT, 'American Indian or Alaska Native');
INSERT INTO `Race` (`raceid`, `race`) VALUES (DEFAULT, 'Asian');
INSERT INTO `Race` (`raceid`, `race`) VALUES (DEFAULT, 'Native Hawaiian or Other Pacific Islander');
INSERT INTO `Race` (`raceid`, `race`) VALUES (DEFAULT, 'Hispanic');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CooperGreen`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `CooperGreen` (`cooperid`, `cooper`) VALUES (DEFAULT, 'Yes');
INSERT INTO `CooperGreen` (`cooperid`, `cooper`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `CurrentEmployment`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `CurrentEmployment` (`employmentid`, `employment`) VALUES (DEFAULT, 'Yes');
INSERT INTO `CurrentEmployment` (`employmentid`, `employment`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Disability`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Disability` (`disabilityid`, `disability`) VALUES (DEFAULT, 'Yes');
INSERT INTO `Disability` (`disabilityid`, `disability`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `EducationLevel`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `EducationLevel` (`educationid`, `education`) VALUES (DEFAULT, 'Some High School');
INSERT INTO `EducationLevel` (`educationid`, `education`) VALUES (DEFAULT, 'High School Diploma');
INSERT INTO `EducationLevel` (`educationid`, `education`) VALUES (DEFAULT, 'GED');
INSERT INTO `EducationLevel` (`educationid`, `education`) VALUES (DEFAULT, 'Some College');
INSERT INTO `EducationLevel` (`educationid`, `education`) VALUES (DEFAULT, 'College');
INSERT INTO `EducationLevel` (`educationid`, `education`) VALUES (DEFAULT, 'Post-graduate');

COMMIT;


-- -----------------------------------------------------
-- Data for table `FoodStamp`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `FoodStamp` (`foodstampid`, `foodstamp`) VALUES (DEFAULT, 'Yes');
INSERT INTO `FoodStamp` (`foodstampid`, `foodstamp`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `HeadofHousehold`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `HeadofHousehold` (`housestatid`, `housestat`) VALUES (DEFAULT, 'Yes');
INSERT INTO `HeadofHousehold` (`housestatid`, `housestat`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `HomeType`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `HomeType` (`hometypeid`, `hometype`) VALUES (DEFAULT, 'Homeless');
INSERT INTO `HomeType` (`hometypeid`, `hometype`) VALUES (DEFAULT, 'Homeless Shelter');
INSERT INTO `HomeType` (`hometypeid`, `hometype`) VALUES (DEFAULT, 'Rental House/Apartment');
INSERT INTO `HomeType` (`hometypeid`, `hometype`) VALUES (DEFAULT, 'Personal Residence');

COMMIT;


-- -----------------------------------------------------
-- Data for table `MedicalInsurance`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `MedicalInsurance` (`insuranceid`, `insurance`) VALUES (DEFAULT, 'Yes');
INSERT INTO `MedicalInsurance` (`insuranceid`, `insurance`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `PrimaryPhysician`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `PrimaryPhysician` (`physicianid`, `physician`) VALUES (DEFAULT, 'Yes');
INSERT INTO `PrimaryPhysician` (`physicianid`, `physician`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `RelationshipStatus`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `RelationshipStatus` (`relationshipid`, `relationship`) VALUES (DEFAULT, 'Never married');
INSERT INTO `RelationshipStatus` (`relationshipid`, `relationship`) VALUES (DEFAULT, 'Married/Partnered');
INSERT INTO `RelationshipStatus` (`relationshipid`, `relationship`) VALUES (DEFAULT, 'Separated');
INSERT INTO `RelationshipStatus` (`relationshipid`, `relationship`) VALUES (DEFAULT, 'Divorced');
INSERT INTO `RelationshipStatus` (`relationshipid`, `relationship`) VALUES (DEFAULT, 'Widowed');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Transport`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Transport` (`transportid`, `transport`) VALUES (DEFAULT, 'Walk/Bike');
INSERT INTO `Transport` (`transportid`, `transport`) VALUES (DEFAULT, 'Public Transportation');
INSERT INTO `Transport` (`transportid`, `transport`) VALUES (DEFAULT, 'Personal Vehicle');
INSERT INTO `Transport` (`transportid`, `transport`) VALUES (DEFAULT, 'Ride from Friend/Family');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Veteran`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `Veteran` (`veteranid`, `veteran`) VALUES (DEFAULT, 'Yes');
INSERT INTO `Veteran` (`veteranid`, `veteran`) VALUES (DEFAULT, 'No');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ReasonforVisit`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `ReasonforVisit` (`reasonforvisitid`, `reasonforvisit`) VALUES (DEFAULT, 'Recent Problem (<2 weeks), ex. new back pain');
INSERT INTO `ReasonforVisit` (`reasonforvisitid`, `reasonforvisit`) VALUES (DEFAULT, 'Ongoing Problem (>2 weeks), ex. high blood pressure');
INSERT INTO `ReasonforVisit` (`reasonforvisitid`, `reasonforvisit`) VALUES (DEFAULT, 'Smoking/Alcohol/Drug Cessation');
INSERT INTO `ReasonforVisit` (`reasonforvisitid`, `reasonforvisit`) VALUES (DEFAULT, 'Mental Health');

COMMIT;


-- -----------------------------------------------------
-- Data for table `VisitType`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `VisitType` (`visittypeid`, `visittype`) VALUES (DEFAULT, 'New Patient');
INSERT INTO `VisitType` (`visittypeid`, `visittype`) VALUES (DEFAULT, 'Returning Patient');

COMMIT;
