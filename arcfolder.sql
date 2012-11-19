/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : arcfolder

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2012-11-19 01:01:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `af_categories`
-- ----------------------------
DROP TABLE IF EXISTS `af_categories`;
CREATE TABLE `af_categories` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryNiceName` varchar(255) NOT NULL,
  PRIMARY KEY (`CategoryID`,`CategoryName`,`CategoryNiceName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of af_categories
-- ----------------------------
INSERT INTO `af_categories` VALUES ('1', 'Addons', 'addons');
INSERT INTO `af_categories` VALUES ('2', 'Libraries', 'libraries');

-- ----------------------------
-- Table structure for `af_packages`
-- ----------------------------
DROP TABLE IF EXISTS `af_packages`;
CREATE TABLE `af_packages` (
  `PackageID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) NOT NULL,
  `PackageVersion` varchar(11) NOT NULL,
  `PackageCompat` varchar(11) NOT NULL,
  `PackageDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PackageURL` varchar(255) NOT NULL,
  `PackagePath` varchar(255) DEFAULT NULL,
  `PackageChanges` blob,
  `PackageDependencies` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PackageID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of af_packages
-- ----------------------------
INSERT INTO `af_packages` VALUES ('1', '1', '1', '0.5.1476', '2012-11-10 22:20:43', 'packages/addons/jekotia/example_addon/example_addon-v1-jekotia.zip', 'gui/components/MainUI/Addons/', 0x46697273742072656C656173652E, '2');
INSERT INTO `af_packages` VALUES ('2', '2', '1', '0.5.1476', '2012-11-10 22:21:47', 'packages/libraries/jekotia/example_library/example_library-v1-jekotia.zip', 'gui/lib/', 0x46697273742072656C656173652E, null);

-- ----------------------------
-- Table structure for `af_projects`
-- ----------------------------
DROP TABLE IF EXISTS `af_projects`;
CREATE TABLE `af_projects` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `ProjectNiceName` varchar(255) NOT NULL,
  `ProjectDescription` blob,
  `ProjectURL` varchar(255) DEFAULT NULL,
  `TagID` varchar(255) DEFAULT NULL,
  `CategoryID` int(11) NOT NULL,
  `PackageLatest` int(11) NOT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of af_projects
-- ----------------------------
INSERT INTO `af_projects` VALUES ('1', '1', 'Example Addon', 'example_addon', 0x416E206578616D706C65206164646F6E2E, 'example_addon.net', '2,5', '1', '1');
INSERT INTO `af_projects` VALUES ('2', '1', 'Example Library', 'example_library', 0x416E206578616D706C65206C6962726172792E, 'example_library.net', '5', '2', '2');

-- ----------------------------
-- Table structure for `af_tags`
-- ----------------------------
DROP TABLE IF EXISTS `af_tags`;
CREATE TABLE `af_tags` (
  `TagID` int(11) NOT NULL AUTO_INCREMENT,
  `TagName` varchar(20) NOT NULL,
  `TagNiceName` varchar(20) NOT NULL,
  PRIMARY KEY (`TagID`,`TagName`,`TagNiceName`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of af_tags
-- ----------------------------
INSERT INTO `af_tags` VALUES ('1', 'Open World', 'open_world');
INSERT INTO `af_tags` VALUES ('2', 'PvP', 'pvp');
INSERT INTO `af_tags` VALUES ('3', 'PvE', 'pve');
INSERT INTO `af_tags` VALUES ('4', 'Weapons', 'weapons');
INSERT INTO `af_tags` VALUES ('5', 'Reticule', 'reticule');
INSERT INTO `af_tags` VALUES ('6', '3D', '3d');
INSERT INTO `af_tags` VALUES ('7', 'Resources', 'resources');
INSERT INTO `af_tags` VALUES ('8', 'Loot', 'loot');
INSERT INTO `af_tags` VALUES ('9', 'SIN', 'sin');
INSERT INTO `af_tags` VALUES ('10', 'Player', 'player');
INSERT INTO `af_tags` VALUES ('11', 'Enemy', 'enemy');
INSERT INTO `af_tags` VALUES ('12', 'NPC', 'npc');
INSERT INTO `af_tags` VALUES ('13', 'Health', 'health');
INSERT INTO `af_tags` VALUES ('14', 'Energy', 'energy');
INSERT INTO `af_tags` VALUES ('15', 'Ability', 'ability');
INSERT INTO `af_tags` VALUES ('16', 'Thumper', 'thumper');
INSERT INTO `af_tags` VALUES ('17', 'World Events', 'world_events');
INSERT INTO `af_tags` VALUES ('18', 'Team Deathmatch', 'team_deathmatch');
INSERT INTO `af_tags` VALUES ('19', 'Sabotage', 'sabotage');
INSERT INTO `af_tags` VALUES ('20', 'Harvester', 'harvester');
INSERT INTO `af_tags` VALUES ('21', 'Sunken Harbour', 'sunken_harbour');
INSERT INTO `af_tags` VALUES ('22', 'The Rig', 'the_rig');
INSERT INTO `af_tags` VALUES ('23', 'Shanty Town', 'shanty_town');
INSERT INTO `af_tags` VALUES ('24', 'Moisture Farm', 'moisture_farm');
INSERT INTO `af_tags` VALUES ('25', 'Orbital Comm Tower', 'orbital_comm_tower');
INSERT INTO `af_tags` VALUES ('26', 'Blackwater', 'blackwater');
INSERT INTO `af_tags` VALUES ('27', 'Chosen', 'chosen');
INSERT INTO `af_tags` VALUES ('28', 'Damage', 'damage');
INSERT INTO `af_tags` VALUES ('29', 'Healing', 'healing');
INSERT INTO `af_tags` VALUES ('30', 'XP', 'xp');
INSERT INTO `af_tags` VALUES ('31', 'Battleframe', 'battleframe');
INSERT INTO `af_tags` VALUES ('32', 'Tier', 'tier');

-- ----------------------------
-- Table structure for `af_users`
-- ----------------------------
DROP TABLE IF EXISTS `af_users`;
CREATE TABLE `af_users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(20) NOT NULL,
  `UserNiceName` varchar(15) NOT NULL,
  `UserPassword` varchar(64) NOT NULL,
  `UserToken` varchar(64) DEFAULT NULL,
  `UserIP` varchar(15) NOT NULL,
  `UserGroup` int(1) DEFAULT '1',
  `UserEmail` varchar(64) NOT NULL,
  PRIMARY KEY (`UserID`,`UserName`,`UserNiceName`,`UserEmail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of af_users
-- ----------------------------
