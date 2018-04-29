<?php

session_start();

define('DEV_MODE', true);

define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');
define('CONFIG_PATH', constant('ROOT_PATH') . 'config.yml');
define('CONTROLLERS_PATH', 'controller/');
define('STATIC_PATH', constant('ROOT_PATH') . 'static/');
define('UPLOAD_DIR', constant('STATIC_PATH') . 'img/uploads/');

require_once constant('ROOT_PATH') . 'vendor/autoload.php';
require_once 'connect.php';
