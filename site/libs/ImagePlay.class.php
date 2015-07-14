<?php
class ImagePlay
{
	static private $_filetype = array("jpg", "png", "gif", "bmp");
	static private $_excluded_folder = array("../play");
	static private $_show_hide = false;	 //是否显示隐藏(.开头)文件
	
	static public $dirs = array();
	static public $files = array();
	
	static public function getCategory($dirs)
	{
		if(!$dirs) return false;
		$dirs = self::get1DirsOrFile($dirs,'dir',0);
		ABase::toJson(0,'ok',$dirs);
	}
	
	static public function getPagesCount($dirs, $size)
	{
		if(!$dirs) return false;
		$dirs = self::get1DirsOrFile($dirs,'dir',0);
		$count = count($dirs);
		$page = ceil($count/$size);
		$data = array('count'=>$count, 'page'=>$page);
		ABase::toJson(0,'ok',$data);
	}
	
	static public function getPagePic($dirs, $size, $page)
	{
		if(!$dirs) return false;
		$dirs = self::get1DirsOrFile($dirs,'dir',0);
		rsort($dirs);
		$start = $size*($page-1);
		$dirs = array_slice($dirs, $start, $size);
		ABase::toJson(0,'ok',$dirs);
	}
	
	static public function getPics($dirs)
	{
		if(!$dirs) return false;
		$files = self::get1DirsOrFile($dirs,'file',0);
		return $files;
	}
	
	static public function get1DirsOrFile($dirs,$type="dir", $realpath=1)
	{
		if(!$dirs) return false;
		if(!$type) $type = 'dir';
		
		$mydir=dir($dirs);
		$tmp = array();
		while($dir = $mydir->read()){
			$reldir = $dir;
			$dir = $dirs.$dir;
			if("dir"==$type && is_dir($dir) && $dirs.'.'!=$dir && $dirs.'..'!=$dir){
				if(!$realpath){
					$tmp[]=$reldir;
				}else{
					$tmp[]=$dir;
				}
			}
			if("file"==$type && is_file($dir)){
				if(!$realpath){
					$tmp[]=$reldir;
				}else{
					$tmp[]=$dir;
				}
			}
		}
		return $tmp;
	}
	
	static public function getFolderFirstImage($dirs)
	{
		if(!$dirs) return false;
		$mydir=dir($dirs);
		while($file = $mydir->read()){
			$file = $dirs.$file;
			if(is_file($file)){
				return $file;
			}
		}
		return false;
	}
	
}