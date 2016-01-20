USE `eabdbw`;

UPDATE `ReasonforVisit` SET `reasonforvisit` = "Recent Problem (<2 weeks), ex. new back pain" WHERE `reasonforvisitid` = 2;

UPDATE `ReasonforVisit` SET `reasonforvisit` = "Ongoing Problem (>2 weeks), ex. high blood pressure" WHERE `reasonforvisitid` = 3;

UPDATE `AllergyList` SET `allergylist` = "Sulfa drugs/Sulfonamides" WHERE `allergylistid` = 1;