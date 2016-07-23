<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Rbac config
|--------------------------------------------------------------------------
*/

$config['rbac_auth_on']	             = TRUE;			      	//是否开启认证
$config['rbac_notauth_dirc']         = array("welcome","public","home","cron","sys_open","sys_log");  //默认无需认证目录array("public","manage")
