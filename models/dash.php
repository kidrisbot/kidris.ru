<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);
/**
 * Kidris Engine v. 2.0 Панель управления // там пиздец ес чо
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
$template           = new TemplateEngine('dash_new.tpl');
$db                 = new DataBase();
$main               = new Main();
$user_id            = $_SESSION['user_id'];
$screenName         = '';
$groupFon           = '';
$groupText          = '';
$totalMsg           = '';
$attach             = '';
$hashtag      = '';
$off_on_attach      = '';
$activeForStats     = '';
$desc_off     = 1;
$offDesc = 0;
$ratingId = 0;
$pointId = 0;
$blockfordash       = '';
$blockforstats      = '';
$blockforgraf       = '';
$groupphoto_100     = '';
$groupOfName        = '';
$groupOFScreen_name = '';
$activeForGrafs     = '';

$spisoktpl          = '';
$spisoktplstatii          = '';
$spisoktplstatss          = '';
 $rowCount = 0;
$CheckBoxValue =1;
$rowCount2 = 0;
 $rowCou = 0;
 $message = '';
$vars = [];
$groupId = explode('/', $_GET['route']);
if ($groupId[0] == 'dash') {
    $activeForDash = 'active ';
} else { $activeForDash = '';}
if (isset($groupId[1]) && $groupId[1] == '') { $rowCount = 3;} 
elseif (count($groupId) == 1) { $rowCount = 3;}
else {$rowCount = 0;}
$user  = $main->requestVkAPI('users.get', "user_ids={$_SESSION['user_id']}&fields=photo_100,sex,bdate,city,country&name_case=Nom&v=5.5&access_token={$_SESSION['access_token']}");

//проверка. зареган ли участник
$stmusers = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `id` = ? LIMIT 1");
$stmusers->bindValue(1, $user_id, PDO::PARAM_STR);
try {    $stmusers->execute();} catch (PDOException $error) {    trigger_error("Ошибка при работе с базой данных: {$error}");}

$cols = $stmusers->fetchAll(PDO::FETCH_ASSOC);
$ratingId = $cols[0]['rating'];
$pointId = $cols[0]['point'];


//вывод списка групп
$groups     = $main->requestVkAPI('groups.get', "user_id={$_SESSION['user_id']}&extended=1&filter=editor&fields=description&access_token={$_SESSION['access_token']}");


if (isset($groups['error']) || !$groups) {
$message = "<div class=\"callout callout-danger\">
Похоже, что произошла ошибка! Попробуйте обновить страницу, или повторите попытку позднее.
</div>";
 //проверить, куда это идет?
  } else {
    for ($i=0; $i<=$groups["count"]-1; $i++) {
  if($groups["items"][$i]["type"]<> "page") {unset($groups["items"][$i]);}
}
$_SESSION['groups'] = '';
    if (isset($groups['count']) && $groups['count'] !== 0) {
        foreach ($groups['items'] as $item => $groupData) {
         
            if ($groupData['type'] == 'page' || $groupData['type'] == 'group') {
                $_SESSION['groups'][$groupData['id']] = $groupData;
            }
        }
    } else {
        unset($_SESSION['groups']);
    }
}
if (!isset($_SESSION['groups']) || count($_SESSION['groups']) == 0) {
    $message = "<div class=\"callout callout-danger\">
Похоже, что вы не являетесь администратором ни одного паблика.
</div>";
//проверить, куда это идет?
  $rowCount == 3;
} else {
    foreach ($_SESSION['groups'] as $id => $group) {
        
        $classActive = '';
        $groupname   = $group['name'];
        if (strlen(htmlspecialchars($group['name'])) > 35) {
            $groupname = mb_substr($group['name'], 0, 20, 'UTF-8') . '...';
        }
        if (isset($groupId[1])) {
        
            if ($groupId[1] == $id) {
              $rowCount = 1;
               $rowCount2 = $id;
            
                $classActive = 'class="active"';
                $groupphoto_100     = $group['photo_100'];
                $groupOfName        = htmlspecialchars($group['name']);
                $groupOFScreen_name = $group['screen_name'];
              $description = $group['description'];
                $qwer = $db->dbStream->prepare("SELECT * FROM `groups` WHERE `group_id` = ? LIMIT 1");
            $qwer->bindValue(1, $rowCount2, PDO::PARAM_INT);
          try {
            $qwer->execute();
        } catch (PDOException $error) {
            trigger_error("Ошибка при работе с базой данных: {$error}");
        }
             
                if ($qwer->rowCount() ==  0)  {
                    $rowCount = 0; 
                }
              else {
                  $rowCount = 1; 
                    $rows          = $qwer->fetchAll(PDO::FETCH_ASSOC);
                    $screenName    = $rows[0]['screen_name'];
                 
                    $groupFon      = $rows[0]['group_fon'];
                
                  if ($groupFon == '') {$groupFon ='https://pp.vk.me/c633923/v633923984/2a633/K_yuR7_MizU.jpg';}
                   
                if ($rows[0]['group_text'] =='') { $groupText = $description;}
                else {$groupText = $rows[0]['group_text'];}
                    $totalMsg      = $rows[0]['total_msg'];
                    $attach        = $rows[0]['attach'];
                $hashtag        = $rows[0]['hashtag'];
                    $off_on_attach = $rows[0]['off_on_attach'];
                }
          
            } 
        } else { //тут надо чтобы $col3 не было
          $vars += [
            'del1' => '<!--',
       'del2' => '-->',
            ];
        } 
      
    $spisoktpl .= '<li ' . $classActive . '><a href="//kidris.ru/dash/' . $group['id'] . '" >' . htmlspecialchars($groupname) . '</a></li>';
        $spisoktplstatii .= '<li ' . $classActive . '><a href="//kidris.ru/stats/' . $group['id'] . '" >' . htmlspecialchars($groupname) . '</a></li>';
         $spisoktplstatss .= '<li ' . $classActive . '><a href="//kidris.ru/stati/' . $group['id'] . '" >' . htmlspecialchars($groupname) . '</a></li>';
    } 
} 
//теперь делаем вывод  5 новостей
//$news = $main->requestVkAPI('wall.get', "owner_id=-88986513&count=5&offset=1");
$spisok_news = '';

// кушаем рейтинг
$forrating2 = 0;
$ratings = '';
  $rating = $db->dbStream->prepare("SELECT `screen_name`, `group_id`, `total_msg` FROM `groups` ORDER BY `total_msg` DESC LIMIT 5");
          try {
            $rating->execute();
        } catch (PDOException $error) {
            trigger_error("Ошибка при работе с базой данных: {$error}");
        }
        $rats = $rating->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rats as $id => $rat) {
          if ($rowCount2 == $rat['group_id']) {
          $callout = 'info';
            $forrating2 = 1;
}
          else {$callout = 'warning';}
     
 $ratin = json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids={$rat['group_id']}&fields=photo_100&v=5.5"), true); 
$ratings .= '<div class="callout callout-'.$callout .'"><h4>'.$ratin['response'][0]['name'].'</h4> <p>Рейтинг '.$rat['total_msg'].'</p></div>';
 
        }

  if ($forrating2 !== 1) {
 
         $rating2 = $db->dbStream->prepare("SELECT * FROM `groups` WHERE `group_id` = ?  LIMIT 1");
   $rating2->bindValue(1, $rowCount2, PDO::PARAM_INT);
          try {
            $rating2->execute();
        } catch (PDOException $error) {
            trigger_error("Ошибка при работе с базой данных: {$error}");
        }
 

      if ($rating2->rowCount() <>  0)  {
         $rats2 = $rating2->fetchAll(PDO::FETCH_ASSOC);
       
$ratings .= '<div class="callout callout-info">
                <h4>'.$groupOfName.'</h4>
                <p>Рейтинг '.$rats2[0]['total_msg'].'</p>
              </div>';
      }

}


//конец
$vars += [
            'group_photo' => $user[0]['photo_100'],
            'group_name' => $user[0]['last_name'],
            'group_screen_name' => $user[0]['first_name'],
            'rows_news' => $spisok_news,
  'spisoktpl' => $spisoktpl,
   'screenName' => $screenName,
 'groupFon' => $groupFon,
 'groupText' => htmlspecialchars($groupText),
 'totalMsg' => $totalMsg,
  'spisokstats' => $ratings,
 'attach' => $attach,
 'off_on_attach' => $off_on_attach,
  'activeForDash' => $activeForDash,
    'groupOfPhoto' => $groupphoto_100,
            'groupOfName' => $groupOfName,
            'groupOFScreen_name' => $groupOFScreen_name,
   'spisoktplstatii' => $spisoktplstatii,
   'spisoktplstatss' => $spisoktplstatss,
  'hashtag' => $hashtag,

];  

// 3 значит, что групп нету
  // 0= группа есть в ссылке
  //1 - это значит, что группа подключена

if ($rowCount2 == isset($groupId[1]) ) {
if ($rowCount == 1 ) {
  $co3 = $template->templateLoadInString('dashgForGroup.tpl', $vars);
} 
elseif ($rowCount == 3) {
$co3 = $template->templateLoadInString('dashgForGroup3.tpl', $vars);}
else {$co3 = $template->templateLoadInString('dashgForGroup2.tpl', $vars);}
}
else {$co3 = $template->templateLoadInString('dashgForGroup3.tpl', $vars);}
    $co6 = $template->templateLoadInString('statslist.tpl', $vars);




$tree = '';
$desc = '';
if (isset($_POST)) {

 
  
  if (isset($_POST['submit']) && $_POST['submit'] !== '') {
  
     if (isset($rowCount2) == isset($groupId[1])) {
    
     $stmts = $db->dbStream->prepare("INSERT INTO `groups` (`group_id`, `screen_name`, `owner_id`) VALUES (?, ?, ?)");
            $stmts->bindValue(1, $rowCount2, PDO::PARAM_INT);
            $stmts->bindValue(2, $groupOFScreen_name, PDO::PARAM_STR);
            $stmts->bindValue(3, $_SESSION['user_id'], PDO::PARAM_INT);

            try {
                $stmts->execute();
            } catch (PDOException $error) {
                trigger_error("Ошибка при работе с базой данных: {$error}");
            }
        $message = "<div class=\"callout callout-success\">
Успешно подключено!
</div>";
       
       
     }
   
       
       
       
  } // конец подключения
 if (isset($_POST['disconnect']) && $_POST['disconnect'] !== '') {
  
     if (isset($rowCount2) == isset($groupId[1])) {
    
     $stmts = $db->dbStream->prepare("DELETE FROM `groups` WHERE `group_id` = ?");
            $stmts->bindValue(1, $rowCount2, PDO::PARAM_INT);
            try {
                $stmts->execute();
            } catch (PDOException $error) {
                trigger_error("Ошибка при работе с базой данных: {$error}");
            }
 $message = "<div class=\"callout callout-success\">
Успешно отключено!
</div>";
       
     }
     
  } // конец подключения
 
   if (isset($_POST['reload']) && $_POST['reload'] !== '') {
    if (isset($rowCount2) == isset($groupId[1])) {
    $allowFiles = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
    $attachments = '';  
    $account['token'] = 'ef584b3652783460d14239a4d83be48f2a41f9ba1cd1ddaa5288584768f23193ff5852c8e0f81dc6d2207';
    $account['album'] = 223599158;
    $token = $account['token'];
     $attachforpost = '';
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
                    else { $attachforpost = $membeer['response'][0]["src"];
                         } 
                }
            }
    }    

       $hashtag = '';
      
       if (isset($_POST['desc']) && ($_POST['desc'] !== '')) {$desc = $_POST['desc'];}
     
          if (!isset($_POST['desc_off'])) {

          $offDesc = 1;}
       
       $CheckBoxValue = 0;
      
      if (!isset($_POST['CheckBoxValue1'])) {
$CheckBoxValue =3;  }   
       
       //тут просто список хештегов
  if (isset($_POST['hashtag']) && ($_POST['hashtag'] !== '')) {$hashtag = PHP_EOL.$_POST['hashtag'];}

      
       //либо фото сервиса 1 либо хештег с хештегами 2
       if (isset($_POST['hashtagis']) && ($_POST['hashtagis'] !== '')) {
         $hashtagis = $_POST['hashtagis'];
         if ($hashtagis == 2) {$hashtag .=' #kidris ';}
       
       }

       if ($attachforpost == '') {
        $stmts = $db->dbStream->prepare("UPDATE `groups` SET `group_text`= ?, `off_on_attach`= ? , `hashtag`=? , `is_hashtag`= ?, `Off_desc`= ? WHERE `group_id` = ?");
        
        $stmts->bindValue(1, $desc, PDO::PARAM_STR);
        $stmts->bindValue(2, $CheckBoxValue, PDO::PARAM_INT);
        $stmts->bindValue(3, $hashtag, PDO::PARAM_STR);
        $stmts->bindValue(4, $hashtagis, PDO::PARAM_INT);
        $stmts->bindValue(5, $offDesc, PDO::PARAM_INT);
        $stmts->bindValue(6, $rowCount2, PDO::PARAM_INT);
            try {
                $stmts->execute();
            } catch (PDOException $error) {
                trigger_error("Ошибка при работе с базой данных: {$error}");
            }
       }
       else {
          $stmts = $db->dbStream->prepare("UPDATE `groups` SET `group_fon`= ?, `group_text`= ?, `off_on_attach`= ? , `hashtag`=? , `is_hashtag`= ?, `Off_desc`= ? WHERE `group_id` = ?");
                 $stmts->bindValue(1, $attachforpost, PDO::PARAM_STR);
        $stmts->bindValue(2, $desc, PDO::PARAM_STR);
        $stmts->bindValue(3, $CheckBoxValue, PDO::PARAM_INT);
        $stmts->bindValue(4, $hashtag, PDO::PARAM_STR);
        $stmts->bindValue(5, $hashtagis, PDO::PARAM_INT);
        $stmts->bindValue(6, $offDesc, PDO::PARAM_INT);
        $stmts->bindValue(7, $rowCount2, PDO::PARAM_INT);
            try {
                $stmts->execute();
            } catch (PDOException $error) {
                trigger_error("Ошибка при работе с базой данных: {$error}");
            }
       }
       
       
     
    
 $message = "<div class=\"callout callout-success\">
Обновлено!
</div>";
       
       
     }
     
  } // конец подключения

  
}






$vars['target'] = 'Добро пожаловать, <br> ' . $user[0]['first_name'] . ' ' . $user[0]['last_name'] . '!';
$vars['name']   = $user[0]['first_name'] . ' ' . $user[0]['last_name'];
$co2            = $template->templateLoadInString('news.tpl', $vars);

$co4 = $template->templateLoadInString('footer.tpl', $vars);
$co5 = $template->templateLoadInString('menu.tpl', $vars);
$template->templateSetVar('news', $co2);
$template->templateSetVar('dashgForGroup', $co3);
$template->templateSetVar('pointId', $pointId);
$template->templateSetVar('ratingId', $ratingId);
$template->templateSetVar('footer', $co4);
$template->templateSetVar('menu', $co5);
$template->templateSetVar('statslist', $co6);
$template->templateSetVar('message', $message);
$template->templateSetVar('fotos', $user[0]['photo_100']);
$template->templateSetVar('spisoktpl', $spisoktpl);
$template->templateSetVar('target', $vars['target']);

$template->templateSetVar('name', $vars['name']);

$template->templateCompile();
$template->templateDisplay();
function fiveNews($news) {
  $spisok_news = '';
 for ($i = 0; $i <= 4; $i++) {
    $count_news = $i + 1;
  $spisok_news .= '<li class="item"><a class="product-title">Новость #' . $count_news . ' <span class="label label-info pull-right">' . date('d-m-Y', $news["items"][$i]["date"]) . '</span></a> <span class="product-description">' . $news["items"][$i]['text'] . '</span></li>';
}
  return $spisok_news;
}
