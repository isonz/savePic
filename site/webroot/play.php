<?php
$category = isset($_REQUEST['c']) ? $_REQUEST['c'] : null;
$ajax = isset($_REQUEST['ajax']) ? $_REQUEST['ajax'] : null;
if(!$ajax){
	Templates::Assign('category', $category);
	Templates::Display('play.tpl');
}else{
	$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;
	$page = isset($_REQUEST['page']) ? (int)$_REQUEST['page'] : 1;
	$size = isset($_REQUEST['size']) ? (int)$_REQUEST['size'] : 30;
	if($page<1) $page = 1;
	if($size<1) $size = 1;
	
	switch ($type)
	{
		case 'getCategory':
			ImagePlay::getCategory(_DOWNLOAD);
			break;
		case 'getPagesCount':
			ImagePlay::getPagesCount(_DOWNLOAD.$category.DS, $size);
			break;
		case 'getPagePic':
			ImagePlay::getPagePic(_DOWNLOAD.$category.DS, $size, $page);
			break;
		default:
			ABase::toJson(1,'No Type');
			break;
	}
	
}


