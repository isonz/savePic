<?php
$category = isset($_REQUEST['c']) ? $_REQUEST['c'] : null;
$picfolder  = isset($_REQUEST['p']) ? $_REQUEST['p'] : null;
$first  = isset($_REQUEST['first']) ? $_REQUEST['first'] : 0;
$filename = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;

if(!$picfolder || !$category){
	
}else{
	$folder = _DOWNLOAD.$category.DS.$picfolder.DS;
	if($filename){
		$filename = $folder.$filename;
	}else if($first){
		$filename = ImagePlay::getFolderFirstImage($folder);
	}else{
		exit('Param Error.');
	}
	
	if (!file_exists($filename)) {
		exit("Not Found Image.");
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


