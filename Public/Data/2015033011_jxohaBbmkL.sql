-- 2015-03-30 11:35:45--
-- 表的结构 `fyt_access`
-- 
DROP TABLE IF EXISTS `fyt_access`;
CREATE TABLE `fyt_access` (
  `role_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `node_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `model` varchar(50) NOT NULL DEFAULT '',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_access`表中的数据 `fyt_access`
--
INSERT INTO `fyt_access` VALUES ('6','264','3','201','');
INSERT INTO `fyt_access` VALUES ('6','263','3','181','');
INSERT INTO `fyt_access` VALUES ('6','262','3','236','');
INSERT INTO `fyt_access` VALUES ('6','261','3','186','');
INSERT INTO `fyt_access` VALUES ('6','260','3','186','');
INSERT INTO `fyt_access` VALUES ('6','259','3','181','');
INSERT INTO `fyt_access` VALUES ('6','258','3','236','');
INSERT INTO `fyt_access` VALUES ('6','257','3','236','');
INSERT INTO `fyt_access` VALUES ('6','256','3','236','');
INSERT INTO `fyt_access` VALUES ('6','255','3','236','');
INSERT INTO `fyt_access` VALUES ('6','254','3','236','');
INSERT INTO `fyt_access` VALUES ('2','171','2','1','');
INSERT INTO `fyt_access` VALUES ('2','170','2','1','');
INSERT INTO `fyt_access` VALUES ('2','169','3','81','');
INSERT INTO `fyt_access` VALUES ('2','167','3','2','');
INSERT INTO `fyt_access` VALUES ('2','173','3','3','');
INSERT INTO `fyt_access` VALUES ('2','165','3','81','');
INSERT INTO `fyt_access` VALUES ('2','164','3','12','');
INSERT INTO `fyt_access` VALUES ('2','163','3','2','');
INSERT INTO `fyt_access` VALUES ('2','162','2','1','');
INSERT INTO `fyt_access` VALUES ('2','157','3','3','');
INSERT INTO `fyt_access` VALUES ('2','156','3','151','');
INSERT INTO `fyt_access` VALUES ('2','155','3','151','');
INSERT INTO `fyt_access` VALUES ('2','154','3','151','');
INSERT INTO `fyt_access` VALUES ('2','150','3','129','');
INSERT INTO `fyt_access` VALUES ('2','149','3','129','');
INSERT INTO `fyt_access` VALUES ('2','148','3','129','');
INSERT INTO `fyt_access` VALUES ('2','147','3','129','');
INSERT INTO `fyt_access` VALUES ('2','139','3','12','');
INSERT INTO `fyt_access` VALUES ('2','138','3','125','');
INSERT INTO `fyt_access` VALUES ('2','137','3','125','');
INSERT INTO `fyt_access` VALUES ('2','136','3','125','');
INSERT INTO `fyt_access` VALUES ('2','135','3','125','');
INSERT INTO `fyt_access` VALUES ('2','134','3','125','');
INSERT INTO `fyt_access` VALUES ('2','133','3','125','');
INSERT INTO `fyt_access` VALUES ('2','132','3','125','');
INSERT INTO `fyt_access` VALUES ('2','131','3','125','');
INSERT INTO `fyt_access` VALUES ('2','117','2','1','');
INSERT INTO `fyt_access` VALUES ('2','116','2','1','');
INSERT INTO `fyt_access` VALUES ('2','115','2','1','');
INSERT INTO `fyt_access` VALUES ('2','114','2','1','');
INSERT INTO `fyt_access` VALUES ('2','113','2','1','');
INSERT INTO `fyt_access` VALUES ('2','112','2','1','');
INSERT INTO `fyt_access` VALUES ('2','111','2','1','');
INSERT INTO `fyt_access` VALUES ('2','110','2','1','');
INSERT INTO `fyt_access` VALUES ('2','107','2','1','');
INSERT INTO `fyt_access` VALUES ('2','81','2','1','');
INSERT INTO `fyt_access` VALUES ('2','30','3','2','');
INSERT INTO `fyt_access` VALUES ('2','28','3','2','');
INSERT INTO `fyt_access` VALUES ('2','27','3','2','');
INSERT INTO `fyt_access` VALUES ('2','26','3','2','');
INSERT INTO `fyt_access` VALUES ('2','25','3','12','');
INSERT INTO `fyt_access` VALUES ('2','24','3','12','');
INSERT INTO `fyt_access` VALUES ('2','23','3','12','');
INSERT INTO `fyt_access` VALUES ('2','22','3','12','');
INSERT INTO `fyt_access` VALUES ('2','21','3','12','');
INSERT INTO `fyt_access` VALUES ('2','16','3','12','');
INSERT INTO `fyt_access` VALUES ('2','15','3','12','');
INSERT INTO `fyt_access` VALUES ('2','11','3','2','');
INSERT INTO `fyt_access` VALUES ('2','4','3','3','');
INSERT INTO `fyt_access` VALUES ('2','3','2','1','');
INSERT INTO `fyt_access` VALUES ('2','2','2','1','');
INSERT INTO `fyt_access` VALUES ('2','1','1','0','');
INSERT INTO `fyt_access` VALUES ('6','253','3','203','');
INSERT INTO `fyt_access` VALUES ('6','252','3','203','');
INSERT INTO `fyt_access` VALUES ('6','251','2','1','');
INSERT INTO `fyt_access` VALUES ('6','250','2','1','');
INSERT INTO `fyt_access` VALUES ('6','249','3','186','');
INSERT INTO `fyt_access` VALUES ('6','248','3','245','');
INSERT INTO `fyt_access` VALUES ('6','247','3','245','');
INSERT INTO `fyt_access` VALUES ('6','246','3','245','');
INSERT INTO `fyt_access` VALUES ('6','245','2','1','');
INSERT INTO `fyt_access` VALUES ('6','244','3','186','');
INSERT INTO `fyt_access` VALUES ('6','243','2','1','');
INSERT INTO `fyt_access` VALUES ('6','241','2','1','');
INSERT INTO `fyt_access` VALUES ('6','240','2','1','');
INSERT INTO `fyt_access` VALUES ('6','239','2','1','');
INSERT INTO `fyt_access` VALUES ('6','238','2','1','');
INSERT INTO `fyt_access` VALUES ('6','237','2','1','');
INSERT INTO `fyt_access` VALUES ('6','236','2','1','');
INSERT INTO `fyt_access` VALUES ('6','234','3','230','');
INSERT INTO `fyt_access` VALUES ('6','233','3','230','');
INSERT INTO `fyt_access` VALUES ('6','232','3','230','');
INSERT INTO `fyt_access` VALUES ('6','231','3','230','');
INSERT INTO `fyt_access` VALUES ('6','230','2','1','');
INSERT INTO `fyt_access` VALUES ('6','229','3','225','');
INSERT INTO `fyt_access` VALUES ('6','228','3','225','');
INSERT INTO `fyt_access` VALUES ('6','227','3','225','');
INSERT INTO `fyt_access` VALUES ('6','226','3','225','');
INSERT INTO `fyt_access` VALUES ('6','225','2','1','');
INSERT INTO `fyt_access` VALUES ('6','224','3','220','');
INSERT INTO `fyt_access` VALUES ('6','223','3','220','');
INSERT INTO `fyt_access` VALUES ('6','222','3','220','');
INSERT INTO `fyt_access` VALUES ('6','221','3','220','');
INSERT INTO `fyt_access` VALUES ('6','220','2','1','');
INSERT INTO `fyt_access` VALUES ('6','219','3','215','');
INSERT INTO `fyt_access` VALUES ('6','218','3','215','');
INSERT INTO `fyt_access` VALUES ('6','217','3','215','');
INSERT INTO `fyt_access` VALUES ('6','216','3','215','');
INSERT INTO `fyt_access` VALUES ('6','215','2','1','');
INSERT INTO `fyt_access` VALUES ('6','214','3','211','');
INSERT INTO `fyt_access` VALUES ('6','213','3','211','');
INSERT INTO `fyt_access` VALUES ('6','212','3','211','');
INSERT INTO `fyt_access` VALUES ('6','211','2','1','');
INSERT INTO `fyt_access` VALUES ('6','210','3','206','');
INSERT INTO `fyt_access` VALUES ('6','209','3','206','');
INSERT INTO `fyt_access` VALUES ('6','208','3','206','');
INSERT INTO `fyt_access` VALUES ('6','207','3','206','');
INSERT INTO `fyt_access` VALUES ('6','206','2','1','');
INSERT INTO `fyt_access` VALUES ('6','205','3','203','');
INSERT INTO `fyt_access` VALUES ('6','204','3','203','');
INSERT INTO `fyt_access` VALUES ('6','203','2','1','');
INSERT INTO `fyt_access` VALUES ('6','202','3','201','');
INSERT INTO `fyt_access` VALUES ('6','201','2','1','');
INSERT INTO `fyt_access` VALUES ('6','200','3','198','');
INSERT INTO `fyt_access` VALUES ('6','198','2','1','');
INSERT INTO `fyt_access` VALUES ('6','197','3','194','');
INSERT INTO `fyt_access` VALUES ('6','196','3','194','');
INSERT INTO `fyt_access` VALUES ('6','195','3','194','');
INSERT INTO `fyt_access` VALUES ('6','194','2','1','');
INSERT INTO `fyt_access` VALUES ('6','193','3','190','');
INSERT INTO `fyt_access` VALUES ('6','192','3','190','');
INSERT INTO `fyt_access` VALUES ('6','191','3','190','');
INSERT INTO `fyt_access` VALUES ('6','190','2','1','');
INSERT INTO `fyt_access` VALUES ('6','189','3','186','');
INSERT INTO `fyt_access` VALUES ('6','181','2','1','');
INSERT INTO `fyt_access` VALUES ('6','164','3','12','');
INSERT INTO `fyt_access` VALUES ('6','156','3','151','');
INSERT INTO `fyt_access` VALUES ('6','155','3','151','');
INSERT INTO `fyt_access` VALUES ('6','154','3','151','');
INSERT INTO `fyt_access` VALUES ('6','153','3','151','');
INSERT INTO `fyt_access` VALUES ('6','152','3','151','');
INSERT INTO `fyt_access` VALUES ('6','151','2','1','');
INSERT INTO `fyt_access` VALUES ('6','139','3','12','');
INSERT INTO `fyt_access` VALUES ('6','186','2','1','');
INSERT INTO `fyt_access` VALUES ('6','184','3','181','');
INSERT INTO `fyt_access` VALUES ('6','182','3','181','');
INSERT INTO `fyt_access` VALUES ('6','183','3','181','');
INSERT INTO `fyt_access` VALUES ('6','187','3','186','');
INSERT INTO `fyt_access` VALUES ('1','181','2','1','');
INSERT INTO `fyt_access` VALUES ('1','164','3','12','');
INSERT INTO `fyt_access` VALUES ('1','156','3','151','');
INSERT INTO `fyt_access` VALUES ('1','155','3','151','');
INSERT INTO `fyt_access` VALUES ('1','154','3','151','');
INSERT INTO `fyt_access` VALUES ('1','153','3','151','');
INSERT INTO `fyt_access` VALUES ('1','152','3','151','');
INSERT INTO `fyt_access` VALUES ('1','151','2','1','');
INSERT INTO `fyt_access` VALUES ('1','139','3','12','');
INSERT INTO `fyt_access` VALUES ('1','184','3','181','');
INSERT INTO `fyt_access` VALUES ('1','182','3','181','');
INSERT INTO `fyt_access` VALUES ('1','183','3','181','');
INSERT INTO `fyt_access` VALUES ('1','25','3','12','');
INSERT INTO `fyt_access` VALUES ('1','24','3','12','');
INSERT INTO `fyt_access` VALUES ('1','23','3','12','');
INSERT INTO `fyt_access` VALUES ('1','22','3','12','');
INSERT INTO `fyt_access` VALUES ('1','21','3','12','');
INSERT INTO `fyt_access` VALUES ('1','16','3','12','');
INSERT INTO `fyt_access` VALUES ('1','15','3','12','');
INSERT INTO `fyt_access` VALUES ('1','14','3','12','');
INSERT INTO `fyt_access` VALUES ('1','13','3','12','');
INSERT INTO `fyt_access` VALUES ('1','12','2','1','');
INSERT INTO `fyt_access` VALUES ('1','1','1','0','');
INSERT INTO `fyt_access` VALUES ('6','25','3','12','');
INSERT INTO `fyt_access` VALUES ('6','24','3','12','');
INSERT INTO `fyt_access` VALUES ('6','23','3','12','');
INSERT INTO `fyt_access` VALUES ('6','22','3','12','');
INSERT INTO `fyt_access` VALUES ('6','21','3','12','');
INSERT INTO `fyt_access` VALUES ('6','16','3','12','');
INSERT INTO `fyt_access` VALUES ('6','15','3','12','');
INSERT INTO `fyt_access` VALUES ('6','14','3','12','');
INSERT INTO `fyt_access` VALUES ('6','13','3','12','');
INSERT INTO `fyt_access` VALUES ('6','12','2','1','');
INSERT INTO `fyt_access` VALUES ('6','188','3','186','');
INSERT INTO `fyt_access` VALUES ('6','1','1','0','');
INSERT INTO `fyt_access` VALUES ('6','265','3','201','');
INSERT INTO `fyt_access` VALUES ('6','266','3','186','');
INSERT INTO `fyt_access` VALUES ('6','267','3','186','');
INSERT INTO `fyt_access` VALUES ('6','268','3','203','');
INSERT INTO `fyt_access` VALUES ('6','269','2','1','');
INSERT INTO `fyt_access` VALUES ('6','270','3','186','');
INSERT INTO `fyt_access` VALUES ('6','271','2','1','');
--
-- 表的结构 `fyt_admin`
-- 
DROP TABLE IF EXISTS `fyt_admin`;
CREATE TABLE `fyt_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `question` varchar(50) NOT NULL DEFAULT '',
  `answer` varchar(50) NOT NULL DEFAULT '',
  `login_count` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `last_logintime` int(11) unsigned NOT NULL DEFAULT '0',
  `reg_ip` char(15) NOT NULL DEFAULT '',
  `last_ip` char(15) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_admin`表中的数据 `fyt_admin`
--
INSERT INTO `fyt_admin` VALUES ('1','1','admin','f3a1203086beab4f003b6bf9f37f70b4cab95b73','','','','','0','0','0','0','','','0');
INSERT INTO `fyt_admin` VALUES ('2','1','admin01','47f2a7a6b4b6e52f459654163272e3789a1dc0a9','udditypl@126.com','admin','','','0','1337849011','1353465403','1414371111','127.0.0.1','58.60.35.217','1');
INSERT INTO `fyt_admin` VALUES ('3','2','yuzihao','9db557c4a121400b1f7dc27edc887ed773777e53','udditypl@163.com','','','','1','0','1374048376','1427686524','','127.0.0.1','1');
--
-- 表的结构 `fyt_article`
-- 
DROP TABLE IF EXISTS `fyt_article`;
CREATE TABLE `fyt_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `copyfrom` varchar(255) NOT NULL DEFAULT '',
  `fromlink` varchar(80) NOT NULL DEFAULT '0',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `template` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `readgroup` varchar(255) NOT NULL DEFAULT '',
  `readpoint` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `url` varchar(150) NOT NULL DEFAULT '',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `lang` (`id`,`lang`,`status`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_attachment`
-- 
DROP TABLE IF EXISTS `fyt_attachment`;
CREATE TABLE `fyt_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `moduleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `id` int(8) unsigned NOT NULL DEFAULT '0',
  `filename` varchar(50) NOT NULL DEFAULT '',
  `filepath` varchar(80) NOT NULL DEFAULT '',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `fileext` char(10) NOT NULL DEFAULT '',
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isthumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `uploadip` char(15) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=366 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_block`
-- 
DROP TABLE IF EXISTS `fyt_block`;
CREATE TABLE `fyt_block` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pos` char(30) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`),
  KEY `pos` (`pos`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_block`表中的数据 `fyt_block`
--
INSERT INTO `fyt_block` VALUES ('1','wap_about_index','手机版-首页公司简介','1','<span style=\"color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;\">深圳市顺达成电子设备有限公司是一家集SMT电子设备设计、生产、销售、维修于一体的综合性公司。公司成立于2007年，中国地区总部位于深圳宝安福永镇，濒临深圳机场、码头及107国道，交通极为便利。本公司坚持“精益求精，诚信服务，持续改进，永续经营”为最高经营宗旨和质量方针，凭着优良的产品质量及优惠的产品价格，为顾客提供满意的产品。主要经营产项目有：回流焊、波峰焊、三防涂覆设备、平行移载机，异型元件自动插装区总部位于深圳宝机、组装.</span>');
INSERT INTO `fyt_block` VALUES ('8','wap_youshi','手机版-公司优势','1','<div class=\"youshi-a\">\r\n <img src=\"/Themes/Mobile/Default/public/images/ys-a.jpg\" alt=\"24小时售后专线\" /> \r\n <h3>\r\n    24小时售后专线\r\n  </h3>\r\n <p>\r\n   开通24小时售后服务专线公司所售出的设备享受12个月整机免费保修（人为损坏除外），主体结构保用五年（易损件见说明书附表清单），终生维修。\r\n  </p>\r\n</div>\r\n<div class=\"youshi-b\">\r\n  <img src=\"/Themes/Mobile/Default/public/images/ys-b.jpg\" alt=\"售后保修\" /> \r\n <h3>\r\n    售后保修\r\n  </h3>\r\n <p>\r\n   公司所售出的设备享受12个月整机免费保修（人为损坏除外），主体结构保用五年（易损件见说明书附表清单），终生维护，维护期间只收取成本；\r\n  </p>\r\n</div>\r\n<div class=\"youshi-a\">\r\n  <img src=\"/Themes/Mobile/Default/public/images/ys-c.jpg\" alt=\"定期回访\" /> \r\n <h3>\r\n    定期回访\r\n  </h3>\r\n <p>\r\n   公司所有客户，每月由专业人员电话回访一次，询问客户的使用情况；\r\n </p>\r\n</div>\r\n<div class=\"youshi-b\">\r\n  <img src=\"/Themes/Mobile/Default/public/images/ys-d.jpg\" alt=\"上门服务\" /> \r\n <h3>\r\n    上门服务\r\n  </h3>\r\n <p>\r\n   我公司外出人员都带有售后维修单，并请客户对我公司的维修人员、 维修结果、满意程度书面给予评价，我公司将会根据此记录对维修人员进行量化管理；\r\n </p>\r\n</div>\r\n<div class=\"youshi-a\">\r\n  <img src=\"/Themes/Mobile/Default/public/images/ys-e.jpg\" alt=\"响应速度\" /> \r\n <h3>\r\n    响应速度\r\n  </h3>\r\n <p>\r\n   客户设备出现故障后，可以以传真或电话的形式通知我公司，我公司在接到通知后，1小时内提出解决方案，如需派人上门维修的，深圳、东莞范围在8小时内赶赴现场\r\n  </p>\r\n</div>\r\n<div class=\"youshi-b\">\r\n  <img src=\"/Themes/Mobile/Default/public/images/ys-f.jpg\" alt=\"免费培训\" /> \r\n <h3>\r\n    免费培训\r\n  </h3>\r\n <p>\r\n   我公司设备验收合格后，免费对客户的使用技术人员进行设备的操作、保养和维护培训，确保生产正常运行；\r\n  </p>\r\n</div>');
--
-- 表的结构 `fyt_cart`
-- 
DROP TABLE IF EXISTS `fyt_cart`;
CREATE TABLE `fyt_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sessionid` char(32) NOT NULL DEFAULT '',
  `moduleid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_thumb` varchar(120) NOT NULL DEFAULT '',
  `product_name` varchar(120) NOT NULL DEFAULT '',
  `product_url` varchar(120) NOT NULL DEFAULT '',
  `product_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr` text NOT NULL,
  `goods_attr_id` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isgift` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sessionid` (`sessionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_category`
-- 
DROP TABLE IF EXISTS `fyt_category`;
CREATE TABLE `fyt_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `catname` varchar(30) NOT NULL DEFAULT '',
  `catdir` varchar(30) NOT NULL DEFAULT '',
  `parentdir` varchar(50) NOT NULL DEFAULT '',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `moduleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `module` char(24) NOT NULL DEFAULT '',
  `arrparentid` varchar(255) NOT NULL DEFAULT '',
  `arrchildid` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT '',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(150) NOT NULL DEFAULT '',
  `template_list` varchar(20) NOT NULL DEFAULT '',
  `template_show` varchar(20) NOT NULL DEFAULT '',
  `pagesize` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `catcontent` varchar(250) NOT NULL,
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `listtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `urlruleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `listorder` (`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_config`
-- 
DROP TABLE IF EXISTS `fyt_config`;
CREATE TABLE `fyt_config` (
  `id` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(20) NOT NULL DEFAULT '',
  `info` varchar(100) NOT NULL DEFAULT '',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `value` text NOT NULL,
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_config`表中的数据 `fyt_config`
--
INSERT INTO `fyt_config` VALUES ('1','site_name','网站名称','1','','1');
INSERT INTO `fyt_config` VALUES ('2','site_url','网站网址','1','','1');
INSERT INTO `fyt_config` VALUES ('4','site_email','公司邮箱','2','','1');
INSERT INTO `fyt_config` VALUES ('5','seo_title','首页标题','1','','1');
INSERT INTO `fyt_config` VALUES ('6','seo_keywords','首页关键词','1','','1');
INSERT INTO `fyt_config` VALUES ('7','seo_description','首页描述','1','','1');
INSERT INTO `fyt_config` VALUES ('69','site_telephone','公司电话','2','88888888','1');
INSERT INTO `fyt_config` VALUES ('74','site_lxr','联系人','2','','1');
INSERT INTO `fyt_config` VALUES ('68','site_address','公司地址','2','','1');
INSERT INTO `fyt_config` VALUES ('72','site_mainproducts','主营产品','2','','1');
INSERT INTO `fyt_config` VALUES ('73','site_copyright','版权所有','1','版权所有 2014 © All Rights Reserved','1');
INSERT INTO `fyt_config` VALUES ('75','site_approve','ICP备案号','1','备案号','1');
INSERT INTO `fyt_config` VALUES ('89','site_tel400','全国服务热线','2','','1');
INSERT INTO `fyt_config` VALUES ('90','site_phone','手 机','2',' ','1');
INSERT INTO `fyt_config` VALUES ('106','site_fax','公司传真','2','','1');
INSERT INTO `fyt_config` VALUES ('108','site_ywzx','业务咨询','2','','1');
INSERT INTO `fyt_config` VALUES ('109','site_rszp','人事招聘','2','','1');
INSERT INTO `fyt_config` VALUES ('52','site_name','网站名称','2','company','2');
INSERT INTO `fyt_config` VALUES ('53','site_url','网站网址','2','','2');
INSERT INTO `fyt_config` VALUES ('55','site_email','站点邮箱','2','sales@racktt.com','2');
INSERT INTO `fyt_config` VALUES ('56','seo_title','网站标题','2','','2');
INSERT INTO `fyt_config` VALUES ('57','seo_keywords','关键词','2','','2');
INSERT INTO `fyt_config` VALUES ('93','site_lxr','联系人','2','','2');
INSERT INTO `fyt_config` VALUES ('58','seo_description','网站简介','2','','2');
INSERT INTO `fyt_config` VALUES ('91','site_telephone','公司电话','2','','2');
INSERT INTO `fyt_config` VALUES ('92','site_fax','公司传真','2','','2');
INSERT INTO `fyt_config` VALUES ('94','site_address','公司地址','2','','2');
INSERT INTO `fyt_config` VALUES ('95','site_mainproducts','主营产品','2','','2');
INSERT INTO `fyt_config` VALUES ('96','site_copyright','版权所有','2','','2');
INSERT INTO `fyt_config` VALUES ('97','site_approve','ICP备案号','2','','2');
INSERT INTO `fyt_config` VALUES ('98','site_tel400','全国服务热线','2','','2');
INSERT INTO `fyt_config` VALUES ('99','site_phone','手 机','2','','2');
INSERT INTO `fyt_config` VALUES ('8','mail_type','邮件发送模式','4','1','0');
INSERT INTO `fyt_config` VALUES ('9','mail_server','邮件服务器','4','smtp.qq.com','0');
INSERT INTO `fyt_config` VALUES ('10','mail_port','邮件发送端口','4','25','0');
INSERT INTO `fyt_config` VALUES ('11','mail_from','发件人地址','4','448927359@qq.com','0');
INSERT INTO `fyt_config` VALUES ('12','mail_auth','AUTH LOGIN验证','4','1','0');
INSERT INTO `fyt_config` VALUES ('13','mail_user','验证用户名','4','448927359@qq.com','0');
INSERT INTO `fyt_config` VALUES ('14','mail_password','验证密码','4','yanxiaojun520..','0');
INSERT INTO `fyt_config` VALUES ('15','attach_maxsize','允许上传附件大小','5','5200000','0');
INSERT INTO `fyt_config` VALUES ('16','attach_allowext','允许上传附件类型','5','jpg,jpeg,gif,png,doc,docx,rar,zip,swf','0');
INSERT INTO `fyt_config` VALUES ('17','watermark_enable','是否开启图片水印','5','0','0');
INSERT INTO `fyt_config` VALUES ('18','watemard_text','水印文字内容','5','s','0');
INSERT INTO `fyt_config` VALUES ('19','watemard_text_size','文字大小','5','18','0');
INSERT INTO `fyt_config` VALUES ('20','watemard_text_color','watemard_text_color','5','#FFFFFF','0');
INSERT INTO `fyt_config` VALUES ('21','watemard_text_face','字体','5','elephant.ttf','0');
INSERT INTO `fyt_config` VALUES ('22','watermark_minwidth','图片最小宽度','5','300','0');
INSERT INTO `fyt_config` VALUES ('23','watermark_minheight','水印最小高度','5','300','0');
INSERT INTO `fyt_config` VALUES ('24','watermark_img','水印图片名称','5','','0');
INSERT INTO `fyt_config` VALUES ('25','watermark_pct','水印透明度','5','80','0');
INSERT INTO `fyt_config` VALUES ('26','watermark_quality','JPEG 水印质量','5','100','0');
INSERT INTO `fyt_config` VALUES ('27','watermark_pospadding','水印边距','5','10','0');
INSERT INTO `fyt_config` VALUES ('28','watermark_pos','水印位置','5','9','0');
INSERT INTO `fyt_config` VALUES ('29','PAGE_LISTROWS','列表分页数','6','20','0');
INSERT INTO `fyt_config` VALUES ('30','URL_MODEL','URL访问模式','6','2','0');
INSERT INTO `fyt_config` VALUES ('31','URL_PATHINFO_DEPR','参数分割符','6','/','0');
INSERT INTO `fyt_config` VALUES ('32','URL_HTML_SUFFIX','URL伪静态后缀','6','.html','0');
INSERT INTO `fyt_config` VALUES ('33','TOKEN_ON','令牌验证','6','0','0');
INSERT INTO `fyt_config` VALUES ('34','TOKEN_NAME','令牌表单字段','6','__hash__','0');
INSERT INTO `fyt_config` VALUES ('35','TMPL_CACHE_ON','模板编译缓存','6','0','0');
INSERT INTO `fyt_config` VALUES ('36','TMPL_CACHE_TIME','模板缓存有效期','6','-1','0');
INSERT INTO `fyt_config` VALUES ('37','HTML_CACHE_ON','静态缓存','6','0','0');
INSERT INTO `fyt_config` VALUES ('38','HTML_CACHE_TIME','缓存有效期','6','60','0');
INSERT INTO `fyt_config` VALUES ('39','HTML_READ_TYPE','缓存读取方式','6','0','0');
INSERT INTO `fyt_config` VALUES ('40','HTML_FILE_SUFFIX','静态文件后缀','6','.html','0');
INSERT INTO `fyt_config` VALUES ('41','ADMIN_ACCESS','ADMIN_ACCESS','6','c653a6e39a9fcdf234bb0cb01655040d','0');
INSERT INTO `fyt_config` VALUES ('42','DEFAULT_THEME','默认模板','6','Default','0');
INSERT INTO `fyt_config` VALUES ('43','HOME_ISHTML','首页生成html','6','1','0');
INSERT INTO `fyt_config` VALUES ('44','URL_URLRULE','URL','6','{$catdir}/{$catid}-{$id}.html|{$catdir}/-{$catid}-{$id}-{$page}.html:::{$catdir}.html|{$catdir}-{$catid}-{$page}.html','0');
INSERT INTO `fyt_config` VALUES ('45','DEFAULT_LANG','默认语言','6','zh-cn','0');
INSERT INTO `fyt_config` VALUES ('46','member_register','允许新会员注册','3','1','1');
INSERT INTO `fyt_config` VALUES ('47','member_emailcheck','新会员注册需要邮件验证','3','0','1');
INSERT INTO `fyt_config` VALUES ('48','member_registecheck','新会员注册需要审核','3','1','1');
INSERT INTO `fyt_config` VALUES ('49','member_login_verify','注册登陆开启验证码','3','1','1');
INSERT INTO `fyt_config` VALUES ('50','member_emailchecktpl','邮件认证模板','3',' 欢迎您注册成为[国人在线]用户，您的账号需要邮箱认证，点击下面链接进行认证：{click}\r\n或者将网址复制到浏览器：{url}','1');
INSERT INTO `fyt_config` VALUES ('51','member_getpwdemaitpl','密码找回邮件内容','3','尊敬的用户{username}，请点击进入<a href=\\\\\\\"{url}\\\\\\\">重置密码</a>,或者将网址复制到浏览器：{url}（链接3天内有效）。<br>感谢您对本站的支持。<br>　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　{sitename}<br>此邮件为系统自动邮件，无需回复。','1');
INSERT INTO `fyt_config` VALUES ('65','LAYOUT_ON','布局模板','6','1','0');
INSERT INTO `fyt_config` VALUES ('59','member_register','允许新会员注册','3','1','2');
INSERT INTO `fyt_config` VALUES ('60','member_emailcheck','新会员注册需要邮件验证','3','0','2');
INSERT INTO `fyt_config` VALUES ('61','member_registecheck','新会员注册需要审核','3','1','2');
INSERT INTO `fyt_config` VALUES ('62','member_login_verify','注册登陆开启验证码','3','1','2');
INSERT INTO `fyt_config` VALUES ('63','member_emailchecktpl','邮件认证模板','3',' 欢迎您注册成为[国人在线]用户，您的账号需要邮箱认证，点击下面链接进行认证：{click}\r\n或者将网址复制到浏览器：{url}','2');
INSERT INTO `fyt_config` VALUES ('64','member_getpwdemaitpl','密码找回邮件内容','3','尊敬的用户{username}，请点击进入<a href=\\\\\\\"{url}\\\\\\\">重置密码</a>,或者将网址复制到浏览器：{url}（链接3天内有效）。<br>感谢您对本站的支持。<br>　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　{sitename}<br>此邮件为系统自动邮件，无需回复。','2');
INSERT INTO `fyt_config` VALUES ('76','site_txz','腾讯帐号','1','http://t.qq.com/','0');
INSERT INTO `fyt_config` VALUES ('77','site_txd','腾讯地址','1','http://t.qq.com/','0');
INSERT INTO `fyt_config` VALUES ('78','site_xlz','新浪帐号','1','http://weibo.com','0');
INSERT INTO `fyt_config` VALUES ('79','site_xld','新浪地址','1','http://weibo.com','0');
INSERT INTO `fyt_config` VALUES ('80','site_tongji','统计代码','10','','0');
INSERT INTO `fyt_config` VALUES ('81','site_tjzh','用户名','10','','0');
INSERT INTO `fyt_config` VALUES ('82','site_mima','密码','10','','0');
INSERT INTO `fyt_config` VALUES ('83','site_dwangzhi','登录网址','10','http://tongji.baidu.com/web/7111513/overview/sole?siteId=4452270','0');
INSERT INTO `fyt_config` VALUES ('84','site_x','坐标x','9','114.163869','0');
INSERT INTO `fyt_config` VALUES ('85','site_y','坐标y','9','22.747551','0');
INSERT INTO `fyt_config` VALUES ('86','site_dname','地图标题','9',' ','0');
INSERT INTO `fyt_config` VALUES ('87','site_daddress','地图地址','9','','0');
INSERT INTO `fyt_config` VALUES ('88','site_dtel','地图电话','9','','0');
INSERT INTO `fyt_config` VALUES ('101','site_sjcompany','手机公司名称','11','','1');
INSERT INTO `fyt_config` VALUES ('102','site_map_address','手机公司地址','11','','1');
INSERT INTO `fyt_config` VALUES ('110','site_qrcode','首页二维码','11','','1');
INSERT INTO `fyt_config` VALUES ('111','site_wxqrcode','微信二维码','1','','0');
INSERT INTO `fyt_config` VALUES ('112','site_wzqrcode','网站二维码','1','','0');
INSERT INTO `fyt_config` VALUES ('113','site_400pic','400电话','2','','1');
INSERT INTO `fyt_config` VALUES ('114','site_logo','网站logo','2','','1');
--
-- 表的结构 `fyt_dbsource`
-- 
DROP TABLE IF EXISTS `fyt_dbsource`;
CREATE TABLE `fyt_dbsource` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `host` varchar(20) NOT NULL DEFAULT '',
  `port` int(5) NOT NULL DEFAULT '3306',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `dbname` varchar(50) NOT NULL DEFAULT '',
  `dbtablepre` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_download`
-- 
DROP TABLE IF EXISTS `fyt_download`;
CREATE TABLE `fyt_download` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `url` varchar(150) NOT NULL DEFAULT '',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `filepath` varchar(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `lang` (`id`,`status`,`lang`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_email`
-- 
DROP TABLE IF EXISTS `fyt_email`;
CREATE TABLE `fyt_email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_feedback`
-- 
DROP TABLE IF EXISTS `fyt_feedback`;
CREATE TABLE `fyt_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(20) NOT NULL DEFAULT '',
  `tel` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_field`
-- 
DROP TABLE IF EXISTS `fyt_field`;
CREATE TABLE `fyt_field` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `moduleid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `tips` varchar(150) NOT NULL DEFAULT '',
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `minlength` int(10) unsigned NOT NULL DEFAULT '0',
  `maxlength` int(10) unsigned NOT NULL DEFAULT '0',
  `pattern` varchar(255) NOT NULL DEFAULT '',
  `errormsg` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(20) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `setup` mediumtext NOT NULL,
  `ispost` tinyint(1) NOT NULL DEFAULT '0',
  `unpostgroup` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=338 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_field`表中的数据 `fyt_field`
--
INSERT INTO `fyt_field` VALUES ('1','1','title','标题','','1','3','80','','标题必填3-80个字','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'0\',\n  \'size\' => \'\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('2','1','keywords','关键词','','0','0','0','','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('3','1','description','SEO简介','','0','0','0','','','','textarea','array (\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('4','1','content','内容','','0','0','0','','','','editor','array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'\',\n  \'showpage\' => \'1\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'1\',\n  \'alowuploadexts\' => \'jpg,jpeg,gif,doc,rar,zip,xls\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('5','2','catid','栏目','','1','1','6','digits','必须选择一个栏目','','catid','','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('6','2','title','标题/问题','','1','0','0','0','标题必须为1-80个字符','','title','array (\n  \\\'thumb\\\' => \\\'1\\\',\n  \\\'style\\\' => \\\'1\\\',\n  \\\'size\\\' => \\\'55\\\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('7','2','keywords','关键词','','0','0','0','','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('8','2','description','SEO简介','','0','0','0','','','','textarea','array (\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('9','2','content','内容/回答','','0','0','0','0','','','editor','array (\n  \\\'toolbar\\\' => \\\'full\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'height\\\' => \\\'\\\',\n  \\\'show_add_description\\\' => \\\'0\\\',\n  \\\'show_auto_thumb\\\' => \\\'0\\\',\n  \\\'showpage\\\' => \\\'1\\\',\n  \\\'enablekeylink\\\' => \\\'0\\\',\n  \\\'replacenum\\\' => \\\'\\\',\n  \\\'enablesaveimage\\\' => \\\'0\\\',\n  \\\'flashupload\\\' => \\\'1\\\',\n  \\\'alowuploadexts\\\' => \\\'\\\',\n  \\\'alowuploadlimit\\\' => \\\'\\\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('10','2','createtime','发布时间','','1','0','0','','','','datetime','','1','3,4','0','1','1');
INSERT INTO `fyt_field` VALUES ('11','2','copyfrom','来源','','0','0','0','0','','','text','array (\n  \'size\' => \'20\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('12','2','fromlink','来源网址','','0','0','0','','','','text','array (\n  \'size\' => \'20\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('13','2','readgroup','访问权限','','0','0','0','','','','groupid','array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'varchar\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)','1','3,4','0','0','1');
INSERT INTO `fyt_field` VALUES ('14','2','posid','推荐位','','0','0','0','','','','posid','','1','3,4','0','1','1');
INSERT INTO `fyt_field` VALUES ('15','2','template','模板','','0','0','0','','','','template','','1','3,4','0','0','1');
INSERT INTO `fyt_field` VALUES ('16','2','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','3,4','0','1','1');
INSERT INTO `fyt_field` VALUES ('17','3','catid','栏目','','1','1','6','','必须选择一个栏目','','catid','','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('18','3','title','产品名称','','1','1','80','0','标题必须为1-80个字符','','title','array (\n  \\\'thumb\\\' => \\\'1\\\',\n  \\\'style\\\' => \\\'1\\\',\n  \\\'size\\\' => \\\'55\\\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('19','3','keywords','关键词','','0','0','80','','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('20','3','description','SEO简介','','0','0','0','','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('21','3','content','产品说明','','0','0','0','0','','','editor','array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'\',\n  \'show_add_description\' => \'0\',\n  \'show_auto_thumb\' => \'0\',\n  \'showpage\' => \'1\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'1\',\n  \'alowuploadexts\' => \'\',\n  \'alowuploadlimit\' => \'\',\n)','1','','10','1','1');
INSERT INTO `fyt_field` VALUES ('22','3','createtime','发布时间','','1','0','0','','','','datetime','','1','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('23','2','recommend','允许评论','','0','0','1','','','','radio','array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'1\',\n)','1','3,4','0','0','0');
INSERT INTO `fyt_field` VALUES ('24','3','readgroup','访问权限','','0','0','0','','','','groupid','array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)','1','3,4','96','0','1');
INSERT INTO `fyt_field` VALUES ('25','3','posid','推荐位','','0','0','0','','','','posid','','1','3,4','97','1','1');
INSERT INTO `fyt_field` VALUES ('26','3','template','模板','','0','0','0','','','','template','','1','3,4','98','0','1');
INSERT INTO `fyt_field` VALUES ('27','3','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('28','3','price','价格','','0','0','0','','','','number','array (\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'2\',\n  \'default\' => \'0\',\n)','1','','0','0','1');
INSERT INTO `fyt_field` VALUES ('29','3','recommend','允许评论','','0','0','1','','','','radio','array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)','1','3,4','0','0','0');
INSERT INTO `fyt_field` VALUES ('30','2','readpoint','阅读收费','','0','0','3','','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'\',\n)','1','3,4','0','0','0');
INSERT INTO `fyt_field` VALUES ('31','2','hits','点击次数','','0','0','8','','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'\',\n)','1','','0','0','0');
INSERT INTO `fyt_field` VALUES ('32','3','readpoint','阅读收费','','0','0','5','','','','number','array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','3,4','0','0','0');
INSERT INTO `fyt_field` VALUES ('33','3','hits','点击次数','','0','0','8','','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','','0','0','0');
INSERT INTO `fyt_field` VALUES ('34','3','pics','图片','','0','0','0','0','','','images','array (\n  \'default\' => \'\',\n  \'upload_maxnum\' => \'10\',\n  \'upload_maxsize\' => \'0.2\',\n  \'upload_allowext\' => \'jpeg,jpg,gif\',\n  \'watermark\' => \'0\',\n  \'more\' => \'1\',\n)','1','','1','1','0');
INSERT INTO `fyt_field` VALUES ('35','3','gl','关联产品','','0','0','0','0','','','guanlian','','0','','0','0','0');
INSERT INTO `fyt_field` VALUES ('36','4','catid','栏目','','1','1','6','','必须选择一个栏目','','catid','','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('37','4','title','名称','','1','1','80','0','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('38','4','keywords','关键词','','0','0','80','','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('39','4','description','SEO简介','','0','0','0','','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('40','4','content','内容','','0','0','0','0','','','editor','array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'\',\n  \'show_add_description\' => \'0\',\n  \'show_auto_thumb\' => \'0\',\n  \'showpage\' => \'1\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'1\',\n  \'alowuploadexts\' => \'\',\n  \'alowuploadlimit\' => \'\',\n)','1','','10','1','1');
INSERT INTO `fyt_field` VALUES ('41','4','createtime','发布时间','','1','0','0','','','','datetime','','1','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('44','4','hits','点击次数','','0','0','8','','','','number','array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','','0','0','0');
INSERT INTO `fyt_field` VALUES ('45','4','posid','推荐位','','0','0','0','','','','posid','','1','3,4','97','1','1');
INSERT INTO `fyt_field` VALUES ('46','4','template','模板','','0','0','0','','','','template','','1','3,4','98','1','1');
INSERT INTO `fyt_field` VALUES ('47','4','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('48','4','pics','图组','','0','0','0','','','','images','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'upload_maxnum\' => \'20\',\n  \'upload_maxsize\' => \'2\',\n  \'upload_allowext\' => \'jpeg,jpg,png,gif\',\n  \'watermark\' => \'0\',\n  \'more\' => \'1\',\n)','1','','0','0','0');
INSERT INTO `fyt_field` VALUES ('50','5','catid','栏目','','1','1','6','','必须选择一个栏目','','catid','','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('51','5','title','标题','','1','1','80','0','标题必须为1-80个字符','','title','array (\n  \\\'thumb\\\' => \\\'1\\\',\n  \\\'style\\\' => \\\'1\\\',\n  \\\'size\\\' => \\\'55\\\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('52','5','keywords','关键词','','0','0','80','','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('53','5','description','SEO简介','','0','0','0','','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('55','5','createtime','发布时间','','1','0','0','','','','datetime','','1','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('56','5','filepath','文件','','0','0','0','0','','','file','array (\n  \'size\' => \'40\',\n  \'default\' => \'\',\n  \'upload_maxsize\' => \'\',\n  \'upload_allowext\' => \'zip,rar,doc,ppt\',\n  \'more\' => \'0\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('57','5','posid','推荐位','','0','0','0','','','','posid','','1','3,4','97','1','1');
INSERT INTO `fyt_field` VALUES ('58','5','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('69','6','uname','姓名','','1','2','20','cn_username','','','text','array (\n  \'size\' => \'10\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','2','1','0');
INSERT INTO `fyt_field` VALUES ('70','6','tel','电话','','0','0','0','tel','','','text','array (\n  \'size\' => \'20\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','4','1','0');
INSERT INTO `fyt_field` VALUES ('71','6','email','邮箱','','1','0','50','email','','','text','array (\n  \'size\' => \'20\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','2','1','0');
INSERT INTO `fyt_field` VALUES ('72','6','content','内 容','','1','4','200','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'5\\\',\n  \\\'cols\\\' => \\\'60\\\',\n  \\\'default\\\' => \\\'\\\',\n)','1','','6','1','0');
INSERT INTO `fyt_field` VALUES ('74','6','title','主题','','1','4','50','0','','','text','array (\n  \'size\' => \'40\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','3,4','0','1','0');
INSERT INTO `fyt_field` VALUES ('76','6','createtime','提交时间','','0','0','0','','','','datetime','','0','3,4','98','1','0');
INSERT INTO `fyt_field` VALUES ('78','6','status','审核状态','','0','0','1','','','','radio','array (\n  \'options\' => \'己审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'0\',\n)','0','3,4','99','1','0');
INSERT INTO `fyt_field` VALUES ('79','6','verifyCode','验证码','','1','4','4','en_num','','','verify','array (\n  \\\'size\\\' => \\\'4\\\',\n)','1','','97','1','0');
INSERT INTO `fyt_field` VALUES ('81','7','status','状态','','0','0','1','','','','radio','array (\n  \'options\' => \'已审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('82','7','name','网站名称','','1','2','50','','','','text','array (\n  \'size\' => \'40\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','1','1','0');
INSERT INTO `fyt_field` VALUES ('83','7','logo','网站LOGO','','0','0','0','','','','image','array (\n  \'size\' => \'50\',\n  \'default\' => \'\',\n  \'upload_maxsize\' => \'\',\n  \'upload_allowext\' => \'jpg,jpeg,gif,png\',\n  \'watermark\' => \'0\',\n  \'more\' => \'0\',\n)','1','','2','1','0');
INSERT INTO `fyt_field` VALUES ('84','7','siteurl','网站地址','','1','10','150','url','','','text','array (\n  \'size\' => \'50\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','3','1','0');
INSERT INTO `fyt_field` VALUES ('85','7','typeid','友情链接分类','','0','0','0','','','','typeid','array (\n  \'inputtype\' => \'select\',\n  \'fieldtype\' => \'smallint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'1\',\n)','1','','0','0','0');
INSERT INTO `fyt_field` VALUES ('86','7','linktype','链接类型','','0','0','1','','','','radio','array (\n  \'options\' => \'文字链接|1\r\nLOGO链接|2\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'1\',\n)','1','','0','1','0');
INSERT INTO `fyt_field` VALUES ('87','7','siteinfo','站点简介','','0','0','0','','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'3\',\n  \'cols\' => \'60\',\n  \'default\' => \'\',\n)','1','','4','0','0');
INSERT INTO `fyt_field` VALUES ('88','8','createtime','提交时间','','1','0','0','','','','datetime','','0','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('89','8','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'已审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'0\',\n)','0','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('90','8','title','姓名','','1','2','50','0','','','text','array (\n  \\\'size\\\' => \\\'40\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','1','','0','1','0');
INSERT INTO `fyt_field` VALUES ('91','8','username','姓名','','1','2','20','','','','text','array (\n  \'size\' => \'10\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','0','0','0');
INSERT INTO `fyt_field` VALUES ('92','8','telephone','联系电话','','0','0','0','tel','','','text','array (\n  \\\'size\\\' => \\\'20\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','1','','2','1','0');
INSERT INTO `fyt_field` VALUES ('93','8','email','邮箱','','1','0','40','email','','','text','array (\n  \'size\' => \'20\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','1','0','0');
INSERT INTO `fyt_field` VALUES ('95','8','reply_content','留言内容','','0','0','0','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'4\\\',\n  \\\'cols\\\' => \\\'50\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','3,4','10','1','0');
INSERT INTO `fyt_field` VALUES ('96','8','ip','IP','','0','0','15','','','','text','array (\n  \'size\' => \'15\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','0','3,4','90','1','0');
INSERT INTO `fyt_field` VALUES ('97','8','posid','推荐位','','0','0','0','0','','','posid','','0','','10','0','0');
INSERT INTO `fyt_field` VALUES ('98','8','thumb','头像','','0','0','0','0','','','image','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'upload_maxsize\\\' => \\\'\\\',\n  \\\'upload_allowext\\\' => \\\'jpg,jpeg,gif,png\\\',\n  \\\'watermark\\\' => \\\'0\\\',\n  \\\'more\\\' => \\\'0\\\',\n)','0','','0','0','0');
INSERT INTO `fyt_field` VALUES ('99','8','content','产品的信息','','0','0','0','0','','','editor','array (\n  \\\'toolbar\\\' => \\\'basic\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'height\\\' => \\\'\\\',\n  \\\'show_add_description\\\' => \\\'0\\\',\n  \\\'show_auto_thumb\\\' => \\\'0\\\',\n  \\\'showpage\\\' => \\\'0\\\',\n  \\\'enablekeylink\\\' => \\\'0\\\',\n  \\\'replacenum\\\' => \\\'\\\',\n  \\\'enablesaveimage\\\' => \\\'0\\\',\n  \\\'flashupload\\\' => \\\'0\\\',\n  \\\'alowuploadexts\\\' => \\\'\\\',\n  \\\'alowuploadlimit\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('102','9','name','客服名称','','0','2','20','','','','text','array (\n  \'size\' => \'20\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('103','9','type','客服类型','','1','1','2','0','','','select','array (\n  \'options\' => \'QQ|1\r\nMSN|2\r\n旺旺|3\r\n贸易通|6\r\n电话|4\r\n代码|5\',\n  \'multiple\' => \'0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'size\' => \'\',\n  \'default\' => \'\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('104','9','code','ID或代码','','0','2','0','0','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'50\',\n  \'default\' => \'\',\n)','0','','10','1','0');
INSERT INTO `fyt_field` VALUES ('105','9','skin','风格样式','','0','0','3','0','','','select','array (\n  \'options\' => \'无风格图标|0\r\nQQ风格1|q1\r\nQQ风格2|q2\r\nQQ风格3|q3\r\nQQ风格4|q4\r\nQQ风格5|q5\r\nQQ风格6|q6\r\nQQ风格7|q7\r\nMSN小图|m1\r\nMSN大图1|m2\r\nMSN大图2|m3\r\nMSN大图3|m4\r\n旺旺小图|w2\r\n旺旺大图|w1\r\n贸易通|al1\',\n  \'multiple\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n  \'numbertype\' => \'1\',\n  \'size\' => \'\',\n  \'default\' => \'\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('153','15','createtime','发布时间','','1','0','0','','','','datetime','','0','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('154','15','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'已审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','0','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('155','15','title','视频标题','','0','0','0','0','','','title','array (\n  \'thumb\' => \'0\',\n  \'style\' => \'0\',\n  \'size\' => \'\',\n)','0','','1','1','0');
INSERT INTO `fyt_field` VALUES ('156','15','content','视频地址','','0','0','0','0','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'5\',\n  \'cols\' => \'60\',\n  \'default\' => \'\',\n)','0','','2','1','0');
INSERT INTO `fyt_field` VALUES ('158','15','catid','栏目','','1','0','0','0','','','catid','','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('206','20','createtime','发布时间','','1','0','0','','','','datetime','','0','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('207','20','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'已审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','0','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('227','20','cpurl','产品地址','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('209','20','title','您的姓名','','0','0','0','0','','','title','array (\n  \\\'thumb\\\' => \\\'0\\\',\n  \\\'style\\\' => \\\'0\\\',\n  \\\'size\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('210','20','sjhm','手机号码','','0','0','0','mobile','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('211','20','content','内容','','0','0','0','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'6\\\',\n  \\\'cols\\\' => \\\'60\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('212','20','verifyCode','验证码','','1','4','4','en_num','','','verify','array (\n  \\\'size\\\' => \\\'\\\',\n)','1','','0','1','0');
INSERT INTO `fyt_field` VALUES ('228','20','cpname','产品名称','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('229','20','email','邮箱','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('235','21','createtime','发布时间','','1','0','0','','','','datetime','','0','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('236','21','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'已审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','0','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('238','21','title','产品名称','','0','0','0','0','','','text','array (\n  \'size\' => \'\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('240','21','sjhm','电话','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','0','0');
INSERT INTO `fyt_field` VALUES ('241','21','email','Email','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','0','0');
INSERT INTO `fyt_field` VALUES ('242','21','verifyCode','验证码','','1','4','4','en_num','','','verify','array (\n  \\\'size\\\' => \\\'\\\',\n)','1','','1','1','0');
INSERT INTO `fyt_field` VALUES ('243','21','content','评论内容','','0','0','0','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'6\\\',\n  \\\'cols\\\' => \\\'50\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('253','23','createtime','发布时间','','1','0','0','','','','datetime','','0','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('254','23','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'已审核|1\r\n未审核|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','0','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('255','23','title','姓名','','0','0','0','0','','','title','array (\n  \\\'thumb\\\' => \\\'0\\\',\n  \\\'style\\\' => \\\'0\\\',\n  \\\'size\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('256','23','sex','性别','','0','0','0','0','','','radio','array (\n  \\\'options\\\' => \\\'男|男\r\n女|女\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n  \\\'numbertype\\\' => \\\'1\\\',\n  \\\'labelwidth\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('257','23','LinkPhone','联系电话','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('259','23','theYear','出生年月','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('260','23','IDNum','身份证号','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('261','23','Native','籍贯','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','0','0');
INSERT INTO `fyt_field` VALUES ('262','23','address','现居住地','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('263','23','Folk','毕业时间','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('264','23','Email','电邮','','0','0','0','0','','','text','','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('265','23','ComSkill','教育经历','','0','0','0','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'5\\\',\n  \\\'cols\\\' => \\\'60\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('266','23','Intro','工作经历','','0','0','0','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'5\\\',\n  \\\'cols\\\' => \\\'60\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('267','23','Grade','自我评价','','0','0','0','0','','','textarea','array (\n  \\\'fieldtype\\\' => \\\'mediumtext\\\',\n  \\\'rows\\\' => \\\'5\\\',\n  \\\'cols\\\' => \\\'60\\\',\n  \\\'default\\\' => \\\'\\\',\n)','0','','0','1','0');
INSERT INTO `fyt_field` VALUES ('268','23','jianli','简历下载','','0','0','0','0','','','text','array (\n  \\\'size\\\' => \\\'\\\',\n  \\\'default\\\' => \\\'\\\',\n  \\\'ispassword\\\' => \\\'0\\\',\n  \\\'fieldtype\\\' => \\\'varchar\\\',\n)','0','','0','0','0');
INSERT INTO `fyt_field` VALUES ('296','26','catid','栏目','','1','1','6','','必须选择一个栏目','','catid','','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('297','26','title','标题','','1','1','80','','标题必须为1-80个字符','','title','array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)','1','','0','1','1');
INSERT INTO `fyt_field` VALUES ('298','26','keywords','关键词','','0','0','80','','','','text','array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','','2','1','1');
INSERT INTO `fyt_field` VALUES ('299','26','description','SEO简介','','0','0','0','','','','textarea','array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','','3','1','1');
INSERT INTO `fyt_field` VALUES ('300','26','requirements','任职要求','','0','0','0','0','','','editor','array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'\',\n  \'show_add_description\' => \'0\',\n  \'show_auto_thumb\' => \'0\',\n  \'showpage\' => \'1\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'1\',\n  \'alowuploadexts\' => \'\',\n  \'alowuploadlimit\' => \'\',\n)','1','','12','1','1');
INSERT INTO `fyt_field` VALUES ('301','26','createtime','发布时间','','0','0','0','','','','datetime','','1','3,4','93','1','1');
INSERT INTO `fyt_field` VALUES ('337','26','education','学历','','0','0','0','0','','','text','array (\n  \'size\' => \'40\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','0','','6','1','0');
INSERT INTO `fyt_field` VALUES ('306','26','posid','推荐位','','0','0','0','','','','posid','','1','','97','1','1');
INSERT INTO `fyt_field` VALUES ('308','26','status','状态','','0','0','0','','','','radio','array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','3,4','99','1','1');
INSERT INTO `fyt_field` VALUES ('310','26','num','招聘人数','','0','0','0','0','','','text','array (\n  \'size\' => \'\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','0','','5','1','0');
INSERT INTO `fyt_field` VALUES ('311','26','jobdes','工作描述','','0','0','0','0','','','editor','array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'280\',\n  \'show_add_description\' => \'0\',\n  \'show_auto_thumb\' => \'0\',\n  \'showpage\' => \'0\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'0\',\n  \'alowuploadexts\' => \'\',\n  \'alowuploadlimit\' => \'\',\n)','0','','11','1','0');
--
-- 表的结构 `fyt_guestbook`
-- 
DROP TABLE IF EXISTS `fyt_guestbook`;
CREATE TABLE `fyt_guestbook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL DEFAULT '',
  `telephone` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `reply_content` mediumtext NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(80) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_job`
-- 
DROP TABLE IF EXISTS `fyt_job`;
CREATE TABLE `fyt_job` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(120) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `requirements` text NOT NULL,
  `url` varchar(60) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `num` varchar(255) NOT NULL DEFAULT '',
  `jobdes` text NOT NULL,
  `education` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_kefu`
-- 
DROP TABLE IF EXISTS `fyt_kefu`;
CREATE TABLE `fyt_kefu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `code` mediumtext NOT NULL,
  `skin` varchar(3) NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_kefu`表中的数据 `fyt_kefu`
--
INSERT INTO `fyt_kefu` VALUES ('1','1','0','888888888','在线客服','1','888888888','0','1');
--
-- 表的结构 `fyt_lang`
-- 
DROP TABLE IF EXISTS `fyt_lang`;
CREATE TABLE `fyt_lang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `mark` varchar(30) NOT NULL DEFAULT '',
  `flag` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `path` varchar(30) NOT NULL DEFAULT '',
  `domain` varchar(30) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_lang`表中的数据 `fyt_lang`
--
INSERT INTO `fyt_lang` VALUES ('1','中文','zh-cn','cn.gif','1','','','1');
INSERT INTO `fyt_lang` VALUES ('2','英文','en','en.gif','1','','','2');
--
-- 表的结构 `fyt_link`
-- 
DROP TABLE IF EXISTS `fyt_link`;
CREATE TABLE `fyt_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `logo` varchar(80) NOT NULL DEFAULT '',
  `siteurl` varchar(150) NOT NULL DEFAULT '',
  `typeid` smallint(5) unsigned NOT NULL,
  `linktype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `siteinfo` mediumtext NOT NULL,
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_link`表中的数据 `fyt_link`
--
INSERT INTO `fyt_link` VALUES ('1','1','0','1367131429','国人伟业','','http://www.grwy.net','0','1','','2');
INSERT INTO `fyt_link` VALUES ('2','1','0','1397102236','深圳网站建设','','http://www.grwy.net','0','1','','1');
--
-- 表的结构 `fyt_menu`
-- 
DROP TABLE IF EXISTS `fyt_menu`;
CREATE TABLE `fyt_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `model` char(20) NOT NULL DEFAULT '',
  `action` char(20) NOT NULL DEFAULT '',
  `data` char(50) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parentid`),
  KEY `model` (`model`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_menu`表中的数据 `fyt_menu`
--
INSERT INTO `fyt_menu` VALUES ('1','0','index','main','menuid=42','1','1','0','控制面板','','0');
INSERT INTO `fyt_menu` VALUES ('122','0','config','index','','1','1','0','系统设置','','0');
INSERT INTO `fyt_menu` VALUES ('124','122','config','mail','','1','1','0','邮箱设置','','0');
INSERT INTO `fyt_menu` VALUES ('125','122','config','member','','1','1','0','会员设置','','0');
INSERT INTO `fyt_menu` VALUES ('126','122','user','index','','1','1','0','管理员设置','','0');
INSERT INTO `fyt_menu` VALUES ('127','122','role','index','','1','1','0','角色管理','','0');
INSERT INTO `fyt_menu` VALUES ('39','2','menu','','','1','1','0','后台管理菜单','后台管理菜单','11');
INSERT INTO `fyt_menu` VALUES ('15','39','Menu','add','','1','1','0','添加菜单','','0');
INSERT INTO `fyt_menu` VALUES ('128','122','index','cache','','1','1','0','更新缓存','','0');
INSERT INTO `fyt_menu` VALUES ('22','3','product','','','1','1','0','产品管理','','3');
INSERT INTO `fyt_menu` VALUES ('8','50','Config','sys','','1','1','0','系统参数','','0');
INSERT INTO `fyt_menu` VALUES ('32','50','Config','member','','1','1','0','用户中心设置','','0');
INSERT INTO `fyt_menu` VALUES ('59','50','Config','add','','1','1','0','添加系统变量','','99');
INSERT INTO `fyt_menu` VALUES ('9','5','User','','','1','1','0','会员资料管理','','0');
INSERT INTO `fyt_menu` VALUES ('10','9','User','add','','1','1','0','添加会员','','0');
INSERT INTO `fyt_menu` VALUES ('11','5','Role','','','1','1','0','会员组管理','','0');
INSERT INTO `fyt_menu` VALUES ('12','11','Role','add','','1','1','0','添加会员组','','0');
INSERT INTO `fyt_menu` VALUES ('13','5','Node','','','1','1','0','权限节点管理','','0');
INSERT INTO `fyt_menu` VALUES ('14','13','Node','add','','1','1','0','添加权限节点','','0');
INSERT INTO `fyt_menu` VALUES ('130','122','database','index','','1','1','0','数据库备份','','0');
INSERT INTO `fyt_menu` VALUES ('17','3','category','','','1','1','0','栏目管理','栏目管理','1');
INSERT INTO `fyt_menu` VALUES ('18','16','module','add','','1','1','0','添加模型','','0');
INSERT INTO `fyt_menu` VALUES ('19','17','Category','add','','1','1','0','添加栏目','','0');
INSERT INTO `fyt_menu` VALUES ('20','3','article','','','1','1','0','文章管理','','2');
INSERT INTO `fyt_menu` VALUES ('21','20','Article','add','','1','1','0','添加文章','','0');
INSERT INTO `fyt_menu` VALUES ('24','23','Posid','add','','1','1','0','添加推荐位','','0');
INSERT INTO `fyt_menu` VALUES ('25','22','Product','add','','1','1','0','添加产品','','0');
INSERT INTO `fyt_menu` VALUES ('26','3','Picture','','','1','0','0','相册管理','','4');
INSERT INTO `fyt_menu` VALUES ('27','3','Download','','','1','0','0','下载管理','','5');
INSERT INTO `fyt_menu` VALUES ('28','2','Type','','','1','1','0','类别管理','','6');
INSERT INTO `fyt_menu` VALUES ('29','50','Config','mail','','1','1','0','系统邮箱','','0');
INSERT INTO `fyt_menu` VALUES ('30','50','Config','attach','','1','1','0','附件配置','','0');
INSERT INTO `fyt_menu` VALUES ('31','17','Category','repair_cache','','1','1','0','恢复栏目数据','','0');
INSERT INTO `fyt_menu` VALUES ('33','6','Createhtml','index','','1','1','0','更新首页','','0');
INSERT INTO `fyt_menu` VALUES ('34','6','Createhtml','Createlist','','1','1','0','更新列表页','','0');
INSERT INTO `fyt_menu` VALUES ('35','6','Createhtml','Createshow','','1','1','0','更新内容页','','0');
INSERT INTO `fyt_menu` VALUES ('36','6','Createhtml','Updateurl','','1','1','0','更新内容页url','','0');
INSERT INTO `fyt_menu` VALUES ('37','26','Picture','add','','1','1','0','添加图片','','0');
INSERT INTO `fyt_menu` VALUES ('38','27','Download','add','','1','1','0','添加文件','','0');
INSERT INTO `fyt_menu` VALUES ('40','1','index','password','','1','1','0','修改密码','','2');
INSERT INTO `fyt_menu` VALUES ('41','1','index','profile','','1','1','0','个人资料','','3');
INSERT INTO `fyt_menu` VALUES ('42','1','index','def','','1','1','0','后台首页','','1');
INSERT INTO `fyt_menu` VALUES ('43','17','Category','add','&type=1','1','1','0','添加外部链接','','0');
INSERT INTO `fyt_menu` VALUES ('44','2','Database','','','1','1','0','数据库管理','','0');
INSERT INTO `fyt_menu` VALUES ('45','44','Database','query','','1','1','0','执行SQL语句','','0');
INSERT INTO `fyt_menu` VALUES ('46','44','Database','recover','','1','1','0','恢复数据库','','0');
INSERT INTO `fyt_menu` VALUES ('48','51','Module','add','type=2','1','1','0','创建模块','','0');
INSERT INTO `fyt_menu` VALUES ('49','3','Feedback','index','','1','0','0','信息反馈','信息反馈','7');
INSERT INTO `fyt_menu` VALUES ('51','4','module','index','type=2','1','1','0','模块管理','','0');
INSERT INTO `fyt_menu` VALUES ('52','28','Type','add','','1','1','0','添加类别','','0');
INSERT INTO `fyt_menu` VALUES ('53','4','link','index','sort=desc','1','1','0','友情链接','','0');
INSERT INTO `fyt_menu` VALUES ('54','53','Link','add','','1','1','0','添加链接','','0');
INSERT INTO `fyt_menu` VALUES ('55','3','guestbook','index','','1','1','0','在线留言','','8');
INSERT INTO `fyt_menu` VALUES ('56','4','kefu','index','sort=asc','1','1','0','在线客服','','0');
INSERT INTO `fyt_menu` VALUES ('57','56','Kefu','add','','1','1','0','添加客服','','0');
INSERT INTO `fyt_menu` VALUES ('58','4','Order','index','','1','0','0','订单管理','','0');
INSERT INTO `fyt_menu` VALUES ('60','7','Template','index','','1','1','0','模板管理','','0');
INSERT INTO `fyt_menu` VALUES ('61','60','Template','add','','1','1','0','添加模板','','0');
INSERT INTO `fyt_menu` VALUES ('62','60','Template','index','type=css','1','1','0','CSS管理','','0');
INSERT INTO `fyt_menu` VALUES ('63','60','Template','index','type=js','1','1','0','JS管理','','0');
INSERT INTO `fyt_menu` VALUES ('64','60','Template','images','','1','1','0','媒体文件管理','','0');
INSERT INTO `fyt_menu` VALUES ('65','7','Theme','index','menuid=65','1','0','0','风格管理','','0');
INSERT INTO `fyt_menu` VALUES ('66','65','Theme','upload','','1','1','0','上传风格','','0');
INSERT INTO `fyt_menu` VALUES ('129','122','createhtml','updateurl','','1','1','0','更新伪静态','','0');
INSERT INTO `fyt_menu` VALUES ('68','67','Urlrule','add','','1','1','0','添加规则','','0');
INSERT INTO `fyt_menu` VALUES ('70','69','Dbsource','add','','1','1','0','添加数据源','','0');
INSERT INTO `fyt_menu` VALUES ('71','2','Lang','index','','1','1','0','多语言管理','语言管理','0');
INSERT INTO `fyt_menu` VALUES ('72','71','Lang','add','','1','1','0','添加语言','','0');
INSERT INTO `fyt_menu` VALUES ('73','71','Lang','param','','1','1','0','设置语言包','','0');
INSERT INTO `fyt_menu` VALUES ('74','7','Block','index','','1','1','0','碎片管理','','0');
INSERT INTO `fyt_menu` VALUES ('75','74','Block','add','','1','1','0','添加碎片','','0');
INSERT INTO `fyt_menu` VALUES ('76','60','Template','config','','1','1','0','模板参数配置','','0');
INSERT INTO `fyt_menu` VALUES ('77','7','slide','index','','1','1','0','广告管理','','0');
INSERT INTO `fyt_menu` VALUES ('78','77','Slide','add','','1','1','0','添加广告位','','0');
INSERT INTO `fyt_menu` VALUES ('79','4','Payment','index','','1','0','0','在线支付','','0');
INSERT INTO `fyt_menu` VALUES ('80','79','Shipping','','','1','1','0','配送方式','','0');
INSERT INTO `fyt_menu` VALUES ('81','79','Shipping','add','isajax=1','1','1','0','添加配送方式','','0');
INSERT INTO `fyt_menu` VALUES ('82','58','Order','orderlist','','1','1','0','单据管理','','0');
INSERT INTO `fyt_menu` VALUES ('93','3','Vsp','index','','1','0','0','视频模型','','9');
INSERT INTO `fyt_menu` VALUES ('94','93','Vsp','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('102','22','Product','import','','1','1','0','导入数据','','0');
INSERT INTO `fyt_menu` VALUES ('103','22','Product','batch','','1','1','0','批量上传','','0');
INSERT INTO `fyt_menu` VALUES ('104','3','申请加盟','index','','1','1','0','join','','9');
INSERT INTO `fyt_menu` VALUES ('105','104','申请加盟','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('106','3','message','index','','1','1','0','留言','','9');
INSERT INTO `fyt_menu` VALUES ('107','106','message','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('108','3','vip','index','','1','1','0','产品评论','','9');
INSERT INTO `fyt_menu` VALUES ('109','108','vip','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('110','3','xinwen','index','','1','1','0','新闻评论','','9');
INSERT INTO `fyt_menu` VALUES ('111','110','xinwen','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('112','3','jianli','index','','1','1','0','简历模型','','9');
INSERT INTO `fyt_menu` VALUES ('114','3','zhanzhang','index','','1','1','0','站长工具','','9');
INSERT INTO `fyt_menu` VALUES ('115','114','zhanzhang','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('131','0','category','index','','1','1','0','内容展示','','0');
INSERT INTO `fyt_menu` VALUES ('117','116','weibo','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('118','3','down','index','','1','1','0','下载模型','','9');
INSERT INTO `fyt_menu` VALUES ('119','118','down','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('120','3','jobs','index','','1','1','0','招聘模型','','9');
INSERT INTO `fyt_menu` VALUES ('121','120','jobs','add','','1','1','0','添加信息','','9');
INSERT INTO `fyt_menu` VALUES ('132','131','category','index','','1','1','0','导航设置','','0');
INSERT INTO `fyt_menu` VALUES ('133','131','page','index','','1','1','0','单页管理','','0');
INSERT INTO `fyt_menu` VALUES ('134','131','product','index','','1','1','0','产品列表','','0');
INSERT INTO `fyt_menu` VALUES ('135','131','news','index','','1','1','0','新闻列表','','0');
INSERT INTO `fyt_menu` VALUES ('136','131','picture','index','','1','1','0','图片列表','','0');
INSERT INTO `fyt_menu` VALUES ('137','131','download','index','','1','1','0','下载管理','','0');
INSERT INTO `fyt_menu` VALUES ('138','131','job','index','','1','1','0','招聘管理','','0');
INSERT INTO `fyt_menu` VALUES ('139','131','block','index','','1','1','0','碎片管理','','0');
INSERT INTO `fyt_menu` VALUES ('140','0','slide','index','','1','1','0','插件管理','','0');
INSERT INTO `fyt_menu` VALUES ('141','140','slide','index','','1','1','0','幻灯管理','','0');
INSERT INTO `fyt_menu` VALUES ('142','140','link','index','','1','1','0','友情接件','','0');
INSERT INTO `fyt_menu` VALUES ('143','140','config','ditu','','1','1','0','电子地图','','0');
INSERT INTO `fyt_menu` VALUES ('144','140','resume','index','','1','1','0','简历列表','','0');
INSERT INTO `fyt_menu` VALUES ('145','140','createhtml','createsitemap','','1','1','0','网站地图生成','','0');
INSERT INTO `fyt_menu` VALUES ('146','0','kefu','index','','1','1','0','运营管理','','0');
INSERT INTO `fyt_menu` VALUES ('147','146','kefu','index','','1','1','0','客服设置','','0');
INSERT INTO `fyt_menu` VALUES ('148','146','feedback','index','','1','1','0','客户留言','','0');
INSERT INTO `fyt_menu` VALUES ('149','146','config','liul','','1','1','0','流量监控','','0');
INSERT INTO `fyt_menu` VALUES ('150','146','config','shoulu','','1','1','0','搜索引擎登陆','','0');
INSERT INTO `fyt_menu` VALUES ('151','146','member','index','','1','1','0','会员管理','','0');
INSERT INTO `fyt_menu` VALUES ('152','0','config','shouji','','1','1','0','手机网站','','0');
INSERT INTO `fyt_menu` VALUES ('153','152','config','index','','1','1','0','基本设置','','0');
INSERT INTO `fyt_menu` VALUES ('154','152','wapcategory','index','','1','1','0','导航菜单','','0');
INSERT INTO `fyt_menu` VALUES ('155','152','template','edit','','1','1','0','公司优势','','0');
INSERT INTO `fyt_menu` VALUES ('156','123','aa','aa','aaa','1','1','0','aa','','0');
--
-- 表的结构 `fyt_message`
-- 
DROP TABLE IF EXISTS `fyt_message`;
CREATE TABLE `fyt_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `urll` varchar(150) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `sjhm` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `cpurl` varchar(255) NOT NULL DEFAULT '',
  `cpname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_module`
-- 
DROP TABLE IF EXISTS `fyt_module`;
CREATE TABLE `fyt_module` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listfields` varchar(255) NOT NULL DEFAULT '',
  `setup` mediumtext NOT NULL,
  `listorder` smallint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `postgroup` varchar(100) NOT NULL DEFAULT '',
  `ispost` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_module`表中的数据 `fyt_module`
--
INSERT INTO `fyt_module` VALUES ('1','单页类型','Page','单页类型','1','1','0','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('2','文章/问题','Article','文章/问题','1','1','1','id,catid,url,copyfrom,title,title_style,content,userid,username,hits,keywords,description,thumb,createtime,status,listorder','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('3','产品模型','Product','产品类型','1','1','1','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('4','图片模型','Picture','图片模型','1','1','1','id,catid,url,title,title_style,userid,username,content,hits,keywords,description,thumb,createtime,status,listorder','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('5','下载模型','Download','下载模型','1','1','1','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('6','在线留言','Feedback','在线留言','1','0','0','*','','0','1','3','0');
INSERT INTO `fyt_module` VALUES ('7','友情链接','Link','友情链接','2','0','0','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('8','特殊定制','Guestbook','特殊定制','1','0','0','*','','0','0','3','0');
INSERT INTO `fyt_module` VALUES ('9','在线客服','Kefu','在线客服','2','0','0','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('15','视频模型','Vsp','视频模型','1','0','0','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('20','产品订单','Message','产品订单','1','0','0','*','','0','0','','1');
INSERT INTO `fyt_module` VALUES ('21','产品评论','Vip','产品评论','1','0','0','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('23','简历类型','Resume','简历类型','1','0','0','*','','0','1','','0');
INSERT INTO `fyt_module` VALUES ('26','招聘模型','Job','招聘模型','1','0','0','*','','0','0','','0');
--
-- 表的结构 `fyt_node`
-- 
DROP TABLE IF EXISTS `fyt_node`;
CREATE TABLE `fyt_node` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`status`,`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=272 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_node`表中的数据 `fyt_node`
--
INSERT INTO `fyt_node` VALUES ('1','Admin','后台管理','1','后台项目','0','0','1','0');
INSERT INTO `fyt_node` VALUES ('188','mail','邮箱设置','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('3','config','站点配置','1','','0','1','2','2');
INSERT INTO `fyt_node` VALUES ('4','index','站点配置','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('5','sys','系统参数','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('6','member','用户中心','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('160','add','增加变量','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('11','index','默认动作','1','','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('12','Public','全局操作','1','','0','1','2','0');
INSERT INTO `fyt_node` VALUES ('13','index','默认','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('14','add','添加','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('15','edit','编辑','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('16','insert','插入','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('17','attach','附件设置','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('18','mail','系统邮箱','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('21','update','更新','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('22','status','状态','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('23','deleteall','批量删除','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('24','delete','删除','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('25','listorder','排序','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('26','password','修改密码','1','','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('27','profile','个人资料','1','','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('28','cache','更新缓存','1','','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('30','main','系统信息','1','','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('40','Urlrule','URL规则','1','','0','1','2','2');
INSERT INTO `fyt_node` VALUES ('187','index','基本设置','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('55','Type','类别管理','1','','0','1','2','2');
INSERT INTO `fyt_node` VALUES ('183','index','默认动作','1','','0','181','3','1');
INSERT INTO `fyt_node` VALUES ('75','database','数据库管理','1','','0','1','2','2');
INSERT INTO `fyt_node` VALUES ('76','docommand','优化操作','1','','0','75','3','2');
INSERT INTO `fyt_node` VALUES ('77','backup','备份','1','','0','75','3','2');
INSERT INTO `fyt_node` VALUES ('78','recover','恢复','1','','0','75','3','2');
INSERT INTO `fyt_node` VALUES ('182','profile','修改个人信息','1','','0','181','3','1');
INSERT INTO `fyt_node` VALUES ('81','category','栏目管理','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('88','repair_cache','修复栏目数据','1','','0','81','3','3');
INSERT INTO `fyt_node` VALUES ('185','config','系统设置','0','','0','0','1','122');
INSERT INTO `fyt_node` VALUES ('184','password','修改密码','1','','0','181','3','1');
INSERT INTO `fyt_node` VALUES ('107','page','单页模型','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('110','article','文章模型','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('111','product','产品模型','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('112','picture','图片模型','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('113','download','下载模型','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('114','feedback','信息反馈','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('115','guestbook','在线留言','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('116','Link','友情链接','1','','0','1','2','4');
INSERT INTO `fyt_node` VALUES ('117','Kefu','在线客服','1','','0','1','2','4');
INSERT INTO `fyt_node` VALUES ('177','index','aaaa','1','','0','3','3','0');
INSERT INTO `fyt_node` VALUES ('178','sssssss','ssssssssssssssssss','1','','0','0','1','146');
INSERT INTO `fyt_node` VALUES ('174','index',' 后台首页','1','','0','0','1','1');
INSERT INTO `fyt_node` VALUES ('121','User','会员管理','1','','0','1','2','5');
INSERT INTO `fyt_node` VALUES ('123','Node','节点管理','1','','0','1','2','5');
INSERT INTO `fyt_node` VALUES ('179','sdfdsfs','dsfdsfs','1','','0','114','3','152');
INSERT INTO `fyt_node` VALUES ('125','Createhtml','网站更新','1','','0','1','2','6');
INSERT INTO `fyt_node` VALUES ('126','Template','模板管理','1','','0','1','2','7');
INSERT INTO `fyt_node` VALUES ('186','config','系统设置','1','','0','1','2','122');
INSERT INTO `fyt_node` VALUES ('128','block','碎片管理','1','','0','1','2','7');
INSERT INTO `fyt_node` VALUES ('129','slide','幻灯片管理','1','','0','1','2','7');
INSERT INTO `fyt_node` VALUES ('130','show','查看订单','1','','0','118','3','4');
INSERT INTO `fyt_node` VALUES ('131','index','更新首页','1','','0','125','3','6');
INSERT INTO `fyt_node` VALUES ('132','docreateindex','生成首页','1','','0','125','3','6');
INSERT INTO `fyt_node` VALUES ('133','createlist','更新列表页','1','','0','125','3','6');
INSERT INTO `fyt_node` VALUES ('134','createshow','更新内容页','1','','0','125','3','6');
INSERT INTO `fyt_node` VALUES ('135','updateurl','更新url','1','','0','125','3','6');
INSERT INTO `fyt_node` VALUES ('175','aaa','aaaa','0','','0','3','3','1');
INSERT INTO `fyt_node` VALUES ('176','首页幻灯','aaa','0','','0','0','1','0');
INSERT INTO `fyt_node` VALUES ('138','doUpdateurl','生成url','1','','0','125','3','6');
INSERT INTO `fyt_node` VALUES ('139','statusallok','批量审核','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('140','images','媒体文件','1','','0','126','3','7');
INSERT INTO `fyt_node` VALUES ('141','config','模板参数','1','','0','126','3','7');
INSERT INTO `fyt_node` VALUES ('142','index','列表','1','','0','127','3','7');
INSERT INTO `fyt_node` VALUES ('143','chose','更换','1','','0','127','3','7');
INSERT INTO `fyt_node` VALUES ('144','upload','上传风格','1','','0','127','3','7');
INSERT INTO `fyt_node` VALUES ('145','picmanage','图片管理','1','','0','129','3','7');
INSERT INTO `fyt_node` VALUES ('146','addpic','添加图片','1','','0','129','3','7');
INSERT INTO `fyt_node` VALUES ('147','editpic','编辑图片','1','','0','129','3','7');
INSERT INTO `fyt_node` VALUES ('148','insertpic','插入图片','1','','0','129','3','7');
INSERT INTO `fyt_node` VALUES ('149','updatepic','更新图片','1','','0','129','3','7');
INSERT INTO `fyt_node` VALUES ('150','listorder','图片排序','1','','0','129','3','7');
INSERT INTO `fyt_node` VALUES ('151','attachment','附件管理','1','','0','1','2','0');
INSERT INTO `fyt_node` VALUES ('152','index','默认操作','1','','0','151','3','0');
INSERT INTO `fyt_node` VALUES ('153','upload','上传文件','1','','0','151','3','0');
INSERT INTO `fyt_node` VALUES ('154','filelist','浏览文件','1','','0','151','3','0');
INSERT INTO `fyt_node` VALUES ('155','delfile','删除文件','1','','0','151','3','0');
INSERT INTO `fyt_node` VALUES ('156','cleanfile','清理文件','1','','0','151','3','0');
INSERT INTO `fyt_node` VALUES ('158','testmail','邮件测试','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('157','dosite','保存配置','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('159','Menu','菜单管理','1','','0','1','2','2');
INSERT INTO `fyt_node` VALUES ('180','sfsdfs','sfsdf','0','','0','55','3','122');
INSERT INTO `fyt_node` VALUES ('162','vsp','视频模型','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('163','def','后台logo','1','后台logo','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('164','ajax_content_insert','增加','1','','0','12','3','0');
INSERT INTO `fyt_node` VALUES ('165','seo','SEO','1','','0','81','3','3');
INSERT INTO `fyt_node` VALUES ('173','shouji','手机站','1','','0','3','3','2');
INSERT INTO `fyt_node` VALUES ('167','qr','二维码','1','','0','2','3','1');
INSERT INTO `fyt_node` VALUES ('168','ajax_one_insert','顶级栏目','1','','0','81','3','3');
INSERT INTO `fyt_node` VALUES ('169','ajax_insert','加子栏目','1','','0','81','3','3');
INSERT INTO `fyt_node` VALUES ('181','index','后台首页','1','','0','1','2','1');
INSERT INTO `fyt_node` VALUES ('171','message','留言列表','1','','0','1','2','3');
INSERT INTO `fyt_node` VALUES ('189','member','会员设置','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('190','user','用户管理','1','','0','1','2','122');
INSERT INTO `fyt_node` VALUES ('191','add','添加','1','','0','190','3','122');
INSERT INTO `fyt_node` VALUES ('192','edit','编辑','1','','0','190','3','122');
INSERT INTO `fyt_node` VALUES ('193','delete','删除','1','','0','190','3','122');
INSERT INTO `fyt_node` VALUES ('194','role','角色管理','1','','0','1','2','122');
INSERT INTO `fyt_node` VALUES ('195','add','添加','1','','0','194','3','122');
INSERT INTO `fyt_node` VALUES ('196','edit','编辑','1','','0','194','3','122');
INSERT INTO `fyt_node` VALUES ('197','delete','删除','1','','0','194','3','122');
INSERT INTO `fyt_node` VALUES ('198','index','控制面板','1','','0','1','2','122');
INSERT INTO `fyt_node` VALUES ('199','cache','清除缓存','0','','0','0','1','122');
INSERT INTO `fyt_node` VALUES ('200','cache','去除缓存','1','','0','198','3','122');
INSERT INTO `fyt_node` VALUES ('201','createhtml','网站更新','1','','0','1','2','122');
INSERT INTO `fyt_node` VALUES ('202','updateurl','更新伪静态','1','','0','201','3','122');
INSERT INTO `fyt_node` VALUES ('203','database','数据库','1','','0','1','2','122');
INSERT INTO `fyt_node` VALUES ('204','index','默认','1','','0','203','3','122');
INSERT INTO `fyt_node` VALUES ('205','backup','备份','1','','0','203','3','122');
INSERT INTO `fyt_node` VALUES ('206','category','导航设置','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('207','index','默认动作','1','','0','206','3','131');
INSERT INTO `fyt_node` VALUES ('208','add','添加','1','','0','206','3','131');
INSERT INTO `fyt_node` VALUES ('209','edit','编辑','1','','0','206','3','131');
INSERT INTO `fyt_node` VALUES ('210','delete','删除','1','','0','206','3','131');
INSERT INTO `fyt_node` VALUES ('211','page','单页管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('212','index','默认动作','1','','0','211','3','131');
INSERT INTO `fyt_node` VALUES ('213','add','添加','1','','0','211','3','131');
INSERT INTO `fyt_node` VALUES ('214','edit','编辑','1','','0','211','3','131');
INSERT INTO `fyt_node` VALUES ('215','product','产品管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('216','index','默认动作','1','','0','215','3','131');
INSERT INTO `fyt_node` VALUES ('217','add','添加','1','','0','215','3','131');
INSERT INTO `fyt_node` VALUES ('218','edit','编辑','1','','0','215','3','131');
INSERT INTO `fyt_node` VALUES ('219','delete','删除','1','','0','215','3','131');
INSERT INTO `fyt_node` VALUES ('220','article','新闻管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('221','index','默认','1','','0','220','3','131');
INSERT INTO `fyt_node` VALUES ('222','add','添加','1','','0','220','3','131');
INSERT INTO `fyt_node` VALUES ('223','edit','编辑','1','','0','220','3','131');
INSERT INTO `fyt_node` VALUES ('224','delete','删除','1','','0','220','3','131');
INSERT INTO `fyt_node` VALUES ('225','picture','图片管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('226','add','添加','1','','0','225','3','131');
INSERT INTO `fyt_node` VALUES ('227','index','默认动作','1','\r\n','0','225','3','131');
INSERT INTO `fyt_node` VALUES ('228','edit','编辑','1','','0','225','3','131');
INSERT INTO `fyt_node` VALUES ('229','delete','删除','1','','0','225','3','131');
INSERT INTO `fyt_node` VALUES ('230','download','下载管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('231','index','默认动作','1','','0','230','3','131');
INSERT INTO `fyt_node` VALUES ('232','add','添加','1','','0','230','3','131');
INSERT INTO `fyt_node` VALUES ('233','edit','编辑','1','','0','230','3','131');
INSERT INTO `fyt_node` VALUES ('234','delete','删除','1','','0','230','3','131');
INSERT INTO `fyt_node` VALUES ('235','slide','幻灯管理','1','','0','0','1','140');
INSERT INTO `fyt_node` VALUES ('236','slide','幻灯管理','1','','0','1','2','140');
INSERT INTO `fyt_node` VALUES ('237','link','友情链接','1','','0','1','2','140');
INSERT INTO `fyt_node` VALUES ('238','resume','简历管理','1','','0','1','2','140');
INSERT INTO `fyt_node` VALUES ('239','kefu','客服设置','1','','0','1','2','146');
INSERT INTO `fyt_node` VALUES ('240','feedback','留言管理','1','','0','1','2','146');
INSERT INTO `fyt_node` VALUES ('241','member','会员管理','1','','0','1','2','146');
INSERT INTO `fyt_node` VALUES ('242','wabcategory','导航菜单','1','','0','0','1','152');
INSERT INTO `fyt_node` VALUES ('243','wapcategory','导航菜单','1','','0','1','2','152');
INSERT INTO `fyt_node` VALUES ('244','shouji','手机设置','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('245','template','模板管理','1','','0','1','2','152');
INSERT INTO `fyt_node` VALUES ('246','add','添加','1','','0','245','3','152');
INSERT INTO `fyt_node` VALUES ('247','index','默认动作','1','','0','245','3','152');
INSERT INTO `fyt_node` VALUES ('248','edit','编辑','1','','0','245','3','152');
INSERT INTO `fyt_node` VALUES ('249','dosite','修改','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('250','job','招聘管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('251','block','碎片管理','1','','0','1','2','131');
INSERT INTO `fyt_node` VALUES ('252','recover','备份列表','1','','0','203','3','122');
INSERT INTO `fyt_node` VALUES ('253','download','下载','1','','0','203','3','122');
INSERT INTO `fyt_node` VALUES ('254','index','默认动作','1','','0','236','3','140');
INSERT INTO `fyt_node` VALUES ('255','add','添加','1','','0','236','3','140');
INSERT INTO `fyt_node` VALUES ('256','picmanage','图片管理','1','','0','236','3','140');
INSERT INTO `fyt_node` VALUES ('257','editpic','编辑图片','1','','0','236','3','140');
INSERT INTO `fyt_node` VALUES ('258','updatepic','更新幻灯','1','','0','236','3','140');
INSERT INTO `fyt_node` VALUES ('259','cache','跟新缓存','1','','0','181','3','1');
INSERT INTO `fyt_node` VALUES ('260','liul','流量监控','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('261','ditu','电子地图','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('262','addpic','添加图片','1','','0','236','3','140');
INSERT INTO `fyt_node` VALUES ('263','shoulu','搜索引擎登陆','1','','0','181','3','1');
INSERT INTO `fyt_node` VALUES ('264','createsitemap','生成网站地图','1','','0','201','3','122');
INSERT INTO `fyt_node` VALUES ('265','docreatesitemap','生成网站地图','1','','0','201','3','122');
INSERT INTO `fyt_node` VALUES ('266','weibo','微博设置','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('267','weixin','微信设置','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('268','delete','删除','1','','0','203','3','122');
INSERT INTO `fyt_node` VALUES ('269','tags','标签管理','1','','0','1','2','146');
INSERT INTO `fyt_node` VALUES ('270','qr','网站二维码','1','','0','186','3','122');
INSERT INTO `fyt_node` VALUES ('271','email','邮件营销','1','','0','1','2','146');
--
-- 表的结构 `fyt_online`
-- 
DROP TABLE IF EXISTS `fyt_online`;
CREATE TABLE `fyt_online` (
  `sessionid` char(32) NOT NULL,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL,
  `lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sessionid`),
  KEY `lastvisit` (`lastvisit`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_online`表中的数据 `fyt_online`
--
INSERT INTO `fyt_online` VALUES ('e90051b275a81c68fd65d680f8f17b1d','0','','183.37.10.54','1414373119','4');
--
-- 表的结构 `fyt_order`
-- 
DROP TABLE IF EXISTS `fyt_order`;
CREATE TABLE `fyt_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sn` bigint(19) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `consignee` varchar(60) NOT NULL DEFAULT '',
  `country` smallint(5) unsigned NOT NULL DEFAULT '0',
  `province` smallint(5) unsigned NOT NULL DEFAULT '0',
  `city` smallint(5) unsigned NOT NULL DEFAULT '0',
  `area` smallint(5) unsigned NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL DEFAULT '',
  `zipcode` varchar(60) NOT NULL DEFAULT '',
  `tel` varchar(60) NOT NULL DEFAULT '',
  `mobile` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `shipping_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `shipping_name` varchar(120) NOT NULL DEFAULT '',
  `shipping_sn` varchar(100) NOT NULL DEFAULT '',
  `pay_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pay_name` varchar(120) NOT NULL DEFAULT '',
  `pay_code` varchar(120) NOT NULL DEFAULT '',
  `amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `pay_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `shipping_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `insure_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `invoice_fee` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0',
  `shipping_time` int(10) unsigned NOT NULL DEFAULT '0',
  `accept_time` int(10) unsigned NOT NULL DEFAULT '0',
  `confirm_time` int(10) unsigned NOT NULL DEFAULT '0',
  `point` int(5) unsigned NOT NULL DEFAULT '0',
  `invoice` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `invoice_title` varchar(100) NOT NULL DEFAULT '',
  `postmessage` varchar(255) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`),
  KEY `userid` (`userid`),
  KEY `status` (`status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `pay_status` (`pay_status`),
  KEY `shipping_id` (`shipping_id`),
  KEY `pay_id` (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_order_data`
-- 
DROP TABLE IF EXISTS `fyt_order_data`;
CREATE TABLE `fyt_order_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `moduleid` smallint(3) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_thumb` varchar(120) NOT NULL DEFAULT '',
  `product_name` varchar(120) NOT NULL DEFAULT '',
  `product_url` varchar(120) NOT NULL DEFAULT '',
  `product_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr` text NOT NULL,
  `goods_attr_id` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isgift` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `userid` (`userid`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_page`
-- 
DROP TABLE IF EXISTS `fyt_page`;
CREATE TABLE `fyt_page` (
  `id` smallint(5) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(250) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `template` varchar(30) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_payment`
-- 
DROP TABLE IF EXISTS `fyt_payment`;
CREATE TABLE `fyt_payment` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `pay_code` varchar(20) NOT NULL DEFAULT '',
  `pay_name` varchar(120) NOT NULL DEFAULT '',
  `pay_fee` varchar(10) NOT NULL DEFAULT '0',
  `pay_fee_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pay_desc` text NOT NULL,
  `pay_config` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_cod` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_online` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `author` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pay_code` (`pay_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_picture`
-- 
DROP TABLE IF EXISTS `fyt_picture`;
CREATE TABLE `fyt_picture` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` varchar(120) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `url` varchar(150) NOT NULL DEFAULT '',
  `template` varchar(40) NOT NULL DEFAULT '',
  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `pics` mediumtext NOT NULL,
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `lang` (`id`,`status`,`lang`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_posid`
-- 
DROP TABLE IF EXISTS `fyt_posid`;
CREATE TABLE `fyt_posid` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `listorder` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_posid`表中的数据 `fyt_posid`
--
INSERT INTO `fyt_posid` VALUES ('1','首页推荐','0');
INSERT INTO `fyt_posid` VALUES ('2','首页热门','0');
--
-- 表的结构 `fyt_product`
-- 
DROP TABLE IF EXISTS `fyt_product`;
CREATE TABLE `fyt_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `title` varchar(80) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `keywords` varchar(80) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `content` text NOT NULL,
  `template` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `posid` varchar(50) NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `readpoint` smallint(5) NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `url` varchar(150) NOT NULL DEFAULT '',
  `pics` mediumtext NOT NULL,
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `gl` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `status` (`id`,`status`,`listorder`),
  KEY `catid` (`id`,`catid`,`status`),
  KEY `lang` (`id`,`status`,`lang`),
  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_resume`
-- 
DROP TABLE IF EXISTS `fyt_resume`;
CREATE TABLE `fyt_resume` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `sex` varchar(255) NOT NULL DEFAULT '',
  `LinkPhone` varchar(255) NOT NULL DEFAULT '',
  `jianl` varchar(80) NOT NULL DEFAULT '',
  `theYear` varchar(255) NOT NULL DEFAULT '',
  `IDNum` varchar(255) NOT NULL DEFAULT '',
  `Native` varchar(255) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `Folk` varchar(255) NOT NULL DEFAULT '',
  `Email` text NOT NULL,
  `ComSkill` mediumtext NOT NULL,
  `Intro` mediumtext NOT NULL,
  `Grade` mediumtext NOT NULL,
  `jianli` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_role`
-- 
DROP TABLE IF EXISTS `fyt_role`;
CREATE TABLE `fyt_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowpostverify` tinyint(1) unsigned NOT NULL,
  `allowsearch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowupgrade` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allowsendmessage` tinyint(1) unsigned NOT NULL,
  `allowattachment` tinyint(1) NOT NULL,
  `maxpostnum` smallint(5) unsigned NOT NULL DEFAULT '0',
  `maxmessagenum` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_role`表中的数据 `fyt_role`
--
INSERT INTO `fyt_role` VALUES ('1','超级管理员','1','超级管理员','0','0','0','0','0','0','0','0','0','0');
INSERT INTO `fyt_role` VALUES ('6','普通管理员','1','','0','0','0','0','0','1','0','0','0','0');
--
-- 表的结构 `fyt_role_user`
-- 
DROP TABLE IF EXISTS `fyt_role_user`;
CREATE TABLE `fyt_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_role_user`表中的数据 `fyt_role_user`
--
INSERT INTO `fyt_role_user` VALUES ('6','4');
INSERT INTO `fyt_role_user` VALUES ('6','3');
INSERT INTO `fyt_role_user` VALUES ('6','2');
--
-- 表的结构 `fyt_shipping`
-- 
DROP TABLE IF EXISTS `fyt_shipping`;
CREATE TABLE `fyt_shipping` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(50) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `first_weight` int(11) unsigned NOT NULL DEFAULT '0',
  `second_weight` int(11) unsigned NOT NULL DEFAULT '0',
  `first_price` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `second_price` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '99',
  `is_insure` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `insure_fee` int(11) unsigned NOT NULL DEFAULT '0',
  `insure_low_price` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `price_type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_slide`
-- 
DROP TABLE IF EXISTS `fyt_slide`;
CREATE TABLE `fyt_slide` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `flashfile` varchar(150) NOT NULL DEFAULT '',
  `xmlfile` varchar(150) NOT NULL DEFAULT '',
  `tpl` varchar(30) NOT NULL DEFAULT '',
  `width` smallint(5) unsigned NOT NULL DEFAULT '0',
  `height` smallint(5) unsigned NOT NULL DEFAULT '0',
  `num` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_slide`表中的数据 `fyt_slide`
--
INSERT INTO `fyt_slide` VALUES ('1','首页幻灯','','','index0','1440','539','5','1','0');
INSERT INTO `fyt_slide` VALUES ('2','手机版首页动画','','','mob','320','208','3','1','0');
INSERT INTO `fyt_slide` VALUES ('3','内页幻灯片','','','3','1019','280','3','1','0');
--
-- 表的结构 `fyt_slide_data`
-- 
DROP TABLE IF EXISTS `fyt_slide_data`;
CREATE TABLE `fyt_slide_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` tinyint(3) unsigned DEFAULT '0',
  `title` varchar(30) NOT NULL DEFAULT '',
  `small` varchar(150) NOT NULL DEFAULT '',
  `pic` varchar(150) NOT NULL DEFAULT '',
  `link` varchar(150) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `data` text,
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_slide_data`表中的数据 `fyt_slide_data`
--
INSERT INTO `fyt_slide_data` VALUES ('1','1','幻灯片','','/Uploads/201503/5507d7d26e784.jpg','/chanpinzhongxin.html','','','0','1','1');
INSERT INTO `fyt_slide_data` VALUES ('2','1','幻灯片','','/Uploads/201503/5507d7d26e784.jpg','/fuwuchengnuo.html','','','2','1','1');
INSERT INTO `fyt_slide_data` VALUES ('3','1','幻灯片','','/Uploads/201503/5507d7ad65c9d.jpg','/zaixianliuyan.html','','','1','1','1');
INSERT INTO `fyt_slide_data` VALUES ('7','1','create the classic works,highl','','/Uploads/201405/5383e659a7233.jpg','/en/roducts.html','',NULL,'0','1','2');
INSERT INTO `fyt_slide_data` VALUES ('8','1','honesty rate,eternal service','','/Uploads/201405/5383e5de62f55.jpg','/en/bout.html','',NULL,'0','1','2');
INSERT INTO `fyt_slide_data` VALUES ('9','1','scientific and technological i','','/Uploads/201405/5383e7c92383d.jpg','/en/ervice.html','',NULL,'0','1','2');
INSERT INTO `fyt_slide_data` VALUES ('10','2','3dfsd','','/Uploads/201503/5513c07278c82.jpg','#','','','2','1','1');
INSERT INTO `fyt_slide_data` VALUES ('12','2','1adasda','','/Uploads/201503/5514beebacf52.jpg','#','','','3','1','1');
INSERT INTO `fyt_slide_data` VALUES ('13','3','b1','','/Grzx/Tpl/home/default/public/images/bannner.jpg','','',NULL,'0','1','1');
INSERT INTO `fyt_slide_data` VALUES ('14','3','b2','','/Grzx/Tpl/home/default/public/images/bannner.jpg','','',NULL,'0','1','1');
INSERT INTO `fyt_slide_data` VALUES ('15','3','b3','','/Grzx/Tpl/home/default/public/images/bannner.jpg','','',NULL,'0','1','1');
INSERT INTO `fyt_slide_data` VALUES ('17','2','aaa','','/Uploads/201503/55164aba981c2.jpg','','','','1','1','1');
--
-- 表的结构 `fyt_tags`
-- 
DROP TABLE IF EXISTS `fyt_tags`;
CREATE TABLE `fyt_tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `slug` varchar(100) NOT NULL DEFAULT '',
  `moduleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `module` varchar(30) NOT NULL DEFAULT '',
  `num` smallint(5) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=513 DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_tags_data`
-- 
DROP TABLE IF EXISTS `fyt_tags_data`;
CREATE TABLE `fyt_tags_data` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `tagid` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tagid` (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_type`
-- 
DROP TABLE IF EXISTS `fyt_type`;
CREATE TABLE `fyt_type` (
  `typeid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `keyid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`typeid`),
  KEY `parentid` (`parentid`,`listorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_urlrule`
-- 
DROP TABLE IF EXISTS `fyt_urlrule`;
CREATE TABLE `fyt_urlrule` (
  `urlruleid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `showurlrule` varchar(255) NOT NULL DEFAULT '',
  `showexample` varchar(255) NOT NULL DEFAULT '',
  `listurlrule` varchar(255) NOT NULL DEFAULT '',
  `listexample` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`urlruleid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_urlrule`表中的数据 `fyt_urlrule`
--
INSERT INTO `fyt_urlrule` VALUES ('1','0','{$catdir}/{$catid}-{$id}.html|{$catdir}/-{$catid}-{$id}-{$page}.html','news/1.html|news/1-1.html','{$catdir}.html|{$catdir}-{$catid}-{$page}.html','news.html|news-1.html','0');
INSERT INTO `fyt_urlrule` VALUES ('2','0','show-{$catid}-{$id}.html|show-{$catid}-{$id}-{$page}.html','show-1-1.html|show-1-1-1.html','list-{$catid}.html|list-{$catid}-{$page}.html','list-1.html|list-1-1.html','0');
INSERT INTO `fyt_urlrule` VALUES ('3','0','{$module}/show/{$catid}/{$id}.html|{$module}/show/{$catid}/{$id}-{$page}.html','Article/show/1.html|Article/show/1-1.html','{$module}/list/{$catid}.html|{$module}/list/{$catid}-{$page}.html','Article/list/1.html|Article/list/1-1.html','0');
INSERT INTO `fyt_urlrule` VALUES ('4','1','{$parentdir}{$catdir}/show_{$id}.html|{$parentdir}{$catdir}/show_{$id}_{$page}.html','news/show_1.html|news/show_1_1.html','{$parentdir}{$catdir}/|{$parentdir}{$catdir}/{$page}.html','news/|news/1.html','0');
--
-- 表的结构 `fyt_user`
-- 
DROP TABLE IF EXISTS `fyt_user`;
CREATE TABLE `fyt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `question` varchar(50) NOT NULL DEFAULT '',
  `answer` varchar(50) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `tel` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `fax` varchar(50) NOT NULL DEFAULT '',
  `web_url` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `login_count` int(11) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `last_logintime` int(11) unsigned NOT NULL DEFAULT '0',
  `reg_ip` char(15) NOT NULL DEFAULT '',
  `last_ip` char(15) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `point` smallint(5) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_user_address`
-- 
DROP TABLE IF EXISTS `fyt_user_address`;
CREATE TABLE `fyt_user_address` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `consignee` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `country` smallint(5) unsigned NOT NULL DEFAULT '0',
  `province` smallint(5) unsigned NOT NULL DEFAULT '0',
  `city` smallint(5) unsigned NOT NULL DEFAULT '0',
  `area` smallint(5) unsigned NOT NULL DEFAULT '0',
  `address` varchar(120) NOT NULL DEFAULT '',
  `zipcode` varchar(60) NOT NULL DEFAULT '',
  `tel` varchar(60) NOT NULL DEFAULT '',
  `mobile` varchar(60) NOT NULL DEFAULT '',
  `isdefault` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_vip`
-- 
DROP TABLE IF EXISTS `fyt_vip`;
CREATE TABLE `fyt_vip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `sjhm` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_vsp`
-- 
DROP TABLE IF EXISTS `fyt_vsp`;
CREATE TABLE `fyt_vsp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_style` varchar(40) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
-- 表的结构 `fyt_wapcategory`
-- 
DROP TABLE IF EXISTS `fyt_wapcategory`;
CREATE TABLE `fyt_wapcategory` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `catname` varchar(30) NOT NULL DEFAULT '',
  `catdir` varchar(30) NOT NULL DEFAULT '',
  `parentdir` varchar(50) NOT NULL DEFAULT '',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `moduleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `module` char(24) NOT NULL DEFAULT '',
  `arrparentid` varchar(255) NOT NULL DEFAULT '',
  `arrchildid` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ishtml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT '',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(150) NOT NULL DEFAULT '',
  `template_list` varchar(20) NOT NULL DEFAULT '',
  `template_show` varchar(20) NOT NULL DEFAULT '',
  `pagesize` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `catcontent` varchar(250) NOT NULL,
  `readgroup` varchar(100) NOT NULL DEFAULT '',
  `listtype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `urlruleid` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `content` text,
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`),
  KEY `listorder` (`listorder`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- 
-- 导出`fyt_wapcategory`表中的数据 `fyt_wapcategory`
--
INSERT INTO `fyt_wapcategory` VALUES ('1','关于我们','about','','0','1','Page','0','0','0','dsafasd','sadfadsf','safdsfsda','0','0','1','0','/Uploads/201503/551260933d72d.jpg','0','/about.html','','','0','','','0','0','4','<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n  东莞市台机减速机有限公司（天机传动）成立于2005年，国内知名,磁粉制动器生产厂家，于2013年入驻天机传动工业园。天机传动专业研制工业领域专用的高精密传动设备，包括蜗轮蜗杆减速机、干式单片电磁制动器、磁粉制动器、干式单片电磁离合器、金牌对边机（光电纠偏系统）、电磁离合制动组合体、电磁离合制动减速机一体化等系列优质产品/组合。天机传动拥有自主研发、生产、设计等多项先进技术以及先进的生产、加工、检测设备，并通过质量管理体系ISO9001:2008标准认证，天机传动拥有自主研发、生产、设计等多项先进技术以及先进的生产、加工、检测设备，并通过质量管理体系ISO9001:2008标准认证，具备完善的质量管理体系，并严格执行国家机械行业标准。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 经过多年不懈的努力，天机传动系列产品已远销海内外市场，并获得海外广大新老客户的认可与支持。天机传动系列产品用途包括张力控制、收卷、放卷、缓冲起动、荷载保护、连续滑动、高速应答、高频运转、寸动定位等等，被广泛应用于印刷机械、包装机械、纺织机械、分条机、电线电缆设备、化工机械、橡塑机械、钢材卷取设备、印染机械、食品机械等行业领域。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 天机传动已建立起完善的研发、设计、生产、检测、售后等生产管理和服务体系，因此在社会赢得了良好的声誉和知名度。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 东莞市台机减速机有限公司（天机传动）成立于2005年，国内知名,磁粉制动器生产厂家，于2013年入驻天机传动工业园。天机传动专业研制工业领域专用的高精密传动设备，包括蜗轮蜗杆减速机、干式单片电磁制动器、磁粉制动器、干式单片电磁离合器、金牌对边机（光电纠偏系统）、电磁离合制动组合体、电磁离合制动减速机一体化等系列优质产品/组合。天机传动拥有自主研发、生产、设计等多项先进技术以及先进的生产、加工、检测设备，并通过质量管理体系ISO9001:2008标准认证，天机传动拥有自主研发、生产、设计等多项先进技术以及先进的生产、加工、检测设备，并通过质量管理体系ISO9001:2008标准认证，具备完善的质量管理体系，并严格执行国家机械行业标准。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 经过多年不懈的努力，天机传动系列产品已远销海内外市场，并获得海外广大新老客户的认可与支持。天机传动系列产品用途包括张力控制、收卷、放卷、缓冲起动、荷载保护、连续滑动、高速应答、高频运转、寸动定位等等，被广泛应用于印刷机械、包装机械、纺织机械、分条机、电线电缆设备、化工机械、橡塑机械、钢材卷取设备、印染机械、食品机械等行业领域。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 天机传动已建立起完善的研发、设计、生产、检测、售后等生产管理和服务体系，因此在社会赢得了良好的声誉和知名度。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 东莞市台机减速机有限公司（天机传动）成立于2005年，国内知名,磁粉制动器生产厂家，于2013年入驻天机传动工业园。天机传动专业研制工业领域专用的高精密传动设备，包括蜗轮蜗杆减速机、干式单片电磁制动器、磁粉制动器、干式单片电磁离合器、金牌对边机（光电纠偏系统）、电磁离合制动组合体、电磁离合制动减速机一体化等系列优质产品/组合。天机传动拥有自主研发、生产、设计等多项先进技术以及先进的生产、加工、检测设备，并通过质量管理体系ISO9001:2008标准认证，天机传动拥有自主研发、生产、设计等多项先进技术以及先进的生产、加工、检测设备，并通过质量管理体系ISO9001:2008标准认证，具备完善的质量管理体系，并严格执行国家机械行业标准。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 经过多年不懈的努力，天机传动系列产品已远销海内外市场，并获得海外广大新老客户的认可与支持。天机传动系列产品用途包括张力控制、收卷、放卷、缓冲起动、荷载保护、连续滑动、高速应答、高频运转、寸动定位等等，被广泛应用于印刷机械、包装机械、纺织机械、分条机、电线电缆设备、化工机械、橡塑机械、钢材卷取设备、印染机械、食品机械等行业领域。\r\n</p>\r\n<p style=\"margin-top:0px;margin-bottom:0px;padding:10px 0px 0px;list-style:none;outline:none;color:#666666;font-family:Arial, Helvetica, sans-serif, 宋体;line-height:24px;white-space:normal;text-indent:2em;background-image:initial;background-attachment:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;\">\r\n 天机传动已建立起完善的研发、设计、生产、检测、售后等生产管理和服务体系，因此在社会赢得了良好的声誉和知名度。\r\n</p>');
INSERT INTO `fyt_wapcategory` VALUES ('2','产品中心','','','0','3','Product','0','1','0','','','','0','0','1','0','/Uploads/201503/551260a242f14.jpg','0','/chanpinzhongxin.html','','','0','','','0','0','4','');
INSERT INTO `fyt_wapcategory` VALUES ('3','新闻中心','','','0','0','','0','2','1','','','','0','0','1','0','/Uploads/201503/551260b6dda35.jpg','0','mobile.php?g=mobile&m=page&a=index','','','0','','','0','0','4','');
INSERT INTO `fyt_wapcategory` VALUES ('4','服务支持','','','0','1','Page','0','3','0','','','','0','0','1','0','/Uploads/201503/551260c742514.jpg','0','/fuwuzhichi.html','','','0','','','0','0','4','');
INSERT INTO `fyt_wapcategory` VALUES ('5','人才招聘','','','0','1','Page','0','4','0','','','','0','0','1','0','/Uploads/201503/551260d4cbfd8.jpg','0','/rencaizhaopin.html','','','0','','','0','0','4','暂无招聘');
INSERT INTO `fyt_wapcategory` VALUES ('6','在线反馈','','','0','1','Page','0','5','0','','','','0','0','1','0','/Uploads/201503/5514c139f1340.jpg','0','/zaixianfankui.html','','','0','','','0','0','4','');
INSERT INTO `fyt_wapcategory` VALUES ('7','联系我们','','','0','1','Page','0','6','0','','','','0','0','1','0','/Uploads/201503/551260f11ae67.jpg','0','/lianxiwomen.html','contact','','0','','','0','0','4','联系我们');
--
-- 表的结构 `fyt_xls`
-- 
DROP TABLE IF EXISTS `fyt_xls`;
CREATE TABLE `fyt_xls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
  `lang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `partnumr` varchar(255) NOT NULL DEFAULT '',
  `brand` varchar(255) NOT NULL DEFAULT '',
  `datecode` varchar(255) NOT NULL DEFAULT '',
  `pcs` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;