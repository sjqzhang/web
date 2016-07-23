-- MySQL dump 10.13  Distrib 5.5.40, for Win32 (x86)
--
-- Host: localhost    Database: cmdb
-- ------------------------------------------------------
-- Server version	5.5.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sys_basedata`
--

DROP TABLE IF EXISTS `sys_basedata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_basedata` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `pid` bigint(20) DEFAULT NULL COMMENT '父编号',
  `sort` int(11) DEFAULT NULL COMMENT '排序码',
  `value` varchar(1024) DEFAULT NULL COMMENT '参数值',
  `code` varchar(64) DEFAULT NULL COMMENT '变量编码 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='基础资料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_basedata`
--

LOCK TABLES `sys_basedata` WRITE;
/*!40000 ALTER TABLE `sys_basedata` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_basedata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_form`
--

DROP TABLE IF EXISTS `sys_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_form` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL COMMENT '名称',
  `file_name` varchar(256) DEFAULT NULL COMMENT '文件名',
  `db` varchar(512) DEFAULT NULL COMMENT '数据库',
  `ctrl` text COMMENT '控制器',
  `model` text COMMENT '模型',
  `views` text COMMENT '视图',
  `js` text COMMENT '视图控制器',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`file_name`(64))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_form`
--

LOCK TABLES `sys_form` WRITE;
/*!40000 ALTER TABLE `sys_form` DISABLE KEYS */;
INSERT INTO `sys_form` VALUES (2,'树型结构','c_tree','','\n<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\'); \n//c_tree      \nclass c_tree extends Base_Controller {\n public function __construct()\n    {\n\n        parent::__construct();\n        $this->load->model(\'cmdb/c_tree_model\');\n    \n\n    }\n    //查询列表\n    public function data(){\n \n		//$this->c_tree_model->data();\n      \n      \n         $pid=$this->input->post(\'id\');\n      \n      if(empty($pid)){\n      \n         $rows=$this->db->query(\'select * from c_tree where isnull(pid)\')->result_array();\n      } else {\n       $rows=$this->db->select(\"*\")->from(\"c_tree\")->where(\'pid\',$pid)->get()->result_array();\n      \n      }\n      \n      	foreach($rows as $i=>$row){\n          \n          if(empty($row[\'pid\'])){\n          \n            	$row[\'isParent\']=true;\n          } else {\n                $row[\'isParent\']=true;\n          \n          }\n          \n          $rows[$i]=$row;\n      \n      	}\n      \n         echo json_encode($rows);\n\n    }\n  \n\n\n	//导出数据\n    public function export(){\n \n	   $this->c_tree_model->export();     \n\n    }\n\n    //页面显示\n    public function index()\n    {\n        $this->load->view(\'cmdb/c_tree\');\n    }\n\n    \n    //增加\n    public function add(){\n        $id=$this->input->post(\'id\');\n      if($id==\'0\') {\n        $data=$this->req_data($this->c_tree_model->_fields);\n        if($this->c_tree_model->add($data)){\n            $this->ajax_success($this->db->insert_id());\n        }  else {\n			$this->ajax_error(0); \n		}   \n      } else {\n      	$this->edit();\n      }\n    }\n    //修改\n    public function edit(){ \n        $where= $this->req_data(array($this->c_tree_model->_pk));\n        $data=$this->req_data($this->c_tree_model->_fields);\n        if($this->c_tree_model->edit($data,$where)) {\n          $this->ajax_success(1);\n        }  else {\n			$this->ajax_error(0); \n		}   \n    }\n	//删除\n    public function del(){ \n        $where= $this->req_data(array($this->c_tree_model->_pk));\n         if($this->c_tree_model->del($where)) {\n           $this->ajax_success(1);\n        }  else {\n			$this->ajax_error(0); \n		}   \n    }\n\n}\n\n?>\n ','<?php\nclass c_tree_model extends MY_Model {\n	public $_debug=false;\n    public function __construct()\n    {\n        parent::__construct();\n        $this->_table = \'c_tree\';\n        $this->_pk= \'id\' ;\n        $this->_fields= array(\"id\"=>0,\n		\"pid\"=>0,\n		\"name\"=>\"\",\n		\"tags\"=>\"\",\n		) ;\n        $this->_where=array(\n				\'id,keyword\'=>\'li\',\n				\'0\'=>\'or\',\n				\'pid,keyword\'=>\'li\',\n				\'1\'=>\'or\',\n				\'name,keyword\'=>\'li\',\n				\'2\'=>\'or\',\n				\'tags,keyword\'=>\'li\',\n				\'3\'=>\'or\',\n				);\n        \n    }\n\n	public function data(){\n	\n	     $data=$this->req_data(array(\'keyword\'));\n		 $where= where($this->c_tree_model->_where,$data);\n		 $this->db->select(\"*\")->from(\"c_tree\");\n		 if(!empty($where)){\n			$this->db->where(preg_replace(\'/^\\s*where/i\',\'\', $where),NULL,false);\n		 }\n		 $this->ajax_page();\n\n	}\n\n\n	  public function export(){\n		 $this->load->helper(\'excel\');\n		 $data=$this->req_data(array(\'keyword\'));\n		 $where= where($this->c_tree_model->_where,$data);\n		 $this->db->select(\"*\")->from(\"c_tree\");\n		 if(!empty($where)){\n			$this->db->where(preg_replace(\'/^\\s*where/i\',\'\', $where),NULL,false);\n		 }\n		 $page= $this->page();\n		  excel_export(\'\',$page[\'items\'],excel_header_map());\n\n	}\n} \n?>','<!DOCTYPE html>\n<HTML>\n<HEAD>\n	<TITLE> ZTREE DEMO - async & edit</TITLE>\n	<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">\n	<link rel=\"stylesheet\" href=\"resources/plugins/zTree_v3/css/demo.css\" type=\"text/css\">\n	<link rel=\"stylesheet\" href=\"resources/plugins/zTree_v3/css/zTreeStyle/zTreeStyle.css\" type=\"text/css\">\n	<script type=\"text/javascript\" src=\"resources/plugins/zTree_v3/js/jquery-1.4.4.min.js\"></script>\n	<script type=\"text/javascript\" src=\"resources/plugins/zTree_v3/js/jquery.ztree.core-3.5.js\"></script>\n	<script type=\"text/javascript\" src=\"resources/plugins/zTree_v3/js/jquery.ztree.excheck-3.5.js\"></script>\n	<script type=\"text/javascript\" src=\"resources/plugins/zTree_v3/js/jquery.ztree.exedit-3.5.js\"></script>\n	<SCRIPT type=\"text/javascript\">\n		<!--\n		var setting = {\n			async: {\n				enable: true,\n				url:\"index.php/cmdb/c_tree/data\",\n				autoParam:[\"id\", \"name=n\", \"level=lv\"],\n				otherParam:{\"otherParam\":\"zTreeAsyncTest\"},\n				dataFilter: filter\n			},\n			view: {expandSpeed:\"\",\n				addHoverDom: addHoverDom,\n				removeHoverDom: removeHoverDom,\n				selectedMulti: false\n			},\n			edit: {\n				enable: true\n			},\n			data: {\n				simpleData: {\n					enable: true\n				}\n			},\n			callback: {\n				beforeRemove: beforeRemove,\n				beforeRename: beforeRename,\n\n				beforeEditName: zTreeBeforeEditName,\n\ncancelEditName:cancelEditName,\n\nonRename :onRename,\n\n\n\nonClick:onMyClick\n\n\n			}\n		};\n\n\nfunction onMyClick(obj,nodename,node){\n\n\n\n$(\'#tags\').val(node[\'tags\'])\n\n\n}\n\n\n	function onRename(obj,nodename,node){\n\n\n\n	//console.log(arguments);\n\n\n\n    $.post(\'index.php/cmdb/c_tree/add\',{tags:$(\'#tags\').val(),pid:node.pId,id:node.id,name:node.name},function(data){\n\n       \n\n  })\n\n}\n\n\n	function cancelEditName(){\n\n\n\n	console.log(arguments.length);\n\n}\n	\n\n		function filter(treeId, parentNode, childNodes) {\n			if (!childNodes) return null;\n			for (var i=0, l=childNodes.length; i<l; i++) {\n				childNodes[i].name = childNodes[i].name.replace(/\\.n/g, \'.\');\n			}\n			return childNodes;\n		}\n		function beforeRemove(treeId, treeNode) {\n			var zTree = $.fn.zTree.getZTreeObj(\"treeDemo\");\n			zTree.selectNode(treeNode);\n			return confirm(\"确认删除 节点 -- \" + treeNode.name + \" 吗？\");\n		}		\n		function beforeRename(treeId, treeNode, newName) {\n			if (newName.length == 0) {\n				alert(\"节点名称不能为空.\");\n				return false;\n			}\n			return true;\n		}\n\n\n\n		function zTreeBeforeEditName(){\n\n\n\n			console.log(arguments)\n\n		}\n\n		var newCount = 1;\n		function addHoverDom(treeId, treeNode) {\n			var sObj = $(\"#\" + treeNode.tId + \"_span\");\n			if (treeNode.editNameFlag || $(\"#addBtn_\"+treeNode.tId).length>0) return;\n			var addStr = \"<span class=\'button add\' id=\'addBtn_\" + treeNode.tId\n				+ \"\' title=\'add node\' onfocus=\'this.blur();\'></span>\";\n			sObj.after(addStr);\n			var btn = $(\"#addBtn_\"+treeNode.tId);\n			if (btn) btn.bind(\"click\", function(){\n				var zTree = $.fn.zTree.getZTreeObj(\"treeDemo\");\n				zTree.addNodes(treeNode, {id:0, pId:treeNode.id, name:\"new node\" + (newCount++)});\n				return false;\n			});\n		};\n		function removeHoverDom(treeId, treeNode) {\n			$(\"#addBtn_\"+treeNode.tId).unbind().remove();\n		};\n\n		$(document).ready(function(){\n			$.fn.zTree.init($(\"#treeDemo\"), setting);\n		});\n		//-->\n	</SCRIPT>\n	<style type=\"text/css\">\n.ztree li span.button.add {margin-left:2px; margin-right: -1px; background-position:-144px 0; vertical-align:top; *vertical-align:middle}\n	</style>\n</HEAD>\n\n<BODY>\n\n<!--\n<h1>异步加载 & 编辑功能 共存</h1>\n<h6>[ 文件路径: exedit/async_edit.html ]</h6>\n\n-->\n<div class=\"content_wrap\"  style=\"width:900px;\">\n	<div class=\"zTreeDemoBackground left\" style=\"width:500px;\" >\n		<ul id=\"treeDemo\" class=\"ztree\" style=\"width:500px;\"></ul>\n	</div>\n\n	\n	<div class=\"right\" style=\"float:left;\">\n\n		<div style=\"height:20px;\"></div>\n		<input type=\"text\" id=\"tags\" />\n	</div>\n</div>\n</BODY>\n</HTML>','\n\nfunction CTree(){\n    that=this;\n    if(location.href.indexOf(\'c_tree\')>=0){\n        this.baseUrl=\'\';\n    } else {\n        this.baseUrl=\'index.php/cmdb/c_tree/data\';\n    }\n    BaseGrid.call(this,CTree.prototype);\n    \n\n}\n\n \n\nCTree.prototype={\n        init:function(){\n    \n        var self=this;\n    \n            var cols = [\n                \n	{title: \'id\', name : \'id\', width : 25, sortable : false, align: \'left\'},\n		{title: \'pid\', name : \'pid\', width : 25, sortable : false, align: \'left\'},\n		{title: \'name\', name : \'name\', width : 25, sortable : false, align: \'left\'},\n		{title: \'tags\', name : \'tags\', width : 25, sortable : false, align: \'left\'}\n];\n            \n\n\n//AJAX示例\nvar mmg =  $(this.gridId).mmGrid({\n    cols: cols,\n    url: self.searchUrl,\n    method: \'post\',\n    remoteSort:true ,\n    sortName: \'SECUCODE\',\n    sortStatus: \'asc\',\n    root: \'items\',\n    fullWidthRows:true,\n    params:function(){\n        var params=self.buildParam(self.gridSearchBarId);\n        return params;\n    },\n    plugins : [\n        $(self.pageBarId).mmPaginator()\n    ],\n    checkCol:true,\n    indexCol:true,\n    multiSelect:true\n\n});\n\nthis.grid=mmg;\n        \n}\n};\n\n\n\nvar cTree=new CTree();\n\n\n$(document).ready(function(){\n    \n    cTree.init();\n    \n    $(\'#addBtn\').click(function(){\n        cTree.addEntrance();\n    });\n    \n    $(\'#editBtn\').click(function(){\n        cTree.editEntrance();\n    });\n    $(\'#delBtn\').click(function(){\n        cTree.delEntrance();\n    });\n	/*\n	$(\'#exportBtn\').click(function(){\n        cTree.export();\n		return false;\n    });\n	*/\n    $(\'#searchBtn\').click(function(){\n        cTree.searchEntrance();\n		return false;\n    });\n});\n\n\n');
/*!40000 ALTER TABLE `sys_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_group_permission`
--

DROP TABLE IF EXISTS `sys_group_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_group_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sys_module_id` int(11) unsigned NOT NULL COMMENT '模块ID',
  `user_group_id` int(11) unsigned NOT NULL COMMENT '组ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1475 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_group_permission`
--

LOCK TABLES `sys_group_permission` WRITE;
/*!40000 ALTER TABLE `sys_group_permission` DISABLE KEYS */;
INSERT INTO `sys_group_permission` VALUES (31,2,3),(32,6,3),(33,8,3),(34,21,3),(41,3,3),(42,13,3),(52,9,3),(53,7,3),(1039,105,9),(1040,106,9),(1063,105,6),(1064,106,6),(1287,116,2),(1288,119,2),(1289,127,2),(1290,126,2),(1291,125,2),(1292,120,2),(1293,118,2),(1294,131,2),(1295,130,2),(1296,129,2),(1297,128,2),(1298,117,2),(1299,124,2),(1300,123,2),(1301,122,2),(1302,121,2),(1381,116,1),(1382,118,1),(1383,131,1),(1384,128,1),(1385,129,1),(1386,130,1),(1387,119,1),(1388,127,1),(1389,126,1),(1390,125,1),(1391,120,1),(1392,117,1),(1393,121,1),(1394,122,1),(1395,123,1),(1396,136,1),(1397,124,1),(1398,1,1),(1407,3,1),(1408,13,1),(1409,14,1),(1410,15,1),(1411,10,1),(1412,109,1),(1413,11,1),(1416,4,1),(1417,16,1),(1418,17,1),(1419,18,1),(1420,19,1),(1421,138,1),(1422,142,1),(1423,141,1),(1424,140,1),(1425,139,1),(1426,143,1),(1427,147,1),(1428,146,1),(1429,145,1),(1430,144,1),(1431,148,1),(1432,150,1),(1433,149,1),(1434,152,1),(1435,157,1),(1436,156,1),(1437,155,1),(1438,154,1),(1439,153,1),(1440,158,1),(1441,163,1),(1442,162,1),(1443,161,1),(1444,160,1),(1445,159,1),(1446,164,1),(1447,2,1),(1448,21,1),(1449,9,1),(1450,8,1),(1451,7,1),(1452,6,1),(1453,107,1),(1454,110,1),(1467,134,1),(1468,169,1),(1469,168,1),(1470,167,1),(1471,166,1),(1472,170,1),(1473,135,1),(1474,171,1);
/*!40000 ALTER TABLE `sys_group_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_group_user`
--

DROP TABLE IF EXISTS `sys_group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_group_user` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  UNIQUE KEY `NewIndex1` (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_group_user`
--

LOCK TABLES `sys_group_user` WRITE;
/*!40000 ALTER TABLE `sys_group_user` DISABLE KEYS */;
INSERT INTO `sys_group_user` VALUES (15,1);
/*!40000 ALTER TABLE `sys_group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_log`
--

DROP TABLE IF EXISTS `sys_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `url` varchar(2048) NOT NULL DEFAULT '' COMMENT '路径',
  `params` text NOT NULL COMMENT '参数',
  `error_code` char(4) NOT NULL DEFAULT '0' COMMENT '错误码',
  `error_message` varchar(255) NOT NULL DEFAULT '' COMMENT '错误信息',
  `ip` char(15) DEFAULT NULL COMMENT '用户IP',
  `admin_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `time` int(11) DEFAULT NULL COMMENT '时间',
  `query` varchar(1024) DEFAULT NULL COMMENT '执行的sql',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=689 DEFAULT CHARSET=utf8 COMMENT='系统日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_log`
--

LOCK TABLES `sys_log` WRITE;
/*!40000 ALTER TABLE `sys_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_module`
--

DROP TABLE IF EXISTS `sys_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `module_icon` varchar(20) DEFAULT NULL COMMENT '模块图标',
  `module_name` varchar(20) NOT NULL COMMENT '模块名称',
  `module_parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  `module_type` varchar(10) DEFAULT NULL COMMENT '模块类型',
  `module_resource` varchar(60) NOT NULL COMMENT 'URL',
  `module_order` int(11) NOT NULL DEFAULT '0' COMMENT '顺序',
  `module_default_resource` varchar(45) DEFAULT NULL COMMENT '模块默认的动作',
  `visiable` tinyint(1) DEFAULT '1' COMMENT '1显示 0 不显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_module`
--

LOCK TABLES `sys_module` WRITE;
/*!40000 ALTER TABLE `sys_module` DISABLE KEYS */;
INSERT INTO `sys_module` VALUES (1,'','系统管理',0,'module','',0,'sys/sys_user/index',1),(2,'','用户管理',1,'page','sys_user/index',0,NULL,1),(3,'','用户组管理',1,'page','sys_user_group/index',1,NULL,1),(4,'','模块管理',1,'page','sys_module/index',2,'',1),(6,'','添加用户',2,'action','sys_user/add',0,NULL,1),(7,'','修改用户',2,'action','sys_user/edit',0,'',1),(8,'','删除用户',2,'action','sys_user/delete',0,'',1),(9,'','拉取数据',2,'action','sys_user/get_list',0,'',1),(10,'','添加组',3,'action','sys_user_group/add',0,NULL,1),(11,'','删除用户组',3,'action','sys_user_group/delete',4,'',1),(13,'','权限修改',3,'action','sys_group_permission/change',0,NULL,1),(14,'','修改用户组',3,'action','sys_user_group/edit',0,NULL,1),(15,'','拉取数据',3,'action','sys_user_group/get_list',0,NULL,1),(16,'','模块修改',4,'action','sys_module/edit',0,NULL,1),(17,'','模块添加',4,'action','sys_module/add',0,'',1),(18,'','模块删除',4,'action','sys_module/delete',0,NULL,1),(19,'','模块排序',4,'action','sys_module/sort',0,NULL,1),(21,'','拉取用户组',2,'action','sys_user/get_group',0,'',1),(102,'','二级目录',101,'page','test',0,'',1),(107,'','我的权限',2,'action','sys_user/ajax_get_permission',0,'',1),(109,'','用户组授权',3,'action','sys_group_permission/config',1,'',1),(110,'','获取业务树',2,'action','sys_user/get_group_tree',1,'sys/sys_user/getGroupTree',1),(134,'','操作日志',1,'page','sys_log/index',1,'',1),(135,'','获取操作日志列表',134,'action','sys_log/get_list',1,'',1),(137,'','模板配置',0,'module','',0,NULL,1),(138,'','系统模板',137,'page','sys_template/index',0,NULL,1),(139,'','查询列表',138,'action','sys_template/data',0,NULL,1),(140,'','增加',138,'action','sys_template/add',0,NULL,1),(141,'','修改',138,'action','sys_template/edit',0,NULL,1),(142,'','删除',138,'action','sys_template/del',0,NULL,1),(143,'','模板配置',137,'page','sys_form/index',0,NULL,1),(144,'','查询列表',143,'action','sys_form/data',0,NULL,1),(145,'','增加',143,'action','sys_form/add',0,NULL,1),(146,'','修改',143,'action','sys_form/edit',0,NULL,1),(147,'','删除',143,'action','sys_form/del',0,NULL,1),(148,'','保存模板',143,'action','sys_form/save_report',0,NULL,1),(149,'','载入模板',143,'action','sys_form/load_report',0,NULL,1),(150,'','检查模板',143,'action','sys_form/check_report',0,NULL,1),(158,'','基础资料',1,'page','sys_basedata/index',0,NULL,1),(159,'','查询列表',158,'action','sys_basedata/data',0,NULL,1),(160,'','列表',158,'action','sys_basedata/get_parent_list',0,NULL,1),(161,'','列表',158,'action','sys_basedata/get_basedata_for_ztree',0,NULL,1),(162,'','增加',158,'action','sys_basedata/add',0,NULL,1),(163,'','修改',158,'action','sys_basedata/edit',0,NULL,1),(164,'','删除',158,'action','sys_basedata/del',0,NULL,1),(166,'','查询列表',134,'action','sys_log/data',0,NULL,1),(167,'','导出数据',134,'action','sys_log/export',0,NULL,1),(168,'','增加',134,'action','sys_log/add',0,NULL,1),(169,'','修改',134,'action','sys_log/edit',0,NULL,1),(170,'','删除',134,'action','sys_log/del',0,NULL,1),(171,'','用户组列表',2,'action','sys_user/get_group_user',0,NULL,1);
/*!40000 ALTER TABLE `sys_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_operation_log`
--

DROP TABLE IF EXISTS `sys_operation_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_operation_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `remote` varchar(255) DEFAULT NULL,
  `form_data` varchar(2048) DEFAULT NULL,
  `response` text,
  `code` tinyint(4) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_operation_log`
--

LOCK TABLES `sys_operation_log` WRITE;
/*!40000 ALTER TABLE `sys_operation_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_operation_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_template`
--

DROP TABLE IF EXISTS `sys_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_template` (
  `id` double DEFAULT NULL,
  `name` varchar(768) DEFAULT NULL,
  `db` varchar(1536) DEFAULT NULL,
  `ctrl` blob,
  `model` blob,
  `views` blob,
  `js` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_template`
--

LOCK TABLES `sys_template` WRITE;
/*!40000 ALTER TABLE `sys_template` DISABLE KEYS */;
INSERT INTO `sys_template` VALUES (1,'报表模板--线状图','hostname=172.16.136.98;username=root;password=root;database=stock;dbdriver=mysql;','<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');\n\n\n\nclass {{filename}} extends Base_Controller {\n    public function __construct(){\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->model(\'{{projectname}}/{{filename}}_model\',\'model\');\n        \n\n    }\n\n\n	function index(){\n	\n      $this->load->view(\'{{projectname}}/{{filename}}.php\');\n	}\n  \n    function report(){\n	\n		$this->model->report(); \n	}\n\n\n\n\n	\n\n\n\n\n}\n\n?>\n','<?php\nclass {{filename}}_model extends MY_Model {\n    public function __construct()\n    {\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->helper(\'echart\');\n        $this->load->helper(\'db\');\n      	$config=ec_ds_conn(\'{{db}}\');\n		$this->report_db= $this->load->database($config,true);\n        \n        \n    }\n\n\n	function report(){\n      /*\n      $wdata=$this->req_data(array(\'start_time\',\'end_time\',\'project\'));\n      \n      if($wdata[\'project\']==\'all\'){\n      	$wdata[\'project\']=\'\';\n      }\n      \n      $wmap=array(\n        	\'collect_time,start_time\'=>\'ge\',\n        	\'1\'=>\'and\',\n            \'collect_time,end_time\'=>\'le\',\n            \'2\'=>\'and\',\n            \'name,project\'=>\'eq\',\n                  );\n     $where=where($wmap,$wdata);\n     */\n	\n         $sql=\"SELECT ftime,SUM(type1) AS \'type1\',SUM(type2) AS \'type2\',SUM(type3) AS \'type3\',SUM(type4) AS \'type4\',SUM(type5) AS \'type5\',SUM(type6) AS \'type6\',SUM(type7) AS \'type7\',SUM(type10) AS \'type10\' FROM (\nSELECT DATE(ftime) AS ftime,\nSUM(CASE ftype WHEN 1 THEN 1 ELSE 0 END ) AS type1,\nSUM(CASE ftype WHEN 2 THEN 1 ELSE 0 END ) AS type2,\nSUM(CASE ftype WHEN 3 THEN 1 ELSE 0 END ) AS type3,\nSUM(CASE ftype WHEN 4 THEN 1 ELSE 0 END ) AS type4,\nSUM(CASE ftype WHEN 5 THEN 1 ELSE 0 END ) AS type5,\nSUM(CASE ftype WHEN 6 THEN 1 ELSE 0 END ) AS type6,\nSUM(CASE ftype WHEN 7 THEN 1 ELSE 0 END ) AS type7,\nSUM(CASE ftype WHEN 10 THEN 1 ELSE 0 END ) AS type10\nFROM T_MAS_MONITOR WHERE fphone_number=\'13427708928\' AND DATE(ftime)>=\'2014-10-31\' GROUP BY DATE(ftime) ,ftype) t GROUP BY ftime;\n\n\";\n      \n            \n      $rows= $this->report_db->query($sql)->result_array();\n      \n      		$rows= ec_ds_trans( $rows);\n\n		$rows[\'series\']=array(\n			array(\'name\'=>\'慢查询\',\'type\'=>\'line\',\'data\'=>\'type1\'),\n			array(\'name\'=>\'连接数超时\',\'type\'=>\'line\',\'data\'=>\'type2\'),\n          array(\'name\'=>\'负载异常\',\'type\'=>\'line\',\'data\'=>\'type3\'),\n           array(\'name\'=>\'宕机报警\',\'type\'=>\'line\',\'data\'=>\'type4\'),\n           array(\'name\'=>\'非故障报警\',\'type\'=>\'line\',\'data\'=>\'type5\'),\n			);\n		$rows[\'xAxis\']=array(\n			array(\'name\'=>\'时间\',\'type\'=>\'line\',\'data\'=>\'ftime\')\n			);\n		$rows[\'title\']=array(\'text\'=>\'告警统计信息报表\',\'subtext\'=>\'\',\'x\'=>\'left\');\n	\n\n	  print_r(  json_encode(	($rows)));\n       \n	 \n	}\n  \n  	function combox(){\n      // $type= $this->input->post(\'type\');\n     	return $this->report_db->select(\'id value,name text\')->from(\'\')->get()->result_array();\n  		\n    }\n\n	\n\n	\n} \n?>','\n\n<div class=\"main-content\" id=\"page_div\">\n\n\n    <div class=\"breadcrumbs\" id=\"breadcrumbs\">\n        <ul class=\"breadcrumb\">\n            <li>\n                <i class=\"ace-icon fa fa-home home-icon\"></i>\n                <a href=\"<?php echo site_url() ?>\">首页</a>\n            </li>\n            <li class=\"active\"></li>\n        </ul>\n    </div>\n\n\n    <div class=\"page-content\">\n        <div class=\"page-content-area\">\n            <div class=\"row\">\n                <div class=\"col-xs-12\">\n                \n       \n\n        <script src=\"http://echarts.baidu.com/build/echarts-plain.js\"></script>\n        \n        <script src=\"/resources/{{projectname}}/js/echarts_common.js\"></script> \n	    <script src=\"/resources/{{projectname}}/js/{{filename}}.js\"></script> \n                \n\n                                \n        <div class=\"space-2\"></div>\n        <div class=\"hr hr-dotted\"></div>\n                                \n                                \n         <div id=\"graphSearchBarId\"  class=\"page-header\">\n                <form  class=\"form-inline\">\n				<!--\n				   <label class=\"inline input-sm\">\n                        <span class=\"lbl\">项目：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"project\" name=\"project\"></select>\n                    </div>\n\n\n\n					<div class=\"input-daterange input-group\">\n                                <input type=\"text\" id=\"start_time\" name=\"start_time\" class=\"input-sm form-control date-picker\">\n                                <span class=\"input-group-addon\">\n                                <i class=\"fa fa-exchange\"></i>\n                                </span>\n                                <input type=\"text\" id=\"end_time\" name=\"end_time\" class=\"input-sm form-control date-picker\">\n                       </div>\n\n					<label class=\"inline input-sm\">\n                        <span class=\"lbl\">周期：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"cycle\" name=\"cycle\">\n							<option value=\"1\">按日</option>\n							<option value=\"2\">按周</option>\n							<option value=\"3\">按月</option>\n						</select>\n						<input type=\"hidden\" name=\"type\" id=\"type\" value=\"1\" />\n                    </div>\n					-->\n\n                   \n\n                    <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">刷新</span>\n                    </button>\n\n					 <!--\n					  <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn2\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">查询</span>\n                    </button>\n					-->\n        \n                </form>\n            </div>\n\n                            <div>\n                               <div id=\"graph\" style=\"width:100%;height:500px;\"></div>\n                            </div>\n\n                           \n                    \n                    \n                    \n                    <!-- PAGE CONTENT ENDS -->\n                </div>\n                <!-- /.col -->\n            </div>\n            <!-- /.row -->\n        </div>\n        <!-- /.page-content-area -->\n    </div>\n    <!-- /.page-content -->\n</div>\n<!-- /.main-content -->\n','function {{className}}(){\n    this.graphSearchBarId=\'#graphSearchBarId\';\n	BaseGrid.call(this,{{className}}.prototype);\n}\n\n{{className}}.prototype={\n	init:function(){\n		var self=this;\n				 var cbxOptions=\n			    {\n			        url:\'index.php/{{projectname}}/open/get_app_name\',\n			        selector:\"#project\",\n                  	before:function(op,data){\n                      return data.unshift({value:\'all\',text:\'所有\'})	\n                    },\n					after:function(op,data){\n						\n					}\n			    }//end cbxOptions\n		// self.combox(cbxOptions);\n        /*\n        $(\'.date-picker\').datepicker({\n         	autoclose: true,\n        	todayHighlight: true,\n        	format:\'yyyy-mm-dd\'\n        });\n        $(\'.date-picker\').val(self.date(\'Y-m-d\'));\n        */\n		\n\n		\n	},\n	render:function(){\n	  self=this;\n      var data=self.buildParam(self.graphSearchBarId);\n		$.post(\'index.php/{{projectname}}/{{filename}}/report\',data,function(data){\n			    myChart = echarts.init(document.getElementById(\'graph\')); \n				option=ec_build_ops({},data);\n				myChart.setOption(option); \n			})//end post\n	}\n	\n}\n\n\n\nvar {{instanceName}}=new {{className}}();\n\n{{instanceName}}.init();\n\n\n$(document).ready(function(){\n\n\n$(\'#searchBtn\').click(function(){\n			{{instanceName}}.render();\n			return false;  \n});\n     \n  \n $(\'#graph\').html(\'正在载入中…………\');\n     \n setTimeout(function(){\n	$(\'#searchBtn\').trigger(\'click\');\n },1500);\n     \n\n\n\n\n\n		\n\n})'),(2,'报表模板--饼图','hostname=192.168.16.179;username=web_form;password=web2015.com;database=web_SYNC_BI;dbdriver=mysql;','<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');\n\n\n\nclass {{filename}} extends Base_Controller {\n    public function __construct(){\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->model(\'{{projectname}}/{{filename}}_model\',\'model\');\n        \n\n    }\n\n\n	function index(){\n	\n		 $this->load->view(\'{{projectname}}/{{filename}}.php\');\n	}\n  \n    function report(){\n	\n		$this->model->report(); \n	}\n\n\n\n\n	\n\n\n\n\n}\n\n?>\n','<?php\nclass {{filename}}_model extends MY_Model {\n    public function __construct()\n    {\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->helper(\'echart\');\n        $this->load->helper(\'db\');\n      	$config=ec_ds_conn(\'{{db}}\');\n		$this->report_db= $this->load->database($config,true);\n        \n        \n    }\n\n  \n  	function combox(){\n      // $type= $this->input->post(\'type\');\n     	return $this->report_db->select(\'id value,name text\')->from(\'\')->get()->result_array();\n  		\n    }\n\n\n  function report(){\n      \n      $date= date(\'Y-m-d\', strtotime(\'-30 day\'));\n      /*\n      $project=$this->input->post(\'project\');\n      if($project!=\'all\'){\n      	$where_project=\" FSERVICE_NAME=\'$project\' and \";\n      } else {\n      	$where_project=\'\';\n      }\n      */\n          \n      $wdata=$this->req_data(array(\'start_time\',\'end_time\',\'project\'));\n      \n      if($wdata[\'project\']==\'all\'){\n      	$wdata[\'project\']=\'\';\n      }\n      if(trim($wdata[\'end_time\'])!=\'\'){\n      	$wdata[\'end_time\']=$wdata[\'end_time\'].\' 23:59:59\';\n      }\n      \n      $wdata[\'fphone_number\']=\'13427708928\';\n      \n      $wmap=array(\n        	\'ftime,start_time\'=>\'ge\',\n        	\'1\'=>\'and\',\n            \'ftime,end_time\'=>\'le\',\n            \'2\'=>\'and\',\n            \'FSERVICE_NAME,project\'=>\'eq\',\n            \'3\'=>\'and\',\n            \'fphone_number\'=>\'eq\'\n                  );\n     $where=where($wmap,$wdata);\n	\n         $sql=\"SELECT  CASE WHEN FTYPE=1 THEN \'慢查询\' WHEN FTYPE=2 THEN \'连接数超时\' WHEN FTYPE=3 THEN \'负载异常\' \nWHEN FTYPE=4 THEN \'宕机报警\' WHEN FTYPE=5 THEN \'非故障报警\' WHEN FTYPE=6 THEN \'复制延迟\' WHEN FTYPE=7 THEN \'oracle故障\' \nWHEN FTYPE=10 THEN \'其他未分类\' \n END  name,COUNT(1) value\nFROM T_MAS_MONITOR $where  GROUP BY FTYPE\n\n\";\n      \n     // echo $sql;\n      \n            \n      $rows= $this->report_db->query($sql)->result_array();\n	  $data[\'series\']=array(\n			array(\'name\'=>\'慢查询\',\'type\'=>\'pie\',\'radius\'=>\'55%\',\'center\'=>array(\'50%\',\'60%\'),\'data\'=>$rows),\n	  );\n\n		$data[\'title\']=array(\'text\'=>\'告警统计信息报表\',\'subtext\'=>\'\',\'x\'=>\'left\');\n	\n\n	  print_r(  json_encode(	($data)));\n       \n	 \n	}\n\n\n	\n} \n?>','\n\n<div class=\"main-content\" id=\"page_div\">\n\n\n    <div class=\"breadcrumbs\" id=\"breadcrumbs\">\n        <ul class=\"breadcrumb\">\n            <li>\n                <i class=\"ace-icon fa fa-home home-icon\"></i>\n                <a href=\"<?php echo site_url() ?>\">首页</a>\n            </li>\n            <li class=\"active\"></li>\n        </ul>\n    </div>\n\n\n    <div class=\"page-content\">\n        <div class=\"page-content-area\">\n            <div class=\"row\">\n                <div class=\"col-xs-12\">\n                \n       \n\n        <script src=\"http://echarts.baidu.com/build/echarts-plain.js\"></script>\n        \n        <script src=\"/resources/{{projectname}}/js/echarts_common.js\"></script> \n	    <script src=\"/resources/{{projectname}}/js/{{filename}}.js\"></script> \n                \n\n                                \n        <div class=\"space-2\"></div>\n        <div class=\"hr hr-dotted\"></div>\n                                \n                                \n         <div id=\"graphSearchBarId\"  class=\"page-header\">\n                <form  class=\"form-inline\">\n				<!--\n				   <label class=\"inline input-sm\">\n                        <span class=\"lbl\">项目：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"project\" name=\"project\"></select>\n                    </div>\n\n\n\n					<div class=\"input-daterange input-group\">\n                                <input type=\"text\" id=\"start_time\" name=\"start_time\" class=\"input-sm form-control date-picker\">\n                                <span class=\"input-group-addon\">\n                                <i class=\"fa fa-exchange\"></i>\n                                </span>\n                                <input type=\"text\" id=\"end_time\" name=\"end_time\" class=\"input-sm form-control date-picker\">\n                       </div>\n\n					<label class=\"inline input-sm\">\n                        <span class=\"lbl\">周期：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"cycle\" name=\"cycle\">\n							<option value=\"1\">按日</option>\n							<option value=\"2\">按周</option>\n							<option value=\"3\">按月</option>\n						</select>\n						<input type=\"hidden\" name=\"type\" id=\"type\" value=\"1\" />\n                    </div>\n					-->\n\n                   \n\n                    <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">刷新</span>\n                    </button>\n\n					 <!--\n					  <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn2\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">查询</span>\n                    </button>\n					-->\n        \n                </form>\n            </div>\n\n                            <div>\n                               <div id=\"graph\" style=\"width:100%;height:500px;\"></div>\n                            </div>\n\n                           \n                    \n                    \n                    \n                    <!-- PAGE CONTENT ENDS -->\n                </div>\n                <!-- /.col -->\n            </div>\n            <!-- /.row -->\n        </div>\n        <!-- /.page-content-area -->\n    </div>\n    <!-- /.page-content -->\n</div>\n<!-- /.main-content -->\n','function {{className}}(){\n    this.graphSearchBarId=\'#graphSearchBarId\';\n	BaseGrid.call(this,{{className}}.prototype);\n}\n\n{{className}}.prototype={\n	init:function(){\n		var self=this;\n				 var cbxOptions=\n			    {\n			        url:\'index.php/{{projectname}}/open/get_app_name\',\n			        selector:\"#project\",\n                  	before:function(op,data){\n                      return data.unshift({value:\'all\',text:\'所有\'})	\n                    },\n					after:function(op,data){\n						\n					}\n			    }//end cbxOptions\n		// self.combox(cbxOptions);\n        /*\n        $(\'.date-picker\').datepicker({\n         	autoclose: true,\n        	todayHighlight: true,\n        	format:\'yyyy-mm-dd\'\n        });\n        $(\'.date-picker\').val(self.date(\'Y-m-d\'));\n        */\n		\n\n		\n	},\n	render:function(){\n	  self=this;\n      var data=self.buildParam(self.graphSearchBarId);\n		$.post(\'index.php/{{projectname}}/{{filename}}/report\',data,function(data){\n			    myChart = echarts.init(document.getElementById(\'graph\')); \n				option=ec_pie_ops({},data,\'graph\');\n				myChart.setOption(option); \n			})//end post\n	}\n	\n}\n\n\n\nvar {{instanceName}}=new {{className}}();\n\n{{instanceName}}.init();\n\n\n$(document).ready(function(){\n\n\n$(\'#searchBtn\').click(function(){\n			{{instanceName}}.render();\n			return false;  \n});\n     \n  \n $(\'#graph\').html(\'正在载入中…………\');\n     \n setTimeout(function(){\n	$(\'#searchBtn\').trigger(\'click\');\n },1500);\n     \n\n\n\n\n\n		\n\n})'),(3,'报表模板--表格','hostname=192.168.16.179;username=web_form;password=web2015.com;database=web_SYNC_BI;dbdriver=mysql;','<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');\n\n\n\nclass {{filename}} extends Base_Controller {\n    public function __construct(){\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->model(\'{{projectname}}/{{filename}}_model\',\'model\');\n        \n\n    }\n\n\n	function index(){\n	\n		 $this->load->view(\'{{projectname}}/{{filename}}.php\');\n	}\n  \n    function report(){\n	\n		$this->model->report(); \n	}\n\n\n\n\n	\n\n\n\n\n}\n\n?>\n','<?php\nclass {{filename}}_model extends MY_Model {\n    public function __construct()\n    {\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->helper(\'echart\');\n        $this->load->helper(\'db\');\n      	$config=ec_ds_conn(\'{{db}}\');\n		$this->report_db= $this->load->database($config,true);\n        \n        \n    }\n\n\n	function report(){\n      /*\n      $wdata=$this->req_data(array(\'start_time\',\'end_time\',\'project\'));\n      \n      if($wdata[\'project\']==\'all\'){\n      	$wdata[\'project\']=\'\';\n      }\n      \n      $wmap=array(\n        	\'collect_time,start_time\'=>\'ge\',\n        	\'1\'=>\'and\',\n            \'collect_time,end_time\'=>\'le\',\n            \'2\'=>\'and\',\n            \'name,project\'=>\'eq\',\n                  );\n     $where=where($wmap,$wdata);\n     */\n	\n         $sql=\"SELECT ftime,SUM(type1) AS \'type1\',SUM(type2) AS \'type2\',SUM(type3) AS \'type3\',SUM(type4) AS \'type4\',SUM(type5) AS \'type5\',SUM(type6) AS \'type6\',SUM(type7) AS \'type7\',SUM(type10) AS \'type10\' FROM (\nSELECT DATE(ftime) AS ftime,\nSUM(CASE ftype WHEN 1 THEN 1 ELSE 0 END ) AS type1,\nSUM(CASE ftype WHEN 2 THEN 1 ELSE 0 END ) AS type2,\nSUM(CASE ftype WHEN 3 THEN 1 ELSE 0 END ) AS type3,\nSUM(CASE ftype WHEN 4 THEN 1 ELSE 0 END ) AS type4,\nSUM(CASE ftype WHEN 5 THEN 1 ELSE 0 END ) AS type5,\nSUM(CASE ftype WHEN 6 THEN 1 ELSE 0 END ) AS type6,\nSUM(CASE ftype WHEN 7 THEN 1 ELSE 0 END ) AS type7,\nSUM(CASE ftype WHEN 10 THEN 1 ELSE 0 END ) AS type10\nFROM T_MAS_MONITOR WHERE fphone_number=\'13427708928\' AND DATE(ftime)>=\'2014-10-31\' GROUP BY DATE(ftime) ,ftype) t GROUP BY ftime;\n\n\";\n      \n            \n      $rows= $this->report_db->query($sql)->result_array();\n      \n      		$rows= ec_ds_trans( $rows);\n\n		$rows[\'series\']=array(\n			array(\'name\'=>\'慢查询\',\'type\'=>\'line\',\'data\'=>\'type1\'),\n			array(\'name\'=>\'连接数超时\',\'type\'=>\'line\',\'data\'=>\'type2\'),\n          array(\'name\'=>\'负载异常\',\'type\'=>\'line\',\'data\'=>\'type3\'),\n           array(\'name\'=>\'宕机报警\',\'type\'=>\'line\',\'data\'=>\'type4\'),\n           array(\'name\'=>\'非故障报警\',\'type\'=>\'line\',\'data\'=>\'type5\'),\n			);\n		$rows[\'xAxis\']=array(\n			array(\'name\'=>\'时间\',\'type\'=>\'line\',\'data\'=>\'ftime\')\n			);\n		$rows[\'title\']=array(\'text\'=>\'告警统计信息报表\',\'subtext\'=>\'\',\'x\'=>\'left\');\n	\n\n	  print_r(  json_encode(	($rows)));\n       \n	 \n	}\n  \n  	function combox(){\n      // $type= $this->input->post(\'type\');\n     	return $this->report_db->select(\'id value,name text\')->from(\'\')->get()->result_array();\n  		\n    }\n\n	\n\n	\n} \n?>','\n\n<div class=\"main-content\" id=\"page_div\">\n\n\n    <div class=\"breadcrumbs\" id=\"breadcrumbs\">\n        <ul class=\"breadcrumb\">\n            <li>\n                <i class=\"ace-icon fa fa-home home-icon\"></i>\n                <a href=\"<?php echo site_url() ?>\">首页</a>\n            </li>\n            <li class=\"active\"></li>\n        </ul>\n    </div>\n\n\n    <div class=\"page-content\">\n        <div class=\"page-content-area\">\n            <div class=\"row\">\n                <div class=\"col-xs-12\">\n                \n       \n\n        <script src=\"http://echarts.baidu.com/build/echarts-plain.js\"></script>\n        \n        <script src=\"/resources/{{projectname}}/js/echarts_common.js\"></script> \n	    <script src=\"/resources/{{projectname}}/js/{{filename}}.js\"></script> \n                \n\n                                \n        <div class=\"space-2\"></div>\n        <div class=\"hr hr-dotted\"></div>\n                                \n                                \n         <div id=\"graphSearchBarId\"  class=\"page-header\">\n                <form  class=\"form-inline\">\n				<!--\n				   <label class=\"inline input-sm\">\n                        <span class=\"lbl\">项目：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"project\" name=\"project\"></select>\n                    </div>\n\n\n\n					<div class=\"input-daterange input-group\">\n                                <input type=\"text\" id=\"start_time\" name=\"start_time\" class=\"input-sm form-control date-picker\">\n                                <span class=\"input-group-addon\">\n                                <i class=\"fa fa-exchange\"></i>\n                                </span>\n                                <input type=\"text\" id=\"end_time\" name=\"end_time\" class=\"input-sm form-control date-picker\">\n                       </div>\n\n					<label class=\"inline input-sm\">\n                        <span class=\"lbl\">周期：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"cycle\" name=\"cycle\">\n							<option value=\"1\">按日</option>\n							<option value=\"2\">按周</option>\n							<option value=\"3\">按月</option>\n						</select>\n						<input type=\"hidden\" name=\"type\" id=\"type\" value=\"1\" />\n                    </div>\n					-->\n\n                   \n\n                    <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">刷新</span>\n                    </button>\n\n					 <!--\n					  <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn2\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">查询</span>\n                    </button>\n					-->\n        \n                </form>\n            </div>\n\n                            <div>\n                               <div id=\"graph\" style=\"width:100%;height:500px;\"></div>\n                            </div>\n\n                           \n                    \n                    \n                    \n                    <!-- PAGE CONTENT ENDS -->\n                </div>\n                <!-- /.col -->\n            </div>\n            <!-- /.row -->\n        </div>\n        <!-- /.page-content-area -->\n    </div>\n    <!-- /.page-content -->\n</div>\n<!-- /.main-content -->\n','function {{className}}(){\n    this.graphSearchBarId=\'#graphSearchBarId\';\n	BaseGrid.call(this,{{className}}.prototype);\n}\n\n{{className}}.prototype={\n	init:function(){\n		var self=this;\n				 var cbxOptions=\n			    {\n			        url:\'index.php/report/open/get_app_name\',\n			        selector:\"#project\",\n                  	before:function(op,data){\n                      return data.unshift({value:\'all\',text:\'所有\'})	\n                    },\n					after:function(op,data){\n						\n					}\n			    }//end cbxOptions\n		// self.combox(cbxOptions);\n        /*\n        $(\'.date-picker\').datepicker({\n         	autoclose: true,\n        	todayHighlight: true,\n        	format:\'yyyy-mm-dd\'\n        });\n        $(\'.date-picker\').val(self.date(\'Y-m-d\'));\n        */\n		\n\n		\n	},\n	render:function(){\n	  self=this;\n      var data=self.buildParam(self.graphSearchBarId);\n		$.post(\'index.php/report/{{filename}}/report\',data,function(data){\n			    myChart = echarts.init(document.getElementById(\'graph\')); \n				option=ec_build_ops({},data);\n				myChart.setOption(option); \n			})//end post\n	}\n	\n}\n\n\n\nvar {{instanceName}}=new {{className}}();\n\n{{instanceName}}.init();\n\n\n$(document).ready(function(){\n\n\n$(\'#searchBtn\').click(function(){\n			{{instanceName}}.render();\n			return false;  \n});\n     \n  \n $(\'#graph\').html(\'正在载入中…………\');\n     \n setTimeout(function(){\n	$(\'#searchBtn\').trigger(\'click\');\n },1500);\n     \n\n\n\n\n\n		\n\n})'),(4,'报表模板--待定','hostname=192.168.16.179;username=web_form;password=web2015.com;database=web_SYNC_BI;dbdriver=mysql;','<?php if ( ! defined(\'BASEPATH\')) exit(\'No direct script access allowed\');\n\n\n\nclass {{filename}} extends Base_Controller {\n    public function __construct(){\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->model(\'{{projectname}}/{{filename}}_model\',\'model\');\n        \n\n    }\n\n\n	function index(){\n	\n		 $this->load->view(\'{{projectname}}/{{filename}}.php\');\n	}\n  \n    function report(){\n	\n		$this->model->report(); \n	}\n\n\n\n\n	\n\n\n\n\n}\n\n?>\n','<?php\nclass {{filename}}_model extends MY_Model {\n    public function __construct()\n    {\n        parent::__construct();\n		$this->load->helper(\'date\');\n        $this->load->helper(\'echart\');\n        $this->load->helper(\'db\');\n      	$config=ec_ds_conn(\'{{db}}\');\n		$this->report_db= $this->load->database($config,true);\n        \n        \n    }\n\n\n	function report(){\n      /*\n      $wdata=$this->req_data(array(\'start_time\',\'end_time\',\'project\'));\n      \n      if($wdata[\'project\']==\'all\'){\n      	$wdata[\'project\']=\'\';\n      }\n      \n      $wmap=array(\n        	\'collect_time,start_time\'=>\'ge\',\n        	\'1\'=>\'and\',\n            \'collect_time,end_time\'=>\'le\',\n            \'2\'=>\'and\',\n            \'name,project\'=>\'eq\',\n                  );\n     $where=where($wmap,$wdata);\n     */\n	\n         $sql=\"SELECT ftime,SUM(type1) AS \'type1\',SUM(type2) AS \'type2\',SUM(type3) AS \'type3\',SUM(type4) AS \'type4\',SUM(type5) AS \'type5\',SUM(type6) AS \'type6\',SUM(type7) AS \'type7\',SUM(type10) AS \'type10\' FROM (\nSELECT DATE(ftime) AS ftime,\nSUM(CASE ftype WHEN 1 THEN 1 ELSE 0 END ) AS type1,\nSUM(CASE ftype WHEN 2 THEN 1 ELSE 0 END ) AS type2,\nSUM(CASE ftype WHEN 3 THEN 1 ELSE 0 END ) AS type3,\nSUM(CASE ftype WHEN 4 THEN 1 ELSE 0 END ) AS type4,\nSUM(CASE ftype WHEN 5 THEN 1 ELSE 0 END ) AS type5,\nSUM(CASE ftype WHEN 6 THEN 1 ELSE 0 END ) AS type6,\nSUM(CASE ftype WHEN 7 THEN 1 ELSE 0 END ) AS type7,\nSUM(CASE ftype WHEN 10 THEN 1 ELSE 0 END ) AS type10\nFROM T_MAS_MONITOR WHERE fphone_number=\'13427708928\' AND DATE(ftime)>=\'2014-10-31\' GROUP BY DATE(ftime) ,ftype) t GROUP BY ftime;\n\n\";\n      \n            \n      $rows= $this->report_db->query($sql)->result_array();\n      \n      		$rows= ec_ds_trans( $rows);\n\n		$rows[\'series\']=array(\n			array(\'name\'=>\'慢查询\',\'type\'=>\'line\',\'data\'=>\'type1\'),\n			array(\'name\'=>\'连接数超时\',\'type\'=>\'line\',\'data\'=>\'type2\'),\n          array(\'name\'=>\'负载异常\',\'type\'=>\'line\',\'data\'=>\'type3\'),\n           array(\'name\'=>\'宕机报警\',\'type\'=>\'line\',\'data\'=>\'type4\'),\n           array(\'name\'=>\'非故障报警\',\'type\'=>\'line\',\'data\'=>\'type5\'),\n			);\n		$rows[\'xAxis\']=array(\n			array(\'name\'=>\'时间\',\'type\'=>\'line\',\'data\'=>\'ftime\')\n			);\n		$rows[\'title\']=array(\'text\'=>\'告警统计信息报表\',\'subtext\'=>\'\',\'x\'=>\'left\');\n	\n\n	  print_r(  json_encode(	($rows)));\n       \n	 \n	}\n  \n  	function combox(){\n      // $type= $this->input->post(\'type\');\n     	return $this->report_db->select(\'id value,name text\')->from(\'\')->get()->result_array();\n  		\n    }\n\n	\n\n	\n} \n?>','\n\n<div class=\"main-content\" id=\"page_div\">\n\n\n    <div class=\"breadcrumbs\" id=\"breadcrumbs\">\n        <ul class=\"breadcrumb\">\n            <li>\n                <i class=\"ace-icon fa fa-home home-icon\"></i>\n                <a href=\"<?php echo site_url() ?>\">首页</a>\n            </li>\n            <li class=\"active\"></li>\n        </ul>\n    </div>\n\n\n    <div class=\"page-content\">\n        <div class=\"page-content-area\">\n            <div class=\"row\">\n                <div class=\"col-xs-12\">\n                \n       \n\n        <script src=\"http://echarts.baidu.com/build/echarts-plain.js\"></script>\n        \n        <script src=\"/resources/{{projectname}}/js/echarts_common.js\"></script> \n	    <script src=\"/resources/{{projectname}}/js/{{filename}}.js\"></script> \n                \n\n                                \n        <div class=\"space-2\"></div>\n        <div class=\"hr hr-dotted\"></div>\n                                \n                                \n         <div id=\"graphSearchBarId\"  class=\"page-header\">\n                <form  class=\"form-inline\">\n				<!--\n				   <label class=\"inline input-sm\">\n                        <span class=\"lbl\">项目：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"project\" name=\"project\"></select>\n                    </div>\n\n\n\n					<div class=\"input-daterange input-group\">\n                                <input type=\"text\" id=\"start_time\" name=\"start_time\" class=\"input-sm form-control date-picker\">\n                                <span class=\"input-group-addon\">\n                                <i class=\"fa fa-exchange\"></i>\n                                </span>\n                                <input type=\"text\" id=\"end_time\" name=\"end_time\" class=\"input-sm form-control date-picker\">\n                       </div>\n\n					<label class=\"inline input-sm\">\n                        <span class=\"lbl\">周期：</span>\n                    </label>\n\n                    <div class=\"form-group\">\n                        <select id=\"cycle\" name=\"cycle\">\n							<option value=\"1\">按日</option>\n							<option value=\"2\">按周</option>\n							<option value=\"3\">按月</option>\n						</select>\n						<input type=\"hidden\" name=\"type\" id=\"type\" value=\"1\" />\n                    </div>\n					-->\n\n                   \n\n                    <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">刷新</span>\n                    </button>\n\n					 <!--\n					  <span> &nbsp;&nbsp;</span>\n                    <button id=\"searchBtn2\" class=\"btn btn-xs   btn-purple\">\n                        <i class=\"ace-icon fa  fa-search  bigger-110\"></i>\n                        <span class=\"bigger-110 no-text-shadow\">查询</span>\n                    </button>\n					-->\n        \n                </form>\n            </div>\n\n                            <div>\n                               <div id=\"graph\" style=\"width:100%;height:500px;\"></div>\n                            </div>\n\n                           \n                    \n                    \n                    \n                    <!-- PAGE CONTENT ENDS -->\n                </div>\n                <!-- /.col -->\n            </div>\n            <!-- /.row -->\n        </div>\n        <!-- /.page-content-area -->\n    </div>\n    <!-- /.page-content -->\n</div>\n<!-- /.main-content -->\n','function {{className}}(){\n    this.graphSearchBarId=\'#graphSearchBarId\';\n	BaseGrid.call(this,{{className}}.prototype);\n}\n\n{{className}}.prototype={\n	init:function(){\n		var self=this;\n				 var cbxOptions=\n			    {\n			        url:\'index.php/report/open/get_app_name\',\n			        selector:\"#project\",\n                  	before:function(op,data){\n                      return data.unshift({value:\'all\',text:\'所有\'})	\n                    },\n					after:function(op,data){\n						\n					}\n			    }//end cbxOptions\n		// self.combox(cbxOptions);\n        /*\n        $(\'.date-picker\').datepicker({\n         	autoclose: true,\n        	todayHighlight: true,\n        	format:\'yyyy-mm-dd\'\n        });\n        $(\'.date-picker\').val(self.date(\'Y-m-d\'));\n        */\n		\n\n		\n	},\n	render:function(){\n	  self=this;\n      var data=self.buildParam(self.graphSearchBarId);\n		$.post(\'index.php/{{projectname}}/{{filename}}/report\',data,function(data){\n			    myChart = echarts.init(document.getElementById(\'graph\')); \n				option=ec_build_ops({},data);\n				myChart.setOption(option); \n			})//end post\n	}\n	\n}\n\n\n\nvar {{instanceName}}=new {{className}}();\n\n{{instanceName}}.init();\n\n\n$(document).ready(function(){\n\n\n$(\'#searchBtn\').click(function(){\n			{{instanceName}}.render();\n			return false;  \n});\n     \n  \n $(\'#graph\').html(\'正在载入中…………\');\n     \n setTimeout(function(){\n	$(\'#searchBtn\').trigger(\'click\');\n },1500);\n     \n\n\n\n\n\n		\n\n})');
/*!40000 ALTER TABLE `sys_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user`
--

DROP TABLE IF EXISTS `sys_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL COMMENT '名字拼音',
  `password` varchar(45) NOT NULL COMMENT '密码',
  `truename` varchar(45) NOT NULL DEFAULT '' COMMENT '中文名',
  `email` varchar(80) NOT NULL COMMENT 'email',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `sys_group_id` varchar(255) NOT NULL COMMENT '组ID',
  `flag_valid` tinyint(1) NOT NULL COMMENT '0:无效，1：有效',
  `team` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`user_name`,`email`),
  UNIQUE KEY `username_UNIQUE` (`user_name`),
  KEY `k_group_id` (`sys_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user`
--

LOCK TABLES `sys_user` WRITE;
/*!40000 ALTER TABLE `sys_user` DISABLE KEYS */;
INSERT INTO `sys_user` VALUES (15,'s-jqzhang','dbbdca5606f3b0d381f277e694dc0aa1','s-jqzhang','s-jqzhang@web.com','2015-04-17 06:24:07','1',1,NULL);
/*!40000 ALTER TABLE `sys_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_user_group`
--

DROP TABLE IF EXISTS `sys_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_user_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `group_name` varchar(40) NOT NULL COMMENT '组名',
  `parent_id` int(11) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_user_group`
--

LOCK TABLES `sys_user_group` WRITE;
/*!40000 ALTER TABLE `sys_user_group` DISABLE KEYS */;
INSERT INTO `sys_user_group` VALUES (1,'超级管理员',0,NULL,NULL),(3,'普通用户',0,NULL,NULL),(10,'测试组',0,NULL,NULL);
/*!40000 ALTER TABLE `sys_user_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-23 14:13:14
