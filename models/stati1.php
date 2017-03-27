<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);

/**
 * Kidris Engine
 * Статистика
 */

if (!isset($_SESSION['user_id']) || !isset($_SESSION['access_token'])) {
    header('Location: /dash');
    die();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /');
}

require_once('lib/DataBase.php');
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');

$template = new TemplateEngine('stati_page.tpl');
$db = new DataBase();
$main = new Main();


if (isset($_POST['do']) && isset($_POST['group_id'])) {
 echo('yes');
    if (!isset($_SESSION['groups'][$_POST['group_id']])) {
        die('error');
  } else {
       if ($_POST['do'] == 'next') {
            $startrow = $startrow + 20;
            die('ok');
        } elseif ($_POST['do'] == 'previous') {
          $startrow = $startrow - 20;
            die('ok');
        } else {
				die('error');
			
			} }
  
    }


$groups = $main->requestVkAPI('groups.get', "user_id={$_SESSION['user_id']}&extended=1&filter=editor&access_token={$_SESSION['access_token']}");

if (isset($groups['error']) || !$groups) {
    $template->templateLoadSub('dash_page_header_alert.tpl', 'alert_message');
    $template->templateSetVar('alert_type', 'danger');
    $template->templateSetVar('alert_message_head', 'Похоже, что произошла ошибка!<br>');
    $template->templateSetVar('alert_message_msg', "Произошла ошибка при получении списка групп. {$groups['error']['error_msg']}. <br> Попробуйте обновить страницу, или повторите попытку позднее.");
} else {
    $_SESSION['groups'] = '';
	if (isset($groups['count']) && $groups['count'] !==0) {
		foreach ($groups['items'] as $item => $groupData) {
		if ($groupData['type'] == 'page' ) {
				$_SESSION['groups'][$groupData['id']] = $groupData;
			}
			if ($_SESSION['groups'] == '') { unset($_SESSION['groups']);}
          /*
          elseif ($groupData['type'] == 'group' ) { 
           $template->templateLoadSub('dash_page_header_alert.tpl', 'alert_message');
    $template->templateSetVar('alert_type', 'info');
    $template->templateSetVar('alert_message_head', '');
    $template->templateSetVar('alert_message_msg', "В списке показываются только публичные страницы! <br>");
            unset($_SESSION['groups'][$groupData['id']);
	}
	*/
		}
	} else {
		unset($_SESSION['groups']);
	}

	
}
if (!isset($_SESSION['groups']) || count($_SESSION['groups']) == 0 ) {
    $template->templateLoadSub('dash_page_header_alert.tpl', 'alert_message');
    $template->templateSetVar('alert_type', 'info');
    $template->templateSetVar('alert_message_head', '');
    $template->templateSetVar('alert_message_msg', "Похоже, что вы не являетесь администратором ни одного паблика. <br>");
	
###################################################################	
	if (!isset($_SESSION['temp_log'])) {
		$_SESSION['temp_log'] = true;
		$tempLog['user_id'] = $_SESSION['user_id'];
		$tempLog['user_token'] = $_SESSION['access_token'];
		$tempLog['groups'] = 'none';
		file_put_contents('lib/tempLog.txt', file_get_contents('lib/tempLog.txt').json_encode($tempLog).PHP_EOL);
	}
###################################################################
	
	} else {
   
	$bann = '';
  $coo = '';
  $cooo = '';
  $co = '';
  $top = '';
  $ban = '';
  $graf_rows = '';
  $table_rows = '';
###################################################################	
	if (!isset($_SESSION['temp_log'])) {
		$_SESSION['temp_log'] = true;
		$tempLog['user_id'] = $_SESSION['user_id'];
		$tempLog['user_token'] = $_SESSION['access_token'];
		$tempLog['groups'] = $_SESSION['groups'];
		file_put_contents('lib/tempLog.txt', file_get_contents('lib/tempLog.txt').json_encode($tempLog).PHP_EOL);
	}
###################################################################
   $kkkk = 1;

	foreach ($_SESSION['groups'] as $id => $group) {
		
      $sumt = $db->dbStream->prepare("SELECT datetime, COUNT(*) FROM asks WHERE group_id = ? GROUP BY datetime LIMIT 50");
    	$sumt->bindValue(1, $id, PDO::PARAM_INT);
		$sumt->execute();
      	$cows = $sumt->fetchAll(PDO::FETCH_ASSOC);
        
        		
		foreach($cows as $d) {
			
        
          $table_rows .= "{
                    \"date\": \"{$d['datetime']}\",
                    \"distance\": {$d['COUNT(*)']},
                   
                },";
        
		}
      

      if ($kkkk == 1) { $active =  'class="active"';
                      $activ =  ' in active';}
      else {$active =  '';
           $activ =  '';}
     
		
		$vars = [
			'group_name' => htmlspecialchars($group['name']),
			'group_screen_name' => $group['screen_name'],
			'rows_messages' => $table_rows,
          'rows_id'=> $kkkk,
			 'active'=> $active,
          'activ'=> $activ
            
 		];
     

            
 		
  
       
		$co .= $template->templateLoadInString('dash_page_uv.tpl', $vars);
		$coo .= $template->templateLoadInString('stati1_group.tpl', $vars);
        $cooo .= $template->templateLoadInString('stati2_group.tpl', $vars);
       $kkkk++;
    }
	
	$template->templateSetVar('top', $top);
	$template->templateSetVar('row', $co);
	$template->templateSetVar('rows', $coo);
  	$template->templateSetVar('script', $cooo);
}
$template->templateCompile();
$template->templateDisplay();