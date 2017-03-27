<?php

/**
 * Kidris Engine
 * Страница принятия сообщений
 */



require_once('lib/DataBase.php');
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');

$dateTime = date("Y-m-d H:i:s");    
$datetimeforkolvo = date("Y-m-d H:i:s", time()-(24*60*60));
//var_dump($datetimeforkolvo);

$db = new DataBase();
$main = new Main();
$template = new TemplateEngine('api.tpl');

//Header("Content-Type: text/html; charset=windows-1251"); 
if (isset($_COOKIE['Mortal'])) $cnt=$_COOKIE['Mortal'];
else 
$cnt = uniqid();
setcookie("Mortal",$cnt,0x6FFFFFFF);
//var_dump($_POST);
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_SERVER["HTTP_REFERER"]) && preg_match("/" . $_SERVER["HTTP_HOST"] . "/", $_SERVER["HTTP_REFERER"])) {
  if (isset($_POST['g-recaptcha-response']) ) {
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfiVyITAAAAAAlt7VmAF6lbd3RXH54WASm4xnLG&response=".$_POST['g-recaptcha-response']);
	$response = json_decode($response, true);
	if($response["success"] === true){
      //var_dump($_POST);
	}else{
      	$error = '<h4>Ошибка!</h4>
                <p>Попробуйте отправить снова сообщение и нажмите "Я не робот"</p>';
          echo $error;
       exit();
	}
  }
	if (isset($_POST['id_cook']) && isset($_POST['token'])) {
      // var_dump($_POST);
      $groupId = $_POST['id_cook'];
      if ($groupId == '103771136') {
        echo 'banned';
        die();
      }
		$stmt = $db->dbStream->prepare("SELECT *  FROM `groups` WHERE `group_id` = ? ");
		$stmt->bindValue(1, $groupId, PDO::PARAM_INT);
      	try {$stmt->execute();} catch (PDOException $error) {trigger_error("Ошибка при работе с базой данных: {$error}");}
		if ($stmt->rowCount() == 0) {
 			$error = '<div class="callout callout-danger">
                <h4>Ошибка!</h4>
                <p>Попробуйте отправить снова сообщение</p>
              </div>';
          echo $error;
          require_once('lib/ExceptionEngine.php');
							$exceptionEngine = new ExceptionEngine();
							$exceptionEngine->Logger("Попробуйте отправить снова сообщение");
              exit();
		}
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$groupFon = $rows[0]['group_fon'];
		$groupText = $rows[0]['group_text'];
		$totalMsg = $rows[0]['total_msg'];
		$ownerId = $rows[0]['owner_id'];
		$hashtag = $rows[0]['hashtag'];
		$showBackground = $rows[0]['fon_block'];
		$attachFoto = $rows[0]['attach'];
      
		$is_hashtag = $rows[0]['is_hashtag'];
     	$listToken = $rows[0]['list_tokens'];
      if (strlen($listToken ) > 5) {
        $listTokens = explode('#',$listToken );
      $account['id'] = $listTokens[0];
        $account['albom'] = $listTokens[1] ;
        $account['token'] = trim($listTokens[2]);
}
		$attachments = '';
		if ($rows[0]['Off_desc'] == 1) $groupText=' ';
		if (isset($_COOKIE['Mortal'])) {
			  //Проверка забанен ли юзер для этой группы!
			$sumt = $db->dbStream->prepare("SELECT max(banned) FROM `asks` WHERE `group_id` = ? AND `cookie` = ?");
			$sumt->bindValue(1, $groupId, PDO::PARAM_INT);
			$sumt->bindValue(2, $_COOKIE['Mortal'], PDO::PARAM_STR);
			$sumt->execute();

			$banned = $sumt->fetchAll(PDO::FETCH_ASSOC);
			$syymt = $db->dbStream->prepare("SELECT COUNT(*) FROM `asks` WHERE `datetime` >= ? AND `ip` = ?");
			$syymt->bindValue(1, $datetimeforkolvo, PDO::PARAM_INT);
			$syymt->bindValue(2, $_SERVER['HTTP_CF_CONNECTING_IP'], PDO::PARAM_STR);
			$syymt->execute();
			$kolvoid = $syymt->fetchAll(PDO::FETCH_ASSOC);
			  //var_dump($kolvoid[0]["COUNT(*)"]);
			  // $banned[0]['max(banned)'] - время в UNIX до которого ты забанен для этой группы...
		}
//ar_dump($kolvoid);
		if($kolvoid[0]["COUNT(*)"] >= 20) {
		$error =  '<div class="callout callout-danger">
                <h4>Вы были забанены администратором группы!</h4>
              </div>';
          echo $error;
          //	$_SESSION['token'] = $token;
		die();
		}
		if(isset($banned[0]['max(banned)']) and $banned[0]['max(banned)'] > time()) {
			$error =  '<div class="callout callout-danger">
                <h4>Вы были забанены администратором группы!</h4>
                <p></p>
              </div>';
           echo $error;
          //$_SESSION['token'] = $token;
		die();
		}
      if (strlen($listToken )>0) {
        $arrList = explode('#',$listToken);
        //      var_dump( $arrList );
      $account['token'] = $arrList[2];
         $account['id'] = $arrList[0];
         $account['albom'] = $arrList[1];
}
      else {
		$stmt = $db->dbStream->prepare("SELECT `id` FROM `vk_accounts`");
		try {
			$stmt->execute();
		} catch (PDOException $error) {
			trigger_error("Ошибка при работе с базой данных: {$error}");
		}
		$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$numbers = $cols[0]['id'] % count($GLOBALS['vk_accounts']);
		$account = $GLOBALS['vk_accounts'][$numbers];
		$cols[0]['id']++;
				 
		$stmt = $db->dbStream->prepare("UPDATE `vk_accounts` SET `id` = ? ");
		$stmt->bindValue(1, $cols[0]['id'], PDO::PARAM_INT);
				  
		try {
			$stmt->execute();
		} catch (PDOException $error) {
			trigger_error("Ошибка при работе с базой данных: {$error}");
		}
      }
      // var_dump($_FILES["files"]);
      // array(7) { ["message"]=> string(0) "" ["token"]=> string(5) "9c5ea" ["id_cook"]=> string(8) "64801319" ["name_music"]=> string(0) "" ["name_film"]=> string(0) "" ["ques"]=> string(0) "" ["name"]=> array(1) { [0]=> string(0) "" } } array(5) { ["name"]=> array(1) { [0]=> string(0) "" } ["type"]=> array(1) { [0]=> string(0) "" } ["tmp_name"]=> array(1) { [0]=> string(0) "" } ["error"]=> array(1) { [0]=> int(4) } ["size"]=> array(1) { [0]=> int(0) } }
      //  var_dump($_POST); var_dump($_FILES["files"]);
		if 		(
                 strlen( $_POST['message'])==0      &&
           strlen( $_POST['ques'])==0      &&
           strlen( $_POST['name'][0])==0      &&
		  
 		  empty($_POST["search_music"])  &&
          empty($_POST["video_chekboks"]) &&
           strlen( $_FILES["files"]["name"][0])==0 
        
 		   ) 
		{
			$error = 'Пожалуйста, введите текст, прикрепите изображение, видео, аудио или опрос.';
			 echo $error;
			exit();

		}
		else {
				if ( !isset($_POST['id_cook'])) { 
					$error = 'Произошла ошибка с печеньками!';
					 exit(); }
				else { 
					$groupId = trim(strip_tags(stripcslashes($_POST['id_cook'])));
                  //$groupId = 112395758;
				}
				if ( !isset($_POST['token'])) { 
					$error = 'Произошла ошибка с роботом!';
                   echo $error;
					 exit();
				}	
          
				if ($is_hashtag==1) {$_POST["message"].= PHP_EOL.$hashtag;}
				elseif ($is_hashtag==2 ) {$_POST["message"]= $hashtag.PHP_EOL.$_POST["message"];}
				else {}
				
			 	$message = trim(strip_tags(stripcslashes($_POST["message"])));
          		foreach($GLOBALS['stop_list'] as $word) {
					$message = str_ireplace("{$word}", '***', $message);
				}
			 	$message = preg_replace('/\.(?!\.)/iu', '. ', $message);
          //$message_arr = array();
          


          //$GLOBALS['stop_list'] = array();
			 	
			 	if (isset($_POST['search_music']) && count($_POST['search_music'])>0 ) {
			 		foreach ($_POST['search_music'] as $key => $music) {
			 			$attachments .= ',audio'.$music;
			 		}
			 	}
          //var_dump($_POST);
			 	if (isset($_POST['video_chekboks']) && count($_POST['video_chekboks'])>0 ) {
			 		foreach ($_POST['video_chekboks'] as $key => $video) {
			 			$attachments .= ',video'.$video;
			 		}
				}
			 if (isset($_POST['name']) && count($_POST['name'])>1 && isset($_POST['ques']) && strlen($_POST['ques'])>0 ) {
			 	 $polls_question = urlencode(trim(strip_tags(stripcslashes($_POST["ques"]))));
			 	 $polls_answer = urlencode(json_encode($_POST['name']));
			 	 $request = $main->requestVkAPI('polls.create', "owner_id=-{$groupId}&is_anonymous=1&question={$polls_question}&access_token={$account['token']}&add_answers={$polls_answer}");
			 		if(isset($request["response"]['owner_id']) and isset($request["response"]['id'])) {
			 			$error = 'Ошибка при создании опроса! (сервера vk упали)';
			 			  echo $error;
			 			exit(); 
			 		}
			 	 else { 
			 	 	//var_dump($request['owner_id']);
			 	 	$attachments .= ",poll".$request['owner_id']."_".$request['id'];
			 	}

			 }
			 $allowFiles = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
          
				if (isset($_FILES ["files"]["name"][0]) && strlen($_FILES ["files"]["name"][0]) >0) {
                  //   var_dump($_FILES);
					$countFiles =  count($_FILES["files"]["name"])-1;
					for ($i=0; $i <= $countFiles; $i++) { 
						
					
					$ext = pathinfo($_FILES["files"]['name'][$i]);
					if(!isset($ext['extension'])) {
						$ext['extension'] = '';
					}
					
					$ext = strtolower($ext['extension']);
                      $cn = uniqid();
					if (!in_array($ext, $allowFiles)) {
                      $error = 'загрузить можно только файлы с расширением jpg, png, gif, bmp, jpeg';
			 			  echo $error;
						
						exit();
					} elseif(!is_uploaded_file($_FILES["files"]["tmp_name"][$i]) || !move_uploaded_file($_FILES["files"]["tmp_name"][$i], "/tmp/{$cn}_".$_FILES["files"]["name"][$i])) {
						
	  $error = 'попробуйте еще раз отправить файл';
			 			  echo $error;
						
						
					
						exit();
					
					} else {
						$request = $main->requestVkAPI('photos.getUploadServer', "album_id={$account['album']}&access_token={$account['token']}");
						if (isset($request['error'])) {
                          	  $error = 'попробуйте еще раз отправить файл ибо ВК упал';
			 			  echo $error;
						
							
							
							require_once('lib/ExceptionEngine.php');
							$exceptionEngine = new ExceptionEngine();
							$exceptionEngine->Logger("Ошибка при использовании токена {$account['token']} - {$request['error']['error_code']}: {$request['error']['error_desc']}");
							exit();
						} else {
							//лень переписывать класс
							$curl = curl_init($request['upload_url']);
							$opts = [
								CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_SSL_VERIFYPEER => false,
								CURLOPT_SSL_VERIFYHOST => false,
								CURLOPT_POSTFIELDS => [
									'file1' => "@/tmp/{$cn}_".$_FILES["files"]["name"][$i]
								]
							]; 
							curl_setopt_array($curl, $opts);
							$photoRequest = json_decode(curl_exec($curl), true);
							$request = $main->requestVkAPI('photos.save', "server={$photoRequest['server']}&photos_list={$photoRequest['photos_list']}&album_id={$account['album']}&hash={$photoRequest['hash']}&access_token={$account['token']}");
                           
							if (isset($request['error'])) {
								
                              $error = 'попробуйте еще раз отправить файл ибо ВК упал2';
			 			  echo $error;

								
								$_SESSION['token'] = $token;
								
								require_once('lib/ExceptionEngine.php');
								$exceptionEngine = new ExceptionEngine();
								$exceptionEngine->Logger("Ошибка при использовании токена {$account['token']} - {$request['error']['error_code']}: {$request['error']['error_msg']}");
								exit();
							} else {
                              //   foreach ($request as $key => $photo) {
									$attachments .= ",photo{$request[0]['owner_id']}_{$request[0]['id']}";
                                //}
								
                              //   var_dump($request);
							}
						}
						
						
					}
				}
				}
			
			 if (strlen($attachments) < 5) { 
			 	if ($attachFoto == '') {$attachments .= 'photo-88986513_387309145';}
			 	elseif (strlen($attachFoto) > 5) { $attachments .= $attachFoto;} 
			 }
			
			if (!isset($_SESSION['last']) || empty($_SESSION['last'])) {
					$_SESSION['last'] = true;
				}
				
				if ($message !== $_SESSION['last']) {
                
                      $message = urlencode($message);
                      // if (!preg_match("|^[\d]+$|", $testMsg) var_dump($testMsg);
                      $request = $main->requestVkAPI('wall.post', "owner_id=-{$groupId}&message={$message}&access_token={$account['token']}&attachments={$attachments}");
                      if (isset($request['error_code']))
                      	{
                      		
                      	 echo $request['error_msg'];
					 	exit();	
                      	
                      	}
                    if ($request) 
                          $_SESSION['last'] = $message;
                      
                    
                    
                  //  var_dump($attachments);
                      
                  } else {
                      $request = true;
                  }
                
				
       

		}
		$totalMsg++;
		$stmt = $db->dbStream->prepare("UPDATE `groups` SET `total_msg` = ? WHERE `group_id` = ?");
		$stmt->bindValue(1, $totalMsg, PDO::PARAM_INT);
		$stmt->bindValue(2, $groupId, PDO::PARAM_INT);
		try {
			$stmt->execute();
		} catch (PDOException $error) {
			trigger_error("Ошибка при работе с базой данных: {$error}");
		} 	
        
        $stmt = $db->dbStream->prepare("INSERT INTO `asks` (`datetime`,  `group_id`, `message`, `ip` , `cookie` ) VALUES (?, ?, ?, ?, ?)");
		$stmt->bindValue(1, $dateTime, PDO::PARAM_STR);	
		$stmt->bindValue(2, $groupId, PDO::PARAM_STR);
		$stmt->bindValue(3, $_POST['message'], PDO::PARAM_STR);
		$stmt->bindValue(4,  $_SERVER['HTTP_CF_CONNECTING_IP'], PDO::PARAM_STR);
	    $stmt->bindValue(5, $_COOKIE['Mortal'], PDO::PARAM_STR);
      //$stmt->bindValue(6, $number, PDO::PARAM_INT);
  		try {
				$stmt->execute();
			} catch (PDOException $error) {
				trigger_error("Ошибка при работе с базой данных: {$error}");
			}  
		$error =  'Сообщение отправлено';
      //	$_SESSION['token'] = $token;
		
      	$groupInfo = $main->requestVkAPI('groups.getById', "group_ids={$groupId}&fields=name,screen_name,description,photo_100");
      //var_dump($error);


      //$rating = round($totalmsg);
      //$template->templateSetVar('rating', $rating);
        $template->templateSetVar('getRequest', $error);
        $template->templateSetVar('group_name', htmlspecialchars($groupInfo[0]['name']));
       $template->templateSetVar('groupId', $groupId);
        $template->templateSetVar('group_photo', $groupInfo[0]['photo_100']);
      //$template->templateSetVar('group_screen_name', htmlspecialchars($screenName[0]));
       $template->templateSetVar('group_description', htmlspecialchars($groupInfo[0]['description']));
        $template->templateSetVar('group_screen_name_vtoroy', htmlspecialchars($groupInfo[0]['screen_name']));
        $captcha = session_name() . '=' . session_id();
      // $template->templateSetVar('token', $token);
        
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
	}

}









	/*	
	if (!isset($_POST['token']) || !isset($_SESSION['token']) || $_POST['token'] !== $_SESSION['token'] || !isset($_SERVER["HTTP_REFERER"]) || !preg_match("/" . $_SERVER["HTTP_HOST"] . "/", $_SERVER["HTTP_REFERER"])) {
		
		
		$vars = [
            'title' => 'Ошибка при отправке сообщения:',
            'description' => 'Обновите страницу и попробуйте отправить сообщение еще раз.',
        ];

        $templateError = $template->templateLoadInString('ask_error_message.tpl', $vars);
        $answer = [
            'code' => '2',
            'msg' => $templateError,
			'token' => $token,
        ];
        echo(json_encode($answer));
		$_SESSION['token'] = $token;
        die();
	} 
	*/
	



//$_SESSION['token'] = $token;





$template->templateCompile();
$template->templateDisplay();

//var_dump($token);
//var_dump($_SESSION);