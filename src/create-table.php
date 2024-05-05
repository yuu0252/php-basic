<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP+DB</title>
</head>

<body>
    <p>
        <?php
        $database = $_ENV['MYSQL_DATABASE'];
        $dsn = "mysql:dbname={$database};host=mysql;charset=utf8mb4";
        $user = 'root';
        $password = $_ENV['MYSQL_PASSWORD'];

        try {
            $pdo = new PDO($dsn, $user, $password);

            $sql = 'CREATE TABLE IF NOT EXISTS users (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(60) NOT NULL,
                furigana VARCHAR(60) NOT NULL,
                email VARCHAR(255) NOT NULL,
                age INT(11),
                address VARCHAR(255)
                )';

            $pdo->query($sql);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
        ?>
    </p>
</body>

</html>