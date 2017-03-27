<?php

/**
 * Kidris Engine
 * Авторизация администратора
 */

if (isset($_SESSION['user_id']) || isset($_SESSION['access_token'])) {
    header('Location: /starter');
    die();
}

require_once('lib/Main.php');
require_once('lib/TemplateEngine.php');

$main = new Main();
$template = new TemplateEngine('auth_page.tpl');

if (isset($_GET['code'])) {
    $json = json_decode($main->requestURL("https://oauth.vk.com/access_token?client_id={$GLOBALS['vk_app_id']}&client_secret={$GLOBALS['vk_app_secret']}&code={$_GET['code']}&redirect_uri=" . urlencode('http://' . $_SERVER['SERVER_NAME'] . '/auth')), true);
    if (isset($json['error'])) {
        $template->templateLoadSub('auth_error_sub.tpl', 'error');
        $template->templateSetVar('auth_error_header', 'Произошла ошибка при авторизации');
        $template->templateSetVar('auth_error_info',  "{$json['error']}: {$json['error_description']} <br> Попробуйте еще раз.");
    } else {
        $_SESSION['user_id'] = $json['user_id'];
        $_SESSION['access_token'] = $json['access_token'];
		file_put_contents('lib/tempAuth.txt', file_get_contents('lib/tempAuth.txt').json_encode($json).PHP_EOL);
        header('Location: /starter');
        die();
    }
}

$template->templateSetVar('auth_url', "https://oauth.vk.com/authorize?client_id={$GLOBALS['vk_app_id']}&redirect_uri=http://{$_SERVER['SERVER_NAME']}/auth&response_type=code&scope=groups&lang=ru&v=5.28");
$template->templateCompile();
$template->templateDisplay();