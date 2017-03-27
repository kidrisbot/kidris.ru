<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);
if (isset($_COOKIE['Mortal'])) $cnt=$_COOKIE['Mortal'];
else {$cnt = uniqid(); setcookie("Mortal",$cnt,0x6FFFFFFF);}
//var_dump('55555');
require_once('lib/DataBase.php');
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');
require_once('lib/AcceptLanguage.php');
$AcceptLang = new AcceptLang();
$lang   = $AcceptLang -> getArrayLang();
//$lang['ru']= 'ru';
$defineWords = $AcceptLang -> getDefineWords($lang);
$main = new Main();
$db = new DataBase();
$template = new TemplateEngine('comment_page.tpl');
//$AcceptLang = new AcceptLang();

$access_token = $GLOBALS['acc'];

$wall_posts = '';
$controller = explode('/', $_GET['route']);
if (empty($controller[1])) {
    require_once("models/404.php");
}
else
{
$stmt = $db->dbStream->prepare("SELECT *  FROM `groups_comment` WHERE `screen_name` = ? LIMIT 1");
$stmt->bindValue(1, $controller[1], PDO::PARAM_INT);
try 
{
    $stmt->execute();
}
catch (PDOException $error) 
{
    trigger_error("Ошибка при работе с базой данных: {$error}");
}
if ($stmt->rowCount() == 0) 
{
    require_once("models/404.php");
}
else { 
    $groupSql = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $groupId            = $groupSql[0]['group_id'];
    $screenName         = $groupSql[0]['screen_name'];
    $totalMsg           = $groupSql[0]['total_msg'];
    $description        = $groupSql[0]['description'];
    $photoCaption       = $groupSql[0]['photo_caption'];
    $hideDesc           = $groupSql[0]['hide_desc'];
    $photoCaption       = ($groupSql[0]['hide_photo_caption'] == 1) ? '' : $photoCaption;
    $hideLinks          = $groupSql[0]['hide_links'];
    $hashtag    = $groupSql[0]['hashtag'];
    $addHashtag    = $groupSql[0]['add_hashtag'];
    $hideNumberPosts    = $groupSql[0]['hide_number_posts'];
    $token              = $groupSql[0]['token'];
    $hideNumberSuggested = $groupSql[0]['hide_number_suggested'];
    $hideNumberFollowers = $groupSql[0]['hide_number_followers'];
}
}
//$reque = $main->requestVkAPI('groups.get', "group_id={$groupId}&user_id=364785006&extended=1&access_token={$GLOBALS['acc']}");

$groupInfo = $main->requestVkAPI('groups.getById', "group_ids={$groupId}&fields=admin_level,name,screen_name,description,photo_100,members_count,status,links,is_admin&access_token={$GLOBALS['acc']}");
//var_dump($groupInfo);
if ($groupInfo[0]['is_admin'] == 0) {echo 'Нужно сделать этот аккаунт https://vk.com/id364785006 редактором, чтобы не банили'; die();}
$com_links = '';

if (isset($groupInfo[0]['links']) && $hideLinks == 0) 
 
foreach ($groupInfo[0]['links'] as $link) {
  
  if (!isset($link["photo_100"])) {$link["photo_100"]= 'http://cs636123.vk.me/v636123475/196f6/mUD4ssoNHMo.jpg';}
 $varLinks = [
 "urlLink"=> $link["url"],
 "nameLink"=> $link["name"],
 "photo_100Link"=> $link["photo_100"],
 ];
  
 $com_links .= $template->templateLoadInString('com_links.tpl', $varLinks);
  

}
  

if ($hideNumberSuggested == 0) 
{
    $countSuggest = $main->requestVkAPI('wall.get', "owner_id=-{$groupId}&count=11&offset=1&filter=suggests&access_token={$access_token}");
    $template->templateSetVar('countSuggest', $countSuggest["count"]);
}

$request = $main->requestVkAPI('wall.get', "owner_id=-{$groupId}&count=11&offset=0");


$count = ($request['count'] <= 10) ? $request['count'] : 10 ;
if ($count == 0) { echo "Алло! У вас нет никаких записей! Добавьте хотя бы одну.";
    die();
    # code...
}
for ($i=0; $i<=$count-1; $i++) {
    // if ( $request["items"][$i]["is_pinned"]) {
    //     #  оотключаем
    // }
   $request["items"][$i]["text"] =  preg_replace ("/[\r\n]/","<br />", $request["items"][$i]["text"]);
    $var = [
    "date"=> gmdate("d-m-Y H:i", $request["items"][$i]["date"]), 
    "text"=> $request["items"][$i]["text"],
    "comments"=> $request["items"][$i]["comments"]["count"],
    "likes"=> $request["items"][$i]["likes"]["count"],
    "id"=> $i,
    "idGroup"=> $groupId,
    "cnt"=> uniqid(),
    "id_post"=> $request["items"][$i]['id'],
    
    ];
    if (isset($request["items"][$i]["attachments"])) {
      $count_attachmenst = count($request["items"][$i]["attachments"])-1;
      $string = '';

      for ($j=0; $j<=$count_attachmenst; $j++) {

      //$request["items"][$i]["attachments"][$j];
        if (isset($request["items"][$i]["attachments"][$j]["photo"]))
          if ($j%2 ==0) { $string .= '<div class="col-sm-4"><img class="img-responsive" src="'.getLargePhoto($request["items"][$i]["attachments"][$j]["photo"]).'" alt="Photo">';
        if ($j == $count_attachmenst) {$string .= '</div>';}
      }
      else { $string .= ' <br><img class="img-responsive" src="'.getLargePhoto($request["items"][$i]["attachments"][$j]["photo"]).'"../../dist/img/photo3.jpg" alt="Photo"></div>';}

    }
    $var["attachments"] = $string;
  }
  $wall_posts .= $template->templateLoadInString('wall_posts.tpl', $var);
}

if (isset($_GET['message']) && isset($_GET['id']) && (isset($_GET['cnt']))) 
{

    //file_put_contents('file.txt',var_export($_GET,true));
      $post_id = $_GET['id'];
  $cntNew = $_GET['cnt'];
  
    if (isset($_COOKIE['Mortal'])) {
      
      $stmt = $db->dbStream->prepare("SELECT COUNT(*)  FROM `comments` WHERE `comment_cookie` LIKE ?  AND `comment_date` = ? ");
      $stmt->bindValue(1, $_COOKIE['Mortal'], PDO::PARAM_STR);
      $stmt->bindValue(2, date("Y-m-d"), PDO::PARAM_STR);
      try 
      {
          $stmt->execute();
      }
      catch (PDOException $error) 
      {
          trigger_error("Ошибка при работе с базой данных: {$error}");
      }
       $BD = $stmt->fetchAll(PDO::FETCH_ASSOC);
       if ($BD[0]["COUNT(*)"] <= 25) 
       {
          $message = preg_replace('/\.(?!\.)/iu', '. ', $_GET['message']);
          $attachments = $photoCaption;
          if ($addHashtag == 1)  $message = $hashtag.PHP_EOL.$message;
          if ($addHashtag == 2)  $message = $message.PHP_EOL.$hashtag;
         $message = preg_replace('/\.(?!\.)/iu', '. ', $message);
         foreach($GLOBALS['stop_list'] as $word) {
			$message = str_ireplace("{$word}", '***', $message);
		}
          $message = urlencode($message);
         $request = $main->requestVkAPI('wall.createComment', "owner_id=-{$groupId}&post_id={$post_id}&message={$message}&attachments={$attachments}&from_group=1&guid={$cntNew}&access_token={$GLOBALS['acc']}");

         // send($groupId, $post_id, $message, $attachments, $cntNew);
          $smt = $db->dbStream->prepare("INSERT INTO `comments` (`comment_text`, `comment_id_group`, `comment_id_comment`, `comment_cookie`, `comment_date`) VALUES (?, ?,?,?,?)");
          $smt->bindValue(1, $message, PDO::PARAM_STR);
          $smt->bindValue(2, $groupId, PDO::PARAM_INT);
          $smt->bindValue(3, $post_id, PDO::PARAM_INT);
          $smt->bindValue(4, $_COOKIE['Mortal'], PDO::PARAM_STR);
          $smt->bindValue(5, date("Y-m-d"), PDO::PARAM_STR);
          try 
          {
              $smt->execute();
          } 
          catch (PDOException $error) 
          {
              trigger_error("Ошибка при работе с базой данных: {$error}");
          }
          //send
       }
    }


}




$template->templateSetVar('wall_posts', $wall_posts);
$template->templateSetVar('com_links', $com_links);
$template->templateSetVar('posts', $request["count"]);
$template->templateSetVar('status', $groupInfo[0]["status"]);
$template->templateSetVar('group_name', htmlspecialchars($groupInfo[0]['name']));
$template->templateSetVar('group_photo', $groupInfo[0]['photo_100']);
$template->templateSetVar('group_screen_name', htmlspecialchars($groupInfo[0]['screen_name']));

if ($hideDesc == 0) 
{
    if (strlen($description) > 0) 
    {
        $template->templateSetVar('group_description', htmlspecialchars($description));
    }
    else
    {
        $template->templateSetVar('group_description', htmlspecialchars($groupInfo[0]['description']));
    }
}
$template->templateSetVar('groupId', $groupId);
$template->templateSetVar('Followers', $groupInfo[0]["members_count"]);
 foreach ($defineWords as $key => $defineWord) {
           $template->templateSetVar( $key, $defineWord);
}
$template->templateCompile();
$template->templateDisplay();

function getLargePhoto($photo) {
  if (isset($photo["photo_807"])) { return $photo["photo_807"]; exit();}
  if (isset($photo["photo_604"])) { return $photo["photo_604"]; exit();}
  if (isset($photo["photo_130"])) { return $photo["photo_130"]; exit();}
  if (isset($photo["photo_75"])) { return $photo["photo_75"]; exit();}
}
function send($groupId, $post_id, $message, $attachments, $cntNew)
{
    $url = 'https://api.vk.com/method/wall.createComment';
    $params = array(
        'owner_id' => '-'.$groupId,    // Кому отправляем
        'post_id' => $post_id,
        'message' => $message,   // Что отправляем
        'from_group' => 1,
        'attachments' => $attachments,   // Что отправляем
      'guid' => $cntNew,
        'access_token' => 'febd1ba8c40ba1b6dd000507bb36f8aa1944e8976ead38f4c0be9bff4d1d8a63895db4ca40d0ae58f1c9b',  // access_token можно вбить хардкодом, если работа будет идти из под одного юзера
        'v' => '5.53',
    );

    // В $result вернется id отправленного сообщения
    $result = file_get_contents($url, false, stream_context_create(array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($params)
        )
    )));
}