<?php
$title = 'Супер-мега сайт';
$header = 'Добро пожаловать!';

$id = isset($_GET['id']) ? strtolower(strip_tags(trim($_GET['id']))) : '';

switch ($id) {
    case 'contact':
        $title = 'Контакты';
        $header = 'Наши контакты';
        break;
    case 'about':
        $title = 'О нас';
        $header = 'О нашем сайте';
        break;
    case 'info':
        $title = 'Информация';
        $header = 'Полезная информация';
        break;
    case 'log':
        $title = 'Журнал посещений';
        $header = 'Журнал посещений';
        break;
    case 'gbook':
        $title = 'Гостевая книга';
        $header = 'Наша гостевая книга';
        break;
}
?>