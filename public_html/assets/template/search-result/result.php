<?php

if (!class_exists('modX')) {
  echo "Доступ запрещен";
  die();
}

?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Воинское звание</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Имя</th>
      <th scope="col">Отчество</th>
      <th scope="col">Дата рождения</th>
      <th scope="col">Место рождения</th>
      <th scope="col">Дата призыва</th>
      <th scope="col">Кем призван</th>
      <th scope="col">Дата гибели (смерти)</th>
      <th scope="col">Сведения о награждении</th>
      <th scope="col">Кем представлены</th>
      <th scope="col">Прим.</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach ($mans as $arrMan) {
    ?>
    <tr>
      <th scope="row"><?=$i?></th>
      <td><?= $arrMan['rank'] ?></td>
      <td><?= $arrMan['lastname'] ?></td>
      <td><?= $arrMan['firstname'] ?></td>
      <td><?= $arrMan['patronymic'] ?></td>
      <td><?= $arrMan['birthdate'] ?></td>
      <td><?= $arrMan['birthplace'] ?></td>
      <td><?= $arrMan['calldate'] ?></td>
      <td><?= $arrMan['callplace'] ?></td>
      <td><?= $arrMan['deathdate'] ?></td>
      <td><?= $arrMan['awards'] ?></td>
      <!-- <td><?= $arrMan['photo'] ?></td> -->
      <td><?= $arrMan['provider'] ?></td>
      <td><?= $arrMan['note'] ?></td>
    </tr>
    <?php
      $i ++;
      } ?>
  </tbody>