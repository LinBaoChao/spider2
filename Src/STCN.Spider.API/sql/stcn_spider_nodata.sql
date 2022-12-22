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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `website_field` */

DROP TABLE IF EXISTS `website_field`;

CREATE TABLE `website_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL COMMENT '网站id',
  `name` varchar(50) DEFAULT NULL COMMENT '要与入库时表的字段对应',
  `selector` varchar(200) DEFAULT NULL COMMENT '定义抽取规则, 默认使用xpath,如''selector'' => "//*[@id=''single-next-link'']"',
  `selector_type` varchar(50) DEFAULT 'xpath' COMMENT '抽取规则的类型,默认xpath，目前可用xpath, jsonpath, regex',
  `required` tinyint(1) DEFAULT '0' COMMENT '定义该field的值是否必须, 默认false，true的话, 如果该field没有抽取到内容, 该field对应的整条数据都将被丢弃',
  `repeated` tinyint(1) DEFAULT '0' COMMENT '定义该field抽取到的内容是否是有多项, 默认false,赋值为true的话, 无论该field是否真的是有多项, 抽取到的结果都是数组结构，''selector'' => "//*[@id=''zh-single-question-page'']//a[contains(@class,''zm-item-tag'')]",',
  `source_type` varchar(50) DEFAULT NULL COMMENT '该field的数据源, 默认从当前的网页中抽取数据,选择attached_url可以发起一个新的请求, 然后从请求返回的数据中抽取,选择url_context可以从当前网页的url附加数据',
  `attached_url` varchar(200) DEFAULT NULL COMMENT '当source_type设置为attached_url时, 定义新请求的url',
  `is_write_db` tinyint(1) DEFAULT '1' COMMENT '是否入库',
  `join_field` varchar(50) DEFAULT NULL COMMENT '合并字段,用什么符号分割就用什么符号连接内容',
  `join_field_split` varchar(50) DEFAULT NULL COMMENT '合并字段分割符，如果值直接连接不用分割则是|no|空格用|space|',
  `filter` varchar(100) DEFAULT NULL COMMENT '过滤移除正则表达式',
  `filter_type` varchar(50) DEFAULT NULL COMMENT 'replace regex xpath css',
  `status` int(11) DEFAULT '1' COMMENT '0禁用 1启用 2出错',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
