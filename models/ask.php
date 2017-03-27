<?php

/**
 * Kidris Engine
 * Страница добавления сообщений
 */
if (isset($_COOKIE['Mortal'])) $cnt=$_COOKIE['Mortal'];
else {
$cnt = uniqid();
setcookie("Mortal",$cnt,0x6FFFFFFF);
}
$cook = uniqid();
$cap = '';
require_once('lib/DataBase.php');
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');

$dateTime = date("Y-m-d H");    

$datetimeforkolvo = date("Y-m-d H:i:s", time()-(24*60*60));
$screenName = explode('/', $_GET['route']);
$db = new DataBase();
$main = new Main();

$template = new TemplateEngine('ask_page.tpl');

$stmt = $db->dbStream->prepare("SELECT *  FROM `groups` WHERE `screen_name` = ? LIMIT 1");
$stmt->bindValue(1, $screenName[0], PDO::PARAM_STR);

try {
    $stmt->execute();
} catch (PDOException $error) {
    trigger_error("Ошибка при работе с базой данных: {$error}");
}

if ($stmt->rowCount() == 0) {
    require_once("models/404.php");
}


$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); //var_dump($rows);
$groupId = $rows[0]['group_id'];
$groupFon = $rows[0]['group_fon'];
$groupText = $rows[0]['group_text'];
$totalMsg = $rows[0]['total_msg'];
$ownerId = $rows[0]['owner_id'];
$hashtag = $rows[0]['hashtag'];
$showBackground = $rows[0]['fon_block'];
$attachFoto = $rows[0]['attach'];
$is_hashtag = $rows[0]['is_hashtag'];

if ($rows[0]['off_on_attach'] == 3) { $open1 = '<!--'; $open2 = '-->'; 
                                    $template->templateSetVar('open1', $open1); 
$template->templateSetVar('open2', $open2); }
elseif ($rows[0]['off_on_attach'] == 4) { $open3 = '<!--'; $open4 = '-->'; 
                                        $template->templateSetVar('open3', $open3); 
$template->templateSetVar('open4', $open4); }

$attachments = '';
//проверка на то, нужно ли делать описание
//if ($rows[0]['Off_desc'] == 1) {$groupText=' ';}
//если 1 то убирается только опросы, если 2 то только фото, если 3, то и опросы и фото
//$off_on_attach = $rows[0]['off_on_attach'];
//if ($off_on_attach == 3) {$del1 = '<!--'; $del2 = '-->'; }
$token = $main->randString();
//$cap = '<div class="g-recaptcha" data-sitekey="6LfiVyITAAAAAJqYq0h00SCTHs0i7QLhpY2rLHqW"></div>';
if (isset($_COOKIE['Mortal'])) 
 {
 			$syymt = $db->dbStream->prepare("SELECT COUNT(*) FROM `asks` WHERE `datetime` >= ? AND `ip` = ?");
 			$syymt->bindValue(1, $datetimeforkolvo, PDO::PARAM_INT);
 			$syymt->bindValue(2, $_SERVER['HTTP_CF_CONNECTING_IP'], PDO::PARAM_STR);
 			$syymt->execute();
			
 			  //var_dump($kolvoid[0]["COUNT(*)"]);
 			  // $banned[0]['max(banned)'] - время в UNIX до которого ты забанен для этой группы...

//   if($syymt->rowCount() > 3) {}
 //  else {}
  $kolvoid = $syymt->fetchAll(PDO::FETCH_ASSOC);
   if (isset($kolvoid[0]["COUNT(*)"]) &&  $kolvoid[0]["COUNT(*)"] > 2 )
  
   $cap = '<div class="g-recaptcha" data-sitekey="6LfiVyITAAAAAJqYq0h00SCTHs0i7QLhpY2rLHqW"></div>';
  
   else 
      $cap = '';
//     //$cap = '<div class="g-recaptcha" data-sitekey="6LfiVyITAAAAAJqYq0h00SCTHs0i7QLhpY2rLHqW"></div>';
  
 
  
//   //var_dump($kolvoid );
 }

$groupInfo = $main->requestVkAPI('groups.getById', "group_ids={$groupId}&fields=name,screen_name,description,photo_100");



$rating = round($totalMsg);
$template->templateSetVar('rating', $rating); 
  $template->templateSetVar('cap', $cap); 


$template->templateSetVar('group_name', htmlspecialchars($groupInfo[0]['name']));
$template->templateSetVar('group_photo', $groupInfo[0]['photo_100']);
$template->templateSetVar('id_cook', $groupId);
$template->templateSetVar('group_screen_name', htmlspecialchars($screenName[0]));
$template->templateSetVar('group_description', htmlspecialchars($groupInfo[0]['description']));
$template->templateSetVar('group_screen_name_vtoroy', htmlspecialchars($groupInfo[0]['screen_name']));
$captcha = session_name() . '=' . session_id();
$template->templateSetVar('token', $token);

if (strlen($groupFon) < 6) {
	$template->templateSetVar('group_fon', 'http://kidris.ru/fon.PNG');
} else {
	$template->templateSetVar('group_fon', $groupFon);
}

if (strlen($groupText) == 0) {
	$template->templateSetVar('group_text', htmlspecialchars($groupInfo[0]['description']));
} else {
	$template->templateSetVar('group_text', $groupText);
}



$template->templateCompile();
$template->templateDisplay();

//var_dump($token);
//var_dump($_SESSION);