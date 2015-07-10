<?php
$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : null;

if(!$module){
	Templates::Display('home.tpl');
}else{
	$module::run();
}


