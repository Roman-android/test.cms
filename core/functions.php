<?php

if (!defined('_PLUGSECURE_')){
	die('Прямой вызов модуля запрещен!');
}

class functions{
	
	private static $className = 'Функции';
	
	//функция вывода контента
	public static function toContent($contents, $class = null){

		if($class){
			Config::$global_cms_vars['CONTENT'].= '<div class="'.$class.'">'.$contents.'</div>';
		}else{
			Config::$global_cms_vars['CONTENT'].=$contents;
		}

	}
	
	public static function setTitle($title){
		Config::$global_cms_vars['PAGE_TITLE'] = $title;
	}
	
	public static function getClassName(){
		return self::$className;
	}

	public static function testFun($content){
	    echo $content;
    }

    public static function stripPost($text)
    {
        $check_pre_tags = strpos($text, '<pre');
        if($check_pre_tags < config::$strip_posts && (!empty($check_pre_tags) || $check_pre_tags !=0))
            return substr(strip_tags($text), 0, strpos($text, ' ', $check_pre_tags)).'...';
        else
            return substr(strip_tags($text), 0, strpos($text, ' ', config::$strip_posts)).'...';
    }

}



?>