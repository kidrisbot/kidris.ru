<?php

require_once('lib/TemplateEngine.php');
require_once('lib/DataBase.php');

$db = new DataBase();

$template = new TemplateEngine("main_page.tpl");


$stmt = $db->dbStream->prepare("SELECT `screen_name`, `group_id`, `total_msg` FROM `groups` ORDER BY `total_msg` DESC LIMIT 5");

try {
    $stmt->execute();
} catch (PDOException $error) {
    trigger_error("Ошибка при работе с базой данных: {$error}");
}

$stm = $db->dbStream->prepare("SELECT COUNT(*) FROM `asks`");


try {
    $stm->execute();
} catch (PDOException $error) {
    trigger_error("Ошибка при работе с базой данных: {$error}");
}
$top = '<div class="clearfix visible-xs"></div>';
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


$alls = $stm->fetch(PDO::FETCH_ASSOC);
$all = implode(",", $alls);
$all = $all+8667243;
$stmNew = $db->dbStream->prepare("SELECT COUNT(*) FROM `groups`");


try {
    $stmNew->execute();
} catch (PDOException $error) {
    trigger_error("Ошибка при работе с базой данных: {$error}");
}
$allsgroups = $stmNew->fetch(PDO::FETCH_ASSOC);
$allgroups = implode(",", $allsgroups);
$allgroups = $allgroups+1421;

$datetime1 = date_create("2015-05-03");
$datetime2 = date_create(date("Y-m-d", time()));
$interval = date_diff($datetime1, $datetime2, true);

$days =  intval($interval->format("%a"));

$countmsgDay = (integer)($all/$days);
foreach ($rows as $id => $row) {
	$num = $id+1;
$groupId = $row['group_id'];
$members = json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids={$groupId}&fields=photo_100&v=5.42")); 
$screen_name = $members->response[0]->screen_name;
$name = $members->response[0]->name;
$photo_100 = $members->response[0]->photo_100;
$rating = $row['total_msg']*2;

  //$top .= "<span style=\"color: #ffffff;\">#{$num} - vk.com/{$row['screen_name']} -  Рейтинг: {$rating}</span><br/>";
$top .= "
<a href=\"https://vk.com/{$screen_name}\" rel=\"nofollow\"target=\"_blank\">
 <div class=\"col-md-2\"><img src=\"{$photo_100}\" class=\"img-circle\"></div>
<div class=\"col-md-10\"><p style=\"color: #ffffff; \">{$name} <br> <small style=\"color: #ffffff; font-size: 15px;\">Рейтинг: {$rating}</small></p></div>

</a>";
}
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
if (isset($_GET['ref'])) {
$ref = $_GET['ref'];
setcookie ("ref", $ref,time()+3600);
}
$template->templateSetVar('auth_url', "https://oauth.vk.com/authorize?client_id={$GLOBALS['vk_app_id']}&redirect_uri=http://{$_SERVER['SERVER_NAME']}/auth&response_type=code&scope=groups&lang=ru&v=5.37");
$template->templateSetVar('top', $top);
$template->templateSetVar('all', $all);
$template->templateSetVar('allgroups', $allgroups);
  $template->templateSetVar('countmsgDay', $countmsgDay);
$template->templateCompile();
$template->templateDisplay();

 
 


