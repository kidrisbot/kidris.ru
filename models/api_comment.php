<?php
if (isset($_COOKIE['Mortal'])) $cnt=$_COOKIE['Mortal'];
else
$cnt = uniqid();
setcookie("Mortal",$cnt,0x6FFFFFFF);
require_once('lib/Main.php');
require_once('lib/DataBase.php');
$db = new DataBase();
$main = new Main();


//$groupInfo = $main->requestVkAPI('groups.getById', "group_ids={$groupId}&fields=name,screen_name,description,photo_100");

$groupId = 75359956;
$access_token = 'e275b2a3eca953211905255f0da1150dff9216786566bdf1ffa31fce9781d404d78def12d9a3710581faf';
//var_dump($_GET);
if(isset($_GET) && !empty($_GET['message']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
  foreach($_GET['message'] as $key => $message)
  {
    $message_array = explode('####', $message );
    //var_dump($message_array);
    if(!empty($message_array[0] ))
      
    {// var_dump($message_array);
     $message_array[0] = trim(strip_tags(stripcslashes($message_array[0])));
          		/*foreach($GLOBALS['stop_list'] as $word) {
					$message_array[0] = str_ireplace("{$word}", '***', $message_array[0]);
				}*/
			 	$message_array[0] = preg_replace('/\.(?!\.)/iu', '. ', $message_array[0]);
     $message_array[0] = 'АНОНИМНЫЙ КОММЕНТАРИЙ '.PHP_EOL.$message_array[0];
     $message_post = urlencode($message_array[0]);
     $message_post_id = urlencode($message_array[1]);
     $message_guid = urlencode($message_array[2]);
     $dateTime = date("Y-m-d");     
     $dateTimeYesterday = date("Y-m-d");
$syymt = $db->dbStream->prepare("SELECT COUNT(*) FROM `comments` WHERE `comment_date` = ? AND `comment_ip` = ?");
			$syymt->bindValue(1, $dateTimeYesterday, PDO::PARAM_STR);
			$syymt->bindValue(2, $_SERVER['HTTP_CF_CONNECTING_IP'], PDO::PARAM_STR);
			try {
				    $syymt->execute();
				} catch (PDOException $error) {
				    trigger_error("Ошибка при работе с базой данных: {$error}");
				}
			$kolvoid = $syymt->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($kolvoid);
	if($kolvoid[0]["COUNT(*)"] >= 6) {
		$error =  '<div class="callout callout-danger">
                <h4>Не отправим сообщение!</h4>
                <p> Лимит)</p>
              </div>';
          echo $error;
          //	$_SESSION['token'] = $token;
		//die();
		}





    $groupAddComment = $main->requestVkAPI('wall.createComment', "owner_id=-{$groupId}&post_id={$message_post_id}&from_group=1&message={$message_post}&guid={$message_guid}&access_token={$access_token}");
     //  var_dump($groupAddComment);
     if (isset($groupAddComment["comment_id"])) {echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Отправлено!</h4>
               Анонимный комментарий успешно отправлен
              </div>';
              	$stmt = $db->dbStream->prepare("INSERT INTO  `comments` (`comment_text`,  `comment_id_group`, `comment_id_comment`, `comment_cookie` , `comment_date`, `comment_ip` ) VALUES (?, ?, ?, ?, ?, ?)");
				$stmt->bindValue(1, $message_array[0], 			PDO::PARAM_INT);
				$stmt->bindValue(2, $groupId,      			PDO::PARAM_INT);
				$stmt->bindValue(3, $message_post_id, PDO::PARAM_INT);
				$stmt->bindValue(4, $_COOKIE['Mortal'], 	PDO::PARAM_STR);
				$stmt->bindValue(5,  $dateTime,				PDO::PARAM_STR);
				$stmt->bindValue(6, $_SERVER['HTTP_CF_CONNECTING_IP'], PDO::PARAM_STR);



				try {
				    $stmt->execute();
				} catch (PDOException $error) {
				    trigger_error("Ошибка при работе с базой данных: {$error}");
				}
				
          	}
     else { 
       echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Ой, всё!</h4>
                Либо упал сервер вк, либо аккаунт заблокировали
              </div>';
     }
    }
  }
}
