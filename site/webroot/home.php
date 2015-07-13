<?php
$module = isset($_REQUEST['module']) ? $_REQUEST['module'] : null;
$page = isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : null;
$epage = isset($_REQUEST['epage']) ? (int)$_REQUEST['epage'] : null;
if(!$module){
	Templates::Display('home.tpl');
}else{
	$module::run($page,$epage);
}


