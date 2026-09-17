<?php 
  // Имя файла журнала
  define('PATH_LOG', 'path.log');

  // Подключение модулей работы с cookie и журнала посещений
  include 'inc/cookie.inc.php';
  include 'inc/log.inc.php';
  
  // Заголовки страницы и роутинг
  include 'inc/headers.inc.php'; 
?>
<!DOCTYPE html>
<html>

<head>
  <title>
    <?=$title?>
  </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="inc/style.css" />
</head>

<body>

  <div id="header">
    <!-- Верхняя часть страницы -->
    <img src="logo.gif" width="187" height="29" alt="Наш логотип" class="logo" />
    <span class="slogan">обо всём сразу</span>
    <!-- Верхняя часть страницы -->
  </div>

  <div id="content">
    <!-- Вывод информации о визитах пользователя на основе Cookie -->
    <?php
      if ($visitCounter <= 1) {
          echo "<p style='background: #e1f5fe; padding: 8px; border-radius: 4px;'>Спасибо, что зашли на огонек</p>";
      } else {
          echo "<p style='background: #e8f5e9; padding: 8px; border-radius: 4px;'>Вы зашли к нам <b>$visitCounter</b> раз(а)<br />";
          echo "Последнее посещение: <b>$lastVisit</b></p>";
      }
    ?>

    <!-- Заголовок -->
    <h1><?= $header?></h1>
    <!-- Заголовок -->

    <!-- Область основного контента -->
    <?php 
      include 'inc/routing.inc.php'; 
    ?>
    <!-- Область основного контента -->
  </div>

  <div id="nav">
    <!-- Навигация -->
    <h2>Навигация по сайту</h2>
    <ul>
      <li><a href='index.php'>Домой</a></li>
      <li><a href='index.php?id=contact'>Контакты</a></li>
      <li><a href='index.php?id=about'>О нас</a></li>
      <li><a href='index.php?id=info'>Информация</a></li>
      <li><a href='index.php?id=gbook'>Гостевая книга</a></li>
      <li><a href='index.php?id=log'>Журнал посещений</a></li>
    </ul>
    <!-- Навигация -->
  </div>

  <div id="footer">
    <!-- Нижняя часть страницы -->
    &copy; Супер-мега сайт, 2000 &ndash; <?= date('Y')?>
    <!-- Нижняя часть страницы -->
  </div>

</body>
</html>