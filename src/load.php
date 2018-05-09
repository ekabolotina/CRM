<?php

session_start();

define('DEV_MODE', true);

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
define('CONFIG_PATH', constant('ROOT_PATH') . 'config.yml');
define('CONTROLLERS_PATH', 'controller/');
define('VIEWS_DIR', 'view');
define('STATIC_PATH', constant('ROOT_PATH') . 'static/');
define('UPLOAD_DIR', constant('STATIC_PATH') . 'img/uploads/');
define('MODULE_PATH', constant('ROOT_PATH') . 'src/module/');

define('ROLE_ADMIN', 1);
define('ROLE_COMPANY', 2);
define('ROLE_BRANCH', 3);

require_once constant('ROOT_PATH') . 'vendor/autoload.php';
require_once 'connect.php';
require_once constant('MODULE_PATH') . 'mail/mail.php';
