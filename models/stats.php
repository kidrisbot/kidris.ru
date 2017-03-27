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
$template           = new TemplateEngine('dash_new.tpl');
$db                 = new DataBase();
$main               = new Main();
$user_id            = $_SESSION['user_id'];
$spisoktpl ='';
$spisoktplstatii ='';
$spisoktplstatss ='';
$screenName = '';
$groupFon = '';
$groupText = '';
$totalMsg = '';
$attach = '';
$off_on_attach = '';
$groupphoto_100 = '';
$groupOfName = '';
$groupOFScreen_name = '';
$groupOfName = '';
$groupOfName = '';
 $vars = [];
$rowCount2 = 0;
$message ='';
// Разбиваем url и смотрим его
$groupId = explode('/', $_GET['route']);
if ($groupId[0] == 'stats') {
    $activeForStart = 'active ';
} else { $activeForStart = '';}
// для проверок , что есть id в ссылке

if (isset($groupId[1]) && $groupId[1] == '') {
 $rowCount = 3;} 
  elseif (count($groupId) == 1) { $rowCount = 3;}
else {$rowCount = 0;}

$startrow = 0;

$today = date("Y-m-d");
$time = strtotime($today) + 1209600;
$dayaftertwoweeks = date('Y-m-d', $time);
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
$startrow = 0;
} else {
  $startrow = (int)$_GET['startrow'];
}

//получаем ФИО и фото юзера
$user  = $main->requestVkAPI('users.get', "user_ids={$_SESSION['user_id']}&fields=photo_100,sex,bdate,city,country&name_case=Nom&v=5.5&access_token={$_SESSION['access_token']}");
$groups     = $main->requestVkAPI('groups.get', "user_id={$_SESSION['user_id']}&extended=1&filter=editor&access_token={$_SESSION['access_token']}");
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
}  else {
 
    foreach ( $_SESSION['groups'] as $id => $group) {

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
                    $groupText     = $rows[0]['group_text'];
                    $totalMsg      = $rows[0]['total_msg'];
                    $attach        = $rows[0]['attach'];
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
$news = $main->requestVkAPI('wall.get', "owner_id=-88986513&count=5&offset=1");
$spisok_news = fiveNews($news);

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


        for ($i = 0; $i <= count($rats)-1; $i++) {
          if ($rowCount2 == $rats[$i]['group_id']) {
          $callout = 'info';
            $forrating2 = 1;
}
          else {$callout = 'warning';}
     
 $ratin = json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids={$rats[$i]['group_id']}&fields=photo_100&v=5.5"), true); 
$ratings .= '<div class="callout callout-'.$callout .'"><h4>'.$ratin['response'][0]['name'].'</h4> <p>Рейтинг '.$rats[$i]['total_msg'].'</p></div>';
 
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
    $ratin = json_decode(file_get_contents("https://api.vk.com/method/groups.getById?group_ids={$rats2[0]['group_id']}&fields=photo_100&v=5.5"), true); 
$ratings .= '<div class="callout callout-info">
                <h4>'.$ratin['response'][0]['name'].'</h4>
                <p>Рейтинг '.$rats2[0]['total_msg'].'</p>
              </div>';
      }

}


$spisokTab = '';



if(isset($_GET['act']) and $_GET['act'] == "ban") {
		if(isset($_GET['g']) and isset($_GET['id'])) {
			foreach($_SESSION['groups'] as $id => $group) {
				if($group['id'] == $_GET['g']) {
					$good_group = true;
					break;
				} else {
					$good_group = false;
				}
			}
			if($good_group) {
				$stmt = $db->dbStream->prepare("UPDATE `asks` SET `banned` = ? WHERE `id` = ?");
				$stmt->bindValue(1, time() + (3600 * 24 * 14), PDO::PARAM_INT);
				$stmt->bindValue(2, $_GET['id'], PDO::PARAM_INT);
				$stmt->execute();
				$message = '<div class="callout callout-success">
<h4>Аноним забанен</h4>
<p>Автор данного поста был забанен для Вашей группы на 2 недели. Он теперь не сможет присылать посты в группу в течении выше указанного срока.</p>
</div>';
			} else {
				#ГРУППА ПРЕНАДЛЕЖИТ НЕ ЕМУ
			}
		}
	}
 
  	if(isset($_GET['act']) and $_GET['act'] == "antiban") {
		if(isset($_GET['g']) and isset($_GET['id'])) {
			foreach($_SESSION['groups'] as $id => $group) {
				if($group['id'] == $_GET['g']) {
					$good_group = true;
					break;
				} else {
					$good_group = false;
				}
			}
			if($good_group) {
				$stmt = $db->dbStream->prepare("UPDATE `asks` SET `banned` = ? WHERE `id` = ?");
				$stmt->bindValue(1, 0, PDO::PARAM_INT);
				$stmt->bindValue(2, $_GET['id'], PDO::PARAM_INT);
				$stmt->execute();
					$message = '<div class="callout callout-success">
<h4>Аноним разбанен</h4>
<p>Автор данного поста был разбанен для Вашей группы.</p>
</div>';
				} else {
				#ГРУППА ПРЕНАДЛЕЖИТ НЕ ЕМУ
			}
		}
	}


      $sumt = $db->dbStream->prepare("SELECT id,datetime, banned, message, group_id FROM `asks` WHERE `group_id` = ? ORDER BY `id` DESC LIMIT $startrow, 20");
    	$sumt->bindValue(1, $rowCount2, PDO::PARAM_INT);
		
		$sumt->execute();
		
      	$cows = $sumt->fetchAll(PDO::FETCH_ASSOC);
		
		$spisokTab = '';
		
		
		foreach($cows as $d) {
          if ($d['message'] <> '') {
          
			$date = explode('-', $d['datetime']);
          if(isset($d['banned']) and $d['banned'] > time()) 
       {
          $spisokTab .= "<tr>
		  <td>{$date[2]}.{$date[1]}.{$date[0]}</td>
		  <td>{$d['message']}</td>
		  <td><a class=\"btn btn-danger\" href=\"{$d['group_id']}?act=antiban&g={$d['group_id']}&id={$d['id']}\">Разбанить</a></td> 
		  </tr>";}
          else {
             $spisokTab .= "<tr>
		  <td>{$date[2]}.{$date[1]}.{$date[0]}</td>
		  <td>{$d['message']}</td>
		  <td><a class=\"btn btn-info\" href=\"{$d['group_id']}?act=ban&g={$d['group_id']}&id={$d['id']}\">Забанить</a></td> 
		  </tr>";
          }
            }
		}
if(isset($_POST['ajax']) and $_POST['ajax'] == 1) {
		  $var = Array(
				'answer' => $spisokTab,
				'error' => 0
		  );
		  if($_POST['id'] == $rowCount2) {
				echo(json_encode($var, true));
				die();
		  }
	  }




$ratingId = 0;
$pointId = 0;
//проверка. зареган ли участник
$stmusers = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `id` = ? LIMIT 1");
$stmusers->bindValue(1, $user_id, PDO::PARAM_STR);

try {
    $stmusers->execute();
} catch (PDOException $error) {
    trigger_error("Ошибка при работе с базой данных: {$error}");
}

$cols = $stmusers->fetchAll(PDO::FETCH_ASSOC);
$ratingId = $cols[0]['rating'];
$pointId = $cols[0]['point'];




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
  'activeForStart' => $activeForStart,
    'groupOfPhoto' => $groupphoto_100,
            'groupOfName' => $groupOfName,
            'groupOFScreen_name' => $groupOFScreen_name,
   'spisoktplstatii' => $spisoktplstatii,
    'tableforstats' => $spisokTab,
   'spisoktplstatss' => $spisoktplstatss,

  

];  
 $vars['url'] = 
             '	
			  <p><a class="btn btn-warning" id="but_back_'.$group['screen_name'].'" onclick="stats_get(0, \''.$group['screen_name'].'\', '.$rowCount2.')">Более новые записи</a>
			<a class="btn btn-info" id="but_next_'.$group['screen_name'].'" onclick="stats_get(20, \''.$group['screen_name'].'\', '.$rowCount2.')">Более старые записи</a></p>
			';



// 3 значит, что групп нету
  // 0= группа есть в ссылке
  //1 - это значит, что группа подключена
if ($rowCount == 1 ) {
  $co3 = $template->templateLoadInString('statsForGroup.tpl', $vars);
} else {
$co3 = $template->templateLoadInString('statsForGroup2.tpl', $vars);}

    
    $co6 = $template->templateLoadInString('statslist.tpl', $vars);


$vars['target'] = 'Добро пожаловать, <br> ' . $user[0]['first_name'] . ' ' . $user[0]['last_name'] . '!';
$vars['name']   = $user[0]['first_name'] . ' ' . $user[0]['last_name'];
$co2            = $template->templateLoadInString('news.tpl', $vars);

$co4 = $template->templateLoadInString('footer.tpl', $vars);
$co5 = $template->templateLoadInString('menu.tpl', $vars);
$template->templateSetVar('news', $co2);
$template->templateSetVar('dashgForGroup', $co3);
$template->templateSetVar('footer', $co4);
$template->templateSetVar('menu', $co5);
$template->templateSetVar('statslist', $co6);
$template->templateSetVar('message', $message);
$template->templateSetVar('url', $vars['url']);
$template->templateSetVar('fotos', $user[0]['photo_100']);
$template->templateSetVar('spisoktpl', $spisoktpl);
$template->templateSetVar('pointId', $pointId);
$template->templateSetVar('ratingId', $ratingId);
$template->templateSetVar('target', $vars['target']);

$template->templateSetVar('name', $vars['name']);

$template->templateCompile();
$template->templateDisplay();
//$spisoktpl 
//



function fiveNews($news) {
  $spisok_news = '';
 for ($i = 0; $i <= 4; $i++) {
    $count_news = $i + 1;
  $spisok_news .= '<li class="item"><a class="product-title">Новость #' . $count_news . ' <span class="label label-info pull-right">' . date('d-m-Y', $news["items"][$i]["date"]) . '</span></a> <span class="product-description">' . $news["items"][$i]['text'] . '</span></li>';
}
  return $spisok_news;
}

