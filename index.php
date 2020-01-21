<?php
session_start();
define("_PLUGSECURE_", true);
require_once('core/registry.php');
$registry = Registry::singleton();
$url_data = surl::parseUrl(config::$s_url,  $_SERVER['REQUEST_URI']);

echo '<b><un>Подключено</un></b>';

foreach ($registry->getObjectsList() as $names) {
    echo '<li>' . $names . '</li>';
}

//$db=$registry->database->connect($registry->config::$database);//старое
//одно и тоже все
//$db=new Database;
//$db = $registry->getObject('database');
$db = $registry->database;

//$c = $registry->getObject('config');
//$c = $registry->config;


//$db::connect($c::$database);

//echo $db::dbPing();

echo $registry->database->dbPing();

echo "<hr /><br />";

echo '
	<form method="post" action="index.php">
		Введите текст:<br />
		<textarea name="text"></textarea><br />
		<input type="submit" name="send" value="GO!" />
	</form><br />';

if (!empty($_POST['send'])) {
    if (!empty($_POST['text'])) {
        $query = "INSERT INTO `test`(`text`)VALUES('" . $_POST['text'] . "')";
        $result = $db->query($query);
        if ($db->error) {
            echo "ОШИБКА!<br />";
        } else {
            echo "Запрос выполнен.<br />";
        }
    }
}

$result = $db->query("SELECT * FROM `test` ORDER BY `id`");
while ($res = $result->fetch_assoc()) {
    echo $res['id'] . ":" . $res['text'] . "<br/>";
}

echo('Проверка работы ЧПУ.<br />');
$chpu_data = $registry->surl->parseUrl($registry->config::$s_url, $_SERVER['REQUEST_URI']);
foreach ($chpu_data as $key => $value) {
    if ($key != 'params') {
        echo $key . ":" . $value . ";";
    } else {
        echo 'PARAMS:';
        foreach ($value as $key2 => $value2) {
            echo $key2 . ":" . $value2 . ";";
        }
    }
}
//====================================
//TODO commented 05/11/2019
/*$content_text = '
	<div style="width: 813px; min-height: 300px; background: #FFFFFF; color: #444444; margin: 0 auto; text-align: center;">
		<h1>Hello WORLD!</h1>
		<h3>It\'s works! </h3>
 	</div>';
functions::toContent($content_text);*/
if(empty($url_data)){
    $request_module = 'posts';
    $request_template = 'index';
}else{
    $request_module = $url_data['module'];
    $request_template = 'page';
}

$try_module = modules::getModule($request_module);
if ($try_module) {
    require_once $try_module;
}else{
    handler::engineError('module_not_found', './includes/modules/stock/'.$request_module.'/'.$request_module.'.inc');
}




//Генерируем страницу в элемент нашего глобального массива
config::$global_cms_vars['PAGE'] = template::loadTemplate(config::$template, $request_template, config::$global_cms_vars);

//показываем страницу, которая хранится в нашем глобальном массиве
echo config::$global_cms_vars['PAGE'];

//тестовое
functions::testFun("<br>Test function");
$my_var = $registry_test_var;
echo '<br>'.$my_var;
?>