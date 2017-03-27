<?php

/**
 * Kidris Engine
 * Инициализация движка
 */

session_start();

error_reporting (E_ALL);

require_once('lib/Loader.php');
new Controller($_GET);
