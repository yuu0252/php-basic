<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP+DB</title>
</head>

<body>
    <p>
        <?php

        $host = 'mysql';
        $dbname = $_ENV['MYSQL_DATABASE'];
        $username = 'root';
        $password = $_ENV['MYSQL_ROOT_PASSWORD'];

        try {
            $pdo = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $username, $password);
            echo 'データベースの接続に成功しました。';
        } catch (PDOException $e) {
            exit('データベースの接続に失敗しました。' . $e->getMessage());
        }
        ?>
    </p>
</body>

</html>