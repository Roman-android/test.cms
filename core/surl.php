<?php

if (!defined('_PLUGSECURE_')) {
    die('Прямой вызов модуля запрещен!');
}

class Surl
{
    private static $classname = "ЧПУ";

    public static function getClassName()
    {
        return self::$classname;
    }

    public static function parseUrl($type, $requset_uri)
    {

        if ($requset_uri != '/')
        {
            $data = array();
            $query_alias = database::prepareQuery("SELECT * FROM `aliases` WHERE `alias` = 's:uri';", array('uri' => $_SERVER['REQUEST_URI']));
            if($query_alias->num_rows)
            {
                $alias = $query_alias->fetch_assoc();
                $requset_uri = $alias['address'];
            }
            if($type == 1)
            {
                $url_path = parse_url($requset_uri, PHP_URL_PATH);
                $uri_parts = explode('/', trim($url_path, ' /'));

                //если количество элементов в массиве $uri_parts, деленое на 2 нечетное, т.е. отличное от нуля
                // и следовательно существует, значит адрес не семантический (или в адресной строке только модуль без действия и параметров)
                if (count($uri_parts) % 2)
                {
                    if(isset($_GET['module']))
                    {
                        echo '<div style="color: #ffffff;">1. uri_parts='.$uri_parts[0].'; count($uri_parts)='.count($uri_parts).'</div>';
                        $data['module'] = $_GET['module'];
                        unset($_GET['module']);

                        if(isset($_GET['action'])){
                            $data['action'] = $_GET['action'];
                            unset($_GET['action']);
                        }

                        foreach ($_GET as $key => $value)
                        {
                            $data['params'][$key] = $value;
                        }
                    }
                    else
                    {
                        $uri_parts = explode('&', trim($url_path, ' /'));
                        echo '<div style="color: #ffffff;">2. uri_parts='.$uri_parts[0].'; count($uri_parts)='.count($uri_parts).'</div>';
                        if(modules::getModule($uri_parts[0])){
                            modules::getModule($uri_parts[0]);
                            $data['module'] = array_shift($uri_parts);
                        }
                        else
                            handler::engineError('exception', 'Запрос не может быть обработан');
                    }
                }
                //если количество элементов в массиве $uri_parts, деленое на 2 четное (семантический адрес)
                else
                {//todo внимательно посмотреть!!!
                    echo '<div style="color: #ffffff;">3. uri_parts='.$uri_parts[2].'; count($uri_parts)='.count($uri_parts).'</div>';
                    modules::getModule($uri_parts[0]);
                        $data['module'] = array_shift($uri_parts);
                        $data['action'] = array_shift($uri_parts);

                        for ($i=0; $i < count($uri_parts); $i++)
                        {
                            $data['params'][$uri_parts[$i]] = $uri_parts[++$i];
                        }
                    echo '<div style="color: #ffffff;">3.1. $data[\'action\']='.$data['action'].'</div>';
                    echo '<div style="color: #ffffff;">3.2. $data["params"]['.$uri_parts[0].'] = '.$uri_parts[1].'</div>';


                }
                return $data;
            }
            else
            {
                if(isset($_GET['module']))
                {
                    $data['module'] = $_GET['module']; unset($_GET['module']);

                    if(isset($_GET['action']))
                    {
                        $data['action'] = $_GET['action']; unset($_GET['action']);
                    }

                    foreach ($_GET as $key => $value)
                    {
                        $data['params'][$key] = $value;
                    }
                }
                else
                {
                    handler::engineError('exception', 'Запрос не может быть обработан');
                }
                return $data;
            }
        }
        return;
    }

    public static function genUri($module, $action = null, $params = null){
        if(config::$s_url){
            $result = '/'.$module.'/';
            if($action){
                $result .= $action.'/';

                if(is_array($params)){
                    foreach ($params as $key => $value) {
                        $result .= $key.'/'.$value.'/';
                    }
                }
            }
        }else{
            $result = '/?module='.$module;
            if($action){
                $result .= '&action='.$action;

                if(is_array($params)){
                    foreach ($params as $key => $value) {
                        $result .= '&'.$key.'='.$value;
                    }
                }
            }
        }

        return $result;
    }
}

?>