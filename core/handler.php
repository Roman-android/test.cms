<?php 

if (!defined('_PLUGSECURE_')){
  die('Прямой вызов модуля запрещен!');
}

class Handler{
	private static $className = 'Обработчик';
	
	public static function engineError($error, $data = null){
		switch($error){
			case 'db_connect':
				$descript = 'Ошибка при подключении к базе данных';
				break;
			case 'db_query':
				$descript = 'Ошибка при выполнении запроса в базу данных';
				break;
			case 'db_empty_query':
				$descript = 'Пустой запрос';
				break;
			case 'db_empty_prepare':
				$descript = 'Пустой шаблон запроса';
				break;
			case 'db_empty_values':
				$descript = 'Не получен массив данных для шаблона запроса';
				break;
			case 'db_unknown_type':
				$descript = 'Неизвестный тип данных в запросе';
				break;
			case 'db_empty_type':
				$descript = 'Не указан тип данных в шаблоне запроса';
				break;
			case 'exeption':
				$descript = 'Исключение';
				break;
            case 'template_not_found':
                $descript	=	'Файл шаблона не найден';
                break;
            case 'template_part_not_found':
                $descript	=	'Файл части шаблона не найден';
                break;
            case 'template_not_configure':
                $descript	=	'Не получена конфигурация шаблона';
                break;
			default:
				$descript = 'Неизвестная ошибка';
				break;
		}
		
		echo '
			<div style="padding: 10px; width: 80%; margin: 10px auto; background: #fff; border: 3px solid #FF0000;">
				<b>'.$descript.'</b>: '.$data.'
			</div>
			';
		
	}
	
	public static function vardamp($data,$full = false){
		if($full){
			echo '
				<div style="padding: 10px; width: 80%; margin: 10px auto; background: #fff; border: 3px solid #FF0000;">
					<pre>';
						var_dump($data);
			echo '
					</pre>
				</div>
				';
		}else{
			echo '
				<div style="padding: 10px; width: 80%; margin: 10px auto; background: #fff; border: 3px solid #FF0000;">
					<pre>';
						print_r($data);
			echo '
					</pre>
				</div>
				';
		}
	}
	
	public static function getClassName(){
		return self::$className;
	}
}
?>