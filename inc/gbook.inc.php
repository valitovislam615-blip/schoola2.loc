<?php
/* Основные настройки */
define('DB_HOST', 'MySQL-8.4');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'gbook');

// Отключаем выброс фатальных ошибок PHP для MySQLi
mysqli_report(MYSQLI_REPORT_OFF);

// Подключение к базе данных
$link = @mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

if (!$link) {
    $link = @mysqli_connect('127.0.0.1', DB_LOGIN, DB_PASSWORD, DB_NAME, 3306);
}
if (!$link) {
    $link = @mysqli_connect('localhost', DB_LOGIN, DB_PASSWORD, DB_NAME);
}

if (!$link) {
    die('Ошибка подключения к базе данных: ' . mysqli_connect_error());
}

// Установка кодировки соединения
mysqli_set_charset($link, 'utf8');
/* Основные настройки */


/* Сохранение записи в БД */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Прием и фильтрация полученных данных
    $name = mysqli_real_escape_string($link, trim(strip_tags($_POST['name'])));
    $email = mysqli_real_escape_string($link, trim(strip_tags($_POST['email'])));
    $msg = mysqli_real_escape_string($link, trim(strip_tags($_POST['msg'])));

    if (!empty($name) && !empty($msg)) {
        // Формирование SQL-запроса на вставку данных
        $sql = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";

        // Выполнение запроса и проверка его корректности
        if (mysqli_query($link, $sql)) {
            $url = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href = '$url';</script>";
            exit;
        } else {
            echo 'Ошибка при сохранении записи: ' . mysqli_error($link);
        }
    } else {
        echo '<p style="color:red;">Заполните обязательные поля (Имя и Сообщение)!</p>';
    }
}
/* Сохранение записи в БД */


/* Удаление записи из БД */
if (isset($_GET['del'])) {
    // Прием и фильтрация полученных данных (приведение к целому числу)
    $del = (int)$_GET['del'];

    if ($del > 0) {
        // Формирование SQL-запроса на удаление
        $sql = "DELETE FROM msgs WHERE id = $del";

        // Выполнение запроса и проверка его корректности
        if (mysqli_query($link, $sql)) {
            echo "<script>window.location.href = 'index.php?id=gbook';</script>";
            exit;
        } else {
            echo 'Ошибка при удалении записи: ' . mysqli_error($link);
        }
    }
}
/* Удаление записи из БД */
?>

<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg" rows="5" cols="40"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>

<?php
/* Вывод записей из БД */
// SQL-запрос на выборку всех данных в обратном порядке
$sql = "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) as dt 
        FROM msgs 
        ORDER BY id DESC";

$result = mysqli_query($link, $sql);

// Закрытие соединения с сервером БД
mysqli_close($link);

if ($result) {
    // Получение количества записей
    $count = mysqli_num_rows($result);
    echo "<p>Всего записей в гостевой книге: $count</p>";

    // Вывод записей в цикле
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $msg = nl2br(htmlspecialchars($row['msg']));
        $dt = date('d-m-Y в H:i', $row['dt']);

        echo "<p>";
        if (!empty($email)) {
            echo "<a href=\"mailto:$email\">$name</a> ";
        } else {
            echo "$name ";
        }
        echo "$dt написал<br />$msg";
        echo "</p>";

        // Ссылка на удаление записи
        echo "<p align=\"right\">";
        echo "<a href=\"index.php?id=gbook&del=$id\">Удалить</a>";
        echo "</p><hr />";
    }
}
/* Вывод записей из БД */
?>