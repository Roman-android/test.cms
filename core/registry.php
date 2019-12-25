<?php
//получено с git 23/10/2019
if(!defined('_PLUGSECURE_')){
	die('Прямой вызов модуля запрещен!');
};

interface StorableObject{
	public static function getClassName();
}

//тестовое для отображения в файле index.php
$registry_test_var = '456';

/**
 * @property string config
 * @property string test
 * @property string functions
 * @property string handler
 * @property string database
 * @property string modules
 * @property string surl
 * @property string template
 */
class Registry implements StorableObject{
	
	private static $className = "Реестр";
	private static $instance;
	private static $objects = array();

	public function loadCore(){
		$this->config='core/config.php';
		$this->test='core/test.php';
        $this->functions='core/functions.php';
        $this->handler='core/handler.php';
		$this->database='core/database.php';
		$this->modules='core/modules.php';
		$this->surl='core/surl.php';
		$this->template='core/template.php';
	}

    private function __construct(){
        $this -> loadCore();
    }
	
	public static function singleton(){
		if(!isset(self::$instance)){
			$obj = __CLASS__;
			self::$instance = new $obj;
		}
		
		return self::$instance;
	}


	//обычный метод
/*    public function addObject($key,$object){
		require_once ($object);
		self::$objects[$key] = new $key(self::$instance);
	}*/


    //альтернативный метод через магию
    public function __set($key,$object){
        require_once ($object);
        self::$objects[$key] = new $key(self::$instance);
        //$this -> addObject($key,$object);
    }

    //обычный метод
/*    public function getObject($key){
        if(is_object(self::$objects[$key])){
            return self::$objects[$key];
        }
    }*/

    //аналогичный метод через магию
    public function __get($key){
        if(is_object(self::$objects[$key])){
            return self::$objects[$key];
        }
        //$this->getObject($key);
    }



	public function getObjectsList(){
		$names = array();

		foreach(self::$objects as $obj){
			$names[] = $obj->getClassName();
		}

		array_push($names,self::getClassName());
		return $names;
	}
	
	public static function getClassName(){
		return self::$className;
	}
	
	private function __clone(){}
	private function __wakeup(){}
	private function __sleep() {}
	
}


?>