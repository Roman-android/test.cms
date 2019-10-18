<?php

if (!defined('_PLUGSECURE_')) {
    die('Прямой вызов модуля запрещен!');
}

class Surl
{
    private static $classname = "ЧПУ";
    
    public static function getClassName(){
        return self::$classname;
    }

	public static function parseUrl($type,$request_uri){
		$data = array();
		$quety_alias = database::query("SELECT * FROM `aliases` WHERE `alias`='".$_SERVER['REQUEST_URI']."';");
		if($quety_alias -> num_rows){
			$alias = $quety_alias -> fetch_assoc();
			$request_uri = $alias['addres'];
		}

		if($type == 1){
			if($request_uri != '/'){
				$url_path = parse_url($request_uri,PHP_URL_PATH);
				$uri_parts = explode('/',trim($url_path,'/'));
				if(count($uri_parts)%2){
					$uri_parts = explode('&',trim($url_path,'/'));
					if(isset($_GET['module']) & isset($_GET['action'])){
						$data['module'] = $_GET['module'];
						$data['action'] = $_GET['action'];
						unset($_GET['module']);
						unset($_GET['action']);
						foreach($_GET as $key=>$value){
							$data['params'][$key] = $value;
							}
						}else{
							die('Запрос не может быть обработан 1.');
						}
					}else{
						$data['module'] = array_shift($uri_parts);
						$data['action'] = array_shift($uri_parts);
						for($i=0;$i<count($uri_parts);$i++){
							$data['params'][$uri_parts[$i]] = $uri_parts[++$i];
						}
					}
				}
				return $data;
			}else{
				if ($request_uri != '/'){
					$url_path = parse_url($request_uri, PHP_URL_PATH);
					//$uri_parts = explode('&', trim($url_path, ' /'));
					if(isset($_GET['module']) & isset($_GET['action'])){
						$data['module'] = $_GET['module'];
						$data['action'] = $_GET['action'];
						unset($_GET['module']);
						unset($_GET['action']);
						foreach ($_GET as $key => $value){
							$data['params'][$key] = $value;
						}
					}else{
						die('Запрос не может быть обработан 2.');
					}
				}
				return $data;
			}
		}

		public static function genUri($module, $action=null,$params=null){
            if (config::$s_url) {
                $result = '/'.$module.'/';
                if ($action){
                    $result .= $action.'/';
                    if (is_array($params)){
                        foreach ($params as $key => $value){
                            $result .= $key.'/'.$value;
                        }
                    }
                }
            } else {
                $result = '/?module='.$module;
                if ($action){
                    $result .= '&action='.$action;
                    if (is_array($params)){
                        foreach ($params as $key => $value){
                            $result .= '&'.$key.'='.$value;
                        }
                    }
                }
            }
            return $result;
        }
	}

?>