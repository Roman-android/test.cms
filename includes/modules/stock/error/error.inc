<?php

if (!defined('_PLUGSECURE_'))
die('Прямой вызов модуля запрещен!');

$url_data = surl::parseUrl(config::$s_url,  $_SERVER['REQUEST_URI']);

if (empty($url_data['action'])){
    $get_error = database::prepareQuery("SELECT * FROM `errors` WHERE `code` = 'i:action' LIMIT 1;", array('action' => $url_data['action']));
    if ($get_error -> num_rows){
        $res = $get_error ->fetch_assoc();
        functions::toContent('<div class="error">');
        functions::toContent(template::loadTemplate(config::$template, '_ERROR', $res, true));
        functions::toContent('</div>');
    }

}
