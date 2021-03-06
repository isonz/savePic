<?php
error_reporting(E_ALL);
ini_set("display_startup_errors","1");
ini_set("display_errors","On");
set_time_limit(0);

//======================================= Basic
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if(!defined('_SITE')){
    define('_SITE', dirname(__FILE__) . DS);
}
if(!defined('_LIBS')){
    define('_LIBS', _SITE . 'libs' . DS);
}
if(!defined('_MODS')){
	define('_MODS', _SITE . 'mods' . DS);
}
if(!defined('_MODULES')){
	define('_MODULES', _SITE . 'modules' . DS);
}
if(!defined('_VIEWS')){
	define('_VIEWS', _SITE . 'views' . DS);
}
if(!defined('_DATA')){
	define('_DATA', _SITE . 'data' . DS);
}
if(!defined('_LOGS')){
    define('_LOGS', _DATA . 'logs' . DS);
}
if(!defined('_DOWNLOAD')){
	define('_DOWNLOAD', _DATA . 'download' . DS);
}
//------------------------ encoding
if(!defined('_ENCODING')){
	define('_ENCODING', 'UTF-8');
}
//======================================= Smarty
if(!defined('_SMARTY')){
	define('_SMARTY', _LIBS . 'Smarty' . DS);
}
if(!defined('_SMARTY_TEMPLATE')){
	define('_SMARTY_TEMPLATE', _SITE .'template' . DS);
}
if(!defined('_SMARTY_COMPILED')){
	define('_SMARTY_COMPILED', _DATA . 'compileds' . DS);
}
if(!defined('_SMARTY_CACHE')){
	define('_SMARTY_CACHE', _DATA . 'caches' . DS);
}
if(!defined('_HTMLDOM')){
	define('_HTMLDOM', _LIBS . 'Htmldom' . DS);
}
//======================================== Config
$GLOBALS['CONFIG_DATABASE'] = array(
	'host'      => '127.0.0.1',
    'user'      => '',
    'pwd'       => '',
    'dbname'    => '',
	'port'      => 3306,
	'tb_prefix' => ''
);

$GLOBALS['SLEEP_TIME'] = array(
	'time'      => 300,      //second
);

foreach (glob(_LIBS."/*.php") as $libs){
	require_once $libs;
}
foreach (glob(_MODS."/*.php") as $mods){
	require_once $mods;
}
foreach (glob(_MODULES."/*.php") as $modules){
	require_once $modules;
}
foreach (glob(_SMARTY."/*.php") as $lib_smarty){
	require_once $lib_smarty;
}
foreach (glob(_HTMLDOM."/*.php") as $htmldom){
	require_once $htmldom;
}


