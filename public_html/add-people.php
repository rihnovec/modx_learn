<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
require_once MODX_CORE_PATH.'xpdo/xpdo.class.php';

$modx = new modX();

$modxConfig = $modx->getConfig();
$dsn = $modxConfig['dsn'];
$database_user = $modxConfig['username'];
$database_password = $modxConfig['password'];
$tablePrefix = $modxConfig['table_prefix'];

$xpdo = new xPDO($dsn, $database_user, $database_password);

$xpdo->setLogLevel(xPDO::LOG_LEVEL_INFO);
$xpdo->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

if (!$xpdo->addPackage('Man', $_SERVER['DOCUMENT_ROOT'] . '/model/', $tablePrefix)) {
  print 'Возникли проблемы при установке вашего пакета';
} else {
  $manager = $xpdo->getManager();
  if (!$manager) {
    print 'Не удалось получить менеджер';
  }
  
  if (!$manager->createObjectContainer('Man')) {
    print 'Не удалось создать таблицу Man';
  }

  $man = $xpdo->newObject('Man', [
    'name' => 'Anton Rikhnovets'
  ]);

  if (!$man) {
    print 'Не удалось создать новый объект Man';
  } else {
    print 'Сохраняем';
    $man->save();
  }
}
