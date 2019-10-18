<?php

if (!defined('_PLUGSECURE_')){
    die('Прямой вызов запрещен!');
}

class Template{

    private static $className = "Шаблоны";
	
    public static function getClassName(){
        return self::$className;
    }

    private static $template;
    private static $template_dir;
    private static $template_page;
    private static $template_parts = array();
    private static $template_vars = array();

    private static function getTemplate(){
        $template_file = self::$template_dir.self::$template_page.'_template.tpl';
        if (!file_exists($template_file)){
            handler::engineError('template_not_found', $template_file);
            return;
        }else{
            self::$template = file_get_contents($template_file);
        }
    }
	
    private static function getTemplatePart($part){
        $part_file = self::$template_dir.'__'.$part.'.tpl';
        if (!file_exists($part_file)){
            handler::engineError('template_part_not_found', $part_file);
            return;
        }else{
            $template_part = file_get_contents($part_file);
            return $template_part;
        }
    }
	
    private static function parseTemplate(){
        foreach (self::$template_parts as $replace){
			
            //если в шаблоне встречается определенный тег части шаблона
            if (substr_count(self::$template,'{*'.$replace.'*}')>0){
                //обрабатываем тег {*TAG:*}
                self::$template = str_replace('{*'.$replace.'*}',self::getTemplatePart($replace),self::$template);
            }
        }
		
        //теперь парсим на переменные самой системы {:TAG:}
        foreach (self::$template_vars as $find=>$replace){

            //теперь обрабатываем теги {:TAG:}
            self::$template = str_replace('{:'.$find.':}',$replace,self::$template);
        }
        self::$template;
    }

    public static function loadTemplate($data, $page, $vars){
        if(!empty($data['dir']) && !empty($data['name'])){

            if(!file_exists('./' . $data['dir'] . '/' . $data['name'] . '/' . $data['name'] . '.php')){
                handler::engineError('template_not_found', $data['dir'] . '/' . $data['name'] . '/' . $data['name'] . '.php');
            }else{
                self::$template_dir = './' . $data['dir'] . '/' . $data['name'] . '/';
                require_once self::$template_dir . $data['name'] . '.php';
                self::$template_page = $page;
                self::$template_parts = $t_files;
                self::$template_vars = $vars;
                self::getTemplate();
                self::parseTemplate();
                return self::$template;
            }
        }else{
            handler::engineError('template_not_configure');
        }

    }

	
}