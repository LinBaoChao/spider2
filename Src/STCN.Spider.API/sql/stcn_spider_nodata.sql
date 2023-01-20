/*
SQLyog Community
MySQL - 5.6.51-log : Database - stcn_spider
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stcn_spider` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `stcn_spider`;

/*Table structure for table `article_spider` */

DROP TABLE IF EXISTS `article_spider`;

CREATE TABLE `article_spider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(100) DEFAULT NULL COMMENT '来源',
  `pub_source_name` varchar(100) DEFAULT NULL,
  `pub_media_name` varchar(100) DEFAULT NULL,
  `pub_product_name` varchar(100) DEFAULT NULL,
  `pub_platform_name` varchar(50) DEFAULT NULL,
  `pub_channel_name` varchar(100) DEFAULT NULL,
  `source_title` varchar(300) DEFAULT NULL,
  `source_content` blob,
  `source_author` varchar(100) DEFAULT NULL,
  `source_url` varchar(300) DEFAULT NULL,
  `source_pub_time` datetime DEFAULT NULL,
  `source_media_name` varchar(100) DEFAULT NULL COMMENT '媒体',
  `source_product_name` varchar(100) DEFAULT NULL COMMENT '子媒',
  `source_platform_name` varchar(50) DEFAULT NULL COMMENT '平台',
  `source_channel_name` varchar(100) DEFAULT NULL COMMENT '频道栏目',
  `status` int(11) DEFAULT '1',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `article_spider` */

/*Table structure for table `dept` */

DROP TABLE IF EXISTS `dept`;

CREATE TABLE `dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `dept_name` varchar(50) DEFAULT NULL COMMENT '部门名称',
  `desc` varchar(200) DEFAULT NULL COMMENT '介绍',
  `order_no` int(11) DEFAULT NULL COMMENT '排序码',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dept` */

insert  into `dept`(`id`,`parent_id`,`dept_name`,`desc`,`order_no`,`status`,`create_time`,`update_time`) values 
(1,NULL,'时报传媒','时报传媒',1,1,'2022-09-20 11:25:07','2022-11-19 00:03:24'),
(2,1,'技术中心','技术中心',203,1,'2022-09-02 16:56:08','2022-09-02 16:56:08'),
(3,1,'公司中心','公司中心',202,1,'2022-09-20 11:28:02','2022-09-20 11:28:02'),
(4,1,'新闻中心','新闻中心',201,1,'2022-09-20 11:28:31','2022-11-19 00:02:48'),
(15,14,'bbb','',0,1,'2022-10-23 16:47:11','2022-10-23 16:47:11');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级id',
  `menu_code` varchar(50) DEFAULT NULL COMMENT '菜单编码，101开始',
  `menu_name` varchar(50) DEFAULT NULL COMMENT '名称',
  `title` varchar(100) DEFAULT NULL COMMENT '显示名',
  `icon` varchar(300) DEFAULT NULL COMMENT '图标',
  `component` varchar(300) DEFAULT NULL COMMENT '组件及路径',
  `redirect` varchar(300) DEFAULT NULL COMMENT '指向路径',
  `path` varchar(100) DEFAULT NULL COMMENT '菜单链接的页面及路径',
  `param_path` varchar(300) DEFAULT NULL COMMENT '带参数路径',
  `disabled` tinyint(1) DEFAULT '0' COMMENT '不可用',
  `show_menu` tinyint(1) DEFAULT '1' COMMENT '展示',
  `hide_children_in_menu` tinyint(1) DEFAULT '0' COMMENT '隐藏子菜单',
  `current_active_menu` varchar(100) DEFAULT NULL COMMENT '当前活动页路径',
  `ignore_keep_alive` tinyint(1) DEFAULT '1' COMMENT '忽略保持活动状态',
  `type` int(11) DEFAULT NULL COMMENT '类型 1目录 2菜单 3按钮',
  `level` int(11) DEFAULT NULL COMMENT '级别',
  `is_menu` tinyint(1) DEFAULT '1' COMMENT '是否菜单',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `order_no` int(11) DEFAULT NULL COMMENT '排序码',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu` */

insert  into `menu`(`id`,`parent_id`,`menu_code`,`menu_name`,`title`,`icon`,`component`,`redirect`,`path`,`param_path`,`disabled`,`show_menu`,`hide_children_in_menu`,`current_active_menu`,`ignore_keep_alive`,`type`,`level`,`is_menu`,`status`,`order_no`,`create_time`,`update_time`) values 
(1,NULL,'Sys','Sys','系统管理','ion:settings-outline','LAYOUT','/sys/user/index','/sys',NULL,0,1,0,NULL,1,1,1,1,1,33,'2022-09-02 16:50:24','2022-09-02 16:50:24'),
(2,1,'Sys.User','User','用户管理',NULL,'/sys/user/index','','user',NULL,0,1,0,NULL,1,2,2,1,1,101201,'2022-09-02 15:09:14','2022-09-02 15:09:14'),
(3,1,'Sys.Dept','Dept','部门管理',NULL,'/sys/dept/index','','dept',NULL,0,1,0,NULL,1,2,2,1,1,101202,'2022-09-02 16:33:23','2022-09-02 16:33:23'),
(4,1,'Sys.Menu','Menu','功能管理',NULL,'/sys/menu/index',NULL,'menu',NULL,0,1,0,NULL,1,2,2,1,1,101204,'2022-09-06 17:08:57','2022-09-06 17:08:57'),
(5,1,'Sys.Role','Role','角色管理',NULL,'/sys/role/index',NULL,'role',NULL,0,1,0,NULL,1,2,2,1,1,101203,'2022-09-06 17:09:41','2022-09-06 17:09:41'),
(6,NULL,'Dashboard','Dashboard','routes.dashboard.dashboard','bx:bx-home','LAYOUT','/dashboard/analysis','/dashboard',NULL,0,0,0,NULL,1,1,1,1,0,102,'2022-09-09 10:36:57','2022-09-09 10:36:57'),
(7,6,'Dashboard.Analysis','Analysis','routes.dashboard.analysis',NULL,'/dashboard/analysis/index',NULL,'analysis',NULL,0,0,0,NULL,1,2,2,1,0,102201,'2022-09-09 10:40:43','2022-09-09 10:40:43'),
(8,6,'Dashboard.Workbench','Workbench','routes.dashboard.workbench',NULL,'dashboard/workbench/index',NULL,'workbench',NULL,0,0,0,NULL,1,2,2,1,0,102202,'2022-09-09 11:17:09','2022-09-09 11:17:09'),
(9,NULL,'About','About','routes.dashboard.about','simple-icons:about-dot-me','LAYOUT','/about/index','/about',NULL,0,0,0,NULL,1,1,1,1,0,103,'2022-09-09 11:29:42','2022-09-09 11:29:42'),
(10,9,'About.AboutPage','AboutPage','routes.dashboard.about','simple-icons:about-dot-me','/sys/about/index',NULL,'index',NULL,0,0,0,NULL,1,2,2,1,0,103201,'2022-09-09 11:31:56','2022-09-09 11:31:56'),
(11,NULL,'MyWork','MyWork','我的工作台','ion:grid-outline','LAYOUT','/mywork/workbench','/mywork',NULL,0,1,0,NULL,1,1,1,1,1,1,'2022-09-09 10:36:57','2022-09-09 10:36:57'),
(12,11,'MyWork.Workbench','Workbench','工作台',NULL,'mywork/workbench/index',NULL,'workbench',NULL,0,1,0,NULL,1,2,2,1,1,2,'2022-09-09 11:17:09','2022-09-09 11:17:09'),
(13,1,'Sys.User.UserDetail','UserDetail','个人信息',NULL,'/sys/user/UserDetail',NULL,'user_detail',NULL,0,0,0,'/mywork/workbench',1,2,3,1,1,999999999,'2022-09-21 11:06:33','2022-09-21 11:06:33'),
(88,2,'Sys.User.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(89,2,'Sys.User.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(90,2,'Sys.User.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(91,2,'Sys.User.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(92,3,'Sys.Dept.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(93,4,'Sys.Menu.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(94,5,'Sys.Role.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(95,7,'Dashboard.Analysis.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,1,3,3,0,0,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(96,8,'Dashboard.Workbench.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,1,3,3,0,0,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(97,10,'About.AboutPage.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,1,3,3,0,0,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(102,12,'MyWork.Workbench.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(103,13,'Sys.User.UserDetail.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(104,3,'Sys.Dept.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(105,3,'Sys.Dept.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(106,3,'Sys.Dept.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(107,4,'Sys.Menu.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(108,4,'Sys.Menu.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(109,4,'Sys.Menu.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(110,5,'Sys.Role.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(111,5,'Sys.Role.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(112,5,'Sys.Role.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(113,5,'Sys.Role.AssignPermission','AssignPermission','分配权限',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(114,2,'Sys.User.AssignRoles','AssignRoles','分配角色',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(116,13,'Sys.User.UserDetail.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-14 11:11:02','2022-11-14 11:11:02'),
(122,NULL,'Resources','Resources','新闻资源','fluent:news-28-regular','LAYOUT','/resources/spider/index','/resources',NULL,0,1,0,NULL,1,1,1,1,1,11,'2022-11-28 09:29:15','2022-11-28 09:29:15'),
(123,122,'Resources.Spider','Spider','采集资源',NULL,'/resources/spider/index',NULL,'spider',NULL,0,1,0,NULL,1,2,2,1,1,12,'2022-11-28 09:40:39','2022-11-28 09:40:39'),
(124,123,'Resources.Spider.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-28 10:58:03','2022-11-28 10:58:03'),
(125,123,'Resources.Spider.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-11-28 10:58:19','2022-11-28 10:58:19'),
(126,NULL,'BllConfig','BllConfig','业务配置','grommet-icons:document-config','LAYOUT','/bllConfig/website/index','/bllConfig',NULL,0,1,0,NULL,1,1,1,1,1,22,'2022-12-09 14:42:48','2022-12-09 14:42:48'),
(127,126,'BllConfig.Website','Website','网站配置',NULL,'/bllConfig/website/index','','website',NULL,0,1,0,NULL,1,2,2,1,1,23,'2022-12-09 14:45:38','2022-12-09 14:45:38'),
(128,127,'BllConfig.Website.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:30:24','2022-12-09 16:30:24'),
(129,127,'BllConfig.Website.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:30:46','2022-12-09 16:30:46'),
(130,127,'BllConfig.Website.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:31:41','2022-12-09 16:31:41'),
(131,127,'BllConfig.Website.FieldConfig','FieldConfig','字段配置',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 16:32:33','2022-12-09 16:32:33'),
(132,127,'BllConfig.Website.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-09 17:19:35','2022-12-09 17:19:35'),
(133,126,'BllConfig.WebsiteField','WebsiteField','字段规则管理',NULL,'/bllConfig/websiteField/index',NULL,'websiteField/:id/:mediaName',NULL,0,0,0,'/bllConfig/website',1,2,3,1,1,888888,'2022-12-10 12:09:58','2022-12-10 12:09:58'),
(134,133,'BllConfig.WebsiteField.View','View','查看',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:46:37','2022-12-10 12:46:37'),
(135,133,'BllConfig.WebsiteField.Create','Create','新增',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:48:29','2022-12-10 12:48:29'),
(136,133,'BllConfig.WebsiteField.Update','Update','修改',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:48:56','2022-12-10 12:48:56'),
(137,133,'BllConfig.WebsiteField.Delete','Delete','删除',NULL,NULL,NULL,NULL,NULL,0,1,0,NULL,1,3,3,0,1,NULL,'2022-12-10 12:49:39','2022-12-10 12:49:39');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL COMMENT '名称',
  `desc` varchar(200) DEFAULT NULL COMMENT '介绍',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `order_no` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role` */

insert  into `role`(`id`,`role_name`,`desc`,`status`,`order_no`,`create_time`,`update_time`) values 
(1,'管理员','维护人员',1,1,'2022-09-02 16:57:43','2022-10-22 16:46:39'),
(2,'测试','测试人员',1,2,'2022-09-02 16:57:43','2022-10-22 16:47:08'),
(15,'记者','新闻记者',1,3,'2022-10-22 16:45:48','2022-10-22 16:47:33');

/*Table structure for table `role_menu` */

DROP TABLE IF EXISTS `role_menu`;

CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `menu_id` int(11) DEFAULT NULL COMMENT '权限id',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1189 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role_menu` */

insert  into `role_menu`(`id`,`role_id`,`menu_id`,`create_time`,`update_time`) values 
(1144,1,88,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1145,1,2,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1146,1,1,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1147,1,89,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1148,1,90,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1149,1,91,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1150,1,114,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1151,1,3,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1152,1,92,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1153,1,104,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1154,1,105,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1155,1,106,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1156,1,5,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1157,1,94,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1158,1,110,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1159,1,111,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1160,1,112,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1161,1,113,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1162,1,4,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1163,1,93,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1164,1,107,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1165,1,108,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1166,1,109,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1167,1,13,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1168,1,103,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1169,1,116,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1170,1,102,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1171,1,12,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1172,1,11,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1173,1,122,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1174,1,123,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1175,1,124,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1176,1,125,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1177,1,128,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1178,1,127,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1179,1,129,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1180,1,130,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1181,1,131,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1182,1,132,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1183,1,133,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1184,1,134,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1185,1,135,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1186,1,136,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1187,1,137,'2022-12-10 12:54:43','2022-12-10 12:54:43'),
(1188,1,126,'2022-12-10 12:54:43','2022-12-10 12:54:43');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_code` varchar(50) DEFAULT NULL COMMENT '工号',
  `username` varchar(50) DEFAULT NULL COMMENT '登录名',
  `real_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `nickname` varchar(50) DEFAULT NULL COMMENT '别名/笔名',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `salt` varchar(50) DEFAULT NULL COMMENT '随时盐加密码用',
  `gender` varchar(4) DEFAULT NULL COMMENT '性别',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像url',
  `birthday` datetime DEFAULT NULL COMMENT '生日',
  `desc` varchar(200) DEFAULT NULL COMMENT '介绍',
  `wechat_id` varchar(50) DEFAULT NULL COMMENT '微信号',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(50) DEFAULT NULL COMMENT '电话',
  `job` varchar(50) DEFAULT NULL COMMENT '职务',
  `order_no` int(11) DEFAULT NULL COMMENT '排序码',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `login_time` datetime DEFAULT NULL COMMENT '登录时间',
  `effective_time` datetime DEFAULT NULL COMMENT '有效日期',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_code` (`user_code`),
  KEY `idx_user_create_time` (`create_time`),
  KEY `idx_user_name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`user_code`,`username`,`real_name`,`nickname`,`password`,`salt`,`gender`,`avatar`,`birthday`,`desc`,`wechat_id`,`email`,`mobile`,`job`,`order_no`,`status`,`login_time`,`effective_time`,`create_time`,`update_time`) values 
(1,'1001','admin','超级管理员','超管','f92f247c7719f46ef7e24c88d1d537eb','123','男','user-avatar/logo.png','2022-08-25 16:39:30','这是个介绍','abc','admin@stcn.com','13813813888','IT',1,1,'2023-01-20 02:24:24','2042-10-19 00:00:00','2022-08-23 16:39:30','2023-01-20 14:24:24');

/*Table structure for table `user_dept` */

DROP TABLE IF EXISTS `user_dept`;

CREATE TABLE `user_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `dept_id` int(11) DEFAULT NULL COMMENT '部门id',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_dept` */

insert  into `user_dept`(`id`,`user_id`,`dept_id`,`create_time`,`update_time`) values 
(37,1,2,'2022-11-28 13:08:15','2022-11-28 13:08:15');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`user_id`,`role_id`,`create_time`,`update_time`) values 
(36,1,1,'2022-11-28 13:08:15','2022-11-28 13:08:15');

/*Table structure for table `website` */

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `media_name` varchar(50) DEFAULT NULL COMMENT '媒体名称，如证券时报',
  `product_name` varchar(50) DEFAULT NULL COMMENT '媒体下的某产品名称，如e公司',
  `platform` varchar(50) DEFAULT NULL COMMENT '平台，如网站、app、微信、微博',
  `channel` varchar(50) DEFAULT NULL COMMENT '栏目/频道',
  `name` varchar(50) DEFAULT NULL COMMENT '英文名，采集程序使用',
  `domains` varchar(200) DEFAULT NULL COMMENT '多个用【分割 爬虫爬取哪些域名下的网页, 非域名下的url会被忽略以提高爬取速度',
  `scan_urls` varchar(200) DEFAULT NULL COMMENT '多个用【分割 爬虫的入口链接',
  `list_urls` varchar(500) DEFAULT NULL COMMENT '多个用【分割 列表页url的规则',
  `content_urls` varchar(500) DEFAULT NULL COMMENT '多个用【分割 内容页url的规则',
  `input_encoding` varchar(50) DEFAULT NULL COMMENT '输入编码，UTF-8,GB2312,…..',
  `output_encoding` varchar(50) DEFAULT NULL COMMENT '输出编码，UTF-8,GB2312,…..',
  `tasknum` int(11) DEFAULT NULL COMMENT '同时工作的爬虫任务数',
  `multiserver` tinyint(1) DEFAULT NULL COMMENT '多服务器处理',
  `serverid` int(11) DEFAULT NULL COMMENT '第几台服务器id',
  `save_running_state` tinyint(1) DEFAULT NULL COMMENT '保存爬虫运行状态',
  `interval` int(11) DEFAULT NULL COMMENT '单位：毫秒，爬虫爬取每个网页的时间间隔',
  `timeout` int(11) DEFAULT NULL COMMENT '单位：秒，爬虫爬取每个网页的超时时间',
  `max_try` int(11) DEFAULT NULL COMMENT '默认值为0，即不重复爬取，爬虫爬取每个网页失败后尝试次数',
  `max_depth` int(11) DEFAULT NULL COMMENT '默认值为0，即不限制，爬虫爬取网页深度，超过深度的页面不再采集',
  `max_fields` int(11) DEFAULT NULL COMMENT '默认值为0，即不限制，爬虫爬取内容网页最大条数',
  `user_agent` varchar(300) DEFAULT NULL COMMENT '多个用【分割 爬虫爬取网页所使用的浏览器类型,AGENT_ANDROID, 表示爬虫爬取网页时, 使用安卓手机浏览器',
  `client_ip` varchar(100) DEFAULT NULL COMMENT '多个用【分割 爬虫爬取网页所使用的伪IP，用于破解防采集 ''192.168.0.2'',',
  `proxy` varchar(100) DEFAULT NULL COMMENT '多个用【分割 代理服务器，如果爬取的网站根据IP做了反爬虫, 可以设置此项，如http://host:port http://user:pass@host:port',
  `callback_method` varchar(300) DEFAULT NULL COMMENT '多个用【分割 目前支持回调函数有on_start、on_extract_field、on_extract_page、on_scan_page、on_list_page、on_content_page、on_handle_img、on_download_page、on_download_attached_page、on_fetch_url、on_status_code、is_anti_spider、on_attachment_file',
  `callback_script` text COMMENT '要和回调函数配对，函数命名：函数名+_+媒体标识，如on_start_stcn，此脚本的每一个函数是一个php功能及业务逻辑完整的函数',
  `status` int(11) DEFAULT '1' COMMENT '0禁用 1启用 2出错',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

/*Data for the table `website` */

insert  into `website`(`id`,`parent_id`,`media_name`,`product_name`,`platform`,`channel`,`name`,`domains`,`scan_urls`,`list_urls`,`content_urls`,`input_encoding`,`output_encoding`,`tasknum`,`multiserver`,`serverid`,`save_running_state`,`interval`,`timeout`,`max_try`,`max_depth`,`max_fields`,`user_agent`,`client_ip`,`proxy`,`callback_method`,`callback_script`,`status`,`create_time`,`update_time`) values 
(10,NULL,'证券时报','证券时报网','网站','要闻','stcn','stcn.com【www.stcn.com','http://www.stcn.com/','http://www.stcn.com/article/list/yw.html【http://www.stcn.com/article/list/kx.html【http://www.stcn.com/article/list/company.html【http://www.stcn.com/article/list/gsxw.html','http://www.stcn.com/article/detail/\\d+.html',NULL,NULL,3,1,1,1,1,5,5,0,0,NULL,NULL,NULL,'on_start【on_extract_field','function on_start_stcn($spider)\n{\n    //log::add(\"on_start_stcn\",\"script\");\n    // 把列表页重新加入增量更新抓取，这样不会排重url\n    foreach ($spider::$configs[\'list_url_regexes\'] as $url) {\n        $spider->add_scan_url($url);\n    }\n}\n\nfunction on_extract_field_stcn($fieldname, $data, $page)\n{\n    //log::add(\"on_extract_field_stcn\".$data,\"script\");\n\n    if ($fieldname == \'source_author\') {\n        $data = str_replace(\"作者：\", \"\", $data);\n    } elseif ($fieldname == \'source_name\') {\n        $data = str_replace(\"来源：\", \"\", $data);\n    } elseif ($fieldname == \'source_content\') {\n        $data = selector::remove($data, \"//div[contains(@class,\'social-bar\')]\");\n    }\n\n    return $data;\n}',0,'2022-12-10 23:53:02','2023-01-12 17:16:38'),
(11,NULL,'上海证券报','中国证券网','网站','要闻','cnstock','news.cnstock.com【www.news.cnstock.com','https://news.cnstock.com/','https://news.cnstock.com/【https://news.cnstock.com/news/sns_jg/index.html','https://news.cnstock.com/\\S+-\\d+-\\d+.htm',NULL,NULL,3,1,1,1,1,5,5,0,0,'','','','on_start【on_extract_field','function on_start_cnstock($spider)\n{\n    // log::add(\"on_start_cnstock\",\"script\");\n    // 把列表页重新加入增量更新抓取，这样不会排重url\n    foreach ($spider::$configs[\'list_url_regexes\'] as $url) {\n        $spider->add_scan_url($url);\n    }\n}\n\nfunction on_extract_field_cnstock($fieldname, $data, $page)\n{\n    // log::add(\"on_extract_field_cnstock\".$data,\"script\");\n\n    if ($fieldname == \'source_author\') {\n        $data = str_replace(\"作者：\", \"\", $data);\n    } elseif ($fieldname == \'source_name\') {\n        $data = str_replace(\"来源：\", \"\", $data);\n    }\n\n    return $data;\n}',0,'2022-12-11 00:46:22','2023-01-12 17:16:42'),
(12,NULL,'新京报','新京报网','网站','财经 时事  政事儿 国际','bjnews','bjnews.com.cn【www.bjnews.com.cn','https://www.bjnews.com.cn/news/【https://www.bjnews.com.cn/financial/【https://www.bjnews.com.cn/zhengshi/【https://www.bjnews.com.cn/guoji/','https://www.bjnews.com.cn/news/【https://www.bjnews.com.cn/financial/【https://www.bjnews.com.cn/zhengshi/【https://www.bjnews.com.cn/guoji/','https://www.bjnews.com.cn/detail/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,10000,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2022-12-19 15:53:08','2023-01-16 10:52:14'),
(13,NULL,'北京日报','北京日报网','网站','新闻 财经','bjdcom','www.bjd.com.cn【bjd.com.cn','https://www.bjd.com.cn/jbw/news/【https://www.bjd.com.cn/jbw/finance/','https://www.bjd.com.cn/jbw/news/【https://www.bjd.com.cn/jbw/finance/','https://news.bjd.com.cn//\\d+/\\d+/\\d+/\\d+.shtml',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2022-12-22 10:56:52','2023-01-05 17:42:09'),
(14,NULL,'北青网','北青网','网站','新闻 财经 金融','ynet','www.ynet.com【ynet.com【finance.ynet.com【news.ynet.com【financial.ynet.com','http://news.ynet.com/【http://finance.ynet.com/index.html【http://financial.ynet.com/','http://news.ynet.com/【http://finance.ynet.com/index.html【http://financial.ynet.com/','http://news.ynet.com/\\d+/\\d+/\\d+/\\d+t\\d+.html【http://finance.ynet.com/\\d+/\\d+/\\d+/\\d+t\\d+.html【http://financial.ynet.com/\\d+/\\d+/\\d+/\\d+t\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2022-12-22 11:22:49','2023-01-05 17:42:04'),
(15,NULL,'北京商报','北京商报','网站','国际 政经 基金','bbtnews','bbtnews.com.cn【www.bbtnews.com.cn','https://www.bbtnews.com.cn/chuizhipd/yaowenzx/guojipd/【https://www.bbtnews.com.cn/chuizhipd/yaowenzx/zhengjingpd/【https://www.bbtnews.com.cn/chuizhipd/caijingxinwenzx/jijinjigoupd/','https://www.bbtnews.com.cn/chuizhipd/yaowenzx/guojipd/【https://www.bbtnews.com.cn/chuizhipd/yaowenzx/zhengjingpd/【https://www.bbtnews.com.cn/chuizhipd/caijingxinwenzx/jijinjigoupd/','https://www.bbtnews.com.cn/\\d+/\\d+/\\d+.shtml',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-03 10:48:07','2023-01-05 17:42:00'),
(16,NULL,'长城网','长城网','网站','新闻资讯','thegreatwall','www.thegreatwall.cn【thegreatwall.cn','http://www.thegreatwall.cn/xinwen/','http://www.thegreatwall.cn/xinwen/','http://www.thegreatwall.cn/xinwen/\\d+/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-03 11:14:21','2023-01-04 19:40:14'),
(17,NULL,'河工新闻网','河工新闻网','网站','国内 国际 产经','hbgrb','www.hbgrb.net【hbgrb.net','http://www.hbgrb.net/gn/【http://www.hbgrb.net/gj/【http://www.hbgrb.net/cj/','http://www.hbgrb.net/gn/【http://www.hbgrb.net/gj/【http://www.hbgrb.net/cj/','http://www.hbgrb.net/gn/\\d+/t\\d+_\\d+.html【http://www.hbgrb.net/gj/\\d+/t\\d+_\\d+.html【http://www.hbgrb.net/cj/\\d+/t\\d+_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-03 14:57:15','2023-01-04 19:40:09'),
(19,NULL,'石家庄新闻网','石家庄新闻网','网站','新闻 财经','sjzdaily1','sjzdaily.com.cn【www.sjzdaily.com.cn【news.sjzdaily.com.cn','http://news.sjzdaily.com.cn/','http://news.sjzdaily.com.cn/','http://news.sjzdaily.com.cn/\\d+/\\d+/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-05 18:22:39','2023-01-09 14:23:24'),
(20,NULL,'秦皇岛新闻网','秦皇岛新闻网','网站','国内要闻 本地要闻 头条新闻 财经新闻','qhdnews','www.qhdnews.com【qhdnews.com','http://www.qhdnews.com/','http://www.qhdnews.com/home/list?code=NA%ce%b3%ce%b3&pcode=MA%ce%b3%ce%b3【http://www.qhdnews.com/home/list?code=MTUw&pcode=MA%ce%b3%ce%b3【http://www.qhdnews.com/home/list?code=MjA0&pcode=MA%ce%b3%ce%b3【http://www.qhdnews.com/home/list?code=MTkz&pcode=MA%ce%b3%ce%b3','http://www.qhdnews.com/home/details?code=MTUw&pcode=MA%ce%b3%ce%b3&id=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-09 15:17:44','2023-01-11 16:59:01'),
(21,NULL,'今日渤海网','今日渤海网','网站','国内新闻','bohaitoday','www.bohaitoday.cn【bohaitoday.cn','http://www.bohaitoday.cn','http://www.bohaitoday.cn/h-nr-j-4_12.html\\#_np=172_0','http://www.bohaitoday.cn/h-nd-\\d+.html\\#_jcp=4_12',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-09 16:16:04','2023-01-09 17:36:45'),
(22,NULL,'沧州广电网','沧州广电网','网站','新闻中心','czgdtv','www.czgd.tv','http://www.czgd.tv/Article/lists?colid=190','http://www.czgd.tv/Article/lists?colid=190','http://www.czgd.tv/Article/des?infoid=\\d+&modelid=2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-09 19:48:22','2023-01-09 19:48:22'),
(24,NULL,'沧州新闻网','沧州新闻网','网站','时政要闻 财经传真','cznews','www.cznews.gov.cn','https://www.cznews.gov.cn/newweb/news/','https://www.cznews.gov.cn/newweb/news/shizheng/【https://www.cznews.gov.cn/newweb/news/caijing/','https://www.cznews.gov.cn/newweb/news/shizheng/\\d+-\\d+-\\d+/\\d+.html【https://www.cznews.gov.cn/newweb/news/caijing/\\d+-\\d+-\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-10 09:52:48','2023-01-10 16:58:41'),
(25,NULL,'环渤海新闻网','环渤海新闻网','网站','时政要闻','huanbohainews','www.huanbohainews.com.cn【tangshan.huanbohainews.com.cn','https://tangshan.huanbohainews.com.cn/node_208.html','https://tangshan.huanbohainews.com.cn/node_208.html','https://tangshan.huanbohainews.com.cn/\\d+-\\d+/\\d+/content_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-10 14:12:20','2023-01-10 14:37:49'),
(26,NULL,'张家口新闻网','张家口新闻网','网站','时政 新闻中心','zjknews','www.zjknews.com','http://www.zjknews.com/news/','http://www.zjknews.com/news/\nhttp://www.zjknews.com/news/shizheng/','http://www.zjknews.com/news/shizheng/\\d+/\\d+/\\d+.html【http://www.zjknews.com/news/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-10 17:50:35','2023-01-10 19:32:26'),
(27,NULL,'承德新闻网','承德新闻网','网站','新闻 财经','chengdechina','www.chengdechina.com','https://www.chengdechina.com/news.html【https://www.chengdechina.com/finance.html','https://www.chengdechina.com/news.html【https://www.chengdechina.com/finance.html','https://www.chengdechina.com/detail.html?id=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-11 17:05:37','2023-01-11 17:05:37'),
(28,NULL,'廊坊传媒网','廊坊传媒网','网站','时政新闻','lfcmwcom','www.lfcmw.com','http://www.lfcmw.com/szxw/','http://www.lfcmw.com/szxw/','http://www.lfcmw.com/szxw/content/\\d+-\\d+/\\d+/content_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 14:59:28','2023-01-12 15:39:58'),
(29,NULL,'太行新闻网','太行新闻网','网站','省内新闻 国内新闻 国际新闻','thxwwgov','www.thxww.gov.cn','http://www.thxww.gov.cn/thxw/','http://www.thxww.gov.cn/shengnei/【http://www.thxww.gov.cn/guonei/【http://www.thxww.gov.cn/gjnews/','http://www.thxww.gov.cn/shengnei/\\d+.html【http://www.thxww.gov.cn/guonei/\\d+.html【http://www.thxww.gov.cn/gjnews/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 16:41:23','2023-01-12 17:01:54'),
(30,NULL,'河北日报','河北日报','网站','时政 经济','hebnews','hbxw.hebnews.cn','https://hbxw.hebnews.cn/','https://hbxw.hebnews.cn/?id=62f4be6c3f35af3ada2d1d04【https://hbxw.hebnews.cn/?id=62f4be713f35af3ada2d1d05','https://hbxw.hebnews.cn/news.html?id=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 17:05:33','2023-01-12 17:33:52'),
(31,NULL,'河北青年报','河北青年报','网站','河北新闻 财经','hbynetnet','www.hbynet.net','https://www.hbynet.net/html/heqing/index.html','https://www.hbynet.net/html/heqing/daohang/caijing/index.html【https://www.hbynet.net/html/heqing/daohang/hebeixinwen/index.html','https://www.hbynet.net/html/heqing/daohang/hebeixinwen/\\d+.html【https://www.hbynet.net/html/heqing/daohang/caijing/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-12 18:02:50','2023-01-12 18:25:03'),
(32,NULL,'山西新闻网','山西新闻网','网站','山西新闻 太原新闻 国内新闻 国际新闻 社会新闻','newssxrb','news.sxrb.com','http://news.sxrb.com/GB/index.html','http://news.sxrb.com/GB/314066/index.html【http://news.sxrb.com/GB/314061/index.html【http://news.sxrb.com/GB/314060/index.html【http://news.sxrb.com/GB/314064/index.html【http://news.sxrb.com/GB/314065/index.html','http://news.sxrb.com/GB/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'on_extract_field','function on_extract_field_newssxrb($fieldname, $data, $page)\n{\n    if ($fieldname == \'source_pub_time\') {\n       // log::add(\"on_extract_field_newssxrb.\" . $fieldname . \":\" . $data, \"script\");\n\n        $data = str_replace(\"年\", \"-\", $data);\n        $data = str_replace(\"月\", \"-\", $data);\n        $data = str_replace(\"日\", \" \", $data);\n        // log::add(\"on_extract_field_newssxrb.\" . $fieldname . \" change:\" . $data, \"script\");\n        if (strtotime($data) === false) {\n            // log::add(\"日期不正确：{$data}\\r\\n\", \'pubtime\');\n            return false;\n        }\n    }\n\n    return $data;\n}',1,'2023-01-13 11:07:10','2023-01-17 14:09:11'),
(33,NULL,'山西晚报网','山西晚报网','网站','时事 财经','sxwbscom','www.sxwbs.com','https://www.sxwbs.com/#/generalColumns/ModilarId=121003【https://www.sxwbs.com/#/generalColumns/ModilarId=120999','https://www.sxwbs.com/#/generalColumns/ModilarId=121003【https://www.sxwbs.com/#/generalColumns/ModilarId=120999','https://www.sxwbs.com/#/detailsPage?appId=\\d+&id=\\d+&ModilarId=\\d+',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-16 18:32:43','2023-01-16 18:32:43'),
(34,NULL,'太原新闻网','太原新闻网','网站','经济新闻 今日聚焦 山西新闻 太原新闻','tynewscom','www.tynews.com.cn','http://www.tynews.com.cn/','http://www.tynews.com.cn/jjxw/【http://www.tynews.com.cn/jrjj/【http://www.tynews.com.cn/sxxw/【http://www.tynews.com.cn/taiyuan/','http://www.tynews.com.cn/system/\\d|/\\d+/\\d+/\\d+.shtml',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'on_extract_field','function on_extract_field_tynewscom($fieldname, $data, $page)\n{\n    if ($fieldname == \'source_pub_time\') {\n       // log::add(\"on_extract_field_newssxrb.\" . $fieldname . \":\" . $data, \"script\");\n\n        $data = str_replace(\"年\", \"-\", $data);\n        $data = str_replace(\"月\", \"-\", $data);\n        $data = str_replace(\"日\", \" \", $data);\n        // log::add(\"on_extract_field_newssxrb.\" . $fieldname . \" change:\" . $data, \"script\");\n        if (strtotime($data) === false) {\n            // log::add(\"日期不正确：{$data}\\r\\n\", \'pubtime\');\n            return false;\n        }\n    }\n\n    return $data;\n}',1,'2023-01-17 10:06:57','2023-01-17 14:10:55'),
(35,NULL,'大同新闻网','大同新闻网','网站','今日头条 理财','dtnewscn','www.dtnews.cn','http://www.dtnews.cn/toutiao/【http://www.dtnews.cn/licai/','http://www.dtnews.cn/toutiao/【http://www.dtnews.cn/licai/','http://www.dtnews.cn/todayhot\\d+/\\d+/\\d+.html【http://www.dtnews.cn/lcnr/\\d+/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'2023-01-17 14:56:15','2023-01-17 14:56:15'),
(36,NULL,'长治新闻网','长治新闻网','网站','长治要闻','changzhinews','www.changzhinews.com','http://www.changzhinews.com/changzhi/jinritoutiao/','http://www.changzhinews.com/changzhi/jinritoutiao/','http://www.changzhinews.com/changzhi/jinritoutiao/\\d+-\\d+-\\d+/\\d+.html【http://www.changzhinews.com/changzhi/jinritoutiao/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-17 15:06:53','2023-01-18 10:55:17'),
(37,NULL,'晋城新闻网','晋城新闻网','网站','财经 山西新闻  社会新闻 晋城新闻 国内新闻','jcnewscom','www.jcnews.com.cn','http://www.jcnews.com.cn/【http://www.jcnews.com.cn/xw/','http://www.jcnews.com.cn/【http://www.jcnews.com.cn/lm/cj/【http://www.jcnews.com.cn/xw/gnxw/【http://www.jcnews.com.cn/xw/jcxw/【http://www.jcnews.com.cn/xw/shxw/【http://www.jcnews.com.cn/xw/sxxw/','http://www.jcnews.com.cn/lm/cj/\\d+/t\\d+_\\d+.html【http://www.jcnews.com.cn/xw/sxxw/\\d+/t\\d+_\\d+.html【http://www.jcnews.com.cn/xw/shxw/\\d+/t\\d+_\\d+.html【http://www.jcnews.com.cn/xw/gnxw/\\d+/t\\d+_\\d+.html【http://www.jcnews.com.cn/xw/jcxw/\\d+/t\\d+_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-18 14:36:59','2023-01-19 11:18:23'),
(38,NULL,'运城新闻网','运城新闻网','网站','焦点新闻 要闻 经济 国内  国际','sxycrbcom','www.sxycrb.com','http://www.sxycrb.com/','http://www.sxycrb.com/node_8.html【http://www.sxycrb.com/node_5.html【http://www.sxycrb.com/node_7.html【http://www.sxycrb.com/node_30.html【http://www.sxycrb.com/node_31.html','http://www.sxycrb.com/\\d+-\\d+/\\d+/content_\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-19 14:32:32','2023-01-19 15:19:13'),
(39,NULL,'临汾新闻网','临汾新闻网','网站','时政要闻','lfxwwcom','www.lfxww.com','http://www.lfxww.com/linfen/shizheng/','http://www.lfxww.com/linfen/shizheng/','http://www.lfxww.com/linfen/shizheng/\\d+.html',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2023-01-20 14:26:21','2023-01-20 15:16:10');

/*Table structure for table `website_field` */

DROP TABLE IF EXISTS `website_field`;

CREATE TABLE `website_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL COMMENT '网站id',
  `name` varchar(50) DEFAULT NULL COMMENT '要与入库时表的字段对应',
  `selector` varchar(200) DEFAULT NULL COMMENT '定义抽取规则, 默多个用【分割'', "默认使用xpath,如//div[contains(@class,''content'')]',
  `selector_type` varchar(50) DEFAULT 'xpath' COMMENT '多个用【分割，顺序与抽取规则对应，默认xpath，目前可用有xpath, css, regex, self',
  `required` tinyint(1) DEFAULT '0' COMMENT '定义该field的值是否必须, 默认false，true的话, 如果该field没有抽取到内容, 该field对应的整条数据都将被丢弃',
  `repeated` tinyint(1) DEFAULT '0' COMMENT '定义该field抽取到的内容是否是有多项, 默认false,赋值为true的话, 无论该field是否真的是有多项, 抽取到的结果都是数组结构，''selector'' => "//*[@id=''zh-single-question-page'']//a[contains(@class,''zm-item-tag'')]",',
  `source_type` varchar(50) DEFAULT NULL COMMENT '该field的数据源, 默认从当前的网页中抽取数据,选择attached_url可以发起一个新的请求, 然后从请求返回的数据中抽取,选择url_context可以从当前网页的url附加数据',
  `attached_url` varchar(200) DEFAULT NULL COMMENT '当source_type设置为attached_url时, 定义新请求的url',
  `is_write_db` tinyint(1) DEFAULT '1' COMMENT '是否入库',
  `join_field` varchar(200) DEFAULT NULL COMMENT '合并字段,用什么符号分割就用什么符号连接内容',
  `join_field_split` varchar(100) DEFAULT NULL COMMENT '合并字段分割符，如果值直接连接不用分割则是|no|空格用|space|',
  `filter` varchar(300) DEFAULT NULL COMMENT '多个用【分割'', ''输入符合过滤类型的过滤规则或过滤内容，并选择对应的过滤类型',
  `filter_type` varchar(100) DEFAULT NULL COMMENT '多个用【分割，顺序要和过滤项相对应，目前可用有replace, xpath, regex, css, self',
  `status` int(11) DEFAULT '1' COMMENT '0禁用 1启用 2出错',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=166 DEFAULT CHARSET=utf8mb4;

/*Data for the table `website_field` */

insert  into `website_field`(`id`,`parent_id`,`website_id`,`name`,`selector`,`selector_type`,`required`,`repeated`,`source_type`,`attached_url`,`is_write_db`,`join_field`,`join_field_split`,`filter`,`filter_type`,`status`,`create_time`,`update_time`) values 
(11,NULL,10,'source_title','//div[contains(@class,\'detail-title\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:04:02','2022-12-18 16:28:40'),
(12,NULL,10,'source_author','//div[contains(@class,\'detail-info\')]//span[2]','xpath',0,0,NULL,NULL,1,'','','作者：','replace',1,'2022-12-11 00:14:20','2022-12-19 14:36:13'),
(13,NULL,10,'source_name','//div[contains(@class,\'detail-info\')]//span[1]','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2022-12-11 00:15:40','2022-12-18 15:14:57'),
(14,NULL,10,'source_pub_time','//div[contains(@class,\'detail-info\')]//span[last()]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:17:15','2023-01-05 09:42:15'),
(15,NULL,10,'source_content','//div[@class=\'detail-content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'//div[contains(@class,\'social-bar\')]','xpath',1,'2022-12-11 00:21:00','2023-01-04 11:34:00'),
(19,NULL,11,'source_title','//h1[@class=\'title\']','xpath',1,0,NULL,NULL,1,'','',NULL,NULL,1,'2022-12-11 00:47:12','2023-01-04 17:09:08'),
(20,NULL,11,'source_author','//span[contains(@class,\'author\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,'作者：','replace',1,'2022-12-11 00:47:34','2023-01-04 17:09:46'),
(21,NULL,11,'source_name','//span[contains(@class,\'source\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2022-12-11 00:48:14','2023-01-04 17:11:03'),
(22,NULL,11,'source_pub_time','//span[contains(@class,\'timer\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:49:34','2023-01-04 17:11:28'),
(23,NULL,11,'source_content','//div[contains(@class,\'content\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-11 00:50:04','2023-01-04 17:12:53'),
(26,NULL,12,'source_title','//div[@class=\'bodyTitle\']//div[@class=\'content\']//h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 15:58:45','2023-01-11 13:00:34'),
(27,NULL,12,'source_content','//div[contains(@class,\'articleCenter\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 15:59:04','2022-12-19 15:59:04'),
(28,NULL,12,'source_name','','self',0,0,NULL,NULL,1,'pub_source_name','|no|',NULL,NULL,1,'2022-12-19 15:59:27','2022-12-19 16:49:09'),
(29,NULL,12,'source_author','//span[contains(@class,\'reporter\')]//em','xpath',0,0,NULL,NULL,1,NULL,NULL,'记者：【编辑：【原作者：','replace【replace【replace',1,'2022-12-19 15:59:48','2023-01-05 17:36:05'),
(30,NULL,12,'source_pub_time','//span[contains(@class,\'timer\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 16:00:07','2023-01-03 16:48:56'),
(31,NULL,12,'pub_channel_name','//i[contains(@class,\'twoTit\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-19 16:00:27','2023-01-10 09:41:18'),
(32,NULL,13,'pub_channel_name','//p[contains(@class,\'mianbaoxie\')]//a[2]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:02:48','2023-01-11 14:28:02'),
(33,NULL,13,'source_name','//div[contains(@class,\'bjd-article-source\')]//p//a','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:05:24','2022-12-22 11:05:24'),
(34,NULL,13,'source_title','//div[contains(@class,\'bjd-article-title\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:07:28','2022-12-22 11:07:28'),
(35,NULL,13,'source_content','//div[contains(@class,\'bjd-article-centent\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:07:58','2022-12-22 11:07:58'),
(36,NULL,13,'source_pub_time','//p[contains(@style,\'float: right;margin-right: 0;\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:12:55','2023-01-03 16:57:16'),
(37,NULL,14,'source_title','//div[contains(@class,\'articleTitle\')]//h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:24:50','2022-12-22 14:54:43'),
(38,NULL,14,'source_content','//div[@id=\'articleAll\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:32:06','2022-12-22 11:32:06'),
(39,NULL,14,'source_name','//span[contains(@class,\'sourceMsg\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2022-12-22 11:35:15','2022-12-22 11:35:15'),
(40,NULL,14,'source_author','//span[contains(@class,\'authorMsg\')]','xpath',0,0,NULL,NULL,1,'source_author|space|editor','|space|','见习记者','replace',1,'2022-12-22 11:36:20','2023-01-06 18:30:18'),
(41,NULL,14,'yearMsg','//span[@class=\'yearMsg\']//text()','xpath',1,0,NULL,NULL,0,'','',NULL,NULL,1,'2022-12-22 11:38:33','2023-01-05 17:38:57'),
(42,NULL,14,'pub_channel_name','//dl[contains(@class,\'cfix fLeft\')]//dd//a[2]','xpath',1,0,NULL,NULL,1,'','',NULL,NULL,1,'2022-12-22 11:40:46','2023-01-11 14:27:44'),
(43,NULL,14,'timeMsg','//span[@class=\'timeMsg\']//text()','xpath',1,0,NULL,NULL,0,NULL,NULL,NULL,NULL,1,'2022-12-22 11:43:49','2023-01-05 17:39:30'),
(44,NULL,14,'source_pub_time','','self',0,0,NULL,NULL,1,'yearMsg|space|timeMsg','|space|',NULL,NULL,1,'2022-12-22 11:45:04','2023-01-03 13:08:49'),
(45,NULL,15,'source_title','//div[contains(@class,\'article-hd\')]//h3','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 10:55:42','2023-01-03 13:10:54'),
(46,NULL,15,'source_content','//div[@id=\'pageContent\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 10:59:51','2023-01-03 10:59:51'),
(47,NULL,15,'source_pub_time','//div[contains(@class,\'info\')]//span[last()]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:04:57','2023-01-03 17:20:34'),
(48,NULL,15,'source_author','//div[contains(@class,\'info\')]//span[2]','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:05:49','2023-01-03 11:05:49'),
(49,NULL,15,'source_name','//div[contains(@class,\'info\')]//span[1]','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:06:22','2023-01-03 11:06:22'),
(50,NULL,15,'pub_channel_name','//div[contains(@class,\'bread\')]//a[2]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:07:30','2023-01-11 14:27:25'),
(51,NULL,16,'source_title','//div[contains(@class,\'content\')]//h2//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:17:13','2023-01-16 09:58:36'),
(52,NULL,16,'source_content','//div[contains(@class,\'article bb_gray\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:17:44','2023-01-03 17:26:40'),
(53,NULL,16,'source_pub_time','//div[contains(@class,\'after_title mb25\')]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:22:12','2023-01-03 13:03:36'),
(54,NULL,16,'pub_channel_name','//div[contains(@class,\'bread_nav clearfix mb20\')]//a[2]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 11:25:06','2023-01-11 14:27:07'),
(55,NULL,17,'source_title','//div[contains(@class,\'contentbox\')]//h1//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 14:58:48','2023-01-05 15:17:51'),
(56,NULL,17,'source_content','//div[contains(@class,\'TRS_Editor\')]','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-03 15:00:16','2023-01-03 15:00:16'),
(57,NULL,17,'source_pub_time','//div[contains(@class,\'datefrom\')]//p//span[1]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'发布时间：','replace',1,'2023-01-03 15:03:20','2023-01-03 15:03:20'),
(58,NULL,17,'source_name','//div[contains(@class,\'datefrom\')]//p//span[2]','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-03 15:04:38','2023-01-03 15:04:38'),
(59,NULL,17,'source_author','//div[contains(@class,\'news_info\')]','xpath',0,0,NULL,NULL,1,NULL,NULL,'',NULL,1,'2023-01-03 15:05:47','2023-01-03 15:05:47'),
(60,NULL,17,'pub_channel_name','//div[contains(@class,\'CurrentLocation\')]//p//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'',NULL,1,'2023-01-03 15:07:35','2023-01-11 14:26:48'),
(61,NULL,10,'pub_channel_name','//div[contains(@class,\'breadcrumb\')]//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-04 11:01:58','2023-01-11 14:28:36'),
(62,NULL,11,'pub_channel_name','//div[contains(@class,\'container\')]//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-04 17:14:29','2023-01-11 14:28:51'),
(73,70,17,'tge','d【ee','xpath【css',0,0,NULL,NULL,1,NULL,NULL,'作者：【编辑：','replace【xpath',1,'2023-01-05 15:42:05','2023-01-05 15:48:02'),
(74,66,17,'tge','d【ee','xpath【css',0,0,NULL,NULL,1,NULL,NULL,'作者：【编辑：','replace【xpath',1,'2023-01-05 15:42:20','2023-01-05 15:42:20'),
(75,68,17,'tge','d【ee','xpath【css',0,0,NULL,NULL,1,NULL,NULL,'作者：【编辑：','replace【xpath',1,'2023-01-05 15:42:28','2023-01-05 15:42:28'),
(76,NULL,14,'editor','//span[@class=\'authors\']','xpath',0,0,NULL,NULL,0,NULL,NULL,'责任编辑：【见习记者【(EN057)','replace【replace【replace',1,'2023-01-05 17:22:32','2023-01-10 17:43:23'),
(77,NULL,19,'source_title','//*[@id=\"news_title\"]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'&ZerWidthSpace;','replace',1,'2023-01-09 14:32:58','2023-01-09 14:32:58'),
(78,NULL,19,'source_content','//div[@class=\"news_txt\"]','xpath',1,0,NULL,NULL,1,NULL,NULL,'','replace',1,'2023-01-09 14:34:37','2023-01-09 14:34:37'),
(79,NULL,21,'source_title','//h1[@class=\'title\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-09 16:33:08','2023-01-09 16:33:08'),
(80,NULL,21,'source_content','//div[@class=\'richContent  richContent0\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-09 16:34:03','2023-01-09 16:34:03'),
(81,NULL,21,'source_pub_time','//div[@class=\'leftInfo\']//span[1]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'发表时间：','replace',1,'2023-01-09 16:35:43','2023-01-09 16:49:46'),
(82,NULL,21,'source_name','//div[@class=\'leftInfo\']//span[2]//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-09 16:50:25','2023-01-09 16:50:25'),
(83,NULL,21,'pub_channel_name','国内新闻','self',0,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-09 16:55:05','2023-01-09 16:55:17'),
(84,NULL,25,'source_title','//div[@class=\'title\']//h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 10:45:52','2023-01-10 14:15:02'),
(85,NULL,25,'source_content','//div[@class=\'content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 10:46:21','2023-01-10 10:46:21'),
(86,NULL,25,'source_pub_time','//span[@class=\'date\']//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'|','replace',1,'2023-01-10 11:03:43','2023-01-10 11:03:43'),
(87,NULL,25,'source_author','//div[@class=\'ntit\']//div[@class=\'fr ntit_rbj\']//span//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-10 11:05:43','2023-01-10 11:05:43'),
(88,NULL,25,'source_name','//div[@class=\'fr ntit_r\']//span//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-10 11:07:35','2023-01-10 11:07:35'),
(89,NULL,25,'pub_channel_name','//div[@id=\'logo\']//h3','xpath',1,0,NULL,NULL,1,NULL,NULL,'&#13;【<!--function channel_name() parse begin-->【<!--function: channel_name() parse end  0ms cost! -->','replace【replace【replace',1,'2023-01-10 11:30:51','2023-01-11 14:26:20'),
(90,NULL,24,'source_name','//div[@class=\'left10\']//p//a//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:39:17','2023-01-10 14:39:17'),
(91,NULL,24,'pub_channel_name','//div[@class=\'wei\']//a[3]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:40:43','2023-01-11 14:23:28'),
(92,NULL,24,'source_title','//div[@class=\'left1_a\']//h2','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:42:00','2023-01-10 14:42:00'),
(93,NULL,24,'source_content','//div[@class=\'left1_d\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 14:42:29','2023-01-10 14:42:29'),
(94,NULL,24,'source_pub_time','//div[@class=\'left1_b\']//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'责任编辑：【字体：','replace【replace',1,'2023-01-10 14:44:43','2023-01-10 15:58:02'),
(95,NULL,24,'source_author','//div[@class=\'left1_b\']//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'/(\\r\\n.+\\r\\n责任编辑：).+(\\r\\n字体.+)/','regex',1,'2023-01-10 15:55:15','2023-01-11 14:24:32'),
(96,NULL,26,'source_title','//h1[@class=\'w1 hot_h1\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'【&#13;','strip_tags【replace',1,'2023-01-10 17:54:12','2023-01-10 17:54:12'),
(97,NULL,26,'source_content','//div[@class=\'i_left_body\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-10 19:04:08','2023-01-10 19:35:15'),
(98,NULL,26,'source_pub_time','//div[@class=\'key w1 clear\']//span[1]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'/(来源：.*)/','regex',1,'2023-01-10 19:10:29','2023-01-10 19:20:46'),
(99,NULL,26,'source_name','//div[@class=\'key w1 clear\']//span[1]','xpath',0,0,NULL,NULL,1,NULL,NULL,'/(.*来源：)/【','regex【strip_tags',1,'2023-01-10 19:23:40','2023-01-11 15:58:39'),
(100,NULL,26,'source_author','//div[@class=\'i_left_body\']//div[@class=\'clear\']','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-10 19:26:31','2023-01-10 19:26:31'),
(101,NULL,26,'pub_channel_name','//div[@class=\'position w1 clear\']//a[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-10 19:27:55','2023-01-11 14:25:41'),
(102,NULL,27,'source_title','//div[@id=\'article-title\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-11 17:07:19','2023-01-11 17:07:19'),
(103,NULL,27,'source_content','//div[@id=\'article-content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-11 17:07:56','2023-01-11 17:07:56'),
(104,NULL,28,'source_title','//div[@class=\'detail-h\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'/(<p>.*<\\/p>)/【&#13;【','regex【replace【strip_tags',1,'2023-01-12 15:01:30','2023-01-12 15:01:30'),
(105,NULL,28,'source_content','//div[@class=\'detail-d\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 15:02:09','2023-01-12 15:02:09'),
(106,NULL,28,'source_pub_time','//div[@class=\'detail-h\']/p/span[2]//text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-12 15:04:41','2023-01-12 15:04:41'),
(107,NULL,28,'source_author','//dl[@class=\'clearfix\']/dd/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-12 15:07:00','2023-01-12 15:07:00'),
(108,NULL,28,'source_name','//div[@class=\'detail-h\']/p/span[1]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-12 15:09:50','2023-01-12 15:09:50'),
(109,NULL,28,'pub_channel_name','//div[@class=\'Crumbs auto\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 15:10:58','2023-01-12 15:11:21'),
(110,NULL,29,'source_title','//div[@class=\'g_con\']/h1/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 16:44:15','2023-01-12 16:44:15'),
(111,NULL,29,'source_content','//div[@class=\'con\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 16:45:06','2023-01-12 16:45:06'),
(112,NULL,29,'source_pub_time','//div[@class=\'info\']/span[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-12 16:47:53','2023-01-12 16:47:53'),
(113,NULL,29,'source_name','//div[@class=\'info\']/span[1]/a/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 16:54:38','2023-01-12 16:54:38'),
(114,NULL,29,'source_author','//div[@class=\'info\']/span[2]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-12 16:57:48','2023-01-12 16:57:48'),
(115,NULL,29,'pub_channel_name','//div[@class=\'weizhi\']/a[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 16:58:50','2023-01-12 16:58:50'),
(116,NULL,30,'source_title','//div[@class=\'details_news_title__W7OFw\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:07:21','2023-01-12 17:07:21'),
(117,NULL,30,'source_content','//div[@id=\'news_content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:08:29','2023-01-12 17:08:29'),
(118,NULL,30,'source_pub_time','//div[@class=\'smallComponents_article_info_bar__tBES1\']/span[1]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:09:35','2023-01-12 17:09:35'),
(119,NULL,30,'source_name','//div[@class=\'smallComponents_article_info_bar__tBES1\']/span[2]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:11:24','2023-01-12 17:13:00'),
(120,NULL,30,'pub_channel_name','//div[@class=\'layout_bread_crumb__HBepy ellipsis\']/span[2]/a/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 17:12:53','2023-01-12 17:12:53'),
(121,NULL,31,'source_title','//div[@class=\'headlineBox\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 18:08:49','2023-01-12 18:08:49'),
(122,NULL,31,'source_content','//div[@class=\'article\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-12 18:09:26','2023-01-12 18:09:26'),
(123,NULL,31,'source_pub_time','//div[@class=\'sourceBox flex_r flex_wrap\']/span[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-12 18:11:32','2023-01-12 18:28:38'),
(124,NULL,31,'source_name','//div[@class=\'sourceBox flex_r flex_wrap\']/span[1]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-12 18:14:43','2023-01-12 18:14:43'),
(125,NULL,31,'pub_channel_name','//div[@class=\'current-position\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-12 18:15:51','2023-01-12 18:15:51'),
(126,NULL,31,'source_author','//div[@class=\'sourceBox flex_r flex_wrap\']/span[3]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'编辑：','replace',1,'2023-01-12 18:17:11','2023-01-12 18:17:11'),
(127,NULL,32,'source_title','//div[@class=\'jz\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'/(\\s)/【\\n【','regex【replace【strip_tags',1,'2023-01-13 11:24:35','2023-01-13 11:24:35'),
(128,NULL,32,'source_content','//div[@id=\'rwb_zw\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-13 11:25:29','2023-01-13 11:25:29'),
(129,NULL,32,'pub_channel_name','//span[@id=\'rwb_navpath\']/a[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-13 11:27:30','2023-01-13 11:27:30'),
(130,NULL,32,'source_author','//div[@class=\'editer clearfix\']//text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'/(\\(责编：).*(\\))/','regex',1,'2023-01-16 11:05:04','2023-01-16 11:05:04'),
(131,NULL,32,'source_pub_time','//div[@class=\'left1\']【/(\\d+年\\d+月\\d+日\\d+:\\d+)/','xpath【regex',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-16 15:07:25','2023-01-16 15:07:25'),
(132,NULL,32,'source_name','//div[@class=\'left1\']【/来源：([\\d\\D]*)\';/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'来源：【','replace【strip_tags',1,'2023-01-16 16:40:19','2023-01-16 16:40:59'),
(133,NULL,34,'source_title','//h1[@class=\'title\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-17 10:12:00','2023-01-17 10:12:00'),
(134,NULL,34,'source_content','//div[@class=\'content\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-17 10:12:40','2023-01-17 10:12:40'),
(135,NULL,34,'source_pub_time','//div[@class=\'info clearfix\']/span[last()]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-17 11:23:39','2023-01-17 11:23:39'),
(136,NULL,34,'pub_channel_name','//div[@class=\'local domPC clearfix\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-17 11:28:35','2023-01-17 11:28:35'),
(137,NULL,34,'source_name','//div[@class=\'info clearfix\']/span[1]【/来源：([\\d\\D]*)/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'来源：【','replace【strip_tags',1,'2023-01-17 11:33:56','2023-01-17 14:35:17'),
(138,NULL,34,'source_author','//div[@class=\'info clearfix\']/span[2]/text()【/作者：([\\d\\D]*)/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'记者【文/摄【通讯员','replace【replace【replace',1,'2023-01-17 11:36:24','2023-01-17 14:24:45'),
(139,NULL,35,'source_title','//div[@class=\'text\']/dl/dt/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-17 14:59:13','2023-01-17 14:59:13'),
(140,NULL,35,'source_content','//div[@class=\'news_cont\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-17 14:59:53','2023-01-17 14:59:53'),
(141,NULL,36,'source_title','//p[@class=\'fywztitle\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-18 10:02:14','2023-01-18 10:02:14'),
(142,NULL,36,'source_content','//div[@class=\'fywzlm\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-18 10:03:25','2023-01-18 10:40:37'),
(143,NULL,36,'source_pub_time','//table[@class=\'fywzzz\']//td[1]/text()[1]','xpath',1,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-18 10:16:15','2023-01-18 10:16:15'),
(144,NULL,36,'source_name','//table[@class=\'fywzzz\']//td[1]【/来源：([\\d\\D]*)\\s*编辑/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'【','strip_tags',1,'2023-01-18 10:27:51','2023-01-18 10:51:39'),
(145,NULL,36,'source_author','//table[@class=\'fywzzz\']//td[1]【/编辑：([\\d\\D]*)/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-18 10:30:32','2023-01-18 10:52:21'),
(146,NULL,36,'pub_channel_name','//div[@class=\'fylogo\']//a[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-18 10:32:00','2023-01-18 10:34:57'),
(147,NULL,37,'source_title','//h1[@id=\'title\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-18 14:48:25','2023-01-18 14:48:25'),
(148,NULL,37,'source_content','//div[@class=\'TRS_Editor\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-18 14:50:37','2023-01-18 14:50:37'),
(149,NULL,37,'source_pub_time','//span[@class=\'time\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-18 14:52:40','2023-01-18 14:52:40'),
(150,NULL,37,'source_name','//div[@class=\'source\']/span[2]/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-18 14:55:02','2023-01-18 14:55:02'),
(151,NULL,37,'source_author','//span[@class=\'editor\']/text()【/\\[[\\w\\W]*责任编辑:([\\d\\D]*)[\\w\\W]*\\]/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'/(\\s*)/','regex',1,'2023-01-18 15:09:55','2023-01-18 16:13:12'),
(152,NULL,37,'pub_channel_name','//div[@class=\'mbx fl\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-18 15:11:35','2023-01-18 15:11:35'),
(153,NULL,38,'source_title','//div[@class=\'detail-h\']/h1','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,'strip_tags',1,'2023-01-19 14:49:01','2023-01-19 14:49:01'),
(154,NULL,38,'source_content','//div[@class=\'detail-d\']','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,'',1,'2023-01-19 15:05:45','2023-01-19 15:05:45'),
(155,NULL,38,'source_pub_time','//div[@class=\'detail-h\']/p/span[3]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'时间：','replace',1,'2023-01-19 15:08:19','2023-01-19 15:08:19'),
(156,NULL,38,'source_name','//div[@class=\'detail-h\']/p/span[1]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'来源：','replace',1,'2023-01-19 15:08:53','2023-01-19 15:08:53'),
(157,NULL,38,'source_author','//div[@class=\'detail-h\']/p/span[2]/text()','xpath',0,0,NULL,NULL,1,'source_author|space|editor','|space|','发布者：','replace',1,'2023-01-19 15:09:39','2023-01-19 15:13:44'),
(158,NULL,38,'pub_channel_name','//div[@class=\'wzdh clearfix\']/a[2]/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-19 15:10:29','2023-01-19 15:10:29'),
(159,NULL,38,'editor','//dl[@class=\'clearfix\']/dd/text()','xpath',0,0,NULL,NULL,0,NULL,NULL,'编辑：','replace',1,'2023-01-19 15:12:30','2023-01-19 15:12:30'),
(160,NULL,39,'source_title','//h2[@class=\'h2 text-center xb-h2\']/text()','xpath',1,0,NULL,NULL,1,NULL,NULL,NULL,NULL,1,'2023-01-20 14:35:13','2023-01-20 14:35:13'),
(161,NULL,39,'source_content','//div[@class=\'col-md-12 nry jcontent\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'<p>','strip_tags',1,'2023-01-20 14:38:58','2023-01-20 14:38:58'),
(162,NULL,39,'source_pub_time','//h3[@class=\'h4 text-center xb-h4\']','xpath',1,0,NULL,NULL,1,NULL,NULL,'0,19','substr',1,'2023-01-20 14:45:19','2023-01-20 14:45:19'),
(163,NULL,39,'source_name','//h3[@class=\'h4 text-center xb-h4\']【/来源：(.*)浏览次数/','xpath【regex',0,0,NULL,NULL,1,NULL,NULL,'/(　　 )/','regex',1,'2023-01-20 15:04:34','2023-01-20 15:11:55'),
(164,NULL,39,'pub_channel_name','//div[@class=\'navlf\']/span/span/a/text()','',1,0,NULL,NULL,1,NULL,NULL,'','',1,'2023-01-20 15:06:37','2023-01-20 15:06:37'),
(165,NULL,39,'source_author','//div[@class=\'text-right zrbj\']/p/text()','xpath',0,0,NULL,NULL,1,NULL,NULL,'责任编辑：','replace',1,'2023-01-20 15:08:43','2023-01-20 15:08:43');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
