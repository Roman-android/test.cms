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

}



?>