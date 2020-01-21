<?php

if (!defined('_PLUGSECURE_')){
    die('Прямой вызов запрещен!');
}

class Modules{
    private static $className = 'Модули';

    public static function getClassName(){
        return self::$className;
    }

    public static function getModule($module){

        if (file_exists('./includes/modules/custom/'.$module.'/'.$module.'.inc')){
            require_once './includes/modules/custom/'.$module.'/'.$module.'.inc';
            return './includes/modules/custom/'.$module.'/'.$module.'.inc';
        }elseif (file_exists('./includes/modules/stock/'.$module.'/'.$module.'.inc')){
            require_once './includes/modules/stock/'.$module.'/'.$module.'.inc';
            return './includes/modules/stock/'.$module.'/'.$module.'.inc';
        }else{
            return false;
        }

    }
}
