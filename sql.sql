-- commander table
CREATE TABLE `bbnState`.`commanders` (
`command_id` INT NOT NULL AUTO_INCREMENT ,
`commander_name` VARCHAR(255) NOT NULL,
`commander_email` VARCHAR(255) NOT NULL ,
`commander_phone_no` INT(15) NOT NULL ,
`commander_home_church` VARCHAR(255) NOT NULL ,
`commander_permissions` VARCHAR(100) NOT NULL ,
`commander_accessName` VARCHAR(255) NOT NULL ,
`commander_password` VARCHAR(255) NOT NULL ,
`vkey` VARCHAR(64) NULL ,
`verified` TINYINT NOT NULL DEFAULT '0' ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
`dateAdded` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`command_id`)) ENGINE = InnoDB;

-- commander profile
create table commander_profile (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
commander_id int(11) not null,
status tinyint (4) not null DEFAULT 0
)


-- officers TABLE
CREATE TABLE `bbnState`.`officers` (
`officer_id` INT NOT NULL AUTO_INCREMENT ,
`officers_name` VARCHAR(255) NOT NULL,
`officers_email` VARCHAR(255) NOT NULL ,
`officers_phone_no` INT(15) NOT NULL ,
`officers_company_code` VARCHAR(255) NOT NULL ,
`officers_Lt_inCharge_name` VARCHAR(255) NOT NULL ,
`officers_Capts_name` VARCHAR(255) NOT NULL ,
`officers_rank` VARCHAR(255) NOT NULL ,
`officers_home_church` VARCHAR(255) NOT NULL ,
`officers_dob` DATE NOT NULL,
`officers_permissions` VARCHAR(100) NOT NULL ,
`officers_access_name` VARCHAR(255) NOT NULL ,
`officers_password` VARCHAR(255) NOT NULL ,
`vkey` VARCHAR(64) NULL ,
`verified` TINYINT NOT NULL DEFAULT '0' ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
`date_joined` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`officer_id`)) ENGINE = InnoDB;

-- officers profile
create table officers_profile (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
officer_id int(11) not null,
status tinyint (4) not null DEFAULT 0
)

create table notifications (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
type VARCHAR(255) not null,
message text not null,
dateCreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)

create table news (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) not null,
featuredImage VARCHAR(255) not null,
description text not null,
dateCreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
dateUpdated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)

create table newsImages (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
news_id int(11) not null ,
images text not null
)


create table commander_monitor (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
lieutenant_id int(11) not null,
action text not null,
actionDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

)

create table resetPwd (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
officer_email VARCHAR(255) not null,
resetPwdselector VARCHAR(64) not null,
resetPwdvalidator VARCHAR(64) not null,
resetPwdExpiry TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

)

create table BBHistory (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
bb_logo VARCHAR(255) not null,
bb_title VARCHAR(255) not null,
bb_description text not null


)

create table BBNHistory (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
bb_logo VARCHAR(255) not null,
bb_title VARCHAR(255) not null,
bb_description text not null
)

create table BBStateHistory (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
bb_logo VARCHAR(255) not null,
bb_title VARCHAR(255) not null,
bb_description text not null

)
create table BBStateExecutives (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
exective_name VARCHAR(255) not null,
exective_rank VARCHAR(255) not null,
exective_image VARCHAR(255) not null,
exective_description text not null
)

create table BBStateCaptian (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
captians_name VARCHAR(255) not null,
captians_image VARCHAR(255) not null,
captians_phone_number VARCHAR(255) not null,
captians_description text not null
)

create table BBStateLieutenant (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
lieutenants_name VARCHAR(255) not null,
lieutenants_image VARCHAR(255) not null,
lieutenants_phone_number VARCHAR(255) not null,
lieutenants_description text not null
)
create table BBStateSecGen (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
secGen_name VARCHAR(255) not null,
secGen_image VARCHAR(255) not null,
secGen_phone_number VARCHAR(255) not null,
secGen_description text not null
)
create table BBStateGallery (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
gall_title VARCHAR(255) not null,
gall_event VARCHAR(255) not null,
gall_image VARCHAR(255) not null,
gall_description text not null,
gall_eventDate date not null,
`deleted` TINYINT NOT NULL DEFAULT '0'
)

create table carousel_item (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
carousel_event VARCHAR(255) not null,
carousel_image VARCHAR(255) not null,
carousel_description text not null,
`deleted` TINYINT NOT NULL DEFAULT '0'
)
create table bunker (
id int(11) not null AUTO_INCREMENT PRIMARY KEY,
permission VARCHAR(255) not null,
`deleted` TINYINT NOT NULL DEFAULT '0'
)
CREATE TABLE servedLieutenants (
`id` INT NOT NULL AUTO_INCREMENT ,
`lt_name` VARCHAR(255) NOT NULL ,
`lt_image` VARCHAR(255) NULL ,
`lt_description` TEXT NOT NULL ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `bbnState`.`notes` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `note` TEXT NOT NULL , `dateCreated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `dateUpdated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateVicePresidents` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`pre_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateSSO` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`sso_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `stateASSO` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`asso_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateTreasures` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`tre_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateFinSec` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`fs_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateAuditors` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`aud_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateAuditors` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`aud_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `statePROS` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`pro_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `stateDO` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`do_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `stateParadeCommanders` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`pc_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `statequarterMasters` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`qm_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `stateBandMasters` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`bm_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateBBPionierMem` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`piom_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateBBPatrons` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`pat_name` VARCHAR(255) NOT NULL ,
`served_start_date` DATE NOT NULL ,
`served_finish_date` DATE NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `stateBBconclusion` (
`id` INT(11) NOT NULL AUTO_INCREMENT ,
`conclusion` text NOT NULL ,
`deleted` TINYINT NOT NULL DEFAULT '0' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB;



CREATE TABLE `DataFormBoys` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `stateNo` varchar(20) DEFAULT NULL,
  `Qualification` varchar(255) NOT NULL,
  `LastTraining` year(4) DEFAULT NULL,
  `hasStateID` tinyint(4) NOT NULL DEFAULT 0
)

CREATE TABLE `DataFormOfficers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `stateNo` varchar(20) DEFAULT NULL,
  `Qualification` varchar(255) NOT NULL,
  `LastTraining` year(4) DEFAULT NULL,
  `hasStateID` tinyint(4) NOT NULL DEFAULT 0
)

CREATE TABLE `DataFormMothers` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `stateNo` varchar(20) DEFAULT NULL,
  `Qualification` varchar(255) NOT NULL,
  `LastTraining` year(4) DEFAULT NULL,
  `hasStateID` tinyint(4) NOT NULL DEFAULT 0
)
CREATE TABLE `DataFormPatrons` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `stateNo` varchar(20) DEFAULT NULL,
  `Qualification` varchar(255) NOT NULL,
  `LastTraining` year(4) DEFAULT NULL,
  `hasStateID` tinyint(4) NOT NULL DEFAULT 0
)

CREATE TABLE `DataFormSummaryCompany` (
  `id` int(11) NOT NULL,
  `NoOfBoys` varchar(255) NOT NULL,
  `NoOfOfficers` varchar(255) NOT NULL,
  `NoOfPatrons` varchar(255) NOT NULL,
  `NoOfMothers` varchar(255) NOT NULL
)


CREATE TABLE `DataFormSummaryCouncil` (
  `id` int(11) NOT NULL,
  `NoOfBoys` varchar(255) NOT NULL,
  `NoOfOfficers` varchar(255) NOT NULL,
  `NoOfPatrons` varchar(255) NOT NULL,
  `NoOfMothers` varchar(255) NOT NULL
)


CREATE TABLE `DataFormCouncilAll` (
  `id` int(11) NOT NULL,
  `CompanyName` varchar(255) NOT NULL,
  `NoOfBoys` varchar(255) NOT NULL,
  `NoOfOfficers` varchar(255) NOT NULL,
  `NoOfPatrons` varchar(255) NOT NULL,
  `NoOfMothers` varchar(255) NOT NULL
)


DataFormInfo