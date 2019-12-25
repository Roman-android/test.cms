<?php

//TODO added 29.10.2019
if (!defined('_PLUGSECURE_')){
    die('Прямой вызов запрещен!');
}

echo '<div style="color: #ffffff;">Проверка: $url_data(action) = ' .$url_data['action'].'</div>';

/*
functions::setTitle("Новости");
functions::toContent("Тестовое 3","test");
functions::toContent("Тестовое 4","test");

if (empty($url_data['action'])){
    functions::setTitle("Новости");
    functions::toContent("Тестовое","test");
}*/

/*echo '<div style="color: #ffffff;">Проверка: $url_data(action) = ' .$url_data['action'].'</div>';
echo '<div style="color: #ffffff;">$url_data(params)(id) = ' .$url_data['params']['id'].'</div>';*/


/*if (empty($url_data['action'])){
    functions::setTitle("Новости");
    $posts = database::query("SELECT * FROM `posts` ORDER BY `id`;");
    $posts_grid = '';
    while ($res = $posts->fetch_assoc()){
        if (config::$s_url){
            $try_alias = database::prepareQuery("SELECT `alias` FROM `aliases` WHERE `address`='s:addr' ORDER BY `id` LIMIT 1;",
                array(
                    'addr' => surl::genUri(
                        'posts',
                        'show',
                        array('id' => $res['id'])
                    )
                )
            );

            if ($try_alias->num_rows){
                $try_alias = $try_alias->fetch_assoc();
                $res['id'] =  $try_alias['alias'];
            }else{
                $res['id'] = surl::genUri('posts','show',array('id' => $res['id']));
            }

        }else{
            $res['id'] = surl::genUri('posts','show',array('id' => $res['id']));
        }
        //$res['text'] = functions::stripPost($res['text']);
        $posts_grid .= template::loadTemplate(config::$template,'_POSTS',$res,true);
    }
    functions::toContent($posts_grid,'posts');
    unset($posts_grid,$posts,$res);
}elseif ($url_data['action'] == 'show' && !empty($url_data['params']['id'])){//TODO added 30.10.2019
    $post  = database::prepareQuery("SELECT * FROM `posts` WHERE `id` = 's:id' LIMIT 1;",array('id'=> $url_data['params']['id']));
    $res = $post ->fetch_assoc();
    functions::setTitle($res['title']);
    functions::toContent(template::loadTemplate(config::$template,'_SINGLE_POST_'.$res['class'],$res,true),'single_post');
}else{
    handler::engineError('Exception', 'Ошибка загрузки модуля posts.');
}*/