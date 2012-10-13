/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : scrum

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2012-10-13 01:04:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `assigned`
-- ----------------------------
DROP TABLE IF EXISTS `assigned`;
CREATE TABLE `assigned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `saved_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assigned_task1` (`task_id`),
  KEY `fk_assigned_team1` (`team_id`),
  CONSTRAINT `fk_assigned_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_assigned_team1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of assigned
-- ----------------------------

-- ----------------------------
-- Table structure for `AuthAssignment`
-- ----------------------------
DROP TABLE IF EXISTS `AuthAssignment`;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of AuthAssignment
-- ----------------------------
INSERT INTO AuthAssignment VALUES ('SuperAdmin', '1', '', '');
INSERT INTO AuthAssignment VALUES ('guest', '2', null, 'N;');

-- ----------------------------
-- Table structure for `AuthItem`
-- ----------------------------
DROP TABLE IF EXISTS `AuthItem`;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of AuthItem
-- ----------------------------
INSERT INTO AuthItem VALUES ('SuperAdmin', '2', '', '', '');
INSERT INTO AuthItem VALUES ('RbacAssignmentEditor', '1', '', '', '');
INSERT INTO AuthItem VALUES ('RbacViewer', '0', '', '', '');
INSERT INTO AuthItem VALUES ('RbacEditor', '1', '', '', '');
INSERT INTO AuthItem VALUES ('RbacAssignmentViewer', '0', '', '', '');
INSERT INTO AuthItem VALUES ('RbacAdmin', '2', '', '', '');
INSERT INTO AuthItem VALUES ('registered', '2', 'Default role by Yii-conf', 'return !Yii::app()->user->isGuest;', '');
INSERT INTO AuthItem VALUES ('guest', '2', '', null, 'N;');
INSERT INTO AuthItem VALUES ('administrador', '2', '', null, 'N;');
INSERT INTO AuthItem VALUES ('site', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('siteLogin', '0', 'Autenticación del sistema.', null, 'N;');
INSERT INTO AuthItem VALUES ('siteIndex', '0', 'Indice del sistema.', null, 'N;');
INSERT INTO AuthItem VALUES ('siteError', '0', 'Autenticacion del sistema.', null, 'N;');
INSERT INTO AuthItem VALUES ('siteLogout', '0', 'Salir del sistema.', null, 'N;');
INSERT INTO AuthItem VALUES ('siteCiclo', '0', 'Seleccionar el ciclo del sistema.', null, 'N;');
INSERT INTO AuthItem VALUES ('siteSite', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('siteUsuario', '0', 'Cambiar el password del usuario del sistema.', null, 'N;');
INSERT INTO AuthItem VALUES ('historical', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('historicalIndex', '0', 'Indice del controlador historical .', null, 'N;');
INSERT INTO AuthItem VALUES ('historicalView', '0', 'Vista del controlador historical .', null, 'N;');
INSERT INTO AuthItem VALUES ('localizacion', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('localizacionEstados', '0', 'Indice del controlador localizacion .', null, 'N;');
INSERT INTO AuthItem VALUES ('localizacionEditar', '0', 'Vista del controlador localizacion .', null, 'N;');
INSERT INTO AuthItem VALUES ('localizacionMunicipios', '0', 'Actualizar del controlador localizacion .', null, 'N;');
INSERT INTO AuthItem VALUES ('project', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('projectIndex', '0', 'Indice del controlador project .', null, 'N;');
INSERT INTO AuthItem VALUES ('projectView', '0', 'Vista del controlador project .', null, 'N;');
INSERT INTO AuthItem VALUES ('projectUpdate', '0', 'Actualizar del controlador project .', null, 'N;');
INSERT INTO AuthItem VALUES ('projectCreate', '0', 'Crear del controlador project .', null, 'N;');
INSERT INTO AuthItem VALUES ('projectDelete', '0', 'Eliminar del controlador project .', null, 'N;');
INSERT INTO AuthItem VALUES ('revisa', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('revisaNoexiste', '0', 'Indice del controlador revisa .', null, 'N;');
INSERT INTO AuthItem VALUES ('user', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('userIndex', '0', 'Indice del controlador user .', null, 'N;');
INSERT INTO AuthItem VALUES ('userView', '0', 'Vista del controlador user .', null, 'N;');
INSERT INTO AuthItem VALUES ('userUpdate', '0', 'Actualizar del controlador user .', null, 'N;');
INSERT INTO AuthItem VALUES ('userCreate', '0', 'Crear del controlador user .', null, 'N;');
INSERT INTO AuthItem VALUES ('userDelete', '0', 'Eliminar del controlador user .', null, 'N;');
INSERT INTO AuthItem VALUES ('userPass', '0', 'Cambiar el password del usuario.', null, 'N;');
INSERT INTO AuthItem VALUES ('permisos', '1', '', null, 'N;');
INSERT INTO AuthItem VALUES ('permisosCrea', '0', 'Crear estructura de permisos.', null, 'N;');
INSERT INTO AuthItem VALUES ('permisosCrear', '0', 'Crear estructura de permisos.', null, 'N;');

-- ----------------------------
-- Table structure for `AuthItemChild`
-- ----------------------------
DROP TABLE IF EXISTS `AuthItemChild`;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of AuthItemChild
-- ----------------------------
INSERT INTO AuthItemChild VALUES ('administrador', 'historical');
INSERT INTO AuthItemChild VALUES ('administrador', 'localizacion');
INSERT INTO AuthItemChild VALUES ('administrador', 'project');
INSERT INTO AuthItemChild VALUES ('administrador', 'revisa');
INSERT INTO AuthItemChild VALUES ('administrador', 'siteSite');
INSERT INTO AuthItemChild VALUES ('administrador', 'user');
INSERT INTO AuthItemChild VALUES ('guest', 'site');
INSERT INTO AuthItemChild VALUES ('historical', 'historicalIndex');
INSERT INTO AuthItemChild VALUES ('historical', 'historicalView');
INSERT INTO AuthItemChild VALUES ('localizacion', 'localizacionEditar');
INSERT INTO AuthItemChild VALUES ('localizacion', 'localizacionEstados');
INSERT INTO AuthItemChild VALUES ('localizacion', 'localizacionMunicipios');
INSERT INTO AuthItemChild VALUES ('permisos', 'permisosCrea');
INSERT INTO AuthItemChild VALUES ('permisos', 'permisosCrear');
INSERT INTO AuthItemChild VALUES ('project', 'projectCreate');
INSERT INTO AuthItemChild VALUES ('project', 'projectDelete');
INSERT INTO AuthItemChild VALUES ('project', 'projectIndex');
INSERT INTO AuthItemChild VALUES ('project', 'projectUpdate');
INSERT INTO AuthItemChild VALUES ('project', 'projectView');
INSERT INTO AuthItemChild VALUES ('RbacAdmin', 'RbacAssignmentEditor');
INSERT INTO AuthItemChild VALUES ('RbacAdmin', 'RbacEditor');
INSERT INTO AuthItemChild VALUES ('RbacAssignmentEditor', 'RbacAssignmentViewer');
INSERT INTO AuthItemChild VALUES ('RbacEditor', 'RbacViewer');
INSERT INTO AuthItemChild VALUES ('revisa', 'revisaNoexiste');
INSERT INTO AuthItemChild VALUES ('site', 'siteCiclo');
INSERT INTO AuthItemChild VALUES ('site', 'siteError');
INSERT INTO AuthItemChild VALUES ('site', 'siteIndex');
INSERT INTO AuthItemChild VALUES ('site', 'siteLogin');
INSERT INTO AuthItemChild VALUES ('site', 'siteLogout');
INSERT INTO AuthItemChild VALUES ('siteSite', 'siteUsuario');
INSERT INTO AuthItemChild VALUES ('SuperAdmin', 'administrador');
INSERT INTO AuthItemChild VALUES ('SuperAdmin', 'permisos');
INSERT INTO AuthItemChild VALUES ('SuperAdmin', 'RbacAdmin');
INSERT INTO AuthItemChild VALUES ('user', 'userCreate');
INSERT INTO AuthItemChild VALUES ('user', 'userDelete');
INSERT INTO AuthItemChild VALUES ('user', 'userIndex');
INSERT INTO AuthItemChild VALUES ('user', 'userPass');
INSERT INTO AuthItemChild VALUES ('user', 'userUpdate');
INSERT INTO AuthItemChild VALUES ('user', 'userView');

-- ----------------------------
-- Table structure for `cstory`
-- ----------------------------
DROP TABLE IF EXISTS `cstory`;
CREATE TABLE `cstory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cstory
-- ----------------------------

-- ----------------------------
-- Table structure for `historical`
-- ----------------------------
DROP TABLE IF EXISTS `historical`;
CREATE TABLE `historical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL,
  `description` varchar(768) NOT NULL,
  `controller` varchar(32) NOT NULL,
  `action` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `record` varchar(32) NOT NULL,
  `saved_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of historical
-- ----------------------------
INSERT INTO historical VALUES ('1', 'root', 'Se agregó el proyecto xxx - ddx.', 'project', 'create', 'Project', '3', '2012-10-12 23:56:14');
INSERT INTO historical VALUES ('2', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:19:17');
INSERT INTO historical VALUES ('3', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:20:43');
INSERT INTO historical VALUES ('4', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:41:25');
INSERT INTO historical VALUES ('5', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:46:30');
INSERT INTO historical VALUES ('6', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:48:15');
INSERT INTO historical VALUES ('7', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:50:39');
INSERT INTO historical VALUES ('8', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:50:51');
INSERT INTO historical VALUES ('9', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '3', '2012-10-13 00:51:58');
INSERT INTO historical VALUES ('10', 'root', 'Se agregó el proyecto xxx1 - d.', 'project', 'create', 'Project', '4', '2012-10-13 01:00:06');
INSERT INTO historical VALUES ('11', 'root', 'Se eliminó el proyecto xxx - ddx.', 'project', 'delete', 'Project', '3', '2012-10-13 01:01:42');
INSERT INTO historical VALUES ('12', 'root', 'Se agregó el proyecto xxx - ddx.', 'project', 'create', 'Project', '5', '2012-10-13 01:02:06');
INSERT INTO historical VALUES ('13', 'root', 'Se editó el proyecto xxx - ddx.', 'project', 'update', 'Project', '5', '2012-10-13 01:03:32');

-- ----------------------------
-- Table structure for `pbacklog`
-- ----------------------------
DROP TABLE IF EXISTS `pbacklog`;
CREATE TABLE `pbacklog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `saved_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pbacklog_project1` (`project_id`),
  KEY `fk_pbacklog_story1` (`story_id`),
  CONSTRAINT `fk_pbacklog_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pbacklog_story1` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pbacklog
-- ----------------------------

-- ----------------------------
-- Table structure for `project`
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sproject_id` int(11) NOT NULL,
  `key` varchar(12) NOT NULL,
  `name` varchar(45) NOT NULL,
  `starts` date DEFAULT NULL,
  `ends` date DEFAULT NULL,
  `saved_at` datetime NOT NULL,
  `modified_in` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_sproject1` (`sproject_id`),
  CONSTRAINT `fk_project_sproject1` FOREIGN KEY (`sproject_id`) REFERENCES `sproject` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO project VALUES ('5', '1', 'xxx', 'ddx', '2012-10-12', '2014-10-13', '2012-10-13 01:02:06', '2012-10-13 01:03:32');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------

-- ----------------------------
-- Table structure for `sbacklog`
-- ----------------------------
DROP TABLE IF EXISTS `sbacklog`;
CREATE TABLE `sbacklog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprint_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `saved_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sbacklog_sprint1` (`sprint_id`),
  KEY `fk_sbacklog_story1` (`story_id`),
  CONSTRAINT `fk_sbacklog_sprint1` FOREIGN KEY (`sprint_id`) REFERENCES `sprint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sbacklog_story1` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sbacklog
-- ----------------------------

-- ----------------------------
-- Table structure for `size`
-- ----------------------------
DROP TABLE IF EXISTS `size`;
CREATE TABLE `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of size
-- ----------------------------

-- ----------------------------
-- Table structure for `sprint`
-- ----------------------------
DROP TABLE IF EXISTS `sprint`;
CREATE TABLE `sprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ssprint_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `starts` date NOT NULL,
  `ends` date NOT NULL,
  `dworked` int(11) DEFAULT NULL,
  `hdayworked` int(11) DEFAULT NULL,
  `saved_at` datetime NOT NULL,
  `modified_in` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sprint_ssprint1` (`ssprint_id`),
  KEY `fk_sprint_project1` (`project_id`),
  CONSTRAINT `fk_sprint_ssprint1` FOREIGN KEY (`ssprint_id`) REFERENCES `ssprint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_sprint_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sprint
-- ----------------------------

-- ----------------------------
-- Table structure for `sproject`
-- ----------------------------
DROP TABLE IF EXISTS `sproject`;
CREATE TABLE `sproject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sproject
-- ----------------------------
INSERT INTO sproject VALUES ('1', 'INI', 'Inicial');
INSERT INTO sproject VALUES ('2', 'APR', 'Aprobado');
INSERT INTO sproject VALUES ('3', 'PRO', 'En proceso');
INSERT INTO sproject VALUES ('4', 'FIN', 'Finalizado');
INSERT INTO sproject VALUES ('5', 'CAN', 'Cancelado');

-- ----------------------------
-- Table structure for `ssprint`
-- ----------------------------
DROP TABLE IF EXISTS `ssprint`;
CREATE TABLE `ssprint` (
  `id` int(11) NOT NULL,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ssprint
-- ----------------------------

-- ----------------------------
-- Table structure for `sstory`
-- ----------------------------
DROP TABLE IF EXISTS `sstory`;
CREATE TABLE `sstory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sstory
-- ----------------------------

-- ----------------------------
-- Table structure for `stask`
-- ----------------------------
DROP TABLE IF EXISTS `stask`;
CREATE TABLE `stask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stask
-- ----------------------------

-- ----------------------------
-- Table structure for `story`
-- ----------------------------
DROP TABLE IF EXISTS `story`;
CREATE TABLE `story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size_id` int(11) NOT NULL,
  `sstory_id` int(11) NOT NULL,
  `cstory_id` int(11) NOT NULL,
  `numer` int(11) NOT NULL,
  `description` varchar(768) NOT NULL,
  `weight` int(11) NOT NULL,
  `saved_at` datetime NOT NULL,
  `modified_in` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_history_size1` (`size_id`),
  KEY `fk_story_sstory1` (`sstory_id`),
  KEY `fk_story_cstory1` (`cstory_id`),
  CONSTRAINT `fk_history_size1` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_story_cstory1` FOREIGN KEY (`cstory_id`) REFERENCES `cstory` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_story_sstory1` FOREIGN KEY (`sstory_id`) REFERENCES `sstory` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of story
-- ----------------------------

-- ----------------------------
-- Table structure for `task`
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stask_id` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `ttask_id` int(11) NOT NULL,
  `summary` varchar(256) NOT NULL,
  `description` text,
  `estimated` int(11) DEFAULT NULL,
  `starts` datetime DEFAULT NULL,
  `ends` datetime DEFAULT NULL,
  `saved_at` datetime NOT NULL,
  `modified_in` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_task_stask1` (`stask_id`),
  KEY `fk_task_story1` (`story_id`),
  KEY `fk_task_ttask1` (`ttask_id`),
  CONSTRAINT `fk_task_stask1` FOREIGN KEY (`stask_id`) REFERENCES `stask` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_task_story1` FOREIGN KEY (`story_id`) REFERENCES `story` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_task_ttask1` FOREIGN KEY (`ttask_id`) REFERENCES `ttask` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of task
-- ----------------------------

-- ----------------------------
-- Table structure for `tbacklog`
-- ----------------------------
DROP TABLE IF EXISTS `tbacklog`;
CREATE TABLE `tbacklog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sbacklog_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `saved_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbacklog_sbacklog1` (`sbacklog_id`),
  KEY `fk_tbacklog_task1` (`task_id`),
  CONSTRAINT `fk_tbacklog_sbacklog1` FOREIGN KEY (`sbacklog_id`) REFERENCES `sbacklog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbacklog_task1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbacklog
-- ----------------------------

-- ----------------------------
-- Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `saved_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_team_project` (`project_id`),
  KEY `fk_team_role1` (`role_id`),
  KEY `fk_team_users1` (`users_id`),
  CONSTRAINT `fk_team_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_team_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_team_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of team
-- ----------------------------

-- ----------------------------
-- Table structure for `ttask`
-- ----------------------------
DROP TABLE IF EXISTS `ttask`;
CREATE TABLE `ttask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ttask
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `group` varchar(32) DEFAULT NULL,
  `saved_at` datetime NOT NULL,
  `modified_in` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('1', 'root', 'd033e22ae348aeb5660fc2140aec35850c4da997', '_', '_', '_', 'root', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO users VALUES ('2', 'Guest', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '', '', 'guest', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
