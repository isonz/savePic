<?php
$category = isset($_REQUEST['c']) ? $_REQUEST['c'] : null;
$picfolder  = isset($_REQUEST['p']) ? $_REQUEST['p'] : null;

if(!$picfolder || !$category) exit('Not Found.');

$folder = _DOWNLOAD.$category.DS.$picfolder.DS;
$pics = ImagePlay::getPics($folder);

$page_title = $picfolder ? $picfolder : "Pic";
Templates::Assign('page_title', $page_title);
Templates::Assign('category', $category);
Templates::Assign('picfolder', $picfolder);
Templates::Assign('pics', $pics);
Templates::Display('pic.tpl');

