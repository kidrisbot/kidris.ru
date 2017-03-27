<?php
if(!empty($_POST["music"]))
{ //Принимаем данные
    $_POST["music"] = str_replace(" ", "%20",$_POST["music"]);
    $music = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["music"]))));
    $request = requestVkAPI('audio.search', "q={$music}&auto_complete=1&sort=2&access_token=ef584b3652783460d14239a4d83be48f2a41f9ba1cd1ddaa5288584768f23193ff5852c8e0f81dc6d2207");
    if(isset($request['error'])) 
    {
      //  echo  '<div class="list-group-item list-group-item-danger"> Вк снова упал! </div>';
    }
    else 
    {
        if (!isset($request["items"]))  {// echo  ' <br><div class="list-group-item list-group-item-warning"> Загрузка аудио! </div><br>';   
    }
        else
        {
            echo ' <select class="form-control" id="search_result_mu" size="5"  name="search_music[]" multiple  onchange="run()"> ';
            foreach ($request["items"] as $key => $video) 
            {
                if (strlen(htmlspecialchars($video["title"])) > 50 ) 
                    $video["title"] = mb_substr($video["title"],0,50, 'UTF-8').'...';    
                echo "\n<option value=\"".$video['owner_id']."_".$video['id']."\">".$video['title']."</option>"; 
            }
            echo ' </select> ';
        }
       // if (count($request["items"]) < 1) echo  '<br><div class="list-group-item list-group-item-danger"> Нет аудиозаписей! </div><br>';
    }
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