<?php
class Controller {
    private $reservedControllers = ['auth','com','admin', 'main', 'dash', 'stats', 'stati', 'api', 'dev','starter', 'api_comment','noscript', 404];
    public function __construct($params)
    {
        if (empty($params['route'])) {
            $this->loadModel('main');
        } else {
            $controller = explode('/', $params['route']);

            if (in_array($controller[0], $this->reservedControllers)) {
                $this->loadModel($controller[0]);
            
            } else {
                $this->loadModel('ask');
            }        }    }

    private function loadModel($controller)
	{
        if ($controller !== 'ask') {
            if (!is_file("models/{$controller}.php") && !in_array($controller, $this->reservedControllers)) {
                header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
				require_once("models/404.php");
            } else {
                require_once("models/{$controller}.php");
            }
        } else {
            require_once("models/ask.php");
        }    } }