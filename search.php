<?php

if(!empty($_POST["film"])){ //Принимаем данные

$_POST["film"] = str_replace(" ", "%20",$_POST["film"]);
    $film = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["film"]))));
     $request = requestVkAPI('video.search', "q={$film}&sort=2&adult=0&extended=1&access_token=ef584b3652783460d14239a4d83be48f2a41f9ba1cd1ddaa5288584768f23193ff5852c8e0f81dc6d2207");

        if(isset($request['error']))  echo  '<div class="list-group-item list-group-item-danger"> Вк снова упал! </div>';
            else {
              

            $id = 0;
        
            if (!isset($request["items"]))  echo  '<div class="list-group-item list-group-item-warning"> Загрузка видео! </div>';   else {
//echo ' <select class="form-control" id="search_result_film" size="10"  name="search_film" multiple> ';

                foreach ($request["items"] as $key => $video) {
                    $id++;
                    if (strlen(htmlspecialchars($video["title"])) > 35 ) 
                        $video["title"] = mb_substr($video["title"],0,20, 'UTF-8').'...'; 

                //  echo '" class="img-rounded" alt="">';
if (($id % 6) == 0) {echo ' <div class="row">';}

                     echo '<div class="col-sm-3 col-md-2">
    <div class="thumbnail">
      <img src="'.$video["photo_130"].'" alt="">
      <div class="caption">
        <h4>'.$video["title"].'</h4>
        <label class="label_video">
    <input type="checkbox" name="video_chekboks[]" onchange="run2()"  id="video_chekboks[]" value="'.$video["owner_id"].'_'.$video["id"].'" class="toggle">
    </label>
       </div>
    </div>
  </div>'; //  
if (($id % 6) == 0) {echo ' </div>';}             
               
                            }
if (count($request["items"]) < 1) echo  '<div class="list-group-item list-group-item-danger"> По запросу '.$film.' не найдено ни одной видеозаписи!</div>';
                    //  echo ' </select> '; 
                      }
                            }

    // $db_music = $mysqli -> query("SELECT * from ".PREFIX."search WHERE name LIKE '%$film%'")
    // or die('Ошибка №'.__LINE__.'<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    // while ($row = $db_music -> fetch_array()) {
    //     echo "\n<li>".$row["name"]."</li>"; //$row["name"] - имя таблицы
    // }

}
function requestVkAPI($method, $params)
    {
        $url = 'https://api.vk.com/method/' . $method . '?' . $params . '&lang=ru&v=5.52';
        $options = [
            CURLOPT_USERAGENT => 'Kidris',
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER => [
                'Accept-Language: ru,en-us'
            ]
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
		
		if(!$res = curl_exec($ch)) {
			require_once('lib/ExceptionEngine.php');
            $exceptionEngine = new ExceptionEngine();
            $exceptionEngine->Logger("Ошибка " . curl_error($ch));
			return false;
		} else {
			$parsedResult = json_decode($res, true);
		}
		
		curl_close($ch);

		if (isset($parsedResult['error']) && $parsedResult['error']['error_code'] !== 14) {
            return false;
        } else {
			if (isset($parsedResult['response'])) {
				return $parsedResult['response'];
				} else {
				return $parsedResult;
			}
		}    }

?>