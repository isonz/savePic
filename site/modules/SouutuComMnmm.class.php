<?php
class SouutuComMnmm
{
	static private $_indexurl = "http://www.souutu.com/mnmm/index.html";
    static private $_nexturl = "http://www.souutu.com/mnmm/index_#.html";
    static private $_cur_pos = array(1,1,1);
	static private $_urls = array();
    
	static public function run()
	{
		$urls = self::getIndexPageUrls();
		$urls = self::getInfoPages($urls);
		$urls = self::getInfoPics($urls);
	}
	
    static protected function getIndexPageUrls()
    {
    	$index_page_num = self::$_cur_pos[0];
    	$url  = self::$_indexurl;
    	if($index_page_num > 1) $url = str_replace(self::$_nexturl, '#', $index_page_num);
    	
    	$html = file_get_html($url);
    	if(!$html) return false;
    	
    	$urls = array();
    	foreach ($html->find("#load-img ul li") as $li){
    		foreach ($li->find(".timg a ") as $a){
    			$urls[$a->href] = self::$_urls[$a->href]= "";
    		}
    	}
    	$index_page_num++;
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
    			$title = $img->alt;
    			$ext=strrchr($pic,".");
    			Func::downImage($pic, $title.$ext);
    		}
    	}
    }
    
}

