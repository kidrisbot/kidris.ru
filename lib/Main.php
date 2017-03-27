<?php
class Main
{
	
    public function requestVkAPI($method, $params)
    {
        $url = 'https://api.vk.com/method/' . $method . '?' . $params . '&lang=ru&v=5.28';
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
     //var_dump($parsedResult);
		if (isset($parsedResult['error']) && $parsedResult['error']['error_code'] !== 14) {
            return false;
        } else {
			if (isset($parsedResult['response'])) {
				return $parsedResult['response'];
				} else {
				return $parsedResult;
			}
		}    }

    public function requestURL($url)
    {
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
        $response = curl_exec($ch);

        if (curl_error($ch)) {
            trigger_error('Ошибка при обращении к ссылке: ' . curl_errno($ch) . curl_error($ch));
            return false;
        } else {
            return $response;
        }
    }
	
	public function randString() {	
		return substr(md5(uniqid()), 0, 5);
	}
	
   
}