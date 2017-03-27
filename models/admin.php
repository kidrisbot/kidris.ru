<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
error_reporting(-1);

require_once('lib/DataBase.php');
require_once('lib/TemplateEngine.php');
require_once('lib/Main.php');
require_once('lib/AcceptLanguage.php');

$blockCommentPage = ''; //вдруг сломается нафиг все
$AcceptLang = new AcceptLang();
$lang   = $AcceptLang -> getArrayLang();
$defineWords = $AcceptLang -> getDefineWords($lang);
$main = new Main();
$db = new DataBase();
$template = new TemplateEngine('admin_page.tpl');
$AcceptLang = new AcceptLang();
//сессия
// $_SESSION['user_id'] = 253358984;
// $_SESSION['user_id'] = 353389489;
// $is_vip = 0; // на всякий случай
// // $_SESSION['access_token'] = '15929903264b84902e89a547329712755e55cc501e9aaed08ec90c8dc3299de5ca1722eb949d308190a57'; // моё
// $_SESSION['access_token'] = '3326f0f7663955b9f51c96ca0baa211ff566321534c5c41000f19b397075357ea7871152712074a3f7d2a';
// //
if (!isset($_SESSION['user_id']) || !isset($_SESSION['access_token'])) {
    header('Location: /');
    die();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /');
}
$referal = (isset($_COOKIE['ref'])) ? $referal = $_COOKIE['ref'] : '' ;

//проверка. зареган ли участник
$stmt = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `id` = ? LIMIT 1");
$stmt->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
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
    $smt = $db->dbStream->prepare("INSERT INTO `users` (`id`, `ref`) VALUES (?, ?)");
    $smt->bindValue(1, $_SESSION['user_id'], PDO::PARAM_INT);
    $smt->bindValue(2, $referal, PDO::PARAM_INT);
    try 
    {
        $smt->execute();
    } 
    catch (PDOException $error) 
    {
        trigger_error("Ошибка при работе с базой данных: {$error}");
    }
    $smt = $db->dbStream->prepare("SELECT *  FROM `users` WHERE `id` = ? LIMIT 1");
    $smt->bindValue(1, $referal, PDO::PARAM_INT); 
    try 
    {
        $smt->execute();
    }
    catch (PDOException $error) 
    {
        trigger_error("Ошибка при работе с базой данных: {$error}");
    }
    if ($smt->rowCount() != 0) 
    {
        $referalItems = $smt->fetchAll(PDO::FETCH_ASSOC);
        $pointRef = intval($referalItems[0]['point']) + 100;
        $ratingRef = intval($referalItems[0]['rating']) + 1;
        $smt = $db->dbStream->prepare("UPDATE `users` SET `point` = ?, `rating` = ? WHERE `id` = ?");
        $smt->bindValue(1, $pointRef, PDO::PARAM_INT);
        $smt->bindValue(2, $ratingRef, PDO::PARAM_INT);
        $smt->bindValue(3, $referal, PDO::PARAM_INT);
        try 
        {
            $smt->execute();
        } 
        catch (PDOException $error) 
        {
            trigger_error("Ошибка при работе с базой данных: {$error}");
        }
        
    }
    $rating = 0;
    $point  = 0;
} 
else 
{
    $userItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rating = $userItems[0]['rating'];
    $is_vip  = 2147483647;  //$userItems[0]['is_vip'];
    $point  = $userItems[0]['point'];
    $access_token  = $userItems[0]['token'];
}
//инфа о юзере
$user  = $main->requestVkAPI('users.get', "user_ids={$_SESSION['user_id']}&fields=photo_100,sex,bdate,city,country&name_case=Nom&v=5.5&access_token={$_SESSION['access_token']}");
if (isset($user['error']) || !$user)  
{
  $answer = [
  'code' => 3,
  'msg' => 'Какая-то непонятная ошибка, почему то не хочет загружать ваше ФИО и аватарку из вк',
  ];
  echo(json_encode($answer));
  die();
}
else
   $spisokludey = '' ;
{
    $template->templateSetVar('FIO', $user[0]['first_name'].' '.$user[0]['last_name']);
    $template->templateSetVar('photo_100', $user[0]['photo_100']);
}
//инфа о его группах
$sidebar_menu_groups  = '';
$groups     = $main->requestVkAPI('groups.get', "user_id={$_SESSION['user_id']}&extended=1&filter=admin&fields=description&access_token={$_SESSION['access_token']}");
if (isset($groups['error']) || !$groups) 
{
	$answer = [
    'code' => 3,
    'msg' => 'Какая-то непонятная ошибка, почему то вконтакте не хочет загружать ваши группы',
    ];
    echo(json_encode($answer));
    die();
}
else
{
    $controller = explode('/', $_GET['route']);
    $idRoute = 0;
    if (count($groups["items"]) > 0) 
        foreach ($groups["items"] as $group) 
        {

            $idRoute = (isset($controller[1]) && $controller[1] == $group["id"]) ? $group["id"] : $idRoute;
            $varLinks = 
            [
            "id"    => $group["id"],
            "name"  => $group["name"],
            //"photo_100Link"=> $group["photo_100"],
            ];
            $sidebar_menu_groups .= $template->templateLoadInString('sidebar_menu_groups.tpl', $varLinks);
        }
        if ($idRoute != 0) 
        {
            $groupInfo     = $main->requestVkAPI('groups.getById', "group_id={$idRoute}&fields=description&access_token={$_SESSION['access_token']}");
            if (isset($groupInfo['error']) || !$groupInfo) 
            {
                $answer = [
                'code' => 3,
                'msg' => 'Какая-то непонятная ошибка 2, почему то вконтакте не хочет загружать о вашей группе инфу',
                ];
                echo(json_encode($answer));
                die();
            }
            $varLinks = 
            [
            "id"            => $groupInfo[0]["id"],
            "name"          => $groupInfo[0]["name"],
            "type"          => $groupInfo[0]["type"],
            "is_closed"     => $groupInfo[0]["is_closed"],
            "photo_100"     => $groupInfo[0]["photo_100"],
            "screen_name"   => $groupInfo[0]["screen_name"],
            ];
            $stmt = $db->dbStream->prepare("SELECT *  FROM `groups_comment` WHERE `group_id` = ? LIMIT 1");
            $stmt->bindValue(1, $groupInfo[0]["id"], PDO::PARAM_INT);
            try 
            {
                $stmt->execute();
            }
            catch (PDOException $error) 
            {
                trigger_error("Ошибка при работе с базой данных: {$error}");
            } 
            $blockAdvert = (time() > $is_vip) ? $template->templateLoadInString('advert.tpl', $varLinks) : '' ;
            $template->templateSetVar('blockAdvert', $blockAdvert);

            if ($stmt->rowCount() != 0) 
            {  
                $groupData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $varLinks['total_msg']             =  $groupData[0]['total_msg'];
                $varLinks['group_id']              =  $groupData[0]['group_id'];
                $varLinks['screen_name']           =  $groupData[0]['screen_name'];
                $varLinks['hashtag']               =  $groupData[0]['hashtag'];
                $varLinks['select_hashtag_end']    = ($groupData[0]['add_hashtag'] == 1) ? 'selected' : '' ;
                $varLinks['select_hashtag_first']  = ($groupData[0]['add_hashtag'] == 2) ? 'selected' : '' ;
                $varLinks['hide_photo_caption']    = ($groupData[0]['hide_photo_caption'] == 1) ? 'checked' : '' ;
                $varLinks['hide_desc']             = ($groupData[0]['hide_desc'] == 1) ? 'checked' : '' ;
                $varLinks['hide_links']            = ($groupData[0]['hide_links'] == 1) ? 'checked' : '' ;
                $varLinks['hide_number_followers'] = ($groupData[0]['hide_number_followers'] == 1) ? 'checked' : '' ;
                $varLinks['hide_number_posts']     = ($groupData[0]['hide_number_posts'] == 1) ? 'checked' : '' ;
                $varLinks['hide_number_suggested'] = ($groupData[0]['hide_number_suggested'] == 1) ? 'checked' : '' ;
                $varLinks['display_block_add'] = ($stmt->rowCount() != 0) ? 'display:none;' : '' ;
                $varLinks['display_block_edit'] = ($stmt->rowCount() != 0) ? '' : 'display:none;' ;
                $blockCommentPage = (time() > $is_vip) ? $template->templateLoadInString('blockEditCommentPage.tpl', $varLinks) : $template->templateLoadInString('blockEditVipCommentPage.tpl', $varLinks) ;
                $blockCommentPage .=   $template->templateLoadInString('blockAddCommentPage.tpl', $varLinks);
            }
            else 
            { 
                $varLinks['total_msg'] = 0;
                $varLinks['photo_caption'] = 'photo-88986513_431236010'; 

                $varLinks['display_block_add'] = ($stmt->rowCount() != 0) ? 'display:none;' : '' ;
                $varLinks['display_block_edit'] = ($stmt->rowCount() != 0) ? '' : 'display:none;' ;
                $blockCommentPage = (time() > $is_vip) ? $template->templateLoadInString('blockEditCommentPage.tpl', $varLinks) : $template->templateLoadInString('blockEditVipCommentPage.tpl', $varLinks) ;
                $blockCommentPage .=   $template->templateLoadInString('blockAddCommentPage.tpl', $varLinks);

            }
            //$blockCommentPage = ($stmt->rowCount() != 0) ?  $template->templateLoadInString('blockEditCommentPage.tpl', $varLinks) :  $template->templateLoadInString('blockAddCommentPage.tpl', $varLinks) ;
        }

}
if (isset($_GET['connect'])) {
  $joinGroup  = $main->requestVkAPI('groups.join', "group_id={$groupInfo[0]['id']}&access_token={$GLOBALS['acc']}");
if (isset($joinGroup['error']) || !$joinGroup)  
{ echo 'error'; die(); }
else 
{
  $groups     = $main->requestVkAPI('groups.get', "user_id={$_SESSION['user_id']}&extended=1&filter=admin&fields=description&access_token={$_SESSION['access_token']}");/*
  var_dump($groups);
    $editManager  = $main->requestVkAPI('groups.editManager', "group_id=129390402&user_id=364785006&role=editor&is_contact=0&access_token={$_SESSION['access_token']}&v=5.53");
  var_dump($editManager);
  if (isset($editManager['error']) || !$editManager) {echo $_SESSION['access_token']; die();}*/
}
    $answer = [
    'code' => '2',
    'msg' => '555',
    ];
    $stmt = $db->dbStream->prepare("INSERT INTO `groups_comment` (`group_id`,`screen_name`, `owner_id`) VALUES (?,?,?)");
    $stmt->bindValue(1, $groupInfo[0]["id"], PDO::PARAM_INT);
    $stmt->bindValue(2, $groupInfo[0]["screen_name"], PDO::PARAM_STR);
    $stmt->bindValue(3, $_SESSION['user_id'], PDO::PARAM_INT);
    try 
    {
        $stmt->execute();
    }
    catch (PDOException $error) 
    {
        trigger_error("Ошибка при работе с базой данных: {$error}");
    } 
    echo(json_encode($answer));
    die();
}
// сделать записи в бд
if (isset($_GET['disconnect'])) {
    
    $stmt = $db->dbStream->prepare("DELETE FROM `groups_comment` WHERE `group_id` = ? ");
    $stmt->bindValue(1, $groupInfo[0]["id"], PDO::PARAM_INT);
    try 
    {
        $stmt->execute();
    }
    catch (PDOException $error) 
    {
        trigger_error("Ошибка при работе с базой данных: {$error}");
    }
    $answer = [
    'code' => '2',
    'msg' => '555',
    ]; 
    echo(json_encode($answer));
    die();
}

if (isset($_GET['edit'])) 
{


    if (time() > $is_vip) 
    {
        $descriptionGet = strip_tags($_GET['a'][0]['value']);
        $stbd = $db->dbStream->prepare("UPDATE `groups_comment` SET 
                        `description` = ?,
                        `hide_desc` = ?,
                        `hashtag` = ?,
                        `add_hashtag` = ?,
                        `hide_links` = ?,
                        `hide_number_suggested` = ?
                        WHERE `group_id`= ? ");
        $stbd->bindValue(1, $descriptionGet, PDO::PARAM_STR);
        $stbd->bindValue(2, intval($_GET['a'][1]['value']), PDO::PARAM_INT);
        $stbd->bindValue(3, intval($_GET['a'][2]['value']), PDO::PARAM_INT);
        $stbd->bindValue(4, intval($_GET['a'][3]['value']), PDO::PARAM_INT);
        $stbd->bindValue(5, intval($_GET['a'][4]['value']), PDO::PARAM_INT);
        $stbd->bindValue(6, intval($_GET['a'][5]['value']), PDO::PARAM_INT);
        $stbd->bindValue(7, intval($_GET['edit']), PDO::PARAM_INT);

        try 
        {
            $stbd->execute();
        }
        catch (PDOException $error) 
        {
            trigger_error("Ошибка при работе с базой данных: {$error}");
        }

    }
    else
    {
        $photo_caption = '';
 //   file_put_contents('file.txt',var_export($_GET,true));

        $stbd = $db->dbStream->prepare("UPDATE `groups_comment` SET 
                        `description` = ?,
                        `hashtag` = ?,
                        `add_hashtag` = ?,
                        `hide_desc` = ?,
                        `hide_links` = ?,
                        `hide_photo_caption` = ?,
                        `hide_number_suggested` = ?,
                        `hide_number_posts` = ?,
                        `hide_number_followers` = ?
                        WHERE `group_id` = ? ");
        $stbd->bindValue(1, $_GET['a'][0]['value'], PDO::PARAM_STR);
       // $stbd->bindValue(2, $photo_caption, PDO::PARAM_STR);
        $stbd->bindValue(2, $_GET['a'][1]['value'], PDO::PARAM_STR);
        $stbd->bindValue(3, intval($_GET['a'][2]['value']), PDO::PARAM_INT);
        $stbd->bindValue(4, intval($_GET['a'][3]['value']), PDO::PARAM_INT);
        $stbd->bindValue(5, intval($_GET['a'][4]['value']), PDO::PARAM_INT);
        $stbd->bindValue(6, intval($_GET['a'][5]['value']), PDO::PARAM_INT);
        $stbd->bindValue(7, intval($_GET['a'][6]['value']), PDO::PARAM_INT);
        $stbd->bindValue(8, intval($_GET['a'][7]['value']), PDO::PARAM_INT);
        $stbd->bindValue(9, intval($_GET['a'][8]['value']), PDO::PARAM_INT);
        $stbd->bindValue(10, intval($_GET['edit']), PDO::PARAM_INT);
        try 
        {
            $stbd->execute();
        }
        catch (PDOException $error) 
        {
            trigger_error("Ошибка при работе с базой данных: {$error}");
        }
    }
    
    /*
    $answer = [
    'code' => '2',
    'msg' => '555',
    ]; */
    echo(json_encode($answer));
    die();
}



$template->templateSetVar('rating', $rating);

$template->templateSetVar('point', $point);
$template->templateSetVar('sidebar_menu_groups', $sidebar_menu_groups);
$template->templateSetVar('blockCommentPage', $blockCommentPage);
$template->templateCompile();
$template->templateDisplay();
