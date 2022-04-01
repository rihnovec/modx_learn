<?php

$arrPeople = [];

if (($handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/import-csv/people.csv', 'r')) !== FALSE) { // Check the resource is valid
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!
      $arrPeople[] = $data;
  }
  fclose($handle);
}

return $arrPeople;
