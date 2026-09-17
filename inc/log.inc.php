<?php
$dt = time();
$page = $_SERVER['REQUEST_URI'];
$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

// Формируем строку записи с разделителем "|"
$path = "$dt|$page|$ref\n";

// Путь к файлу логов в папке log
$logFilePath = __DIR__ . '/../log/' . PATH_LOG;

// Записываем строку в лог-файл в фоновом режиме
file_put_contents($logFilePath, $path, FILE_APPEND);
?>