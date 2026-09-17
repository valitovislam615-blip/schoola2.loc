<?php
$logFilePath = __DIR__ . '/../log/' . PATH_LOG;

if (file_exists($logFilePath)) {
    $lines = file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    echo "<ol>";
    foreach ($lines as $line) {
        $data = explode('|', $line);
        if (count($data) >= 3) {
            $dt = date('d-m-Y H:i:s', (int)$data[0]);
            $page = htmlspecialchars($data[1]);
            $ref = htmlspecialchars($data[2]);
            
            echo "<li>$dt - $page ";
            if (!empty($ref)) {
                echo "&rarr; $ref";
            }
            echo "</li>";
        }
    }
    echo "</ol>";
} else {
    echo "<p>Журнал посещений пуст.</p>";
}
?>