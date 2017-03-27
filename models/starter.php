<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);

/**
 * Kidris Engine v. 2.0
 * Панель управления
 */
if (!isset($_SESSION['user_id']) || !isset($_SESSION['access_token'])) {
    header('Location: /');
    die();
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /');
}
require_once('lib/DataBase.php');
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');
$template = new TemplateEngine('starter.tpl');
$db = new DataBase();
$main = new Main();
$user_id = $_SESSION['user_id'];
if (isset($_COOKIE['ref'])) {
$ref = $_COOKIE['ref'];
}
else {$ref = '';}
$ratingId = 0;
$pointId = 0;
$message = '';

//проверка. зареган ли участник
$stmusers = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `id` = ? LIMIT 1");
$stmusers->bindValue(1, $user_id, PDO::PARAM_STR);

try {    $stmusers->execute();} catch (PDOException $error) {    trigger_error("Ошибка при работе с базой данных: {$error}");}
if ($stmusers->rowCount() == 0) {
    $smt = $db->dbStream->prepare("INSERT INTO `users` (`id`, `ref`) VALUES (?, ?)");
            $smt->bindValue(1, $user_id, PDO::PARAM_INT);
            $smt->bindValue(2, $ref, PDO::PARAM_INT);
  try {
    $smt->execute();
} catch (PDOException $error) {
    trigger_error("Ошибка при работе с базой данных: {$error}");
}
}  else {
$cols = $stmusers->fetchAll(PDO::FETCH_ASSOC);
$ratingId = $cols[0]['rating'];
$pointId = $cols[0]['point'];
}
  $listforfoto = '';
$spisoktplstatii = '';
$spisoktplstatss = '';
$request = $main->requestVkAPI('users.get', "user_ids={$user_id}&fields=photo_100,sex,bdate,city,country&name_case=Nom&v=5.42&access_token={$_SESSION['access_token']}");
				if (isset($request['error'])) {
					$vars = [
						'title' => 'Ошибка при загрузки файла:',
						'description' => 'Сервис недоступен, попробуйте повторить позднее.',
					];
$first_name = 'Не определено';
 $photo_100 = '';   
                  $photo_100 = 'https://vk.com/images/camera_100.png'; 
                  $last_name = 'Не определено'; 
                  $last_name = 'Не определено'; 
				} else {
$first_name = $request[0]['first_name'];
                

$photo_100 =  $request[0]['photo_100'];
  
$last_name =  $request[0]['last_name'];

                }

//вывод списка групп
$groups = $main->requestVkAPI('groups.get', "user_id={$user_id}&extended=1&filter=editor&access_token={$_SESSION['access_token']}");

if (isset($groups['error']) || !$groups) {
   $message = "<div class=\"callout callout-danger\">
Похоже, что произошла ошибка! Попробуйте обновить страницу, или повторите попытку позднее.
</div>";
} else {
 
  for ($i=0; $i<=$groups["count"]-1; $i++) {
  if($groups["items"][$i]["type"]<> "page") {unset($groups["items"][$i]);}
}
 
  
    $_SESSION['groups'] = '';
   if (isset($groups['count']) && $groups['count'] !==0 && count($groups['items']) !==0) {
    foreach ($groups['items'] as $item => $groupData) {
      if ($groupData['type'] == 'page' || $groupData['type'] == 'group' ) {
        $_SESSION['groups'][$groupData['id']] = $groupData;   }
    }
  } else {
    unset($_SESSION['groups']);
  }
}
$spisoktpl = '';
if (!isset($_SESSION['groups']) || count($_SESSION['groups']) == 0 ) {
    $message = "<div class=\"callout callout-danger\">
Похоже, что вы не являетесь администратором ни одной публичной! страницы.
</div>";
}
else {
 foreach ($_SESSION['groups'] as $id => $group) {
if (strlen(htmlspecialchars($group['name'])) > 35 ) {
$group['name'] = mb_substr($group['name'],0,20, 'UTF-8').'...'; 
 
}
 

      
  $groupname = $group['name']; 
     $listforfoto .= '<option value="' . $group['id'] . '">' . htmlspecialchars($groupname) . '</option>';
     $spisoktpl .= '<li><a href="//kidris.ru/dash/' . $group['id'] . '" >' . htmlspecialchars($groupname) . '</a></li>';
        $spisoktplstatii .= '<li><a href="//kidris.ru/stats/' . $group['id'] . '" >' . htmlspecialchars($groupname) . '</a></li>';
         $spisoktplstatss .= '<li><a href="//kidris.ru/stati/' . $group['id'] . '" >' . htmlspecialchars($groupname) . '</a></li>';
 }
}
$spisok_news = '';
$news = $main->requestVkAPI('wall.get', "owner_id=-88986513&count=5&offset=1");
for ($i = 0; $i <= 4; $i++) {
  $count_news= $i+1;
  $spisok_news .= '<li class="item"> <a class="product-title">Новость #'.$count_news.' <span class="label label-info pull-right">'.date('d-m-Y', $news["items"][$i]["date"]).'</span></a> <span class="product-description">'.$news["items"][$i]['text'].'</span> </li>';}       


if (isset($_POST["taskOption"]) && $_POST["taskOption"] !== 0) {
    if (isset($rowCount2) == isset($groupId[1])) {
    $allowFiles = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
    $attachments = '';  
    $account['token'] = 'ef584b3652783460d14239a4d83be48f2a41f9ba1cd1ddaa5288584768f23193ff5852c8e0f81dc6d2207';
    $account['album'] = 223599158;
    $token = $account['token'];
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        $ext = pathinfo($_FILES['file']['name']);
        if(!isset($ext['extension'])) { $ext['extension'] = '';}
        $ext = strtolower($ext['extension']);
            if (!in_array($ext, $allowFiles)) {
                $message = "<div class=\"callout callout-danger\">Ошибка при загрузке файла: загрузить можно только файлы с расширением jpg, png, gif, bmp, jpeg. </div>";} 
            elseif(!is_uploaded_file($_FILES["file"]["tmp_name"]) || !move_uploaded_file($_FILES["file"]["tmp_name"], "/tmp/{$token}_".$_FILES["file"]["name"])) {
                $message = "<div class=\"callout callout-danger\"> Ошибка при загрузке файла: попробуйте еще раз. </div>";$_SESSION['token'] = $token; } 
            else {
            $members = json_decode(file_get_contents("https://api.vk.com/method/photos.getUploadServer?album_id={$account['album']}&group_id=106833405&access_token={$account['token']}"),true);
                if (isset($members['response']['error'])) {
                $message = "<div class=\"callout callout-danger\"> Ошибка при загрузке файла: Сервис недоступен, попробуйте повторить позднее. </div>"; 
                $_SESSION['token'] = $token;
                } else {  
                    $curl = curl_init($members['response']['upload_url']);
                    $opts = [
                      CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:6.0.2) Gecko/20100101 Firefox/6.0.2',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_SSL_VERIFYPEER => false,
                      CURLOPT_SSL_VERIFYHOST => false,
                      CURLOPT_POSTFIELDS => [
                        'file1' => "@/tmp/{$token}_".$_FILES["file"]["name"]
                      ]
                    ]; 
                    curl_setopt_array($curl, $opts);
                    $photoRequest = json_decode(curl_exec($curl), true); 
                    $membeer = json_decode(file_get_contents("https://api.vk.com/method/photos.save?server={$photoRequest['server']}&photos_list={$photoRequest['photos_list']}&album_id={$account['album']}&group_id=106833405&hash={$photoRequest['hash']}&access_token={$account['token']}"),true);

                    if (isset($request['response']['error'])) {
                    $message = "<div class=\"callout callout-danger\"> Ошибка при загрузке файла: Сервис недоступен, попробуйте повторить позднее. </div>";
                    $_SESSION['token'] = $token; } 
                  else { $attachforpost = 'photo-106833405_'.$membeer['response'][0]["pid"];
          $st = $db->dbStream->prepare("UPDATE `groups` SET `attach` = ? WHERE  `group_id`=?");
          $st->bindValue(1, $attachforpost, PDO::PARAM_STR);
                    $st->bindValue(2, $_POST["taskOption"], PDO::PARAM_STR);    
          try {    $st->execute();} catch (PDOException $error) {    trigger_error("Ошибка при работе с базой данных: {$error}");}
                     $message = "<div class=\"callout callout-success\"> Готово. Фотография обновлена! </div>";    
} 
                }
            }
    }    
  }
}


$vars = [
            'group_photo' => $photo_100,
            'group_name' => $last_name,
            'group_screen_name' => $first_name,
           'rows_news' => $spisok_news,
  'spisoktpl' => $spisoktpl,
  'spisoktplstatii' =>$spisoktplstatii,
  'spisoktplstatss' =>$spisoktplstatss,
        
        ]; 

$vars['target'] = 'Добро пожаловать, <br> '.  $first_name .' ' . $last_name . '!';
$vars['name'] =  $first_name .' ' . $last_name;
$co2 = $template->templateLoadInString('news.tpl', $vars);
$co3= $template->templateLoadInString('menu.tpl', $vars);
$template->templateSetVar('news', $co2);
$template->templateSetVar('ref_id', $user_id);
$template->templateSetVar('menu', $co3);
$template->templateSetVar('ratingId', $ratingId);
$template->templateSetVar('pointId', $pointId);
$template->templateSetVar('message', $message);
$template->templateSetVar('fotos', $photo_100);
$template->templateSetVar('spisoktpl', $spisoktpl);
$template->templateSetVar('target', $vars['target']);
$template->templateSetVar('name', $vars['name']);
$template->templateSetVar('listforfoto', $listforfoto);

$template->templateCompile();
$template->templateDisplay();
//$spisoktpl 
//



