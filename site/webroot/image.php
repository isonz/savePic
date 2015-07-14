<?php
$category = isset($_REQUEST['c']) ? $_REQUEST['c'] : null;
$picfolder  = isset($_REQUEST['p']) ? $_REQUEST['p'] : null;

if(!$picfolder || !$category){
	
}else{
	$folder = _DOWNLOAD.$category.DS.$picfolder.DS;
	$filename = ImagePlay::getFolderFirstImage($folder);
	if (!file_exists($filename)) {
		
	} else {
		$ext = substr(strrchr($filename, '.'), 1);
		switch ($ext){
			case 'png':		//进行透明处理
				$im = imagecreatefrompng($filename);
				break;
			case 'gif':
				$im = imagecreatefromgif($filename);
				break;
			case 'jpg':
			default:
				$im = imagecreatefromjpeg($filename);
		}
		header("Content-Type:text/html;charset=utf-8");
		header("Content-type: image/jpeg");

		imagejpeg($im);
		echo $im;
	}
	
}


