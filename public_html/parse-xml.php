<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
require_once MODX_CORE_PATH.'xpdo/xpdo.class.php';

$modx = new modX();

$modxConfig = $modx->getConfig();
$dsn = $modxConfig['dsn'];
$database_user = $modxConfig['database_user'];
$database_password = $modxConfig['database_password'];


$xpdo = new xPDO($dsn, $database_user, $database_password);

$xpdo->setLogLevel(xPDO::LOG_LEVEL_INFO);
$xpdo->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$manager = $xpdo->getManager();
$generator = $manager->getGenerator();

$schema = $_SERVER['DOCUMENT_ROOT'] . '/scheme/people.xml';
$target = $_SERVER['DOCUMENT_ROOT'] . '/model/';
$generator->parseSchema($schema,$target);

echo "Файлы модели созданы";

// $xpdo->setLogLevel(xPDO::LOG_LEVEL_INFO);
// $xpdo->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
