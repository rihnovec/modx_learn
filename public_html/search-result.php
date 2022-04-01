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
$name = $_REQUEST['name'];

if (!$xpdo->addPackage('People', $_SERVER['DOCUMENT_ROOT'] . '/model/', $tablePrefix)) {
  echo 'Возникли проблемы при установке вашего пакета';
} else {
  $mans = [];

  $results = $xpdo->query("SELECT *, CONCAT(lastname, ' ', firstname, ' ', patronymic) as fullname FROM modx_people HAVING fullname LIKE '%$name%'");

  while ($resultItem = $results->fetch(PDO::FETCH_ASSOC)) {
    $mans[] = $resultItem;
  }

  
  if (count($mans) === 0) {
    echo "По вашему запросу ничего не найдено";
  } else {
    include $_SERVER['DOCUMENT_ROOT'] . '/assets/template/search-result/result.php';
  }
}