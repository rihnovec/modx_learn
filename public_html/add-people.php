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

if (!$xpdo->addPackage('People', $_SERVER['DOCUMENT_ROOT'] . '/model/', $tablePrefix)) {
  print 'Возникли проблемы при установке вашего пакета';
} else {
  $manager = $xpdo->getManager();
  if (!$manager) {
    print 'Не удалось получить менеджер';
  }
  
  if (!$manager->createObjectContainer('People')) {
    print 'Не удалось создать таблицу People';
  }

  $arrPeople = include $_SERVER['DOCUMENT_ROOT'] . '/parse-csv.php';

  foreach ($arrPeople as $man) {
    $people = $xpdo->newObject('People', [
      'rank' => $man[1],
      'lastname' => $man[2],
      'firstname' => $man[3],
      'patronymic' => $man[4],
      'birthdate' => $man[5],
      'birthplace' => $man[6],
      'calldate' => $man[7],
      'callplace' => $man[8],
      'deathdate' => $man[9],
      'awards' => $man[10],
      'photo' => $man[11],
      'provider' => $man[12],
      'note' => $man[13]
    ]);
  
    if (!$people) {
      print 'Не удалось создать новый объект People';
    } else {
      print "Сохраняем $man[2] $man[3] $man[4] <br>";
      $people->save();
    }
  }
}
