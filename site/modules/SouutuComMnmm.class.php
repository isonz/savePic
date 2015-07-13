<?php
class SouutuComMnmm
{
	static private $_indexurl = "http://www.souutu.com/mnmm/index.html";
    static private $_nexturl = "http://www.souutu.com/mnmm/index_#.html";
	static private $_urls = array();
    static private $_download_dir = null;
    static private $_all_page_num = 79;
    static private $_cur_page = 1;
	
	static public function run($page = 1, $epage=0)
	{
		self::$_download_dir = _DOWNLOAD."/".__CLASS__."/";
		if(!$epage) $epage = self::$_all_page_num;
		if($page < 1) $page = 1;
		for($i=$page; $i<$epage; $i++){
			self::$_cur_page = $i;
			$urls = self::getIndexPageUrls();
			$urls = self::getInfoPages($urls);
			$urls = self::getInfoPics($urls);
		}
	}
	
    static protected function getIndexPageUrls()
    {
    	$index_page_num = self::$_cur_page;
    	$url  = self::$_indexurl;
    	if($index_page_num > 1) $url = str_replace('#', $index_page_num, self::$_nexturl);
    	$html = file_get_html($url);
    	if(!$html) return false;
    	
    	$urls = array();
    	foreach ($html->find("#load-img ul li") as $li){
    		foreach ($li->find(".timg a ") as $a){
    			$href = $a->href;
    			$urls[$href] = self::$_urls[$href]= "";
    			$n = strrchr($href, "/");
    			$n = strstr($n, '.', true);
    			Func::createDir(self::$_download_dir.$n);
    		}
    	}
    	echo $index_page_num."<br>";
    	return $urls;
    }

    static protected function getInfoPages($urls)
    {
    	$tmp = array();
    	foreach ($urls as $url => $v){
    		$html = file_get_html($url);
    		if(!$html) return false;
    		foreach ($html->find("#showImg li a") as $a){
    			$tmp[$a->href] = self::$_urls[$url][$a->href]= "";
    		};
    	}
    	return $tmp;
    }
    
    static protected function getInfoPics($urls)
    {
    	foreach ($urls as $url => $v){
    		$html = file_get_html($url);
    		if(!$html) return false;
    		foreach ($html->find("#bigImg") as $img){
    			$pic = $img->src;
    			
    			$title = strrchr($url, "/");
    			$title = strstr($title, '.', true);
    			$flod = strstr($title, '_', true);
    			if(!$flod) $flod = $title;
    				
    			$ext=strrchr($pic,".");
    			Func::downImage($pic, self::$_download_dir.$flod."/".$title.$ext);
    		}
    	}
    }
    
}

