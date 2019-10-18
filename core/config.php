<?php 

if(!defined('_PLUGSECURE_')){
	die('Прямой вызов модуля запрещен!');
};

class Config{
	
	private static $className = 'Конфиг';
	public static $site_name = 'New CMS';
	
	public static $database = array(
		'host'=>'localhost',
		'port' => '3306',
		'user'=>'u47689',
		'password'=>'m9uwkybnif',
		'base'=>'u47689_test_admin',
		'charset'	=>	'utf8'		//кодировка
	);
	
	public static $s_url = 1;
	public static $global_cms_vars	= array();
	
	public static function getClassName(){
		return self::$className;
	}
	
	function __construct(){
		self::$global_cms_vars['SITE_NAME'] = self::$site_name;
		self::$global_cms_vars['PAGE_TITLE'] = '';
		self::$global_cms_vars['CONTENT'] = '';
		self::$global_cms_vars['YEAR'] = date('Y');
		self::$global_cms_vars['TIME'] = date('H:i:s');
		
		//self::$global_cms_vars['USER_NAME'] = 'GUEST';
	}
	
	//==============================
	public static $template = array(
		'dir'	=> 'templates',
		'name'	=> 'Conversion'
	);

 
}

?>