<?php

if (!defined('_PLUGSECURE_')){
    die('Прямой вызов запрещен!');
}

class Modules{
    private static $className = 'Модули';

    public static function getClassName(){
        return self::$className;
    }

/*    private function __construct(){
        self::getModule();
    }*/
    public static function getModule($module){
        echo '<div style="color: #ffffff;">getModule() подключен</div>';
        if (file_exists('./includes/modules/custom/'.$module.'/'.$module.'.inc')){
            require './includes/modules/custom/'.$module.'/'.$module.'.inc';
            return './includes/modules/custom/'.$module.'/'.$module.'.inc';
        }elseif (file_exists('./includes/modules/stock/'.$module.'/'.$module.'.inc')){
            /*echo '<div style="color: #ffffff;">Posts подключен</div>';*/
            require_once './includes/modules/stock/'.$module.'/'.$module.'.inc';
            return './includes/modules/stock/'.$module.'/'.$module.'.inc';
        }else{
            return false;
        }
    }
}
