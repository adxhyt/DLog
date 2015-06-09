<?php
date_default_timezone_set("PRC");

// 建议直接使用框架提供的预定义常量 
define('ROOT_PATH', dirname(__FILE__) . "/../src/lib");

// 建议直接使用框架的autoload 
require_once( ROOT_PATH . "/DLog.php");

// 打日志同时，会输出到终端(仅用于脚本开发调试) 
DLog::useLogerStdOut();

// 指定当前loger为app1, 日志会打印到app1/app1.log[.wf] 
DLog::setLogger('app1'); 

$log_args = array(
    'key1' => 'value1',
    'key2' => 'value2',
);
DLog::debug("this is debug");
DLog::trace("this is trace");
DLog::notice("this is notice");
DLog::warning("this is warning", '404');
DLog::fatal("this is fatal", '500', $log_args);


DLog::pushKey("newkey",'xxx');
DLog::notice("this is notice app1, with newkey");

DLog::setLogger('app2'); 
DLog::notice("this is notice app2");

DLog::setLogger('app1'); 
DLog::notice("this is notice back to app1, still with newkey :)");
